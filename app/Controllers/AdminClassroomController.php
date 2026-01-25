<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\ClassroomModel;
use Config\Sidebar;

class AdminClassroomController extends Controller
{
    private ClassroomModel $classroomModel;
    

    public function __construct()
    {
        parent::__construct();
        $this->classroomModel = new ClassroomModel();
    }
    public function index(): void
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
