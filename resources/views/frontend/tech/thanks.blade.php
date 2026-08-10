<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Received</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --tech-primary: #06b6d4;
            --tech-darker: #020617;
            --tech-muted: #94a3b8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, rgba(6,182,212,0.12), transparent 55%), var(--tech-darker);
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .card {
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 1rem;
            padding: 2.5rem;
            text-align: center;
            max-width: 520px;
        }
        h1 {
            font-family: 'JetBrains Mono', monospace;
            color: var(--tech-primary);
            margin-bottom: 0.75rem;
            font-size: 2rem;
        }
        p { color: var(--tech-muted); margin-bottom: 1.5rem; }
        .badge {
            display: inline-block;
            padding: 0.5rem 1.2rem;
            border-radius: 999px;
            background: #111827;
            color: #e2e8f0;
            font-family: 'JetBrains Mono', monospace;
            margin-bottom: 1.5rem;
        }
        a {
            display: inline-block;
            padding: 0.8rem 1.6rem;
            border-radius: 0.75rem;
            background: var(--tech-primary);
            color: #020617;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="card">
        <div class="badge">Inquiry #{{ $project->id }}</div>
        <h1>Inquiry Received</h1>
        <p>Thanks for reaching out to {{ $customer->name ?? 'our team' }}. We will reply with a proposal shortly.</p>
        <a href="{{ url('/' . $customer->slug) }}">Back to Profile</a>
    </div>
</body>
</html>
