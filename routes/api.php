<?php

use App\Http\Controllers\Api\ApiTokenController;
use App\Http\Controllers\LogController;
use App\Repository\Chart\ChartRepository;
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
    Route::delete('/log/{id}', [LogController::class, 'destroy'])->name('log.destroy');
    Route::post('/log/search', [LogController::class, 'findByName'])->name('log.search');

    Route::post('/grouping',[LogController::class,'grouping']);

    Route::get('/patients/current', [LogController::class, 'currentPatient']);
    Route::get('/patients/today/receipt', [LogController::class, 'todayReceipt']);
    Route::get('/patients/today/discharge', [LogController::class, 'todayDischarge']);

});

