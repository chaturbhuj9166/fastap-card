@extends('layouts.redesign.agent')

@section('page-title', 'My Users')
@section('breadcrumb', 'Users')

@section('agent-content')
<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">My Users</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage users registered under your franchise</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/agent/addnewuser') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add User
        </a>
    </div>
</div>

<!-- Users Table -->
<div class="table-container">
    <div class="table-header">
        <div class="table-search">
            <i class="fas fa-search"></i>
            <input type="text" id="userSearch" placeholder="Search users...">
        </div>
    </div>

    <table class="data-table" id="usersTable">
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users ?? [] as $user)
            <tr>
                <td>
                    <div class="table-cell-user">
                        <div class="table-avatar">
                            @if($user->profile_image)
                                <img src="{{ asset('uploads/customer/'.$user->profile_image) }}" alt="{{ $user->name }}">
                            @else
                                <img src="{{ asset('assets/images/avatars/default.png') }}" alt="{{ $user->name }}">
                            @endif
                        </div>
                        <div class="table-user-info">
                            <div class="table-user-name">{{ $user->name ?? 'N/A' }}</div>
                            <div class="table-user-email">{{ $user->unique_id ?? '' }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $user->email ?? 'N/A' }}</td>
                <td>{{ $user->mobile ?? 'N/A' }}</td>
                <td>
                    <span class="status-badge {{ ($user->status ?? 1) == 1 ? 'status-active' : 'status-inactive' }}">
                        {{ ($user->status ?? 1) == 1 ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</td>
                <td>
                    <div class="table-action-btns">
                        <a href="{{ url('/agent/viewuser/'.$user->id) }}" class="table-action-btn view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ url('/agent/edituser/'.$user->id) }}" class="table-action-btn edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/user/'.$user->unique_id) }}" class="table-action-btn" title="Profile" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="empty-state-title">No Users Yet</h3>
                        <p class="empty-state-text">Add your first user to get started.</p>
                        <a href="{{ url('/agent/addnewuser') }}" class="btn btn-primary">Add User</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if(isset($users) && method_exists($users, 'hasPages') && $users->hasPages())
    <div class="table-footer">
        <div class="table-info">
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
        </div>
        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>
    @endif
</div>

@push('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('userSearch');
    const tableRows = document.querySelectorAll('#usersTable tbody tr');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});
</script>
@endpush
@endsection
