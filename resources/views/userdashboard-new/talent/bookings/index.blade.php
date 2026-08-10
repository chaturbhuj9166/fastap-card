@extends('layouts.redesign.dashboard')

@section('page-title', 'My Bookings')
@section('breadcrumb', 'Bookings')

@section('dashboard-content')
<div class="bookings-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>My Bookings</h1>
            <p>Manage your talent booking requests and reservations</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="stats-row fade-up">
        @php
            $pendingCount = $bookings->where('status', 'pending')->count();
            $confirmedCount = $bookings->where('status', 'confirmed')->count();
            $completedCount = $bookings->where('status', 'completed')->count();
            $cancelledCount = $bookings->where('status', 'cancelled')->count();
        @endphp
        <div class="stat-mini-card">
            <div class="stat-mini-icon yellow">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $pendingCount }}</span>
                <span class="stat-mini-label">Pending</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon blue">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $confirmedCount }}</span>
                <span class="stat-mini-label">Confirmed</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon green">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $completedCount }}</span>
                <span class="stat-mini-label">Completed</span>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon red">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-mini-info">
                <span class="stat-mini-value">{{ $cancelledCount }}</span>
                <span class="stat-mini-label">Cancelled</span>
            </div>
        </div>
    </div>

    <div class="filter-bar fade-up">
        <div class="filter-tabs">
            <a href="?status=all" class="filter-tab {{ !request('status') || request('status') == 'all' ? 'active' : '' }}">
                All Bookings
            </a>
            <a href="?status=pending" class="filter-tab {{ request('status') == 'pending' ? 'active' : '' }}">
                Pending
            </a>
            <a href="?status=confirmed" class="filter-tab {{ request('status') == 'confirmed' ? 'active' : '' }}">
                Confirmed
            </a>
            <a href="?status=completed" class="filter-tab {{ request('status') == 'completed' ? 'active' : '' }}">
                Completed
            </a>
            <a href="?status=cancelled" class="filter-tab {{ request('status') == 'cancelled' ? 'active' : '' }}">
                Cancelled
            </a>
        </div>
        <div class="filter-section">
            <select class="filter-select" onchange="window.location.href='?talent_type=' + this.value + '{{ request('status') ? '&status=' . request('status') : '' }}'">
                <option value="">All Talent Types</option>
                <option value="actor" {{ request('talent_type') == 'actor' ? 'selected' : '' }}>Actor</option>
                <option value="model" {{ request('talent_type') == 'model' ? 'selected' : '' }}>Model</option>
                <option value="singer" {{ request('talent_type') == 'singer' ? 'selected' : '' }}>Singer</option>
                <option value="dancer" {{ request('talent_type') == 'dancer' ? 'selected' : '' }}>Dancer</option>
                <option value="youtuber" {{ request('talent_type') == 'youtuber' ? 'selected' : '' }}>YouTuber</option>
                <option value="music_producer" {{ request('talent_type') == 'music_producer' ? 'selected' : '' }}>Music Producer</option>
                <option value="anchor" {{ request('talent_type') == 'anchor' ? 'selected' : '' }}>Anchor</option>
                <option value="influencer" {{ request('talent_type') == 'influencer' ? 'selected' : '' }}>Influencer</option>
                <option value="custom" {{ request('talent_type') == 'custom' ? 'selected' : '' }}>Custom Talent</option>
            </select>
        </div>
    </div>

    @if($bookings && count($bookings) > 0)
        <div class="bookings-grid stagger-animation">
            @foreach($bookings as $booking)
                <div class="booking-card fade-up">
                    <div class="booking-header">
                        <div class="client-info">
                            <div class="client-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="client-details">
                                <h4>{{ $booking->client_name }}</h4>
                                <p>{{ $booking->client_email }}</p>
                            </div>
                        </div>
                        <div class="booking-status">
                            <span class="status-badge {{ $booking->status }}">
                                @if($booking->status == 'pending')
                                    <i class="fas fa-clock"></i> Pending
                                @elseif($booking->status == 'confirmed')
                                    <i class="fas fa-check-circle"></i> Confirmed
                                @elseif($booking->status == 'completed')
                                    <i class="fas fa-calendar-check"></i> Completed
                                @else
                                    <i class="fas fa-times-circle"></i> Cancelled
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="booking-body">
                        @if($booking->talent_type)
                            <div class="booking-talent-type">
                                <span class="talent-badge {{ $booking->talent_type }}">
                                    {{ ucfirst(str_replace('_', ' ', $booking->talent_type)) }}
                                </span>
                            </div>
                        @endif
                        <div class="booking-details-row">
                            <div class="detail-item">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <small>Event Date</small>
                                    <strong>{{ \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') }}</strong>
                                </div>
                            </div>
                            @if($booking->event_time)
                                <div class="detail-item">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <small>Time</small>
                                        <strong>{{ \Carbon\Carbon::parse($booking->event_time)->format('h:i A') }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if($booking->event_type)
                            <div class="booking-event-type">
                                <i class="fas fa-tag"></i>
                                <span>{{ $booking->event_type }}</span>
                            </div>
                        @endif
                        @if($booking->location)
                            <div class="booking-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ Str::limit($booking->location, 50) }}</span>
                            </div>
                        @endif
                        <div class="booking-payment">
                            <div class="payment-status">
                                <span class="payment-badge {{ $booking->payment_status }}">
                                    @if($booking->payment_status == 'paid')
                                        <i class="fas fa-check-circle"></i> Paid
                                    @elseif($booking->payment_status == 'partial')
                                        <i class="fas fa-clock"></i> Partial
                                    @else
                                        <i class="fas fa-exclamation-circle"></i> Pending
                                    @endif
                                </span>
                            </div>
                            <div class="payment-amount">
                                <span class="amount">₹{{ number_format($booking->total_amount) }}</span>
                            </div>
                        </div>
                        <p class="booking-date">Booked {{ $booking->created_at ? $booking->created_at->diffForHumans() : 'N/A' }}</p>
                    </div>
                    <div class="booking-actions">
                        <a href="{{ route('talent.bookings.show', $booking->id) }}" class="action-btn primary" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if($booking->client_phone)
                            <a href="tel:{{ $booking->client_phone }}" class="action-btn success" title="Call Client">
                                <i class="fas fa-phone"></i>
                            </a>
                        @endif
                        <a href="mailto:{{ $booking->client_email }}" class="action-btn" title="Email Client">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-calendar-times"></i>
            </div>
            <h3>No Bookings Found</h3>
            <p>You don't have any bookings yet. Share your talent profile to start receiving booking requests.</p>
        </div>
    @endif
</div>

<style>
.filter-bar {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-sm);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    flex: 1;
}

.filter-tab {
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    background: var(--bg-secondary);
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
}

.filter-tab:hover {
    background: var(--bg-tertiary);
    color: var(--text-color);
}

.filter-tab.active {
    background: var(--primary-color);
    color: white;
}

.filter-section {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.filter-select {
    padding: 0.5rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background: var(--bg-secondary);
    color: var(--text-color);
    font-size: 0.875rem;
    cursor: pointer;
    min-width: 180px;
}

.bookings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
}

.booking-card {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
}

.booking-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.booking-header {
    padding: 1.25rem;
    background: var(--bg-secondary);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border-bottom: 1px solid var(--border-color);
}

.client-info {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.client-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), #667eea);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.client-details h4 {
    margin: 0 0 0.25rem;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-color);
}

