<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Cat;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function create(Cat $cat)
    {
        if ($cat->status !== 'Available') {
            return redirect()->route('cats.show', $cat)
                ->with('error', 'This cat is no longer available for adoption.');
        }

        $existingApplication = Adoption::where('user_id', auth()->id())
            ->where('cat_id', $cat->id)
            ->whereNotIn('status', ['Rejected'])
            ->first();

        return view('adoptions.apply', compact('cat', 'existingApplication'));
    }

    public function store(Request $request, Cat $cat)
    {
        $request->validate([
            'full_name'        => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'required|string|max:500',
            'living_situation' => 'required|in:house,apartment,condo,other',
            'reason'           => 'required|string|min:20|max:1000',
            'pet_experience'   => 'required|string|max:500',
            'other_pets'       => 'nullable|string|max:255',
            'agree_terms'      => 'accepted',
        ]);

        $existing = Adoption::where('user_id', auth()->id())
            ->where('cat_id', $cat->id)
            ->whereNotIn('status', ['Rejected'])
            ->first();

        if ($existing) {
            return redirect()->route('cats.show', $cat)
                ->with('error', 'You already have an active application for this cat.');
        }

        Adoption::create([
            'user_id'            => auth()->id(),
            'cat_id'             => $cat->id,
            'status'             => 'Pending',
            'pipeline_stage'     => 'New',
            'application_details' => [
                'full_name'        => $request->full_name,
                'phone'            => $request->phone,
                'address'          => $request->address,
                'living_situation' => $request->living_situation,
                'reason'           => $request->reason,
                'pet_experience'   => $request->pet_experience,
                'other_pets'       => $request->other_pets ?? 'None',
            ],
            'checklist' => Adoption::defaultChecklist(),
        ]);

        return redirect()->route('adoptions.submitted', $cat)
            ->with('success', 'Your adoption application has been submitted!');
    }

    public function submitted(Cat $cat)
    {
        return view('adoptions.submitted', compact('cat'));
    }
}
