<?php
use App\Http\Controllers\Api\ApiPriceController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('/gold_price', [ApiPriceController::class, 'index']);
});
