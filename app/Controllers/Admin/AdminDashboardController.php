<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
// use App\Models\AcademicyearsModel;
// use App\Models\ClassroomModel;
// use App\Models\SubjectModel;  
// use App\Models\UserModel;
use Config\Sidebar;

class AdminDashboardController extends Controller
{
    // private UserModel $userModel;
    // private ClassroomModel $classroomModel;
    // private AcademicyearsModel $academicYearsModel;
    // private SubjectModel $subjectModel;

    public function __construct()
    {
        parent::__construct();
        // $this->userModel = new UserModel();
        // $this->academicYearsModel = new AcademicyearsModel();
        // $this->classroomModel = new ClassroomModel();
        // $this->subjectModel = new SubjectModel();
    }
    public function index(): void
    {
        $data['page'] = 'Dashboard';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = Session::get('role');
        $data['sidebar'] = Sidebar::get()[$_SESSION['role']];
        $this->renderDashboard('admin/dashboard', $data);
    }

    
}
