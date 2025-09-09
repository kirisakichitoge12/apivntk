@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Sửa Deal quốc tế #{{ $deal->id }}</h1>

    <form action="{{ route('international-deals.update', $deal->id) }}" method="POST" enctype="multipart/form-data">
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
                    <option value="Singapore Airlines" {{ $deal->airline == 'Singapore Airlines' ? 'selected' : '' }}>Singapore Airlines</option>
                    <option value="Korean Air" {{ $deal->airline == 'Korean Air' ? 'selected' : '' }}>Korean Air</option>
                    <option value="Asiana Airlines" {{ $deal->airline == 'Asiana Airlines' ? 'selected' : '' }}>Asiana Airlines</option>
                    <option value="Japan Airlines" {{ $deal->airline == 'Japan Airlines' ? 'selected' : '' }}>Japan Airlines</option>
                    <option value="Qatar Airways" {{ $deal->airline == 'Qatar Airways' ? 'selected' : '' }}>Qatar Airways</option>
                    <option value="Lufthansa" {{ $deal->airline == 'Lufthansa' ? 'selected' : '' }}>Lufthansa</option>
                    <option value="Air France" {{ $deal->airline == 'Air France' ? 'selected' : '' }}>Air France</option>
                    <option value="Qantas" {{ $deal->airline == 'Qantas' ? 'selected' : '' }}>Qantas</option>
                    <option value="United Airlines" {{ $deal->airline == 'United Airlines' ? 'selected' : '' }}>United Airlines</option>
                </select>
            </div>

            <input type="hidden" name="airline_logo" id="airline_logo" value="{{ $deal->airline_logo }}">

            <div class="col-md-3 mb-3">
                <label for="from" class="form-label">Điểm đi</label>
                <select name="from" class="form-select" required>
                    <option value="">Chọn điểm đi</option>
                    <option value="TP. Hồ Chí Minh (SGN)" {{ old('from', $deal->from) == 'TP. Hồ Chí Minh (SGN)' ? 'selected' : '' }}>TP. Hồ Chí Minh (SGN)</option>
                    <option value="Hà Nội (HAN)" {{ old('from', $deal->from) == 'Hà Nội (HAN)' ? 'selected' : '' }}>Hà Nội (HAN)</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label for="to" class="form-label">Điểm đến</label>
                <select name="to" class="form-select" required>
                    <option value="">Chọn điểm đến quốc tế</option>
                    <option value="Bangkok (BKK)" {{ old('to', $deal->to) == 'Bangkok (BKK)' ? 'selected' : '' }}>Bangkok (BKK), Thái Lan</option>
                    <option value="Singapore (SIN)" {{ old('to', $deal->to) == 'Singapore (SIN)' ? 'selected' : '' }}>Singapore (SIN)</option>
                    <option value="Seoul (ICN)" {{ old('to', $deal->to) == 'Seoul (ICN)' ? 'selected' : '' }}>Seoul (ICN), Hàn Quốc</option>
                    <option value="Tokyo (NRT/HND)" {{ old('to', $deal->to) == 'Tokyo (NRT/HND)' ? 'selected' : '' }}>Tokyo (NRT/HND), Nhật Bản</option>
                    <option value="Bắc Kinh (PEK)" {{ old('to', $deal->to) == 'Bắc Kinh (PEK)' ? 'selected' : '' }}>Bắc Kinh (PEK), Trung Quốc</option>
                    <option value="Paris (CDG)" {{ old('to', $deal->to) == 'Paris (CDG)' ? 'selected' : '' }}>Paris (CDG), Pháp</option>
                    <option value="Frankfurt (FRA)" {{ old('to', $deal->to) == 'Frankfurt (FRA)' ? 'selected' : '' }}>Frankfurt (FRA), Đức</option>
                    <option value="Sydney (SYD)" {{ old('to', $deal->to) == 'Sydney (SYD)' ? 'selected' : '' }}>Sydney (SYD), Úc</option>
                    <option value="Doha (DOH)" {{ old('to', $deal->to) == 'Doha (DOH)' ? 'selected' : '' }}>Doha (DOH), Qatar</option>
                    <option value="Los Angeles (LAX)" {{ old('to', $deal->to) == 'Los Angeles (LAX)' ? 'selected' : '' }}>Los Angeles (LAX), Mỹ</option>
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
        <a href="{{ route('international-deals.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
    const logoMap = {
        "Vietnam Airlines": "deals/VN.png",
        "Vietjet Air": "deals/vietjet.jfif",
        "Bamboo Airways": "deals/bamboo.png",
        "Pacific Airlines": "deals/pacificair.png",
        "Vietravel Airlines": "deals/VU.png",
        "Singapore Airlines": "deals/singapore.png",
        "Korean Air": "deals/koreanair.png",
        "Asiana Airlines": "deals/asiana.png",
        "Japan Airlines": "deals/japan.png",
        "Qatar Airways": "deals/qatar.png",
        "Lufthansa": "deals/lufthansa.png",
        "Air France": "deals/airfrance.png",
        "Qantas": "deals/qantas.png",
        "United Airlines": "deals/united.png",
    };

    document.getElementById("airline").addEventListener("change", function() {
        const selected = this.value;
        document.getElementById("airline_logo").value = logoMap[selected] || "";
    });
</script>
@endsection
