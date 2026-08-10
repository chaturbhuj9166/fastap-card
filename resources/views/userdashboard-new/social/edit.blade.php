@extends('layouts.redesign.dashboard')

@section('page-title', 'Edit Social Links')
@section('breadcrumb', 'Edit Social Links')

@section('dashboard-content')
<div class="social-form-page">
    {{-- Page Header --}}
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Edit Social Links</h1>
            <p>Update your social media profiles</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ url('/social') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <form action="{{ url('/updatesocial') }}" method="POST" class="social-form">
        @csrf
        <input type="hidden" name="id" value="{{ $social->id }}">

        <div class="form-card fade-up">
            <div class="form-card-header">
                <h3><i class="fas fa-share-alt"></i> Social Media Profiles</h3>
                <p>Update links to your social media accounts. Leave blank any you don't want to include.</p>
            </div>

            <div class="form-card-body">
                <div class="social-inputs-grid">
                    {{-- YouTube --}}
                    <div class="social-input-group">
                        <div class="social-input-icon youtube">
                            <i class="fab fa-youtube"></i>
                        </div>
                        <div class="social-input-field">
                            <label for="youtube">YouTube</label>
                            <input type="url" id="youtube" name="youtube"
                                   value="{{ old('youtube', $social->youtube) }}"
                                   class="form-control @error('youtube') is-invalid @enderror"
                                   placeholder="https://youtube.com/channel/...">
                            @error('youtube')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Facebook --}}
                    <div class="social-input-group">
                        <div class="social-input-icon facebook">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <div class="social-input-field">
                            <label for="facebook">Facebook</label>
                            <input type="url" id="facebook" name="facebook"
                                   value="{{ old('facebook', $social->facebook) }}"
                                   class="form-control @error('facebook') is-invalid @enderror"
                                   placeholder="https://facebook.com/...">
                            @error('facebook')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Instagram --}}
                    <div class="social-input-group">
                        <div class="social-input-icon instagram">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <div class="social-input-field">
                            <label for="instagram">Instagram</label>
                            <input type="url" id="instagram" name="instagram"
                                   value="{{ old('instagram', $social->instagram) }}"
                                   class="form-control @error('instagram') is-invalid @enderror"
                                   placeholder="https://instagram.com/...">
                            @error('instagram')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Twitter --}}
                    <div class="social-input-group">
                        <div class="social-input-icon twitter">
                            <i class="fab fa-twitter"></i>
                        </div>
                        <div class="social-input-field">
                            <label for="twitter">Twitter</label>
                            <input type="url" id="twitter" name="twitter"
                                   value="{{ old('twitter', $social->twitter) }}"
                                   class="form-control @error('twitter') is-invalid @enderror"
                                   placeholder="https://twitter.com/...">
                            @error('twitter')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- LinkedIn --}}
                    <div class="social-input-group">
                        <div class="social-input-icon linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </div>
                        <div class="social-input-field">
                            <label for="linkdin">LinkedIn</label>
                            <input type="url" id="linkdin" name="linkdin"
                                   value="{{ old('linkdin', $social->linkdin) }}"
                                   class="form-control @error('linkdin') is-invalid @enderror"
                                   placeholder="https://linkedin.com/in/...">
                            @error('linkdin')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Snapchat --}}
                    <div class="social-input-group">
                        <div class="social-input-icon snapchat">
                            <i class="fab fa-snapchat-ghost"></i>
                        </div>
                        <div class="social-input-field">
                            <label for="snapchat">Snapchat</label>
                            <input type="url" id="snapchat" name="snapchat"
                                   value="{{ old('snapchat', $social->snapchat) }}"
                                   class="form-control @error('snapchat') is-invalid @enderror"
                                   placeholder="https://snapchat.com/add/...">
                            @error('snapchat')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Pinterest --}}
                    <div class="social-input-group">
                        <div class="social-input-icon pinterest">
                            <i class="fab fa-pinterest-p"></i>
                        </div>
                        <div class="social-input-field">
                            <label for="pinterest">Pinterest</label>
                            <input type="url" id="pinterest" name="pinterest"
                                   value="{{ old('pinterest', $social->pinterest) }}"
                                   class="form-control @error('pinterest') is-invalid @enderror"
                                   placeholder="https://pinterest.com/...">
                            @error('pinterest')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Google Review --}}
                    <div class="social-input-group">
                        <div class="social-input-icon google">
                            <i class="fab fa-google"></i>
                        </div>
                        <div class="social-input-field">
                            <label for="google_review">Google Review</label>
                            <input type="url" id="google_review" name="google_review"
                                   value="{{ old('google_review', $social->google_review) }}"
                                   class="form-control @error('google_review') is-invalid @enderror"
                                   placeholder="https://g.page/...">
                            @error('google_review')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card-footer">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Update Social Links
                </button>
                <a href="{{ url('/social') }}" class="btn btn-outline btn-lg">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>

<style>
.social-form-page {
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

/* Form Card */
.form-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.form-card-header {
    padding: var(--space-lg);
    border-bottom: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

.form-card-header h3 {
    font-size: var(--text-base);
    font-weight: var(--font-semibold);
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin: 0 0 var(--space-xs) 0;
}

.form-card-header h3 i {
    color: var(--purple-500);
}

.form-card-header p {
    font-size: var(--text-sm);
    color: var(--text-secondary);
    margin: 0;
}

.form-card-body {
    padding: var(--space-xl);
}

.form-card-footer {
    display: flex;
    gap: var(--space-md);
    padding: var(--space-lg);
    border-top: 1px solid var(--border-light);
    background: var(--bg-secondary);
}

/* Social Inputs Grid */
.social-inputs-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-lg);
}

.social-input-group {
    display: flex;
    gap: var(--space-md);
    align-items: flex-start;
}

.social-input-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--text-xl);
    color: white;
    flex-shrink: 0;
    margin-top: 24px;
}

.social-input-icon.youtube { background: #FF0000; }
.social-input-icon.facebook { background: #1877F2; }
.social-input-icon.instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
.social-input-icon.twitter { background: #1DA1F2; }
.social-input-icon.linkedin { background: #0A66C2; }
.social-input-icon.snapchat { background: #FFFC00; color: #000; }
.social-input-icon.pinterest { background: #E60023; }
.social-input-icon.google { background: #4285F4; }

.social-input-field {
    flex: 1;
}

.social-input-field label {
    display: block;
    font-size: var(--text-sm);
    font-weight: var(--font-medium);
    color: var(--text-primary);
    margin-bottom: var(--space-xs);
}

.form-control {
    width: 100%;
    padding: var(--space-sm) var(--space-md);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: var(--text-base);
    transition: all var(--transition-fast);
}

.form-control:focus {
    outline: none;
    border-color: var(--purple-500);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
}

.form-control.is-invalid {
    border-color: var(--red-500);
}

.form-error {
    display: block;
    font-size: var(--text-xs);
    color: var(--red-500);
    margin-top: var(--space-xs);
}

/* Responsive */
@media (max-width: 992px) {
    .social-inputs-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .form-card-footer {
        flex-direction: column;
    }

    .form-card-footer .btn {
        width: 100%;
        justify-content: center;
    }

    .social-input-icon {
        width: 40px;
        height: 40px;
        font-size: var(--text-lg);
    }
}
</style>
@endsection
