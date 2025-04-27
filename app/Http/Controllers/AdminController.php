<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        // If admin is already logged in, redirect to dashboard
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }
    
    /**
     * Handle the admin login attempt
     */
    public function login(Request $request)
    {
        // Dump login attempt for debugging
        \Log::info('Login attempt with email: ' . $request->email);
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Log the credentials being used (without password)
        \Log::info('Attempting login with email: ' . $credentials['email']);
        
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Check if user is an admin
            if (Auth::user()->isAdmin()) {
                \Log::info('Admin login successful for: ' . $credentials['email']);
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            
            // Logout if not an admin
            \Log::info('User not admin: ' . $credentials['email']);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return back()->withErrors([
                'email' => 'You do not have admin privileges.',
            ])->onlyInput('email');
        }
        
        \Log::error('Authentication failed for: ' . $credentials['email']);
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }
    
    /**
     * Show the admin dashboard
     */
    public function dashboard()
    {
        $clientCount = \App\Models\Client::count();
        $programCount = \App\Models\Program::count();
        $enrollmentCount = \App\Models\Enrollment::count();
        
        // Get latest activities
        $recentActivities = \App\Models\Enrollment::with(['client', 'program'])
                                ->latest()
                                ->take(10)
                                ->get();
        
        return view('admin.dashboard', compact(
            'clientCount', 
            'programCount', 
            'enrollmentCount', 
            'recentActivities'
        ));
    }
}
