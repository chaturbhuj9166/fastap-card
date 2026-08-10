<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryAdminController extends Controller
{
    /**
     * Display listing of product categories
     */
    public function index()
    {
        $categories = ProductCategory::with('parent')->latest()->paginate(20);
        return view('admin-new.categories.index', compact('categories'));
    }

    /**
     * Show form for creating new category
     */
    public function create()
    {
        $parentCategories = ProductCategory::whereNull('parent_id')->active()->get();
        return view('admin-new.categories.create', compact('parentCategories'));
    }

    /**
     * Store new category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'parent_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        ProductCategory::create([
            'name' => $validated['name'],
            'parent_id' => $validated['parent_id'] ?? null,
            'image' => $imagePath,
            'status' => $validated['status']
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Show form for editing category
     */
    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        $parentCategories = ProductCategory::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->active()
            ->get();

        return view('admin-new.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update category
     */
    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $id,
            'parent_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean'
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $category->update([
            'name' => $validated['name'],
            'parent_id' => $validated['parent_id'] ?? null,
            'image' => $imagePath,
            'status' => $validated['status']
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Delete category
     */
    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);

        // Check if category has products
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete category with existing products');
        }

        // Delete category image
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
