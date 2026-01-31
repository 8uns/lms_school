CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL, -- ID unik login (NIS/NIP). Tidak boleh ganda.
    password VARCHAR(255) NOT NULL,        -- Hash password untuk keamanan data.
    full_name VARCHAR(100) NOT NULL,      -- Nama lengkap untuk keperluan rapor/sertifikat.
    role ENUM('SuperAdmin', 'Admin', 'Guru', 'Siswa') NOT NULL, -- Penentu hak akses sistem.
    is_deleted BOOLEAN DEFAULT FALSE,     -- Flag soft delete agar data tetap ada di arsip DB.
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Waktu pendaftaran akun.
);

CREATE TABLE access_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,                          -- Referensi user yang melakukan aktivitas.
    action VARCHAR(255),                  -- Deskripsi aksi (cth: "Login", "Hapus Soal").
    ip_address VARCHAR(45),               -- Alamat IP untuk audit keamanan akses.
    user_agent TEXT,                      -- Info browser/perangkat untuk fitur Force Logout.
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE academic_years (
    id INT PRIMARY KEY AUTO_INCREMENT,
    year_name VARCHAR(20),                -- Label tahun ajaran (cth: '2024/2025').
    semester ENUM('Ganjil', 'Genap'),     -- Pembagian periode belajar.
    is_active BOOLEAN DEFAULT TRUE        -- Penanda tahun/semester yang sedang berjalan.
		is_deleted BOOLEAN DEFAULT FALSE,     -- Flag soft delete agar data tetap ada di arsip DB.
);

CREATE TABLE subjects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    subject_name VARCHAR(100),            -- Nama mata pelajaran (cth: 'Matematika').
    is_deleted BOOLEAN DEFAULT FALSE      -- Soft delete mata pelajaran.
);

CREATE TABLE classrooms (
    id INT PRIMARY KEY AUTO_INCREMENT,
    class_name VARCHAR(20),               -- Nama rombel (cth: 'X-IPA-1', '7A').
    is_deleted BOOLEAN DEFAULT FALSE      -- Soft delete kelas.
);

CREATE TABLE teacher_assignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    teacher_id INT,                       -- Guru yang ditugaskan (FK ke users).
    subject_id INT,                       -- Mata pelajaran yang diampu.
    classroom_id INT,                     -- Kelas tempat guru tersebut mengajar.
    academic_year_id INT,                 -- Konteks waktu penugasan (berbeda tiap tahun/semester).
    FOREIGN KEY (teacher_id) REFERENCES users(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id),
    FOREIGN KEY (classroom_id) REFERENCES classrooms(id),
    FOREIGN KEY (academic_year_id) REFERENCES academic_years(id)
);

CREATE TABLE student_classes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,                       -- Siswa yang ditempatkan (FK ke users).
    classroom_id INT,                     -- Kelas tempat siswa belajar.
    academic_year_id INT,                 -- Untuk riwayat kenaikan kelas siswa dari tahun ke tahun.
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (classroom_id) REFERENCES classrooms(id),
    FOREIGN KEY (academic_year_id) REFERENCES academic_years(id)
);

CREATE TABLE lesson_plans (
    id INT PRIMARY KEY AUTO_INCREMENT,
    subject_id INT,                       -- RPP untuk mata pelajaran tertentu.
    admin_id INT,                         -- Admin kurikulum yang memvalidasi/mengunggah.
    file_path VARCHAR(255),               -- Lokasi penyimpanan file modul (PDF/Doc).
    academic_year_id INT,                 -- Versi RPP berdasarkan tahun ajaran.
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (subject_id) REFERENCES subjects(id),
    FOREIGN KEY (admin_id) REFERENCES users(id),
    FOREIGN KEY (academic_year_id) REFERENCES academic_years(id)
);

CREATE TABLE teaching_materials (
    id INT PRIMARY KEY AUTO_INCREMENT,
    teacher_assignment_id INT,            -- Mengikat materi ke jadwal mengajar guru di kelas spesifik.
    title VARCHAR(255),                   -- Judul materi (cth: 'Bab 1: Aljabar').
    content TEXT,                         -- Isi materi jika dalam bentuk teks/HTML.
    file_path VARCHAR(255),               -- Lampiran file materi (jika ada).
    status ENUM('Draft', 'Publish') DEFAULT 'Draft', -- Jika draft, materi belum tampil di sisi siswa.
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_assignment_id) REFERENCES teacher_assignments(id)
);

CREATE TABLE material_views (
    id INT PRIMARY KEY AUTO_INCREMENT,
    material_id INT,                      -- Materi yang diakses.
    student_id INT,                       -- Siswa yang membaca.
    viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Bukti kehadiran siswa dalam mempelajari materi.
    FOREIGN KEY (material_id) REFERENCES teaching_materials(id),
    FOREIGN KEY (student_id) REFERENCES users(id)
);

