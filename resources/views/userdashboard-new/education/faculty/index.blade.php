@extends('layouts.redesign.dashboard')

@section('title', 'Education Faculty')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Faculty</h1>
            <p class="content-subtitle">Manage faculty profiles</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Faculty</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/education/faculty') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Faculty Name</label>
                    <input type="text" name="faculty_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Qualification</label>
                    <input type="text" name="qualification" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Specialization</label>
                    <input type="text" name="specialization" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Experience (years)</label>
                    <input type="number" name="experience_years" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span>Active</span>
                    </label>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add Faculty</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Faculty Members</h3>
        </div>
        <div class="card-body">
            @if($faculty->count() === 0)
                <p class="empty-state">No faculty added yet.</p>
            @else
                @foreach($faculty as $member)
                    <div class="item-card">
                        <div class="item-header">
                            <strong>{{ $member->faculty_name }}</strong>
                            <span>{{ $member->specialization ?? 'General' }}</span>
                        </div>
                        <p class="item-desc">{{ $member->bio ?? 'No bio yet.' }}</p>

                        <form method="POST" action="{{ url('/user/education/faculty/' . $member->id) }}" class="form-grid" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Faculty Name</label>
                                <input type="text" name="faculty_name" class="form-input" value="{{ $member->faculty_name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Qualification</label>
                                <input type="text" name="qualification" class="form-input" value="{{ $member->qualification }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Specialization</label>
                                <input type="text" name="specialization" class="form-input" value="{{ $member->specialization }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Experience (years)</label>
                                <input type="number" name="experience_years" class="form-input" value="{{ $member->experience_years }}" min="0">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Photo</label>
                                <input type="file" name="photo" class="form-input">
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Bio</label>
                                <textarea name="bio" class="form-input" rows="2">{{ $member->bio }}</textarea>
                            </div>
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }}>
                                    <span>Active</span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-sm btn-outline">Save</button>
                            </div>
                        </form>

                        <form method="POST" action="{{ url('/user/education/faculty/' . $member->id) }}" class="inline-form" onsubmit="return confirm('Delete this faculty member?');">
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
