<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\TourBooking;
use App\Models\TourPackage;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function packages(Request $request)
    {
        $company = $this->getCompany($request);
        $packages = TourPackage::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.tour.packages.index', compact('company', 'packages'));
    }

    public function storePackage(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'package_name' => 'required|string|max:150',
            'package_type' => 'nullable|string|max:80',
            'destination' => 'nullable|string|max:150',
            'duration_days' => 'nullable|integer|min:0',
            'itinerary' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'price_per_person' => 'nullable|numeric|min:0',
            'group_discount' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'best_time_to_visit' => 'nullable|string|max:100',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'package-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/tour/packages'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        TourPackage::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'package_name' => $request->package_name,
            'package_type' => $request->package_type,
            'destination' => $request->destination,
            'duration_days' => $request->duration_days,
            'itinerary' => $this->splitLines($request->itinerary),
            'inclusions' => $this->splitLines($request->inclusions),
            'exclusions' => $this->splitLines($request->exclusions),
            'price_per_person' => $request->price_per_person,
            'group_discount' => $request->group_discount,
            'images' => $imageNames,
            'video_url' => $request->video_url,
            'best_time_to_visit' => $request->best_time_to_visit,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Package added successfully!');
    }

    public function updatePackage(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $package = TourPackage::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'package_name' => 'required|string|max:150',
            'package_type' => 'nullable|string|max:80',
            'destination' => 'nullable|string|max:150',
            'duration_days' => 'nullable|integer|min:0',
            'itinerary' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'price_per_person' => 'nullable|numeric|min:0',
            'group_discount' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'best_time_to_visit' => 'nullable|string|max:100',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $imageNames = $package->images ?? [];
        if ($request->hasFile('images')) {
            $imageNames = [];
            foreach ($request->file('images') as $image) {
                $imageName = 'package-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/tour/packages'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        $package->update([
            'package_name' => $request->package_name,
            'package_type' => $request->package_type,
            'destination' => $request->destination,
            'duration_days' => $request->duration_days,
            'itinerary' => $this->splitLines($request->itinerary),
            'inclusions' => $this->splitLines($request->inclusions),
            'exclusions' => $this->splitLines($request->exclusions),
            'price_per_person' => $request->price_per_person,
            'group_discount' => $request->group_discount,
            'images' => $imageNames,
            'video_url' => $request->video_url,
            'best_time_to_visit' => $request->best_time_to_visit,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Package updated.');
    }

    public function deletePackage(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $package = TourPackage::where('company_id', $company->id)->findOrFail($id);
        $package->delete();

        return back()->with('success', 'Package removed.');
    }

    public function bookings(Request $request)
    {
        $company = $this->getCompany($request);
        $bookings = TourBooking::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $packages = TourPackage::where('company_id', $company->id)->orderBy('package_name')->get();

        return view('company.tour.bookings.index', compact('company', 'bookings', 'packages'));
    }

    public function storeBooking(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'package_id' => 'nullable|exists:tour_packages,id',
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'travel_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'adults' => 'nullable|integer|min:0',
            'children' => 'nullable|integer|min:0',
            'room_preference' => 'nullable|string|max:100',
            'special_requirements' => 'nullable|string',
            'visa_assistance_needed' => 'nullable|boolean',
            'insurance_needed' => 'nullable|boolean',
            'total_amount' => 'nullable|numeric|min:0',
            'advance_paid' => 'nullable|numeric|min:0',
            'booking_status' => 'nullable|string|max:30',
        ]);

        TourBooking::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'package_id' => $request->package_id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'travel_date' => $request->travel_date,
            'return_date' => $request->return_date,
            'adults' => $request->adults ?? 1,
            'children' => $request->children ?? 0,
            'room_preference' => $request->room_preference,
            'special_requirements' => $request->special_requirements,
            'visa_assistance_needed' => $request->has('visa_assistance_needed'),
            'insurance_needed' => $request->has('insurance_needed'),
            'total_amount' => $request->total_amount,
            'advance_paid' => $request->advance_paid,
            'booking_status' => $request->booking_status ?? 'inquiry',
        ]);

        return back()->with('success', 'Booking added.');
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $booking = TourBooking::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'booking_status' => 'required|string|max:30',
        ]);

        $booking->update([
            'booking_status' => $request->booking_status,
        ]);

        return back()->with('success', 'Booking status updated.');
    }

    public function deleteBooking(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $booking = TourBooking::where('company_id', $company->id)->findOrFail($id);
        $booking->delete();

        return back()->with('success', 'Booking removed.');
    }

    private function getCompany(Request $request): Company
    {
        $companyId = $request->session()->get('COMPANY_ID');
        return Company::findOrFail($companyId);
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
