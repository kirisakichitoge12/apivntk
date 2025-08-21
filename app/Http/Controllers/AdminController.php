<?php

namespace App\Http\Controllers;

use App\Models\AdminCustom;
use App\Models\AdminHistory;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
   
   private function calculateGrowth($model, $type = 'bookings')
    {
        // Lấy tháng hiện tại & tháng trước
        $currentMonth = now()->month;
        $lastMonth    = now()->subMonth()->month;

        switch ($type) {
            case 'bookings':
                $current = Booking::whereMonth('created_at', $currentMonth)->count();
                $previous = Booking::whereMonth('created_at', $lastMonth)->count();
                break;

            case 'users':
                $current = User::whereMonth('created_at', $currentMonth)->count();
                $previous = User::whereMonth('created_at', $lastMonth)->count();
                break;

            case 'histories':
                $current = AdminHistory::whereMonth('acted_at', $currentMonth)->count();
                $previous = AdminHistory::whereMonth('acted_at', $lastMonth)->count();
                break;

            case 'revenue':
            $current = DB::table('booking_details')
                ->whereMonth('created_at', $currentMonth)
                ->selectRaw("SUM(CAST(REPLACE(JSON_UNQUOTE(total_fare), ',', '') AS UNSIGNED)) as total")
                ->value('total');

            $previous = DB::table('booking_details')
                ->whereMonth('created_at', $lastMonth)
                ->selectRaw("SUM(CAST(REPLACE(JSON_UNQUOTE(total_fare), ',', '') AS UNSIGNED)) as total")
                ->value('total');
            break;


            default:
                $current = $previous = 0;
        }

        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }

    public function dashboard()
    {
        // Tổng số đơn hàng
        $totalBookings = Booking::count();

        // Tổng số người dùng
        $totalUsers = User::count();

        // Tổng số thao tác gần đây (30 ngày)
        $recentHistories = AdminHistory::where('acted_at', '>=', now()->subDays(30))->count();

        // Tổng doanh thu
        $totalRevenue = DB::table('booking_details')
            ->selectRaw("SUM(CAST(REPLACE(JSON_UNQUOTE(total_fare), ',', '') AS UNSIGNED)) as total_revenue")
            ->value('total_revenue');

       $monthlyRevenue = DB::table('booking_details')
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw("SUM(CAST(REPLACE(JSON_UNQUOTE(total_fare), ',', '') AS UNSIGNED)) as total")
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->take(12)
        ->get();
        $monthlyRevenue = $monthlyRevenue->map(function ($item, $key) use ($monthlyRevenue) {
            $previous = $monthlyRevenue->get($key + 1); // tháng trước đó
            if ($previous && $previous->total > 0) {
                $growth = round((($item->total - $previous->total) / $previous->total) * 100, 1);
            } else {
                $growth = 0;
            }
            $item->growth = $growth;
            return $item;
        });

      $latestActivities = AdminHistory::orderBy('acted_at', 'desc')
        ->take(5)
        ->get();
        // Chuẩn bị dữ liệu cho ChartJS
      $labels = $monthlyRevenue->map(function($item) {
        return 'Tháng ' . $item->month;
       });

      $data = $monthlyRevenue->pluck('total');
        return view('admin.dashboard', [
            'totalBookings'   => $totalBookings,
            'totalUsers'      => $totalUsers,
            'recentHistories' => $recentHistories,
            'totalRevenue'    => $totalRevenue,
            'monthlyRevenue'  => $monthlyRevenue,
            'latestActivities'=> $latestActivities,
            'labels' => $labels,
            'data'   => $data,
            // % thay đổi so với tháng trước
            'bookingGrowth'   => $this->calculateGrowth($monthlyRevenue, 'bookings'),
            'userGrowth'      => $this->calculateGrowth($monthlyRevenue, 'users'),
            'historyGrowth'   => $this->calculateGrowth($monthlyRevenue, 'histories'),
            'revenueGrowth'   => $this->calculateGrowth($monthlyRevenue, 'revenue'),
        ]);
    }

    public function viewhoadon()
    {
        return view("emails.email-invoid");
    }
    public function LoginAdmin()
    {
        return view('login.index');
    }
      public function listUsers()
    {
        $users = User::select('id', 'name', 'phone', 'email', 'email_verification_token', 'created_at')
        ->paginate(15); // tự động phân trang

       $users->setCollection(
        $users->getCollection()->transform(function ($user) {
            $user->status = $user->email_verification_token === null 
                ? '✅ Đã xác thực' 
                : '❌ Chưa xác thực';
            return $user;
        })
    );


        return view('admin.users.index', compact('users'));
    }
    public function listAdmins()
    {
        $admins = AdminCustom::select('id', 'name', 'email', 'is_super_admin', 'created_at')
            ->paginate(15);

        $admins->setCollection(
            $admins->getCollection()->transform(function ($admin) {
                $admin->role = $admin->is_super_admin == 1 
                    ? 'Admin phân quyền' 
                    : 'Admin';
                return $admin;
            })
        );

        return view('admin.admins.index', compact('admins'));
    }

    public function listHistories()
    {
        $histories = AdminHistory::select('id', 'admin_id', 'action', 'table_name', 'details', 'admin_name', 'acted_at')
            ->orderBy('acted_at', 'desc')
            ->paginate(20);

        return view('admin.histories.index', compact('histories'));
    }

}
