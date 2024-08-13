<?php

// use Illuminate\Http\Request;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::get('/address/{zipcode}', [AddressController::class, 'getAddress']);
