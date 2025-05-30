@extends('admin.layouts.app')

@section('title', 'Sửa loại vàng')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Sửa loại vàng</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.type-gold.update', $typeGold->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="companies_id" class="form-label">Công ty <span class="text-danger">*</span></label>
                            <select class="form-select @error('companies_id') is-invalid @enderror" id="companies_id" name="companies_id" required>
                                <option value="">Chọn công ty</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ (old('companies_id', $typeGold->companies_id) == $company->id) ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('companies_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name_vn" class="form-label">Tên tiếng Việt <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name_vn') is-invalid @enderror" id="name_vn" name="name_vn" value="{{ old('name_vn', $typeGold->name_vn) }}" required>
                            @error('name_vn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name_en" class="form-label">Tên tiếng Anh</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en" value="{{ old('name_en', $typeGold->name_en) }}">
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Loại <span class="text-danger">*</span></label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="">Chọn loại</option>
                                <option value="0" {{ (old('type', $typeGold->type) == '0') ? 'selected' : '' }}>Trong nước</option>
                                <option value="1" {{ (old('type', $typeGold->type) == '1') ? 'selected' : '' }}>Quốc tế</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3">{{ old('note', $typeGold->note) }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.type-gold.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 