<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EnrollmentController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Program routes
Route::resource('programs', ProgramController::class);
// Workaround for direct POST to programs/create
Route::post('/programs/create', [ProgramController::class, 'store'])->name('programs.direct-store');

// Client routes
Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');
Route::resource('clients', ClientController::class);

// Program Registration routes - completely new naming
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
