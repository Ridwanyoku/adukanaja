<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller {

    public function dashboard() {
        $totalReports = Report::count();
        $totalResponses = Response::count();
        return view('staff.dashboard', compact('totalReports', 'totalResponses'));
    }

    public function responseIndex() {
        $reports = Report::with('responses', 'user')->latest()->get();
        return view('staff.response', compact('reports'));
    }

    public function responseShow(Report $report) {
        $report->load('responses.admin', 'user');
        return view('staff.show', compact('report'));
    }

    public function responseStore(Request $request, Report $report) {
        $request->validate([
            'response_content' => 'required|string',
        ]);

        Response::create([
            'report_id' => $report->id,
            'admin_id' => Auth::guard('admins')->id(),
            'date' => now()->format('Y-m-d'),
            'response_content' => $request->response_content,
        ]);

        $report->update(['status' => 'in_progress']);

        return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan!');
    }

    public function responseEdit(Response $response) {
        // Return modal view or JSON for pop up edit
        return view('staff.response.edit', compact('response'));
    }

    public function responseUpdate(Request $request, Response $response) {
        $request->validate([
            'response_content' => 'required|string',
        ]);

        $response->update([
            'response_content' => $request->response_content,
            'date' => now()->format('Y-m-d'),
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil diperbarui!');
    }

    public function responseDestroy(Response $response) {
        $response->delete();
        return redirect()->back()->with('success', 'Tanggapan berhasil dihapus!');
    }

    public function updateStatus(Request $request, Report $report) {
    $request->validate([
        'status' => 'required|in:0,in_progress,resolved',
    ]);

    $report->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Status laporan berhasil diubah!');
    }
}