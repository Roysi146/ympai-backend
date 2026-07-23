<?php

namespace App\Models;

use CodeIgniter\Model;

class AssessmentModel extends Model
{
    protected $table            = 'assessment';
    protected $primaryKey       = 'id_assessment';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nama',
        'usia',
        'gender',
        'pekerjaan',
        'id_wilayah',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama'       => 'required|min_length[2]|max_length[100]',
        'usia'       => 'required|is_natural|less_than_equal_to[120]',
        'gender'     => 'required|in_list[Pria,Wanita]',
        'id_wilayah' => 'required|is_natural_no_zero',
    ];
}