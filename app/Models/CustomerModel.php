<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    protected $allowedFields = ['name', 'gender', 'phone', 'address', 'created_at', 'updated_at']; // Sesuaikan dengan kolom pada tabel Anda

    // Jika Anda ingin menambahkan metode untuk mendapatkan semua pengguna
    public function getCustomers()
    {
        return $this->findAll();
    }
}
