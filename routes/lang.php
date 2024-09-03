<?php

/** @var Core\Router $router */

use App\Http\controllers\LanguageController;

$router->patch('/lang', [LanguageController::class, 'update'])->only('auth')->csrf();