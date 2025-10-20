<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return session()->all();
});

Route::get('/auth', function () {
    return session()->all();
})->middleware('auth');

require __DIR__.'/auth.php';
