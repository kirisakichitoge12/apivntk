<?php
// app/Http/Controllers/HomeContentController.php
namespace App\Http\Controllers;

use App\Models\HomeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    public function index()
    {
        $homeContent = HomeContent::find(1);
        return view('admin.home_content.index', compact('homeContent'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content1' => 'nullable|string',
            'content2' => 'nullable|string',
            'image1'   => 'nullable|image|max:2048',
            'image2'   => 'nullable|image|max:2048',
            'image3'   => 'nullable|image|max:2048',
        ]);

        $homeContent = HomeContent::find(1);
        $data = $request->only(['title', 'content1', 'content2']);

        // xử lý 3 ảnh
        foreach (['image1', 'image2', 'image3'] as $img) {
            if ($request->hasFile($img)) {
                if (!empty($homeContent?->$img)) {
                    Storage::disk('public')->delete($homeContent->$img);
                }
                $data[$img] = $request->file($img)->store('home_contents', 'public');
            } else {
                $data[$img] = $homeContent?->$img;
            }
        }

        HomeContent::updateOrCreate(['id' => 1], $data);

        return redirect()->route('home_content.index')->with('success', 'Lưu nội dung trang chủ thành công');
    }
}
