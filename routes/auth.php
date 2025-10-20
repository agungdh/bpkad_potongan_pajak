<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/logout', function () {
    session()->invalidate();
    session()->regenerateToken();
});

Route::get('/auth/redirect', function () {
    return Socialite::driver('laravelpassport')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('laravelpassport')->user();

    Session::put('user', $user);

    return redirect('/');
});
