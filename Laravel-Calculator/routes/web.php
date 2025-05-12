<?php

use App\Http\Controllers\CalculatorController;
use Illuminate\Support\Facades\Route;




Route::get('/', [CalculatorController::class, 'showForm'])->name('calculator');

Route::post('calculate', [CalculatorController::class, 'calculate'])->name('calculate');
