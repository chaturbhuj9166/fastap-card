@extends('layouts.redesign.dashboard')

@section('title', 'Consultations')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Consultations</h1>
            <p class="content-subtitle">Manage consultation bookings</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Consultation</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/lawyer/consultations') }}" class="form-grid">
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
                    <label class="form-label">Client Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Consultation Type</label>
                    <select name="consultation_type" class="form-input">
                        <option value="physical">Physical</option>
                        <option value="video">Video</option>
                        <option value="phone">Phone</option>
                        <option value="document">Document Review</option>
                    </select>
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
                    <label class="form-label">Practice Area</label>
                    <select name="practice_area" class="form-input">
                        <option value="">Select</option>
                        @foreach($services as $service)
                            <option value="{{ $service->practice_area }}">{{ $service->practice_area }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Consultation Fee</label>
                    <input type="number" name="consultation_fee" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Status</label>
                    <input type="text" name="payment_status" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-input">
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Meeting Link</label>
                    <input type="text" name="meeting_link" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Consultation</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Consultations</h3>
        </div>
        <div class="card-body">
            @if($consultations->count() === 0)
                <p class="empty-state">No consultations yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consultations as $consultation)
                            <tr>
                                <td>{{ $consultation->client_name }}</td>
                                <td>{{ ucfirst($consultation->consultation_type ?? 'physical') }}</td>
                                <td>{{ ucfirst($consultation->status) }}</td>
                                <td>{{ $consultation->appointment_date ? $consultation->appointment_date->format('d M Y') : '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/lawyer/consultations/' . $consultation->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="status" class="form-input form-input-sm">
                                            <option value="scheduled" {{ $consultation->status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                            <option value="completed" {{ $consultation->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $consultation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Update</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/lawyer/consultations/' . $consultation->id) }}" class="inline-form" onsubmit="return confirm('Delete this consultation?');">
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
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-right: 0.5rem; }
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
