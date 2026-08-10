@extends('layouts.redesign.company')

@section('page-title', 'Event Bookings')
@section('breadcrumb', 'Event Bookings')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Event Bookings</h2>
            <p>Track inquiries and confirmed events</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="settings-card">
        <div class="card-body">
            @if($events->count() === 0)
                <p class="empty-state">No event bookings yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Guests</th>
                                <th>Status</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{ $event->client_name ?? '-' }}</td>
                                <td>{{ $event->event_type ?? '-' }}</td>
                                <td>{{ $event->event_date ? $event->event_date->format('d M Y') : '-' }}</td>
                                <td>{{ $event->guest_count ?? '-' }}</td>
                                <td>{{ ucfirst($event->booking_status) }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/restaurant/events/' . $event->id . '/status') }}" class="inline-form">
                                        @csrf
                                        <select name="booking_status" class="form-input form-input-sm">
                                            <option value="inquiry" {{ $event->booking_status === 'inquiry' ? 'selected' : '' }}>Inquiry</option>
                                            <option value="confirmed" {{ $event->booking_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="cancelled" {{ $event->booking_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="completed" {{ $event->booking_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $events->links() }}
            @endif
        </div>
    </div>
</div>

@push('page-styles')
<style>
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; }
    .form-input-sm { max-width: 140px; }
    .empty-state { color: var(--text-muted); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .alert-success { background: #d1fae5; color: #065f46; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .settings-card { margin-bottom: 1.5rem; }
    .card-body { padding: 1.5rem; }
    .card-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); }
</style>
@endpush
@endsection
