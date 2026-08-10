<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\AstroClientData;
use App\Models\AstroConsultation;
use App\Models\AstroService;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AstrologerController extends Controller
{
    public function services(Request $request)
    {
        $company = $this->getCompany($request);
        $services = AstroService::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.astrologer.services.index', compact('company', 'services'));
    }

    public function storeService(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'service_category' => 'nullable|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'consultation_duration_minutes' => 'nullable|integer|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'is_online_available' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        AstroService::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'consultation_duration_minutes' => $request->consultation_duration_minutes,
            'consultation_fee' => $request->consultation_fee,
            'is_online_available' => $request->has('is_online_available'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Astro service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = AstroService::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'service_category' => 'nullable|string|max:50',
            'service_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'consultation_duration_minutes' => 'nullable|integer|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'is_online_available' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $service->update([
            'service_category' => $request->service_category,
            'service_name' => $request->service_name,
            'description' => $request->description,
            'consultation_duration_minutes' => $request->consultation_duration_minutes,
            'consultation_fee' => $request->consultation_fee,
            'is_online_available' => $request->has('is_online_available'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Astro service updated.');
    }

    public function deleteService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = AstroService::where('company_id', $company->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Astro service removed.');
    }

    public function consultations(Request $request)
    {
        $company = $this->getCompany($request);
        $consultations = AstroConsultation::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $services = AstroService::where('company_id', $company->id)->orderBy('service_name')->get();

        return view('company.astrologer.consultations.index', compact('company', 'consultations', 'services'));
    }

    public function storeConsultation(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'consultation_mode' => 'nullable|string|max:30',
            'service_id' => 'nullable|integer',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'birth_time' => 'nullable|string|max:20',
            'birth_place' => 'nullable|string|max:150',
            'property_address' => 'nullable|string|max:255',
            'property_direction' => 'nullable|string|max:50',
            'consultation_fee' => 'nullable|numeric|min:0',
            'payment_status' => 'nullable|string|max:30',
            'status' => 'nullable|string|max:30',
            'meeting_link' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $birthDetails = array_filter([
            'date' => $request->birth_date,
            'time' => $request->birth_time,
            'place' => $request->birth_place,
        ], static fn ($value) => !is_null($value) && $value !== '');

        $propertyDetails = array_filter([
            'address' => $request->property_address,
            'direction' => $request->property_direction,
        ], static fn ($value) => !is_null($value) && $value !== '');

        AstroConsultation::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'consultation_mode' => $request->consultation_mode,
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'birth_details' => $birthDetails,
            'property_details' => $propertyDetails,
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
        $consultation = AstroConsultation::where('company_id', $company->id)->findOrFail($id);

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
        $consultation = AstroConsultation::where('company_id', $company->id)->findOrFail($id);
        $consultation->delete();

        return back()->with('success', 'Consultation removed.');
    }

    public function reports(Request $request)
    {
        $company = $this->getCompany($request);
        $reports = AstroClientData::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.astrologer.reports.index', compact('company', 'reports'));
    }

    public function storeReport(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'birth_date' => 'nullable|date',
            'birth_time' => 'nullable|string|max:20',
            'birth_place' => 'nullable|string|max:150',
            'kundli_data' => 'nullable|string',
            'reports.*' => 'nullable|file|max:4096',
        ]);

        $reportFiles = $this->storeFiles($request, 'reports', 'uploads/astro/reports', 'report');

        AstroClientData::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'birth_date' => $request->birth_date,
            'birth_time' => $request->birth_time,
            'birth_place' => $request->birth_place,
            'kundli_data' => $this->splitLines($request->kundli_data),
            'reports' => $reportFiles,
        ]);

        return back()->with('success', 'Client report added.');
    }

    public function deleteReport(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $report = AstroClientData::where('company_id', $company->id)->findOrFail($id);
        $report->delete();

        return back()->with('success', 'Report removed.');
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
