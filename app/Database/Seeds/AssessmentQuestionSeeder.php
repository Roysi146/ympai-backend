<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AssessmentQuestionSeeder extends Seeder
{
    public function run()
    {
        $subscales = [
            'depression' => 7,
            'anxiety'    => 7,
            'stress'     => 7,
        ];

        $urutan = 1;
        $data   = [];

        foreach ($subscales as $subscale => $jumlah) {
            for ($i = 1; $i <= $jumlah; $i++) {
                $data[] = [
                    'id_admin'  => null,
                    'subscale'  => $subscale,
                    'teks_soal' => "Pertanyaan {$subscale} {$i} (dummy - ganti dengan teks asli)",
                    'urutan'    => $urutan,
                ];
                $urutan++;
            }
        }

        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->table('assessment_question')->truncate();
        $this->db->table('assessment_question')->insertBatch($data);
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }
}