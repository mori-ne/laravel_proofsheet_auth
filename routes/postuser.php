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
use App\Http\Middleware\PostUserRedirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;

// postuser (UUID)
// Route::prefix('postuser')->group(function () {
//     Route::middleware('auth:postuser')->group(function () {
//         Route::get('{uuid}', [PostUserController::class, 'index'])->name('postuser.index');
//         Route::post('{uuid}/login', [PostUserController::class, 'login'])->name('postuser.login');
//         Route::get('{uuid}/dashboard', [PostUserController::class, 'dashboard'])->name('postuser.dashboard');
//     });
// });
Route::prefix('/postuser/{uuid}')->group(function () {
    Route::get('/', [PostUserController::class, 'index'])->name('postuser.index');
    Route::post('login', [PostUserController::class, 'login'])->name('postuser.login');
    Route::post('logout', [PostUserController::class, 'logout'])->name('postuser.logout');

    Route::get('signup', [PostUserController::class, 'signup'])->name('postuser.signup');
    Route::get('signup/send', function () {
        abort(404);
    });
    Route::post('signup/send', [PostUserController::class, 'verifyMailSignup'])->name('postuser.verifymailsignup');
    Route::get('verify/{token}', [PostUserController::class, 'verifiedMailSignup'])->name('postuser.verifiedmailsignup');
    Route::put('store', [PostUserController::class, 'store'])->name('postuser.store');

    // auth:postuser
    Route::middleware('auth:postuser')->group(function () {
        Route::get('dashboard', [PostUserController::class, 'dashboard'])->name('postuser.dashboard');
    });
});
