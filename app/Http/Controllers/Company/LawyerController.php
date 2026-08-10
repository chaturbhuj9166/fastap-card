<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CaseHearing;
use App\Models\Company;
use App\Models\LegalCase;
use App\Models\LegalConsultation;
use App\Models\LegalService;
use Illuminate\Http\Request;

class LawyerController extends Controller
{
    public function services(Request $request)
    {
        $company = $this->getCompany($request);
        $services = LegalService::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.lawyer.services.index', compact('company', 'services'));
    }

    public function storeService(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'practice_area' => 'required|string|max:150',
            'description' => 'nullable|string',
            'consultation_fee' => 'nullable|numeric|min:0',
            'court_fee_range' => 'nullable|string|max:100',
            'success_rate_percentage' => 'nullable|integer|min:0|max:100',
            'experience_years_in_area' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        LegalService::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'practice_area' => $request->practice_area,
            'description' => $request->description,
            'consultation_fee' => $request->consultation_fee,
            'court_fee_range' => $request->court_fee_range,
            'success_rate_percentage' => $request->success_rate_percentage,
            'experience_years_in_area' => $request->experience_years_in_area,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = LegalService::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'practice_area' => 'required|string|max:150',
            'description' => 'nullable|string',
            'consultation_fee' => 'nullable|numeric|min:0',
            'court_fee_range' => 'nullable|string|max:100',
            'success_rate_percentage' => 'nullable|integer|min:0|max:100',
            'experience_years_in_area' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $service->update([
            'practice_area' => $request->practice_area,
            'description' => $request->description,
            'consultation_fee' => $request->consultation_fee,
            'court_fee_range' => $request->court_fee_range,
            'success_rate_percentage' => $request->success_rate_percentage,
            'experience_years_in_area' => $request->experience_years_in_area,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service updated.');
    }

    public function deleteService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = LegalService::where('company_id', $company->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service removed.');
    }

    public function cases(Request $request)
    {
        $company = $this->getCompany($request);
        $cases = LegalCase::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.lawyer.cases.index', compact('company', 'cases'));
    }

    public function storeCase(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'case_number' => 'nullable|string|max:100',
            'case_type' => 'nullable|string|max:150',
            'court_name' => 'nullable|string|max:150',
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'case_status' => 'nullable|string|max:30',
            'filing_date' => 'nullable|date',
            'next_hearing_date' => 'nullable|date',
            'case_details' => 'nullable|string',
            'documents' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        LegalCase::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'case_number' => $request->case_number,
            'case_type' => $request->case_type,
            'court_name' => $request->court_name,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'case_status' => $request->case_status ?? 'inquiry',
            'filing_date' => $request->filing_date,
            'next_hearing_date' => $request->next_hearing_date,
            'case_details' => $this->splitLines($request->case_details),
            'documents' => $this->splitLines($request->documents),
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Case added.');
    }

    public function updateCaseStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $case = LegalCase::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'case_status' => 'required|string|max:30',
        ]);

        $case->update([
            'case_status' => $request->case_status,
        ]);

        return back()->with('success', 'Case status updated.');
    }

    public function deleteCase(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $case = LegalCase::where('company_id', $company->id)->findOrFail($id);
        $case->delete();

        return back()->with('success', 'Case removed.');
    }

    public function hearings(Request $request)
    {
        $company = $this->getCompany($request);
        $hearings = CaseHearing::whereHas('legalCase', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->orderByDesc('hearing_date')->get();
        $cases = LegalCase::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.lawyer.hearings.index', compact('company', 'hearings', 'cases'));
    }

    public function storeHearing(Request $request)
    {
        $company = $this->getCompany($request);

        $request->validate([
            'case_id' => 'required|exists:legal_cases,id',
            'hearing_date' => 'nullable|date',
            'hearing_time' => 'nullable|date_format:H:i',
            'court_room' => 'nullable|string|max:100',
            'hearing_status' => 'nullable|string|max:20',
            'next_hearing_date' => 'nullable|date',
            'outcome_notes' => 'nullable|string',
        ]);

        $case = LegalCase::where('company_id', $company->id)->findOrFail($request->case_id);

        CaseHearing::create([
            'case_id' => $case->id,
            'hearing_date' => $request->hearing_date,
            'hearing_time' => $request->hearing_time,
            'court_room' => $request->court_room,
            'hearing_status' => $request->hearing_status ?? 'scheduled',
            'next_hearing_date' => $request->next_hearing_date,
            'outcome_notes' => $request->outcome_notes,
        ]);

        return back()->with('success', 'Hearing added.');
    }

    public function updateHearing(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $hearing = CaseHearing::whereHas('legalCase', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->findOrFail($id);

        $request->validate([
            'hearing_date' => 'nullable|date',
            'hearing_time' => 'nullable|date_format:H:i',
            'court_room' => 'nullable|string|max:100',
            'hearing_status' => 'nullable|string|max:20',
            'next_hearing_date' => 'nullable|date',
            'outcome_notes' => 'nullable|string',
        ]);

        $hearing->update([
            'hearing_date' => $request->hearing_date,
            'hearing_time' => $request->hearing_time,
            'court_room' => $request->court_room,
            'hearing_status' => $request->hearing_status ?? $hearing->hearing_status,
            'next_hearing_date' => $request->next_hearing_date,
            'outcome_notes' => $request->outcome_notes,
        ]);

        return back()->with('success', 'Hearing updated.');
    }

    public function deleteHearing(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $hearing = CaseHearing::whereHas('legalCase', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->findOrFail($id);
        $hearing->delete();

        return back()->with('success', 'Hearing removed.');
    }

    public function consultations(Request $request)
    {
        $company = $this->getCompany($request);
        $consultations = LegalConsultation::where('company_id', $company->id)->orderByDesc('created_at')->get();
        $services = LegalService::where('company_id', $company->id)->orderBy('practice_area')->get();

        return view('company.lawyer.consultations.index', compact('company', 'consultations', 'services'));
    }

    public function storeConsultation(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'nullable|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'consultation_type' => 'nullable|string|max:30',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|date_format:H:i',
            'practice_area' => 'nullable|string|max:150',
            'consultation_fee' => 'nullable|numeric|min:0',
            'payment_status' => 'nullable|string|max:30',
            'status' => 'nullable|string|max:30',
            'meeting_link' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        LegalConsultation::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'consultation_type' => $request->consultation_type,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'practice_area' => $request->practice_area,
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
        $consultation = LegalConsultation::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:30',
        ]);

        $consultation->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Consultation status updated.');
    }

    public function deleteConsultation(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $consultation = LegalConsultation::where('company_id', $company->id)->findOrFail($id);
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
}
