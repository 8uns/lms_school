<?php


namespace App\Models;

use App\Core\Database;
use Exception;

class AcademicyearsModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // get data
    public function getAcademicYears()
    {
        $stmt = $this->db->prepare("SELECT * FROM academic_years WHERE is_deleted = 0 ORDER BY is_active DESC, id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM academic_years WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    // create data
    public function create(array $data)
    {
        try {
            // Mulai transaksi
            $this->db->beginTransaction();

            // 1. Set semua data lama menjadi is_active = 0
            $this->db->prepare("UPDATE academic_years SET is_active = 0")->execute();

            // 2. Masukkan data baru dengan is_active = 1
            $stmt = $this->db->prepare("INSERT INTO academic_years (year_name, semester, is_active) VALUES (?, ?, 1)");
            $stmt->execute([
                $data['year_name'],
                $data['semester']
            ]);

            // Jika sampai sini tidak ada error, simpan perubahan permanen
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // Jika ada error di salah satu query, batalkan semua perubahan
            $this->db->rollBack();
            return false;
        }
    }


    // update data
    public function update(int $id, array $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE academic_years SET year_name = ?, semester = ? WHERE id = ?");
            return $stmt->execute([
                $data['year_name'],
                $data['semester'],
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
            $this->db->beginTransaction();
            $this->db->prepare("UPDATE academic_years SET is_deleted = 1, is_active = 0 WHERE id = ? AND is_active = 1")
                ->execute([$id]);
            $sql = "UPDATE academic_years SET is_active = 1 WHERE id = (
                    SELECT id FROM (
                        SELECT id FROM academic_years WHERE is_deleted = 0 AND is_active = 0 ORDER BY id DESC LIMIT 1
                    ) AS t
                )";
            $this->db->prepare($sql)->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
