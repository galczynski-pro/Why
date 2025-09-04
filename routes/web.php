<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; // Dodane
use App\Http\Controllers\PersonaController;

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

// Trasa dla strony głównej (landing page) - wywołanie kontrolera HomeController
Route::get('/', [HomeController::class, 'index'])->name('welcome'); // Używamy HomeController

// Trasa dla panelu użytkownika (dashboard) - wymaga autoryzacji i weryfikacji email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Trasy dla zarządzania profilem użytkownika - wymagają autoryzacji
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dołączamy trasy autoryzacji (rejestracja, logowanie, reset hasła)
require __DIR__.'/auth.php';

// Proste API do pobrania persony (read-only)
Route::get('/api/persona/{key}', [PersonaController::class, 'show']);
