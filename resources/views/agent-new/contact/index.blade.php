@extends('layouts.redesign.agent')

@section('page-title', 'Contacts')
@section('breadcrumb', 'Contacts')

@push('page-styles')
<style>
    .contact-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .contact-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .contact-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .contact-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .contact-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .contact-email {
        color: var(--blue-500);
    }

    .contact-phone {
        font-family: monospace;
        color: var(--green-500);
    }

    .address-cell {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        .contact-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('agent-content')
@php
    $totalContacts = count($contact);
@endphp

<!-- Contact Stats -->
<div class="contact-stats">
    <div class="contact-stat-card">
        <div class="contact-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-address-book"></i>
        </div>
        <div>
            <div class="contact-stat-value">{{ $totalContacts }}</div>
            <div class="contact-stat-label">Total Contacts</div>
        </div>
    </div>
    <div class="contact-stat-card">
        <div class="contact-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-user-friends"></i>
        </div>
        <div>
            <div class="contact-stat-value">{{ $contact->count() }}</div>
            <div class="contact-stat-label">On This Page</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">Contacts</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">View and manage contact submissions</p>
    </div>
    <div class="table-actions">
        <div class="table-search">
            <i class="fas fa-search"></i>
            <input type="text" id="contactSearch" placeholder="Search contacts...">
        </div>
    </div>
</div>

<!-- Contacts Table -->
<div class="table-container">
    <table class="data-table" id="contactsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contact as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-weight: var(--font-medium);">{{ $item->name }}</td>
                <td>
                    <a href="mailto:{{ $item->email }}" class="contact-email">{{ $item->email }}</a>
                </td>
                <td class="contact-phone">{{ $item->mobile }}</td>
                <td class="address-cell" title="{{ $item->address }}">{{ $item->address }}</td>
                <td>
                    <a href="{{ url('/agent/contact/' . $item->id . '/contactview') }}" class="btn btn-icon btn-sm" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: var(--space-xl);">
                    <div style="color: var(--text-muted);">
                        <i class="fas fa-address-book" style="font-size: var(--text-3xl); margin-bottom: var(--space-md);"></i>
                        <p>No contacts found</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($contact->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $contact->links() }}
</div>
@endif

@endsection

@push('page-scripts')
<script>
    // Search functionality
    document.getElementById('contactSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#contactsTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
