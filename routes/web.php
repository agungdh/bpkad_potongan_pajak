<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    $driver = Session::getDrivers()[Session::getDefaultDriver()];
    $dbId = $driver->getId();
    $db = DB::table('sessions')->where('id', $dbId)->firstOrFail();
    dd($db);
    dd(user());
});

Route::get('/auth', function () {
    dd(user());
})->middleware('auth');

require __DIR__.'/auth.php';
