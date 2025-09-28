<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Employee Dashboard</h1>
        <p class="mb-4">Welcome, <span class="font-medium">{{ auth()->user()->employee->first_name }}</span></p>

        @if($employee)
            {{-- Profile Section --}}
            <div class="flex items-center mb-6 space-x-6">
                @if($employee->profile_image)
                    <img src="{{ route('employee.profile.image') }}" 
                         alt="Profile Image" 
                         class="w-32 h-32 rounded-full border object-cover">
                @else
                    <div class="w-32 h-32 rounded-full border bg-gray-200 flex items-center justify-center text-gray-500">
                        ไม่มีรูป
                    </div>
                @endif

                <div>
                    <p><span class="font-semibold">ชื่อ:</span> {{ $employee->first_name }} {{ $employee->last_name }}</p>
                    <p><span class="font-semibold">แผนก:</span> {{ $employee->department->name ?? '-' }}</p>
                    <p><span class="font-semibold">ตำแหน่ง:</span> {{ $employee->position->name ?? '-' }}</p>

                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('employee.profile.edit') }}">
                            <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">แก้ไขโปรไฟล์</button>
                        </a>
                        <a href="{{ route('employee.leave.submit_form') }}">
                            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">ส่งคำขอลา</button>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Latest Leaves --}}
            <h2 class="text-xl font-semibold mb-2">คำขอลาล่าสุด</h2>
            @if($leaves->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ประเภทลา</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">วันที่เริ่ม</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">วันที่สิ้นสุด</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($leaves as $leave)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->leave_type }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->start_date }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $leave->end_date }}</td>
                                <td class="px-4 py-2 text-sm font-semibold">
                                    @if($leave->status === 'pending')
                                        <span class="text-orange-500">รออนุมัติ</span>
                                    @elseif($leave->status === 'approved')
                                        <span class="text-green-500">อนุมัติ</span>
                                    @elseif($leave->status === 'rejected')
                                        <span class="text-red-500">ปฏิเสธ</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">ยังไม่มีคำขอลา</p>
            @endif

        @else
            <p class="text-red-500">ยังไม่ได้เพิ่มข้อมูลพนักงาน</p>
        @endif

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Logout</button>
        </form>
    </div>
</body>
</html>
