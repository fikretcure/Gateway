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
    Route::apiResources([
        'users' => UserController::class,
    ]);
});


Route::get("test", function () {
    return request()->server("SERVER_ADDR");
//    return request()->server("HTTP_USER_AGENT");
//    return request()->server("REMOTE_ADDR");
});

