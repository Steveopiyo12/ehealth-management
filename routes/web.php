<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect the root URL to the admin dashboard or login page
Route::get('/', function() {
    // Check if user is logged in and is admin
    if (Auth::check() && Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    
    // Otherwise redirect to admin login
    return redirect()->route('admin.login');
})->name('root');

// Define unprotected routes (login routes)
Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.submit');

// Force login routes - use these if you have trouble with the admin login
Route::get('/force-login', [App\Http\Controllers\ForceLoginController::class, 'showForceLoginPage'])->name('force-login.form');
Route::post('/force-login', [App\Http\Controllers\ForceLoginController::class, 'forceLogin'])->name('force-login');

// All protected routes - only accessible when authenticated as admin
Route::middleware(['admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    
    // Home route for internal redirects
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Program routes
    Route::resource('programs', ProgramController::class);
    Route::post('/programs/create', [ProgramController::class, 'store'])->name('programs.direct-store');
    
    // Client routes
    Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');
    Route::resource('clients', ClientController::class);
    
    // Program Registration routes
    Route::get('/register-program', [EnrollmentController::class, 'showRegistrationForm'])->name('program.register.form');
    Route::post('/register-program', [EnrollmentController::class, 'processRegistration'])->name('program.register.process');
    Route::get('/program-registrations', [EnrollmentController::class, 'registrationsList'])->name('program.registrations');
    Route::get('/program-registrations/{enrollment}', [EnrollmentController::class, 'registrationDetails'])->name('program.registration.details');
    Route::get('/program-registrations/{enrollment}/modify', [EnrollmentController::class, 'editRegistration'])->name('program.registration.edit');
    Route::put('/program-registrations/{enrollment}', [EnrollmentController::class, 'updateRegistration'])->name('program.registration.update');
    Route::delete('/program-registrations/{enrollment}', [EnrollmentController::class, 'removeRegistration'])->name('program.registration.delete');
    
    // API-like routes for AJAX requests
    Route::get('/api/clients/{client}/info', [EnrollmentController::class, 'getClientInfo'])->name('api.clients.info');
    Route::get('/api/programs/{program}/info', [EnrollmentController::class, 'getProgramInfo'])->name('api.programs.info');
});

// These routes have been reorganized above
