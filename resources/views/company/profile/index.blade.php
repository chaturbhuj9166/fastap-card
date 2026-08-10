@extends('layouts.redesign.company')

@section('page-title', 'Company Profile')
@section('breadcrumb', 'Profile')

@section('company-content')
<div class="profile-page">
    <div class="profile-header-card">
        <div class="profile-cover" style="background: linear-gradient(135deg, #0891b2, #06b6d4);">
            @if($company->banner)
                <img src="{{ asset('uploads/companies/' . $company->banner) }}" alt="Banner">
            @endif
        </div>
        <div class="profile-info">
            <div class="profile-avatar">
                @if($company->logo)
                    <img src="{{ asset('uploads/companies/' . $company->logo) }}" alt="{{ $company->name }}">
                @else
                    <span>{{ substr($company->name, 0, 1) }}</span>
                @endif
            </div>
            <div class="profile-details">
                <h1>{{ $company->name }}</h1>
                <p>{{ $company->industry ?? 'Company' }}</p>
                @if($company->professionTheme)
                    <span class="theme-badge" style="background: {{ $company->professionTheme->color }}20; color: {{ $company->professionTheme->color }};">
                        <i class="fas {{ $company->professionTheme->icon }}"></i>
                        {{ $company->professionTheme->name }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="profile-content">
        <div class="profile-main">
            <!-- Basic Info Form -->
            <div class="form-card">
                <div class="card-header">
                    <h3><i class="fas fa-building"></i> Company Information</h3>
                </div>
                <form action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Company Name *</label>
                                <input type="text" name="name" class="form-input" value="{{ old('name', $company->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-input" value="{{ old('phone', $company->phone) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-input" rows="3" placeholder="Tell us about your company">{{ old('description', $company->description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Industry</label>
                                <input type="text" name="industry" class="form-input" value="{{ old('industry', $company->industry) }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Website</label>
                                <input type="url" name="website" class="form-input" value="{{ old('website', $company->website) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Theme *</label>
                            <select name="profession_type" class="form-select" required>
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->id }}" {{ $company->profession_type == $theme->id ? 'selected' : '' }}>
                                        {{ $theme->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <h4 class="section-subtitle"><i class="fas fa-map-marker-alt"></i> Address</h4>

                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-input" value="{{ old('address', $company->address) }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-input" value="{{ old('city', $company->city) }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-input" value="{{ old('state', $company->state) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-input" value="{{ old('country', $company->country) }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">PIN Code</label>
                                <input type="text" name="pincode" class="form-input" value="{{ old('pincode', $company->pincode) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">GST Number</label>
                            <input type="text" name="gst_number" class="form-input" value="{{ old('gst_number', $company->gst_number) }}">
                        </div>

                        <h4 class="section-subtitle"><i class="fas fa-image"></i> Images</h4>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Company Logo</label>
                                <input type="file" name="logo" class="form-input" accept="image/*">
                                <small class="form-hint">Max 2MB. Recommended: 200x200px</small>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Banner Image</label>
                                <input type="file" name="banner" class="form-input" accept="image/*">
                                <small class="form-hint">Max 5MB. Recommended: 1200x300px</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Social Links Form -->
            <div class="form-card">
                <div class="card-header">
                    <h3><i class="fas fa-share-alt"></i> Social Media Links</h3>
                </div>
                <form action="{{ route('company.profile.social') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label"><i class="fab fa-facebook" style="color: #1877f2;"></i> Facebook</label>
                                <input type="url" name="facebook" class="form-input" value="{{ old('facebook', $company->facebook) }}" placeholder="https://facebook.com/...">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class="fab fa-instagram" style="color: #e4405f;"></i> Instagram</label>
                                <input type="url" name="instagram" class="form-input" value="{{ old('instagram', $company->instagram) }}" placeholder="https://instagram.com/...">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label"><i class="fab fa-twitter" style="color: #1da1f2;"></i> Twitter</label>
                                <input type="url" name="twitter" class="form-input" value="{{ old('twitter', $company->twitter) }}" placeholder="https://twitter.com/...">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class="fab fa-linkedin" style="color: #0a66c2;"></i> LinkedIn</label>
                                <input type="url" name="linkedin" class="form-input" value="{{ old('linkedin', $company->linkedin) }}" placeholder="https://linkedin.com/...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fab fa-youtube" style="color: #ff0000;"></i> YouTube</label>
                            <input type="url" name="youtube" class="form-input" value="{{ old('youtube', $company->youtube) }}" placeholder="https://youtube.com/...">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Social Links
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="profile-sidebar">
            <div class="info-card">
                <h4>Account Info</h4>
                <div class="info-list">
                    <div class="info-item">
                        <span class="label">Email</span>
                        <span class="value">{{ $company->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Plan</span>
                        <span class="value badge badge-{{ $company->subscription_type == 'free' ? 'secondary' : 'primary' }}">
                            {{ ucfirst($company->subscription_type) }}
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="label">Cards</span>
                        <span class="value">{{ $company->cards_used }}/{{ $company->card_limit }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Status</span>
                        <span class="value badge badge-{{ $company->status ? 'success' : 'danger' }}">
                            {{ $company->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="label">Joined</span>
                        <span class="value">{{ $company->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="quick-links">
                <a href="{{ url('/company/branding') }}" class="quick-link">
                    <i class="fas fa-palette"></i>
                    <span>Branding Settings</span>
                </a>
                <a href="{{ url('/company/subscription') }}" class="quick-link">
                    <i class="fas fa-crown"></i>
                    <span>Subscription</span>
                </a>
                <a href="{{ url('/company/change-password') }}" class="quick-link">
                    <i class="fas fa-key"></i>
                    <span>Change Password</span>
                </a>
            </div>
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .profile-page { max-width: 1200px; }
    .profile-header-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }
    .profile-cover {
        height: 150px;
        position: relative;
    }
    .profile-cover img { width: 100%; height: 100%; object-fit: cover; }
    .profile-info {
        display: flex;
        align-items: flex-end;
        gap: 1.5rem;
        padding: 0 1.5rem 1.5rem;
        margin-top: -50px;
    }
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 1rem;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #0891b2;
        border: 4px solid white;
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }
    .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .profile-details h1 { font-size: 1.5rem; margin-bottom: 0.25rem; }
    .profile-details p { color: var(--text-muted); }
    .theme-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.8rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }
    .profile-content {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 1.5rem;
    }
    @media (max-width: 768px) { .profile-content { grid-template-columns: 1fr; } }
    .form-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
    }
    .card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    .card-header h3 { font-size: 1rem; display: flex; align-items: center; gap: 0.5rem; }
    .card-body { padding: 1.5rem; }
    .card-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
    }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-input, .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        background: var(--bg-primary);
        color: var(--text-primary);
    }
    .form-input:focus, .form-select:focus { outline: none; border-color: #0891b2; }
    .form-hint { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem; display: block; }
    .section-subtitle {
        font-size: 0.95rem;
        font-weight: 600;
        margin: 1.5rem 0 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1rem;
    }
    .info-card h4 { font-size: 0.95rem; margin-bottom: 1rem; }
    .info-list { display: flex; flex-direction: column; gap: 0.75rem; }
    .info-item { display: flex; justify-content: space-between; font-size: 0.9rem; }
    .info-item .label { color: var(--text-muted); }
    .quick-links { display: flex; flex-direction: column; gap: 0.5rem; }
    .quick-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        background: var(--bg-primary);
        border-radius: 0.75rem;
        text-decoration: none;
        color: var(--text-primary);
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }
    .quick-link:hover { transform: translateX(4px); color: #0891b2; }
    .quick-link i { color: #0891b2; }
</style>
@endpush
@endsection
