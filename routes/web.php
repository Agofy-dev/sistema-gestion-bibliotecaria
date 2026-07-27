<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController; // <--- 1. Agregado
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

App::setLocale('es');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// <--- 2. Agregado: Rutas del CRUD para el Administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';