@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h3>Chi tiết đơn hàng #{{ $booking->id }}</h3>
    <hr>
    <p><strong>Khu vực:</strong> {{ $booking->guest_area }}</p>
    <p><strong>Tên khách:</strong> {{ $booking->guest_name }}</p>
    <p><strong>Email khách:</strong> {{ $booking->guest_email }}</p>
    <p><strong>Số điện thoại khách:</strong> {{ $booking->guest_phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $booking->guest_address }}</p>
    <p><strong>Ghi chú:</strong> {{ $booking->guest_remark }}</p>
    <hr>
    <p><strong>Email đại lý:</strong> {{ $booking->agent_email }}</p>
    <p><strong>Số điện thoại đại lý:</strong> {{ $booking->agent_phone }}</p>
    <p><strong>Tổng giá:</strong> {{ number_format($booking->total_price, 0, ',', '.') }} {{ $booking->currency }}</p>
    <p><strong>Ngày tạo:</strong> {{ $booking->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Ngày cập nhật:</strong> {{ $booking->updated_at->format('d/m/Y H:i') }}</p>

    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
