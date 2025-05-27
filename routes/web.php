<?php

use App\Http\Controllers\Auto\AutoPriceController;
use App\Http\Controllers\Auto\AutoCurrencyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserFAQController;

Route::get('/', [UserHomeController::class, 'index']);
Route::get('/faq', [UserFAQController::class, 'index']);
Route::get('/auto_price', [AutoPriceController::class, 'index']);
Route::get('/auto_currency', [AutoCurrencyController::class, 'index']);
