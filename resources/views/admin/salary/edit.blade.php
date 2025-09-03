
<div class="container mt-4">
    <h2 class="mb-3">ปรับเงินเดือน: {{ $employee->first_name }} {{ $employee->last_name }}</h2>

    <form action="{{ route('admin.salary.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>เงินเดือนพื้นฐาน</label>
            <input type="number" name="base_salary" class="form-control" value="{{ $latestSalary->base_salary ?? 0 }}" required>
        </div>

        <div class="mb-3">
            <label>โบนัส</label>
            <input type="number" name="bonus" class="form-control" value="{{ $latestSalary->bonus ?? 0 }}">
        </div>

        <div class="mb-3">
            <label>หัก</label>
            <input type="number" name="deduction" class="form-control" value="{{ $latestSalary->deduction ?? 0 }}">
        </div>

        <div class="mb-3">
            <label>วันที่บันทึก</label>
            <input type="date" name="payment_date" class="form-control" value="{{ $latestSalary->payment_date ?? now()->toDateString() }}" required>
        </div>

        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="{{ url()->previous() }}">
            <button type="button">ยกเลิก</button>
        </a>
    </form>
</div>

