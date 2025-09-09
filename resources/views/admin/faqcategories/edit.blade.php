@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Sửa danh mục FAQ</h2>

    <form action="{{ route('faq-categories.update', $faqCategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $faqCategory->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('faq-categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
