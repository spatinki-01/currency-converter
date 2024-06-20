<?php

use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CurrencyController::class, 'homeView'])->name('home');
Route::post('/', [CurrencyController::class, 'getAmount'])->name('getAmount.post');
