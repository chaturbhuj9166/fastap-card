@extends('layouts.redesign.company')

@section('page-title', 'Production Portfolio')
@section('breadcrumb', 'Production Portfolio')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Production Portfolio</h2>
            <p>Showcase the company portfolio</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Portfolio Item</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/production/portfolios') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="project_title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Project Type</label>
                    <input type="text" name="project_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Video URL</label>
                    <input type="url" name="video_url" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Production Date</label>
                    <input type="date" name="production_date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Thumbnail Image</label>
                    <input type="file" name="thumbnail_image" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Gallery Images</label>
                    <input type="file" name="images[]" class="form-input" multiple>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_featured" value="1">
                        <span>Featured</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Portfolio</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Portfolio Items</h3>
        </div>
        <div class="card-body">
            @if($portfolios->count() === 0)
                <p class="empty-state">No portfolio items added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Featured</th>
                                <th>Video</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($portfolios as $portfolio)
                            <tr>
                                <td>{{ $portfolio->project_title }}</td>
                                <td>{{ $portfolio->category ?? '-' }}</td>
                                <td>{{ $portfolio->is_featured ? 'Yes' : 'No' }}</td>
                                <td>
                                    @if($portfolio->video_url)
                                        <a href="{{ $portfolio->video_url }}" target="_blank">View</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('/company/production/portfolios/' . $portfolio->id) }}" class="inline-form" onsubmit="return confirm('Delete this portfolio item?');">
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
    .inline-form { display: inline-flex; gap: 0.5rem; align-items: center; margin-right: 0.5rem; }
    .empty-state { color: var(--text-secondary); }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 0.75rem; border-bottom: 1px solid var(--border-color); }
    .table-responsive { overflow-x: auto; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
