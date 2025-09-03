<!DOCTYPE html>

<!-- Dashboard admin page -->

<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }} (Role: {{ auth()->user()->role_id }})</p>

    <p>จำนวนพนักงานทั้งหมด: {{ $totalEmployees }}</p>

    <a href="{{ route('admin.employees.index') }}">
        <button>ดูรายชื่อพนักงาน</button>
    </a>

    <a href="{{ route('admin.employees.create') }}">
        <button>เพิ่มพนักงาน</button>
    </a>

    <a href="{{ route('admin.salary.index') }}">
        <button>จัดการเงินเดือน</button>
    </a>

    <a href="{{ route('admin.leaves.index') }}">
        <button>จัดการคำขอลา</button>
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
