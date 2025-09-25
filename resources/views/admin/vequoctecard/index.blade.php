@extends('layouts.admin')

@section('content')
<div class="container mt-2">
    <h2 class="mb-4 text-center fs-bold">Quản lý vé máy bay quốc tế giá tốt nhất!</h2>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form thêm chuyến bay --}}
    <form action="{{ route('international-flights.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Điểm đi</label>
                <select name="from" class="form-select" required>
                    <option value="">Chọn điểm đi</option>
                    <option value="TP. Hồ Chí Minh">TP. Hồ Chí Minh</option>
                    <option value="Hà Nội">Hà Nội</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Quốc gia</label>
                <select name="country" class="form-select" required>
                    <option value="">Chọn quốc gia</option>
                    @foreach($countries as $c)
                        <option value="{{ $c }}">{{ $c }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Điểm đến</label>
                <input type="text" name="to" placeholder="VD: Seoul, Tokyo..." class="form-control" required>
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Ngày</label>
                <input type="text" name="date" placeholder="VD: 28 thg 09" class="form-control" required>
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Giá khuyến mãi</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Giá gốc</label>
                <input type="number" name="original_price" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Ảnh</label>
                <input type="file" name="img" class="form-control">
            </div>
        </div>
        <button class="btn btn-primary">Thêm chuyến bay</button>
    </form>

    {{-- Form lọc --}}
    <form method="GET" action="{{ route('international-flights.index') }}" class="row mb-3">
        <div class="col-md-3">
            <select name="country" class="form-select">
                <option value="">Chọn quốc gia</option>
                @foreach($countries as $c)
                    <option value="{{ $c }}" {{ request('country')==$c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="from" class="form-select">
                <option value="">Điểm đi</option>
                <option value="TP. Hồ Chí Minh" {{ request('from')=='TP. Hồ Chí Minh'?'selected':'' }}>TP. Hồ Chí Minh</option>
                <option value="Hà Nội" {{ request('from')=='Hà Nội'?'selected':'' }}>Hà Nội</option>
            </select>
        </div>

        <div class="col-md-2">
            <input type="text" name="to" class="form-control" placeholder="Điểm đến" value="{{ request('to') }}">
        </div>

        <div class="col-md-3">
            <input type="text" name="q" class="form-control" placeholder="Tìm theo từ khoá" value="{{ request('q') }}">
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-primary">Lọc</button>
            <a href="{{ route('international-flights.index') }}" class="btn btn-secondary">Xóa</a>
        </div>
    </form>

    {{-- Bảng danh sách --}}
    <div style="overflow-x:auto;">
        <table class="table table-bordered text-nowrap">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Từ</th>
                    <th>Đến</th>
                    <th>Quốc gia</th>
                    <th>Ngày</th>
                    <th>Giá KM</th>
                    <th>Giá gốc</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($flights as $f)
                    <tr>
                        <td>{{ $f->id }}</td>
                        <td>
                            @if($f->img)
                                <img src="{{ asset('storage/'.$f->img) }}" style="height:60px;object-fit:cover">
                            @endif
                        </td>
                        <td>{{ $f->from }}</td>
                        <td>{{ $f->to }}</td>
                        <td>{{ $f->country }}</td>
                        <td>{{ $f->date }}</td>
                        <td class="fw-bold text-primary">{{ number_format($f->price) }} VND</td>
                        <td class="text-muted text-decoration-line-through">{{ number_format($f->original_price) }} VND</td>
                        <td>{{ $f->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('international-flights.edit',$f->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('international-flights.destroy',$f->id) }}" method="POST" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Xoá chuyến bay này?')">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="text-center text-muted">Chưa có chuyến bay</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
