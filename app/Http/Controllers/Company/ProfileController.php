<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\ProfessionTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Show company profile page
     */
    public function index(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::with('professionTheme')->find($companyId);
        $themes = ProfessionTheme::active()->ordered()->get();

        return view('company.profile.index', compact('company', 'themes'));
    }

    /**
     * Update company profile
     */
    public function update(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:1000',
            'profession_type' => 'required|integer|min:1|max:13',
            'industry' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:20',
            'gst_number' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($company->logo && file_exists(public_path('uploads/companies/' . $company->logo))) {
                unlink(public_path('uploads/companies/' . $company->logo));
            }

            $logo = $request->file('logo');
            $logoName = 'logo_' . $company->id . '_' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/companies'), $logoName);
            $company->logo = $logoName;
        }

        // Handle banner upload
        if ($request->hasFile('banner')) {
            // Delete old banner
            if ($company->banner && file_exists(public_path('uploads/companies/' . $company->banner))) {
                unlink(public_path('uploads/companies/' . $company->banner));
            }

            $banner = $request->file('banner');
            $bannerName = 'banner_' . $company->id . '_' . time() . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/companies'), $bannerName);
            $company->banner = $bannerName;
        }

        // Update slug if name changed
        if ($company->name !== $request->name) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $counter = 1;
            while (Company::where('slug', $slug)->where('id', '!=', $company->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            $company->slug = $slug;
        }

        $company->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'description' => $request->description,
            'profession_type' => $request->profession_type,
            'industry' => $request->industry,
            'website' => $request->website,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode,
            'gst_number' => $request->gst_number,
        ]);

        // Update session name if changed
        $request->session()->put('COMPANY_NAME', $company->name);

        return back()->with('success', 'Company profile updated successfully!');
    }

    /**
     * Update social media links
     */
    public function updateSocial(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        $request->validate([
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);

        $company->update([
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
        ]);

        return back()->with('success', 'Social media links updated successfully!');
    }

    /**
     * Show branding settings page
     */
    public function branding(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);
        $branding = $company->branding_settings ?? [];

        return view('company.branding.index', compact('company', 'branding'));
    }

    /**
     * Update color scheme
     */
    public function updateColors(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        $branding = $company->branding_settings ?? [];
        $branding['primary_color'] = $request->primary_color ?? '#0891b2';
        $branding['secondary_color'] = $request->secondary_color ?? '#06b6d4';
        $branding['accent_color'] = $request->accent_color ?? '#f59e0b';
        $branding['text_color'] = $request->text_color ?? '#1f2937';

        $company->branding_settings = $branding;
        $company->save();

        return back()->with('success', 'Color scheme updated successfully!');
    }

    /**
     * Update typography
     */
    public function updateTypography(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        $branding = $company->branding_settings ?? [];
        $branding['heading_font'] = $request->heading_font ?? 'Inter';
        $branding['body_font'] = $request->body_font ?? 'Inter';

        $company->branding_settings = $branding;
        $company->save();

        return back()->with('success', 'Typography updated successfully!');
    }

    /**
     * Update card layout
     */
    public function updateLayout(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        $branding = $company->branding_settings ?? [];
        $branding['card_layout'] = $request->card_layout ?? 'modern';
        $branding['button_style'] = $request->button_style ?? 'rounded';
        $branding['show_company_logo'] = $request->has('show_company_logo');
        $branding['show_company_name'] = $request->has('show_company_name');

        $company->branding_settings = $branding;
        $company->save();

        return back()->with('success', 'Card layout updated successfully!');
    }

    /**
     * Show subscription page
     */
    public function subscription(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        $plans = [
            'free' => [
                'name' => 'Free',
                'price' => 0,
                'cards' => 5,
                'features' => ['5 Staff Cards', 'Basic Themes', 'Fastap Branding'],
            ],
            'basic' => [
                'name' => 'Basic',
                'price' => 999,
                'cards' => 25,
                'features' => ['25 Staff Cards', 'All Themes', 'Custom Branding', 'Priority Support'],
            ],
            'premium' => [
                'name' => 'Premium',
                'price' => 2499,
                'cards' => 100,
                'features' => ['100 Staff Cards', 'All Themes', 'White-label Option', 'Dedicated Support'],
            ],
            'enterprise' => [
                'name' => 'Enterprise',
                'price' => 'Contact Us',
                'cards' => 'Unlimited',
                'features' => ['Unlimited Cards', 'Custom Development', 'Dedicated Account Manager', 'SLA Support'],
            ],
        ];

        return view('company.profile.subscription', compact('company', 'plans'));
    }

    /**
     * Change password page
     */
    public function changePassword(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        return view('company.profile.change-password', compact('company'));
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::find($companyId);

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if (!\Hash::check($request->current_password, $company->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $company->password = \Hash::make($request->password);
        $company->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
