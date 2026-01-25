<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\UserModel;
use Config\Sidebar;

class AdminSiswaController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }
    public function index(): void
    {
        $data['page'] = 'Akun Siswa';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = $_SESSION['role'];
        $data['sidebar'] = Sidebar::get()['Admin'];
        $data['user'] = $this->userModel->getSiswa();
        $this->renderDashboard('admin/siswa', $data);
    }

    public function createSiswa(): void
    {
        if ($this->userModel->createSiswa($_POST)) {
            // Berhasil membuat siswa
            $this->redirect('/admin/siswa');
        } else {
            // Gagal membuat siswa
            $this->redirect('/admin/siswa');
        }
    }

    public function updateSiswa($id): void
    {
        if ($this->userModel->updateSiswa($id, $_POST)) {
            // Berhasil mengupdate siswa
            $this->redirect('/admin/siswa');
        } else {
            // Gagal mengupdate siswa
            $this->redirect('/admin/siswa');
        }
    }

    public function deleteSiswa($id): void
    {
        if ($this->userModel->delete($id)) {
            // Berhasil menghapus siswa
            $this->redirect('/admin/siswa');
        } else {
            // Gagal menghapus siswa
            $this->redirect('/admin/siswa');
        }
    }
}
