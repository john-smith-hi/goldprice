@extends('admin.layouts.app')

@section('title', 'Quản lý cài đặt')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Danh sách cài đặt</h4>
        <a href="{{ route('admin.settings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
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
                        <th>Tên cài đặt</th>
                        <th>Loại giá trị</th>
                        <th>Giá trị</th>
                        <th>Ghi chú</th>
                        <th>Thời gian tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($settings as $setting)
                        <tr>
                            <td>{{ $setting->id }}</td>
                            <td>{{ $setting->name }}</td>
                            <td>{{ $setting->type_value }}</td>
                            <td>{{ Str::limit($setting->value, 50) }}</td>
                            <td>{{ Str::limit($setting->note, 50) }}</td>
                             <td>{{ $setting->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có cài đặt nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $settings->links() }}
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