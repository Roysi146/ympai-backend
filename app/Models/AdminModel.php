<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id_admin';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nama_admin',
        'username',
        'password',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    protected $validationRules = [
        'nama_admin' => 'required|max_length[100]',
        'username'   => 'required|is_unique[admin.username]|max_length[50]',
    ];

    public function insertAdmin(string $nama, string $username, string $passwordPlain): int|string|false
    {
        return $this->insert([
            'nama_admin' => $nama,
            'username'   => $username,
            'password'   => password_hash($passwordPlain, PASSWORD_DEFAULT),
        ]);
    }

    public function verifyLogin(string $username, string $passwordPlain): array|null
    {
        $admin = $this->where('username', $username)->first();

        if ($admin && password_verify($passwordPlain, $admin['password'])) {
            return $admin;
        }

        return null;
    }
}
