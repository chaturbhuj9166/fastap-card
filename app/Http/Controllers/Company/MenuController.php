<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display menu management dashboard
     */
    public function index(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        // Check if company has restaurant theme (Theme 13)
        if ($company->profession_type != 13) {
            return redirect('/company/dashboard')->with('error', 'Menu management is only available for Restaurant/Hotel theme.');
        }

        $categories = MenuCategory::where('company_id', $companyId)
            ->withCount('items')
            ->ordered()
            ->get();

        $totalItems = MenuItem::where('company_id', $companyId)->count();
        $activeItems = MenuItem::where('company_id', $companyId)->where('is_available', 1)->count();
        $bestsellers = MenuItem::where('company_id', $companyId)->where('is_bestseller', 1)->count();

        return view('company.menu.index', compact('company', 'categories', 'totalItems', 'activeItems', 'bestsellers'));
    }

    // =====================
    // CATEGORY METHODS
    // =====================

    /**
     * Show form to create new category
     */
    public function createCategory(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        return view('company.menu.categories.create', compact('company'));
    }

    /**
     * Store a new category
     */
    public function storeCategory(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::findOrFail($companyId);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get max sort order
        $maxOrder = MenuCategory::where('company_id', $companyId)->max('sort_order') ?? 0;

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/menu/categories'), $imagePath);
        }

        MenuCategory::create([
            'customer_id' => $customerId,
            'company_id' => $companyId,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'sort_order' => $maxOrder + 1,
            'status' => 1,
        ]);

        return redirect('/company/menu')->with('success', 'Category created successfully!');
    }

    /**
     * Show form to edit category
     */
    public function editCategory(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $category = MenuCategory::where('company_id', $companyId)->findOrFail($id);

        return view('company.menu.categories.edit', compact('company', 'category'));
    }

    /**
     * Update category
     */
    public function updateCategory(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $category = MenuCategory::where('company_id', $companyId)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image && file_exists(public_path('uploads/menu/categories/' . $category->image))) {
                unlink(public_path('uploads/menu/categories/' . $category->image));
            }

            $image = $request->file('image');
            $imagePath = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/menu/categories'), $imagePath);
            $category->image = $imagePath;
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/company/menu')->with('success', 'Category updated successfully!');
    }

    /**
     * Delete category
     */
    public function destroyCategory(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $category = MenuCategory::where('company_id', $companyId)->findOrFail($id);

        // Delete category image
        if ($category->image && file_exists(public_path('uploads/menu/categories/' . $category->image))) {
            unlink(public_path('uploads/menu/categories/' . $category->image));
        }

        // Delete all items in this category
        foreach ($category->items as $item) {
            if ($item->image && file_exists(public_path('uploads/menu/items/' . $item->image))) {
                unlink(public_path('uploads/menu/items/' . $item->image));
            }
        }
        $category->items()->delete();

        $category->delete();

        return redirect('/company/menu')->with('success', 'Category and all its items deleted successfully!');
    }

    /**
     * Toggle category status
     */
    public function toggleCategory(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $category = MenuCategory::where('company_id', $companyId)->findOrFail($id);

        $category->status = !$category->status;
        $category->save();

        $status = $category->status ? 'activated' : 'deactivated';
        return back()->with('success', "Category has been {$status}.");
    }

    /**
     * Reorder categories
     */
    public function reorderCategories(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');

        $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:menu_categories,id',
        ]);

        foreach ($request->categories as $index => $categoryId) {
            MenuCategory::where('company_id', $companyId)
                ->where('id', $categoryId)
                ->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    // =====================
    // MENU ITEM METHODS
    // =====================

    /**
     * Show items in a category
     */
    public function categoryItems(Request $request, $categoryId)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $category = MenuCategory::where('company_id', $companyId)->findOrFail($categoryId);

        $items = MenuItem::where('company_id', $companyId)
            ->where('category_id', $categoryId)
            ->ordered()
            ->paginate(20);

        return view('company.menu.items.index', compact('company', 'category', 'items'));
    }

    /**
     * Show form to create new item
     */
    public function createItem(Request $request, $categoryId = null)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        $categories = MenuCategory::where('company_id', $companyId)
            ->where('status', 1)
            ->ordered()
            ->get();

        $selectedCategory = $categoryId;

        return view('company.menu.items.create', compact('company', 'categories', 'selectedCategory'));
    }

    /**
     * Store a new menu item
     */
    public function storeItem(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::findOrFail($companyId);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'dietary_type' => 'required|in:veg,non_veg,egg',
            'spice_level' => 'nullable|in:mild,medium,hot,extra_hot',
            'preparation_time' => 'nullable|string|max:50',
            'serves' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_bestseller' => 'nullable|boolean',
            'is_chefs_special' => 'nullable|boolean',
            'variants' => 'nullable|array',
            'variants.*.name' => 'nullable|string|max:100',
            'variants.*.price' => 'nullable|numeric|min:0',
        ]);

        // Verify category belongs to company
        $category = MenuCategory::where('company_id', $companyId)
            ->where('id', $request->category_id)
            ->firstOrFail();

        // Get max sort order for this category
        $maxOrder = MenuItem::where('company_id', $companyId)
            ->where('category_id', $request->category_id)
            ->max('sort_order') ?? 0;

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/menu/items'), $imagePath);
        }

        // Process variants
        $variants = null;
        if ($request->has('variants') && is_array($request->variants)) {
            $variants = array_filter($request->variants, function ($v) {
                return !empty($v['name']) && isset($v['price']);
            });
            $variants = array_values($variants); // Re-index array
        }

        MenuItem::create([
            'customer_id' => $customerId,
            'company_id' => $companyId,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'dietary_type' => $request->dietary_type,
            'spice_level' => ($request->spice_level === null || $request->spice_level === '') ? 0 : $request->spice_level,
            'preparation_time' => $request->preparation_time,
            'serves' => $request->serves,
            'image' => $imagePath,
            'is_bestseller' => $request->has('is_bestseller'),
            'is_chefs_special' => $request->has('is_chefs_special'),
            'is_available' => 1,
            'variants' => $variants,
            'sort_order' => $maxOrder + 1,
        ]);

        return redirect('/company/menu/category/' . $request->category_id . '/items')->with('success', 'Menu item created successfully!');
    }

    /**
     * Show form to edit menu item
     */
    public function editItem(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $item = MenuItem::where('company_id', $companyId)->findOrFail($id);

        $categories = MenuCategory::where('company_id', $companyId)
            ->where('status', 1)
            ->ordered()
            ->get();

        return view('company.menu.items.edit', compact('company', 'item', 'categories'));
    }

    /**
     * Update menu item
     */
    public function updateItem(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $item = MenuItem::where('company_id', $companyId)->findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:menu_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'dietary_type' => 'required|in:veg,non_veg,egg',
            'spice_level' => 'nullable|in:mild,medium,hot,extra_hot',
            'preparation_time' => 'nullable|string|max:50',
            'serves' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_bestseller' => 'nullable|boolean',
            'is_chefs_special' => 'nullable|boolean',
            'variants' => 'nullable|array',
        ]);

        // Verify category belongs to company
        MenuCategory::where('company_id', $companyId)
            ->where('id', $request->category_id)
            ->firstOrFail();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($item->image && file_exists(public_path('uploads/menu/items/' . $item->image))) {
                unlink(public_path('uploads/menu/items/' . $item->image));
            }

            $image = $request->file('image');
            $imagePath = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/menu/items'), $imagePath);
            $item->image = $imagePath;
        }

        // Process variants
        $variants = null;
        if ($request->has('variants') && is_array($request->variants)) {
            $variants = array_filter($request->variants, function ($v) {
                return !empty($v['name']) && isset($v['price']);
            });
            $variants = array_values($variants);
        }

        $item->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'dietary_type' => $request->dietary_type,
            'spice_level' => ($request->spice_level === null || $request->spice_level === '') ? 0 : $request->spice_level,
            'preparation_time' => $request->preparation_time,
            'serves' => $request->serves,
            'is_bestseller' => $request->has('is_bestseller'),
            'is_chefs_special' => $request->has('is_chefs_special'),
            'variants' => $variants,
        ]);

        return redirect('/company/menu/category/' . $item->category_id . '/items')->with('success', 'Menu item updated successfully!');
    }

    /**
     * Delete menu item
     */
    public function destroyItem(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $item = MenuItem::where('company_id', $companyId)->findOrFail($id);
        $categoryId = $item->category_id;

        // Delete item image
        if ($item->image && file_exists(public_path('uploads/menu/items/' . $item->image))) {
            unlink(public_path('uploads/menu/items/' . $item->image));
        }

        $item->delete();

        return redirect('/company/menu/category/' . $categoryId . '/items')->with('success', 'Menu item deleted successfully!');
    }

    /**
     * Toggle item availability
     */
    public function toggleItem(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $item = MenuItem::where('company_id', $companyId)->findOrFail($id);

        $item->is_available = !$item->is_available;
        $item->save();

        $status = $item->is_available ? 'available' : 'unavailable';
        return back()->with('success', "Item marked as {$status}.");
    }

    /**
     * Toggle bestseller status
     */
    public function toggleBestseller(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $item = MenuItem::where('company_id', $companyId)->findOrFail($id);

        $item->is_bestseller = !$item->is_bestseller;
        $item->save();

        $status = $item->is_bestseller ? 'marked as bestseller' : 'removed from bestsellers';
        return back()->with('success', "Item {$status}.");
    }

    /**
     * Reorder items in a category
     */
    public function reorderItems(Request $request, $categoryId)
    {
        $companyId = $request->session()->get('COMPANY_ID');

        $request->validate([
            'items' => 'required|array',
            'items.*' => 'integer|exists:menu_items,id',
        ]);

        foreach ($request->items as $index => $itemId) {
            MenuItem::where('company_id', $companyId)
                ->where('category_id', $categoryId)
                ->where('id', $itemId)
                ->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    private function resolveCustomerId(Company $company): int
    {
        if ($company->created_by) {
            return (int) $company->created_by;
        }

        $customerId = customer::where('company_id', $company->id)->value('id');
        if (!$customerId) {
            abort(400, 'Company owner not found.');
        }

        return (int) $customerId;
    }
}
