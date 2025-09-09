@extends('layouts.admin')

@section('content')
<div class="container mt-2">
    <h2 class="mb-4 text-center fs-bold">Quản lý vé máy bay nội địa giá tốt nhất!</h2>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Form thêm chuyến bay --}}
    <form action="{{ route('flights.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="row">
            <!-- <div class="col-md-3 mb-3">
                <label for="from" class="form-label">Điểm đi</label>
                <input type="text" name="from" id="from" placeholder="vd: TP HCM" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="to" class="form-label">Điểm đến</label>
                <input type="text" name="to" id="to" placeholder="vd: Hà Nội" class="form-control" required>
            </div> -->
            <div class="col-md-3 mb-3">
                <label for="from" class="form-label">Điểm đi</label>
                <select name="from" id="from" class="form-select" required>
                    <option value="">Chọn điểm đi</option>
                    <option value="Tất cả">Tất cả</option>
                    <option value="TP. Hồ Chí Minh">TP. Hồ Chí Minh</option>
                    <option value="Hà Nội">Hà Nội</option>
                    <option value="Đà Nẵng">Đà Nẵng</option>
                    <option value="Huế">Huế</option>
                    <option value="Phú Quốc">Phú Quốc</option>
                    <option value="Nha Trang">Nha Trang</option>
                    <option value="Quy Nhơn">Quy Nhơn</option>
                    <option value="Phú Yên">Phú Yên</option>
                    <option value="Hải Phòng">Hải Phòng</option>
                    <option value="Cần Thơ">Cần Thơ</option>
                </select>
                </div>

                <div class="col-md-3 mb-3">
                <label for="to" class="form-label">Điểm đến</label>
                <select name="to" id="to" class="form-select" required>
                    <option value="">Chọn điểm đến</option>
                    <option value="Tất cả">Tất cả</option>
                    <option value="TP. Hồ Chí Minh">TP. Hồ Chí Minh</option>
                    <option value="Hà Nội">Hà Nội</option>
                    <option value="Đà Nẵng">Đà Nẵng</option>
                    <option value="Huế">Huế</option>
                    <option value="Phú Quốc">Phú Quốc</option>
                    <option value="Nha Trang">Nha Trang</option>
                    <option value="Quy Nhơn">Quy Nhơn</option>
                    <option value="Phú Yên">Phú Yên</option>
                    <option value="Hải Phòng">Hải Phòng</option>
                    <option value="Cần Thơ">Cần Thơ</option>
                </select>
                </div>

            <div class="col-md-2 mb-3">
                <label for="date" class="form-label">Ngày</label>
                <input type="text" name="date" id="date" class="form-control" required placeholder="VD: 28 thg 09">
            </div>
            <div class="col-md-2 mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" name="price"  placeholder="vd: 1000000" id="price" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="original_price" class="form-label">Giá gốc</label>
                <input type="number" name="original_price" placeholder="vd: 1200000" id="original_price" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="img" class="form-label">Ảnh điểm đến</label>
                <input style="width:400px" type="file" name="img" id="img" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm chuyến bay</button>
    </form>


    <form method="GET" action="{{ route('flights.index') }}" class="row mb-3">
    <div class="col-md-3">
        <select name="from" class="form-select">
            <option value="">Chọn điểm đi</option>
            <option value="Tất cả" {{ request('from')=='Tất cả' ? 'selected' : '' }}>Tất cả</option>
            <option value="TP. Hồ Chí Minh" {{ request('from')=='TP. Hồ Chí Minh' ? 'selected' : '' }}>TP. Hồ Chí Minh</option>
            <option value="Hà Nội" {{ request('from')=='Hà Nội' ? 'selected' : '' }}>Hà Nội</option>
            <option value="Đà Nẵng" {{ request('from')=='Đà Nẵng' ? 'selected' : '' }}>Đà Nẵng</option>
            <option value="Huế" {{ request('from')=='Huế' ? 'selected' : '' }}>Huế</option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="to" class="form-select">
            <option value="">Chọn điểm đến</option>
            <option value="Tất cả" {{ request('to')=='Tất cả' ? 'selected' : '' }}>Tất cả</option>
            <option value="Phú Quốc" {{ request('to')=='Phú Quốc' ? 'selected' : '' }}>Phú Quốc</option>
            <option value="Nha Trang" {{ request('to')=='Nha Trang' ? 'selected' : '' }}>Nha Trang</option>
            <option value="Quy Nhơn" {{ request('to')=='Quy Nhơn' ? 'selected' : '' }}>Quy Nhơn</option>
            <option value="Phú Yên" {{ request('to')=='Phú Yên' ? 'selected' : '' }}>Phú Yên</option>
            <option value="Hải Phòng" {{ request('to')=='Hải Phòng' ? 'selected' : '' }}>Hải Phòng</option>
            <option value="Cần Thơ" {{ request('to')=='Cần Thơ' ? 'selected' : '' }}>Cần Thơ</option>
        </select>
    </div>

    <div class="col-md-3">
        <input type="text" name="q" class="form-control"
               placeholder="Tìm theo điểm/ ngày..."
               value="{{ request('q') }}">
    </div>

    <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary">Lọc</button>
        <a href="{{ route('flights.index') }}" class="btn btn-secondary">Xóa lọc</a>
    </div>
</form>

    {{-- Danh sách flights --}}
    <div style="overflow-x:auto;">
    <table class="table table-bordered text-nowrap">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Từ</th>
                <th>Đến</th>
                <th>Ngày</th>
                <th>Giá khuyến mãi</th>
                <th>Giá gốc</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($flights as $flight)
                <tr>
                    <td>{{ $flight->id }}</td>
                    <td>
                        @if($flight->img)
                            <img src="{{ asset('storage/' . $flight->img) }}"
                                alt="flight-img"
                                style="height:60px;object-fit:cover;border-radius:6px;">
                        @else
                            <span class="text-muted">Chưa có</span>
                        @endif
                    </td>
                    <td>{{ $flight->from }}</td>
                    <td>{{ $flight->to }}</td>
                    <td>{{ $flight->date }}</td>
                    <td class="fw-bold text-primary">{{ number_format($flight->price) }} VND</td>
                    <td class="text-muted text-decoration-line-through">{{ number_format($flight->original_price) }} VND</td>
                    <td>{{ $flight->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('flights.edit', $flight->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('flights.destroy', $flight->id) }}" method="POST"
                            style="display:inline-block"
                            onsubmit="return confirm('Bạn chắc chắn muốn xoá chuyến bay này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xoá</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">Chưa có chuyến bay nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>

{{-- Modal sửa --}}
<div class="modal fade" id="editFlightModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" id="editFlightForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Sửa chuyến bay</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Điểm đi</label>
                <input type="text" name="from" id="editFrom" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Điểm đến</label>
                <input type="text" name="to" id="editTo" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Ngày</label>
                <input type="text" name="date" id="editDate" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price" id="editPrice" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Ảnh</label>
                <input type="file" name="img" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection