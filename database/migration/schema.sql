-- CREATE TABLE users (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     username VARCHAR(50) UNIQUE NOT NULL, -- ID unik login (NIS/NIP). Tidak boleh ganda.
--     password VARCHAR(255) NOT NULL,        -- Hash password untuk keamanan data.
--     full_name VARCHAR(100) NOT NULL,      -- Nama lengkap untuk keperluan rapor/sertifikat.
--     role ENUM('SuperAdmin', 'Admin', 'Guru', 'Siswa') NOT NULL, -- Penentu hak akses sistem.
--     is_deleted BOOLEAN DEFAULT FALSE,     -- Flag soft delete agar data tetap ada di arsip DB.
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Waktu pendaftaran akun.
-- );

-- CREATE TABLE access_logs (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     user_id INT,                          -- Referensi user yang melakukan aktivitas.
--     action VARCHAR(255),                  -- Deskripsi aksi (cth: "Login", "Hapus Soal").
--     ip_address VARCHAR(45),               -- Alamat IP untuk audit keamanan akses.
--     user_agent TEXT,                      -- Info browser/perangkat untuk fitur Force Logout.
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (user_id) REFERENCES users(id)
-- );

-- CREATE TABLE academic_years (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     year_name VARCHAR(20),                -- Label tahun ajaran (cth: '2024/2025').
--     semester ENUM('Ganjil', 'Genap'),     -- Pembagian periode belajar.
--     is_active BOOLEAN DEFAULT TRUE        -- Penanda tahun/semester yang sedang berjalan.
-- 		is_deleted BOOLEAN DEFAULT FALSE,     -- Flag soft delete agar data tetap ada di arsip DB.
-- );

-- CREATE TABLE subjects (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     subject_name VARCHAR(100),            -- Nama mata pelajaran (cth: 'Matematika').
--     is_deleted BOOLEAN DEFAULT FALSE      -- Soft delete mata pelajaran.
-- );

-- CREATE TABLE classrooms (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     class_name VARCHAR(20),               -- Nama rombel (cth: 'X-IPA-1', '7A').
--     is_deleted BOOLEAN DEFAULT FALSE      -- Soft delete kelas.
-- );

-- CREATE TABLE teacher_assignments (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     teacher_id INT,                       -- Guru yang ditugaskan (FK ke users).
--     subject_id INT,                       -- Mata pelajaran yang diampu.
--     classroom_id INT,                     -- Kelas tempat guru tersebut mengajar.
--     academic_year_id INT,                 -- Konteks waktu penugasan (berbeda tiap tahun/semester).
--     FOREIGN KEY (teacher_id) REFERENCES users(id),
--     FOREIGN KEY (subject_id) REFERENCES subjects(id),
--     FOREIGN KEY (classroom_id) REFERENCES classrooms(id),
--     FOREIGN KEY (academic_year_id) REFERENCES academic_years(id)
-- );

-- CREATE TABLE student_classes (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     student_id INT,                       -- Siswa yang ditempatkan (FK ke users).
--     classroom_id INT,                     -- Kelas tempat siswa belajar.
--     academic_year_id INT,                 -- Untuk riwayat kenaikan kelas siswa dari tahun ke tahun.
--     FOREIGN KEY (student_id) REFERENCES users(id),
--     FOREIGN KEY (classroom_id) REFERENCES classrooms(id),
--     FOREIGN KEY (academic_year_id) REFERENCES academic_years(id)
-- );

-- CREATE TABLE lesson_plans (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     subject_id INT,                       -- RPP untuk mata pelajaran tertentu.
--     admin_id INT,                         -- Admin kurikulum yang memvalidasi/mengunggah.
--     file_path VARCHAR(255),               -- Lokasi penyimpanan file modul (PDF/Doc).
--     academic_year_id INT,                 -- Versi RPP berdasarkan tahun ajaran.
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (subject_id) REFERENCES subjects(id),
--     FOREIGN KEY (admin_id) REFERENCES users(id),
--     FOREIGN KEY (academic_year_id) REFERENCES academic_years(id)
-- );

-- CREATE TABLE teaching_materials (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     teacher_assignment_id INT,            -- Mengikat materi ke jadwal mengajar guru di kelas spesifik.
--     title VARCHAR(255),                   -- Judul materi (cth: 'Bab 1: Aljabar').
--     content TEXT,                         -- Isi materi jika dalam bentuk teks/HTML.
--     file_path VARCHAR(255),               -- Lampiran file materi (jika ada).
--     status ENUM('Draft', 'Publish') DEFAULT 'Draft', -- Jika draft, materi belum tampil di sisi siswa.
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (teacher_assignment_id) REFERENCES teacher_assignments(id)
-- );

