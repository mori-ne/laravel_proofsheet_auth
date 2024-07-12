<?php

use App\Http\Controllers\FormsController;
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
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index')->middleware('auth', 'verified');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show')->middleware('auth', 'verified');

// form
Route::get('/forms', [FormsController::class, 'index'])->name('forms.index')->middleware('auth', 'verified');
Route::get('/forms/create', [FormsController::class, 'create'])->name('forms.create')->middleware('auth', 'verified');

require __DIR__ . '/auth.php';
