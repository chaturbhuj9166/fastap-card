<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book {{ $talent->name ?? 'Talent' }} - Fastap</title>

    @php
        $websetting = App\Models\websetting::first();
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --ent-primary: #8b5cf6;
            --ent-secondary: #ec4899;
            --ent-dark: #0f0f1a;
            --ent-card-bg: rgba(26, 26, 46, 0.8);
            --ent-border: rgba(255, 255, 255, 0.1);
            --ent-input-bg: rgba(255, 255, 255, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--ent-dark);
            color: #f8fafc;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 20%, var(--ent-primary) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, var(--ent-secondary) 0%, transparent 50%);
            opacity: 0.15;
            z-index: 0;
        }

        /* Container */
        .booking-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
            position: relative;
            z-index: 1;
        }

        /* Back Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #a1a1aa;
            text-decoration: none;
            font-size: 0.95rem;
            margin-bottom: 2rem;
            transition: all 0.3s;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }

        .back-btn:hover {
            color: var(--ent-primary);
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(-5px);
        }

        /* Talent Info Card */
        .talent-info-card {
            background: var(--ent-card-bg);
            border: 1px solid var(--ent-border);
            border-radius: 1.5rem;
            padding: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            box-shadow: 0 0 40px rgba(139, 92, 246, 0.1);
        }

        .talent-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid var(--ent-primary);
            overflow: hidden;
            background: linear-gradient(135deg, var(--ent-primary) 0%, var(--ent-secondary) 100%);
            flex-shrink: 0;
            box-shadow: 0 0 30px rgba(139, 92, 246, 0.3);
        }

        .talent-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .talent-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
        }

        .talent-details h2 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #fff 0%, var(--ent-primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .talent-type {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(139, 92, 246, 0.15);
            border: 1px solid var(--ent-primary);
            border-radius: 2rem;
            color: var(--ent-primary);
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Booking Form Card */
        .booking-form-card {
            background: var(--ent-card-bg);
            border: 1px solid var(--ent-border);
            border-radius: 1.5rem;
            padding: 2.5rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 40px rgba(139, 92, 246, 0.1);
        }

        .form-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-header h3 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--ent-primary) 0%, var(--ent-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-header p {
            color: #a1a1aa;
            font-size: 0.95rem;
        }

        /* Success Message */
        .alert-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(34, 197, 94, 0.05) 100%);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
            padding: 1rem 1.25rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form Groups */
        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-row.two-col {
            grid-template-columns: repeat(2, 1fr);
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #e4e4e7;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group label .required {
            color: var(--ent-secondary);
        }

        .form-group label i {
            color: var(--ent-primary);
            font-size: 0.9rem;
        }

        .form-control {
            background: var(--ent-input-bg);
            border: 1px solid var(--ent-border);
            border-radius: 0.75rem;
            padding: 0.875rem 1.125rem;
            color: #f8fafc;
            font-size: 0.95rem;
            font-family: 'Outfit', sans-serif;
            transition: all 0.3s;
            outline: none;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--ent-primary);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .form-control::placeholder {
            color: #71717a;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23a1a1aa' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        select.form-control option {
            background: #1a1a2e;
            color: #f8fafc;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ent-primary);
            pointer-events: none;
        }

        .input-icon .form-control {
            padding-left: 2.75rem;
        }

        /* Validation Error */
        .invalid-feedback {
            color: #f87171;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .form-control.is-invalid {
            border-color: #f87171;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--ent-primary) 0%, var(--ent-secondary) 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 1.05rem;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 2rem;
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(139, 92, 246, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .booking-container {
                padding: 1.5rem 1rem;
            }

            .talent-info-card {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
            }

            .booking-form-card {
                padding: 1.75rem;
            }

            .form-row.two-col {
                grid-template-columns: 1fr;
            }

            .talent-details h2 {
                font-size: 1.5rem;
            }

            .form-header h3 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .talent-avatar {
                width: 80px;
                height: 80px;
            }

            .booking-form-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Profile
        </a>

        <!-- Talent Info Card -->
        <div class="talent-info-card">
            <div class="talent-avatar">
                @if(isset($talent->profile) && $talent->profile)
                    <img src="{{ url('uploads/customer/'.$talent->profile) }}" alt="{{ $talent->name ?? 'Talent' }}">
                @else
                    <div class="talent-avatar-placeholder">
                        <i class="fas fa-star"></i>
                    </div>
                @endif
            </div>
            <div class="talent-details">
                <h2>{{ $talent->name ?? 'Professional Talent' }}</h2>
                <span class="talent-type">
                    <i class="fas fa-{{ $talentIcon ?? 'star' }}"></i>
                    {{ $talentType ?? 'Entertainment Professional' }}
                </span>
            </div>
        </div>

        <!-- Booking Form Card -->
        <div class="booking-form-card">
            <div class="form-header">
                <h3>Book Your Talent</h3>
                <p>Fill out the form below and we'll get back to you shortly</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Booking Form -->
            <form action="{{ route('talent.booking.store') }}" method="POST">
                @csrf

                <!-- Hidden Fields -->
                <input type="hidden" name="customer_id" value="{{ $talent->id ?? '' }}">
                <input type="hidden" name="talent_type" value="{{ $talentType ?? '' }}">

                <!-- Client Information -->
                <div class="form-row two-col">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-user"></i>
                            Your Name <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="client_name"
                            class="form-control @error('client_name') is-invalid @enderror"
                            placeholder="Enter your full name"
                            value="{{ old('client_name') }}"
                            required
                        >
                        @error('client_name')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-envelope"></i>
                            Email Address
                        </label>
                        <input
                            type="email"
                            name="client_email"
                            class="form-control @error('client_email') is-invalid @enderror"
                            placeholder="your.email@example.com"
                            value="{{ old('client_email') }}"
                        >
                        @error('client_email')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row two-col">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-phone"></i>
                            Mobile Number <span class="required">*</span>
                        </label>
                        <input
                            type="tel"
                            name="client_mobile"
                            class="form-control @error('client_mobile') is-invalid @enderror"
                            placeholder="+91 98765 43210"
                            value="{{ old('client_mobile') }}"
                            required
                        >
                        @error('client_mobile')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-building"></i>
                            Company/Organization
                        </label>
                        <input
                            type="text"
                            name="client_company"
                            class="form-control @error('client_company') is-invalid @enderror"
                            placeholder="Your company name"
                            value="{{ old('client_company') }}"
                        >
                        @error('client_company')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Event Details -->
                <div class="form-row two-col">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-film"></i>
                            Event Type
                        </label>
                        <select name="event_type" class="form-control @error('event_type') is-invalid @enderror">
                            <option value="">Select event type</option>
                            <option value="Movie" {{ old('event_type') == 'Movie' ? 'selected' : '' }}>Movie</option>
                            <option value="Ad" {{ old('event_type') == 'Ad' ? 'selected' : '' }}>Advertisement</option>
                            <option value="Show" {{ old('event_type') == 'Show' ? 'selected' : '' }}>Show/Performance</option>
                            <option value="Event" {{ old('event_type') == 'Event' ? 'selected' : '' }}>Event</option>
                            <option value="Campaign" {{ old('event_type') == 'Campaign' ? 'selected' : '' }}>Campaign</option>
                            <option value="Wedding" {{ old('event_type') == 'Wedding' ? 'selected' : '' }}>Wedding</option>
                            <option value="Other" {{ old('event_type') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('event_type')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-calendar-alt"></i>
                            Event Date
                        </label>
                        <input
                            type="date"
                            name="event_date"
                            class="form-control @error('event_date') is-invalid @enderror"
                            value="{{ old('event_date') }}"
                            min="{{ date('Y-m-d') }}"
                        >
                        @error('event_date')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row two-col">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-map-marker-alt"></i>
                            Event Location
                        </label>
                        <input
                            type="text"
                            name="event_location"
                            class="form-control @error('event_location') is-invalid @enderror"
                            placeholder="City, State or Venue"
                            value="{{ old('event_location') }}"
                        >
                        @error('event_location')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fas fa-clock"></i>
                            Project Duration (days)
                        </label>
                        <input
                            type="number"
                            name="project_duration"
                            class="form-control @error('project_duration') is-invalid @enderror"
                            placeholder="Number of days"
                            value="{{ old('project_duration') }}"
                            min="1"
                        >
                        @error('project_duration')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-rupee-sign"></i>
                            Budget (₹)
                        </label>
                        <input
                            type="number"
                            name="budget"
                            class="form-control @error('budget') is-invalid @enderror"
                            placeholder="Enter your budget in INR"
                            value="{{ old('budget') }}"
                            min="0"
                            step="1000"
                        >
                        @error('budget')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-align-left"></i>
                            Event Description
                        </label>
                        <textarea
                            name="event_description"
                            class="form-control @error('event_description') is-invalid @enderror"
                            placeholder="Briefly describe your event or project..."
                        >{{ old('event_description') }}</textarea>
                        @error('event_description')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-list-ul"></i>
                            Special Requirements
                        </label>
                        <textarea
                            name="special_requirements"
                            class="form-control @error('special_requirements') is-invalid @enderror"
                            placeholder="Any special requests or requirements..."
                        >{{ old('special_requirements') }}</textarea>
                        @error('special_requirements')
                        <span class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    Submit Booking Request
                </button>
            </form>
        </div>
    </div>
</body>
</html>
