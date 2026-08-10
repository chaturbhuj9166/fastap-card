<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display the store homepage with all products
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'user'])
            ->active();

        // Filter by source (admin/user/all)
        if ($request->filled('source')) {
            if ($request->source === 'admin') {
                $query->adminProducts();
            } elseif ($request->source === 'user') {
                $query->userProducts();
            }
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by type (product/service)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                // Could add view count or order count later
                $query->latest();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);
        $categories = ProductCategory::active()->parents()->get();

        // Get featured products for sidebar
        $featuredProducts = Product::active()->featured()->take(5)->get();

        return view('frontend.store.index', compact('products', 'categories', 'featuredProducts'));
    }

    /**
     * Display single product detail page
     */
    public function show($slug)
    {
        $product = Product::with(['category', 'user'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Get related products (same category)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->take(4)
            ->get();

        // Get more products from same seller (if user product)
        $sellerProducts = [];
        if ($product->user_id) {
            $sellerProducts = Product::where('user_id', $product->user_id)
                ->where('id', '!=', $product->id)
                ->active()
                ->take(4)
                ->get();
        }

        return view('frontend.store.show', compact('product', 'relatedProducts', 'sellerProducts'));
    }

    /**
     * Display products by category
     */
    public function category($slug)
    {
        $category = ProductCategory::where('slug', $slug)->active()->firstOrFail();

        $products = Product::with(['category', 'user'])
            ->where('category_id', $category->id)
            ->active()
            ->latest()
            ->paginate(12);

        $categories = ProductCategory::active()->parents()->get();

        return view('frontend.store.category', compact('category', 'products', 'categories'));
    }

    /**
     * Display products by seller
     */
    public function seller($id)
    {
        $seller = \App\Models\customer::findOrFail($id);

        $products = Product::with('category')
            ->where('user_id', $id)
            ->active()
            ->latest()
            ->paginate(12);

        // Get seller's store settings
        $storeSetting = \App\Models\UserStoreSetting::where('user_id', $id)->first();

        return view('frontend.store.seller', compact('seller', 'products', 'storeSetting'));
    }

    /**
     * Search products (AJAX)
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $products = Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->active()
            ->limit(10)
            ->get(['id', 'name', 'slug', 'price', 'images']);

        return response()->json($products);
    }
}
