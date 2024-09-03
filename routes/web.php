<?php

use App\Http\controllers\PagesController;

/** @var Core\Router $router */
$router->get('/', [PagesController::class, 'home'])->only('guest');

require __DIR__.'/jiri.php';
require __DIR__.'/attendance.php';
require __DIR__.'/contact.php';
require __DIR__.'/auth.php';
require __DIR__.'/lang.php';
require __DIR__.'/profile.php';
