@extends('layouts.redesign.company')

@section('title', 'Brand Collaborations')

@section('content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Brand Collaborations</h1>
            <p class="content-subtitle">Manage collaboration inquiries and campaigns</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Collaboration</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/influencer/collaborations') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Brand Name</label>
                    <input type="text" name="brand_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Brand Email</label>
                    <input type="email" name="brand_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Brand Mobile</label>
                    <input type="text" name="brand_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Collaboration Type</label>
                    <input type="text" name="collaboration_type" class="form-input" placeholder="sponsored_post/review/event">
                </div>
                <div class="form-group">
                    <label class="form-label">Platform</label>
                    <input type="text" name="platform" class="form-input" placeholder="instagram/youtube/multiple">
                </div>
                <div class="form-group">
                    <label class="form-label">Budget</label>
                    <input type="number" name="budget" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Campaign Start</label>
                    <input type="date" name="campaign_start_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Campaign End</label>
                    <input type="date" name="campaign_end_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-input" placeholder="inquiry/confirmed/in_progress">
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Status</label>
                    <input type="text" name="payment_status" class="form-input" placeholder="pending/paid">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Deliverables (one per line)</label>
                    <textarea name="deliverables" class="form-input" rows="2" placeholder="1 Instagram Reel&#10;2 Story Mentions"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Campaign Brief</label>
                    <textarea name="campaign_brief" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="contract_signed" value="1">
                        <span>Contract Signed</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Collaboration</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Collaboration List</h3>
        </div>
        <div class="card-body">
            @if($collaborations->count() === 0)
                <p class="empty-state">No collaborations yet.</p>
            @else
                @foreach($collaborations as $collaboration)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $collaboration->brand_name }}</strong>
                            <span>{{ $collaboration->collaboration_type ?? 'Collaboration' }}</span>
                        </div>
                        <p class="item-desc">{{ $collaboration->campaign_brief ?? 'No campaign brief.' }}</p>

                        <form method="POST" action="{{ url('/company/influencer/collaborations/' . $collaboration->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Brand Name</label>
                                <input type="text" name="brand_name" class="form-input" value="{{ $collaboration->brand_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Brand Email</label>
                                <input type="email" name="brand_email" class="form-input" value="{{ $collaboration->brand_email }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Brand Mobile</label>
                                <input type="text" name="brand_mobile" class="form-input" value="{{ $collaboration->brand_mobile }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Collaboration Type</label>
                                <input type="text" name="collaboration_type" class="form-input" value="{{ $collaboration->collaboration_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Platform</label>
                                <input type="text" name="platform" class="form-input" value="{{ $collaboration->platform }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Budget</label>
                                <input type="number" name="budget" class="form-input" value="{{ $collaboration->budget }}" step="0.01" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Campaign Start</label>
                                <input type="date" name="campaign_start_date" class="form-input" value="{{ optional($collaboration->campaign_start_date)->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Campaign End</label>
                                <input type="date" name="campaign_end_date" class="form-input" value="{{ optional($collaboration->campaign_end_date)->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="status" class="form-input" value="{{ $collaboration->status }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Payment Status</label>
                                <input type="text" name="payment_status" class="form-input" value="{{ $collaboration->payment_status }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Deliverables</label>
                                <textarea name="deliverables" class="form-input" rows="2">{{ is_array($collaboration->deliverables) ? implode("\n", $collaboration->deliverables) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Campaign Brief</label>
                                <textarea name="campaign_brief" class="form-input" rows="2">{{ $collaboration->campaign_brief }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="contract_signed" value="1" {{ $collaboration->contract_signed ? 'checked' : '' }}>
                                    <span>Contract Signed</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/company/influencer/collaborations/' . $collaboration->id) }}" class="inline-form" onsubmit="return confirm('Delete this collaboration?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-top: 0.75rem; }
    .empty-state { color: var(--text-secondary); }
    .item-card { border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .item-header { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.5rem; }
    .item-desc { color: var(--text-secondary); margin-bottom: 1rem; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
