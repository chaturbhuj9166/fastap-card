<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Salon' }} - Booking Confirmed</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --salon-primary: #ec4899;
            --salon-dark: #831843;
            --salon-light: #fdf2f8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top, rgba(236,72,153,0.12), transparent 60%), #fff7fb;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .card {
            max-width: 720px;
            width: 100%;
            background: #ffffff;
            border-radius: 1.25rem;
            padding: 2.5rem 2rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
            text-align: center;
        }
        .badge {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: var(--salon-light);
            color: var(--salon-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        h1 {
            color: var(--salon-dark);
            margin-bottom: 0.5rem;
            font-size: clamp(1.8rem, 4vw, 2.4rem);
        }
        p { color: #64748b; }
        .details {
            margin-top: 1.5rem;
            text-align: left;
            background: var(--salon-light);
            padding: 1rem;
            border-radius: 0.75rem;
            display: grid;
            gap: 0.5rem;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #1e293b;
        }
        .detail-row span:first-child { color: #64748b; }
        .cta {
            margin-top: 1.5rem;
            display: inline-flex;
            gap: 0.75rem;
        }
        .cta a {
            text-decoration: none;
            padding: 0.75rem 1.4rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .cta-primary { background: var(--salon-primary); color: #fff; }
        .cta-secondary { background: #fff; color: var(--salon-primary); border: 1px solid #fbcfe8; }
    </style>
</head>
<body>
    <div class="card">
        <div class="badge">✓</div>
        <h1>Booking Request Received</h1>
        <p>Thanks for choosing {{ $customer->name ?? 'our salon' }}. Our team will confirm your appointment soon.</p>

        <div class="details">
            <div class="detail-row">
                <span>Client</span>
                <span>{{ $appointment->client_name }}</span>
            </div>
            <div class="detail-row">
                <span>Mobile</span>
                <span>{{ $appointment->client_mobile }}</span>
            </div>
            <div class="detail-row">
                <span>Date</span>
                <span>{{ $appointment->appointment_date ? $appointment->appointment_date->format('d M Y') : 'To be confirmed' }}</span>
            </div>
            <div class="detail-row">
                <span>Time</span>
                <span>{{ $appointment->appointment_time ?? 'To be confirmed' }}</span>
            </div>
        </div>

        <div class="cta">
            <a href="{{ url('/' . $customer->slug) }}" class="cta-primary">Back to Profile</a>
            <a href="{{ url('/' . $customer->slug . '/salon-booking') }}" class="cta-secondary">New Booking</a>
        </div>
    </div>
</body>
</html>
