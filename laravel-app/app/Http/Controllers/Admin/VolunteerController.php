<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::orderBy('created_at', 'desc')->get()->map(function ($v) {
            $statusClass = match($v->status) {
                'APPROVED'    => 'bg-green-50 text-green-600 border border-green-100',
                'INTERVIEWING'=> 'bg-[#FAF8F0] text-[#C9A84C] border border-[#E8E2D8]',
                'REJECTED'    => 'bg-red-50 text-red-500 border border-red-100',
                default       => 'bg-cyan-50 text-cyan-600 border border-cyan-100',
            };
            return [
                'id'           => $v->id,
                'name'         => $v->name,
                'matric'       => $v->matric ?? '',
                'email'        => $v->email ?? '',
                'phone'        => $v->phone ?? '',
                'program'      => $v->program ?? '',
                'availability' => $v->availability ?? '',
                'availTime'    => $v->avail_time ?? '',
                'status'       => $v->status,
                'statusClass'  => $statusClass,
                'skills'       => $v->skills ?? [],
                'bio'          => $v->bio ?? '',
                'experience'   => $v->experience ?? '',
                'location'     => $v->location ?? '',
                'applied'      => $v->applied_at ? $v->applied_at->format('M d, Y') : $v->created_at->format('M d, Y'),
                'avatar'       => '',
            ];
        });

        $stats = [
            'active'      => Volunteer::where('status', 'APPROVED')->count(),
            'pending'     => Volunteer::where('status', 'PENDING')->count(),
            'onboarding'  => Volunteer::where('status', 'INTERVIEWING')->count(),
        ];

        return view('admin.volunteers.index', compact('volunteers', 'stats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'matric'       => 'nullable|string|max:50',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'nullable|string|max:50',
            'program'      => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:50',
            'avail_time'   => 'nullable|string|max:100',
            'status'       => 'nullable|in:PENDING,INTERVIEWING,APPROVED,REJECTED',
        ]);

        $volunteer = Volunteer::create([
            ...$data,
            'name'       => ucwords(strtolower($data['name'])),
            'status'     => $data['status'] ?? 'PENDING',
            'applied_at' => now(),
        ]);

        $statusClass = match($volunteer->status) {
            'APPROVED'    => 'bg-green-50 text-green-600 border border-green-100',
            'INTERVIEWING'=> 'bg-[#FAF8F0] text-[#C9A84C] border border-[#E8E2D8]',
            'REJECTED'    => 'bg-red-50 text-red-500 border border-red-100',
            default       => 'bg-cyan-50 text-cyan-600 border border-cyan-100',
        };

        return response()->json([
            'id'           => $volunteer->id,
            'name'         => $volunteer->name,
            'matric'       => $volunteer->matric ?? '',
            'email'        => $volunteer->email ?? '',
            'phone'        => $volunteer->phone ?? '',
            'program'      => $volunteer->program ?? '',
            'availability' => $volunteer->availability ?? '',
            'availTime'    => $volunteer->avail_time ?? '',
            'status'       => $volunteer->status,
            'statusClass'  => $statusClass,
            'skills'       => [],
            'bio'          => '',
            'experience'   => '',
            'location'     => '',
            'applied'      => now()->format('M d, Y'),
            'avatar'       => '',
        ]);
    }

    public function update(Request $request, Volunteer $volunteer)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'matric'       => 'nullable|string|max:50',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'nullable|string|max:50',
            'program'      => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:50',
            'avail_time'   => 'nullable|string|max:100',
            'status'       => 'nullable|in:PENDING,INTERVIEWING,APPROVED,REJECTED',
        ]);

        if (isset($data['name'])) {
            $data['name'] = ucwords(strtolower($data['name']));
        }
        $volunteer->update($data);

        $statusClass = match($volunteer->status) {
            'APPROVED'    => 'bg-green-50 text-green-600 border border-green-100',
            'INTERVIEWING'=> 'bg-[#FAF8F0] text-[#C9A84C] border border-[#E8E2D8]',
            'REJECTED'    => 'bg-red-50 text-red-500 border border-red-100',
            default       => 'bg-cyan-50 text-cyan-600 border border-cyan-100',
        };

        return response()->json(['success' => true, 'statusClass' => $statusClass]);
    }

    public function updateStatus(Request $request, Volunteer $volunteer)
    {
        $request->validate(['status' => 'required|in:PENDING,INTERVIEWING,APPROVED,REJECTED']);
        $volunteer->update(['status' => $request->status]);

        $statusClass = match($volunteer->status) {
            'APPROVED'    => 'bg-green-50 text-green-600 border border-green-100',
            'INTERVIEWING'=> 'bg-[#FAF8F0] text-[#C9A84C] border border-[#E8E2D8]',
            'REJECTED'    => 'bg-red-50 text-red-500 border border-red-100',
            default       => 'bg-cyan-50 text-cyan-600 border border-cyan-100',
        };

        return response()->json(['success' => true, 'statusClass' => $statusClass]);
    }

    public function import(Request $request)
    {
        $request->validate(['volunteers' => 'required|array']);

        $statusClass = fn($s) => match($s) {
            'APPROVED'    => 'bg-green-50 text-green-600 border border-green-100',
            'INTERVIEWING'=> 'bg-[#FAF8F0] text-[#C9A84C] border border-[#E8E2D8]',
            'REJECTED'    => 'bg-red-50 text-red-500 border border-red-100',
            default       => 'bg-cyan-50 text-cyan-600 border border-cyan-100',
        };

        $created = [];
        foreach ($request->volunteers as $row) {
            $status = in_array(strtoupper($row['status'] ?? ''), ['APPROVED','INTERVIEWING','REJECTED'])
                ? strtoupper($row['status'])
                : 'PENDING';

            $volunteer = Volunteer::create([
                'name'         => ucwords(strtolower($row['name'] ?? '')),
                'matric'       => $row['matric'] ?? null,
                'email'        => $row['email'] ?? null,
                'phone'        => $row['phone'] ?? null,
                'program'      => $row['program'] ?? null,
                'availability' => $row['availability'] ?? null,
                'avail_time'   => $row['availTime'] ?? null,
                'status'       => $status,
                'applied_at'   => now(),
            ]);

            $created[] = [
                'id'           => $volunteer->id,
                'name'         => $volunteer->name,
                'matric'       => $volunteer->matric ?? '',
                'email'        => $volunteer->email ?? '',
                'phone'        => $volunteer->phone ?? '',
                'program'      => $volunteer->program ?? '',
                'availability' => $volunteer->availability ?? '',
                'availTime'    => $volunteer->avail_time ?? '',
                'status'       => $volunteer->status,
                'statusClass'  => $statusClass($volunteer->status),
                'skills'       => [],
                'bio'          => '',
                'experience'   => '',
                'location'     => '',
                'applied'      => now()->format('M d, Y'),
                'avatar'       => '',
            ];
        }

        return response()->json(['imported' => count($created), 'volunteers' => $created]);
    }
}
