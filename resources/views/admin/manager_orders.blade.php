@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Quản lý đơn hàng vé máy bay</h3>

    <div class="card">
        <div class="card-header">Danh sách đơn hàng</div>
        <div class="card-body" style="overflow-x: auto;">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Kv</th>
                        <th>SĐT khách</th>
                        <th>Email khách</th>
                        <th>Tên khách</th>
                        <th>Địa chỉ</th>
                        <th>Ghi chú</th>
                        <th>Email đại lý</th>
                        <th>SĐT đại lý</th>
                        <th style="min-width: 120px;">Tổng giá</th>
                        <th style="min-width: 80px;">Tiền</th>
                        <th>Ngày tạo</th>
                        <th style="min-width: 150px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->guest_area }}</td>
                        <td>{{ $booking->guest_phone }}</td>
                        <td>{{ $booking->guest_email }}</td>
                        <td>{{ $booking->guest_name }}</td>
                        <td>{{ $booking->guest_address }}</td>
                        <td>{{ $booking->guest_remark }}</td>
                        <td>{{ $booking->agent_email }}</td>
                        <td>{{ $booking->agent_phone }}</td>
                        <td class="text-end fw-bold">{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $booking->currency }}</td>
                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <button 
                                class="btn btn-sm btn-info"
                                data-bs-toggle="modal"
                                data-bs-target="#bookingDetailModal{{ $booking->id }}"
                            >
                                Xem chi tiết
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Phân trang --}}
            <div class="mt-3">
                {{ $bookings->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

{{-- Vòng lặp để render modal ra ngoài table --}}
@foreach ($bookings as $booking)
<div class="modal fade" id="bookingDetailModal{{ $booking->id }}" tabindex="-1" aria-labelledby="bookingDetailModalLabel{{ $booking->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết đơn hàng #{{ $booking->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{-- Include lại view email --}}
                @include('emails.email-invoid-oders', [
                    'booking' => $booking,
                    'passengerCount' => $booking->passengers->count(),
                    'services' => $booking->services ?? collect([]),
                    'details' => $booking->detail ?? null,
                ])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    table.table td, table.table th {
        white-space: nowrap;
        vertical-align: middle;
    }
</style>
@endsection
