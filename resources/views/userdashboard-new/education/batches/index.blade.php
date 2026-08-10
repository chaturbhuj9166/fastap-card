@extends('layouts.redesign.dashboard')

@section('title', 'Education Batches')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Batches</h1>
            <p class="content-subtitle">Manage batches and schedules</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Batch</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/education/batches') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Course</label>
                    <select name="course_id" class="form-input">
                        <option value="">Select course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Batch Name</label>
                    <input type="text" name="batch_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Faculty</label>
                    <select name="faculty_id" class="form-input">
                        <option value="">Select faculty</option>
                        @foreach($faculty as $member)
                            <option value="{{ $member->id }}">{{ $member->faculty_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Max Students</label>
                    <input type="number" name="max_students" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Enrolled Students</label>
                    <input type="number" name="enrolled_students" class="form-input" min="0">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Class Schedule (one per line)</label>
                    <textarea name="class_schedule" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Batch</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Batches</h3>
        </div>
        <div class="card-body">
            @if($batches->count() === 0)
                <p class="empty-state">No batches added yet.</p>
            @else
                @foreach($batches as $batch)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $batch->batch_name }}</strong>
                            <span>{{ $batch->start_date?->format('Y-m-d') ?? 'n/a' }}</span>
                        </div>

                        <form method="POST" action="{{ url('/user/education/batches/' . $batch->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Course</label>
                                <select name="course_id" class="form-input">
                                    <option value="">Select course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ $batch->course_id == $course->id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Batch Name</label>
                                <input type="text" name="batch_name" class="form-input" value="{{ $batch->batch_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-input" value="{{ $batch->start_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-input" value="{{ $batch->end_date?->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Faculty</label>
                                <select name="faculty_id" class="form-input">
                                    <option value="">Select faculty</option>
                                    @foreach($faculty as $member)
                                        <option value="{{ $member->id }}" {{ $batch->faculty_id == $member->id ? 'selected' : '' }}>{{ $member->faculty_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Max Students</label>
                                <input type="number" name="max_students" class="form-input" value="{{ $batch->max_students }}" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enrolled</label>
                                <input type="number" name="enrolled_students" class="form-input" value="{{ $batch->enrolled_students }}" min="0">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Class Schedule</label>
                                <textarea name="class_schedule" class="form-input" rows="2">{{ is_array($batch->class_schedule) ? implode("\n", $batch->class_schedule) : '' }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" value="1" {{ $batch->is_active ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/education/batches/' . $batch->id) }}" class="inline-form" onsubmit="return confirm('Delete this batch?');">
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
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
