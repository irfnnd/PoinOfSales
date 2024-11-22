<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'Suppliers';
    protected $primaryKey = 'supplier_id';
    protected $allowedFields = ['name', 'phone', 'address', 'description', 'created_at', 'updated_at']; // Sesuaikan dengan kolom pada tabel Anda

    // Jika Anda ingin menambahkan metode untuk mendapatkan semua pengguna
    public function getSuppliers()
    {
        return $this->findAll();
    }
}
