<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserPageController;
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
    // 編集
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // 更新
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // 削除
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// projects（そのうちresourceで書き直す）
Route::middleware('auth')->group(function () {
    // 一覧
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    // 検索
    Route::get('projects/search', [ProjectController::class, 'search'])->name('projects.search');
    // 新規作成画面
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // 確認・バリデーション
    Route::post('projects/confirm', [ProjectController::class, 'confirm'])->name('projects.confirm');
    // ストア
    Route::post('/project', [ProjectController::class, 'store'])->name('projects.store');
    // 詳細
    Route::get('projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    // 編集
    Route::get('projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    // 編集の適用
    Route::put('projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    // 削除
    Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    // 公開・非公開の切り替え
    Route::post('projects/{id}', [ProjectController::class, 'toggleStatus'])->name('projects.toggle');
    // 複製
    Route::post('projects/duplicate/{id}', [ProjectController::class, 'duplicate'])->name('projects.duplicate');
});

// forms（そのうちresourceで書き直す）
Route::middleware('auth')->group(function () {
    // 一覧
    Route::get('forms', [FormController::class, 'index'])->name('forms.index');
    // 新規作成画面
    Route::get('forms/create', [FormController::class, 'create'])->name('forms.create');
    // ストア処理
    Route::post('forms', [FormController::class, 'store'])->name('forms.store');
    // 詳細
    Route::get('forms/{id}', [FormController::class, 'show'])->name('forms.show');
    // 編集
    Route::get('forms/edit/{id}', [FormController::class, 'edit'])->name('forms.edit');
    // 編集の適用
    Route::put('forms/update/{id}', [FormController::class, 'update'])->name('forms.update');
    // 削除
    Route::delete('forms/{id}', [FormController::class, 'destroy'])->name('forms.destroy');
    // 全て削除
    Route::post('forms/{project_id}', [FormController::class, 'destroyAll'])->name('forms.destroyAll');
    // 複製
    Route::post('forms/duplicate/{id}', [FormController::class, 'duplicate'])->name('forms.duplicate');
});

// userpage (UUID)
Route::get('userpage/{uuid}', [UserPageController::class, 'index'])->name('posts.index');

require __DIR__ . '/auth.php';
