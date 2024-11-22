<?php

namespace App\Controllers;

use App\Libraries\Template;
use App\Models\SupplierModel;
use stdClass;

class Supplier extends BaseController
{
    protected $template;
    protected $supplierModel;

    public function __construct()
    {
        // Load the Template library
        $this->template = new Template();

        // Load the supplier model
        $this->supplierModel = new SupplierModel(); // Sesuaikan dengan nama model yang Anda gunakan
    }

    public function index()
    {
        // Load supplier data from the model
        $suppliers = $this->supplierModel->getSuppliers(); // Mengambil semua data supplier dari model

        // Prepare data to be sent to the view
        $data = [
            'suppliers' => $suppliers // Mengirim data supplier ke view dengan nama variabel 'suppliers'
        ];

        // Load the template and view with data
        echo $this->template->load('template', 'suppliers/supplierData', $data);
    }
    public function delete($id)
    {
        $this->supplierModel->delete($id);
        $error = $this->supplierModel->errors();

        if ($error) {
            session()->setFlashdata('error', 'Data supplier digunakan oleh data lain');
            return redirect()->to('/suppliers');
        }

        else {
            session()->setFlashdata('success', 'Data supplier berhasil di hapus');
        }

        return redirect()->to('/suppliers');
    }

    protected $helpers = ['form'];

    public function add()
    {
        $supplier = new stdClass();
        $supplier->supplier_id = '';
        $supplier->name = '';
        $supplier->phone = '';
        $supplier->address = '';
        $supplier->description = '';

        $data = [
            'page' => 'Add',
            'supplier' => $supplier
        ];

        echo $this->template->load('template', 'suppliers/supplierForm', $data);
    }
    public function edit($id)
    {
        // Mengambil data supplier berdasarkan ID
        $supplier = $this->supplierModel->find($id);
        
        if (!$supplier) {
            session()->setFlashdata('error', 'Data supplier tidak ditemukan');
            return redirect()->to('/suppliers');
        }
        $supplier = (object) $supplier;

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'page' => 'Edit',
            'supplier' => $supplier
        ];

        echo $this->template->load('template', 'suppliers/supplierForm', $data);
    }



    public function save()
    {
        $id = $this->request->getPost('supplier_id');

        // Menyiapkan aturan validasi jika diperlukan

        // Menyiapkan data untuk disimpan
        $data = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'description' => $this->request->getPost('description')
        ];

        if (empty($id)) {
            // Jika ID kosong, maka ini adalah proses penambahan data
            $this->supplierModel->insert($data);
        } else {
            // Jika ID tidak kosong, maka ini adalah proses pengeditan data
            $this->supplierModel->update($id, $data);
        }

        // Set flash message untuk memberi informasi kepada pengguna
        session()->setFlashdata('success', 'Data supplier berhasil disimpan');

        // Redirect kembali ke halaman utama supplier
        return redirect()->to('/suppliers');
    }

}