<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['name', 'created_at', 'updated_at']; // Sesuaikan dengan kolom pada tabel Anda

    // Jika Anda ingin menambahkan metode untuk mendapatkan semua pengguna
    public function getCategories()
    {
        return $this->findAll();
    }
}
