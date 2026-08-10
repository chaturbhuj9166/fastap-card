@extends('layouts.redesign.admin')

@section('page-title', 'View Company')
@section('breadcrumb', 'Companies / ' . $company->name)

@push('page-styles')
<style>
    .company-header {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
        display: flex;
        gap: var(--space-xl);
        align-items: flex-start;
    }

    .company-logo-large {
        width: 100px;
        height: 100px;
        border-radius: var(--radius-lg);
        object-fit: cover;
        background: var(--bg-tertiary);
        flex-shrink: 0;
    }

    .company-logo-placeholder-large {
        width: 100px;
        height: 100px;
        border-radius: var(--radius-lg);
        background: var(--bg-tertiary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-3xl);
        color: var(--text-muted);
        flex-shrink: 0;
    }

    .company-info {
        flex: 1;
    }

    .company-title {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-xs);
    }

    .company-meta {
        display: flex;
        flex-wrap: wrap;
        gap: var(--space-md);
        color: var(--text-muted);
        font-size: var(--text-sm);
        margin-bottom: var(--space-md);
    }

    .company-meta-item {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .company-actions {
        display: flex;
        gap: var(--space-sm);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-lg);
        margin-bottom: var(--space-lg);
    }

    .info-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
    }

    .info-card-title {
        font-size: var(--text-sm);
        font-weight: var(--font-semibold);
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: var(--space-md);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: var(--space-sm) 0;
        border-bottom: 1px solid var(--card-border);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--text-muted);
        font-size: var(--text-sm);
    }

    .info-value {
        font-weight: var(--font-medium);
        text-align: right;
    }

    .card-limit-editor {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .card-limit-input {
        width: 80px;
        padding: var(--space-xs) var(--space-sm);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-md);
        font-size: var(--text-sm);
        text-align: center;
    }

    .usage-bar-large {
        height: 8px;
        background: var(--bg-tertiary);
        border-radius: 4px;
        overflow: hidden;
        margin: var(--space-sm) 0;
    }

    .usage-bar-fill {
        height: 100%;
        border-radius: 4px;
        transition: width var(--transition-normal);
    }

    .staff-table-container {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        overflow: hidden;
    }

    .staff-table-header {
        padding: var(--space-lg);
        border-bottom: 1px solid var(--card-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .staff-table-title {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: var(--space-xs) var(--space-sm);
        border-radius: var(--radius-full);
        font-size: var(--text-xs);
        font-weight: var(--font-medium);
    }

    .status-badge.active {
        background: rgba(16, 185, 129, 0.1);
        color: var(--green-500);
    }

    .status-badge.inactive {
        background: rgba(239, 68, 68, 0.1);
        color: var(--red-500);
    }

    .status-badge.pending {
        background: rgba(245, 158, 11, 0.1);
        color: var(--yellow-600);
    }

    @media (max-width: 1024px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .company-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .company-meta {
            justify-content: center;
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $theme = $company->profession_type ? \App\Models\ProfessionTheme::find($company->profession_type) : null;
    $usagePercent = $company->card_limit > 0 ? ($company->cards_used / $company->card_limit) * 100 : 0;
    $staff = \App\Models\CompanyStaff::where('company_id', $company->id)->orderBy('created_at', 'desc')->take(10)->get();
@endphp

<!-- Company Header -->
<div class="company-header">
    @if($company->logo)
        <img src="{{ url('uploads/company/'.$company->logo) }}" alt="{{ $company->name }}" class="company-logo-large">
    @else
        <div class="company-logo-placeholder-large">
            <i class="fas fa-building"></i>
        </div>
    @endif

    <div class="company-info">
        <h1 class="company-title">{{ $company->name }}</h1>
        <div class="company-meta">
            <span class="company-meta-item">
                <i class="fas fa-envelope"></i> {{ $company->email }}
            </span>
            @if($company->phone)
            <span class="company-meta-item">
                <i class="fas fa-phone"></i> {{ $company->phone }}
            </span>
            @endif
            @if($company->website)
            <span class="company-meta-item">
                <i class="fas fa-globe"></i> {{ $company->website }}
            </span>
            @endif
            <span class="company-meta-item">
                <i class="fas fa-calendar"></i> Joined {{ $company->created_at->format('M d, Y') }}
            </span>
        </div>
        <div class="company-actions">
            <a href="{{ url('/admin/companies/'.$company->id.'/edit') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit Company
            </a>
            <a href="{{ url('/admin/companies') }}" class="btn btn-outline btn-sm">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div>
        <span class="status-badge {{ $company->status }}">
            <i class="fas fa-circle" style="font-size: 6px; margin-right: 4px;"></i>
            {{ ucfirst($company->status) }}
        </span>
    </div>
</div>

<!-- Info Grid -->
<div class="info-grid">
    <!-- Company Details -->
    <div class="info-card">
        <div class="info-card-title">
            <i class="fas fa-building"></i> Company Details
        </div>
        <div class="info-row">
            <span class="info-label">Industry</span>
            <span class="info-value">{{ $company->industry ?? 'Not specified' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Theme</span>
            <span class="info-value">{{ $theme ? $theme->name : 'Default' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Address</span>
            <span class="info-value">{{ $company->address ?? 'Not provided' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">City</span>
            <span class="info-value">{{ $company->city ?? '-' }}</span>
        </div>
    </div>

    <!-- Card Usage -->
    <div class="info-card">
        <div class="info-card-title">
            <i class="fas fa-id-card"></i> Card Usage
        </div>
        <div style="text-align: center; padding: var(--space-md) 0;">
            <div style="font-size: var(--text-4xl); font-weight: var(--font-bold); color: var(--primary-color);">
                {{ $company->cards_used }}
            </div>
            <div style="color: var(--text-muted); font-size: var(--text-sm);">of {{ $company->card_limit }} cards used</div>
            <div class="usage-bar-large">
                <div class="usage-bar-fill" style="width: {{ min($usagePercent, 100) }}%; background: {{ $usagePercent > 90 ? 'var(--red-500)' : ($usagePercent > 70 ? 'var(--yellow-500)' : 'var(--green-500)') }};"></div>
            </div>
        </div>
        <form action="{{ url('/admin/companies/'.$company->id.'/update-limit') }}" method="POST" style="margin-top: var(--space-md);">
            @csrf
            <div class="info-row">
                <span class="info-label">Card Limit</span>
                <div class="card-limit-editor">
                    <input type="number" name="card_limit" value="{{ $company->card_limit }}" class="card-limit-input" min="0">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Subscription -->
    <div class="info-card">
        <div class="info-card-title">
            <i class="fas fa-crown"></i> Subscription
        </div>
        <div class="info-row">
            <span class="info-label">Current Plan</span>
            <span class="info-value" style="text-transform: capitalize;">{{ $company->subscription_tier ?? 'Free' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Start Date</span>
            <span class="info-value">{{ $company->subscription_start ? $company->subscription_start->format('M d, Y') : '-' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">End Date</span>
            <span class="info-value">{{ $company->subscription_end ? $company->subscription_end->format('M d, Y') : '-' }}</span>
        </div>
        <div style="margin-top: var(--space-md);">
            <a href="{{ url('/admin/companies/'.$company->id.'/subscription') }}" class="btn btn-outline btn-sm" style="width: 100%;">
                <i class="fas fa-edit"></i> Manage Subscription
            </a>
        </div>
    </div>
</div>

<!-- Staff Members -->
<div class="staff-table-container">
    <div class="staff-table-header">
        <div>
            <h3 class="staff-table-title">Staff Members</h3>
            <p style="color: var(--text-muted); font-size: var(--text-sm);">{{ $staff->count() }} staff members</p>
        </div>
        <a href="{{ url('/admin/companies/'.$company->id.'/staff') }}" class="btn btn-outline btn-sm">
            View All Staff <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Card Status</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @forelse($staff as $member)
            <tr>
                <td style="font-weight: var(--font-medium);">{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->designation ?? '-' }}</td>
                <td>
                    <span class="status-badge {{ $member->card_status }}">
                        {{ ucfirst($member->card_status) }}
                    </span>
                </td>
                <td>{{ $member->created_at->format('M d, Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: var(--space-xl); color: var(--text-muted);">
                    No staff members yet
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
