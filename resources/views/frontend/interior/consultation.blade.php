<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Interior Designer' }} - Consultation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --interior-primary: #78350f;
            --interior-accent: #d97706;
            --interior-light: #fef3c7;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, rgba(217,119,6,0.12), transparent 60%), #fffaf0;
            color: var(--text-main);
            min-height: 100vh;
            padding: 32px 16px;
        }
        .card {
            max-width: 760px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 20px 40px rgba(15,23,42,0.08);
        }
        h1 { font-family: 'Playfair Display', serif; font-size: 1.8rem; margin-bottom: 0.5rem; }
        p { color: var(--text-muted); margin-bottom: 1.5rem; }
        label { font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; display: block; }
        input, textarea {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.6rem;
            font-size: 0.95rem;
        }
        textarea { resize: vertical; }
        .grid { display: grid; gap: 16px; }
        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 0.75rem 1rem;
            border-radius: 0.6rem;
            margin-bottom: 1rem;
        }
        .submit-btn {
            background: var(--interior-primary);
            color: #fff;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 0.6rem;
            font-weight: 600;
            cursor: pointer;
        }
        .submit-btn:hover { background: var(--interior-accent); }
    </style>
</head>
<body>
    <div class="card">
        <h1>Design Consultation</h1>
        <p>Tell us about your project and we will schedule a consultation.</p>

        @if ($errors->any())
            <div class="error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url($customer->slug . '/design-consultation') }}">
            @csrf
            <div class="grid">
                <div>
                    <label>Name</label>
                    <input type="text" name="client_name" value="{{ old('client_name') }}" required>
                </div>
                <div>
                    <label>Mobile</label>
                    <input type="text" name="client_mobile" value="{{ old('client_mobile') }}" required>
                </div>
                <div>
                    <label>Email (optional)</label>
                    <input type="email" name="client_email" value="{{ old('client_email') }}">
                </div>
                <div>
                    <label>Consultation Type</label>
                    <input type="text" name="consultation_type" value="{{ old('consultation_type') }}" placeholder="site_visit/video">
                </div>
                <div>
                    <label>Appointment Date</label>
                    <input type="date" name="appointment_date" value="{{ old('appointment_date') }}">
                </div>
                <div>
                    <label>Appointment Time</label>
                    <input type="time" name="appointment_time" value="{{ old('appointment_time') }}">
                </div>
                <div>
                    <label>Project Type</label>
                    <input type="text" name="project_type" value="{{ old('project_type') }}" placeholder="residential/commercial">
                </div>
                <div>
                    <label>Property Type</label>
                    <input type="text" name="property_type" value="{{ old('property_type') }}" placeholder="villa/office/shop">
                </div>
                <div>
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location') }}">
                </div>
                <div>
                    <label>Requirements</label>
                    <textarea name="requirements" rows="4">{{ old('requirements') }}</textarea>
                </div>
                <button type="submit" class="submit-btn">Submit Consultation</button>
            </div>
        </form>
    </div>
</body>
</html>
