<?php

// app/Controllers/Auth.php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        $ModelUser = new UserModel();
        $login = $this->request->getPost('login');
        if ($login){
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            if ($username == '' || $password == '') {
                $err = "Silahkan masukkan username dan password";
            }

            if (empty($err)) {
                $user = $ModelUser->where('username', $username)->first();
                if (!$user || $user['password'] != sha1($password)) {
                    $err = "Username atau password salah";
                } else {
                    session()->set('name', $user['name']);
                    // Set user level
                    session()->set('level', $user['level']);
                }
            }

            if (empty($err)) {
                $usersesi = [
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    'password' => $user['password'],
                    // Store user level in session
                    'level' => $user['level'],
                ];
                session()->set($usersesi);
                return redirect()->to('/dashboard');
            }

            if ($err) {
                session()->setFlashdata('username', $username);
                session()->setFlashdata('error', $err);
                return redirect()->to('login');
            }
        }
        return view('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function Access()
    {
        echo view('errors/noAccess');
    }
}
