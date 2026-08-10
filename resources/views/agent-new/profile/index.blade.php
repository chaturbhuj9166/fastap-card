@extends('layouts.redesign.agent')

@section('page-title', 'My Profile')
@section('breadcrumb', 'My Profile')

@push('page-styles')
<style>
    .profile-container {
        max-width: 800px;
    }

    .profile-header-card {
        background: linear-gradient(135deg, var(--purple-500), var(--blue-500));
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
        color: white;
        text-align: center;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto var(--space-lg);
        font-size: 3rem;
        color: var(--purple-500);
    }

    .profile-name {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-xs);
    }

    .profile-code {
        font-family: monospace;
        background: rgba(255, 255, 255, 0.2);
        padding: var(--space-xs) var(--space-md);
        border-radius: var(--radius-md);
        display: inline-block;
    }

    .profile-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
    }

    .profile-section-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-lg);
        padding-bottom: var(--space-sm);
        border-bottom: 1px solid var(--card-border);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .profile-section-title i {
        color: var(--purple-500);
    }

    .profile-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-lg);
    }

    .profile-info-item {
        display: flex;
        flex-direction: column;
        gap: var(--space-xs);
    }

    .profile-info-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
        font-weight: var(--font-medium);
    }

    .profile-info-value {
        font-size: var(--text-base);
        color: var(--text-primary);
        background: var(--bg-secondary);
        padding: var(--space-sm) var(--space-md);
        border-radius: var(--radius-md);
    }

    .profile-documents {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-lg);
    }

    .document-item {
        text-align: center;
    }

    .document-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-sm);
    }

    .document-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: var(--radius-md);
        border: 1px solid var(--card-border);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-xs) var(--space-md);
        border-radius: var(--radius-md);
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
    }

    .status-badge.active {
        background: rgba(16, 185, 129, 0.1);
        color: var(--green-500);
    }

    .status-badge.inactive {
        background: rgba(239, 68, 68, 0.1);
        color: var(--red-500);
    }

    @media (max-width: 768px) {
        .profile-info-grid,
        .profile-documents {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('agent-content')
<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header-card">
        <div class="profile-avatar">
            <i class="fas fa-user"></i>
        </div>
        <h1 class="profile-name">{{ $agent->name }}</h1>
        <div class="profile-code">Franchise Code: {{ $agent->agent_code }}</div>
    </div>

    <!-- Personal Information -->
    <div class="profile-card">
        <h2 class="profile-section-title">
            <i class="fas fa-user-circle"></i>
            Personal Information
        </h2>
        <div class="profile-info-grid">
            <div class="profile-info-item">
                <span class="profile-info-label">Full Name</span>
                <span class="profile-info-value">{{ $agent->name }}</span>
            </div>
            <div class="profile-info-item">
                <span class="profile-info-label">Email Address</span>
                <span class="profile-info-value">{{ $agent->email }}</span>
            </div>
            <div class="profile-info-item">
                <span class="profile-info-label">Mobile Number</span>
                <span class="profile-info-value">{{ $agent->mobile }}</span>
            </div>
            <div class="profile-info-item">
                <span class="profile-info-label">Alternative Mobile</span>
                <span class="profile-info-value">{{ $agent->alternative_mobile ?: 'Not provided' }}</span>
            </div>
            <div class="profile-info-item" style="grid-column: 1 / -1;">
                <span class="profile-info-label">Address</span>
                <span class="profile-info-value">{{ $agent->address ?: 'Not provided' }}</span>
            </div>
        </div>
    </div>

    <!-- Business Information -->
    <div class="profile-card">
        <h2 class="profile-section-title">
            <i class="fas fa-briefcase"></i>
            Business Information
        </h2>
        <div class="profile-info-grid">
            <div class="profile-info-item">
                <span class="profile-info-label">Franchise Code</span>
                <span class="profile-info-value" style="font-family: monospace;">{{ $agent->agent_code }}</span>
            </div>
            <div class="profile-info-item">
                <span class="profile-info-label">Commission Rate</span>
                <span class="profile-info-value">{{ $agent->commission }}%</span>
            </div>
            <div class="profile-info-item">
                <span class="profile-info-label">Account Status</span>
                <span class="profile-info-value">
                    @if($agent->status == 1)
                        <span class="status-badge active"><i class="fas fa-check-circle"></i> Active</span>
                    @else
                        <span class="status-badge inactive"><i class="fas fa-times-circle"></i> Inactive</span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Documents -->
    @if($agent->aadhar_front || $agent->aadhar_back)
    <div class="profile-card">
        <h2 class="profile-section-title">
            <i class="fas fa-file-alt"></i>
            Documents
        </h2>
        <div class="profile-documents">
            @if($agent->aadhar_front)
            <div class="document-item">
                <div class="document-label">Aadhar Card (Front)</div>
                <img src="{{ url('uploads/aadhar/aadhar_front/' . $agent->aadhar_front) }}" alt="Aadhar Front" class="document-image">
            </div>
            @endif
            @if($agent->aadhar_back)
            <div class="document-item">
                <div class="document-label">Aadhar Card (Back)</div>
                <img src="{{ url('uploads/aadhar/aadhar_back/' . $agent->aadhar_back) }}" alt="Aadhar Back" class="document-image">
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Security Note -->
    <div class="profile-card" style="background: rgba(245, 158, 11, 0.1); border-color: var(--amber-500);">
        <div style="display: flex; align-items: center; gap: var(--space-md);">
            <i class="fas fa-shield-alt" style="font-size: var(--text-2xl); color: var(--amber-500);"></i>
            <div>
                <h4 style="font-weight: var(--font-semibold); color: var(--text-primary); margin-bottom: var(--space-xs);">Security Notice</h4>
                <p style="font-size: var(--text-sm); color: var(--text-secondary);">To update your profile information, please contact the admin. For security reasons, some fields cannot be modified directly.</p>
            </div>
        </div>
    </div>
</div>

@endsection
