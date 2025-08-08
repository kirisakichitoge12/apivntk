@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Quản lý Banner</h3>

    {{-- Form thêm mới --}}
    <div class="card mb-4">
        <div class="card-header">Thêm banner mới</div>
        <div class="card-body">
            <form method="POST" action="{{ url('/api/banners') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Trang</label>
                        <select name="page" class="form-select" required>
                            <option value="home">Trang chủ</option>
                            <option value="about">Giới thiệu</option>
                            <option value="contact">Liên hệ</option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Chọn ảnh</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Mô tả ảnh (alt)</label>
                        <input type="text" class="form-control" name="alt_text" placeholder="VD: Ưu đãi mùa hè">
                    </div>

                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Danh sách banner --}}
    <div class="card">
        <div class="card-header">Danh sách Banner</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Trang</th>
                        <th>Ảnh</th>
                        <th>Alt (mô tả)</th>
                        <th>Thời gian tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->page }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $banner->image_path) }}"
                                 alt="{{ $banner->alt_text }}"
                                 style="height: 80px; object-fit: cover;">
                        </td>
                        <td>{{ $banner->alt_text }}</td>
                        <td>{{ $banner->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ url('/admin/banners/' . $banner->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá banner này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xoá</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
