<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerVemaybaynoidia;
use App\Models\BackgroundVemaybaynoidia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VemaybaynoidiaImageController extends Controller
{
    // Trang quản lý banners (web)
    public function index()
    {
        $banners = BannerVemaybaynoidia::latest()->get();
        return view('admin.vemaybaynoidia.banners.index', compact('banners'));
    }

    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:2048',
        'alt'   => 'nullable|string|max:255',
    ]);

    $path = $request->file('image')->store('vemaybaynoidia/banners', 'public');

    $banner = BannerVemaybaynoidia::create([
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
        'banner_vemaybaynoidia',
        'Admin '.$adminName.' (ID='.$adminId.') đã thêm banner vé máy bay nội địa ID='.$banner->id
    );

    return redirect()->route('vemaybaynoidia.banners.index')
                     ->with('success', 'Thêm banner thành công');
}

public function destroy($id)
{
    $banner = BannerVemaybaynoidia::findOrFail($id);
    Storage::disk('public')->delete($banner->image_path);
    $banner->delete();

    // Ghi lịch sử xóa banner
    $adminId   = Session::get('admin_id');
    $adminName = Session::get('admin_name');
    AdminAuthController::logAction(
        $adminId,
        $adminName,
        'xóa',
        'banner_vemaybaynoidia',
        'Admin '.$adminName.' (ID='.$adminId.') đã xoá banner vé máy bay nội địa ID='.$id
    );

    return redirect()->route('vemaybaynoidia.banners.index')
                     ->with('success', 'Xoá banner thành công');
}

// Background quản lý (web)
public function backgroundIndex()
{
    $background = BackgroundVemaybaynoidia::first();
    return view('admin.vemaybaynoidia.background.index', compact('background'));
}

public function backgroundStore(Request $request)
{
    $count = BackgroundVemaybaynoidia::count();
    if ($count >= 1) {
        return redirect()->route('vemaybaynoidia.background.index')
                         ->with('error', 'Chỉ được upload tối đa 1 background');
    }

    $request->validate([
        'image' => 'required|image|max:2048',
        'alt'   => 'nullable|string|max:255',
    ]);

    $path = $request->file('image')->store('vemaybaynoidia/backgrounds', 'public');

    // chỉ cho 1 background duy nhất
    BackgroundVemaybaynoidia::truncate();

    $bg = BackgroundVemaybaynoidia::create([
        'image_path' => $path,
        'alt'        => $request->alt,
    ]);

    // Ghi lịch sử thêm/cập nhật background
    $adminId   = Session::get('admin_id');
    $adminName = Session::get('admin_name');
    AdminAuthController::logAction(
        $adminId,
        $adminName,
        'thêm/cập nhật',
        'background_vemaybaynoidia',
        'Admin '.$adminName.' (ID='.$adminId.') đã thêm/cập nhật background vé máy bay nội địa ID='.$bg->id
    );

    return redirect()->route('vemaybaynoidia.background.index')
                     ->with('success', 'Cập nhật background thành công');
}

public function backgroundDestroy($id)
{
    $bg = BackgroundVemaybaynoidia::findOrFail($id);
    Storage::disk('public')->delete($bg->image_path);
    $bg->delete();

    // Ghi lịch sử xóa background
    $adminId   = Session::get('admin_id');
    $adminName = Session::get('admin_name');
    AdminAuthController::logAction(
        $adminId,
        $adminName,
        'xóa',
        'background_vemaybaynoidia',
        'Admin '.$adminName.' (ID='.$adminId.') đã xoá background vé máy bay nội địa ID='.$id
    );

    return redirect()->route('vemaybaynoidia.background.index')
                     ->with('success', 'Xoá background thành công');
}
}
