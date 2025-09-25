<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BackgroundHome;
use App\Models\BannerHome;
use App\Models\HomeContent;
// Models khuyến mãi
use App\Models\BackgroundKhuyenmai;
use App\Models\BannerKhuyenmai;

// Models tin tức
use App\Models\BackgroundTintuc;
use App\Models\BannerTintuc;

// Models vé máy bay nội địa
use App\Models\BackgroundVemaybaynoidia;
use App\Models\BannerVemaybaynoidia;

// Models vé máy bay quốc tế
use App\Models\BackgroundVemaybayquocte;
use App\Models\BannerVemaybayquocte;
use Illuminate\Http\Request;

class ContentManagementController extends Controller
{
    //
   public function ApiHomeManagement()
    {
        $backgrounds = BackgroundHome::orderBy('id', 'asc')->get();
        $banners = BannerHome::orderBy('id', 'desc')->get();
        $homeContent = HomeContent::find(1); // chỉ có 1 record

        return response()->json([
            'backgrounds' => $backgrounds,
            'banners'     => $banners,
            'content'     => $homeContent, // thêm quản lý nội dung
        ]);
    }

   // API khuyến mãi
    public function ApiKhuyenmaiManagement()
    {
        $backgrounds = BackgroundKhuyenmai::orderBy('id', 'desc')->get();
        $banners     = BannerKhuyenmai::orderBy('id', 'desc')->get();

        return response()->json([
            'backgrounds' => $backgrounds,
            'banners'     => $banners,
        ]);
    }

    // API tin tức
    public function ApiTintucManagement()
    {
        $backgrounds = BackgroundTintuc::orderBy('id', 'desc')->get();
        $banners     = BannerTintuc::orderBy('id', 'desc')->get();

        return response()->json([
            'backgrounds' => $backgrounds,
            'banners'     => $banners,
        ]);
    }

    // API vé máy bay nội địa
    public function ApiVemaybaynoidiaManagement()
    {
        $backgrounds = BackgroundVemaybaynoidia::orderBy('id', 'desc')->get();
        $banners     = BannerVemaybaynoidia::orderBy('id', 'desc')->get();

        return response()->json([
            'backgrounds' => $backgrounds,
            'banners'     => $banners,
        ]);
    }

    // API vé máy bay quốc tế
    public function ApiVemaybayquocteManagement()
    {
        $backgrounds = BackgroundVemaybayquocte::orderBy('id', 'desc')->get();
        $banners     = BannerVemaybayquocte::orderBy('id', 'desc')->get();

        return response()->json([
            'backgrounds' => $backgrounds,
            'banners'     => $banners,
        ]);
    }

}
