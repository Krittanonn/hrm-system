<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;
        $leaves = $employee ? $employee->leaves()->latest()->take(5)->get() : collect();
        return view('employee.dashboard', compact('employee','leaves'));
    }
}
