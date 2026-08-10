<?php

namespace App\Http\Controllers;

use App\Models\JewelleryCustomOrder;
use App\Models\JewelleryProduct;
use App\Models\MetalRate;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JewelleryController extends Controller
{
    // =====================
    // User Dashboard (Customer)
    // =====================

    public function products()
    {
        $user = Auth::guard('customer')->user();
        $products = JewelleryProduct::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.jewellery.products.index', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'category' => 'required|string|max:50',
            'product_name' => 'required|string|max:150',
            'product_code' => 'nullable|string|max:80',
            'description' => 'nullable|string',
            'metal_type' => 'nullable|string|max:50',
            'metal_purity' => 'nullable|string|max:20',
            'weight_grams' => 'nullable|numeric|min:0',
            'stone_details' => 'nullable|string',
            'making_charges' => 'nullable|numeric|min:0',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'is_bestseller' => 'nullable|boolean',
            'is_trending' => 'nullable|boolean',
            'is_available' => 'nullable|boolean',
            'stock_quantity' => 'nullable|integer|min:0',
            'certifications' => 'nullable|string',
        ]);

        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'product-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/jewellery/products'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        JewelleryProduct::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'category' => $request->category,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'metal_type' => $request->metal_type,
            'metal_purity' => $request->metal_purity,
            'weight_grams' => $request->weight_grams,
            'stone_details' => $this->splitLines($request->stone_details),
            'making_charges' => $request->making_charges,
            'price' => $request->price,
            'images' => $imageNames,
            'video_url' => $request->video_url,
            'is_bestseller' => $request->has('is_bestseller'),
            'is_trending' => $request->has('is_trending'),
            'is_available' => $request->has('is_available'),
            'stock_quantity' => $request->stock_quantity,
            'certifications' => $this->splitLines($request->certifications),
        ]);

        return back()->with('success', 'Product added successfully!');
    }

    public function updateProduct(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $product = JewelleryProduct::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'category' => 'required|string|max:50',
            'product_name' => 'required|string|max:150',
            'product_code' => 'nullable|string|max:80',
            'description' => 'nullable|string',
            'metal_type' => 'nullable|string|max:50',
            'metal_purity' => 'nullable|string|max:20',
            'weight_grams' => 'nullable|numeric|min:0',
            'stone_details' => 'nullable|string',
            'making_charges' => 'nullable|numeric|min:0',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'is_bestseller' => 'nullable|boolean',
            'is_trending' => 'nullable|boolean',
            'is_available' => 'nullable|boolean',
            'stock_quantity' => 'nullable|integer|min:0',
            'certifications' => 'nullable|string',
        ]);

        $imageNames = $product->images ?? [];
        if ($request->hasFile('images')) {
            $imageNames = [];
            foreach ($request->file('images') as $image) {
                $imageName = 'product-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/jewellery/products'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        $product->update([
            'category' => $request->category,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'metal_type' => $request->metal_type,
            'metal_purity' => $request->metal_purity,
            'weight_grams' => $request->weight_grams,
            'stone_details' => $this->splitLines($request->stone_details),
            'making_charges' => $request->making_charges,
            'price' => $request->price,
            'images' => $imageNames,
            'video_url' => $request->video_url,
            'is_bestseller' => $request->has('is_bestseller'),
            'is_trending' => $request->has('is_trending'),
            'is_available' => $request->has('is_available'),
            'stock_quantity' => $request->stock_quantity,
            'certifications' => $this->splitLines($request->certifications),
        ]);

        return back()->with('success', 'Product updated.');
    }

    public function deleteProduct($id)
    {
        $user = Auth::guard('customer')->user();
        $product = JewelleryProduct::where('customer_id', $user->id)->findOrFail($id);
        $product->delete();

        return back()->with('success', 'Product removed.');
    }

    public function rates()
    {
        $user = Auth::guard('customer')->user();
        $rates = MetalRate::where('customer_id', $user->id)->orderByDesc('rate_date')->get();

        return view('userdashboard-new.jewellery.rates.index', compact('rates'));
    }

    public function storeRate(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'metal_type' => 'required|string|max:30',
            'purity' => 'nullable|string|max:20',
            'rate_per_gram' => 'required|numeric|min:0',
            'rate_date' => 'nullable|date',
            'city' => 'nullable|string|max:100',
        ]);

        MetalRate::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'metal_type' => $request->metal_type,
            'purity' => $request->purity,
            'rate_per_gram' => $request->rate_per_gram,
            'rate_date' => $request->rate_date,
            'city' => $request->city,
        ]);

        return back()->with('success', 'Metal rate updated.');
    }

    public function updateRate(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $rate = MetalRate::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'metal_type' => 'required|string|max:30',
            'purity' => 'nullable|string|max:20',
            'rate_per_gram' => 'required|numeric|min:0',
            'rate_date' => 'nullable|date',
            'city' => 'nullable|string|max:100',
        ]);

        $rate->update([
            'metal_type' => $request->metal_type,
            'purity' => $request->purity,
            'rate_per_gram' => $request->rate_per_gram,
            'rate_date' => $request->rate_date,
            'city' => $request->city,
        ]);

        return back()->with('success', 'Rate updated.');
    }

    public function deleteRate($id)
    {
        $user = Auth::guard('customer')->user();
        $rate = MetalRate::where('customer_id', $user->id)->findOrFail($id);
        $rate->delete();

        return back()->with('success', 'Rate removed.');
    }

    public function orders()
    {
        $user = Auth::guard('customer')->user();
        $orders = JewelleryCustomOrder::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.jewellery.orders.index', compact('orders'));
    }

    public function storeOrder(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'order_type' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:80',
            'reference_images.*' => 'nullable|image|max:2048',
            'budget_range' => 'nullable|string|max:100',
            'metal_preference' => 'nullable|string|max:80',
            'stone_preference' => 'nullable|string|max:80',
            'timeline_required' => 'nullable|string|max:100',
            'special_requirements' => 'nullable|string',
            'quoted_amount' => 'nullable|numeric|min:0',
            'advance_paid' => 'nullable|numeric|min:0',
            'order_status' => 'nullable|string|max:30',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|string|max:30',
        ]);

        $imageNames = [];
        if ($request->hasFile('reference_images')) {
            foreach ($request->file('reference_images') as $image) {
                $imageName = 'order-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/jewellery/orders'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        JewelleryCustomOrder::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'order_type' => $request->order_type,
            'category' => $request->category,
            'reference_images' => $imageNames,
            'budget_range' => $request->budget_range,
            'metal_preference' => $request->metal_preference,
            'stone_preference' => $request->stone_preference,
            'timeline_required' => $request->timeline_required,
            'special_requirements' => $request->special_requirements,
            'quoted_amount' => $request->quoted_amount,
            'advance_paid' => $request->advance_paid,
            'order_status' => $request->order_status ?? 'inquiry',
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);

        return back()->with('success', 'Custom order added.');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $order = JewelleryCustomOrder::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'order_status' => 'required|string|max:30',
        ]);

        $order->update([
            'order_status' => $request->order_status,
        ]);

        return back()->with('success', 'Order status updated.');
    }

    public function deleteOrder($id)
    {
        $user = Auth::guard('customer')->user();
        $order = JewelleryCustomOrder::where('customer_id', $user->id)->findOrFail($id);
        $order->delete();

        return back()->with('success', 'Order removed.');
    }

    // =====================
    // Frontend Booking
    // =====================

    public function orderForm(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $rates = MetalRate::where('customer_id', $customer->id)->orderByDesc('rate_date')->get();

        return view('frontend.jewellery.order', compact('customer', 'rates'));
    }

    public function storePublicOrder(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'required|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'order_type' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:80',
            'reference_images.*' => 'nullable|image|max:2048',
            'budget_range' => 'nullable|string|max:100',
            'metal_preference' => 'nullable|string|max:80',
            'stone_preference' => 'nullable|string|max:80',
            'timeline_required' => 'nullable|string|max:100',
            'special_requirements' => 'nullable|string',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|string|max:30',
        ]);

        $imageNames = [];
        if ($request->hasFile('reference_images')) {
            foreach ($request->file('reference_images') as $image) {
                $imageName = 'order-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/jewellery/orders'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        $order = JewelleryCustomOrder::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'order_type' => $request->order_type,
            'category' => $request->category,
            'reference_images' => $imageNames,
            'budget_range' => $request->budget_range,
            'metal_preference' => $request->metal_preference,
            'stone_preference' => $request->stone_preference,
            'timeline_required' => $request->timeline_required,
            'special_requirements' => $request->special_requirements,
            'order_status' => 'inquiry',
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);

        return redirect()->route('jewellery.order.thanks', ['slug' => $slug, 'orderId' => $order->id]);
    }

    public function orderThanks(Request $request, $slug, $orderId)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $order = JewelleryCustomOrder::where('customer_id', $customer->id)->findOrFail($orderId);

        return view('frontend.jewellery.thanks', compact('customer', 'order'));
    }

    private function splitLines(?string $value): array
    {
        if (!$value) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', $value);
        $lines = array_map('trim', $lines);
        $lines = array_filter($lines, static fn ($line) => $line !== '');

        return array_values($lines);
    }
}
