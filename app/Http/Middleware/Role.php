<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class Role {
    public function handle(Request $request, Closure $next, $role): Response {
        if (!Auth::guard('admins')->check()) {
            return redirect('/admin/login');
        }

        $user = Auth::guard('admins')->user();
        if (!$user instanceof Admin) {
            return redirect('/admin/login');
        }

        if ($role === 'admin' && !$user->isAdmin()) {
            return redirect('/staff/dashboard');
        }
        if ($role === 'staff' && !$user->isStaff()) {
            return redirect('/admin/dashboard');
        }
        return $next($request);
    }
}