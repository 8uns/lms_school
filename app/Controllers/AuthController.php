<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function login()
    {
        $this->view('login');
    }

    public function postLogin()
    {
        $service = new AuthService();
        try {
            $user = $service->login($_POST['username'], $_POST['password']);
            $_SESSION['user'] = $user;
            header('Location: /');
        } catch (\Exception $e) {
            View::render('login', ['error' => $e->getMessage()]);
        }
    }

    public function notfound()
    {
        View::render('notfound');
    }
}
