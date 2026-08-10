<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Solar Survey' }} - Site Survey</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --solar-primary: #eab308;
            --solar-light: #fef9c3;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(140deg, var(--solar-light), #ffffff 60%);
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
            background: var(--solar-primary);
            color: #fff;
            border: none;
            padding: 0.75rem 1.2rem;
            border-radius: 0.6rem;
            font-weight: 700;
            cursor: pointer;
        }
        .submit-btn:hover { background: #ca8a04; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Request a Site Survey</h1>
        <p>Share your details and we will contact you for a free solar site survey.</p>

        @if ($errors->any())
            <div class="error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url($customer->slug . '/solar-survey') }}">
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
                    <label>Property Type</label>
                    <input type="text" name="property_type" value="{{ old('property_type') }}" placeholder="residential/commercial">
                </div>
                <div>
                    <label>Property Address</label>
                    <input type="text" name="property_address" value="{{ old('property_address') }}">
                </div>
                <div>
                    <label>Monthly Consumption (units)</label>
                    <input type="number" name="monthly_power_consumption_units" value="{{ old('monthly_power_consumption_units') }}" min="0">
                </div>
                <button type="submit" class="submit-btn">Submit Survey Request</button>
            </div>
        </form>
    </div>
</body>
</html>
