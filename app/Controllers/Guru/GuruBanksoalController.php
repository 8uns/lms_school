<?php

namespace App\Controllers\Guru;

use App\Core\Controller;
use Config\Sidebar;
use App\Core\Session;
use App\Models\AcademicyearsModel;
use App\Services\StudentclassesService;
use App\Services\QuestionBankService;

class GuruBanksoalController extends Controller
{
    private QuestionBankService $question_bank_service;
    private AcademicyearsModel $academicYearsModel;
    private StudentclassesService $studentclassesService;


    public function __construct()
    {
        parent::__construct();
        $this->question_bank_service = new QuestionBankService;
        $this->academicYearsModel = new AcademicyearsModel();
        $this->studentclassesService = new StudentclassesService();

    }
    public function index($academic_year_id = NULL): void
    {
        $data['page'] = 'Bank Soal';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = Session::get('role');
        $data['sidebar'] = Sidebar::get()[$_SESSION['role']];

        $data['academic_years'] = $this->academicYearsModel->getAcademicYears();
        $data['academic_year_id'] = $this->studentclassesService->getAcademicyearId($academic_year_id);

        $data['classsubject'] = $this->question_bank_service->getTeacherQuestionStats($academic_year_id);

        $this->renderDashboard('/guru/bank-soal', $data);
    }

    public function getQuestionByClassAcademicYear($classroom_id, $academic_year_id)
    {
        $data['page'] = 'Bank Soal';
        $data['subpage'] = 'Soal';
        $data['full_name'] = Session::get('full_name');
        $data['role'] = Session::get('role');
        $data['sidebar'] = Sidebar::get()[$_SESSION['role']];
        // $data['classsubject'] = $this->question_bank_service->getCalassAndSubject();

        $this->renderDashboard('/guru/bank-soal-by-class-academicyear', $data);
    }
}
