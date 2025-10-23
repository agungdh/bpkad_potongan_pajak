<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(Request $request) {
        return redirect($request->url)->with('success', 'Login berhasil. Selamat datang !!!');
    }

    public function redirect()
    {
        return Socialite::driver('laravelpassport')->redirect();
    }

    public function callback(Request $request)
    {
        $request->session()->regenerate();

        $request->session()->save();

        $passport = Socialite::driver('laravelpassport');
        $user = $passport->user();

        DB::table('sessions')->where('id', $request->session()->getId())->update([
            'user_uuid' => $user['uuid'],
        ]);

        Session::put('passport', $user->accessTokenResponseBody);
        Session::put('user', $user);

        $url = $request->session()->get('url.intended', route('dashboard', absolute: true));

        $parts = explode('.', passport()['access_token']);
        if (count($parts) === 3) {
            $payload = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);
            $jti = $payload['jti'] ?? null;
        } else {
            $jti = null;
        }
        $jti = Crypt::encryptString($jti);

        return redirect(config('services.laravelpassport.host') . '/redirect?jti='.$jti.'&redirect_to=' . $url);
    }

    public function logout(): RedirectResponse
    {
        Session::invalidate();
        Session::regenerateToken();

        return redirect(config('services.laravelpassport.host') . '/logout?redirect_to=' . config('app.url'));
    }
}
