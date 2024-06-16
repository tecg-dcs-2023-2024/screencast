<?php

/** @var Core\Router $router */

use App\Http\controllers\Auth\AuthenticatedSessionController;
use App\Http\controllers\Auth\RegisteredUserController;

$router->get('/register', [RegisteredUserController::class, 'create'])->only('guest');

$router->post('/register', [RegisteredUserController::class, 'store'])->only('guest')->csrf();

$router->get('/login', [AuthenticatedSessionController::class, 'create'])->only('guest');

$router->post('/login', [AuthenticatedSessionController::class, 'store'])->only('guest')->csrf();

$router->delete('/logout', [AuthenticatedSessionController::class, 'destroy'])->only('auth')->csrf();
