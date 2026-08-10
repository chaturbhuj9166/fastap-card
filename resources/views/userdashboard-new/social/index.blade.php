@extends('layouts.redesign.dashboard')

@section('page-title', 'Social Links')
@section('breadcrumb', 'Social Links')

@section('dashboard-content')
<div class="social-page">
    {{-- Page Header --}}
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Social Links</h1>
            <p>Manage your social media profiles</p>
        </div>
        <div class="page-header-actions">
            @if(!$socials || $socials->count() == 0)
                <a href="{{ url('/addsocial') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Social Links
                </a>
            @endif
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    @if($socials && $socials->count() > 0)
        @foreach($socials as $social)
            <div class="social-card fade-up">
                <div class="social-card-header">
                    <h3><i class="fas fa-share-alt"></i> Your Social Profiles</h3>
                    <div class="social-card-actions">
                        <a href="{{ url('/editsocial' . $social->id) }}" class="btn btn-sm btn-outline">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ url('/deletesocial' . $social->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete all social links?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>

                <div class="social-links-grid">
                    @if($social->youtube)
                        <a href="{{ $social->youtube }}" target="_blank" class="social-link-item youtube">
                            <div class="social-icon">
                                <i class="fab fa-youtube"></i>
                            </div>
                            <div class="social-info">
                                <span class="social-name">YouTube</span>
                                <span class="social-url">{{ Str::limit($social->youtube, 40) }}</span>
                            </div>
                            <i class="fas fa-external-link-alt social-external"></i>
                        </a>
                    @endif

                    @if($social->facebook)
                        <a href="{{ $social->facebook }}" target="_blank" class="social-link-item facebook">
                            <div class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="social-info">
                                <span class="social-name">Facebook</span>
                                <span class="social-url">{{ Str::limit($social->facebook, 40) }}</span>
                            </div>
                            <i class="fas fa-external-link-alt social-external"></i>
                        </a>
                    @endif

                    @if($social->instagram)
                        <a href="{{ $social->instagram }}" target="_blank" class="social-link-item instagram">
                            <div class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="social-info">
                                <span class="social-name">Instagram</span>
                                <span class="social-url">{{ Str::limit($social->instagram, 40) }}</span>
                            </div>
                            <i class="fas fa-external-link-alt social-external"></i>
                        </a>
                    @endif

                    @if($social->twitter)
                        <a href="{{ $social->twitter }}" target="_blank" class="social-link-item twitter">
                            <div class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="social-info">
                                <span class="social-name">Twitter</span>
                                <span class="social-url">{{ Str::limit($social->twitter, 40) }}</span>
                            </div>
                            <i class="fas fa-external-link-alt social-external"></i>
                        </a>
                    @endif

                    @if($social->linkdin)
                        <a href="{{ $social->linkdin }}" target="_blank" class="social-link-item linkedin">
                            <div class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                            <div class="social-info">
                                <span class="social-name">LinkedIn</span>
                                <span class="social-url">{{ Str::limit($social->linkdin, 40) }}</span>
                            </div>
                            <i class="fas fa-external-link-alt social-external"></i>
                        </a>
                    @endif

                    @if($social->snapchat)
                        <a href="{{ $social->snapchat }}" target="_blank" class="social-link-item snapchat">
                            <div class="social-icon">
                                <i class="fab fa-snapchat-ghost"></i>
                            </div>
                            <div class="social-info">
                                <span class="social-name">Snapchat</span>
                                <span class="social-url">{{ Str::limit($social->snapchat, 40) }}</span>
                            </div>
                            <i class="fas fa-external-link-alt social-external"></i>
                        </a>
                    @endif

                    @if($social->pinterest)
                        <a href="{{ $social->pinterest }}" target="_blank" class="social-link-item pinterest">
                            <div class="social-icon">
                                <i class="fab fa-pinterest-p"></i>
                            </div>
                            <div class="social-info">
                                <span class="social-name">Pinterest</span>
                                <span class="social-url">{{ Str::limit($social->pinterest, 40) }}</span>
                            </div>
                            <i class="fas fa-external-link-alt social-external"></i>
                        </a>
                    @endif

                    @if($social->google_review)
                        <a href="{{ $social->google_review }}" target="_blank" class="social-link-item google">
                            <div class="social-icon">
                                <i class="fab fa-google"></i>
                            </div>
                            <div class="social-info">
                                <span class="social-name">Google Review</span>
                                <span class="social-url">{{ Str::limit($social->google_review, 40) }}</span>
                            </div>
                            <i class="fas fa-external-link-alt social-external"></i>
                        </a>
                    @endif
                </div>

                @php
                    $filledLinks = collect([
                        $social->youtube, $social->facebook, $social->instagram,
                        $social->twitter, $social->linkdin, $social->snapchat,
                        $social->pinterest, $social->google_review
                    ])->filter()->count();
                @endphp

                @if($filledLinks == 0)
                    <div class="social-empty-state">
                        <i class="fas fa-link"></i>
                        <p>No social links added yet. Click Edit to add your profiles.</p>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="empty-state fade-up">
            <div class="empty-state-icon">
                <i class="fas fa-share-alt"></i>
            </div>
            <h3>No Social Links</h3>
            <p>Add your social media profiles to let visitors connect with you.</p>
            <a href="{{ url('/addsocial') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Social Links
            </a>
        </div>
    @endif
</div>

<style>
.social-page {
    padding: var(--space-lg);
}

/* Page Header */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: var(--space-xl);
    flex-wrap: wrap;
    gap: var(--space-md);
}

