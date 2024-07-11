<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// index
Route::get('/', function () {
    return view('welcome');
});

// dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// project（そのうちresourceで書き直す）
Route::get('/project', [ProjectController::class, 'index'])->name('project.index')->middleware('auth', 'verified');
Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show')->middleware('auth', 'verified');

// form
Route::get('/form', function () {
    return view('form');
})->middleware(['auth', 'verified'])->name('form');

require __DIR__ . '/auth.php';
