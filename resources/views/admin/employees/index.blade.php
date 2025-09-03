<!DOCTYPE html>

<!-- Index page -->

<html>
<head>
    <title>Employee List</title>
</head>
<body>
    <h1>Employee List</h1>

    <!-- link to create page -->
    <a href="{{ route('admin.employees.create') }}"><button>เพิ่มพนักงาน</button></a>
    
    <!-- show success message on display -->
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="3" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>ชื่อ-นามสกุล</th>
            <th>แผนก</th>
            <th>ตำแหน่ง</th>
            <th>วันเข้าทำงาน</th>
            <th>โทรศัพท์</th>
            <th>User</th>
            <th>Actions</th>
        </tr>
        @foreach($employees as $emp)
        <!-- create table for show employees -->
            <tr>
                <td>{{ $emp->id }}</td>
                <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                <td>{{ $emp->department->name ?? '-' }}</td>
                <td>{{ $emp->position->name ?? '-' }}</td>
                <td>{{ $emp->hire_date }}</td>
                <td>{{ $emp->phone }}</td>
                <td>{{ $emp->user->name ?? '-' }}</td>
                <td>
                    <!-- link to edit page by use post to route -->
                    <a href="{{ route('admin.employees.edit', $emp->id) }}">Edit</a>
                    <!-- post delete command -->
                    <form method="POST" action="{{ route('admin.employees.destroy', $emp->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('ลบพนักงาน?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <!-- link to Dashboard admin -->
    <a href="{{ route('admin.dashboard') }}">
        <button type="button">ย้อนกลับไป Dashboard</button>
    </a>
</body>
</html>
