<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model
{
    protected $table = "pegawai";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama', 'email'];

    protected $validationRules = [
        'nama' => 'required',
        'email' => 'required|valid_email'
    ];
    protected $validationMessages = [
        'nama' => [
            'required' => 'Silakan masukkan nama'
        ],
        'email' => [
            'required' => 'Silakan masukkan email',
            'valid_email' => 'Email yang dimasukkan tidak valid'
        ]
    ];
}
