<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Fitness Trainer' }} - Fitness & Wellness</title>

    @php
        $websetting = App\Models\websetting::first();

        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile' => 1, 'quali' => 1, 'service' => 1, 'thought' => 1,
                'personal' => 1, 'profess' => 1, 'videos' => 1, 'product' => 1,
                'social_link' => 1, 'upload_file' => 1, 'client' => 1,
            ];
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client'], 1);
            }
        }

        $themeColor = $theme->color ?? '#f97316';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:wght@400;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary:   #f97316;
            --accent:    #ef4444;
            --green:     #22c55e;
            --dark:      #0d0d0d;
            --card:      #161616;
            --card2:     #1e1e1e;
            --border:    #2c2c2c;
            --text-muted:#888;
            --nav-bg:    #f97316;
        }

        * { margin:0; padding:0; box-sizing:border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            color: #fff;
            overflow-x: hidden;
        }

        /* ===== ANNOUNCEMENT BAR ===== */
        .announcement-bar {
            width: 100%;
            background: linear-gradient(90deg, var(--accent), var(--primary));
            color: #fff;
            text-align: center;
            padding: 0.45rem 1rem;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            position: relative;
            z-index: 200;
        }
        .announcement-bar i { margin-right: 0.4rem; }

        /* ===== HERO BANNER ===== */
        .hero-banner {
            position: relative;
            width: 100%;
            min-height: 420px;
            background-color: #0d0d0d;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center 30%;
            opacity: 0.35;
            transition: opacity 0.5s;
        }

        /* Diagonal color overlay */
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                105deg,
                rgba(239,68,68,0.55) 0%,
                rgba(249,115,22,0.25) 45%,
                transparent 75%
            );
        }

        /* Bottom fade to dark */
        .hero-fade-bottom {
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 180px;
            background: linear-gradient(to bottom, transparent, var(--dark));
        }

        .hero-content {
            position: relative;
            z-index: 10;
            padding: 3.5rem 2rem 2.5rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-sub-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--accent);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.3rem 0.8rem;
            border-radius: 3px;
            margin-bottom: 1rem;
        }

        .hero-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3rem, 8vw, 6.5rem);
            line-height: 0.92;
            letter-spacing: 0.03em;
            margin-bottom: 0.8rem;
        }

        .hero-title .word-accent { color: var(--primary); }

        .hero-tagline {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #bbb;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 1.8rem;
        }

        /* Hero Stats */
        .hero-stats {
            display: flex;
            gap: 2.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .hero-stat {
            display: flex;
            flex-direction: column;
        }

        .hero-stat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.4rem;
            color: var(--primary);
            line-height: 1;
        }

        .hero-stat-label {
            font-size: 0.72rem;
            color: #888;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Hero Buttons */
        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--accent);
            color: #fff;
            padding: 0.75rem 1.8rem;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            transition: all 0.25s;
        }

        .btn-hero-primary:hover {
            background: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(239,68,68,0.45);
        }

        .btn-hero-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.5);
            color: #fff;
            padding: 0.72rem 1.8rem;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            transition: all 0.25s;
        }

        .btn-hero-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* ===== NAVIGATION BAR ===== */
        .nav-bar {
            width: 100%;
            background: var(--nav-bg);
            position: sticky;
            top: 0;
            z-index: 150;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .nav-bar::-webkit-scrollbar { display: none; }

        .nav-inner {
            display: flex;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            white-space: nowrap;
        }

        .nav-item {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.85rem 1.1rem;
            color: rgba(255,255,255,0.9);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
            border-bottom: 3px solid transparent;
        }

        .nav-item:hover,
        .nav-item.active {
            color: #fff;
            border-bottom-color: rgba(255,255,255,0.8);
            background: rgba(0,0,0,0.15);
        }

        /* ===== PROFILE CARD ===== */
        .profile-card-wrap {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .profile-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.8rem 2rem;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 1.5rem;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* Red left border accent */
        .profile-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, var(--accent), var(--primary));
        }

        .profile-avatar-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid var(--primary);
            object-fit: cover;
            flex-shrink: 0;
        }

        .profile-avatar-placeholder {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid var(--primary);
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #fff;
        }

        .profile-avatar-label {
            font-size: 0.65rem;
            color: var(--text-muted);
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-align: center;
        }

        .profile-info-col { min-width: 0; }

        .profile-card-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: 0.04em;
            color: #fff;
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .profile-card-desig {
            font-size: 0.82rem;
            color: var(--primary);
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        /* Stats in profile card */
        .pc-stats {
            display: flex;
            gap: 2rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .pc-stat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: #fff;
            line-height: 1;
        }

        .pc-stat-num sup {
            font-size: 1rem;
            color: var(--primary);
        }

        .pc-stat-lbl {
            font-size: 0.7rem;
            color: var(--text-muted);
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        /* Tag pills */
        .pc-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0;
        }

        .pc-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(249,115,22,0.12);
            border: 1px solid rgba(249,115,22,0.35);
            color: var(--primary);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.28rem 0.7rem;
            border-radius: 3px;
        }

        /* Action buttons col */
        .profile-actions-col {
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
            align-items: stretch;
            min-width: 140px;
        }

        .pc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            border-radius: 5px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .pc-btn-red {
            background: var(--accent);
            color: #fff;
        }
        .pc-btn-red:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .pc-btn-outline {
            background: transparent;
            border-color: var(--border);
            color: #ccc;
        }
        .pc-btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .pc-btn-green {
            background: var(--green);
            color: #fff;
        }
        .pc-btn-green:hover {
            background: #16a34a;
            transform: translateY(-1px);
        }

        /* ===== CONTENT WRAPPER ===== */
        .content-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem 3rem;
        }

        /* ===== SECTION HEADER (Cinematic style) ===== */
        .section-num-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-top: 1.5rem;
        }

        .sec-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1rem;
            color: var(--text-muted);
            letter-spacing: 0.06em;
            line-height: 1;
            min-width: 30px;
        }

        .sec-accent-line {
            width: 4px;
            height: 28px;
            background: var(--accent);
            border-radius: 2px;
            flex-shrink: 0;
        }

        .sec-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.9rem;
            letter-spacing: 0.06em;
            color: #fff;
            line-height: 1;
        }

        /* ===== ABOUT BLOCK ===== */
        .about-block {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            font-size: 1rem;
            line-height: 1.85;
            color: #ccc;
            margin-bottom: 2.5rem;
        }

        /* ===== PROGRAMS GRID (image cards) ===== */
        .programs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 0;
            margin-bottom: 2.5rem;
            border-radius: 12px;
            overflow: hidden;
        }

        .prog-card {
            position: relative;
            aspect-ratio: 4/5;
            overflow: hidden;
            cursor: pointer;
        }

        .prog-card-img {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s ease;
        }

        .prog-card:hover .prog-card-img {
            transform: scale(1.08);
        }

        .prog-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(0,0,0,0.05) 0%,
                rgba(0,0,0,0.7) 60%,
                rgba(0,0,0,0.92) 100%
            );
        }

        /* Red badge top-left */
        .prog-badge {
            position: absolute;
            top: 0.7rem;
            left: 0.7rem;
            background: var(--accent);
            color: #fff;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.2rem 0.5rem;
            border-radius: 2px;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .prog-card-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
        }

        .prog-card-cat {
            font-size: 0.65rem;
            color: var(--primary);
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
        }

        .prog-card-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            color: #fff;
            letter-spacing: 0.04em;
            line-height: 1.1;
        }

        .prog-card-price {
            font-size: 0.8rem;
            color: #aaa;
            margin-top: 0.2rem;
        }

        /* ===== FILMSTRIP (Gallery) ===== */
        .filmstrip-wrap {
            margin-bottom: 2.5rem;
        }

        .filmstrip {
            display: flex;
            gap: 0.6rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: var(--primary) var(--card);
        }

        .filmstrip::-webkit-scrollbar { height: 4px; }
        .filmstrip::-webkit-scrollbar-track { background: var(--card); }
        .filmstrip::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 2px; }

        .film-item {
            flex: 0 0 200px;
            aspect-ratio: 4/3;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }

        .film-item:hover {
            transform: scale(1.03);
            border-color: var(--primary);
        }

        .film-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .film-placeholder {
            width: 100%;
            height: 100%;
            background: var(--card2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #444;
            font-size: 1.5rem;
        }

        /* ===== MEMBERSHIP PLANS ===== */
        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.2rem;
            margin-bottom: 2.5rem;
        }

        .plan-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            position: relative;
        }

        .plan-card:hover {
            border-color: var(--primary);
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(249,115,22,0.2);
        }

        .plan-header-img {
            height: 120px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .plan-header-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(13,13,13,0.95));
        }

        .plan-header-content {
            position: absolute;
            bottom: 0.8rem;
            left: 1rem;
            right: 1rem;
        }

        .plan-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.5rem;
            color: #fff;
            letter-spacing: 0.06em;
        }

        .plan-card-body {
            padding: 1.2rem 1.2rem 1.5rem;
        }

        .plan-price-row {
            display: flex;
            align-items: baseline;
            gap: 0.4rem;
            margin-bottom: 1rem;
        }

        .plan-price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.4rem;
            color: var(--primary);
            line-height: 1;
        }

        .plan-dur {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .plan-features { margin-bottom: 1.2rem; }

        .plan-feat {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.45rem 0;
            font-size: 0.88rem;
            color: #ccc;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }

        .plan-feat i { color: var(--green); font-size: 0.85rem; flex-shrink: 0; }

        .plan-cta {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(90deg, var(--accent), var(--primary));
            color: #fff;
            text-align: center;
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.25s;
            border: none;
            cursor: pointer;
        }

        .plan-cta:hover {
            box-shadow: 0 8px 20px rgba(249,115,22,0.4);
            transform: scale(1.02);
        }

        /* ===== TRAINERS ===== */
        .trainers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        .trainer-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            transition: all 0.3s;
        }

        .trainer-card:hover {
            border-color: var(--primary);
            transform: translateY(-4px);
        }

        .trainer-img-wrap {
            height: 160px;
            overflow: hidden;
            position: relative;
        }

        .trainer-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .trainer-card:hover .trainer-img-wrap img {
            transform: scale(1.06);
        }

        .trainer-img-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .trainer-info {
            padding: 0.8rem;
        }

        .trainer-name {
            font-weight: 700;
            font-size: 0.92rem;
            color: #fff;
            margin-bottom: 0.2rem;
        }

        .trainer-meta {
            font-size: 0.75rem;
            color: var(--primary);
        }

        /* ===== SCHEDULE ===== */
        .schedule-list {
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
            margin-bottom: 2.5rem;
        }

        .sched-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--card);
            border: 1px solid var(--border);
            border-left: 3px solid var(--accent);
            border-radius: 0 8px 8px 0;
            padding: 1rem 1.5rem;
            transition: all 0.2s;
        }

        .sched-item:hover {
            border-left-color: var(--primary);
            background: var(--card2);
            transform: translateX(4px);
        }

        .sched-left { display: flex; align-items: center; gap: 1rem; }

        .sched-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            background: var(--accent);
            flex-shrink: 0;
        }

        .sched-class {
            font-weight: 700;
            font-size: 0.95rem;
            color: #fff;
        }

        .sched-day {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 0.1rem;
        }

        .sched-time {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.2rem;
            color: var(--primary);
            letter-spacing: 0.04em;
        }

        /* ===== DIET PLANS ===== */
        .diet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.2rem;
            margin-bottom: 2.5rem;
        }

        .diet-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            position: relative;
        }

        .diet-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--green), #16a34a);
        }

        .diet-card:hover {
            border-color: var(--green);
            transform: translateY(-4px);
        }

        .diet-card-body {
            padding: 1.4rem;
        }

        .diet-icon {
            width: 44px; height: 44px;
            background: rgba(34,197,94,0.12);
            border: 1px solid rgba(34,197,94,0.3);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 1.2rem;
            margin-bottom: 0.8rem;
        }

        .diet-title {
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
            margin-bottom: 0.4rem;
        }

        .diet-meta {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* ===== TRANSFORMATIONS ===== */
        .transform-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.2rem;
            margin-bottom: 2.5rem;
        }

        .transform-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .transform-card:hover {
            border-color: var(--primary);
            transform: scale(1.02);
        }

        .transform-imgs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px;
            background: var(--primary);
        }

        .transform-img {
            aspect-ratio: 3/4;
            position: relative;
            overflow: hidden;
            background: var(--card2);
        }

        .transform-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .transform-label {
            position: absolute;
            bottom: 0.4rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.85);
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            white-space: nowrap;
        }

        .transform-foot {
            padding: 0.8rem 1rem;
            text-align: center;
        }

        .transform-result {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.1rem;
            color: var(--primary);
            letter-spacing: 0.04em;
        }

        /* ===== VIDEOS ===== */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.2rem;
            margin-bottom: 2.5rem;
        }

        .video-card {
            aspect-ratio: 16/9;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--border);
            position: relative;
            transition: all 0.3s;
        }

        .video-card:hover {
            border-color: var(--accent);
            transform: scale(1.02);
        }

        .video-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-play-btn {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.3);
            transition: background 0.2s;
        }

        .video-card:hover .video-play-btn {
            background: rgba(239,68,68,0.3);
        }

        .video-play-btn i {
            font-size: 2.5rem;
            color: #fff;
            filter: drop-shadow(0 0 12px rgba(0,0,0,0.8));
        }

        .video-placeholder-box {
            width: 100%;
            height: 100%;
            background: var(--card);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #444;
            font-size: 2.5rem;
        }

        /* ===== CTA SECTION (Cinematic "LIGHTS. CAMERA. ACTION!" inspired) ===== */
        .cta-section {
            position: relative;
            overflow: hidden;
            margin: 2rem 0;
            border-radius: 14px;
        }

        .cta-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center 40%;
            opacity: 0.15;
        }

        .cta-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg, var(--dark) 0%, rgba(13,13,13,0.85) 50%, rgba(13,13,13,0.6) 100%);
        }

        .cta-inner {
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            padding: 3.5rem 2.5rem;
            align-items: center;
        }

        .cta-left {}

        .cta-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--accent);
            color: #fff;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.25rem 0.7rem;
            border-radius: 3px;
            margin-bottom: 1rem;
        }

        .cta-headline {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3rem, 6vw, 5.5rem);
            line-height: 0.9;
            letter-spacing: 0.02em;
            margin-bottom: 1.2rem;
        }

        .cta-headline .cta-accent { color: var(--primary); }

        .cta-desc {
            font-size: 0.9rem;
            color: #aaa;
            line-height: 1.7;
            margin-bottom: 1.8rem;
            max-width: 380px;
        }

        .cta-btns {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .cta-right {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        /* Contact Info Items */
        .ci-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.9rem 1.2rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .ci-item:hover {
            background: rgba(249,115,22,0.08);
            border-color: var(--primary);
            transform: translateX(4px);
        }

        .ci-icon {
            width: 40px; height: 40px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .ci-icon.red   { background: var(--accent); }
        .ci-icon.orange{ background: var(--primary); }
        .ci-icon.green { background: var(--green); }
        .ci-icon.blue  { background: #3b82f6; }

        .ci-text {
            flex: 1;
            min-width: 0;
        }

        .ci-label {
            font-size: 0.65rem;
            color: var(--text-muted);
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.1rem;
        }

        .ci-value {
            font-size: 0.9rem;
            color: #fff;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ===== FOLLOW REEL / SOCIAL ===== */
        .social-section {
            text-align: center;
            padding: 3rem 1.5rem 2rem;
        }

        .social-eyebrow {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.3rem;
        }

        .social-eyebrow span {
            color: var(--primary);
        }

        .social-heading {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            letter-spacing: 0.08em;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .soc-btn {
            width: 52px; height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #fff;
            text-decoration: none;
            transition: all 0.25s;
        }

        .soc-btn:hover {
            transform: scale(1.15) translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }

        .soc-facebook  { background: #1877f2; }
        .soc-instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
        .soc-youtube   { background: #ff0000; }
        .soc-linkedin  { background: #0077b5; }
        .soc-twitter   { background: #1da1f2; }

        /* ===== FOOTER ===== */
        .site-footer {
            background: #080808;
            border-top: 1px solid var(--border);
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand {
            display: flex;
            flex-direction: column;
        }

        .footer-brand-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.5rem;
            letter-spacing: 0.06em;
            color: #fff;
            line-height: 1;
        }

        .footer-brand-name span { color: var(--primary); }

        .footer-brand-sub {
            font-size: 0.65rem;
            color: var(--text-muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .footer-copy {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .footer-powered {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .footer-powered a {
            color: var(--primary);
            text-decoration: none;
        }

        /* ===== DIVIDER ===== */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
            margin: 0.5rem 0 2rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .profile-card {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .profile-avatar-col { flex-direction: row; justify-content: center; }
            .pc-stats { justify-content: center; }
            .pc-tags { justify-content: center; }
            .profile-actions-col {
                flex-direction: row;
                flex-wrap: wrap;
                min-width: unset;
                justify-content: center;
            }
            .cta-inner {
                grid-template-columns: 1fr;
                padding: 2rem 1.5rem;
            }
            .cta-headline { font-size: 3rem; }
        }

        @media (max-width: 600px) {
            .hero-content { padding: 3rem 1.2rem 2rem; }
            .hero-stats { gap: 1.5rem; }
            .hero-stat-num { font-size: 1.8rem; }
            .programs-grid { grid-template-columns: repeat(2, 1fr); }
            .prog-card { aspect-ratio: 3/4; }
            .plans-grid { grid-template-columns: 1fr; }
            .site-footer { flex-direction: column; align-items: center; text-align: center; }
            .nav-inner { padding: 0 0.5rem; }
            .nav-item { padding: 0.85rem 0.7rem; font-size: 0.7rem; }
        }

        @media (max-width: 400px) {
            .programs-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')

    <!-- ===== ANNOUNCEMENT BAR ===== -->
    <div class="announcement-bar">
        <i class="fas fa-bolt"></i>
        Transform Your Body &amp; Mind — Book a Free Consultation Today!
    </div>

    <!-- ===== HERO BANNER ===== -->
    <section class="hero-banner" id="home">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-fade-bottom"></div>

        <div class="hero-content">
            <div class="hero-sub-label">
                <i class="fas fa-fire"></i> Fitness &amp; Wellness Studio
            </div>

            @if($userdata->isFeatureVisible('name'))
            <h1 class="hero-title">
                <span class="word-accent">{{ explode(' ', $userdata->name)[0] ?? 'FIT' }}</span>
                {{ implode(' ', array_slice(explode(' ', $userdata->name), 1)) }}
            </h1>
            @else
            <h1 class="hero-title"><span class="word-accent">Elite</span> Fitness</h1>
            @endif

            @if($userdata->isFeatureVisible('designation') && $userdata->designation)
            <p class="hero-tagline">{{ $userdata->designation }}</p>
            @else
            <p class="hero-tagline">Certified Personal Trainer &amp; Nutrition Coach</p>
            @endif

            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-num">10+</div>
                    <div class="hero-stat-label">Years</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">500+</div>
                    <div class="hero-stat-label">Clients</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">200+</div>
                    <div class="hero-stat-label">Transformations</div>
                </div>
              
            </div>

            <div class="hero-actions">
                @if($userdata->isFeatureVisible('contact_number') && $userdata->contact)
                <a href="tel:{{ $userdata->contact }}" class="btn-hero-primary">
                    <i class="fas fa-phone-alt"></i> Book A Session
                </a>
                @endif
                @if($userdata->isFeatureVisible('whatsapp') && $userdata->contact)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->contact) }}" target="_blank" class="btn-hero-outline">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ===== NAVIGATION BAR ===== -->
    <nav class="nav-bar">
        <div class="nav-inner">
            <a href="#home"      class="nav-item active"><i class="fas fa-home"></i> Home</a>
            <a href="#about"     class="nav-item"><i class="fas fa-user"></i> About</a>
            <a href="#programs"  class="nav-item"><i class="fas fa-dumbbell"></i> Programs</a>
            <a href="#membership" class="nav-item"><i class="fas fa-tag"></i> Plans</a>
            @if(isset($fitnessTrainers) && $fitnessTrainers->count() > 0)
            <a href="#trainers"  class="nav-item"><i class="fas fa-user-ninja"></i> Trainers</a>
            @endif
            @if(isset($fitnessClasses) && $fitnessClasses->count() > 0)
            <a href="#schedule"  class="nav-item"><i class="fas fa-calendar-alt"></i> Schedule</a>
            @endif
            @if(isset($dietPlans) && $dietPlans->count() > 0)
            <a href="#diet"      class="nav-item"><i class="fas fa-apple-alt"></i> Diet</a>
            @endif
            <a href="#contact"   class="nav-item"><i class="fas fa-envelope"></i> Contact</a>
        </div>
    </nav>

    <!-- ===== PROFILE CARD ===== -->
    <div class="profile-card-wrap">
        <div class="profile-card">

            <!-- Avatar -->
            <div class="profile-avatar-col">
                @if($userdata->isFeatureVisible('profile_photo'))
                    @if(isset($userdata->profile) && $userdata->profile)
                        <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}"
                             alt="{{ $userdata->name }}" class="profile-avatar">
                    @else
                        <div class="profile-avatar-placeholder">
                            <i class="fas fa-dumbbell"></i>
                        </div>
                    @endif
                @else
                    <div class="profile-avatar-placeholder">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                @endif
                <span class="profile-avatar-label">Trainer</span>
            </div>

            <!-- Info -->
            <div class="profile-info-col">
                @if($userdata->isFeatureVisible('name'))
                <div class="profile-card-name">{{ $userdata->name }}</div>
                @endif
                @if($userdata->isFeatureVisible('designation') && $userdata->designation)
                <div class="profile-card-desig">{{ $userdata->designation }}</div>
                @endif

                <div class="pc-stats">
                    <div>
                        <div class="pc-stat-num">10<sup>+</sup></div>
                        <div class="pc-stat-lbl">Years</div>
                    </div>
                    <div>
                        <div class="pc-stat-num">500<sup>+</sup></div>
                        <div class="pc-stat-lbl">Clients</div>
                    </div>
                    <div>
                        <div class="pc-stat-num">200<sup>+</sup></div>
                        <div class="pc-stat-lbl">Transforms</div>
                    </div>
                    <div>
                        <div class="pc-stat-num">25<sup>+</sup></div>
                        <div class="pc-stat-lbl">Awards</div>
                    </div>
                </div>

                <div class="pc-tags">
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Weight Loss</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Muscle Gain</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Nutrition</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Yoga</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Cardio</span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="profile-actions-col">
                @if($userdata->isFeatureVisible('contact_number') && $userdata->contact)
                <a href="tel:{{ $userdata->contact }}" class="pc-btn pc-btn-red">
                    <i class="fas fa-phone-alt"></i> Contact
                </a>
                @endif
                @if($userdata->isFeatureVisible('email') && $userdata->email)
                <a href="mailto:{{ $userdata->email }}" class="pc-btn pc-btn-outline">
                    <i class="fas fa-envelope"></i> Email
                </a>
                @endif
                @if($userdata->isFeatureVisible('whatsapp') && $userdata->contact)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->contact) }}" target="_blank" class="pc-btn pc-btn-green">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- ===== CONTENT ===== -->
    <div class="content-wrap">

        <!-- 01 ABOUT -->
        @if($userdata->isFeatureVisible('bio') && $userdata->about_us)
        <div id="about">
            <div class="section-num-header">
                <span class="sec-num">01</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">About Me</h2>
            </div>
            <div class="about-block">{{ $userdata->about_us }}</div>
        </div>
        @endif

        <!-- 02 TRAINING PROGRAMS (image cards) -->
        @if($userdata->isFeatureVisible('services'))
        <div id="programs">
            <div class="section-num-header">
                <span class="sec-num">02</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">Training Programs</h2>
            </div>

            @php
            $defaultPrograms = [
                [
                    'name' => 'Weight Loss',
                    'cat'  => 'Fat Burn Program',
                    'img'  => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=600&q=80',
                    'icon' => 'fas fa-fire'
                ],
                [
                    'name' => 'Muscle Building',
                    'cat'  => 'Strength Program',
                    'img'  => 'https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?auto=format&fit=crop&w=600&q=80',
                    'icon' => 'fas fa-dumbbell'
                ],
                [
                    'name' => 'Cardio Training',
                    'cat'  => 'Endurance Program',
                    'img'  => 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&w=600&q=80',
                    'icon' => 'fas fa-running'
                ],
                [
                    'name' => 'Yoga & Flex',
                    'cat'  => 'Mind-Body Program',
                    'img'  => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=600&q=80',
                    'icon' => 'fas fa-spa'
                ],
                [
                    'name' => 'Personal Training',
                    'cat'  => '1-on-1 Program',
                    'img'  => 'https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?auto=format&fit=crop&w=600&q=80',
                    'icon' => 'fas fa-user-check'
                ],
            ];

            $programImages = [
                'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?auto=format&fit=crop&w=600&q=80',
            ];
            @endphp

            <div class="programs-grid">
                @if(isset($fitnessPrograms) && $fitnessPrograms->count() > 0)
                    @foreach($fitnessPrograms as $i => $program)
                    <div class="prog-card">
                        <div class="prog-card-img" style="background-image:url('{{ $programImages[$i % count($programImages)] }}')"></div>
                        <div class="prog-card-overlay"></div>
                        <div class="prog-badge"><i class="fas fa-bolt"></i> Program</div>
                        <div class="prog-card-bottom">
                            <div class="prog-card-cat">Training Service</div>
                            <div class="prog-card-name">{{ $program->program_name }}</div>
                            @if($program->price)
                            <div class="prog-card-price">Rs.{{ number_format($program->price, 0) }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    @foreach($defaultPrograms as $prog)
                    <div class="prog-card">
                        <div class="prog-card-img" style="background-image:url('{{ $prog['img'] }}')"></div>
                        <div class="prog-card-overlay"></div>
                        <div class="prog-badge"><i class="fas fa-bolt"></i> Program</div>
                        <div class="prog-card-bottom">
                            <div class="prog-card-cat">{{ $prog['cat'] }}</div>
                            <div class="prog-card-name">{{ $prog['name'] }}</div>
                        </div>
                    </div>
                    @endforeach
                    @if(isset($professions) && $professions->count() > 0)
                        @foreach($professions as $i => $prog)
                        <div class="prog-card">
                            <div class="prog-card-img" style="background-image:url('{{ $programImages[$i % count($programImages)] }}')"></div>
                            <div class="prog-card-overlay"></div>
                            <div class="prog-badge"><i class="fas fa-bolt"></i> Specialty</div>
                            <div class="prog-card-bottom">
                                <div class="prog-card-cat">Specialty</div>
                                <div class="prog-card-name">{{ $prog->name }}</div>
                                @if(isset($prog->description) && $prog->description)
                                <div class="prog-card-price">{{ Str::limit($prog->description, 40) }}</div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
        @endif

        <!-- 03 PORTFOLIO FILMSTRIP (Gallery) -->
        @if($userdata->isFeatureVisible('gallery') && isset($gallery) && $gallery->count() > 0)
        <div>
            <div class="section-num-header">
                <span class="sec-num">03</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">Portfolio Filmstrip</h2>
            </div>
            <div class="filmstrip-wrap">
                <div class="filmstrip">
                    @foreach($gallery as $img)
                    <div class="film-item">
                        <img src="{{ url('uploads/user_gallery/'.$img->image) }}" alt="Gallery">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- 04 MEMBERSHIP PLANS -->
        <div id="membership">
            <div class="section-num-header">
                <span class="sec-num">04</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">Membership Plans</h2>
            </div>

            @php
            $planImages = [
                'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1594737625785-a6cbdabd333c?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1534258936925-c58bed479fcb?auto=format&fit=crop&w=600&q=80',
            ];
            @endphp

            <div class="plans-grid">
                @if(isset($fitnessMemberships) && $fitnessMemberships->count() > 0)
                    @foreach($fitnessMemberships as $i => $plan)
                    <div class="plan-card">
                        <div class="plan-header-img" style="background-image:url('{{ $planImages[$i % count($planImages)] }}')">
                            <div class="plan-header-img-overlay"></div>
                            <div class="plan-header-content">
                                <div class="plan-name">{{ $plan->plan_name }}</div>
                            </div>
                        </div>
                        <div class="plan-card-body">
                            <div class="plan-price-row">
                                <div class="plan-price">{{ $plan->price ? 'Rs.'.number_format($plan->price, 0) : 'Enquire' }}</div>
                                @if($plan->duration_months)
                                <div class="plan-dur">/{{ $plan->duration_months }} months</div>
                                @endif
                            </div>
                            <div class="plan-features">
                                @if(!empty($plan->features))
                                    @foreach($plan->features as $feat)
                                    <div class="plan-feat"><i class="fas fa-check-circle"></i>{{ $feat }}</div>
                                    @endforeach
                                @else
                                    <div class="plan-feat"><i class="fas fa-check-circle"></i> Full Gym Access</div>
                                    <div class="plan-feat"><i class="fas fa-check-circle"></i> Trainer Support</div>
                                @endif
                            </div>
                            <a href="{{ url('/' . $userdata->slug . '/fitness-booking') }}" class="plan-cta">Join Now</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    @php
                    $defaultPlans = [
                        ['name'=>'Basic','price'=>'Rs.2,999','dur'=>'/month','feats'=>['Gym Access','Basic Equipment','Locker Facility'],'img'=>$planImages[0]],
                        ['name'=>'Premium','price'=>'Rs.4,999','dur'=>'/month','feats'=>['All Basic Features','Personal Trainer','Diet Plan','Steam & Sauna'],'img'=>$planImages[1]],
                        ['name'=>'Elite','price'=>'Rs.7,999','dur'=>'/month','feats'=>['All Premium Features','Dedicated Trainer','Supplements Guide','Priority Support'],'img'=>$planImages[2]],
                    ];
                    @endphp
                    @foreach($defaultPlans as $plan)
                    <div class="plan-card">
                        <div class="plan-header-img" style="background-image:url('{{ $plan['img'] }}')">
                            <div class="plan-header-img-overlay"></div>
                            <div class="plan-header-content">
                                <div class="plan-name">{{ $plan['name'] }}</div>
                            </div>
                        </div>
                        <div class="plan-card-body">
                            <div class="plan-price-row">
                                <div class="plan-price">{{ $plan['price'] }}</div>
                                <div class="plan-dur">{{ $plan['dur'] }}</div>
                            </div>
                            <div class="plan-features">
                                @foreach($plan['feats'] as $f)
                                <div class="plan-feat"><i class="fas fa-check-circle"></i> {{ $f }}</div>
                                @endforeach
                            </div>
                            <a href="#contact" class="plan-cta">Join Now</a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- 05 TRAINERS -->
        @if(isset($fitnessTrainers) && $fitnessTrainers->count() > 0)
        <div id="trainers">
            <div class="section-num-header">
                <span class="sec-num">05</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">Our Trainers</h2>
            </div>
            <div class="trainers-grid">
                @foreach($fitnessTrainers->take(6) as $trainer)
                <div class="trainer-card">
                    <div class="trainer-img-wrap">
                        @if($trainer->photo)
                            <img src="{{ url('uploads/fitness/trainers/'.$trainer->photo) }}" alt="{{ $trainer->trainer_name }}">
                        @else
                            <div class="trainer-img-placeholder">{{ strtoupper(substr($trainer->trainer_name,0,2)) }}</div>
                        @endif
                    </div>
                    <div class="trainer-info">
                        <div class="trainer-name">{{ $trainer->trainer_name }}</div>
                        <div class="trainer-meta">
                            {{ $trainer->experience_years ? $trainer->experience_years . '+ yrs exp' : 'Certified Trainer' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 06 CLASS SCHEDULE -->
        @if(isset($fitnessClasses) && $fitnessClasses->count() > 0)
        <div id="schedule">
            <div class="section-num-header">
                <span class="sec-num">06</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">Class Schedule</h2>
            </div>
            <div class="schedule-list">
                @foreach($fitnessClasses->take(8) as $class)
                <div class="sched-item">
                    <div class="sched-left">
                        <div class="sched-dot"></div>
                        <div>
                            <div class="sched-class">{{ $class->class_name }}</div>
                            @if($class->schedule_day)
                            <div class="sched-day">{{ ucfirst($class->schedule_day) }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="sched-time">
                        {{ $class->start_time ? \Carbon\Carbon::createFromFormat('H:i:s', $class->start_time)->format('h:i A') : 'TBD' }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 07 DIET PLANS -->
        @if(isset($dietPlans) && $dietPlans->count() > 0)
        <div id="diet">
            <div class="section-num-header">
                <span class="sec-num">07</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">Diet Plans</h2>
            </div>
            <div class="diet-grid">
                @foreach($dietPlans->take(4) as $plan)
                <div class="diet-card">
                    <div class="diet-card-body">
                        <div class="diet-icon"><i class="fas fa-leaf"></i></div>
                        <div class="diet-title">{{ $plan->plan_name }}</div>
                        <div class="diet-meta">
                            {{ $plan->goal ?? 'Personalized nutrition' }}
                            @if($plan->daily_calories) · {{ $plan->daily_calories }} cal/day @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 08 SUCCESS STORIES / TRANSFORMATIONS -->
        @if(isset($fitnessTransformations) && $fitnessTransformations->count() > 0)
        <div id="transformations">
            <div class="section-num-header">
                <span class="sec-num">08</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">Success Stories</h2>
            </div>
            <div class="transform-grid">
                @foreach($fitnessTransformations->take(4) as $entry)
                <div class="transform-card">
                    <div class="transform-imgs">
                        <div class="transform-img">
                            @if($entry->before_photo)
                                <img src="{{ url('uploads/fitness/transformations/'.$entry->before_photo) }}" alt="Before">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#555;font-size:0.8rem;font-weight:700;">BEFORE</div>
                            @endif
                            <span class="transform-label">Before</span>
                        </div>
                        <div class="transform-img">
                            @if($entry->after_photo)
                                <img src="{{ url('uploads/fitness/transformations/'.$entry->after_photo) }}" alt="After">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#555;font-size:0.8rem;font-weight:700;">AFTER</div>
                            @endif
                            <span class="transform-label">After</span>
                        </div>
                    </div>
                    <div class="transform-foot">
                        <div class="transform-result">
                            {{ $entry->weight_lost_kg ? '-' . $entry->weight_lost_kg . ' Kg' : 'Amazing Transformation' }}
                            @if($entry->duration_months) in {{ $entry->duration_months }} months @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 09 VIDEOS -->
        @elseif($userdata->isFeatureVisible('videos') && isset($videos) && $videos->count() > 0)
        <div id="transformations">
            <div class="section-num-header">
                <span class="sec-num">08</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">Success Stories</h2>
            </div>
            <div class="transform-grid">
                @foreach($gallery->take(4) as $image)
                <div class="transform-card">
                    <div class="transform-imgs">
                        <div class="transform-img">
                            <img src="{{ url('uploads/user_gallery/'.$image->image) }}" alt="Before">
                            <span class="transform-label">Before</span>
                        </div>
                        <div class="transform-img">
                            <img src="{{ url('uploads/user_gallery/'.$image->image) }}" alt="After">
                            <span class="transform-label">After</span>
                        </div>
                    </div>
                    <div class="transform-foot">
                        <div class="transform-result">Amazing Transformation</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($userdata->isFeatureVisible('videos') && isset($videos) && $videos->count() > 0)
        <div id="videos">
            <div class="section-num-header">
                <span class="sec-num">09</span>
                <div class="sec-accent-line"></div>
                <h2 class="sec-title">Workout Videos</h2>
            </div>
            <div class="video-grid">
                @foreach($videos as $video)
                @php
                    $videoUrl = trim((string) ($video->video_link ?? $video->video ?? ''));
                    $thumbUrl = '';
                    if ($videoUrl && preg_match('~(youtu\.be/|v=)([^&?/]{11})~', $videoUrl, $matches)) {
                        $thumbUrl = 'https://img.youtube.com/vi/' . $matches[2] . '/hqdefault.jpg';
                    }
                @endphp
                <a href="{{ $videoUrl }}" target="_blank" rel="noopener noreferrer" class="video-card">
                    @if($thumbUrl)
                        <img src="{{ $thumbUrl }}" alt="Workout Video">
                        <div class="video-play-btn"><i class="fas fa-play-circle"></i></div>
                    @else
                        <div class="video-placeholder-box"><i class="fas fa-play-circle"></i></div>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- ===== CTA SECTION — "SWEAT. GRIND. CONQUER." ===== -->
        <div id="contact" class="cta-section">
            <div class="cta-bg"></div>
            <div class="cta-overlay"></div>
            <div class="cta-inner">

                <!-- Left: Big motivational text -->
                <div class="cta-left">
                    <div class="cta-eyebrow"><i class="fas fa-fire-alt"></i> Ready to Transform</div>
                    <h2 class="cta-headline">
                        SWEAT.<br>
                        GRIND.<br>
                        <span class="cta-accent">CONQUER!</span>
                    </h2>
                    <p class="cta-desc">
                        Let's bring your fitness vision to life. Whether it's weight loss,
                        muscle gain, or complete wellness — we're ready to push you to your limit.
                    </p>
                    <div class="cta-btns">
                        @if($userdata->isFeatureVisible('contact_number') && $userdata->contact)
                        <a href="tel:{{ $userdata->contact }}" class="btn-hero-primary">
                            <i class="fas fa-phone-alt"></i> Start A Project
                        </a>
                        @endif
                        @if($userdata->isFeatureVisible('whatsapp') && $userdata->contact)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->contact) }}" target="_blank" class="btn-hero-outline">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Right: Contact info items -->
                <div class="cta-right">
                    @if($userdata->isFeatureVisible('contact_number') && $userdata->contact)
                    <a href="tel:{{ $userdata->contact }}" class="ci-item">
                        <div class="ci-icon red"><i class="fas fa-phone-alt"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Call Us</div>
                            <div class="ci-value">{{ $userdata->contact }}</div>
                        </div>
                    </a>
                    @endif

                    @if($userdata->isFeatureVisible('email') && $userdata->email)
                    <a href="mailto:{{ $userdata->email }}" class="ci-item">
                        <div class="ci-icon orange"><i class="fas fa-envelope"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Email</div>
                            <div class="ci-value">{{ $userdata->email }}</div>
                        </div>
                    </a>
                    @endif

                    @if($userdata->isFeatureVisible('address') && $userdata->address)
                    <div class="ci-item">
                        <div class="ci-icon blue"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Studio Location</div>
                            <div class="ci-value">{{ $userdata->address }}</div>
                        </div>
                    </div>
                    @endif

                    @if($userdata->isFeatureVisible('whatsapp') && $userdata->contact)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->contact) }}" target="_blank" class="ci-item">
                        <div class="ci-icon green"><i class="fab fa-whatsapp"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">WhatsApp</div>
                            <div class="ci-value">{{ $userdata->contact }}</div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>

    </div><!-- end content-wrap -->

    <!-- ===== FOLLOW OUR REEL ===== -->
    @if($userdata->isFeatureVisible('social_media'))
    <div class="social-section">
        <div class="social-eyebrow">Follow Our <span>Reel</span></div>
        <div class="social-heading">STAY CONNECTED</div>
        <div class="social-icons">
            @if($userdata->isFeatureVisible('facebook') && isset($social->facebook) && $social->facebook)
            <a href="{{ $social->facebook }}" target="_blank" class="soc-btn soc-facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            @endif
            @if($userdata->isFeatureVisible('instagram') && isset($social->instagram) && $social->instagram)
            <a href="{{ $social->instagram }}" target="_blank" class="soc-btn soc-instagram">
                <i class="fab fa-instagram"></i>
            </a>
            @endif
            @if($userdata->isFeatureVisible('youtube') && isset($social->youtube) && $social->youtube)
            <a href="{{ $social->youtube }}" target="_blank" class="soc-btn soc-youtube">
                <i class="fab fa-youtube"></i>
            </a>
            @endif
            @if($userdata->isFeatureVisible('linkedin') && isset($social->linkedin) && $social->linkedin)
            <a href="{{ $social->linkedin }}" target="_blank" class="soc-btn soc-linkedin">
                <i class="fab fa-linkedin-in"></i>
            </a>
            @endif
        </div>
    </div>
    @endif

    <!-- ===== FOOTER ===== -->
    <footer class="site-footer">
        <div class="footer-brand">
            @if($userdata->isFeatureVisible('name'))
            <div class="footer-brand-name">
                {{ explode(' ', $userdata->name)[0] ?? 'GYM' }}
                <span>{{ implode(' ', array_slice(explode(' ', $userdata->name), 1)) }}</span>
            </div>
            @endif
            <div class="footer-brand-sub">Fitness &amp; Wellness Studio</div>
        </div>
        <div class="footer-copy">© {{ date('Y') }} All Rights Reserved</div>
        <div class="footer-powered">Powered by <a href="#">FitPro</a></div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id   ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview      ?? false
    ])
</body>
</html>