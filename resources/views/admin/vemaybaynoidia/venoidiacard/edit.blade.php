@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Sửa chuyến bay #{{ $flight->id }}</h1>

    <form action="{{ route('flights.update', $flight->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="from" class="form-label">Điểm đi</label>
            <select name="from" id="from" class="form-select" required>
                <option value="">Chọn điểm đi</option>
                <option value="Tất cả" {{ old('from', $flight->from) == 'Tất cả' ? 'selected' : '' }}>Tất cả</option>
                <option value="TP. Hồ Chí Minh" {{ old('from', $flight->from) == 'TP. Hồ Chí Minh' ? 'selected' : '' }}>TP. Hồ Chí Minh</option>
                <option value="Hà Nội" {{ old('from', $flight->from) == 'Hà Nội' ? 'selected' : '' }}>Hà Nội</option>
                <option value="Đà Nẵng" {{ old('from', $flight->from) == 'Đà Nẵng' ? 'selected' : '' }}>Đà Nẵng</option>
                <option value="Huế" {{ old('from', $flight->from) == 'Huế' ? 'selected' : '' }}>Huế</option>
                <option value="Phú Quốc" {{ old('from', $flight->from) == 'Phú Quốc' ? 'selected' : '' }}>Phú Quốc</option>
                <option value="Nha Trang" {{ old('from', $flight->from) == 'Nha Trang' ? 'selected' : '' }}>Nha Trang</option>
                <option value="Quy Nhơn" {{ old('from', $flight->from) == 'Quy Nhơn' ? 'selected' : '' }}>Quy Nhơn</option>
                <option value="Phú Yên" {{ old('from', $flight->from) == 'Phú Yên' ? 'selected' : '' }}>Phú Yên</option>
                <option value="Hải Phòng" {{ old('from', $flight->from) == 'Hải Phòng' ? 'selected' : '' }}>Hải Phòng</option>
                <option value="Cần Thơ" {{ old('from', $flight->from) == 'Cần Thơ' ? 'selected' : '' }}>Cần Thơ</option>
            </select>
            </div>

            <div class="col-md-3 mb-3">
            <label for="to" class="form-label">Điểm đến</label>
            <select name="to" id="to" class="form-select" required>
                <option value="">Chọn điểm đến</option>
                <option value="Tất cả" {{ old('to', $flight->to) == 'Tất cả' ? 'selected' : '' }}>Tất cả</option>
                <option value="TP. Hồ Chí Minh" {{ old('to', $flight->to) == 'TP. Hồ Chí Minh' ? 'selected' : '' }}>TP. Hồ Chí Minh</option>
                <option value="Hà Nội" {{ old('to', $flight->to) == 'Hà Nội' ? 'selected' : '' }}>Hà Nội</option>
                <option value="Đà Nẵng" {{ old('to', $flight->to) == 'Đà Nẵng' ? 'selected' : '' }}>Đà Nẵng</option>
                <option value="Huế" {{ old('to', $flight->to) == 'Huế' ? 'selected' : '' }}>Huế</option>
                <option value="Phú Quốc" {{ old('to', $flight->to) == 'Phú Quốc' ? 'selected' : '' }}>Phú Quốc</option>
                <option value="Nha Trang" {{ old('to', $flight->to) == 'Nha Trang' ? 'selected' : '' }}>Nha Trang</option>
                <option value="Quy Nhơn" {{ old('to', $flight->to) == 'Quy Nhơn' ? 'selected' : '' }}>Quy Nhơn</option>
                <option value="Phú Yên" {{ old('to', $flight->to) == 'Phú Yên' ? 'selected' : '' }}>Phú Yên</option>
                <option value="Hải Phòng" {{ old('to', $flight->to) == 'Hải Phòng' ? 'selected' : '' }}>Hải Phòng</option>
                <option value="Cần Thơ" {{ old('to', $flight->to) == 'Cần Thơ' ? 'selected' : '' }}>Cần Thơ</option>
            </select>
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Ngày</label>
                <input type="text" name="date" value="{{ old('date', $flight->date) }}" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price" value="{{ old('price', $flight->price) }}" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Giá gốc</label>
                <input type="number" name="original_price" value="{{ old('original_price', $flight->original_price) }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Ảnh điểm đến</label><br>
                @if($flight->img)
                    <img src="{{ asset('storage/' . $flight->img) }}" alt="current-img" style="height:80px; border-radius:6px; margin-bottom:10px;">
                @endif
                <input type="file" name="img" class="form-control">
                <small class="text-muted">Nếu không chọn ảnh mới thì ảnh cũ sẽ được giữ lại</small>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="{{ route('flights.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
