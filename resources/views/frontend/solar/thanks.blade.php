<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Solar Survey' }} - Request Submitted</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            max-width: 640px;
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            text-align: center;
            box-shadow: 0 18px 40px rgba(15,23,42,0.08);
        }
        h1 { font-size: 1.9rem; margin-bottom: 0.5rem; }
        p { color: var(--text-muted); margin-bottom: 1.5rem; }
        .ref {
            background: var(--solar-light);
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            display: inline-block;
            margin-bottom: 1.5rem;
            font-weight: 700;
            color: #a16207;
        }
        .btn {
            background: var(--solar-primary);
            color: #fff;
            text-decoration: none;
            padding: 0.7rem 1.3rem;
            border-radius: 0.6rem;
            font-weight: 700;
            display: inline-block;
        }
        .btn:hover { background: #ca8a04; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Survey Request Submitted</h1>
        <p>Thanks for your interest. Our team will contact you soon.</p>
        <div class="ref">Request ID: {{ $survey->id }}</div>
        <div>
            <a href="{{ url($customer->slug) }}" class="btn">Back to Profile</a>
        </div>
    </div>
</body>
</html>
