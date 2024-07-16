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

// projects（そのうちresourceで書き直す）

Route::middleware('auth')->group(function () {
    // 一覧
    Route::get('/projects{query?}', [ProjectController::class, 'index'])->name('projects.index');
    // 新規作成画面
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // 確認・バリデーション
    Route::post('/projects/confirm', [ProjectController::class, 'confirm'])->name('projects.confirm');
    // ストア
    Route::post('/project', [ProjectController::class, 'store'])->name('projects.store');
    // 詳細
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    // 編集
    Route::post('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    // 編集の適用
    Route::put('/projects/edit/{id}', [ProjectController::class, 'update'])->name('projects.update');
    // 削除
    Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    // 公開・非公開の切り替え
    Route::post('projects/{id}', [ProjectController::class, 'toggleStatus'])->name('projects.toggle');
});

// forms（そのうちresourceで書き直す）
Route::get('/forms', [FormsController::class, 'index'])->name('forms.index')->middleware('auth', 'verified');
Route::get('/forms/create', [FormsController::class, 'create'])->name('forms.create')->middleware('auth', 'verified');

require __DIR__ . '/auth.php';
