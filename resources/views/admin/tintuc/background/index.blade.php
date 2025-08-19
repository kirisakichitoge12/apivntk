@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Quản lý Background - Tin tức</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('tintuc.background.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Ảnh background</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alt" class="form-label">Alt (mô tả ảnh)</label>
            <input type="text" name="alt" id="alt" class="form-control" value="{{ old('alt') }}">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật Background</button>
    </form>

    @if ($background)
        <div class="mb-3">
            <p>Ảnh hiện tại:</p>
            <img src="{{ asset('storage/' . $background->image_path) }}"
                 alt="{{ $background->alt }}"
                 style="max-height:200px;border-radius:8px;object-fit:cover;">
        </div>
        <form action="{{ route('tintuc.background.destroy', $background->id) }}" method="POST"
              onsubmit="return confirm('Bạn chắc chắn muốn xoá background này?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Xoá Background</button>
        </form>
    @endif
</div>
@endsection
