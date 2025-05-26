<?php
use App\Http\Controllers\Auto\AutoCurrencyController;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Khởi tạo ứng dụng
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Gọi controller
$controller = new AutoCurrencyController();
$controller->index();

