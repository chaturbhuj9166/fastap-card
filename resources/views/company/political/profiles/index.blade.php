@extends('layouts.redesign.company')

@section('page-title', 'Political Profiles')
@section('breadcrumb', 'Political Profiles')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Political Profiles</h2>
            <p>Manage leadership profile information</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Profile</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/political/profiles') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Party Name</label>
                    <input type="text" name="party_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Constituency</label>
                    <input type="text" name="constituency" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Role Title</label>
                    <input type="text" name="role_title" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Office Hours</label>
                    <input type="text" name="office_hours" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Biography</label>
                    <textarea name="biography" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Manifesto / Vision</label>
                    <textarea name="manifesto" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Office Address</label>
                    <textarea name="office_address" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Focus Areas (one per line)</label>
                    <textarea name="focus_areas" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Achievements (one per line)</label>
                    <textarea name="achievements" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Profile</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Profiles</h3>
        </div>
        <div class="card-body">
            @if($profiles->count() === 0)
                <p class="empty-state">No profiles added yet.</p>
            @else
                @foreach($profiles as $profile)
                    <div class="item-card">
                        <form method="POST" action="{{ url('/company/political/profiles/' . $profile->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Party Name</label>
                                <input type="text" name="party_name" class="form-input" value="{{ $profile->party_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Constituency</label>
                                <input type="text" name="constituency" class="form-input" value="{{ $profile->constituency }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Role Title</label>
                                <input type="text" name="role_title" class="form-input" value="{{ $profile->role_title }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Office Hours</label>
                                <input type="text" name="office_hours" class="form-input" value="{{ $profile->office_hours }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Biography</label>
                                <textarea name="biography" class="form-input" rows="3">{{ $profile->biography }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Manifesto / Vision</label>
                                <textarea name="manifesto" class="form-input" rows="3">{{ $profile->manifesto }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Office Address</label>
                                <textarea name="office_address" class="form-input" rows="2">{{ $profile->office_address }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Focus Areas (one per line)</label>
                                <textarea name="focus_areas" class="form-input" rows="3">{{ $profile->focus_areas ? implode("\n", $profile->focus_areas) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Achievements (one per line)</label>
                                <textarea name="achievements" class="form-input" rows="3">{{ $profile->achievements ? implode("\n", $profile->achievements) : '' }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" value="1" {{ $profile->is_active ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ url('/company/political/profiles/' . $profile->id) }}" class="inline-form" onsubmit="return confirm('Delete this profile?');">
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
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
