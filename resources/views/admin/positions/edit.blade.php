<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขแผนก</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">แก้ไขตำแหน่ง</h1>

        <form action="{{ route('admin.positions.update', $position->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block mb-1 font-medium">ชื่อตำแหน่ง</label>
                <input type="text" name="name" value="{{ $position->name }}" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                @error('name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    อัปเดต
                </button>

                <a href="{{ route('admin.positions.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 inline-block text-center">
                    กลับหน้าจัดการแผนก
                </a>
            </div>
        </form>
    </div>
</body>
</html>
