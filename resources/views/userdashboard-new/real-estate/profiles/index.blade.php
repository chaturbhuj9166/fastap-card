@extends('layouts.redesign.dashboard')

@section('page-title', 'Profile Settings')
@section('breadcrumb', 'Real Estate Profiles')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Real Estate Profile Settings</h1>
            <p>Select which property types you want to showcase</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ route('real-estate.profiles.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-building"></i> Active Profiles</h3>
            </div>
            <div class="form-card-body">
                <p class="profile-info-text">Enable the property profiles you want to display on your page. Select one as your default profile.</p>

                <div class="profiles-grid">
                    <!-- Residential Profile -->
                    <div class="profile-option-card">
                        <div class="profile-checkbox">
                            <input type="checkbox" id="residential" name="profiles[]" value="residential"
                                {{ in_array('residential', $activeProfiles ?? []) ? 'checked' : '' }}>
                            <label for="residential" class="profile-label">
                                <div class="profile-icon residential">
                                    <span>🏠</span>
                                </div>
                                <div class="profile-info">
                                    <h4>Residential</h4>
                                    <p>Houses, Apartments, Villas</p>
                                </div>
                            </label>
                        </div>
                        <div class="profile-default">
                            <input type="radio" id="default_residential" name="default_profile" value="residential"
                                {{ ($defaultProfile ?? '') === 'residential' ? 'checked' : '' }}>
                            <label for="default_residential">Set as Default</label>
                        </div>
                    </div>

                    <!-- Commercial Profile -->
                    <div class="profile-option-card">
                        <div class="profile-checkbox">
                            <input type="checkbox" id="commercial" name="profiles[]" value="commercial"
                                {{ in_array('commercial', $activeProfiles ?? []) ? 'checked' : '' }}>
                            <label for="commercial" class="profile-label">
                                <div class="profile-icon commercial">
                                    <span>🏬</span>
                                </div>
                                <div class="profile-info">
                                    <h4>Commercial</h4>
                                    <p>Offices, Shops, Showrooms</p>
                                </div>
                            </label>
                        </div>
                        <div class="profile-default">
                            <input type="radio" id="default_commercial" name="default_profile" value="commercial"
                                {{ ($defaultProfile ?? '') === 'commercial' ? 'checked' : '' }}>
                            <label for="default_commercial">Set as Default</label>
                        </div>
                    </div>

                    <!-- Plot Profile -->
                    <div class="profile-option-card">
                        <div class="profile-checkbox">
                            <input type="checkbox" id="plot" name="profiles[]" value="plot"
                                {{ in_array('plot', $activeProfiles ?? []) ? 'checked' : '' }}>
                            <label for="plot" class="profile-label">
                                <div class="profile-icon plot">
                                    <span>🌳</span>
                                </div>
                                <div class="profile-info">
                                    <h4>Plot</h4>
                                    <p>Land, Farm Plots, Sites</p>
                                </div>
                            </label>
                        </div>
                        <div class="profile-default">
                            <input type="radio" id="default_plot" name="default_profile" value="plot"
                                {{ ($defaultProfile ?? '') === 'plot' ? 'checked' : '' }}>
                            <label for="default_plot">Set as Default</label>
                        </div>
                    </div>

                    <!-- Rental Profile -->
                    <div class="profile-option-card">
                        <div class="profile-checkbox">
                            <input type="checkbox" id="rental" name="profiles[]" value="rental"
                                {{ in_array('rental', $activeProfiles ?? []) ? 'checked' : '' }}>
                            <label for="rental" class="profile-label">
                                <div class="profile-icon rental">
                                    <span>🏘️</span>
                                </div>
                                <div class="profile-info">
                                    <h4>Rental</h4>
                                    <p>Properties for Rent</p>
                                </div>
                            </label>
                        </div>
                        <div class="profile-default">
                            <input type="radio" id="default_rental" name="default_profile" value="rental"
                                {{ ($defaultProfile ?? '') === 'rental' ? 'checked' : '' }}>
                            <label for="default_rental">Set as Default</label>
                        </div>
                    </div>

                    <!-- Builder Profile -->
                    <div class="profile-option-card">
                        <div class="profile-checkbox">
                            <input type="checkbox" id="builder" name="profiles[]" value="builder"
                                {{ in_array('builder', $activeProfiles ?? []) ? 'checked' : '' }}>
                            <label for="builder" class="profile-label">
                                <div class="profile-icon builder">
                                    <span>🏗️</span>
                                </div>
                                <div class="profile-info">
                                    <h4>Builder</h4>
                                    <p>Projects, Developments</p>
                                </div>
                            </label>
                        </div>
                        <div class="profile-default">
                            <input type="radio" id="default_builder" name="default_profile" value="builder"
                                {{ ($defaultProfile ?? '') === 'builder' ? 'checked' : '' }}>
                            <label for="default_builder">Set as Default</label>
                        </div>
                    </div>
                </div>

                @error('profiles')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                @error('default_profile')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Save Profile Settings
                </button>
            </div>
        </div>
    </form>
</div>

<style>
.profile-info-text {
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
    border-left: 3px solid var(--purple-500);
}

.profiles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.25rem;
}

.profile-option-card {
    background: var(--bg-secondary);
    border: 2px solid var(--border-light);
    border-radius: var(--radius-xl);
    padding: 1.25rem;
    transition: all 0.3s ease;
}

.profile-option-card:has(input[type="checkbox"]:checked) {
    border-color: var(--purple-500);
    background: rgba(139, 92, 246, 0.05);
}

.profile-checkbox {
    margin-bottom: 1rem;
}

.profile-checkbox input[type="checkbox"] {
    display: none;
}

.profile-label {
    display: flex;
    align-items: center;
    gap: 1rem;
    cursor: pointer;
    user-select: none;
}

.profile-icon {
    width: 60px;
    height: 60px;
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    transition: all 0.3s ease;
}

.profile-icon.residential {
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.profile-icon.commercial {
    background: linear-gradient(135deg, #f093fb, #f5576c);
}

.profile-icon.plot {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
}

.profile-icon.rental {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
}

.profile-icon.builder {
    background: linear-gradient(135deg, #fa709a, #fee140);
}

.profile-checkbox input[type="checkbox"]:checked + .profile-label .profile-icon {
    transform: scale(1.1);
    box-shadow: var(--shadow-lg);
}

.profile-info h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem;
}

.profile-info p {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin: 0;
}

.profile-default {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-light);
}

.profile-default input[type="radio"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--purple-500);
}

.profile-default label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    cursor: pointer;
    user-select: none;
    margin: 0;
}

@media (max-width: 768px) {
    .profiles-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@include('userdashboard-new.partials.form-page-styles')
@endsection
