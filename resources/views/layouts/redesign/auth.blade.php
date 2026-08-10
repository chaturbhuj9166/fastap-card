@extends('layouts.redesign.app')

@section('content')
    <div class="auth-wrapper">
        <div class="auth-container">
            <!-- Left Side - Illustration -->
            <div class="auth-illustration hide-mobile">
                <div class="auth-illustration-content">
                    <img src="{{ asset('frontend/assets/img/redesign/hero/hero-ai-tech.svg') }}" alt="Fastap">
                    <h2>Welcome to Fastap</h2>
                    <p>Transform your networking with smart NFC digital business cards</p>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="auth-form-wrapper">
                <div class="auth-form-container">
                    <!-- Logo -->
                    <a href="{{ url('/') }}" class="auth-logo">
                        <span class="text-gradient-purple">FASTAP</span>
                    </a>

                    <!-- Form Content -->
                    @yield('auth-content')

                    <!-- Footer -->
                    <div class="auth-footer">
                        <p class="text-muted text-center">
                            &copy; {{ date('Y') }} Fastap. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.auth-wrapper {
    min-height: 100vh;
    background: var(--bg-secondary);
}

.auth-container {
    display: flex;
    min-height: 100vh;
}

.auth-illustration {
    flex: 1;
    background: var(--gradient-purple);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-2xl);
    position: relative;
    overflow: hidden;
}

.auth-illustration::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.auth-illustration-content {
    text-align: center;
    color: white;
    position: relative;
    z-index: 1;
}

.auth-illustration-content img {
    max-width: 300px;
    margin-bottom: var(--space-xl);
}

.auth-illustration-content h2 {
    font-size: var(--text-3xl);
    margin-bottom: var(--space-md);
    color: white;
}

.auth-illustration-content p {
    font-size: var(--text-lg);
    opacity: 0.9;
    color: white;
}

.auth-form-wrapper {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-xl);
    background: var(--bg-primary);
}

.auth-form-container {
    width: 100%;
    max-width: 420px;
}

.auth-logo {
    display: block;
    text-align: center;
    font-size: var(--text-3xl);
    font-weight: var(--font-extrabold);
    margin-bottom: var(--space-xl);
    text-decoration: none;
}

.auth-title {
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    color: var(--text-primary);
    margin-bottom: var(--space-xs);
    text-align: center;
}

.auth-subtitle {
    color: var(--text-secondary);
    margin-bottom: var(--space-xl);
    text-align: center;
}

.auth-divider {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    margin: var(--space-lg) 0;
    color: var(--text-muted);
    font-size: var(--text-sm);
}

.auth-divider::before,
.auth-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border-light);
}

.auth-footer {
    margin-top: var(--space-xl);
}

.auth-link {
    text-align: center;
    margin-top: var(--space-lg);
}

.auth-link a {
    color: var(--purple-500);
    font-weight: var(--font-medium);
}

@media (max-width: 992px) {
    .auth-illustration {
        display: none;
    }

    .auth-form-wrapper {
        padding: var(--space-lg);
    }
}
</style>
@endpush