CREATE TABLE material_discussions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    material_id INT,                      -- Topik materi yang didiskusikan.
    user_id INT,                          -- Pengirim komentar (Bisa Guru atau Siswa).
    comment TEXT,                         -- Isi pesan diskusi.
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES teaching_materials(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE question_bank (
    id INT PRIMARY KEY AUTO_INCREMENT,
    subject_id INT,                       -- Kategorisasi soal per mata pelajaran.
    teacher_id INT,                       -- Guru pembuat soal (pemilik hak cipta soal).
    question_text TEXT,                   -- Pertanyaan (mendukung tag HTML untuk gambar/rumus).
    question_type ENUM('Pilihan Ganda', 'Esai', 'Portofolio', 'Proyek') NOT NULL, -- Menentukan UI pengerjaan siswa.
    academic_year_id INT,                 -- Penanda tahun pembuatan soal.
    is_deleted BOOLEAN DEFAULT FALSE,     -- Soft delete soal.
    FOREIGN KEY (subject_id) REFERENCES subjects(id),
    FOREIGN KEY (teacher_id) REFERENCES users(id),
    FOREIGN KEY (academic_year_id) REFERENCES academic_years(id)
);

CREATE TABLE question_options (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_id INT UNIQUE,               -- Relasi 1-to-1 dengan soal PG.
    option_a TEXT,                        -- Teks pilihan jawaban A.
    option_b TEXT,                        -- Teks pilihan jawaban B.
    option_c TEXT,                        -- Teks pilihan jawaban C.
    option_d TEXT,                        -- Teks pilihan jawaban D.
    option_e TEXT,                        -- Teks pilihan jawaban E.
    correct_answer ENUM('A', 'B', 'C', 'D', 'E'), -- Kunci jawaban untuk koreksi otomatis.
    FOREIGN KEY (question_id) REFERENCES question_bank(id) ON DELETE CASCADE -- Jika soal dihapus, opsi ikut terhapus.
);

CREATE TABLE assessments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    teacher_assignment_id INT,            -- Mengikat ujian ke kelas, guru, dan mapel tertentu.
    title VARCHAR(255),                   -- Nama asesmen (cth: 'Ulangan Harian 1').
    assessment_type ENUM('Awal', 'Formatif', 'Sumatif'), -- Jenis penilaian pendidikan.
    category ENUM('Pilihan Ganda', 'Esai', 'Portofolio', 'Proyek') NOT NULL, -- Filter agar tipe soal seragam dalam satu ujian.
    start_time DATETIME,                  -- Jadwal mulai pengerjaan dibuka.
    end_time DATETIME,                    -- Batas akhir waktu pengumpulan.
    duration_minutes INT,                 -- Lama waktu pengerjaan (Timer) dalam menit.
    status ENUM('Draft', 'Publish') DEFAULT 'Draft',
    FOREIGN KEY (teacher_assignment_id) REFERENCES teacher_assignments(id)
);

CREATE TABLE assessment_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    assessment_id INT,                    -- Relasi ke lembar ujian.
    question_id INT,                      -- ID soal yang diambil dari Bank Soal.
    order_number INT,                     -- Urutan nomor soal (bisa digunakan untuk fitur acak soal).
    FOREIGN KEY (assessment_id) REFERENCES assessments(id),
    FOREIGN KEY (question_id) REFERENCES question_bank(id)
);

CREATE TABLE assessment_submissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    assessment_id INT,                    -- Ujian yang dikerjakan.
    student_id INT,                       -- Peserta ujian.
    total_score DECIMAL(5,2) DEFAULT 0,   -- Skor akhir kumulatif (hasil sum points_earned di student_answers).
    status ENUM('Belum Dikerjakan', 'Selesai', 'Sudah Dinilai') DEFAULT 'Belum Dikerjakan',
    submitted_at TIMESTAMP NULL,          -- Waktu penekanan tombol submit oleh siswa.
    FOREIGN KEY (assessment_id) REFERENCES assessments(id),
    FOREIGN KEY (student_id) REFERENCES users(id)
);

CREATE TABLE student_answers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    submission_id INT,                    -- Merujuk ke lembar jawaban siswa.
    question_id INT,                      -- Soal yang sedang dijawab.
    answer_text TEXT,                     -- Jawaban pilihan (A/B) atau jawaban esai teks.
    file_attachment VARCHAR(255),         -- URL file jika tugas berupa upload file (Proyek/Portofolio).
    points_earned DECIMAL(5,2) DEFAULT 0, -- Nilai per nomor. Otomatis terisi (PG) atau Manual oleh Guru (Esai).
    teacher_feedback TEXT,                -- Catatan koreksi guru per butir soal.
    is_correct BOOLEAN DEFAULT FALSE,     -- Flag helper untuk mempermudah statistik benar/salah pada PG.
    FOREIGN KEY (submission_id) REFERENCES assessment_submissions(id),
    FOREIGN KEY (question_id) REFERENCES question_bank(id)
);