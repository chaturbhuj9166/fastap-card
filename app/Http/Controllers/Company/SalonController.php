<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SalonAppointment;
use App\Models\SalonArtist;
use App\Models\SalonPackage;
use App\Models\SalonPortfolio;
use App\Models\SalonProduct;
use App\Models\SalonService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SalonController extends Controller
{
    public function services(Request $request)
    {
        $company = $this->getCompany($request);
        $services = SalonService::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.salon.services.index', compact('company', 'services'));
    }

    public function storeService(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $service = SalonService::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = SalonService::where('company_id', $company->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service removed.');
    }

    public function artists(Request $request)
    {
        $company = $this->getCompany($request);
        $artists = SalonArtist::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.salon.artists.index', compact('company', 'artists'));
    }

    public function storeArtist(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $artist = SalonArtist::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteArtist(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $artist = SalonArtist::where('company_id', $company->id)->findOrFail($id);
        $artist->delete();

        return back()->with('success', 'Artist removed.');
    }

    public function appointments(Request $request)
    {
        $company = $this->getCompany($request);
        $appointments = SalonAppointment::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $services = SalonService::where('company_id', $company->id)->orderBy('service_name')->get();
        $artists = SalonArtist::where('company_id', $company->id)->orderBy('artist_name')->get();

        return view('company.salon.appointments.index', compact('company', 'appointments', 'services', 'artists'));
    }

    public function storeAppointment(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $appointment = SalonAppointment::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:20',
        ]);

        $appointment->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Appointment status updated.');
    }

    public function deleteAppointment(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $appointment = SalonAppointment::where('company_id', $company->id)->findOrFail($id);
        $appointment->delete();

        return back()->with('success', 'Appointment removed.');
    }

    public function packages(Request $request)
    {
        $company = $this->getCompany($request);
        $packages = SalonPackage::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.salon.packages.index', compact('company', 'packages'));
    }

    public function storePackage(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $package = SalonPackage::where('company_id', $company->id)->findOrFail($id);

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

    public function deletePackage(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $package = SalonPackage::where('company_id', $company->id)->findOrFail($id);
        $package->delete();

        return back()->with('success', 'Package removed.');
    }

    public function portfolio(Request $request)
    {
        $company = $this->getCompany($request);
        $portfolioItems = SalonPortfolio::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.salon.portfolio.index', compact('company', 'portfolioItems'));
    }

    public function storePortfolio(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $item = SalonPortfolio::where('company_id', $company->id)->findOrFail($id);

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

    public function deletePortfolio(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $item = SalonPortfolio::where('company_id', $company->id)->findOrFail($id);
        $item->delete();

        return back()->with('success', 'Portfolio item removed.');
    }

    public function products(Request $request)
    {
        $company = $this->getCompany($request);
        $products = SalonProduct::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.salon.products.index', compact('company', 'products'));
    }

    public function storeProduct(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

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
            'customer_id' => $customerId,
            'company_id' => $company->id,
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
        $company = $this->getCompany($request);
        $product = SalonProduct::where('company_id', $company->id)->findOrFail($id);

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

    public function deleteProduct(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $product = SalonProduct::where('company_id', $company->id)->findOrFail($id);
        $product->delete();

        return back()->with('success', 'Product removed.');
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