.page-header-content h1 {
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    margin-bottom: var(--space-xs);
}

.page-header-content p {
    color: var(--text-secondary);
}

/* Social Card */
.social-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.social-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
    flex-wrap: wrap;
    gap: var(--space-md);
}

.social-card-header h3 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0;
}

.social-card-header h3 i {
    color: var(--purple-500);
}

.social-card-actions {
    display: flex;
    gap: var(--space-sm);
}

/* Social Links Grid */
.social-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: var(--space-md);
    padding: var(--space-lg);
}

.social-link-item {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    padding: var(--space-md);
    background: var(--bg-secondary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.social-link-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--purple-300);
}

.social-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-xl);
    color: white;
    flex-shrink: 0;
}

.social-link-item.youtube .social-icon { background: #FF0000; }
.social-link-item.facebook .social-icon { background: #1877F2; }
.social-link-item.instagram .social-icon { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
.social-link-item.twitter .social-icon { background: #1DA1F2; }
.social-link-item.linkedin .social-icon { background: #0A66C2; }
.social-link-item.snapchat .social-icon { background: #FFFC00; color: #000; }
.social-link-item.pinterest .social-icon { background: #E60023; }
.social-link-item.google .social-icon { background: #4285F4; }

.social-info {
    flex: 1;
    min-width: 0;
}

.social-name {
    display: block;
    font-weight: var(--font-semibold);
    color: var(--text-primary);
    margin-bottom: 2px;
}

.social-url {
    display: block;
    font-size: var(--text-xs);
    color: var(--text-muted);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.social-external {
    color: var(--text-muted);
    font-size: var(--text-sm);
    opacity: 0;
    transition: opacity var(--transition-fast);
}

.social-link-item:hover .social-external {
    opacity: 1;
}

/* Empty State */
.social-empty-state {
    text-align: center;
    padding: var(--space-xl);
    color: var(--text-muted);
}

.social-empty-state i {
    font-size: var(--text-3xl);
    margin-bottom: var(--space-md);
}

.empty-state {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    text-align: center;
    padding: var(--space-3xl);
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto var(--space-lg);
    background: var(--bg-secondary);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-3xl);
    color: var(--text-muted);
}

.empty-state h3 {
    font-size: var(--text-xl);
    margin-bottom: var(--space-sm);
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: var(--space-lg);
}

/* Responsive */
@media (max-width: 576px) {
    .social-links-grid {
        grid-template-columns: 1fr;
    }

    .social-card-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .social-card-actions {
        width: 100%;
    }

    .social-card-actions .btn {
        flex: 1;
        justify-content: center;
    }
}
</style>
@endsection
