<?php

namespace App\Services;

use App\Models\QuestionBankModel;

class QuestionBankService
{
    private QuestionBankModel $question_bank_model;

    public function __construct()
    {
        $this->question_bank_model = new QuestionBankModel();
    }

    public function getTeacherQuestionStats($academic_year_id = null)
    {

        if (!is_null($academic_year_id)) {
            return $this->question_bank_model->getTeacherQuestionStatsByAcademicYear($academic_year_id);
        } else {
            return $this->question_bank_model->getTeacherQuestionStats();
        }
    }
}
