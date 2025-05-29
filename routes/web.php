<?php

use App\Http\Controllers\Auto\AutoPriceController;
use App\Http\Controllers\Auto\AutoCurrencyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserFAQController;
use App\Http\Controllers\Admin\AdminDatabaseController;
use App\Http\Middleware\CheckFKey;

Route::get('/', [UserHomeController::class, 'index']);
Route::get('/faq', [UserFAQController::class, 'index']);

Route::middleware([CheckFKey::class])->group(function () {
    Route::get('/auto_price', [AutoPriceController::class, 'index']);
    Route::get('/auto_currency', [AutoCurrencyController::class, 'index']);
    Route::get('/control_database', [AdminDatabaseController::class, 'index']);
    Route::post('/control_database/execute-query', [AdminDatabaseController::class, 'executeQuery']);
});
