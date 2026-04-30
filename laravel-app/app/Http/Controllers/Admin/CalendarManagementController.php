<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class CalendarManagementController extends Controller
{
    /**
     * Display a listing of events (calendar view).
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhere('location', 'like', "%$search%");
            });
        }

        // Get events for the current month or all events
        $events = $query
            ->withCount('registrations')
            ->orderBy('event_date', 'asc')
            ->paginate(20);

        $statuses = ['Scheduled', 'Ongoing', 'Completed', 'Cancelled'];

        return view('admin.calendar.index', compact('events', 'statuses'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('admin.calendar.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date_format:Y-m-d\TH:i',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Scheduled,Ongoing,Completed,Cancelled',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        Event::create($validated);

        return redirect()->route('admin.calendar.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        $event->load('registrations');
        return view('admin.calendar.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('admin.calendar.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date_format:Y-m-d\TH:i',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Scheduled,Ongoing,Completed,Cancelled',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        $event->update($validated);

        return redirect()->route('admin.calendar.show', $event)
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.calendar.index')
            ->with('success', 'Event deleted successfully!');
    }

    /**
     * Update event status.
     */
    public function updateStatus(Request $request, Event $event)
    {
        $validated = $request->validate([
            'status' => 'required|in:Scheduled,Ongoing,Completed,Cancelled',
        ]);

        $event->update($validated);

        return redirect()->back()
            ->with('success', 'Event status updated successfully!');
    }

    /**
     * Get events data for calendar API (JSON response).
     */
    public function getEventsApi(Request $request)
    {
        $events = Event::query()
            ->where('status', '!=', 'Cancelled')
            ->orderBy('event_date', 'asc')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->event_date->toDateTimeString(),
                    'end' => $event->event_date->addHours(2)->toDateTimeString(),
                    'location' => $event->location,
                    'status' => $event->status,
                    'description' => substr($event->description, 0, 50) . '...',
                ];
            });

        return response()->json($events);
    }
}
