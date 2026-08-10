<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Received</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Inter:wght@500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --lawyer-primary: #1e40af;
            --lawyer-dark: #0f172a;
            --lawyer-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 50%, #e2e8f0 100%);
            color: #0f172a;
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
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            margin-bottom: 0.75rem;
            color: var(--lawyer-primary);
        }
        p {
            color: var(--lawyer-muted);
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
            background: var(--lawyer-primary);
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="thanks-card">
        <div class="booking-code">Consultation #{{ $consultation->id }}</div>
        <h1>Request Received</h1>
        <p>Thanks for reaching out to {{ $customer->name ?? 'our legal team' }}. We will confirm your appointment shortly.</p>
        <a href="{{ url('/' . $customer->slug) }}">Back to Profile</a>
    </div>
</body>
</html>
