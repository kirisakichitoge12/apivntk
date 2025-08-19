@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Quản lý Banner - Tin tức</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('tintuc.banners.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Ảnh banner</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alt" class="form-label">Alt (mô tả ảnh)</label>
            <input type="text" name="alt" id="alt" class="form-control" value="{{ old('alt') }}">
        </div>

        <button type="submit" class="btn btn-primary">Thêm Banner</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Alt</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($banners as $banner)
            <tr>
                <td>{{ $banner->id }}</td>
                <td>
                    <img src="{{ asset('storage/' . $banner->image_path) }}"
                         alt="{{ $banner->alt }}"
                         style="height:80px;object-fit:cover;border-radius:6px;">
                </td>
                <td>{{ $banner->alt ?? '-' }}</td>
                <td>{{ $banner->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('tintuc.banners.destroy', $banner->id) }}" method="POST"
                          onsubmit="return confirm('Bạn chắc chắn muốn xoá banner này?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Xoá</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Chưa có banner nào</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
