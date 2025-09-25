@extends('layouts.admin')

@section('content')
<div class="container mt-2">
    <h2 class="mb-4 text-center">Sửa chuyến bay quốc tế</h2>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form sửa chuyến bay --}}
    <form action="{{ route('international-flights.update', $flight->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Điểm đi</label>
                <select name="from" class="form-select" required>
                    <option value="">Chọn điểm đi</option>
                    <option value="TP. Hồ Chí Minh" {{ $flight->from == "TP. Hồ Chí Minh" ? 'selected' : '' }}>TP. Hồ Chí Minh</option>
                    <option value="Hà Nội" {{ $flight->from == "Hà Nội" ? 'selected' : '' }}>Hà Nội</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Quốc gia</label>
                <select name="country" class="form-select" required>
                    <option value="">Chọn quốc gia</option>
                    @foreach($countries as $c)
                        <option value="{{ $c }}" {{ $flight->country == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Điểm đến</label>
                <input type="text" name="to" value="{{ $flight->to }}" class="form-control" required>
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Ngày</label>
                <input type="text" name="date" value="{{ $flight->date }}" class="form-control" required>
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Giá khuyến mãi</label>
                <input type="number" name="price" value="{{ $flight->price }}" class="form-control" required>
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Giá gốc</label>
                <input type="number" name="original_price" value="{{ $flight->original_price }}" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Ảnh</label>
                <input type="file" name="img" class="form-control">
                @if($flight->img)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$flight->img) }}" style="height:80px;object-fit:cover;border:1px solid #ddd">
                    </div>
                @endif
            </div>
        </div>

        <button class="btn btn-success">Cập nhật</button>
        <a href="{{ route('international-flights.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
