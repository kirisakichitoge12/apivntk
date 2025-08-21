<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerKhuyenmai;
use App\Models\BackgroundKhuyenmai;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class KhuyenmaiImageController extends Controller
{
    // Trang quản lý banners
    public function index()
    {
        $banners = BannerKhuyenmai::latest()->get();
        return view('admin.khuyenmai.banners.index', compact('banners'));
    }

   public function store(Request $request)
    {
        $count = BannerKhuyenmai::count();
        if ($count >= 3) {
            return redirect()->route('khuyenmai.banners.index')
                            ->with('error', 'Chỉ được upload tối đa 3 banner');
        }

        $request->validate([
            'image' => 'required|image|max:2048',
            'alt'   => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('khuyenmai/banners', 'public');

        $banner = BannerKhuyenmai::create([
            'image_path' => $path,
            'alt'        => $request->alt,
        ]);

        // Ghi lịch sử thêm banner
        $adminId   = Session::get('admin_id');
        $adminName = Session::get('admin_name');
        AdminAuthController::logAction(
            $adminId,
            $adminName,
            'thêm',
            'banner_khuyenmai',
            'Admin '.$adminName.' (ID='.$adminId.') đã thêm banner khuyến mãi ID='.$banner->id
        );

        return redirect()->route('khuyenmai.banners.index')
                        ->with('success', 'Thêm banner thành công');
    }

    public function destroy($id)
    {
        $banner = BannerKhuyenmai::findOrFail($id);
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();

        // Ghi lịch sử xóa banner
        $adminId   = Session::get('admin_id');
        $adminName = Session::get('admin_name');
        AdminAuthController::logAction(
            $adminId,
            $adminName,
            'xóa',
            'banner_khuyenmai',
            'Admin '.$adminName.' (ID='.$adminId.') đã xoá banner khuyến mãi ID='.$id
        );

        return redirect()->route('khuyenmai.banners.index')
                        ->with('success', 'Xoá banner thành công');
    }

    // Background quản lý
    public function backgroundIndex()
    {
        $background = BackgroundKhuyenmai::first();
        return view('admin.khuyenmai.background.index', compact('background'));
    }

    public function backgroundStore(Request $request)
    {
        $count = BackgroundKhuyenmai::count();
        if ($count >= 1) {
            return redirect()->route('khuyenmai.background.index')
                            ->with('error', 'Chỉ được upload tối đa 1 background');
        }

        $request->validate([
            'image' => 'required|image|max:2048',
            'alt'   => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('khuyenmai/backgrounds', 'public');

        // chỉ cho 1 background duy nhất
        BackgroundKhuyenmai::truncate();

        $bg = BackgroundKhuyenmai::create([
            'image_path' => $path,
            'alt'        => $request->alt,
        ]);

        // Ghi lịch sử thêm background
        $adminId   = Session::get('admin_id');
        $adminName = Session::get('admin_name');
        AdminAuthController::logAction(
            $adminId,
            $adminName,
            'thêm/cập nhật',
            'background_khuyenmai',
            'Admin '.$adminName.' (ID='.$adminId.') đã thêm/cập nhật background khuyến mãi ID='.$bg->id
        );

        return redirect()->route('khuyenmai.background.index')
                        ->with('success', 'Cập nhật background thành công');
    }

    public function backgroundDestroy($id)
    {
        $bg = BackgroundKhuyenmai::findOrFail($id);
        Storage::disk('public')->delete($bg->image_path);
        $bg->delete();

        // Ghi lịch sử xóa background
        $adminId   = Session::get('admin_id');
        $adminName = Session::get('admin_name');
        AdminAuthController::logAction(
            $adminId,
            $adminName,
            'xóa',
            'background_khuyenmai',
            'Admin '.$adminName.' (ID='.$adminId.') đã xoá background khuyến mãi ID='.$id
        );

        return redirect()->route('khuyenmai.background.index')
                        ->with('success', 'Xoá background thành công');
    }
}
