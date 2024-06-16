<?php

namespace App\Http\controllers\Auth;

use App\Models\User;
use Core\Auth;
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
            exit($exception->getMessage());
        }
    }

    public function create(): void
    {
        view('auth.login.create');
    }

    #[NoReturn]
    public function store(): void
    {
        $data = Validator::check([
            'email' => 'required|email|exists:user,email',
            'password' => 'required|password',
        ]);

        if (isset($_POST['remember'])) {
            $data['remember'] = true;
        }

        Auth::attempt($data);
    }

    #[NoReturn]
    public function destroy(): void
    {
        $this->user->update(Auth::id(), ['remember_token' => null]);

        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 42000);
        }

        if (isset($_COOKIE['email'])) {
            setcookie('email', '', time() - 42000);
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        Response::redirect('/login');
    }
}
