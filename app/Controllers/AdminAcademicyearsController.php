<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\AcademicyearsModel;
use Config\Sidebar;

class AdminAcademicyearsController extends Controller
{
    private AcademicyearsModel $academicYearsModel;
    

    public function __construct()
    {
        parent::__construct();
        $this->academicYearsModel = new AcademicyearsModel();
    }
    public function index(): void
    {
         $data['page'] = 'Tahun Ajaran';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = $_SESSION['role'];
        $data['sidebar'] = Sidebar::get()['Admin'];
        $data['academic_years'] = $this->academicYearsModel->getAcademicYears();
        $this->renderDashboard('admin/tahun-ajaran', $data);
    
    }

    public function createTahunAjaran(): void
    {
        if ($this->academicYearsModel->create($_POST)) {
            // Berhasil membuat tahun ajaran
            $this->redirect('/admin/tahun-ajaran');
        } else {
            // Gagal membuat tahun ajaran
            $this->redirect('/admin/tahun-ajaran');
        }
    }

    public function updateTahunAjaran($id): void
    {
        if ($this->academicYearsModel->update($id, $_POST)) {
            // Berhasil mengupdate tahun ajaran
            $this->redirect('/admin/tahun-ajaran');
        } else {
            // Gagal mengupdate tahun ajaran
            $this->redirect('/admin/tahun-ajaran');
        }
    }

    public function deleteTahunAjaran($id): void
    {
        if ($this->academicYearsModel->delete($id)) {
            // Berhasil menghapus tahun ajaran
            $this->redirect('/admin/tahun-ajaran');
        } else {
            // Gagal menghapus tahun ajaran
            $this->redirect('/admin/tahun-ajaran');
        }
    }
}
