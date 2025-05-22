<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

Route::redirect("/", "/home");
Route::get('/home', [HomeController::class, 'index']);
