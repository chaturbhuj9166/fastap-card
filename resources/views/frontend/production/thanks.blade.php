<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Received</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0b0b0f;
            --accent: #f97316;
            --muted: #6b7280;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: linear-gradient(135deg, #fff1e6 0%, #f1f5f9 60%, #e0f2fe 100%);
            color: var(--ink);
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
            font-family: 'Oswald', sans-serif;
            font-size: 2.4rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }
        p {
            color: var(--muted);
            margin-bottom: 1.5rem;
        }
        .project-code {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            border-radius: 999px;
            background: #111827;
            color: #fff;
            font-weight: 600;
            letter-spacing: 0.08em;
            margin-bottom: 1.5rem;
        }
        a {
            display: inline-block;
            padding: 0.8rem 1.6rem;
            border-radius: 999px;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="thanks-card">
        <div class="project-code">Project #{{ $project->id }}</div>
        <h1>Booking Received</h1>
        <p>Thanks for reaching out to {{ $customer->name ?? 'our production house' }}. Our team will contact you shortly with next steps.</p>
        <a href="{{ url('/' . $customer->slug) }}">Back to Profile</a>
    </div>
</body>
</html>
