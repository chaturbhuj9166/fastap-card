<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Received</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Mulish:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #c07b1b;
            --deep: #1b1a17;
            --muted: #6b7280;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Mulish', sans-serif;
            background: linear-gradient(135deg, #fff7ed 0%, #f3f4f6 60%, #e9d5ff 100%);
            color: var(--deep);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .card {
            background: #fff;
            border-radius: 1.5rem;
            padding: 2.5rem;
            text-align: center;
            max-width: 520px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
        }
        h1 {
            font-family: 'Cinzel', serif;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-size: 2.2rem;
            margin-bottom: 0.75rem;
        }
        p { color: var(--muted); margin-bottom: 1.5rem; }
        .order-badge {
            display: inline-block;
            padding: 0.5rem 1.2rem;
            border-radius: 999px;
            background: var(--deep);
            color: #fff;
            font-weight: 600;
            letter-spacing: 0.08em;
            margin-bottom: 1.5rem;
        }
        a {
            display: inline-block;
            padding: 0.8rem 1.6rem;
            border-radius: 999px;
            background: var(--gold);
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="card">
        <div class="order-badge">Order #{{ $order->id }}</div>
        <h1>Request Received</h1>
        <p>Thanks for sharing your requirements with {{ $customer->name ?? 'our jeweller' }}. We will connect shortly with design ideas and pricing.</p>
        <a href="{{ url('/' . $customer->slug) }}">Back to Profile</a>
    </div>
</body>
</html>
