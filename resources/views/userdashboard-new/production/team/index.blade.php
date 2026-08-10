@extends('layouts.redesign.dashboard')

@section('title', 'Production Team')

@section('dashboard-content')
<div class="content-page">
    <div class="content-header">
        <div class="content-header-left">
            <h1 class="content-title">Production Team</h1>
            <p class="content-subtitle">Add crew and showcase expertise</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Team Member</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/user/production/team') }}" class="form-grid" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="member_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <input type="text" name="role" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Specialization</label>
                    <input type="text" name="specialization" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Experience (Years)</label>
                    <input type="number" name="experience_years" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Portfolio Link</label>
                    <input type="url" name="portfolio_link" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="display_order" class="form-input" min="0" value="0">
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
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Team Members</h3>
        </div>
        <div class="card-body">
            @if($members->count() === 0)
                <p class="empty-state">No team members added yet.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                            <tr>
                                <td>{{ $member->member_name }}</td>
                                <td>{{ $member->role ?? '-' }}</td>
                                <td>{{ $member->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/user/production/team/' . $member->id) }}" class="inline-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="member_name" class="form-input form-input-sm" value="{{ $member->member_name }}" required>
                                        <input type="text" name="role" class="form-input form-input-sm" value="{{ $member->role }}">
                                        <input type="text" name="specialization" class="form-input form-input-sm" value="{{ $member->specialization }}">
                                        <input type="number" name="experience_years" class="form-input form-input-sm" value="{{ $member->experience_years }}" min="0">
                                        <input type="url" name="portfolio_link" class="form-input form-input-sm" value="{{ $member->portfolio_link }}">
                                        <input type="number" name="display_order" class="form-input form-input-sm" value="{{ $member->display_order }}" min="0">
                                        <input type="file" name="photo" class="form-input form-input-sm">
                                        <input type="text" name="bio" class="form-input form-input-sm" value="{{ $member->bio }}">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }}>
                                            <span>Active</span>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-outline">Save</button>
                                    </form>
                                    <form method="POST" action="{{ url('/user/production/team/' . $member->id) }}" class="inline-form" onsubmit="return confirm('Delete this team member?');">
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
    .form-input-sm { max-width: 160px; }
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
