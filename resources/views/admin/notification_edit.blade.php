@extends('admin.layouts.app')

@section('title', isset($notification) ? 'Chỉnh sửa thông báo' : 'Thêm thông báo mới')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">{{ isset($notification) ? 'Chỉnh sửa thông báo' : 'Thêm thông báo mới' }}</h4>
        <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
    <div class="card-body">
        <form action="{{ isset($notification) ? route('admin.notifications.update', $notification) : route('admin.notifications.store') }}" method="POST">
            @csrf
            @if(isset($notification))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $notification->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Loại <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $notification->type ?? '') }}" required>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4" required>{{ old('content', $notification->content ?? '') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input @error('status') is-invalid @enderror" id="status" name="status" value="1" {{ old('status', $notification->status ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Hoạt động</label>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($notification) ? 'Cập nhật' : 'Lưu' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 