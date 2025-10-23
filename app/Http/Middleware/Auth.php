<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws ConnectionException
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Session::get('user')) {
            return redirect('/auth/redirect');
        }

        $baseUrl = config('services.laravelpassport.host');

        $response = Http::acceptJson()->withToken(passport()['access_token'])->get("$baseUrl/api");

        if ($response->failed()) {
            if ($response->unauthorized()) {
                return redirect('/auth/redirect');
            } else {
                $data = $response->json();

                $message = data_get($data, 'message', 'Unknown error');
                throw new Exception("{$response->status()}: {$message}");
            }
        }

        return $next($request);
    }
}
