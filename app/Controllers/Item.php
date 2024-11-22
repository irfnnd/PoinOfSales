<?php

namespace App\Controllers;

use App\Libraries\Template;
use App\Libraries\Pdfgenerator;
use App\Models\ItemModel;
use App\Models\CategoryModel;
use App\Models\UnitModel;
use CodeIgniter\Controller;
use stdClass;
use Dompdf\Dompdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class Item extends BaseController
{
    protected $template;
    protected $itemModel;
    protected $categoryModel;
    protected $unitModel;
    protected $pdfGenerator;

    public function __construct()
    {
        // Load the Template library
        $this->template = new Template();
        $this->pdfGenerator = new Pdfgenerator();

        // Load the item model
        $this->itemModel = new ItemModel(); // Sesuaikan dengan nama model yang Anda gunakan
        $this->categoryModel = new CategoryModel(); // Sesuaikan dengan nama model yang Anda gunakan
        $this->unitModel = new UnitModel(); // Sesuaikan dengan nama model yang Anda gunakan
    }

    public function index()
    {
        // Load item data from the model
        $items = $this->itemModel->getItems(); // Mengambil semua data item dari model
        $categories = $this->categoryModel->getCategories(); // Mengambil semua data item dari model
        $units = $this->unitModel->getUnits(); // Mengambil semua data item dari model

        // Prepare data to be sent to the view
        $data = [
            'items' => $items,
            'units' => $units,
            'categories' => $categories
            // Mengirim data item ke view dengan nama variabel 'items'
        ];

        // Load the template and view with data
        echo $this->template->load('template', 'products/items/itemData', $data);
    }

    public function delete($id)
    {
        // Ambil data item berdasarkan ID
        $item = $this->itemModel->find($id);

        if ($item) {
            // Hapus gambar jika ada
            if (!empty($item['image'])) {
                $imagePath = 'uploads/images/' . $item['image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Hapus data item dari database
            $this->itemModel->delete($id);

            if ($this->itemModel->affectedRows() > 0) {
                session()->setFlashdata('success', 'Data item berhasil dihapus');
            } else {
                session()->setFlashdata('error', 'Data item gagal dihapus atau tidak ditemukan');
            }
        } else {
            session()->setFlashdata('error', 'Data item tidak ditemukan');
        }

        return redirect()->to('products/items');
    }

    protected $helpers = ['form'];

    public function add()
    {
        $item = new stdClass();
        $item->item_id = '';
        $item->barcode = '';
        $item->category_id = '';
        $item->unit_id = '';
        $item->name = '';
        $item->price = '';
        $item->image = '';

        $category = $this->categoryModel->getCategories();
        $unit = $this->unitModel->getUnits();

        $data = [
            'page' => 'Add',
            'item' => $item,
            'category' => $category,
            'unit' => $unit
        ];

        echo $this->template->load('template', 'products/items/itemForm', $data);
    }

    public function edit($id)
    {
        // Mengambil data item berdasarkan ID
        $item = $this->itemModel->find($id);

        if (!$item) {
            session()->setFlashdata('error', 'Data item tidak ditemukan');
            return redirect()->to('products/items');
        }
        $item = (object) $item;

        $category = $this->categoryModel->getCategories();
        $unit = $this->unitModel->getUnits();

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'page' => 'Edit',
            'item' => $item,
            'category' => $category,
            'unit' => $unit,
            'validation' => $this->validator
        ];

        echo $this->template->load('template', 'products/items/itemForm', $data);
    }
    public function save()
    {
        $id = $this->request->getPost('item_id');

        // Menyiapkan aturan validasi dengan pesan kesalahan kustom
        $rules = [
            'barcode' => [
                'label' => 'Barcode',
                'rules' => 'required|is_unique[items.barcode,item_id,' . $id . ']',
                'errors' => [
                    'required' => 'Barcode harus diisi.',
                    'is_unique' => 'Barcode sudah digunakan, harap gunakan barcode yang lain.'
                ]
            ],
            'name' => [
                'label' => 'Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.'
                ]
            ],
            'category' => [
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih.'
                ]
            ],
            'unit' => [
                'label' => 'Unit',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Unit harus dipilih.'
                ]
            ],
            'price' => [
                'label' => 'Price',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi.',
                    'numeric' => 'Harga harus berupa angka.'
                ]
            ],
            'image' => [
                'label' => 'Image',
                'rules' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar maksimal 2MB.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in' => 'File harus memiliki format JPG, JPEG, atau PNG.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            // Jika validasi tidak berhasil, kembali ke form dengan pesan kesalahan
            $item = new stdClass();
            $item->item_id = $id;
            $item->barcode = $this->request->getPost('barcode');
            $item->name = $this->request->getPost('name');
            $item->price = $this->request->getPost('price');
            $item->category_id = $this->request->getPost('category');
            $item->unit_id = $this->request->getPost('unit');
            $item->image = $this->request->getPost('image'); // Menambahkan properti image

            // Jika sedang mengedit, pastikan untuk mempertahankan gambar lama
            if ($id) {
                $existingItem = $this->itemModel->find($id);
                $item->image = $existingItem['image'] ?? null;
            }

            $category = $this->categoryModel->getCategories();
            $unit = $this->unitModel->getUnits();

            $data = [
                'page' => $id ? 'Edit' : 'Add',
                'item' => $item,
                'category' => $category,
                'unit' => $unit,
                'validation' => $this->validator
            ];

            echo $this->template->load('template', 'products/items/itemForm', $data);
        } else {
            // Jika validasi berhasil, siapkan data untuk disimpan
            $image = $this->request->getFile('image');
            $newName = null; // Default value for newName

            if ($image && $image->isValid() && !$image->hasMoved()) {
                // Membuat nama file baru dengan prefix "item-" dan panjang maksimal 10 karakter
                $newName = 'item-' . uniqid() . '.' . $image->getExtension();

                // Jika mengedit data, hapus gambar lama jika ada gambar baru
                if (!empty($id)) {
                    $item = $this->itemModel->find($id);
                    if ($item && !empty($item['image'])) {
                        $oldImagePath = 'uploads/images/' . $item['image'];
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }

                // Pindahkan file baru ke direktori tujuan
                $image->move('uploads/images', $newName);
            } else {
                // Jika tidak ada file baru diunggah, gunakan gambar yang sudah ada (jika ada)
                if ($id) {
                    $existingItem = $this->itemModel->find($id);
                    $newName = $existingItem['image'] ?? null;
                }
            }

            $data = [
                'barcode' => $this->request->getPost('barcode'),
                'name' => $this->request->getPost('name'),
                'category_id' => $this->request->getPost('category'),
                'unit_id' => $this->request->getPost('unit'),
                'price' => $this->request->getPost('price'),
                'image' => $newName
            ];

            if (empty($id)) {
                // Jika ID kosong, maka ini adalah proses penambahan data
                $this->itemModel->insert($data);
            } else {
                // Jika ID tidak kosong, maka ini adalah proses pengeditan data
                $this->itemModel->update($id, $data);
            }

            // Set flash message untuk memberi informasi kepada pengguna
            session()->setFlashdata('success', 'Data item berhasil disimpan');

            // Redirect kembali ke halaman utama item
            return redirect()->to('products/items');
        }

    }

    function barcode_qrcode($id)
    {
        $item = $this->itemModel->find($id);
        $data = [
            'item' => $item
        ];
        echo $this->template->load('template', 'products/items/barcode_qrcode', $data);
    }


    public function barcodePrint($id)
    {
        // Mengambil semua data item dari model
        $html = view('products/items/barcodePrint', [
            'item' => $this->itemModel->find($id)
        ]);

        $this->pdfGenerator->generate($html,'Barcode Product ' . $this->itemModel->find($id)['name'],'A4','potrait');
    }
    public function qrcodePrint($id)
    {
        // Mengambil semua data item dari model
        $html = view('products/items/qrcodePrint', [
            'item' => $this->itemModel->find($id)
        ]);

        $this->pdfGenerator->generate($html,'QR-Code Product ' . $this->itemModel->find($id)['name'],'A4','potrait');
    }
}

