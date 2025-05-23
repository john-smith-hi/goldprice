<?php

use App\Http\Controllers\Auto\AutoPriceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserHomeController;

Route::redirect("/", "/home");
Route::get('/home', [UserHomeController::class, 'index']);
// Route::get('/update_code', []);
Route::get('/auto_price', [AutoPriceController::class, 'index']);
