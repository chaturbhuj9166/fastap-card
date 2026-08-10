@extends('layouts.redesign.company')

@section('page-title', 'Salon Artists')
@section('breadcrumb', 'Salon Artists')

@section('company-content')
<div class="restaurant-page">
    <div class="page-header">
        <div class="page-header-left">
            <h2>Salon Artists</h2>
            <p>Manage stylists and makeup artists</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-plus"></i> Add Artist</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/company/salon/artists') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Artist Name</label>
                    <input type="text" name="artist_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Experience (Years)</label>
                    <input type="number" name="experience_years" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Specialization (one per line)</label>
                    <textarea name="specialization" class="form-input" rows="2"></textarea>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Certifications</label>
                    <input type="text" name="certifications" class="form-input">
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_available" value="1" checked>
                        <span>Available</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Artist</button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-card">
        <div class="card-header">
            <h3><i class="fas fa-list"></i> Artists</h3>
        </div>
        <div class="card-body">
            @if($artists->count() === 0)
                <p class="empty-state">No artists added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Experience</th>
                                <th>Available</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($artists as $artist)
                            <tr>
                                <td>{{ $artist->artist_name }}</td>
                                <td>{{ $artist->experience_years ? $artist->experience_years . ' yrs' : '-' }}</td>
                                <td>{{ $artist->is_available ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/company/salon/artists/' . $artist->id) }}" class="inline-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="artist_name" class="form-input form-input-sm" value="{{ $artist->artist_name }}" required>
                                        <input type="number" name="experience_years" class="form-input form-input-sm" value="{{ $artist->experience_years }}" min="0">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_available" value="1" {{ $artist->is_available ? 'checked' : '' }}>
                                            <span>Available</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/company/salon/artists/' . $artist->id) }}" class="inline-form" onsubmit="return confirm('Delete this artist?');">
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
