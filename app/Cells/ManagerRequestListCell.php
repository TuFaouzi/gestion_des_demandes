<?php

namespace App\Cells;

use App\Controllers\RequestController;
use CodeIgniter\View\Cells\Cell;


class ManagerRequestListCell extends Cell
{

    public string $perPage = '10';
    public string $page = '1';
    public RequestController $requestController;

    public function __construct()
    {
        $this->requestController = new RequestController();
    }

    public function render(): string
    {
        
        $pending = $this->requestController->getPendingRequests($this->perPage, $this->page);

        $data = [
            'results' => $pending['results'],
            'pager' => $pending['pager'],
        ];

        return $this->view('manager_request_list', $data);
    }

}
