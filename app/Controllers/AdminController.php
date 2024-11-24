<?php

namespace App\Controllers;

class AdminController extends BaseController
{

    protected $userController;

    public function __construct() {
        $this->userController = new UsersController();
    }

    public function index($perPage, $page) {
        $pp = $perPage ?? 10;
        $p = $page ?? 1;
        return view('admin/index', ['perPage' => $pp, 'page' => $p]);
    } 

    public function addUser()
    {
        helper(['form']);

        if ($this->request->getMethod() == 'POST') {
            

            $data = [
                'firstName' => $this->request->getPost('firstName'),
                'lastName' => $this->request->getPost('lastName'),
                'phoneNumber' => $this->request->getPost('phoneNumber'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role'),
            ];

            if (!$this->userController->validateValues($data)) {
                $errors = $this->userController->getErrors();
                return redirect()->back()->withInput()->with('errors', $errors);
            }

            $this->userController->addUser($data);

            return redirect()->to('/admin/users')->with('success', 'User added successfully!');
        }

        return view('admin/add_user');
    }

}
