<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    public function login()
    {
        if (Session::get('user_id')) {
            $this->redirect('/');
        }
        $this->view('layouts/header');
        $this->view('auth/login');
        $this->view('layouts/footer');
    }

    public function postLogin()
    {
        $username = $this->request->post('username');
        $password = $this->request->post('password');

        if ($this->authService->login($username, $password)) {
            // Ambil role yang baru disimpan di session oleh AuthService
            $role = Session::get('role');

            // Lakukan redirect sesuai role
            switch ($role) {
                case 'SuperAdmin':
                    $this->redirect('/administrator/dashboard'); // Sesuaikan rute Anda
                    break;
                case 'Admin':
                    $this->redirect('/admin/dashboard'); // Sesuaikan rute Anda
                    break;
                case 'Guru':
                    $this->redirect('/guru/dashboard');
                    break;
                case 'Siswa':
                    $this->redirect('/siswa/dashboard');
                    break;
                default:
                    $this->redirect('/');
            }
        } else {
            Session::setFlash('errorlogin', 'Username atau Password salah!');
            $this->redirect('/login');
        }
    }

    public function logout()
    {
        AuthService::logout();
        $this->redirect('/login');
    }

    public function notfound()
    {
        $this->view('notfound');
    }
}
