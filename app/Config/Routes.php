<?php

use App\Controllers\RequestController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default page
$routes->get('/', 'DashboardController::index', ['filter' => 'auth']);
// $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Login
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::login');

// Logout
$routes->get('/logout', 'AuthController::logout');

$routes->group('request', ['filter' => 'auth'], function ($routes) {
    $routes->get('(:num)', 'RequestController::show/$1');
});

// Admin routes
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('users', 'AdminController::users');
    $routes->get('add-user', 'AdminController::addUser');
    $routes->post('add-user', 'AdminController::addUser');
});


// Employee routes
$routes->group('employee', ['filter' => 'employee'], function ($routes) {
    $routes->get('request/(:num)', 'EmployeeController::showRequest/$1');
    $routes->get('requests', 'EmployeeController::requests');
    $routes->get('add-request', 'EmployeeController::addRequest');
    $routes->post('add-request', 'EmployeeController::addRequest');
});

// Manager routes
$routes->group('manager', ['filter' => 'manager'], function ($routes) {
    $routes->get('request/(:num)', 'ManagerController::showRequest/$1');
    $routes->get('requests', 'ManagerController::requests');
    $routes->get('approve/(:num)', 'ManagerController::approve/$1');
    $routes->get('reject/(:num)', 'ManagerController::reject/$1');
    $routes->post('reject/(:num)', 'ManagerController::reject/$1');
});

// Boss routes
$routes->group('boss', ['filter' => 'boss'], function ($routes) {
    $routes->get('request/(:num)', 'BossController::showRequest/$1');
    $routes->get('requests', 'BossController::requests');
    $routes->get('approve/(:num)', 'BossController::approve/$1');
    $routes->get('decline/(:num)', 'BossController::declineForm/$1');
    $routes->post('decline/(:num)', 'BossController::decline/$1');
});


