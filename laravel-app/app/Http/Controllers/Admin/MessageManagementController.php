<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageManagementController extends Controller
{
    /**
     * Display a listing of messages.
     */
    public function index(Request $request)
    {
        $query = Message::query();

        // Filter by read status
        if ($request->has('status') && $request->status) {
            if ($request->status === 'unread') {
                $query->whereNull('read_at');
            } elseif ($request->status === 'read') {
                $query->whereNotNull('read_at');
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%$search%")
                  ->orWhere('content', 'like', "%$search%")
                  ->orWhereHas('sender', function ($q) use ($search) {
                      $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                  })
                  ->orWhereHas('receiver', function ($q) use ($search) {
                      $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                  });
            });
        }

        $messages = $query
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total' => Message::count(),
            'unread' => Message::whereNull('read_at')->count(),
        ];

        return view('admin.messages.index', compact('messages', 'stats'));
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        $message->load(['sender', 'receiver']);
        
        // Mark as read when viewing
        if ($message->isUnread()) {
            $message->markAsRead();
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
                        ->with('success', 'Message deleted successfully.');
    }

    /**
     * Mark message as read.
     */
    public function markAsRead(Message $message)
    {
        $message->markAsRead();

        return redirect()->back()
                        ->with('success', 'Message marked as read.');
    }

    /**
     * Mark message as unread.
     */
    public function markAsUnread(Message $message)
    {
        $message->update(['read_at' => null]);

        return redirect()->back()
                        ->with('success', 'Message marked as unread.');
    }
}
