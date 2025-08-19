<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerHome;
use App\Models\BackgroundHome;
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
            return redirect()->route('banners.index')->with('success', 'Chỉ được upload tối đa 3 banner');
        }

        $request->validate([
            'page' => 'required|string',
            'image' => 'required|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('banners', 'public');

        BannerHome::create([
            'page' => $request->page,
            'image_path' => $path,
            'alt' => $request->alt_text,
        ]);

        return redirect()->route('banners.index')->with('success', 'Thêm banner thành công');
    }

   
    public function destroy($id)
    {
        $banner = BannerHome::findOrFail($id);
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Xoá banner thành công');
    }

    // Background quản lý (web)
    public function backgroundIndex()
    {
        $background = BackgroundHome::first();
        return view('admin.background.index', compact('background'));
    }

    public function backgroundStore(Request $request)
    {
         $count = BackgroundHome::count();
        if ($count >= 1) {
            return redirect()->route('background.index')->with('success', 'Chỉ được upload tối đa 1 background');
        }
        $request->validate([
            'image' => 'required|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('backgrounds', 'public');

        // chỉ 1 background duy nhất
        BackgroundHome::truncate();

        BackgroundHome::create([
            'image_path' => $path,
            'alt' => $request->alt_text,
        ]);

        return redirect()->route('background.index')->with('success', 'Cập nhật background thành công');
    }

    public function backgroundDestroy($id)
    {
        $bg = BackgroundHome::findOrFail($id);
        Storage::disk('public')->delete($bg->image_path);
        $bg->delete();

        return redirect()->route('background.index')->with('success', 'Xoá background thành công');
    }
}
