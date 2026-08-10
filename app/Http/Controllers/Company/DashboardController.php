<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyStaff;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show company dashboard
     */
    public function index(Request $request)
    {
        $companyId = $request->session()->get('COMPANY_ID');
        $company = Company::with(['staff', 'professionTheme'])->find($companyId);

        // Get stats
        $stats = [
            'total_staff' => $company->staff->count(),
            'active_cards' => $company->staff->where('card_enabled', 1)->where('status', 1)->count(),
            'inactive_cards' => $company->staff->filter(fn($s) => $s->card_enabled == 0 || $s->status == 0)->count(),
            'cards_remaining' => $company->remaining_cards,
            'card_limit' => $company->card_limit,
        ];

        // Get recent staff
        $recentStaff = CompanyStaff::where('company_id', $companyId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('company.dashboard', compact('company', 'stats', 'recentStaff'));
    }
}
