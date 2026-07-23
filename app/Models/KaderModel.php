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
        'created_by',
        'nama',
        'id_wilayah',
        'status_aktif',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'created_by'   => 'required|is_natural_no_zero',
        'nama'         => 'required|max_length[100]',
        'id_wilayah'   => 'required|is_natural_no_zero',
        'status_aktif' => 'permit_empty|in_list[Aktif,Non-aktif]',
    ];

    // Ambil kader aktif saja, dengan nama wilayah (join) - berguna untuk dashboard peta
    public function getAktifDenganWilayah(): array
    {
        return $this->db->table('kader k')
            ->select('k.*, w.nama_wilayah')
            ->join('wilayah w', 'k.id_wilayah = w.id_wilayah')
            ->where('k.status_aktif', 'Aktif')
            ->orderBy('w.nama_wilayah', 'ASC')
            ->get()
            ->getResultArray();
    }
}