<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FlightProxyController extends Controller
{
    public function search(Request $request)
    {
        try {
            // Lấy toàn bộ query params client gửi
            $query = $request->getQueryString();

            // Dùng key cố định (thay trực tiếp)
            $key = "DTC10978";

            // Gọi sang API gốc có kèm key
            $url = "https://plg.datacom.vn/Partial/Search?" . $query . "&key=" . $key;

            $response = Http::withOptions([
                'verify' => false // ⚠️ bỏ kiểm tra SSL (chỉ local/dev)
            ])->withHeaders([
                'Accept' => 'application/json,text/html,*/*'
            ])->get($url);

            // Trả nguyên response về client
            return response($response->body(), $response->status())
                ->header('Content-Type', $response->header('Content-Type'));

        } catch (\Exception $e) {
            Log::error("❌ Proxy search error: " . $e->getMessage());

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
