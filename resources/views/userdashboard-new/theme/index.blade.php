@extends('layouts.redesign.dashboard')

@section('title', 'Profile Theme')

@section('dashboard-content')
<div class="content-page">
    <!-- Page Header -->
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Profile Theme</h1>
            <p class="content-subtitle">Choose a theme that best represents your profession</p>
        </div>
        <div class="content-header-right">
            <a href="{{ url('/'.$userdata->slug) }}" target="_blank" class="btn btn-outline">
                <i class="fas fa-external-link-alt"></i> View Live Profile
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
    @endif

    <!-- Current Theme -->
    @if($currentTheme)
    <div class="card mb-4">
        <div class="card-body">
            <div class="current-theme-display">
                <div class="current-theme-info">
                    <div class="current-theme-icon" style="background: {{ $currentTheme->color }};">
                        <i class="fas {{ $currentTheme->icon }}"></i>
                    </div>
                    <div class="current-theme-details">
                        <span class="current-theme-label">Current Theme</span>
                        <h3 class="current-theme-name">{{ $currentTheme->name }}</h3>
                        <p class="current-theme-desc">{{ $currentTheme->description }}</p>
                    </div>
                </div>
                <a href="{{ url('/'.$userdata->slug) }}" target="_blank" class="btn btn-primary">
                    <i class="fas fa-eye"></i> View Live Profile
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Theme Selection Grid -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-th-large"></i> Available Themes
            </h3>
            <p class="card-subtitle">Select a theme to customize your digital business card</p>
        </div>
        <div class="card-body">
            <div class="theme-grid">
                @foreach($themes as $theme)
                <div class="theme-card {{ $currentTheme && $currentTheme->id == $theme->id ? 'theme-card-active' : '' }}"
                     data-theme-id="{{ $theme->id }}">
                    <div class="theme-card-preview" style="background: linear-gradient(135deg, {{ $theme->color }} 0%, {{ $theme->color }}dd 100%);">
                        <div class="theme-card-icon">
                            <i class="fas {{ $theme->icon }}"></i>
                        </div>
                        @if($currentTheme && $currentTheme->id == $theme->id)
                        <div class="theme-card-badge">
                            <i class="fas fa-check"></i> Active
                        </div>
                        @endif
                    </div>
                    <div class="theme-card-content">
                        <h4 class="theme-card-name">{{ $theme->name }}</h4>
                        <p class="theme-card-desc">{{ Str::limit($theme->description, 60) }}</p>
                        <div class="theme-card-actions">
                            @if($currentTheme && $currentTheme->id == $theme->id)
                                <span class="btn btn-sm btn-success disabled">
                                    <i class="fas fa-check"></i> Selected
                                </span>
                            @else
                                <form action="{{ url('/profile-theme/select') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-check"></i> Select
                                    </button>
                                </form>
                            @endif
                            <button type="button" class="btn btn-sm btn-outline" onclick="previewTheme({{ $theme->id }}, '{{ $theme->name }}', '{{ $theme->description }}', '{{ $theme->color }}', '{{ $theme->icon }}')">
                                <i class="fas fa-eye"></i> Preview
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Restaurant Theme Notice -->
    @if($currentTheme && $currentTheme->id == 13)
    <div class="card mt-4">
        <div class="card-body">
            <div class="restaurant-notice">
                <div class="restaurant-notice-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="restaurant-notice-content">
                    <h4>Restaurant Theme Features</h4>
                    <p>You've selected the Restaurant/Hotel theme. This theme includes special features for menu management.</p>
                    <a href="{{ url('/menu-management') }}" class="btn btn-primary">
                        <i class="fas fa-book-open"></i> Manage Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Theme Customization -->
    @if($currentTheme)
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-sliders-h"></i> Customize Your Card
            </h3>
            <p class="card-subtitle">Personalize colors and styles for your digital business card</p>
        </div>
        <div class="card-body">
            <div class="customization-grid">
                <!-- Customization Options -->
                <div class="customization-options">
                    <form action="{{ url('/profile-theme/customize') }}" method="POST" id="customizeForm">
                        @csrf
                        @php
                            $customization = $userdata->theme_customization ?? [];
                            if (is_string($customization)) {
                                $customization = json_decode($customization, true) ?? [];
                            }
                        @endphp

                        <!-- Color Scheme -->
                        <div class="customize-section">
                            <h4><i class="fas fa-palette"></i> Color Scheme</h4>
                            <div class="color-options">
                                <div class="color-option">
                                    <label for="primaryColor">Primary Color</label>
                                    <div class="color-input-group">
                                        <input type="color" id="primaryColor" name="primary_color" value="{{ $customization['primary_color'] ?? $currentTheme->color }}" onchange="updatePreview()">
                                        <input type="text" class="color-text" value="{{ $customization['primary_color'] ?? $currentTheme->color }}" readonly>
                                    </div>
                                </div>
                                <div class="color-option">
                                    <label for="accentColor">Accent Color</label>
                                    <div class="color-input-group">
                                        <input type="color" id="accentColor" name="accent_color" value="{{ $customization['accent_color'] ?? '#f59e0b' }}" onchange="updatePreview()">
                                        <input type="text" class="color-text" value="{{ $customization['accent_color'] ?? '#f59e0b' }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="preset-colors">
                                <span class="preset-label">Presets:</span>
                                <button type="button" class="preset-btn" style="background: #7C3AED;" onclick="setColors('#7C3AED', '#F59E0B')"></button>
                                <button type="button" class="preset-btn" style="background: #3B82F6;" onclick="setColors('#3B82F6', '#10B981')"></button>
                                <button type="button" class="preset-btn" style="background: #EF4444;" onclick="setColors('#EF4444', '#F97316')"></button>
                                <button type="button" class="preset-btn" style="background: #10B981;" onclick="setColors('#10B981', '#06B6D4')"></button>
                                <button type="button" class="preset-btn" style="background: #8B5CF6;" onclick="setColors('#8B5CF6', '#EC4899')"></button>
                            </div>
                        </div>

                        <!-- Button Style -->
                        <div class="customize-section">
                            <h4><i class="fas fa-hand-pointer"></i> Button Style</h4>
                            <div class="button-style-options">
                                <label class="style-option">
                                    <input type="radio" name="button_style" value="rounded" {{ ($customization['button_style'] ?? 'rounded') == 'rounded' ? 'checked' : '' }} onchange="updatePreview()">
                                    <span class="style-preview style-rounded">Rounded</span>
                                </label>
                                <label class="style-option">
                                    <input type="radio" name="button_style" value="pill" {{ ($customization['button_style'] ?? '') == 'pill' ? 'checked' : '' }} onchange="updatePreview()">
                                    <span class="style-preview style-pill">Pill</span>
                                </label>
                                <label class="style-option">
                                    <input type="radio" name="button_style" value="square" {{ ($customization['button_style'] ?? '') == 'square' ? 'checked' : '' }} onchange="updatePreview()">
                                    <span class="style-preview style-square">Square</span>
                                </label>
                            </div>
                        </div>

                        <!-- Display Options -->
                        <div class="customize-section">
                            <h4><i class="fas fa-eye"></i> Display Options</h4>
                            <div class="toggle-options">
                                <label class="toggle-option">
                                    <span>Show Social Icons</span>
                                    <input type="checkbox" name="show_social" value="1" {{ ($customization['show_social'] ?? true) ? 'checked' : '' }} onchange="updatePreview()">
                                    <span class="toggle-slider"></span>
                                </label>
                                <label class="toggle-option">
                                    <span>Show Contact Buttons</span>
                                    <input type="checkbox" name="show_contact_buttons" value="1" {{ ($customization['show_contact_buttons'] ?? true) ? 'checked' : '' }} onchange="updatePreview()">
                                    <span class="toggle-slider"></span>
                                </label>
                                <label class="toggle-option">
                                    <span>Show Save Contact Button</span>
                                    <input type="checkbox" name="show_save_contact" value="1" {{ ($customization['show_save_contact'] ?? true) ? 'checked' : '' }} onchange="updatePreview()">
                                    <span class="toggle-slider"></span>
                                </label>
                                <label class="toggle-option">
                                    <span>Show Share Button</span>
                                    <input type="checkbox" name="show_share" value="1" {{ ($customization['show_share'] ?? true) ? 'checked' : '' }} onchange="updatePreview()">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="customize-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Customization
                            </button>
                            <button type="button" class="btn btn-outline" onclick="resetCustomization()">
                                <i class="fas fa-undo"></i> Reset to Default
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Live Preview -->
                <div class="live-preview-panel">
                    <div class="preview-header">
                        <h4><i class="fas fa-mobile-alt"></i> Live Preview</h4>
                    </div>
                    <div class="phone-mockup">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="preview-card" id="previewCard">
                                    <div class="preview-card-header" id="previewCardHeader" style="background: linear-gradient(135deg, {{ $customization['primary_color'] ?? $currentTheme->color }} 0%, {{ $customization['primary_color'] ?? $currentTheme->color }}dd 100%);">
                                        <div class="preview-card-avatar">
                                            @if(session('FRONT_USER_PROFILE'))
                                            <img src="{{ asset(session('FRONT_USER_PROFILE')) }}" alt="Profile">
                                            @else
                                            <i class="fas fa-user"></i>
                                            @endif
                                        </div>
                                        <h3 class="preview-card-name">{{ $userdata->name ?? 'Your Name' }}</h3>
                                        <p class="preview-card-title">{{ $userdata->designation ?? 'Your Title' }}</p>
                                    </div>
                                    <div class="preview-card-body">
                                        <div class="preview-card-buttons" id="previewButtons">
                                            <a class="preview-btn" style="border-radius: {{ ($customization['button_style'] ?? 'rounded') == 'pill' ? '50px' : (($customization['button_style'] ?? '') == 'square' ? '4px' : '8px') }};">
                                                <i class="fas fa-phone"></i> Call
                                            </a>
                                            <a class="preview-btn" style="border-radius: {{ ($customization['button_style'] ?? 'rounded') == 'pill' ? '50px' : (($customization['button_style'] ?? '') == 'square' ? '4px' : '8px') }};">
                                                <i class="fas fa-envelope"></i> Email
                                            </a>
                                            <a class="preview-btn" style="border-radius: {{ ($customization['button_style'] ?? 'rounded') == 'pill' ? '50px' : (($customization['button_style'] ?? '') == 'square' ? '4px' : '8px') }};">
                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                            </a>
                                        </div>
                                        <div class="preview-card-social" id="previewSocial">
                                            <a class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                            <a class="social-icon"><i class="fab fa-instagram"></i></a>
                                            <a class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                            <a class="social-icon"><i class="fab fa-twitter"></i></a>
                                        </div>
                                        <div class="preview-card-action" id="previewSaveContact">
                                            <a class="preview-save-btn" id="previewSaveBtn" style="background: {{ $customization['primary_color'] ?? $currentTheme->color }}; border-radius: {{ ($customization['button_style'] ?? 'rounded') == 'pill' ? '50px' : (($customization['button_style'] ?? '') == 'square' ? '4px' : '8px') }};">
                                                <i class="fas fa-user-plus"></i> Save Contact
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/'.$userdata->slug) }}" target="_blank" class="btn btn-outline btn-block mt-3">
                        <i class="fas fa-external-link-alt"></i> View Full Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Theme Preview Modal -->
