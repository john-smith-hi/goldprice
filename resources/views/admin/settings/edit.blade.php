@extends('admin.layouts.app')

@section('title', 'Sửa cài đặt')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Sửa cài đặt</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $setting->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type_value" class="form-label">Loại giá trị <span class="text-danger">*</span></label>
                        <select class="form-select @error('type_value') is-invalid @enderror" id="type_value" name="type_value" required>
                            <option value="">Chọn loại giá trị</option>
                            <option value="integer" {{ old('type_value', $setting->type_value) == 'integer' ? 'selected' : '' }}>Integer (Số nguyên)</option>
                            <option value="float" {{ old('type_value', $setting->type_value) == 'float' ? 'selected' : '' }}>Float (Số thực)</option>
                            <option value="varchar" {{ old('type_value', $setting->type_value) == 'varchar' ? 'selected' : '' }}>Varchar (Chuỗi)</option>
                        </select>
                        @error('type_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="value" class="form-label">Giá trị <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $setting->value) }}" required>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Ghi chú <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note" value="{{ old('note', $setting->note) }}" required>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeValueSelect = document.getElementById('type_value');
    const valueInput = document.getElementById('value');
    const currentValue = valueInput.value;

    function setInputType(type) {
        switch(type) {
            case 'integer':
                valueInput.type = 'number';
                valueInput.step = '1';
                valueInput.pattern = '[0-9]*';
                break;
            case 'float':
                valueInput.type = 'number';
                valueInput.step = 'any';
                break;
            case 'varchar':
                valueInput.type = 'text';
                break;
            default:
                valueInput.type = 'text';
        }
    }

    // Set initial input type based on current type_value
    if (typeValueSelect.value) {
        setInputType(typeValueSelect.value);
    }

    typeValueSelect.addEventListener('change', function() {
        const selectedType = this.value;
        setInputType(selectedType);
    });
});
</script>
@endsection 