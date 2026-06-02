<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventManagementController extends Controller
{
    public function index()
    {
        $events    = Event::withCount('registrations')->latest()->paginate(15);
        $total     = Event::count();
        $upcoming  = Event::where('status', 'Upcoming')->count();
        $completed = Event::where('status', 'Completed')->count();
        $cancelled = Event::where('status', 'Cancelled')->count();

        return view('admin.events.index', compact(
            'events', 'total', 'upcoming', 'completed', 'cancelled'
        ));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'required|date',
            'location'    => 'nullable|string|max:255',
            'status'      => 'required|in:Upcoming,Completed,Cancelled',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'required|date',
            'location'    => 'nullable|string|max:255',
            'status'      => 'required|in:Upcoming,Completed,Cancelled',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) Storage::disk()->delete($event->image);
            $data['image'] = $request->file('image')->store('events');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->image) Storage::disk()->delete($event->image);
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
