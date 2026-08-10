@extends('layouts.redesign.company')

@section('page-title', 'Study Materials')
@section('breadcrumb', 'Study Materials')

@section('company-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Study Materials</h1>
            <p class="content-subtitle">Upload and share materials</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Material</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/education/materials') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-input" required>
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
                    <label class="form-label">Batch</label>
                    <select name="batch_id" class="form-input">
                        <option value="">Select batch</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Material Type</label>
                    <input type="text" name="material_type" class="form-input" placeholder="pdf/video/notes">
                </div>
                <div class="form-group">
                    <label class="form-label">Upload File</label>
                    <input type="file" name="material_file" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">External Link</label>
                    <input type="text" name="external_link" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Material</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Materials</h3>
        </div>
        <div class="card-body">
            @if($materials->count() === 0)
                <p class="empty-state">No materials added yet.</p>
            @else
                @foreach($materials as $material)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $material->title }}</strong>
                            <span>{{ $material->material_type ?? 'material' }}</span>
                        </div>
                        <p class="item-desc">{{ $material->description ?? 'No description.' }}</p>
                        <form method="POST" action="{{ url('/company/education/materials/' . $material->id) }}" class="inline-form" onsubmit="return confirm('Delete this material?');">
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
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-top: 0.5rem; }
    .empty-state { color: var(--text-secondary); }
    .item-card { border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .item-header { display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.5rem; }
    .item-desc { color: var(--text-secondary); }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection

