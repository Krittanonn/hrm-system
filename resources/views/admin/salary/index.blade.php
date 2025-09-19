<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการเงินเดือนพนักงาน</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow mb-4">
        <h2 class="text-2xl font-bold mb-4">จัดการเงินเดือนพนักงาน</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ชื่อ-นามสกุล</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">เงินเดือนปัจจุบัน</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">โบนัส</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">หัก</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">สุทธิ</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">วันที่บันทึกล่าสุด</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($employees as $employee)
                        @php $salary = $employee->salaries->first(); @endphp
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $employee->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ number_format($salary->base_salary ?? 0, 2) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ number_format($salary->bonus ?? 0, 2) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ number_format($salary->deduction ?? 0, 2) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800 font-bold">{{ number_format($salary->net_salary ?? 0, 2) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $salary->payment_date ?? '-' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800 flex gap-2">
                                <a href="{{ route('admin.salary.edit', $employee->id) }}"
                                   class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">ปรับเงินเดือน</a>
                                <a href="{{ route('admin.salary.history', $employee->id) }}"
                                   class="px-2 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600">ประวัติ</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="max-w-6xl mx-auto">
        <a href="{{ route('admin.dashboard') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 inline-block">
           ย้อนกลับไป Dashboard
        </a>
    </div>
</body>
</html>
