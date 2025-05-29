@extends('admin.layouts.app')

@section('title', 'Quản lý phản hồi')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Danh sách phản hồi</h4>
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
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->name }}</td>
                            <td>{{ $feedback->email ?? 'Không có' }}</td>
                            <td>{{ Str::limit($feedback->message, 100) }}</td>
                            <td>{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $feedback->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal{{ $feedback->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Chi tiết phản hồi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Họ và tên:</strong> {{ $feedback->name }}</p>
                                        <p><strong>Email:</strong> {{ $feedback->email ?? 'Không có' }}</p>
                                        <p><strong>Nội dung:</strong></p>
                                        <p>{{ $feedback->message }}</p>
                                        <p><strong>Thời gian:</strong> {{ $feedback->created_at->format('d/m/Y H:i:s') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có phản hồi nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $feedbacks->links() }}
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
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn có chắc chắn muốn xóa phản hồi này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
});
</script>
@endsection 