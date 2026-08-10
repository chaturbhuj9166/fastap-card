@extends('layouts.redesign.admin')

@section('page-title', 'Contact Messages')
@section('breadcrumb', 'Contact Messages')

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

    .message-cell {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .contact-email {
        color: var(--blue-500);
    }

    .contact-phone {
        color: var(--green-500);
        font-family: monospace;
    }

    @media (max-width: 768px) {
        .contact-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalMessages = DB::table('contacts')->count();
@endphp

<!-- Contact Stats -->
<div class="contact-stats">
    <div class="contact-stat-card">
        <div class="contact-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-envelope"></i>
        </div>
        <div>
            <div class="contact-stat-value">{{ number_format($totalMessages) }}</div>
            <div class="contact-stat-label">Total Messages</div>
        </div>
    </div>
    <div class="contact-stat-card">
        <div class="contact-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-inbox"></i>
        </div>
        <div>
            <div class="contact-stat-value">{{ count($contactus) }}</div>
            <div class="contact-stat-label">On This Page</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">Contact Messages</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">View messages from the contact form</p>
    </div>
    <div class="table-actions">
        <div class="table-search">
            <i class="fas fa-search"></i>
            <input type="text" id="contactSearch" placeholder="Search messages...">
        </div>
    </div>
</div>

<!-- Contact Table -->
<div class="table-container">
    <table class="data-table" id="contactTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp
            @forelse($contactus as $contact)
            <tr>
                <td>{{ ++$i }}</td>
                <td style="font-weight: var(--font-medium);">{{ $contact->name }}</td>
                <td>
                    <a href="mailto:{{ $contact->email }}" class="contact-email">{{ $contact->email }}</a>
                </td>
                <td>
                    <span class="contact-phone">{{ $contact->sub }}</span>
                </td>
                <td class="message-cell" title="{{ $contact->msg }}">{{ $contact->msg }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: var(--space-xl);">
                    <div style="color: var(--text-muted);">
                        <i class="fas fa-inbox" style="font-size: var(--text-3xl); margin-bottom: var(--space-md);"></i>
                        <p>No contact messages yet</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($contactus->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $contactus->links() }}
</div>
@endif

@endsection

@push('page-scripts')
<script>
    // Search functionality
    document.getElementById('contactSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#contactTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
