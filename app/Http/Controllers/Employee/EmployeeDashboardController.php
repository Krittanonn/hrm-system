<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    public function index()
    {   
        // get employee data from user login
        $employee = Auth::user()->employee;

        $leaves = $employee ? $employee->leaves()->latest()->take(5)->get() : collect();

        // show employee data in DB to dashboard
        return view('employee.dashboard', compact('employee', 'leaves'));
    }
}
