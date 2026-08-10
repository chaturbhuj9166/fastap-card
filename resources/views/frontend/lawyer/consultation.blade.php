<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Lawyer' }} - Consultation Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --lawyer-primary: #1e40af;
            --lawyer-gold: #f59e0b;
            --lawyer-dark: #0f172a;
            --lawyer-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, rgba(30,64,175,0.12), transparent 60%), #f8fafc;
            color: #1e293b;
            min-height: 100vh;
        }
        .hero {
            padding: 3rem 1.5rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(30,64,175,0.08), rgba(245,158,11,0.08));
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 2.8rem);
            color: var(--lawyer-primary);
            margin-bottom: 0.5rem;
        }
        .hero p {
            color: var(--lawyer-muted);
            max-width: 640px;
            margin: 0 auto;
        }
        .card {
            max-width: 900px;
            margin: 0 auto 3rem;
            background: #ffffff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
        }
        .form-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #0f172a;
            display: block;
            margin-bottom: 0.4rem;
        }
        .form-input, select, textarea {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #0f172a;
            font-family: inherit;
        }
        .full-width { grid-column: 1 / -1; }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
        .btn-primary {
            background: var(--lawyer-primary);
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
            color: var(--lawyer-muted);
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
        <h1>Book a Consultation</h1>
        <p>Share your legal query and {{ $customer->name ?? 'our team' }} will confirm the best slot.</p>
    </section>

    <section class="card">
        <form method="POST" action="{{ url('/' . $customer->slug . '/legal-consultation') }}">
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
                    <label>Consultation Type</label>
                    <select name="consultation_type" class="form-input">
                        <option value="physical">Physical</option>
                        <option value="video">Video</option>
                        <option value="phone">Phone</option>
                        <option value="document">Document Review</option>
                    </select>
                </div>
                <div>
                    <label>Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-input">
                </div>
                <div>
                    <label>Appointment Time</label>
                    <input type="time" name="appointment_time" class="form-input">
                </div>
                <div>
                    <label>Practice Area</label>
                    <select name="practice_area" class="form-input">
                        <option value="">Select</option>
                        @foreach($services as $service)
                            <option value="{{ $service->practice_area }}">{{ $service->practice_area }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="full-width">
                    <label>Notes</label>
                    <textarea name="notes" class="form-input" rows="3"></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Submit Request</button>
            </div>
            <p class="note">We will confirm your appointment and consultation fee.</p>
        </form>
    </section>
</body>
</html>
