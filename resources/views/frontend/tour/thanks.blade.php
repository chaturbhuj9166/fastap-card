<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Received</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --travel-primary: #0891b2;
            --travel-dark: #0f172a;
            --travel-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ecfeff 0%, #f0f9ff 50%, #f8fafc 100%);
            color: var(--travel-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .thanks-card {
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 2.5rem;
            max-width: 560px;
            text-align: center;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
        }
        h1 {
            font-size: 2.2rem;
            margin-bottom: 0.75rem;
            color: var(--travel-primary);
        }
        p {
            color: var(--travel-muted);
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
            background: var(--travel-primary);
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
        <p>Thanks for booking with {{ $customer->name ?? 'our travel team' }}. We will confirm availability and reach out shortly.</p>
        <a href="{{ url('/' . $customer->slug) }}">Back to Profile</a>
    </div>
</body>
</html>
