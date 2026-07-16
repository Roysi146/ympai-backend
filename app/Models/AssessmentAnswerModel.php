<?php

namespace App\Models;

use CodeIgniter\Model;

class AssessmentAnswerModel extends Model
{
    protected $table            = 'assessment_answer';
    protected $primaryKey       = 'id_jawaban';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'id_assessment',
        'id_soal',
        'nilai_jawaban',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_assessment' => 'required|is_natural_no_zero',
        'id_soal'       => 'required|is_natural_no_zero',
        'nilai_jawaban' => 'required|in_list[0,1,2,3]',
    ];

    
    public function getSkorPerSubscale(int $idAssessment): array
    {
        $rows = $this->db->table('assessment_answer a')
            ->select('q.subscale, SUM(a.nilai_jawaban) * 2 AS skor')
            ->join('assessment_question q', 'a.id_soal = q.id_soal')
            ->where('a.id_assessment', $idAssessment)
            ->groupBy('q.subscale')
            ->get()
            ->getResultArray();

        $skor = ['depression' => 0, 'anxiety' => 0, 'stress' => 0];
        foreach ($rows as $row) {
            $skor[$row['subscale']] = (int) $row['skor'];
        }

        return $skor;
    }
}
