@extends('layouts.redesign.admin')

@section('page-title', 'Users')
@section('breadcrumb', 'Users')

@push('page-styles')
<style>
    .user-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .user-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .user-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .user-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .user-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    @media (max-width: 1200px) {
        .user-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .user-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalUsers = DB::table('customers')->count();
    $activeUsers = DB::table('customers')->where('status', 1)->count();
    $newUsersThisMonth = DB::table('customers')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();
    $goldMembers = 0; // is_gold column not available
@endphp

<!-- User Stats -->
<div class="user-stats">
    <div class="user-stat-card">
        <div class="user-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div class="user-stat-value">{{ number_format($totalUsers) }}</div>
            <div class="user-stat-label">Total Users</div>
        </div>
    </div>
    <div class="user-stat-card">
        <div class="user-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-user-check"></i>
        </div>
        <div>
            <div class="user-stat-value">{{ number_format($activeUsers) }}</div>
            <div class="user-stat-label">Active Users</div>
        </div>
    </div>
    <div class="user-stat-card">
        <div class="user-stat-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--blue-500);">
            <i class="fas fa-user-plus"></i>
        </div>
        <div>
            <div class="user-stat-value">{{ number_format($newUsersThisMonth) }}</div>
            <div class="user-stat-label">New This Month</div>
        </div>
    </div>
    <div class="user-stat-card">
        <div class="user-stat-icon" style="background: rgba(249, 115, 22, 0.1); color: var(--orange-500);">
            <i class="fas fa-crown"></i>
        </div>
        <div>
            <div class="user-stat-value">{{ number_format($goldMembers) }}</div>
            <div class="user-stat-label">Gold Members</div>
        </div>
    </div>
</div>

<!-- Users Table -->
<div class="table-container">
    <div class="table-header">
        <h3 class="table-title">All Users</h3>
        <div class="table-actions">
            <div class="table-search">
                <i class="fas fa-search"></i>
                <input type="text" id="userSearch" placeholder="Search users...">
            </div>
            <select id="statusFilter" style="padding: 0.5rem 1rem; border: 1px solid var(--border-light); border-radius: var(--radius-md); background: var(--bg-primary); font-size: var(--text-sm);">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

    <table class="data-table" id="usersTable">
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Status</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users ?? [] as $user)
            <tr data-status="{{ ($user->status ?? 1) == 1 ? 'active' : 'inactive' }}">
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
                    @if($user->is_gold ?? false)
                        <span class="status-badge" style="background: rgba(249, 115, 22, 0.1); color: var(--orange-500);">
                            <i class="fas fa-crown" style="margin-right: 4px;"></i> Gold
                        </span>
                    @else
                        <span class="status-badge status-inactive">Standard</span>
                    @endif
                </td>
                <td>
                    <span class="status-badge {{ ($user->status ?? 1) == 1 ? 'status-active' : 'status-inactive' }}">
                        {{ ($user->status ?? 1) == 1 ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</td>
                <td>
                    <div class="table-action-btns">
                        <a href="{{ url('/admin/user-view/'.$user->id) }}" class="table-action-btn view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ url('/admin/user-edit/'.$user->id) }}" class="table-action-btn edit" title="Edit">
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
                <td colspan="7">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="empty-state-title">No Users Yet</h3>
                        <p class="empty-state-text">Users will appear here once they register on the platform.</p>
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
    const statusFilter = document.getElementById('statusFilter');
    const tableRows = document.querySelectorAll('#usersTable tbody tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowStatus = row.dataset.status;

            const matchesSearch = text.includes(searchTerm);
            const matchesStatus = !statusValue || rowStatus === statusValue;

            row.style.display = matchesSearch && matchesStatus ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
});
</script>
@endpush
@endsection
