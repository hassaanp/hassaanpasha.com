<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY'); // Assuming the key is sent in a header

        $validApiKey = config('api.admin_api_key');

        if ($apiKey !== $validApiKey) {
            return response()->json(['error' => 'Invalid API Key'], 401);
        }

        return $next($request);
    }
}
