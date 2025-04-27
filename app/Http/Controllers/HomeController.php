<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Program;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get counts for dashboard widgets - force fresh data without caching
        $clientCount = Client::count();
        
        // Count all programs, not just active ones, to match what's in the system
        $programCount = Program::count(); // Changed to count all programs
        
        // Force a fresh count of enrollments
        $enrollmentCount = Enrollment::count();
        
        // Get recent clients
        $recentClients = Client::latest()->take(5)->get();
        
        // Get recent activities (enrollments)
        $recentActivities = Enrollment::with(['client', 'program'])
                             ->latest()
                             ->take(5)
                             ->get();
                             
        // Make sure we're not caching any of this data
        $timestamp = now()->format('Y-m-d H:i:s');
        
        return view('home', compact(
            'clientCount', 
            'programCount', 
            'enrollmentCount', 
            'recentClients', 
            'recentActivities',
            'timestamp'
        ));
    }
}
