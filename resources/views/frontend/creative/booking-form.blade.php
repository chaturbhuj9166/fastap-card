<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book {{ $customer->name }} - Creative Services</title>

    @php
        $websetting = App\Models\websetting::first();
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .booking-container {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .booking-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .booking-header h1 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .booking-header p {
            opacity: 0.9;
            font-size: 1rem;
        }

        .provider-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem 2rem;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .provider-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #667eea;
        }

        .provider-details h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .provider-details p {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .booking-form {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group label .required {
            color: #dc3545;
            margin-left: 0.25rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.error {
            border-color: #dc3545;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .package-select {
            display: grid;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .package-option {
            border: 2px solid #e9ecef;
            border-radius: 0.75rem;
            padding: 1.25rem;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .package-option:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .package-option.selected {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .package-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .package-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .package-name {
            font-weight: 600;
            font-size: 1.125rem;
            color: #333;
        }

        .package-price {
            font-weight: 700;
            font-size: 1.25rem;
            color: #667eea;
        }

        .package-details {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            border-radius: 0.75rem;
            font-size: 1.125rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 1.5rem;
            transition: gap 0.3s;
        }

        .back-link:hover {
            gap: 0.75rem;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #f5c6cb;
        }

        .help-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <div class="booking-header">
            <h1><i class="fas fa-calendar-check"></i> Book Creative Services</h1>
            <p>Fill in the details below to request a booking</p>
        </div>

        <div class="provider-info">
            @if($customer->profile)
                <img src="{{ asset('public/frontend/user_images/'.$customer->profile) }}" alt="{{ $customer->name }}" class="provider-avatar">
            @else
                <div class="provider-avatar" style="background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.5rem; font-weight: 700;">
                    {{ substr($customer->name, 0, 1) }}
                </div>
            @endif
            <div class="provider-details">
                <h3>{{ $customer->name }}</h3>
                <p><i class="fas fa-camera"></i> {{ $customer->designation ?? 'Creative Professional' }}</p>
            </div>
        </div>

        <div class="booking-form">
            <a href="{{ url('/'.$customer->slug) }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Profile
            </a>

            @if(session('success'))
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('creative.booking.store', ['slug' => $customer->slug]) }}" method="POST">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                <div class="form-group">
                    <label>Service Type <span class="required">*</span></label>
                    <select name="service_type" class="form-control" required>
                        <option value="">Select Service Type</option>
                        <option value="photography" {{ old('service_type') == 'photography' ? 'selected' : '' }}>Photography</option>
                        <option value="event" {{ old('service_type') == 'event' ? 'selected' : '' }}>Event Planning</option>
                        <option value="combined" {{ old('service_type') == 'combined' ? 'selected' : '' }}>Photography + Event Planning</option>
                    </select>
                </div>

                @if($packages->count() > 0)
                <div class="form-group">
                    <label>Select Package (Optional)</label>
                    <div class="package-select">
                        @foreach($packages as $package)
                        <label class="package-option">
                            <input type="radio" name="package_id" value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'checked' : '' }}>
                            <div class="package-header">
                                <span class="package-name">{{ $package->name }}</span>
                                <span class="package-price">{{ $package->formatted_price }}</span>
                            </div>
                            @if($package->duration || $package->deliverables)
                            <div class="package-details">
                                @if($package->duration)<i class="fas fa-clock"></i> {{ $package->duration }}@endif
                                @if($package->duration && $package->deliverables) &bull; @endif
                                @if($package->deliverables){{ Str::limit($package->deliverables, 50) }}@endif
                            </div>
                            @endif
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="form-row">
                    <div class="form-group">
                        <label>Your Name <span class="required">*</span></label>
                        <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number <span class="required">*</span></label>
                        <input type="tel" name="client_mobile" class="form-control" value="{{ old('client_mobile') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="client_email" class="form-control" value="{{ old('client_email') }}">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Event Date <span class="required">*</span></label>
                        <input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Event Time</label>
                        <input type="time" name="event_time" class="form-control" value="{{ old('event_time') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Event Type</label>
                        <input type="text" name="event_type" class="form-control" placeholder="e.g., Wedding, Birthday, Corporate" value="{{ old('event_type') }}">
                    </div>

                    <div class="form-group">
                        <label>Guest Count</label>
                        <input type="number" name="guest_count" class="form-control" placeholder="Approximate number" value="{{ old('guest_count') }}" min="1">
                    </div>
                </div>

                <div class="form-group">
                    <label>Budget Range</label>
                    <input type="number" name="budget" class="form-control" placeholder="₹" value="{{ old('budget') }}" min="0" step="1000">
                    <div class="help-text">Optional - helps us recommend suitable packages</div>
                </div>

                <div class="form-group">
                    <label>Venue / Location</label>
                    <textarea name="venue" class="form-control" placeholder="Event venue or location">{{ old('venue') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Special Requirements / Notes</label>
                    <textarea name="special_requirements" class="form-control" placeholder="Tell us about your specific needs or preferences">{{ old('special_requirements') }}</textarea>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Submit Booking Request
                </button>
            </form>
        </div>
    </div>

    <script>
        // Package selection interaction
        document.querySelectorAll('.package-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.package-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        // Pre-select if already selected
        const selectedRadio = document.querySelector('.package-option input[type="radio"]:checked');
        if (selectedRadio) {
            selectedRadio.closest('.package-option').classList.add('selected');
        }
    </script>
</body>
</html>
