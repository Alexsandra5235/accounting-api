<?php

use App\Http\Controllers\Api\ApiTokenController;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return response()->json(['message' => 'Hello World!']);
})->middleware(['auth:sanctum']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/log/all', [LogController::class, 'findAll'])->name('user.all');
});

