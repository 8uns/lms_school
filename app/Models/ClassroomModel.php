<?php


namespace App\Models;

use App\Core\Database;
use Exception;

class ClassroomModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // count
    public function countClassrooms(): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM classrooms WHERE is_deleted = 0");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int)$result['total'];
    }
    public function countClassroomsByGrade(string $grade): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(DISTINCT sc.student_id) as total 
     FROM student_classes sc 
     JOIN classrooms c ON sc.classroom_id = c.id
     JOIN academic_years ay ON sc.academic_year_id=ay.id
     WHERE ay.is_active=1 AND ay.is_deleted=0 AND c.class_name LIKE ? AND c.is_deleted = 0");
        $stmt->execute([$grade . '%']);
        $result = $stmt->fetch();
        return (int)$result['total'];
    }

    // get data
    public function getClass()
    {
        $stmt = $this->db->prepare("SELECT * FROM classrooms WHERE is_deleted = FALSE ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM classrooms WHERE id = ? AND is_deleted = FALSE");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // create data
    public function create(array $data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO classrooms (class_name) VALUES (?)");
            return $stmt->execute([
                $data['class_name']
            ]);
        } catch (Exception $e) {
            return false;
        }
    }


    // update data
    public function update(int $id, array $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE classrooms SET class_name = ? WHERE id = ?");
            return $stmt->execute([
                $data['class_name'],
                $id
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    // delete data
    public function delete(int $id)
    {
        try {
            $stmt = $this->db->prepare("UPDATE classrooms SET is_deleted = TRUE, is_active = FALSE WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            return false;
        }
    }
}
