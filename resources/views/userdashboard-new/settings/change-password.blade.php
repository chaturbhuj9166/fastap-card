@extends('layouts.redesign.dashboard')

@section('page-title', 'Change Password')
@section('breadcrumb', 'Change Password')

@section('dashboard-content')
<div class="form-page settings-page">
    <div class="page-header fade-up">
        <div class="page-header-content">
            <h1>Change Password</h1>
            <p>Update your account password</p>
        </div>
    </div>

    @include('layouts.redesign.partials.flash-messages')

    <div class="settings-container">
        <form action="{{ url('/updatepassword') }}" method="POST">
            @csrf
            <div class="form-card fade-up">
                <div class="form-card-header">
                    <h3><i class="fas fa-lock"></i> Password Settings</h3>
                </div>
                <div class="form-card-body">
                    <div class="security-notice">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <strong>Security Tips</strong>
                            <p>Use a strong password with at least 8 characters, including uppercase, lowercase, numbers, and special characters.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="old_password">Current Password <span class="required">*</span></label>
                        <div class="password-input-wrapper">
                            <input type="password" id="old_password" name="old_password"
                                   class="form-control @error('old_password') is-invalid @enderror"
                                   placeholder="Enter your current password" required>
                            <button type="button" class="password-toggle" tabindex="-1">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('old_password')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="new_password">New Password <span class="required">*</span></label>
                            <div class="password-input-wrapper">
                                <input type="password" id="new_password" name="new_password"
                                       class="form-control @error('new_password') is-invalid @enderror"
                                       placeholder="Enter new password" required>
                                <button type="button" class="password-toggle" tabindex="-1">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('new_password')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                            <div class="password-strength" id="passwordStrength">
                                <div class="strength-bar"></div>
                                <span class="strength-text"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_pass">Confirm New Password <span class="required">*</span></label>
                            <div class="password-input-wrapper">
                                <input type="password" id="confirm_pass" name="confirm_pass"
                                       class="form-control @error('confirm_pass') is-invalid @enderror"
                                       placeholder="Confirm new password" required>
                                <button type="button" class="password-toggle" tabindex="-1">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('confirm_pass')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                            <div class="password-match" id="passwordMatch"></div>
                        </div>
                    </div>
                </div>
                <div class="form-card-footer">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-key"></i> Update Password
                    </button>
                    <a href="{{ url('/userdashboard') }}" class="btn btn-outline btn-lg">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
.settings-container {
    max-width: 700px;
}

.security-notice {
    display: flex;
    gap: 1rem;
    padding: 1rem 1.25rem;
    background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(155, 89, 182, 0.1));
    border-radius: 12px;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(52, 152, 219, 0.2);
}

.security-notice i {
    font-size: 1.5rem;
    color: var(--primary-color);
    margin-top: 0.25rem;
}

.security-notice strong {
    display: block;
    color: var(--text-color);
    margin-bottom: 0.25rem;
}

.security-notice p {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.5;
}

.password-input-wrapper {
    position: relative;
}

.password-input-wrapper input {
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
    padding: 0.5rem;
    transition: color 0.2s;
}

.password-toggle:hover {
    color: var(--primary-color);
}

.password-strength {
    margin-top: 0.5rem;
    display: none;
}

.password-strength.show {
    display: block;
}

.strength-bar {
    height: 4px;
    border-radius: 2px;
    background: var(--border-color);
    overflow: hidden;
    margin-bottom: 0.25rem;
}

.strength-bar::before {
    content: '';
    display: block;
    height: 100%;
    width: 0;
    transition: width 0.3s, background 0.3s;
}

.password-strength.weak .strength-bar::before {
    width: 33%;
    background: var(--danger-color);
}

.password-strength.medium .strength-bar::before {
    width: 66%;
    background: var(--warning-color);
}

.password-strength.strong .strength-bar::before {
    width: 100%;
    background: var(--success-color);
}

.strength-text {
    font-size: 0.75rem;
    color: var(--text-muted);
}

.password-strength.weak .strength-text { color: var(--danger-color); }
.password-strength.medium .strength-text { color: var(--warning-color); }
.password-strength.strong .strength-text { color: var(--success-color); }

.password-match {
    margin-top: 0.5rem;
    font-size: 0.75rem;
    display: none;
}

.password-match.show {
    display: block;
}

.password-match.match {
    color: var(--success-color);
}

.password-match.no-match {
    color: var(--danger-color);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle visibility
    document.querySelectorAll('.password-toggle').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Password strength indicator
    const newPassword = document.getElementById('new_password');
    const strengthEl = document.getElementById('passwordStrength');

    newPassword.addEventListener('input', function() {
        const password = this.value;

        if (password.length === 0) {
            strengthEl.classList.remove('show', 'weak', 'medium', 'strong');
            return;
        }

        strengthEl.classList.add('show');

        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;

        strengthEl.classList.remove('weak', 'medium', 'strong');

        if (strength <= 1) {
            strengthEl.classList.add('weak');
            strengthEl.querySelector('.strength-text').textContent = 'Weak password';
        } else if (strength <= 3) {
            strengthEl.classList.add('medium');
            strengthEl.querySelector('.strength-text').textContent = 'Medium strength';
        } else {
            strengthEl.classList.add('strong');
            strengthEl.querySelector('.strength-text').textContent = 'Strong password';
        }

        checkPasswordMatch();
    });

    // Password match indicator
    const confirmPassword = document.getElementById('confirm_pass');
    const matchEl = document.getElementById('passwordMatch');

    function checkPasswordMatch() {
        const newPass = newPassword.value;
        const confirmPass = confirmPassword.value;

        if (confirmPass.length === 0) {
            matchEl.classList.remove('show', 'match', 'no-match');
            return;
        }

        matchEl.classList.add('show');
        matchEl.classList.remove('match', 'no-match');

        if (newPass === confirmPass) {
            matchEl.classList.add('match');
            matchEl.innerHTML = '<i class="fas fa-check"></i> Passwords match';
        } else {
            matchEl.classList.add('no-match');
            matchEl.innerHTML = '<i class="fas fa-times"></i> Passwords do not match';
        }
    }

    confirmPassword.addEventListener('input', checkPasswordMatch);
});
</script>
@include('userdashboard-new.partials.form-page-styles')
@endsection
