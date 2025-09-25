<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerHome;
use App\Models\BackgroundHome;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeImageController extends Controller
{
    // Trang quản lý banners (web)
    public function index()
    {
        $banners = BannerHome::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

   public function store(Request $request)
    {
        $count = BannerHome::count();
        if ($count >= 3) {
            return redirect()->route('banners.index')
                            ->with('error', 'Chỉ được upload tối đa 3 banner');
        }

        $request->validate([
            'page' => 'required|string',
            'image' => 'required|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('banners', 'public');

        BannerHome::create([
            'page'       => $request->page,
            'image_path' => $path,
            'alt'        => $request->alt_text,
        ]);
           // Ghi lịch sử xóa banner
        $adminId   = Session::get('admin_id');
        $adminName = Session::get('admin_name');
        AdminAuthController::logAction(
            $adminId,
            $adminName,
            'thêm',
            'banner home',
            'Admin '.$adminName.' (ID='.$adminId.') đã thêm banner trang home'
        );

        return redirect()->route('banners.index')
                        ->with('success', 'Thêm banner thành công');
    }
    // public function backgroundIndex()
    // {
    //     $background = BackgroundHome::first();
    //     return view('admin.background.index', compact('background'));
    // }

    public function backgroundIndex()
    {
        $backgroundHome   = BackgroundHome::find(1); // background trang chủ
        $backgroundFooter = BackgroundHome::find(2); // background footer

        return view('admin.background.index', compact('backgroundHome', 'backgroundFooter'));
    }

// public function backgroundStore(Request $request)
// {
//     $count = BackgroundHome::count();
//     if ($count >= 2) {
//         return redirect()->route('background.index')
//                          ->with('error', 'Chỉ được upload tối đa 2 background');
//     }

//     $request->validate([
//         'image' => 'required|image|max:2048',
//         'alt_text' => 'nullable|string|max:255',
//     ]);

//     $path = $request->file('image')->store('backgrounds', 'public');

//     BackgroundHome::truncate();

//     BackgroundHome::create([
//         'image_path' => $path,
//         'alt'        => $request->alt_text,
//     ]);


//       // Ghi lịch sử xóa banner
//         $adminId   = Session::get('admin_id');
//         $adminName = Session::get('admin_name');
//         AdminAuthController::logAction(
//             $adminId,
//             $adminName,
//             'thêm',
//             'background home',
//             'Admin '.$adminName.' (ID='.$adminId.') đã thêm background trang home'
//         );

//     return redirect()->route('background.index')
//                      ->with('success', 'Cập nhật background thành công');
//     }

public function backgroundStore(Request $request)
{
    $request->validate([
        'id'       => 'required|in:1,2',
        'image'    => 'required|image|max:2048',
        'alt_text' => 'nullable|string|max:255',
    ]);

    $path = $request->file('image')->store('backgrounds', 'public');

    // Tìm hoặc tạo mới theo ID (1: home, 2: footer)
    $background = BackgroundHome::find($request->id);

    if ($background) {
        // Update
        $background->update([
            'image_path' => $path,
            'alt_text'   => $request->alt_text,
        ]);
    } else {
        // Insert
        BackgroundHome::create([
            'id'         => $request->id,
            'image_path' => $path,
            'alt_text'   => $request->alt_text,
        ]);
    }

    // Log lại
    $adminId   = Session::get('admin_id');
    $adminName = Session::get('admin_name');
    AdminAuthController::logAction(
        $adminId,
        $adminName,
        'cập nhật',
        'background',
        'Admin '.$adminName.' (ID='.$adminId.') đã cập nhật background ID='.$request->id
    );

    return redirect()->route('background.index')
                     ->with('success', 'Cập nhật background thành công');
}

    
    public function backgroundDestroy($id)
    {
        $bg = BackgroundHome::findOrFail($id);
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

        return redirect()->route('banners.index')
                        ->with('success', 'Xoá background thành công');
    }

     public function destroy($id)
    {
        $banner = BannerHome::findOrFail($id);
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

        return redirect()->route('banners.index')
                        ->with('success', 'Xoá banner thành công');
    }
}
