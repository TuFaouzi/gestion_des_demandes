<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RequestStatusModel;

class RequestStatusController extends BaseController
{

    protected $requestStatusModel;

    
    public function __construct()
    {
        $this->requestStatusModel = new RequestStatusModel();
    }


    public function getRequestStatusByLabel($label)
    {
        switch($label) {
            case "Waiting": {
                return $this->requestStatusModel->getByLabel("Waiting");
            }
            case "Forwarded": {
                return $this->requestStatusModel->getByLabel("Forwarded");
            }
            case "Validated": {
                return $this->requestStatusModel->getByLabel("Validated");
            }
            case "DeclinedByManager": {
                return $this->requestStatusModel->getByLabel("DeclinedByManager");
            }
            case "DeclinedByBoss": {
                return $this->requestStatusModel->getByLabel("DeclinedByBoss");
            }
            case "Deleted": {
                return $this->requestStatusModel->getByLabel("Deleted");
            }
            default: {
                return $this->requestStatusModel->getByLabel("Deleted");
            }
        }
    }

    public function getStatusLabel($label) {
        switch($label) {
            case "Waiting": {
                return "En attente";
            }
            case "Forwarded": {
                return "Escaladée";
            }
            case "Validated": {
                return "Validée";
            }
            case "DeclinedByManager": {
                return "Déclinée par un Responsable";
            }
            case "DeclinedByBoss": {
                return "Déclinée par le Manager";
            }
            case "Deleted": {
                return $this->requestStatusModel->getByLabel("Deleted");
            }
            default: {
                return $this->requestStatusModel->getByLabel("Deleted");
            }
        }
    }
}
