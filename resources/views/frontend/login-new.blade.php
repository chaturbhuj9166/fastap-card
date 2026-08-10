<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#ffffff">
    <title>Login - Fastap | NFC Digital Business Cards</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- New Design System CSS --}}
    <link rel="stylesheet" href="{{url('redesign/css/variables.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/base.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/components.css')}}">
    <link rel="stylesheet" href="{{url('redesign/css/theme-toggle.css')}}">

    {{-- Theme Toggle Script --}}
    <script src="{{url('redesign/js/theme-toggle.js')}}"></script>

    <style>
    .auth-page {
        min-height: 100vh;
        display: flex;
    }

    /* Left Side - Illustration */
    .auth-illustration {
        flex: 1;
        background: var(--gradient-purple);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: var(--space-3xl);
        position: relative;
        overflow: hidden;
    }

    .auth-illustration::before {
        content: '';
        position: absolute;
        top: -20%;
        left: -20%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .auth-illustration::after {
        content: '';
        position: absolute;
        bottom: -20%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .auth-illustration-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: white;
        max-width: 500px;
    }

    .auth-logo {
        font-size: var(--text-3xl);
        font-weight: var(--font-extrabold);
        margin-bottom: var(--space-2xl);
        text-decoration: none;
        color: white;
        display: inline-block;
    }

    .auth-illustration img {
        max-width: 100%;
        height: auto;
        margin-bottom: var(--space-2xl);
    }

    .auth-illustration h2 {
        font-size: var(--text-2xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-md);
    }

    .auth-illustration p {
        opacity: 0.9;
        line-height: 1.7;
    }

    /* Right Side - Form */
    .auth-form-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: var(--space-3xl);
        background: var(--bg-primary);
    }

    .auth-form-container {
        max-width: 440px;
        width: 100%;
        margin: 0 auto;
    }

    .auth-form-header {
        margin-bottom: var(--space-2xl);
    }

    .auth-form-header h1 {
        font-size: var(--text-3xl);
        font-weight: var(--font-bold);
        margin-bottom: var(--space-sm);
    }

    .auth-form-header p {
        color: var(--text-secondary);
    }

    /* Form Elements */
    .auth-form {
        display: flex;
        flex-direction: column;
        gap: var(--space-lg);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: var(--space-xs);
    }

    .form-group label {
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        color: var(--text-primary);
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: var(--space-md);
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .input-wrapper input {
        width: 100%;
        padding: var(--space-md) var(--space-md) var(--space-md) calc(var(--space-md) * 2 + 16px);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-size: var(--text-base);
        transition: all var(--transition-fast);
    }

    .input-wrapper input:focus {
        outline: none;
        border-color: var(--purple-500);
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .input-wrapper .toggle-password {
        position: absolute;
        right: var(--space-md);
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 0;
    }

    .input-wrapper .toggle-password:hover {
        color: var(--purple-500);
    }

    /* Remember & Forgot */
    .form-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        cursor: pointer;
    }

    .remember-me input {
        width: 18px;
        height: 18px;
        accent-color: var(--purple-500);
    }

    .remember-me span {
        font-size: var(--text-sm);
        color: var(--text-secondary);
    }

    .forgot-link {
        font-size: var(--text-sm);
        color: var(--purple-500);
        text-decoration: none;
        font-weight: var(--font-medium);
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        padding: var(--space-md);
        background: var(--gradient-purple);
        color: white;
        border: none;
        border-radius: var(--radius-lg);
        font-size: var(--text-base);
        font-weight: var(--font-semibold);
        cursor: pointer;
        transition: all var(--transition-base);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-sm);
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
    }

    /* Divider */
    .auth-divider {
        display: flex;
        align-items: center;
        gap: var(--space-md);
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

    /* Social Login */
    .social-login {
        display: flex;
        gap: var(--space-md);
    }

    .social-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-sm);
        padding: var(--space-md);
        background: var(--bg-secondary);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        color: var(--text-primary);
        font-size: var(--text-sm);
        font-weight: var(--font-medium);
        text-decoration: none;
        transition: all var(--transition-fast);
    }

    .social-btn:hover {
        border-color: var(--purple-500);
        background: var(--bg-primary);
    }

    .social-btn i {
        font-size: var(--text-lg);
    }

    .social-btn.google i {
        color: #DB4437;
    }

    .social-btn.facebook i {
        color: #4267B2;
    }

    /* Signup Link */
    .auth-footer {
        text-align: center;
        margin-top: var(--space-xl);
        color: var(--text-secondary);
        font-size: var(--text-sm);
    }

    .auth-footer a {
        color: var(--purple-500);
        font-weight: var(--font-semibold);
        text-decoration: none;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }

    /* Alert */
    .alert {
        padding: var(--space-md);
        border-radius: var(--radius-lg);
        margin-bottom: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        font-size: var(--text-sm);
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #dc2626;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: var(--green-600);
    }

    /* Theme Toggle */
    .auth-theme-toggle {
        position: absolute;
        top: var(--space-lg);
        right: var(--space-lg);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .auth-illustration {
            display: none;
        }

        .auth-form-section {
            padding: var(--space-xl);
        }
    }

    @media (max-width: 480px) {
        .social-login {
            flex-direction: column;
        }

        .form-options {
            flex-direction: column;
            gap: var(--space-sm);
            align-items: flex-start;
        }
    }
    </style>
</head>
<body>
    <div class="auth-page">
        {{-- Left Side - Illustration --}}
        <div class="auth-illustration">
            <div class="auth-illustration-content">
                <a href="{{ url('/') }}" class="auth-logo">FASTAP</a>
                <img src="{{ url('frontend/assets/img/signin/signin.png') }}" alt="Login Illustration">
                <h2>Welcome Back!</h2>
                <p>Access your digital business card dashboard, manage your profile, track analytics, and connect with your network seamlessly.</p>
            </div>
        </div>

        {{-- Right Side - Form --}}
        <div class="auth-form-section">
            <div class="auth-theme-toggle">
                <button class="theme-toggle" id="authThemeToggle" aria-label="Toggle theme">
                    <span class="theme-icon theme-icon-sun"><i class="fas fa-sun"></i></span>
                    <span class="theme-icon theme-icon-moon"><i class="fas fa-moon"></i></span>
                    <span class="theme-toggle-slider"></span>
                </button>
            </div>

            <div class="auth-form-container">
                <div class="auth-form-header">
                    <h1>Sign In</h1>
                    <p>Enter your credentials to access your account</p>
                </div>

                @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ Session::get('fail') }}
                    </div>
                @endif

                @if (Session::get('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="auth-form" method="POST" action="/loginuser/login_store">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="{{ url('/forgot_password') }}" class="forgot-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>
                </form>

                <div class="auth-divider">or continue with</div>

                <div class="social-login">
                    <a href="#" class="social-btn google">
                        <i class="fab fa-google"></i>
                        Google
                    </a>
                    <a href="#" class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                        Facebook
                    </a>
                </div>

                <div class="auth-footer">
                    Don't have an account? <a href="{{ url('/signin') }}">Sign up for free</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Theme toggle for auth page
    document.getElementById('authThemeToggle')?.addEventListener('click', function() {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
    });
    </script>
</body>
</html>
