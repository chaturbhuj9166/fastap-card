<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration - Fastap</title>
    <link rel="stylesheet" href="{{ asset('redesign/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('redesign/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('redesign/css/components.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
            padding: 2rem;
        }
        .auth-card {
            background: var(--bg-primary);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 600px;
            padding: 2.5rem;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0891b2, #06b6d4);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }
        .auth-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
        .auth-subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }
        .form-input, .form-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.2s;
            background: var(--bg-primary);
            color: var(--text-primary);
        }
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #0891b2;
            box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
        }
        .btn-auth {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #0891b2, #06b6d4);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(8, 145, 178, 0.3);
        }
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-muted);
        }
        .auth-footer a {
            color: #0891b2;
            font-weight: 500;
            text-decoration: none;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
        .alert {
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 1.5rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border-color);
        }
        .theme-option {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border: 2px solid var(--border-color);
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .theme-option:hover {
            border-color: #0891b2;
        }
        .theme-option.selected {
            border-color: #0891b2;
            background: rgba(8, 145, 178, 0.05);
        }
        .theme-option input {
            display: none;
        }
        .theme-icon {
            width: 40px;
            height: 40px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }
        .theme-info h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
        }
        .theme-info p {
            font-size: 0.75rem;
            color: var(--text-muted);
        }
        .themes-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            max-height: 300px;
            overflow-y: auto;
            padding: 0.5rem;
        }
        @media (max-width: 480px) {
            .themes-grid {
                grid-template-columns: 1fr;
            }
        }
        .error-text {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <i class="fas fa-building"></i>
                </div>
                <h1 class="auth-title">Create Company Account</h1>
                <p class="auth-subtitle">Start managing digital business cards for your team</p>
            </div>

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('company.register') }}" method="POST">
                @csrf

                <h3 class="section-title"><i class="fas fa-building"></i> Company Information</h3>

                <div class="form-group">
                    <label class="form-label">Company Name *</label>
                    <input type="text" name="name" class="form-input" placeholder="Enter company name" value="{{ old('name') }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-input" placeholder="company@example.com" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number *</label>
                        <input type="text" name="phone" class="form-input" placeholder="Enter phone number" value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-input" placeholder="Min 6 characters" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password *</label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Industry</label>
                    <input type="text" name="industry" class="form-input" placeholder="e.g., Technology, Healthcare, Retail" value="{{ old('industry') }}">
                </div>

                <h3 class="section-title"><i class="fas fa-palette"></i> Select Your Theme</h3>

                <div class="themes-grid">
                    @foreach($themes as $theme)
                    <label class="theme-option" data-theme="{{ $theme->id }}">
                        <input type="radio" name="profession_type" value="{{ $theme->id }}" {{ old('profession_type') == $theme->id ? 'checked' : '' }} {{ $loop->first ? 'checked' : '' }}>
                        <div class="theme-icon" style="background: {{ $theme->color }}20; color: {{ $theme->color }};">
                            <i class="fas {{ $theme->icon }}"></i>
                        </div>
                        <div class="theme-info">
                            <h4>{{ $theme->name }}</h4>
                            <p>{{ Str::limit($theme->description, 50) }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>

                <h3 class="section-title"><i class="fas fa-map-marker-alt"></i> Location (Optional)</h3>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-input" placeholder="Enter address" value="{{ old('address') }}">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-input" placeholder="City" value="{{ old('city') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="form-input" placeholder="State" value="{{ old('state') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-input" placeholder="Country" value="{{ old('country', 'India') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">PIN Code</label>
                        <input type="text" name="pincode" class="form-input" placeholder="PIN Code" value="{{ old('pincode') }}">
                    </div>
                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn-auth">
                        <i class="fas fa-user-plus"></i> Create Account
                    </button>
                </div>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="{{ url('/company/login') }}">Sign In</a></p>
                <p style="margin-top: 1rem;"><a href="{{ url('/') }}">Back to Home</a></p>
            </div>
        </div>
    </div>

    <script>
        // Theme selection
        document.querySelectorAll('.theme-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.theme-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input').checked = true;
            });
        });

        // Mark initial selection
        const checkedInput = document.querySelector('.theme-option input:checked');
        if (checkedInput) {
            checkedInput.closest('.theme-option').classList.add('selected');
        }
    </script>
</body>
</html>
