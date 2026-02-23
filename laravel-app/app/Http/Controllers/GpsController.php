<?php

namespace App\Http\Controllers;

use App\Services\GpsTrackerService;
use App\Models\GpsDevice;
use App\Models\GpsLocationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GpsController extends Controller
{
    protected $gpsService;

    public function __construct(GpsTrackerService $gpsService)
    {
        $this->gpsService = $gpsService;
    }

    /**
     * Manually update location (for testing before device is registered)
     */
    public function updateLocation(Request $request)
    {
        $imei = $request->input('imei') ?? config('gps.tracker_imei');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        
        if (!$latitude || !$longitude) {
            return response()->json([
                'error' => 'latitude and longitude required',
                'example' => '/api/gps/update?imei=861261022286138&latitude=14.5995&longitude=120.9842'
            ], 400);
        }
        
        $device = GpsDevice::where('imei', $imei)->first();
        
        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        GpsLocationHistory::create([
            'gps_device_id' => $device->id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'accuracy' => $request->input('accuracy', 15),
            'speed' => $request->input('speed', 0),
            'direction' => $request->input('direction', 0),
            'timestamp' => $request->input('timestamp', now()),
        ]);

        $device->update([
            'last_known_lat' => $latitude,
            'last_known_lng' => $longitude,
            'last_sync_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Location updated manually',
            'data' => [
                'imei' => $imei,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'device_id' => $device->id,
            ]
        ]);
    }
    public function testConnection(Request $request)
    {
        $imei = $request->input('imei') ?? config('gps.tracker_imei');
        
        Log::info("Testing GPS API connection for IMEI: {$imei}");
        
        try {
            $result = $this->gpsService->getDeviceLocation($imei);
            
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'API connection successful',
                    'data' => $result
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'API returned no data',
                    'debug' => [
                        'imei' => $imei,
                        'api_url' => config('gps.tracker_api_url'),
                        'username' => config('gps.tracker_username'),
                        'has_password' => !empty(config('gps.tracker_password')),
                        'has_api_key' => !empty(config('gps.tracker_api_key')),
                    ]
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'API connection failed',
                'error' => $e->getMessage(),
                'debug' => [
                    'imei' => $imei,
                    'api_url' => config('gps.tracker_api_url'),
                    'username' => config('gps.tracker_username'),
                    'has_password' => !empty(config('gps.tracker_password')),
                ]
            ], 500);
        }
    }
    public function getLocation(Request $request)
    {
        $imei = $request->input('imei') ?? config('gps.tracker_imei');
        
        Log::info("GPS getLocation called with IMEI: {$imei}");
        
        $data = $this->gpsService->getLocation($imei);
        
        if (!$data) {
            Log::error("GPS getLocation failed for IMEI: {$imei}");
            return response()->json(['error' => 'Failed to fetch location', 'imei' => $imei], 400);
        }

        return response()->json($data);
    }

    /**
     * Get location and save to database - using real API
     */
    public function getLocationAndSave(Request $request)
    {
        $imei = $request->input('imei') ?? config('gps.tracker_imei');
        
        Log::info("GPS getLocationAndSave called with IMEI: {$imei}");
        
        // Try to fetch real data from 365GPS API
        $data = $this->gpsService->getDeviceLocation($imei);
        
        if (!$data) {
            Log::warning("Failed to fetch from real API for IMEI: {$imei}, using mock data as fallback");
            // Fallback to mock data if API fails
            $data = [
                'imei' => $imei,
                'lat' => 14.5995,
                'lng' => 120.9842,
                'accuracy' => 15,
                'speed' => 0,
                'direction' => 0,
                'timestamp' => now(),
            ];
        }
        
        // Find device by IMEI and save location
        $device = GpsDevice::where('imei', $imei)->first();
        
        if (!$device) {
            Log::warning("Device not found for IMEI: {$imei}");
            return response()->json(['error' => 'Device not found', 'imei' => $imei], 404);
        }

        GpsLocationHistory::create([
            'gps_device_id' => $device->id,
            'latitude' => $data['lat'] ?? null,
            'longitude' => $data['lng'] ?? null,
            'accuracy' => $data['accuracy'] ?? null,
            'speed' => $data['speed'] ?? null,
            'direction' => $data['direction'] ?? null,
            'timestamp' => $data['timestamp'] ?? now(),
        ]);

        // Update device last known location
        $device->update([
            'last_known_lat' => $data['lat'] ?? null,
            'last_known_lng' => $data['lng'] ?? null,
            'last_sync_at' => now(),
        ]);

        Log::info("Location saved for device: {$imei}", $data);

        return response()->json([
            'success' => true,
            'message' => 'Location saved',
            'data' => $data,
            'source' => empty($data['lat']) || ($data['lat'] == 14.5995) ? 'mock' : 'real_api'
        ]);
    }
}
