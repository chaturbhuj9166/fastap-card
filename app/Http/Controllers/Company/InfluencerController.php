<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\BrandCollaboration;
use App\Models\CreatorPortfolio;
use App\Models\CreatorStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InfluencerController extends Controller
{
    public function stats()
    {
        $company = Auth::guard('company')->user();
        $stats = CreatorStat::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.influencer.stats.index', compact('stats'));
    }

    public function storeStat(Request $request)
    {
        $company = Auth::guard('company')->user();

        $request->validate([
            'platform' => 'nullable|string|max:40',
            'handle' => 'nullable|string|max:120',
            'followers_count' => 'nullable|integer|min:0',
            'avg_reach' => 'nullable|integer|min:0',
            'avg_engagement_rate' => 'nullable|numeric|min:0|max:100',
            'audience_demographics' => 'nullable|string',
            'monthly_views' => 'nullable|integer|min:0',
            'last_updated' => 'nullable|date',
        ]);

        CreatorStat::create([
            'customer_id' => $company->customer_id,
            'company_id' => $company->id,
            'platform' => $request->platform,
            'handle' => $request->handle,
            'followers_count' => $request->followers_count,
            'avg_reach' => $request->avg_reach,
            'avg_engagement_rate' => $request->avg_engagement_rate,
            'audience_demographics' => $this->splitLines($request->audience_demographics),
            'monthly_views' => $request->monthly_views,
            'last_updated' => $request->last_updated,
        ]);

        return back()->with('success', 'Creator stats added.');
    }

    public function updateStat(Request $request, $id)
    {
        $company = Auth::guard('company')->user();
        $stat = CreatorStat::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'platform' => 'nullable|string|max:40',
            'handle' => 'nullable|string|max:120',
            'followers_count' => 'nullable|integer|min:0',
            'avg_reach' => 'nullable|integer|min:0',
            'avg_engagement_rate' => 'nullable|numeric|min:0|max:100',
            'audience_demographics' => 'nullable|string',
            'monthly_views' => 'nullable|integer|min:0',
            'last_updated' => 'nullable|date',
        ]);

        $stat->update([
            'platform' => $request->platform,
            'handle' => $request->handle,
            'followers_count' => $request->followers_count,
            'avg_reach' => $request->avg_reach,
            'avg_engagement_rate' => $request->avg_engagement_rate,
            'audience_demographics' => $this->splitLines($request->audience_demographics),
            'monthly_views' => $request->monthly_views,
            'last_updated' => $request->last_updated,
        ]);

        return back()->with('success', 'Creator stats updated.');
    }

    public function deleteStat($id)
    {
        $company = Auth::guard('company')->user();
        $stat = CreatorStat::where('company_id', $company->id)->findOrFail($id);
        $stat->delete();

        return back()->with('success', 'Creator stats removed.');
    }

    public function collaborations()
    {
        $company = Auth::guard('company')->user();
        $collaborations = BrandCollaboration::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.influencer.collaborations.index', compact('collaborations'));
    }

    public function storeCollaboration(Request $request)
    {
        $company = Auth::guard('company')->user();

        $request->validate([
            'brand_name' => 'required|string|max:150',
            'brand_email' => 'nullable|email|max:150',
            'brand_mobile' => 'nullable|string|max:30',
            'collaboration_type' => 'nullable|string|max:60',
            'platform' => 'nullable|string|max:60',
            'deliverables' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'campaign_brief' => 'nullable|string',
            'campaign_start_date' => 'nullable|date',
            'campaign_end_date' => 'nullable|date',
            'status' => 'nullable|string|max:30',
            'payment_status' => 'nullable|string|max:30',
            'contract_signed' => 'nullable|boolean',
        ]);

        BrandCollaboration::create([
            'customer_id' => $company->customer_id,
            'company_id' => $company->id,
            'brand_name' => $request->brand_name,
            'brand_email' => $request->brand_email,
            'brand_mobile' => $request->brand_mobile,
            'collaboration_type' => $request->collaboration_type,
            'platform' => $request->platform,
            'deliverables' => $this->splitLines($request->deliverables),
            'budget' => $request->budget,
            'campaign_brief' => $request->campaign_brief,
            'campaign_start_date' => $request->campaign_start_date,
            'campaign_end_date' => $request->campaign_end_date,
            'status' => $request->status ?? 'inquiry',
            'contract_signed' => $request->has('contract_signed'),
            'payment_status' => $request->payment_status,
        ]);

        return back()->with('success', 'Brand collaboration added.');
    }

    public function updateCollaboration(Request $request, $id)
    {
        $company = Auth::guard('company')->user();
        $collaboration = BrandCollaboration::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'brand_name' => 'required|string|max:150',
            'brand_email' => 'nullable|email|max:150',
            'brand_mobile' => 'nullable|string|max:30',
            'collaboration_type' => 'nullable|string|max:60',
            'platform' => 'nullable|string|max:60',
            'deliverables' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'campaign_brief' => 'nullable|string',
            'campaign_start_date' => 'nullable|date',
            'campaign_end_date' => 'nullable|date',
            'status' => 'nullable|string|max:30',
            'payment_status' => 'nullable|string|max:30',
            'contract_signed' => 'nullable|boolean',
        ]);

        $collaboration->update([
            'brand_name' => $request->brand_name,
            'brand_email' => $request->brand_email,
            'brand_mobile' => $request->brand_mobile,
            'collaboration_type' => $request->collaboration_type,
            'platform' => $request->platform,
            'deliverables' => $this->splitLines($request->deliverables),
            'budget' => $request->budget,
            'campaign_brief' => $request->campaign_brief,
            'campaign_start_date' => $request->campaign_start_date,
            'campaign_end_date' => $request->campaign_end_date,
            'status' => $request->status,
            'contract_signed' => $request->has('contract_signed'),
            'payment_status' => $request->payment_status,
        ]);

        return back()->with('success', 'Collaboration updated.');
    }

    public function deleteCollaboration($id)
    {
        $company = Auth::guard('company')->user();
        $collaboration = BrandCollaboration::where('company_id', $company->id)->findOrFail($id);
        $collaboration->delete();

        return back()->with('success', 'Collaboration removed.');
    }

    public function portfolio()
    {
        $company = Auth::guard('company')->user();
        $portfolio = CreatorPortfolio::where('company_id', $company->id)->orderByDesc('created_at')->get();

        return view('company.influencer.portfolio.index', compact('portfolio'));
    }

    public function storePortfolio(Request $request)
    {
        $company = Auth::guard('company')->user();

        $request->validate([
            'content_type' => 'nullable|string|max:40',
            'title' => 'required|string|max:150',
            'brand_name' => 'nullable|string|max:150',
            'content_url' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|max:4096',
            'views_count' => 'nullable|integer|min:0',
            'engagement_rate' => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $thumbnail = $this->storeSingleFile($request, 'thumbnail', 'uploads/influencer/portfolio', 'thumb');

        CreatorPortfolio::create([
            'customer_id' => $company->customer_id,
            'company_id' => $company->id,
            'content_type' => $request->content_type,
            'title' => $request->title,
            'brand_name' => $request->brand_name,
            'content_url' => $request->content_url,
            'thumbnail' => $thumbnail,
            'views_count' => $request->views_count,
            'engagement_rate' => $request->engagement_rate,
            'description' => $request->description,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Portfolio item added.');
    }

    public function updatePortfolio(Request $request, $id)
    {
        $company = Auth::guard('company')->user();
        $item = CreatorPortfolio::where('company_id', $company->id)->findOrFail($id);

        $request->validate([
            'content_type' => 'nullable|string|max:40',
            'title' => 'required|string|max:150',
            'brand_name' => 'nullable|string|max:150',
            'content_url' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|max:4096',
            'views_count' => 'nullable|integer|min:0',
            'engagement_rate' => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $thumbnail = $item->thumbnail;
        $newThumbnail = $this->storeSingleFile($request, 'thumbnail', 'uploads/influencer/portfolio', 'thumb');
        if ($newThumbnail) {
            $thumbnail = $newThumbnail;
        }

        $item->update([
            'content_type' => $request->content_type,
            'title' => $request->title,
            'brand_name' => $request->brand_name,
            'content_url' => $request->content_url,
            'thumbnail' => $thumbnail,
            'views_count' => $request->views_count,
            'engagement_rate' => $request->engagement_rate,
            'description' => $request->description,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Portfolio item updated.');
    }

    public function deletePortfolio($id)
    {
        $company = Auth::guard('company')->user();
        $item = CreatorPortfolio::where('company_id', $company->id)->findOrFail($id);
        $item->delete();

        return back()->with('success', 'Portfolio item removed.');
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

    private function storeSingleFile(Request $request, string $field, string $directory, string $prefix): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $storagePath = public_path($directory);
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $file = $request->file($field);
        $fileName = $prefix . '-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($storagePath, $fileName);

        return $fileName;
    }
}
