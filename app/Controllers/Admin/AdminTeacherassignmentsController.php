<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Models\TeacherassignmentsModel;
use Config\Sidebar;

class AdminTeacherassignmentsController extends Controller
{
    private TeacherassignmentsModel $teacherassignments;

    public function __construct()
    {
        parent::__construct();
        $this->teacherassignments = new TeacherassignmentsModel();
    }
    public function index(): void
    {
        $data['page'] = 'Penugasan Guru';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = $_SESSION['role'];
        $data['sidebar'] = Sidebar::get()[$_SESSION['role']];
        $data['subjects'] = $this->teacherassignments->getTeacherAssignments();
        $this->renderDashboard('admin/penugasan-guru', $data);
    }

    public function createPenugasanGuru(): void
    {
        if ($this->teacherassignments->create($_POST)) {
            // Berhasil membuat penugasan guru
            $this->redirect('/admin/penugasan-guru');
        } else {
            // Gagal membuat penugasan guru
            $this->redirect('/admin/penugasan-guru');
        }
    }

    public function updatePenugasanGuru($id): void
    {
        if ($this->teacherassignments->update($id, $_POST)) {
            // Berhasil mengupdate penugasan guru
            $this->redirect('/admin/penugasan-guru');
        } else {
            // Gagal mengupdate penugasan guru
            $this->redirect('/admin/penugasan-guru');
        }
    }

    public function deletePenugasanGuru($id): void
    {
        if ($this->teacherassignments->delete($id)) {
            // Berhasil menghapus penugasan guru
            $this->redirect('/admin/penugasan-guru');
        } else {
            // Gagal menghapus penugasan guru
            $this->redirect('/admin/penugasan-guru');
        }
    }
}

