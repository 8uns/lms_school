<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;
use Config\Sidebar;

class SuperAdminDashboardController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }
    public function index(): void
    {
        $data['page'] = 'Dashboard';
        $data['subpage'] = false;
        $data['full_name'] = $_SESSION['full_name'];
        $data['role'] = $_SESSION['role'];
        $data['sidebar'] = Sidebar::get()['SuperAdmin'];
        $this->view('layouts/header');
        $this->view('layouts/sidebar', $data);
        $this->view('layouts/navbar', $data);
        $this->view('layouts/dashboard');
        $this->view('layouts/footer');
    }

    public function userAdmin(): void
    {
        $data['page'] = 'User';
        $data['subpage'] = 'Admin';
        $data['full_name'] = $_SESSION['full_name'];
        $data['role'] = $_SESSION['role'];
        $data['sidebar'] = Sidebar::get()['SuperAdmin'];
        $data['user'] = $this->userModel->getUserAdmin();
        $this->view('layouts/header');
        $this->view('layouts/sidebar', $data);
        $this->view('layouts/navbar', $data);
        $this->view('superadmin/user-admin', $data);
        $this->view('layouts/footer');
    }

    public function createAdmin(): void
    {
        if ($this->userModel->create($_POST)) {
            // Berhasil membuat admin
            $this->redirect('/administrator/user/admin');
        } else {
            // Gagal membuat admin
            $this->redirect('/administrator/user/admin');
        }
    }

    
}
