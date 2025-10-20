<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('laravelpassport')->redirect();
    }

    public function callback() {
        $user = Socialite::driver('laravelpassport')->user();

        Session::put('user', $user);

        return redirect('/');
    }

    public function logout(): void {
        Session::invalidate();
        Session::regenerateToken();
    }
}
