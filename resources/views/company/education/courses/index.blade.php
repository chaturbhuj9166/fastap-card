@extends('layouts.redesign.company')

@section('page-title', 'Education Courses')
@section('breadcrumb', 'Education Courses')

@section('company-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Courses</h1>
            <p class="content-subtitle">Manage education courses and batches</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Course</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/education/courses') }}" class="form-grid">
                @csrf
                <div class="form-group">
                    <label class="form-label">Course Name</label>
                    <input type="text" name="course_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Course Category</label>
                    <input type="text" name="course_category" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Board/Exam</label>
                    <input type="text" name="board_exam" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Class/Standard</label>
                    <input type="text" name="class_standard" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Batch Type</label>
                    <input type="text" name="batch_type" class="form-input" placeholder="regular/weekend">
                </div>
                <div class="form-group">
                    <label class="form-label">Mode</label>
                    <input type="text" name="mode" class="form-input" placeholder="online/offline">
                </div>
                <div class="form-group">
                    <label class="form-label">Duration (months)</label>
                    <input type="number" name="duration_months" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Fee Structure</label>
                    <input type="text" name="fee_structure" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Subjects (one per line)</label>
                    <textarea name="subjects" class="form-input" rows="3"></textarea>
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
                    <button type="submit" class="btn btn-primary">Create Course</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Courses</h3>
        </div>
        <div class="card-body">
            @if($courses->count() === 0)
                <p class="empty-state">No courses added yet.</p>
            @else
                @foreach($courses as $course)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $course->course_name }}</strong>
                            <span>{{ $course->course_category ?? 'General' }} · {{ $course->mode ?? 'n/a' }}</span>
                        </div>
                        <p class="item-desc">{{ $course->description ?? 'No description yet.' }}</p>

                        <form method="POST" action="{{ url('/company/education/courses/' . $course->id) }}" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Course Name</label>
                                <input type="text" name="course_name" class="form-input" value="{{ $course->course_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <input type="text" name="course_category" class="form-input" value="{{ $course->course_category }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Board/Exam</label>
                                <input type="text" name="board_exam" class="form-input" value="{{ $course->board_exam }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Class/Standard</label>
                                <input type="text" name="class_standard" class="form-input" value="{{ $course->class_standard }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Batch Type</label>
                                <input type="text" name="batch_type" class="form-input" value="{{ $course->batch_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mode</label>
                                <input type="text" name="mode" class="form-input" value="{{ $course->mode }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Duration</label>
                                <input type="number" name="duration_months" class="form-input" value="{{ $course->duration_months }}" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Fee Structure</label>
                                <input type="text" name="fee_structure" class="form-input" value="{{ $course->fee_structure }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Subjects</label>
                                <textarea name="subjects" class="form-input" rows="2">{{ is_array($course->subjects) ? implode("\n", $course->subjects) : '' }}</textarea>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="2">{{ $course->description }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" value="1" {{ $course->is_active ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/company/education/courses/' . $course->id) }}" class="inline-form" onsubmit="return confirm('Delete this course?');">
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

