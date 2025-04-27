<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return response()->json(['message' => 'Hello World!']);
})->middleware(['auth:sanctum']);
