<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('reports', 'public');
        }

        Report::create([
            'user_id' => auth()->id(),
            'type' => $validated['type'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'photo_path' => $path,
            'reporter_name' => auth()->user()->name,
            'reporter_contact' => auth()->user()->phone ?? auth()->user()->email,
        ]);

        return redirect()->route('home')->with('success', 'Report submitted successfully.');
    }
}
