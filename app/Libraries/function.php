<?php

namespace App\Libraries;

use App\Models\ItemModel; 
use App\Models\UserModel;
use App\Models\SupplierModel;
use App\Models\CustomerModel;
class FunctionLib
{
    protected $itemModel;
    protected $userModel;
    protected $supplierModel;
    protected $customerModel;

    public function __construct()
    {
        // Load model menggunakan konstruktor
        $this->itemModel = new ItemModel();
        $this->customerModel = new CustomerModel();
        // Load the unit model
        $this->userModel = new UserModel(); // Sesuaikan dengan nama model yang Anda gunakan
        $this->supplierModel = new SupplierModel();

        // Load the item model
    }

    public function count_items()
    {
        // Menggunakan model untuk menghitung item
        $data = $this->itemModel->count_items();
        return $data;
    }
    public function count_suppliers()
    {
        // Menggunakan model untuk menghitung item
        $data = $this->supplierModel->count_suppliers();
        return $data;
    }
    public function count_customers()
    {
        // Menggunakan model untuk menghitung item
        $data = $this->customerModel->count_customers();
        return $data;
    }
    public function count_users()
    {
        // Menggunakan model untuk menghitung item
        $data = $this->userModel->count_users();
        return $data;
    }
}
