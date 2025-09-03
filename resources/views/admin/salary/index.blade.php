<!DOCTYPE html>
<html>
<head>
    <title>จัดการเงินเดือนพนักงาน</title>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-3">จัดการเงินเดือนพนักงาน</h2>

    <table border="1" cellpadding="5" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อ-นามสกุล</th>
                <th>เงินเดือนปัจจุบัน</th>
                <th>โบนัส</th>
                <th>หัก</th>
                <th>สุทธิ</th>
                <th>วันที่บันทึกล่าสุด</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                @php $salary = $employee->salaries->first(); @endphp
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td>{{ number_format($salary->base_salary ?? 0, 2) }}</td>
                    <td>{{ number_format($salary->bonus ?? 0, 2) }}</td>
                    <td>{{ number_format($salary->deduction ?? 0, 2) }}</td>
                    <td><strong>{{ number_format($salary->net_salary ?? 0, 2) }}</strong></td>
                    <td>{{ $salary->payment_date ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.salary.edit', $employee->id) }}" class="btn btn-sm btn-primary">ปรับเงินเดือน</a>
                        <a href="{{ route('admin.salary.history', $employee->id) }}" class="btn btn-sm btn-info">ประวัติ</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{ route('admin.dashboard') }}">
        <button type="button">ย้อนกลับไป Dashboard</button>
    </a>
</body>
