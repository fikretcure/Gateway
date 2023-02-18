<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticationMiddleware;
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
Route::middleware(AuthenticationMiddleware::class)->group(function () {


});

/**
 * Middleware Controller İçinde Verildi
 */
Route::apiResource('users', UserController::class);

Route::post("users/login", [UserController::class, "login"])->name("users.login");

