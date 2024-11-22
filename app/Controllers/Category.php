<?php

namespace App\Controllers;

use App\Libraries\Template;
use App\Models\CategoryModel;
use stdClass;

class Category extends BaseController
{
    protected $template;
    protected $categoryModel;

    public function __construct()
    {
        // Load the Template library
        $this->template = new Template();

        // Load the category model
        $this->categoryModel = new CategoryModel(); // Sesuaikan dengan nama model yang Anda gunakan
    }

    public function index()
    {
        // Load category data from the model
        $categories = $this->categoryModel->getCategories(); // Mengambil semua data category dari model

        // Prepare data to be sent to the view
        $data = [
            'categories' => $categories // Mengirim data category ke view dengan nama variabel 'categories'
        ];

        // Load the template and view with data
        echo $this->template->load('template', 'products/categories/categoryData', $data);
    }
    public function delete($id)
    {
        $this->categoryModel->delete($id);

        if ($this->categoryModel->affectedRows() > 0) {
            session()->setFlashdata('success', 'Data category berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data category gagal dihapus atau tidak ditemukan');
        }

        return redirect()->to('products/categories');
    }

    protected $helpers = ['form'];

    public function add()
    {
        $category = new stdClass();
        $category->category_id = '';
        $category->name = '';

        $data = [
            'page' => 'Add',
            'category' => $category
        ];

        echo $this->template->load('template', 'products/categories/categoryForm', $data);
    }
    public function edit($id)
    {
        // Mengambil data category berdasarkan ID
        $category = $this->categoryModel->find($id);
        
        if (!$category) {
            session()->setFlashdata('error', 'Data category tidak ditemukan');
            return redirect()->to('products/categories');
        }
        $category = (object) $category;

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'page' => 'Edit',
            'category' => $category
        ];

        echo $this->template->load('template', 'products/categories/categoryForm', $data);
    }



    public function save()
    {
        $id = $this->request->getPost('category_id');

        // Menyiapkan aturan validasi jika diperlukan

        // Menyiapkan data untuk disimpan
        $data = [
            'name' => $this->request->getPost('name')
        ];

        if (empty($id)) {
            // Jika ID kosong, maka ini adalah proses penambahan data
            $this->categoryModel->insert($data);
        } else {
            // Jika ID tidak kosong, maka ini adalah proses pengeditan data
            $this->categoryModel->update($id, $data);
        }

        // Set flash message untuk memberi informasi kepada pengguna
        session()->setFlashdata('success', 'Data category berhasil disimpan');

        // Redirect kembali ke halaman utama category
        return redirect()->to('products/categories');
    }

}