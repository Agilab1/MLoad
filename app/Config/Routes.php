<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'DashboardController::index');
$routes->get('/', 'DashboardController::index');
$routes->get('/dashboard', 'DashboardController::index');

$routes->get('machine-loading/create', 'MachineLoadingController::create');
$routes->post('machine-loading/store', 'MachineLoadingController::store');

$routes->group('machine', function ($routes) {
    $routes->get('/', 'MachineController::index');
    $routes->get('create', 'MachineController::create');
    $routes->post('store', 'MachineController::store');
});

$routes->group('order', function ($routes) {
    $routes->get('/', 'OrderController::index');
    $routes->get('create', 'OrderController::create');
    $routes->post('store', 'OrderController::store');
});

$routes->group('loading', function ($routes) {
    $routes->get('/', 'LoadingController::index');
    $routes->get('create', 'LoadingController::create');
    $routes->post('store', 'LoadingController::store');
});
