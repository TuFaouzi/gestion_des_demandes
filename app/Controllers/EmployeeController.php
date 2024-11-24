<?php

namespace App\Controllers;

class EmployeeController extends BaseController
{
    protected $interactionController;
    protected $requestStatusController;
    protected $requestController;
    protected $typeController;

    public function __construct()
    {
        $this->interactionController = new InteractionController();
        $this->requestStatusController = new RequestStatusController();
        $this->requestController = new RequestController();
        $this->typeController = new TypeController();
    }

    public function requests()
    {
        $user_id = session()->get('user_id');
        $requests = $this->requestController->getUserRequests($user_id);
        return view('employee/requests', ['requests' => $requests]);
    }

    public function index($perPage, $page) {
        $pp = $perPage ?? 10;
        $p = $page ?? 1;
        return view('employee/index', ['perPage' => $pp, 'page' => $p]);
    }

    public function getUserConnectedRequestsPagination($perPage = 10, $page = 1) {

        $user_id = session()->get('user_id');
        
        return $this->requestController->getUserRequestsPagination($user_id, $perPage, $page);

    }


    public function addRequest()
    {
        helper(['form']);
        if ($this->request->getMethod() === 'POST') {

            $waitingStatus = $this->requestStatusController->getRequestStatusByLabel('Waiting');

            $data = [
                'title' => $this->request->getPost('title'),
                'type_id' => $this->request->getPost('type_id'),
                'comment' => $this->request->getPost('comment'),
                'created_by' => session()->get('user_id'),
                'status_id' => $waitingStatus['id'],
            ];


            $errors = [];
            // Validate data
            if (!$this->requestController->validateValues($data) && !$this->interactionController->validateValues($data)) {
                array_push($errors, $this->requestController->getErrors());
                array_push($errors, $this->interactionController->getErrors());
                return redirect()->back()->withInput()->with('errors', $errors);
            }

            
            $savedRequest = $this->requestController->addRequest($data);

            $savedInteraction = $this->interactionController->addInteraction($this->requestController->getInsertedRequest()['id'], $waitingStatus['id'], $data['comment']);

            if ($savedInteraction && $savedRequest) {
                return redirect()->to('/')->with('success', 'Request added successfully!');
            }

            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $types = $this->typeController->getAllTypes();

        return view('employee/add-request', ['types' => $types]);
    }
}
