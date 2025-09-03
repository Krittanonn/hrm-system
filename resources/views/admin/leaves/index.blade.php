<!DOCTYPE html>
<html>
<head>
    <title>จัดการคำขอลา</title>
</head>
<body>
    <h1>จัดการคำขอลา</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>ชื่อ-นามสกุล</th>
            <th>ประเภทลา</th>
            <th>วันที่เริ่ม</th>
            <th>วันที่สิ้นสุด</th>
            <th>เหตุผล</th>
            <th>สถานะ</th>
            <th>Actions</th>
        </tr>
        @foreach($leaves as $leave)
        <tr>
            <td>{{ $leave->id }}</td>
            <td>{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}</td>
            <td>{{ $leave->leave_type }}</td>
            <td>{{ $leave->start_date }}</td>
            <td>{{ $leave->end_date }}</td>
            <td>{{ $leave->reason }}</td>
            <td>{{ ucfirst($leave->status) }}</td>
            <td>
                @if($leave->status == 'pending')
                    <form method="POST" action="{{ route('admin.leaves.approve', $leave->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit">อนุมัติ</button>
                    </form>
                    <form method="POST" action="{{ route('admin.leaves.reject', $leave->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit">ปฏิเสธ</button>
                    </form>
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </table>

    <a href="{{ route('admin.dashboard') }}">
        <button>กลับไป Dashboard</button>
    </a>
</body>
</html>
