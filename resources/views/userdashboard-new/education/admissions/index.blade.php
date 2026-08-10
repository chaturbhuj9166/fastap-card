@extends('layouts.redesign.dashboard')

@section('title', 'Admission Applications')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Admissions</h1>
            <p class="content-subtitle">Track admission applications</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Admission</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/education/admissions') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Student Name</label>
                    <input type="text" name="student_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Parent Name</label>
                    <input type="text" name="parent_name" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="mobile" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input">
                </div>
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
                    <label class="form-label">Class/Standard</label>
                    <input type="text" name="class_standard" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Entrance Test Date</label>
                    <input type="date" name="entrance_test_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Entrance Test Score</label>
                    <input type="text" name="entrance_test_score" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Admission Status</label>
                    <input type="text" name="admission_status" class="form-input" placeholder="applied/approved/rejected">
                </div>
                <div class="form-group">
                    <label class="form-label">Seat Allocated</label>
                    <input type="text" name="seat_allocated" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Documents (one per line)</label>
                    <textarea name="documents" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Admission</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Applications</h3>
        </div>
        <div class="card-body">
            @if($admissions->count() === 0)
                <p class="empty-state">No admissions yet.</p>
            @else
                @foreach($admissions as $admission)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $admission->student_name }}</strong>
                            <span>{{ $admission->admission_status ?? 'applied' }}</span>
                        </div>
                        <p class="item-desc">{{ $admission->notes ?? 'No notes yet.' }}</p>

                        <form method="POST" action="{{ url('/user/education/admissions/' . $admission->id . '/status') }}" class="form-grid">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" name="admission_status" class="form-input" value="{{ $admission->admission_status }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Entrance Test Score</label>
                                <input type="text" name="entrance_test_score" class="form-input" value="{{ $admission->entrance_test_score }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Seat Allocated</label>
                                <input type="text" name="seat_allocated" class="form-input" value="{{ $admission->seat_allocated }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-input" rows="2">{{ $admission->notes }}</textarea>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Update Status</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/education/admissions/' . $admission->id) }}" class="inline-form" onsubmit="return confirm('Delete this admission?');">
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
