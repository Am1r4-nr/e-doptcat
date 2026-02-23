<?php

namespace App\Http\Controllers;

use App\Models\GpsDevice;
use App\Services\GpsTrackerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GpsDeviceController extends Controller
{
    protected $gpsService;

    public function __construct(GpsTrackerService $gpsService)
    {
        $this->gpsService = $gpsService;
    }

    /**
     * Display a listing of GPS devices
     */
    public function index()
    {
        $devices = GpsDevice::with('cat')->get();
        return view('admin.gps-devices.index', compact('devices'));
    }

    /**
     * Store a newly created GPS device
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'imei' => 'required|unique:gps_devices,imei',
            'device_name' => 'required|string',
            'cat_id' => 'required|exists:cats,id',
        ]);

        GpsDevice::create($validated);

        return redirect()->route('gps.devices.index')->with('success', 'GPS device registered successfully');
    }

    /**
     * Delete a GPS device
     * @param GpsDevice $device
     */
    public function destroy(GpsDevice $device)
    {
        $device->delete();
        return redirect()->route('gps.devices.index')->with('success', 'GPS device deleted');
    }

    /**
     * Toggle GPS device active status
     * @param GpsDevice $device
     */
    public function toggle(GpsDevice $device)
    {
        $device->update(['is_active' => !$device->is_active]);
        return redirect()->route('gps.devices.index')->with('success', 'GPS device status updated');
    }

    /**
     * Sync a single GPS device location
     * @param GpsDevice $device
     */
    public function syncDevice(GpsDevice $device)
    {
        try {
            /** @var GpsDevice $device */
            $location = $this->gpsService->getLocation($device->imei);

            if ($location && isset($location['lat'], $location['lng'])) {
                /** @var GpsDevice $device */
                $device->history()->create([
                    'latitude' => $location['lat'],
                    'longitude' => $location['lng'],
                    'accuracy' => $location['accuracy'] ?? null,
                    'timestamp' => $location['timestamp'] ?? now(),
                ]);

                // Update cat's location
                $device->cat->update([
                    'gps_lat' => $location['lat'],
                    'gps_lng' => $location['lng'],
                ]);

                Log::info("Synced GPS device {$device->imei}");
                return response()->json(['success' => true, 'message' => 'Location synced']);
            }

            return response()->json(['success' => false, 'message' => 'No location data'], 400);
        } catch (\Exception $e) {
            Log::error("Sync failed for {$device->imei}: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Sync failed'], 500);
        }
    }

    /**
     * Sync all GPS devices
     */
    public function syncAll()
    {
        $devices = GpsDevice::where('is_active', true)->get();
        $synced = 0;

        /** @var GpsDevice $device */
        foreach ($devices as $device) {
            try {
                $location = $this->gpsService->getLocation($device->imei);

                if ($location && isset($location['lat'], $location['lng'])) {
                    $device->history()->create([
                        'latitude' => $location['lat'],
                        'longitude' => $location['lng'],
                        'accuracy' => $location['accuracy'] ?? null,
                        'timestamp' => $location['timestamp'] ?? now(),
                    ]);

                    $device->cat->update([
                        'gps_lat' => $location['lat'],
                        'gps_lng' => $location['lng'],
                    ]);

                    $synced++;
                }
            } catch (\Exception $e) {
                Log::error("Sync failed for {$device->imei}: " . $e->getMessage());
            }
        }

        return response()->json(['success' => true, 'synced' => $synced, 'total' => count($devices)]);
    }

    /**
     * Get location history for a device
     * @param GpsDevice $device
     */
    public function history(GpsDevice $device)
    {
        $history = $device->history()->latest('timestamp')->paginate(50);
        return view('admin.gps-devices.history', compact('device', 'history'));
    }

    /**
     * Test connection to 365GPS API
     */
    public function testConnection()
    {
        try {
            $isConnected = $this->gpsService->testConnection();
            return response()->json([
                'success' => true,
                'connected' => $isConnected,
                'message' => $isConnected ? 'GPS API connection successful' : 'GPS API connection failed'
            ]);
        } catch (\Exception $e) {
            Log::error("GPS connection test failed: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Connection test error: ' . $e->getMessage()
            ], 500);
        }
    }
}