-- CREATE TABLE material_views (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     material_id INT,                      -- Materi yang diakses.
--     student_id INT,                       -- Siswa yang membaca.
--     viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Bukti kehadiran siswa dalam mempelajari materi.
--     FOREIGN KEY (material_id) REFERENCES teaching_materials(id),
--     FOREIGN KEY (student_id) REFERENCES users(id)
-- );

-- CREATE TABLE material_discussions (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     material_id INT,                      -- Topik materi yang didiskusikan.
--     user_id INT,                          -- Pengirim komentar (Bisa Guru atau Siswa).
--     comment TEXT,                         -- Isi pesan diskusi.
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (material_id) REFERENCES teaching_materials(id),
--     FOREIGN KEY (user_id) REFERENCES users(id)
-- );

-- CREATE TABLE question_bank (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     subject_id INT,                       -- Kategorisasi soal per mata pelajaran.
--     teacher_id INT,                       -- Guru pembuat soal (pemilik hak cipta soal).
--     question_text TEXT,                   -- Pertanyaan (mendukung tag HTML untuk gambar/rumus).
--     question_type ENUM('Pilihan Ganda', 'Esai', 'Portofolio', 'Proyek') NOT NULL, -- Menentukan UI pengerjaan siswa.
--     academic_year_id INT,                 -- Penanda tahun pembuatan soal.
--     is_deleted BOOLEAN DEFAULT FALSE,     -- Soft delete soal.
--     FOREIGN KEY (subject_id) REFERENCES subjects(id),
--     FOREIGN KEY (teacher_id) REFERENCES users(id),
--     FOREIGN KEY (academic_year_id) REFERENCES academic_years(id)
-- );

-- CREATE TABLE question_options (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     question_id INT UNIQUE,               -- Relasi 1-to-1 dengan soal PG.
--     option_a TEXT,                        -- Teks pilihan jawaban A.
--     option_b TEXT,                        -- Teks pilihan jawaban B.
--     option_c TEXT,                        -- Teks pilihan jawaban C.
--     option_d TEXT,                        -- Teks pilihan jawaban D.
--     option_e TEXT,                        -- Teks pilihan jawaban E.
--     correct_answer ENUM('A', 'B', 'C', 'D', 'E'), -- Kunci jawaban untuk koreksi otomatis.
--     FOREIGN KEY (question_id) REFERENCES question_bank(id) ON DELETE CASCADE -- Jika soal dihapus, opsi ikut terhapus.
-- );

-- CREATE TABLE assessments (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     teacher_assignment_id INT,            -- Mengikat ujian ke kelas, guru, dan mapel tertentu.
--     title VARCHAR(255),                   -- Nama asesmen (cth: 'Ulangan Harian 1').
--     assessment_type ENUM('Awal', 'Formatif', 'Sumatif'), -- Jenis penilaian pendidikan.
--     category ENUM('Pilihan Ganda', 'Esai', 'Portofolio', 'Proyek') NOT NULL, -- Filter agar tipe soal seragam dalam satu ujian.
--     start_time DATETIME,                  -- Jadwal mulai pengerjaan dibuka.
--     end_time DATETIME,                    -- Batas akhir waktu pengumpulan.
--     duration_minutes INT,                 -- Lama waktu pengerjaan (Timer) dalam menit.
--     status ENUM('Draft', 'Publish') DEFAULT 'Draft',
--     FOREIGN KEY (teacher_assignment_id) REFERENCES teacher_assignments(id)
-- );

-- CREATE TABLE assessment_items (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     assessment_id INT,                    -- Relasi ke lembar ujian.
--     question_id INT,                      -- ID soal yang diambil dari Bank Soal.
--     order_number INT,                     -- Urutan nomor soal (bisa digunakan untuk fitur acak soal).
--     FOREIGN KEY (assessment_id) REFERENCES assessments(id),
--     FOREIGN KEY (question_id) REFERENCES question_bank(id)
-- );

