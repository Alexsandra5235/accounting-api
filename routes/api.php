<?php

use App\Http\Controllers\Api\ApiTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return response()->json(['message' => 'Hello World!']);
})->middleware(['auth:sanctum']);

Route::middleware('auth')->group(function () {

});

