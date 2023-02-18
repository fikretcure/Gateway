<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| SERVICE Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::fallback(function () {
    $url = 'http://' . request()->path();
    $method = request()->method();
    $response = Http::withHeaders([
        'bearer' => request()->header("bearer"),
        'refresh' => request()->header("refresh")
    ])->$method($url, request()->all());
    return response()->json($response->json(), $response->status());
});
