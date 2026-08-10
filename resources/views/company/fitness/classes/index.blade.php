@extends('layouts.redesign.company')

@section('page-title', 'Fitness Classes')
@section('breadcrumb', 'Fitness Classes')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Fitness Classes</h2>
            <p>Manage schedules and class capacity</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Class</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/fitness/classes') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Class Name</label>
                    <input type="text" name="class_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Class Type</label>
                    <input type="text" name="class_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Trainer</label>
                    <select name="trainer_id" class="form-input">
                        <option value="">Select</option>
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}">{{ $trainer->trainer_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Schedule Day</label>
                    <input type="text" name="schedule_day" class="form-input" placeholder="Monday">
                </div>
                <div class="form-group">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="start_time" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">End Time</label>
                    <input type="time" name="end_time" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Max Capacity</label>
                    <input type="number" name="max_capacity" class="form-input" min="0">
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_online" value="1">
                        <span>Online Class</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Class</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Classes</h3>
        </div>
        <div class="card-body">
            @if($classes->count() === 0)
                <p class="empty-state">No classes added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $class)
                            <tr>
                                <td>{{ $class->class_name }}</td>
                                <td>{{ $class->schedule_day ?? '-' }}</td>
                                <td>
                                    {{ $class->start_time ? \Carbon\Carbon::createFromFormat('H:i:s', $class->start_time)->format('h:i A') : '-' }}
                                </td>
                                <td>{{ $class->is_active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/fitness/classes/' . $class->id) }}" class="inline-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="class_name" class="form-input form-input-sm" value="{{ $class->class_name }}" required>
                                        <input type="text" name="schedule_day" class="form-input form-input-sm" value="{{ $class->schedule_day }}">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_active" value="1" {{ $class->is_active ? 'checked' : '' }}>
                                            <span>Active</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/fitness/classes/' . $class->id) }}" class="inline-form" onsubmit="return confirm('Delete this class?');">
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
    .form-input-sm { max-width: 150px; }
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
