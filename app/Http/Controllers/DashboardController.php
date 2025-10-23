<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $parts = explode('.', passport()['access_token']);
        if (count($parts) === 3) {
            $payload = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);
            $jti = $payload['jti'] ?? null;
        } else {
            $jti = null;
        }

        dd([
            'passport' => passport(),
            'user' => user(),
            'jti' => $jti,
        ]);
    }
}
