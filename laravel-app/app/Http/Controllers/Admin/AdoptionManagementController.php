<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;

class AdoptionManagementController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::with(['user', 'cat'])->paginate(15);
        return view('admin.adoptions.index', compact('adoptions'));
    }

    public function pipeline()
    {
        $columns = [
            'Pending'  => Adoption::with(['user', 'cat'])->where('status', 'Pending')->latest()->get(),
            'Approved' => Adoption::with(['user', 'cat'])->where('status', 'Approved')->latest()->get(),
            'Rejected' => Adoption::with(['user', 'cat'])->where('status', 'Rejected')->latest()->get(),
            'Archived' => Adoption::with(['user', 'cat'])->where('status', 'Archived')->latest()->get(),
        ];
        $recent = Adoption::with(['user', 'cat'])->latest()->take(6)->get();
        return view('admin.adoptions.pipeline', compact('columns', 'recent'));
    }

    public function show(Adoption $adoption)
    {
        $adoption->load(['user', 'cat']);
        return view('admin.adoptions.show', compact('adoption'));
    }

    public function approve(Adoption $adoption)
    {
        $adoption->update(['status' => 'Approved']);
        return redirect()->back()->with('success', 'Adoption approved successfully.');
    }

    public function reject(Adoption $adoption)
    {
        $adoption->update(['status' => 'Rejected']);
        return redirect()->back()->with('success', 'Adoption rejected successfully.');
    }

    public function destroy(Adoption $adoption)
    {
        $adoption->delete();
        return redirect()->route('admin.adoptions.index')->with('success', 'Adoption record deleted.');
    }
}
