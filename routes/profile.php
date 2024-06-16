<?php

use App\Http\controllers\ProfileController;

/** @var Core\Router $router */

$router->get('/profile/edit', [ProfileController::class, 'edit'])->only('auth');