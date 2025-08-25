<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thông tin chuyến bay</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap');
    
    body {
        font-family: 'Be Vietnam Pro', sans-serif !important;
        background-color: #f8fafc;
        margin: 0;
        padding: 0;
        color: #334155;
        line-height: 1.6;
    }
    .container {
     
        background: #fff;
        margin: 30px auto;
        padding: 40px 50px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    }
    .logo {
        text-align: center;
        margin-bottom: 30px;
    }
    .logo img {
        max-height: 90px;
    }
    h2 {
        color: #2563eb;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 24px;
    }
    .divider {
        border-top: 1.5px solid #e2e8f0;
        margin: 25px 0;
    }
    .customer-block {
        margin-bottom: 25px;
        background: #f8fafc;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #2563eb;
    }
    .customer-block p {
        margin: 8px 0;
        font-size: 15px;
        color: #475569;
    }
    .customer-block strong {
        color: #1e293b;
        font-weight: 500;
        display: inline-block;
        width: 120px;
    }
    .section-title {
        background: linear-gradient(90deg, #2563eb, #3b82f6);
        color: white;
        padding: 10px 15px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 16px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 12px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    th {
        background-color: #f1f5f9;
        font-weight: 500;
        color: #1e293b;
        font-size: 14px;
    }
    th, td {
        padding: 14px 16px;
        text-align: left;
        font-size: 14.5px;
        border-bottom: 1px solid #e2e8f0;
    }
    tr:last-child td {
        border-bottom: none;
    }
    .footer {
        font-size: 13.5px;
        color: #64748b;
        text-align: center;
        border-top: 1px solid #e2e8f0;
        padding-top: 20px;
        margin-top: 30px;
        line-height: 1.7;
    }
    .highlight {
        color: #2563eb;
        font-weight: 500;
    }
    .thank-you {
        font-size: 15.5px;
        line-height: 1.7;
        margin-bottom: 25px;
        color: #475569;
    }
    a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="container">

    <!-- Logo -->
    <div class="logo" style="background-color: #ffffff;">
        <img src="https://apii.hungthinhsecurity.com/storage/app/public/uploads/logo-vietnam-tickets.png" alt="Vietnam Tickets Logo">
    </div>

    <!-- Kính gửi & Cảm ơn -->
    <div class="customer-block">
       <p><strong>Kính gửi:</strong> {{ $booking->guest_name }}</p>
       <p><strong>Số điện thoại:</strong> {{ $booking->guest_phone }}</p>
       <p><strong>Email:</strong> {{ $booking->guest_email }}</p>
       <p><strong>Địa chỉ:</strong> {{ $booking->guest_address }}</p>
    </div>

    <div class="divider"></div>

    <p class="thank-you">
        Cảm ơn Quý khách đã tin tưởng đặt vé máy bay tại 
        <span class="highlight">Vietnam Tickets</span>. 
        Dưới đây là thông tin chi tiết chuyến bay của Quý khách:
    </p>






    @if(!empty($booking->flights) && count($booking->flights) > 2)

    {{-- ✅ Trường hợp nhiều hơn 2 chặng: dùng foreach --}}
    @foreach($booking->flights as $index => $flight)
        @php
            $route = ($flight->start_point ?? '') . '-' . ($flight->end_point ?? '');
        @endphp

        <div class="flight-info" style="margin-top:30px;">
            <div class="section-title">
                ✈️ Chặng {{ $index + 1 }}: {{ $flight->start_city ?? '' }} → {{ $flight->end_city ?? '' }}
            </div>

            <table>
                <tr>
                    <th>Đi từ</th>
                    <td>{{ $flight->start_city ?? '' }} ({{ $flight->start_point ?? '' }})</td>
                </tr>
                <tr>
                    <th>Đến</th>
                    <td>{{ $flight->end_city ?? '' }} ({{ $flight->end_point ?? '' }})</td>
                </tr>
                <tr>
                    <th>Ngày giờ xuất phát</th>
                    <td>{{ optional($flight->start_date)->format('d/m/Y H:i') ?? '' }}</td>
                </tr>
                <tr>
                    <th>Hãng hàng không</th>
                    <td>{{ $flight->airline_name ?? '' }} ({{ $flight->flight_number ?? '' }})</td>
                </tr>
                {{-- Ghế / Hành lý / Dịch vụ / Vé: giữ nguyên code bạn đã viết --}}
            </table>
        </div>
    @endforeach

@elseif(!empty($booking->flights))

       <!-- Chuyến đi -->
<div class="flight-info">
    <div class="section-title">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plane-icon lucide-plane"><path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/></svg> Thông tin chuyến đi
    </div>

    @if(isset($booking->flights[0]))
        @php
            $routeGo = ($booking->flights[0]->start_point ?? '') . '-' . ($booking->flights[0]->end_point ?? '');
        @endphp

        <table>
            <tr>
                <th>Đi từ</th>
                <td>{{ $booking->flights[0]->start_city ?? '' }} ({{ $booking->flights[0]->start_point ?? '' }})</td>
            </tr>
            <tr>
                <th>Đến</th>
                <td>{{ $booking->flights[0]->end_city ?? '' }} ({{ $booking->flights[0]->end_point ?? '' }})</td>
            </tr>
            <tr>
                <th>Ngày giờ xuất phát</th>
                <td>{{ optional($booking->flights[0]->start_date)->format('d/m/Y H:i') ?? '' }}</td>
            </tr>
            <tr>
                <th>Hãng hàng không</th>
                <td>{{ $booking->flights[0]->airline_name ?? '' }} ({{ $booking->flights[0]->flight_number ?? '' }})</td>
            </tr>

            {{-- Ghế --}}
            <tr>
                <th>Ghế ngồi</th>
                <td>
                    @forelse(($details->list_pre_seat ?? []) as $seat)
                        @if(($seat['Route'] ?? '') === $routeGo)
                            {{ $seat['Code'] ?? $seat['Name'] }} - {{ $seat['PassengerName'] }}
                            ({{ number_format((float)($seat['Price'] ?? 0)) }} VND)<br>
                        @endif
                    @empty
                        Không có
                    @endforelse
                </td>
            </tr>

            {{-- Hành lý --}}
            <tr>
                <th>Hành lý</th>
                <td>
                    @forelse(($details->list_baggage ?? []) as $bag)
                        @if(($bag['Route'] ?? '') === $routeGo)
                            {{ $bag['Name'] }} - {{ $bag['PassengerName'] }}
                            ({{ number_format((float)($bag['Price'] ?? 0)) }} VND)<br>
                        @endif
                    @empty
                        Không có
                    @endforelse
                </td>
            </tr>

            {{-- Dịch vụ --}}
            <tr>
                <th>Dịch vụ</th>
                <td>
                    @forelse(($details->list_service ?? []) as $sv)
                        @if(($sv['Route'] ?? '') === $routeGo)
                            {{ $sv['Name'] }} - {{ $sv['PassengerName'] }}
                            ({{ number_format((float)($sv['Price'] ?? 0)) }} VND)<br>
                        @endif
                    @empty
                        Không có
                    @endforelse
                </td>
            </tr>
            {{-- Chi tiết vé --}}
            <tr>
                <th>Chi tiết vé</th>
                <td>
                    @php
                        $fares = collect($details->list_fare ?? [])->where('Route', $routeGo);
                    @endphp

                    @forelse($fares as $fare)
                        @foreach($fare['ListFarePax'] ?? [] as $pax)
                            {{ $pax['PaxName'] ?? '' }}:  
                            giá vé/1 khách là {{ number_format((float)str_replace(',', '', $pax['TotalFare'] ?? 0)) }} VND/1 vé
                            <br>
                        @endforeach
                    @empty
                        Không có
                    @endforelse
                </td>
            </tr>

        </table>
    @else
        <p><em>Chưa có thông tin chuyến đi</em></p>
    @endif
</div>


<!-- Chuyến về -->
<div class="flight-info" style="margin-top:30px;">
    <div class="section-title"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plane-icon lucide-plane"><path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/></svg> Thông tin chuyến về</div>

    @if(isset($booking->flights[1]))
        @php
            $routeReturn = ($booking->flights[1]->start_point ?? '') . '-' . ($booking->flights[1]->end_point ?? '');
        @endphp

        <table>
            <tr>
                <th>Đi từ</th>
                <td>{{ $booking->flights[1]->start_city ?? '' }} ({{ $booking->flights[1]->start_point ?? '' }})</td>
            </tr>
            <tr>
                <th>Đến</th>
                <td>{{ $booking->flights[1]->end_city ?? '' }} ({{ $booking->flights[1]->end_point ?? '' }})</td>
            </tr>
            <tr>
                <th>Ngày giờ xuất phát</th>
                <td>{{ optional($booking->flights[1]->start_date)->format('d/m/Y H:i') ?? '' }}</td>
            </tr>
            <tr>
                <th>Hãng hàng không</th>
                <td>{{ $booking->flights[1]->airline_name ?? '' }} ({{ $booking->flights[1]->flight_number ?? '' }})</td>
            </tr>

            {{-- Ghế --}}
            <tr>
                <th>Ghế ngồi</th>
                <td>
                    @forelse(($details->list_pre_seat ?? []) as $seat)
                        @if(($seat['Route'] ?? '') === $routeReturn)
                            {{ $seat['Code'] ?? $seat['Name'] }} - {{ $seat['PassengerName'] }}
                            ({{ number_format((float)($seat['Price'] ?? 0)) }} VND)<br>
                        @endif
                    @empty
                        Không có
                    @endforelse
                </td>
            </tr>

            {{-- Hành lý --}}
            <tr>
                <th>Hành lý</th>
                <td>
                    @forelse(($details->list_baggage ?? []) as $bag)
                        @if(($bag['Route'] ?? '') === $routeReturn)
                            {{ $bag['Name'] }} - {{ $bag['PassengerName'] }}
                            ({{ number_format((float)($bag['Price'] ?? 0)) }} VND)<br>
                        @endif
                    @empty
                        Không có
                    @endforelse
                </td>
            </tr>

            {{-- Dịch vụ --}}
            <tr>
                <th>Dịch vụ</th>
                <td>
                    @forelse(($details->list_service ?? []) as $sv)
                        @if(($sv['Route'] ?? '') === $routeReturn)
                            {{ $sv['Name'] }} - {{ $sv['PassengerName'] }}
                            ({{ number_format((float)($sv['Price'] ?? 0)) }} VND)<br>
                        @endif
                    @empty
                        Không có
                    @endforelse
                </td>
            </tr>
            {{-- Chi tiết vé (Chuyến về) --}}
            <tr>
                <th>Chi tiết vé (chuyến về)</th>
                <td>
                    @php
                        $routeReturn = $booking->flights[1]->start_point . '-' . $booking->flights[1]->end_point;
                        $faresReturn = collect($details->list_fare ?? [])->where('Route', $routeReturn);
                    @endphp

                    @forelse($faresReturn as $fare)
                        @foreach($fare['ListFarePax'] ?? [] as $pax)
                            {{ $pax['PaxName'] ?? '' }}: 
                             giá vé/1 khách là {{ number_format((float)str_replace(',', '', $pax['TotalFare'] ?? 0)) }} VND/1 vé
                            <br>
                        @endforeach
                    @empty
                        Không có
                    @endforelse
                </td>
            </tr>

        </table>
    @else
        <p><em>Chưa có thông tin chuyến về</em></p>
    @endif
</div>


@else
    <p><em>Chưa có thông tin chuyến bay</em></p>
@endif


 



@if(!empty($details->list_baggage))
<div class="flight-info" style="margin-top:30px;">
    <div class="section-title"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-luggage-icon lucide-luggage"><path d="M6 20a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2"/><path d="M8 18V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v14"/><path d="M10 20h4"/><circle cx="16" cy="20" r="2"/><circle cx="8" cy="20" r="2"/></svg> Hành lý ký gửi</div>
    <table>
        <tr>
            <th>Chuyến</th>
            <th>Tên dịch vụ</th>
            <th>Hành khách</th>
            <th>Giá</th>
        </tr>
        @foreach($details->list_baggage as $bag)
        <tr>
            <td>{{ $bag['Route'] ?? '' }}</td>
            <td>{{ $bag['Name'] ?? '' }}</td>
            <td>{{ $bag['PassengerName'] ?? '' }}</td>
            <td>{{ number_format((float)($bag['Price'] ?? 0)) }} VND</td>
        </tr>
        @endforeach
    </table>
</div>
@endif

@if(!empty($details->list_service))
<div class="flight-info" style="margin-top:30px;">
    <div class="section-title"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-check-icon lucide-clipboard-check"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/></svg> Dịch vụ mua thêm</div>
    <table>
        <tr>
            <th>Chuyến</th>
            <th>Tên dịch vụ</th>
            <th>Hành khách</th>
            <th>Giá</th>
        </tr>
        @foreach($details->list_service as $sv)
        <tr>
            <td>{{ $sv['Route'] ?? '' }}</td>
            <td>{{ $sv['Name'] ?? '' }}</td>
            <td>{{ $sv['PassengerName'] ?? '' }}</td>
            <td>{{ number_format((float)($sv['Price'] ?? 0)) }} VND</td>
        </tr>
        @endforeach
    </table>
</div>
@endif

@if(!empty($details->list_pre_seat))
<div class="flight-info" style="margin-top:30px;">
    <div class="section-title"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy-check-icon lucide-copy-check"><path d="m12 15 2 2 4-4"/><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg> Ghế ngồi đã chọn</div>
    <table>
        <tr>
            <th>Chuyến</th>
            <th>Mã ghế</th>
            <th>Hành khách</th>
            <th>Giá</th>
        </tr>
        @foreach($details->list_pre_seat as $seat)
        <tr>
            <td>{{ $seat['Route'] ?? '' }}</td>
            <td>{{ $seat['Code'] ?? $seat['Name'] ?? '' }}</td>
            <td>{{ $seat['PassengerName'] ?? '' }}</td>
            <td>{{ number_format((float)($seat['Price'] ?? 0)) }} VND</td>
        </tr>
        @endforeach
    </table>
</div>
@endif

@if(!empty($details))
<div class="flight-info" style="margin-top:30px;">
    <div class="section-title"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket-check-icon lucide-ticket-check"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="m9 12 2 2 4-4"/></svg> Chi tiết phí</div>
  @php
    $baggage = (float)str_replace(',', '', ($details->baggage_price ?? 0));
    $service = (float)str_replace(',', '', ($details->service_price ?? 0));
    $seat    = (float)str_replace(',', '', ($details->seat_price ?? 0));
    $total   = (float)str_replace(',', '', ($details->total_fare ?? 0));

    $ticketFare = $total - ($baggage + $service + $seat);
@endphp

<table>
    <tr>
        <th>Hạng mục</th>
        <th>Số tiền (VND)</th>
    </tr>
    <tr>
        <td>Giá vé</td>
        <td>{{ number_format($ticketFare) }}</td>
    </tr>
    <tr>
        <td>Phí hành lý</td>
        <td>{{ number_format($baggage) }}</td>
    </tr>
    <tr>
        <td>Phí dịch vụ</td>
        <td>{{ number_format($service) }}</td>
    </tr>
    <tr>
        <td>Phí ghế ngồi</td>
        <td>{{ number_format($seat) }}</td>
    </tr>
    <tr>
        <th>Tổng cộng</th>
        <th>{{ number_format($total) }}</th>
    </tr>
</table>

</div>
@endif

    <!-- Footer -->
    <div class="footer">
        <p><strong>Vietnam Tickets</strong> - Đại lý vé máy bay nội địa & quốc tế uy tín</p>
        <p>Trụ sở: 69 Võ Thị Sáu, P.6, Q.3, TP.HCM | Chi nhánh: 173 Nguyễn Thị Minh Khai, Q.1, TP.HCM</p>
        <p>Điện thoại: 1900 3173 | (028) 3936 2020 | Email: vietnamtickets16@gmail.com</p>
        <p>Website: <a href="https://vietnam-tickets.com">vietnam-tickets.com</a></p>
    </div>
</div>

</body>
</html>
