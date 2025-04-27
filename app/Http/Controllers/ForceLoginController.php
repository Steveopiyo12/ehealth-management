<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ForceLoginController extends Controller
{
    /**
     * Show the force login page
     */
    public function showForceLoginPage()
    {
        return view('force-login');
    }
    
    /**
     * Force create/update admin user and login
     */
    public function forceLogin(Request $request)
    {
        // Create or update admin user
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@ehealth.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );
        
        // Log the user in
        Auth::login($adminUser);
        
        return redirect()->route('admin.dashboard')
            ->with('success', 'Admin account reset and logged in successfully.');
    }
}
