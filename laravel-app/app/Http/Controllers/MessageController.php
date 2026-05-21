<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'subject'    => 'nullable|string|max:255',
            'content'    => 'required|string|min:5|max:2000',
            'attachment' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,txt',
        ]);

        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            return back()->with('error', 'Unable to send message. No admin found.');
        }

        $attachmentPath = null;
        $attachmentName = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentPath = $file->store('message-attachments', 'public');
            $attachmentName = $file->getClientOriginalName();
        }

        $msg = Message::create([
            'sender_id'       => auth()->id(),
            'receiver_id'     => $admin->id,
            'subject'         => $request->subject ?? 'No Subject',
            'content'         => $request->content,
            'attachment'      => $attachmentPath,
            'attachment_name' => $attachmentName,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'id' => $msg->id]);
        }

        return back()->with('message_sent', 'Your message has been sent to the AHC team!');
    }

    public function markRead(Message $message)
    {
        if ($message->receiver_id !== auth()->id()) {
            abort(403);
        }

        $message->markAsRead();

        return back();
    }
}
