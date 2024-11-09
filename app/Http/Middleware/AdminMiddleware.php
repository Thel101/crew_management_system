<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
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
        $role = trim(auth()->user()->role);
        Log::info('User Role:', ['role' => $role]); // Log the role

        if (auth()->check() && !in_array(strtolower($role), ['admin', 'staff'])) {
            return redirect(route('user.home'));
        }


        return $next($request);
    }
}
