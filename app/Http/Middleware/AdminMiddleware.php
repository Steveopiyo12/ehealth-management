<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Check if user is logged in and is an admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }
        
        // Redirect to login if not authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'You must login first.');
        }
        
        // Redirect to home if authenticated but not admin
        return redirect()->route('home')
            ->with('error', 'You do not have permission to access this page.');
    }
}
