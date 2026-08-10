<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreativeBooking;
use App\Models\CreativePackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CreativeBookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index(Request $request)
    {
        $query = CreativeBooking::where('customer_id', Auth::id());

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $bookings = $query->with('package')
                          ->orderBy('event_date', 'desc')
                          ->paginate(15);

        $stats = [
            'pending' => CreativeBooking::where('customer_id', Auth::id())->where('status', 'pending')->count(),
            'confirmed' => CreativeBooking::where('customer_id', Auth::id())->where('status', 'confirmed')->count(),
            'completed' => CreativeBooking::where('customer_id', Auth::id())->where('status', 'completed')->count(),
            'cancelled' => CreativeBooking::where('customer_id', Auth::id())->where('status', 'cancelled')->count(),
        ];

        return view('userdashboard-new.creative.bookings.index', compact('bookings', 'stats'));
    }

    /**
     * Show the form for viewing a booking
     */
    public function show($id)
    {
        $booking = CreativeBooking::where('customer_id', Auth::id())
                                  ->with('package')
                                  ->findOrFail($id);

        return view('userdashboard-new.creative.bookings.show', compact('booking'));
    }

    /**
     * Update booking status
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = CreativeBooking::where('customer_id', Auth::id())
                                  ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()
                        ->with('success', 'Booking status updated successfully!');
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(Request $request, $id)
    {
        $booking = CreativeBooking::where('customer_id', Auth::id())
                                  ->findOrFail($id);

        $request->validate([
            'payment_status' => 'required|in:pending,partial,paid,refunded',
            'payment_amount' => 'nullable|numeric|min:0',
        ]);

        $booking->payment_status = $request->payment_status;
        if ($request->has('payment_amount')) {
            $booking->payment_amount = $request->payment_amount;
        }
        $booking->save();

        return redirect()->back()
                        ->with('success', 'Payment status updated successfully!');
    }

    /**
     * Add notes to booking
     */
    public function addNotes(Request $request, $id)
    {
        $booking = CreativeBooking::where('customer_id', Auth::id())
                                  ->findOrFail($id);

        $request->validate([
            'notes' => 'required|string',
        ]);

        $booking->notes = $request->notes;
        $booking->save();

        return redirect()->back()
                        ->with('success', 'Notes added successfully!');
    }

    /**
     * Show booking form (frontend)
     */
    public function showBookingForm($slug)
    {
        $customer = \App\Models\customer::where('slug', $slug)->firstOrFail();

        $packages = collect();
        if (Schema::hasTable('creative_packages')) {
            $packages = CreativePackage::where('customer_id', $customer->id)
                                       ->where('is_active', true)
                                       ->orderBy('sort_order')
                                       ->get();
        }

        return view('frontend.creative.booking-form', compact('customer', 'packages'));
    }

    /**
     * Store a new booking (from frontend)
     */
    public function store(Request $request)
    {
        $packageRule = Schema::hasTable('creative_packages')
            ? 'nullable|exists:creative_packages,id'
            : 'nullable';

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'package_id' => $packageRule,
            'client_name' => 'required|string|max:255',
            'client_mobile' => 'required|string|max:20',
            'client_email' => 'nullable|email',
            'service_type' => 'required|in:photography,event,combined',
            'event_date' => 'required|date|after:today',
            'event_time' => 'nullable',
            'event_type' => 'nullable|string|max:255',
            'guest_count' => 'nullable|integer|min:1',
            'budget' => 'nullable|numeric|min:0',
            'venue' => 'nullable|string',
            'special_requirements' => 'nullable|string',
        ]);

        CreativeBooking::create($validated);

        return redirect()->back()
                        ->with('success', 'Your booking request has been submitted successfully! We will contact you soon.');
    }
}
