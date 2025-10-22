<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('laravelpassport')->redirect();
    }

    public function callback()
    {
        $db = Session::getDrivers()[Session::getDefaultDriver()];
        dd($db);
        $user = Socialite::driver('laravelpassport')->user();

        Session::put('user', $user);

        return redirect('/');
    }

    public function logout(): void
    {
        Session::invalidate();
        Session::regenerateToken();
    }
}
