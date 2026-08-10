<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Submitted</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --interior-primary: #78350f;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, rgba(217,119,6,0.12), transparent 60%), #fffaf0;
            color: var(--text-main);
            min-height: 100vh;
            padding: 32px 16px;
        }
        .card {
            max-width: 640px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(15,23,42,0.08);
        }
        h1 { font-size: 1.6rem; margin-bottom: 0.5rem; }
        p { color: var(--text-muted); margin-bottom: 1rem; }
        a { color: var(--interior-primary); text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Thank You!</h1>
        <p>Your consultation request has been submitted successfully.</p>
        <p>We will contact you soon to confirm the appointment.</p>
        <a href="{{ url('/' . $customer->slug) }}">Back to Profile</a>
    </div>
</body>
</html>
