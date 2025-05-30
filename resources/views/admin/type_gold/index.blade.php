@extends('admin.layouts.app')

@section('title', 'Quản lý loại vàng')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Danh sách loại vàng</h4>
        <a href="{{ route('admin.type-gold.create') }}" class="btn btn-primary">
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
                        <th>Công ty</th>
                        <th>Tên tiếng Việt</th>
                        <th>Tên tiếng Anh</th>
                        <th>Loại</th>
                        <th>Ghi chú</th>
                        <th>Thời gian tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($typeGolds as $typeGold)
                        <tr>
                            <td>{{ $typeGold->id }}</td>
                            <td>{{ $typeGold->company->name }}</td>
                            <td>{{ $typeGold->name_vn }}</td>
                            <td>{{ $typeGold->name_en ?? 'N/A' }}</td>
                            <td>
                                @if($typeGold->type == 0)
                                    <span class="badge bg-primary">Trong nước</span>
                                @else
                                    <span class="badge bg-info">Quốc tế</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($typeGold->note, 50) ?? 'N/A' }}</td>
                            <td>{{ $typeGold->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.type-gold.edit', $typeGold) }}" class="btn btn-warning btn-sm" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Không có loại vàng nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $typeGolds->links() }}
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