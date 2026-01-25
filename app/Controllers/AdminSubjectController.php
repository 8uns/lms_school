<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\SubjectModel;
use Config\Sidebar;

class AdminSubjectController extends Controller
{
    private SubjectModel $subjectModel;

    public function __construct()
    {
        parent::__construct();
        $this->subjectModel = new SubjectModel();
    }
    public function index(): void
    {
        $data['page'] = 'Mata Pelajaran';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = $_SESSION['role'];
        $data['sidebar'] = Sidebar::get()['Admin'];
        $data['subjects'] = $this->subjectModel->getSubjects();
        $this->renderDashboard('admin/mata-pelajaran', $data);
    }

    public function createMataPelajaran(): void
    {
        if ($this->subjectModel->create($_POST)) {
            // Berhasil membuat mata pelajaran
            $this->redirect('/admin/mata-pelajaran');
        } else {
            // Gagal membuat mata pelajaran
            $this->redirect('/admin/mata-pelajaran');
        }
    }

    public function updateMataPelajaran($id): void
    {
        if ($this->subjectModel->update($id, $_POST)) {
            // Berhasil mengupdate mata pelajaran
            $this->redirect('/admin/mata-pelajaran');
        } else {
            // Gagal mengupdate mata pelajaran
            $this->redirect('/admin/mata-pelajaran');
        }
    }

    public function deleteMataPelajaran($id): void
    {
        if ($this->subjectModel->delete($id)) {
            // Berhasil menghapus mata pelajaran
            $this->redirect('/admin/mata-pelajaran');
        } else {
            // Gagal menghapus mata pelajaran
            $this->redirect('/admin/mata-pelajaran');
        }
    }
}
