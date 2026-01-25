<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\UserModel;
use Config\Sidebar;

class AdminGuruController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }
    public function index(): void
    {
       $data['page'] = 'Akun Guru';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = Session::get('role');
        $data['sidebar'] = Sidebar::get()['Admin'];
        $data['user'] = $this->userModel->getGuru();
        $this->renderDashboard('admin/guru', $data);
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
