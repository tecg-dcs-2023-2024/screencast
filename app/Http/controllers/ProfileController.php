<?php

namespace App\Http\controllers;

use JetBrains\PhpStorm\NoReturn;

class ProfileController
{
    #[NoReturn]
    public function edit(): void
    {
        view('profile.edit');
    }
}
