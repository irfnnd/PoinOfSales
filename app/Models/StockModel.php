<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'stock_id';
    protected $allowedFields = ['stock_id', 'item_id', 'type', 'detail', 'supplier_id', 'qty', 'date', 'created_at', 'user_id']; // Sesuaikan dengan kolom pada tabel Anda

    public function get($id = null)
    {
        if ($id === null) {
            return $this->findAll(); // Mengembalikan semua data jika $id tidak diberikan
        } else {
            return $this->find($id); // Mengembalikan satu baris data berdasarkan ID
        }
    }

    // Jika Anda ingin menambahkan metode untuk mendapatkan semua pengguna
    public function getStocksIn()
    {
        return $this->select('stocks.*, items.name as item_name, suppliers.name as supplier_name, items.barcode as barcode, users.name as user_name')
            ->join('items', 'items.item_id = stocks.item_id')
            ->join('suppliers', 'suppliers.supplier_id = stocks.supplier_id', 'left')
            ->join('users', 'users.user_id = stocks.user_id')
            ->where('stocks.type', 'In') // Add this line to filter by "In" type
            ->orderBy('stock_id', 'DESC')
            ->findAll();
    }
    public function getStocksOut()
    {
        return $this->select('stocks.*, items.name as item_name, suppliers.name as supplier_name, items.barcode as barcode, users.name as user_name')
            ->join('items', 'items.item_id = stocks.item_id')
            ->join('suppliers', 'suppliers.supplier_id = stocks.supplier_id', 'left')
            ->join('users', 'users.user_id = stocks.user_id')
            ->where('stocks.type', 'Out') // Add this line to filter by "In" type
            ->orderBy('stock_id', 'DESC')
            ->findAll();
    }

}
