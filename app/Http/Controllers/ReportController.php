<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller {
    public function index() {
        $reports = Report::with('user')->latest()->get();
        return view('reports.index', compact('reports'));
    }

    public function create() {
        return view('reports.create');
    }

    public function store(Request $request) {
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'user_nik' => Auth::guard('user')->check() ? Auth::guard('user')->user()->nik : null,
            'date' => now()->format('Y-m-d'),
            'content' => $request->content,
            'status' => '0',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('reports', 'public');
        }

        Report::create($data);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dibuat!');
    }

    public function show(string $id) {
        $report = Report::with('user', 'responses.admin')->findOrFail($id);
        return view('reports.show', compact('report'));
    }

    public function edit(string $id) {
        $report = Report::findOrFail($id);
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $report = Report::findOrFail($id);

        $data = [
            'content' => $request->content,
            'date' => now()->format('Y-m-d'),
        ];

        if ($request->hasFile('image')) {
            if ($report->image) {
                Storage::disk('public')->delete($report->image);
            }
            $data['image'] = $request->file('image')->store('reports', 'public');
        }

        $report->update($data);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(string $id) {
        $report = Report::findOrFail($id);

        if ($report->image) {
            Storage::disk('public')->delete($report->image);
        }

        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus!');
    }
}