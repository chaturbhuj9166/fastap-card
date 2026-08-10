@extends('layouts.redesign.dashboard')

@section('page-title', 'Location Tracking')
@section('breadcrumb', 'Location Tracking')

@section('dashboard-content')
<div class="location-tracking-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Profile Tap Locations</h1>
            <p>See where and when your real estate profile was opened.</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        <div class="stat-mini-card">
            <div class="stat-mini-icon blue">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $stats['total'] ?? 0 }}</span>
                <span class="stat-mini-label">Total Taps</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon orange">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $stats['last_7_days'] ?? 0 }}</span>
                <span class="stat-mini-label">Last 7 Days</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon green">
                <i class="fas fa-location-arrow"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $stats['with_location'] ?? 0 }}</span>
                <span class="stat-mini-label">With Location</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon purple">
                <i class="fas fa-wifi"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ ($stats['nfc'] ?? 0) + ($stats['qr'] ?? 0) }}</span>
                <span class="stat-mini-label">NFC + QR</span>
            </div>
        </div>
    </div>

    <div class="filter-tabs fade-up">
        <a href="{{ route('real-estate.location-tracking.index') }}" class="filter-tab {{ !request('source') ? 'active' : '' }}">
            All
        </a>
        <a href="{{ route('real-estate.location-tracking.index', ['source' => 'nfc']) }}" class="filter-tab {{ request('source') === 'nfc' ? 'active' : '' }}">
            NFC
        </a>
        <a href="{{ route('real-estate.location-tracking.index', ['source' => 'qr']) }}" class="filter-tab {{ request('source') === 'qr' ? 'active' : '' }}">
            QR
        </a>
        <a href="{{ route('real-estate.location-tracking.index', ['source' => 'unknown']) }}" class="filter-tab {{ request('source') === 'unknown' ? 'active' : '' }}">
            Unknown
        </a>
    </div>

    @if($tracks && count($tracks) > 0)
        <div class="visits-table-container fade-up">
            <div class="table-responsive">
                <table class="visits-table">
                    <thead>
                        <tr>
                            <th>Tap Time</th>
                            <th>Source</th>
                            <th>Location</th>
                            <th>Accuracy</th>
                            <th>IP</th>
                            <th>Device</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tracks as $track)
                            <tr>
                                <td>
                                    <strong class="date-text">
                                        {{ $track->created_at ? $track->created_at->format('M d, Y h:i A') : 'N/A' }}
                                    </strong>
                                </td>
                                <td>
                                    <span class="status-badge {{ $track->tap_source }}">
                                        @if($track->tap_source === 'nfc')
                                            <i class="fas fa-wifi"></i> NFC
                                        @elseif($track->tap_source === 'qr')
                                            <i class="fas fa-qrcode"></i> QR
                                        @elseif($track->tap_source === 'link')
                                            <i class="fas fa-link"></i> Link
                                        @else
                                            <i class="fas fa-question-circle"></i> Unknown
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    @if($track->latitude && $track->longitude)
                                        <div class="location-cell">
                                            <div>{{ $track->latitude }}, {{ $track->longitude }}</div>
                                            <a class="map-link" href="https://www.google.com/maps?q={{ $track->latitude }},{{ $track->longitude }}" target="_blank" rel="noopener">
                                                View Map
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-muted">Location not shared</span>
                                    @endif
                                </td>
                                <td>
                                    @if($track->accuracy_m)
                                        <span class="time-badge">
                                            <i class="fas fa-bullseye"></i>
                                            {{ $track->accuracy_m }} m
                                        </span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">{{ $track->ip_address ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">
                                        {{ \Illuminate\Support\Str::limit($track->user_agent ?? 'N/A', 40) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($tracks, 'links'))
            <div class="pagination-wrapper fade-up">
                {{ $tracks->links() }}
            </div>
        @endif
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3>No Tap History Yet</h3>
            <p>When someone opens your profile via NFC or QR, their tap details will appear here.</p>
        </div>
    @endif
</div>

<style>
.filter-tabs {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.filter-tab {
    padding: 0.75rem 1.5rem;
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    color: var(--text-secondary);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
}

.filter-tab:hover {
    background: var(--bg-tertiary);
    border-color: var(--purple-500);
    color: var(--text-primary);
}

.filter-tab.active {
    background: linear-gradient(135deg, var(--purple-500), #667eea);
    border-color: var(--purple-500);
    color: white;
}

.visits-table-container {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.table-responsive {
    overflow-x: auto;
}

.visits-table {
    width: 100%;
    border-collapse: collapse;
}

.visits-table thead {
    background: var(--bg-secondary);
    border-bottom: 2px solid var(--border-color);
}

.visits-table th {
    padding: 1rem;
    text-align: left;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.visits-table tbody tr {
    border-bottom: 1px solid var(--border-color);
    transition: background 0.2s;
}

.visits-table tbody tr:hover {
    background: var(--bg-secondary);
}

.visits-table td {
    padding: 1rem;
    font-size: 0.9rem;
    color: var(--text-color);
    vertical-align: top;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.4rem 0.85rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.time-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.35rem 0.75rem;
    background: var(--bg-secondary);
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 500;
}

.time-badge i {
    color: var(--purple-500);
}

.location-tracking-page .status-badge.nfc {
    background: rgba(59, 130, 246, 0.1);
    color: var(--blue-500);
}

.location-tracking-page .status-badge.qr {
    background: rgba(236, 72, 153, 0.1);
    color: var(--pink-500);
}

.location-tracking-page .status-badge.link {
    background: rgba(249, 115, 22, 0.1);
    color: var(--orange-500);
}

.location-tracking-page .status-badge.unknown {
    background: rgba(148, 163, 184, 0.15);
    color: var(--text-muted);
}

.location-cell {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.map-link {
    color: var(--purple-500);
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
}

.map-link:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .visits-table {
        font-size: 0.85rem;
    }

    .visits-table th,
    .visits-table td {
        padding: 0.75rem 0.5rem;
    }

    .filter-tabs {
        gap: 0.5rem;
    }

    .filter-tab {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@endsection
