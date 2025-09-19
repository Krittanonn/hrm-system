<!DOCTYPE html>
<html>
<head>
    <title>แก้ไขโปรไฟล์</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">แก้ไขโปรไฟล์</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('employee.profile.update') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-semibold">ชื่อ</label>
                <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('first_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">นามสกุล</label>
                <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('last_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">เบอร์โทร</label>
                <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">ที่อยู่</label>
                <textarea name="address" rows="3"
                          class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">{{ old('address', $employee->address) }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                บันทึกการแก้ไข
            </button>
            <a href="{{ url()->previous() }}" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                ย้อนกลับ
            </a>
        </form>
    </div>
</body>
</html>
