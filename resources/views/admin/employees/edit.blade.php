<!DOCTYPE html>

<!-- from edit page  -->

<html>
<head>
    <title>แก้ไขพนักงาน</title>
</head>
<body>
    <h1>แก้ไขพนักงาน</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}">
        @csrf
        @method('PUT')

        <p>
            <label>ชื่อ:</label><br>
            <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}">
        </p>
        <p>
            <label>นามสกุล:</label><br>
            <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}">
        </p>
        <p>
            <label>Role:</label><br>
            <select name="role_id">
                <option value="1">Admin</option>
                <option value="2" selected>Employee</option>
            </select>
        </p>
        <p>
            <label>แผนก:</label><br>
            <select name="department_id">
                <option value="">-- เลือกแผนก --</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ $employee->department_id == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label>ตำแหน่ง:</label><br>
            <select name="position_id">
                <option value="">-- เลือกตำแหน่ง --</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}" {{ $employee->position_id == $pos->id ? 'selected' : '' }}>
                        {{ $pos->name }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <label>วันที่เข้าทำงาน:</label><br>
            <input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}">
        </p>
        <p>
            <label>โทรศัพท์:</label><br>
            <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}">
        </p>
        <p>
            <label>ที่อยู่:</label><br>
            <input type="text" name="address" value="{{ old('address', $employee->address) }}">
        </p>
        <p>
            <label>User:</label><br>
            <select name="user_id">
                <option value="">-- เลือก User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $employee->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">บันทึก</button>
        <a href="{{ url()->previous() }}">
            <button type="button">ยกเลิก</button>
        </a>
    </form>
</body>
</html>
