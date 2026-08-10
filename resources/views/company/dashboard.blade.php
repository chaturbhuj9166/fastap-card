@extends('layouts.redesign.company')

@section('page-title', 'Dashboard')
@section('breadcrumb', 'Overview')

@section('company-content')
<div class="dashboard-page">
    <!-- Welcome Card -->
    <div class="welcome-card">
        <div class="welcome-content">
            <h2>Welcome back, {{ $company->name }}!</h2>
            <p>Manage your staff cards and company profile from here.</p>
            <div class="welcome-actions">
                <a href="{{ url('/company/staff/create') }}" class="btn btn-light">
                    <i class="fas fa-user-plus"></i> Add Staff
                </a>
                <a href="{{ url('/company/profile') }}" class="btn btn-outline-light">
                    <i class="fas fa-building"></i> Edit Profile
                </a>
            </div>
        </div>
        <div class="welcome-illustration">
            <i class="fas fa-building" style="font-size: 6rem; opacity: 0.3;"></i>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $stats['total_staff'] }}</span>
                <span class="stat-label">Total Staff</span>
            </div>
        </div>

        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-id-card"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $stats['active_cards'] }}</span>
                <span class="stat-label">Active Cards</span>
            </div>
        </div>

        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-id-card-alt"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $stats['inactive_cards'] }}</span>
                <span class="stat-label">Inactive Cards</span>
            </div>
        </div>

        <div class="stat-card info">
            <div class="stat-icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $stats['cards_remaining'] }}/{{ $stats['card_limit'] }}</span>
                <span class="stat-label">Cards Remaining</span>
            </div>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- Recent Staff -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3><i class="fas fa-clock"></i> Recent Staff</h3>
                <a href="{{ url('/company/staff') }}" class="btn btn-sm btn-outline">View All</a>
            </div>
            <div class="card-body">
                @if($recentStaff->count() > 0)
                    <div class="recent-list">
                        @foreach($recentStaff as $staff)
                        <div class="recent-item">
                            <div class="recent-avatar">
                                @if($staff->profile_image)
                                    <img src="{{ asset('uploads/staff/' . $staff->profile_image) }}" alt="{{ $staff->name }}">
                                @else
                                    <span>{{ substr($staff->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="recent-info">
                                <h4>{{ $staff->name }}</h4>
                                <p>{{ $staff->designation ?? 'Staff' }}</p>
                            </div>
                            <div class="recent-status">
                                @if($staff->card_enabled && $staff->status)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-warning">Inactive</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-users"></i>
                        <p>No staff members yet</p>
                        <a href="{{ url('/company/staff/create') }}" class="btn btn-primary btn-sm">Add First Staff</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
            </div>
            <div class="card-body">
                <div class="quick-actions-grid">
                    <a href="{{ url('/company/staff/create') }}" class="quick-action">
                        <div class="quick-action-icon" style="background: rgba(8, 145, 178, 0.1); color: #0891b2;">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <span>Add Staff</span>
                    </a>
                    <a href="{{ url('/company/staff/import') }}" class="quick-action">
                        <div class="quick-action-icon" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
                            <i class="fas fa-file-import"></i>
                        </div>
                        <span>Bulk Import</span>
                    </a>
                    <a href="{{ url('/company/profile') }}" class="quick-action">
                        <div class="quick-action-icon" style="background: rgba(168, 85, 247, 0.1); color: #a855f7;">
                            <i class="fas fa-building"></i>
                        </div>
                        <span>Edit Profile</span>
                    </a>
                    <a href="{{ url('/company/branding') }}" class="quick-action">
                        <div class="quick-action-icon" style="background: rgba(249, 115, 22, 0.1); color: #f97316;">
                            <i class="fas fa-palette"></i>
                        </div>
                        <span>Branding</span>
                    </a>
                    <a href="{{ url('/company/subscription') }}" class="quick-action">
                        <div class="quick-action-icon" style="background: rgba(234, 179, 8, 0.1); color: #eab308;">
                            <i class="fas fa-crown"></i>
                        </div>
                        <span>Subscription</span>
                    </a>
                    <a href="{{ url('/company/staff') }}" class="quick-action">
                        <div class="quick-action-icon" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;">
                            <i class="fas fa-list"></i>
                        </div>
                        <span>Manage Staff</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Company Info Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3><i class="fas fa-info-circle"></i> Company Info</h3>
            </div>
            <div class="card-body">
                <div class="info-list">
                    <div class="info-item">
                        <span class="info-label">Theme</span>
                        <span class="info-value">
                            @if($company->professionTheme)
                                <span class="badge" style="background: {{ $company->professionTheme->color }}20; color: {{ $company->professionTheme->color }};">
                                    <i class="fas {{ $company->professionTheme->icon }}"></i>
                                    {{ $company->professionTheme->name }}
                                </span>
                            @else
                                Not Set
                            @endif
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Industry</span>
                        <span class="info-value">{{ $company->industry ?? 'Not specified' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Plan</span>
                        <span class="info-value">
                            <span class="badge badge-{{ $company->subscription_type == 'enterprise' ? 'primary' : ($company->subscription_type == 'premium' ? 'success' : ($company->subscription_type == 'basic' ? 'info' : 'secondary')) }}">
                                {{ ucfirst($company->subscription_type) }}
                            </span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Card Limit</span>
                        <span class="info-value">{{ $company->card_limit }} cards</span>
                    </div>
                    @if($company->website)
                    <div class="info-item">
                        <span class="info-label">Website</span>
                        <span class="info-value">
                            <a href="{{ $company->website }}" target="_blank" style="color: #0891b2;">
                                {{ parse_url($company->website, PHP_URL_HOST) }}
                                <i class="fas fa-external-link-alt" style="font-size: 0.75rem;"></i>
                            </a>
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Card Usage Progress -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3><i class="fas fa-chart-pie"></i> Card Usage</h3>
            </div>
            <div class="card-body">
                <div style="text-align: center; padding: 1rem;">
                    <div style="width: 150px; height: 150px; margin: 0 auto; position: relative;">
                        <svg viewBox="0 0 36 36" style="transform: rotate(-90deg);">
                            <path
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="var(--border-color)"
                                stroke-width="3"
                            />
                            <path
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="#0891b2"
                                stroke-width="3"
                                stroke-dasharray="{{ ($stats['total_staff'] / max($stats['card_limit'], 1)) * 100 }}, 100"
                            />
                        </svg>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                            <span style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary);">{{ $stats['total_staff'] }}</span>
                            <span style="display: block; font-size: 0.75rem; color: var(--text-muted);">of {{ $stats['card_limit'] }}</span>
                        </div>
                    </div>
                    <p style="margin-top: 1rem; color: var(--text-muted);">
                        {{ $stats['cards_remaining'] }} cards available
                    </p>
                    @if($stats['cards_remaining'] <= 2)
                        <a href="{{ url('/company/subscription') }}" class="btn btn-primary btn-sm" style="margin-top: 0.5rem;">
                            <i class="fas fa-crown"></i> Upgrade Plan
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .dashboard-page {
        max-width: 1400px;
    }
    .welcome-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2rem;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
        color: white;
    }
    .welcome-content h2 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .welcome-content p {
        opacity: 0.9;
        margin-bottom: 1rem;
    }
    .welcome-actions {
        display: flex;
        gap: 0.75rem;
    }
    .btn-light {
        background: white;
        color: #0891b2;
    }
    .btn-outline-light {
        background: transparent;
        border: 2px solid white;
        color: white;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: 1fr; }
    }
    .stat-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: var(--shadow-sm);
    }
    .stat-card.primary { background: linear-gradient(135deg, #0891b2, #06b6d4); color: white; }
    .stat-card.success { background: linear-gradient(135deg, #22c55e, #4ade80); color: white; }
    .stat-card.warning { background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; }
    .stat-card.info { background: linear-gradient(135deg, #6366f1, #818cf8); color: white; }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        background: rgba(255,255,255,0.2);
    }
    .stat-value {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
    }
    .stat-label {
        font-size: 0.875rem;
        opacity: 0.9;
    }
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    @media (max-width: 768px) {
        .dashboard-grid { grid-template-columns: 1fr; }
    }
    .dashboard-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border-color);
    }
    .card-header h3 {
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .card-body {
        padding: 1.25rem;
    }
    .recent-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .recent-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: background 0.2s;
    }
    .recent-item:hover {
        background: var(--bg-secondary);
    }
    .recent-avatar {
        width: 40px;
        height: 40px;
        border-radius: 0.5rem;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        overflow: hidden;
    }
    .recent-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .recent-info {
        flex: 1;
        min-width: 0;
    }
    .recent-info h4 {
        font-size: 0.9rem;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .recent-info p {
        font-size: 0.75rem;
        color: var(--text-muted);
    }
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
    }
    .quick-action {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem;
        border-radius: 0.75rem;
        transition: all 0.2s;
        text-decoration: none;
        color: var(--text-primary);
    }
    .quick-action:hover {
        background: var(--bg-secondary);
        transform: translateY(-2px);
    }
    .quick-action-icon {
        width: 48px;
        height: 48px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .quick-action span {
        font-size: 0.8rem;
        font-weight: 500;
    }
    .info-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid var(--border-color);
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .info-label {
        color: var(--text-muted);
        font-size: 0.875rem;
    }
    .info-value {
        font-weight: 500;
    }
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--text-muted);
    }
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    .empty-state p {
        margin-bottom: 1rem;
    }
</style>
@endpush
@endsection
