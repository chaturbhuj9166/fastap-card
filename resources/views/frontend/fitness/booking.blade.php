<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Fitness' }} - Class Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --fitness-primary: #ef4444;
            --fitness-secondary: #f97316;
            --fitness-dark: #0f172a;
            --fitness-muted: #94a3b8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Montserrat', sans-serif;
            background: radial-gradient(circle at top, rgba(239,68,68,0.12), transparent 60%), #0f172a;
            color: #f8fafc;
            min-height: 100vh;
        }
        .hero {
            padding: 3rem 1.5rem 2rem;
            text-align: center;
        }
        .hero h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            color: var(--fitness-secondary);
            margin-bottom: 0.5rem;
        }
        .hero p {
            color: var(--fitness-muted);
            max-width: 640px;
            margin: 0 auto;
        }
        .card {
            max-width: 900px;
            margin: 0 auto 3rem;
            background: #111827;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.35);
            border: 1px solid #1f2937;
        }
        .form-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #e2e8f0;
            display: block;
            margin-bottom: 0.4rem;
        }
        .form-input, select {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border-radius: 0.75rem;
            border: 1px solid #1f2937;
            background: #0f172a;
            color: #f8fafc;
            font-family: inherit;
        }
        .full-width { grid-column: 1 / -1; }
        .checkbox-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .checkbox-row label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
        .btn-primary {
            background: var(--fitness-primary);
            color: white;
            border: none;
            padding: 0.85rem 1.6rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-primary:hover { opacity: 0.9; }
        .note {
            margin-top: 1rem;
            color: var(--fitness-muted);
            font-size: 0.85rem;
        }
        @media (max-width: 600px) {
            .card { padding: 1.5rem; }
            .form-actions { justify-content: center; }
        }
    </style>
</head>
<body>
    <section class="hero">
        <h1>Book a Class</h1>
        <p>Choose a class and {{ $customer->name ?? 'our fitness team' }} will confirm your slot and schedule.</p>
    </section>

    <section class="card">
        <form method="POST" action="{{ url('/' . $customer->slug . '/fitness-booking') }}">
            @csrf
            <div class="form-grid">
                <div>
                    <label>Member Name</label>
                    <input type="text" name="member_name" class="form-input" required>
                </div>
                <div>
                    <label>Mobile</label>
                    <input type="text" name="member_mobile" class="form-input" required>
                </div>
                <div>
                    <label>Class</label>
                    <select name="class_id" class="form-input">
                        <option value="">Select</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Preferred Date</label>
                    <input type="date" name="booking_date" class="form-input">
                </div>
                <div class="full-width checkbox-row">
                    <label>
                        <input type="checkbox" name="is_trial" value="1">
                        Trial Class
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Submit Booking</button>
            </div>
            <p class="note">We will confirm availability and share the class schedule.</p>
        </form>
    </section>
</body>
</html>
