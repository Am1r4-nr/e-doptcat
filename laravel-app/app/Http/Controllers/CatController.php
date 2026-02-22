<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index(Request $request)
    {
        $query = Cat::query();

        // Filter by breed
        if ($request->has('breed') && $request->breed != '') {
            $query->where('breed', $request->breed);
        }

        // Filter by health status
        if ($request->has('health_status') && $request->health_status != '') {
            $query->where('health_status', $request->health_status);
        }

        // Filter by vaccinated status
        if ($request->has('vaccinated') && $request->vaccinated != '') {
            $query->where('vaccinated', $request->vaccinated);
        }

        // Filter by location
        if ($request->has('location') && $request->location != '') {
            $query->where('location_name', $request->location);
        }

        $cats = $query->where('status', 'Available')->get();

        return view('cats.index', compact('cats'));
    }

    public function show(Cat $cat)
    {
        return view('cats.show', compact('cat'));
    }
}
