<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\ClassroomModel;
use App\Models\UserModel;
use Config\Sidebar;

class AdminDashboardController extends Controller
{
    private UserModel $userModel;
    private ClassroomModel $classroomModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->classroomModel = new ClassroomModel();
    }
    public function index(): void
    {
        $data['page'] = 'Dashboard';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = Session::get('role');
        $data['sidebar'] = Sidebar::get()['Admin'];
        $this->renderDashboard('admin/dashboard', $data);
    }

    // guru management
    public function guru(): void
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

    // siswa management
    public function siswa(): void
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

    // kelas management
    public function kelas(): void
    {
        $data['page'] = 'Kelas';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = $_SESSION['role'];
        $data['sidebar'] = Sidebar::get()['Admin'];
        $data['kelas'] = $this->classroomModel->getClass();
        $this->renderDashboard('admin/kelas', $data);
    }

    public function createKelas(): void
    {
        if ($this->classroomModel->create($_POST)) {
            // Berhasil membuat kelas
            $this->redirect('/admin/kelas');
        } else {
            // Gagal membuat kelas
            $this->redirect('/admin/kelas');
        }
    }

    public function updateKelas($id): void
    {
        if ($this->classroomModel->update($id, $_POST)) {
            // Berhasil mengupdate kelas
            $this->redirect('/admin/kelas');
        } else {
            // Gagal mengupdate kelas
            $this->redirect('/admin/kelas');
        }
    }

    public function deleteKelas($id): void
    {
        if ($this->classroomModel->delete($id)) {
            // Berhasil menghapus kelas
            $this->redirect('/admin/kelas');
        } else {
            // Gagal menghapus kelas
            $this->redirect('/admin/kelas');
        }
    }
}
