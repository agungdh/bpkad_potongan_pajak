<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/redirect', [AuthController::class, 'redirect']);
Route::get('/auth/callback', [AuthController::class, 'callback']);
Route::get('/logout', [AuthController::class, 'logout']);