<div class="modal" id="themePreviewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="previewThemeName">Theme Preview</h4>
                <button type="button" class="modal-close" onclick="closePreviewModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="theme-preview-iframe-container">
                    <div class="preview-loader" id="previewLoader">
                        <i class="fas fa-spinner fa-spin"></i>
                        <p>Loading preview...</p>
                    </div>
                    <iframe id="themePreviewFrame" style="width: 100%; height: 600px; border: none; display: none;" onload="hidePreviewLoader()"></iframe>
                </div>
                <div class="theme-preview-info" style="margin-top: 20px; padding: 20px; background: var(--bg-secondary); border-radius: var(--radius-lg); text-align: center;">
                    <div class="preview-icon-large" id="previewIconLarge" style="width: 60px; height: 60px; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: white;">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3 id="previewThemeTitle" style="margin-bottom: 8px;">Theme Name</h3>
                    <p id="previewThemeDesc" style="color: var(--text-secondary); margin-bottom: 0;">Theme description goes here.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closePreviewModal()">Close</button>
                <form action="{{ url('/profile-theme/select') }}" method="POST" id="previewSelectForm">
                    @csrf
                    <input type="hidden" name="theme_id" id="previewThemeId">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Select This Theme
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Scoped CSS variables for modal only */
    #themePreviewModal {
        --card-bg: #ffffff;
        --bg-secondary: #f3f4f6;
        --border-color: #e5e7eb;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --primary-color: #7c3aed;
        --success-color: #10b981;
        --radius-lg: 0.75rem;
    }

    .current-theme-display {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    .current-theme-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .current-theme-icon {
        width: 60px;
        height: 60px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }
    .current-theme-label {
        font-size: 0.75rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .current-theme-name {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0.25rem 0;
    }
    .current-theme-desc {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin: 0;
    }

    .theme-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    .theme-card {
        background: var(--card-bg);
        border: 2px solid var(--border-color);
        border-radius: 1rem;
        overflow: hidden;
        transition: all 0.3s;
    }
    .theme-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .theme-card-active {
        border-color: var(--success-color);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }
    .theme-card-preview {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .theme-card-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }
    .theme-card-badge {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background: var(--success-color);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .theme-card-content {
        padding: 1rem;
    }
    .theme-card-name {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .theme-card-desc {
        color: var(--text-secondary);
        font-size: 0.8rem;
        margin-bottom: 1rem;
        min-height: 2.5rem;
    }
    .theme-card-actions {
        display: flex;
        gap: 0.5rem;
    }
    .theme-card-actions .btn {
        flex: 1;
    }

    .restaurant-notice {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1rem;
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-radius: 0.75rem;
    }
    .restaurant-notice-icon {
        width: 60px;
        height: 60px;
        background: #f59e0b;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .restaurant-notice-content h4 {
        margin: 0 0 0.5rem;
        color: #92400e;
    }
    .restaurant-notice-content p {
        margin: 0 0 1rem;
        color: #a16207;
        font-size: 0.9rem;
    }

    /* Modal Styles - Force proper sizing and visibility */
    #themePreviewModal {
        display: none;
        position: fixed;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(0, 0, 0, 0.7) !important;
        z-index: 999999 !important;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow-y: auto;
        transform: none !important;
        margin: 0 !important;
        opacity: 1 !important;
    }
    #themePreviewModal.show {
        display: flex !important;
        opacity: 1 !important;
    }
    #themePreviewModal .modal-dialog {
        width: 90%;
        max-width: 700px;
        margin: auto;
        transform: none !important;
        flex-shrink: 0;
    }
    #themePreviewModal .modal-content {
        background: var(--card-bg, #ffffff);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        visibility: visible !important;
    }
    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color, #e5e7eb);
    }
    .modal-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }
    .modal-close {
        background: none;
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: background 0.2s;
    }
    .modal-close:hover {
        background: var(--bg-secondary);
    }
    .modal-body {
        padding: 1.5rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    @media (max-width: 600px) {
        .modal-body {
            grid-template-columns: 1fr;
        }
    }
    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .theme-preview-container {
        background: var(--bg-secondary);
        border-radius: 0.75rem;
        overflow: hidden;
    }

    /* Preview Iframe Container */
    .theme-preview-iframe-container {
        position: relative;
        min-height: 600px;
        background: var(--bg-secondary);
        border-radius: 0.75rem;
        overflow: hidden;
    }
    .preview-loader {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 600px;
        color: var(--text-secondary);
    }
    .preview-loader i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--primary-color);
    }

    .theme-preview-header {
        padding: 2rem 1rem;
        text-align: center;
        color: white;
    }
    .preview-avatar {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        font-size: 1.5rem;
    }
    .preview-name {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0 0 0.25rem;
    }
    .preview-title {
        opacity: 0.9;
        font-size: 0.9rem;
        margin: 0;
    }
    .theme-preview-body {
        padding: 1rem;
        background: var(--card-bg);
    }
    .preview-section {
        margin-bottom: 1rem;
    }
    .preview-section:last-child {
        margin-bottom: 0;
    }
    .preview-section h5 {
        font-size: 0.8rem;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
    }
    .preview-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
    }
    .preview-tag {
        padding: 0.25rem 0.5rem;
        background: var(--bg-secondary);
        border-radius: 0.25rem;
        font-size: 0.75rem;
    }
    .preview-contact {
        color: var(--text-secondary);
        font-size: 0.8rem;
        margin: 0;
    }

    .theme-preview-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 1rem;
    }
    .preview-icon-large {
        width: 80px;
        height: 80px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin-bottom: 1rem;
    }
    .theme-preview-info h3 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .theme-preview-info p {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin: 0;
    }

    .btn-sm {
        padding: 0.4rem 0.75rem;
        font-size: 0.8rem;
    }
    .btn-success {
        background: var(--success-color);
        color: white;
    }
    .btn.disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }
    .mt-4 {
        margin-top: 1.5rem;
    }
    .mt-3 {
        margin-top: 1rem;
    }
    .btn-block {
        display: block;
        width: 100%;
        text-align: center;
    }

    /* Customization Grid */
    .customization-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 2rem;
    }
    @media (max-width: 900px) {
        .customization-grid {
            grid-template-columns: 1fr;
        }
        .live-preview-panel {
            order: -1;
        }
    }

    .customization-options {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .customize-section {
        padding: 1.25rem;
        background: var(--bg-secondary);
        border-radius: 0.75rem;
    }
    .customize-section h4 {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .customize-section h4 i {
        color: var(--primary-color);
    }

    /* Color Options */
    .color-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .color-option label {
        display: block;
        font-size: 0.8rem;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
    }
    .color-input-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .color-input-group input[type="color"] {
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        padding: 0;
    }
    .color-text {
        flex: 1;
        padding: 0.5rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 0.8rem;
        background: var(--card-bg);
        font-family: monospace;
    }

    .preset-colors {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }
    .preset-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }
    .preset-btn {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        cursor: pointer;
        transition: transform 0.2s;
    }
    .preset-btn:hover {
        transform: scale(1.15);
    }

    /* Button Style Options */
    .button-style-options {
        display: flex;
        gap: 1rem;
    }
    .style-option {
        flex: 1;
        cursor: pointer;
    }
    .style-option input {
        display: none;
    }
    .style-preview {
        display: block;
        padding: 0.75rem;
        text-align: center;
        border: 2px solid var(--border-color);
        background: var(--card-bg);
        font-size: 0.8rem;
        transition: all 0.2s;
    }
    .style-rounded {
        border-radius: 0.5rem;
    }
    .style-pill {
        border-radius: 2rem;
    }
    .style-square {
        border-radius: 0.25rem;
    }
    .style-option input:checked + .style-preview {
        border-color: var(--primary-color);
        background: rgba(124, 58, 237, 0.1);
        color: var(--primary-color);
    }

    /* Toggle Options */
    .toggle-options {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .toggle-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem;
        background: var(--card-bg);
        border-radius: 0.5rem;
        cursor: pointer;
    }
    .toggle-option span:first-child {
        font-size: 0.9rem;
    }
    .toggle-option input {
        display: none;
    }
    .toggle-slider {
        width: 44px;
        height: 24px;
        background: var(--border-color);
        border-radius: 12px;
        position: relative;
        transition: background 0.2s;
    }
    .toggle-slider::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        top: 2px;
        left: 2px;
        transition: transform 0.2s;
    }
    .toggle-option input:checked + .toggle-slider {
        background: var(--success-color);
    }
    .toggle-option input:checked + .toggle-slider::after {
        transform: translateX(20px);
    }

    .customize-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    /* Phone Mockup */
    .live-preview-panel {
        position: sticky;
        top: 1rem;
    }
    .preview-header {
        text-align: center;
        margin-bottom: 1rem;
    }
    .preview-header h4 {
        font-size: 0.9rem;
        color: var(--text-secondary);
    }
    .phone-mockup {
        display: flex;
        justify-content: center;
    }
    .phone-frame {
        width: 280px;
        background: #1a1a1a;
        border-radius: 2.5rem;
        padding: 0.75rem;
        box-shadow: 0 25px 50px rgba(0,0,0,0.25);
    }
    .phone-notch {
        width: 100px;
        height: 25px;
        background: #1a1a1a;
        border-radius: 0 0 1rem 1rem;
        margin: 0 auto -12px;
        position: relative;
        z-index: 1;
    }
    .phone-screen {
        background: var(--card-bg);
        border-radius: 2rem;
        overflow: hidden;
        min-height: 400px;
    }

    /* Preview Card */
    .preview-card {
        height: 100%;
    }
    .preview-card-header {
        padding: 2rem 1rem 1.5rem;
        text-align: center;
        color: white;
    }
    .preview-card-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        font-size: 1.5rem;
        overflow: hidden;
    }
    .preview-card-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .preview-card-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0 0 0.25rem;
    }
    .preview-card-title {
        font-size: 0.8rem;
        opacity: 0.9;
        margin: 0;
    }
    .preview-card-body {
        padding: 1rem;
    }
    .preview-card-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    .preview-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.6rem;
        background: var(--bg-secondary);
        border-radius: 0.5rem;
        font-size: 0.8rem;
        color: var(--text-primary);
        text-decoration: none;
    }
    .preview-card-social {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    .social-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--bg-secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    .preview-card-action {
        text-align: center;
    }
    .preview-save-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        color: white;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        width: 100%;
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .alert-success {
        background: #d1fae5;
        color: #065f46;
    }
    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }
