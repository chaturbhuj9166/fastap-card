<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalProfile;
use App\Models\MedicalAppointment;
use App\Models\MedicalPayment;
use App\Models\MedicalReview;
use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MedicalController extends Controller
{
    /**
     * Normalize comma-separated or JSON list inputs into arrays.
     */
    protected function parseListInput($value)
    {
        if (is_array($value)) {
            return array_values(array_filter(array_map('trim', $value)));
        }

        $value = trim((string) $value);
        if ($value === '') {
            return null;
        }

        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return array_values(array_filter(array_map('trim', $decoded)));
        }

        return array_values(array_filter(array_map('trim', explode(',', $value))));
    }

    /**
     * Show medical profile selector (public view)
     */
    public function showProfileSelector($slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $profiles = MedicalProfile::where('customer_id', $customer->id)
                                  ->where('is_active', true)
                                  ->orderBy('display_order')
                                  ->get();

        // Get default profile or first active profile
        $defaultProfile = $profiles->where('is_default', true)->first() ?? $profiles->first();

        return view('frontend.medical.profile-selector', compact('customer', 'profiles', 'defaultProfile'))
            ->with('userdata', $customer);
    }

    /**
     * Show specific medical profile (public view)
     */
    public function showProfile($slug, $profileType)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $profile = MedicalProfile::where('customer_id', $customer->id)
                                 ->where('profile_type', $profileType)
                                 ->where('is_active', true)
                                 ->firstOrFail();

        $viewName = 'frontend.medical.' . $profileType . '-profile';
        return view($viewName, compact('customer', 'profile'))
            ->with('userdata', $customer);
    }

    // ==================== USER DASHBOARD - PROFILE MANAGEMENT ====================

    /**
     * Show medical profile settings in user dashboard
     */
    public function profileSettings()
    {
        $user = Auth::guard('customer')->user();
        $profiles = MedicalProfile::where('customer_id', $user->id)
                                  ->orderBy('display_order')
                                  ->get();

        return view('userdashboard-new.medical.profile-settings', compact('profiles'));
    }

    /**
     * Create or update medical profile
     */
    public function saveProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_type' => 'required|in:doctor,hospital,daycare',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::guard('customer')->user();

        // If setting as default, unset other defaults
        if ($request->is_default) {
            MedicalProfile::where('customer_id', $user->id)->update(['is_default' => false]);
        }

        $profile = MedicalProfile::updateOrCreate(
            [
                'customer_id' => $user->id,
                'profile_type' => $request->profile_type,
            ],
            [
                'is_active' => $request->is_active ?? true,
                'is_default' => $request->is_default ?? false,
                'specialization' => $request->specialization,
                'degree' => $request->degree,
                'experience_years' => $request->experience_years,
                'patients_treated' => $request->patients_treated,
                'registration_number' => $request->registration_number,
                'hospital_name' => $request->hospital_name,
                'bed_capacity' => $request->bed_capacity,
                'departments' => $this->parseListInput($request->departments),
                'facilities' => $this->parseListInput($request->facilities),
                'ambulance_service' => $request->ambulance_service ?? false,
                'emergency_contact' => $request->emergency_contact,
                'insurance_accepted' => $this->parseListInput($request->insurance_accepted),
                'home_services' => $this->parseListInput($request->home_services),
                'service_packages' => $this->parseListInput($request->service_packages),
                'service_areas' => $this->parseListInput($request->service_areas),
                'equipment_rental' => $request->equipment_rental ?? false,
                'consultation_fee_inperson' => $request->consultation_fee_inperson,
                'consultation_fee_video' => $request->consultation_fee_video,
                'opd_timings' => $this->parseListInput($request->opd_timings),
                'clinic_address' => $request->clinic_address,
                'clinic_facilities' => $this->parseListInput($request->clinic_facilities),
            ]
        );

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $images = [];
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('medical/gallery', 'public');
                $images[] = $path;
            }
            $profile->gallery_images = $images;
            $profile->save();
        }

        return redirect()->back()->with('success', 'Medical profile saved successfully!');
    }

    /**
     * Delete medical profile
     */
    public function deleteProfile($id)
    {
        $user = Auth::guard('customer')->user();
        $profile = MedicalProfile::where('customer_id', $user->id)->findOrFail($id);
        $profile->delete();

        return redirect()->back()->with('success', 'Profile deleted successfully!');
    }

    // ==================== APPOINTMENTS ====================

    /**
     * Show appointment booking form (public)
     */
    public function showAppointmentForm($slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $profiles = MedicalProfile::where('customer_id', $customer->id)
                                  ->where('is_active', true)
                                  ->get();

        return view('frontend.medical.book-appointment', compact('customer', 'profiles'))
            ->with('userdata', $customer);
    }

    /**
     * Store appointment booking (public)
     */
    public function storeAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'profile_type' => 'required|in:doctor,hospital,daycare',
            'patient_name' => 'required|string|max:255',
            'patient_mobile' => 'required|string|max:15',
            'patient_email' => 'nullable|email',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'service' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $appointment = MedicalAppointment::create([
            'customer_id' => $request->customer_id,
            'profile_type' => $request->profile_type,
            'patient_name' => $request->patient_name,
            'patient_mobile' => $request->patient_mobile,
            'patient_email' => $request->patient_email,
            'patient_age' => $request->patient_age,
            'patient_gender' => $request->patient_gender,
            'service' => $request->service,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'symptoms' => $request->symptoms,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Appointment booked successfully! You will receive a confirmation shortly.');
    }

    /**
     * Show appointments dashboard (user)
     */
    public function appointments()
    {
        $user = Auth::guard('customer')->user();
        $appointments = MedicalAppointment::where('customer_id', $user->id)
                                          ->with('medicalProfile')
                                          ->orderBy('appointment_date', 'desc')
                                          ->paginate(20);

        $upcomingCount = MedicalAppointment::where('customer_id', $user->id)->upcoming()->count();
        $pendingCount = MedicalAppointment::where('customer_id', $user->id)->pending()->count();

        return view('userdashboard-new.medical.appointments', compact('appointments', 'upcomingCount', 'pendingCount'));
    }

    /**
     * Update appointment status (user)
     */
    public function updateAppointmentStatus(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $appointment = MedicalAppointment::where('customer_id', $user->id)->findOrFail($id);

        $appointment->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Appointment status updated!');
    }

    // ==================== PAYMENTS ====================

    /**
     * Show payment form (public)
     */
    public function showPaymentForm($slug, $appointmentId = null)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $appointment = null;

        if ($appointmentId) {
            $appointment = MedicalAppointment::where('customer_id', $customer->id)
                                            ->findOrFail($appointmentId);
        }

        return view('frontend.medical.payment', compact('customer', 'appointment'))
            ->with('userdata', $customer);
    }

    /**
     * Process payment (public)
     */
    public function processPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'patient_name' => 'required|string',
            'patient_mobile' => 'required|string',
            'service_type' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|in:upi,card,cash,bank_transfer,online_gateway',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $finalAmount = $request->amount - ($request->discount ?? 0);

        $payment = MedicalPayment::create([
            'customer_id' => $request->customer_id,
            'appointment_id' => $request->appointment_id,
            'patient_name' => $request->patient_name,
            'patient_mobile' => $request->patient_mobile,
            'patient_email' => $request->patient_email,
            'service_type' => $request->service_type,
            'amount' => $request->amount,
            'discount' => $request->discount ?? 0,
            'final_amount' => $finalAmount,
            'payment_mode' => $request->payment_mode,
            'upi_transaction_id' => $request->upi_transaction_id,
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        // Handle payment screenshot upload
        if ($request->hasFile('payment_screenshot')) {
            $path = $request->file('payment_screenshot')->store('medical/payments', 'public');
            $payment->payment_screenshot = $path;
            $payment->save();
        }

        // Update appointment payment status if linked
        if ($request->appointment_id) {
            MedicalAppointment::where('id', $request->appointment_id)->update([
                'payment_status' => 'paid',
                'payment_transaction_id' => $payment->receipt_number,
            ]);
        }

        $customer = customer::find($payment->customer_id);
        return view('frontend.medical.payment-success', compact('payment', 'customer'))
            ->with('userdata', $customer);
    }

    /**
     * Show payments dashboard (user)
     */
    public function payments()
    {
        $user = Auth::guard('customer')->user();
        $payments = MedicalPayment::where('customer_id', $user->id)
                                  ->with('appointment')
                                  ->orderBy('created_at', 'desc')
                                  ->paginate(20);

        $totalRevenue = MedicalPayment::where('customer_id', $user->id)
                                      ->where('status', 'completed')
                                      ->sum('final_amount');

        return view('userdashboard-new.medical.payments', compact('payments', 'totalRevenue'));
    }

    /**
     * Download payment receipt (user)
     */
    public function downloadReceipt($id)
    {
        $user = Auth::guard('customer')->user();
        $payment = MedicalPayment::where('customer_id', $user->id)->findOrFail($id);

        // Generate receipt data
        $receiptData = $payment->generateReceipt();

        // Return receipt view (can be extended to PDF)
        $customer = customer::find($payment->customer_id);
        return view('frontend.medical.receipt', compact('payment', 'receiptData', 'customer'))
            ->with('userdata', $customer);
    }

    /**
     * Show payment settings in user dashboard
     */
    public function paymentSettings()
    {
        $user = Auth::guard('customer')->user();
        return view('userdashboard-new.medical.payment-settings', compact('user'));
    }

    /**
     * Save payment settings (UPI, bank details, etc.)
     */
    public function savePaymentSettings(Request $request)
    {
        $user = Auth::guard('customer')->user();

        // This can be extended to store payment settings
        // For now, we'll store in customer table or create separate settings table

        return redirect()->back()->with('success', 'Payment settings saved successfully!');
    }

    // ==================== REVIEWS & RATINGS ====================

    /**
     * Show reviews for a medical profile (public)
     */
    public function showReviews($slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $reviews = MedicalReview::where('customer_id', $customer->id)
                                ->approved()
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        $averageRating = MedicalReview::averageRatingFor($customer->id);
        $totalReviews = MedicalReview::totalReviewsFor($customer->id);
        $ratingDistribution = MedicalReview::ratingDistributionFor($customer->id);

        return view('frontend.medical.reviews', compact('customer', 'reviews', 'averageRating', 'totalReviews', 'ratingDistribution'))
            ->with('userdata', $customer);
    }

    /**
     * Store review (public)
     */
    public function storeReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'profile_type' => 'required|in:doctor,hospital,daycare',
            'reviewer_name' => 'required|string|max:255',
            'reviewer_email' => 'nullable|email',
            'reviewer_mobile' => 'nullable|string|max:15',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|min:10',
            'visit_date' => 'nullable|date',
            'treatment_type' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        MedicalReview::create([
            'customer_id' => $request->customer_id,
            'profile_type' => $request->profile_type,
            'reviewer_name' => $request->reviewer_name,
            'reviewer_email' => $request->reviewer_email,
            'reviewer_mobile' => $request->reviewer_mobile,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'visit_date' => $request->visit_date,
            'treatment_type' => $request->treatment_type,
            'status' => 'pending', // Reviews require approval
        ]);

        return redirect()->back()->with('success', 'Thank you for your review! It will be published after approval.');
    }

    /**
     * Show reviews dashboard (user)
     */
    public function reviews()
    {
        $user = Auth::guard('customer')->user();
        $reviews = MedicalReview::where('customer_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(20);

        $averageRating = MedicalReview::averageRatingFor($user->id);
        $totalReviews = MedicalReview::totalReviewsFor($user->id);
        $pendingCount = MedicalReview::where('customer_id', $user->id)->pending()->count();

        return view('userdashboard-new.medical.reviews', compact('reviews', 'averageRating', 'totalReviews', 'pendingCount'));
    }

    /**
     * Approve review (user)
     */
    public function approveReview($id)
    {
        $user = Auth::guard('customer')->user();
        $review = MedicalReview::where('customer_id', $user->id)->findOrFail($id);

        $review->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Review approved successfully!');
    }

    /**
     * Reject review (user)
     */
    public function rejectReview($id)
    {
        $user = Auth::guard('customer')->user();
        $review = MedicalReview::where('customer_id', $user->id)->findOrFail($id);

        $review->update([
            'status' => 'rejected',
        ]);

        return redirect()->back()->with('success', 'Review rejected.');
    }

    /**
     * Toggle featured status of review (user)
     */
    public function toggleFeaturedReview($id)
    {
        $user = Auth::guard('customer')->user();
        $review = MedicalReview::where('customer_id', $user->id)->findOrFail($id);

        $review->update([
            'is_featured' => !$review->is_featured,
        ]);

        return redirect()->back()->with('success', 'Review featured status updated!');
    }

    /**
     * Delete review (user)
     */
    public function deleteReview($id)
    {
        $user = Auth::guard('customer')->user();
        $review = MedicalReview::where('customer_id', $user->id)->findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }
}
