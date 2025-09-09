@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Thêm danh mục FAQ</h2>

    <form action="{{ route('faq-categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Lưu</button>
        <a href="{{ route('faq-categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
