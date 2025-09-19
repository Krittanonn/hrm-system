<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มพนักงานใหม่</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 font-sans">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">เพิ่มพนักงานใหม่</h1>

        <!-- show validation errors -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.employees.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">ชื่อ</label>
                <input type="text" name="first_name" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       value="{{ old('first_name') }}">
                <label class="block mb-1 font-medium">นามสกุล</label>
                <input type="text" name="last_name" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       value="{{ old('last_name') }}">
            </div>

            <div>
                <label class="block mb-1 font-medium">Role</label>
                <select name="role_id" 
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="1">Admin</option>
                    <option value="2" selected>Employee</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">แผนก</label>
                <select name="department_id" 
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- เลือกแผนก --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">ตำแหน่ง</label>
                <select name="position_id" 
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- เลือกตำแหน่ง --</option>
                    @foreach($positions as $pos)
                        <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">วันที่เข้าทำงาน</label>
                <input type="date" name="hire_date" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       value="{{ old('hire_date') }}">
            </div>

            <div>
                <label class="block mb-1 font-medium">โทรศัพท์</label>
                <input type="text" name="phone" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       value="{{ old('phone') }}">
            </div>

            <div>
                <label class="block mb-1 font-medium">ที่อยู่</label>
                <input type="text" name="address" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       value="{{ old('address') }}">
            </div>

            <div>
                <label class="block mb-1 font-medium">User (ถ้ามี)</label>
                <select name="user_id" 
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- เลือก User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
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
