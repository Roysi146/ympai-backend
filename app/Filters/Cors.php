<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Cors implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $response = service('response');
        
        // Jika variabel tidak ditemukan di .env, fallback langsung ke domain produksi secara hardcode.
        // Ini menutup celah human error saat deployment.
        $allowedOrigin = env('CORS_ALLOWED_ORIGIN', 'https://ympai.org');
        $response->setHeader('Access-Control-Allow-Origin', $allowedOrigin);
        
        // Mengizinkan jenis header spesifik yang biasa dikirim oleh aplikasi Front-End modern
        $response->setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, Authorization');
        
        // Mengizinkan metode HTTP yang digunakan dalam sistem REST API
        $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');

        // Menangani Preflight Request (Browser mengirim method OPTIONS sebelum POST/PUT/DELETE)
        if ($request->getMethod() === 'options') {
            $response->setStatusCode(200);
            return $response;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan yang diperlukan setelah response dikirim
    }
}