<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\TechCaseStudy;
use App\Models\TechProject;
use App\Models\TechService;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TechController extends Controller
{
    public function services(Request $request)
    {
        $company = $this->getCompany($request);
        $services = TechService::where('company_id', $company->id)->orderBy('service_name')->get();

        return view('company.tech.services.index', compact('company', 'services'));
    }

    public function storeService(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'service_category' => 'required|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'pricing_model' => 'nullable|string|max:30',
            'base_price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'delivery_time' => 'nullable|string|max:100',
            'technology_stack' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        TechService::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'pricing_model' => $request->pricing_model,
            'base_price' => $request->base_price,
            'features' => $this->splitLines($request->features),
            'delivery_time' => $request->delivery_time,
            'technology_stack' => $this->splitLines($request->technology_stack),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = TechService::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'service_category' => 'required|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'pricing_model' => 'nullable|string|max:30',
            'base_price' => 'nullable|numeric|min:0',
            'features' => 'nullable|string',
            'delivery_time' => 'nullable|string|max:100',
            'technology_stack' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $service->update([
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'pricing_model' => $request->pricing_model,
            'base_price' => $request->base_price,
            'features' => $this->splitLines($request->features),
            'delivery_time' => $request->delivery_time,
            'technology_stack' => $this->splitLines($request->technology_stack),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service updated.');
    }

    public function deleteService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = TechService::where('company_id', $company->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service removed.');
    }

    public function projects(Request $request)
    {
        $company = $this->getCompany($request);
        $projects = TechProject::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $services = TechService::where('company_id', $company->id)->orderBy('service_name')->get();

        return view('company.tech.projects.index', compact('company', 'projects', 'services'));
    }

    public function storeProject(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_email' => 'nullable|email|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'service_category' => 'nullable|string|max:50',
            'services_required' => 'nullable|array',
            'project_description' => 'nullable|string',
            'budget_range' => 'nullable|string|max:100',
            'timeline' => 'nullable|string|max:100',
            'technology_preferences' => 'nullable|string',
            'project_status' => 'nullable|string|max:30',
            'quoted_amount' => 'nullable|numeric|min:0',
            'contract_signed' => 'nullable|boolean',
            'milestones' => 'nullable|string',
        ]);

        TechProject::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'client_mobile' => $request->client_mobile,
            'service_category' => $request->service_category,
            'services_required' => $request->services_required,
            'project_description' => $request->project_description,
            'budget_range' => $request->budget_range,
            'timeline' => $request->timeline,
            'technology_preferences' => $this->splitLines($request->technology_preferences),
            'project_status' => $request->project_status ?? 'inquiry',
            'quoted_amount' => $request->quoted_amount,
            'contract_signed' => $request->has('contract_signed'),
            'milestones' => $this->splitLines($request->milestones),
        ]);

        return back()->with('success', 'Project added successfully!');
    }

    public function updateProjectStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = TechProject::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'project_status' => 'required|string|max:30',
        ]);

        $project->update([
            'project_status' => $request->project_status,
        ]);

        return back()->with('success', 'Project status updated.');
    }

    public function deleteProject(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = TechProject::where('company_id', $company->id)->findOrFail($id);
        $project->delete();

        return back()->with('success', 'Project removed.');
    }

    public function caseStudies(Request $request)
    {
        $company = $this->getCompany($request);
        $caseStudies = TechCaseStudy::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.tech.case-studies.index', compact('company', 'caseStudies'));
    }

    public function storeCaseStudy(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'title' => 'required|string|max:150',
            'client_name' => 'nullable|string|max:150',
            'industry' => 'nullable|string|max:100',
            'summary' => 'nullable|string',
            'results' => 'nullable|string',
            'technology_stack' => 'nullable|string',
            'metrics' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048',
            'project_url' => 'nullable|url|max:255',
            'is_featured' => 'nullable|boolean',
        ]);

        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'case-' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/tech/case-studies'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        TechCaseStudy::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'title' => $request->title,
            'client_name' => $request->client_name,
            'industry' => $request->industry,
            'summary' => $request->summary,
            'results' => $request->results,
            'technology_stack' => $this->splitLines($request->technology_stack),
            'metrics' => $this->splitLines($request->metrics),
            'images' => $imageNames,
            'project_url' => $request->project_url,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Case study added.');
    }

    public function deleteCaseStudy(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $caseStudy = TechCaseStudy::where('company_id', $company->id)->findOrFail($id);
        $caseStudy->delete();

        return back()->with('success', 'Case study removed.');
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
