<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class CalendarController extends Controller
{
    public function index()
    {
        return view('admin.calendar.index');
    }

    public function events(): JsonResponse
    {
        $events = Event::all()->map(function (Event $event) {
            $color = match ($event->status) {
                'Completed' => ['bg' => '#0d9488', 'border' => '#0f766e'],
                'Cancelled' => ['bg' => '#ef4444', 'border' => '#dc2626'],
                default     => ['bg' => '#d97706', 'border' => '#b45309'],
            };

            return [
                'id'              => $event->id,
                'title'           => $event->title,
                'start'           => $event->event_date->toIso8601String(),
                'url'             => route('admin.events.edit', $event),
                'backgroundColor' => $color['bg'],
                'borderColor'     => $color['border'],
                'textColor'       => '#ffffff',
                'extendedProps'   => [
                    'location'    => $event->location,
                    'status'      => $event->status,
                    'description' => $event->description,
                ],
            ];
        });

        return response()->json($events);
    }
}
