<?php

namespace App\Controllers;

use App\Models\UserModel; // Sesuaikan dengan nama model yang Anda gunakan
use App\Libraries\Template;

class Users extends BaseController
{
    protected $template;
    protected $userModel;

    public function __construct()
    {
        // Load the Template library
        $this->template = new Template();

        // Load the User model
        $this->userModel = new UserModel(); // Sesuaikan dengan nama model yang Anda gunakan
    }

    public function index()
    {
        // Load user data from the model
        $users = $this->userModel->getUsers(); // Mengambil semua data user dari model

        // Prepare data to be sent to the view
        $data = [
            'users' => $users // Mengirim data user ke view dengan nama variabel 'users'
        ];

        // Load the template and view with data
        echo $this->template->load('template', 'users/usersData', $data);
    }

    protected $helpers = ['form'];

    public function add()
    {
        // Load the validation service
        $validation = \Config\Services::validation();

        if (! $this->request->is('post')) {
            return $this->template->load('template', 'users/userFormAdd');
        }

        $rules = [
            'username' => 'required|max_length[12]|min_length[5]|is_unique[users.username]',
            'password' => 'required|max_length[12]|min_length[6]',
            'passconf' => 'required|matches[password]',
            'name' => 'required',
            'address' => 'required',
            'level' => 'required',
        ];

        $messages = [
            'username' => [
                'required' => 'Username tidak boleh kosong.',
                'max_length' => 'Username maksimal 12 karakter.',
                'min_length' => 'Username minimal 5 karakter.',
                'is_unique' => 'Username telah digunakan.',
            ],
            'password' => [
                "required" => 'Password tidak boleh kosong.',
                'max_length' => 'Password maksimal 12 karakter.',
                'min_length' => 'Password minimal 6 karakter.',
            ],
            'passconf' => [
                'required' => 'Konfirmasi password tidak boleh kosong.',
                'matches' => 'Password tidak sesuai.',
            ],
            'name' => [
                'required' => 'Nama tidak boleh kosong.',
            ],
            'address' => [
                'required' => 'Silahkan isi alamat.',
            ],
            'level' => [
                'required' => 'Silahkan pilih level user.',
            ],
        ];

        // Set validation rules and custom error messages
        $validation->setRules($rules, $messages);

        if (! $validation->withRequest($this->request)->run()) {
            // Validation failed, return to form with errors
            $data['errors'] = $validation->getErrors();
            return $this->template->load('template', 'users/userFormAdd', $data);
        } else{
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => sha1($this->request->getPost('password')),
                'name' => $this->request->getPost('name'),
                'address' => $this->request->getPost('address'),
                'level' => $this->request->getPost('level'),
            ];
            $this->userModel->insert($data);
            if ($this->userModel->affectedRows() > 0) {
                session()->setFlashdata('success', 'Data user berhasil ditambahkan');
            }
            return redirect()->to('/users');
        }

       
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
    
        if ($this->userModel->affectedRows() > 0) {
            session()->setFlashdata('success', 'Data user berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data user gagal dihapus atau tidak ditemukan');
        }
    
        return redirect()->to('/users');
    }


    public function edit($id)
    {
        // Load the validation service
        $validation = \Config\Services::validation();
    
        // Fetch the user data to be edited
        $userData = $this->userModel->find($id);
        if (!$userData) {
            return redirect()->to('/users')->with('error', 'User data not found');
        }
    
        if (!$this->request->is('post')) {
            // Load the edit form with existing user data
            $data = [
                'user' => $userData
            ];
            return $this->template->load('template', 'users/userFormEdit', $data);
        }
    
        $rules = [
            'username' => 'required|max_length[12]|min_length[5]|is_unique[users.username,user_id,' . $id . ']',
            'password' => 'permit_empty|max_length[12]|min_length[6]',
            'passconf' => 'permit_empty|matches[password]',
            'name' => 'required',
            'address' => 'required',
            'level' => 'required',
        ];
    
        $messages = [
            'username' => [
                'required' => 'Username tidak boleh kosong.',
                'max_length' => 'Username maksimal 12 karakter.',
                'min_length' => 'Username minimal 5 karakter.',
                'is_unique' => 'Username telah digunakan.',
            ],
            'password' => [
                'max_length' => 'Password maksimal 12 karakter.',
                'min_length' => 'Password minimal 6 karakter.',
            ],
            'passconf' => [
                'matches' => 'Password tidak sesuai.',
            ],
            'name' => [
                'required' => 'Nama tidak boleh kosong.',
            ],
            'address' => [
                'required' => 'Silahkan isi alamat.',
            ],
            'level' => [
                'required' => 'Silahkan pilih level user.',
            ],
        ];
    
        // Set validation rules and custom error messages
        $validation->setRules($rules, $messages);
    
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, return to form with errors
            $data['errors'] = $validation->getErrors();
            $data['user'] = $userData; // Include existing user data in case of errors
            return $this->template->load('template', 'users/userFormEdit', $data);
        }
    
        // Prepare data for update
        $data = [
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'level' => $this->request->getPost('level'),
        ];
    
        // Check if password is being updated
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = sha1($password);
        }
    
        // Perform update
        $this->userModel->update($id, $data);
        if ($this->userModel->affectedRows() > 0) {
            session()->setFlashdata('success', 'Data user berhasil diupdate');
        } else {
            session()->setFlashdata('error', 'Data user gagal diupdate');
        }
    
        return redirect()->to('/users');
    }
    
    
    

}
