@php
    $hasMedicalProfiles = false;
    $medicalProfiles = [];
 
    if (isset($userdata) && $userdata->id) {
        $medicalProfiles = App\Models\MedicalProfile::where('customer_id', $userdata->id)
                                                    ->where('is_active', true)
                                                    ->orderBy('display_order')
                                                    ->get();
        $hasMedicalProfiles = $medicalProfiles->count() > 0;
    }
 
    if ($hasMedicalProfiles && !request()->has('legacy')) {
        header('Location: ' . url($userdata->slug . '/medical'));
        exit;
    }
@endphp
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. {{ $userdata->name ?? 'Doctor' }} - Medical Professional</title>
 
    @php
        $websetting = App\Models\websetting::first();
        $serviceImages = [
            'https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1504813184591-01572f98c85f?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?w=600&h=400&fit=crop&auto=format',
        ];
    @endphp
 
    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif
 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary:        #0a4d6e;
            --primary-mid:    #0d6a96;
            --primary-light:  #1591c8;
            --accent:         #00d4ff;
            --accent-gold:    #f0a500;
            --success:        #00c896;
            --danger:         #e84d4d;
            --text-dark:      #111827;
            --text-mid:       #374151;
            --text-gray:      #6b7280;
            --text-light:     #9ca3af;
            --bg-light:       #f0f6fc;
            --bg-card:        #ffffff;
            --border:         #dde5ed;
            --shadow-sm:      0 2px 8px rgba(10,77,110,0.10);
            --shadow-md:      0 8px 28px rgba(10,77,110,0.15);
            --shadow-lg:      0 20px 60px rgba(10,77,110,0.20);
            --shadow-xl:      0 30px 80px rgba(10,77,110,0.25);
            --radius-sm:      8px;
            --radius-md:      14px;
            --radius-lg:      22px;
            --radius-xl:      32px;
            --transition:     all 0.35s cubic-bezier(.4,0,.2,1);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ═══════════════════════════════
           PREVIEW BANNER
        ═══════════════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg,#7c3aed,#ec4899,#f97316);
            color:#fff;
            padding:0.9rem 1rem;
            text-align:center;
            font-weight:600;
            font-size:0.9rem;
            position:sticky;
            top:0;
            z-index:2000;
            box-shadow:0 4px 16px rgba(0,0,0,.18);
            letter-spacing:.3px;
        }
        .preview-banner a { color:#fde68a; text-decoration:underline; font-weight:800; }

        /* ═══════════════════════════════
           HERO SECTION
        ═══════════════════════════════ */
        .hero {
            position: relative;
            min-height: 680px;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?w=1800&h=900&fit=crop&auto=format');
            background-size: cover;
            background-position: center 30%;
            transform: scale(1.05);
            animation: heroZoom 18s ease-in-out infinite alternate;
            z-index: 1;
        }

        @keyframes heroZoom {
            from { transform: scale(1.0); background-position: center 30%; }
            to   { transform: scale(1.08); background-position: center 35%; }
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                160deg,
                rgba(5,30,50,0.80) 0%,
                rgba(10,77,110,0.70) 40%,
                rgba(13,106,150,0.55) 70%,
                rgba(0,180,220,0.25) 100%
            );
            z-index: 2;
        }

        /* decorative wave at bottom */
        .hero-wave {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            z-index: 3;
            line-height: 0;
        }
        .hero-wave svg { display: block; width: 100%; }

        .hero-content {
            position: relative;
            z-index: 4;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 7rem 2rem 6rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.2rem;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            padding: 0.5rem 1.4rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            animation: fadeSlideDown 0.7s ease both;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.4rem, 5.5vw, 4.2rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            animation: fadeSlideDown 0.8s 0.1s ease both;
        }

        .hero-title span {
            color: var(--accent);
            font-style: italic;
        }

        .hero-sub {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: rgba(255,255,255,0.90);
            font-weight: 400;
            max-width: 600px;
            animation: fadeSlideDown 0.8s 0.2s ease both;
        }

        .hero-stats {
            display: flex;
            gap: 2.5rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 0.5rem;
            animation: fadeSlideDown 0.8s 0.3s ease both;
        }

        .hero-stat {
            text-align: center;
            color: #fff;
        }

        .hero-stat-num {
            font-size: 2.4rem;
            font-weight: 900;
            color: var(--accent);
            line-height: 1;
            display: block;
            text-shadow: 0 0 20px rgba(0,212,255,0.5);
        }

        .hero-stat-label {
            font-size: 0.8rem;
            opacity: 0.85;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeSlideDown 0.8s 0.4s ease both;
        }

        @keyframes fadeSlideDown {
            from { opacity: 0; transform: translateY(-22px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ═══════════════════════════════
           BUTTONS
        ═══════════════════════════════ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.85rem 2rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            white-space: nowrap;
            letter-spacing: .2px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-mid));
            color: #fff;
            box-shadow: 0 8px 24px rgba(21,145,200,0.4);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-mid), var(--primary));
            transform: translateY(-3px);
            box-shadow: 0 14px 36px rgba(21,145,200,0.5);
        }

        .btn-white {
            background: #fff;
            color: var(--primary);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }
        .btn-white:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-3px);
        }

        .btn-glass {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            color: #fff;
            border: 2px solid rgba(255,255,255,0.4);
        }
        .btn-glass:hover {
            background: rgba(255,255,255,0.28);
            transform: translateY(-3px);
        }

        .btn-outline {
            background: #fff;
            color: var(--primary);
            border: 2px solid var(--primary-light);
        }
        .btn-outline:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            transform: translateY(-3px);
        }

        .btn-wa {
            background: linear-gradient(135deg,#25d366,#128c7e);
            color: #fff;
            box-shadow: 0 8px 24px rgba(37,211,102,0.4);
        }
        .btn-wa:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 36px rgba(37,211,102,0.5);
        }

        /* ═══════════════════════════════
           PROFILE CARD (FLOATING)
        ═══════════════════════════════ */
        .profile-section {
            position: relative;
            z-index: 10;
            margin-top: 20px;
            padding: 0 2rem 0;
        }

        .profile-card {
            max-width: 1160px;
            margin: 0 auto;
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            display: grid;
            grid-template-columns: 340px 1fr;
        }

        .profile-card-left {
            background: linear-gradient(170deg, var(--primary) 0%, var(--primary-mid) 60%, var(--primary-light) 100%);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .profile-card-left::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }
        .profile-card-left::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .profile-avatar-wrap {
            position: relative;
            z-index: 2;
        }

        .profile-avatar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 5px solid rgba(255,255,255,0.85);
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
            object-fit: cover;
            display: block;
            background: rgba(255,255,255,0.1);
        }

        .profile-avatar-icon {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 5px solid rgba(255,255,255,0.85);
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5.5rem;
            color: rgba(255,255,255,0.9);
        }

        .avatar-verified {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 44px;
            height: 44px;
            background: var(--success);
            border-radius: 50%;
            border: 3px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(0,200,150,0.4);
        }

        .profile-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            position: relative;
            z-index: 2;
        }

        .profile-desig {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.85);
            font-weight: 500;
            position: relative;
            z-index: 2;
            line-height: 1.5;
        }

        .profile-tag-row {
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .profile-tag {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: var(--radius-md);
            padding: 0.7rem 1rem;
            color: #fff;
            font-size: 0.88rem;
            font-weight: 500;
            transition: var(--transition);
        }
        .profile-tag:hover {
            background: rgba(255,255,255,0.22);
        }
        .profile-tag i {
            width: 20px;
            text-align: center;
            color: var(--accent);
            font-size: 0.95rem;
        }

        .profile-contact-btns {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .profile-card-right {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .profile-headline {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .profile-headline h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.15;
        }

        .profile-headline .sub {
            font-size: 1.1rem;
            color: var(--primary-light);
            font-weight: 600;
        }

        .profile-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.7rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.5rem 1.1rem;
            background: var(--bg-light);
            border: 1.5px solid var(--border);
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--primary);
            transition: var(--transition);
        }
        .badge:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        .badge i { font-size: 0.85rem; }

        .profile-quick-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .qs-item {
            background: var(--bg-light);
            border-radius: var(--radius-md);
            padding: 1.2rem;
            text-align: center;
            border: 1.5px solid var(--border);
            transition: var(--transition);
        }
        .qs-item:hover {
            border-color: var(--primary-light);
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }
        .qs-num {
            font-size: 2rem;
            font-weight: 900;
            color: var(--primary);
            display: block;
            line-height: 1;
            margin-bottom: 0.3rem;
        }
        .qs-label {
            font-size: 0.78rem;
            color: var(--text-gray);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profile-btn-row {
            display: flex;
            gap: 0.9rem;
            flex-wrap: wrap;
        }

        /* ═══════════════════════════════
           LAYOUT CONTAINER
        ═══════════════════════════════ */
        .page-body {
            max-width: 1160px;
            margin: 0 auto;
            padding: 4rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 5rem;
        }

        /* ═══════════════════════════════
           SECTION HEADERS
        ═══════════════════════════════ */
        .section-head {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2.5rem;
            position: relative;
            padding-bottom: 1.5rem;
        }
        .section-head::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 4px;
        }

        .section-icon {
            width: 62px;
            height: 62px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.6rem;
            flex-shrink: 0;
            box-shadow: 0 8px 24px rgba(21,145,200,0.3);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.6rem, 3vw, 2.1rem);
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
        }
        .section-title span {
            color: var(--primary-light);
        }

        /* ═══════════════════════════════
           SERVICE CARDS  (unique images)
        ═══════════════════════════════ */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border: 1px solid var(--border);
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .sc-image {
            position: relative;
            height: 220px;
            overflow: hidden;
        }
        .sc-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .service-card:hover .sc-image img {
            transform: scale(1.1);
        }
        .sc-image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(10,77,110,0.3) 0%,
                rgba(10,77,110,0.7) 100%
            );
        }
        .sc-icon-badge {
            position: absolute;
            bottom: -24px;
            left: 50%;
            transform: translateX(-50%);
            width: 52px;
            height: 52px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
            box-shadow: 0 8px 20px rgba(10,77,110,0.25);
            border: 3px solid var(--bg-light);
            z-index: 2;
        }

        .sc-body {
            padding: 2.5rem 1.8rem 2rem;
            text-align: center;
        }
        .sc-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.7rem;
        }
        .sc-desc {
            font-size: 0.9rem;
            color: var(--text-gray);
            line-height: 1.7;
        }
        .sc-tag {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.3rem 0.9rem;
            background: var(--bg-light);
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: .5px;
        }

        /* ═══════════════════════════════
           QUALIFICATIONS TIMELINE
        ═══════════════════════════════ */
        .edu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 1.5rem;
        }

        .edu-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            display: flex;
            gap: 1.4rem;
            align-items: flex-start;
            transition: var(--transition);
        }
        .edu-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .edu-icon {
            width: 54px;
            height: 54px;
            border-radius: var(--radius-md);
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.4rem;
            flex-shrink: 0;
            box-shadow: 0 6px 18px rgba(21,145,200,0.3);
        }

        .edu-body {}
        .edu-degree {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.3rem;
        }
        .edu-details {
            font-size: 0.88rem;
            color: var(--text-gray);
            line-height: 1.6;
        }
        .edu-year {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 0.25rem 0.75rem;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            color: #fff;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        /* ═══════════════════════════════
           OPD SCHEDULE  (image + overlay)
        ═══════════════════════════════ */
        .opd-section {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .opd-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1600&h=700&fit=crop&auto=format');
            background-size: cover;
            background-position: center;
            z-index: 1;
        }
        .opd-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(5,25,45,0.90) 0%, rgba(10,77,110,0.85) 100%);
            z-index: 2;
        }

        .opd-content {
            position: relative;
            z-index: 3;
            padding: 4rem 3rem;
        }

        .opd-content .section-head { margin-bottom: 3rem; }
        .opd-content .section-head::after { background: linear-gradient(90deg,#fff,var(--accent)); }
        .opd-content .section-title { color: #fff; }
        .opd-content .section-icon {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: none;
        }

        .opd-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
        }

        .opd-card {
            background: rgba(255,255,255,0.10);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.20);
            border-radius: var(--radius-lg);
            padding: 2rem 1.5rem;
            text-align: center;
            color: #fff;
            transition: var(--transition);
        }
        .opd-card:hover {
            background: rgba(255,255,255,0.18);
            transform: translateY(-6px);
        }

        .opd-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin: 0 auto 1.2rem;
            color: var(--accent);
        }

        .opd-label {
            font-size: 0.82rem;
            opacity: 0.8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }
        .opd-value {
            font-size: 1.3rem;
            font-weight: 800;
        }

        /* ═══════════════════════════════
           FEES
        ═══════════════════════════════ */
        .fees-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .fee-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: var(--transition);
        }
        .fee-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .fee-card-top {
            padding: 2rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .fee-card-top::before {
            content: '';
            position: absolute;
            top: -30px; right: -30px;
            width: 120px; height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }

        .fee-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .fee-icon {
            font-size: 2.8rem;
            margin-bottom: 0.8rem;
            position: relative;
            z-index: 1;
        }
        .fee-type-label {
            font-size: 0.8rem;
            opacity: 0.85;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
        }

        .fee-card-body {
            padding: 2rem;
            text-align: center;
        }
        .fee-type {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }
        .fee-amount {
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 0.3rem;
        }
        .fee-note {
            font-size: 0.82rem;
            color: var(--text-light);
            font-weight: 500;
        }

        /* ═══════════════════════════════
           CONTACT CARDS
        ═══════════════════════════════ */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .contact-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-md);
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 6px 18px rgba(21,145,200,0.3);
        }
        .contact-label {
            font-size: 0.75rem;
            color: var(--text-light);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 0.25rem;
        }
        .contact-value {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* ═══════════════════════════════
           ABOUT QUOTE
        ═══════════════════════════════ */
        .about-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            min-height: 380px;
        }

        .about-img-side {
            background-image: url('https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=800&h=600&fit=crop&auto=format');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .about-img-side::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10,77,110,0.5), transparent);
        }

        .about-text-side {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-mid) 100%);
            padding: 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5rem;
        }

        .about-quote-mark {
            font-size: 5rem;
            color: rgba(255,255,255,0.2);
            font-family: 'Playfair Display', serif;
            line-height: 1;
            margin-bottom: -1.5rem;
        }

        .about-quote-text {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.2rem, 2vw, 1.7rem);
            font-style: italic;
            color: #fff;
            line-height: 1.7;
            font-weight: 600;
        }

        .about-author {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.75);
            font-weight: 600;
        }

        /* ═══════════════════════════════
           PHOTO GALLERY
        ═══════════════════════════════ */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto auto;
            gap: 1.2rem;
        }

        .gallery-item {
            border-radius: var(--radius-md);
            overflow: hidden;
            position: relative;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: var(--transition);
        }

        .gallery-item:nth-child(1) {
            grid-column: span 2;
            grid-row: span 2;
        }
        .gallery-item:nth-child(5) {
            grid-column: span 2;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 180px;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover {
            transform: scale(1.03);
            box-shadow: var(--shadow-lg);
            z-index: 5;
        }
        .gallery-item:hover img { transform: scale(1.08); }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(10,77,110,0.45);
            opacity: 0;
            transition: opacity 0.35s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2rem;
        }
        .gallery-item:hover .gallery-overlay { opacity: 1; }

        /* ═══════════════════════════════
           CTA BAND
        ═══════════════════════════════ */
        .cta-band {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }

        .cta-band-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1666214280557-f1b5022eb634?w=1600&h=600&fit=crop&auto=format');
            background-size: cover;
            background-position: center;
            z-index: 1;
        }
        .cta-band-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(5,20,40,0.93) 0%, rgba(10,77,110,0.87) 60%, rgba(21,145,200,0.75) 100%);
            z-index: 2;
        }

        .cta-band-content {
            position: relative;
            z-index: 3;
            padding: 5rem 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.5rem;
        }

        .cta-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.3);
            color: var(--accent);
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
        }

        .cta-sub {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.85);
            max-width: 540px;
            font-weight: 400;
        }

        .cta-actions {
            display: flex;
            gap: 1.2rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 0.5rem;
        }

        .btn-cta-main {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            background: #fff;
            color: var(--primary);
            padding: 1.1rem 2.8rem;
            border-radius: var(--radius-xl);
            font-weight: 800;
            font-size: 1rem;
            text-decoration: none;
            box-shadow: 0 12px 35px rgba(0,0,0,0.25);
            transition: var(--transition);
        }
        .btn-cta-main:hover {
            background: var(--accent);
            color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 18px 50px rgba(0,0,0,0.3);
        }

        .btn-cta-sec {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            color: #fff;
            padding: 1.1rem 2.8rem;
            border-radius: var(--radius-xl);
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.35);
            transition: var(--transition);
        }
        .btn-cta-sec:hover {
            background: rgba(255,255,255,0.22);
            transform: translateY(-5px);
        }

        /* ═══════════════════════════════
           SOCIAL SECTION
        ═══════════════════════════════ */
       /* ========================
   SOCIAL FLOATING LINKS
========================= */
.social-float {
    padding: 4rem 2rem;
    display: flex;
    justify-content: center;
    background: linear-gradient(135deg,#f9fafb,#fff);
}

.social-container {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
}

.social-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #111;
}
.social-title span {
    color: #ff5e57;
}

