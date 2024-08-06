<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PostUserController;
use Illuminate\Support\Facades\Route;

// index
Route::get('/', function () {
    return view('welcome');
});

// dashboard
Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// profile
Route::middleware('auth:web', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// projects（そのうちresourceで書き直す）
Route::middleware('auth:web', 'verified')->group(function () {
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/search', [ProjectController::class, 'search'])->name('projects.search');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects/confirm', [ProjectController::class, 'confirm'])->name('projects.confirm');
    Route::post('/project', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::post('projects/{id}', [ProjectController::class, 'toggleStatus'])->name('projects.toggle');
    Route::post('projects/duplicate/{id}', [ProjectController::class, 'duplicate'])->name('projects.duplicate');
});

// forms（そのうちresourceで書き直す）
Route::middleware('auth:web', 'verified')->group(function () {
    Route::get('forms', [FormController::class, 'index'])->name('forms.index');
    Route::get('forms/search', [FormController::class, 'search'])->name('forms.search');
    Route::get('forms/create', [FormController::class, 'create'])->name('forms.create');
    Route::post('forms', [FormController::class, 'store'])->name('forms.store');
    Route::get('forms/{id}', [FormController::class, 'show'])->name('forms.show');
    Route::get('forms/edit/{id}', [FormController::class, 'edit'])->name('forms.edit');
    Route::put('forms/update/{id}', [FormController::class, 'update'])->name('forms.update');
    Route::delete('forms/{id}', [FormController::class, 'destroy'])->name('forms.destroy');
    Route::post('forms/{project_id}', [FormController::class, 'destroyAll'])->name('forms.destroyAll');
    Route::post('forms/duplicate/{id}', [FormController::class, 'duplicate'])->name('forms.duplicate');

    // 入力項目エディター
    Route::get('forms/inputs/{form_id}', [FormController::class, 'inputEdit'])->name('forms.inputEdit');
    // 入力項目受取（上手く動かない）
    // Route::post('/forms/inputs/submit/{id}', [FormController::class, 'submit'])->name('forms.submit');
    // Route::get('/forms/inputs/submit/{id}', [FormController::class, 'submit'])->name('forms.submit');
});


require __DIR__ . '/auth.php';
require __DIR__ . '/postuser.php';
