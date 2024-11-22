<?php

namespace App\Controllers;

use App\Libraries\Template;
use App\Models\CustomerModel;
use stdClass;

class Customer extends BaseController
{
    protected $template;
    protected $customerModel;

    public function __construct()
    {
        // Load the Template library
        $this->template = new Template();

        // Load the customer model
        $this->customerModel = new CustomerModel(); // Sesuaikan dengan nama model yang Anda gunakan
    }

    public function index()
    {
        // Load customer data from the model
        $customers = $this->customerModel->getCustomers(); // Mengambil semua data customer dari model

        // Prepare data to be sent to the view
        $data = [
            'customers' => $customers // Mengirim data customer ke view dengan nama variabel 'customers'
        ];

        // Load the template and view with data
        echo $this->template->load('template', 'customers/customerData', $data);
    }
    public function delete($id)
    {
        $this->customerModel->delete($id);

        if ($this->customerModel->affectedRows() > 0) {
            session()->setFlashdata('success', 'Data customer berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data customer gagal dihapus atau tidak ditemukan');
        }

        return redirect()->to('/customers');
    }

    protected $helpers = ['form'];

    public function add()
    {
        $customer = new stdClass();
        $customer->customer_id = '';
        $customer->name = '';
        $customer->gender = '';
        $customer->phone = '';
        $customer->address = '';

        $data = [
            'page' => 'Add',
            'customer' => $customer
        ];

        echo $this->template->load('template', 'customers/customerForm', $data);
    }
    public function edit($id)
    {
        // Mengambil data customer berdasarkan ID
        $customer = $this->customerModel->find($id);
        
        if (!$customer) {
            session()->setFlashdata('error', 'Data customer tidak ditemukan');
            return redirect()->to('/customers');
        }
        $customer = (object) $customer;

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'page' => 'Edit',
            'customer' => $customer
        ];

        echo $this->template->load('template', 'customers/customerForm', $data);
    }



    public function save()
    {
        $id = $this->request->getPost('customer_id');

        // Menyiapkan aturan validasi jika diperlukan

        // Menyiapkan data untuk disimpan
        $data = [
            'name' => $this->request->getPost('name'),
            'gender' => $this->request->getPost('gender'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address')
        ];

        if (empty($id)) {
            // Jika ID kosong, maka ini adalah proses penambahan data
            $this->customerModel->insert($data);
        } else {
            // Jika ID tidak kosong, maka ini adalah proses pengeditan data
            $this->customerModel->update($id, $data);
        }

        // Set flash message untuk memberi informasi kepada pengguna
        session()->setFlashdata('success', 'Data customer berhasil disimpan');

        // Redirect kembali ke halaman utama customer
        return redirect()->to('/customers');
    }

}