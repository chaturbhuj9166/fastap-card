<?php

namespace App\Http\Controllers;

use App\Models\CaseHearing;
use App\Models\LegalCase;
use App\Models\LegalConsultation;
use App\Models\LegalService;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LawyerController extends Controller
{
    // =====================
    // User Dashboard (Customer)
    // =====================

    public function services()
    {
        $user = Auth::guard('customer')->user();
        $services = LegalService::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.lawyer.services.index', compact('services'));
    }

    public function storeService(Request $request)
    {
        $user = Auth::guard('customer')->user();

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
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
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
        $user = Auth::guard('customer')->user();
        $service = LegalService::where('customer_id', $user->id)->findOrFail($id);

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

    public function deleteService($id)
    {
        $user = Auth::guard('customer')->user();
        $service = LegalService::where('customer_id', $user->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service removed.');
    }

    public function cases()
    {
        $user = Auth::guard('customer')->user();
        $cases = LegalCase::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.lawyer.cases.index', compact('cases'));
    }

    public function storeCase(Request $request)
    {
        $user = Auth::guard('customer')->user();

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
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
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
        $user = Auth::guard('customer')->user();
        $case = LegalCase::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'case_status' => 'required|string|max:30',
        ]);

        $case->update([
            'case_status' => $request->case_status,
        ]);

        return back()->with('success', 'Case status updated.');
    }

    public function deleteCase($id)
    {
        $user = Auth::guard('customer')->user();
        $case = LegalCase::where('customer_id', $user->id)->findOrFail($id);
        $case->delete();

        return back()->with('success', 'Case removed.');
    }

    public function hearings()
    {
        $user = Auth::guard('customer')->user();
        $hearings = CaseHearing::whereHas('legalCase', function ($query) use ($user) {
            $query->where('customer_id', $user->id);
        })->orderByDesc('hearing_date')->get();
        $cases = LegalCase::where('customer_id', $user->id)->orderByDesc('created_at')->get();

        return view('userdashboard-new.lawyer.hearings.index', compact('hearings', 'cases'));
    }

    public function storeHearing(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'case_id' => 'required|exists:legal_cases,id',
            'hearing_date' => 'nullable|date',
            'hearing_time' => 'nullable|date_format:H:i',
            'court_room' => 'nullable|string|max:100',
            'hearing_status' => 'nullable|string|max:20',
            'next_hearing_date' => 'nullable|date',
            'outcome_notes' => 'nullable|string',
        ]);

        $case = LegalCase::where('customer_id', $user->id)->findOrFail($request->case_id);

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
        $user = Auth::guard('customer')->user();
        $hearing = CaseHearing::whereHas('legalCase', function ($query) use ($user) {
            $query->where('customer_id', $user->id);
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

    public function deleteHearing($id)
    {
        $user = Auth::guard('customer')->user();
        $hearing = CaseHearing::whereHas('legalCase', function ($query) use ($user) {
            $query->where('customer_id', $user->id);
        })->findOrFail($id);
        $hearing->delete();

        return back()->with('success', 'Hearing removed.');
    }

    public function consultations()
    {
        $user = Auth::guard('customer')->user();
        $consultations = LegalConsultation::where('customer_id', $user->id)->orderByDesc('created_at')->get();
        $services = LegalService::where('customer_id', $user->id)->orderBy('practice_area')->get();

        return view('userdashboard-new.lawyer.consultations.index', compact('consultations', 'services'));
    }

    public function storeConsultation(Request $request)
    {
        $user = Auth::guard('customer')->user();

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
            'customer_id' => $user->id,
            'company_id' => $user->company_id,
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
        $user = Auth::guard('customer')->user();
        $consultation = LegalConsultation::where('customer_id', $user->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:30',
        ]);

        $consultation->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Consultation status updated.');
    }

    public function deleteConsultation($id)
    {
        $user = Auth::guard('customer')->user();
        $consultation = LegalConsultation::where('customer_id', $user->id)->findOrFail($id);
        $consultation->delete();

        return back()->with('success', 'Consultation removed.');
    }

    // =====================
    // Frontend Consultation
    // =====================

    public function consultationForm(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $services = LegalService::where('customer_id', $customer->id)
            ->where('is_active', 1)
            ->orderBy('practice_area')
            ->get();

        return view('frontend.lawyer.consultation', compact('customer', 'services'));
    }

    public function storePublicConsultation(Request $request, $slug)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_mobile' => 'required|string|max:30',
            'client_email' => 'nullable|email|max:150',
            'consultation_type' => 'nullable|string|max:30',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|date_format:H:i',
            'practice_area' => 'nullable|string|max:150',
            'notes' => 'nullable|string',
        ]);

        $consultation = LegalConsultation::create([
            'customer_id' => $customer->id,
            'company_id' => $customer->company_id,
            'client_name' => $request->client_name,
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->client_email,
            'consultation_type' => $request->consultation_type,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'practice_area' => $request->practice_area,
            'status' => 'scheduled',
            'notes' => $request->notes,
        ]);

        return redirect()->route('lawyer.consultation.thanks', ['slug' => $slug, 'consultationId' => $consultation->id]);
    }

    public function consultationThanks(Request $request, $slug, $consultationId)
    {
        $customer = customer::where('slug', $slug)->firstOrFail();
        $consultation = LegalConsultation::where('customer_id', $customer->id)->findOrFail($consultationId);

        return view('frontend.lawyer.thanks', compact('customer', 'consultation'));
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
