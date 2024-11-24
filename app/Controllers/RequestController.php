<?php

namespace App\Controllers;

use App\Models\RequestModel;
use App\Controllers\BaseController;

class RequestController extends BaseController
{
    protected $requestModel;
    protected $requestStatusController;
    protected $interactionController;

    public function __construct()
    {
        $this->requestModel = new RequestModel();
        $this->requestStatusController = new RequestStatusController();
        $this->interactionController = new InteractionController();
    }

    public function getPendingRequests($perPage = 10, $page = 1): array
    {
        $results = $this->requestModel
            ->select("requests.*, request_statuses.label AS status, types.label AS type, users.firstName AS firstName, users.lastName AS lastName")
            ->where('status_id', $this->requestStatusController->getRequestStatusByLabel("Waiting")['id'])
            ->join('request_statuses', 'requests.status_id = request_statuses.id')
            ->join('users', 'requests.created_by = users.id')
            ->join('types', 'requests.type_id = types.id')
            ->orderBy('created_at', 'DESC')
            ->paginate((int) $perPage, 'default', (int) $page);

        $data = [
            "results" => $results,
            "pager" => $this->requestModel->pager,
        ];

        return $data;
    }

    public function getForwardedRequestsPagination($perPage = 10, $page = 1): array
    {

        $results = $this->requestModel
            ->select("requests.*, request_statuses.label AS status, types.label AS type, users.firstName AS firstName, users.lastName AS lastName")
            ->where('status_id', $this->requestStatusController->getRequestStatusByLabel("Forwarded")['id'])
            ->join('request_statuses', 'requests.status_id = request_statuses.id')
            ->join('users', 'requests.created_by = users.id')
            ->join('types', 'requests.type_id = types.id')
            ->orderBy('created_at', 'DESC')
            ->paginate((int) $perPage, 'default', (int) $page);

        $data = [
            "results" => $results,
            "pager" => $this->requestModel->pager,
        ];

        return $data;
    }

    public function getPendingRequestsCount()
    {
        return $this->requestModel->getCountByStatus($this->requestStatusController->getRequestStatusByLabel("Waiting")['id']);
    }

    public function getApprovedRequestsCount()
    {
        return $this->requestModel->getCountByStatus($this->requestStatusController->getRequestStatusByLabel("Validated")['id']);
    }

    public function getRejectedRequestsCount()
    {
        return $this->requestModel->getCountByStatuses(
            [
                $this->requestStatusController->getRequestStatusByLabel("DeclinedByBoss")['id'],
                $this->requestStatusController->getRequestStatusByLabel("DeclinedByManager")['id']
            ]
        );
    }

    public function getForwardedRequestCount()
    {
        return $this->requestModel->getCountByStatus($this->requestStatusController->getRequestStatusByLabel("Forwarded")['id']);
    }


    public function show(int $id)
    {

        $result = $this->requestModel
            ->select('requests.*, request_statuses.label AS status, types.label AS type, users.firstName AS firstName, users.lastName AS lastName')
            ->join('request_statuses', 'requests.status_id = request_statuses.id')
            ->join('users', 'requests.created_by = users.id')
            ->join('types', 'requests.type_id = types.id')
            ->where('requests.id', $id)
            ->first();

        $interactionsResult = $this->interactionController->getInteractionsForRequest($id);
        $result['statusLabel'] = $this->requestStatusController->getStatusLabel($result['status']);
        return view('request/show', [
            'request' => $result,
            'interactions' => $interactionsResult,
        ]);
    }

    public function updateStatus($requestId, $status)
    {
        $this->requestModel->update($requestId, [
            'status_id' => (int) $status['id'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function getWaitingRequests()
    {
        return $this->requestModel
            ->where('status_id', (int) $this->requestStatusController->getRequestStatusByLabel("Waiting")['id'])
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getForwardedRequests()
    {
        return $this->requestModel
            ->where('status_id', (int) $this->requestStatusController->getRequestStatusByLabel("Forwarded")['id'])
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getRequest($id)
    {
        return $this->requestModel->find($id);
    }

    public function getUserRequests($user_id)
    {
        return $this->requestModel
            ->select('requests.*, types.label AS type, request_statuses.label AS status')
            ->join('types', 'types.id = requests.type_id')
            ->join('request_statuses', 'request_statuses.id = requests.status_id')
            ->where('created_by', $user_id)
            ->orderBy('requests.created_at', 'DESC')
            ->findAll();
    }

    public function getUserRequestsPagination($user_id, $perPage, $page)
    {
        $data = [
            'results' => $this->requestModel
                ->select('requests.*, types.label AS type, request_statuses.label AS status')
                ->join('types', 'types.id = requests.type_id')
                ->join('request_statuses', 'request_statuses.id = requests.status_id')
                ->where('created_by', $user_id)
                ->orderBy('requests.created_at', 'DESC')
                ->paginate($perPage, 'default', $page),
            'pager' => $this->requestModel->pager
        ];

        return $data;
    }

    public function addRequest($data)
    {
        return $this->requestModel->save($data);
    }

    public function getInsertedRequest()
    {
        return $this->getRequest($this->requestModel->getInsertID());
    }


    public function validateValues($values)
    {
        return $this->requestModel->validate($values);
    }

    public function getErrors()
    {
        return $this->requestModel->errors();
    }

}

