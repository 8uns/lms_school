<?php

namespace App\Models;

use App\Core\Database;
use Exception;

class AssessmentsModel
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // count
    public function countActiveAssessments(): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM assessments WHERE status = 'Publish'");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int)$result['total'];
    }
}