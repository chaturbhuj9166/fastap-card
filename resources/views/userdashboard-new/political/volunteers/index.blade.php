@extends('layouts.redesign.dashboard')

@section('title', 'Volunteers')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Volunteers</h1>
            <p class="content-subtitle">Manage party volunteers and teams</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Volunteer</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/political/volunteers') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Volunteer Name</label>
                    <input type="text" name="volunteer_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="volunteer_mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="volunteer_email" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <input type="text" name="role" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Area</label>
                    <input type="text" name="area" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Joined Date</label>
                    <input type="date" name="joined_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-input" placeholder="active/inactive">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Volunteer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Volunteers</h3>
        </div>
        <div class="card-body">
            @if($volunteers->count() === 0)
                <p class="empty-state">No volunteers added yet.</p>
            @else
                @foreach($volunteers as $volunteer)
                    <div class="item-card">
                        <form method="POST" action="{{ url('/user/political/volunteers/' . $volunteer->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Volunteer Name</label>
                                <input type="text" name="volunteer_name" class="form-input" value="{{ $volunteer->volunteer_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mobile</label>
                                <input type="text" name="volunteer_mobile" class="form-input" value="{{ $volunteer->volunteer_mobile }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="volunteer_email" class="form-input" value="{{ $volunteer->volunteer_email }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <input type="text" name="role" class="form-input" value="{{ $volunteer->role }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Area</label>
                                <input type="text" name="area" class="form-input" value="{{ $volunteer->area }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Joined Date</label>
                                <input type="date" name="joined_date" class="form-input" value="{{ $volunteer->joined_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="status" class="form-input" value="{{ $volunteer->status }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-input" rows="2">{{ $volunteer->notes }}</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ url('/user/political/volunteers/' . $volunteer->id) }}" class="inline-form" onsubmit="return confirm('Delete this volunteer?');">
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
