<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index(Request $request)
    {
        $query = Cat::query();

        if ($request->has('breed')) {
            $query->where('breed', $request->breed);
        }
        if ($request->has('age')) {
            $query->where('age', $request->age);
        }

        $cats = $query->where('status', 'Available')->get();

        return view('cats.index', compact('cats'));
    }

    public function show(Cat $cat)
    {
        return view('cats.show', compact('cat'));
    }
}
