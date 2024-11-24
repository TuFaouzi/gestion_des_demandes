<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        helper(['form']); // Load form helper

        // If the user is already logged in, redirect to the dashboard
        if (session()->get('is_logged_in')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() == 'POST') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Store user session
                session()->set([
                    'user_id' => $user['id'],
                    'role' => $user['role'],
                    'is_logged_in' => true,
                ]);

                return redirect()->to('/');
            } else {
                return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy(); // Clear the session
        return redirect()->to('/login');
    }
}
