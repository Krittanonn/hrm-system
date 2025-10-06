<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();

        return view('admin.dashboard', compact('totalEmployees'));
    }

}
