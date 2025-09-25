@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Sửa chuyến bay #{{ $flight->id }}</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('flights-noi-dia.update', $flight->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Điểm đi</label>
                        <input type="text" name="from" class="form-control" value="{{ old('from', $flight->from) }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Điểm đến</label>
                        <input type="text" name="to" class="form-control" value="{{ old('to', $flight->to) }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Ngày đi</label>
                        <input type="text" name="departure_date" class="form-control" value="{{ old('departure_date', $flight->departure_date) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Ngày về</label>
                        <input type="text" name="return_date" class="form-control" value="{{ old('return_date', $flight->return_date) }}">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('flights-noi-dia.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection
