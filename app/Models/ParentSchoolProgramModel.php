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
        'id_wilayah',
        'tujuan',
        'tanggal',
        'jumlah_peserta',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'id_kader'   => 'required|is_natural_no_zero',
        'id_wilayah' => 'required|is_natural_no_zero',
        'tujuan'     => 'required|max_length[255]',
        'tanggal'    => 'required|valid_date',
    ];

    // Ambil program lengkap dengan nama kader dan nama wilayah (join) - untuk tabel filterable dashboard
    public function getProgramLengkap(?int $idWilayah = null): array
    {
        $builder = $this->db->table('parent_school_program p')
            ->select('p.*, k.nama AS nama_kader, w.nama_wilayah')
            ->join('kader k', 'p.id_kader = k.id_kader')
            ->join('wilayah w', 'p.id_wilayah = w.id_wilayah')
            ->orderBy('p.tanggal', 'DESC');

        if ($idWilayah !== null) {
            $builder->where('p.id_wilayah', $idWilayah);
        }

        return $builder->get()->getResultArray();
    }
}