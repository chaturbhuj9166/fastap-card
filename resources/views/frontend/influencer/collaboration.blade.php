<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Influencer' }} - Collaboration Inquiry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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
            padding: 32px 16px;
        }
        .card {
            max-width: 780px;
            margin: 0 auto;
            background: #fff;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 18px 40px rgba(15,23,42,0.08);
        }
        h1 { font-size: 1.8rem; margin-bottom: 0.5rem; }
        p { color: var(--text-muted); margin-bottom: 1.5rem; }
        label { font-weight: 700; font-size: 0.9rem; margin-bottom: 0.35rem; display: block; }
        input, select, textarea {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.6rem;
            font-size: 0.95rem;
            background: #fff;
        }
        textarea { resize: vertical; }
        .grid { display: grid; gap: 16px; }
        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 0.75rem 1rem;
            border-radius: 0.6rem;
            margin-bottom: 1rem;
        }
        .submit-btn {
            background: linear-gradient(135deg, var(--influencer-primary) 0%, var(--influencer-secondary) 100%);
            color: #fff;
            border: none;
            padding: 0.75rem 1.2rem;
            border-radius: 0.6rem;
            font-weight: 700;
            cursor: pointer;
        }
        .submit-btn:hover { opacity: 0.92; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Collaboration Inquiry</h1>
        <p>Share your campaign details and we will get back with a proposal.</p>

        @if ($errors->any())
            <div class="error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url($customer->slug . '/brand-collaboration') }}">
            @csrf
            <div class="grid">
                <div>
                    <label>Brand Name</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name') }}" required>
                </div>
                <div>
                    <label>Brand Email</label>
                    <input type="email" name="brand_email" value="{{ old('brand_email') }}" required>
                </div>
                <div>
                    <label>Brand Mobile</label>
                    <input type="text" name="brand_mobile" value="{{ old('brand_mobile') }}" required>
                </div>
                <div>
                    <label>Collaboration Type</label>
                    <input type="text" name="collaboration_type" value="{{ old('collaboration_type') }}" placeholder="sponsored_post/review/event">
                </div>
                <div>
                    <label>Platform</label>
                    <input type="text" name="platform" value="{{ old('platform') }}" placeholder="instagram/youtube/multiple">
                </div>
                <div>
                    <label>Budget (optional)</label>
                    <input type="number" name="budget" value="{{ old('budget') }}" min="0" step="0.01">
                </div>
                <div class="full-width">
                    <label>Campaign Brief</label>
                    <textarea name="campaign_brief" rows="3">{{ old('campaign_brief') }}</textarea>
                </div>
                <button type="submit" class="submit-btn">Submit Inquiry</button>
            </div>
        </form>
    </div>
</body>
</html>
