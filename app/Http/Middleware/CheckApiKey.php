<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->query('api_key');

        if ($apiKey !== '12345') {
            return response()->json([
                'message' => 'Invalid API Key'
            ], 403);
        }

        return $next($request);
    }
}
