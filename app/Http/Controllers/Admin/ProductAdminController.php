<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
{
    /**
     * Display a listing of admin products
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'user'])
            ->adminProducts();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->latest()->paginate(20);
        $categories = ProductCategory::active()->get();

        return view('admin-new.products.index', compact('products', 'categories'));
    }

    /**
     * Show form for creating new admin product
     */
    public function create()
    {
        $categories = ProductCategory::active()->get();
        return view('admin-new.products.create', compact('categories'));
    }

    /**
     * Store new admin product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:product_categories,id',
            'type' => 'required|in:product,service',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive,out_of_stock'
        ]);

        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
        }

        $product = Product::create([
            'user_id' => null, // Admin product
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'type' => $validated['type'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'stock_quantity' => $validated['stock_quantity'],
            'sku' => $validated['sku'] ?? null,
            'images' => $images,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $validated['status'],
            'source' => 'admin',
            'approved_by' => auth()->guard('admin')->id(),
            'approved_at' => now()
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    /**
     * Show form for editing admin product
     */
    public function edit($id)
    {
        $product = Product::adminProducts()->findOrFail($id);
        $categories = ProductCategory::active()->get();

        return view('admin-new.products.edit', compact('product', 'categories'));
    }

    /**
     * Update admin product
     */
    public function update(Request $request, $id)
    {
        $product = Product::adminProducts()->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:product_categories,id',
            'type' => 'required|in:product,service',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive,out_of_stock'
        ]);

        // Handle new image uploads
        $images = $product->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
        }

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'type' => $validated['type'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'stock_quantity' => $validated['stock_quantity'],
            'sku' => $validated['sku'] ?? null,
            'images' => $images,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $validated['status']
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Delete admin product
     */
    public function destroy($id)
    {
        $product = Product::adminProducts()->findOrFail($id);

        // Delete product images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }

    /**
     * Display pending user products for approval
     */
    public function pending()
    {
        $products = Product::with(['category', 'user'])
            ->userProducts()
            ->where('status', 'pending')
            ->latest()
            ->paginate(20);

        return view('admin-new.products.pending', compact('products'));
    }

    /**
     * Approve user product
     */
    public function approve($id)
    {
        $product = Product::userProducts()
            ->where('status', 'pending')
            ->findOrFail($id);

        $product->update([
            'status' => 'active',
            'approved_by' => auth()->guard('admin')->id(),
            'approved_at' => now()
        ]);

        return back()->with('success', 'Product approved successfully');
    }

    /**
     * Reject user product
     */
    public function reject($id)
    {
        $product = Product::userProducts()
            ->where('status', 'pending')
            ->findOrFail($id);

        $product->update([
            'status' => 'inactive'
        ]);

        return back()->with('success', 'Product rejected');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured($id)
    {
        $product = Product::findOrFail($id);
        $product->is_featured = !$product->is_featured;
        $product->save();

        return back()->with('success', 'Featured status updated');
    }
}
