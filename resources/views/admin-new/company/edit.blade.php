@extends('layouts.redesign.admin')

@section('page-title', 'Edit Company')
@section('breadcrumb', 'Companies / Edit')

@push('page-styles')
<style>
    .form-container {
        max-width: 900px;
    }

    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
    }

    .form-card-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-lg);
        padding-bottom: var(--space-md);
        border-bottom: 1px solid var(--card-border);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-lg);
    }

    .form-group {
        margin-bottom: var(--space-lg);
    }

    .form-label {
        display: block;
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        margin-bottom: var(--space-sm);
        color: var(--text-primary);
    }

    .form-label .required {
        color: var(--red-500);
    }

    .form-control {
        width: 100%;
        padding: var(--space-sm) var(--space-md);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-md);
        font-size: var(--text-base);
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
    }

    .form-control.is-invalid {
        border-color: var(--red-500);
    }

    .invalid-feedback {
        color: var(--red-500);
        font-size: var(--text-sm);
        margin-top: var(--space-xs);
    }

    .form-text {
        color: var(--text-muted);
        font-size: var(--text-sm);
        margin-top: var(--space-xs);
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        padding-right: 2.5rem;
    }

    .current-logo {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        margin-bottom: var(--space-md);
        padding: var(--space-md);
        background: var(--bg-secondary);
        border-radius: var(--radius-md);
    }

    .current-logo img {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-md);
        object-fit: cover;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: var(--space-md);
        padding-top: var(--space-lg);
        border-top: 1px solid var(--card-border);
    }

    .subscription-options {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--space-md);
    }

    .subscription-option {
        position: relative;
    }

    .subscription-option input {
        position: absolute;
        opacity: 0;
    }

    .subscription-option label {
        display: block;
        padding: var(--space-lg);
        border: 2px solid var(--card-border);
        border-radius: var(--radius-lg);
        cursor: pointer;
        text-align: center;
        transition: all var(--transition-fast);
    }

    .subscription-option input:checked + label {
        border-color: var(--primary-color);
        background: rgba(var(--primary-rgb), 0.05);
    }

    .subscription-option label:hover {
        border-color: var(--primary-color);
    }

    .subscription-name {
        font-weight: var(--font-semibold);
        margin-bottom: var(--space-xs);
    }

    .subscription-cards {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .subscription-options {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush

@section('admin-content')
<div class="form-container">
    <!-- Page Header -->
    <div style="margin-bottom: var(--space-lg);">
        <a href="{{ url('/admin/companies/'.$company->id) }}" class="btn btn-outline btn-sm" style="margin-bottom: var(--space-md);">
            <i class="fas fa-arrow-left"></i> Back to Company
        </a>
        <h1 style="font-size: var(--text-2xl); font-weight: var(--font-bold);">Edit Company</h1>
        <p style="color: var(--text-muted);">Update company details and settings</p>
    </div>

    <form action="{{ url('/admin/companies/'.$company->id.'/update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Information -->
        <div class="form-card">
            <h2 class="form-card-title">
                <i class="fas fa-building" style="color: var(--primary-color);"></i>
                Basic Information
            </h2>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Company Name <span class="required">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $company->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Industry</label>
                    <input type="text" name="industry" class="form-control" value="{{ old('industry', $company->industry) }}" placeholder="e.g., Technology, Healthcare">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $company->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Website</label>
                <input type="url" name="website" class="form-control" value="{{ old('website', $company->website) }}" placeholder="https://example.com">
            </div>

            <div class="form-group">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address', $company->address) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $company->city) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $company->state) }}">
                </div>
            </div>
        </div>

        <!-- Theme & Branding -->
        <div class="form-card">
            <h2 class="form-card-title">
                <i class="fas fa-palette" style="color: var(--purple-500);"></i>
                Theme & Branding
            </h2>

            <div class="form-group">
                <label class="form-label">Profession Theme</label>
                <select name="profession_type" class="form-control form-select">
                    <option value="">Default Theme</option>
                    @foreach(\App\Models\ProfessionTheme::active()->ordered()->get() as $theme)
                        <option value="{{ $theme->id }}" {{ $company->profession_type == $theme->id ? 'selected' : '' }}>
                            {{ $theme->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Company Logo</label>
                @if($company->logo)
                <div class="current-logo">
                    <img src="{{ url('uploads/company/'.$company->logo) }}" alt="{{ $company->name }}">
                    <div>
                        <div style="font-weight: var(--font-medium);">Current Logo</div>
                        <div style="font-size: var(--text-sm); color: var(--text-muted);">Upload new image to replace</div>
                    </div>
                </div>
                @endif
                <input type="file" name="logo" class="form-control" accept="image/*">
                <span class="form-text">Recommended: Square image, at least 200x200px</span>
            </div>
        </div>

        <!-- Card Settings -->
        <div class="form-card">
            <h2 class="form-card-title">
                <i class="fas fa-id-card" style="color: var(--blue-500);"></i>
                Card Settings
            </h2>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Card Limit <span class="required">*</span></label>
                    <input type="number" name="card_limit" class="form-control @error('card_limit') is-invalid @enderror" value="{{ old('card_limit', $company->card_limit) }}" min="0" required>
                    <span class="form-text">Maximum number of staff cards this company can create</span>
                    @error('card_limit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Cards Used</label>
                    <input type="text" class="form-control" value="{{ $company->cards_used }}" disabled>
                    <span class="form-text">This is calculated automatically</span>
                </div>
            </div>
        </div>

        <!-- Subscription -->
        <div class="form-card">
            <h2 class="form-card-title">
                <i class="fas fa-crown" style="color: var(--yellow-600);"></i>
                Subscription
            </h2>

            <div class="form-group">
                <label class="form-label">Subscription Tier</label>
                <div class="subscription-options">
                    <div class="subscription-option">
                        <input type="radio" name="subscription_tier" id="tier_free" value="free" {{ ($company->subscription_tier ?? 'free') == 'free' ? 'checked' : '' }}>
                        <label for="tier_free">
                            <div class="subscription-name">Free</div>
                            <div class="subscription-cards">5 cards</div>
                        </label>
                    </div>
                    <div class="subscription-option">
                        <input type="radio" name="subscription_tier" id="tier_basic" value="basic" {{ $company->subscription_tier == 'basic' ? 'checked' : '' }}>
                        <label for="tier_basic">
                            <div class="subscription-name">Basic</div>
                            <div class="subscription-cards">25 cards</div>
                        </label>
                    </div>
                    <div class="subscription-option">
                        <input type="radio" name="subscription_tier" id="tier_premium" value="premium" {{ $company->subscription_tier == 'premium' ? 'checked' : '' }}>
                        <label for="tier_premium">
                            <div class="subscription-name">Premium</div>
                            <div class="subscription-cards">100 cards</div>
                        </label>
                    </div>
                    <div class="subscription-option">
                        <input type="radio" name="subscription_tier" id="tier_enterprise" value="enterprise" {{ $company->subscription_tier == 'enterprise' ? 'checked' : '' }}>
                        <label for="tier_enterprise">
                            <div class="subscription-name">Enterprise</div>
                            <div class="subscription-cards">Unlimited</div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Subscription Start</label>
                    <input type="date" name="subscription_start" class="form-control" value="{{ $company->subscription_start ? $company->subscription_start->format('Y-m-d') : '' }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Subscription End</label>
                    <input type="date" name="subscription_end" class="form-control" value="{{ $company->subscription_end ? $company->subscription_end->format('Y-m-d') : '' }}">
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="form-card">
            <h2 class="form-card-title">
                <i class="fas fa-toggle-on" style="color: var(--green-500);"></i>
                Status
            </h2>

            <div class="form-group">
                <label class="form-label">Account Status</label>
                <select name="status" class="form-control form-select">
                    <option value="active" {{ $company->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $company->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ $company->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-card">
            <div class="form-actions" style="border-top: none; padding-top: 0;">
                <a href="{{ url('/admin/companies/'.$company->id) }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