</style>

<script>
function previewTheme(id, name, description, color, icon) {
    console.log('previewTheme called with:', {id, name, description, color, icon});

    try {
        // Update modal header and theme info
        document.getElementById('previewThemeName').textContent = name + ' Preview';
        document.getElementById('previewThemeTitle').textContent = name;
        document.getElementById('previewThemeDesc').textContent = description;
        document.getElementById('previewThemeId').value = id;
        document.getElementById('previewIconLarge').style.background = color;
        document.getElementById('previewIconLarge').innerHTML = '<i class="fas ' + icon + '"></i>';

        // Show loader and hide iframe
        document.getElementById('previewLoader').style.display = 'block';
        document.getElementById('themePreviewFrame').style.display = 'none';

        // Load actual theme preview in iframe
        document.getElementById('themePreviewFrame').src = '/theme-live-preview/' + id;

        // Move modal to body level (outside dashboard container)
        const modal = document.getElementById('themePreviewModal');
        if (modal.parentElement !== document.body) {
            document.body.appendChild(modal);
        }

        // Show modal
        console.log('Modal element:', modal);
        modal.classList.add('show');
        console.log('Modal should now be visible');
    } catch (error) {
        console.error('Error in previewTheme:', error);
        alert('Error opening preview: ' + error.message);
    }
}

