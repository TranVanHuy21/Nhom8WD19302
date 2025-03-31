<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'status' => 'required|in:active,inactive'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Thêm danh mục thành công!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'status' => 'required|in:active,inactive'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công!');
    }
}