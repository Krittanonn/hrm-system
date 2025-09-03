<!DOCTYPE html>
<html>
<head>
    <title>Employee Leave</title>
</head>
<body>
    <h2>ฟอร์มส่งคำขอลา</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('employee.leave.submit') }}">
        @csrf

        <label>ประเภทการลา:</label>
        <select name="leave_type" required>
            <option value="ลาป่วย">ลาป่วย</option>
            <option value="ลากิจ">ลากิจ</option>
            <option value="ลาพักร้อน">ลาพักร้อน</option>
        </select><br>

        <label>วันที่เริ่ม:</label>
        <input type="date" name="start_date" required><br>

        <label>วันที่สิ้นสุด:</label>
        <input type="date" name="end_date" required><br>

        <label>เหตุผล:</label>
        <textarea name="reason"></textarea><br>

        <button type="submit">ส่งคำขอลา</button>
        <a href="{{ route('employee.dashboard') }}">
        <button type="button">ย้อนกลับไป Dashboard</button>
    </a>
    </form>
</body>
</html>
