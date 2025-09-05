# HRM System (Human Resource Management)

ระบบบริหารจัดการบุคลากรและการเงิน/บัญชี สำหรับองค์กร  
พัฒนาด้วย **Laravel (PHP) + Blade Templating + MySQL**

---

## 🚀 Features

### 👩‍💼 พนักงานทั่วไป (Employee)
- Dashboard ส่วนตัว: ข้อมูลส่วนตัว, ตำแหน่ง, แผนก, สลิปเงินเดือนล่าสุด
- โปรไฟล์ของฉัน: ดู/แก้ไขข้อมูล, เปลี่ยนรหัสผ่าน
- เงินเดือนของฉัน: ดูประวัติเงินเดือน, ดาวน์โหลดสลิป (PDF)
- แจ้งขอลา: ฟอร์มแจ้งวันลา, ตรวจสอบสถานะการลา
- ประกาศ/ข่าวสาร: ดูข่าวสารจาก HR

### 🧑‍💼 HR/Admin
- Dashboard ผู้ดูแล: จำนวนพนักงาน, เงินเดือนที่ต้องจ่าย, การลา
- จัดการพนักงาน: เพิ่ม/แก้ไข/ลบข้อมูล, จัดการตำแหน่งและแผนก
- จัดการแผนก/ตำแหน่ง: CRUD ข้อมูล
- จัดการเงินเดือน: ตั้งค่าเงินเดือน, โบนัส, Generate & Download Pay Slip
- จัดการผู้ใช้ระบบ: สร้าง user login, กำหนดบทบาท
- จัดการการลา: อนุมัติ/ปฏิเสธ
- รายงาน & Export: เงินเดือน, การลา, Export Excel/PDF

---

## 🛠️ Tech Stack

- **Backend**: PHP 8+, Laravel 10  
- **Frontend**: Laravel Blade, Tailwind CSS  
- **Database**: MySQL  
- **Authentication**: Laravel Breeze / Fortify / Custom JWT (ขึ้นกับ implementation)  

---

## 📂 Project Structure

```bash
hrm-system/
│── app/             
│── bootstrap/       
│── config/          
│── database/        # Migrations & Seeders
│── public/          # Public assets
│── resources/       # Blade views, CSS, JS
│── routes/          # Web & API routes
│── storage/         
│── tests/           
└── README.md

