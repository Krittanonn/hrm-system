<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
</head>
<body>
    <h1>Employee Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}</p>

    @if($employee)
        <p>ชื่อ: {{ $employee->first_name }} {{ $employee->last_name }}</p>
        <p>แผนก: {{ $employee->department->name ?? '-' }}</p>
        <p>ตำแหน่ง: {{ $employee->position->name ?? '-' }}</p>

        <h3>คำขอลาล่าสุด</h3>
        @if($leaves->count() > 0)
            <table border="3" cellpadding="5">
                <thead>
                    <tr>
                        <th>ประเภทลา</th>
                        <th>วันที่เริ่ม</th>
                        <th>วันที่สิ้นสุด</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->leave_type }}</td>
                        <td>{{ $leave->start_date }}</td>
                        <td>{{ $leave->end_date }}</td>
                        <td>
                            @if($leave->status === 'pending')
                                <span style="color: orange;">รออนุมัติ</span>
                            @elseif($leave->status === 'approved')
                                <span style="color: green;">อนุมัติ</span>
                            @elseif($leave->status === 'rejected')
                                <span style="color: red;">ปฏิเสธ</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>ยังไม่มีคำขอลา</p>
        @endif

        <a href="{{ route('employee.leave.submit_form') }}">
            <button type="button">ส่งคำขอลา</button>
        </a>
    @else
        <p>ยังไม่ได้เพิ่มข้อมูลพนักงาน</p>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
