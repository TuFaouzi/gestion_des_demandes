<?php

namespace App\Models;

use CodeIgniter\Model;

class InteractionModel extends Model
{
    protected $table = 'interactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['comment', 'status_id', 'request_id', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getWithRelations()
    {
        return $this->select('interactions.*, request_statuses.label AS status_label, requests.title AS request_title')
                    ->join('request_statuses', 'request_statuses.id = interactions.status_id', 'left')
                    ->join('requests', 'requests.id = interactions.request_id', 'left')
                    ->findAll();
    }

    protected $validationRules = [
        'comment' => 'required|min_length[2]|max_length[10000]',
    ];

    protected $validationMessages = [
        'comment' => [
            'required' => 'Ce champ est requis'
        ]
    ];
}
