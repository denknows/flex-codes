<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Codes\App\Http\Controllers\StoreCustomerController;
use Codes\App\Http\Controllers\RetrieveAllCustomerController;
use Codes\App\Http\Controllers\RetrieveCustomerController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/customers', StoreCustomerController::class);
$router->get('/customers', RetrieveAllCustomerController::class);
$router->get('/customers/{id}', RetrieveCustomerController::class);
