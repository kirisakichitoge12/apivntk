<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flexy Free Bootstrap Admin Template by WrapPixel</title>
  <link rel="shortcut icon" type="image/png" href="/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="/assets/css/styles.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600&display=swap" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<style>
        
body {
    font-family: 'Be Vietnam Pro', sans-serif;
    background-color: #f9fafb;
    color: #374151; /* đen nhẹ */
}

.sidebar-container {
    width: 350px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: #ffffff; /* nền trắng */
    color: #374151; /* chữ đen nhẹ */
    overflow: hidden;
    border-right: 1px solid #e5e7eb;
    box-shadow: 2px 0 6px rgba(0, 0, 0, 0.05);
    z-index: 1000;
}

.sidebar-nav {
    padding: 15px 0;
    height: 100%;
}

.nav-small-cap {
    padding: 20px 20px 15px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 1px solid #f3f4f6;
    margin-bottom: 10px;
    color: #6b7280; /* xám */
}

.nav-small-cap-icon {
    color: #2563eb; /* xanh primary */
}

.sidebar-item {
    list-style: none;
    margin: 5px 10px;
    border-radius: 8px;
    overflow: hidden;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    color: #374151; /* đen nhẹ */
    text-decoration: none;
    transition: all 0.2s ease;
    border-radius: 8px;
}

.sidebar-link:hover {
    background-color: #f3f4f6; /* xám nhạt */
    color: #111827; /* đen đậm */
}

.sidebar-link.active {
    background-color: #e0f2fe; /* xanh nhạt */
    color: #2563eb;
    font-weight: 500;
}

.sidebar-link i {
    font-size: 20px;
    width: 24px;
    text-align: center;
    color: #2563eb; /* xanh primary */
}

.hide-menu {
    font-size: 15px;
    font-weight: 500;
    flex: 1;
}

.sidebar-item.has-submenu .sidebar-link {
    justify-content: space-between;
}

.submenu-arrow {
    font-size: 16px;
    transition: transform 0.3s ease;
    color: #9ca3af; /* mũi tên xám */
}

.sidebar-item.has-submenu.open .submenu-arrow {
    transform: rotate(180deg);
}

.submenu {
    display: none;
    background-color: #f9fafb;
    border-radius: 8px;
    margin: 5px 0;
    padding: 5px 0;
}

.sidebar-item.has-submenu.open .submenu {
    display: block;
    animation: fadeIn 0.3s ease;
}

.submenu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px 10px 45px;
    color: #4b5563;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.2s;
    border-radius: 6px;
    margin: 2px 8px;
}

.submenu a:hover {
    background-color: #e5e7eb;
    color: #111827;
}

.submenu a i {
    font-size: 16px;
    color: #2563eb;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Nội dung chính */
.main-content {
    margin-left: 280px;
    padding: 30px;
    min-height: 100vh;
    background: #f9fafb;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e5e7eb;
}

.dashboard-title {
    font-size: 24px;
    font-weight: 700;
    color: #111827;
}

.card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    margin-bottom: 25px;
}

.card-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #111827;
}

.card-content {
    color: #374151;
    line-height: 1.6;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    background-color: #e0f2fe;
    color: #2563eb;
}

.stat-info {
    flex: 1;
}

.stat-value {
    font-size: 22px;
    font-weight: 700;
    color: #111827;
}

