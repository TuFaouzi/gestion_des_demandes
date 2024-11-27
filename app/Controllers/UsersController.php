<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function addUser($data)
    {
        return $this->userModel->insert($data);
    }

    public function findUserById($id) {
        return $this->userModel->find($id);
    }

    public function validateValues($data) {
        return $this->userModel->validate($data);
    }

    public function getErrors() {
        return $this->userModel->errors();
    }
    
}
