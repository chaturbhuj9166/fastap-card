<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyStaff;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    /**
     * Display list of staff members
     */
    public function index(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        $query = CompanyStaff::where('company_id', $companyId);

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('designation', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Department filter
        if ($request->has('department') && $request->department) {
            $query->where('department', $request->department);
        }

        $staff = $query->ordered()->paginate(15);

        // Get unique departments for filter
        $departments = CompanyStaff::where('company_id', $companyId)
            ->whereNotNull('department')
            ->distinct()
            ->pluck('department');

        return view('company.staff.index', compact('company', 'staff', 'departments'));
    }

    /**
     * Show form to create new staff member
     */
    public function create(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        if (!$company->canCreateCard()) {
            return back()->with('error', 'You have reached your card limit. Please upgrade your subscription.');
        }

        return view('company.staff.create', compact('company'));
    }

    /**
     * Store a new staff member
     */
    public function store(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        if (!$company->canCreateCard()) {
            return back()->with('error', 'You have reached your card limit. Please upgrade your subscription.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'employee_id' => 'nullable|string|max:50',
            'role' => 'required|in:admin,manager,staff',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        $profileImage = null;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $profileImage = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/staff'), $profileImage);
        }

        // Default visibility settings
        $visibilitySettings = [
            'show_email' => true,
            'show_phone' => true,
            'show_department' => true,
            'show_designation' => true,
            'show_qualifications' => true,
            'show_social' => true,
        ];

        $staff = CompanyStaff::create([
            'company_id' => $companyId,
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'department' => $request->department,
            'profile_image' => $profileImage,
            'role' => $request->role,
            'card_enabled' => 1,
            'visibility_settings' => $visibilitySettings,
            'status' => 1,
        ]);

        // Increment cards used count
        $company->incrementCardsUsed();

        return redirect('/company/staff')->with('success', 'Staff member added successfully!');
    }

    /**
     * Show staff member details
     */
    public function show(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $staff = CompanyStaff::where('company_id', $companyId)->findOrFail($id);

        return view('company.staff.show', compact('company', 'staff'));
    }

    /**
     * Show form to edit staff member
     */
    public function edit(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $staff = CompanyStaff::where('company_id', $companyId)->findOrFail($id);

        return view('company.staff.edit', compact('company', 'staff'));
    }

    /**
     * Update staff member
     */
    public function update(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $staff = CompanyStaff::where('company_id', $companyId)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'employee_id' => 'nullable|string|max:50',
            'role' => 'required|in:admin,manager,staff',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($staff->profile_image && file_exists(public_path('uploads/staff/' . $staff->profile_image))) {
                unlink(public_path('uploads/staff/' . $staff->profile_image));
            }

            $image = $request->file('profile_image');
            $profileImage = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/staff'), $profileImage);
            $staff->profile_image = $profileImage;
        }

        $staff->update([
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'department' => $request->department,
            'role' => $request->role,
        ]);

        return redirect('/company/staff')->with('success', 'Staff member updated successfully!');
    }

    /**
     * Delete staff member
     */
    public function destroy(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $staff = CompanyStaff::where('company_id', $companyId)->findOrFail($id);

        // Delete profile image
        if ($staff->profile_image && file_exists(public_path('uploads/staff/' . $staff->profile_image))) {
            unlink(public_path('uploads/staff/' . $staff->profile_image));
        }

        $staff->delete();

        // Decrement cards used count
        $company->decrementCardsUsed();

        return redirect('/company/staff')->with('success', 'Staff member deleted successfully!');
    }

    /**
     * Toggle staff card status
     */
    public function toggleCard(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $staff = CompanyStaff::where('company_id', $companyId)->findOrFail($id);

        $staff->card_enabled = !$staff->card_enabled;
        $staff->save();

        $status = $staff->card_enabled ? 'enabled' : 'disabled';
        return back()->with('success', "Staff card has been {$status}.");
    }

    /**
     * Show visibility settings form
     */
    public function visibility(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $staff = CompanyStaff::where('company_id', $companyId)->findOrFail($id);
        $visibility = $staff->visibility_settings ?? [];

        return view('company.staff.visibility', compact('company', 'staff', 'visibility'));
    }

    /**
     * Update visibility settings
     */
    public function updateVisibility(Request $request, $id)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $staff = CompanyStaff::where('company_id', $companyId)->findOrFail($id);

        $visibilitySettings = [
            // Personal Info
            'show_profile_image' => $request->has('show_profile_image'),
            'show_name' => $request->has('show_name'),
            'show_bio' => $request->has('show_bio'),
            // Contact Info
            'show_email' => $request->has('show_email'),
            'show_phone' => $request->has('show_phone'),
            'show_whatsapp' => $request->has('show_whatsapp'),
            'show_address' => $request->has('show_address'),
            // Work Info
            'show_designation' => $request->has('show_designation'),
            'show_department' => $request->has('show_department'),
            'show_employee_id' => $request->has('show_employee_id'),
            'show_qualifications' => $request->has('show_qualifications'),
            // Company Info
            'show_company_name' => $request->has('show_company_name'),
            'show_company_logo' => $request->has('show_company_logo'),
            'show_company_website' => $request->has('show_company_website'),
            // Social Media
            'show_social' => $request->has('show_social'),
            'show_facebook' => $request->has('show_facebook'),
            'show_instagram' => $request->has('show_instagram'),
            'show_twitter' => $request->has('show_twitter'),
            'show_linkedin' => $request->has('show_linkedin'),
            'show_youtube' => $request->has('show_youtube'),
            // Card Sections
            'show_contact_buttons' => $request->has('show_contact_buttons'),
            'show_save_contact' => $request->has('show_save_contact'),
            'show_share_button' => $request->has('show_share_button'),
        ];

        $staff->visibility_settings = $visibilitySettings;
        $staff->save();

        return back()->with('success', 'Visibility settings updated successfully!');
    }

    /**
     * Bulk import staff via CSV
     */
    public function import(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        if ($request->isMethod('get')) {
            return view('company.staff.import', compact('company'));
        }

        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getPathname(), 'r');

        // Skip header row
        $header = fgetcsv($handle);

        $imported = 0;
        $skipped = 0;

        while (($row = fgetcsv($handle)) !== false) {
            // Check card limit
            if (!$company->canCreateCard()) {
                $skipped++;
                continue;
            }

            // Expected columns: name, email, phone, designation, department, employee_id
            if (count($row) < 1 || empty($row[0])) {
                $skipped++;
                continue;
            }

            CompanyStaff::create([
                'company_id' => $companyId,
                'name' => $row[0] ?? '',
                'email' => $row[1] ?? null,
                'phone' => $row[2] ?? null,
                'designation' => $row[3] ?? null,
                'department' => $row[4] ?? null,
                'employee_id' => $row[5] ?? null,
                'role' => 'staff',
                'card_enabled' => 1,
                'status' => 1,
                'visibility_settings' => [
                    'show_email' => true,
                    'show_phone' => true,
                    'show_department' => true,
                    'show_designation' => true,
                ],
            ]);

            $company->incrementCardsUsed();
            $imported++;
        }

        fclose($handle);

        $message = "Successfully imported {$imported} staff members.";
        if ($skipped > 0) {
            $message .= " {$skipped} entries were skipped (invalid data or card limit reached).";
        }

        return redirect('/company/staff')->with('success', $message);
    }
}
