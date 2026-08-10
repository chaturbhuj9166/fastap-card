<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SolarAmc;
use App\Models\SolarMonitoring;
use App\Models\SolarProject;
use App\Models\SolarSiteSurvey;
use App\Models\SolarSolution;
use App\Models\SubsidyApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SolarController extends Controller
{
    public function solutions(Request $request)
    {
        $company = $this->getCompany($request);
        $solutions = SolarSolution::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.solar.solutions.index', compact('company', 'solutions'));
    }

    public function storeSolution(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'solution_type' => 'nullable|string|max:50',
            'system_capacity_kw' => 'nullable|numeric|min:0',
            'solution_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'components' => 'nullable|string',
            'price_per_kw' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'warranty_years' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        SolarSolution::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'solution_type' => $request->solution_type,
            'system_capacity_kw' => $request->system_capacity_kw,
            'solution_name' => $request->solution_name,
            'description' => $request->description,
            'components' => $this->splitLines($request->components),
            'price_per_kw' => $request->price_per_kw,
            'total_price' => $request->total_price,
            'features' => $this->splitLines($request->features),
            'warranty_years' => $request->warranty_years,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Solar solution added successfully!');
    }

    public function updateSolution(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $solution = SolarSolution::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'solution_type' => 'nullable|string|max:50',
            'system_capacity_kw' => 'nullable|numeric|min:0',
            'solution_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'components' => 'nullable|string',
            'price_per_kw' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'warranty_years' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $solution->update([
            'solution_type' => $request->solution_type,
            'system_capacity_kw' => $request->system_capacity_kw,
            'solution_name' => $request->solution_name,
            'description' => $request->description,
            'components' => $this->splitLines($request->components),
            'price_per_kw' => $request->price_per_kw,
            'total_price' => $request->total_price,
            'features' => $this->splitLines($request->features),
            'warranty_years' => $request->warranty_years,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Solar solution updated.');
    }

    public function deleteSolution(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $solution = SolarSolution::where('company_id', $company->id)->findOrFail($id);
        $solution->delete();

        return back()->with('success', 'Solar solution removed.');
    }

    public function surveys(Request $request)
    {
        $company = $this->getCompany($request);
        $surveys = SolarSiteSurvey::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.solar.surveys.index', compact('company', 'surveys'));
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
            'roof_area_sqft' => 'nullable|integer|min:0',
            'monthly_power_consumption_units' => 'nullable|integer|min:0',
            'current_electricity_bill' => 'nullable|numeric|min:0',
            'google_map_location' => 'nullable|string|max:255',
            'roof_images.*' => 'nullable|image|max:4096',
            'shadow_analysis_file' => 'nullable|file|max:4096',
            'survey_date' => 'nullable|date',
            'survey_status' => 'nullable|string|max:30',
            'recommended_capacity_kw' => 'nullable|numeric|min:0',
            'estimated_generation_monthly' => 'nullable|numeric|min:0',
            'estimated_savings_yearly' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $roofImages = $this->storeFiles($request, 'roof_images', 'uploads/solar/surveys', 'roof');
        $shadowFile = $this->storeSingleFile($request, 'shadow_analysis_file', 'uploads/solar/surveys', 'shadow');

        SolarSiteSurvey::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'property_type' => $request->property_type,
            'property_address' => $request->property_address,
            'roof_area_sqft' => $request->roof_area_sqft,
            'monthly_power_consumption_units' => $request->monthly_power_consumption_units,
            'current_electricity_bill' => $request->current_electricity_bill,
            'google_map_location' => $request->google_map_location,
            'roof_images' => $roofImages,
            'shadow_analysis_file' => $shadowFile,
            'survey_date' => $request->survey_date,
            'survey_status' => $request->survey_status ?? 'requested',
            'recommended_capacity_kw' => $request->recommended_capacity_kw,
            'estimated_generation_monthly' => $request->estimated_generation_monthly,
            'estimated_savings_yearly' => $request->estimated_savings_yearly,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Site survey added.');
    }

    public function updateSurveyStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $survey = SolarSiteSurvey::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'survey_status' => 'required|string|max:30',
            'recommended_capacity_kw' => 'nullable|numeric|min:0',
            'estimated_generation_monthly' => 'nullable|numeric|min:0',
            'estimated_savings_yearly' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $survey->update([
            'survey_status' => $request->survey_status,
            'recommended_capacity_kw' => $request->recommended_capacity_kw,
            'estimated_generation_monthly' => $request->estimated_generation_monthly,
            'estimated_savings_yearly' => $request->estimated_savings_yearly,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Survey updated.');
    }

    public function deleteSurvey(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $survey = SolarSiteSurvey::where('company_id', $company->id)->findOrFail($id);
        $survey->delete();

        return back()->with('success', 'Survey removed.');
    }

    public function projects(Request $request)
    {
        $company = $this->getCompany($request);
        $projects = SolarProject::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.solar.projects.index', compact('company', 'projects'));
    }

    public function storeProject(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'nullable|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'system_type' => 'nullable|string|max:50',
            'capacity_kw' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:150',
            'quotation_amount' => 'nullable|numeric|min:0',
            'subsidy_amount' => 'nullable|numeric|min:0',
            'net_amount' => 'nullable|numeric|min:0',
            'advance_paid' => 'nullable|numeric|min:0',
            'project_status' => 'nullable|string|max:30',
            'installation_start_date' => 'nullable|date',
            'commissioning_date' => 'nullable|date',
            'warranty_end_date' => 'nullable|date',
            'documents.*' => 'nullable|file|max:4096',
            'notes' => 'nullable|string',
        ]);

        $documents = $this->storeFiles($request, 'documents', 'uploads/solar/projects', 'doc');

        SolarProject::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'system_type' => $request->system_type,
            'capacity_kw' => $request->capacity_kw,
            'location' => $request->location,
            'quotation_amount' => $request->quotation_amount,
            'subsidy_amount' => $request->subsidy_amount,
            'net_amount' => $request->net_amount,
            'advance_paid' => $request->advance_paid,
            'project_status' => $request->project_status ?? 'quoted',
            'installation_start_date' => $request->installation_start_date,
            'commissioning_date' => $request->commissioning_date,
            'warranty_end_date' => $request->warranty_end_date,
            'documents' => $documents,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Project added.');
    }

    public function updateProjectStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = SolarProject::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'project_status' => 'required|string|max:30',
            'commissioning_date' => 'nullable|date',
            'warranty_end_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $project->update([
            'project_status' => $request->project_status,
            'commissioning_date' => $request->commissioning_date,
            'warranty_end_date' => $request->warranty_end_date,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Project updated.');
    }

    public function deleteProject(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = SolarProject::where('company_id', $company->id)->findOrFail($id);
        $project->delete();

        return back()->with('success', 'Project removed.');
    }

    public function subsidies(Request $request)
    {
        $company = $this->getCompany($request);
        $subsidies = SubsidyApplication::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $projects = SolarProject::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.solar.subsidies.index', compact('company', 'subsidies', 'projects'));
    }

    public function storeSubsidy(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'project_id' => 'nullable|integer',
            'client_name' => 'nullable|string|max:150',
            'scheme_name' => 'nullable|string|max:100',
            'system_capacity_kw' => 'nullable|numeric|min:0',
            'subsidy_amount' => 'nullable|numeric|min:0',
            'application_date' => 'nullable|date',
            'application_number' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:30',
            'documents.*' => 'nullable|file|max:4096',
        ]);

        $documents = $this->storeFiles($request, 'documents', 'uploads/solar/projects', 'subsidy');

        SubsidyApplication::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'project_id' => $request->project_id,
            'client_name' => $request->client_name,
            'scheme_name' => $request->scheme_name,
            'system_capacity_kw' => $request->system_capacity_kw,
            'subsidy_amount' => $request->subsidy_amount,
            'application_date' => $request->application_date,
            'application_number' => $request->application_number,
            'status' => $request->status ?? 'applied',
            'documents' => $documents,
        ]);

        return back()->with('success', 'Subsidy application added.');
    }

    public function updateSubsidyStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $subsidy = SubsidyApplication::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:30',
            'application_number' => 'nullable|string|max:100',
        ]);

        $subsidy->update([
            'status' => $request->status,
            'application_number' => $request->application_number,
        ]);

        return back()->with('success', 'Subsidy updated.');
    }

    public function deleteSubsidy(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $subsidy = SubsidyApplication::where('company_id', $company->id)->findOrFail($id);
        $subsidy->delete();

        return back()->with('success', 'Subsidy removed.');
    }

    public function monitoring(Request $request)
    {
        $company = $this->getCompany($request);
        $monitoring = SolarMonitoring::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $projects = SolarProject::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.solar.monitoring.index', compact('company', 'monitoring', 'projects'));
    }

    public function storeMonitoring(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'project_id' => 'nullable|integer',
            'client_mobile' => 'nullable|string|max:30',
            'monitoring_platform' => 'nullable|string|max:255',
            'daily_generation_kwh' => 'nullable|numeric|min:0',
            'monthly_generation_kwh' => 'nullable|numeric|min:0',
            'performance_ratio' => 'nullable|numeric|min:0',
            'system_uptime_percentage' => 'nullable|numeric|min:0|max:100',
            'alerts' => 'nullable|string',
            'last_updated' => 'nullable|date',
        ]);

        SolarMonitoring::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'project_id' => $request->project_id,
            'client_mobile' => $request->client_mobile,
            'monitoring_platform' => $request->monitoring_platform,
            'daily_generation_kwh' => $request->daily_generation_kwh,
            'monthly_generation_kwh' => $request->monthly_generation_kwh,
            'performance_ratio' => $request->performance_ratio,
            'system_uptime_percentage' => $request->system_uptime_percentage,
            'alerts' => $this->splitLines($request->alerts),
            'last_updated' => $request->last_updated,
        ]);

        return back()->with('success', 'Monitoring entry added.');
    }

    public function deleteMonitoring(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $entry = SolarMonitoring::where('company_id', $company->id)->findOrFail($id);
        $entry->delete();

        return back()->with('success', 'Monitoring entry removed.');
    }

    public function amc(Request $request)
    {
        $company = $this->getCompany($request);
        $amcPlans = SolarAmc::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $projects = SolarProject::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.solar.amc.index', compact('company', 'amcPlans', 'projects'));
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

        SolarAmc::create([
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
        $amc = SolarAmc::where('company_id', $company->id)->findOrFail($id);
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
