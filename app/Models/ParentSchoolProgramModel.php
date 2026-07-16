<?php

namespace App\Models;

use CodeIgniter\Model;

class ParentSchoolProgramModel extends Model
{
    protected $table            = 'parent_school_program';
    protected $primaryKey       = 'id_program';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'id_kader',
        'tujuan',
        'tanggal',
        'jumlah_peserta',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    protected $validationRules = [
        'id_kader' => 'required|is_natural_no_zero',
        'tujuan'   => 'required|max_length[255]',
        'tanggal'  => 'required|valid_date',
    ];

    public function getProgramDenganKader(?string $wilayah = null): array
    {
        $builder = $this->db->table('parent_school_program p')
            ->select('p.*, k.nama AS nama_kader, k.wilayah')
            ->join('kader k', 'p.id_kader = k.id_kader')
            ->orderBy('p.tanggal', 'DESC');

        if ($wilayah !== null) {
            $builder->where('k.wilayah', $wilayah);
        }

        return $builder->get()->getResultArray();
    }
}
