<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/redirect', function () {
    return Socialite::driver('laravelpassport')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('laravelpassport')->user();

    dd($user);
});
