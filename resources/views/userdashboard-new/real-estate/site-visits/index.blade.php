@extends('layouts.redesign.dashboard')

@section('page-title', 'Site Visits')
@section('breadcrumb', 'Site Visits')

@section('dashboard-content')
<div class="site-visits-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Site Visit Requests</h1>
            <p>Manage property viewing appointments</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        @php
            $visits = $visits ?? collect();
            $totalVisits = is_countable($visits) ? count($visits) : 0;
            $pendingVisits = $visits->where('status', 'pending')->count();
            $confirmedVisits = $visits->where('status', 'confirmed')->count();
            $completedVisits = $visits->where('status', 'completed')->count();
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon blue">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $totalVisits }}</span>
                <span class="stat-mini-label">Total Requests</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon orange">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $pendingVisits }}</span>
                <span class="stat-mini-label">Pending</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon purple">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $confirmedVisits }}</span>
                <span class="stat-mini-label">Confirmed</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon green">
                <i class="fas fa-check-double"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $completedVisits }}</span>
                <span class="stat-mini-label">Completed</span>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs fade-up">
        <a href="{{ route('real-estate.site-visits.index') }}" class="filter-tab {{ !request('status') ? 'active' : '' }}">
            All
        </a>
        <a href="{{ route('real-estate.site-visits.index', ['status' => 'pending']) }}" class="filter-tab {{ request('status') === 'pending' ? 'active' : '' }}">
            Pending
        </a>
        <a href="{{ route('real-estate.site-visits.index', ['status' => 'confirmed']) }}" class="filter-tab {{ request('status') === 'confirmed' ? 'active' : '' }}">
            Confirmed
        </a>
        <a href="{{ route('real-estate.site-visits.index', ['status' => 'completed']) }}" class="filter-tab {{ request('status') === 'completed' ? 'active' : '' }}">
            Completed
        </a>
        <a href="{{ route('real-estate.site-visits.index', ['status' => 'cancelled']) }}" class="filter-tab {{ request('status') === 'cancelled' ? 'active' : '' }}">
            Cancelled
        </a>
    </div>

    @if($visits && count($visits) > 0)
        <div class="visits-table-container fade-up">
            <div class="table-responsive">
                <table class="visits-table">
                    <thead>
                        <tr>
                            <th>Visitor</th>
                            <th>Contact</th>
                            <th>Property</th>
                            <th>Visit Date</th>
                            <th>Visit Time</th>
                            <th>Status</th>
                            <th>Requested On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visits as $visit)
                            <tr>
                                <td>
                                    <div class="visitor-info">
                                        <div class="visitor-avatar">
                                            {{ strtoupper(substr($visit->visitor_name, 0, 1)) }}
                                        </div>
                                        <div class="visitor-details">
                                            <h4>{{ $visit->visitor_name }}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="contact-info">
                                        <div class="contact-item">
                                            <i class="fas fa-phone"></i>
                                            <a href="tel:{{ $visit->visitor_mobile }}">{{ $visit->visitor_mobile }}</a>
                                        </div>
                                        @if($visit->visitor_email)
                                            <div class="contact-item">
                                                <i class="fas fa-envelope"></i>
                                                <a href="mailto:{{ $visit->visitor_email }}">{{ Str::limit($visit->visitor_email, 20) }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="property-ref">
                                        <strong>{{ $visit->property->title ?? 'N/A' }}</strong>
                                        @if($visit->property)
                                            <small>{{ $visit->property->location }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <strong class="date-text">
                                        {{ \Carbon\Carbon::parse($visit->visit_date)->format('M d, Y') }}
                                    </strong>
                                </td>
                                <td>
                                    <span class="time-badge">
                                        <i class="fas fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($visit->visit_time)->format('h:i A') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $visit->status }}">
                                        @if($visit->status === 'pending')
                                            <i class="fas fa-clock"></i> Pending
                                        @elseif($visit->status === 'confirmed')
                                            <i class="fas fa-check-circle"></i> Confirmed
                                        @elseif($visit->status === 'completed')
                                            <i class="fas fa-check-double"></i> Completed
                                        @else
                                            <i class="fas fa-times-circle"></i> Cancelled
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $visit->created_at ? $visit->created_at->diffForHumans() : 'N/A' }}
                                    </small>
                                </td>
                                <td>
                                    <a href="{{ route('real-estate.site-visits.show', $visit->id) }}" class="action-btn-small" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($visits, 'links'))
            <div class="pagination-wrapper fade-up">
                {{ $visits->links() }}
            </div>
        @endif
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h3>No Site Visit Requests Yet</h3>
            <p>When visitors request property viewings, they will appear here.</p>
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
}

.visitor-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.visitor-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--purple-500), #667eea);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.1rem;
}

.visitor-details h4 {
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0;
    color: var(--text-primary);
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
}

.contact-item i {
    color: var(--purple-500);
    font-size: 0.75rem;
}

.contact-item a {
    color: var(--text-secondary);
    text-decoration: none;
}

.contact-item a:hover {
    color: var(--purple-500);
    text-decoration: underline;
}

.property-ref {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.property-ref strong {
    font-size: 0.9rem;
    color: var(--text-primary);
}

.property-ref small {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.date-text {
    font-weight: 600;
    color: var(--text-primary);
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

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.4rem 0.85rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.pending {
    background: rgba(241, 196, 15, 0.1);
    color: #f39c12;
}

.status-badge.confirmed {
    background: rgba(139, 92, 246, 0.1);
    color: var(--purple-500);
}

.status-badge.completed {
    background: rgba(39, 174, 96, 0.1);
    color: var(--success-color);
}

.status-badge.cancelled {
    background: rgba(231, 76, 60, 0.1);
    color: var(--danger-color);
}

.action-btn-small {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    color: var(--text-secondary);
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
}

.action-btn-small:hover {
    background: var(--purple-500);
    border-color: var(--purple-500);
    color: white;
    transform: translateY(-2px);
}

.text-muted {
    color: var(--text-muted);
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
