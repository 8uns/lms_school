<?php

namespace App\Controllers\Auth;

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

    public function index()
    {
        $this->redirect('/login');
    }

    public function login()
    {
        if (Session::get('user_id')) {
            if (Session::get('role') == 'SuperAdmin') {
                $this->redirect('/administrator/dashboard');
            } elseif (Session::get('role') == 'Admin') {
                $this->redirect('/admin/dashboard');
            } elseif (Session::get('role') == 'Guru') {
                $this->redirect('/guru/dashboard');
            } elseif (Session::get('role') == 'Siswa') {
                $this->redirect('/siswa/dashboard');
            } 
        }
        $this->view('layouts/header');
        if ($this->data['error_message'] = Session::getFlash('error_message')) {
            $this->view('layouts/banner', $this->data);
        }
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
            Session::setFlash('error_message', 'Username atau Password salah!');
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
