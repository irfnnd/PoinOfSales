<?php

namespace App\Controllers;

use App\Libraries\Template;
use App\Models\SaleModel;
use App\Models\CustomerModel;
use App\Models\ItemModel;
use App\Models\TransactionModel;
class Sale extends BaseController
{
    protected $template;
    protected $saleModel;
    protected $customerModel;
    protected $itemModel;
    protected $transactionModel;
    public function __construct()
    {
        // Load the Template library
        $this->template = new Template();
        $this->saleModel = new SaleModel();
        $this->customerModel = new CustomerModel();
        $this->itemModel = new ItemModel();
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        // Load the template and view
        $customers = $this->customerModel->getCustomers();
        $items = $this->itemModel->getItems();
        $data = [
            'items' => $items,
            'customers' => $customers,
            'invoice' => $this->saleModel->invoice_no()
        ];
        echo $this->template->load('template', 'trancactions/sale/saleForm', $data);
    }

    public function addCart()
    {
        if ($this->request->isAJAX()) {
            // Terima data dari AJAX
            $no = $this->request->getPost('no'); // Ambil nomor dari AJAX
            $item_id = $this->request->getPost('item_id');
            $item_name = $this->request->getPost('item_name');
            $unit_name = $this->request->getPost('unit_name');
            $barcode = $this->request->getPost('barcode');
            $price = $this->request->getPost('price');
            $qty = $this->request->getPost('qty');

            // Hitung total harga
            $total = $price * $qty;

            // Buat output baris baru dengan nomor urut dari AJAX
            $output = '
                <tr>
                    <td>' . esc($no) . '</td>
                    <input type="hidden" class="item_id" name="item_id[]" value="' . esc($item_id) . '">
                    <td class="barcode">' . esc($barcode) . '</td>
                    <td class="item_name">' . esc($item_name) . '</td>
                    <td class="unit_name">' . esc($unit_name) . '</td>
                    <td class="price">' . esc($price) . '</td>
                    <td class="qty">' . esc($qty) . '</td>
                    <td class="discount">0</td>
                    <td class="total">' . esc($total) . '</td>
                    <td>
                        <button class="btn btn-xs btn-info edit_cart" data-item-id="' . esc($item_id) . '">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-xs btn-danger delete_cart" data-item-id="' . esc($item_id) . '">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            ';

            // Kirim output sebagai respon JSON

            // Kirim output sebagai respon JSON
            return $this->response->setJSON(['output' => $output]);
        }
    }

    public function removeCart()
    {
        // Ambil item_id dari request AJAX
        $item_id = $this->request->getPost('item_id');

        // Hapus item dari session
        $cart = session()->get('cart');
        if (isset($cart[$item_id])) {
            unset($cart[$item_id]);
            session()->set('cart', $cart);
        }

        // Response ke AJAX
        return $this->response->setJSON(['status' => 'success']);
    }

// In Sales.php controller
    public function processPayment() {
        // Load the model for transactions
        // Retrieve POST data
        $customer_id = $this->request->getPost('customer_id');
        $sub_total = $this->request->getPost('sub_total');
        $discount = $this->request->getPost('discount');
        $grand_total = $this->request->getPost('grand_total');
        $payment_method = $this->request->getPost('payment_method');
        $status = $this->request->getPost('status');
        $cart_items = $this->request->getPost('cart_items'); // This is an array of cart items
        
        // Prepare the transaction data
        $transactionData = [
            'customer_id' => $customer_id,
            'transaction_date' => date('Y-m-d H:i:s'), // Current timestamp
            'sub_total' => $sub_total,
            'discount' => $discount,
            'grand_total' => $grand_total,
            'payment_method' => $payment_method,
            'status' => $status
    ];
    
    // Insert the transaction into the 'transactions' table
    $transaction_id = $this->transactionModel->insertTransaction($transactionData);

    if ($transaction_id) {
        // Prepare the items data for each cart item
        foreach ($cart_items as $item) {
            $itemData = [
                'transaction_id' => $transaction_id,
                'item_id' => $item['item_id'],
                'item_name' => $item['item_name'],
                'unit_name' => $item['unit_name'],
                'barcode' => $item['barcode'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'total' => $item['total']
            ];

            // Insert each item into the 'transaction_items' table
            $this->transactionModel->insertTransactionItem($itemData);
        }

        // Send success response
        return $this->response->setJSON(['status' => 'success']);
    } else {
        // Send failure response
        return $this->response->setJSON(['status' => 'failure']);
    }
}


}
