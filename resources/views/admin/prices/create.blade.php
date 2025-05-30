@extends('admin.layouts.app')

@section('title', 'Thêm giá vàng mới')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Thêm giá vàng mới</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.prices.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="type" class="form-label">Loại vàng <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">Chọn loại vàng</option>
                            @foreach($typeGolds as $typeGold)
                                <option value="{{ $typeGold->id }}" {{ old('type') == $typeGold->id ? 'selected' : '' }}>
                                    {{ $typeGold->name_vn }} ({{ $typeGold->company->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price_in" class="form-label">Giá mua vào <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('price_in') is-invalid @enderror" id="price_in" name="price_in" value="{{ old('price_in') }}" required>
                        @error('price_in')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price_out" class="form-label">Giá bán ra <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('price_out') is-invalid @enderror" id="price_out" name="price_out" value="{{ old('price_out') }}" required>
                        @error('price_out')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="url" class="form-label">URL nguồn <span class="text-danger">*</span></label>
                        <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}" required>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="published_at" class="form-label">Thời gian công bố</label>
                        <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.prices.index') }}" class="btn btn-secondary">
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