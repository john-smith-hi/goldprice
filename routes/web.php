<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserHomeController;

Route::redirect("/", "/home");
Route::get('/home', [UserHomeController::class, 'index']);
