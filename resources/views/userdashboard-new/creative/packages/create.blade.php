@extends('layouts.redesign.dashboard')

@section('page-title', 'Create Package')
@section('breadcrumb', 'Create Package')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Create Package</h1>
            <p>Add a new photography or event package</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('user.creative.packages.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ route('user.creative.packages.store') }}" method="POST">
        @csrf
        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-box-open"></i> Package Details</h3>
            </div>
            <div class="form-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="type">Package Type <span class="required">*</span></label>
                        <select id="type" name="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="">Select Type</option>
                            <option value="photography" {{ old('type') == 'photography' ? 'selected' : '' }}>Photography</option>
                            <option value="event" {{ old('type') == 'event' ? 'selected' : '' }}>Event</option>
                            <option value="combined" {{ old('type') == 'combined' ? 'selected' : '' }}>Combined</option>
                        </select>
                        @error('type')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">Choose the service type for this package</small>
                    </div>
                    <div class="form-group">
                        <label for="name">Package Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="e.g., Wedding Platinum Package" required>
                        @error('name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price (₹) <span class="required">*</span></label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}"
                               class="form-control @error('price') is-invalid @enderror"
                               placeholder="0.00" min="0" step="0.01" required>
                        @error('price')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" id="duration" name="duration" value="{{ old('duration') }}"
                               class="form-control @error('duration') is-invalid @enderror"
                               placeholder="e.g., 8 hours, Full day, 2 days">
                        @error('duration')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">Event duration or session length</small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Describe what this package includes...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deliverables">Deliverables</label>
                    <textarea id="deliverables" name="deliverables" rows="3"
                              class="form-control @error('deliverables') is-invalid @enderror"
                              placeholder="What will clients receive? (e.g., 500+ edited photos, online gallery, prints)">{{ old('deliverables') }}</textarea>
                    @error('deliverables')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">List what clients will receive with this package</small>
                </div>

                <div class="form-group">
                    <label>Features <span class="required">*</span></label>
                    <div id="featuresContainer">
                        @if(old('features'))
                            @foreach(old('features') as $index => $feature)
                                <div class="feature-input-group">
                                    <input type="text" name="features[]" value="{{ $feature }}"
                                           class="form-control" placeholder="e.g., Professional photographer">
                                    <button type="button" class="btn-remove-feature" onclick="removeFeature(this)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="feature-input-group">
                                <input type="text" name="features[]" class="form-control"
                                       placeholder="e.g., Professional photographer" required>
                                <button type="button" class="btn-remove-feature" onclick="removeFeature(this)">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-outline btn-sm" onclick="addFeature()">
                        <i class="fas fa-plus"></i> Add Feature
                    </button>
                    @error('features')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    @error('features.*')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Add key features included in this package</small>
                </div>

                <div class="form-group">
                    <div class="form-checkbox">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active">Active (visible to clients)</label>
                    </div>
                    @error('is_active')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Create Package
                </button>
                <a href="{{ route('user.creative.packages.index') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>

<style>
.feature-input-group {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.feature-input-group .form-control {
    flex: 1;
}

.btn-remove-feature {
    background: var(--danger-color);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-remove-feature:hover {
    background: #c0392b;
    transform: scale(1.05);
}

.form-checkbox {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.form-checkbox input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
}

.form-checkbox label {
    margin: 0;
    cursor: pointer;
    user-select: none;
}
</style>

<script>
function addFeature() {
    const container = document.getElementById('featuresContainer');
    const newFeature = document.createElement('div');
    newFeature.className = 'feature-input-group';
    newFeature.innerHTML = `
        <input type="text" name="features[]" class="form-control" placeholder="e.g., Professional photographer">
        <button type="button" class="btn-remove-feature" onclick="removeFeature(this)">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(newFeature);
}

function removeFeature(button) {
    const container = document.getElementById('featuresContainer');
    const featureGroups = container.querySelectorAll('.feature-input-group');

    if (featureGroups.length > 1) {
        button.closest('.feature-input-group').remove();
    } else {
        alert('At least one feature is required');
    }
}
</script>
@include('userdashboard-new.partials.form-page-styles')
@endsection
