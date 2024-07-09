<?php

use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('vouchers', VoucherController::class);

Route::apiResource('users', UserController::class);