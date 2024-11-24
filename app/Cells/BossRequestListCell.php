<?php

namespace App\Cells;

use App\Controllers\RequestController;
use CodeIgniter\View\Cells\Cell;


class BossRequestListCell extends Cell
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
        
        $results = $this->requestController->getForwardedRequestsPagination($this->perPage, $this->page);

        $data = [
            'results' => $results['results'],
            'pager' => $results['pager'],
        ];

        return $this->view('boss_request_list', $data);
    }

}
