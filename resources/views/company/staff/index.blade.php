@extends('layouts.redesign.company')

@section('page-title', 'Staff Management')
@section('breadcrumb', 'Staff')

@section('company-content')
<div class="staff-page">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h2>All Staff Members</h2>
            <p>Manage your company staff cards</p>
        </div>
        <div class="page-header-right">
            <a href="{{ url('/company/staff/import') }}" class="btn btn-outline">
                <i class="fas fa-file-import"></i> Bulk Import
            </a>
            @if($company->canCreateCard())
            <a href="{{ url('/company/staff/create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add Staff
            </a>
            @else
            <button class="btn btn-secondary" disabled title="Card limit reached">
                <i class="fas fa-user-plus"></i> Add Staff
            </button>
            @endif
        </div>
    </div>

    <!-- Card Limit Warning -->
    @if($company->remaining_cards <= 2)
    <div class="alert alert-warning" style="margin-bottom: 1.5rem;">
        <i class="fas fa-exclamation-triangle"></i>
        You have only {{ $company->remaining_cards }} card(s) remaining.
        <a href="{{ url('/company/subscription') }}" style="color: inherit; font-weight: 600;">Upgrade your plan</a> to add more staff.
    </div>
    @endif

    <!-- Filters -->
    <div class="filters-card">
        <form action="{{ url('/company/staff') }}" method="GET" class="filters-form">
            <div class="filter-group">
                <input type="text" name="search" class="form-input" placeholder="Search staff..." value="{{ request('search') }}">
            </div>
            <div class="filter-group">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="filter-group">
                <select name="department" class="form-select">
                    <option value="">All Departments</option>
                    @foreach($departments as $dept)
                    <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Filter
            </button>
            @if(request()->hasAny(['search', 'status', 'department']))
            <a href="{{ url('/company/staff') }}" class="btn btn-outline">Clear</a>
            @endif
        </form>
    </div>

    <!-- Staff Grid -->
    @if($staff->count() > 0)
    <div class="staff-grid">
        @foreach($staff as $member)
        <div class="staff-card">
            <div class="staff-card-header">
                <div class="staff-avatar">
                    @if($member->profile_image)
                        <img src="{{ asset('uploads/staff/' . $member->profile_image) }}" alt="{{ $member->name }}">
                    @else
                        <span>{{ substr($member->name, 0, 1) }}</span>
                    @endif
                </div>
                <div class="staff-status">
                    @if($member->card_enabled && $member->status)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-warning">Inactive</span>
                    @endif
                </div>
            </div>
            <div class="staff-card-body">
                <h3 class="staff-name">{{ $member->name }}</h3>
                <p class="staff-designation">{{ $member->designation ?? 'Staff' }}</p>
                @if($member->department)
                <p class="staff-department"><i class="fas fa-building"></i> {{ $member->department }}</p>
                @endif
                @if($member->email)
                <p class="staff-contact"><i class="fas fa-envelope"></i> {{ $member->email }}</p>
                @endif
                @if($member->phone)
                <p class="staff-contact"><i class="fas fa-phone"></i> {{ $member->phone }}</p>
                @endif
            </div>
            <div class="staff-card-footer">
                <div class="staff-actions">
                    <a href="{{ url('/company/staff/' . $member->id . '/edit') }}" class="btn btn-sm btn-outline" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ url('/company/staff/' . $member->id . '/visibility') }}" class="btn btn-sm btn-outline" title="Visibility">
                        <i class="fas fa-eye"></i>
                    </a>
                    <form action="{{ route('company.staff.toggle', $member->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline" title="{{ $member->card_enabled ? 'Disable Card' : 'Enable Card' }}">
                            <i class="fas {{ $member->card_enabled ? 'fa-toggle-on text-success' : 'fa-toggle-off' }}"></i>
                        </button>
                    </form>
                    <form action="{{ route('company.staff.delete', $member->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline text-danger" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        {{ $staff->withQueryString()->links() }}
    </div>
    @else
    <div class="empty-state-card">
        <div class="empty-state">
            <i class="fas fa-users"></i>
            <h3>No Staff Members Found</h3>
            <p>Start by adding your first staff member or adjust your filters</p>
            <a href="{{ url('/company/staff/create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add Staff Member
            </a>
        </div>
    </div>
    @endif
</div>

@push('page-styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .page-header h2 {
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
    }
    .page-header p {
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    .page-header-right {
        display: flex;
        gap: 0.75rem;
    }
    .filters-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }
    .filters-form {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .filter-group {
        flex: 1;
        min-width: 150px;
    }
    .form-input, .form-select {
        width: 100%;
        padding: 0.625rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        background: var(--bg-primary);
        color: var(--text-primary);
        font-size: 0.9rem;
    }
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #0891b2;
    }
    .staff-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.25rem;
    }
    .staff-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s;
    }
    .staff-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }
    .staff-card-header {
        position: relative;
        padding: 1.5rem;
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        display: flex;
        justify-content: center;
    }
    .staff-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        color: #0891b2;
        border: 4px solid white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        overflow: hidden;
    }
    .staff-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .staff-status {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
    }
    .staff-card-body {
        padding: 1.25rem;
        text-align: center;
    }
    .staff-name {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .staff-designation {
        color: #0891b2;
        font-weight: 500;
        margin-bottom: 0.75rem;
    }
    .staff-department, .staff-contact {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 0.35rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .staff-card-footer {
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--border-color);
    }
    .staff-actions {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }
    .text-success { color: #22c55e !important; }
    .text-danger { color: #ef4444 !important; }
    .empty-state-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        padding: 3rem;
        box-shadow: var(--shadow-sm);
    }
    .empty-state {
        text-align: center;
    }
    .empty-state i {
        font-size: 4rem;
        color: var(--text-muted);
        opacity: 0.5;
        margin-bottom: 1rem;
    }
    .empty-state h3 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .empty-state p {
        color: var(--text-muted);
        margin-bottom: 1.5rem;
    }
    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }
    .alert {
        padding: 1rem 1.25rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .alert-warning {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }
</style>
@endpush
@endsection
