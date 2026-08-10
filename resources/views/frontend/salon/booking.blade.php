<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Salon' }} - Salon Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --salon-primary: #ec4899;
            --salon-dark: #831843;
            --salon-light: #fdf2f8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top, rgba(236,72,153,0.12), transparent 60%), #fff7fb;
            color: #1e293b;
            min-height: 100vh;
        }
        .hero {
            padding: 3rem 1.5rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(236,72,153,0.14), rgba(216,180,254,0.18));
        }
        .hero h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            color: var(--salon-dark);
            margin-bottom: 0.5rem;
        }
        .hero p {
            color: #64748b;
            max-width: 640px;
            margin: 0 auto;
        }
        .card {
            max-width: 960px;
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
        .service-grid {
            display: grid;
            gap: 0.75rem;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
        .service-option {
            border: 1px solid #fbcfe8;
            border-radius: 0.75rem;
            padding: 0.75rem;
            background: var(--salon-light);
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
            cursor: pointer;
        }
        .service-option input { margin-right: 0.5rem; }
        .service-name { font-weight: 600; }
        .service-meta { font-size: 0.75rem; color: #64748b; }
        .service-price { font-size: 0.85rem; color: var(--salon-primary); font-weight: 600; }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
        .btn-primary {
            background: var(--salon-primary);
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
            color: #64748b;
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
        <h1>Book a Salon Visit</h1>
        <p>Pick your services and share your preferred time. {{ $customer->name ?? 'Our salon' }} will confirm your appointment shortly.</p>
    </section>

    <section class="card">
        <form method="POST" action="{{ url('/' . $customer->slug . '/salon-booking') }}">
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
                    <label>Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-input">
                </div>
                <div>
                    <label>Appointment Time</label>
                    <input type="time" name="appointment_time" class="form-input">
                </div>
                <div class="full-width">
                    <label>Services</label>
                    @if($services->count() > 0)
                        <div class="service-grid">
                            @foreach($services as $service)
                            <label class="service-option">
                                <span>
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}">
                                    <span class="service-name">{{ $service->service_name }}</span>
                                </span>
                                @if($service->duration_minutes)
                                    <span class="service-meta">{{ $service->duration_minutes }} mins</span>
                                @endif
                                <span class="service-price">{{ $service->price ? 'Rs. ' . number_format($service->price, 2) : 'On request' }}</span>
                            </label>
                            @endforeach
                        </div>
                    @else
                        <p class="note">Service list will be updated soon.</p>
                    @endif
                </div>
                <div>
                    <label>Preferred Artist</label>
                    <select name="artist_id" class="form-input">
                        <option value="">Select</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->artist_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Location</label>
                    <select name="location" class="form-input">
                        <option value="salon">Salon</option>
                        <option value="home">Home</option>
                    </select>
                </div>
                <div class="full-width">
                    <label>Home Address (if home service)</label>
                    <input type="text" name="home_address" class="form-input">
                </div>
                <div class="full-width">
                    <label>Notes</label>
                    <textarea name="notes" class="form-input" rows="3"></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Request Booking</button>
            </div>
            <p class="note">We will confirm your appointment and any advance requirements.</p>
        </form>
    </section>
</body>
</html>
