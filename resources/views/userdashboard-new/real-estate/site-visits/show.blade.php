@extends('layouts.redesign.dashboard')

@section('page-title', 'Site Visit Details')
@section('breadcrumb', 'Site Visit Details')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Site Visit Details</h1>
            <p>View and manage site visit request</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('real-estate.site-visits.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="visit-details-container">
        <div class="details-column">
            <!-- Property Details -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-building"></i> Property Details</h3>
                </div>
                <div class="form-card-body">
                    @if($visit->property)
                        <div class="property-card-detail">
                            @php
                                $images = is_string($visit->property->images) ? json_decode($visit->property->images, true) : $visit->property->images;
                                $firstImage = is_array($images) ? ($images[0] ?? null) : null;
                            @endphp
                            @if($firstImage)
                                @php
                                    $imagePath = ltrim($firstImage, '/');
                                    $imageUrl = Str::startsWith($imagePath, 'public/') ? asset($imagePath) : asset('public/' . $imagePath);
                                @endphp
                                <div class="property-image">
                                    <img src="{{ $imageUrl }}" alt="{{ $visit->property->title }}">
                                </div>
                            @endif
                            <div class="property-info-detail">
                                <h3>{{ $visit->property->title }}</h3>
                                <div class="info-badges">
                                    <span class="info-badge">
                                        <i class="fas fa-tag"></i>
                                        {{ ucfirst($visit->property->property_type) }}
                                    </span>
                                    <span class="info-badge">
                                        <i class="fas fa-rupee-sign"></i>
                                        @if($visit->property->profile_type === 'rental')
                                            ₹{{ number_format($visit->property->rental_price) }}/mo
                                        @else
                                            ₹{{ number_format($visit->property->price) }}
                                        @endif
                                    </span>
                                    <span class="info-badge">
                                        <i class="fas fa-expand"></i>
                                        {{ $visit->property->area }} sq ft
                                    </span>
                                </div>
                                <div class="property-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $visit->property->location }}</span>
                                </div>
                                <p class="property-address">{{ $visit->property->address }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-muted">Property information not available</p>
                    @endif
                </div>
            </div>

            <!-- Visitor Information -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-user"></i> Visitor Information</h3>
                </div>
                <div class="form-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Name</label>
                            <p>{{ $visit->visitor_name }}</p>
                        </div>
                        <div class="info-item">
                            <label>Mobile Number</label>
                            <p><a href="tel:{{ $visit->visitor_mobile }}">{{ $visit->visitor_mobile }}</a></p>
                        </div>
                        @if($visit->visitor_email)
                            <div class="info-item">
                                <label>Email Address</label>
                                <p><a href="mailto:{{ $visit->visitor_email }}">{{ $visit->visitor_email }}</a></p>
                            </div>
                        @endif
                    </div>
                    @if($visit->visitor_message)
                        <div class="info-item full-width">
                            <label>Message</label>
                            <p class="visitor-message">{{ $visit->visitor_message }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Visit Schedule -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-calendar-alt"></i> Visit Schedule</h3>
                </div>
                <div class="form-card-body">
                    <div class="schedule-info">
                        <div class="schedule-item">
                            <div class="schedule-icon date">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="schedule-details">
                                <label>Visit Date</label>
                                <p>{{ \Carbon\Carbon::parse($visit->visit_date)->format('l, F d, Y') }}</p>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-icon time">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="schedule-details">
                                <label>Visit Time</label>
                                <p>{{ \Carbon\Carbon::parse($visit->visit_time)->format('h:i A') }}</p>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-icon status">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="schedule-details">
                                <label>Current Status</label>
                                <p>
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
                                </p>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-icon requested">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <div class="schedule-details">
                                <label>Requested On</label>
                                <p>{{ $visit->created_at ? $visit->created_at->format('M d, Y h:i A') : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            @if($visit->notes)
                <div class="form-card fade-up">
                    <div class="form-card-header">
                        <h3><i class="fas fa-sticky-note"></i> Notes</h3>
                    </div>
                    <div class="form-card-body">
                        <div class="notes-content">{{ $visit->notes }}</div>
                    </div>
                </div>
            @endif
        </div>

        <div class="actions-column">
            <!-- Update Status -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-tasks"></i> Update Status</h3>
                </div>
                <div class="form-card-body">
                    <form action="{{ route('real-estate.site-visits.update-status', $visit->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="status">Visit Status</label>
                            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="pending" {{ $visit->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $visit->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $visit->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $visit->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Add Notes -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-comment-alt"></i> Add Notes</h3>
                </div>
                <div class="form-card-body">
                    <form action="{{ route('real-estate.site-visits.add-notes', $visit->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="notes">Internal Notes</label>
                            <textarea id="notes" name="notes" rows="5"
                                      class="form-control @error('notes') is-invalid @enderror"
                                      placeholder="Add notes about this visit request...">{{ old('notes', $visit->notes) }}</textarea>
                            @error('notes')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Save Notes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                </div>
                <div class="form-card-body">
                    <div class="quick-actions">
                        <a href="tel:{{ $visit->visitor_mobile }}" class="btn btn-outline btn-block">
                            <i class="fas fa-phone"></i> Call Visitor
                        </a>
                        @if($visit->visitor_email)
                            <a href="mailto:{{ $visit->visitor_email }}" class="btn btn-outline btn-block">
                                <i class="fas fa-envelope"></i> Email Visitor
                            </a>
                        @endif
                        @if($visit->property)
                            <a href="{{ route('real-estate.properties.edit', $visit->property->id) }}" class="btn btn-outline btn-block">
                                <i class="fas fa-building"></i> View Property
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.visit-details-container {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;
}

.details-column,
.actions-column {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.property-card-detail {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.property-image {
    width: 100%;
    aspect-ratio: 16/9;
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.property-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.property-info-detail h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.75rem;
}

.info-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.info-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.4rem 0.75rem;
    background: var(--bg-secondary);
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 500;
}

.info-badge i {
    color: var(--purple-500);
}

.property-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.property-location i {
    color: var(--purple-500);
}

.property-address {
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.5;
    margin: 0;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.info-item {
    display: flex;
    flex-direction: column;
}

.info-item.full-width {
    grid-column: 1 / -1;
}

.info-item label {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.info-item p {
    font-size: 0.95rem;
    color: var(--text-color);
    margin: 0;
}

.info-item a {
    color: var(--purple-500);
    text-decoration: none;
}

.info-item a:hover {
    text-decoration: underline;
}

.visitor-message {
    background: var(--bg-secondary);
    padding: 1rem;
    border-radius: 8px;
    border-left: 3px solid var(--purple-500);
    white-space: pre-wrap;
}

.schedule-info {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.schedule-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.schedule-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.schedule-icon.date {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
    color: var(--purple-500);
}

.schedule-icon.time {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%);
    color: #3b82f6;
}

.schedule-icon.status {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(52, 211, 153, 0.15) 100%);
    color: var(--success-color);
}

.schedule-icon.requested {
    background: linear-gradient(135deg, rgba(249, 115, 22, 0.15) 0%, rgba(251, 146, 60, 0.15) 100%);
    color: #f97316;
}

.schedule-details {
    flex: 1;
}

.schedule-details label {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.35rem;
    display: block;
}

.schedule-details p {
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--text-primary);
    margin: 0;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.4rem 0.85rem;
    border-radius: 12px;
    font-size: 0.8rem;
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

.notes-content {
    background: var(--bg-secondary);
    padding: 1.25rem;
    border-radius: 8px;
    white-space: pre-wrap;
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.6;
}

.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.btn-block {
    width: 100%;
    justify-content: center;
}

.text-muted {
    color: var(--text-muted);
}

@media (max-width: 992px) {
    .visit-details-container {
        grid-template-columns: 1fr;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@include('userdashboard-new.partials.form-page-styles')
@endsection
