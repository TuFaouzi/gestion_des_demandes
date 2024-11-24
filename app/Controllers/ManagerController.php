<?php

namespace App\Controllers;

class ManagerController extends BaseController
{
    protected $requestController;
    protected $interactionController;
    protected $requestStatusController;

    public function __construct()
    {
        $this->requestController = new RequestController();
        $this->interactionController = new InteractionController();
        $this->requestStatusController = new RequestStatusController();
    }

    public function index($perPage, $page)
    {
        $pp = $perPage ?? 10;
        $p = $page ?? 1;

        $pendingRequestsCount = $this->requestController->getPendingRequestsCount();
        $approvedRequestsCount = $this->requestController->getApprovedRequestsCount();
        $rejectedRequestsCount = $this->requestController->getRejectedRequestsCount();
        $forwardedRequestsCount = $this->requestController->getForwardedRequestCount();

        return view('manager/index', [
            'perPage' => $pp,
            'page' => $p,
            'pendingRequestsCount' => $pendingRequestsCount,
            'approvedRequestsCount' => $approvedRequestsCount,
            'rejectedRequestsCount' => $rejectedRequestsCount,
            'forwardedRequestsCount' => $forwardedRequestsCount
        ]);
    }

    public function requests()
    {
        $requests = $this->requestController->getWaitingRequests();
        return view('manager/requests', ['requests' => $requests]);
    }

    public function approve($requestId)
    {
        $request = $this->requestController->getRequest($requestId);

        if (!$request) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Request not found');
        }

        $status = $this->requestStatusController->getRequestStatusByLabel('Forwarded');

        $this->requestController->updateStatus($request['id'], $status);

        $this->interactionController->addInteraction($request['id'], $status['id'], "Approuvé par un Responsable");

        return redirect()->to('/')->with('success', 'Request approved successfully');
    }

    public function reject($requestId)
    {
        $request = $this->requestController->getRequest($requestId);

        if (!$request) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Request not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $comment = $this->request->getPost('comment');

            $status = $this->requestStatusController->getRequestStatusByLabel('DeclinedByManager');

            $this->requestController->updateStatus($request['id'], $status);

            $this->interactionController->addInteraction($request['id'], $status['id'], $comment);

            return redirect()->to('/')->with('success', 'Request rejected successfully');
        }

        return view('manager/reject', ['requestId' => $requestId]);
    }

}
