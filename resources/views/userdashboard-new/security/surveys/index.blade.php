@extends('layouts.redesign.dashboard')

@section('title', 'Security Site Surveys')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Site Surveys</h1>
            <p class="content-subtitle">Track client surveys and requirements</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Survey</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/security/surveys') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Client Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Property Type</label>
                    <input type="text" name="property_type" class="form-input" placeholder="home/office/factory">
                </div>
                <div class="form-group">
                    <label class="form-label">Property Address</label>
                    <input type="text" name="property_address" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Area (sqft)</label>
                    <input type="number" name="area_sqft" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Cameras Required</label>
                    <input type="number" name="number_of_cameras_required" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Storage Days</label>
                    <input type="number" name="storage_days_required" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Survey Date</label>
                    <input type="date" name="survey_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Survey Status</label>
                    <input type="text" name="survey_status" class="form-input" placeholder="requested/scheduled/completed">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Site Images</label>
                    <input type="file" name="site_images[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Layout File</label>
                    <input type="file" name="layout_file" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Recommended Solution (one per line)</label>
                    <textarea name="recommended_solution" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Survey</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Surveys</h3>
        </div>
        <div class="card-body">
            @if($surveys->count() === 0)
                <p class="empty-state">No surveys added yet.</p>
            @else
                @foreach($surveys as $survey)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $survey->client_name ?? 'Client' }}</strong>
                            <span>{{ $survey->survey_status ?? 'requested' }}</span>
                        </div>
                        <p class="item-desc">{{ $survey->property_address ?? 'Address not set' }}</p>

                        <form method="POST" action="{{ url('/user/security/surveys/' . $survey->id . '/status') }}" class="form-grid">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="survey_status" class="form-input" value="{{ $survey->survey_status }}" required>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Recommended Solution</label>
                                <textarea name="recommended_solution" class="form-input" rows="2">{{ is_array($survey->recommended_solution) ? implode("\n", $survey->recommended_solution) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-input" rows="2">{{ $survey->notes }}</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Update</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/security/surveys/' . $survey->id) }}" class="inline-form" onsubmit="return confirm('Delete this survey?');">
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
