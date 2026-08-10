<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Received</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --fitness-primary: #ef4444;
            --fitness-dark: #0f172a;
            --fitness-muted: #94a3b8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #111827 50%, #1f2937 100%);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .thanks-card {
            background: #111827;
            border-radius: 1.5rem;
            padding: 2.5rem;
            max-width: 560px;
            text-align: center;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.35);
            border: 1px solid #1f2937;
        }
        h1 {
            font-size: 2.2rem;
            margin-bottom: 0.75rem;
            color: var(--fitness-primary);
        }
        p {
            color: var(--fitness-muted);
            margin-bottom: 1.5rem;
        }
        .booking-code {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            border-radius: 999px;
            background: #0f172a;
            color: #fff;
            font-weight: 600;
            letter-spacing: 0.04em;
            margin-bottom: 1.5rem;
        }
        a {
            display: inline-block;
            padding: 0.8rem 1.6rem;
            border-radius: 999px;
            background: var(--fitness-primary);
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="thanks-card">
        <div class="booking-code">Booking #{{ $booking->id }}</div>
        <h1>Request Received</h1>
        <p>Thanks for booking with {{ $customer->name ?? 'our fitness team' }}. We will confirm the schedule shortly.</p>
        <a href="{{ url('/' . $customer->slug) }}">Back to Profile</a>
    </div>
</body>
</html>
