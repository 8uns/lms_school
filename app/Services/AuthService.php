<?php

namespace App\Services;

use App\Models\UserModel;
use App\Core\Session;

class AuthService
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login(string $username, string $password): bool
    {
        $user = $this->userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            Session::set('user_id', $user['id']);
            Session::set('username', $user['username']);
            Session::set('role', $user['role']);
            Session::set('full_name', $user['full_name']);
            return true;
        }

        return false;
    }

    public static function logout()
    {
        Session::destroy();
    }
}