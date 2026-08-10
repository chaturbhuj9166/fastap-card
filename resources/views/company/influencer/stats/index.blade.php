@extends('layouts.redesign.company')

@section('title', 'Creator Stats')

@section('content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Creator Stats</h1>
            <p class="content-subtitle">Track social media reach by platform</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Stats</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/influencer/stats') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Platform</label>
                    <input type="text" name="platform" class="form-input" placeholder="instagram/youtube/tiktok">
                </div>
                <div class="form-group">
                    <label class="form-label">Handle</label>
                    <input type="text" name="handle" class="form-input" placeholder="@creator">
                </div>
                <div class="form-group">
                    <label class="form-label">Followers/Subscribers</label>
                    <input type="number" name="followers_count" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Avg Reach</label>
                    <input type="number" name="avg_reach" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Engagement Rate (%)</label>
                    <input type="number" name="avg_engagement_rate" class="form-input" step="0.01" min="0" max="100">
                </div>
                <div class="form-group">
                    <label class="form-label">Monthly Views</label>
                    <input type="number" name="monthly_views" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Last Updated</label>
                    <input type="date" name="last_updated" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Audience Demographics (one per line)</label>
                    <textarea name="audience_demographics" class="form-input" rows="2" placeholder="65% Female&#10;18-34 Age Group&#10;Top City: Mumbai"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Stats</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Stats List</h3>
        </div>
        <div class="card-body">
            @if($stats->count() === 0)
                <p class="empty-state">No stats added yet.</p>
            @else
                @foreach($stats as $stat)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $stat->platform ?? 'Platform' }}</strong>
                            <span>{{ $stat->handle ?? 'Handle' }}</span>
                        </div>

                        <form method="POST" action="{{ url('/company/influencer/stats/' . $stat->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Platform</label>
                                <input type="text" name="platform" class="form-input" value="{{ $stat->platform }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Handle</label>
                                <input type="text" name="handle" class="form-input" value="{{ $stat->handle }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Followers</label>
                                <input type="number" name="followers_count" class="form-input" value="{{ $stat->followers_count }}" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Avg Reach</label>
                                <input type="number" name="avg_reach" class="form-input" value="{{ $stat->avg_reach }}" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Engagement Rate (%)</label>
                                <input type="number" name="avg_engagement_rate" class="form-input" value="{{ $stat->avg_engagement_rate }}" step="0.01" min="0" max="100">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Monthly Views</label>
                                <input type="number" name="monthly_views" class="form-input" value="{{ $stat->monthly_views }}" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Updated</label>
                                <input type="date" name="last_updated" class="form-input" value="{{ optional($stat->last_updated)->format('Y-m-d') }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Audience Demographics</label>
                                <textarea name="audience_demographics" class="form-input" rows="2">{{ is_array($stat->audience_demographics) ? implode("\n", $stat->audience_demographics) : '' }}</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/company/influencer/stats/' . $stat->id) }}" class="inline-form" onsubmit="return confirm('Delete this stat entry?');">
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
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
