<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Production' }} - Project Booking</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #0b0b0f;
            --cream: #f8f3ec;
            --accent: #f97316;
            --accent-dark: #1f2937;
            --muted: #6b7280;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: radial-gradient(circle at top right, #ffd7a3 0%, #f8f3ec 45%, #e5f3f6 100%);
            color: var(--ink);
            min-height: 100vh;
        }

        .booking-hero {
            padding: 3rem 1.5rem 2rem;
            text-align: center;
        }
        .booking-hero h1 {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(2.2rem, 4vw, 3.5rem);
            letter-spacing: 0.06em;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }
        .booking-hero p {
            color: var(--muted);
            max-width: 640px;
            margin: 0.5rem auto 0;
        }

        .booking-card {
            max-width: 860px;
            margin: 0 auto 3rem;
            background: #ffffff;
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
            border: 1px solid rgba(15, 23, 42, 0.06);
        }

        .form-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.5rem;
            display: block;
            color: var(--accent-dark);
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            font-family: inherit;
        }
        .form-group.full-width { grid-column: 1 / -1; }

        .form-actions {
            margin-top: 1.5rem;
            display: flex;
            justify-content: flex-end;
        }
        .btn-primary {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 0.9rem 1.6rem;
            border-radius: 999px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.02em;
        }
        .btn-primary:hover { opacity: 0.9; }

        .booking-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            margin-top: 1rem;
        }
        .meta-chip {
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            background: #111827;
            color: #fff;
            font-size: 0.8rem;
        }

        @media (max-width: 600px) {
            .booking-card { padding: 1.5rem; }
            .form-actions { justify-content: center; }
        }
    </style>
</head>
<body>
    <section class="booking-hero">
        <h1>Project Booking</h1>
        <p>Share your vision with {{ $customer->name ?? 'our production house' }}. We will respond with a tailored quote and timeline.</p>
        <div class="booking-meta">
            <span class="meta-chip">Film</span>
            <span class="meta-chip">Video</span>
            <span class="meta-chip">Photography</span>
            <span class="meta-chip">Post-Production</span>
        </div>
    </section>

    <section class="booking-card">
        <form method="POST" action="{{ url('/' . $customer->slug . '/production-booking') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="client_mobile" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div class="form-group">
                    <label>Service Category</label>
                    <input type="text" name="service_category" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label>Services Needed</label>
                    <select name="service_ids[]" class="form-input" multiple>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Project Type</label>
                    <input type="text" name="project_type" class="form-input">
                </div>
                <div class="form-group">
                    <label>Shoot Date</label>
                    <input type="date" name="shoot_date" class="form-input">
                </div>
                <div class="form-group">
                    <label>Shoot Duration</label>
                    <input type="text" name="shoot_duration" class="form-input">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" class="form-input">
                </div>
                <div class="form-group">
                    <label>Budget Range</label>
                    <input type="text" name="budget_range" class="form-input">
                </div>
                <div class="form-group full-width">
                    <label>Requirements</label>
                    <textarea name="requirements" class="form-input" rows="4"></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Submit Booking</button>
            </div>
        </form>
    </section>
</body>
</html>
