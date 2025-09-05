<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }} (Role: {{ auth()->user()->role_id }})</p>

    <p>จำนวนพนักงานทั้งหมด: {{ $totalEmployees }}</p>

    {{-- Employee --}}
    <a href="{{ route('admin.employees.index') }}"><button>ดูรายชื่อพนักงาน</button></a>
    <a href="{{ route('admin.employees.create') }}"><button>เพิ่มพนักงาน</button></a>

    {{-- Salary --}}
    <a href="{{ route('admin.salary.index') }}"><button>จัดการเงินเดือน</button></a>

    {{-- Leave --}}
    <a href="{{ route('admin.leaves.index') }}"><button>จัดการคำขอลา</button></a>

    {{-- Departments --}}
    <a href="{{ route('admin.departments.index') }}">
        <button>จัดการแผนก</button>
    </a>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
