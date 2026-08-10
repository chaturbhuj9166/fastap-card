<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('COMPANY_LOGIN')) {
            // Check if company is still active
            $companyId = $request->session()->get('COMPANY_ID');
            $company = \App\Models\Company::find($companyId);

            if (!$company || $company->status != 1) {
                $request->session()->flush();
                $request->session()->flash('error', 'Your company account has been deactivated. Please contact support.');
                return redirect('company/login');
            }

            // Share company data with all views
            view()->share('company', $company);

            return $next($request);
        }

        $request->session()->flash('error', 'Please login to access the company dashboard');
        return redirect('company/login');
    }
}
