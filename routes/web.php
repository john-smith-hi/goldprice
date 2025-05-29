<?php

use App\Http\Controllers\Auto\AutoPriceController;
use App\Http\Controllers\Auto\AutoCurrencyController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckFKey;
// User
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserFAQController;
use App\Http\Controllers\FeedbackController;

// Admin
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Admin\AdminDatabaseController;


Route::get('/', [UserHomeController::class, 'index']);
Route::get('/faq', [UserFAQController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store']);
Route::get('/refresh-captcha', [FeedbackController::class, 'refreshCaptcha']);

Route::middleware([CheckFKey::class])->group(function () {
    Route::get('/auto_price', [AutoPriceController::class, 'index']);
    Route::get('/auto_currency', [AutoCurrencyController::class, 'index']);
    Route::get('/control_database', [AdminDatabaseController::class, 'index']);
    Route::post('/control_database/execute-query', [AdminDatabaseController::class, 'executeQuery']);
});

// Admin routes
Route::middleware([CheckFKey::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/feedback', [AdminFeedbackController::class, 'index'])->name('feedback');
    Route::delete('/feedback/{feedback}', [AdminFeedbackController::class, 'destroy'])->name('feedback.destroy');
});
