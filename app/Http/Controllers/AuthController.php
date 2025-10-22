<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('laravelpassport')->redirect();
    }

    public function callback(Request $request)
    {
        $request->session()->regenerate();

        $request->session()->save();

        $user = Socialite::driver('laravelpassport')->user();

        DB::table('sessions')->where('id', $request->session()->getId())->update([
            'user_uuid' => $user['uuid'],
        ]);

        Session::put('user', $user);

        return redirect()->intended(route('dashboard', absolute: false))->with('success', 'Login berhasil. Selamat datang !!!');
    }

    public function logout(): RedirectResponse
    {
        Session::invalidate();
        Session::regenerateToken();

        return redirect(config('services.laravelpassport.host') . '/logout?redirect_to=' . config('app.url'));
    }
}
