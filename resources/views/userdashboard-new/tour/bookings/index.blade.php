@extends('layouts.redesign.dashboard')

@section('title', 'Tour Bookings')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Tour Bookings</h1>
            <p class="content-subtitle">Manage travel bookings and inquiries</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Booking</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/tour/bookings') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Package</label>
                    <select name="package_id" class="form-input">
                        <option value="">Select</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Client Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Travel Date</label>
                    <input type="date" name="travel_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Return Date</label>
                    <input type="date" name="return_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Adults</label>
                    <input type="number" name="adults" class="form-input" min="0" value="1">
                </div>
                <div class="form-group">
                    <label class="form-label">Children</label>
                    <input type="number" name="children" class="form-input" min="0" value="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Room Preference</label>
                    <input type="text" name="room_preference" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Total Amount</label>
                    <input type="number" name="total_amount" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Advance Paid</label>
                    <input type="number" name="advance_paid" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="booking_status" class="form-input">
                        <option value="inquiry">Inquiry</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="visa_assistance_needed" value="1">
                        <span>Visa Assistance</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="insurance_needed" value="1">
                        <span>Insurance</span>
                    </label>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Special Requirements</label>
                    <textarea name="special_requirements" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Booking</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bookings</h3>
        </div>
        <div class="card-body">
            @if($bookings->count() === 0)
                <p class="empty-state">No bookings yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Package</th>
                                <th>Status</th>
                                <th>Travel Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->client_name }}</td>
                                <td>{{ $booking->package?->package_name ?? '-' }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $booking->booking_status)) }}</td>
                                <td>{{ $booking->travel_date ? $booking->travel_date->format('d M Y') : '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/tour/bookings/' . $booking->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="booking_status" class="form-input form-input-sm">
                                            <option value="inquiry" {{ $booking->booking_status === 'inquiry' ? 'selected' : '' }}>Inquiry</option>
                                            <option value="confirmed" {{ $booking->booking_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="in_progress" {{ $booking->booking_status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ $booking->booking_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $booking->booking_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Update</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/tour/bookings/' . $booking->id) }}" class="inline-form" onsubmit="return confirm('Delete this booking?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-right: 0.5rem; }
    .form-input-sm { max-width: 160px; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
