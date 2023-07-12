<?php

use App\Http\Controllers\Test2Controller;
use App\Http\Controllers\Test3Controller;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', [TestController::class, 'index']);
Route::get('/test2', [Test2Controller::class, 'newIndex']);
Route::get('/test3', Test3Controller::class);
