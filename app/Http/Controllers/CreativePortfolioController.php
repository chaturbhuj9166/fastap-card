<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreativePortfolioCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreativePortfolioController extends Controller
{
    /**
     * Display a listing of portfolio categories
     */
    public function index()
    {
        $categories = CreativePortfolioCategory::where('customer_id', Auth::id())
                                               ->orderBy('sort_order')
                                               ->paginate(12);

        return view('userdashboard-new.creative.portfolio.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create()
    {
        return view('userdashboard-new.creative.portfolio.create');
    }

    /**
     * Store a newly created category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['customer_id'] = Auth::id();

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/creative/portfolio'), $imageName);
            $validated['cover_image'] = $imageName;
        }

        CreativePortfolioCategory::create($validated);

        return redirect()->route('creative.portfolio.index')
                        ->with('success', 'Portfolio category created successfully!');
    }

    /**
     * Show the form for editing a category
     */
    public function edit($id)
    {
        $category = CreativePortfolioCategory::where('customer_id', Auth::id())
                                             ->findOrFail($id);

        return view('userdashboard-new.creative.portfolio.edit', compact('category'));
    }

    /**
     * Update the specified category
     */
    public function update(Request $request, $id)
    {
        $category = CreativePortfolioCategory::where('customer_id', Auth::id())
                                             ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($category->cover_image && file_exists(public_path('frontend/creative/portfolio/' . $category->cover_image))) {
                unlink(public_path('frontend/creative/portfolio/' . $category->cover_image));
            }

            $image = $request->file('cover_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('frontend/creative/portfolio'), $imageName);
            $validated['cover_image'] = $imageName;
        }

        $category->update($validated);

        return redirect()->route('creative.portfolio.index')
                        ->with('success', 'Portfolio category updated successfully!');
    }

    /**
     * Remove the specified category
     */
    public function destroy($id)
    {
        $category = CreativePortfolioCategory::where('customer_id', Auth::id())
                                             ->findOrFail($id);

        // Delete cover image if exists
        if ($category->cover_image && file_exists(public_path('frontend/creative/portfolio/' . $category->cover_image))) {
            unlink(public_path('frontend/creative/portfolio/' . $category->cover_image));
        }

        $category->delete();

        return redirect()->route('creative.portfolio.index')
                        ->with('success', 'Portfolio category deleted successfully!');
    }

    /**
     * Toggle category status
     */
    public function toggleStatus($id)
    {
        $category = CreativePortfolioCategory::where('customer_id', Auth::id())
                                             ->findOrFail($id);

        $category->is_active = !$category->is_active;
        $category->save();

        return response()->json([
            'success' => true,
            'is_active' => $category->is_active
        ]);
    }
}
