<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการตำแหน่ง</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">จัดการตำแหน่ง</h1>

        <!-- ปุ่มเพิ่มตำแหน่ง -->
        <div class="mb-4">
            <a href="{{ route('admin.positions.create') }}">
                <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    เพิ่มตำแหน่งใหม่
                </button>
            </a>

            <!-- ปุ่มกลับหน้าต่างเว็บ admin -->
            <button type="button" onclick="window.location='{{ route('admin.dashboard') }}'"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                กลับหน้าต่างเว็บ
            </button>
        </div>

        <!-- ตารางรายการตำแหน่ง -->
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-2 px-4">#</th>
                    <th class="py-2 px-4">ชื่อตำแหน่ง</th>
                    <th class="py-2 px-4">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($positions as $position)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4">{{ $position->name }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.positions.edit', $position->id) }}">
                                <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                                    แก้ไข
                                </button>
                            </a>

                            <form action="{{ route('admin.positions.destroy', $position->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                        onclick="return confirm('คุณแน่ใจว่าจะลบตำแหน่งนี้?')">
                                    ลบ
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
