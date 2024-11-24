<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $managerController = new ManagerController();
        $bossController = new BossController();
        $employeeController = new EmployeeController();
        $adminController = new AdminController();
        $role = session()->get('role');
        // Redirect to a specific dashboard view based on the role
        switch ($role) {
            case 'Admin':
                return $adminController->index($this->request->getGet('perPage'), $this->request->getGet('page'));
            case 'Boss':
                return $bossController->index($this->request->getGet('perPage'), $this->request->getGet('page'));
            case 'Manager':
                return $managerController->index($this->request->getGet('perPage'), $this->request->getGet('page'));
            case 'Employee':
                return $employeeController->index($this->request->getGet('perPage'), $this->request->getGet('page'));
            default:
                return redirect()->to('/auth/logout'); // Fallback in case of invalid role
        }
    }
}
