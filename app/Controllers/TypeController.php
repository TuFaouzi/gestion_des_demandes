<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TypeModel;

class TypeController extends BaseController
{
    protected $typeModel;

    public function __construct() {
        $this->typeModel = new TypeModel();
    }

    public function getAllTypes()
    {
        return $this->typeModel->where('status', 'Active')->findAll();
    }
}
