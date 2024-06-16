<?php

namespace App\Http\controllers;

use JetBrains\PhpStorm\NoReturn;

class ProfileController
{
    #[NoReturn]
    public function show(): void
    {
        view('profile.show');
    }
}
