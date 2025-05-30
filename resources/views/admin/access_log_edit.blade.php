@extends('admin.layouts.app')

@section('title', isset($accessLog) ? 'Chỉnh sửa access log' : 'Thêm access log mới')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">{{ isset($accessLog) ? 'Chỉnh sửa access log' : 'Thêm access log mới' }}</h4>
        <a href="{{ route('admin.access-logs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
    <div class="card-body">
        <form action="{{ isset($accessLog) ? route('admin.access-logs.update', $accessLog) : route('admin.access-logs.store') }}" method="POST">
            @csrf
            @if(isset($accessLog))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="ip_address" class="form-label">IP Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('ip_address') is-invalid @enderror" id="ip_address" name="ip_address" value="{{ old('ip_address', $accessLog->ip_address ?? '') }}" required>
                @error('ip_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_agent" class="form-label">User Agent</label>
                <input type="text" class="form-control @error('user_agent') is-invalid @enderror" id="user_agent" name="user_agent" value="{{ old('user_agent', $accessLog->user_agent ?? '') }}">
                @error('user_agent')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="device" class="form-label">Device</label>
                <input type="text" class="form-control @error('device') is-invalid @enderror" id="device" name="device" value="{{ old('device', $accessLog->device ?? '') }}">
                @error('device')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="resolution" class="form-label">Resolution</label>
                <input type="text" class="form-control @error('resolution') is-invalid @enderror" id="resolution" name="resolution" value="{{ old('resolution', $accessLog->resolution ?? '') }}">
                @error('resolution')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="language" class="form-label">Language</label>
                <input type="text" class="form-control @error('language') is-invalid @enderror" id="language" name="language" value="{{ old('language', $accessLog->language ?? '') }}">
                @error('language')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $accessLog->url ?? '') }}" required>
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($accessLog) ? 'Cập nhật' : 'Lưu' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 