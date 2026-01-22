<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;

Route::get('/', [CalculatorController::class, 'index'])->name('home');
Route::post('/calculate', [CalculatorController::class, 'calculate'])->name('calculate');
Route::get('/result/{uniqueId}', [CalculatorController::class, 'result'])->name('result');
Route::post('/certificate/{uniqueId}', [CalculatorController::class, 'generateCertificate'])->name('generate.certificate');
Route::get('/certificate/{certificateNumber}', [CalculatorController::class, 'certificate'])->name('certificate');
Route::get('/recent', [CalculatorController::class, 'recent'])->name('recent');
