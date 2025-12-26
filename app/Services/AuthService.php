<?php

namespace App\Services;

use App\Models\UserModel;

class AuthService
{
    private UserModel $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // ################# CONTOH PENERAPAN ###########################
    public function login(string $user, string $pass)
    {
        $userData = $this->userModel->findByUsername($user);
        if ($userData && password_verify($pass, $userData['password'])) {
            return $userData; // Login Sukses
        }
        throw new \Exception("Username atau Password Salah");
    }
}
