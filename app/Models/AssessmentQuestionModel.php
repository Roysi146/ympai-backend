<?php

namespace App\Models;

use CodeIgniter\Model;

class AssessmentQuestionModel extends Model
{
    protected $table            = 'assessment_question';
    protected $primaryKey       = 'id_soal';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'id_admin',
        'subscale',
        'teks_soal',
        'urutan',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'subscale'  => 'required|in_list[depression,anxiety,stress]',
        'teks_soal' => 'required',
        'urutan'    => 'required|is_natural_no_zero',
    ];

    public function getAllOrdered(): array
    {
        return $this->orderBy('urutan', 'ASC')->findAll();
    }
}
