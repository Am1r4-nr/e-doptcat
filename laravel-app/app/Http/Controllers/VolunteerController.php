<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function create()
    {
        return view('volunteers.apply');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'matric'       => 'nullable|string|max:20',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'program'      => 'nullable|string|max:255',
            'availability' => 'required|in:weekday,weekend,both,flexible',
            'avail_time'   => 'required|in:morning,afternoon,evening,anytime',
            'skills'       => 'nullable|array',
            'skills.*'     => 'string|max:50',
            'experience'   => 'nullable|string|max:1000',
            'bio'          => 'required|string|min:20|max:1000',
            'agree_terms'  => 'accepted',
        ]);

        Volunteer::create([
            'name'         => $request->name,
            'matric'       => $request->matric,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'program'      => $request->program,
            'availability' => $request->availability,
            'avail_time'   => $request->avail_time,
            'skills'       => $request->skills ?? [],
            'experience'   => $request->experience,
            'bio'          => $request->bio,
            'status'       => 'PENDING',
            'applied_at'   => now()->toDateString(),
        ]);

        return redirect()->route('volunteers.thanks');
    }

    public function thanks()
    {
        return view('volunteers.thanks');
    }
}
