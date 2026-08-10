@extends('layouts.redesign.company')

@section('title', 'CA Consultations')

@section('content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Consultations</h1>
            <p class="content-subtitle">Manage appointments and payment status</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Consultation</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/ca/consultations') }}" class="form-grid">
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
                    <label class="form-label">Consultation Type</label>
                    <input type="text" name="consultation_type" class="form-input" placeholder="physical/video/phone">
                </div>
                <div class="form-group">
                    <label class="form-label">Service Category</label>
                    <input type="text" name="service_category" class="form-input" placeholder="taxation/gst">
                </div>
                <div class="form-group">
                    <label class="form-label">Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Appointment Time</label>
                    <input type="text" name="appointment_time" class="form-input" placeholder="11:00 AM">
                </div>
                <div class="form-group">
                    <label class="form-label">Consultation Fee</label>
                    <input type="number" name="consultation_fee" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Status</label>
                    <input type="text" name="payment_status" class="form-input" placeholder="pending/paid">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-input" placeholder="scheduled/completed">
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
                <p class="empty-state">No consultations added yet.</p>
            @else
                @foreach($consultations as $consultation)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $consultation->client_name ?? 'Client' }}</strong>
                            <span>{{ $consultation->status ?? 'scheduled' }}</span>
                        </div>
                        <p class="item-desc">
                            {{ $consultation->consultation_type ?? 'Consultation' }}
                            @if($consultation->appointment_date)
                                • {{ $consultation->appointment_date->format('d M Y') }}
                            @endif
                            @if($consultation->appointment_time)
                                • {{ $consultation->appointment_time }}
                            @endif
                        </p>

                        <form method="POST" action="{{ url('/company/ca/consultations/' . $consultation->id . '/status') }}" class="form-grid">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="status" class="form-input" value="{{ $consultation->status }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Payment Status</label>
                                <input type="text" name="payment_status" class="form-input" value="{{ $consultation->payment_status }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Meeting Link</label>
                                <input type="text" name="meeting_link" class="form-input" value="{{ $consultation->meeting_link }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-input" rows="2">{{ $consultation->notes }}</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Update</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/company/ca/consultations/' . $consultation->id) }}" class="inline-form" onsubmit="return confirm('Delete this consultation?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<style>
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .form-group.full-width { grid-column: 1 / -1; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-top: 0.75rem; }
    .empty-state { color: var(--text-secondary); }
    .item-card { border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .item-header { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.5rem; }
    .item-desc { color: var(--text-secondary); margin-bottom: 1rem; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
