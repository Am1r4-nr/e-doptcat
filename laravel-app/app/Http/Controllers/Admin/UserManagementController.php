<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Staff;
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
        $lecturers = Staff::where('type', 'lecturer')->orderBy('name')->get();
        $committee = Staff::where('type', 'committee')->orderBy('name')->get();
        return view('admin.users.index', compact('users', 'stats', 'volunteers', 'lecturers', 'committee'));
    }

    public function show(User $user)
    {
        $user->load(['adoptions.cat']);
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

    public function importStaff(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,xlsx,xls|max:10240',
        ]);

        $path = $request->file('file')->store('staff-imports', 'public');

        return response()->json([
            'success' => true,
            'path'    => $path,
            'name'    => $request->file('file')->getClientOriginalName(),
            'ext'     => $request->file('file')->getClientOriginalExtension(),
        ]);
    }

    public function storeStaff(Request $request)
    {
        $validated = $request->validate([
            'type'       => 'required|in:lecturer,committee',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'department' => 'required|string|max:255',
            'position'   => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:50',
        ]);

        $staff = Staff::create($validated);
        return response()->json(['success' => true, 'staff' => $staff]);
    }

    public function updateStaff(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'department' => 'required|string|max:255',
            'position'   => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:50',
        ]);

        $staff->update($validated);
        return response()->json(['success' => true, 'staff' => $staff->fresh()]);
    }

    public function destroyStaff(Staff $staff)
    {
        $staff->delete();
        return response()->json(['success' => true]);
    }

    public function batchImportStaff(Request $request)
    {
        $request->validate([
            'rows'         => 'required|array|min:1',
            'rows.*.type'  => 'required|in:lecturer,committee',
            'rows.*.name'  => 'required|string|max:255',
            'rows.*.email' => 'required|email|max:255',
        ]);

        $created = [];
        foreach ($request->rows as $row) {
            $created[] = Staff::create([
                'type'       => $row['type'],
                'name'       => $row['name'],
                'email'      => $row['email'],
                'department' => $row['department'] ?? null,
                'position'   => $row['position'] ?? null,
                'phone'      => $row['phone'] ?? null,
            ]);
        }

        return response()->json(['success' => true, 'count' => count($created), 'staff' => $created]);
    }
}
