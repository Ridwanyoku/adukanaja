<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;

class UserController extends Controller
{
    // Dashboard: list all reports milik user
    public function dashboard()
    {
        $user = Auth::guard('user')->user();
        $reports = Report::with('responses')->where('user_nik', $user->nik)->latest()->get();
        return view('user.dashboard', compact('user', 'reports'));
    }

    // Show form create report
    public function create()
    {
        return view('user.report');
    }

    // Store new report
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'user_nik' => Auth::guard('user')->user()->nik,
            'content' => $request->content,
            'date' => now(),
            'status' => '0',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('reports', 'public');
        }

        Report::create($data);

        return redirect()->route('user.dashboard')->with('success', 'Laporan berhasil dibuat!');
    }

    // Show detail report
    public function show($id)
    {
        $report = Report::with('user', 'responses.admin')->findOrFail($id);

        // Pastikan hanya pemilik yang bisa lihat detail
        if ($report->user_nik !== Auth::guard('user')->user()->nik) {
            abort(403);
        }

        return view('user.show', compact('report'));
    }

    // Show form edit report
    public function edit($id)
    {
        $report = Report::findOrFail($id);

        if ($report->user_nik !== Auth::guard('user')->user()->nik) {
            abort(403);
        }

        return view('user.edit_report', compact('report'));
    }

    // Update report
    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        if ($report->user_nik !== Auth::guard('user')->user()->nik) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'content' => $request->content,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($report->image) {
                Storage::disk('public')->delete($report->image);
            }
            $data['image'] = $request->file('image')->store('reports', 'public');
        }

        $report->update($data);

        return redirect()->route('user.dashboard')->with('success', 'Laporan berhasil diperbarui!');
    }

    // Delete report
    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        if ($report->user_nik !== Auth::guard('user')->user()->nik) {
            abort(403);
        }

        if ($report->image) {
            Storage::disk('public')->delete($report->image);
        }

        $report->delete();

        return redirect()->route('user.dashboard')->with('success', 'Laporan berhasil dihapus!');
    }
}
