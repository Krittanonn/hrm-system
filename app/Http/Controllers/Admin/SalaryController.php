<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;
use Carbon\Carbon;

class SalaryController extends Controller
{
    // แสดงเงินเดือนล่าสุดของพนักงานทั้งหมด
    public function index()
    {
        // ดึง employee พร้อม latest salary
        $employees = Employee::with(['salaries' => function($q) {
            $q->latest('payment_date')->limit(1);
        }])->get();

        return view('admin.salary.index', compact('employees'));
    }

    // หน้าแก้ไขเงินเดือน
    public function edit(Employee $employee)
    {
        $latestSalary = $employee->salaries()->latest('payment_date')->first();
        return view('admin.salary.edit', compact('employee', 'latestSalary'));
    }

    // อัปเดตเงินเดือน
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'base_salary' => 'required|numeric|min:0',
            'bonus'       => 'nullable|numeric|min:0',
            'deduction'   => 'nullable|numeric|min:0',
            'payment_date'=> 'required|date',
        ]);

        $net_salary = $request->base_salary + ($request->bonus ?? 0) - ($request->deduction ?? 0);

        // สร้าง record ใหม่
        $employee->salaries()->create([
            'base_salary'  => $request->base_salary,
            'bonus'        => $request->bonus ?? 0,
            'deduction'    => $request->deduction ?? 0,
            'net_salary'   => $net_salary,
            'payment_date' => $request->payment_date,
        ]);

        return redirect()->route('admin.salary.index')
                         ->with('success', 'ปรับเงินเดือนเรียบร้อยแล้ว');
    }

    // แสดงประวัติเงินเดือนของพนักงาน
    public function history(Employee $employee)
    {
        $salaries = $employee->salaries()->orderBy('payment_date', 'desc')->get();
        return view('admin.salary.history', compact('employee', 'salaries'));
    }
}
