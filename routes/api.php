<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('book', BookController::class);
Route::middleware(["auth:api"])->group(
    function () {
        Route::get('payment/makePayment/{system}', [PaymentController::class, 'createPayment']);
        Route::get('payment/confirm/{system}', [PaymentController::class, 'confirmPayment']);
    }
);
Route::post('login', [UserController::class, 'login']);
