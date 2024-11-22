<?php
use App\Models\ItemModel;
use App\Models\UserModel;
use App\Models\SupplierModel;
use App\Models\CustomerModel;
if (!function_exists('count_items')) {
    function count_items()
    {
        // Inisialisasi model
        $itemModel = new ItemModel();

        // Hitung jumlah item
        $count = $itemModel->countAll();

        // Kembalikan hasil
        return $count;
    }
}
if (!function_exists('count_users')) {
    function count_users()
    {
        // Inisialisasi model
        $userModel = new UserModel();

        // Hitung jumlah item
        $count = $userModel->countAll();

        // Kembalikan hasil
        return $count;
    }
}
if (!function_exists('count_suppliers')) {
    function count_suppliers()
    {
        // Inisialisasi model
        $supplierModel = new SupplierModel();

        // Hitung jumlah item
        $count = $supplierModel->countAll();

        // Kembalikan hasil
        return $count;
    }
}
if (!function_exists('count_customers')) {
    function count_customers()
    {
        // Inisialisasi model
        $customerModel = new CustomerModel();

        // Hitung jumlah item
        $count = $customerModel->countAll();

        // Kembalikan hasil
        return $count;
    }
}
if (!function_exists('rupiah')) {
    function rupiah($angka) {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

function indo_date($date) {
    $d = substr($date, 8, 2);
    $m = substr($date, 5, 2);
    $y = substr($date, 0, 4);

    // Daftar nama bulan dalam bahasa Indonesia
    $months = [
        '01' => 'Jan',
        '02' => 'Feb',
        '03' => 'Mar',
        '04' => 'Apr',
        '05' => 'Mei',
        '06' => 'Jun',
        '07' => 'Jul',
        '08' => 'Agt',
        '09' => 'Sep',
        '10' => 'Okt',
        '11' => 'Nov',
        '12' => 'Des'
    ];

    // Ubah format bulan dari numerik ke nama bulan
    $monthName = $months[$m];

    // Format menjadi 'DD-NamaBulan-YYYY'
    return $d . ' ' . $monthName . ' ' . $y;
}
