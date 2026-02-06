<?php


namespace App\Models;

use App\Core\Database;
use App\Core\Session;
use Exception;

class QuestionBankModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // get data
    public function getTeacherQuestionStatsByAcademicYear($academic_year_id = null)
    {
        $stmt = $this->db->prepare("SELECT 
                                    s.subject_name,
                                    ay.year_name,
                                    ay.semester,
                                    c.class_name,
                                    -- Menghitung jumlah soal yang sesuai dengan Mapel, Kelas, dan Tahun Ajaran
                                    (SELECT COUNT(*) 
                                    FROM question_bank qb 
                                    WHERE qb.subject_id = ta.subject_id 
                                    AND qb.classroom_id = ta.classroom_id 
                                    AND qb.academic_year_id = ta.academic_year_id 
                                    AND qb.is_deleted = FALSE
                                    ) AS total_soal,
                                    -- ID untuk keperluan parameter URL/Aksi
                                    ta.subject_id,
                                    ta.classroom_id,
                                    ta.academic_year_id
                                FROM teacher_assignments ta
                                JOIN subjects s ON ta.subject_id = s.id
                                JOIN classrooms c ON ta.classroom_id = c.id
                                JOIN academic_years ay ON ta.academic_year_id = ay.id
                                WHERE ta.teacher_id = ?
                                AND ay.id = ?
                                ORDER BY s.subject_name ASC, c.class_name ASC;");
        $stmt->execute([
            Session::get('user_id'),
            $academic_year_id
        ]);
        return $stmt->fetchAll();
    }

    public function getTeacherQuestionStats()
    {
        $stmt = $this->db->prepare("SELECT 
                                    s.subject_name,
                                    ay.year_name,
                                    ay.semester,
                                    c.class_name,
                                    -- Menghitung jumlah soal yang sesuai dengan Mapel, Kelas, dan Tahun Ajaran
                                    (SELECT COUNT(*) 
                                    FROM question_bank qb 
                                    WHERE qb.subject_id = ta.subject_id 
                                    AND qb.classroom_id = ta.classroom_id 
                                    AND qb.academic_year_id = ta.academic_year_id 
                                    AND qb.is_deleted = FALSE
                                    ) AS total_soal,
                                    -- ID untuk keperluan parameter URL/Aksi
                                    ta.subject_id,
                                    ta.classroom_id,
                                    ta.academic_year_id
                                FROM teacher_assignments ta
                                JOIN subjects s ON ta.subject_id = s.id
                                JOIN classrooms c ON ta.classroom_id = c.id
                                JOIN academic_years ay ON ta.academic_year_id = ay.id
                                WHERE ta.teacher_id = ?
                                AND ay.is_active = TRUE
                                ORDER BY s.subject_name ASC, c.class_name ASC;");
        $stmt->execute([Session::get('user_id')]);
        return $stmt->fetchAll();
    }
}
