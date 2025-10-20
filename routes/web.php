<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //    if (! session()->get('user')) {
    //        return redirect('/auth/redirect');
    //    }
    //    dd(user());

    return session()->all();
});

require __DIR__.'/auth.php';
