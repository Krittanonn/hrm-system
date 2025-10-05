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

    // show create employee form if user click button
    public function create()
        {
            return view('admin.employees.create');
        }

    // store new employee to database
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:employees,email',
            'department' => 'required|string|max:100',
            'position'   => 'required|string|max:100',
            ]);

        \App\Models\Employee::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'department' => $request->department,
            'position'   => $request->position,    
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'เพิ่มพนักงานเรียบร้อยแล้ว');
    }

}
