<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username','password', 'name', 'address', 'level']; // Sesuaikan dengan kolom pada tabel Anda

    // Jika Anda ingin menambahkan metode untuk mendapatkan semua pengguna
    public function getUsers()
    {
        return $this->findAll();
    }
}
