<?php

namespace App\Controllers;

use App\Libraries\Template;
use App\Models\UnitModel;
use App\Models\ItemModel;
use App\Models\SupplierModel;
use App\Models\StockModel;
use stdClass;

class Stock extends BaseController
{
    protected $template;
    protected $unitModel;
    protected $itemModel;
    protected $supplierModel;
    protected $stockModel;
    public function __construct()
    {
        // Load the Template library
        $this->template = new Template();
        $this->stockModel = new StockModel();

        // Load the unit model
        $this->unitModel = new UnitModel(); // Sesuaikan dengan nama model yang Anda gunakan
        $this->supplierModel = new SupplierModel();

        // Load the item model
        $this->itemModel = new ItemModel(); // Sesuaikan dengan nama model yang Anda gunakan
    }

    public function stockInData()
    {
        // Load unit data from the model
        $stocks = $this->stockModel->getStocksIn();

        $data = [
            'stocks' => $stocks
        ];
        // Load the template and view with data
        echo $this->template->load('template', 'trancactions/stockIn/stockInData', $data);
    }

    public function stockInAdd()
    {
        $item = $this->itemModel->getItems();
        $suppliers = $this->supplierModel->getSuppliers();

        $data = [
            'suppliers' => $suppliers,
            'items' => $item
        ];
        echo $this->template->load('template', 'trancactions/stockIn/stockInForm', $data);
    }

    public function stockInSave()
    {
        if (isset($_POST['inAdd'])) {

            $data = [
                'item_id' => $_POST['item_id'],
                'type' => 'in',
                'detail' => $_POST['detail'],
                'supplier_id' => $_POST['supplier_id'] ?? null,
                'qty' => $_POST['qty'],
                'date' => $_POST['date'],
                'user_id' => $_SESSION['user_id'],
            ];

            $this->stockModel->insert($data);
            $this->itemModel->update_stock_in($data);


            if ($this->stockModel->affectedRows() > 0) {
                session()->setFlashdata('success', 'Data berhasil disimpan');
            } else {
                session()->setFlashdata('error', 'Data gagal disimpan');
            }
            // Redirect kembali ke halaman utama unit
            return redirect()->to('trancactions/stocks/in');
        }
    }
    public function stockInDelete($stock_id, $item_id)
    {
        // Mengambil quantity dari stock_id yang diberikan
        $stock = $this->stockModel->get($stock_id);
        if ($stock) {
            $qty = $stock['qty'];  // Mengambil quantity dari stock
            $data = [
                'item_id' => $item_id,
                'qty' => $qty
            ];

            // Mengurangi stock pada item yang bersangkutan
            $this->itemModel->update_stock_out($data);

            // Menghapus data stock
            $this->stockModel->delete($stock_id);

            if ($this->stockModel->affectedRows() > 0) {
                session()->setFlashdata('success', 'Data berhasil dihapus');
            } else {
                session()->setFlashdata('error', 'Data gagal dihapus');
            }
        } else {
            session()->setFlashdata('error', 'Data tidak ditemukan');
        }

        // Redirect kembali ke halaman utama stock in
        return redirect()->to('trancactions/stocks/in');
    }
    public function stockOutData()
    {
        // Load unit data from the model
        $stocks = $this->stockModel->getStocksOut();

        $data = [
            'stocks' => $stocks
        ];
        // Load the template and view with data
        echo $this->template->load('template', 'trancactions/stockOut/stockOutData', $data);
    }

    public function stockOutAdd()
    {
        $item = $this->itemModel->getItems();
        $suppliers = $this->supplierModel->getSuppliers();

        $data = [
            'suppliers' => $suppliers,
            'items' => $item
        ];
        echo $this->template->load('template', 'trancactions/stockOut/stockOutForm', $data);
    }

    public function stockOutSave()
    {
        if (isset($_POST['inAdd'])) {

            $data = [
                'item_id' => $_POST['item_id'],
                'type' => 'out',
                'detail' => $_POST['detail'],
                'supplier_id' => $_POST['supplier_id'] ?? null,
                'qty' => $_POST['qty'],
                'date' => $_POST['date'],
                'user_id' => $_SESSION['user_id'],
            ];

            // Attempt to update the stock
            if ($this->itemModel->update_stock_out_del($data)) {
                // If stock update is successful, insert the stock out data
                $this->stockModel->insert($data);

                if ($this->stockModel->affectedRows() > 0) {
                    session()->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    session()->setFlashdata('error', 'Data gagal disimpan');
                }
            } else {
                // If stock is insufficient, set an error message
                session()->setFlashdata('error', 'Jumlah qty lebih besar dari stok yang tersedia');
            }

            // Redirect kembali ke halaman utama stock out
            return redirect()->to('trancactions/stocks/out');
        }
    }

    public function stockOutDelete($stock_id, $item_id)
    {
        // Mengambil quantity dari stock_id yang diberikan
        $stock = $this->stockModel->get($stock_id);
        if ($stock) {
            $qty = $stock['qty'];  // Mengambil quantity dari stock
            $data = [
                'item_id' => $item_id,
                'qty' => $qty
            ];

            // Mengurangi stock pada item yang bersangkutan
            $this->itemModel->update_stock_in($data);

            // Menghapus data stock
            $this->stockModel->delete($stock_id);

            if ($this->stockModel->affectedRows() > 0) {
                session()->setFlashdata('success', 'Data berhasil dihapus');
            } else {
                session()->setFlashdata('error', 'Data gagal dihapus');
            }
        } else {
            session()->setFlashdata('error', 'Data tidak ditemukan');
        }

        // Redirect kembali ke halaman utama stock in
        return redirect()->to('trancactions/stocks/out');
    }

}