@extends('layouts.redesign.dashboard')

@section('title', 'Public Events')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Public Events</h1>
            <p class="content-subtitle">Manage meetings and community events</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Event</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/political/events') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Event Title</label>
                    <input type="text" name="event_title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Event Type</label>
                    <input type="text" name="event_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Event Date</label>
                    <input type="date" name="event_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Event Time</label>
                    <input type="time" name="event_time" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Expected Attendees</label>
                    <input type="number" name="expected_attendees" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Contact Name</label>
                    <input type="text" name="contact_name" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Contact Mobile</label>
                    <input type="text" name="contact_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-input" placeholder="scheduled/completed/cancelled">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Event</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Events</h3>
        </div>
        <div class="card-body">
            @if($events->count() === 0)
                <p class="empty-state">No events added yet.</p>
            @else
                @foreach($events as $event)
                    <div class="item-card">
                        <form method="POST" action="{{ url('/user/political/events/' . $event->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Event Title</label>
                                <input type="text" name="event_title" class="form-input" value="{{ $event->event_title }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Event Type</label>
                                <input type="text" name="event_type" class="form-input" value="{{ $event->event_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Event Date</label>
                                <input type="date" name="event_date" class="form-input" value="{{ $event->event_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Event Time</label>
                                <input type="time" name="event_time" class="form-input" value="{{ $event->event_time }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" class="form-input" value="{{ $event->location }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Expected Attendees</label>
                                <input type="number" name="expected_attendees" class="form-input" min="0" value="{{ $event->expected_attendees }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Contact Name</label>
                                <input type="text" name="contact_name" class="form-input" value="{{ $event->contact_name }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Contact Mobile</label>
                                <input type="text" name="contact_mobile" class="form-input" value="{{ $event->contact_mobile }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="status" class="form-input" value="{{ $event->status }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="3">{{ $event->description }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" value="1" {{ $event->is_active ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ url('/user/political/events/' . $event->id) }}" class="inline-form" onsubmit="return confirm('Delete this event?');">
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
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
