@extends('layouts.redesign.company')

@section('page-title', 'Salon Portfolio')
@section('breadcrumb', 'Salon Portfolio')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Salon Portfolio</h2>
            <p>Showcase before/after transformations</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Portfolio Item</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/salon/portfolio') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Before Image</label>
                    <input type="file" name="before_image" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">After Image</label>
                    <input type="file" name="after_image" class="form-input">
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

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Portfolio Items</h3>
        </div>
        <div class="card-body">
            @if($portfolioItems->count() === 0)
                <p class="empty-state">No portfolio items added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($portfolioItems as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->category ?? '-' }}</td>
                                <td>{{ $item->is_featured ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/salon/portfolio/' . $item->id) }}" class="inline-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="title" class="form-input form-input-sm" value="{{ $item->title }}" required>
                                        <input type="text" name="category" class="form-input form-input-sm" value="{{ $item->category }}">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_featured" value="1" {{ $item->is_featured ? 'checked' : '' }}>
                                            <span>Featured</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/salon/portfolio/' . $item->id) }}" class="inline-form" onsubmit="return confirm('Delete this item?');">
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
