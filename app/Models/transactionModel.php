<?php

namespace App\Models;

use CodeIgniter\Model;

// In TransactionModel.php
class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $allowedFields = [
        'transaction_id', 'customer_id', 'transaction_date', 'sub_total', 'discount', 'grand_total', 'payment_method', 'status'
    ];

    // Function to insert a new transaction
    public function insertTransaction($data)
    {
        $this->insert($data);  // Insert transaction data
        return $this->insertID();  // Return the last inserted transaction ID
    }

    // Function to insert transaction items
    public function insertTransactionItem($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transaction_items');  // Insert into transaction_items table
        return $builder->insert($data);  // Insert each item data
    }
}
