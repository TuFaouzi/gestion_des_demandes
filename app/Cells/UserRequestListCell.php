<?php

namespace App\Cells;

use App\Controllers\EmployeeController;
use App\Models\UserModel;
use CodeIgniter\View\Cells\Cell;


class UserRequestListCell extends Cell
{

    public string $limit = '10';
    public string $page = '1';

    public function render(): string
    {
        $employeeController = new EmployeeController();

        $results = $employeeController->getUserConnectedRequestsPagination($this->limit, $this->page);

        $data = [
            'results' => $results['results'],
            'pager' => $results['pager'],
        ];

        return $this->view('user_request_list', $data);
    }
}
