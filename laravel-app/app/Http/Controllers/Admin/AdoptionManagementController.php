<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use Illuminate\Http\Request;

class AdoptionManagementController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::with(['user', 'cat'])->paginate(15);
        return view('admin.adoptions.index', compact('adoptions'));
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
