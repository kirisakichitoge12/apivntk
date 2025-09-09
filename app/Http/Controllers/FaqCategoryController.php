<?php
namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index() {
        $categories = FaqCategory::all();
        return view('admin.faqcategories.index', compact('categories'));
    }

    public function create() {
        return view('admin.faqcategories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        FaqCategory::create([
            'name' => $request->name,
            'slug' => $request->name
        ]);

        return redirect()->route('faq-categories.index')->with('success', 'Danh mục đã được thêm!');
    }

    public function edit(FaqCategory $faqCategory) {
        return view('admin.faqcategories.edit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategory $faqCategory) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $faqCategory->update([
            'name' => $request->name,
            'slug' => $request->name
        ]);

        return redirect()->route('faq-categories.index')->with('success', 'Danh mục đã được cập nhật!');
    }

    public function destroy(FaqCategory $faqCategory) {
        $faqCategory->delete();
        return redirect()->route('faq-categories.index')->with('success', 'Danh mục đã được xóa!');
    }
}
