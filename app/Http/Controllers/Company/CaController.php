<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CaClientCase;
use App\Models\CaConsultation;
use App\Models\CaService;
use App\Models\Company;
use App\Models\ComplianceDeadline;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaController extends Controller
{
    public function services(Request $request)
    {
        $company = $this->getCompany($request);
        $services = CaService::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.ca.services.index', compact('company', 'services'));
    }

    public function storeService(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'service_category' => 'nullable|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'pricing_type' => 'nullable|string|max:30',
            'base_price' => 'nullable|numeric|min:0',
            'turnaround_time_days' => 'nullable|integer|min:0',
            'required_documents' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        CaService::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'pricing_type' => $request->pricing_type,
            'base_price' => $request->base_price,
            'turnaround_time_days' => $request->turnaround_time_days,
            'required_documents' => $this->splitLines($request->required_documents),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'CA service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = CaService::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'service_category' => 'nullable|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'pricing_type' => 'nullable|string|max:30',
            'base_price' => 'nullable|numeric|min:0',
            'turnaround_time_days' => 'nullable|integer|min:0',
            'required_documents' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $service->update([
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'pricing_type' => $request->pricing_type,
            'base_price' => $request->base_price,
            'turnaround_time_days' => $request->turnaround_time_days,
            'required_documents' => $this->splitLines($request->required_documents),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'CA service updated.');
    }

    public function deleteService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = CaService::where('company_id', $company->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'CA service removed.');
    }

    public function cases(Request $request)
    {
        $company = $this->getCompany($request);
        $cases = CaClientCase::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $services = CaService::where('company_id', $company->id)->orderBy('service_name')->get();

        return view('company.ca.cases.index', compact('company', 'cases', 'services'));
    }

    public function storeCase(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'pan_number' => 'nullable|string|max:20',
            'gstin' => 'nullable|string|max:25',
            'service_id' => 'nullable|integer',
            'financial_year' => 'nullable|string|max:20',
            'case_status' => 'nullable|string|max:30',
            'documents_uploaded.*' => 'nullable|file|max:4096',
            'filed_returns.*' => 'nullable|file|max:4096',
            'due_date' => 'nullable|date',
            'filing_date' => 'nullable|date',
            'case_notes' => 'nullable|string',
        ]);

        $documents = $this->storeFiles($request, 'documents_uploaded', 'uploads/ca/documents', 'doc');
        $returns = $this->storeFiles($request, 'filed_returns', 'uploads/ca/returns', 'return');

        CaClientCase::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'pan_number' => $request->pan_number,
            'gstin' => $request->gstin,
            'service_id' => $request->service_id,
            'financial_year' => $request->financial_year,
            'case_status' => $request->case_status ?? 'inquiry',
            'documents_uploaded' => $documents,
            'filed_returns' => $returns,
            'due_date' => $request->due_date,
            'filing_date' => $request->filing_date,
            'case_notes' => $request->case_notes,
        ]);

        return back()->with('success', 'Client case added.');
    }

    public function updateCaseStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $case = CaClientCase::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'case_status' => 'required|string|max:30',
            'due_date' => 'nullable|date',
            'filing_date' => 'nullable|date',
            'case_notes' => 'nullable|string',
        ]);

        $case->update([
            'case_status' => $request->case_status,
            'due_date' => $request->due_date,
            'filing_date' => $request->filing_date,
            'case_notes' => $request->case_notes,
        ]);

        return back()->with('success', 'Case updated.');
    }

    public function deleteCase(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $case = CaClientCase::where('company_id', $company->id)->findOrFail($id);
        $case->delete();

        return back()->with('success', 'Case removed.');
    }

    public function consultations(Request $request)
    {
        $company = $this->getCompany($request);
        $consultations = CaConsultation::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.ca.consultations.index', compact('company', 'consultations'));
    }

    public function storeConsultation(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'consultation_type' => 'nullable|string|max:30',
            'service_category' => 'nullable|string|max:50',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|string|max:20',
            'consultation_fee' => 'nullable|numeric|min:0',
            'payment_status' => 'nullable|string|max:30',
            'status' => 'nullable|string|max:30',
            'meeting_link' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        CaConsultation::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'consultation_type' => $request->consultation_type,
            'service_category' => $request->service_category,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'consultation_fee' => $request->consultation_fee,
            'payment_status' => $request->payment_status ?? 'pending',
            'status' => $request->status ?? 'scheduled',
            'meeting_link' => $request->meeting_link,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Consultation added.');
    }

    public function updateConsultationStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $consultation = CaConsultation::where('company_id', $company->id)->findOrFail($id);

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
        $consultation = CaConsultation::where('company_id', $company->id)->findOrFail($id);
        $consultation->delete();

        return back()->with('success', 'Consultation removed.');
    }

    public function deadlines(Request $request)
    {
        $company = $this->getCompany($request);
        $deadlines = ComplianceDeadline::where('company_id', $company->id)->orderBy('due_date')->get();

        return view('company.ca.deadlines.index', compact('company', 'deadlines'));
    }

    public function storeDeadline(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_mobile' => 'nullable|string|max:30',
            'compliance_type' => 'nullable|string|max:30',
            'financial_year' => 'nullable|string|max:20',
            'due_date' => 'nullable|date',
            'reminder_sent' => 'nullable|boolean',
            'status' => 'nullable|string|max:30',
        ]);

        ComplianceDeadline::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_mobile' => $request->client_mobile,
            'compliance_type' => $request->compliance_type,
            'financial_year' => $request->financial_year,
            'due_date' => $request->due_date,
            'reminder_sent' => $request->has('reminder_sent'),
            'status' => $request->status ?? 'pending',
        ]);

        return back()->with('success', 'Compliance deadline added.');
    }

    public function updateDeadline(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $deadline = ComplianceDeadline::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'compliance_type' => 'nullable|string|max:30',
            'financial_year' => 'nullable|string|max:20',
            'due_date' => 'nullable|date',
            'reminder_sent' => 'nullable|boolean',
            'status' => 'nullable|string|max:30',
        ]);

        $deadline->update([
            'compliance_type' => $request->compliance_type,
            'financial_year' => $request->financial_year,
            'due_date' => $request->due_date,
            'reminder_sent' => $request->has('reminder_sent'),
            'status' => $request->status,
        ]);

        return back()->with('success', 'Compliance deadline updated.');
    }

    public function deleteDeadline(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $deadline = ComplianceDeadline::where('company_id', $company->id)->findOrFail($id);
        $deadline->delete();

        return back()->with('success', 'Compliance deadline removed.');
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
