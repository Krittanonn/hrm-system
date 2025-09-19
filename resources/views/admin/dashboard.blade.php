<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
        <p class="mb-2">Welcome, <span class="font-medium">{{ auth()->user()->name }}</span> (Role: {{ auth()->user()->role_id }})</p>
        <p class="mb-6">จำนวนพนักงานทั้งหมด: <span class="font-semibold">{{ $totalEmployees }}</span></p>

        {{-- Buttons in one line --}}
        <div class="flex flex-wrap gap-3 mb-6">
            <a href="{{ route('admin.employees.index') }}">
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">ดูรายชื่อพนักงาน</button>
            </a>
            <a href="{{ route('admin.employees.create') }}">
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">เพิ่มพนักงาน</button>
            </a>
            <a href="{{ route('admin.salary.index') }}">
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">จัดการเงินเดือน</button>
            </a>
            <a href="{{ route('admin.leaves.index') }}">
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">จัดการคำขอลา</button>
            </a>
            <a href="{{ route('admin.departments.index') }}">
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">จัดการแผนก</button>
            </a>
            <a href="{{ route('admin.positions.index') }}">
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">จัดการตำแหน่ง</button>
        </div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Logout</button>
        </form>
    </div>
</body>
</html>
