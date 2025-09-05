<h1>รายการแผนก</h1>

<a href="{{ route('admin.departments.create') }}">
    <button>เพิ่มแผนก</button>
</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ชื่อแผนก</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $department)
            <td>{{ $department->id }}</td>
            <td>{{ $department->name }}</td>
            <td>
                <a href="{{ route('admin.departments.edit', $department->id) }}">แก้ไข</a>
                <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">ลบ</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
