<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;

class EmployeeController extends Controller
{
    // =====================
    // Admin: Employees CRUD
    // =====================
    public function index()
    {
        $employees = Employee::with(['department', 'position', 'user'])->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $users = User::all();
        return view('admin.employees.create', compact('departments','positions','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'department_id'=>'required|exists:departments,id',
            'position_id'=>'required|exists:positions,id',
            'hire_date'=>'required|date',
            'phone'=>'nullable|string|max:20',
            'address'=>'nullable|string|max:255',
            'role_id'=>'required|in:1,2',
            'profile_image'=>'nullable|image|max:5120',
        ]);

        // Auto-generate unique email
        $emailBase = strtolower($request->first_name).'.'.strtolower($request->last_name);
        $email = $emailBase.'@company.com';
        $counter = 1;
        while(User::where('email',$email)->exists()){
            $email = $emailBase.$counter.'@company.com';
            $counter++;
        }

        $user = User::create([
            'name'=>$request->first_name.' '.$request->last_name,
            'email'=>$email,
            'password'=>Hash::make('123456'),
            'role_id'=>$request->role_id,
        ]);

        $employeeData = $request->only(['first_name','last_name','department_id','position_id','hire_date','phone','address']);
        $employeeData['user_id'] = $user->id;

        if($request->hasFile('profile_image')){
            $file = $request->file('profile_image');
            $employeeData['profile_image'] = file_get_contents($file->getRealPath());
            $employeeData['profile_image_mime'] = $file->getMimeType();
        }

        Employee::create($employeeData);

        return redirect()->route('admin.employees.index')->with('success','เพิ่มพนักงานและสร้าง user เรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        $users = User::all();
        return view('admin.employees.edit', compact('employee','departments','positions','users'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'department_id'=>'required|exists:departments,id',
            'position_id'=>'required|exists:positions,id',
            'hire_date'=>'required|date',
            'phone'=>'nullable|string|max:20',
            'address'=>'nullable|string|max:255',
            'role_id'=>'required|in:1,2',
            'profile_image'=>'nullable|image|max:5120',
        ]);

        if($employee->user_id && $request->role_id){
            $user = $employee->user;
            $user->role_id = $request->role_id;
            $user->save();
        }

        $data = $request->only(['first_name','last_name','department_id','position_id','hire_date','phone','address']);
        if($request->hasFile('profile_image')){
            $file = $request->file('profile_image');
            $data['profile_image'] = file_get_contents($file->getRealPath());
            $data['profile_image_mime'] = $file->getMimeType();
        }

        $employee->update($data);

        return redirect()->route('admin.employees.index')->with('success','อัปเดตข้อมูลพนักงานเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        if($employee->user){
            $employee->user->delete();
        }
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success','ลบพนักงานเรียบร้อยแล้ว');
    }

    // =====================
    // Employee: Profile
    // =====================
    public function editProfile()
    {
        $employee = auth()->user()->employee;
        return view('employee.profile_edit', compact('employee'));
    }

    public function updateProfile(Request $request)
    {
        $employee = auth()->user()->employee; // get employee from id

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->phone = $request->phone;
        $employee->address = $request->address;

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $employee->profile_image = file_get_contents($file->getRealPath());
            $employee->profile_image_mime = $file->getMimeType();
        }

        $employee->save();

        return redirect()->route('employee.profile.edit')->with('success', 'แก้ไขโปรไฟล์เรียบร้อยแล้ว');
    }

    public function getProfileImage()
    {
        $employee = auth()->user()->employee;
        if(!$employee || !$employee->profile_image){
            abort(404);
        }

        $mime = $employee->profile_image_mime ?? 'image/jpeg';

        return response($employee->profile_image)->header('Content-Type', $mime);
    }

}
