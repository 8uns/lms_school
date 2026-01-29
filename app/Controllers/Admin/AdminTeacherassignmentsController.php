<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Models\TeacherassignmentsModel;
use App\Models\ClassroomModel;
use App\Models\AcademicyearsModel;
use App\Models\SubjectModel;
use App\Models\UserModel;
use Config\Sidebar;

class AdminTeacherassignmentsController extends Controller
{
    private TeacherassignmentsModel $teacherassignmentsModel;
    private ClassroomModel $classroomModel;
    private AcademicyearsModel $academicYearsModel;
    private SubjectModel $subjectModel;
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->teacherassignmentsModel = new TeacherassignmentsModel();
        $this->classroomModel = new ClassroomModel();
        $this->academicYearsModel = new AcademicyearsModel();
        $this->subjectModel = new SubjectModel();
        $this->userModel = new UserModel();
    }
    public function index($academic_year_id = 0): void
    {
        $data['page'] = 'Penugasan Guru';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = $_SESSION['role'];
        $data['sidebar'] = Sidebar::get()[$_SESSION['role']];
        $data['teacher_assignments'] = $this->teacherassignmentsModel->getTeacherAssignmentsByAcademicyear($academic_year_id);
        $data['classrooms'] = $this->classroomModel->getClass();
        $data['academicyears'] = $this->academicYearsModel->getAcademicYears();
        $data['subject'] = $this->subjectModel->getSubjects();
        $data['guru'] = $this->userModel->getGuru();

        $this->renderDashboard('admin/penugasan-guru', $data);
    }

    public function createPenugasanGuru(): void
    {
        if ($this->teacherassignmentsModel->create($_POST)) {
            // Berhasil membuat penugasan guru
            $this->redirect('/admin/penugasan-guru');
        } else {
            // Gagal membuat penugasan guru
            $this->redirect('/admin/penugasan-guru');
        }
    }

    public function updatePenugasanGuru($id): void
    {
        if ($this->teacherassignmentsModel->update($id, $_POST)) {
            // Berhasil mengupdate penugasan guru
            $this->redirect('/admin/penugasan-guru');
        } else {
            // Gagal mengupdate penugasan guru
            $this->redirect('/admin/penugasan-guru');
        }
    }

    public function deletePenugasanGuru($id): void
    {
        if ($this->teacherassignmentsModel->delete($id)) {
            // Berhasil menghapus penugasan guru
            $this->redirect('/admin/penugasan-guru');
        } else {
            // Gagal menghapus penugasan guru
            $this->redirect('/admin/penugasan-guru');
        }
    }
}
