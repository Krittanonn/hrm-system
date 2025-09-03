
<div class="container mt-4">
    <h2 class="mb-3">ประวัติเงินเดือน: {{ $employee->first_name }} {{ $employee->last_name }}</h2>

    <table border="1" cellpadding="5" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>เงินเดือนพื้นฐาน</th>
                <th>โบนัส</th>
                <th>หัก</th>
                <th>สุทธิ</th>
                <th>วันที่บันทึกล่าสุด</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $salary)
            <tr>
                <td>{{ $salary->id }}</td>
                <td>{{ number_format($salary->base_salary, 2) }}</td>
                <td>{{ number_format($salary->bonus, 2) }}</td>
                <td>{{ number_format($salary->deduction, 2) }}</td>
                <td>{{ number_format($salary->net_salary, 2) }}</td>
                <td>{{ $salary->payment_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.salary.index') }}">
        <button>กลับหน้าจัดการเงินเดือน</button>
    </a>
</div>
