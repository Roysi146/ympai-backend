<?php

namespace App\Models;

use CodeIgniter\Model;

class KaderModel extends Model
{
    protected $table            = 'kader';
    protected $primaryKey       = 'id_kader';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'id_admin',
        'nama',
        'wilayah',
        'status_aktif',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    protected $validationRules = [
        'nama'         => 'required|max_length[100]',
        'wilayah'      => 'required|max_length[100]',
        'status_aktif' => 'permit_empty|in_list[Aktif,Non-aktif]',
    ];

    public function getAktifByWilayah(): array
    {
        return $this->where('status_aktif', 'Aktif')
            ->orderBy('wilayah', 'ASC')
            ->findAll();
    }
}
