<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Astro Consultation' }} - Consultation Request</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --astro-primary: #7c3aed;
            --astro-light: #ede9fe;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(140deg, var(--astro-light), #ffffff 60%);
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
            box-shadow: 0 18px 40px rgba(15,23,42,0.08);
        }
        h1 { font-size: 1.8rem; margin-bottom: 0.4rem; }
        p { color: var(--text-muted); margin-bottom: 1.5rem; }
        label { font-weight: 700; font-size: 0.9rem; margin-bottom: 0.35rem; display: block; }
        input, select, textarea {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.6rem;
            font-size: 0.95rem;
            background: #fff;
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
            background: var(--astro-primary);
            color: #fff;
            border: none;
            padding: 0.75rem 1.2rem;
            border-radius: 0.6rem;
            font-weight: 700;
            cursor: pointer;
        }
        .submit-btn:hover { background: #6d28d9; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Request a Consultation</h1>
        <p>Share your details and we will schedule an astrology or vastu consultation.</p>

        @if ($errors->any())
            <div class="error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url($customer->slug . '/astro-consultation') }}">
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
                    <label>Consultation Mode</label>
                    <input type="text" name="consultation_mode" value="{{ old('consultation_mode') }}" placeholder="in_person/video/phone">
                </div>
                <div>
                    <label>Preferred Date</label>
                    <input type="date" name="appointment_date" value="{{ old('appointment_date') }}">
                </div>
                <div>
                    <label>Preferred Time</label>
                    <input type="text" name="appointment_time" value="{{ old('appointment_time') }}" placeholder="11:00 AM">
                </div>
                <div>
                    <label>Birth Date</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}">
                </div>
                <div>
                    <label>Birth Time</label>
                    <input type="text" name="birth_time" value="{{ old('birth_time') }}" placeholder="10:45 PM">
                </div>
                <div>
                    <label>Birth Place</label>
                    <input type="text" name="birth_place" value="{{ old('birth_place') }}">
                </div>
                <div>
                    <label>Property Address (Vastu)</label>
                    <input type="text" name="property_address" value="{{ old('property_address') }}">
                </div>
                <div>
                    <label>Property Direction</label>
                    <input type="text" name="property_direction" value="{{ old('property_direction') }}" placeholder="north/east/west">
                </div>
                <button type="submit" class="submit-btn">Submit Request</button>
            </div>
        </form>
    </div>
</body>
</html>
