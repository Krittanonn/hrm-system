<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    // แสดงรายการแผนกทั้งหมด
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    // ฟอร์มเพิ่มแผนก
    public function create()
    {
        return view('admin.departments.create');
    }

    // บันทึกข้อมูลแผนกใหม่
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        Department::create(['name' => $request->name]);

        return redirect()->route('departments.index')->with('success', 'เพิ่มแผนกสำเร็จ');
    }

    // ฟอร์มแก้ไขแผนก
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }

    // อัปเดตข้อมูลแผนก
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $id,
        ]);

        $department = Department::findOrFail($id);
        $department->update(['name' => $request->name]);

        return redirect()->route('departments.index')->with('success', 'แก้ไขแผนกสำเร็จ');
    }

    // ลบแผนก
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'ลบแผนกสำเร็จ');
    }
}
