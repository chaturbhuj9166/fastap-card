@extends('layouts.redesign.admin')

@section('page-title', 'Testimonials')
@section('breadcrumb', 'Testimonials')

@push('page-styles')
<style>
    .testimonial-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: var(--space-lg);
    }

    .testimonial-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: transform var(--transition-fast), box-shadow var(--transition-fast);
    }

    .testimonial-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .testimonial-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: var(--bg-tertiary);
    }

    .testimonial-content {
        padding: var(--space-lg);
    }

    .testimonial-name {
        font-size: var(--text-lg);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .testimonial-actions {
        display: flex;
        gap: var(--space-sm);
        padding-top: var(--space-md);
        border-top: 1px solid var(--card-border);
    }

    .empty-state {
        text-align: center;
        padding: var(--space-3xl);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--text-muted);
        margin-bottom: var(--space-lg);
    }
</style>
@endpush

@section('admin-content')
@php
    $totalTestimonials = DB::table('testimonials')->count();
@endphp

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">Testimonials</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">{{ $totalTestimonials }} customer testimonials</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/admin/addtestimonial') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Testimonial
        </a>
    </div>
</div>

@if(count($testimonial) > 0)
<!-- Testimonial Grid -->
<div class="testimonial-grid">
    @foreach($testimonial as $item)
    <div class="testimonial-card">
        @if($item->image)
            <img src="{{ url('uploads/testimonial/' . $item->image) }}" alt="{{ $item->name }}" class="testimonial-image">
        @else
            <div class="testimonial-image" style="display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-user" style="font-size: 4rem; color: var(--text-muted);"></i>
            </div>
        @endif
        <div class="testimonial-content">
            <h3 class="testimonial-name">{{ $item->name }}</h3>
            <div class="testimonial-actions">
                <a href="{{ url('/admin/edittestimonial' . $item->id) }}" class="btn btn-secondary btn-sm" style="flex: 1;">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ url('/admin/testimonialdelete' . $item->id) }}" class="btn btn-danger btn-sm" style="flex: 1;" onclick="return confirm('Are you sure you want to delete this testimonial?')">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="empty-state">
    <i class="fas fa-comment-dots"></i>
    <h3 style="color: var(--text-primary); margin-bottom: var(--space-sm);">No Testimonials Yet</h3>
    <p style="color: var(--text-muted); margin-bottom: var(--space-lg);">Start collecting customer testimonials to build trust</p>
    <a href="{{ url('/admin/addtestimonial') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add First Testimonial
    </a>
</div>
@endif

@endsection
