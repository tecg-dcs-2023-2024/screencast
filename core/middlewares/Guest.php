<?php

namespace Core\Middlewares;

use Core\Response;

class Guest implements \Core\Contracts\Middleware
{
    public function handle(): void
    {
        if (isset($_SESSION['user']) && $_SESSION['user']) {
            Response::redirect('/jiris');
        }
    }
}