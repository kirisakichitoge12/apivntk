<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Booking;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string',
            'gender' => 'required|string',
            'birth_date' => 'required|date',
            'nationality' => 'required|string',
            'document_type' => 'required|string',
            'document_number' => 'required|string',
            'country_code' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'nullable|string',

            'departure' => 'required|string',
            'arrival' => 'required|string',
            'departure_date' => 'required|string',
            'return_date' => 'nullable|string',
            'airline1' => 'required|string',
            'airline2' => 'nullable|string',
            'seat_class1' => 'required|string',
            'seat_class2' => 'nullable|string',
            'time_start1' => 'required|string',
            'time_end1' => 'required|string',
            'time_start2' => 'nullable|string',
            'time_end2' => 'nullable|string',
            'price1' => 'required|string',
            'price2' => 'nullable|string',

            'selected_seat' => 'nullable|string',
            'luggage_label' => 'required|string',
            'luggage_price' => 'required|integer',
            'voucher_discount' => 'required|integer',

            'total_price' => 'required|integer',
            'final_total' => 'required|integer',
        ]);

        $booking = Booking::create($validated);

        return response()->json([
            'message' => 'Đặt vé thành công!',
            'booking_id' => $booking->id
        ]);
    }
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner_manage', compact('banners'));
    }
}
