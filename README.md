# 🎓 ระบบจัดการเวิร์กชอป (Workshop Management System)

ระบบลงทะเบียนและจัดการกิจกรรมเวิร์กชอป พัฒนาด้วย **Laravel 12** ร่วมกับ **Livewire 3** และออกแบบ UI ให้มีความสวยงามทันสมัยสไตล์ Glassmorphism ด้วย **Flux UI** และ **Tailwind CSS**

## ✨ ฟีเจอร์หลัก (Features)

### 🧑‍🎓 สำหรับนักศึกษา (Student Panel)
- **ลงทะเบียนเข้าร่วมเวิร์กชอป**: นักศึกษาสามารถเลือกหัวข้อเวิร์กชอปที่สนใจเพื่อลงทะเบียนได้
- **เงื่อนไขการลงทะเบียน**:
  - ลงทะเบียนได้สูงสุด **3 หัวข้อ** ต่อคน
  - ป้องกันการลงทะเบียนซ้ำหัวข้อเดิม (Double Registration)
  - ระบบตรวจสอบและปิดรับสมัครอัตโนมัติเมื่อจำนวนที่นั่งเต็ม (Real-time Remaining Seats)
- **จัดการเวิร์กชอปของฉัน (My Workshops)**: ดูสถานะกิจกรรมที่ลงทะเบียนไปแล้ว และสามารถกด "ยกเลิก" การลงทะเบียนได้ (พร้อมยืนยันด้วย SweetAlert2)
- **โปรไฟล์ผู้ใช้ (Profile)**: ดึงรูปภาพประจำตัวผู้ใช้ (Avatar) อัตโนมัติด้วยระบบ API ของมหาวิทยาลัยราชภัฏเชียงใหม่ (CMRU API) ผ่านทางรหัสนักศึกษา (`student_id`)

### 👨‍💼 สำหรับผู้ดูแลระบบ (Admin Panel)
- **จัดการข้อมูลเวิร์กชอป (CRUD)**: สร้าง, ตรวจสอบ, แก้ไข และลบ เวิร์กชอปได้อย่างอิสระ
- **แดชบอร์ดสรุปผล (Dashboard)**: ดูข้อมูลภาพรวมของกิจกรรมทั้งหมด เช่น กิจกรรมที่กำลังเปิดรับ, จำนวนผู้ลงทะเบียนทั้งหมด และที่นั่งคงเหลือ
- **ระบบยืนยันการดำเนินการ (Confirmation)**: ป้องกันการกดผิดพลาด (เช่น การลบเวิร์กชอป หรือการลบผู้ใช้) แจ้งเตือนยืนยันด้วย UI ของ SweetAlert2 พร้อม Danger Zone สีแดงเด่นชัด

## 🛠️ เทคโนโลยีที่ใช้ (Tech Stack)

- **Backend**: Laravel 12, PHP 8.4+
- **Frontend / reactivity**: Livewire 3
- **UI Components**: Flux UI (by Livewire), Tailwind CSS
- **Database**: SQLite (หรือ MySQL/PostgreSQL ตามกำหนดใน `.env`)
- **Alerts & Modals**: SweetAlert2 

## 🚀 การติดตั้งและใช้งาน (Installation)

1. **โคลนโปรเจกต์ (Clone the repository)**
   ```bash
   git clone <repository-url>
   cd Workshop-std66143420
   ```

2. **ติดตั้ง Dependencies**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **คัดลอกไฟล์ Environment**
   ```bash
   cp .env.example .env
   ```

4. **สร้าง Application Key**
   ```bash
   php artisan key:generate
   ```

5. **รัน Migration และ Seed ข้อมูล (ถ้ามี)**
   ```bash
   php artisan migrate --seed
   ```

6. **เปิดเซิร์ฟเวอร์จำลอง (Start the local server)**
   ```bash
   php artisan serve
   ```
   จากนั้นเข้าใช้งานผ่านเบราว์เซอร์ที่ `http://localhost:8000` (หรือพอร์ตที่รันอยู่)

## 🎨 การปรับแต่ง UI (Customization Highlights)
- เมนูด้านซ้ายและเมนูผู้ใช้ (Sidebar & Desktop User Menu) ปรับโฉมโดยแสดงโลโก้ **"พี่สอนน้อย"** 
- แสดงรูปโปรไฟล์นักศึกษาจากฐานข้อมูลส่วนกลางโดยอัตโนมัติ
- หน้าจอการตั้งค่า (Settings: Profile, Password, 2FA) จัดรูปแบบใหม่เป็นแบบ Card Layout แยกสัดส่วนและมี Background Effect เพื่อความสวยงามพรีเมียม

---
*พัฒนาเพื่อประกอบวิชาหรือโครงการ Workshop สำหรับนักศึกษา*
