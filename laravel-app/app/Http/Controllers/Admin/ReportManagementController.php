<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Mail\AdminNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportManagementController extends Controller
{
    public function index()
    {
        $reports = Report::with('user')->paginate(15);
        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        $report->load('user');
        return view('admin.reports.show', compact('report'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Resolved,Closed',
        ]);

        $report->update($validated);

        try {
            $user = $report->user;
            if ($user) {
                Mail::to($user->email)->send(new AdminNotificationMail(
                    'Incident Report Update',
                    'Your submitted report regarding "' . $report->type . '" (ID: #' . $report->id . ') has been updated to: "' . $report->status . '".',
                    route('dashboard'),
                    'View Reports'
                ));
            }
        } catch (\Exception $e) {
            \Log::error('Failed to send report status email to ' . ($report->user ? $report->user->email : 'unknown') . ': ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Report status updated.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Report deleted successfully.');
    }
}
