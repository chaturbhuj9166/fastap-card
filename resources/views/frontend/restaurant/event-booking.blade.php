<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Restaurant' }} - Event Booking</title>
    <style>
        body { margin: 0; font-family: "Segoe UI", sans-serif; background: #f9fafb; color: #111827; }
        .event-page { max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        .event-header { text-align: center; margin-bottom: 1.5rem; }
        .event-header h1 { margin-bottom: 0.5rem; }
        .event-form { display: flex; flex-direction: column; gap: 1.25rem; background: #fff; padding: 1.5rem; border-radius: 0.75rem; border: 1px solid #e5e7eb; }
        .form-row { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }
        .form-group label { display: block; margin-bottom: 0.4rem; font-weight: 600; color: #111827; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 0.6rem; border: 1px solid #d1d5db; border-radius: 0.4rem; background: #fff; color: #111827; }
        textarea { resize: vertical; }
        .btn-primary { background: #dc2626; color: #fff; border: none; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; cursor: pointer; }
        @media (max-width: 640px) { .event-form { padding: 1rem; } }
    </style>
</head>
<body>
<section class="event-page">
    <div class="event-header">
        <h1>{{ $customer->name ?? 'Restaurant' }} - Event Booking</h1>
        <p>Share your event details and we will get back to you.</p>
    </div>

    <form method="POST" action="{{ url('/' . $customer->slug . '/event-booking') }}" class="event-form">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label>Client Name</label>
                <input type="text" name="client_name" required>
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="client_mobile" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="client_email">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Event Type</label>
                <input type="text" name="event_type" required>
            </div>
            <div class="form-group">
                <label>Event Date</label>
                <input type="date" name="event_date" required>
            </div>
            <div class="form-group">
                <label>Time Slot</label>
                <select name="time_slot">
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                    <option value="night">Night</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Guest Count</label>
                <input type="number" name="guest_count" min="0">
            </div>
            <div class="form-group">
                <label>Venue Area</label>
                <input type="text" name="venue_area">
            </div>
            <div class="form-group">
                <label>Food Preference</label>
                <select name="food_preference">
                    <option value="veg">Veg</option>
                    <option value="non_veg">Non-Veg</option>
                    <option value="jain">Jain</option>
                    <option value="mixed">Mixed</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Special Requirements</label>
            <textarea name="special_requirements" rows="4"></textarea>
        </div>

        <button type="submit" class="btn-primary">Submit Booking</button>
    </form>
</section>
</body>
</html>
