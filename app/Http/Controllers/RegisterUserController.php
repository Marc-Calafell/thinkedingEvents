<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;

class RegisterUserController extends Controller
{
    public function registerUser()
    {
        $user = new \App\User();
        $user->name = 'Ramon Zampón';
        $user->email = 'manelgavalda@gmail.com';
        event(new Registered($user));
        dump("Done!");
    }
}
