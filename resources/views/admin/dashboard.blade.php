@extends('layouts.admin')

@section('title', 'Bảng điều khiển')

@section('content')
    <div class="dashboard-header" data-aos="fade-down">
        <h1 class="dashboard-title"><i class="ti ti-dashboard"></i> Bảng điều khiển</h1>
        <div class="user-info">
            <i class="ti ti-user"></i>
            <span>Xin chào, Quản trị viên</span>
            <div class="pulse"></div>
        </div>
    </div>

  <div class="stats-grid">
    <div class="stat-card primary" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-icon">
            <i class="ti ti-shopping-cart"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($totalBookings) }}</div>
            <div class="stat-label">Tổng đơn hàng</div>
            <div class="stat-change positive">
                <i class="ti ti-trending-up"></i> +{{ $bookingGrowth ?? 0 }}% so với tháng trước
            </div>
        </div>
    </div>
    
    <div class="stat-card success" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-icon">
            <i class="ti ti-users"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($totalUsers) }}</div>
            <div class="stat-label">Số lượng người dùng</div>
            <div class="stat-change positive">
                <i class="ti ti-trending-up"></i> +{{ $userGrowth ?? 0 }}% so với tháng trước
            </div>
        </div>
    </div>
    
    <div class="stat-card warning" data-aos="fade-up" data-aos-delay="300">
        <div class="stat-icon">
            <i class="ti ti-currency-dollar"></i>
        </div>
        <div class="stat-info">
       <div class="stat-value">{{ $totalRevenue}} VND</div>
            <div class="stat-label">Tổng doanh thu</div>
            <div class="stat-change positive">
                <i class="ti ti-trending-up"></i> +12.5% so với tháng trước
            </div>
        </div>
    </div>
    
    <div class="stat-card secondary" data-aos="fade-up" data-aos-delay="400">
        <div class="stat-icon">
            <i class="ti ti-history"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ number_format($recentHistories) }}</div>
            <div class="stat-label">Thao tác gần đây</div>
            <div class="stat-change negative">
                <i class="ti ti-trending-down"></i> -{{ $historyGrowth ?? 0 }}% so với tháng trước
            </div>
        </div>
    </div>
</div>


    <div class="chart-grid">
        <div class="card" data-aos="fade-right" data-aos-delay="500">
            <h3 class="card-title"><i class="ti ti-chart-line"></i> Thống kê doanh thu</h3>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
        
       <div class="card" data-aos="fade-left" data-aos-delay="500">
    <h3 class="card-title"><i class="ti ti-activity"></i> Hoạt động gần đây</h3>
    <ul class="recent-activities">
        @foreach($latestActivities as $activity)
            <li class="activity-item activity-primary">
                <div class="activity-icon">
                    <i class="ti ti-history"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">{{ $activity->action }} - {{ $activity->table_name }}</div>
                    <div class="activity-time">{{ \Carbon\Carbon::parse($activity->acted_at)->diffForHumans() }}</div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

    </div>
<div class="card" data-aos="fade-up" data-aos-delay="600">
    <h3 class="card-title"><i class="ti ti-report-analytics"></i> Doanh thu theo tháng</h3>
    <table class="revenue-table">
        <thead>
            <tr>
                <th>Tháng</th>
                <th>Doanh thu</th>
                <th>Tăng trưởng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyRevenue as $item)
                <tr>
                    <td>Tháng {{ $item->month }}/{{ $item->year }}</td>
                    <td><strong>{{ number_format($item->total, 0, ',', '.') }} ₫</strong></td>
                    <td>
                        @if($item->growth > 0)
                            <span class="badge badge-success">+{{ $item->growth }}%</span>
                        @elseif($item->growth < 0)
                            <span class="badge badge-danger">{{ $item->growth }}%</span>
                        @else
                            <span class="badge badge-secondary">0%</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



   <script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // ===== DỮ LIỆU TỪ LARAVEL =====
        const labels = @json($labels);
        const data = @json($data);

        // ===== VẼ BIỂU ĐỒ =====
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: data,
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: '#3b82f6',
                    borderWidth: 3,
                    tension: 0.3,
                    pointBackgroundColor: '#3b82f6',
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return `Doanh thu: ${context.raw.toLocaleString()} VND`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { drawBorder: false },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' ₫';
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // ===== HIỆU ỨNG SỐ ĐẾM =====
        const statValues = document.querySelectorAll('.stat-value');
        const options = { threshold: 0.5 };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const finalValue = parseInt(el.textContent.replace(/\D/g, '')) || 0;
                    const duration = 2000;
                    const step = finalValue / (duration / 16);
                    let current = 0;

                    const timer = setInterval(() => {
                        current += step;
                        if (current >= finalValue) {
                            clearInterval(timer);
                            el.textContent = finalValue.toLocaleString();
                        } else {
                            el.textContent = Math.floor(current).toLocaleString();
                        }
                    }, 16);

                    observer.unobserve(el);
                }
            });
        }, options);

        statValues.forEach(value => observer.observe(value));
    });
</script>

@endsection
