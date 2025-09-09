@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Quản lý Deal vé máy bay</h2>

    {{-- Form thêm deal --}}
    <div class="card mb-4">
        <div class="card-header">Thêm Deal mới</div>
        <div class="card-body">
            <form action="{{ route('deals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-3">
                    <label class="form-label">Hãng bay</label>
                    <select name="airline" class="form-control" id="airline" required>
                        <option value="">-- Chọn hãng bay --</option>
                        <option value="Vietnam Airlines">Vietnam Airlines</option>
                        <option value="Vietjet Air">Vietjet Air</option>
                        <option value="Bamboo Airways">Bamboo Airways</option>
                        <option value="Pacific Airlines">Pacific Airlines</option>
                        <option value="Vietravel Airlines">Vietravel Airlines</option>
                    </select>
                </div>

                <input type="hidden" name="airline_logo" id="airline_logo">
                    <div class="col-md-3 mb-3">
                       <label for="from" class="form-label">Điểm đi</label>
                       <select name="from" class="form-select" required>
                            <option value="">Chọn điểm đi</option>
                            <option value="TP. Hồ Chí Minh (SGN)">TP. Hồ Chí Minh (SGN)</option>
                            <option value="Hà Nội (HAN)">Hà Nội (HAN)</option>
                            <option value="Đà Nẵng (DAD)">Đà Nẵng (DAD)</option>
                            <option value="Huế (HUI)">Huế (HUI)</option>
                            <option value="Phú Quốc (PQC)">Phú Quốc (PQC)</option>
                            <option value="Nha Trang (CXR)">Nha Trang (CXR)</option>
                            <option value="Quy Nhơn (UIH)">Quy Nhơn (UIH)</option>
                            <option value="Phú Yên (TBB)">Phú Yên (TBB)</option>
                            <option value="Hải Phòng (HPH)">Hải Phòng (HPH)</option>
                            <option value="Cần Thơ (VCA)">Cần Thơ (VCA)</option>
                        </select>

                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="to" class="form-label">Điểm đến</label>
                        <select name="to" class="form-select" required>
                            <option value="">Chọn điểm đi</option>
                            <option value="TP. Hồ Chí Minh (SGN)">TP. Hồ Chí Minh (SGN)</option>
                            <option value="Hà Nội (HAN)">Hà Nội (HAN)</option>
                            <option value="Đà Nẵng (DAD)">Đà Nẵng (DAD)</option>
                            <option value="Huế (HUI)">Huế (HUI)</option>
                            <option value="Phú Quốc (PQC)">Phú Quốc (PQC)</option>
                            <option value="Nha Trang (CXR)">Nha Trang (CXR)</option>
                            <option value="Quy Nhơn (UIH)">Quy Nhơn (UIH)</option>
                            <option value="Phú Yên (TBB)">Phú Yên (TBB)</option>
                            <option value="Hải Phòng (HPH)">Hải Phòng (HPH)</option>
                            <option value="Cần Thơ (VCA)">Cần Thơ (VCA)</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Ngày</label>
                        <input type="text" name="date_range" class="form-control" value="{{ old('date_range') }}" placeholder="VD: 16 - 24 thg 09" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Giá</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Loại vé</label>
                        <select name="trip_type" class="form-select" required>
                            <option value="mot-chieu" {{ old('trip_type') == 'mot-chieu' ? 'selected' : '' }}>Một chiều</option>
                            <option value="khu-hoi" {{ old('trip_type') == 'khu-hoi' ? 'selected' : '' }}>Khứ hồi</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Thêm deal</button>
            </form>
        </div>
    </div>

    {{-- Bảng danh sách deal --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hãng bay</th>
                <th>Logo</th>
                <th>Từ</th>
                <th>Đến</th>
                <th>Ngày</th>
                <th>Giá</th>
                <th>Loại vé</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deals as $deal)
            <tr>
                <td>{{ $deal->id }}</td>
                <td>{{ $deal->airline }}</td>
                <td>
                    @if($deal->airline_logo)
                        <img src="{{ asset('storage/'.$deal->airline_logo) }}" style="height:40px;">
                    @else
                        <span class="text-muted">Không có</span>
                    @endif
                </td>
                <td>{{ $deal->from }}</td>
                <td>{{ $deal->to }}</td>
                <td>{{ $deal->date_range }}</td>
                <td>{{ number_format($deal->price) }} VND</td>
                <td>{{ $deal->trip_type }}</td>
                <td>
                    <a href="{{ route('deals.edit', $deal->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('deals.destroy', $deal->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xoá deal này?')">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    const logoMap = {
        "Vietnam Airlines": "deals/VN.png",
        "Vietjet Air": "deals/vietjet.jfif",
        "Bamboo Airways": "deals/bamboo.png",
        "Pacific Airlines": "deals/pacificair.png",
        "Vietravel Airlines": "deals/VU.png",
    };

    document.getElementById("airline").addEventListener("change", function() {
        const selected = this.value;
        document.getElementById("airline_logo").value = logoMap[selected] || "";
    });
</script>

@endsection
