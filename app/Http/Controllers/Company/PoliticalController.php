<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DevelopmentProject;
use App\Models\PartyVolunteer;
use App\Models\PoliticalProfile;
use App\Models\PublicEvent;
use App\Models\PublicGrievance;
use App\Models\PublicService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PoliticalController extends Controller
{
    public function profiles(Request $request)
    {
        $company = $this->getCompany($request);
        $profiles = PoliticalProfile::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.political.profiles.index', compact('company', 'profiles'));
    }

    public function storeProfile(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'party_name' => 'required|string|max:150',
            'constituency' => 'nullable|string|max:150',
            'role_title' => 'nullable|string|max:150',
            'biography' => 'nullable|string',
            'manifesto' => 'nullable|string',
            'office_address' => 'nullable|string',
            'office_hours' => 'nullable|string|max:100',
            'focus_areas' => 'nullable|string',
            'achievements' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        PoliticalProfile::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'party_name' => $request->party_name,
            'constituency' => $request->constituency,
            'role_title' => $request->role_title,
            'biography' => $request->biography,
            'manifesto' => $request->manifesto,
            'office_address' => $request->office_address,
            'office_hours' => $request->office_hours,
            'focus_areas' => $this->splitLines($request->focus_areas),
            'achievements' => $this->splitLines($request->achievements),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Profile added successfully!');
    }

    public function updateProfile(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $profile = PoliticalProfile::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'party_name' => 'required|string|max:150',
            'constituency' => 'nullable|string|max:150',
            'role_title' => 'nullable|string|max:150',
            'biography' => 'nullable|string',
            'manifesto' => 'nullable|string',
            'office_address' => 'nullable|string',
            'office_hours' => 'nullable|string|max:100',
            'focus_areas' => 'nullable|string',
            'achievements' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $profile->update([
            'party_name' => $request->party_name,
            'constituency' => $request->constituency,
            'role_title' => $request->role_title,
            'biography' => $request->biography,
            'manifesto' => $request->manifesto,
            'office_address' => $request->office_address,
            'office_hours' => $request->office_hours,
            'focus_areas' => $this->splitLines($request->focus_areas),
            'achievements' => $this->splitLines($request->achievements),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Profile updated.');
    }

    public function deleteProfile(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $profile = PoliticalProfile::where('company_id', $company->id)->findOrFail($id);
        $profile->delete();

        return back()->with('success', 'Profile removed.');
    }

    public function services(Request $request)
    {
        $company = $this->getCompany($request);
        $services = PublicService::where('company_id', $company->id)->orderBy('display_order')->orderByDesc('created_at')->get();

        return view('company.political.services.index', compact('company', 'services'));
    }

    public function storeService(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'service_name' => 'required|string|max:150',
            'service_category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'eligibility' => 'nullable|string',
            'required_documents' => 'nullable|string',
            'contact_details' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        PublicService::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'service_name' => $request->service_name,
            'service_category' => $request->service_category,
            'description' => $request->description,
            'eligibility' => $request->eligibility,
            'required_documents' => $this->splitLines($request->required_documents),
            'contact_details' => $request->contact_details,
            'display_order' => $request->display_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = PublicService::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'service_name' => 'required|string|max:150',
            'service_category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'eligibility' => 'nullable|string',
            'required_documents' => 'nullable|string',
            'contact_details' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $service->update([
            'service_name' => $request->service_name,
            'service_category' => $request->service_category,
            'description' => $request->description,
            'eligibility' => $request->eligibility,
            'required_documents' => $this->splitLines($request->required_documents),
            'contact_details' => $request->contact_details,
            'display_order' => $request->display_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Service updated.');
    }

    public function deleteService(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $service = PublicService::where('company_id', $company->id)->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service removed.');
    }

    public function projects(Request $request)
    {
        $company = $this->getCompany($request);
        $projects = DevelopmentProject::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.political.projects.index', compact('company', 'projects'));
    }

    public function storeProject(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'project_name' => 'required|string|max:150',
            'project_category' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:150',
            'budget_allocated' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'status' => 'nullable|string|max:30',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048',
            'beneficiaries_count' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
        ]);

        $imageNames = $this->storeImages($request, 'images', 'uploads/political/projects', 'project');

        DevelopmentProject::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'project_name' => $request->project_name,
            'project_category' => $request->project_category,
            'location' => $request->location,
            'budget_allocated' => $request->budget_allocated,
            'start_date' => $request->start_date,
            'completion_date' => $request->completion_date,
            'status' => $request->status ?? 'proposed',
            'description' => $request->description,
            'images' => $imageNames,
            'beneficiaries_count' => $request->beneficiaries_count,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Project added successfully!');
    }

    public function updateProject(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = DevelopmentProject::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'project_name' => 'required|string|max:150',
            'project_category' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:150',
            'budget_allocated' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'status' => 'nullable|string|max:30',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048',
            'beneficiaries_count' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
        ]);

        $imageNames = $project->images ?? [];
        $newImages = $this->storeImages($request, 'images', 'uploads/political/projects', 'project');
        if (!empty($newImages)) {
            $imageNames = $newImages;
        }

        $project->update([
            'project_name' => $request->project_name,
            'project_category' => $request->project_category,
            'location' => $request->location,
            'budget_allocated' => $request->budget_allocated,
            'start_date' => $request->start_date,
            'completion_date' => $request->completion_date,
            'status' => $request->status ?? $project->status,
            'description' => $request->description,
            'images' => $imageNames,
            'beneficiaries_count' => $request->beneficiaries_count,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Project updated.');
    }

    public function deleteProject(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $project = DevelopmentProject::where('company_id', $company->id)->findOrFail($id);
        $project->delete();

        return back()->with('success', 'Project removed.');
    }

    public function events(Request $request)
    {
        $company = $this->getCompany($request);
        $events = PublicEvent::where('company_id', $company->id)->orderByDesc('event_date')->get();

        return view('company.political.events.index', compact('company', 'events'));
    }

    public function storeEvent(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'event_title' => 'required|string|max:150',
            'event_type' => 'nullable|string|max:100',
            'event_date' => 'nullable|date',
            'event_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'contact_name' => 'nullable|string|max:150',
            'contact_mobile' => 'nullable|string|max:30',
            'expected_attendees' => 'nullable|integer|min:0',
            'status' => 'nullable|string|max:30',
            'is_active' => 'nullable|boolean',
        ]);

        PublicEvent::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'event_title' => $request->event_title,
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'location' => $request->location,
            'description' => $request->description,
            'contact_name' => $request->contact_name,
            'contact_mobile' => $request->contact_mobile,
            'expected_attendees' => $request->expected_attendees,
            'status' => $request->status ?? 'scheduled',
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Event added successfully!');
    }

    public function updateEvent(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $event = PublicEvent::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'event_title' => 'required|string|max:150',
            'event_type' => 'nullable|string|max:100',
            'event_date' => 'nullable|date',
            'event_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'contact_name' => 'nullable|string|max:150',
            'contact_mobile' => 'nullable|string|max:30',
            'expected_attendees' => 'nullable|integer|min:0',
            'status' => 'nullable|string|max:30',
            'is_active' => 'nullable|boolean',
        ]);

        $event->update([
            'event_title' => $request->event_title,
            'event_type' => $request->event_type,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'location' => $request->location,
            'description' => $request->description,
            'contact_name' => $request->contact_name,
            'contact_mobile' => $request->contact_mobile,
            'expected_attendees' => $request->expected_attendees,
            'status' => $request->status ?? $event->status,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Event updated.');
    }

    public function deleteEvent(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $event = PublicEvent::where('company_id', $company->id)->findOrFail($id);
        $event->delete();

        return back()->with('success', 'Event removed.');
    }

    public function volunteers(Request $request)
    {
        $company = $this->getCompany($request);
        $volunteers = PartyVolunteer::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.political.volunteers.index', compact('company', 'volunteers'));
    }

    public function storeVolunteer(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'volunteer_name' => 'required|string|max:150',
            'volunteer_mobile' => 'nullable|string|max:30',
            'volunteer_email' => 'nullable|email|max:150',
            'role' => 'nullable|string|max:100',
            'area' => 'nullable|string|max:100',
            'joined_date' => 'nullable|date',
            'status' => 'nullable|string|max:30',
            'notes' => 'nullable|string',
        ]);

        PartyVolunteer::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'volunteer_name' => $request->volunteer_name,
            'volunteer_mobile' => $request->volunteer_mobile,
            'volunteer_email' => $request->volunteer_email,
            'role' => $request->role,
            'area' => $request->area,
            'joined_date' => $request->joined_date,
            'status' => $request->status ?? 'active',
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Volunteer added successfully!');
    }

    public function updateVolunteer(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $volunteer = PartyVolunteer::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'volunteer_name' => 'required|string|max:150',
            'volunteer_mobile' => 'nullable|string|max:30',
            'volunteer_email' => 'nullable|email|max:150',
            'role' => 'nullable|string|max:100',
            'area' => 'nullable|string|max:100',
            'joined_date' => 'nullable|date',
            'status' => 'nullable|string|max:30',
            'notes' => 'nullable|string',
        ]);

        $volunteer->update([
            'volunteer_name' => $request->volunteer_name,
            'volunteer_mobile' => $request->volunteer_mobile,
            'volunteer_email' => $request->volunteer_email,
            'role' => $request->role,
            'area' => $request->area,
            'joined_date' => $request->joined_date,
            'status' => $request->status ?? $volunteer->status,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Volunteer updated.');
    }

    public function deleteVolunteer(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $volunteer = PartyVolunteer::where('company_id', $company->id)->findOrFail($id);
        $volunteer->delete();

        return back()->with('success', 'Volunteer removed.');
    }

    public function grievances(Request $request)
    {
        $company = $this->getCompany($request);
        $grievances = PublicGrievance::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.political.grievances.index', compact('company', 'grievances'));
    }

    public function storeGrievance(Request $request)
    {
        $company = $this->getCompany($request);
        $customerId = $this->resolveCustomerId($company);

        $request->validate([
            'complainant_name' => 'required|string|max:150',
            'complainant_mobile' => 'required|string|max:30',
            'complainant_email' => 'nullable|email|max:150',
            'issue_category' => 'nullable|string|max:100',
            'issue_description' => 'required|string',
            'location' => 'nullable|string|max:150',
            'images.*' => 'nullable|image|max:2048',
            'priority' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:20',
        ]);

        $imageNames = $this->storeImages($request, 'images', 'uploads/political/grievances', 'grievance');

        PublicGrievance::create([
            'customer_id' => $customerId,
            'company_id' => $company->id,
            'complainant_name' => $request->complainant_name,
            'complainant_mobile' => $request->complainant_mobile,
            'complainant_email' => $request->complainant_email,
            'issue_category' => $request->issue_category,
            'issue_description' => $request->issue_description,
            'location' => $request->location,
            'images' => $imageNames,
            'priority' => $request->priority ?? 'medium',
            'status' => $request->status ?? 'submitted',
            'ticket_number' => $this->generateTicketNumber(),
        ]);

        return back()->with('success', 'Grievance added successfully!');
    }

    public function updateGrievanceStatus(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $grievance = PublicGrievance::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:20',
            'priority' => 'nullable|string|max:20',
            'assigned_to' => 'nullable|string|max:100',
            'resolution_notes' => 'nullable|string',
            'resolved_date' => 'nullable|date',
        ]);

        $grievance->update([
            'status' => $request->status,
            'priority' => $request->priority ?? $grievance->priority,
            'assigned_to' => $request->assigned_to,
            'resolution_notes' => $request->resolution_notes,
            'resolved_date' => $request->resolved_date,
        ]);

        return back()->with('success', 'Grievance updated.');
    }

    public function deleteGrievance(Request $request, $id)
    {
        $company = $this->getCompany($request);
        $grievance = PublicGrievance::where('company_id', $company->id)->findOrFail($id);
        $grievance->delete();

        return back()->with('success', 'Grievance removed.');
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

    private function generateTicketNumber(): string
    {
        do {
            $ticket = 'GRV-' . strtoupper(Str::random(8));
        } while (PublicGrievance::where('ticket_number', $ticket)->exists());

        return $ticket;
    }
}
