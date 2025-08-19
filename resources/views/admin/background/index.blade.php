@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Quản lý Background (Trang chủ)</h3>

    {{-- Hiển thị thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form cập nhật background --}}
    <div class="card mb-4">
        <div class="card-header">Cập nhật background</div>
        <div class="card-body">
            <form method="POST" action="{{ route('background.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Chọn ảnh</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Mô tả ảnh (alt)</label>
                        <input type="text" class="form-control" name="alt_text" placeholder="VD: Background chính">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Background hiện tại --}}
    <div class="card">
        <div class="card-header">Background hiện tại</div>
        <div class="card-body text-center">
            @if ($background)
                <img src="{{ asset('storage/' . $background->image_path) }}"
                     alt="{{ $background->alt_text }}"
                     loading="lazy"
                     style="max-height: 400px; width: auto; border-radius: 8px;">
                <p class="mt-2 text-muted">{{ $background->alt_text }}</p>

                <form action="{{ route('background.destroy', $background->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá background này?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mt-2">Xoá Background</button>
                </form>
            @else
                <p class="text-muted">Chưa có background nào</p>
            @endif
        </div>
    </div>
</div>
@endsection
