<!DOCTYPE html>
<html>
<head>
    <title>Employee Leave</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">ฟอร์มส่งคำขอลา</h2>

        @if(session('success'))
            <p class="text-green-500 mb-4">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('employee.leave.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium mb-1">ประเภทการลา:</label>
                <select name="leave_type" required class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="ลาป่วย">ลาป่วย</option>
                    <option value="ลากิจ">ลากิจ</option>
                    <option value="ลาพักร้อน">ลาพักร้อน</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">วันที่เริ่ม:</label>
                <input type="date" name="start_date" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium mb-1">วันที่สิ้นสุด:</label>
                <input type="date" name="end_date" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium mb-1">เหตุผล:</label>
                <textarea name="reason" class="w-full border border-gray-300 rounded px-3 py-2" rows="4"></textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">ส่งคำขอลา</button>
                <a href="{{ route('employee.dashboard') }}">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">ย้อนกลับไป Dashboard</button>
                </a>
            </div>
        </form>
    </div>
</body>
</html>
