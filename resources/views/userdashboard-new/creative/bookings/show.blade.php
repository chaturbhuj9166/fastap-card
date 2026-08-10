@extends('layouts.redesign.dashboard')

@section('page-title', 'Booking Details')
@section('breadcrumb', 'Booking Details')

@section('dashboard-content')
<div class="form-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Booking Details</h1>
            <p>View and manage booking information</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('user.creative.bookings.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="booking-details-container">
        <div class="details-column">
            <!-- Client Information -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-user"></i> Client Information</h3>
                </div>
                <div class="form-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Client Name</label>
                            <p>{{ $booking->client_name }}</p>
                        </div>
                        <div class="info-item">
                            <label>Email</label>
                            <p><a href="mailto:{{ $booking->client_email }}">{{ $booking->client_email }}</a></p>
                        </div>
                        @if($booking->client_phone)
                            <div class="info-item">
                                <label>Phone</label>
                                <p><a href="tel:{{ $booking->client_phone }}">{{ $booking->client_phone }}</a></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Event Details -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-calendar-alt"></i> Event Details</h3>
                </div>
                <div class="form-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Event Date</label>
                            <p>{{ \Carbon\Carbon::parse($booking->event_date)->format('F d, Y') }}</p>
                        </div>
                        @if($booking->event_time)
                            <div class="info-item">
                                <label>Event Time</label>
                                <p>{{ \Carbon\Carbon::parse($booking->event_time)->format('h:i A') }}</p>
                            </div>
                        @endif
                        @if($booking->service_type)
                            <div class="info-item">
                                <label>Service Type</label>
                                <p>{{ ucfirst($booking->service_type) }}</p>
                            </div>
                        @endif
                        @if($booking->location)
                            <div class="info-item full-width">
                                <label>Location</label>
                                <p>{{ $booking->location }}</p>
                            </div>
                        @endif
                        @if($booking->event_type)
                            <div class="info-item">
                                <label>Event Type</label>
                                <p>{{ $booking->event_type }}</p>
                            </div>
                        @endif
                        @if($booking->guests_count)
                            <div class="info-item">
                                <label>Number of Guests</label>
                                <p>{{ $booking->guests_count }}</p>
                            </div>
                        @endif
                    </div>
                    @if($booking->special_requests)
                        <div class="info-item full-width">
                            <label>Special Requests</label>
                            <p class="special-requests">{{ $booking->special_requests }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment Information -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-money-bill-wave"></i> Payment Information</h3>
                </div>
                <div class="form-card-body">
                    <div class="payment-summary">
                        <div class="payment-row">
                            <span>Total Amount</span>
                            <strong class="amount-large">₹{{ number_format($booking->total_amount) }}</strong>
                        </div>
                        @if($booking->advance_paid)
                            <div class="payment-row">
                                <span>Advance Paid</span>
                                <span class="amount-paid">₹{{ number_format($booking->advance_paid) }}</span>
                            </div>
                            <div class="payment-row">
                                <span>Balance Due</span>
                                <span class="amount-due">₹{{ number_format($booking->total_amount - $booking->advance_paid) }}</span>
                            </div>
                        @endif
                        <div class="payment-row">
                            <span>Payment Status</span>
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
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($booking->notes)
                <div class="form-card fade-up">
                    <div class="form-card-header">
                        <h3><i class="fas fa-sticky-note"></i> Notes</h3>
                    </div>
                    <div class="form-card-body">
                        <div class="notes-content">{{ $booking->notes }}</div>
                    </div>
                </div>
            @endif
        </div>

        <div class="actions-column">
            <!-- Status Update -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-tasks"></i> Update Status</h3>
                </div>
                <div class="form-card-body">
                    <form action="{{ route('user.creative.bookings.update-status', $booking->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="status">Booking Status</label>
                            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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

            <!-- Payment Update -->
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-credit-card"></i> Update Payment</h3>
                </div>
                <div class="form-card-body">
                    <form action="{{ route('user.creative.bookings.update-payment', $booking->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="payment_status">Payment Status</label>
                            <select id="payment_status" name="payment_status" class="form-control @error('payment_status') is-invalid @enderror">
                                <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="partial" {{ $booking->payment_status == 'partial' ? 'selected' : '' }}>Partial</option>
                                <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                            @error('payment_status')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="advance_paid">Advance Paid (₹)</label>
                            <input type="number" id="advance_paid" name="advance_paid"
                                   value="{{ old('advance_paid', $booking->advance_paid) }}"
                                   class="form-control @error('advance_paid') is-invalid @enderror"
                                   placeholder="0.00" min="0" step="0.01">
                            @error('advance_paid')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Update Payment
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
                    <form action="{{ route('user.creative.bookings.add-notes', $booking->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea id="notes" name="notes" rows="4"
                                      class="form-control @error('notes') is-invalid @enderror"
                                      placeholder="Add internal notes about this booking...">{{ old('notes', $booking->notes) }}</textarea>
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
                        <a href="mailto:{{ $booking->client_email }}" class="btn btn-outline btn-block">
                            <i class="fas fa-envelope"></i> Email Client
                        </a>
                        @if($booking->client_phone)
                            <a href="tel:{{ $booking->client_phone }}" class="btn btn-outline btn-block">
                                <i class="fas fa-phone"></i> Call Client
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.booking-details-container {
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
    color: var(--primary-color);
    text-decoration: none;
}

.info-item a:hover {
    text-decoration: underline;
}

.special-requests {
    background: var(--bg-secondary);
    padding: 1rem;
    border-radius: 8px;
    border-left: 3px solid var(--primary-color);
    white-space: pre-wrap;
}

.payment-summary {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.payment-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--border-color);
}

.payment-row:last-child {
    border-bottom: none;
}

.amount-large {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--success-color);
}

.amount-paid {
    font-weight: 600;
    color: var(--success-color);
}

.amount-due {
    font-weight: 600;
    color: var(--danger-color);
}

.payment-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.4rem 0.85rem;
    border-radius: 12px;
    font-size: 0.8rem;
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

@media (max-width: 992px) {
    .booking-details-container {
        grid-template-columns: 1fr;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@include('userdashboard-new.partials.form-page-styles')
@endsection
