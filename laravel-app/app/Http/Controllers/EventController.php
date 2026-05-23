<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SavedEvent;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('status', 'Upcoming')->orderBy('event_date', 'asc')->get();
        $completedEvents = Event::where('status', 'Completed')->orderBy('event_date', 'desc')->get();
        
        $savedEventIds = auth()->check()
            ? auth()->user()->savedEvents()->pluck('event_id')->toArray()
            : [];

        return view('events.index', compact('upcomingEvents', 'completedEvents', 'savedEventIds'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function register(Request $request, Event $event)
    {
        $existing = SavedEvent::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Event removed from your saved list.');
        }

        SavedEvent::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'status' => 'Saved',
        ]);

        return back()->with('success', 'Event saved successfully!');
    }
}
