<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\RestaurantInfo;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display restaurant settings
     */
    public function index(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $customerId = $this->resolveCustomerId($company);

        // Check if company has restaurant theme (Theme 13)
        if ($company->profession_type != 13) {
            return redirect('/company/dashboard')->with('error', 'Restaurant settings are only available for Restaurant/Hotel theme.');
        }

        // Get or create restaurant info
        $restaurantInfo = RestaurantInfo::firstOrCreate(
            ['company_id' => $companyId, 'customer_id' => $customerId],
            [
                'customer_id' => $customerId,
                'operating_hours' => $this->getDefaultOperatingHours(),
                'delivery_available' => false,
                'dine_in_available' => true,
                'takeaway_available' => true,
                'reservation_available' => false,
            ]
        );

        return view('company.restaurant.index', compact('company', 'restaurantInfo'));
    }

    /**
     * Update basic restaurant info
     */
    public function updateBasic(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'cuisine_type' => 'nullable|string|max:255',
            'seating_capacity' => 'nullable|integer|min:0',
            'average_cost' => 'nullable|numeric|min:0',
            'dress_code' => 'nullable|string|max:255',
            'special_features' => 'nullable|string|max:1000',
        ]);

        $restaurantInfo = RestaurantInfo::where('company_id', $companyId)->first();

        if (!$restaurantInfo) {
            $restaurantInfo = RestaurantInfo::create([
                'company_id' => $companyId,
                'customer_id' => $customerId,
                'operating_hours' => $this->getDefaultOperatingHours(),
            ]);
        }

        $restaurantInfo->update([
            'cuisine_type' => $request->cuisine_type,
            'seating_capacity' => $request->seating_capacity,
            'average_cost' => $request->average_cost,
            'dress_code' => $request->dress_code,
            'special_features' => $request->special_features,
        ]);

        return back()->with('success', 'Restaurant information updated successfully!');
    }

    /**
     * Update operating hours
     */
    public function updateHours(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'operating_hours' => 'required|array',
            'operating_hours.*.is_open' => 'nullable|boolean',
            'operating_hours.*.open' => 'nullable|string',
            'operating_hours.*.close' => 'nullable|string',
        ]);

        $restaurantInfo = RestaurantInfo::where('company_id', $companyId)->first();

        if (!$restaurantInfo) {
            $restaurantInfo = RestaurantInfo::create([
                'company_id' => $companyId,
                'customer_id' => $customerId,
                'operating_hours' => $this->getDefaultOperatingHours(),
            ]);
        }

        // Process operating hours
        $operatingHours = [];
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            $operatingHours[$day] = [
                'is_open' => isset($request->operating_hours[$day]['is_open']),
                'open' => $request->operating_hours[$day]['open'] ?? '09:00',
                'close' => $request->operating_hours[$day]['close'] ?? '22:00',
            ];
        }

        $restaurantInfo->operating_hours = $operatingHours;
        $restaurantInfo->save();

        return back()->with('success', 'Operating hours updated successfully!');
    }

    /**
     * Update service options
     */
    public function updateServices(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $customerId = $this->resolveCustomerId($company);

        $restaurantInfo = RestaurantInfo::where('company_id', $companyId)->first();

        if (!$restaurantInfo) {
            $restaurantInfo = RestaurantInfo::create([
                'company_id' => $companyId,
                'customer_id' => $customerId,
                'operating_hours' => $this->getDefaultOperatingHours(),
            ]);
        }

        $restaurantInfo->update([
            'dine_in_available' => $request->has('dine_in_available'),
            'takeaway_available' => $request->has('takeaway_available'),
            'delivery_available' => $request->has('delivery_available'),
            'reservation_available' => $request->has('reservation_available'),
            'delivery_radius' => $request->delivery_radius,
            'minimum_order' => $request->minimum_order,
            'delivery_fee' => $request->delivery_fee,
            'delivery_time' => $request->delivery_time,
        ]);

        return back()->with('success', 'Service options updated successfully!');
    }

    /**
     * Update payment options
     */
    public function updatePayments(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $customerId = $this->resolveCustomerId($company);

        $restaurantInfo = RestaurantInfo::where('company_id', $companyId)->first();

        if (!$restaurantInfo) {
            $restaurantInfo = RestaurantInfo::create([
                'company_id' => $companyId,
                'customer_id' => $customerId,
                'operating_hours' => $this->getDefaultOperatingHours(),
            ]);
        }

        $paymentMethods = [];
        $methods = ['cash', 'card', 'upi', 'wallet', 'netbanking'];
        foreach ($methods as $method) {
            if ($request->has('payment_' . $method)) {
                $paymentMethods[] = $method;
            }
        }

        $restaurantInfo->payment_methods = implode(',', $paymentMethods);
        $restaurantInfo->save();

        return back()->with('success', 'Payment options updated successfully!');
    }

    /**
     * Get default operating hours
     */
    private function getDefaultOperatingHours()
    {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $hours = [];

        foreach ($days as $day) {
            $hours[$day] = [
                'is_open' => true,
                'open' => '09:00',
                'close' => '22:00',
            ];
        }

        return $hours;
    }

    private function resolveCustomerId(Company $company): int
    {
        if ($company->created_by) {
            return (int) $company->created_by;
        }

        $customerId = $company->customers()->value('id');
        if (!$customerId) {
            abort(400, 'Company owner not found.');
        }

        return (int) $customerId;
    }
}
