@extends('layouts.redesign.agent')

@section('page-title', 'FAQs')
@section('breadcrumb', 'FAQs')

@push('page-styles')
<style>
    .faq-list {
        display: flex;
        flex-direction: column;
        gap: var(--space-md);
    }

    .faq-item {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--space-md);
        transition: box-shadow var(--transition-fast);
    }

    .faq-item:hover {
        box-shadow: var(--shadow-md);
    }

    .faq-number {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--purple-500), var(--blue-500));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: var(--font-semibold);
        flex-shrink: 0;
    }

    .faq-title {
        flex: 1;
        font-weight: var(--font-medium);
        color: var(--text-primary);
    }
</style>
@endpush

@section('agent-content')
<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">FAQs</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage frequently asked questions</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/agent/addfaq') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add FAQ
        </a>
    </div>
</div>

@if(count($faq) > 0)
<div class="faq-list">
    @foreach($faq as $item)
    <div class="faq-item">
        <div class="faq-number">{{ $loop->iteration }}</div>
        <div class="faq-title">{{ $item->internal_title }}</div>
        <div class="action-buttons">
            <a href="{{ url('/agent/editfaq/' . $item->id . '/edit') }}" class="btn btn-icon btn-sm" title="Edit">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{ url('/agent/faq/' . $item->id . '/delete') }}" class="btn btn-icon btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash"></i>
            </a>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
@if($faq->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $faq->links() }}
</div>
@endif
@else
<div style="text-align: center; padding: var(--space-3xl); background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl);">
    <i class="fas fa-question-circle" style="font-size: 4rem; color: var(--text-muted); margin-bottom: var(--space-lg);"></i>
    <h3 style="color: var(--text-primary); margin-bottom: var(--space-sm);">No FAQs Yet</h3>
    <p style="color: var(--text-muted); margin-bottom: var(--space-lg);">Add frequently asked questions to help your customers</p>
    <a href="{{ url('/agent/addfaq') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add First FAQ
    </a>
</div>
@endif

@endsection
