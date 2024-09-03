<?php

namespace Core;

use App\Models\User;
use JetBrains\PhpStorm\NoReturn;
use Random\RandomException;

class Auth
{
    static private User $user;

    #[NoReturn]
    public static function attempt(array $credentials): void
    {
        static::$user = new User(base_path('.env.local.ini'));
        $user_data = static::$user->findByEmail($credentials['email']);

        if (password_verify($credentials['password'], $user_data->password)) {
            if (isset($credentials['remember'])) {
                self::remember($user_data);
            }
            $_SESSION['user'] = $user_data;
            Response::redirect('/jiris');
        }

        $_SESSION['errors']['password'] = 'Le mot de passe ne correspond pas à l’email fourni';
        $_SESSION['old'] = $credentials;
        Response::redirect('/login');
    }

    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function id()
    {
        return $_SESSION['user']->id;
    }

    public static function user()
    {
        return $_SESSION['user'];
    }

    private static function generateRememberToken(): string
    {
        try {
            return bin2hex(random_bytes(50));
        } catch (RandomException $e) {
            return '';
        }
    }

    private static function remember(bool|\stdClass $user_data): void
    {
        $token = self::generateRememberToken();
        $user_data->remember_token = $token;
        static::$user->update($user_data->id, ['remember_token' => $token]);
        $expires = time() + 60 * 60 * 24 * 15;
        setcookie('remember_token', $token, $expires);
        setcookie('email', $user_data->email, $expires);
    }
}
