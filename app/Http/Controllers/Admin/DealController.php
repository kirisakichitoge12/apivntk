<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DealController extends Controller
{
    public function index()
    {
        $deals = Deal::all();
        return view('admin.deals.index', compact('deals'));
    }

    public function create()
    {
        return view('admin.deals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'airline' => 'required|string|max:255',
            // 'airline_logo' => 'nullable|image|max:2048',
            'from' => 'required|string',
            'to' => 'required|string',
            'date_range' => 'required|string',
            'price' => 'required|numeric',
            'trip_type' => 'required|in:mot-chieu,khu-hoi',
        ]);

        $data = $request->only([
            'airline','from','to','date_range','price','trip_type','airline_logo'
        ]);

        // if ($request->hasFile('airline_logo')) {
        //     $data['airline_logo'] = $request->file('airline_logo')->store('deals', 'public');
        // }

        Deal::create($data);

        return redirect()->route('deals.index')->with('success', 'Thêm deal thành công');
    }

    public function edit($id)
    {
        $deal = Deal::findOrFail($id);
        return view('admin.international_deals.edit', compact('deal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'airline' => 'required|string|max:255',
            // 'airline_logo' => 'nullable|image|max:2048',
            'from' => 'required|string',
            'to' => 'required|string',
            'date_range' => 'required|string',
            'price' => 'required|numeric',
            'trip_type' => 'required|in:mot-chieu,khu-hoi',
        ]);

        $deal = Deal::findOrFail($id);
        $data = $request->only([
            'airline','from','to','date_range','price','trip_type','airline_logo'
        ]);

        // if ($request->hasFile('airline_logo')) {
        //     if ($deal->airline_logo && Storage::disk('public')->exists($deal->airline_logo)) {
        //         Storage::disk('public')->delete($deal->airline_logo);
        //     }
        //     $data['airline_logo'] = $request->file('airline_logo')->store('deals', 'public');
        // }

        $deal->update($data);

        return redirect()->route('deals.index')->with('success', 'Cập nhật deal thành công');
    }

    public function destroy($id)
    {
        $deal = Deal::findOrFail($id);

        if ($deal->airline_logo && Storage::disk('public')->exists($deal->airline_logo)) {
            Storage::disk('public')->delete($deal->airline_logo);
        }

        $deal->delete();
        return redirect()->route('deals.index')->with('success', 'Xoá deal thành công');
    }
}
