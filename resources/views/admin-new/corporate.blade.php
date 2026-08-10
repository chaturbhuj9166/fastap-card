@extends('layouts.redesign.admin')

@section('page-title', 'Corporate Leads')
@section('breadcrumb', 'Corporate Leads')

@push('page-styles')
<style>
    .leads-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .lead-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .lead-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .lead-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .lead-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .lead-name {
        font-weight: var(--font-medium);
        color: var(--text-primary);
    }

    .lead-company {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .lead-location {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
        font-size: var(--text-sm);
        color: var(--text-secondary);
    }

    .lead-location i {
        color: var(--purple-500);
        font-size: var(--text-xs);
    }

    @media (max-width: 1200px) {
        .leads-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .leads-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalLeads = DB::table('corporates')->count();
    $newLeadsThisMonth = DB::table('corporates')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();
@endphp

<!-- Lead Stats -->
<div class="leads-stats">
    <div class="lead-stat-card">
        <div class="lead-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-building"></i>
        </div>
        <div>
            <div class="lead-stat-value">{{ number_format($totalLeads) }}</div>
            <div class="lead-stat-label">Total Leads</div>
        </div>
    </div>
    <div class="lead-stat-card">
        <div class="lead-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-user-plus"></i>
        </div>
        <div>
            <div class="lead-stat-value">{{ number_format($newLeadsThisMonth) }}</div>
            <div class="lead-stat-label">New This Month</div>
        </div>
    </div>
    <div class="lead-stat-card">
        <div class="lead-stat-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--blue-500);">
            <i class="fas fa-globe"></i>
        </div>
        <div>
            <div class="lead-stat-value">{{ DB::table('corporates')->distinct('country')->count('country') }}</div>
            <div class="lead-stat-label">Countries</div>
        </div>
    </div>
    <div class="lead-stat-card">
        <div class="lead-stat-icon" style="background: rgba(249, 115, 22, 0.1); color: var(--orange-500);">
            <i class="fas fa-city"></i>
        </div>
        <div>
            <div class="lead-stat-value">{{ DB::table('corporates')->distinct('city')->count('city') }}</div>
            <div class="lead-stat-label">Cities</div>
        </div>
    </div>
</div>

<!-- Corporate Leads Table -->
<div class="table-container">
    <div class="table-header">
        <h3 class="table-title">Corporate Leads</h3>
        <div class="table-actions">
            <div class="table-search">
                <i class="fas fa-search"></i>
                <input type="text" id="leadSearch" placeholder="Search leads...">
            </div>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    <table class="data-table" id="leadsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Location</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = ($corporate->currentPage() - 1) * $corporate->perPage(); @endphp
            @forelse($corporate as $lead)
            <tr>
                <td>{{ ++$i }}</td>
                <td>
                    <div class="lead-name">{{ $lead->fname ?? '' }} {{ $lead->lname ?? '' }}</div>
                </td>
                <td>
                    <div class="lead-company">{{ $lead->cname ?? 'N/A' }}</div>
                </td>
                <td>
                    <a href="mailto:{{ $lead->email }}" style="color: var(--purple-500);">{{ $lead->email ?? 'N/A' }}</a>
                </td>
                <td>
                    <div class="lead-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $lead->city ?? '' }}{{ $lead->city && $lead->state ? ', ' : '' }}{{ $lead->state ?? '' }}{{ ($lead->city || $lead->state) && $lead->country ? ', ' : '' }}{{ $lead->country ?? '' }}
                    </div>
                </td>
                <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('M d, Y') }}</td>
                <td>
                    <div class="table-action-btns">
                        <a href="mailto:{{ $lead->email }}" class="table-action-btn view" title="Send Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <button class="table-action-btn delete" title="Delete" onclick="confirmDelete({{ $lead->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="empty-state-title">No Corporate Leads Yet</h3>
                        <p class="empty-state-text">Corporate inquiries will appear here.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($corporate->hasPages())
    <div class="table-footer">
        <div class="table-info">
            Showing {{ $corporate->firstItem() ?? 0 }} to {{ $corporate->lastItem() ?? 0 }} of {{ $corporate->total() }} leads
        </div>
        <div class="pagination">
            @if($corporate->onFirstPage())
                <button class="pagination-btn" disabled><i class="fas fa-chevron-left"></i></button>
            @else
                <a href="{{ $corporate->previousPageUrl() }}" class="pagination-btn"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach($corporate->getUrlRange(max(1, $corporate->currentPage() - 2), min($corporate->lastPage(), $corporate->currentPage() + 2)) as $page => $url)
                <a href="{{ $url }}" class="pagination-btn {{ $page == $corporate->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if($corporate->hasMorePages())
                <a href="{{ $corporate->nextPageUrl() }}" class="pagination-btn"><i class="fas fa-chevron-right"></i></a>
            @else
                <button class="pagination-btn" disabled><i class="fas fa-chevron-right"></i></button>
            @endif
        </div>
    </div>
    @endif
</div>

@push('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('leadSearch');
    const tableRows = document.querySelectorAll('#leadsTable tbody tr');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
});

function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this lead?')) {
        window.location.href = '/admin/delete-corporate/' + id;
    }
}
</script>
@endpush
@endsection
