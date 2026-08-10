@extends('layouts.redesign.dashboard')

@section('title', 'Event Bookings')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Event Bookings</h1>
            <p class="content-subtitle">Track inquiries and confirmed events</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
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
                                    <form method="POST" action="{{ url('/user/restaurant/events/' . $event->id . '/status') }}" class="inline-form">
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

<style>
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; }
    .form-input-sm { max-width: 140px; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .alert { padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .alert-success { background: #d1fae5; color: #065f46; }
</style>
@endsection