-- CREATE TABLE assessment_submissions (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     assessment_id INT,                    -- Ujian yang dikerjakan.
--     student_id INT,                       -- Peserta ujian.
--     total_score DECIMAL(5,2) DEFAULT 0,   -- Skor akhir kumulatif (hasil sum points_earned di student_answers).
--     status ENUM('Belum Dikerjakan', 'Selesai', 'Sudah Dinilai') DEFAULT 'Belum Dikerjakan',
--     submitted_at TIMESTAMP NULL,          -- Waktu penekanan tombol submit oleh siswa.
--     FOREIGN KEY (assessment_id) REFERENCES assessments(id),
--     FOREIGN KEY (student_id) REFERENCES users(id)
-- );

-- CREATE TABLE student_answers (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     submission_id INT,                    -- Merujuk ke lembar jawaban siswa.
--     question_id INT,                      -- Soal yang sedang dijawab.
--     answer_text TEXT,                     -- Jawaban pilihan (A/B) atau jawaban esai teks.
--     file_attachment VARCHAR(255),         -- URL file jika tugas berupa upload file (Proyek/Portofolio).
--     points_earned DECIMAL(5,2) DEFAULT 0, -- Nilai per nomor. Otomatis terisi (PG) atau Manual oleh Guru (Esai).
--     teacher_feedback TEXT,                -- Catatan koreksi guru per butir soal.
--     is_correct BOOLEAN DEFAULT FALSE,     -- Flag helper untuk mempermudah statistik benar/salah pada PG.
--     FOREIGN KEY (submission_id) REFERENCES assessment_submissions(id),
--     FOREIGN KEY (question_id) REFERENCES question_bank(id)
-- );



















-- NEW SCHEMA

-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2026 at 12:31 PM
-- Server version: 8.0.46-0ubuntu0.24.04.3
-- PHP Version: 8.3.6

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_school_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` int NOT NULL,
  `year_name` varchar(20) DEFAULT NULL,
  `semester` enum('Ganjil','Genap') DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `access_logs`
--

CREATE TABLE `access_logs` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int NOT NULL,
  `teacher_assignment_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `assessment_type` enum('Awal','Formatif','Sumatif') DEFAULT NULL,
  `category` enum('Pilihan Ganda','Esai','Portofolio','Proyek') NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `duration_minutes` int DEFAULT NULL,
  `status` enum('Draft','Publish') DEFAULT 'Draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assessment_items`
--

