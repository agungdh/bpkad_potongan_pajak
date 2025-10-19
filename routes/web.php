<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/callback', function (Request $request) {
    $state = $request->session()->pull('state');

    $codeVerifier = $request->session()->pull('code_verifier');

    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
    );

    $response = Http::asForm()->post(env('SSO_URL') . '/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('SSO_CLIENT_ID'),
        'redirect_uri' => env('APP_URL') . '/auth/callback',
        'code_verifier' => $codeVerifier,
        'code' => $request->code,
    ]);

    $json = $response->json();

    $response = Http::acceptJson()->withToken($json['access_token'])->get(env('SSO_URL') . '/api/user');

    return $response->json();
});

Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    $request->session()->put(
        'code_verifier', $codeVerifier = Str::random(128)
    );

    $codeChallenge = strtr(rtrim(
        base64_encode(hash('sha256', $codeVerifier, true))
        , '='), '+/', '-_');

    $query = http_build_query([
        'client_id' => env('SSO_CLIENT_ID'),
        'redirect_uri' => env('APP_URL'). '/auth/callback',
        'response_type' => 'code',
//        'scope' => 'user:read',
        'state' => $state,
        'code_challenge' => $codeChallenge,
        'code_challenge_method' => 'S256',
         'prompt' => '', // "none", "consent", or "login"
    ]);

    return redirect(env('SSO_URL') . '/oauth/authorize?'.$query);
});