.social-links {
    display: flex;
    gap: 1.8rem;
    flex-wrap: wrap;
}

/* Minimal, floating social buttons */
.social-link {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #fff;
    text-decoration: none;
    transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
    position: relative;
}

/* Floating hover effect */
.social-link::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    opacity: 0;
    transition: opacity 0.35s ease;
}

.social-link:hover {
    transform: translateY(-10px) scale(1.2);
}
.social-link:hover::after {
    opacity: 1;
}

/* Gradient backgrounds */
.social-link.facebook { background: linear-gradient(135deg,#1877f2,#0d5cc7);}
.social-link.instagram { background: linear-gradient(135deg,#f58529,#dd2a7b,#8134af);}
.social-link.linkedin { background: linear-gradient(135deg,#0077b5,#004d83);}
.social-link.twitter { background: linear-gradient(135deg,#1da1f2,#0d7dc7);}
.social-link.youtube { background: linear-gradient(135deg,#ff0000,#cc0000);}
.social-link.whatsapp { background: linear-gradient(135deg,#25d366,#128c7e);}

/* Responsive adjustments */
@media (max-width: 768px) {
    .social-title {
        font-size: 2rem;
    }
    .social-link {
        width: 55px;
        height: 55px;
        font-size: 1.3rem;
    }
}

        /* ═══════════════════════════════
           TRUST STRIP
        ═══════════════════════════════ */
        .trust-strip {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .trust-item {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: var(--transition);
        }
        .trust-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }
        .trust-icon {
            font-size: 2.2rem;
            color: var(--primary-light);
            margin-bottom: 0.8rem;
        }
        .trust-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.3rem;
        }
        .trust-desc {
            font-size: 0.82rem;
            color: var(--text-gray);
            line-height: 1.6;
        }

        /* ═══════════════════════════════
           FOOTER
        ═══════════════════════════════ */
        .footer {
            background: linear-gradient(135deg, var(--primary-dark, #051929), var(--primary));
            color: rgba(255,255,255,0.75);
            padding: 3rem 2rem;
            text-align: center;
        }
        .footer-inner {
            max-width: 1160px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.8rem;
        }
        .footer a { color: var(--accent); text-decoration: none; font-weight: 700; }
        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: #fff;
            font-weight: 800;
            margin-bottom: 0.3rem;
        }

        /* ═══════════════════════════════
           ANIMATIONS
        ═══════════════════════════════ */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ═══════════════════════════════
           RESPONSIVE
        ═══════════════════════════════ */
        @media (max-width: 900px) {
            .profile-card { grid-template-columns: 1fr; }
            .profile-card-left { padding: 2.5rem 2rem; }
            .profile-card-right { padding: 2.5rem 2rem; }
            .about-split { grid-template-columns: 1fr; }
            .about-img-side { min-height: 220px; }
            .gallery-grid { grid-template-columns: repeat(2,1fr); }
            .gallery-item:nth-child(1) { grid-column: span 2; grid-row: span 1; }
            .gallery-item:nth-child(5) { grid-column: span 2; }
        }

        @media (max-width: 640px) {
            .hero { min-height: 500px; }
            .hero-stats { gap: 1.5rem; }
            .profile-section { margin-top: -80px; padding: 0 1rem; }
            .profile-quick-stats { grid-template-columns: repeat(3,1fr); gap: 0.6rem; }
            .profile-btn-row { flex-direction: column; }
            .page-body { padding: 3rem 1rem; gap: 3.5rem; }
            .opd-content { padding: 2.5rem 1.5rem; }
            .cta-band-content { padding: 3.5rem 1.5rem; }
            .social-band { padding: 2.5rem 1.5rem; }
            .gallery-grid { grid-template-columns: 1fr 1fr; }
            .gallery-item:nth-child(1) { grid-column: span 2; }
        }

        @media (max-width: 400px) {
            .profile-quick-stats { grid-template-columns: 1fr 1fr; }
            .hero-stat-num { font-size: 1.8rem; }
        }
    </style>
</head>
<body>

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i>&nbsp; Preview Mode —
        <a href="{{ url('/signin') }}">Sign up free</a> to publish your professional medical profile
    </div>
    @endif

    <!-- ╔══════════════════════════════════════╗
         ║           HERO SECTION               ║
         ╚══════════════════════════════════════╝ -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-shield-heart"></i>
                Trusted Medical Professional
            </div>

            <h1 class="hero-title">
                Dr. <span>{{ $userdata->name ?? 'Your Doctor' }}</span>
            </h1>

            <p class="hero-sub">{{ $userdata->desig ?? 'Specialist · Compassionate Care · Expert Diagnosis' }}</p>

            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-num">15+</span>
                    <span class="hero-stat-label">Years Experience</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-num">10K+</span>
                    <span class="hero-stat-label">Patients Treated</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-num">98%</span>
                    <span class="hero-stat-label">Satisfaction Rate</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-num">24/7</span>
                    <span class="hero-stat-label">Emergency Care</span>
                </div>
            </div>

            <div class="hero-actions">
                @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="btn btn-primary">
                        <i class="fas fa-phone-alt"></i> Book Appointment
                    </a>
                @endif
                @if(($social ?? null) && $social->whatsapp)
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="btn btn-glass">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                @endif
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="hero-wave">
            <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,40 C360,90 1080,0 1440,50 L1440,80 L0,80 Z" fill="#f0f6fc"/>
            </svg>
        </div>
    </section>

    <!-- ╔══════════════════════════════════════╗
         ║        FLOATING PROFILE CARD         ║
         ╚══════════════════════════════════════╝ -->
    <div class="profile-section">
        <div class="profile-card reveal">

            <!-- LEFT PANEL -->
            <div class="profile-card-left">
                <div class="profile-avatar-wrap">
                    @if($userdata->profile ?? false)
                        <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}"
                             alt="Dr. {{ $userdata->name }}"
                             class="profile-avatar">
                    @else
                        <div class="profile-avatar-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                    @endif
                    <div class="avatar-verified">
                        <i class="fas fa-check"></i>
                    </div>
                </div>

                <div class="profile-name">Dr. {{ $userdata->name ?? 'Doctor' }}</div>
                <div class="profile-desig">{{ $userdata->desig ?? 'Medical Specialist' }}</div>

                <div class="profile-tag-row">
                    @if(($qualifications ?? collect())->count() > 0)
                    <div class="profile-tag">
                        <i class="fas fa-graduation-cap"></i>
                        {{ $qualifications->first()->qualifiaction ?? $qualifications->first()->title ?? 'Qualified' }}
                    </div>
                    @endif
                    @if($userdata->city ?? false)
                    <div class="profile-tag">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}
                    </div>
                    @endif
                    @if(($professions ?? collect())->count() > 0)
                    <div class="profile-tag">
                        <i class="fas fa-stethoscope"></i>
                        {{ $professions->count() }} Specialization{{ $professions->count() > 1 ? 's' : '' }}
                    </div>
                    @endif
                    <div class="profile-tag">
                        <i class="fas fa-clock"></i>
                        Mon–Sat · 9 AM – 9 PM
                    </div>
                    <div class="profile-tag">
                        <i class="fas fa-star" style="color:#f0a500;"></i>
                        4.9 / 5.0 Rating
                    </div>
                </div>

                <div class="profile-contact-btns">
                    @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="btn btn-white" style="width:100%;">
                        <i class="fas fa-phone-alt"></i> {{ $userdata->mobile }}
                    </a>
                    @endif
                    @if(($social ?? null) && $social->whatsapp)
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="btn btn-wa" style="width:100%;">
                        <i class="fab fa-whatsapp"></i> WhatsApp Chat
                    </a>
                    @endif
                </div>
            </div>

            <!-- RIGHT PANEL -->
            <div class="profile-card-right">
                <div class="profile-headline">
                    <h1>Dr. {{ $userdata->name ?? 'Your Doctor' }}</h1>
                    <p class="sub">{{ $userdata->desig ?? 'Medical Professional' }}</p>
                </div>

                <div class="profile-badges">
                    @if(($qualifications ?? collect())->count() > 0)
                        <span class="badge">
                            <i class="fas fa-graduation-cap"></i>
                            {{ $qualifications->first()->qualifiaction ?? $qualifications->first()->title ?? 'MD' }}
                        </span>
                    @endif
                    @if($userdata->city ?? false)
                        <span class="badge">
                            <i class="fas fa-location-dot"></i>
                            {{ $userdata->city }}
                        </span>
                    @endif
                    @if(($professions ?? collect())->count() > 0)
                        <span class="badge">
                            <i class="fas fa-stethoscope"></i>
                            {{ $professions->count() }} Service{{ $professions->count() > 1 ? 's' : '' }}
                        </span>
                    @endif
                    <span class="badge">
                        <i class="fas fa-certificate"></i> Board Certified
                    </span>
                    <span class="badge">
                        <i class="fas fa-shield-halved"></i> Verified
                    </span>
                </div>

                <div class="profile-quick-stats">
                    <div class="qs-item">
                        <span class="qs-num">15+</span>
                        <span class="qs-label">Yrs Exp.</span>
                    </div>
                    <div class="qs-item">
                        <span class="qs-num">10K+</span>
                        <span class="qs-label">Patients</span>
                    </div>
                    <div class="qs-item">
                        <span class="qs-num">98%</span>
                        <span class="qs-label">Success</span>
                    </div>
                </div>

                <div class="profile-btn-row">
                    @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="btn btn-primary">
                        <i class="fas fa-calendar-check"></i> Book Appointment
                    </a>
                    @endif
                    @if($userdata->email ?? false)
                    <a href="mailto:{{ $userdata->email }}" class="btn btn-outline">
                        <i class="fas fa-envelope"></i> Send Email
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- ╔══════════════════════════════════════╗
         ║         TRUST / WHY US STRIP         ║
         ╚══════════════════════════════════════╝ -->
    <div style="max-width:1160px;margin:3rem auto 0;padding:0 2rem;">
        <div class="trust-strip reveal">
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-user-doctor"></i></div>
                <div class="trust-title">Expert Specialists</div>
                <div class="trust-desc">Board-certified doctors with proven expertise</div>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-microscope"></i></div>
                <div class="trust-title">Advanced Diagnostics</div>
                <div class="trust-desc">Latest medical technology for precise diagnosis</div>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-heart-pulse"></i></div>
                <div class="trust-title">Patient-Centered Care</div>
                <div class="trust-desc">Compassionate and personalised treatment</div>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-shield-heart"></i></div>
                <div class="trust-title">Confidential & Safe</div>
                <div class="trust-desc">Full privacy and data protection assured</div>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-clock-rotate-left"></i></div>
                <div class="trust-title">Flexible Hours</div>
                <div class="trust-desc">Morning & evening OPD sessions available</div>
            </div>
        </div>
    </div>

    <!-- ═══ MAIN PAGE BODY ═══ -->
    <div class="page-body">

        <!-- ╔═══════════════════════════════╗
             ║    SERVICES / SPECIALIZATIONS ║
             ╚═══════════════════════════════╝ -->
        @if(($professions ?? collect())->count() > 0)
        <section class="reveal">
            <div class="section-head">
                <div class="section-icon"><i class="fas fa-stethoscope"></i></div>
                <div>
                    <h2 class="section-title">Specializations <span>&amp; Services</span></h2>
                </div>
            </div>
            <div class="services-grid">
                @php
                    $serviceImagesArr = [
                        'https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1504813184591-01572f98c85f?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?w=600&h=400&fit=crop&auto=format',
                    ];
                    $serviceIcons = [
                        'fas fa-heart-pulse','fas fa-brain','fas fa-bone','fas fa-eye',
                        'fas fa-baby','fas fa-lungs','fas fa-tooth','fas fa-dna',
                    ];
                    $sIdx = 0;
                @endphp
                @foreach($professions as $profession)
                @php
                    $imgUrl = $serviceImagesArr[$sIdx % count($serviceImagesArr)];
                    $iconClass = $serviceIcons[$sIdx % count($serviceIcons)];
                    $sIdx++;
                @endphp
                <div class="service-card">
                    <div class="sc-image">
                        <img src="{{ $imgUrl }}"
                             alt="{{ $profession->profession ?? $profession->title ?? 'Service' }}"
                             loading="lazy">
                        <div class="sc-image-overlay"></div>
                        <div class="sc-icon-badge">
                            <i class="{{ $iconClass }}"></i>
                        </div>
                    </div>
                    <div class="sc-body">
                        <h3 class="sc-title">{{ $profession->profession ?? $profession->title ?? 'Service' }}</h3>
                        <p class="sc-desc">{{ $profession->description ?? $profession->desc ?? 'Expert medical care and professional consultation available.' }}</p>
                        <span class="sc-tag">Learn More →</span>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- ╔═══════════════════════════════╗
             ║   EDUCATION & QUALIFICATIONS  ║
             ╚═══════════════════════════════╝ -->
        @if(($qualifications ?? collect())->count() > 0)
        <section class="reveal">
            <div class="section-head">
                <div class="section-icon"><i class="fas fa-graduation-cap"></i></div>
                <div>
                    <h2 class="section-title">Education <span>&amp; Qualifications</span></h2>
                </div>
            </div>
            <div class="edu-grid">
                @php $qIcons = ['fas fa-medal','fas fa-award','fas fa-certificate','fas fa-scroll','fas fa-star','fas fa-trophy']; $qIdx=0; @endphp
                @foreach($qualifications as $qual)
                <div class="edu-card">
                    <div class="edu-icon">
                        <i class="{{ $qIcons[$qIdx % count($qIcons)] }}"></i>
                    </div>
                    <div class="edu-body">
                        <div class="edu-degree">{{ $qual->qualifiaction ?? $qual->title ?? 'Qualification' }}</div>
                        <div class="edu-details">{{ $qual->description ?? $qual->desc ?? 'Professional medical qualification' }}</div>
                        @if($qual->year ?? false)
                            <span class="edu-year">{{ $qual->year }}</span>
                        @endif
                    </div>
                </div>
                @php $qIdx++; @endphp
                @endforeach
            </div>
        </section>
        @endif

        <!-- ╔═══════════════════════════════╗
             ║       OPD SCHEDULE            ║
             ╚═══════════════════════════════╝ -->
        <section class="reveal">
            <div class="opd-section">
                <div class="opd-bg"></div>
                <div class="opd-overlay"></div>
                <div class="opd-content">
                    <div class="section-head">
                        <div class="section-icon">
                            <i class="fas fa-calendar-days"></i>
                        </div>
                        <div>
                            <h2 class="section-title">OPD Schedule</h2>
                        </div>
                    </div>
                    <div class="opd-grid">
                        <div class="opd-card">
                            <div class="opd-icon"><i class="fas fa-sun"></i></div>
                            <div class="opd-label">Morning OPD</div>
                            <div class="opd-value">9:00 AM – 2:00 PM</div>
                        </div>
                        <div class="opd-card">
                            <div class="opd-icon"><i class="fas fa-moon"></i></div>
                            <div class="opd-label">Evening OPD</div>
                            <div class="opd-value">5:00 PM – 9:00 PM</div>
                        </div>
                        <div class="opd-card">
                            <div class="opd-icon"><i class="fas fa-calendar-week"></i></div>
                            <div class="opd-label">Working Days</div>
                            <div class="opd-value">Mon – Sat</div>
                        </div>
                        <div class="opd-card">
                            <div class="opd-icon"><i class="fas fa-video"></i></div>
                            <div class="opd-label">Tele-Consultation</div>
                            <div class="opd-value">By Appointment</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ╔═══════════════════════════════╗
             ║     CONSULTATION FEES         ║
             ╚═══════════════════════════════╝ -->
        <section class="reveal">
            <div class="section-head">
                <div class="section-icon"><i class="fas fa-indian-rupee-sign"></i></div>
                <div>
                    <h2 class="section-title">Consultation <span>Fees</span></h2>
                </div>
            </div>
            <div class="fees-grid">
                <div class="fee-card">
                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=600&h=280&fit=crop&auto=format"
                         class="fee-img" alt="In-Person" loading="lazy">
                    <div class="fee-card-body">
                        <div class="fee-type">In-Person Visit</div>
                        <div class="fee-amount">₹500</div>
                        <div class="fee-note">Per consultation at clinic</div>
                    </div>
                </div>
                <div class="fee-card">
                    <img src="https://images.unsplash.com/photo-1576671081837-49000212a370?w=600&h=280&fit=crop&auto=format"
                         class="fee-img" alt="Video" loading="lazy">
                    <div class="fee-card-body">
                        <div class="fee-type">Video Consultation</div>
                        <div class="fee-amount">₹400</div>
                        <div class="fee-note">Online session via video call</div>
                    </div>
                </div>
                <div class="fee-card">
                    <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=600&h=280&fit=crop&auto=format"
                         class="fee-img" alt="Phone" loading="lazy">
                    <div class="fee-card-body">
                        <div class="fee-type">Phone Consultation</div>
                        <div class="fee-amount">₹300</div>
                        <div class="fee-note">Quick telephonic advice</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ╔═══════════════════════════════╗
             ║      CONTACT INFORMATION      ║
             ╚═══════════════════════════════╝ -->
        <section class="reveal">
            <div class="section-head">
                <div class="section-icon"><i class="fas fa-address-card"></i></div>
                <div>
                    <h2 class="section-title">Contact <span>Information</span></h2>
                </div>
            </div>
            <div class="contact-grid">
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="contact-card">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <div class="contact-label">Phone Number</div>
                        <div class="contact-value">{{ $userdata->mobile }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->email ?? false)
                <a href="mailto:{{ $userdata->email }}" class="contact-card">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="contact-label">Email Address</div>
                        <div class="contact-value">{{ $userdata->email }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->city ?? false)
                <div class="contact-card">
                    <div class="contact-icon"><i class="fas fa-location-dot"></i></div>
                    <div>
                        <div class="contact-label">Location</div>
                        <div class="contact-value">
                            {{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}
                        </div>
                    </div>
                </div>
                @endif
                @if(($social ?? null) && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" class="contact-card">
                    <div class="contact-icon" style="background:linear-gradient(135deg,#25d366,#128c7e);">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="contact-label">WhatsApp</div>
                        <div class="contact-value">{{ $social->whatsapp }}</div>
                    </div>
                </a>
                @endif
            </div>
        </section>

        <!-- ╔═══════════════════════════════╗
             ║       ABOUT / PHILOSOPHY      ║
             ╚═══════════════════════════════╝ -->
        @if(($thoughts ?? collect())->count() > 0)
        <section class="reveal">
            <div class="section-head">
                <div class="section-icon"><i class="fas fa-quote-left"></i></div>
                <div>
                    <h2 class="section-title">Doctor's <span>Philosophy</span></h2>
                </div>
            </div>
            <div class="about-split">
                <div class="about-img-side"></div>
                <div class="about-text-side">
                    <div class="about-quote-mark">"</div>
                    @foreach($thoughts->take(1) as $thought)
                        <p class="about-quote-text">{{ $thought->thought ?? $thought->title ?? '' }}</p>
                        <p class="about-author">— Dr. {{ $userdata->name ?? 'Doctor' }}, {{ $userdata->desig ?? '' }}</p>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- ╔═══════════════════════════════╗
             ║       PHOTO GALLERY           ║
             ╚═══════════════════════════════╝ -->
        @if(($professional_photos ?? collect())->count() > 0)
        <section class="reveal">
            <div class="section-head">
                <div class="section-icon"><i class="fas fa-images"></i></div>
                <div>
                    <h2 class="section-title">Clinic <span>&amp; Facilities</span></h2>
                </div>
            </div>
            <div class="gallery-grid">
                @foreach($professional_photos->take(6) as $photo)
                @php
                    $photoValue = $photo->image ?? $photo->name ?? '';
                    if ($photoValue) {
                        if (str_starts_with($photoValue, 'http://') || str_starts_with($photoValue, 'https://')) {
                            $photoUrl = $photoValue;
                        } elseif (str_starts_with($photoValue, 'uploads/') || str_starts_with($photoValue, 'frontend/') || str_starts_with($photoValue, 'storage/')) {
                            $photoUrl = asset($photoValue);
                        } else {
                            $photoUrl = asset('uploads/customer/' . $photoValue);
                        }
                    } else {
                        $galleryDefaults = [
                            'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&h=600&fit=crop&auto=format',
                            'https://images.unsplash.com/photo-1538108149393-fbbd81895907?w=800&h=600&fit=crop&auto=format',
                            'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=800&h=600&fit=crop&auto=format',
                            'https://images.unsplash.com/photo-1579684453423-f84349ef60b0?w=800&h=600&fit=crop&auto=format',
                            'https://images.unsplash.com/photo-1551076805-e1869033e561?w=800&h=600&fit=crop&auto=format',
                            'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=800&h=600&fit=crop&auto=format',
                        ];
                        $photoUrl = $galleryDefaults[$loop->index % count($galleryDefaults)];
                    }
                @endphp
                <div class="gallery-item">
                    <img src="{{ $photoUrl }}" alt="Clinic Photo" loading="lazy">
                    <div class="gallery-overlay"><i class="fas fa-expand-alt"></i></div>
                </div>
                @endforeach
            </div>
        </section>
        @else
        <!-- Static gallery if no photos uploaded -->
        <section class="reveal">
            <div class="section-head">
                <div class="section-icon"><i class="fas fa-images"></i></div>
                <div>
                    <h2 class="section-title">Clinic <span>&amp; Facilities</span></h2>
                </div>
            </div>
            <div class="gallery-grid">
                @php
                    $defaultGallery = [
                        'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=900&h=700&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1538108149393-fbbd81895907?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1579684453423-f84349ef60b0?w=600&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1551076805-e1869033e561?w=900&h=400&fit=crop&auto=format',
                        'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=600&h=400&fit=crop&auto=format',
                    ];
                @endphp
                @foreach($defaultGallery as $gImg)
                <div class="gallery-item">
                    <img src="{{ $gImg }}" alt="Medical Facility" loading="lazy">
                    <div class="gallery-overlay"><i class="fas fa-expand-alt"></i></div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

    </div><!-- /page-body -->

    <!-- ╔══════════════════════════════════════╗
         ║          CTA BAND                    ║
         ╚══════════════════════════════════════╝ -->
    <div style="padding:0 2rem; margin-bottom:4rem;">
        <div style="max-width:1160px;margin:0 auto;">
            <div class="cta-band reveal">
                <div class="cta-band-bg"></div>
                <div class="cta-band-overlay"></div>
                <div class="cta-band-content">
                    <div class="cta-pill">
                        <i class="fas fa-calendar-heart"></i> Book Now
                    </div>
                    <h2 class="cta-title">Ready for Expert Medical Care?</h2>
                    <p class="cta-sub">
                        Schedule your consultation with Dr. {{ $userdata->name ?? 'our specialist' }}
                        today and take the first step towards better health.
                    </p>
                    <div class="cta-actions">
                        @if($userdata->mobile ?? false)
                        <a href="tel:{{ $userdata->mobile }}" class="btn-cta-main">
                            <i class="fas fa-phone-alt"></i> Call: {{ $userdata->mobile }}
                        </a>
                        @endif
                        @if(($social ?? null) && $social->whatsapp)
                        <a href="https://wa.me/{{ $social->whatsapp }}" class="btn-cta-sec">
                            <i class="fab fa-whatsapp"></i> WhatsApp Us
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ╔══════════════════════════════════════╗
         ║         SOCIAL LINKS                 ║
         ╚══════════════════════════════════════╝ -->
    @if($social ?? false)
  <section class="social-float">
    <div class="social-container reveal">
        <h2 class="social-title">Connect <span>With Us</span></h2>
        <div class="social-links">
            @if($social->facebook ?? false)
            <a href="{{ $social->facebook }}" target="_blank" class="social-link facebook" title="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            @endif
            @if($social->instagram ?? false)
            <a href="{{ $social->instagram }}" target="_blank" class="social-link instagram" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            @endif
            @if($social->linkedin ?? false)
            <a href="{{ $social->linkedin }}" target="_blank" class="social-link linkedin" title="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>
            @endif
            @if($social->twitter ?? false)
            <a href="{{ $social->twitter }}" target="_blank" class="social-link twitter" title="Twitter / X">
                <i class="fab fa-x-twitter"></i>
            </a>
            @endif
            @if($social->youtube ?? false)
            <a href="{{ $social->youtube }}" target="_blank" class="social-link youtube" title="YouTube">
                <i class="fab fa-youtube"></i>
            </a>
            @endif
            @if($social->whatsapp ?? false)
            <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="social-link whatsapp" title="WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
            @endif
        </div>
    </div>
</section>
    @endif

    <!-- ╔══════════════════════════════════════╗
         ║             FOOTER                   ║
         ╚══════════════════════════════════════╝ -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-logo">Dr. {{ $userdata->name ?? 'Medical Professional' }}</div>
            <p>{{ $userdata->desig ?? 'Specialist · Trusted Medical Care' }}</p>
            <p style="margin-top:.5rem;">
                &copy; {{ date('Y') }} Digital Card by
                <a href="{{ url('/') }}">Fastap</a> · Professional Medical Profiles
            </p>
        </div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id   ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview      ?? false
    ])

    <script>
    // ─── Intersection Observer for reveal animations ───
    const revealEls = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    revealEls.forEach(el => io.observe(el));
    </script>

</body>
</html>