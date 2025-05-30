@extends('admin.layouts.app')

@section('title', 'Thêm Auto Bot mới')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Thêm Auto Bot mới</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.auto-bots.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}" required>
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="request" class="form-label">Request</label>
                <textarea class="form-control @error('request') is-invalid @enderror" id="request" name="request" rows="3" required>{{ old('request') }}</textarea>
                @error('request')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status_response" class="form-label">Status Response</label>
                <input type="number" class="form-control @error('status_response') is-invalid @enderror" id="status_response" name="status_response" value="{{ old('status_response') }}" required>
                @error('status_response')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="response" class="form-label">Response</label>
                <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="5" required>{{ old('response') }}</textarea>
                @error('response')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.auto-bots.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 