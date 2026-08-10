@extends('layouts.redesign.company')

@section('page-title', 'Transformations')
@section('breadcrumb', 'Transformations')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Transformations</h2>
            <p>Showcase member transformations</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Transformation</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/fitness/transformations') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Member Name</label>
                    <input type="text" name="member_name" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Program Type</label>
                    <input type="text" name="program_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Duration (Months)</label>
                    <input type="number" name="duration_months" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Weight Lost (kg)</label>
                    <input type="number" name="weight_lost_kg" class="form-input" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Before Photo</label>
                    <input type="file" name="before_photo" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">After Photo</label>
                    <input type="file" name="after_photo" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Testimonial</label>
                    <textarea name="testimonial" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_featured" value="1">
                        <span>Featured</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Transformation</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Transformation Gallery</h3>
        </div>
        <div class="card-body">
            @if($transformations->count() === 0)
                <p class="empty-state">No transformations added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Program</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transformations as $transformation)
                            <tr>
                                <td>{{ $transformation->member_name ?? '-' }}</td>
                                <td>{{ $transformation->program_type ?? '-' }}</td>
                                <td>{{ $transformation->is_featured ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/fitness/transformations/' . $transformation->id) }}" class="inline-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="member_name" class="form-input form-input-sm" value="{{ $transformation->member_name }}">
                                        <input type="text" name="program_type" class="form-input form-input-sm" value="{{ $transformation->program_type }}">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_featured" value="1" {{ $transformation->is_featured ? 'checked' : '' }}>
                                            <span>Featured</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/fitness/transformations/' . $transformation->id) }}" class="inline-form" onsubmit="return confirm('Delete this entry?');">
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
