<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->meta_title = $request->meta_title ?? $request->name;
        $category->meta_description = $request->meta_description ?? $request->description;
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'สร้างหมวดหมู่สำเร็จ');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->meta_title = $request->meta_title ?? $request->name;
        $category->meta_description = $request->meta_description ?? $request->description;
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'อัปเดตหมวดหมู่สำเร็จ');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return back()->with('error', 'ไม่สามารถลบหมวดหมู่ที่มีสินค้าอยู่ได้');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'ลบหมวดหมู่สำเร็จ');
    }
}