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
use App\Http\Controllers\Admin\AdminCompanyController;
use App\Http\Controllers\Admin\AdminTypeGoldController;
use App\Http\Controllers\Admin\AdminPriceController;
use App\Http\Controllers\Admin\AdminCurrencyController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminAccessLogController;
use App\Http\Controllers\Admin\AdminAutoBotController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminDatabaseController;

Route::get('/', [UserHomeController::class, 'index']);
Route::get('/faq', [UserFAQController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store']);
Route::get('/refresh-captcha', [FeedbackController::class, 'refreshCaptcha']);

Route::middleware([CheckFKey::class])->group(function () {
    Route::get('/auto_price', [AutoPriceController::class, 'index']);
    Route::get('/auto_currency', [AutoCurrencyController::class, 'index']);
});

// Admin routes
Route::middleware([CheckFKey::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');

    // Companies
    Route::get('/companies', [AdminCompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [AdminCompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [AdminCompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}/edit', [AdminCompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{company}', [AdminCompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [AdminCompanyController::class, 'destroy'])->name('companies.destroy');
    Route::post('/companies/{id}/restore', [AdminCompanyController::class, 'restore'])->name('companies.restore');
    
    // Type Gold
    Route::get('/type-gold', [AdminTypeGoldController::class, 'index'])->name('type-gold.index');
    Route::get('/type-gold/create', [AdminTypeGoldController::class, 'create'])->name('type-gold.create');
    Route::post('/type-gold', [AdminTypeGoldController::class, 'store'])->name('type-gold.store');
    Route::get('/type-gold/{typeGold}/edit', [AdminTypeGoldController::class, 'edit'])->name('type-gold.edit');
    Route::put('/type-gold/{typeGold}', [AdminTypeGoldController::class, 'update'])->name('type-gold.update');
    Route::delete('/type-gold/{typeGold}', [AdminTypeGoldController::class, 'destroy'])->name('type-gold.destroy');
    
    // Prices
    Route::get('/prices', [AdminPriceController::class, 'index'])->name('prices.index');
    Route::get('/prices/create', [AdminPriceController::class, 'create'])->name('prices.create');
    Route::post('/prices', [AdminPriceController::class, 'store'])->name('prices.store');
    Route::get('/prices/{price}', [AdminPriceController::class, 'show'])->name('prices.show');
    Route::get('/prices/{price}/edit', [AdminPriceController::class, 'edit'])->name('prices.edit');
    Route::put('/prices/{price}', [AdminPriceController::class, 'update'])->name('prices.update');
    Route::delete('/prices/{price}', [AdminPriceController::class, 'destroy'])->name('prices.destroy');
    
    // Currencies
    Route::get('/currencies', [AdminCurrencyController::class, 'index'])->name('currencies.index');
    Route::get('/currencies/create', [AdminCurrencyController::class, 'create'])->name('currencies.create');
    Route::post('/currencies', [AdminCurrencyController::class, 'store'])->name('currencies.store');
    Route::get('/currencies/{currency}/edit', [AdminCurrencyController::class, 'edit'])->name('currencies.edit');
    Route::put('/currencies/{currency}', [AdminCurrencyController::class, 'update'])->name('currencies.update');
    Route::delete('/currencies/{currency}', [AdminCurrencyController::class, 'destroy'])->name('currencies.destroy');
    
    // Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/create', [AdminSettingController::class, 'create'])->name('settings.create');
    Route::post('/settings', [AdminSettingController::class, 'store'])->name('settings.store');
    Route::get('/settings/{setting}/edit', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/{setting}', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::delete('/settings/{setting}', [AdminSettingController::class, 'destroy'])->name('settings.destroy');

    // Notifications
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/create', [AdminNotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications', [AdminNotificationController::class, 'store'])->name('notifications.store');
    Route::get('/notifications/{notification}/edit', [AdminNotificationController::class, 'edit'])->name('notifications.edit');
    Route::put('/notifications/{notification}', [AdminNotificationController::class, 'update'])->name('notifications.update');
    Route::delete('/notifications/{notification}', [AdminNotificationController::class, 'destroy'])->name('notifications.destroy');

    // Access Logs
    Route::get('/access-logs', [AdminAccessLogController::class, 'index'])->name('access-logs.index');
    Route::get('/access-logs/create', [AdminAccessLogController::class, 'create'])->name('access-logs.create');
    Route::post('/access-logs', [AdminAccessLogController::class, 'store'])->name('access-logs.store');
    Route::get('/access-logs/{accessLog}/edit', [AdminAccessLogController::class, 'edit'])->name('access-logs.edit');
    Route::put('/access-logs/{accessLog}', [AdminAccessLogController::class, 'update'])->name('access-logs.update');
    Route::delete('/access-logs/{accessLog}', [AdminAccessLogController::class, 'destroy'])->name('access-logs.destroy');

    // Auto Bots
    Route::get('/auto-bots', [AdminAutoBotController::class, 'index'])->name('auto-bots.index');
    Route::get('/auto-bots/create', [AdminAutoBotController::class, 'create'])->name('auto-bots.create');
    Route::post('/auto-bots', [AdminAutoBotController::class, 'store'])->name('auto-bots.store');
    Route::get('/auto-bots/{autoBot}/edit', [AdminAutoBotController::class, 'edit'])->name('auto-bots.edit');
    Route::put('/auto-bots/{autoBot}', [AdminAutoBotController::class, 'update'])->name('auto-bots.update');
    Route::delete('/auto-bots/{autoBot}', [AdminAutoBotController::class, 'destroy'])->name('auto-bots.destroy');

    // Feedback
    Route::get('/feedback', [AdminFeedbackController::class, 'index'])->name('feedback');
    Route::delete('/feedback/delete/{feedback}', [AdminFeedbackController::class, 'destroy'])->name('feedback.destroy');

    // Database (Restored)
    Route::get('/database', [AdminDatabaseController::class, 'index'])->name('database');
    Route::post('/database/execute-query', [AdminDatabaseController::class, 'executeQuery'])->name('database.execute');
});
