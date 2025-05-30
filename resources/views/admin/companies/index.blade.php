@extends('admin.layouts.app')

@section('title', 'Quản lý công ty')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Danh sách công ty</h4>
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
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
                        <th>Tên công ty</th>
                        <th>Địa chỉ</th>
                        <th>Ghi chú</th>
                        <th>Thời gian tạo</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->diachi ?? 'N/A' }}</td>
                            <td>{{ Str::limit($company->note, 50) ?? 'N/A' }}</td>
                            <td>{{ $company->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($company->trashed())
                                    <span class="badge bg-danger">Đã xóa</span>
                                @else
                                    <span class="badge bg-success">Hoạt động</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $company->id }}" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @unless($company->trashed())
                                <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-warning btn-sm" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endunless

                                @if($company->trashed())
                                <form action="{{ route('admin.companies.restore', $company->id) }}" method="POST" class="d-inline restore-form">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" title="Khôi phục">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="{{ $company->trashed() ? 'Xóa vĩnh viễn' : 'Xóa' }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal{{ $company->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $company->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel{{ $company->id }}">Chi tiết công ty</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>ID:</strong> {{ $company->id }}</p>
                                        <p><strong>Tên công ty:</strong> {{ $company->name }}</p>
                                        <p><strong>Địa chỉ:</strong> {{ $company->diachi ?? 'N/A' }}</p>
                                        <p><strong>Ghi chú:</strong> {{ $company->note ?? 'N/A' }}</p>
                                        <p><strong>Thông tin thêm:</strong> {{ $company->moreinfo ?? 'N/A' }}</p>
                                        <p><strong>Thời gian tạo:</strong> {{ $company->created_at->format('d/m/Y H:i:s') }}</p>
                                        <p><strong>Cập nhật cuối:</strong> {{ $company->updated_at->format('d/m/Y H:i:s') }}</p>
                                        @if($company->trashed())
                                            <p><strong>Thời gian xóa:</strong> {{ $company->deleted_at->format('d/m/Y H:i:s') }}</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có công ty nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xác nhận xóa
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const isTrashed = form.querySelector('button[type="submit"]').title === 'Xóa vĩnh viễn';
            const text = isTrashed ? "Bạn có chắc chắn muốn xóa vĩnh viễn công ty này?" : "Bạn có chắc chắn muốn xóa công ty này?";
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: isTrashed ? 'Xóa vĩnh viễn' : 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Xác nhận khôi phục
    const restoreForms = document.querySelectorAll('.restore-form');
    restoreForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận khôi phục?',
                text: "Bạn có chắc chắn muốn khôi phục công ty này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Khôi phục',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection 