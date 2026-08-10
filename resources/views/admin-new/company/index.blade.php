@extends('layouts.redesign.admin')

@section('page-title', 'Manage Companies')
@section('breadcrumb', 'Companies')

@push('page-styles')
<style>
    .company-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .company-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .company-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .company-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .company-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .company-logo {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        object-fit: cover;
        background: var(--bg-tertiary);
    }

    .company-logo-placeholder {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        background: var(--bg-tertiary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
    }

    .company-name-cell {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .theme-badge {
        display: inline-flex;
        align-items: center;
        padding: var(--space-xs) var(--space-sm);
        background: var(--bg-tertiary);
        border-radius: var(--radius-md);
        font-size: var(--text-xs);
        color: var(--text-secondary);
    }

    .theme-badge i {
        margin-right: var(--space-xs);
    }

    .card-usage {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .card-usage-bar {
        flex: 1;
        height: 6px;
        background: var(--bg-tertiary);
        border-radius: 3px;
        overflow: hidden;
        min-width: 60px;
    }

    .card-usage-fill {
        height: 100%;
        background: var(--primary-color);
        border-radius: 3px;
    }

    .card-usage-text {
        font-size: var(--text-sm);
        color: var(--text-muted);
        white-space: nowrap;
    }

    .subscription-badge {
        display: inline-flex;
        align-items: center;
        padding: var(--space-xs) var(--space-sm);
        border-radius: var(--radius-md);
        font-size: var(--text-xs);
        font-weight: var(--font-medium);
    }

    .subscription-badge.free { background: var(--bg-tertiary); color: var(--text-secondary); }
    .subscription-badge.basic { background: rgba(59, 130, 246, 0.1); color: var(--blue-500); }
    .subscription-badge.premium { background: rgba(168, 85, 247, 0.1); color: var(--purple-500); }
    .subscription-badge.enterprise { background: rgba(245, 158, 11, 0.1); color: var(--yellow-600); }

    .status-toggle {
        position: relative;
        width: 44px;
        height: 24px;
        background: var(--bg-tertiary);
        border-radius: 12px;
        cursor: pointer;
        transition: background var(--transition-fast);
    }

    .status-toggle.active {
        background: var(--green-500);
    }

    .status-toggle::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        transition: transform var(--transition-fast);
    }

    .status-toggle.active::after {
        transform: translateX(20px);
    }

    .action-buttons {
        display: flex;
        gap: var(--space-xs);
    }

    .action-buttons .btn {
        padding: var(--space-xs) var(--space-sm);
        font-size: var(--text-sm);
    }

    @media (max-width: 1200px) {
        .company-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .company-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalCompanies = \App\Models\Company::count();
    $activeCompanies = \App\Models\Company::where('status', 'active')->count();
    $totalStaff = \App\Models\CompanyStaff::count();
    $totalCardsUsed = \App\Models\Company::sum('cards_used');
@endphp

<!-- Company Stats -->
<div class="company-stats">
    <div class="company-stat-card">
        <div class="company-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-building"></i>
        </div>
        <div>
            <div class="company-stat-value">{{ number_format($totalCompanies) }}</div>
            <div class="company-stat-label">Total Companies</div>
        </div>
    </div>
    <div class="company-stat-card">
        <div class="company-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <div class="company-stat-value">{{ number_format($activeCompanies) }}</div>
            <div class="company-stat-label">Active Companies</div>
        </div>
    </div>
    <div class="company-stat-card">
        <div class="company-stat-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--blue-500);">
            <i class="fas fa-id-card"></i>
        </div>
        <div>
            <div class="company-stat-value">{{ number_format($totalStaff) }}</div>
            <div class="company-stat-label">Total Staff Cards</div>
        </div>
    </div>
    <div class="company-stat-card">
        <div class="company-stat-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--yellow-600);">
            <i class="fas fa-credit-card"></i>
        </div>
        <div>
            <div class="company-stat-value">{{ number_format($totalCardsUsed) }}</div>
            <div class="company-stat-label">Cards Generated</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">All Companies</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage company accounts and their card allocations</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/admin/companies/export') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-download"></i> Export
        </a>
    </div>
</div>

<!-- Filters -->
<div class="filters-bar" style="display: flex; align-items: center; gap: var(--space-md); margin-bottom: var(--space-lg); flex-wrap: wrap;">
    <div class="filter-tabs" style="display: flex; background: var(--bg-secondary); border-radius: var(--radius-lg); padding: var(--space-xs);">
        <button class="filter-tab active" data-filter="all" style="padding: var(--space-sm) var(--space-lg); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: var(--font-medium); color: var(--text-secondary); background: var(--bg-primary); border: none; cursor: pointer; box-shadow: var(--shadow-sm);">All</button>
        <button class="filter-tab" data-filter="active" style="padding: var(--space-sm) var(--space-lg); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: var(--font-medium); color: var(--text-secondary); background: transparent; border: none; cursor: pointer;">Active</button>
        <button class="filter-tab" data-filter="inactive" style="padding: var(--space-sm) var(--space-lg); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: var(--font-medium); color: var(--text-secondary); background: transparent; border: none; cursor: pointer;">Inactive</button>
    </div>
    <div style="flex: 1;"></div>
    <div class="table-search">
        <i class="fas fa-search"></i>
        <input type="text" id="companySearch" placeholder="Search companies...">
    </div>
</div>

<!-- Companies Table -->
<div class="table-container">
    <table class="data-table" id="companiesTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Company</th>
                <th>Contact</th>
                <th>Theme</th>
                <th>Card Usage</th>
                <th>Subscription</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @forelse($companies as $company)
            @php
                $usagePercent = $company->card_limit > 0 ? ($company->cards_used / $company->card_limit) * 100 : 0;
                $theme = $company->profession_type ? \App\Models\ProfessionTheme::find($company->profession_type) : null;
            @endphp
            <tr data-status="{{ $company->status }}">
                <td>{{ ++$i }}</td>
                <td>
                    <div class="company-name-cell">
                        @if($company->logo)
                            <img src="{{ url('uploads/company/'.$company->logo) }}" alt="{{ $company->name }}" class="company-logo">
                        @else
                            <div class="company-logo-placeholder">
                                <i class="fas fa-building"></i>
                            </div>
                        @endif
                        <div>
                            <div style="font-weight: var(--font-medium);">{{ $company->name }}</div>
                            <div style="font-size: var(--text-xs); color: var(--text-muted);">{{ $company->industry ?? 'Not specified' }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div style="font-size: var(--text-sm);">
                        <i class="fas fa-envelope" style="color: var(--text-muted); margin-right: 4px;"></i>{{ $company->email }}
                    </div>
                    @if($company->phone)
                    <div style="font-size: var(--text-sm); color: var(--text-muted);">
                        <i class="fas fa-phone" style="margin-right: 4px;"></i>{{ $company->phone }}
                    </div>
                    @endif
                </td>
                <td>
                    @if($theme)
                    <span class="theme-badge">
                        <i class="fas fa-palette"></i> {{ $theme->name }}
                    </span>
                    @else
                    <span class="theme-badge">
                        <i class="fas fa-minus"></i> Default
                    </span>
                    @endif
                </td>
                <td>
                    <div class="card-usage">
                        <div class="card-usage-bar">
                            <div class="card-usage-fill" style="width: {{ min($usagePercent, 100) }}%; background: {{ $usagePercent > 90 ? 'var(--red-500)' : ($usagePercent > 70 ? 'var(--yellow-500)' : 'var(--green-500)') }};"></div>
                        </div>
                        <span class="card-usage-text">{{ $company->cards_used }}/{{ $company->card_limit }}</span>
                    </div>
                </td>
                <td>
                    @php
                        $tier = $company->subscription_tier ?? 'free';
                    @endphp
                    <span class="subscription-badge {{ $tier }}">
                        {{ ucfirst($tier) }}
                    </span>
                </td>
                <td>
                    <div class="status-toggle {{ $company->status == 'active' ? 'active' : '' }}"
                         data-id="{{ $company->id }}"
                         onclick="toggleStatus(this)">
                    </div>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ url('/admin/companies/' . $company->id) }}" class="btn btn-icon btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ url('/admin/companies/' . $company->id . '/edit') }}" class="btn btn-icon btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ url('/admin/companies/' . $company->id . '/delete') }}" class="btn btn-icon btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this company? All staff cards will also be deleted.')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: var(--space-xl);">
                    <div style="color: var(--text-muted);">
                        <i class="fas fa-building" style="font-size: var(--text-3xl); margin-bottom: var(--space-md);"></i>
                        <p>No companies registered yet</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($companies->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $companies->links() }}
</div>
@endif

@endsection

@push('page-scripts')
<script>
    // Status toggle function
    function toggleStatus(element) {
        const id = element.dataset.id;
        const isActive = element.classList.contains('active');
        const newStatus = isActive ? 'inactive' : 'active';

        fetch('{{ url("/admin/companies") }}/' + id + '/toggle-status', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (newStatus === 'active') {
                    element.classList.add('active');
                } else {
                    element.classList.remove('active');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Search functionality
    document.getElementById('companySearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#companiesTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Filter tabs
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => {
                t.classList.remove('active');
                t.style.background = 'transparent';
                t.style.boxShadow = 'none';
            });
            this.classList.add('active');
            this.style.background = 'var(--bg-primary)';
            this.style.boxShadow = 'var(--shadow-sm)';

            const filter = this.dataset.filter;
            const rows = document.querySelectorAll('#companiesTable tbody tr');

            rows.forEach(row => {
                if (filter === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.dataset.status === filter ? '' : 'none';
                }
            });
        });
    });
</script>
@endpush
