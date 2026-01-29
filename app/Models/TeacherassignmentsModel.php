<?php

namespace App\Models;

use App\Core\Database;
use Exception;

class TeacherassignmentsModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Mengambil semua data penugasan untuk tabel index
     */
    public function getTeacherAssignments()
    {
        $stmt = $this->db->prepare("SELECT 
                                        ta.id AS assignment_id,
                                        ta.teacher_id,
                                        ta.subject_id,
                                        ta.classroom_id,
                                        ta.academic_year_id,
                                        u.full_name AS teacher_name,
                                        s.subject_name,
                                        c.class_name,
                                        CONCAT(ay.year_name, ' (', ay.semester, ')') AS period_name,
                                        ay.is_active AS is_current_period
                                    FROM teacher_assignments ta
                                    JOIN users u ON ta.teacher_id = u.id
                                    JOIN subjects s ON ta.subject_id = s.id
                                    JOIN classrooms c ON ta.classroom_id = c.id
                                    JOIN academic_years ay ON ta.academic_year_id = ay.id
                                    WHERE 
                                        u.is_deleted = FALSE 
                                        AND u.role = 'Guru'
                                        AND s.is_deleted = FALSE
                                        AND c.is_deleted = FALSE
                                        AND ay.is_active = TRUE
                                    ORDER BY u.full_name ASC;");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getTeacherAssignmentsByAcademicyear($id = 0)
    {
        if ($id) {
            $stmt = $this->db->prepare("SELECT 
                                        ta.id AS assignment_id,
                                        ta.teacher_id,
                                        ta.subject_id,
                                        ta.classroom_id,
                                        ta.academic_year_id,
                                        u.full_name AS teacher_name,
                                        s.subject_name,
                                        c.class_name,
                                        CONCAT(ay.year_name, ' (', ay.semester, ')') AS period_name,
                                        ay.is_active AS is_current_period
                                    FROM teacher_assignments ta
                                    JOIN users u ON ta.teacher_id = u.id
                                    JOIN subjects s ON ta.subject_id = s.id
                                    JOIN classrooms c ON ta.classroom_id = c.id
                                    JOIN academic_years ay ON ta.academic_year_id = ay.id
                                    WHERE 
                                        u.is_deleted = FALSE 
                                        AND u.role = 'Guru'
                                        AND s.is_deleted = FALSE
                                        AND c.is_deleted = FALSE
                                        AND ay.id = ?
                                    ORDER BY u.full_name ASC;");
            $stmt->execute([$id]);
            return $stmt->fetchAll();
        } else {
            $this->getTeacherAssignments();
        }
    }

    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM teacher_assignments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    public function create(array $data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO teacher_assignments 
                (teacher_id, subject_id, classroom_id, academic_year_id) 
                VALUES (?, ?, ?, ?)");

            return $stmt->execute([
                $data['teacher_id'],
                $data['subject_id'],
                $data['classroom_id'],
                $data['academic_year_id']
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Update Data
     */
    public function update(int $id, array $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE teacher_assignments SET 
                teacher_id = ?, 
                subject_id = ?, 
                classroom_id = ?, 
                academic_year_id = ? 
                WHERE id = ?");

            return $stmt->execute([
                $data['teacher_id'],
                $data['subject_id'],
                $data['classroom_id'],
                $data['academic_year_id'],
                $id
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Delete Data
     * Karena tabel ini adalah pivot/relasi, disarankan menggunakan DELETE permanen.
     * Jika tetap ingin soft delete, Anda harus menambahkan kolom is_deleted di tabel tersebut.
     */
    public function delete(int $id)
    {
        try {
            // Hard Delete (Disarankan untuk tabel penugasan/relasi)
            $stmt = $this->db->prepare("DELETE FROM teacher_assignments WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Helper: Mengecek apakah guru sudah ditugaskan di mapel & kelas yang sama pada tahun ajaran tersebut
     * Mencegah duplikasi data
     */
    public function isDuplicate($teacher_id, $subject_id, $classroom_id, $academic_year_id)
    {
        $stmt = $this->db->prepare("SELECT id FROM teacher_assignments 
            WHERE teacher_id = ? AND subject_id = ? AND classroom_id = ? AND academic_year_id = ?");
        $stmt->execute([$teacher_id, $subject_id, $classroom_id, $academic_year_id]);
        return $stmt->fetch() ? true : false;
    }
}
