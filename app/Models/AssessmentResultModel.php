<?php

namespace App\Models;

use CodeIgniter\Model;

class AssessmentResultModel extends Model
{
    protected $table            = 'assessment_result';
    protected $primaryKey       = 'id_hasil';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'id_assessment',
        'skor_depression',
        'skor_anxiety',
        'skor_stress',
        'severity_depression',
        'severity_anxiety',
        'severity_stress',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    private const BANDS = [
        'depression' => [9 => 'Normal', 13 => 'Mild', 20 => 'Moderate', 27 => 'Severe'],
        'anxiety'    => [7 => 'Normal', 9 => 'Mild', 14 => 'Moderate', 19 => 'Severe'],
        'stress'     => [14 => 'Normal', 18 => 'Mild', 25 => 'Moderate', 33 => 'Severe'],
    ];

    public function getSeverity(string $subscale, int $skor): string
    {
        foreach (self::BANDS[$subscale] as $batas => $label) {
            if ($skor <= $batas) {
                return $label;
            }
        }

        return 'Extremely Severe';
    }

    public function simpanHasil(int $idAssessment, array $skor): int|string|false
    {
        $data = [
            'id_assessment'       => $idAssessment,
            'skor_depression'     => $skor['depression'],
            'skor_anxiety'        => $skor['anxiety'],
            'skor_stress'         => $skor['stress'],
            'severity_depression' => $this->getSeverity('depression', $skor['depression']),
            'severity_anxiety'    => $this->getSeverity('anxiety', $skor['anxiety']),
            'severity_stress'     => $this->getSeverity('stress', $skor['stress']),
        ];

        $existing = $this->where('id_assessment', $idAssessment)->first();
        if ($existing) {
            $this->update($existing['id_hasil'], $data);
            return $existing['id_hasil'];
        }

        return $this->insert($data);
    }
}
