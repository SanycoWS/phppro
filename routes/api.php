<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TelegramController;
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
Route::get('swagger', function () {
    return response()->file(public_path() . 'swagger.json');
});

Route::get('download/{file}', [FileDownloadController::class, 'index']);
Route::post('telegram', [TelegramController::class, 'index']);

Route::get('bookIterator', [BookController::class, 'indexIterator'])->middleware();
Route::get('bookModel', [BookController::class, 'indexModel']);
Route::apiResource('book', BookController::class);
Route::middleware(["auth:api"])->group(
    function () {
    }
);
Route::post('login', [UserController::class, 'login']);
Route::get('payment/makePayment/{system}', [PaymentController::class, 'createPayment']);
Route::post('payment/confirm/{system}', [PaymentController::class, 'confirmPayment']);
