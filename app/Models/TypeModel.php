<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeModel extends Model
{
    protected $table = 'types';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
