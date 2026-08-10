<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Tech' }} - Project Inquiry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --tech-primary: #06b6d4;
            --tech-dark: #0f172a;
            --tech-darker: #020617;
            --tech-muted: #94a3b8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, rgba(6,182,212,0.12), transparent 55%), var(--tech-darker);
            color: #e2e8f0;
            min-height: 100vh;
        }
        .hero {
            padding: 3rem 1.5rem 2rem;
            text-align: center;
        }
        .hero h1 {
            font-family: 'JetBrains Mono', monospace;
            font-size: clamp(2rem, 4vw, 3rem);
            color: var(--tech-primary);
            margin-bottom: 0.75rem;
        }
        .hero p {
            color: var(--tech-muted);
            max-width: 620px;
            margin: 0 auto;
        }
        .card {
            max-width: 860px;
            margin: 0 auto 3rem;
            background: var(--tech-dark);
            border-radius: 1rem;
            padding: 2rem;
            border: 1px solid #1e293b;
        }
        .form-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        label {
            font-size: 0.75rem;
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--tech-muted);
            display: block;
            margin-bottom: 0.4rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border-radius: 0.75rem;
            border: 1px solid #1e293b;
            background: rgba(2,6,23,0.7);
            color: #e2e8f0;
            font-family: inherit;
        }
        .full-width { grid-column: 1 / -1; }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
        .btn-primary {
            background: var(--tech-primary);
            color: #020617;
            border: none;
            padding: 0.85rem 1.6rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-primary:hover { opacity: 0.9; }
        @media (max-width: 600px) {
            .card { padding: 1.5rem; }
            .form-actions { justify-content: center; }
        }
    </style>
</head>
<body>
    <section class="hero">
        <h1>Project Inquiry</h1>
        <p>Tell {{ $customer->name ?? 'our team' }} about your product, timeline, and goals. We will send a scoped proposal.</p>
    </section>

    <section class="card">
        <form method="POST" action="{{ url('/' . $customer->slug . '/tech-inquiry') }}">
            @csrf
            <div class="form-grid">
                <div>
                    <label>Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="client_email" class="form-input" required>
                </div>
                <div>
                    <label>Mobile</label>
                    <input type="text" name="client_mobile" class="form-input">
                </div>
                <div>
                    <label>Service Category</label>
                    <input type="text" name="service_category" class="form-input">
                </div>
                <div class="full-width">
                    <label>Services Required</label>
                    <select name="services_required[]" class="form-input" multiple>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Budget Range</label>
                    <input type="text" name="budget_range" class="form-input">
                </div>
                <div>
                    <label>Timeline</label>
                    <input type="text" name="timeline" class="form-input">
                </div>
                <div class="full-width">
                    <label>Technology Preferences</label>
                    <textarea name="technology_preferences" class="form-input" rows="2"></textarea>
                </div>
                <div class="full-width">
                    <label>Project Description</label>
                    <textarea name="project_description" class="form-input" rows="4"></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Submit Inquiry</button>
            </div>
        </form>
    </section>
</body>
</html>
