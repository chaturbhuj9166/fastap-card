<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Political Leader' }} - Grievance Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --political-primary: #2563eb;
            --political-dark: #1e40af;
            --political-light: #eff6ff;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, rgba(37,99,235,0.12), transparent 60%), #f8fafc;
            color: var(--text-main);
            min-height: 100vh;
            padding: 32px 16px;
        }
        .card {
            max-width: 720px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 20px 40px rgba(15,23,42,0.08);
        }
        h1 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        p { color: var(--text-muted); margin-bottom: 1.5rem; }
        label { font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; display: block; }
        input, textarea {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.6rem;
            font-size: 0.95rem;
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
            background: var(--political-primary);
            color: #fff;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 0.6rem;
            font-weight: 600;
            cursor: pointer;
        }
        .submit-btn:hover { background: var(--political-dark); }
        .helper { font-size: 0.8rem; color: var(--text-muted); }
    </style>
</head>
<body>
    <div class="card">
        <h1>Submit a Grievance</h1>
        <p>Share your issue and we will follow up with resolution updates.</p>

        @if ($errors->any())
            <div class="error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url($customer->slug . '/grievance') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid">
                <div>
                    <label>Name</label>
                    <input type="text" name="complainant_name" value="{{ old('complainant_name') }}" required>
                </div>
                <div>
                    <label>Mobile</label>
                    <input type="text" name="complainant_mobile" value="{{ old('complainant_mobile') }}" required>
                </div>
                <div>
                    <label>Email (optional)</label>
                    <input type="email" name="complainant_email" value="{{ old('complainant_email') }}">
                </div>
                <div>
                    <label>Issue Category</label>
                    <input type="text" name="issue_category" value="{{ old('issue_category') }}">
                </div>
                <div>
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location') }}">
                </div>
                <div>
                    <label>Issue Description</label>
                    <textarea name="issue_description" rows="4" required>{{ old('issue_description') }}</textarea>
                </div>
                <div>
                    <label>Images (optional)</label>
                    <input type="file" name="images[]" multiple>
                    <div class="helper">You can upload photos to support the complaint.</div>
                </div>
                <button type="submit" class="submit-btn">Submit Grievance</button>
            </div>
        </form>
    </div>
</body>
</html>
