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

    // get data
    public function findByUsername(string $username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND is_deleted = FALSE");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ? AND is_deleted = FALSE");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
     public function getUserAdmin()
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE is_deleted = FALSE AND role IN('SuperAdmin', 'Admin') LIMIT 0,10");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getGuru()
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE is_deleted = FALSE AND role = 'Guru' LIMIT 0,10");
        $stmt->execute();
        return $stmt->fetchAll();
    }



    // create data
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

    public function createGuru(array $data)
    {
        $data['role'] = 'Guru';
        return $this->create($data);
    }

    // update data
    public function update(int $id, array $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE users SET username = ?, full_name = ?, role = ? WHERE id = ?");
            return $stmt->execute([
                $data['username'],
                $data['full_name'],
                $data['role'],
                $id
            ]);
        } catch (Exception $e) {
            return false;
        }
    }
    public function updateGuru(int $id, array $data)
    {
        $data['role'] = 'Guru';
        return $this->update($id, $data);
    }
    public function updatePassword(int $id, string $newPassword)
    {
        try {
            $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
            return $stmt->execute([
                password_hash($newPassword, PASSWORD_DEFAULT),
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
            $stmt = $this->db->prepare("UPDATE users SET is_deleted = TRUE WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            return false;
        }
    }
    
}