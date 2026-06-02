<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Mail\AdminNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function index()
    {
        $colors   = ['#C9A84C', '#8B7355', '#6B8E6B', '#7B6B8E', '#8E6B6B', '#6B7B8E'];
        $adminIds = User::where('role', 'admin')->pluck('id')->map(fn($id) => (int) $id)->toArray();

        // All unique non-admin users who appear in any message involving any admin
        $userIds = Message::where(function ($q) use ($adminIds) {
                $q->whereIn('sender_id', $adminIds)->orWhereIn('receiver_id', $adminIds);
            })
            ->get()
            ->flatMap(fn($m) => [(int) $m->sender_id, (int) $m->receiver_id])
            ->reject(fn($id) => in_array($id, $adminIds))
            ->unique()
            ->values();

        $conversations = $userIds->map(function ($userId, $i) use ($adminIds, $colors) {
            $user = User::find($userId);
            if (!$user) return null;

            $messages = Message::where(function ($q) use ($adminIds, $userId) {
                    $q->whereIn('sender_id', $adminIds)->where('receiver_id', $userId);
                })->orWhere(function ($q) use ($adminIds, $userId) {
                    $q->where('sender_id', $userId)->whereIn('receiver_id', $adminIds);
                })->orderBy('created_at')->get();

            $latest   = $messages->last();
            $unread   = $messages->where('sender_id', $userId)->whereNull('read_at')->count();
            $parts    = explode(' ', $user->name);
            $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));

            return [
                'id'       => (int) $userId,
                'type'     => 'people',
                'name'     => $user->name,
                'initials' => $initials,
                'color'    => $colors[$i % count($colors)],
                'online'   => false,
                'time'     => $latest ? $latest->created_at->diffForHumans(null, true) : '',
                'preview'  => $latest ? Str::limit($latest->content, 45) : '',
                'unread'   => $unread,
                'messages' => $messages->map(fn($msg) => [
                    'text' => $msg->content,
                    'sent' => in_array((int) $msg->sender_id, $adminIds),
                    'time' => $msg->created_at->format('M d, g:ia'),
                ])->values()->toArray(),
            ];
        })->filter()->values();

        return view('admin.messages.index', compact('conversations'));
    }

    public function reply(Request $request, User $user)
    {
        $request->validate(['content' => 'required|string|min:1|max:2000']);

        $msg = Message::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $user->id,
            'subject'     => 'Admin Reply',
            'content'     => $request->input('content'),
        ]);

        try {
            Mail::to($user->email)->send(new AdminNotificationMail(
                'New Message from AHC Team',
                'You received a new message from the AHC Admin team: "' . $msg->content . '"',
                route('dashboard'),
                'View Messages'
            ));
        } catch (\Exception $e) {
            \Log::error('Failed to send admin message email to ' . $user->email . ': ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => [
                'text' => $msg->content,
                'sent' => true,
                'time' => $msg->created_at->format('M d, g:ia'),
            ],
        ]);
    }
}
