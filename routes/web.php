<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
//    dd(Session::getDrivers());
    dd(Session::getDrivers()[Session::getDefaultDriver()]);
    $session = DB::table('sessions')->where('id', Session::getId())->first();
    dd($session);
    dd(user());
});

Route::get('/auth', function () {
    dd(user());
})->middleware('auth');

require __DIR__.'/auth.php';
