<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('success', 'Report status updated.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Report deleted successfully.');
    }
}
