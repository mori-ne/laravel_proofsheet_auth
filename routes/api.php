<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/address/{zipcode}', [AddressController::class, 'getAddress']);
