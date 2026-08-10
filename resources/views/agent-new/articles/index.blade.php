@extends('layouts.redesign.agent')

@section('page-title', 'Articles')
@section('breadcrumb', 'Articles')

@push('page-styles')
<style>
    .article-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .article-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .article-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xl);
    }

    .article-stat-value {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
    }

    .article-stat-label {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .article-date {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .desc-cell {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        .article-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('agent-content')
@php
    $totalArticles = count($article);
@endphp

<!-- Article Stats -->
<div class="article-stats">
    <div class="article-stat-card">
        <div class="article-stat-icon" style="background: rgba(124, 58, 237, 0.1); color: var(--purple-500);">
            <i class="fas fa-newspaper"></i>
        </div>
        <div>
            <div class="article-stat-value">{{ $totalArticles }}</div>
            <div class="article-stat-label">Total Articles</div>
        </div>
    </div>
    <div class="article-stat-card">
        <div class="article-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--green-500);">
            <i class="fas fa-file-alt"></i>
        </div>
        <div>
            <div class="article-stat-value">{{ $article->count() }}</div>
            <div class="article-stat-label">On This Page</div>
        </div>
    </div>
</div>

<!-- Page Header -->
<div class="table-header" style="background: var(--card-bg); border: 1px solid var(--card-border); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg);">
    <div>
        <h2 class="table-title">Articles</h2>
        <p style="color: var(--text-muted); font-size: var(--text-sm); margin-top: var(--space-xs);">Manage blog articles</p>
    </div>
    <div class="table-actions">
        <a href="{{ url('/agent/addarticle') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Article
        </a>
    </div>
</div>

<!-- Search -->
<div style="margin-bottom: var(--space-lg);">
    <div class="table-search" style="max-width: 300px;">
        <i class="fas fa-search"></i>
        <input type="text" id="articleSearch" placeholder="Search articles...">
    </div>
</div>

<!-- Articles Table -->
<div class="table-container">
    <table class="data-table" id="articlesTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Short Description</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($article as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-weight: var(--font-medium);">{{ $item->title }}</td>
                <td class="desc-cell" title="{{ $item->short_desc }}">{{ Str::limit($item->short_desc, 30) }}</td>
                <td class="article-date">{{ $item->post_date }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ url('/agent/editarticle/' . $item->id . '/edit') }}" class="btn btn-icon btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if(Session::get('ROLE') === 'admin')
                        <a href="{{ url('/agent/article/' . $item->id . '/delete') }}" class="btn btn-icon btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: var(--space-xl);">
                    <div style="color: var(--text-muted);">
                        <i class="fas fa-newspaper" style="font-size: var(--text-3xl); margin-bottom: var(--space-md);"></i>
                        <p>No articles found</p>
                        <a href="{{ url('/agent/addarticle') }}" class="btn btn-primary btn-sm" style="margin-top: var(--space-md);">
                            <i class="fas fa-plus"></i> Add First Article
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if($article->hasPages())
<div style="margin-top: var(--space-lg); display: flex; justify-content: center;">
    {{ $article->links() }}
</div>
@endif

@endsection

@push('page-scripts')
<script>
    // Search functionality
    document.getElementById('articleSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#articlesTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
