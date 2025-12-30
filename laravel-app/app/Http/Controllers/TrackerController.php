<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    public function __invoke()
    {
        $cats = Cat::all();
        return view('tracker', compact('cats'));
    }
}
