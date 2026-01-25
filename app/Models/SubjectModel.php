<?php


namespace App\Models;

use App\Core\Database;
use Exception;

class SubjectModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // get data
    public function getSubjects()
    {
        $stmt = $this->db->prepare("SELECT * FROM subjects WHERE is_deleted = 0 ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM subjects WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // create data
    public function create(array $data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO subjects (subject_name) VALUES (?)");
            return $stmt->execute([
                $data['subject_name']
            ]);
        } catch (Exception $e) {
            return false;
        }
    }


    // update data
    public function update(int $id, array $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE subjects SET subject_name = ? WHERE id = ?");
            return $stmt->execute([
                $data['subject_name'],
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
            $stmt = $this->db->prepare("UPDATE subjects SET is_deleted = TRUE WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            return false;
        }
    }
}
