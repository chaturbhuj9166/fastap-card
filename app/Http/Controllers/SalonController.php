<?php

namespace App\Http\Controllers;

use App\Models\SalonAppointment;
use App\Models\SalonArtist;
use App\Models\SalonPackage;
use App\Models\SalonPortfolio;
use App\Models\SalonProduct;
use App\Models\SalonService;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SalonController extends Controller
{
    // =====================
    // User Dashboard (Customer)
    // =====================

    public function services()
    {
        $user = Auth::guard('customer')->user();
        $services = SalonService::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.salon.services.index', compact('services'));
    }

    public function storeService(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'service_category' => 'required|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'duration_minutes' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:2048',
            'is_available' => 'nullable|boolean',
        ]);

        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'service-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/salon/services'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        SalonService::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'price' => $request->price,
            'images' => $imageNames,
            'is_available' => $request->has('is_available'),
        ]);

        return back()->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $service = SalonService::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'service_category' => 'required|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'duration_minutes' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:2048',
            'is_available' => 'nullable|boolean',
        ]);

        $imageNames = $service->images ?? [];
        if ($request->hasFile('images')) {
            $imageNames = [];
            foreach ($request->file('images') as $image) {
                $imageName = 'service-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/salon/services'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        $service->update([
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'price' => $request->price,
            'images' => $imageNames,
            'is_available' => $request->has('is_available'),
        ]);

        return back()->with('success', 'Service updated.');
    }

    public function deleteService($id)
    {
        $user = Auth::guard('customer')->user();
        $service = SalonService::where('customer_id', $user->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service removed.');
    }

    public function artists()
    {
        $user = Auth::guard('customer')->user();
        $artists = SalonArtist::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.salon.artists.index', compact('artists'));
    }

    public function storeArtist(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'artist_name' => 'required|string|max:150',
            'specialization' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'experience_years' => 'nullable|integer|min:0',
            'certifications' => 'nullable|string|max:255',
            'is_available' => 'nullable|boolean',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = 'artist-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/salon/artists'), $photoName);
        }

        SalonArtist::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'artist_name' => $request->artist_name,
            'specialization' => $this->splitLines($request->specialization),
            'photo' => $photoName,
            'experience_years' => $request->experience_years,
            'certifications' => $request->certifications,
            'is_available' => $request->has('is_available'),
        ]);

        return back()->with('success', 'Artist added successfully!');
    }

    public function updateArtist(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $artist = SalonArtist::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'artist_name' => 'required|string|max:150',
            'specialization' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'experience_years' => 'nullable|integer|min:0',
            'certifications' => 'nullable|string|max:255',
            'is_available' => 'nullable|boolean',
        ]);

        $photoName = $artist->photo;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = 'artist-' . Str::random(8) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/salon/artists'), $photoName);
        }

        $artist->update([
            'artist_name' => $request->artist_name,
            'specialization' => $this->splitLines($request->specialization),
            'photo' => $photoName,
            'experience_years' => $request->experience_years,
            'certifications' => $request->certifications,
            'is_available' => $request->has('is_available'),
        ]);

        return back()->with('success', 'Artist updated.');
    }

    public function deleteArtist($id)
    {
        $user = Auth::guard('customer')->user();
        $artist = SalonArtist::where('customer_id', $user->id)->findOrFail($id);
        $artist->delete();

        return back()->with('success', 'Artist removed.');
    }

    public function appointments()
    {
        $user = Auth::guard('customer')->user();
        $appointments = SalonAppointment::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $services = SalonService::where('customer_id', $user->id)->orderBy('service_name')->get();
        $artists = SalonArtist::where('customer_id', $user->id)->orderBy('artist_name')->get();

        return view('userdashboard-new.salon.appointments.index', compact('appointments', 'services', 'artists'));
    }

    public function storeAppointment(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|date_format:H:i',
            'services' => 'nullable|array',
            'services.*' => 'exists:salon_services,id',
            'artist_id' => 'nullable|exists:salon_artists,id',
            'location' => 'nullable|string|max:20',
            'home_address' => 'nullable|string',
            'total_amount' => 'nullable|numeric|min:0',
            'advance_paid' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        SalonAppointment::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'services' => $request->services ?? [],
            'artist_id' => $request->artist_id,
            'location' => $request->location,
            'home_address' => $request->home_address,
            'total_amount' => $request->total_amount,
            'advance_paid' => $request->advance_paid,
            'status' => $request->status ?? 'scheduled',
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Appointment added.');
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $appointment = SalonAppointment::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:20',
        ]);

        $appointment->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Appointment status updated.');
    }

    public function deleteAppointment($id)
    {
        $user = Auth::guard('customer')->user();
        $appointment = SalonAppointment::where('customer_id', $user->id)->findOrFail($id);
        $appointment->delete();

        return back()->with('success', 'Appointment removed.');
    }

    public function packages()
    {
        $user = Auth::guard('customer')->user();
        $packages = SalonPackage::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.salon.packages.index', compact('packages'));
    }

    public function storePackage(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'package_name' => 'required|string|max:150',
            'package_type' => 'nullable|string|max:40',
            'services_included' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'validity_days' => 'nullable|integer|min:0',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        SalonPackage::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'package_name' => $request->package_name,
            'package_type' => $request->package_type,
            'services_included' => $this->splitLines($request->services_included),
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'validity_days' => $request->validity_days,
            'features' => $this->splitLines($request->features),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Package added.');
    }

    public function updatePackage(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $package = SalonPackage::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'package_name' => 'required|string|max:150',
            'package_type' => 'nullable|string|max:40',
            'services_included' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'validity_days' => 'nullable|integer|min:0',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $package->update([
            'package_name' => $request->package_name,
            'package_type' => $request->package_type,
            'services_included' => $this->splitLines($request->services_included),
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'validity_days' => $request->validity_days,
            'features' => $this->splitLines($request->features),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Package updated.');
    }

    public function deletePackage($id)
    {
        $user = Auth::guard('customer')->user();
        $package = SalonPackage::where('customer_id', $user->id)->findOrFail($id);
        $package->delete();

        return back()->with('success', 'Package removed.');
    }

    public function portfolio()
    {
        $user = Auth::guard('customer')->user();
        $portfolioItems = SalonPortfolio::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.salon.portfolio.index', compact('portfolioItems'));
    }

    public function storePortfolio(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'category' => 'nullable|string|max:100',
            'title' => 'required|string|max:150',
            'before_image' => 'nullable|image|max:2048',
            'after_image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $beforeImage = null;
        if ($request->hasFile('before_image')) {
            $image = $request->file('before_image');
            $beforeImage = 'before-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/salon/portfolio'), $beforeImage);
        }

        $afterImage = null;
        if ($request->hasFile('after_image')) {
            $image = $request->file('after_image');
            $afterImage = 'after-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/salon/portfolio'), $afterImage);
        }

        SalonPortfolio::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'category' => $request->category,
            'title' => $request->title,
            'before_image' => $beforeImage,
            'after_image' => $afterImage,
            'description' => $request->description,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Portfolio item added.');
    }

    public function updatePortfolio(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $item = SalonPortfolio::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'category' => 'nullable|string|max:100',
            'title' => 'required|string|max:150',
            'before_image' => 'nullable|image|max:2048',
            'after_image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $beforeImage = $item->before_image;
        if ($request->hasFile('before_image')) {
            $image = $request->file('before_image');
            $beforeImage = 'before-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/salon/portfolio'), $beforeImage);
        }

        $afterImage = $item->after_image;
        if ($request->hasFile('after_image')) {
            $image = $request->file('after_image');
            $afterImage = 'after-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/salon/portfolio'), $afterImage);
        }

        $item->update([
            'category' => $request->category,
            'title' => $request->title,
            'before_image' => $beforeImage,
            'after_image' => $afterImage,
            'description' => $request->description,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Portfolio item updated.');
    }

    public function deletePortfolio($id)
    {
        $user = Auth::guard('customer')->user();
        $item = SalonPortfolio::where('customer_id', $user->id)->findOrFail($id);
        $item->delete();

        return back()->with('success', 'Portfolio item removed.');
    }

    public function products()
    {
        $user = Auth::guard('customer')->user();
        $products = SalonProduct::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.salon.products.index', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'product_name' => 'required|string|max:150',
            'category' => 'nullable|string|max:80',
            'price' => 'nullable|numeric|min:0',
            'brand' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'is_available' => 'nullable|boolean',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'product-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/salon/products'), $imageName);
        }

        SalonProduct::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'product_name' => $request->product_name,
            'category' => $request->category,
            'price' => $request->price,
            'brand' => $request->brand,
            'image' => $imageName,
            'description' => $request->description,
            'is_available' => $request->has('is_available'),
        ]);

        return back()->with('success', 'Product added.');
    }

    public function updateProduct(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $product = SalonProduct::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'product_name' => 'required|string|max:150',
            'category' => 'nullable|string|max:80',
            'price' => 'nullable|numeric|min:0',
            'brand' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'is_available' => 'nullable|boolean',
        ]);

        $imageName = $product->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'product-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/salon/products'), $imageName);
        }

        $product->update([
            'product_name' => $request->product_name,
            'category' => $request->category,
            'price' => $request->price,
            'brand' => $request->brand,
            'image' => $imageName,
            'description' => $request->description,
            'is_available' => $request->has('is_available'),
        ]);

        return back()->with('success', 'Product updated.');
    }

    public function deleteProduct($id)
    {
        $user = Auth::guard('customer')->user();
        $product = SalonProduct::where('customer_id', $user->id)->findOrFail($id);
        $product->delete();

        return back()->with('success', 'Product removed.');
    }

    // =====================
    // Frontend Booking
    // =====================

    public function bookingForm(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $services = SalonService::where('customer_id', $customer->id)
            ->where('is_available', 1)
            ->orderBy('service_name')
            ->get();
        $artists = SalonArtist::where('customer_id', $customer->id)
            ->where('is_available', 1)
            ->orderBy('artist_name')
            ->get();

        return view('frontend.salon.booking', compact('customer', 'services', 'artists'));
    }

    public function storePublicAppointment(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'required|string|max:30',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|date_format:H:i',
            'services' => 'nullable|array',
            'services.*' => 'exists:salon_services,id',
            'artist_id' => 'nullable|exists:salon_artists,id',
            'location' => 'nullable|string|max:20',
            'home_address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $appointment = SalonAppointment::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'services' => $request->services ?? [],
            'artist_id' => $request->artist_id,
            'location' => $request->location,
            'home_address' => $request->home_address,
            'status' => 'scheduled',
            'notes' => $request->notes,
        ]);

        return redirect()->route('salon.booking.thanks', ['slug' => $slug, 'appointmentId' => $appointment->id]);
    }

    public function bookingThanks(Request $request, $slug, $appointmentId)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $appointment = SalonAppointment::where('customer_id', $customer->id)->findOrFail($appointmentId);

        return view('frontend.salon.thanks', compact('customer', 'appointment'));
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
