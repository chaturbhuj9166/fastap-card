@extends('layouts.redesign.dashboard')

@section('title', 'Class Attendance')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Attendance</h1>
            <p class="content-subtitle">Track class attendance</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Attendance</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/education/attendance') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Batch</label>
                    <select name="batch_id" class="form-input">
                        <option value="">Select batch</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Student Name</label>
                    <input type="text" name="student_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Attendance Date</label>
                    <input type="date" name="attendance_date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <input type="text" name="status" class="form-input" placeholder="present/absent">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Attendance</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Attendance Records</h3>
        </div>
        <div class="card-body">
            @if($attendance->count() === 0)
                <p class="empty-state">No attendance records yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Batch</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendance as $entry)
                            <tr>
                                <td>{{ $entry->student_name }}</td>
                                <td>{{ optional($batches->firstWhere('id', $entry->batch_id))->batch_name ?? 'n/a' }}</td>
                                <td>{{ $entry->attendance_date?->format('Y-m-d') }}</td>
                                <td>{{ $entry->status }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/education/attendance/' . $entry->id) }}" class="inline-form" onsubmit="return confirm('Delete this entry?');">
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
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
