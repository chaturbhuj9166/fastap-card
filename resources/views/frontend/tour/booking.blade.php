<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Travel' }} - Tour Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --travel-primary: #0891b2;
            --travel-secondary: #10b981;
            --travel-dark: #0f172a;
            --travel-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top, rgba(8,145,178,0.12), transparent 60%), #f8fafc;
            color: var(--travel-dark);
            min-height: 100vh;
        }
        .hero {
            padding: 3rem 1.5rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(8,145,178,0.12), rgba(16,185,129,0.12));
        }
        .hero h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            color: var(--travel-primary);
            margin-bottom: 0.5rem;
        }
        .hero p {
            color: var(--travel-muted);
            max-width: 640px;
            margin: 0 auto;
        }
        .card {
            max-width: 900px;
            margin: 0 auto 3rem;
            background: #ffffff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
        }
        .form-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--travel-dark);
            display: block;
            margin-bottom: 0.4rem;
        }
        .form-input, select, textarea {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: var(--travel-dark);
            font-family: inherit;
        }
        .full-width { grid-column: 1 / -1; }
        .checkbox-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .checkbox-row label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
        .btn-primary {
            background: var(--travel-primary);
            color: white;
            border: none;
            padding: 0.85rem 1.6rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-primary:hover { opacity: 0.9; }
        .note {
            margin-top: 1rem;
            color: var(--travel-muted);
            font-size: 0.85rem;
        }
        @media (max-width: 600px) {
            .card { padding: 1.5rem; }
            .form-actions { justify-content: center; }
        }
    </style>
</head>
<body>
    <section class="hero">
        <h1>Tour Booking</h1>
        <p>Share your travel preferences and {{ $customer->name ?? 'our team' }} will confirm availability and a custom quote.</p>
    </section>

    <section class="card">
        <form method="POST" action="{{ url('/' . $customer->slug . '/tour-booking') }}">
            @csrf
            <div class="form-grid">
                <div>
                    <label>Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div>
                    <label>Mobile</label>
                    <input type="text" name="client_mobile" class="form-input" required>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div>
                    <label>Package</label>
                    <select name="package_id" class="form-input">
                        <option value="">Custom itinerary</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Travel Date</label>
                    <input type="date" name="travel_date" class="form-input">
                </div>
                <div>
                    <label>Return Date</label>
                    <input type="date" name="return_date" class="form-input">
                </div>
                <div>
                    <label>Adults</label>
                    <input type="number" name="adults" class="form-input" min="0" value="1">
                </div>
                <div>
                    <label>Children</label>
                    <input type="number" name="children" class="form-input" min="0" value="0">
                </div>
                <div>
                    <label>Room Preference</label>
                    <input type="text" name="room_preference" class="form-input" placeholder="Twin, double, suite">
                </div>
                <div class="full-width">
                    <label>Special Requirements</label>
                    <textarea name="special_requirements" class="form-input" rows="3"></textarea>
                </div>
                <div class="full-width checkbox-row">
                    <label>
                        <input type="checkbox" name="visa_assistance_needed" value="1">
                        Visa Assistance
                    </label>
                    <label>
                        <input type="checkbox" name="insurance_needed" value="1">
                        Travel Insurance
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Submit Booking</button>
            </div>
            <p class="note">We will respond with availability, inclusions, and the best price options.</p>
        </form>
    </section>
</body>
</html>
