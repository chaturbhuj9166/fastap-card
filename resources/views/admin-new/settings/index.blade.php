@extends('layouts.redesign.admin')

@section('page-title', 'Website Settings')
@section('breadcrumb', 'Settings')

@push('page-styles')
<style>
    .settings-grid {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: var(--space-lg);
    }

    .settings-nav {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-md);
        position: sticky;
        top: calc(var(--space-lg) + 70px);
        height: fit-content;
    }

    .settings-nav-item {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        padding: var(--space-sm) var(--space-md);
        border-radius: var(--radius-md);
        color: var(--text-secondary);
        text-decoration: none;
        transition: all var(--transition-fast);
        cursor: pointer;
    }

    .settings-nav-item:hover {
        background: var(--bg-secondary);
        color: var(--text-primary);
    }

    .settings-nav-item.active {
        background: rgba(124, 58, 237, 0.1);
        color: var(--purple-500);
    }

    .settings-content {
        display: flex;
        flex-direction: column;
        gap: var(--space-lg);
    }

    .settings-section {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
    }

    .settings-section-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .settings-section-desc {
        font-size: var(--text-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-lg);
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-lg);
        margin-bottom: var(--space-lg);
    }

    .form-row.single {
        grid-template-columns: 1fr;
    }

    .form-group {
        margin-bottom: var(--space-md);
    }

    .form-label {
        display: block;
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .form-input {
        width: 100%;
        padding: var(--space-sm) var(--space-md);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        background: var(--bg-primary);
        font-size: var(--text-base);
        color: var(--text-primary);
        transition: all var(--transition-fast);
    }

    .form-input:focus {
        outline: none;
        border-color: var(--purple-500);
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    .image-upload-area {
        border: 2px dashed var(--border-light);
        border-radius: var(--radius-lg);
        padding: var(--space-xl);
        text-align: center;
        transition: all var(--transition-fast);
        cursor: pointer;
    }

    .image-upload-area:hover {
        border-color: var(--purple-400);
        background: rgba(124, 58, 237, 0.02);
    }

    .image-preview {
        max-width: 200px;
        max-height: 100px;
        object-fit: contain;
        margin-bottom: var(--space-md);
    }

    .upload-text {
        color: var(--text-muted);
        font-size: var(--text-sm);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: var(--space-md);
        margin-top: var(--space-lg);
        padding-top: var(--space-lg);
        border-top: 1px solid var(--border-light);
    }

    @media (max-width: 992px) {
        .settings-grid {
            grid-template-columns: 1fr;
        }

        .settings-nav {
            position: static;
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-xs);
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $websetting = App\Models\websetting::first();
@endphp

<form action="{{ url('/admin/updatewebsetting') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="settings-grid">
        <!-- Settings Navigation -->
        <div class="settings-nav">
            <a href="#general" class="settings-nav-item active">
                <i class="fas fa-cog"></i> General
            </a>
            <a href="#branding" class="settings-nav-item">
                <i class="fas fa-image"></i> Branding
            </a>
            <a href="#contact" class="settings-nav-item">
                <i class="fas fa-envelope"></i> Contact Info
            </a>
            <a href="#social" class="settings-nav-item">
                <i class="fas fa-share-alt"></i> Social Links
            </a>
            <a href="#seo" class="settings-nav-item">
                <i class="fas fa-search"></i> SEO
            </a>
        </div>

        <!-- Settings Content -->
        <div class="settings-content">
            <!-- General Settings -->
            <div class="settings-section" id="general">
                <h2 class="settings-section-title">General Settings</h2>
                <p class="settings-section-desc">Configure your website's basic information</p>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Website Name</label>
                        <input type="text" name="website_name" class="form-input" value="{{ $websetting->website_name ?? 'Fastap' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tagline</label>
                        <input type="text" name="tagline" class="form-input" value="{{ $websetting->tagline ?? '' }}" placeholder="Your website tagline">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Website Description</label>
                    <textarea name="description" class="form-input form-textarea" placeholder="Brief description of your website">{{ $websetting->description ?? '' }}</textarea>
                </div>
            </div>

            <!-- Branding -->
            <div class="settings-section" id="branding">
                <h2 class="settings-section-title">Branding</h2>
                <p class="settings-section-desc">Upload your logo and favicon</p>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Logo</label>
                        <div class="image-upload-area" onclick="document.getElementById('logoInput').click()">
                            @if($websetting && $websetting->logo)
                                <img src="{{ url('uploads/system_setting/'.$websetting->logo) }}" alt="Logo" class="image-preview" id="logoPreview">
                            @else
                                <img src="{{ asset('assets/images/placeholder.png') }}" alt="Logo" class="image-preview" id="logoPreview">
                            @endif
                            <p class="upload-text">Click to upload logo</p>
                            <input type="file" name="logo" id="logoInput" accept="image/*" style="display: none;" onchange="previewImage(this, 'logoPreview')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Favicon</label>
                        <div class="image-upload-area" onclick="document.getElementById('faviconInput').click()">
                            @if($websetting && $websetting->favicon)
                                <img src="{{ url('uploads/system_setting/'.$websetting->favicon) }}" alt="Favicon" class="image-preview" id="faviconPreview">
                            @else
                                <img src="{{ asset('assets/images/placeholder.png') }}" alt="Favicon" class="image-preview" id="faviconPreview">
                            @endif
                            <p class="upload-text">Click to upload favicon</p>
                            <input type="file" name="favicon" id="faviconInput" accept="image/*" style="display: none;" onchange="previewImage(this, 'faviconPreview')">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="settings-section" id="contact">
                <h2 class="settings-section-title">Contact Information</h2>
                <p class="settings-section-desc">Your business contact details</p>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" value="{{ $websetting->email ?? '' }}" placeholder="contact@example.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-input" value="{{ $websetting->phone ?? '' }}" placeholder="+91 1234567890">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">WhatsApp Number</label>
                        <input type="text" name="whatsapp" class="form-input" value="{{ $websetting->whatsapp ?? '' }}" placeholder="+91 1234567890">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Support Email</label>
                        <input type="email" name="support_email" class="form-input" value="{{ $websetting->support_email ?? '' }}" placeholder="support@example.com">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-input form-textarea" placeholder="Your business address">{{ $websetting->address ?? '' }}</textarea>
                </div>
            </div>

            <!-- Social Links -->
            <div class="settings-section" id="social">
                <h2 class="settings-section-title">Social Media Links</h2>
                <p class="settings-section-desc">Connect your social media profiles</p>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-facebook" style="color: #1877f2;"></i> Facebook</label>
                        <input type="url" name="facebook" class="form-input" value="{{ $websetting->facebook ?? '' }}" placeholder="https://facebook.com/yourpage">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-instagram" style="color: #e4405f;"></i> Instagram</label>
                        <input type="url" name="instagram" class="form-input" value="{{ $websetting->instagram ?? '' }}" placeholder="https://instagram.com/yourpage">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-twitter" style="color: #1da1f2;"></i> Twitter</label>
                        <input type="url" name="twitter" class="form-input" value="{{ $websetting->twitter ?? '' }}" placeholder="https://twitter.com/yourpage">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-linkedin" style="color: #0077b5;"></i> LinkedIn</label>
                        <input type="url" name="linkedin" class="form-input" value="{{ $websetting->linkedin ?? '' }}" placeholder="https://linkedin.com/company/yourpage">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-youtube" style="color: #ff0000;"></i> YouTube</label>
                        <input type="url" name="youtube" class="form-input" value="{{ $websetting->youtube ?? '' }}" placeholder="https://youtube.com/channel/yourpage">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-pinterest" style="color: #bd081c;"></i> Pinterest</label>
                        <input type="url" name="pinterest" class="form-input" value="{{ $websetting->pinterest ?? '' }}" placeholder="https://pinterest.com/yourpage">
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="settings-section" id="seo">
                <h2 class="settings-section-title">SEO Settings</h2>
                <p class="settings-section-desc">Optimize your website for search engines</p>

                <div class="form-group">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-input" value="{{ $websetting->meta_title ?? '' }}" placeholder="Your website title for search engines">
                </div>

                <div class="form-group">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-input form-textarea" placeholder="Brief description for search engines (150-160 characters)">{{ $websetting->meta_description ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-input" value="{{ $websetting->meta_keywords ?? '' }}" placeholder="keyword1, keyword2, keyword3">
                </div>

                <div class="form-group">
                    <label class="form-label">Google Analytics ID</label>
                    <input type="text" name="google_analytics" class="form-input" value="{{ $websetting->google_analytics ?? '' }}" placeholder="UA-XXXXXXXX-X or G-XXXXXXXX">
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-ghost" onclick="window.location.reload()">Reset</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
</form>

@push('page-scripts')
<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Smooth scroll to sections
document.querySelectorAll('.settings-nav-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();

        // Update active state
        document.querySelectorAll('.settings-nav-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');

        // Scroll to section
        const target = this.getAttribute('href');
        document.querySelector(target).scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });
});
</script>
@endpush
@endsection
