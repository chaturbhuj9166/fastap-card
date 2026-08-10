@extends('layouts.redesign.company')

@section('page-title', 'Change Password')
@section('breadcrumb', 'Change Password')

@section('company-content')
<div class="password-page">
    <div class="form-card">
        <div class="card-header">
            <h3><i class="fas fa-key"></i> Change Password</h3>
        </div>
        <form action="{{ route('company.password.update') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Current Password *</label>
                    <div class="password-input-wrapper">
                        <input type="password" name="current_password" class="form-input" required id="currentPassword">
                        <button type="button" class="password-toggle" onclick="togglePassword('currentPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">New Password *</label>
                    <div class="password-input-wrapper">
                        <input type="password" name="password" class="form-input" required minlength="6" id="newPassword">
                        <button type="button" class="password-toggle" onclick="togglePassword('newPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <small class="form-hint">Minimum 6 characters</small>
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm New Password *</label>
                    <div class="password-input-wrapper">
                        <input type="password" name="password_confirmation" class="form-input" required minlength="6" id="confirmPassword">
                        <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="password-tips">
                    <h4><i class="fas fa-shield-alt"></i> Password Tips</h4>
                    <ul>
                        <li>Use at least 6 characters</li>
                        <li>Mix uppercase and lowercase letters</li>
                        <li>Include numbers and special characters</li>
                        <li>Don't use easily guessable information</li>
                    </ul>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ url('/company/profile') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Password
                </button>
            </div>
        </form>
    </div>
</div>

@push('page-styles')
<style>
    .password-page {
        max-width: 500px;
    }
    .form-card {
        background: var(--bg-primary);
        border-radius: 1rem;
        box-shadow: var(--shadow-sm);
    }
    .card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    .card-header h3 {
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .card-body {
        padding: 1.5rem;
    }
    .card-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }
    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        background: var(--bg-primary);
        color: var(--text-primary);
    }
    .form-input:focus {
        outline: none;
        border-color: #0891b2;
    }
    .form-hint {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
        display: block;
    }
    .form-error {
        font-size: 0.8rem;
        color: #ef4444;
        margin-top: 0.25rem;
        display: block;
    }
    .password-input-wrapper {
        position: relative;
    }
    .password-input-wrapper .form-input {
        padding-right: 3rem;
    }
    .password-toggle {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 0.25rem;
    }
    .password-toggle:hover {
        color: #0891b2;
    }
    .password-tips {
        background: var(--bg-secondary);
        border-radius: 0.5rem;
        padding: 1rem;
        margin-top: 1rem;
    }
    .password-tips h4 {
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        color: #0891b2;
    }
    .password-tips ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .password-tips li {
        font-size: 0.85rem;
        color: var(--text-muted);
        padding: 0.25rem 0;
        padding-left: 1rem;
        position: relative;
    }
    .password-tips li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.6rem;
        width: 4px;
        height: 4px;
        background: #0891b2;
        border-radius: 50%;
    }
</style>
@endpush

@push('page-scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
@endsection
