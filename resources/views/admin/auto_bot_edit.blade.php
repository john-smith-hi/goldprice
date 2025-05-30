@extends('admin.layouts.app')

@section('title', isset($autoBot) ? 'Chỉnh sửa auto bot' : 'Thêm auto bot mới')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">{{ isset($autoBot) ? 'Chỉnh sửa auto bot' : 'Thêm auto bot mới' }}</h4>
        <a href="{{ route('admin.auto-bots.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
    <div class="card-body">
        <form action="{{ isset($autoBot) ? route('admin.auto-bots.update', $autoBot) : route('admin.auto-bots.store') }}" method="POST">
            @csrf
            @if(isset($autoBot))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $autoBot->url ?? '') }}" required>
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="request" class="form-label">Request <span class="text-danger">*</span></label>
                <textarea class="form-control @error('request') is-invalid @enderror" id="request" name="request" rows="4" required>{{ old('request', $autoBot->request ?? '') }}</textarea>
                @error('request')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status_response" class="form-label">Status Response <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('status_response') is-invalid @enderror" id="status_response" name="status_response" value="{{ old('status_response', $autoBot->status_response ?? '') }}" required>
                @error('status_response')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="response" class="form-label">Response <span class="text-danger">*</span></label>
                <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="4" required>{{ old('response', $autoBot->response ?? '') }}</textarea>
                @error('response')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($autoBot) ? 'Cập nhật' : 'Lưu' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 