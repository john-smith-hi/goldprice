@extends('admin.layouts.app')

@section('title', 'Lịch sử truy cập')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Danh sách lịch sử truy cập</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Địa chỉ IP</th>
                        <th>User Agent</th>
                        <th>Thiết bị</th>
                        <th>Độ phân giải</th>
                        <th>Ngôn ngữ</th>
                        <th>URL</th>
                        <th>Thời gian truy cập</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($accessLogs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->ip_address ?? 'N/A' }}</td>
                            <td>{{ Str::limit($log->user_agent, 50) ?? 'N/A' }}</td>
                            <td>{{ $log->device ?? 'N/A' }}</td>
                            <td>{{ $log->resolution ?? 'N/A' }}</td>
                            <td>{{ $log->language ?? 'N/A' }}</td>
                            <td>{{ Str::limit($log->url, 50) }}</td>
                            <td>{{ $log->accessed_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Không có lịch sử truy cập nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $accessLogs->links() }}
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Không có script DataTables hoặc xóa ở đây
});
</script>
@endsection
