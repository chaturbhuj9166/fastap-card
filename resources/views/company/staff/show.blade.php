@extends('layouts.redesign.company')

@section('page-title', $staff->name)
@section('breadcrumb')
<a href="{{ url('/company/staff') }}">Staff</a>
<span class="breadcrumb-separator">/</span>
{{ $staff->name }}
@endsection

@section('company-content')
<div class="staff-view-page">
    <!-- Staff Header -->
    <div class="staff-header-card">
        <div class="header-banner" style="background: linear-gradient(135deg, {{ $company->branding_settings['primary_color'] ?? '#0891b2' }}, {{ $company->branding_settings['secondary_color'] ?? '#06b6d4' }});">
            <div class="header-actions">
                <a href="{{ url('/company/staff/' . $staff->id . '/edit') }}" class="btn btn-white btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ url('/company/staff/' . $staff->id . '/visibility') }}" class="btn btn-white btn-sm">
                    <i class="fas fa-eye"></i> Visibility
                </a>
            </div>
        </div>
        <div class="header-content">
            <div class="staff-avatar-large">
                @if($staff->profile_image)
                    <img src="{{ asset('uploads/staff/' . $staff->profile_image) }}" alt="{{ $staff->name }}">
                @else
                    <span>{{ substr($staff->name, 0, 1) }}</span>
                @endif
                <span class="status-dot {{ $staff->isCardActive() ? 'active' : 'inactive' }}"></span>
            </div>
            <div class="staff-details">
                <h1>{{ $staff->name }}</h1>
                <p class="designation">{{ $staff->designation ?? 'Staff Member' }}</p>
                @if($staff->department)
                    <span class="department-badge">{{ $staff->department }}</span>
                @endif
                <div class="staff-meta">
                    @if($staff->employee_id)
                        <span><i class="fas fa-id-badge"></i> {{ $staff->employee_id }}</span>
                    @endif
                    <span><i class="fas fa-user-tag"></i> {{ ucfirst($staff->role) }}</span>
                    <span><i class="fas fa-calendar"></i> Joined {{ $staff->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="staff-content">
        <div class="staff-main">
            <!-- Contact Information -->
            <div class="info-card">
                <div class="card-header">
                    <h3><i class="fas fa-address-book"></i> Contact Information</h3>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <label>Email Address</label>
                                @if($staff->email)
                                    <a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a>
                                @else
                                    <span class="not-set">Not provided</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-content">
                                <label>Phone Number</label>
                                @if($staff->phone)
                                    <a href="tel:{{ $staff->phone }}">{{ $staff->phone }}</a>
                                @else
                                    <span class="not-set">Not provided</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Work Information -->
            <div class="info-card">
                <div class="card-header">
                    <h3><i class="fas fa-briefcase"></i> Work Information</h3>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="info-content">
                                <label>Designation</label>
                                <span>{{ $staff->designation ?? 'Not specified' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-sitemap"></i>
                            </div>
                            <div class="info-content">
                                <label>Department</label>
                                <span>{{ $staff->department ?? 'Not specified' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="info-content">
                                <label>Role</label>
                                <span class="role-badge role-{{ $staff->role }}">{{ ucfirst($staff->role) }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-id-badge"></i>
                            </div>
                            <div class="info-content">
                                <label>Employee ID</label>
                                <span>{{ $staff->employee_id ?? 'Not assigned' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visibility Summary -->
            <div class="info-card">
                <div class="card-header">
                    <h3><i class="fas fa-eye"></i> Visibility Summary</h3>
                    <a href="{{ url('/company/staff/' . $staff->id . '/visibility') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-cog"></i> Configure
                    </a>
                </div>
                <div class="card-body">
                    @php
                        $visibility = $staff->visibility_settings ?? [];
                        $visibleItems = array_filter($visibility, fn($v) => $v === true || $v === 1 || $v === '1');
                        $totalItems = count($visibility) ?: 1;
                    @endphp
                    <div class="visibility-summary">
                        <div class="summary-stat">
                            <span class="stat-value">{{ count($visibleItems) }}</span>
                            <span class="stat-label">Visible Items</span>
                        </div>
                        <div class="summary-stat">
                            <span class="stat-value">{{ $totalItems - count($visibleItems) }}</span>
                            <span class="stat-label">Hidden Items</span>
                        </div>
                    </div>
                    <div class="visibility-tags">
                        @if($visibility['name'] ?? true)
                            <span class="tag visible"><i class="fas fa-check"></i> Name</span>
                        @endif
                        @if($visibility['email'] ?? true)
                            <span class="tag visible"><i class="fas fa-check"></i> Email</span>
                        @endif
                        @if($visibility['phone'] ?? true)
                            <span class="tag visible"><i class="fas fa-check"></i> Phone</span>
                        @endif
                        @if($visibility['designation'] ?? true)
                            <span class="tag visible"><i class="fas fa-check"></i> Designation</span>
                        @endif
                        @if(!($visibility['employee_id'] ?? false))
                            <span class="tag hidden"><i class="fas fa-eye-slash"></i> Employee ID</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="staff-sidebar">
            <!-- Card Status -->
            <div class="status-card">
                <h4>Card Status</h4>
                <div class="status-indicator {{ $staff->isCardActive() ? 'active' : 'inactive' }}">
                    <i class="fas {{ $staff->isCardActive() ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                    <span>{{ $staff->isCardActive() ? 'Active' : 'Inactive' }}</span>
                </div>

                <div class="status-details">
                    <div class="status-row">
                        <span>Card Enabled</span>
                        <span class="{{ $staff->card_enabled ? 'text-green' : 'text-red' }}">
                            {{ $staff->card_enabled ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div class="status-row">
                        <span>Account Status</span>
                        <span class="{{ $staff->status ? 'text-green' : 'text-red' }}">
                            {{ $staff->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    @if($staff->card_expiry)
                    <div class="status-row">
                        <span>Expiry Date</span>
                        <span class="{{ $staff->card_expiry->isPast() ? 'text-red' : '' }}">
                            {{ $staff->card_expiry->format('M d, Y') }}
                        </span>
                    </div>
                    @endif
                </div>

                <form action="{{ route('company.staff.toggle', $staff->id) }}" method="POST" style="margin-top: 1rem;">
                    @csrf
                    <button type="submit" class="btn {{ $staff->card_enabled ? 'btn-outline' : 'btn-primary' }} btn-block">
                        <i class="fas {{ $staff->card_enabled ? 'fa-pause' : 'fa-play' }}"></i>
                        {{ $staff->card_enabled ? 'Disable Card' : 'Enable Card' }}
                    </button>
                </form>
            </div>

            <!-- Quick Actions -->
            <div class="actions-card">
                <h4>Quick Actions</h4>
                <div class="action-links">
                    <a href="{{ url('/company/staff/' . $staff->id . '/edit') }}" class="action-link">
                        <i class="fas fa-edit"></i>
                        <span>Edit Staff Details</span>
                    </a>
                    <a href="{{ url('/company/staff/' . $staff->id . '/visibility') }}" class="action-link">
                        <i class="fas fa-eye"></i>
                        <span>Visibility Settings</span>
                    </a>
                    @if($staff->customer_id)
                    <a href="{{ url('/profile/' . $staff->customer->mobile) }}" target="_blank" class="action-link">
                        <i class="fas fa-external-link-alt"></i>
                        <span>View Public Card</span>
                    </a>
                    @endif
                    <form action="{{ route('company.staff.destroy', $staff->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-link danger">
                            <i class="fas fa-trash"></i>
                            <span>Delete Staff</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .staff-view-page { max-width: 1100px; }

    .staff-header-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
    }
    .header-banner {
        height: 120px;
        position: relative;
    }
    .header-actions {
        position: absolute;
        top: 1rem;
        right: 1rem;
        display: flex;
        gap: 0.5rem;
    }
    .btn-white {
        background: rgba(255,255,255,0.9);
        color: #1f2937;
        backdrop-filter: blur(4px);
    }
    .btn-white:hover { background: white; }

    .header-content {
        display: flex;
        align-items: flex-end;
        gap: 1.5rem;
        padding: 0 1.5rem 1.5rem;
        margin-top: -50px;
    }
    .staff-avatar-large {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        border: 4px solid var(--bg-primary);
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }
    .staff-avatar-large img { width: 100%; height: 100%; object-fit: cover; }
    .status-dot {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid var(--bg-primary);
    }
    .status-dot.active { background: #10b981; }
    .status-dot.inactive { background: #ef4444; }

    .staff-details h1 { font-size: 1.5rem; margin-bottom: 0.25rem; }
    .designation { color: var(--text-muted); margin-bottom: 0.5rem; }
    .department-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: var(--bg-secondary);
        border-radius: 1rem;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 0.75rem;
    }
    .staff-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        font-size: 0.875rem;
        color: var(--text-muted);
    }
    .staff-meta span {
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .staff-content {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 1.5rem;
    }
    @media (max-width: 768px) { .staff-content { grid-template-columns: 1fr; } }

    .info-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
    }
    .card-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-header h3 {
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .card-body { padding: 1.25rem; }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    @media (max-width: 480px) { .info-grid { grid-template-columns: 1fr; } }
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }
    .info-icon {
        width: 40px;
        height: 40px;
        background: rgba(8, 145, 178, 0.1);
        color: #0891b2;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .info-content label {
        display: block;
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 0.25rem;
    }
    .info-content span, .info-content a {
        font-weight: 500;
    }
    .info-content a { color: #0891b2; }
    .not-set { color: var(--text-muted); font-style: italic; }

    .role-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 0.25rem;
        font-size: 0.8rem;
    }
    .role-admin { background: rgba(124, 58, 237, 0.1); color: #7c3aed; }
    .role-manager { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .role-staff { background: rgba(107, 114, 128, 0.1); color: #6b7280; }

    .visibility-summary {
        display: flex;
        gap: 2rem;
        margin-bottom: 1rem;
    }
    .summary-stat { text-align: center; }
    .stat-value { font-size: 1.5rem; font-weight: 700; color: #0891b2; display: block; }
    .stat-label { font-size: 0.8rem; color: var(--text-muted); }
    .visibility-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .tag {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.25rem 0.6rem;
        border-radius: 1rem;
        font-size: 0.75rem;
    }
    .tag.visible { background: #d1fae5; color: #065f46; }
    .tag.hidden { background: #fee2e2; color: #991b1b; }

    /* Sidebar */
    .status-card, .actions-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1rem;
    }
    .status-card h4, .actions-card h4 {
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    .status-indicator {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 1rem;
        border-radius: 0.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .status-indicator.active { background: #d1fae5; color: #065f46; }
    .status-indicator.inactive { background: #fee2e2; color: #991b1b; }
    .status-indicator i { font-size: 1.25rem; }

    .status-details { border-top: 1px solid var(--border-color); padding-top: 1rem; }
    .status-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        font-size: 0.875rem;
    }
    .text-green { color: #10b981; }
    .text-red { color: #ef4444; }

    .action-links { display: flex; flex-direction: column; gap: 0.5rem; }
    .action-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        color: var(--text-primary);
        transition: all 0.2s;
        background: none;
        border: none;
        width: 100%;
        cursor: pointer;
        font-size: 0.9rem;
    }
    .action-link:hover { background: var(--bg-secondary); }
    .action-link i { color: #0891b2; width: 20px; }
    .action-link.danger { color: #ef4444; }
    .action-link.danger i { color: #ef4444; }
    .action-link.danger:hover { background: #fee2e2; }

    .btn-block { width: 100%; }
</style>
@endpush
@endsection
