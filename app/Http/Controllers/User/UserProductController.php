<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\UserStoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserProductController extends Controller
{
    /**
     * Display user's products
     */
    public function index()
    {
        $user = Auth::guard('customer')->user();
        $storeSetting = UserStoreSetting::where('user_id', $user->id)->first();

        // Check if store is enabled
        if (!$storeSetting || !$storeSetting->store_enabled) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Store access is not enabled for your account');
        }

        $products = Product::where('user_id', $user->id)
            ->with('category')
            ->latest()
            ->paginate(20);

        return view('userdashboard-new.store.index', compact('products', 'storeSetting'));
    }

    /**
     * Show form for creating new product
     */
    public function create()
    {
        $user = Auth::guard('customer')->user();
        $storeSetting = UserStoreSetting::where('user_id', $user->id)->first();

        if (!$storeSetting || !$storeSetting->store_enabled) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Store access is not enabled');
        }

        if (!$storeSetting->canAddProducts()) {
            return redirect()->route('user.products.index')
                ->with('error', 'You have reached your product limit');
        }

        $categories = ProductCategory::active()->get();
        return view('userdashboard-new.store.create', compact('categories', 'storeSetting'));
    }

    /**
     * Store new user product
     */
    public function store(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $storeSetting = UserStoreSetting::where('user_id', $user->id)->first();

        if (!$storeSetting || !$storeSetting->canAddProducts()) {
            return back()->with('error', 'Cannot add more products');
        }

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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/user', 'public');
                $images[] = $path;
            }
        }

        // Determine status based on auto-approve setting
        $status = $storeSetting->auto_approve ? 'active' : 'pending';

        Product::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'type' => $validated['type'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'stock_quantity' => $validated['stock_quantity'],
            'sku' => $validated['sku'] ?? null,
            'images' => $images,
            'status' => $status,
            'source' => 'user',
            'approved_by' => $storeSetting->auto_approve ? 1 : null,
            'approved_at' => $storeSetting->auto_approve ? now() : null
        ]);

        $message = $storeSetting->auto_approve
            ? 'Product created successfully'
            : 'Product created and pending approval';

        return redirect()->route('user.products.index')
            ->with('success', $message);
    }

    /**
     * Show form for editing user product
     */
    public function edit($id)
    {
        $user = Auth::guard('customer')->user();
        $product = Product::where('user_id', $user->id)->findOrFail($id);
        $categories = ProductCategory::active()->get();

        return view('userdashboard-new.store.edit', compact('product', 'categories'));
    }

    /**
     * Update user product
     */
    public function update(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $product = Product::where('user_id', $user->id)->findOrFail($id);

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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle new image uploads
        $images = $product->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/user', 'public');
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
            'images' => $images
        ]);

        return redirect()->route('user.products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Delete user product
     */
    public function destroy($id)
    {
        $user = Auth::guard('customer')->user();
        $product = Product::where('user_id', $user->id)->findOrFail($id);

        // Delete product images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('user.products.index')
            ->with('success', 'Product deleted successfully');
    }
}
