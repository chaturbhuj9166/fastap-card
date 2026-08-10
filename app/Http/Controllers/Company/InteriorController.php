<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DesignConsultation;
use App\Models\InteriorPortfolio;
use App\Models\InteriorProject;
use App\Models\InteriorService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InteriorController extends Controller
{
    public function services(Request $request)
    {
        $company = $this->getCompany($request);
        $services = InteriorService::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.interior.services.index', compact('company', 'services'));
    }

    public function storeService(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'service_category' => 'nullable|string|max:100',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'pricing_type' => 'nullable|string|max:50',
            'base_price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        InteriorService::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'pricing_type' => $request->pricing_type,
            'base_price' => $request->base_price,
            'features' => $this->splitLines($request->features),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = InteriorService::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'service_category' => 'nullable|string|max:100',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'pricing_type' => 'nullable|string|max:50',
            'base_price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $service->update([
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'pricing_type' => $request->pricing_type,
            'base_price' => $request->base_price,
            'features' => $this->splitLines($request->features),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service updated.');
    }

    public function deleteService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = InteriorService::where('company_id', $company->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service removed.');
    }

    public function projects(Request $request)
    {
        $company = $this->getCompany($request);
        $projects = InteriorProject::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.interior.projects.index', compact('company', 'projects'));
    }

    public function storeProject(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'nullable|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'project_type' => 'nullable|string|max:50',
            'property_type' => 'nullable|string|max:50',
            'area_sqft' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:150',
            'budget_range' => 'nullable|string|max:100',
            'requirements' => 'nullable|string',
            'consultation_date' => 'nullable|date',
            'site_visit_date' => 'nullable|date',
            'design_approval_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'expected_completion_date' => 'nullable|date',
            'project_status' => 'nullable|string|max:30',
            'quoted_amount' => 'nullable|numeric|min:0',
            'advance_paid' => 'nullable|numeric|min:0',
            'design_files.*' => 'nullable|file|max:4096',
        ]);

        $designFiles = $this->storeFiles($request, 'design_files', 'uploads/interior/projects', 'design');

        InteriorProject::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'project_type' => $request->project_type,
            'property_type' => $request->property_type,
            'area_sqft' => $request->area_sqft,
            'location' => $request->location,
            'budget_range' => $request->budget_range,
            'requirements' => $this->splitLines($request->requirements),
            'consultation_date' => $request->consultation_date,
            'site_visit_date' => $request->site_visit_date,
            'design_approval_date' => $request->design_approval_date,
            'start_date' => $request->start_date,
            'expected_completion_date' => $request->expected_completion_date,
            'project_status' => $request->project_status ?? 'inquiry',
            'quoted_amount' => $request->quoted_amount,
            'advance_paid' => $request->advance_paid,
            'design_files' => $designFiles,
        ]);

        return back()->with('success', 'Project added successfully!');
    }

    public function updateProject(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = InteriorProject::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'client_name' => 'nullable|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'project_type' => 'nullable|string|max:50',
            'property_type' => 'nullable|string|max:50',
            'area_sqft' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:150',
            'budget_range' => 'nullable|string|max:100',
            'requirements' => 'nullable|string',
            'consultation_date' => 'nullable|date',
            'site_visit_date' => 'nullable|date',
            'design_approval_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'expected_completion_date' => 'nullable|date',
            'project_status' => 'nullable|string|max:30',
            'quoted_amount' => 'nullable|numeric|min:0',
            'advance_paid' => 'nullable|numeric|min:0',
            'design_files.*' => 'nullable|file|max:4096',
        ]);

        $designFiles = $project->design_files ?? [];
        $newFiles = $this->storeFiles($request, 'design_files', 'uploads/interior/projects', 'design');
        if (!empty($newFiles)) {
            $designFiles = $newFiles;
        }

        $project->update([
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'project_type' => $request->project_type,
            'property_type' => $request->property_type,
            'area_sqft' => $request->area_sqft,
            'location' => $request->location,
            'budget_range' => $request->budget_range,
            'requirements' => $this->splitLines($request->requirements),
            'consultation_date' => $request->consultation_date,
            'site_visit_date' => $request->site_visit_date,
            'design_approval_date' => $request->design_approval_date,
            'start_date' => $request->start_date,
            'expected_completion_date' => $request->expected_completion_date,
            'project_status' => $request->project_status ?? $project->project_status,
            'quoted_amount' => $request->quoted_amount,
            'advance_paid' => $request->advance_paid,
            'design_files' => $designFiles,
        ]);

        return back()->with('success', 'Project updated.');
    }

    public function deleteProject(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = InteriorProject::where('company_id', $company->id)->findOrFail($id);
        $project->delete();

        return back()->with('success', 'Project removed.');
    }

    public function portfolio(Request $request)
    {
        $company = $this->getCompany($request);
        $portfolioItems = InteriorPortfolio::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.interior.portfolio.index', compact('company', 'portfolioItems'));
    }

    public function storePortfolio(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'project_title' => 'required|string|max:150',
            'project_category' => 'nullable|string|max:50',
            'room_type' => 'nullable|string|max:50',
            'style' => 'nullable|string|max:50',
            'area_sqft' => 'nullable|integer|min:0',
            'before_images.*' => 'nullable|image|max:2048',
            'after_images.*' => 'nullable|image|max:2048',
            'design_render_images.*' => 'nullable|image|max:2048',
            'video_url' => 'nullable|string|max:255',
            'project_description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $beforeImages = $this->storeImages($request, 'before_images', 'uploads/interior/portfolio/before', 'before');
        $afterImages = $this->storeImages($request, 'after_images', 'uploads/interior/portfolio/after', 'after');
        $renderImages = $this->storeImages($request, 'design_render_images', 'uploads/interior/portfolio/renders', 'render');

        InteriorPortfolio::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'project_title' => $request->project_title,
            'project_category' => $request->project_category,
            'room_type' => $request->room_type,
            'style' => $request->style,
            'area_sqft' => $request->area_sqft,
            'before_images' => $beforeImages,
            'after_images' => $afterImages,
            'design_render_images' => $renderImages,
            'video_url' => $request->video_url,
            'project_description' => $request->project_description,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Portfolio item added successfully!');
    }

    public function updatePortfolio(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $item = InteriorPortfolio::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'project_title' => 'required|string|max:150',
            'project_category' => 'nullable|string|max:50',
            'room_type' => 'nullable|string|max:50',
            'style' => 'nullable|string|max:50',
            'area_sqft' => 'nullable|integer|min:0',
            'before_images.*' => 'nullable|image|max:2048',
            'after_images.*' => 'nullable|image|max:2048',
            'design_render_images.*' => 'nullable|image|max:2048',
            'video_url' => 'nullable|string|max:255',
            'project_description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $beforeImages = $item->before_images ?? [];
        $afterImages = $item->after_images ?? [];
        $renderImages = $item->design_render_images ?? [];

        $newBefore = $this->storeImages($request, 'before_images', 'uploads/interior/portfolio/before', 'before');
        $newAfter = $this->storeImages($request, 'after_images', 'uploads/interior/portfolio/after', 'after');
        $newRender = $this->storeImages($request, 'design_render_images', 'uploads/interior/portfolio/renders', 'render');

        if (!empty($newBefore)) {
            $beforeImages = $newBefore;
        }
        if (!empty($newAfter)) {
            $afterImages = $newAfter;
        }
        if (!empty($newRender)) {
            $renderImages = $newRender;
        }

        $item->update([
            'project_title' => $request->project_title,
            'project_category' => $request->project_category,
            'room_type' => $request->room_type,
            'style' => $request->style,
            'area_sqft' => $request->area_sqft,
            'before_images' => $beforeImages,
            'after_images' => $afterImages,
            'design_render_images' => $renderImages,
            'video_url' => $request->video_url,
            'project_description' => $request->project_description,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Portfolio item updated.');
    }

    public function deletePortfolio(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $item = InteriorPortfolio::where('company_id', $company->id)->findOrFail($id);
        $item->delete();

        return back()->with('success', 'Portfolio item removed.');
    }

    public function consultations(Request $request)
    {
        $company = $this->getCompany($request);
        $consultations = DesignConsultation::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.interior.consultations.index', compact('company', 'consultations'));
    }

    public function storeConsultation(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'consultation_type' => 'nullable|string|max:50',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|date_format:H:i',
            'project_type' => 'nullable|string|max:50',
            'property_type' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:150',
            'requirements' => 'nullable|string',
            'consultation_fee' => 'nullable|numeric|min:0',
            'payment_status' => 'nullable|string|max:30',
            'status' => 'nullable|string|max:30',
            'meeting_link' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        DesignConsultation::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'consultation_type' => $request->consultation_type,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'project_type' => $request->project_type,
            'property_type' => $request->property_type,
            'location' => $request->location,
            'requirements' => $request->requirements,
            'consultation_fee' => $request->consultation_fee,
            'payment_status' => $request->payment_status,
            'status' => $request->status ?? 'scheduled',
            'meeting_link' => $request->meeting_link,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Consultation added.');
    }

    public function updateConsultationStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $consultation = DesignConsultation::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:30',
            'payment_status' => 'nullable|string|max:30',
            'meeting_link' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $consultation->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
            'meeting_link' => $request->meeting_link,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Consultation updated.');
    }

    public function deleteConsultation(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $consultation = DesignConsultation::where('company_id', $company->id)->findOrFail($id);
        $consultation->delete();

        return back()->with('success', 'Consultation removed.');
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

    private function storeImages(Request $request, string $field, string $directory, string $prefix): array
    {
        if (!$request->hasFile($field)) {
            return [];
        }

        $storagePath = public_path($directory);
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $imageNames = [];
        foreach ($request->file($field) as $image) {
            $imageName = $prefix . '-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move($storagePath, $imageName);
            $imageNames[] = $imageName;
        }

        return $imageNames;
    }

    private function storeFiles(Request $request, string $field, string $directory, string $prefix): array
    {
        if (!$request->hasFile($field)) {
            return [];
        }

        $storagePath = public_path($directory);
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $fileNames = [];
        foreach ($request->file($field) as $file) {
            $fileName = $prefix . '-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($storagePath, $fileName);
            $fileNames[] = $fileName;
        }

        return $fileNames;
    }
}
