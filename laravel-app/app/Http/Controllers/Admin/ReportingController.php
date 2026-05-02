<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Report;

class ReportingController extends Controller
{
    public function index()
    {
        $lostFoundReports = Report::with('user')
            ->whereIn('type', ['Lost', 'Found'])
            ->latest()
            ->get();

        $catsWithGps = Cat::whereNotNull('gps_lat')
            ->whereNotNull('gps_lng')
            ->get(['id', 'name', 'breed', 'status', 'health_status', 'gps_lat', 'gps_lng', 'image', 'location_name']);

        return view('admin.reporting.index', compact(
            'lostFoundReports',
            'catsWithGps',
        ));
    }
}
