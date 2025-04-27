<?php

use App\Http\Controllers\Api\ApiTokenController;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return response()->json(['message' => 'Hello World!']);
})->middleware(['auth:sanctum']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/log/all', [LogController::class, 'findAll'])->name('log.all');
    Route::get('/log/{id}', [LogController::class, 'findById'])->name('log');
    Route::post('/log', [LogController::class, 'store'])->name('log.store');
    Route::put('/log/{id}', [LogController::class, 'update'])->name('log.update');
});

