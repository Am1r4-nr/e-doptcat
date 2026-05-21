<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use Illuminate\Http\Request;

class AdoptionManagementController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::with(['user', 'cat'])->latest()->paginate(15);

        $pendingCount  = Adoption::where('status', 'Pending')->count();
        $approvedCount = Adoption::where('status', 'Approved')->count();
        $archivedCount = Adoption::where('status', 'Archived')->count();

        return view('admin.adoptions.index', compact(
            'adoptions', 'pendingCount', 'approvedCount', 'archivedCount'
        ));
    }

    public function pipeline()
    {
        $stages = ['New', 'Inquiry', 'Screening', 'Matching', 'Approved'];
        $columns = [];
        foreach ($stages as $stage) {
            $columns[$stage] = Adoption::with(['user', 'cat'])
                ->where('pipeline_stage', $stage)
                ->latest()
                ->get()
                ->map(function ($a) {
                    $a->checklist = $a->checklist ?? Adoption::defaultChecklist();
                    return $a;
                });
        }
        $recent = Adoption::with(['user', 'cat'])->latest()->take(6)->get();
        return view('admin.adoptions.pipeline', compact('columns', 'recent'));
    }

    public function updateChecklist(Request $request, Adoption $adoption)
    {
        $request->validate(['stage' => 'required|string', 'checklist' => 'required|array']);
        $full = $adoption->checklist ?? Adoption::defaultChecklist();
        $full[$request->stage] = $request->checklist;
        $adoption->update(['checklist' => $full]);
        return response()->json(['success' => true]);
    }

    public function moveStage(Request $request, Adoption $adoption)
    {
        $request->validate(['stage' => 'required|in:New,Inquiry,Screening,Matching,Approved']);
        $adoption->update(['pipeline_stage' => $request->stage]);
        return response()->json(['success' => true]);
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
