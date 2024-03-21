<?php

namespace App\Http\Middleware;

use App\Http\Responses\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');

        if ($apiKey != env('API_KEY')) {
            $response = new ApiResponse(false, 'Invalid API key.');
            return response()->json($response, 401);
        }
        // if ($request->api_token != env('API_KEY')) {
        //     return response()->json('Unauthorized', 401);
        // }

        return $next($request);
    }
}
