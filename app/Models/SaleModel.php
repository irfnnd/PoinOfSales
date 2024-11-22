<?php
namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'sale_id';
    protected $allowedFields = ['sale_id', 'invoice', 'customer_id', 'total_price', 'discount', 'final_price', 'cash', 'remaining', 'note', 'date', 'created_at', 'user_id'];

    public function getSales()
    {
        return $this->select('sales.*, customers.name as customer_name , users.name as user_name')
            ->join('customers', 'customers.customer_id = sales.customer_id')
            ->findAll();
    }
    public function invoice_no()
    {
        // Query untuk mendapatkan nomor invoice terbesar dari hari ini
        $sql = $this->db->query("SELECT MAX(MID(invoice, 12, 4)) AS invoice_no FROM sales WHERE MID(invoice, 4, 8) = DATE_FORMAT(CURDATE(), '%Y%m%d')");
    
        // Cek apakah ada hasil dari query
        if ($sql->getNumRows() > 0) {
            $row = $sql->getRow();
            $n = ((int) $row->invoice_no) + 1;
            $no = sprintf("%04d", $n); // Menggunakan sprintf untuk format angka 4 digit
        } else {
            $no = "0001"; // Jika belum ada, mulai dari 0001
        }
    
        // Membuat nomor invoice baru dengan format TRXYYYYMMDDxxxx
        $invoice = "TRX" . date('Ymd') . $no;
    
        return $invoice;
    }
    

}
