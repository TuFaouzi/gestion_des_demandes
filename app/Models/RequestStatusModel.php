<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestStatusModel extends Model
{
    protected $table = 'request_statuses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getByLabel(string $label)
    {
        return $this->where('label', $label)->first();
    }

}

