@extends('layouts.redesign.admin')

@section('page-title', 'Add Offer')
@section('breadcrumb')
    <a href="{{ url('/admin/view_offer') }}">Offers</a>
    <span class="breadcrumb-separator">/</span>
    <span>Add</span>
@endsection

@push('page-styles')
<style>
    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        padding: var(--space-xl);
        max-width: 600px;
    }

    .form-header {
        margin-bottom: var(--space-xl);
        padding-bottom: var(--space-lg);
        border-bottom: 1px solid var(--card-border);
    }

    .form-header h2 {
        font-size: var(--text-xl);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .form-header p {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .form-group {
        margin-bottom: var(--space-lg);
    }

    .form-label {
        display: block;
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .form-label .required {
        color: var(--red-500);
    }

    .form-control {
        width: 100%;
        padding: var(--space-sm) var(--space-md);
        font-size: var(--text-base);
        color: var(--text-primary);
        background: var(--bg-primary);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-md);
        transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--purple-500);
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-control::placeholder {
        color: var(--text-muted);
    }

    .form-error {
        font-size: var(--text-sm);
        color: var(--red-500);
        margin-top: var(--space-xs);
    }

    .form-actions {
        display: flex;
        gap: var(--space-md);
        padding-top: var(--space-lg);
        border-top: 1px solid var(--card-border);
        margin-top: var(--space-xl);
    }

    .info-box {
        background: rgba(124, 58, 237, 0.1);
        border: 1px solid rgba(124, 58, 237, 0.2);
        border-radius: var(--radius-md);
        padding: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .info-box i {
        color: var(--purple-500);
        margin-right: var(--space-sm);
    }

    .info-box p {
        font-size: var(--text-sm);
        color: var(--text-secondary);
        margin: 0;
    }
</style>
@endpush

@section('admin-content')

<div class="form-card">
    <div class="form-header">
        <h2><i class="fas fa-tag" style="color: var(--purple-500); margin-right: var(--space-sm);"></i> Add New Offer</h2>
        <p>Create a promotional offer for your customers</p>
    </div>

    <div class="info-box">
        <p><i class="fas fa-info-circle"></i> Offers will be displayed on the website homepage and product pages.</p>
    </div>

    <form method="POST" action="{{ url('/admin/add_offer') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Offer Title <span class="required">*</span></label>
            <input type="text" name="offer" class="form-control" value="{{ old('offer') }}" placeholder="e.g., Get 20% off on all cards!">
            @error('offer')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ url('/admin/view_offer') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Offer
            </button>
        </div>
    </form>
</div>

@endsection
