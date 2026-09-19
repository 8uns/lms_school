<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;

use App\Models\AcademicyearsModel;
use App\Models\TeacherassignmentsModel;
use App\Models\SubjectModel;  
use App\Models\UserModel;
use App\Models\ClassroomModel;
use App\Models\AssessmentsModel;

use Config\Sidebar;

class AdminDashboardController extends Controller
{
    private UserModel $userModel;
    private TeacherassignmentsModel $teacherAssignmentsModel;
    private AcademicyearsModel $academicYearsModel;
    private SubjectModel $subjectModel;
    private ClassroomModel $classroomModel;
    private AssessmentsModel $assessmentsModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->teacherAssignmentsModel = new TeacherassignmentsModel();
        $this->academicYearsModel = new AcademicyearsModel();
        $this->subjectModel = new SubjectModel();
        $this->classroomModel = new ClassroomModel();
        $this->assessmentsModel = new AssessmentsModel();
    }
    public function index(): void
    {
        $data['page'] = 'Dashboard';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = Session::get('role');
        $data['sidebar'] = Sidebar::get()[$_SESSION['role']];
        $data['activeYear'] = $this->academicYearsModel->getActiveAcademicYears();
        $data['totalTeachers'] = $this->userModel->countUsersByRole('Guru');
        $data['assignedTeachers'] = $this->teacherAssignmentsModel->countAssignedTeachers();
        $data['unassignedTeachers'] = $data['totalTeachers'] - $data['assignedTeachers'];
        $data['totalSubjects'] = $this->subjectModel->countSubjects();
        $data['totalClassrooms'] = $this->classroomModel->countClassrooms();
        $data['totalActiveAssessments'] = $this->assessmentsModel->countActiveAssessments();
        $data['totalStudents'] = $this->userModel->countUsersByRole('Siswa');
        $data['totalClassVII'] = $this->classroomModel->countClassroomsByGrade('VII');
        $data['totalClassVIII'] = $this->classroomModel->countClassroomsByGrade('VIII');
        $data['totalClassIX'] = $this->classroomModel->countClassroomsByGrade('IX');
        
        
        $this->renderDashboard('/admin/dashboard', $data);
    }

    
}
