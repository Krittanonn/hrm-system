<div class="container">
    <h1>เพิ่มแผนกใหม่</h1>

    <form action="{{ route('admin.departments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">ชื่อแผนก</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="{{ route('admin.departments.index') }}">
            <button>กลับหน้าจัดการแผนก</button>
        </a>
    </form>
</div>
