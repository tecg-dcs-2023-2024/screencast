<?php

namespace App\Http\controllers;

use App\Models\User;
use Core\Auth;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;

class ProfileController
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
    public function edit(): void
    {
        $user = Auth::user();
        view('profile.edit', compact('user'));
    }

    #[NoReturn]
    public function update(): void
    {
        $rules = [
            'name' => 'max:255',
        ];

        if ($_POST['email'] !== Auth::user()->email) {
            $rules['email'] = 'required|email|doesntexists:user,email';
        }

        if (!empty($_POST['password'])) {
            $rules['password'] = 'password';
            $rules['old-password'] = 'required|password_match';
        }

        $data = Validator::check($rules);

        $data = array_filter($data, fn($key) => array_key_exists($key, $rules), ARRAY_FILTER_USE_KEY);

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['old-password']);
        }
        
        $this->user->update(Auth::id(), $data);

        $_SESSION['user'] = $this->user->find(Auth::id());

        Response::redirect('/profile/edit');
    }
}
