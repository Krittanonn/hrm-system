<div class="container">
    <h1>แก้ไขแผนก</h1>

    <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">ชื่อแผนก</label>
            <input type="text" name="name" class="form-control" value="{{ $department->name }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">อัปเดต</button>
        <a href="{{ route('admin.departments.index') }}">
            <button>กลับหน้าจัดการแผนก</button>
        </a>
    </form>
</div>
