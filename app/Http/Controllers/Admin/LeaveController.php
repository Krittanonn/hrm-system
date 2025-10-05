<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('employee.department', 'employee.position')->latest()->get();
        return view('admin.leaves.index', compact('leaves'));
    }

    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'approved']);

        return back()->with('success', 'อนุมัติการลาเรียบร้อยแล้ว');
    }

    public function reject($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'rejected']);

        return back()->with('success', 'ปฏิเสธการลาเรียบร้อยแล้ว');
    }
}
