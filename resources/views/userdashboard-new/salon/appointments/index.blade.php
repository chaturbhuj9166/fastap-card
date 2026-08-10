@extends('layouts.redesign.dashboard')

@section('title', 'Salon Appointments')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Salon Appointments</h1>
            <p class="content-subtitle">Manage bookings and schedules</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Appointment</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/salon/appointments') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Appointment Time</label>
                    <input type="time" name="appointment_time" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Services</label>
                    <select name="services[]" class="form-input" multiple>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Artist</label>
                    <select name="artist_id" class="form-input">
                        <option value="">Select</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->artist_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <select name="location" class="form-input">
                        <option value="salon">Salon</option>
                        <option value="home">Home</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Home Address</label>
                    <input type="text" name="home_address" class="form-input">
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
                    <select name="status" class="form-input">
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="no_show">No Show</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Appointment</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Appointments</h3>
        </div>
        <div class="card-body">
            @if($appointments->count() === 0)
                <p class="empty-state">No appointments yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Artist</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->client_name }}</td>
                                <td>{{ $appointment->appointment_date ? $appointment->appointment_date->format('d M Y') : '-' }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $appointment->status)) }}</td>
                                <td>{{ $appointment->artist?->artist_name ?? '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/salon/appointments/' . $appointment->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="status" class="form-input form-input-sm">
                                            <option value="scheduled" {{ $appointment->status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                            <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="no_show" {{ $appointment->status === 'no_show' ? 'selected' : '' }}>No Show</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Update</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/salon/appointments/' . $appointment->id) }}" class="inline-form" onsubmit="return confirm('Delete this appointment?');">
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
