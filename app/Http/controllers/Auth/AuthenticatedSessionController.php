<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;

class AuthenticatedSessionController
{
    private User $user;

    public function __construct()
    {
        try {
            $this->user = new User(base_path('.env.local.ini'));
        } catch (FileNotFoundException $exception) {
            die($exception->getMessage());
        }
    }

    public function create(): void
    {
        view('auth.login.create');
    }

    #[NoReturn] public function store(): void
    {
        $data = Validator::check([
            'email' => 'required|email|exists:user,email',
            'password' => 'required|password',
        ]);

        if (password_verify($data['password'], $_SESSION['user']->password)) {
            Response::redirect('/');
        } else {
            $_SESSION['errors']['password'] = 'Le mot de passe ne correspond pas à l’email fourni';
            $_SESSION['old'] = $data;
            unset($_SESSION['user']);
            Response::redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function destroy(): void
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
        Response::redirect('/login');
    }
}