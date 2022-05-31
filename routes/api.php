<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;

/* Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']); */
     

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('api-products', ProductApiController::class)->only(['index','show']);

Route::apiResource('api-orders', OrderApiController::class)->only(['index','show']);