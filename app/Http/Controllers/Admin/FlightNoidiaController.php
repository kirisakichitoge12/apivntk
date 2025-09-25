<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlightNoidia;

class FlightNoidiaController extends Controller
{
    // Danh sách flight
    public function index()
    {
        $flights = FlightNoidia::latest()->get();
        return view('admin.updatetuyenbay.index', compact('flights'));
    }

    // Lưu flight mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required|string|max:10',
            'to' => 'required|string|max:10',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date',
        ]);

        FlightNoidia::create($validated);

        return redirect()->route('flights-noi-dia.index')->with('success', 'Thêm chuyến bay thành công');
    }

    // Trang edit
    public function edit($id)
    {
        $flight = FlightNoidia::findOrFail($id);
        return view('admin.updatetuyenbay.edit', compact('flight'));
    }

    // Cập nhật
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'from' => 'required|string|max:10',
            'to' => 'required|string|max:10',
            'departure_date' => 'nullable|string',
            'return_date' => 'nullable|string',
        ]);

        $flight = FlightNoidia::findOrFail($id);
        $flight->update($validated);

        return redirect()->route('flights-noi-dia.index')->with('success', 'Cập nhật chuyến bay thành công');
    }

    // Xoá
    public function destroy($id)
    {
        $flight = FlightNoidia::findOrFail($id);
        $flight->delete();

        return redirect()->route('flights-noi-dia.index')->with('success', 'Xoá chuyến bay thành công');
    }
}
