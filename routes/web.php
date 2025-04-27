<?php

use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/log',[LogController::class, 'store'])->name('log.store');
Route::delete('/log/{id}',[LogController::class, 'destroy'])->name('log.destroy');
Route::get('/log/{id}/update',[LogController::class, 'edit'])->name('log.edit');
Route::put('/log/{id}',[LogController::class, 'update'])->name('log.update');
Route::get('/logs', [LogController::class, 'findAll'])->name('logs');
Route::get('/log/{id}', [LogController::class, 'findById'])->name('log.find');
Route::get('/log', [LogController::class, 'add'])->name('log.add');

require base_path('routes/api.php');
