<?php
/** @var Core\Router $router */

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

$router->get('/register', [RegisteredUserController::class, 'create']);

$router->post('/register', [RegisteredUserController::class, 'store'])->csrf();

$router->get('/login', [AuthenticatedSessionController::class, 'create']);

$router->post('/login', [AuthenticatedSessionController::class, 'store'])->csrf();
