<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\ProfessionTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Show company login page
     */
    public function showLogin()
    {
        return view('company.auth.login');
    }

    /**
     * Handle company login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $company = Company::where('email', $request->email)->first();

        if (!$company) {
            return back()->with('error', 'No account found with this email address.');
        }

        if (!Hash::check($request->password, $company->password)) {
            return back()->with('error', 'Invalid password. Please try again.');
        }

        if ($company->status != 1) {
            return back()->with('error', 'Your account has been deactivated. Please contact support.');
        }

        // Set session
        $request->session()->put('COMPANY_LOGIN', true);
        $request->session()->put('COMPANY_ID', $company->id);
        $request->session()->put('COMPANY_NAME', $company->name);
        $request->session()->put('COMPANY_EMAIL', $company->email);

        return redirect('/company/dashboard')->with('success', 'Welcome back, ' . $company->name . '!');
    }

    /**
     * Show company registration page
     */
    public function showRegister()
    {
        $themes = ProfessionTheme::active()->ordered()->get();
        return view('company.auth.register', compact('themes'));
    }

    /**
     * Handle company registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|string|max:20',
            'profession_type' => 'required|integer|min:1|max:13',
            'industry' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:20',
        ]);

        // Generate unique slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (Company::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $company = Company::create([
            'name' => $request->name,
            'slug' => $slug,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'profession_type' => $request->profession_type,
            'industry' => $request->industry,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country ?? 'India',
            'pincode' => $request->pincode,
            'card_limit' => 5, // Default free tier
            'cards_used' => 0,
            'status' => 1,
            'subscription_type' => 'free',
        ]);

        // Auto-login after registration
        $request->session()->put('COMPANY_LOGIN', true);
        $request->session()->put('COMPANY_ID', $company->id);
        $request->session()->put('COMPANY_NAME', $company->name);
        $request->session()->put('COMPANY_EMAIL', $company->email);

        return redirect('/company/dashboard')->with('success', 'Registration successful! Welcome to Fastap.');
    }

    /**
     * Handle company logout
     */
    public function logout(Request $request)
    {
        $request->session()->forget('COMPANY_LOGIN');
        $request->session()->forget('COMPANY_ID');
        $request->session()->forget('COMPANY_NAME');
        $request->session()->forget('COMPANY_EMAIL');

        return redirect('/company/login')->with('success', 'You have been logged out successfully.');
    }
}
