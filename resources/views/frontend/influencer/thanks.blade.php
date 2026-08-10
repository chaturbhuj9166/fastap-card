<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Collaboration Inquiry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --influencer-primary: #ec4899;
            --influencer-secondary: #8b5cf6;
            --influencer-light: #fdf4ff;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--influencer-light), #ede9fe 65%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            max-width: 520px;
            background: #fff;
            border-radius: 18px;
            padding: 32px;
            text-align: center;
            box-shadow: 0 18px 40px rgba(15,23,42,0.08);
        }
        .icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--influencer-primary) 0%, var(--influencer-secondary) 100%);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        h1 { font-size: 1.6rem; margin-bottom: 0.6rem; }
        p { color: var(--text-muted); margin-bottom: 1rem; }
        a {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 0.6rem 1.1rem;
            border-radius: 0.5rem;
            background: linear-gradient(135deg, var(--influencer-primary) 0%, var(--influencer-secondary) 100%);
            color: #fff;
            text-decoration: none;
            font-weight: 700;
        }
        a:hover { opacity: 0.92; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">OK</div>
        <h1>Thanks for reaching out!</h1>
        <p>Your collaboration request has been received. We will respond soon.</p>
        <a href="{{ url('/') }}">Back to Home</a>
    </div>
</body>
</html>
