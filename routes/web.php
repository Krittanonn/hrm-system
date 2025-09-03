<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;

/*
| Authentication
*/
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
| Dashboard redirect
*/
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) return redirect('/login');

    switch ($user->role_id) {
        case 1: return redirect()->route('admin.dashboard');
        case 2: return redirect()->route('employee.dashboard');
        default: return view('dashboard');
    }
})->middleware('auth')->name('dashboard');

/*
| Admin Routes
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Employee
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Salary
    Route::get('/salary', [SalaryController::class, 'index'])->name('salary.index');
    Route::get('/salary/{employee}/edit', [SalaryController::class, 'edit'])->name('salary.edit');
    Route::put('/salary/{employee}', [SalaryController::class, 'update'])->name('salary.update');
    Route::get('/salary/{employee}/history', [SalaryController::class, 'history'])->name('salary.history');



    // Leaves (อนุมัติ/ปฏิเสธการลา)
    Route::get('/leaves', [AdminLeaveController::class, 'index'])->name('leaves.index');
    Route::post('/leaves/{id}/approve', [AdminLeaveController::class, 'approve'])->name('leaves.approve');
    Route::post('/leaves/{id}/reject', [AdminLeaveController::class, 'reject'])->name('leaves.reject');
});

/*
| Employee Routes
*/
Route::middleware('auth')->prefix('employee')->name('employee.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');

    // Leaves (ส่งคำขอลา)
    Route::get('/leave/submit', [EmployeeLeaveController::class, 'create'])->name('leave.submit_form');
    Route::post('/leave/submit', [EmployeeLeaveController::class, 'store'])->name('leave.submit');
});
