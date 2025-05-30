@extends('admin.layouts.app')

@section('title', 'Sửa tỷ giá')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Sửa tỷ giá</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.currencies.update', $currency->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="source" class="form-label">Nguồn <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('source') is-invalid @enderror" id="source" name="source" value="{{ old('source', $currency->source) }}" required>
                        @error('source')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="target" class="form-label">Đích <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('target') is-invalid @enderror" id="target" name="target" value="{{ old('target', $currency->target) }}" required>
                        @error('target')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="number_source" class="form-label">Tỷ giá nguồn <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control @error('number_source') is-invalid @enderror" id="number_source" name="number_source" value="{{ old('number_source', $currency->number_source) }}" required>
                        @error('number_source')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="number_target" class="form-label">Tỷ giá đích <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control @error('number_target') is-invalid @enderror" id="number_target" name="number_target" value="{{ old('number_target', $currency->number_target) }}" required>
                        @error('number_target')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="datetime" class="form-label">Thời gian <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control @error('datetime') is-invalid @enderror" id="datetime" name="datetime" value="{{ old('datetime', $currency->datetime ? \Carbon\Carbon::parse($currency->datetime)->format('Y-m-d\TH:i') : '') }}" required>
                        @error('datetime')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="time" class="form-label">Thời gian (milliseconds)</label>
                        <input type="number" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ old('time', $currency->time) }}">
                        @error('time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.currencies.index') }}" class="btn btn-secondary">
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