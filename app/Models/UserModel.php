<?php

namespace App\Models;

use App\Core\Database;

class UserModel
{
    // ################# CONTOH PENERAPAN ###########################

    public function findByUsername(string $username)
    {
        $stmt = Database::getConnection()->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}
