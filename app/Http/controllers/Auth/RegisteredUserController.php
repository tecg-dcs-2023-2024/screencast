<?php

namespace App\Http\controllers\Auth;

use App\Models\User;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;

class RegisteredUserController
{
    private User $user;

    public function __construct()
    {
        try {
            $this->user = new User(base_path('.env.local.ini'));
        } catch (FileNotFoundException $exception) {
            exit($exception->getMessage());
        }
    }

    #[NoReturn]
    public function store(): void
    {
        $data = Validator::check([
            'email' => 'required|email|doesntexists:user,email',
            'password' => 'required|password',
        ]);

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['preferences'] = json_encode(['language' => CURRENT_LANGUAGE]);

        if ($this->user->create($data)) {
            Response::redirect('/login');
        } else {
            Response::abort(Response::SERVER_ERROR);
        }
    }

    public function create(): void
    {
        view('auth.register.create');
    }
}
