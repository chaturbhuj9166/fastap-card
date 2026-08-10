@extends('layouts.redesign.dashboard')

@section('title', 'Solar Site Surveys')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Site Surveys</h1>
            <p class="content-subtitle">Track survey requests and findings</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Survey</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/solar/surveys') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Property Type</label>
                    <input type="text" name="property_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Property Address</label>
                    <input type="text" name="property_address" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Roof Area (sqft)</label>
                    <input type="number" name="roof_area_sqft" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Monthly Units</label>
                    <input type="number" name="monthly_power_consumption_units" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Monthly Bill</label>
                    <input type="number" name="current_electricity_bill" class="form-input" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Google Map Location</label>
                    <input type="text" name="google_map_location" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Roof Images</label>
                    <input type="file" name="roof_images[]" class="form-input" multiple>
                </div>
                <div class="form-group">
                    <label class="form-label">Shadow Analysis File</label>
                    <input type="file" name="shadow_analysis_file" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Survey Date</label>
                    <input type="date" name="survey_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Survey Status</label>
                    <input type="text" name="survey_status" class="form-input" placeholder="requested/scheduled/completed">
                </div>
                <div class="form-group">
                    <label class="form-label">Recommended Capacity (kW)</label>
                    <input type="number" name="recommended_capacity_kw" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Estimated Generation (monthly)</label>
                    <input type="number" name="estimated_generation_monthly" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Estimated Savings (yearly)</label>
                    <input type="number" name="estimated_savings_yearly" class="form-input" step="0.01" min="0">
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
                <p class="empty-state">No surveys yet.</p>
            @else
                @foreach($surveys as $survey)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $survey->client_name }}</strong>
                            <span>{{ $survey->survey_status }}</span>
                        </div>
                        <p class="item-desc">{{ $survey->property_address ?? 'No address provided.' }}</p>

                        <form method="POST" action="{{ url('/user/solar/surveys/' . $survey->id . '/status') }}" class="form-grid">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="survey_status" class="form-input" value="{{ $survey->survey_status }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Recommended Capacity</label>
                                <input type="number" name="recommended_capacity_kw" class="form-input" value="{{ $survey->recommended_capacity_kw }}" step="0.01" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Estimated Generation</label>
                                <input type="number" name="estimated_generation_monthly" class="form-input" value="{{ $survey->estimated_generation_monthly }}" step="0.01" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Estimated Savings</label>
                                <input type="number" name="estimated_savings_yearly" class="form-input" value="{{ $survey->estimated_savings_yearly }}" step="0.01" min="0">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-input" rows="2">{{ $survey->notes }}</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Update</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/solar/surveys/' . $survey->id) }}" class="inline-form" onsubmit="return confirm('Delete this survey?');">
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
