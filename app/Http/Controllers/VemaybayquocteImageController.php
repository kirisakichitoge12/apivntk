<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerVemaybayquocte;
use App\Models\BackgroundVemaybayquocte;
use Illuminate\Support\Facades\Storage;

class VemaybayquocteImageController extends Controller
{
    // Trang quản lý banners (web)
    public function index()
    {
        $banners = BannerVemaybayquocte::latest()->get();
        return view('admin.vemaybayquocte.banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        // $count = BannerVemaybayquocte::count();
        // if ($count >= 3) {
        //     return redirect()->route('vemaybayquocte.banners.index')
        //                      ->with('error', 'Chỉ được upload tối đa 3 banner');
        // }

        $request->validate([
            'image' => 'required|image|max:2048',
            'alt'   => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('vemaybayquocte/banners', 'public');

        BannerVemaybayquocte::create([
            'image_path' => $path,
            'alt'        => $request->alt,
        ]);

        return redirect()->route('vemaybayquocte.banners.index')
                         ->with('success', 'Thêm banner thành công');
    }

    public function destroy($id)
    {
        $banner = BannerVemaybayquocte::findOrFail($id);
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();

        return redirect()->route('vemaybayquocte.banners.index')
                         ->with('success', 'Xoá banner thành công');
    }

    // Background quản lý (web)
    public function backgroundIndex()
    {
        $background = BackgroundVemaybayquocte::first();
        return view('admin.vemaybayquocte.background.index', compact('background'));
    }

    public function backgroundStore(Request $request)
    {
        $count = BackgroundVemaybayquocte::count();
        if ($count >= 1) {
            return redirect()->route('vemaybayquocte.background.index')
                             ->with('error', 'Chỉ được upload tối đa 1 background');
        }

        $request->validate([
            'image' => 'required|image|max:2048',
            'alt'   => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('vemaybayquocte/backgrounds', 'public');

        // chỉ cho 1 background duy nhất
        BackgroundVemaybayquocte::truncate();

        BackgroundVemaybayquocte::create([
            'image_path' => $path,
            'alt'        => $request->alt,
        ]);

        return redirect()->route('vemaybayquocte.background.index')
                         ->with('success', 'Cập nhật background thành công');
    }

    public function backgroundDestroy($id)
    {
        $bg = BackgroundVemaybayquocte::findOrFail($id);
        Storage::disk('public')->delete($bg->image_path);
        $bg->delete();

        return redirect()->route('vemaybayquocte.background.index')
                         ->with('success', 'Xoá background thành công');
    }
}
