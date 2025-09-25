<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternationalFlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternationalFlightController extends Controller
{
    public function index(Request $request)
    {
        $query = InternationalFlight::query();

        // lọc theo country
        if ($request->filled('country') && $request->country !== 'Tất cả') {
            $query->where('country', $request->country);
        }

        // lọc theo from
        if ($request->filled('from') && $request->from !== 'Tất cả') {
            $query->where('from', $request->from);
        }

        // lọc theo to
        if ($request->filled('to') && $request->to !== 'Tất cả') {
            $query->where('to', $request->to);
        }

        // lọc theo keyword
        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('from', 'like', "%{$q}%")
                    ->orWhere('to', 'like', "%{$q}%")
                    ->orWhere('country', 'like', "%{$q}%")
                    ->orWhere('date', 'like', "%{$q}%");
            });
        }

        $flights = $query->latest()->paginate(15)->withQueryString();

        $countries = [
            "Tất cả","Thái Lan","Hàn Quốc","Nhật Bản","Trung Quốc",
            "Pháp","Đức","Anh","Mỹ","Úc","Qatar","Malaysia","Singapore"
        ];

        return view('admin.vequoctecard.index', compact('flights','countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'from'  => 'required|string',
            'to'    => 'required|string',
            'country' => 'required|string',
            'date'  => 'required|string',
            'price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'img'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['from','to','country','date','price','original_price']);
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('international_flights', 'public');
        }

        InternationalFlight::create($data);

        return redirect()->route('international-flights.index')
            ->with('success','Thêm chuyến bay quốc tế thành công');
    }

    public function edit($id)
    {
        $flight = InternationalFlight::findOrFail($id);
        $countries = [
            "Thái Lan","Hàn Quốc","Nhật Bản","Trung Quốc",
            "Pháp","Đức","Anh","Mỹ","Úc","Qatar","Malaysia","Singapore"
        ];
        return view('admin.vequoctecard.edit', compact('flight','countries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'from'  => 'required|string',
            'to'    => 'required|string',
            'country' => 'required|string',
            'date'  => 'required|string',
            'price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'img'   => 'nullable|image|max:2048',
        ]);

        $flight = InternationalFlight::findOrFail($id);
        $data = $request->only(['from','to','country','date','price','original_price']);

        if ($request->hasFile('img')) {
            if ($flight->img && Storage::disk('public')->exists($flight->img)) {
                Storage::disk('public')->delete($flight->img);
            }
            $data['img'] = $request->file('img')->store('international_flights', 'public');
        }

        $flight->update($data);

        return redirect()->route('international-flights.index')
            ->with('success','Cập nhật chuyến bay quốc tế thành công');
    }

    public function destroy($id)
    {
        $flight = InternationalFlight::findOrFail($id);

        if ($flight->img && Storage::disk('public')->exists($flight->img)) {
            Storage::disk('public')->delete($flight->img);
        }

        $flight->delete();
        return redirect()->route('international-flights.index')
            ->with('success','Xóa chuyến bay quốc tế thành công');
    }
}
