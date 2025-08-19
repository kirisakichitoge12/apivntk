<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerTintuc;
use App\Models\BackgroundTintuc;
use Illuminate\Support\Facades\Storage;

class TintucImageController extends Controller
{
    // Trang quản lý banners
    public function index()
    {
        $banners = BannerTintuc::latest()->get();
        return view('admin.tintuc.banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $count = BannerTintuc::count();
        if ($count >= 3) {
            return redirect()->route('tintuc.banners.index')
                             ->with('error', 'Chỉ được upload tối đa 3 banner');
        }

        $request->validate([
            'image' => 'required|image|max:2048',
            'alt'   => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('tintuc/banners', 'public');

        BannerTintuc::create([
            'image_path' => $path,
            'alt'        => $request->alt,
        ]);

        return redirect()->route('tintuc.banners.index')
                         ->with('success', 'Thêm banner thành công');
    }

    public function destroy($id)
    {
        $banner = BannerTintuc::findOrFail($id);
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();

        return redirect()->route('tintuc.banners.index')
                         ->with('success', 'Xoá banner thành công');
    }

    // Background quản lý
    public function backgroundIndex()
    {
        $background = BackgroundTintuc::first();
        return view('admin.tintuc.background.index', compact('background'));
    }

    public function backgroundStore(Request $request)
    {
        $count = BackgroundTintuc::count();
        if ($count >= 1) {
            return redirect()->route('tintuc.background.index')
                             ->with('error', 'Chỉ được upload tối đa 1 background');
        }

        $request->validate([
            'image' => 'required|image|max:2048',
            'alt'   => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('tintuc/backgrounds', 'public');

        // chỉ cho 1 background duy nhất
        BackgroundTintuc::truncate();

        BackgroundTintuc::create([
            'image_path' => $path,
            'alt'        => $request->alt,
        ]);

        return redirect()->route('tintuc.background.index')
                         ->with('success', 'Cập nhật background thành công');
    }

    public function backgroundDestroy($id)
    {
        $bg = BackgroundTintuc::findOrFail($id);
        Storage::disk('public')->delete($bg->image_path);
        $bg->delete();

        return redirect()->route('tintuc.background.index')
                         ->with('success', 'Xoá background thành công');
    }
}
