<?php

use App\Http\controllers\ProfileController;

/** @var Core\Router $router */

$router->get('/profile', [ProfileController::class, 'show'])->only('auth');