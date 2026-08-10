@extends('layouts.redesign.frontend')

@section('title', 'Blog - Fastap')

@push('styles')
<style>
    .blog-hero {
        background: var(--gradient-purple);
        padding: var(--space-3xl) 0;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .blog-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 600px;
        height: 600px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .blog-hero-title {
        font-size: var(--text-4xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-md);
        position: relative;
        z-index: 1;
    }

    .blog-hero-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-sm);
        font-size: var(--text-sm);
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .blog-hero-breadcrumb a {
        color: white;
        text-decoration: none;
    }

    .blog-hero-breadcrumb a:hover {
        text-decoration: underline;
    }

    .blog-section {
        padding: var(--space-3xl) 0;
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: var(--space-xl);
    }

    .blog-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: var(--radius-xl);
        overflow: hidden;
        transition: all var(--transition-base);
    }

    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }

    .blog-card-image {
        height: 220px;
        overflow: hidden;
    }

    .blog-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-base);
    }

    .blog-card:hover .blog-card-image img {
        transform: scale(1.05);
    }

    .blog-card-content {
        padding: var(--space-lg);
    }

    .blog-card-meta {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        font-size: var(--text-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-md);
    }

    .blog-card-meta span {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .blog-card-meta i {
        color: var(--purple-500);
    }

    .blog-card-title {
        font-size: var(--text-xl);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
        line-height: 1.4;
    }

    .blog-card-title a {
        color: inherit;
        text-decoration: none;
        transition: color var(--transition-fast);
    }

    .blog-card-title a:hover {
        color: var(--purple-500);
    }

    .blog-card-excerpt {
        color: var(--text-secondary);
        font-size: var(--text-sm);
        line-height: 1.6;
        margin-bottom: var(--space-lg);
    }

    .blog-card-link {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        color: var(--purple-500);
        font-weight: var(--font-medium);
        text-decoration: none;
        transition: all var(--transition-fast);
    }

    .blog-card-link:hover {
        gap: var(--space-sm);
    }

    .blog-card-link i {
        transition: transform var(--transition-fast);
    }

    .blog-card-link:hover i {
        transform: translateX(4px);
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: var(--space-2xl);
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .pagination-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        background: var(--bg-primary);
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: var(--font-medium);
        transition: all var(--transition-fast);
    }

    .pagination-btn:hover,
    .pagination-btn.active {
        background: var(--purple-500);
        border-color: var(--purple-500);
        color: white;
    }

    @media (max-width: 768px) {
        .blog-hero-title {
            font-size: var(--text-2xl);
        }

        .blog-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="blog-hero">
    <div class="container">
        <h1 class="blog-hero-title">Our Blog</h1>
        <nav class="blog-hero-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>Blog</span>
        </nav>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section">
    <div class="container">
        <div class="blog-grid">
            @php
                $blogs = DB::table('blogs')->where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
            @endphp

            @forelse($blogs as $blog)
            <article class="blog-card">
                <div class="blog-card-image">
                    @if($blog->image)
                        <img src="{{ asset('uploads/blogs/'.$blog->image) }}" alt="{{ $blog->title }}">
                    @else
                        <img src="{{ asset('redesign/images/blog-placeholder.jpg') }}" alt="{{ $blog->title }}">
                    @endif
                </div>
                <div class="blog-card-content">
                    <div class="blog-card-meta">
                        <span><i class="fas fa-user"></i> Admin</span>
                        <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}</span>
                    </div>
                    <h2 class="blog-card-title">
                        <a href="{{ url('/blog-details/'.$blog->slug) }}">{{ Str::limit($blog->title, 60) }}</a>
                    </h2>
                    <p class="blog-card-excerpt">
                        {{ Str::limit(strip_tags($blog->content), 120) }}
                    </p>
                    <a href="{{ url('/blog-details/'.$blog->slug) }}" class="blog-card-link">
                        Read More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            @empty
            <!-- Static blog cards for demo -->
            <article class="blog-card">
                <div class="blog-card-image">
                    <img src="{{ asset('redesign/images/illustrations/nfc-sharing.svg') }}" alt="Blog">
                </div>
                <div class="blog-card-content">
                    <div class="blog-card-meta">
                        <span><i class="fas fa-user"></i> Admin</span>
                        <span><i class="fas fa-calendar"></i> Dec 01, 2024</span>
                    </div>
                    <h2 class="blog-card-title">
                        <a href="{{ url('/blog-details') }}">How NFC Technology is Revolutionizing Business Cards</a>
                    </h2>
                    <p class="blog-card-excerpt">
                        Discover how NFC-enabled digital business cards are changing the way professionals network and share contact information.
                    </p>
                    <a href="{{ url('/blog-details') }}" class="blog-card-link">
                        Read More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-card-image">
                    <img src="{{ asset('redesign/images/illustrations/digital-profile.svg') }}" alt="Blog">
                </div>
                <div class="blog-card-content">
                    <div class="blog-card-meta">
                        <span><i class="fas fa-user"></i> Admin</span>
                        <span><i class="fas fa-calendar"></i> Nov 25, 2024</span>
                    </div>
                    <h2 class="blog-card-title">
                        <a href="{{ url('/blog-details') }}">Creating the Perfect Digital Business Profile</a>
                    </h2>
                    <p class="blog-card-excerpt">
                        Learn tips and tricks for creating a compelling digital profile that makes a lasting impression on potential clients.
                    </p>
                    <a href="{{ url('/blog-details') }}" class="blog-card-link">
                        Read More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-card-image">
                    <img src="{{ asset('redesign/images/illustrations/analytics.svg') }}" alt="Blog">
                </div>
                <div class="blog-card-content">
                    <div class="blog-card-meta">
                        <span><i class="fas fa-user"></i> Admin</span>
                        <span><i class="fas fa-calendar"></i> Nov 18, 2024</span>
                    </div>
                    <h2 class="blog-card-title">
                        <a href="{{ url('/blog-details') }}">Understanding Your Profile Analytics</a>
                    </h2>
                    <p class="blog-card-excerpt">
                        Make data-driven decisions by understanding the analytics and insights from your Fastap digital business card.
                    </p>
                    <a href="{{ url('/blog-details') }}" class="blog-card-link">
                        Read More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            @endforelse
        </div>

        @if(isset($blogs) && method_exists($blogs, 'hasPages') && $blogs->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination">
                @if($blogs->onFirstPage())
                    <span class="pagination-btn" style="opacity: 0.5;"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $blogs->previousPageUrl() }}" class="pagination-btn"><i class="fas fa-chevron-left"></i></a>
                @endif

                @foreach($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="pagination-btn {{ $page == $blogs->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                @endforeach

                @if($blogs->hasMorePages())
                    <a href="{{ $blogs->nextPageUrl() }}" class="pagination-btn"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="pagination-btn" style="opacity: 0.5;"><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
