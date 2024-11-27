<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class BossController extends BaseController
{
    protected $requestController;
    protected $interactionController;
    protected $requestStatusController;
    protected $userController;


    public function __construct()
    {
        $this->requestController = new RequestController();
        $this->interactionController = new InteractionController();
        $this->requestStatusController = new RequestStatusController();
        $this->userController = new UsersController();
    }
    public function index($perPage, $page) {
        $pp = $perPage ?? 10;
        $p = $page ?? 1;
        
        $pendingRequestsCount = $this->requestController->getPendingRequestsCount();
        $approvedRequestsCount = $this->requestController->getApprovedRequestsCount();
        $rejectedRequestsCount = $this->requestController->getRejectedRequestsCount();
        $forwardedRequestsCount = $this->requestController->getForwardedRequestCount();

        return view('boss/index', [
            'perPage' => $pp, 
            'page' => $p,
            'pendingRequestsCount' => $pendingRequestsCount,
            'approvedRequestsCount' => $approvedRequestsCount,
            'rejectedRequestsCount' => $rejectedRequestsCount,
            'forwardedRequestsCount' => $forwardedRequestsCount,
            'user' => $this->userController->findUserById(session()->get('user_id'))
        ]);
    }

    public function approve($requestId)
    {
        $request = $this->requestController->getRequest($requestId);

        if (!$request) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Request not found');
        }

        $validatedStatus = $this->requestStatusController->getRequestStatusByLabel('Validated');

        if (!$validatedStatus) {
            return redirect()->to('/boss/requests')->with('error', 'Status "Validated" not found.');
        }
        
        $this->requestController->updateStatus($request['id'], $validatedStatus);

        $this->interactionController->addInteraction($request['id'], $validatedStatus['id'], "Approuvé par le Manager");

        return redirect()->to('/')->with('success', 'Request approved successfully.');
    }

    public function declineForm($requestId)
    {
        $request = $this->requestController->getRequest($requestId);

        if (!$request) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Request not found');
        }

        return view('boss/decline', ['requestId' => $requestId, 'user' => $this->userController->findUserById(session()->get('user_id'))]);
    }

    public function decline($requestId)
    {
        $request = $this->requestController->getRequest($requestId);

        if (!$request) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Request not found');
        }

        $comment = $this->request->getPost('comment');

        $declinedStatus = $this->requestStatusController->getRequestStatusByLabel('DeclinedByBoss');

        if (!$declinedStatus) {
            return redirect()->to("/boss/decline/{$requestId}")
                ->with('error', 'Status "DeclinedByBoss" not found.')
                ->withInput();
        }

        $this->requestController->updateStatus($request['id'], $declinedStatus);

        $this->interactionController->addInteraction($request['id'], $declinedStatus['id'], $comment);

        return redirect()->to('/')->with('success', 'Request declined successfully.');
    }

    public function showRequest(int $id) {
        return view('boss/showRequest', ['id' => $id, 'user' => $this->userController->findUserById(session()->get('user_id'))]);
    }

}
