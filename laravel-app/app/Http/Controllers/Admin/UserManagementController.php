<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        $stats = [
            'total'   => User::count(),
            'admins'  => User::where('role', 'admin')->count(),
            'members' => User::where('role', 'user')->count(),
        ];
        $volunteers = Volunteer::orderBy('created_at', 'desc')->get()
            ->map(function ($v) {
                $statusClass = match($v->status) {
                    'APPROVED'     => 'bg-green-50 text-green-600 border border-green-100',
                    'INTERVIEWING' => 'bg-[#FAF8F0] text-[#C9A84C] border border-[#E8E2D8]',
                    'REJECTED'     => 'bg-red-50 text-red-500 border border-red-100',
                    default        => 'bg-cyan-50 text-cyan-600 border border-cyan-100',
                };
                return [
                    'id'           => $v->id,
                    'name'         => $v->name,
                    'matric'       => $v->matric ?? '',
                    'email'        => $v->email ?? '',
                    'phone'        => $v->phone ?? '',
                    'program'      => $v->program ?? '',
                    'availability' => $v->availability ?? '',
                    'skills'       => $v->skills ?? [],
                    'status'       => $v->status,
                    'statusClass'  => $statusClass,
                    'applied'      => $v->applied_at ? $v->applied_at->format('M d, Y') : $v->created_at->format('M d, Y'),
                ];
            });
        return view('admin.users.index', compact('users', 'stats', 'volunteers'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Cannot delete your own account.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
