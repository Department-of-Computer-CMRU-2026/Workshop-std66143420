# 🎓 ระบบจัดการเวิร์กชอป (Workshop Management System)

ระบบลงทะเบียนและจัดการกิจกรรมเวิร์กชอป พัฒนาด้วย **Laravel 12** ร่วมกับ **Livewire 3** และออกแบบ UI ให้มีความสวยงามทันสมัยสไตล์ Glassmorphism ด้วย **Flux UI** และ **Tailwind CSS**

## ✨ ฟีเจอร์หลัก (Features)

### 🧑‍🎓 สำหรับนักศึกษา (Student Panel)
- **ลงทะเบียนเข้าร่วมเวิร์กชอป**: เลือกหัวข้อที่สนใจได้ สูงสุด **3 หัวข้อ** ต่อคน
- **ป้องกันลงทะเบียนซ้ำ**: ระบบตรวจสอบและปฏิเสธ Double Registration
- **ที่นั่งแบบ Real-time**: ระบบปิดรับสมัครอัตโนมัติเมื่อที่นั่งเต็ม
- **เวิร์กชอปของฉัน**: ดูกิจกรรมที่ลงทะเบียนไว้แล้ว และยกเลิกได้ (พร้อม Confirmation)
- **โปรไฟล์**: แสดงรูปภาพอัตโนมัติจาก CMRU API โดยใช้ `student_id`

### 👨‍💼 สำหรับผู้ดูแลระบบ (Admin Panel)
- **จัดการเวิร์กชอป (CRUD)**: สร้าง แก้ไข ดู และลบเวิร์กชอปได้
- **Dashboard**: ภาพรวมกิจกรรม จำนวนผู้ลงทะเบียน และที่นั่งคงเหลือ
- **ยืนยันก่อนดำเนินการ**: ป้องกันกดผิดพลาดด้วย SweetAlert2

## 🛠️ เทคโนโลยีที่ใช้ (Tech Stack)

| Layer | Technology |
|---|---|
| Backend | Laravel 12, PHP 8.4+ |
| Frontend | Livewire 3, Flux UI, Tailwind CSS v4 |
| Database | PostgreSQL 16 |
| Container | Docker, Docker Compose |
| CI/CD | GitHub Actions (Self-hosted Runner) |
| JS Runtime | Bun (สำหรับ build assets ใน Container) |
| Alerts | SweetAlert2 |

---

## 🖥️ การติดตั้งบนเครื่อง Server ครั้งแรก (First-time Server Setup)

> ✅ ใช้สำหรับ Setup โปรเจกต์บน Linux Server ที่มี Docker พร้อมใช้งานแล้ว

### 1. Clone โปรเจกต์
```bash
git clone https://<TOKEN>@github.com/Department-of-Computer-CMRU-2026/Workshop-std66143420.git
cd Workshop-std66143420
```

### 2. ตั้งค่า Environment
```bash
cp .env.example .env
nano .env   # แก้ไข APP_KEY, DB_*, และค่าต่าง ๆ ให้ครบถ้วน
```

### 3. แก้ไข uid ใน Dockerfile ให้ตรงกับ User ของ Server
```bash
# ตรวจสอบ uid และ gid ของ user ปัจจุบัน
id

# แก้ไข uid ใน Dockerfile ให้ตรงกัน แล้ว build ใหม่
docker compose build --no-cache
```

### 4. รัน Container
```bash
docker compose up -d
```

### 5. แก้ไข Permission
```bash
docker compose exec -u 0 app chown -R www-data:www-data storage bootstrap/cache
docker compose exec -u 0 app chmod -R 777 storage bootstrap/cache
docker compose exec -u 0 app chown www-data:www-data .env
docker compose exec -u 0 app chmod 664 .env
```

### 6. Setup Laravel
```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec -u 0 app php artisan storage:link
```

### 7. Build Frontend Assets (ใช้ bun)
```bash
docker compose exec app bun install
docker compose exec app bun run build
```

### 8. ตรวจสอบผล
```bash
docker ps   # ดูสถานะ Container
```
เข้าใช้งานที่ `http://<server-ip>:6001`

---

## 🔄 การ Deploy อัตโนมัติ (CI/CD)

โปรเจกต์ตั้งค่า **GitHub Actions** พร้อม Self-hosted Runner  
เมื่อ `push` ขึ้น `main` หรือ `master` ระบบจะ:
1. Backup `.env`
2. Rebuild Docker Images
3. `bun install && bun run build` (สร้าง Vite assets)
4. รัน `php artisan migrate`, `key:generate`, `storage:link`
5. Cleanup Docker images เก่า

---

## 🎨 UI Highlights
- โลโก้ **"พี่สอนน้อย"** ทั้ง Sidebar และ Desktop Menu
- รูปโปรไฟล์นักศึกษาดึงจาก CMRU API อัตโนมัติ
- หน้า Settings ใช้ **Card Layout + Glassmorphism** พร้อม Danger Zone สีแดง

---

## 👨‍💻 ผู้พัฒนา (Developer)

**Zismail (Zismaildev)** *Computer Science, Chiang Mai Rajabhat University*

- **GitHub:** [@Zismaildev](https://github.com/Zismaildev)
- **Skill Tree:** Full-stack Developer & Cybersecurity Enthusiast

---
*พัฒนาเพื่อประกอบการอบรม — Department of Computer Science, CMRU 2026*

