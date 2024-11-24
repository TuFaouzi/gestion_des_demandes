<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'type_id', 'created_by', 'status_id', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'type_id' => 'required|is_not_unique[types.id]',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Le titre est requis',
        ],
        'type_id' => [
            'required' => 'Le type de requête est requis',
            'is_not_unique' => 'Le type sélectionner est invalide',
        ],
    ];

    public function getCountByStatus(int $statusId) {
        return $this->where('status_id', $statusId)->countAllResults();
    }

    public function getCountByStatuses(array $statuses) {
        $result = 0;
        foreach ($statuses as $status) {
            $result += $this->where('status_id', $status)->countAllResults();
        }
        return $result;
    }

}
