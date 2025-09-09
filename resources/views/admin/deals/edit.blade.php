@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Sửa Deal #{{ $deal->id }}</h1>

    <form action="{{ route('deals.update', $deal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
           <div class="col-md-3 mb-3">
                <label class="form-label">Hãng bay</label>
                <select name="airline" class="form-control" id="airline" required>
                    <option value="">-- Chọn hãng bay --</option>
                    <option value="Vietnam Airlines" {{ $deal->airline == 'Vietnam Airlines' ? 'selected' : '' }}>Vietnam Airlines</option>
                    <option value="Vietjet Air" {{ $deal->airline == 'Vietjet Air' ? 'selected' : '' }}>Vietjet Air</option>
                    <option value="Bamboo Airways" {{ $deal->airline == 'Bamboo Airways' ? 'selected' : '' }}>Bamboo Airways</option>
                    <option value="Pacific Airlines" {{ $deal->airline == 'Pacific Airlines' ? 'selected' : '' }}>Pacific Airlines</option>
                    <option value="Vietravel Airlines" {{ $deal->airline == 'Vietravel Airlines' ? 'selected' : '' }}>Vietravel Airlines</option>
                </select>
            </div>

            <input type="hidden" name="airline_logo" id="airline_logo" value="{{ $deal->airline_logo }}">



            <div class="col-md-3 mb-3">
                <label for="from" class="form-label">Điểm đi</label>
                <select name="from" class="form-select" required>
                    <option value="">Chọn điểm đi</option>
                    <option value="TP. Hồ Chí Minh (SGN)" {{ old('from', $deal->from) == 'TP. Hồ Chí Minh (SGN)' ? 'selected' : '' }}>
                        TP. Hồ Chí Minh (SGN)
                    </option>
                    <option value="Hà Nội (HAN)" {{ old('from', $deal->from) == 'Hà Nội (HAN)' ? 'selected' : '' }}>
                        Hà Nội (HAN)
                    </option>
                    <option value="Đà Nẵng (DAD)" {{ old('from', $deal->from) == 'Đà Nẵng (DAD)' ? 'selected' : '' }}>
                        Đà Nẵng (DAD)
                    </option>
                    <option value="Huế (HUI)" {{ old('from', $deal->from) == 'Huế (HUI)' ? 'selected' : '' }}>
                        Huế (HUI)
                    </option>
                    <option value="Phú Quốc (PQC)" {{ old('from', $deal->from) == 'Phú Quốc (PQC)' ? 'selected' : '' }}>
                        Phú Quốc (PQC)
                    </option>
                    <option value="Nha Trang (CXR)" {{ old('from', $deal->from) == 'Nha Trang (CXR)' ? 'selected' : '' }}>
                        Nha Trang (CXR)
                    </option>
                    <option value="Quy Nhơn (UIH)" {{ old('from', $deal->from) == 'Quy Nhơn (UIH)' ? 'selected' : '' }}>
                        Quy Nhơn (UIH)
                    </option>
                    <option value="Phú Yên (TBB)" {{ old('from', $deal->from) == 'Phú Yên (TBB)' ? 'selected' : '' }}>
                        Phú Yên (TBB)
                    </option>
                    <option value="Hải Phòng (HPH)" {{ old('from', $deal->from) == 'Hải Phòng (HPH)' ? 'selected' : '' }}>
                        Hải Phòng (HPH)
                    </option>
                    <option value="Cần Thơ (VCA)" {{ old('from', $deal->from) == 'Cần Thơ (VCA)' ? 'selected' : '' }}>
                        Cần Thơ (VCA)
                    </option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label for="to" class="form-label">Điểm đến</label>
                <select name="to" class="form-select" required>
                <option value="">Chọn điểm đến</option>
                <option value="TP. Hồ Chí Minh (SGN)" {{ old('to', $deal->to) == 'TP. Hồ Chí Minh (SGN)' ? 'selected' : '' }}>
                    TP. Hồ Chí Minh (SGN)
                </option>
                <option value="Hà Nội (HAN)" {{ old('to', $deal->to) == 'Hà Nội (HAN)' ? 'selected' : '' }}>
                    Hà Nội (HAN)
                </option>
                <option value="Đà Nẵng (DAD)" {{ old('to', $deal->to) == 'Đà Nẵng (DAD)' ? 'selected' : '' }}>
                    Đà Nẵng (DAD)
                </option>
                <option value="Huế (HUI)" {{ old('to', $deal->to) == 'Huế (HUI)' ? 'selected' : '' }}>
                    Huế (HUI)
                </option>
                <option value="Phú Quốc (PQC)" {{ old('to', $deal->to) == 'Phú Quốc (PQC)' ? 'selected' : '' }}>
                    Phú Quốc (PQC)
                </option>
                <option value="Nha Trang (CXR)" {{ old('to', $deal->to) == 'Nha Trang (CXR)' ? 'selected' : '' }}>
                    Nha Trang (CXR)
                </option>
                <option value="Quy Nhơn (UIH)" {{ old('to', $deal->to) == 'Quy Nhơn (UIH)' ? 'selected' : '' }}>
                    Quy Nhơn (UIH)
                </option>
                <option value="Phú Yên (TBB)" {{ old('to', $deal->to) == 'Phú Yên (TBB)' ? 'selected' : '' }}>
                    Phú Yên (TBB)
                </option>
                <option value="Hải Phòng (HPH)" {{ old('to', $deal->to) == 'Hải Phòng (HPH)' ? 'selected' : '' }}>
                    Hải Phòng (HPH)
                </option>
                <option value="Cần Thơ (VCA)" {{ old('to', $deal->to) == 'Cần Thơ (VCA)' ? 'selected' : '' }}>
                    Cần Thơ (VCA)
                </option>
            </select>

            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Ngày</label>
                <input type="text" name="date_range" value="{{ old('date_range', $deal->date_range) }}" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price" value="{{ old('price', $deal->price) }}" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Loại vé</label>
                <select name="trip_type" class="form-select" required>
                    <option value="mot-chieu" {{ old('trip_type', $deal->trip_type) == 'mot-chieu' ? 'selected' : '' }}>Một chiều</option>
                    <option value="khu-hoi" {{ old('trip_type', $deal->trip_type) == 'khu-hoi' ? 'selected' : '' }}>Khứ hồi</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Logo hãng bay</label><br>
                @if($deal->airline_logo)
                    <img src="{{ asset('storage/' . $deal->airline_logo) }}" 
                         alt="current-logo" style="height:50px; border-radius:6px; margin-bottom:10px;">
                @endif
                <input type="file" name="airline_logo" class="form-control">
                <small class="text-muted">Nếu không chọn logo mới thì logo cũ sẽ được giữ lại</small>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="{{ route('deals.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
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
