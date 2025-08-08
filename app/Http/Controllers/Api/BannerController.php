<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function getBanner()
    {
        $banners = Banner::latest()->get(); // hoặc phân trang nếu cần
        return view('admin.banner_manage', compact('banners'));
    }

    public function getByPage($page)
    {
        $banners = Banner::where('page', $page)
            ->when($page === 'home', fn($q) => $q->limit(3))
            ->get()
            ->map(function ($banner) {
                return [
                    'id' => $banner->id,
                    'image_url' => asset('storage/' . $banner->image_path),
                    'alt' => $banner->alt_text ?? 'Banner',
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

        if ($request->page === 'home') {
            $count = Banner::where('page', 'home')->count();
            if ($count >= 3) {
                return response()->json(['message' => 'Trang home chỉ được tối đa 3 banner'], 400);
            }
        }

        $oldBanner = Banner::where('page', $request->page)
            ->where('alt_text', $request->alt_text)
            ->first();

        if ($oldBanner) {
            Storage::disk('public')->delete($oldBanner->image_path);
            $oldBanner->delete();
        }

        $path = $request->file('image')->store('banners', 'public');

        Banner::create([
            'page' => $request->page,
            'image_path' => $path,
            'alt_text' => $request->alt_text,
        ]);

        return response()->json(['message' => 'Banner uploaded successfully']);
    }
}
