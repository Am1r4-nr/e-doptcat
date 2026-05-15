<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Cat;
use Illuminate\Http\Request;

class IncidentManagementController extends Controller
{
    /**
     * Display a listing of incidents.
     */
    public function index(Request $request)
    {
        $query = Incident::query();

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by severity
        if ($request->has('severity') && $request->severity) {
            $query->where('severity', $request->severity);
        }

        // Filter by type
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%$search%")
                  ->orWhere('location_name', 'like', "%$search%");
            });
        }

        $incidents = $query
            ->with(['cat', 'user'])
            ->orderBy('reported_at', 'desc')
            ->paginate(15);

        $statuses = ['Open', 'In Progress', 'Resolved', 'Closed'];
        $severities = ['Low', 'Medium', 'High', 'Critical'];
        $types = ['Injured', 'Lost', 'Found', 'Missing'];

        return view('admin.incidents.index', compact('incidents', 'statuses', 'severities', 'types'));
    }

    /**
     * Show the form for creating a new incident.
     */
    public function create()
    {
        $cats = Cat::all();
        $statuses = ['Open', 'In Progress', 'Resolved', 'Closed'];
        $severities = ['Low', 'Medium', 'High', 'Critical'];
        $types = ['Injured', 'Lost', 'Found', 'Missing'];

        return view('admin.incidents.create', compact('cats', 'statuses', 'severities', 'types'));
    }

    /**
     * Store a newly created incident in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:Injured,Lost,Found,Missing',
            'description' => 'nullable|string',
            'severity' => 'required|string|in:Low,Medium,High,Critical',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => 'required|string|in:Open,In Progress,Resolved,Closed',
            'cat_id' => 'nullable|exists:cats,id',
            'location_name' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['reported_at'] = now();

        Incident::create($validated);

        return redirect()->route('admin.incidents.index')
                        ->with('success', 'Incident created successfully.');
    }

    /**
     * Display the specified incident.
     */
    public function show(Incident $incident)
    {
        $incident->load(['cat', 'user']);

        return view('admin.incidents.show', compact('incident'));
    }

    /**
     * Show the form for editing the specified incident.
     */
    public function edit(Incident $incident)
    {
        $cats = Cat::all();
        $statuses = ['Open', 'In Progress', 'Resolved', 'Closed'];
        $severities = ['Low', 'Medium', 'High', 'Critical'];
        $types = ['Injured', 'Lost', 'Found', 'Missing'];

        return view('admin.incidents.edit', compact('incident', 'cats', 'statuses', 'severities', 'types'));
    }

    /**
     * Update the specified incident in storage.
     */
    public function update(Request $request, Incident $incident)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:Injured,Lost,Found,Missing',
            'description' => 'nullable|string',
            'severity' => 'required|string|in:Low,Medium,High,Critical',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => 'required|string|in:Open,In Progress,Resolved,Closed',
            'cat_id' => 'nullable|exists:cats,id',
            'location_name' => 'nullable|string',
        ]);

        // If status changed to Resolved or Closed, set resolved_at
        if ($validated['status'] !== $incident->status && in_array($validated['status'], ['Resolved', 'Closed'])) {
            $validated['resolved_at'] = now();
        }

        $incident->update($validated);

        return redirect()->route('admin.incidents.show', $incident)
                        ->with('success', 'Incident updated successfully.');
    }

    /**
     * Remove the specified incident from storage.
     */
    public function destroy(Incident $incident)
    {
        $incident->delete();

        return redirect()->route('admin.incidents.index')
                        ->with('success', 'Incident deleted successfully.');
    }

    /**
     * Update incident status.
     */
    public function updateStatus(Request $request, Incident $incident)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Open,In Progress,Resolved,Closed',
        ]);

        if ($validated['status'] !== $incident->status && in_array($validated['status'], ['Resolved', 'Closed'])) {
            $validated['resolved_at'] = now();
        }

        $incident->update($validated);

        return redirect()->back()
                        ->with('success', 'Incident status updated successfully.');
    }
}
