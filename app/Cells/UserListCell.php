<?php

namespace App\Cells;

use App\Models\UserModel;
use CodeIgniter\View\Cells\Cell;


class UserListCell extends Cell
{

    public string $limit = '10';
    public string $page = '1';

    public function render(): string
    {
        $userModel = new UserModel();

        // Pagination configuration
        $pager = \Config\Services::pager();

        $data = [
            'users' => $userModel->paginate((int) $this->limit, 'default', (int) $this->page),
            'pager' => $userModel->pager,
        ];

        return $this->view('user_list', $data);
    }
}
