<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    dd(user());
});

Route::get('/auth', function () {
    dd(user());
})->middleware('auth');

require __DIR__.'/auth.php';
