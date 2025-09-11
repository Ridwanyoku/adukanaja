<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

Route::get('/', fn() => view('welcome'));

Route::get('/debug-guards', function () {
    return [
        'default_guard' => \Illuminate\Support\Facades\Auth::getDefaultDriver(),
        'guards' => array_keys(config('auth.guards')),
    ];
});

// Routes untuk user (login dengan NIK)
Route::middleware('auth:user')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/report/create', [UserController::class, 'create'])->name('reports.create');
    Route::post('/user/reports', [UserController::class, 'store'])->name('reports.store');
    Route::get('/reports/{id}', [UserController::class, 'show'])->name('reports.show');
    Route::get('/user/reports/{id}/edit', [UserController::class, 'edit'])->name('reports.edit');
    Route::put('/user/reports/{id}', [UserController::class, 'update'])->name('reports.update');
    Route::delete('/user/reports/{id}', [UserController::class, 'destroy'])->name('reports.destroy');
});

// Routes untuk admin/staff (login dengan username)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

Route::middleware(['auth:admins', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth:admins', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
});

require __DIR__.'/auth.php';