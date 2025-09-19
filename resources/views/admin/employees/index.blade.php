<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Employee List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow mb-4">
        <h1 class="text-2xl font-bold mb-4">Employee List</h1>

        <!-- link to create page -->
        <a href="{{ route('admin.employees.create') }}">
            <button class="mb-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">เพิ่มพนักงาน</button>
        </a>

        <!-- show success message -->
        @if(session('success'))
            <p class="text-green-600 font-medium mb-4">{{ session('success') }}</p>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ชื่อ-นามสกุล</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">แผนก</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ตำแหน่ง</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">วันเข้าทำงาน</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">โทรศัพท์</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">User</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($employees as $emp)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $emp->id }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $emp->first_name }} {{ $emp->last_name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $emp->department->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $emp->position->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $emp->hire_date }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $emp->phone }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $emp->user->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800 flex gap-2">
                            <a href="{{ route('admin.employees.edit', $emp->id) }}"
                               class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                            <form method="POST" action="{{ route('admin.employees.destroy', $emp->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                        onclick="return confirm('ลบพนักงาน?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="mt-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 inline-block">
           ย้อนกลับไป Dashboard
        </a>
    </div>
</body>
</html>
