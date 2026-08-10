<?php

namespace App\Http\Controllers;

use App\Models\ProductionPayment;
use App\Models\ProductionPortfolio;
use App\Models\ProductionProject;
use App\Models\ProductionService;
use App\Models\ProductionTeam;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductionController extends Controller
{
    // =====================
    // User Dashboard (Customer)
    // =====================

    public function services()
    {
        $user = Auth::guard('customer')->user();
        $services = ProductionService::where('customer_id', $user->id)->orderBy('service_name')->get();

        return view('userdashboard-new.production.services.index', compact('services'));
    }

    public function storeService(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'category' => 'required|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'pricing_type' => 'nullable|string|max:30',
            'base_price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'sample_work' => 'nullable|string',
            'turnaround_time' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        ProductionService::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'category' => $request->category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'pricing_type' => $request->pricing_type,
            'base_price' => $request->base_price,
            'features' => $this->splitLines($request->features),
            'sample_work' => $this->splitLines($request->sample_work),
            'turnaround_time' => $request->turnaround_time,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $service = ProductionService::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'category' => 'required|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'pricing_type' => 'nullable|string|max:30',
            'base_price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'sample_work' => 'nullable|string',
            'turnaround_time' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $service->update([
            'category' => $request->category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'pricing_type' => $request->pricing_type,
            'base_price' => $request->base_price,
            'features' => $this->splitLines($request->features),
            'sample_work' => $this->splitLines($request->sample_work),
            'turnaround_time' => $request->turnaround_time,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service updated successfully!');
    }

    public function deleteService($id)
    {
        $user = Auth::guard('customer')->user();
        $service = ProductionService::where('customer_id', $user->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service removed.');
    }

    public function projects()
    {
        $user = Auth::guard('customer')->user();
        $projects = ProductionProject::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $services = ProductionService::where('customer_id', $user->id)->orderBy('service_name')->get();

        return view('userdashboard-new.production.projects.index', compact('projects', 'services'));
    }

    public function storeProject(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'service_category' => 'nullable|string|max:50',
            'service_ids' => 'nullable|array',
            'project_type' => 'nullable|string|max:100',
            'shoot_date' => 'nullable|date',
            'shoot_duration' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:150',
            'budget_range' => 'nullable|string|max:100',
            'requirements' => 'nullable|string',
            'quoted_amount' => 'nullable|numeric|min:0',
            'advance_paid' => 'nullable|numeric|min:0',
            'project_status' => 'nullable|string|max:30',
            'delivery_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        ProductionProject::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'service_category' => $request->service_category,
            'service_ids' => $request->service_ids,
            'project_type' => $request->project_type,
            'shoot_date' => $request->shoot_date,
            'shoot_duration' => $request->shoot_duration,
            'location' => $request->location,
            'budget_range' => $request->budget_range,
            'requirements' => $this->splitLines($request->requirements),
            'quoted_amount' => $request->quoted_amount,
            'advance_paid' => $request->advance_paid,
            'project_status' => $request->project_status ?? 'inquiry',
            'delivery_date' => $request->delivery_date,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Project added successfully!');
    }

    public function updateProjectStatus(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $project = ProductionProject::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'project_status' => 'required|string|max:30',
        ]);

        $project->update([
            'project_status' => $request->project_status,
        ]);

        return back()->with('success', 'Project status updated.');
    }

    public function deleteProject($id)
    {
        $user = Auth::guard('customer')->user();
        $project = ProductionProject::where('customer_id', $user->id)->findOrFail($id);
        $project->delete();

        return back()->with('success', 'Project removed.');
    }

    public function portfolios()
    {
        $user = Auth::guard('customer')->user();
        $portfolios = ProductionPortfolio::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.production.portfolios.index', compact('portfolios'));
    }

    public function storePortfolio(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'category' => 'nullable|string|max:50',
            'project_title' => 'required|string|max:150',
            'client_name' => 'nullable|string|max:150',
            'project_type' => 'nullable|string|max:100',
            'thumbnail_image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'images.*' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'production_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        $thumbnailName = null;
        if ($request->hasFile('thumbnail_image')) {
            $thumbnailName = 'thumb-' . Str::random(8) . '.' . $request->thumbnail_image->getClientOriginalExtension();
            $request->thumbnail_image->move(public_path('uploads/production/portfolio'), $thumbnailName);
        }

        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'work-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/production/portfolio'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        ProductionPortfolio::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'category' => $request->category,
            'project_title' => $request->project_title,
            'client_name' => $request->client_name,
            'project_type' => $request->project_type,
            'thumbnail_image' => $thumbnailName,
            'video_url' => $request->video_url,
            'images' => $imageNames,
            'description' => $request->description,
            'production_date' => $request->production_date,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Portfolio item added.');
    }

    public function deletePortfolio($id)
    {
        $user = Auth::guard('customer')->user();
        $portfolio = ProductionPortfolio::where('customer_id', $user->id)->findOrFail($id);
        $portfolio->delete();

        return back()->with('success', 'Portfolio item removed.');
    }

    public function team()
    {
        $user = Auth::guard('customer')->user();
        $members = ProductionTeam::where('customer_id', $user->id)->orderBy('display_order')->get();

        return view('userdashboard-new.production.team.index', compact('members'));
    }

    public function storeTeam(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'member_name' => 'required|string|max:150',
            'role' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'experience_years' => 'nullable|integer|min:0',
            'specialization' => 'nullable|string|max:150',
            'portfolio_link' => 'nullable|url|max:255',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = 'team-' . Str::random(8) . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads/production/team'), $photoName);
        }

        ProductionTeam::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'member_name' => $request->member_name,
            'role' => $request->role,
            'bio' => $request->bio,
            'photo' => $photoName,
            'experience_years' => $request->experience_years,
            'specialization' => $request->specialization,
            'portfolio_link' => $request->portfolio_link,
            'display_order' => $request->display_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Team member added.');
    }

    public function updateTeam(Request $request, $id)
    {
        $user = Auth::guard('customer')->user();
        $member = ProductionTeam::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'member_name' => 'required|string|max:150',
            'role' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'experience_years' => 'nullable|integer|min:0',
            'specialization' => 'nullable|string|max:150',
            'portfolio_link' => 'nullable|url|max:255',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $photoName = $member->photo;
        if ($request->hasFile('photo')) {
            $photoName = 'team-' . Str::random(8) . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('uploads/production/team'), $photoName);
        }

        $member->update([
            'member_name' => $request->member_name,
            'role' => $request->role,
            'bio' => $request->bio,
            'photo' => $photoName,
            'experience_years' => $request->experience_years,
            'specialization' => $request->specialization,
            'portfolio_link' => $request->portfolio_link,
            'display_order' => $request->display_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Team member updated.');
    }

    public function deleteTeam($id)
    {
        $user = Auth::guard('customer')->user();
        $member = ProductionTeam::where('customer_id', $user->id)->findOrFail($id);
        $member->delete();

        return back()->with('success', 'Team member removed.');
    }

    public function payments()
    {
        $user = Auth::guard('customer')->user();
        $payments = ProductionPayment::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $projects = ProductionProject::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.production.payments.index', compact('payments', 'projects'));
    }

    public function storePayment(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'project_id' => 'nullable|exists:production_projects,id',
            'payment_stage' => 'nullable|string|max:30',
            'amount' => 'nullable|numeric|min:0',
            'payment_mode' => 'nullable|string|max:30',
            'payment_status' => 'nullable|string|max:30',
            'transaction_id' => 'nullable|string|max:100',
            'paid_on' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        ProductionPayment::create([
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
            'project_id' => $request->project_id,
            'payment_stage' => $request->payment_stage,
            'amount' => $request->amount,
            'payment_mode' => $request->payment_mode,
            'payment_status' => $request->payment_status ?? 'pending',
            'transaction_id' => $request->transaction_id,
            'paid_on' => $request->paid_on,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Payment added.');
    }

    // =====================
    // Frontend Booking
    // =====================

    public function bookingForm(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $services = ProductionService::where('customer_id', $customer->id)
            ->where('is_active', true)
            ->orderBy('service_name')
            ->get();

        return view('frontend.production.booking', compact('customer', 'services'));
    }

    public function storeBooking(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'required|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'service_category' => 'nullable|string|max:50',
            'service_ids' => 'nullable|array',
            'project_type' => 'nullable|string|max:100',
            'shoot_date' => 'nullable|date',
            'shoot_duration' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:150',
            'budget_range' => 'nullable|string|max:100',
            'requirements' => 'nullable|string',
        ]);

        $project = ProductionProject::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'service_category' => $request->service_category,
            'service_ids' => $request->service_ids,
            'project_type' => $request->project_type,
            'shoot_date' => $request->shoot_date,
            'shoot_duration' => $request->shoot_duration,
            'location' => $request->location,
            'budget_range' => $request->budget_range,
            'requirements' => $this->splitLines($request->requirements),
            'project_status' => 'inquiry',
        ]);

        return redirect()->route('production.booking.thanks', ['slug' => $slug, 'projectId' => $project->id]);
    }

    public function bookingThanks(Request $request, $slug, $projectId)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $project = ProductionProject::where('customer_id', $customer->id)->findOrFail($projectId);

        return view('frontend.production.thanks', compact('customer', 'project'));
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
