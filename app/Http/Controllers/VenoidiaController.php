<?php
namespace App\Http\Controllers;

use App\Models\DescriptionNoidia;
use App\Models\Venoidia;
use Illuminate\Http\Request;

class VenoidiaController extends Controller
{
    public function index()
    {
        $venoidias = DescriptionNoidia::latest()->paginate(10);
        return view('admin.venoidia.index', compact('venoidias'));
    }

    public function create()
    {
        return view('admin.venoidia.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        // dd($request);
        $description = $request->description;

        // đổi non-breaking space -> space thường
        $description = str_replace("\u{A0}", " ", $description);
        $description = str_replace("&nbsp;", " ", $description);

        // xóa <br /> thừa
        $description = preg_replace('/<br\s*\/?>\s*/i', '', $description);
        DescriptionNoidia::create([
            'title' => $request->title,
            'description' => $description
        ]);


        DescriptionNoidia::create($request->all());
        return redirect()->route('venoidia.index')->with('success', 'Thêm mô tả thành công');
    }

  public function edit($id)
{
    $venoidia = DescriptionNoidia::findOrFail($id);
    // dd($venoidia);
    return view('admin.venoidia.edit', compact('venoidia'));
}
    // public function update(Request $request, DescriptionNoidia $venoidia)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //     ]);

    //     $venoidia->update($request->all());
    //     return redirect()->route('venoidia.index')->with('success', 'Cập nhật thành công');
    // }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $venoidia = DescriptionNoidia::findOrFail($id);

        $description = $request->description;
        $description = str_replace("\u{A0}", " ", $description);
        $description = str_replace("&nbsp;", " ", $description);
        $description = preg_replace('/<br\s*\/?>\s*/i', '', $description);

        $venoidia->update([
            'title' => $request->title,
            'description' => $description
        ]);

        return redirect()->route('venoidia.index')->with('success', 'Cập nhật thành công');
    }


    public function destroy(DescriptionNoidia $venoidia)
    {
        $venoidia->delete();
        return redirect()->route('venoidia.index')->with('success', 'Xóa thành công');
    }
}
