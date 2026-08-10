@extends('layouts.redesign.company')

@section('page-title', 'Class Bookings')
@section('breadcrumb', 'Class Bookings')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Class Bookings</h2>
            <p>Manage class inquiries and attendance</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Booking</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/fitness/bookings') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Class</label>
                    <select name="class_id" class="form-input">
                        <option value="">Select</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Member Name</label>
                    <input type="text" name="member_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Member Mobile</label>
                    <input type="text" name="member_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Booking Date</label>
                    <input type="date" name="booking_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="booking_status" class="form-input">
                        <option value="confirmed">Confirmed</option>
                        <option value="waitlist">Waitlist</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="attended">Attended</option>
                        <option value="inquiry">Inquiry</option>
                    </select>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_trial" value="1">
                        <span>Trial</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Booking</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Bookings</h3>
        </div>
        <div class="card-body">
            @if($bookings->count() === 0)
                <p class="empty-state">No bookings yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->member_name }}</td>
                                <td>{{ $booking->fitnessClass?->class_name ?? '-' }}</td>
                                <td>{{ ucfirst($booking->booking_status) }}</td>
                                <td>{{ $booking->booking_date ? $booking->booking_date->format('d M Y') : '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/fitness/bookings/' . $booking->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="booking_status" class="form-input form-input-sm">
                                            <option value="confirmed" {{ $booking->booking_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="waitlist" {{ $booking->booking_status === 'waitlist' ? 'selected' : '' }}>Waitlist</option>
                                            <option value="cancelled" {{ $booking->booking_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="attended" {{ $booking->booking_status === 'attended' ? 'selected' : '' }}>Attended</option>
                                            <option value="inquiry" {{ $booking->booking_status === 'inquiry' ? 'selected' : '' }}>Inquiry</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Update</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/fitness/bookings/' . $booking->id) }}" class="inline-form" onsubmit="return confirm('Delete this booking?');">
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
