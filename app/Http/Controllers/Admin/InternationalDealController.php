<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternationalDeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternationalDealController extends Controller
{
    public function index()
    {
        $deals = InternationalDeal::all();
        return view('admin.international_deals.index', compact('deals'));
    }

    public function create()
    {
        return view('admin.international_deals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'airline' => 'required|string|max:255',
            'from' => 'required|string',
            'to' => 'required|string',
            'date_range' => 'required|string',
            'price' => 'required|numeric',
            'trip_type' => 'required|in:mot-chieu,khu-hoi',
        ]);

        $data = $request->only([
            'airline','from','to','date_range','price','trip_type','airline_logo'
        ]);

        InternationalDeal::create($data);

        return redirect()->route('international-deals.index')->with('success', 'Thêm tuyến bay quốc tế thành công');
    }

    public function edit($id)
    {
        $deal = InternationalDeal::findOrFail($id);
        return view('admin.international_deals.edit', compact('deal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'airline' => 'required|string|max:255',
            'from' => 'required|string',
            'to' => 'required|string',
            'date_range' => 'required|string',
            'price' => 'required|numeric',
            'trip_type' => 'required|in:mot-chieu,khu-hoi',
        ]);

        $deal = InternationalDeal::findOrFail($id);
        $data = $request->only([
            'airline','from','to','date_range','price','trip_type','airline_logo'
        ]);

        $deal->update($data);

        return redirect()->route('international-deals.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $deal = InternationalDeal::findOrFail($id);
        $deal->delete();
        return redirect()->route('international-deals.index')->with('success', 'Xoá tuyến bay quốc tế thành công');
    }
}
