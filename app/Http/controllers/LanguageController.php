<?php

namespace App\Http\controllers;

use App\Models\User;
use Core\Auth;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;

class LanguageController
{
    #[NoReturn]
    public function update(): void
    {
        $data = Validator::check([
            'language' => 'required|lang',
        ]);

        $preferences = json_decode($_SESSION['user']->preferences, false);
        $preferences->language = $data['language'];
        $_SESSION['user']->preferences = json_encode($preferences);

        $user = new User(base_path('.env.local.ini'));
        $user->update(Auth::id(), ['preferences' => $_SESSION['user']->preferences]);

        Response::redirect($_SERVER['HTTP_REFERER']);
    }
}
