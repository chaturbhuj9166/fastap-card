<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Jewellery' }} - Custom Order</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Mulish:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #c07b1b;
            --deep: #1b1a17;
            --cream: #fbf7f2;
            --muted: #6b7280;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Mulish', sans-serif;
            background: radial-gradient(circle at top, #fff7ed 0%, #f7efe7 40%, #e9e5df 100%);
            color: var(--deep);
            min-height: 100vh;
        }
        .hero {
            padding: 3rem 1.5rem 2rem;
            text-align: center;
        }
        .hero h1 {
            font-family: 'Cinzel', serif;
            letter-spacing: 0.12em;
            font-size: clamp(2rem, 4vw, 3.2rem);
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }
        .hero p {
            color: var(--muted);
            max-width: 600px;
            margin: 0 auto;
        }
        .rate-bar {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1.25rem;
        }
        .rate-chip {
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            background: var(--deep);
            color: #fff;
            font-size: 0.8rem;
        }
        .card {
            max-width: 860px;
            margin: 0 auto 3rem;
            background: #fff;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
        }
        .form-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 600;
            color: var(--deep);
            display: block;
            margin-bottom: 0.4rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border-radius: 0.9rem;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            font-family: inherit;
        }
        .full-width { grid-column: 1 / -1; }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
        .btn-primary {
            background: var(--gold);
            color: #fff;
            border: none;
            padding: 0.85rem 1.8rem;
            border-radius: 999px;
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
        <h1>Custom Jewellery</h1>
        <p>Share your design vision with {{ $customer->name ?? 'our jeweller' }}. We will reach out with sketches, pricing, and timeline options.</p>
        @if($rates->count() > 0)
        <div class="rate-bar">
            @foreach($rates->take(4) as $rate)
                <span class="rate-chip">{{ strtoupper($rate->metal_type) }} {{ $rate->purity ? $rate->purity : '' }}: {{ number_format($rate->rate_per_gram, 2) }}</span>
            @endforeach
        </div>
        @endif
    </section>

    <section class="card">
        <form method="POST" action="{{ url('/' . $customer->slug . '/jewellery-order') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div>
                    <label>Client Name</label>
                    <input type="text" name="client_name" class="form-input" required>
                </div>
                <div>
                    <label>Mobile</label>
                    <input type="text" name="client_mobile" class="form-input" required>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="client_email" class="form-input">
                </div>
                <div>
                    <label>Order Type</label>
                    <input type="text" name="order_type" class="form-input" placeholder="bridal/custom repair">
                </div>
                <div>
                    <label>Category</label>
                    <input type="text" name="category" class="form-input">
                </div>
                <div>
                    <label>Budget Range</label>
                    <input type="text" name="budget_range" class="form-input">
                </div>
                <div>
                    <label>Metal Preference</label>
                    <input type="text" name="metal_preference" class="form-input">
                </div>
                <div>
                    <label>Stone Preference</label>
                    <input type="text" name="stone_preference" class="form-input">
                </div>
                <div>
                    <label>Timeline Required</label>
                    <input type="text" name="timeline_required" class="form-input">
                </div>
                <div>
                    <label>Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-input">
                </div>
                <div>
                    <label>Appointment Time</label>
                    <input type="text" name="appointment_time" class="form-input">
                </div>
                <div class="full-width">
                    <label>Reference Images</label>
                    <input type="file" name="reference_images[]" class="form-input" multiple>
                </div>
                <div class="full-width">
                    <label>Special Requirements</label>
                    <textarea name="special_requirements" class="form-input" rows="4"></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Submit Request</button>
            </div>
        </form>
    </section>
</body>
</html>
