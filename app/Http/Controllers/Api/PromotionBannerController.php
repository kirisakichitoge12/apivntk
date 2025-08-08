<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PromotionBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionBannerController extends Controller
{
    public function index()
    {
        $banners = PromotionBanner::latest()->get();
        return view('admin.promotion_manage', compact('banners'));
    }

    public function getByPage($page)
    {
        $banners = PromotionBanner::where('page', $page)->get()->map(function ($banner) {
            return [
                'id' => $banner->id,
                'image_url' => asset('storage/' . $banner->image_path),
                'alt' => $banner->alt_text ?? 'Promo Banner',
            ];
        });

        return response()->json($banners);
    }

    public function store(Request $request)
    {
        $request->validate([
            'page' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('promotion_banners', 'public');

        PromotionBanner::create([
            'page' => $request->page,
            'image_path' => $path,
            'alt_text' => $request->alt_text,
        ]);

        return redirect()->back()->with('success', 'Thêm banner khuyến mãi thành công');
    }

    public function destroy($id)
    {
        $banner = PromotionBanner::findOrFail($id);
        Storage::disk('public')->delete($banner->image_path);
        $banner->delete();

        return redirect()->back()->with('success', 'Xoá banner khuyến mãi thành công');
    }
}