.stat-label {
    font-size: 14px;
    color: #6b7280;
}
  :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #64748b;
            --light: #f8fafc;
            --dark: #1e293b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
            --border-radius: 12px;
            --box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            padding: 20px;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        
        .dashboard-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .dashboard-title i {
            color: var(--primary);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            background: var(--light);
            border-radius: 30px;
            font-weight: 500;
        }
        
        .user-info i {
            color: var(--primary);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 24px;
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
        }
        
        .stat-card.primary::before { background-color: var(--primary); }
        .stat-card.success::before { background-color: var(--success); }
        .stat-card.warning::before { background-color: var(--warning); }
        .stat-card.secondary::before { background-color: var(--secondary); }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }
        
        .stat-card.primary .stat-icon { background-color: #dbeafe; color: var(--primary); }
        .stat-card.success .stat-icon { background-color: #d1fae5; color: var(--success); }
        .stat-card.warning .stat-icon { background-color: #fef3c7; color: var(--warning); }
        .stat-card.secondary .stat-icon { background-color: #e2e8f0; color: var(--secondary); }
        
        .stat-info {
            flex: 1;
        }
        
        .stat-value {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .stat-label {
            font-size: 16px;
            color: var(--secondary);
            font-weight: 500;
        }
        
        .stat-change {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            margin-top: 8px;
            font-weight: 500;
        }
        
        .stat-change.positive { color: var(--success); }
        .stat-change.negative { color: var(--danger); }
        
        .chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background: white;
            border-radius: var(--border-radius);
            padding: 24px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }
        
        .card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .card-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-title i {
            color: var(--primary);
        }
        
        .revenue-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .revenue-table th {
            background-color: #f8fafc;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: var(--secondary);
            border-bottom: 2px solid #e2e8f0;
        }
        
        .revenue-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            font-weight: 500;
        }
        
        .revenue-table tr:last-child td {
            border-bottom: none;
        }
        
        .revenue-table tr:hover {
            background-color: #f1f5f9;
        }
        
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: #d1fae5;
            color: var(--success);
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: var(--danger);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        .recent-activities {
            list-style: none;
        }
        
        .activity-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }
        
        .activity-primary .activity-icon { background-color: #dbeafe; color: var(--primary); }
        .activity-success .activity-icon { background-color: #d1fae5; color: var(--success); }
        .activity-warning .activity-icon { background-color: #fef3c7; color: var(--warning); }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 500;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .activity-time {
            font-size: 12px;
            color: var(--secondary);
        }
        
        .pulse {
            display: block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--success);
            margin-top: 5px;
            position: relative;
        }
        
        .pulse:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: var(--success);
            opacity: 0.6;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }
            70% {
                transform: scale(2.5);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 0;
            }
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .chart-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .dashboard-header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
        }
        /* Sidebar width */
.sidebar-container {
  width: 260px !important;
  background: #fff;
  border-right: 1px solid #ddd;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  overflow-y: auto;
  transition: all 0.3s ease;
  z-index: 1000;
  font-size: 13px; /* chữ nhỏ gọn hơn */
}

/* Link trong sidebar */
.sidebar-container .sidebar-link {
  display: flex;
  align-items: center;
  padding: 8px 15px;
  color: #333;
  text-decoration: none;
  transition: 0.2s;
}

.sidebar-container .sidebar-link:hover {
  background: #f1f1f1;
  color: #0d6efd;
}

/* Submenu */
.sidebar-container .submenu {
  list-style: none;
  padding-left: 20px;
  font-size: 12.5px; /* chữ submenu nhỏ hơn 1 chút */
}

.submenu li a {
  display: flex;
  align-items: center;
  padding: 6px 12px;
  color: #555;
}

.submenu li a:hover {
  color: #0d6efd;
}

.cke_notification.cke_notification_warning {
display: none !important;
} 
</style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
        <aside class="left-siderwe" style="background-color:none !important">
        <!-- Sidebar scroll-->
        <div>
            
            <!-- Sidebar navigation-->
           @include('partials.admin.header')
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
     </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      
      <!--  Header End -->
     <div class="body-wrapper-inner">
  <div class="container" style="min-width:920px; margin:0 auto;">
    @yield('content') 
  </div>
</div>

    
  </div>
   <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý mở/đóng submenu
            const submenuItems = document.querySelectorAll('.sidebar-item.has-submenu');
            
            submenuItems.forEach(item => {
                const link = item.querySelector('.sidebar-link');
                
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    item.classList.toggle('open');
                    
                    // Đóng các submenu khác khi mở một submenu mới
                    submenuItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('open')) {
                            otherItem.classList.remove('open');
                        }
                    });
                });
            });
            
            // Xử lý active menu item
            const menuItems = document.querySelectorAll('.sidebar-link');
            
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Nếu không phải là submenu cha
                    if (!this.parentElement.classList.contains('has-submenu')) {
                        menuItems.forEach(i => i.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });
        });
    </script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/sidebarmenu.js"></script>
  <script src="/assets/js/app.min.js"></script>
  <script src="/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="/assets/js/dashboard.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>