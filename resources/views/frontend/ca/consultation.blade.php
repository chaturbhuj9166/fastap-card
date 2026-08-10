<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'CA Consultation' }} - Consultation Request</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ca-primary: #0ea5e9;
            --ca-light: #e0f2fe;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(140deg, var(--ca-light), #ffffff 60%);
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
            background: var(--ca-primary);
            color: #fff;
            border: none;
            padding: 0.75rem 1.2rem;
            border-radius: 0.6rem;
            font-weight: 700;
            cursor: pointer;
        }
        .submit-btn:hover { background: #0284c7; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Request a Consultation</h1>
        <p>Share your details and we will get back to schedule a CA consultation.</p>

        @if ($errors->any())
            <div class="error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url($customer->slug . '/ca-consultation') }}">
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
                    <label>Consultation Type</label>
                    <input type="text" name="consultation_type" value="{{ old('consultation_type') }}" placeholder="physical/video/phone">
                </div>
                <div>
                    <label>Service Category</label>
                    <input type="text" name="service_category" value="{{ old('service_category') }}" placeholder="taxation/gst/audit">
                </div>
                <div>
                    <label>Preferred Date</label>
                    <input type="date" name="appointment_date" value="{{ old('appointment_date') }}">
                </div>
                <div>
                    <label>Preferred Time</label>
                    <input type="text" name="appointment_time" value="{{ old('appointment_time') }}" placeholder="11:00 AM">
                </div>
                <button type="submit" class="submit-btn">Submit Request</button>
            </div>
        </form>
    </div>
</body>
</html>
