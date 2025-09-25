@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Quản lý Chuyến Bay Nội Địa</h2>

    {{-- Form thêm --}}
    <!-- <div class="card mb-4">
        <div class="card-header">Thêm chuyến bay mới</div>
        <div class="card-body">
            <form action="{{ route('flights.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Điểm đi</label>
                        <input type="text" name="from" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Điểm đến</label>
                        <input type="text" name="to" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Ngày đi</label>
                        <input type="date" name="departure_date" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Ngày về</label>
                        <input type="date" name="return_date" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Giá</label>
                        <input type="number" name="price" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Thêm chuyến bay</button>
            </form>
        </div>
    </div> -->

    {{-- Bảng danh sách --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Từ</th>
                <th>Đến</th>
                <th>Ngày đi</th>
                <th>Ngày về</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flights as $flight)
            <tr>
                <td>{{ $flight->id }}</td>
                <td>{{ $flight->from }}</td>
                <td>{{ $flight->to }}</td>
                <td>{{ $flight->departure_date }}</td>
                <td>{{ $flight->return_date }}</td>
                <td>
                    <a href="{{ route('flights-noi-dia.edit', $flight->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <!-- <form action="{{ route('flights.destroy', $flight->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xoá chuyến bay này?')">Xoá</button>
                    </form> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
