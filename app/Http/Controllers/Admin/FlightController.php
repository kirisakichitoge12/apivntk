<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlightController extends Controller
{
    // Hiển thị danh sách chuyến bay
    // public function index()
    // {
    //     $flights = Flight::all();
    //     return view('admin.vemaybaynoidia.venoidiacard.index', compact('flights'));
    // }
    public function index(Request $request)
{
    $query = Flight::query();

    // Lọc theo điểm đi
    if ($request->filled('from') && $request->from !== 'Tất cả') {
        $query->where('from', $request->from);
    }

    // Lọc theo điểm đến
    if ($request->filled('to') && $request->to !== 'Tất cả') {
        $query->where('to', $request->to);
    }

    // Lọc theo keyword (áp dụng cho from, to, date)
    if ($request->filled('q')) {
        $q = trim($request->q);
        $query->where(function ($sub) use ($q) {
            $sub->where('from', 'like', "%{$q}%")
                ->orWhere('to', 'like', "%{$q}%")
                ->orWhere('date', 'like', "%{$q}%");
        });
    }

    $flights = $query->latest()->paginate(15)->withQueryString();

    return view('admin.vemaybaynoidia.venoidiacard.index', compact('flights'));
}


    // Form sửa
    public function edit($id)
    {
        $flight = Flight::findOrFail($id);
        return view('admin.vemaybaynoidia.venoidiacard.edit', compact('flight'));
    }

    // Lưu chuyến bay mới
    public function store(Request $request)
    {
        $request->validate([
            'from'  => 'required|string',
            'to'    => 'required|string',
            'date'  => 'required|string',
            'price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'img'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['from','to','date','price','original_price']);
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('flights', 'public');
        }

        Flight::create($data);
        return redirect()->route('flights.index')->with('success', 'Thêm chuyến bay thành công');
    }

    // Update chuyến bay
    public function update(Request $request, $id)
    {
        $request->validate([
            'from'  => 'required|string',
            'to'    => 'required|string',
            'date'  => 'required|string',
            'price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'img'   => 'nullable|image|max:2048',
        ]);

        $flight = Flight::findOrFail($id);
        $data = $request->only(['from','to','date','original_price','price']);

        if ($request->hasFile('img')) {
            // Xóa ảnh cũ nếu có
            if ($flight->img && Storage::disk('public')->exists($flight->img)) {
                Storage::disk('public')->delete($flight->img);
            }
            $data['img'] = $request->file('img')->store('flights', 'public');
        }

        $flight->update($data);

        return redirect()->route('flights.index')->with('success', 'Cập nhật chuyến bay thành công');
    }

    // Xóa chuyến bay
    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);

        // Xóa ảnh nếu có
        if ($flight->img && Storage::disk('public')->exists($flight->img)) {
            Storage::disk('public')->delete($flight->img);
        }

        $flight->delete();
        return redirect()->route('flights.index')->with('success', 'Xóa chuyến bay thành công');
    }
}
