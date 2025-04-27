<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisplayValidationErrors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        if ($request->isMethod('POST') && $response->getStatusCode() === 302) {
            // Log submission data for debugging
            \Log::info('Form submission data:', [
                'url' => $request->url(),
                'method' => $request->method(),
                'input' => $request->except(['_token', 'password']),
                'redirect' => $response->headers->get('Location')
            ]);
        }

        // Set some debugging variables in the session
        if ($request->session()->has('errors')) {
            $errors = $request->session()->get('errors')->all();
            \Log::error('Validation errors:', ['errors' => $errors]);
            // Flash validation errors to session with a clear name
            $request->session()->flash('debug_validation_errors', $errors);
        }
        
        return $response;
    }
}
