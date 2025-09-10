<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Response;

class ResponseController extends Controller {

    public function index() {
        $reports = Report::with('user', 'responses.admin')->latest()->get();
        return view('admin.report', compact('reports'));
    }

    public function show(Report $report) {
        $report->load('user', 'responses.admin');
        return view('admin.show', compact('report'));
    }

    public function store(Request $request, Report $report) {
        $request->validate([
            'response_content' => 'required|string',
        ]);

        $report->responses()->create([
            'admin_id' => Auth::guard('admins')->id(),
            'date' => now()->format('Y-m-d'),
            'response_content' => $request->response_content,
        ]);

        $report->update(['status' => 'in_progress']);

        return redirect()->route('admin.show', $report)->with('success', 'Tanggapan berhasil ditambahkan!');
    }
}