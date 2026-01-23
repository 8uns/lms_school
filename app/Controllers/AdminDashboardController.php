<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;
use Config\Sidebar;

class AdminDashboardController extends Controller
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
        $data['sidebar'] = Sidebar::get()['Admin'];
        $this->view('layouts/header');
        $this->view('layouts/sidebar', $data);
        $this->view('layouts/navbar', $data);
        // $this->view('layouts/dashboard');
        $this->view('layouts/footer');
    }

    public function guru(): void
    {
        $data['page'] = 'Akun Guru';
        $data['subpage'] = false;
        $data['full_name'] = $_SESSION['full_name'];
        $data['role'] = $_SESSION['role'];
        $data['sidebar'] = Sidebar::get()['Admin'];
        $data['user'] = $this->userModel->getGuru();
        $this->view('layouts/header');
        $this->view('layouts/sidebar', $data);
        $this->view('layouts/navbar', $data);
        $this->view('admin/guru', $data);
        $this->view('layouts/footer');
    }

    public function createGuru(): void
    {
        if ($this->userModel->createGuru($_POST)) {
            // Berhasil membuat admin
            $this->redirect('/admin/guru');
        } else {
            // Gagal membuat admin
            $this->redirect('/admin/guru');
        }
    }

    public function updateGuru($id): void
    {
        if ($this->userModel->updateGuru($id, $_POST)) {
            // Berhasil mengupdate guru
            $this->redirect('/admin/guru');
        } else {
            // Gagal mengupdate guru
            $this->redirect('/admin/guru');
        }
    }

    public function deleteGuru($id): void
    {
        if ($this->userModel->delete($id)) {
            // Berhasil menghapus guru
            $this->redirect('/admin/guru');
        } else {
            // Gagal menghapus guru
            $this->redirect('/admin/guru');
        }
    }
}
