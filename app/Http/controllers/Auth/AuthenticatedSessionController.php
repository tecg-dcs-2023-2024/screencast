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
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = $this->user->findByEmail($data['email']);

        if($user){
            if(password_verify($data['password'], $user->password)){
                $_SESSION['user'] = $user;
                Response::redirect('/');
            }else{
                $_SESSION['errors']['password'] = 'Wrong password';
                $_SESSION['old'] = $data;
                Response::redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            $_SESSION['errors']['email'] = 'Email does not exist in our database';
            $_SESSION['old'] = $data;
            Response::redirect($_SERVER['HTTP_REFERER']);
        }
    }
}