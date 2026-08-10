<?php

namespace App\Http\Controllers;

use App\Models\TalentProfile;
use App\Models\TalentPortfolio;
use App\Models\TalentBooking;
use App\Models\TalentSocialStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TalentController extends Controller
{
    // ==================== PROFILE MANAGEMENT ====================

    /**
     * Show talent profiles management
     */
    public function manageProfiles()
    {
        $customer = Auth::guard('customer')->user();
        $profiles = TalentProfile::where('customer_id', $customer->id)
                                 ->ordered()
                                 ->get();

        $activeProfiles = $profiles->where('is_active', true)
                                   ->pluck('talent_type')
                                   ->values()
                                   ->all();
        $defaultProfile = optional($profiles->firstWhere('is_default', true))->talent_type;

        return view('userdashboard-new.talent.profiles.index', compact('profiles', 'activeProfiles', 'defaultProfile'));
    }

    /**
     * Toggle talent profile activation
     */
    public function toggleProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $talentType = $request->talent_type;

        // Check if profile exists
        $profile = TalentProfile::where('customer_id', $customer->id)
                                ->where('talent_type', $talentType)
                                ->first();

        if ($profile) {
            // Toggle activation
            $profile->is_active = !$profile->is_active;
            $profile->save();
        } else {
            // Create new profile
            $profile = TalentProfile::create([
                'customer_id' => $customer->id,
                'talent_type' => $talentType,
                'is_active' => true,
                'is_default' => TalentProfile::where('customer_id', $customer->id)->count() === 0,
                'display_order' => TalentProfile::where('customer_id', $customer->id)->count()
            ]);
        }

        return response()->json([
            'success' => true,
            'is_active' => $profile->is_active,
            'message' => $profile->is_active ? 'Profile activated' : 'Profile deactivated'
        ]);
    }

    /**
     * Set default talent profile
     */
    public function setDefaultProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $talentType = $request->talent_type;

        $profile = TalentProfile::where('customer_id', $customer->id)
                                ->where('talent_type', $talentType)
                                ->first();

        if ($profile) {
            $profile->setAsDefault();
            return response()->json(['success' => true, 'message' => 'Default profile updated']);
        }

        return response()->json(['success' => false, 'message' => 'Profile not found'], 404);
    }

    /**
     * Update talent profile selections
     */
    public function updateProfiles(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $selectedProfiles = $request->input('profiles', []);
        $defaultProfile = $request->input('default_profile');
        $allowedTypes = array_keys(TalentProfile::$talentTypes);

        if (!is_array($selectedProfiles)) {
            $selectedProfiles = [];
        }

        $selectedProfiles = array_values(array_intersect($selectedProfiles, $allowedTypes));
        $defaultProfile = in_array($defaultProfile, $selectedProfiles, true) ? $defaultProfile : null;

        $existingProfiles = TalentProfile::where('customer_id', $customer->id)->get()->keyBy('talent_type');
        $displayOrder = 0;

        foreach ($allowedTypes as $type) {
            $isActive = in_array($type, $selectedProfiles, true);

            if ($existingProfiles->has($type)) {
                $profile = $existingProfiles->get($type);
                $profile->is_active = $isActive;
                $profile->is_default = false;
                if ($isActive) {
                    $profile->display_order = $displayOrder;
                    $displayOrder++;
                }
                $profile->save();
                continue;
            }

            if ($isActive) {
                TalentProfile::create([
                    'customer_id' => $customer->id,
                    'talent_type' => $type,
                    'is_active' => true,
                    'is_default' => false,
                    'display_order' => $displayOrder,
                ]);
                $displayOrder++;
            }
        }

        if ($defaultProfile) {
            $profile = TalentProfile::where('customer_id', $customer->id)
                                    ->where('talent_type', $defaultProfile)
                                    ->first();
            if ($profile) {
                $profile->setAsDefault();
            }
        } else {
            $firstActive = TalentProfile::where('customer_id', $customer->id)
                                        ->where('is_active', true)
                                        ->orderBy('display_order')
                                        ->first();
            if ($firstActive) {
                $firstActive->setAsDefault();
            }
        }

        return redirect()->back()->with('success', 'Profile settings updated');
    }

    // ==================== PORTFOLIO MANAGEMENT ====================

    /**
     * Show portfolio items
     */
    public function portfolio()
    {
        $customer = Auth::guard('customer')->user();
        $activeProfiles = TalentProfile::getActiveProfilesForCustomer($customer->id);

        // Get selected talent type from query or default
        $selectedTalent = request('talent', $activeProfiles->first()->talent_type ?? null);

        $portfolioItems = TalentPortfolio::where('customer_id', $customer->id)
                                         ->byTalent($selectedTalent)
                                         ->ordered()
                                         ->get();

        return view('userdashboard-new.talent.portfolio.index', compact('portfolioItems', 'activeProfiles', 'selectedTalent'));
    }

    /**
     * Show create portfolio form
     */
    public function createPortfolio()
    {
        $customer = Auth::guard('customer')->user();
        $activeProfiles = TalentProfile::getActiveProfilesForCustomer($customer->id);

        return view('userdashboard-new.talent.portfolio.create', compact('activeProfiles'));
    }

    /**
     * Store portfolio item
     */
    public function storePortfolio(Request $request)
    {
        $request->validate([
            'talent_type' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'media_type' => 'required|in:image,video,audio',
            'media_url' => 'required|string',
            'thumbnail' => 'nullable|string',
            'category' => 'nullable|string',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        $customer = Auth::guard('customer')->user();

        // Handle file upload if it's an image
        $mediaUrl = $request->media_url;
        $thumbnail = $request->thumbnail;

        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('frontend/talent/portfolio'), $filename);
            $mediaUrl = $filename;
        }

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $filename = time() . '_thumb_' . $file->getClientOriginalName();
            $file->move(public_path('frontend/talent/portfolio'), $filename);
            $thumbnail = $filename;
        }

        TalentPortfolio::create([
            'customer_id' => $customer->id,
            'talent_type' => $request->talent_type,
            'title' => $request->title,
            'description' => $request->description,
            'media_type' => $request->media_type,
            'media_url' => $mediaUrl,
            'thumbnail' => $thumbnail,
            'category' => $request->category,
            'year' => $request->year,
            'is_featured' => $request->has('is_featured'),
            'status' => true,
        ]);

        return redirect()->route('talent.portfolio.index', ['talent' => $request->talent_type])
                        ->with('success', 'Portfolio item added successfully');
    }

    /**
     * Show edit portfolio form
     */
    public function editPortfolio($id)
    {
        $customer = Auth::guard('customer')->user();
        $item = TalentPortfolio::where('customer_id', $customer->id)->findOrFail($id);
        $activeProfiles = TalentProfile::getActiveProfilesForCustomer($customer->id);

        return view('userdashboard-new.talent.portfolio.edit', compact('item', 'activeProfiles'));
    }

    /**
     * Update portfolio item
     */
    public function updatePortfolio(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        $customer = Auth::guard('customer')->user();
        $item = TalentPortfolio::where('customer_id', $customer->id)->findOrFail($id);

        $mediaUrl = $item->media_url;
        $thumbnail = $item->thumbnail;

        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('frontend/talent/portfolio'), $filename);
            $mediaUrl = $filename;
        }

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $filename = time() . '_thumb_' . $file->getClientOriginalName();
            $file->move(public_path('frontend/talent/portfolio'), $filename);
            $thumbnail = $filename;
        }

        $item->update([
            'title' => $request->title,
            'description' => $request->description,
            'media_url' => $mediaUrl,
            'thumbnail' => $thumbnail,
            'category' => $request->category,
            'year' => $request->year,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('talent.portfolio.index', ['talent' => $item->talent_type])
                        ->with('success', 'Portfolio item updated successfully');
    }

    /**
     * Delete portfolio item
     */
    public function destroyPortfolio($id)
    {
        $customer = Auth::guard('customer')->user();
        $item = TalentPortfolio::where('customer_id', $customer->id)->findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Portfolio item deleted successfully');
    }

    /**
     * Toggle portfolio item status
     */
    public function togglePortfolioStatus($id)
    {
        $customer = Auth::guard('customer')->user();
        $item = TalentPortfolio::where('customer_id', $customer->id)->findOrFail($id);
        $item->status = !$item->status;
        $item->save();

        return response()->json(['success' => true, 'status' => $item->status]);
    }

    // ==================== BOOKING MANAGEMENT ====================

    /**
     * Show bookings
     */
    public function bookings()
    {
        $customer = Auth::guard('customer')->user();
        $activeProfiles = TalentProfile::getActiveProfilesForCustomer($customer->id);

        $selectedTalent = request('talent', null);
        $status = request('status', null);

        $query = TalentBooking::where('customer_id', $customer->id);

        if ($selectedTalent) {
            $query->byTalent($selectedTalent);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $bookings = $query->recent()->paginate(20);

        // Stats
        $stats = [
            'total' => TalentBooking::where('customer_id', $customer->id)->count(),
            'pending' => TalentBooking::where('customer_id', $customer->id)->pending()->count(),
            'confirmed' => TalentBooking::where('customer_id', $customer->id)->confirmed()->count(),
            'completed' => TalentBooking::where('customer_id', $customer->id)->completed()->count(),
        ];

        return view('userdashboard-new.talent.bookings.index', compact('bookings', 'activeProfiles', 'selectedTalent', 'status', 'stats'));
    }

    /**
     * Show booking details
     */
    public function showBooking($id)
    {
        $customer = Auth::guard('customer')->user();
        $booking = TalentBooking::where('customer_id', $customer->id)->findOrFail($id);

        return view('userdashboard-new.talent.bookings.show', compact('booking'));
    }

    /**
     * Update booking status
     */
    public function updateBookingStatus(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();
        $booking = TalentBooking::where('customer_id', $customer->id)->findOrFail($id);

        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Booking status updated');
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();
        $booking = TalentBooking::where('customer_id', $customer->id)->findOrFail($id);

        $booking->update(['payment_status' => $request->payment_status]);

        return redirect()->back()->with('success', 'Payment status updated');
    }

    /**
     * Add notes to booking
     */
    public function addBookingNotes(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();
        $booking = TalentBooking::where('customer_id', $customer->id)->findOrFail($id);

        $booking->update(['notes' => $request->notes]);

        return redirect()->back()->with('success', 'Notes updated');
    }

    // ==================== SOCIAL STATS MANAGEMENT ====================

    /**
     * Show social stats
     */
    public function socialStats()
    {
        $customer = Auth::guard('customer')->user();
        $stats = TalentSocialStat::where('customer_id', $customer->id)->get();
        $socialStats = $stats;

        $totalFollowers = TalentSocialStat::getTotalFollowers($customer->id);
        $totalViews = TalentSocialStat::getTotalViews($customer->id);

        return view('userdashboard-new.talent.social-stats.index', compact('stats', 'socialStats', 'totalFollowers', 'totalViews'));
    }

    /**
     * Store or update social stat
     */
    public function storeSocialStat(Request $request)
    {
        $request->validate([
            'platform' => 'required|in:instagram,youtube,facebook,tiktok,twitter,linkedin,other',
            'platform_url' => 'nullable|url',
            'platform_username' => 'nullable|string',
            'followers' => 'required|integer|min:0',
            'engagement_rate' => 'nullable|numeric|min:0|max:100',
            'total_views' => 'nullable|integer|min:0',
            'total_posts' => 'nullable|integer|min:0',
            'is_verified' => 'nullable|boolean',
        ]);

        $customer = Auth::guard('customer')->user();

        TalentSocialStat::updateOrCreate(
            [
                'customer_id' => $customer->id,
                'platform' => $request->platform
            ],
            [
                'platform_url' => $request->platform_url,
                'platform_username' => $request->platform_username,
                'followers' => $request->followers,
                'engagement_rate' => $request->engagement_rate,
                'total_views' => $request->total_views ?? 0,
                'total_posts' => $request->total_posts ?? 0,
                'is_verified' => $request->has('is_verified'),
                'last_updated' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Social stats updated successfully');
    }

    /**
     * Delete social stat
     */
    public function destroySocialStat($id)
    {
        $customer = Auth::guard('customer')->user();
        $stat = TalentSocialStat::where('customer_id', $customer->id)->findOrFail($id);
        $stat->delete();

        return redirect()->back()->with('success', 'Social stat deleted');
    }

    // ==================== FRONTEND METHODS ====================

    /**
     * Store booking from frontend (public)
     */
    public function storeBooking(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'talent_type' => 'required|string',
            'client_name' => 'required|string|max:255',
            'client_email' => 'nullable|email',
            'client_mobile' => 'required|string',
            'client_company' => 'nullable|string',
            'event_type' => 'nullable|string',
            'event_description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'event_location' => 'nullable|string',
            'duration_days' => 'nullable|integer|min:1',
            'budget' => 'nullable|numeric|min:0',
            'requirements' => 'nullable|string',
        ]);

        TalentBooking::create($request->all());

        return redirect()->back()->with('success', 'Booking request submitted successfully! The talent will contact you soon.');
    }

    /**
     * Show booking form
     */
    public function showBookingForm($customerId, $talentType)
    {
        $customer = \App\Models\Customer::findOrFail($customerId);
        $profile = TalentProfile::where('customer_id', $customerId)
                                ->where('talent_type', $talentType)
                                ->active()
                                ->firstOrFail();

        return view('frontend.talent.booking-form', compact('customer', 'profile'));
    }
}
