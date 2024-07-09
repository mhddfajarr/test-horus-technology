<?php

use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\VoucherClaimController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('vouchers', VoucherController::class);
Route::get('AllVouchers', [VoucherController::class, 'all']);
Route::apiResource('users', UserController::class);
Route::apiResource('vouchersClaim', VoucherClaimController::class);