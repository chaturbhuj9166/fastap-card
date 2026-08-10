<?php

namespace App\Http\Controllers;

use App\Models\RealEstateProfile;
use App\Models\RealEstateProperty;
use App\Models\RealEstateSiteVisit;
use App\Models\ProfileLocationTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RealEstateController extends Controller
{
    /**
     * Display profiles management page
     */
    public function profiles()
    {
        $user = Auth::guard('customer')->user();
        $profiles = RealEstateProfile::where('customer_id', $user->id)
                                     ->orderBy('display_order')
                                     ->get();

        $activeProfiles = $profiles->where('is_active', true)->pluck('profile_type')->toArray();
        $defaultProfile = optional($profiles->firstWhere('is_default', true))->profile_type;

        return view('userdashboard-new.real-estate.profiles.index', compact('profiles', 'activeProfiles', 'defaultProfile'));
    }

    /**
     * Store or update profiles
     */
    public function storeProfiles(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'profiles' => 'required|array',
            'profiles.*' => ['string', Rule::in(['residential', 'commercial', 'plot', 'rental', 'builder'])],
            'default_profile' => ['required', 'string', Rule::in(['residential', 'commercial', 'plot', 'rental', 'builder'])],
        ]);

        $activeProfiles = $request->profiles;
        if (!in_array($request->default_profile, $activeProfiles, true)) {
            return redirect()->back()->withErrors([
                'default_profile' => 'The default profile must be one of the active profiles.',
            ])->withInput();
        }

        // Get all profile types
        $allTypes = ['residential', 'commercial', 'plot', 'rental', 'builder'];

        foreach ($allTypes as $index => $type) {
            $profile = RealEstateProfile::firstOrNew([
                'customer_id' => $user->id,
                'profile_type' => $type,
            ]);

            $profile->is_active = in_array($type, $activeProfiles);
            $profile->is_default = ($type === $request->default_profile);
            $profile->display_order = $index;
            $profile->save();
        }

        return redirect()->back()->with('success', 'Profile settings updated successfully!');
    }

    /**
     * Display properties list
     */
    public function properties()
    {
        $user = Auth::guard('customer')->user();
        $properties = RealEstateProperty::where('customer_id', $user->id)
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10);

        $activeProfiles = RealEstateProfile::where('customer_id', $user->id)
                                          ->where('is_active', true)
                                          ->pluck('profile_type')
                                          ->toArray();

        // Profile-wise analytics
        $analytics = $this->getProfileAnalytics($user->id);

        return view('userdashboard-new.real-estate.properties.index', compact('properties', 'activeProfiles', 'analytics'));
    }

    /**
     * Get analytics data per profile type
     */
    private function getProfileAnalytics($customerId)
    {
        $profileTypes = ['residential', 'commercial', 'plot', 'rental', 'builder'];
        $analytics = [];

        foreach ($profileTypes as $type) {
            $analytics[$type] = [
                'total' => RealEstateProperty::where('customer_id', $customerId)
                                            ->where('profile_type', $type)
                                            ->count(),
                'active' => RealEstateProperty::where('customer_id', $customerId)
                                             ->where('profile_type', $type)
                                             ->where('is_active', true)
                                             ->count(),
                'featured' => RealEstateProperty::where('customer_id', $customerId)
                                               ->where('profile_type', $type)
                                               ->where('is_featured', true)
                                               ->count(),
                'visits' => RealEstateSiteVisit::where('customer_id', $customerId)
                                              ->whereHas('property', function($q) use ($type) {
                                                  $q->where('profile_type', $type);
                                              })
                                              ->count(),
            ];
        }

        return $analytics;
    }

    /**
     * Show create property form
     */
    public function createProperty()
    {
        $user = Auth::guard('customer')->user();
        $activeProfiles = RealEstateProfile::where('customer_id', $user->id)
                                          ->where('is_active', true)
                                          ->pluck('profile_type')
                                          ->toArray();

        if (empty($activeProfiles)) {
            return redirect()->route('real-estate.profiles')
                           ->with('error', 'Please activate at least one profile type first!');
        }

        return view('userdashboard-new.real-estate.properties.create', compact('activeProfiles'));
    }

    /**
     * Store new property
     */
    public function storeProperty(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'profile_type' => 'required|in:residential,commercial,plot,rental,builder',
            'title' => 'required|string|max:255',
            'property_type' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'rental_price' => 'nullable|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'area_sqft' => 'nullable|numeric|min:0',
            'location' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:30',
            'address' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'parking' => 'nullable|integer|min:0',
            'status' => 'required|in:ready,under_construction,upcoming',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $property = new RealEstateProperty();
        $property->customer_id = $user->id;
        $property->fill($request->except('images'));

        // Handle features
        if ($request->has('features')) {
            $property->features = array_filter($request->features);
        }

        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('frontend/properties'), $filename);
                $images[] = 'frontend/properties/' . $filename;
            }
        }
        $property->images = $images;

        $property->save();

        return redirect()->route('real-estate.properties.index')
                       ->with('success', 'Property added successfully!');
    }

    /**
     * Show edit property form
     */
    public function editProperty($id)
    {
        $user = Auth::guard('customer')->user();
        $property = RealEstateProperty::where('customer_id', $user->id)
                                      ->findOrFail($id);

        $activeProfiles = RealEstateProfile::where('customer_id', $user->id)
                                          ->where('is_active', true)
                                          ->pluck('profile_type')
                                          ->toArray();

        return view('userdashboard-new.real-estate.properties.edit', compact('property', 'activeProfiles'));
    }

    /**
     * Update property
     */
    public function updateProperty(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $property = RealEstateProperty::where('customer_id', $user->id)
                                      ->findOrFail($id);

        $request->validate([
            'profile_type' => 'required|in:residential,commercial,plot,rental,builder',
            'title' => 'required|string|max:255',
            'property_type' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'rental_price' => 'nullable|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'area_sqft' => 'nullable|numeric|min:0',
            'location' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:30',
            'status' => 'required|in:ready,under_construction,upcoming',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $property->fill($request->except('images'));

        // Handle features
        if ($request->has('features')) {
            $property->features = array_filter($request->features);
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $images = $property->images ?? [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('frontend/properties'), $filename);
                $images[] = 'frontend/properties/' . $filename;
            }
            $property->images = $images;
        }

        $property->save();

        return redirect()->route('real-estate.properties.index')
                       ->with('success', 'Property updated successfully!');
    }

    /**
     * Delete property
     */
    public function destroyProperty($id)
    {
        $user = Auth::guard('customer')->user();
        $property = RealEstateProperty::where('customer_id', $user->id)
                                      ->findOrFail($id);

        // Delete images
        if ($property->images) {
            foreach ($property->images as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }

        $property->delete();

        return redirect()->route('real-estate.properties.index')
                       ->with('success', 'Property deleted successfully!');
    }

    /**
     * Toggle property active status
     */
    public function togglePropertyStatus($id)
    {
        $user = Auth::guard('customer')->user();
        $property = RealEstateProperty::where('customer_id', $user->id)
                                      ->findOrFail($id);

        $property->is_active = !$property->is_active;
        $property->save();

        return redirect()->back()->with('success', 'Property status updated!');
    }

    /**
     * Display site visits
     */
    public function siteVisits()
    {
        $user = Auth::guard('customer')->user();
        $visits = RealEstateSiteVisit::where('customer_id', $user->id)
                                     ->with('property')
                                     ->orderBy('visit_date', 'desc')
                                     ->paginate(15);

        $stats = [
            'total' => RealEstateSiteVisit::where('customer_id', $user->id)->count(),
            'pending' => RealEstateSiteVisit::where('customer_id', $user->id)->where('status', 'pending')->count(),
            'confirmed' => RealEstateSiteVisit::where('customer_id', $user->id)->where('status', 'confirmed')->count(),
            'completed' => RealEstateSiteVisit::where('customer_id', $user->id)->where('status', 'completed')->count(),
        ];

        return view('userdashboard-new.real-estate.site-visits.index', compact('visits', 'stats'));
    }

    /**
     * Display location tracking history
     */
    public function locationTracking(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $tracksQuery = ProfileLocationTrack::where('customer_id', $user->id)
            ->orderBy('created_at', 'desc');

        if ($request->filled('source')) {
            $tracksQuery->where('tap_source', $request->source);
        }

        $tracks = $tracksQuery->paginate(20);

        $stats = [
            'total' => ProfileLocationTrack::where('customer_id', $user->id)->count(),
            'last_7_days' => ProfileLocationTrack::where('customer_id', $user->id)
                ->where('created_at', '>=', now()->subDays(7))
                ->count(),
            'with_location' => ProfileLocationTrack::where('customer_id', $user->id)
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->count(),
            'nfc' => ProfileLocationTrack::where('customer_id', $user->id)
                ->where('tap_source', 'nfc')
                ->count(),
            'qr' => ProfileLocationTrack::where('customer_id', $user->id)
                ->where('tap_source', 'qr')
                ->count(),
        ];

        return view('userdashboard-new.real-estate.location-tracking.index', compact('tracks', 'stats'));
    }

    /**
     * Show visit details
     */
    public function showVisit($id)
    {
        $user = Auth::guard('customer')->user();
        $visit = RealEstateSiteVisit::where('customer_id', $user->id)
                                    ->with('property')
                                    ->findOrFail($id);

        return view('userdashboard-new.real-estate.site-visits.show', compact('visit'));
    }

    /**
     * Update visit status
     */
    public function updateVisitStatus(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $visit = RealEstateSiteVisit::where('customer_id', $user->id)
                                    ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $visit->status = $request->status;
        $visit->save();

        return redirect()->back()->with('success', 'Visit status updated!');
    }

    /**
     * Add notes to visit
     */
    public function addVisitNotes(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $visit = RealEstateSiteVisit::where('customer_id', $user->id)
                                    ->findOrFail($id);

        $request->validate([
            'notes' => 'required|string',
        ]);

        $visit->notes = $request->notes;
        $visit->save();

        return redirect()->back()->with('success', 'Notes added successfully!');
    }

    /**
     * Store site visit booking (Frontend)
     */
    public function bookSiteVisit(Request $request, $propertyId)
    {
        $property = RealEstateProperty::where('is_active', true)
                                      ->findOrFail($propertyId);

        $request->validate([
            'visitor_name' => 'required|string|max:255',
            'visitor_mobile' => 'required|string|max:15',
            'visitor_email' => 'nullable|email',
            'visit_date' => 'required|date|after:today',
            'visit_time' => 'required',
            'visitor_message' => 'nullable|string',
        ]);

        $visit = new RealEstateSiteVisit();
        $visit->property_id = $property->id;
        $visit->customer_id = $property->customer_id;
        $visit->visitor_name = $request->visitor_name;
        $visit->visitor_mobile = $request->visitor_mobile;
        $visit->visitor_email = $request->visitor_email;
        $visit->visit_date = $request->visit_date;
        $visit->visit_time = $request->visit_time;
        $visit->visitor_message = $request->visitor_message;
        $visit->status = 'pending';
        $visit->save();

        return redirect()->back()->with('success', 'Site visit booked successfully! The property owner will confirm shortly.');
    }
}
