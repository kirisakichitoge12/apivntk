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

                  {{-- Modal Chi tiết --}}
                <div class="modal fade" id="bookingDetailModal{{ $booking->id }}" tabindex="-1" aria-labelledby="bookingDetailModalLabel{{ $booking->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Chi tiết đơn hàng #{{ $booking->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">

                                {{-- 1. Thông tin khách hàng --}}
                                <h6 class="fw-bold border-bottom pb-1">Thông tin khách hàng</h6>
                                <p>Họ và tên: {{ $booking->guest_name }}</p>
                                <p>CCCD/Hộ chiếu: {{ $booking->guest_identity ?? '—' }}</p>
                                <p>Số điện thoại: {{ $booking->guest_phone }}</p>
                                <p>Email: {{ $booking->guest_email }}</p>
                                <p>Địa chỉ: {{ $booking->guest_address }}</p>

                           @if($booking->airOptions->count())
                            <h6 class="fw-bold border-bottom pb-1 mt-3">Chuyến bay</h6>
                            <ul>
                                @foreach($booking->airOptions as $i => $air)
                                    @php
                                        // Lấy ghế theo thứ tự chuyến bay
                                        $seats = $booking->passengers
                                            ->flatMap->preSeats
                                            ->values(); // đảm bảo index chuẩn

                                        // Lấy ghế tương ứng với chuyến bay hiện tại
                                        $firstSeat = $seats->get($i);
                                    @endphp

                                    <li>
                                        {{ $i === 0 ? 'Chuyến đi' : 'Chuyến về' }}:
                                        {{ $firstSeat->start_point ?? '' }} → {{ $firstSeat->end_point ?? '' }}
                                        (Hãng: {{ $firstSeat->airline ?? '—' }})

                                        {{-- Danh sách ghế --}}
                                        @if($firstSeat)
                                            <ul>
                                                <li>Ghế: {{ $firstSeat->name }} - {{ number_format($firstSeat->price, 0, ',', '.') }} {{ $firstSeat->currency }}</li>
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif


                                {{-- 3. Dịch vụ --}}
                                <h6 class="fw-bold border-bottom pb-1 mt-3">Dịch vụ kèm theo</h6>
                                @foreach($booking->passengers as $passenger)
                                    <p><strong>Hành khách:</strong> {{ $passenger->full_name }}</p>

                                    {{-- Ghế ngồi --}}
                                    @if($passenger->preSeats->count())
                                        <p><u>Ghế ngồi:</u></p>
                                        <ul>
                                            @foreach($passenger->preSeats as $seat)
                                                <li>{{ $seat->name }} - {{ number_format($seat->price, 0, ',', '.') }} {{ $seat->currency }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    {{-- Hành lý --}}
                                    @if($passenger->baggages->count())
                                        <p><u>Hành lý:</u></p>
                                        <ul>
                                            @foreach($passenger->baggages as $bag)
                                                <li>{{ $bag->name }} - {{ number_format($bag->price, 0, ',', '.') }} {{ $bag->currency }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    {{-- Dịch vụ khác --}}
                                    @if($passenger->services->count())
                                        <p><u>Dịch vụ khác:</u></p>
                                        <ul>
                                            @foreach($passenger->services as $service)
                                                <li>{{ $service->name }} - {{ number_format($service->price, 0, ',', '.') }} {{ $service->currency }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endforeach

                                {{-- 4. Hóa đơn --}}
                                @if($booking->invoice)
                                    <h6 class="fw-bold border-bottom pb-1 mt-3">Hóa đơn</h6>
                                    <p>Công ty: {{ $booking->invoice->company_name }}</p>
                                    <p>MST: {{ $booking->invoice->company_tax_code }}</p>
                                    <p>Địa chỉ: {{ $booking->invoice->company_address }}</p>
                                @endif

                                {{-- 5. Tổng tiền --}}
                                <h6 class="fw-bold border-bottom pb-1 mt-3">Tổng tiền</h6>
                                <p>Tổng tiền từng chặng: (nếu cần hiển thị chi tiết)</p>
                                <p class="fw-bold">Tổng thanh toán: {{ number_format($booking->total_price, 0, ',', '.') }} {{ $booking->currency }}</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>

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

<style>
    table.table td, table.table th {
        white-space: nowrap;
        vertical-align: middle;
    }
</style>
@endsection
