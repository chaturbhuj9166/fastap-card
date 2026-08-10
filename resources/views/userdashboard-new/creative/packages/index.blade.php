@extends('layouts.redesign.dashboard')

@section('page-title', 'My Packages')
@section('breadcrumb', 'Packages')

@section('dashboard-content')
<div class="packages-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Packages</h1>
            <p>Manage your photography and event packages</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('user.creative.packages.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Package
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        @php
            $totalPackages = $packages ? (is_countable($packages) ? count($packages) : 0) : 0;
            $activePackages = $packages ? $packages->where('is_active', true)->count() : 0;
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon green">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalPackages }}</span>
                <span class="stat-mini-label">Total Packages</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon blue">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $activePackages }}</span>
                <span class="stat-mini-label">Active Packages</span>
            </div>
        </div>
    </div>

    @if($packages && count($packages) > 0)
        <div class="packages-grid stagger-animation">
            @foreach($packages as $package)
                <div class="package-card fade-up">
                    <div class="package-header">
                        <div class="package-type-badge {{ strtolower($package->type) }}">
                            <i class="fas fa-{{ $package->type === 'photography' ? 'camera' : ($package->type === 'event' ? 'calendar-alt' : 'layer-group') }}"></i>
                            {{ ucfirst($package->type) }}
                        </div>
                        <div class="package-status">
                            @if($package->is_active)
                                <span class="status-badge active">
                                    <i class="fas fa-check-circle"></i> Active
                                </span>
                            @else
                                <span class="status-badge inactive">
                                    <i class="fas fa-times-circle"></i> Inactive
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="package-body">
                        <h4 class="package-title">{{ $package->name }}</h4>
                        <div class="package-meta">
                            <div class="meta-item">
                                <i class="fas fa-rupee-sign"></i>
                                <span class="package-price">{{ number_format($package->price) }}</span>
                            </div>
                            @if($package->duration)
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $package->duration }}</span>
                                </div>
                            @endif
                        </div>
                        @if($package->description)
                            <p class="package-description">{{ Str::limit($package->description, 80) }}</p>
                        @endif
                        @if($package->features && is_array(json_decode($package->features, true)))
                            @php
                                $features = json_decode($package->features, true);
                            @endphp
                            <div class="package-features">
                                @foreach(array_slice($features, 0, 2) as $feature)
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                                @if(count($features) > 2)
                                    <small class="text-muted">+{{ count($features) - 2 }} more</small>
                                @endif
                            </div>
                        @endif
                        <p class="package-date">Created {{ $package->created_at ? $package->created_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="package-actions">
                        <a href="{{ route('user.creative.packages.edit', $package->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('user.creative.packages.toggle-status', $package->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn {{ $package->is_active ? 'warning' : 'success' }}" title="{{ $package->is_active ? 'Deactivate' : 'Activate' }}">
                                <i class="fas fa-{{ $package->is_active ? 'eye-slash' : 'eye' }}"></i>
                            </button>
                        </form>
                        <form action="{{ route('user.creative.packages.destroy', $package->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this package?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <h3>No Packages Yet</h3>
            <p>Create packages to showcase your photography and event services.</p>
            <a href="{{ route('user.creative.packages.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Package
            </a>
        </div>
    @endif
</div>

<style>
.packages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
}

.package-card {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.package-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.package-header {
    padding: 1.25rem;
    background: var(--bg-secondary);
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--border-color);
}

.package-type-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.package-type-badge.photography {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.package-type-badge.event {
    background: linear-gradient(135deg, #f093fb, #f5576c);
    color: white;
}

.package-type-badge.combined {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    color: white;
}

.package-status .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.35rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.active {
    background: rgba(39, 174, 96, 0.1);
    color: var(--success-color);
}

.status-badge.inactive {
    background: rgba(231, 76, 60, 0.1);
    color: var(--danger-color);
}

.package-body {
    padding: 1.25rem;
    flex: 1;
}

.package-title {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0 0 1rem;
}

.package-meta {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.meta-item i {
    color: var(--primary-color);
}

.package-price {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--success-color);
}

.package-description {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 1rem;
    line-height: 1.5;
}

.package-features {
    margin-bottom: 1rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.feature-item i {
    color: var(--success-color);
    font-size: 0.7rem;
}

.package-date {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin: 0;
}

.package-actions {
    display: flex;
    border-top: 1px solid var(--border-color);
    padding: 0.75rem 1.25rem;
    gap: 0.5rem;
    justify-content: flex-end;
}

.stat-mini-icon.blue {
    background: linear-gradient(135deg, var(--primary-color), #667eea);
}

@media (max-width: 576px) {
    .packages-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@endsection
