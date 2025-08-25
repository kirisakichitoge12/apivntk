<?php
// app/Http/Controllers/AdminAuthController.php
namespace App\Http\Controllers;

use App\Models\AdminCustom;
use App\Models\AdminHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $admin = AdminCustom::where('email', $request->email)->first();

        //    dd($request->password);
        if ($admin && Hash::check(trim($request->password), $admin->password)) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            AdminAuthController::logAction(
                $admin->id,
                $admin->name,   // truyền name
                'đăng nhập',
                'admin_customs',
                'Admin '.$admin->name.' (ID='.$admin->id.') đã đăng nhập'
            );
            return redirect('/');
        }

        return back()->with('error', 'Sai email hoặc mật khẩu');
    }

    public function createAdmin(Request $request)
    {
        $superAdmin = AdminCustom::where('is_super_admin', 1)->first();

        if (!$superAdmin || !Hash::check(trim($request->super_password), $superAdmin->password)) {
            return back()->with('error', 'Mật khẩu admin gốc không chính xác!');
        }

        $name     = trim($request->name);
        $email    = trim($request->email);
        $password = trim($request->new_password); // dùng name mới

        if (AdminCustom::where('email', $email)->exists()) {
            return back()->with('error', 'Email này đã tồn tại trong hệ thống!');
        }

       AdminCustom::create([
            'name'          => $name,
            'email'         => $email,
            'password'      => $password, // để model tự hash
            'is_super_admin'=> $request->is_super_admin ?? 0,
        ]);


        return back()->with('success', 'Tạo admin mới thành công');
    }




    public function logout()
    {
        Session::flush();
        return redirect('/admin/login');
    }

    // Ghi lịch sử
    public static function logAction($adminId,$admin_name, $action, $table, $details = null)
    {
        AdminHistory::create([
            'admin_id'   => $adminId,
            'admin_name'   => $admin_name,
            'action'     => $action,
            'table_name' => $table,
            'details'    => $details,
            'acted_at'   => now(),
        ]);
    }
}
