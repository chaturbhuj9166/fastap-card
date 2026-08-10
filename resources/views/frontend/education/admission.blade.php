<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $customer->name ?? 'Education' }} - Admission Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --edu-primary: #4338ca;
            --edu-light: #eef2ff;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(140deg, var(--edu-light), #ffffff 60%);
            color: var(--text-main);
            min-height: 100vh;
            padding: 32px 16px;
        }
        .card {
            max-width: 760px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 18px 40px rgba(15,23,42,0.08);
        }
        h1 { font-size: 1.8rem; margin-bottom: 0.4rem; }
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
            background: var(--edu-primary);
            color: #fff;
            border: none;
            padding: 0.75rem 1.2rem;
            border-radius: 0.6rem;
            font-weight: 700;
            cursor: pointer;
        }
        .submit-btn:hover { background: #312e81; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Admission Form</h1>
        <p>Fill out the form to apply for admission. We will contact you soon.</p>

        @if ($errors->any())
            <div class="error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url($customer->slug . '/admission') }}">
            @csrf
            <div class="grid">
                <div>
                    <label>Student Name</label>
                    <input type="text" name="student_name" value="{{ old('student_name') }}" required>
                </div>
                <div>
                    <label>Parent Name</label>
                    <input type="text" name="parent_name" value="{{ old('parent_name') }}">
                </div>
                <div>
                    <label>Mobile</label>
                    <input type="text" name="mobile" value="{{ old('mobile') }}" required>
                </div>
                <div>
                    <label>Email (optional)</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>
                <div>
                    <label>Course</label>
                    <select name="course_id">
                        <option value="">Select course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Class/Standard</label>
                    <input type="text" name="class_standard" value="{{ old('class_standard') }}">
                </div>
                <button type="submit" class="submit-btn">Submit Admission</button>
            </div>
        </form>
    </div>
</body>
</html>
