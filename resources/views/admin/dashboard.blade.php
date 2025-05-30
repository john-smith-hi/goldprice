@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Thống kê tổng quan -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Thống kê tổng quan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.companies.index') }}" class="text-decoration-none">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Công ty</h5>
                                    <p class="card-text display-6">{{ $stats['companies'] }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.type-gold.index') }}" class="text-decoration-none">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Loại vàng</h5>
                                    <p class="card-text display-6">{{ $stats['type_golds'] }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.prices.index') }}" class="text-decoration-none">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Giá vàng</h5>
                                    <p class="card-text display-6">{{ $stats['prices'] }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.currencies.index') }}" class="text-decoration-none">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Tỷ giá</h5>
                                    <p class="card-text display-6">{{ $stats['currencies'] }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Giá vàng mới nhất -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Giá vàng mới nhất</h4>
                <a href="{{ route('admin.prices.index') }}" class="btn btn-sm btn-primary">Xem tất cả</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Công ty</th>
                                <th>Loại vàng</th>
                                <th>Giá mua</th>
                                <th>Giá bán</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latest_prices as $price)
                            <tr>
                                <td>{{ $price->typeGold->company->name }}</td>
                                <td>{{ $price->typeGold->name_vn }}</td>
                                <td>{{ number_format($price->price_in) }}</td>
                                <td>{{ number_format($price->price_out) }}</td>
                                <td>{{ $price->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tỷ giá mới nhất -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Tỷ giá mới nhất</h4>
                <a href="{{ route('admin.currencies.index') }}" class="btn btn-sm btn-primary">Xem tất cả</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nguồn</th>
                                <th>Đích</th>
                                <th>Tỷ giá</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latest_currencies as $currency)
                            <tr>
                                <td>{{ $currency->source }}</td>
                                <td>{{ $currency->target }}</td>
                                <td>{{ number_format($currency->number_target, 2) }}</td>
                                <td>{{ $currency->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Phản hồi mới nhất -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Phản hồi mới nhất</h4>
                <a href="{{ route('admin.feedback') }}" class="btn btn-sm btn-primary">Xem tất cả</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latest_feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->email ?? 'N/A' }}</td>
                                <td>{{ Str::limit($feedback->message, 50) }}</td>
                                <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Truy cập gần đây -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Truy cập gần đây</h4>
                <a href="{{ route('admin.access-logs.index') }}" class="btn btn-sm btn-primary">Xem tất cả</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>IP</th>
                                <th>URL</th>
                                <th>Thiết bị</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_access as $access)
                            <tr>
                                <td>{{ $access->ip_address }}</td>
                                <td>{{ Str::limit($access->url, 30) }}</td>
                                <td>{{ $access->device ?? 'N/A' }}</td>
                                <td>{{ $access->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Thống kê truy cập -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Thống kê truy cập (7 ngày gần nhất)</h4>
            </div>
            <div class="card-body">
                <canvas id="accessChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('accessChart').getContext('2d');
    const data = @json($access_stats);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.map(item => item.date),
            datasets: [{
                label: 'Số lượt truy cập',
                data: data.map(item => item.total),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>
@endsection 