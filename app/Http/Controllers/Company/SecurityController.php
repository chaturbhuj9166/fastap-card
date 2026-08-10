<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SecurityAmc;
use App\Models\SecurityProduct;
use App\Models\SecurityProject;
use App\Models\SecuritySiteSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SecurityController extends Controller
{
    public function products(Request $request)
    {
        $company = $this->getCompany($request);
        $products = SecurityProduct::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.security.products.index', compact('company', 'products'));
    }

    public function storeProduct(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'product_category' => 'nullable|string|max:50',
            'product_name' => 'required|string|max:150',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:4096',
            'datasheet_url' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $images = $this->storeFiles($request, 'images', 'uploads/security/datasheets', 'product');

        SecurityProduct::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'product_category' => $request->product_category,
            'product_name' => $request->product_name,
            'brand' => $request->brand,
            'model' => $request->model,
            'description' => $request->description,
            'specifications' => $this->splitLines($request->specifications),
            'price' => $request->price,
            'images' => $images,
            'datasheet_url' => $request->datasheet_url,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Security product added.');
    }

    public function updateProduct(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $product = SecurityProduct::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'product_category' => 'nullable|string|max:50',
            'product_name' => 'required|string|max:150',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'datasheet_url' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $product->update([
            'product_category' => $request->product_category,
            'product_name' => $request->product_name,
            'brand' => $request->brand,
            'model' => $request->model,
            'description' => $request->description,
            'specifications' => $this->splitLines($request->specifications),
            'price' => $request->price,
            'datasheet_url' => $request->datasheet_url,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Security product updated.');
    }

    public function deleteProduct(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $product = SecurityProduct::where('company_id', $company->id)->findOrFail($id);
        $product->delete();

        return back()->with('success', 'Security product removed.');
    }

    public function surveys(Request $request)
    {
        $company = $this->getCompany($request);
        $surveys = SecuritySiteSurvey::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.security.surveys.index', compact('company', 'surveys'));
    }

    public function storeSurvey(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'property_type' => 'nullable|string|max:50',
            'property_address' => 'nullable|string|max:255',
            'area_sqft' => 'nullable|integer|min:0',
            'number_of_cameras_required' => 'nullable|integer|min:0',
            'storage_days_required' => 'nullable|integer|min:0',
            'survey_date' => 'nullable|date',
            'survey_status' => 'nullable|string|max:30',
            'site_images.*' => 'nullable|image|max:4096',
            'layout_file' => 'nullable|file|max:4096',
            'recommended_solution' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $siteImages = $this->storeFiles($request, 'site_images', 'uploads/security/surveys', 'site');
        $layoutFile = $this->storeSingleFile($request, 'layout_file', 'uploads/security/surveys', 'layout');

        SecuritySiteSurvey::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'property_type' => $request->property_type,
            'property_address' => $request->property_address,
            'area_sqft' => $request->area_sqft,
            'number_of_cameras_required' => $request->number_of_cameras_required,
            'storage_days_required' => $request->storage_days_required,
            'survey_date' => $request->survey_date,
            'survey_status' => $request->survey_status ?? 'requested',
            'site_images' => $siteImages,
            'layout_file' => $layoutFile,
            'recommended_solution' => $this->splitLines($request->recommended_solution),
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Site survey added.');
    }

    public function updateSurveyStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $survey = SecuritySiteSurvey::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'survey_status' => 'required|string|max:30',
            'recommended_solution' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $survey->update([
            'survey_status' => $request->survey_status,
            'recommended_solution' => $this->splitLines($request->recommended_solution),
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Survey updated.');
    }

    public function deleteSurvey(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $survey = SecuritySiteSurvey::where('company_id', $company->id)->findOrFail($id);
        $survey->delete();

        return back()->with('success', 'Survey removed.');
    }

    public function projects(Request $request)
    {
        $company = $this->getCompany($request);
        $projects = SecurityProject::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.security.projects.index', compact('company', 'projects'));
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
            'location' => 'nullable|string|max:150',
            'products' => 'nullable|string',
            'installation_charges' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
            'advance_paid' => 'nullable|numeric|min:0',
            'project_status' => 'nullable|string|max:30',
            'installation_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'technician_assigned' => 'nullable|string|max:100',
            'documents.*' => 'nullable|file|max:4096',
            'notes' => 'nullable|string',
        ]);

        $documents = $this->storeFiles($request, 'documents', 'uploads/security/projects', 'doc');

        SecurityProject::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'project_type' => $request->project_type,
            'property_type' => $request->property_type,
            'location' => $request->location,
            'products' => $this->splitLines($request->products),
            'installation_charges' => $request->installation_charges,
            'total_amount' => $request->total_amount,
            'advance_paid' => $request->advance_paid,
            'project_status' => $request->project_status ?? 'quoted',
            'installation_date' => $request->installation_date,
            'completion_date' => $request->completion_date,
            'technician_assigned' => $request->technician_assigned,
            'documents' => $documents,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Project added.');
    }

    public function updateProjectStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = SecurityProject::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'project_status' => 'required|string|max:30',
            'installation_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $project->update([
            'project_status' => $request->project_status,
            'installation_date' => $request->installation_date,
            'completion_date' => $request->completion_date,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Project updated.');
    }

    public function deleteProject(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = SecurityProject::where('company_id', $company->id)->findOrFail($id);
        $project->delete();

        return back()->with('success', 'Project removed.');
    }

    public function amc(Request $request)
    {
        $company = $this->getCompany($request);
        $amcPlans = SecurityAmc::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $projects = SecurityProject::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.security.amc.index', compact('company', 'amcPlans', 'projects'));
    }

    public function storeAmc(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'project_id' => 'nullable|integer',
            'amc_type' => 'nullable|string|max:30',
            'amc_start_date' => 'nullable|date',
            'amc_end_date' => 'nullable|date',
            'visit_frequency' => 'nullable|string|max:30',
            'amc_amount' => 'nullable|numeric|min:0',
            'services_included' => 'nullable|string',
            'next_visit_date' => 'nullable|date',
            'visit_history' => 'nullable|string',
        ]);

        SecurityAmc::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'project_id' => $request->project_id,
            'amc_type' => $request->amc_type,
            'amc_start_date' => $request->amc_start_date,
            'amc_end_date' => $request->amc_end_date,
            'visit_frequency' => $request->visit_frequency,
            'amc_amount' => $request->amc_amount,
            'services_included' => $this->splitLines($request->services_included),
            'next_visit_date' => $request->next_visit_date,
            'visit_history' => $this->splitLines($request->visit_history),
        ]);

        return back()->with('success', 'AMC plan added.');
    }

    public function deleteAmc(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $amc = SecurityAmc::where('company_id', $company->id)->findOrFail($id);
        $amc->delete();

        return back()->with('success', 'AMC plan removed.');
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

    private function storeSingleFile(Request $request, string $field, string $directory, string $prefix): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $storagePath = public_path($directory);
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $file = $request->file($field);
        $fileName = $prefix . '-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($storagePath, $fileName);

        return $fileName;
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
