<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'Upcoming')->orderBy('event_date')->get();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function register(Request $request, Event $event)
    {
        $existing = EventRegistration::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->first();

        if ($existing) {
            return back()->with('info', 'You are already registered.');
        }

        EventRegistration::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'status' => 'Registered',
        ]);

        return back()->with('success', 'Successfully registered for the event!');
    }
}