CREATE TABLE `assessment_items` (
  `id` int NOT NULL,
  `assessment_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `order_number` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assessment_submissions`
--

CREATE TABLE `assessment_submissions` (
  `id` int NOT NULL,
  `assessment_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `total_score` decimal(5,2) DEFAULT '0.00',
  `status` enum('Belum Dikerjakan','Selesai','Sudah Dinilai') DEFAULT 'Belum Dikerjakan',
  `submitted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int NOT NULL,
  `class_name` varchar(20) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plans`
--

CREATE TABLE `lesson_plans` (
  `id` int NOT NULL,
  `subject_id` int DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `academic_year_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `material_discussions`
--

CREATE TABLE `material_discussions` (
  `id` int NOT NULL,
  `material_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `material_views`
--

CREATE TABLE `material_views` (
  `id` int NOT NULL,
  `material_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `viewed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_bank`
--

CREATE TABLE `question_bank` (
  `id` int NOT NULL,
  `subject_id` int DEFAULT NULL,
  `teacher_id` int DEFAULT NULL,
  `classroom_id` int DEFAULT NULL,
  `question_text` text,
  `question_type` enum('Pilihan Ganda','Esai','Portofolio','Proyek') NOT NULL,
  `academic_year_id` int DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` int NOT NULL,
  `question_id` int DEFAULT NULL,
  `option_a` text,
  `option_b` text,
  `option_c` text,
  `option_d` text,
  `option_e` text,
  `correct_answer` enum('A','B','C','D','E') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `id` int NOT NULL,
  `submission_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `answer_text` text,
  `file_attachment` varchar(255) DEFAULT NULL,
  `points_earned` decimal(5,2) DEFAULT '0.00',
  `teacher_feedback` text,
  `is_correct` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

CREATE TABLE `student_classes` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `classroom_id` int DEFAULT NULL,
  `academic_year_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Table structure for table `teacher_assignments`
--

CREATE TABLE `teacher_assignments` (
  `id` int NOT NULL,
  `teacher_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `classroom_id` int DEFAULT NULL,
  `academic_year_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Table structure for table `teaching_materials`
--

CREATE TABLE `teaching_materials` (
  `id` int NOT NULL,
  `teacher_assignment_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `file_path` varchar(255) DEFAULT NULL,
  `status` enum('Draft','Publish') DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('SuperAdmin','Admin','Guru','Siswa') NOT NULL,
  `must_reset_password` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `role`, `must_reset_password`, `is_deleted`, `created_at`) VALUES
(1, 'adminco', '$2y$10$Hhfr.HUumb/hj8Vj/Rv0XuhoXShMekhCqbJWhPF5iiaElUF3Ygsri', 'Super Administrator', 'SuperAdmin', 1, 0, '2025-12-30 08:33:49'),
(12, 'adminbun', '$2y$10$DZC8wdnfyE12HUHywFiTVON7TOO6LlVEjrxPDPkh6gFIqIvt6FjbG', 'Bund Kasim', 'Admin', 1, 0, '2026-01-20 04:25:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_assignment_id` (`teacher_assignment_id`);

--
-- Indexes for table `assessment_items`
--
ALTER TABLE `assessment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_id` (`assessment_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `assessment_submissions`
--
ALTER TABLE `assessment_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_id` (`assessment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_plans`
--
ALTER TABLE `lesson_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `academic_year_id` (`academic_year_id`);

--
-- Indexes for table `material_discussions`
--
ALTER TABLE `material_discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `material_views`
--
ALTER TABLE `material_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `fk_question_classroom` (`classroom_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `question_id` (`question_id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submission_id` (`submission_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `academic_year_id` (`academic_year_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_assignments`
--
ALTER TABLE `teacher_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `academic_year_id` (`academic_year_id`);

--
-- Indexes for table `teaching_materials`
--
ALTER TABLE `teaching_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_assignment_id` (`teacher_assignment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessment_items`
--
ALTER TABLE `assessment_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessment_submissions`
--
ALTER TABLE `assessment_submissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lesson_plans`
--
ALTER TABLE `lesson_plans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_discussions`
--
ALTER TABLE `material_discussions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_views`
--
ALTER TABLE `material_views`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_bank`
--
ALTER TABLE `question_bank`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teacher_assignments`
--
ALTER TABLE `teacher_assignments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `teaching_materials`
--
ALTER TABLE `teaching_materials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD CONSTRAINT `access_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_ibfk_1` FOREIGN KEY (`teacher_assignment_id`) REFERENCES `teacher_assignments` (`id`);

--
-- Constraints for table `assessment_items`
--
ALTER TABLE `assessment_items`
  ADD CONSTRAINT `assessment_items_ibfk_1` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`),
  ADD CONSTRAINT `assessment_items_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question_bank` (`id`);

--
-- Constraints for table `assessment_submissions`
--
ALTER TABLE `assessment_submissions`
  ADD CONSTRAINT `assessment_submissions_ibfk_1` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`),
  ADD CONSTRAINT `assessment_submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `lesson_plans`
--
ALTER TABLE `lesson_plans`
  ADD CONSTRAINT `lesson_plans_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `lesson_plans_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lesson_plans_ibfk_3` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`);

--
-- Constraints for table `material_discussions`
--
ALTER TABLE `material_discussions`
  ADD CONSTRAINT `material_discussions_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `teaching_materials` (`id`),
  ADD CONSTRAINT `material_discussions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `material_views`
--
ALTER TABLE `material_views`
  ADD CONSTRAINT `material_views_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `teaching_materials` (`id`),
  ADD CONSTRAINT `material_views_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD CONSTRAINT `fk_question_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `question_bank_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `question_bank_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `question_bank_ibfk_3` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`);

--
-- Constraints for table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question_bank` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `student_answers_ibfk_1` FOREIGN KEY (`submission_id`) REFERENCES `assessment_submissions` (`id`),
  ADD CONSTRAINT `student_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question_bank` (`id`);

--
-- Constraints for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD CONSTRAINT `student_classes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_classes_ibfk_2` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`),
  ADD CONSTRAINT `student_classes_ibfk_3` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`);

--
-- Constraints for table `teacher_assignments`
--
ALTER TABLE `teacher_assignments`
  ADD CONSTRAINT `teacher_assignments_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teacher_assignments_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `teacher_assignments_ibfk_3` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`),
  ADD CONSTRAINT `teacher_assignments_ibfk_4` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`);

--
-- Constraints for table `teaching_materials`
--
ALTER TABLE `teaching_materials`
  ADD CONSTRAINT `teaching_materials_ibfk_1` FOREIGN KEY (`teacher_assignment_id`) REFERENCES `teacher_assignments` (`id`);
COMMIT;
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
