<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $name = trim($request->name);

        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        Department::create(['name' => $name]);

        return redirect()->route('admin.departments.index')->with('success', 'เพิ่มแผนกสำเร็จ');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $name = trim($request->name);

        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $id,
        ]);

        $department = Department::findOrFail($id);
        $department->update(['name' => $name]);

        return redirect()->route('admin.departments.index')->with('success', 'แก้ไขแผนกสำเร็จ');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('admin.departments.index')->with('success', 'ลบแผนกสำเร็จ');
    }
}
