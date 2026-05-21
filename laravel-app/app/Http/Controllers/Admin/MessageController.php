<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function index()
    {
        $adminId = auth()->id();
        $colors  = ['#C9A84C', '#8B7355', '#6B8E6B', '#7B6B8E', '#8E6B6B', '#6B7B8E'];

        $userIds = Message::where('sender_id', $adminId)
            ->orWhere('receiver_id', $adminId)
            ->get()
            ->flatMap(fn($m) => [$m->sender_id, $m->receiver_id])
            ->filter(fn($id) => $id !== $adminId)
            ->unique()
            ->values();

        $conversations = $userIds->map(function ($userId, $i) use ($adminId, $colors) {
            $user = User::find($userId);
            if (!$user) return null;

            $messages = Message::where(function ($q) use ($adminId, $userId) {
                    $q->where('sender_id', $userId)->where('receiver_id', $adminId);
                })->orWhere(function ($q) use ($adminId, $userId) {
                    $q->where('sender_id', $adminId)->where('receiver_id', $userId);
                })->orderBy('created_at')->get();

            $latest  = $messages->last();
            $unread  = $messages->where('sender_id', $userId)->whereNull('read_at')->count();
            $parts   = explode(' ', $user->name);
            $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));

            return [
                'id'       => $userId,
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
                    'sent' => $msg->sender_id === $adminId,
                    'time' => $msg->created_at->format('M d, g:ia'),
                ])->values()->toArray(),
            ];
        })->filter()->values();

        return view('admin.messages.index', compact('conversations'));
    }
}
