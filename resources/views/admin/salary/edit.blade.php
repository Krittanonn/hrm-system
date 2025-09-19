<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ปรับเงินเดือน: {{ $employee->first_name }} {{ $employee->last_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">ปรับเงินเดือน: {{ $employee->first_name }} {{ $employee->last_name }}</h2>

        <form action="{{ route('admin.salary.update', $employee->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-medium">เงินเดือนพื้นฐาน</label>
                <input type="number" name="base_salary" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       value="{{ $latestSalary->base_salary ?? 0 }}" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">โบนัส</label>
                <input type="number" name="bonus" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       value="{{ $latestSalary->bonus ?? 0 }}">
            </div>

            <div>
                <label class="block mb-1 font-medium">หัก</label>
                <input type="number" name="deduction" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       value="{{ $latestSalary->deduction ?? 0 }}">
            </div>

            <div>
                <label class="block mb-1 font-medium">วันที่บันทึก</label>
                <input type="date" name="payment_date" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       value="{{ $latestSalary->payment_date ?? now()->toDateString() }}" required>
            </div>

            <div class="flex gap-2">
                <button type="submit" 
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        บันทึก
                </button>
                <a href="{{ url()->previous() }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 inline-block text-center">
                   ยกเลิก
                </a>
            </div>
        </form>
    </div>
</body>
</html>
