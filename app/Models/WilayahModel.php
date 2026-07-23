<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table            = 'wilayah';
    protected $primaryKey       = 'id_wilayah';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nama_wilayah',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_wilayah' => 'required|max_length[100]|is_unique[wilayah.nama_wilayah]',
    ];

    // Ambil semua wilayah terurut abjad - dipakai untuk isi dropdown di form
    public function getAllSorted(): array
    {
        return $this->orderBy('nama_wilayah', 'ASC')->findAll();
    }
}