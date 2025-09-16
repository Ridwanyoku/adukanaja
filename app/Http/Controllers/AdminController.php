<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
    public function showLoginForm() {
        return view('auth.admin-login');
    }

    public function login(Request $request) {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:6',
        ]);

        // Coba autentikasi dengan guard 'admins'
        if (Auth::guard('admins')->attempt($credentials, $request->has('remember'))) {
            $user = Auth::guard('admins')->user();

            // Pastikan user adalah instance Admin
            if (!$user instanceof Admin) {
                Auth::guard('admins')->logout();
                return back()->withErrors(['username' => 'Invalid user type.']);
            }

            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard')->with('success', 'Logged in as admin!');
            } elseif ($user->isStaff()) {
                return redirect()->intended('/staff/dashboard')->with('success', 'Logged in as staff!');
            }

            // Jika role tidak valid, logout dan redirect
            Auth::guard('admins')->logout();
            return back()->withErrors(['username' => 'Invalid role.']);
        }

        // Jika autentikasi gagal
        return back()->withErrors(['username' => 'Invalid username or password.'])->withInput();
    }

    public function logout(Request $request) {
        Auth::guard('admins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login')->with('success', 'Logged out successfully.');
    }

    public function dashboard() {
        $user = Auth::guard('admins')->user();
        if (!$user instanceof Admin || !$user->isAdmin()) {
            return redirect('/admin/login')->withErrors(['access' => 'Unauthorized access to admin dashboard.']);
        }
        $staffs = Admin::where('level', 'staff')->get();
        return view('admin.dashboard', ['user' => $user]); compact('staffs');
    }

    public function showAddStaffForm() {
        return view('admin.add-staff');
    }

    public function addStaff(Request $request) {
    $request->validate([
        'name' => 'required|string',
        'username' => 'required|string|unique:admins',
        'password' => 'required|string|min:6',
        'telephone' => 'required|string',
    ]);

    Admin::create([
        'name' => $request->name,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'telephone' => $request->telephone,
        'level' => 'staff',
    ]);

    return redirect()->back()->with('success', 'Staff berhasil ditambahkan!');
    }

    public function staffIndex(){
        $staffs = Admin::where('level', 'staff')->get();
        $users = User::all();
        return view('admin.dashboard', compact('staffs', 'users'));
    }
}