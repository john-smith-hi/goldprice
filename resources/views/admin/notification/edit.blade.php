@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa thông báo')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Chỉnh sửa thông báo</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.notifications.update', $notification->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $notification->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Loại</label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                    <option value="info" {{ old('type', $notification->type) == 'info' ? 'selected' : '' }}>Info</option>
                    <option value="success" {{ old('type', $notification->type) == 'success' ? 'selected' : '' }}>Success</option>
                    <option value="warning" {{ old('type', $notification->type) == 'warning' ? 'selected' : '' }}>Warning</option>
                    <option value="error" {{ old('type', $notification->type) == 'error' ? 'selected' : '' }}>Error</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $notification->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="1" {{ old('status', $notification->status) == '1' ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ old('status', $notification->status) == '0' ? 'selected' : '' }}>Ẩn</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 