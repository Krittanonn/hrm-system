<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ประวัติเงินเดือน: {{ $employee->first_name }} {{ $employee->last_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow mb-4">
        <h2 class="text-2xl font-bold mb-4">ประวัติเงินเดือน: {{ $employee->first_name }} {{ $employee->last_name }}</h2>

        <div class="overflow-x-auto mb-4">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">เงินเดือนพื้นฐาน</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">โบนัส</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">หัก</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">สุทธิ</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">วันที่บันทึกล่าสุด</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($salaries as $salary)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $salary->id }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ number_format($salary->base_salary, 2) }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ number_format($salary->bonus, 2) }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ number_format($salary->deduction, 2) }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800 font-bold">{{ number_format($salary->net_salary, 2) }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $salary->payment_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('admin.salary.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 inline-block">
           กลับหน้าจัดการเงินเดือน
        </a>
    </div>
</body>
</html>
