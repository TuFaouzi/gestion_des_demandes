<?php

namespace App\Cells;

use App\Controllers\RequestController;
use CodeIgniter\View\Cells\Cell;


class ShowRequestCell extends Cell
{

    public string $id = '';

    public RequestController $requestController;

    public function __construct()
    {
        $this->requestController = new RequestController();
    }

    public function render(): string
    {
        return $this->view('show_request', $this->requestController->getPlainRequest($this->id));
    }

}