function hidePreviewLoader() {
    document.getElementById('previewLoader').style.display = 'none';
    document.getElementById('themePreviewFrame').style.display = 'block';
}

function closePreviewModal() {
    document.getElementById('themePreviewModal').classList.remove('show');
    // Clear iframe src to stop loading
    setTimeout(function() {
        document.getElementById('themePreviewFrame').src = 'about:blank';
    }, 300);
}

// Close modal on backdrop click
document.getElementById('themePreviewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePreviewModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePreviewModal();
    }
});

// Customization Functions
function setColors(primary, accent) {
    document.getElementById('primaryColor').value = primary;
    document.getElementById('accentColor').value = accent;
    document.querySelector('#primaryColor + .color-text').value = primary;
    document.querySelector('#accentColor + .color-text').value = accent;
    updatePreview();
}

function updatePreview() {
    const primaryColor = document.getElementById('primaryColor')?.value || '#7C3AED';
    const accentColor = document.getElementById('accentColor')?.value || '#f59e0b';
    const buttonStyle = document.querySelector('input[name="button_style"]:checked')?.value || 'rounded';
    const showSocial = document.querySelector('input[name="show_social"]')?.checked ?? true;
    const showContactButtons = document.querySelector('input[name="show_contact_buttons"]')?.checked ?? true;
    const showSaveContact = document.querySelector('input[name="show_save_contact"]')?.checked ?? true;

    // Update color text fields
    const primaryText = document.querySelector('#primaryColor + .color-text');
    const accentText = document.querySelector('#accentColor + .color-text');
    if (primaryText) primaryText.value = primaryColor;
    if (accentText) accentText.value = accentColor;

    // Update preview header
    const previewHeader = document.getElementById('previewCardHeader');
    if (previewHeader) {
        previewHeader.style.background = `linear-gradient(135deg, ${primaryColor} 0%, ${primaryColor}dd 100%)`;
    }

    // Update save button
    const saveBtn = document.getElementById('previewSaveBtn');
    if (saveBtn) {
        saveBtn.style.background = primaryColor;
        saveBtn.style.borderRadius = buttonStyle === 'pill' ? '50px' : (buttonStyle === 'square' ? '4px' : '8px');
    }

    // Update button styles
    const previewBtns = document.querySelectorAll('.preview-btn');
    previewBtns.forEach(btn => {
        btn.style.borderRadius = buttonStyle === 'pill' ? '50px' : (buttonStyle === 'square' ? '4px' : '8px');
    });

    // Toggle visibility
    const socialSection = document.getElementById('previewSocial');
    const buttonsSection = document.getElementById('previewButtons');
    const saveContactSection = document.getElementById('previewSaveContact');

    if (socialSection) socialSection.style.display = showSocial ? 'flex' : 'none';
    if (buttonsSection) buttonsSection.style.display = showContactButtons ? 'flex' : 'none';
    if (saveContactSection) saveContactSection.style.display = showSaveContact ? 'block' : 'none';
}

function resetCustomization() {
    if (confirm('Reset all customization to default theme settings?')) {
        const themeColor = '{{ $currentTheme->color ?? "#7C3AED" }}';
        document.getElementById('primaryColor').value = themeColor;
        document.getElementById('accentColor').value = '#f59e0b';
        document.querySelector('input[name="button_style"][value="rounded"]').checked = true;
        document.querySelectorAll('.toggle-option input').forEach(cb => cb.checked = true);
        updatePreview();
    }
}

// Initialize preview on page load
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('previewCard')) {
        updatePreview();
    }
});
</script>
@endsection
