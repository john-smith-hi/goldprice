<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\TypeGold;
use App\Models\Price;
use App\Models\Currency;
use App\Models\AccessLog;
use App\Models\AutoBot;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function index()
    {
        // Thống kê tổng quan
        $stats = [
            'companies' => Company::count(),
            'type_golds' => TypeGold::count(),
            'prices' => Price::count(),
            'currencies' => Currency::count(),
            'access_logs' => AccessLog::count(),
            'auto_bots' => AutoBot::count(),
            'feedbacks' => Feedback::count(),
        ];

        // Giá vàng mới nhất
        $latest_prices = Price::with(['typeGold.company'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Tỷ giá mới nhất
        $latest_currencies = Currency::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Phản hồi mới nhất
        $latest_feedbacks = Feedback::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Truy cập gần đây
        $recent_access = AccessLog::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Thống kê truy cập theo ngày (7 ngày gần nhất)
        $access_stats = AccessLog::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'latest_prices',
            'latest_currencies',
            'latest_feedbacks',
            'recent_access',
            'access_stats'
        ));
    }
}
