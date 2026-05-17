<?php

namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Report;
use App\Services\GpsTrackerService;
use Illuminate\Support\Facades\Log;
 
class ReportingController extends Controller
{
    protected $gpsService;
 
    public function __construct(GpsTrackerService $gpsService)
    {
        $this->gpsService = $gpsService;
    }
 
    public function index()
    {
        $lostFoundReports = Report::with('user')
            ->whereIn('type', ['Lost', 'Found'])
            ->latest()
            ->get();
 
        $catsWithGps = Cat::whereNotNull('gps_lat')
            ->orWhereHas('gpsDevices')
            ->get();
 
        // Sync Live GPS data (same logic as user side)
        foreach ($catsWithGps as $cat) {
            $gpsDevice = $cat->gpsDevice ?? $cat->gpsDevices()->first();
            if ($gpsDevice && (strtolower($cat->name) === 'bits' || strtolower($cat->name) === 'florian')) {
                try {
                    $liveLocation = $this->gpsService->getLocation($gpsDevice->imei);
                    if ($liveLocation && isset($liveLocation['lat'], $liveLocation['lng'])) {
                        $cat->gps_lat = $liveLocation['lat'];
                        $cat->gps_lng = $liveLocation['lng'];
                        $cat->gps_battery = $liveLocation['battery'] ?? null;
                        $cat->gps_live = true;
                    }
                } catch (\Exception $e) {
                    Log::error("Admin: Failed to get live GPS for {$cat->name}: " . $e->getMessage());
                }
            }
        }
 
        return view('admin.reporting.index', compact(
            'lostFoundReports',
            'catsWithGps',
        ));
    }
}
