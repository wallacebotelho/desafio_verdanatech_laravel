<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tickets', TicketController::class)->except(['show', 'update', 'destroy']);

    Route::get('tickets', [TicketController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::post('login', [AuthController::class, 'login']);