<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('laravelpassport')->redirect();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function callback()
    {
        $user = Socialite::driver('laravelpassport')->user();

        $driver = Session::getDrivers()[Session::getDefaultDriver()];
        $dbId = $driver->getId();
        DB::table('sessions')->where('id', $dbId)->update([
           'user_uuid' => $user['uuid'],
        ]);

        Session::put('user', $user);

        return redirect('/');
    }

    public function logout(): void
    {
        Session::invalidate();
        Session::regenerateToken();
    }
}
