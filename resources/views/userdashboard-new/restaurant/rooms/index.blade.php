@extends('layouts.redesign.dashboard')

@section('title', 'Hotel Rooms')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Hotel Rooms</h1>
            <p class="content-subtitle">Manage room QR codes and availability</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Room</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/restaurant/rooms') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Room Number</label>
                    <input type="text" name="room_number" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Room Type</label>
                    <input type="text" name="room_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Floor</label>
                    <input type="text" name="floor" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Max Occupancy</label>
                    <input type="number" name="max_occupancy" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Profile</label>
                    <select name="profile_id" class="form-input">
                        <option value="">Default</option>
                        @foreach($profiles as $profile)
                            <option value="{{ $profile->id }}">{{ $profile->profile_name ?? ucfirst($profile->profile_type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Room</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rooms</h3>
        </div>
        <div class="card-body">
            @if($rooms->count() === 0)
                <p class="empty-state">No rooms added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Type</th>
                                <th>Floor</th>
                                <th>Occupancy</th>
                                <th>Status</th>
                                <th>QR</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr>
                                <td>{{ $room->room_number }}</td>
                                <td>{{ $room->room_type ?? '-' }}</td>
                                <td>{{ $room->floor ?? '-' }}</td>
                                <td>{{ $room->max_occupancy ?? '-' }}</td>
                                <td>{{ ucfirst($room->status) }}</td>
                                <td>
                                    @if($room->qr_code_path)
                                        <a href="{{ asset($room->qr_code_path) }}" target="_blank">View</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('/user/restaurant/rooms/' . $room->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="room_number" class="form-input form-input-sm" value="{{ $room->room_number }}" required>
                                        <input type="text" name="room_type" class="form-input form-input-sm" value="{{ $room->room_type }}">
                                        <select name="status" class="form-input form-input-sm">
                                            <option value="vacant" {{ $room->status === 'vacant' ? 'selected' : '' }}>Vacant</option>
                                            <option value="occupied" {{ $room->status === 'occupied' ? 'selected' : '' }}>Occupied</option>
                                            <option value="cleaning" {{ $room->status === 'cleaning' ? 'selected' : '' }}>Cleaning</option>
                                            <option value="maintenance" {{ $room->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/restaurant/rooms/' . $room->id . '/qr') }}" class="inline-form">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary">Regenerate QR</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/restaurant/rooms/' . $room->id) }}" class="inline-form" onsubmit="return confirm('Delete this room?');">
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
    .form-grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); align-items: end; }
    .form-actions { display: flex; justify-content: flex-end; }
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-right: 0.5rem; }
    .form-input-sm { max-width: 130px; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-secondary { background: #0ea5e9; color: #fff; border: none; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
    .alert { padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .alert-success { background: #d1fae5; color: #065f46; }
    .alert-danger { background: #fee2e2; color: #991b1b; }
</style>
@endsection
