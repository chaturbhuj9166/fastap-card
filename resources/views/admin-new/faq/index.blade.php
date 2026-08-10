@extends('layouts.redesign.admin')

@section('page-title', 'FAQs')
@section('breadcrumb', 'FAQs')

@push('page-styles')
<style>
    .faq-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .faq-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .faq-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .faq-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .faq-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

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

    .faq-question {
        flex: 1;
        font-weight: var(--font-medium);
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .faq-stats {
            grid-template-columns: 1fr;
        }

        .faq-item {
            flex-wrap: wrap;
        }

        .faq-question {
            width: 100%;
            order: 2;
            margin-top: var(--space-sm);
        }
    }
</style>
@endpush

@section('admin-content')
@php
    $totalFaqs = DB::table('faqs')->count();
@endphp

<!-- FAQ Stats -->
<div class="faq-stats">
    <div class="faq-stat-card">
        <div class="faq-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-question-circle"></i>
        </div>
        <div>
            <div class="faq-stat-value">{{ number_format($totalFaqs) }}</div>
            <div class="faq-stat-label">Total FAQs</div>
        </div>
    </div>
    <div class="faq-stat-card">
        <div class="faq-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-list"></i>
        </div>
        <div>
            <div class="faq-stat-value">{{ count($show_info) }}</div>
            <div class="faq-stat-label">On This Page</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">Frequently Asked Questions</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage FAQ content for your website</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/admin/add-faq') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add FAQ
        </a>
    </div>
</div>

<!-- Search -->
<div style="margin-bottom: var(--space-lg);">
    <div class="table-search" style="max-width: 300px;">
        <i class="fas fa-search"></i>
        <input type="text" id="faqSearch" placeholder="Search FAQs...">
    </div>
</div>

@if(count($show_info) > 0)
<!-- FAQ List -->
<div class="faq-list" id="faqList">
    @php $i = 0; @endphp
    @foreach($show_info as $faq)
    <div class="faq-item">
        <div class="faq-number">{{ ++$i }}</div>
        <div class="faq-question">{{ $faq->name }}</div>
        <div class="action-buttons">
            <a href="{{ url('/admin/edit-faq/' . $faq->id) }}" class="btn btn-icon btn-sm" title="Edit">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{ url('/admin/delete-faq/' . $faq->id) }}" class="btn btn-icon btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this FAQ?')">
                <i class="fas fa-trash"></i>
            </a>
        </div>
    </div>
    @endforeach
</div>
@else
<div style="text-align: center; padding: var(--space-3xl); background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl);">
    <i class="fas fa-question-circle" style="font-size: 4rem; color: var(--text-muted); margin-bottom: var(--space-lg);"></i>
    <h3 style="color: var(--text-primary); margin-bottom: var(--space-sm);">No FAQs Yet</h3>
    <p style="color: var(--text-muted); margin-bottom: var(--space-lg);">Add frequently asked questions to help your customers</p>
    <a href="{{ url('/admin/add-faq') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add First FAQ
    </a>
</div>
@endif

@endsection

@push('page-scripts')
<script>
    // Search functionality
    document.getElementById('faqSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.faq-item');

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
