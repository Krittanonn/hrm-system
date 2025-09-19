<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Models
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;

class EmployeeController extends Controller
{
    // show all employees
    public function index()
    {
        // get all employees with department, position, user
        $employees = Employee::with(['department', 'position', 'user'])->get();
        return view('admin.employees.index', compact('employees'));
    }

    // show create employee form
    public function create()
    {   
        // get all departments, positions, users for dropdown
        $departments = Department::all();
        $positions = Position::all();
        $users = User::all();

        return view('admin.employees.create', compact('departments', 'positions', 'users'));
    }

    // store new employee and create user automatically
    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255', // required and string max 255 char
            'last_name'     => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id', // required choose from departments table
            'position_id'   => 'required|exists:positions,id', // required choose from positions table
            'hire_date'     => 'required|date', // required date format
            'phone'         => 'nullable|string|max:20', // optional phone
            'address'       => 'nullable|string|max:255', // optional address
        ]);

        // create unique email
        $emailBase = strtolower($request->first_name) . '.' . strtolower($request->last_name);
        $email = $emailBase . '@company.com'; // autimatic email for use login
        $counter = 1; // counter to make email unique

        while (User::where('email', $email)->exists()) {
            $email = $emailBase . $counter . '@company.com'; // if has email in DB, add counter
            $counter++;
        }

        // crate User
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name, 
            'email' => $email,
            'password' => Hash::make('123456'), // default password
            'role_id' => $request->role_id, // link role from create form
        ]);

        // create Employee and link to User
        Employee::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'department_id' => $request->department_id,
            'position_id'   => $request->position_id,
            'hire_date'     => $request->hire_date,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'user_id'       => $user->id,
        ]);

        return redirect()->route('admin.employees.index')
                         ->with('success', 'เพิ่มพนักงานและสร้าง user เรียบร้อยแล้ว');
    }

    // edit employee info
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        $users = User::all();

        return view('admin.employees.edit', compact('employee', 'departments', 'positions', 'users'));
    }

    // update employee info
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'first_name'    => 'required|string|max:255', // string max 255 char
            'last_name'     => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id', // select from departments table
            'position_id'   => 'required|exists:positions,id', // select from positions table
            'hire_date'     => 'required|date',
            'phone'         => 'nullable|string|max:20', // optional phone
            'address'       => 'nullable|string|max:255', // optional address
            'role_id'       => 'required|in:1,2', // required choose role Admin or Employee
        ]);

        // update User role if changed
        if ($employee->user_id && $request->role_id) { // if has user_id and role_id from form
            $user = $employee->user; // get user from employee
            $user->role_id = $request->role_id; // update role_id
            $user->save();
        }

        // update Employee info if not new data ignore and use old data
        $employee->update($request->only([
            'first_name', 
            'last_name',
            'department_id',
            'position_id',
            'hire_date',
            'phone',
            'address',
        ]));

        return redirect()->route('admin.employees.index')
                        ->with('success', 'อัปเดตข้อมูลพนักงานเรียบร้อยแล้ว');
    }


    // delete employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // delete employee and associated user
        if ($employee->user) {
            $employee->user->delete(); // delete user if has
        }

        $employee->delete();

        return redirect()->route('admin.employees.index')
                         ->with('success', 'ลบพนักงานเรียบร้อยแล้ว');
    }

    public function editProfile()
    {
        $employee = auth()->user()->employee; 
        return view('employee.profile_edit', compact('employee'));
    }

    public function updateProfile(Request $request)
    {
        $employee = auth()->user()->employee;

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
        ]);

        $employee->update($request->only(['first_name', 'last_name', 'phone', 'address']));

        return redirect()->route('employee.profile.edit')->with('success', 'อัปเดตข้อมูลสำเร็จ');
    }

}
