<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PostUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// postuser (UUID)
Route::get('/postuser/{uuid}', [PostUserController::class, 'index'])->name('postuser.index');
Route::post('/postuser/{uuid}/login', [PostUserController::class, 'login'])->name('postuser.login');
Route::post('/postuser/{uuid}/logout', [PostUserController::class, 'logout'])->name('postuser.logout');

Route::middleware('auth:postuser')->group(function () {
    Route::get('/postuser/{uuid}/dashboard', [PostUserController::class, 'dashboard'])->name('postuser.dashboard');
});

// 管理ログイン後のみアクセス可
// Route::middleware('auth:posuser')->group(function () {
//     Route::get('/postuser/{uuid}/dashboard', function () {
//         return view('postuser/{uuid}');
//     })->name('postuser.index');
// });
