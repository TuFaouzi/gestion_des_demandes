<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InteractionModel;

class InteractionController extends BaseController
{

    protected $interactionModel;

    public function __construct() {
        $this->interactionModel = new InteractionModel();
    }

    public function getInteractionsForRequest($id) {
        return $this->interactionModel
        ->select("interactions.*, request_statuses.label AS status")
        ->join('request_statuses', 'interactions.status_id = request_statuses.id')
        ->where('request_id', $id)
        ->findAll()
        ;
    }

    public function addInteraction($requestId, $statusId, $comment) {
        return $this->interactionModel->save([
            'request_id' => $requestId,
            'status_id' => $statusId,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function validateValues($values) {
        return $this->interactionModel->validate($values);
    }

    public function getErrors() {
        return $this->interactionModel->errors();
    }

}
