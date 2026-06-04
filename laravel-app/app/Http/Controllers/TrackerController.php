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
        $cats = Cat::with('gpsDevice')->get();

        foreach ($cats as $cat) {
            $gpsDevice = $cat->gpsDevice;

            if ($gpsDevice && $gpsDevice->is_active) {
                $liveLocation = null;

                try {
                    $liveLocation = $this->gpsService->getLocation($gpsDevice->imei);
                } catch (\Exception $e) {
                    Log::error("Failed to get live GPS for {$cat->name}: " . $e->getMessage());
                }

                if ($liveLocation && isset($liveLocation['lat'], $liveLocation['lng'])
                    && $liveLocation['lat'] && $liveLocation['lng']) {

                    // Persist only real DB columns
                    $cat->timestamps    = false;
                    $cat->gps_lat       = $liveLocation['lat'];
                    $cat->gps_lng       = $liveLocation['lng'];
                    $cat->gps_timestamp = $liveLocation['timestamp'] ?? now()->toDateTimeString();
                    $cat->save();

                    // View-only flag (not a DB column)
                    $cat->gps_live = true;

                    $gpsDevice->update([
                        'last_known_lat' => $liveLocation['lat'],
                        'last_known_lng' => $liveLocation['lng'],
                        'last_sync_at'   => now(),
                    ]);

                    Log::info("Bits GPS synced: [{$liveLocation['lat']}, {$liveLocation['lng']}] bat={$liveLocation['battery']}%");
                } else {
                    // Fall back to last saved location
                    $cat->gps_live = false;
                }
            }
        }

        return view('tracker', compact('cats'));
    }

    public function liveGps()
    {
        $imei = config('gps.tracker_imei');

        if (!$imei) {
            return response()->json(['error' => 'GPS not configured'], 503);
        }

        try {
            $location = $this->gpsService->getLocation($imei);

            if (!$location || !isset($location['lat'], $location['lng'])) {
                return response()->json(['error' => 'No GPS fix'], 404);
            }

            // Sync to database
            $cat = Cat::where('name', 'Bits')->first();
            if ($cat) {
                $cat->timestamps = false;
                $cat->gps_lat = $location['lat'];
                $cat->gps_lng = $location['lng'];
                $cat->save();

                $gpsDevice = $cat->gpsDevice;
                if ($gpsDevice) {
                    $gpsDevice->update([
                        'last_known_lat' => $location['lat'],
                        'last_known_lng' => $location['lng'],
                        'last_sync_at'   => now(),
                    ]);
                }
            }

            return response()->json([
                'lat'       => $location['lat'],
                'lng'       => $location['lng'],
                'battery'   => $location['battery'],
                'timestamp' => $location['timestamp'],
                'speed'     => $location['speed'],
            ]);
        } catch (\Exception $e) {
            Log::error('GPS live endpoint error: ' . $e->getMessage());
            return response()->json(['error' => 'GPS fetch failed'], 500);
        }
    }
}
