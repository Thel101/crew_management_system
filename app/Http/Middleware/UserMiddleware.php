<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = trim(auth()->user()->role);
        Log::info('User Role:', ['role' => $role]);

        if (auth()->check() && auth()->user()->role != 'user') {
            return redirect(route('dashboard'));
        }
        return $next($request);
    }
}
