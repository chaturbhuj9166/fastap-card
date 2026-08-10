<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreativePackage;
use Illuminate\Support\Facades\Auth;

class CreativePackageController extends Controller
{
    /**
     * Display a listing of packages
     */
    public function index()
    {
        $packages = CreativePackage::where('customer_id', Auth::id())
                                   ->orderBy('sort_order')
                                   ->paginate(10);

        return view('userdashboard-new.creative.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new package
     */
    public function create()
    {
        return view('userdashboard-new.creative.packages.create');
    }

    /**
     * Store a newly created package
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:photography,event,combined',
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'deliverables' => 'nullable|string',
            'features' => 'nullable|array',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['customer_id'] = Auth::id();

        CreativePackage::create($validated);

        return redirect()->route('creative.packages.index')
                        ->with('success', 'Package created successfully!');
    }

    /**
     * Show the form for editing a package
     */
    public function edit($id)
    {
        $package = CreativePackage::where('customer_id', Auth::id())
                                  ->findOrFail($id);

        return view('userdashboard-new.creative.packages.edit', compact('package'));
    }

    /**
     * Update the specified package
     */
    public function update(Request $request, $id)
    {
        $package = CreativePackage::where('customer_id', Auth::id())
                                  ->findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|in:photography,event,combined',
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'deliverables' => 'nullable|string',
            'features' => 'nullable|array',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $package->update($validated);

        return redirect()->route('creative.packages.index')
                        ->with('success', 'Package updated successfully!');
    }

    /**
     * Remove the specified package
     */
    public function destroy($id)
    {
        $package = CreativePackage::where('customer_id', Auth::id())
                                  ->findOrFail($id);

        $package->delete();

        return redirect()->route('creative.packages.index')
                        ->with('success', 'Package deleted successfully!');
    }

    /**
     * Toggle package status
     */
    public function toggleStatus($id)
    {
        $package = CreativePackage::where('customer_id', Auth::id())
                                  ->findOrFail($id);

        $package->is_active = !$package->is_active;
        $package->save();

        return response()->json([
            'success' => true,
            'is_active' => $package->is_active
        ]);
    }
}
