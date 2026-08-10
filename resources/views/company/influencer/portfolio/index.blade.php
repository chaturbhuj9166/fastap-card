@extends('layouts.redesign.company')

@section('title', 'Creator Portfolio')

@section('content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Creator Portfolio</h1>
            <p class="content-subtitle">Showcase collaborations and campaigns</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Portfolio Item</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/influencer/portfolio') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Content Type</label>
                    <input type="text" name="content_type" class="form-input" placeholder="reel/video/post">
                </div>
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Brand Name</label>
                    <input type="text" name="brand_name" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Content URL</label>
                    <input type="text" name="content_url" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Views</label>
                    <input type="number" name="views_count" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Engagement Rate (%)</label>
                    <input type="number" name="engagement_rate" class="form-input" step="0.01" min="0" max="100">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_featured" value="1">
                        <span>Featured</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Portfolio List</h3>
        </div>
        <div class="card-body">
            @if($portfolio->count() === 0)
                <p class="empty-state">No portfolio items yet.</p>
            @else
                @foreach($portfolio as $item)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $item->title }}</strong>
                            <span>{{ $item->content_type ?? 'content' }}</span>
                        </div>
                        <p class="item-desc">{{ $item->description ?? 'No description.' }}</p>

                        <form method="POST" action="{{ url('/company/influencer/portfolio/' . $item->id) }}" class="form-grid" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Content Type</label>
                                <input type="text" name="content_type" class="form-input" value="{{ $item->content_type }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-input" value="{{ $item->title }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Brand Name</label>
                                <input type="text" name="brand_name" class="form-input" value="{{ $item->brand_name }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Content URL</label>
                                <input type="text" name="content_url" class="form-input" value="{{ $item->content_url }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Views</label>
                                <input type="number" name="views_count" class="form-input" value="{{ $item->views_count }}" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Engagement Rate (%)</label>
                                <input type="number" name="engagement_rate" class="form-input" value="{{ $item->engagement_rate }}" step="0.01" min="0" max="100">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-input">
                                @if($item->thumbnail)
                                    <small class="muted">Current: {{ $item->thumbnail }}</small>
                                @endif
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="2">{{ $item->description }}</textarea>
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

                        <form method="POST" action="{{ url('/company/influencer/portfolio/' . $item->id) }}" class="inline-form" onsubmit="return confirm('Delete this item?');">
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
    .muted { color: var(--text-secondary); font-size: 0.75rem; }
    .btn { padding: 0.5rem 0.9rem; border-radius: 0.5rem; }
    .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.8rem; }
    .btn-outline { border: 1px solid var(--border-color); background: transparent; }
    .btn-danger { background: #dc2626; color: #fff; border: none; }
</style>
@endsection
