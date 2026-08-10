@extends('layouts.redesign.dashboard')

@section('page-title', 'Talent Profile Settings')
@section('breadcrumb', 'Talent Profiles')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Talent Profile Settings</h1>
            <p>Select which talent types you want to showcase on your profile</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ route('talent.profiles.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-star"></i> Active Talent Profiles</h3>
            </div>
            <div class="form-card-body">
                <p class="profile-info-text">Enable the talent profiles you want to display on your page. Select one as your default profile to be shown first.</p>

                <div class="profiles-grid">
                    @php
                        $talentTypes = [
                            'actor' => ['icon' => 'fa-theater-masks', 'label' => 'Actor', 'description' => 'Film, TV, Theatre'],
                            'model' => ['icon' => 'fa-user-tie', 'label' => 'Model', 'description' => 'Fashion, Commercial, Runway'],
                            'singer' => ['icon' => 'fa-microphone', 'label' => 'Singer', 'description' => 'Vocals, Live Performance'],
                            'dancer' => ['icon' => 'fa-person-running', 'label' => 'Dancer', 'description' => 'Contemporary, Classical, Hip-Hop'],
                            'youtuber' => ['icon' => 'fa-youtube', 'label' => 'YouTuber', 'description' => 'Content Creator, Vlogger'],
                            'music_producer' => ['icon' => 'fa-headphones', 'label' => 'Music Producer', 'description' => 'Mixing, Mastering, Production'],
                            'anchor' => ['icon' => 'fa-podcast', 'label' => 'Anchor', 'description' => 'TV, Radio, Events'],
                            'influencer' => ['icon' => 'fa-bullhorn', 'label' => 'Influencer', 'description' => 'Social Media, Brand Collaboration'],
                            'custom' => ['icon' => 'fa-wand-magic-sparkles', 'label' => 'Custom Talent', 'description' => 'Other Performing Arts']
                        ];
                    @endphp

                    @foreach($talentTypes as $type => $config)
                    <!-- {{ ucfirst(str_replace('_', ' ', $type)) }} Profile -->
                    <div class="profile-option-card">
                        <div class="profile-checkbox">
                            <input type="checkbox" id="{{ $type }}" name="profiles[]" value="{{ $type }}"
                                {{ in_array($type, $activeProfiles ?? []) ? 'checked' : '' }}>
                            <label for="{{ $type }}" class="profile-label">
                                <div class="profile-icon {{ $type }}">
                                    <i class="fas {{ $config['icon'] }}"></i>
                                </div>
                                <div class="profile-info">
                                    <h4>{{ $config['label'] }}</h4>
                                    <p>{{ $config['description'] }}</p>
                                </div>
                            </label>
                        </div>
                        <div class="profile-default">
                            <input type="radio" id="default_{{ $type }}" name="default_profile" value="{{ $type }}"
                                {{ ($defaultProfile ?? '') === $type ? 'checked' : '' }}>
                            <label for="default_{{ $type }}">Set as Default</label>
                        </div>
                    </div>
                    @endforeach
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
    font-size: 1.5rem;
    color: white;
    transition: all 0.3s ease;
}

.profile-icon.actor {
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.profile-icon.model {
    background: linear-gradient(135deg, #f093fb, #f5576c);
}

.profile-icon.singer {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
}

.profile-icon.dancer {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
}

.profile-icon.youtuber {
    background: linear-gradient(135deg, #fa709a, #fee140);
}

.profile-icon.music_producer {
    background: linear-gradient(135deg, #30cfd0, #330867);
}

.profile-icon.anchor {
    background: linear-gradient(135deg, #a8edea, #fed6e3);
}

.profile-icon.influencer {
    background: linear-gradient(135deg, #ff9a9e, #fecfef);
}

.profile-icon.custom {
    background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
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
