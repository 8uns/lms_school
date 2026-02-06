<?php

namespace App\Services;

use App\Models\AcademicyearsModel;
use App\Models\StudentclassesModel;

class StudentclassesService
{
    private AcademicyearsModel $academicYearsModel;
    private StudentclassesModel $studentclassesModel;

    public function __construct()
    {
        $this->academicYearsModel = new AcademicyearsModel();
        $this->studentclassesModel = new StudentclassesModel();
    }

    public function getAcademicyearId($academic_year_id = NULL)
    {

        if (is_null($academic_year_id)) {
            return $this->academicYearsModel->getActiveAcademicYears()['id'];
        }
        return $academic_year_id;
    }

    public function getStudentCountPerClasss($academic_year_id = null)
    {

        if (is_null($academic_year_id)) {
            return $this->studentclassesModel->getStudentCountPerClasssYearActive();
        }
        return $this->studentclassesModel->getStudentCountPerClasssYearId($academic_year_id);
    }

    public function create($data)
    {
        if (!empty($data['student_id'])) {
            foreach ($data['student_id'] as $id) {
                $payload = [
                    'student_id'       => $id,
                    'classroom_id'     => $data['classroom_id'],
                    'academic_year_id' => $data['academic_year_id']
                ];
                $this->studentclassesModel->create($payload);
            }
        }
    }
}
