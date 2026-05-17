<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Services\GpsTrackerService;
use Illuminate\Support\Facades\Log;

class TrackerController extends Controller
{
    protected $gpsService;

    public function __construct(GpsTrackerService $gpsService)
    {
        $this->gpsService = $gpsService;
    }

    public function __invoke()
    {
        $cats = Cat::all();
        
        // Add GPS location data from gps_location_histories or live GPS tracker
        foreach ($cats as $cat) {
            // Find the GPS device for this cat
            $gpsDevice = $cat->gpsDevice ?? $cat->gpsDevices()->first();
            
            if ($gpsDevice) {
                // Check if this cat is Bits - if so, get LIVE data from GPS tracker
                if (strtolower($cat->name) === 'bits' || strtolower($cat->name) === 'florian') {
                    try {
                        // Fetch live location from 365GPS.net
                        $liveLocation = $this->gpsService->getLocation($gpsDevice->imei);
                        
                        if ($liveLocation && isset($liveLocation['lat'], $liveLocation['lng'])) {
                            $cat->gps_lat = $liveLocation['lat'];
                            $cat->gps_lng = $liveLocation['lng'];
                            $cat->gps_accuracy = $liveLocation['accuracy'] ?? null;
                            $cat->gps_timestamp = $liveLocation['timestamp'] ?? now();
                            $cat->gps_battery = $liveLocation['battery'] ?? null;
                            $cat->gps_live = true; // Mark as live data
                            
                            Log::info("{$cat->name} GPS location fetched LIVE from 365GPS: [{$cat->gps_lat}, {$cat->gps_lng}]");
                        }
                    } catch (\Exception $e) {
                        Log::error("Failed to get live GPS for {$cat->name}: " . $e->getMessage());
                        
                        // Fallback to database if live fetch fails
                        $latestLocation = $gpsDevice->history()->latest('timestamp')->first();
                        if ($latestLocation) {
                            $cat->gps_lat = $latestLocation->latitude;
                            $cat->gps_lng = $latestLocation->longitude;
                            $cat->gps_accuracy = $latestLocation->accuracy;
                            $cat->gps_timestamp = $latestLocation->timestamp;
                            $cat->gps_live = false;
                        }
                    }
                } else {
                    // For other cats, use synced database locations
                    $latestLocation = $gpsDevice->history()->latest('timestamp')->first();
                    
                    if ($latestLocation) {
                        $cat->gps_lat = $latestLocation->latitude;
                        $cat->gps_lng = $latestLocation->longitude;
                        $cat->gps_accuracy = $latestLocation->accuracy;
                        $cat->gps_timestamp = $latestLocation->timestamp;
                        $cat->gps_live = false;
                    }
                }
            }
        }
        
        return view('tracker', compact('cats'));
    }
}
