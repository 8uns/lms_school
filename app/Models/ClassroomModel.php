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

    // get data
    public function getClass()
    {
        $stmt = $this->db->prepare("SELECT * FROM classrooms WHERE is_deleted = FALSE");
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
            $stmt = $this->db->prepare("UPDATE classrooms SET is_deleted = TRUE WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            return false;
        }
    }
}