.client-details p {
    margin: 0;
    font-size: 0.8rem;
    color: var(--text-muted);
}

.booking-status .status-badge {
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
    background: rgba(52, 152, 219, 0.1);
    color: #3498db;
}

.status-badge.completed {
    background: rgba(39, 174, 96, 0.1);
    color: var(--success-color);
}

.status-badge.cancelled {
    background: rgba(231, 76, 60, 0.1);
    color: var(--danger-color);
}

.booking-body {
    padding: 1.25rem;
}

.booking-talent-type {
    margin-bottom: 1rem;
}

.talent-badge {
    display: inline-block;
    padding: 0.4rem 0.85rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: capitalize;
}

.talent-badge.actor,
.talent-badge.model,
.talent-badge.singer,
.talent-badge.dancer,
.talent-badge.youtuber,
.talent-badge.music_producer,
.talent-badge.anchor,
.talent-badge.influencer,
.talent-badge.custom {
    background: rgba(139, 92, 246, 0.1);
    color: var(--purple-500);
}

.booking-details-row {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.detail-item {
    display: flex;
    gap: 0.75rem;
    align-items: flex-start;
}

.detail-item i {
    color: var(--primary-color);
    font-size: 1rem;
    margin-top: 0.25rem;
}

.detail-item small {
    display: block;
    font-size: 0.7rem;
    color: var(--text-muted);
    margin-bottom: 0.15rem;
}

.detail-item strong {
    font-size: 0.875rem;
    color: var(--text-color);
}

.booking-event-type,
.booking-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-bottom: 0.75rem;
}

.booking-event-type i,
.booking-location i {
    color: var(--primary-color);
    width: 16px;
}

.booking-payment {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: 8px;
    margin-bottom: 0.75rem;
}

.payment-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.35rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.payment-badge.paid {
    background: rgba(39, 174, 96, 0.1);
    color: var(--success-color);
}

.payment-badge.partial {
    background: rgba(241, 196, 15, 0.1);
    color: #f39c12;
}

.payment-badge.pending {
    background: rgba(231, 76, 60, 0.1);
    color: var(--danger-color);
}

.payment-amount .amount {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--success-color);
}

.booking-date {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin: 0;
}

.booking-actions {
    display: flex;
    border-top: 1px solid var(--border-color);
    padding: 0.75rem 1.25rem;
    gap: 0.5rem;
    justify-content: flex-end;
}

.stat-mini-icon.yellow {
    background: linear-gradient(135deg, #f39c12, #e67e22);
}

.stat-mini-icon.red {
    background: linear-gradient(135deg, var(--danger-color), #c0392b);
}

@media (max-width: 768px) {
    .bookings-grid {
        grid-template-columns: 1fr;
    }

    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-tabs {
        flex-direction: column;
    }

    .filter-tab {
        text-align: center;
    }

    .filter-select {
        width: 100%;
    }
}
</style>
@include('userdashboard-new.partials.content-page-styles')
@endsection
