<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthSession
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
        $baseUrl = config('kepegawaian.url');
        $response = Http::acceptJson()->get("$baseUrl/user");

        if ($response->failed()) {
            if ($response->unauthorized()) {
                dd('harus login');
            } else {
                $data = $response->json();

                $message = data_get($data, 'message', 'Unknown error');
                throw new Exception("{$response->status()}: {$message}");
            }
        }

        return $next($request);
    }
}
