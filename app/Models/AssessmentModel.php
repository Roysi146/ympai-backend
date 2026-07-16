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
        'wilayah',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; 

    protected $validationRules = [
        'nama'    => 'required|min_length[2]|max_length[100]',
        'gender'  => 'required|in_list[Pria,Wanita]',
        'wilayah' => 'required|max_length[100]',
    ];
}
