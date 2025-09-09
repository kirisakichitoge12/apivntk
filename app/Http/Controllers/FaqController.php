<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $categories = FaqCategory::orderBy('name')->get();

        $query = Faq::with('category')->latest();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where('question', 'like', "%{$q}%");
        }

        $faqs = $query->paginate(15)->withQueryString();

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function create()
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('admin.faqs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question'    => 'required|string|max:500',
            'answer'      => 'required|string',
        ]);

        Faq::create($data);

        return redirect()->route('faqs.index')->with('success', 'Thêm câu hỏi thành công');
    }

    public function edit(Faq $faq)
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question'    => 'required|string|max:500',
            'answer'      => 'required|string',
        ]);

        $faq->update($data);

        return redirect()->route('faqs.index')->with('success', 'Cập nhật câu hỏi thành công');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('success', 'Xóa câu hỏi thành công');
    }
}
