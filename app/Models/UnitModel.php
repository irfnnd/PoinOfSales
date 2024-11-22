<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table = 'units';
    protected $primaryKey = 'unit_id';
    protected $allowedFields = ['name', 'created_at', 'updated_at']; // Sesuaikan dengan kolom pada tabel Anda

    // Jika Anda ingin menambahkan metode untuk mendapatkan semua pengguna
    public function getUnits()
    {
        return $this->findAll();
    }
}
