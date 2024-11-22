<?php

namespace App\Controllers;

use App\Libraries\Template;
use App\Models\UnitModel;
use stdClass;

class Unit extends BaseController
{
    protected $template;
    protected $unitModel;

    public function __construct()
    {
        // Load the Template library
        $this->template = new Template();

        // Load the unit model
        $this->unitModel = new UnitModel(); // Sesuaikan dengan nama model yang Anda gunakan
    }

    public function index()
    {
        // Load unit data from the model
        $units = $this->unitModel->getUnits(); // Mengambil semua data unit dari model

        // Prepare data to be sent to the view
        $data = [
            'units' => $units // Mengirim data unit ke view dengan nama variabel 'units'
        ];

        // Load the template and view with data
        echo $this->template->load('template', 'products/units/unitData', $data);
    }
    public function delete($id)
    {
        $this->unitModel->delete($id);

        if ($this->unitModel->affectedRows() > 0) {
            session()->setFlashdata('success', 'Data unit berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data unit gagal dihapus atau tidak ditemukan');
        }

        return redirect()->to('products//units');
    }

    protected $helpers = ['form'];

    public function add()
    {
        $unit = new stdClass();
        $unit->unit_id = '';
        $unit->name = '';

        $data = [
            'page' => 'Add',
            'unit' => $unit
        ];

        echo $this->template->load('template', 'products/units/unitForm', $data);
    }
    public function edit($id)
    {
        // Mengambil data unit berdasarkan ID
        $unit = $this->unitModel->find($id);
        
        if (!$unit) {
            session()->setFlashdata('error', 'Data unit tidak ditemukan');
            return redirect()->to('products/units');
        }
        $unit = (object) $unit;

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'page' => 'Edit',
            'unit' => $unit
        ];

        echo $this->template->load('template', 'products/units/unitForm', $data);
    }



    public function save()
    {
        $id = $this->request->getPost('unit_id');

        // Menyiapkan aturan validasi jika diperlukan

        // Menyiapkan data untuk disimpan
        $data = [
            'name' => $this->request->getPost('name')      
        ];

        if (empty($id)) {
            // Jika ID kosong, maka ini adalah proses penambahan data
            $this->unitModel->insert($data);
        } else {
            // Jika ID tidak kosong, maka ini adalah proses pengeditan data
            $this->unitModel->update($id, $data);
        }

        // Set flash message untuk memberi informasi kepada pengguna
        session()->setFlashdata('success', 'Data unit berhasil disimpan');

        // Redirect kembali ke halaman utama unit
        return redirect()->to('products/units');
    }

}