@extends('admin.layouts.app')

@section('title', 'Quản lý auto bots')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Danh sách auto bots</h4>
        <a href="{{ route('admin.auto-bots.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>URL</th>
                        <th>Request</th>
                        <th>Status Response</th>
                        <th>Response</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($autoBots as $bot)
                        <tr>
                            <td>{{ $bot->id }}</td>
                            <td>{{ Str::limit($bot->url, 50) }}</td>
                            <td>{{ Str::limit($bot->request, 50) }}</td>
                            <td>{{ $bot->status_response }}</td>
                            <td>{{ Str::limit($bot->response, 50) }}</td>
                            <td>{{ $bot->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>
                                <a href="{{ route('admin.auto-bots.edit', $bot) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $bot->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $autoBots->links() }}
        </div>
    </div>
</div>

<form id="delete-form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            const id = $(this).data('id');
            const form = $('#delete-form');
            
            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Bạn không thể hoàn tác sau khi xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xóa nó!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.attr('action', `/admin/auto-bots/${id}`);
                    form.submit();
                }
            });
        });
    });
</script>
@endpush 