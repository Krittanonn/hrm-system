<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการคำขอลา</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">จัดการคำขอลา</h1>

        @if(session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        <div class="overflow-x-auto mb-4">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ชื่อ-นามสกุล</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">แผนก</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ตำแหน่ง</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ประเภทลา</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">วันที่เริ่ม</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">วันที่สิ้นสุด</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">เหตุผล</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">สถานะ</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($leaves as $leave)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->id }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->employee->department->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->employee->position->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->leave_type }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->start_date }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->end_date }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->reason }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ ucfirst($leave->status) }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800 flex gap-2">
                            @if($leave->status == 'pending')
                                <form method="POST" action="{{ route('admin.leaves.approve', $leave->id) }}">
                                    @csrf
                                    <button type="submit" 
                                            class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">อนุมัติ</button>
                                </form>
                                <form method="POST" action="{{ route('admin.leaves.reject', $leave->id) }}">
                                    @csrf
                                    <button type="submit" 
                                            class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">ปฏิเสธ</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('admin.dashboard') }}" 
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 inline-block">
           กลับไป Dashboard
        </a>
    </div>
</body>
</html>
