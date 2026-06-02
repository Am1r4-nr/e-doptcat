<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SavedEvent;
use App\Mail\AdminNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        try {
            $user = auth()->user();
            Mail::to($user->email)->send(new AdminNotificationMail(
                'Event Saved Successfully!',
                'You have successfully saved the event: "' . $event->title . '". We will notify you of any updates. The event is scheduled for: ' . $event->event_date->format('M d, Y \a\t h:i A') . ' at ' . ($event->location ?? 'TBD') . '.',
                route('events.index'),
                'View Events'
            ));
        } catch (\Exception $e) {
            \Log::error('Failed to send saved event email to ' . auth()->user()->email . ': ' . $e->getMessage());
        }

        return back()->with('success', 'Event saved successfully!');
    }
}
