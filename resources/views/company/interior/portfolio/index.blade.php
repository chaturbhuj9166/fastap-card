@extends('layouts.redesign.company')

@section('page-title', 'Interior Portfolio')
@section('breadcrumb', 'Interior Portfolio')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Interior Portfolio</h2>
            <p>Showcase your best projects</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Portfolio Item</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/interior/portfolio') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Project Title</label>
                    <input type="text" name="project_title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="project_category" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Room Type</label>
                    <input type="text" name="room_type" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Style</label>
                    <input type="text" name="style" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Area (sqft)</label>
                    <input type="number" name="area_sqft" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Before Images</label>
                    <input type="file" name="before_images[]" class="form-input" multiple>
                </div>
                <div class="form-group">
                    <label class="form-label">After Images</label>
                    <input type="file" name="after_images[]" class="form-input" multiple>
                </div>
                <div class="form-group">
                    <label class="form-label">Render Images</label>
                    <input type="file" name="design_render_images[]" class="form-input" multiple>
                </div>
                <div class="form-group">
                    <label class="form-label">Video URL</label>
                    <input type="text" name="video_url" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="project_description" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_featured" value="1">
                        <span>Featured</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create Portfolio</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Portfolio Items</h3>
        </div>
        <div class="card-body">
            @if($portfolioItems->count() === 0)
                <p class="empty-state">No portfolio items added yet.</p>
            @else
                @foreach($portfolioItems as $item)
                    <div class="item-card">
                        <form method="POST" action="{{ url('/company/interior/portfolio/' . $item->id) }}" class="form-grid" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Project Title</label>
                                <input type="text" name="project_title" class="form-input" value="{{ $item->project_title }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <input type="text" name="project_category" class="form-input" value="{{ $item->project_category }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Room Type</label>
                                <input type="text" name="room_type" class="form-input" value="{{ $item->room_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Style</label>
                                <input type="text" name="style" class="form-input" value="{{ $item->style }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Area (sqft)</label>
                                <input type="number" name="area_sqft" class="form-input" min="0" value="{{ $item->area_sqft }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Replace Before Images</label>
                                <input type="file" name="before_images[]" class="form-input" multiple>
                                <small class="muted">Current: {{ $item->before_images ? count($item->before_images) : 0 }} images</small>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Replace After Images</label>
                                <input type="file" name="after_images[]" class="form-input" multiple>
                                <small class="muted">Current: {{ $item->after_images ? count($item->after_images) : 0 }} images</small>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Replace Render Images</label>
                                <input type="file" name="design_render_images[]" class="form-input" multiple>
                                <small class="muted">Current: {{ $item->design_render_images ? count($item->design_render_images) : 0 }} images</small>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Video URL</label>
                                <input type="text" name="video_url" class="form-input" value="{{ $item->video_url }}">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea name="project_description" class="form-input" rows="3">{{ $item->project_description }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_featured" value="1" {{ $item->is_featured ? 'checked' : '' }}>
                                    <span>Featured</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ url('/company/interior/portfolio/' . $item->id) }}" class="inline-form" onsubmit="return confirm('Delete this item?');">
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
    .muted { color: var(--text-secondary); font-size: 0.75rem; }
</style>
@endsection
