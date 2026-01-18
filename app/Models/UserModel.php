<?php


namespace App\Models;

use App\Core\Database;
use Exception;

class UserModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByUsername(string $username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND is_deleted = FALSE");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function create(array $data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, ?)");
            return $stmt->execute([
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['full_name'],
                $data['role']
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getUserAdmin()
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE role IN('SuperAdmin', 'Admin') LIMIT 0,10");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
