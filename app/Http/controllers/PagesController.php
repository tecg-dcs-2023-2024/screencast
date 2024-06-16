<?php

namespace App\Http\controllers;

use JetBrains\PhpStorm\NoReturn;

class PagesController
{
    #[NoReturn]
    public function home(): void
    {
        view('pages.home');
    }
}
