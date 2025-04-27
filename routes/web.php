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
Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs.create');
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::get('/clients/enroll', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');
Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
