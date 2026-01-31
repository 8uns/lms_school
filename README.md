# 📚 Learning Management System (LMS) App

**###English**
**
# 📚 Learning Management System (LMS) App

A web-based **LMS** application designed to manage digital teaching and learning activities. This system supports academic data management, learning material distribution, and online assessments with a strict user role-based access control.

---

## 🛠️ Tech Stack
- **Core Engine:** Custom PHP MVC Framework
- **Frontend:** Tailwind CSS, Alpine.js
- **Icons:** Remix Icon
- **Database:** MySQL
- **Dependency Management:** Composer & NPM

---

## 📂 Directory Structure

This project follows the **MVC (Model-View-Controller)** pattern to separate business logic from the user interface:

- `app/Controllers`: Request handling logic based on user roles.
- `app/Core`: Core framework engine (Router, Session, Database, etc.).
- `app/Models`: Direct interaction with database tables.
- `app/View`: UI template files (Layouts & Components).
- `config/`: Global application configurations.
- `public/`: Primary entry point (`index.php`) and static assets.
- `routes/`: Application URL path definitions.

---

## 📑 Database Schema (Entity Relationship)

The system features an interconnected database structure to support academic history:

### Core Tables:
- **Users**: User credentials (SuperAdmin, Admin, Teacher, Student).
- **Academic Years**: Odd/Even semesters and active academic periods.
- **Subjects & Classrooms**: Master data for subjects and classes.
- **Teacher Assignments**: Mapping teachers to specific subjects and classes.
- **Assessments**: Exam data, question banks, and student results.

---

## 🚀 Features & Development Status

### 1. Basic & Security
- [x] **Authentication**: Login, Register (Role Selection), Session Management.
- [x] **Authorization**: Route protection middleware & dedicated dashboards for each role.
- [x] **UX**: Flash messages & Role-based redirection.
- [x] **Security**: XSS Protection, Password Hashing, Soft Delete, Access Logging.

### 2. Role-Based Features
#### **Super Admin**
- [x] Manage Admin accounts.
- [ ] System Log Monitoring & Force Logout.
- [ ] Database Backup, Recovery, & Soft Delete Restoration.

#### **Admin**
- [x] Manage Teachers, Students, Classes, & Subjects.
- [x] Manage Academic Years & Teacher Assignments (Mapping Teacher-Subject-Class).
- [ ] Student Class Assignment (Roster) & Lesson Plan (RPP) uploads.

#### **Teacher**
- [ ] Access Lesson Plans & Upload Learning Materials (Draft/Publish).
- [ ] Monitor Material Views & Discussion/Comment sections.
- [ ] Question Bank Management (Supports previous years' questions).
- [ ] Assessment Execution (Auto-graded for Multiple Choice, Manual for Essay).

#### **Student**
- [ ] Access Learning Materials & participate in discussions.
- [ ] Take Assessments & view personal grades.

---

## ⚙️ Installation

1. **Clone Repository**
   ```bash
   git clone [https://github.com/username/lms_app.git](https://github.com/username/lms_app.git)
   cd lms_app

2. **Install Dependencies**
   ```
   composer install
   npm install

3. **Database Configuration**
   Create a new database in MySQL.
   Import the schema file located at database/migration/schema.sql.
   Update your configuration in config/Database.php or your .env file.

5. **Run Application**
   ```
   php -S localhost:8000 -t public



**###Indonesian**
**
Aplikasi **LMS** berbasis web yang dirancang untuk mengelola kegiatan belajar mengajar secara digital. Sistem ini mendukung pengelolaan data akademik, distribusi bahan ajar, hingga pelaksanaan asesmen (ujian) online dengan sistem peran pengguna yang ketat.

---

## 🛠️ Tech Stack
- **Core Engine:** Custom PHP MVC Framework
- **Frontend:** Tailwind CSS, Alpine.js
- **Icons:** Remix Icon
- **Database:** MySQL
- **Dependency Management:** Composer & NPM

---

## 📂 Struktur Direktori

Proyek ini menggunakan pola **MVC (Model-View-Controller)** untuk memisahkan logika bisnis dengan tampilan:

- `app/Controllers`: Logika penanganan request berdasarkan peran.
- `app/Core`: Core engine framework (Router, Session, Database, dll).
- `app/Models`: Interaksi langsung dengan tabel database.
- `app/View`: File template UI (Layouts & Components).
- `config/`: Konfigurasi global aplikasi.
- `public/`: Entry point utama (`index.php`) dan aset statis.
- `routes/`: Definisi jalur URL aplikasi.

---

## 📑 Skema Database (Entity Relationship)

Sistem ini memiliki struktur database yang saling berelasi untuk mendukung riwayat akademik:



### Tabel Utama:
- **Users**: Pengguna (SuperAdmin, Admin, Guru, Siswa).
- **Academic Years**: Semester ganjil/genap dan tahun aktif.
- **Subjects & Classrooms**: Data master mata pelajaran dan rombel.
- **Teacher Assignments**: Penugasan guru di kelas dan mapel tertentu.
- **Assessments**: Data ujian, bank soal, dan hasil jawaban siswa.

---

## 🚀 Fitur & Status Pengembangan

### 1. Basic & Security
- [x] **Authentication**: Login, Register (Role Selection), Session Management.
- [x] **Authorization**: Middleware proteksi route & Dashboard terpisah tiap role.
- [x] **UX**: Flash messages & Role-based redirect.
- [x] **Security**: XSS Protection, Password Hashing, Soft Delete, Access Logging.

### 2. Fitur Berdasarkan Peran
#### **Super Admin**
- [x] Manajemen Akun Admin.
- [ ] Monitoring Log System & Force Logout.
- [ ] Database Backup, Recovery, & Restore Soft Delete.

#### **Admin**
- [x] Manajemen Guru, Siswa, Kelas, & Mata Pelajaran.
- [x] Manajemen Tahun Ajaran & Penugasan Guru (Mapping Guru-Mapel-Kelas).
- [ ] Penentuan Kelas Siswa (Rombel) & Upload RPP.

#### **Guru**
- [ ] Akses RPP & Upload Bahan Ajar (Draft/Publish).
- [ ] Monitoring Viewer Bahan Ajar & Kolom Diskusi/Komentar.
- [ ] Manajemen Bank Soal (Mendukung soal tahun sebelumnya).
- [ ] Pelaksanaan Asesmen (Otomatis untuk PG, Manual untuk Esai).

#### **Siswa**
- [ ] Akses Bahan Ajar & Partisipasi Diskusi.
- [ ] Mengikuti Asesmen & Melihat Hasil Nilai Mandiri.

---

## ⚙️ Instalasi

1. **Clone Repository**
   ```
   git clone [https://github.com/username/lms_app.git](https://github.com/username/lms_app.git)

2. **Install Dependensi**
   ```
   composer install
   npm install

3. **Konfigurasi Database**
   Buat database baru di MySQL.
   Import file database/migration/schema.sql.
   Sesuaikan konfigurasi di config/Database.php atau .env.

4. **Jalankan Aplikasi**
   ```
   php -S localhost:8000 -t public


