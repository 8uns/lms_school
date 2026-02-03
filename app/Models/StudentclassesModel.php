<?php

namespace App\Models;

use App\Core\Database;

class StudentclassesModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getClasgetStudentCountPerClasss($academic_year_id = NULL)
    {
        $stmt = $this->db->prepare("SELECT 
                                        cr.id classroom_id, 
                                        cr.class_name, 
                                        COUNT(sc.student_id) AS total_students 
                                    FROM classrooms cr
                                    LEFT JOIN student_classes sc ON cr.id = sc.classroom_id
                                    LEFT JOIN academic_years ay ON sc.academic_year_id = ay.id
                                    WHERE ay.id IS NULL OR ay.id = ?
                                    GROUP BY cr.id, cr.class_name;");
        $stmt->execute([$academic_year_id]);
        return $stmt->fetchAll();
    }

    public function getStudentInClassroom($classroom_id, $academic_year_id)
    {
        $stmt = $this->db->prepare("SELECT
                                        sc.id student_classe_id,
                                        sc.student_id student_id,
                                        u.username nisn,
                                        u.full_name full_name
                                    FROM student_classes sc 
                                    JOIN classrooms cs ON sc.classroom_id=cs.id 
                                    JOIN users u ON sc.student_id=u.id 
                                    JOIN academic_years ay ON sc.academic_year_id=ay.id
                                    WHERE cs.id=? AND ay.id=?");
        $stmt->execute([$classroom_id, $academic_year_id]);
        return $stmt->fetchAll();
    }
    public function getStudentDontHaveClassroom()
    {
        $stmt = $this->db->prepare("SELECT 
                                        DISTINCT u.id student_id, 
                                        u.username nisn, 
                                        u.full_name full_name, 
                                        sc.id 
                                        FROM users u 
                                        LEFT JOIN student_classes sc ON u.id=sc.student_id 
                                        WHERE sc.id IS NULL AND u.role='Siswa';");
        $stmt->execute([]);
        return $stmt->fetchAll();
    }

    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM student_classes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    // public function create(array $data)
    // {
    //     try {
    //         if ($this->isDuplicate($data)) {
    //             return false;
    //         }
    //         $stmt = $this->db->prepare("INSERT INTO student_classes 
    //             (teacher_id, student_id, classroom_id, academic_year_id) 
    //             VALUES (?, ?, ?, ?)");

    //         return $stmt->execute([
    //             $data['teacher_id'],
    //             $data['student_id'],
    //             $data['classroom_id'],
    //             $data['academic_year_id']
    //         ]);
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }


    // public function update(int $id, array $data)
    // {
    //     try {
    //         $stmt = $this->db->prepare("UPDATE student_classes SET 
    //             teacher_id = ?, 
    //             student_id = ?, 
    //             classroom_id = ?, 
    //             academic_year_id = ? 
    //             WHERE id = ?");

    //         return $stmt->execute([
    //             $data['teacher_id'],
    //             $data['student_id'],
    //             $data['classroom_id'],
    //             $data['academic_year_id'],
    //             $id
    //         ]);
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }

    // public function delete(int $id)
    // {
    //     try {
    //         $stmt = $this->db->prepare("DELETE FROM student_classes WHERE id = ?");
    //         return $stmt->execute([$id]);
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }

    // /**
    //  * Helper: Mengecek apakah guru sudah ditugaskan di mapel & kelas yang sama pada tahun ajaran tersebut
    //  * Mencegah duplikasi data
    //  */
    // public function isDuplicate($data)
    // {
    //     $stmt = $this->db->prepare("SELECT id FROM student_classes 
    //         WHERE teacher_id = ? AND student_id = ? AND classroom_id = ? AND academic_year_id = ?");
    //     $stmt->execute([$data['teacher_id'], $data['student_id'], $data['classroom_id'], $data['academic_year_id']]);
    //     return $stmt->fetch() ? true : false;
    // }
}
