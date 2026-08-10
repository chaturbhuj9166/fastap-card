<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Lawyer' }} - Legal Profile</title>

    @php
        $websetting = App\Models\websetting::first();

        if (isset($isPreview) && $isPreview) {
            $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client'], 1);
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client'], 1);
            }
        }

        $themeColor = $theme->color ?? '#1e3a8a';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Barlow+Condensed:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --navy:    #1e3a8a;
            --navy2:   #1e293b;
            --gold:    #d97706;
            --gold2:   #f59e0b;
            --burg:    #991b1b;
            --dark:    #0c0f1a;
            --card-bg: #ffffff;
            --page-bg: #f1f5f9;
            --border:  #e2e8f0;
            --muted:   #64748b;
            --text:    #1e293b;
        }

        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--page-bg);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ============================
           ANNOUNCEMENT BAR
        ============================ */
        .announce-bar {
            width: 100%;
            background: linear-gradient(90deg, var(--navy), var(--burg));
            color: #fff;
            text-align: center;
            padding: 0.45rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            position: relative;
            z-index: 300;
        }
        .announce-bar i { margin-right: 0.4rem; color: var(--gold2); }

        /* ============================
           HERO BANNER
        ============================ */
        .hero {
            position: relative;
            width: 100%;
            min-height: 460px;
            background: var(--dark);
            overflow: hidden;
            display: flex;
            align-items: flex-end;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center 20%;
            opacity: 0.28;
        }

        /* Diagonal navy→dark overlay */
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                110deg,
                rgba(30,58,138,0.72) 0%,
                rgba(30,41,59,0.45) 50%,
                transparent 80%
            );
        }

        /* Gold stripe at very top */
        .hero-top-stripe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 4px;
            background: linear-gradient(90deg, var(--gold), var(--gold2), var(--burg));
        }

        /* Bottom fade */
        .hero-fade {
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 200px;
            background: linear-gradient(to bottom, transparent, var(--page-bg));
        }

        .hero-content {
            position: relative;
            z-index: 10;
            padding: 4rem 2rem 3rem;
            max-width: 1150px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gold);
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.3rem 0.85rem;
            border-radius: 3px;
            margin-bottom: 1.1rem;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.8rem, 7vw, 6rem);
            font-weight: 900;
            line-height: 0.94;
            letter-spacing: -0.01em;
            color: #fff;
            margin-bottom: 0.9rem;
        }

        .hero-title .accent { color: var(--gold2); }

        .hero-sub {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: rgba(255,255,255,0.65);
            letter-spacing: 0.18em;
            text-transform: uppercase;
            margin-bottom: 2rem;
        }

        /* Hero stats */
        .hero-stats {
            display: flex;
            gap: 2.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .h-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--gold2);
            line-height: 1;
        }

        .h-stat-lbl {
            font-size: 0.68rem;
            color: rgba(255,255,255,0.55);
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 0.1rem;
        }

        /* Hero buttons */
        .hero-btns {
            display: flex;
            gap: 0.9rem;
            flex-wrap: wrap;
        }

        .btn-solid {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            background: var(--gold);
            color: #fff;
            padding: 0.8rem 1.9rem;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.25s;
            border: 2px solid var(--gold);
        }

        .btn-solid:hover {
            background: var(--gold2);
            border-color: var(--gold2);
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(217,119,6,0.45);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            background: transparent;
            color: #fff;
            padding: 0.78rem 1.9rem;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.45);
            transition: all 0.25s;
        }

        .btn-ghost:hover {
            border-color: var(--gold2);
            color: var(--gold2);
            transform: translateY(-2px);
        }

        /* ============================
           NAVIGATION BAR
        ============================ */
        .nav-bar {
            width: 100%;
            background: var(--navy);
            position: sticky;
            top: 0;
            z-index: 200;
            overflow-x: auto;
            scrollbar-width: none;
            border-bottom: 3px solid var(--gold);
        }
        .nav-bar::-webkit-scrollbar { display: none; }

        .nav-inner {
            display: flex;
            max-width: 1150px;
            margin: 0 auto;
            padding: 0 1rem;
            white-space: nowrap;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.88rem 1.1rem;
            color: rgba(255,255,255,0.8);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            margin-bottom: -3px;
            transition: all 0.2s;
        }

        .nav-link i { color: var(--gold2); font-size: 0.7rem; }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
            border-bottom-color: var(--gold2);
            background: rgba(255,255,255,0.06);
        }

        /* ============================
           PROFILE CARD
        ============================ */
        .profile-card-wrap {
            max-width: 1150px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .profile-card {
            background: #fff;
            border-radius: 14px;
            padding: 2rem 2.2rem;
            box-shadow: 0 8px 32px rgba(30,58,138,0.12);
            border-top: 4px solid var(--gold);
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 2rem;
            align-items: center;
            position: relative;
        }

        /* subtle navy left bar */
        .profile-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, var(--navy), var(--burg));
            border-radius: 14px 0 0 14px;
        }

        /* Avatar */
        .pc-avatar-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .pc-avatar {
            width: 92px;
            height: 92px;
            border-radius: 50%;
            border: 3px solid var(--gold);
            object-fit: cover;
            box-shadow: 0 6px 20px rgba(217,119,6,0.3);
        }

        .pc-avatar-placeholder {
            width: 92px;
            height: 92px;
            border-radius: 50%;
            border: 3px solid var(--gold);
            background: linear-gradient(135deg, var(--navy), var(--burg));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2rem;
        }

        .pc-avatar-lbl {
            font-size: 0.62rem;
            color: var(--muted);
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        /* Info */
        .pc-info { min-width: 0; }

        .pc-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.1;
            margin-bottom: 0.25rem;
        }

        .pc-desig {
            font-size: 0.78rem;
            color: var(--gold);
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        /* Stats inside card */
        .pc-stats {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 0.9rem;
        }

        .pc-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--burg);
            line-height: 1;
        }

        .pc-stat-num sup {
            font-size: 0.9rem;
            color: var(--gold);
        }

        .pc-stat-lbl {
            font-size: 0.65rem;
            color: var(--muted);
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        /* Tag pills */
        .pc-tags {
            display: flex;
            gap: 0.45rem;
            flex-wrap: wrap;
        }

        .pc-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: var(--navy);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.26rem 0.65rem;
            border-radius: 3px;
        }

        .pc-tag i { color: var(--gold); }

        /* Buttons col */
        .pc-btns-col {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            min-width: 140px;
        }

        .pc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            border-radius: 5px;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .pc-btn-navy {
            background: var(--navy);
            color: #fff;
        }
        .pc-btn-navy:hover {
            background: #1e40af;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(30,58,138,0.35);
        }

        .pc-btn-gold {
            background: var(--gold);
            color: #fff;
        }
        .pc-btn-gold:hover {
            background: var(--gold2);
            transform: translateY(-1px);
        }

        .pc-btn-outline {
            background: transparent;
            border-color: var(--border);
            color: var(--muted);
        }
        .pc-btn-outline:hover {
            border-color: var(--navy);
            color: var(--navy);
        }

        /* ============================
           CONTENT WRAPPER
        ============================ */
        .content-wrap {
            max-width: 1150px;
            margin: 0 auto;
            padding: 0 1.5rem 3rem;
        }

        /* ============================
           SECTION NUMBER HEADERS
           (Cinematic style)
        ============================ */
        .sec-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.8rem;
            padding-top: 1.5rem;
        }

        .sec-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--muted);
            letter-spacing: 0.06em;
            min-width: 28px;
        }

        .sec-bar {
            width: 4px;
            height: 28px;
            background: var(--gold);
            border-radius: 2px;
            flex-shrink: 0;
        }

        .sec-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1;
        }

        /* ============================
           ABOUT BLOCK
        ============================ */
        .about-block {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            font-size: 1rem;
            line-height: 1.85;
            color: #475569;
            border-left: 4px solid var(--gold);
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            margin-bottom: 0.5rem;
        }

        /* ============================
           PRACTICE AREAS — image cards
           (Cinematic Studios style)
        ============================ */
        .practice-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 0;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .prac-card {
            position: relative;
            aspect-ratio: 3/4;
            overflow: hidden;
            cursor: pointer;
        }

        .prac-img {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s ease;
        }

        .prac-card:hover .prac-img { transform: scale(1.08); }

        .prac-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(30,58,138,0.08) 0%,
                rgba(30,41,59,0.72) 55%,
                rgba(12,15,26,0.95) 100%
            );
        }

        /* Gold badge top-left */
        .prac-badge {
            position: absolute;
            top: 0.7rem;
            left: 0.7rem;
            background: var(--gold);
            color: #fff;
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.2rem 0.55rem;
            border-radius: 2px;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .prac-bottom {
            position: absolute;
            bottom: 0;
            left: 0; right: 0;
            padding: 1rem;
        }

        .prac-cat {
            font-size: 0.62rem;
            color: var(--gold2);
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
        }

        .prac-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.15;
        }

        .prac-desc {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.6);
            margin-top: 0.25rem;
        }

        /* ============================
           QUALIFICATIONS — timeline list
        ============================ */
        .qual-timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
            position: relative;
            margin-bottom: 0.5rem;
        }

        .qual-timeline::before {
            content: '';
            position: absolute;
            left: 28px;
            top: 0; bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, var(--gold), var(--navy));
            opacity: 0.3;
        }

        .qual-item {
            display: flex;
            gap: 1.4rem;
            padding: 1.4rem 1.6rem;
            background: #fff;
            border-radius: 10px;
            margin-bottom: 0.8rem;
            box-shadow: 0 3px 12px rgba(0,0,0,0.06);
            border-left: 3px solid var(--burg);
            transition: all 0.25s;
            position: relative;
        }

        .qual-item:hover {
            transform: translateX(5px);
            border-left-color: var(--gold);
            box-shadow: 0 6px 20px rgba(30,58,138,0.12);
        }

        .qual-dot {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--burg));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(217,119,6,0.3);
        }

        .qual-body { flex: 1; }

        .qual-title {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text);
            margin-bottom: 0.3rem;
        }

        .qual-desc {
            font-size: 0.88rem;
            color: var(--muted);
            line-height: 1.5;
        }

        /* ============================
           COURT EXPERIENCE
        ============================ */
        .courts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 0.5rem;
        }

        .court-card {
            background: #fff;
            border-radius: 10px;
            padding: 1.4rem;
            border: 1px solid var(--border);
            border-bottom: 3px solid var(--navy);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.25s;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .court-card:hover {
            border-bottom-color: var(--gold);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(30,58,138,0.12);
        }

        .court-icon-box {
            width: 42px; height: 42px;
            background: #eff6ff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .court-name {
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text);
            line-height: 1.3;
        }

        /* ============================
           CONSULTATION FEES
        ============================ */
        .fees-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .fee-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .fee-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 36px rgba(30,58,138,0.18);
        }

        .fee-card-img {
            height: 100px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .fee-card-img-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(30,58,138,0.4), rgba(12,15,26,0.92));
        }

        .fee-card-img-content {
            position: absolute;
            bottom: 0.7rem;
            left: 1rem;
        }

        .fee-type {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.05em;
        }

        .fee-card-body {
            background: #fff;
            padding: 1.1rem 1.2rem 1.4rem;
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 12px 12px;
        }

        .fee-amount {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--burg);
            line-height: 1;
            margin-bottom: 0.4rem;
        }

        .fee-note {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .fee-cta {
            display: block;
            width: 100%;
            margin-top: 1rem;
            padding: 0.65rem;
            background: linear-gradient(90deg, var(--navy), var(--burg));
            color: #fff;
            text-align: center;
            font-weight: 700;
            font-size: 0.78rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.25s;
        }

        .fee-cta:hover {
            box-shadow: 0 6px 18px rgba(30,58,138,0.3);
            transform: scale(1.02);
        }

        /* ============================
           LEGAL INSIGHTS (quotes)
        ============================ */
        .insights-list {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .insight-card {
            background: #fff;
            border-radius: 10px;
            padding: 1.8rem 1.8rem 1.8rem 2.2rem;
            border-left: 5px solid var(--navy);
            box-shadow: 0 3px 12px rgba(0,0,0,0.06);
            position: relative;
            transition: all 0.25s;
        }

        .insight-card:hover {
            border-left-color: var(--gold);
            transform: translateX(4px);
        }

        .insight-quote-mark {
            position: absolute;
            top: 0.6rem;
            left: 0.8rem;
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            color: var(--gold);
            opacity: 0.25;
            line-height: 1;
        }

        .insight-text {
            font-style: italic;
            color: #475569;
            font-size: 1rem;
            line-height: 1.75;
        }

        .insight-sub {
            margin-top: 0.7rem;
            font-size: 0.85rem;
            color: var(--muted);
        }

        /* ============================
           FILMSTRIP (Gallery)
        ============================ */
        .filmstrip-wrap { margin-bottom: 0.5rem; }

        .filmstrip {
            display: flex;
            gap: 0.7rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: var(--gold) #e2e8f0;
        }

        .filmstrip::-webkit-scrollbar { height: 4px; }
        .filmstrip::-webkit-scrollbar-track { background: #e2e8f0; }
        .filmstrip::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 2px; }

        .film-item {
            flex: 0 0 200px;
            aspect-ratio: 4/3;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid var(--border);
            transition: all 0.3s;
        }

        .film-item:hover {
            transform: scale(1.04);
            border-color: var(--gold);
            box-shadow: 0 8px 20px rgba(30,58,138,0.15);
        }

        .film-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .film-ph {
            width: 100%; height: 100%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 1.5rem;
        }

        /* ============================
           CTA SECTION
           "JUSTICE. INTEGRITY. EXCELLENCE!"
        ============================ */
        .cta-section {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .cta-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center 35%;
            opacity: 0.12;
        }

        .cta-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                110deg,
                rgba(12,15,26,0.97) 0%,
                rgba(30,58,138,0.85) 50%,
                rgba(12,15,26,0.7) 100%
            );
        }

        /* Gold top stripe on CTA */
        .cta-top-stripe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--gold2), var(--burg));
        }

        .cta-inner {
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
            padding: 3.5rem 2.5rem;
            align-items: center;
        }

        .cta-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--gold);
            color: #fff;
            font-size: 0.67rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.25rem 0.7rem;
            border-radius: 3px;
            margin-bottom: 1rem;
        }

        .cta-headline {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5.5vw, 5rem);
            font-weight: 900;
            line-height: 0.92;
            color: #fff;
            letter-spacing: -0.01em;
            margin-bottom: 1.2rem;
        }

        .cta-headline .cta-accent { color: var(--gold2); }

        .cta-desc {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.6);
            line-height: 1.7;
            margin-bottom: 1.8rem;
            max-width: 380px;
        }

        .cta-btns {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        /* Contact info items */
        .ci-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 0.9rem 1.2rem;
            margin-bottom: 0.8rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .ci-item:hover {
            background: rgba(217,119,6,0.1);
            border-color: var(--gold);
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

        .ci-icon.navy  { background: var(--navy); }
        .ci-icon.gold  { background: var(--gold); }
        .ci-icon.burg  { background: var(--burg); }
        .ci-icon.green { background: #16a34a; }

        .ci-text { flex: 1; min-width: 0; }

        .ci-label {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.45);
            font-weight: 700;
            letter-spacing: 0.09em;
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

        /* ============================
           FOLLOW / SOCIAL
        ============================ */
        .social-section {
            text-align: center;
            padding: 3rem 1.5rem 2rem;
        }

        .soc-eyebrow {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.25rem;
        }

        .soc-eyebrow span { color: var(--gold); }

        .soc-heading {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 1.5rem;
        }

        .soc-icons {
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
            font-size: 1.25rem;
            color: #fff;
            text-decoration: none;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        }

        .soc-btn:hover {
            transform: scale(1.15) translateY(-3px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.2);
        }

        .soc-fb  { background: #1877f2; }
        .soc-ig  { background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); }
        .soc-li  { background: #0077b5; }
        .soc-tw  { background: #1da1f2; }
        .soc-yt  { background: #ff0000; }

        /* ============================
           FOOTER
        ============================ */
        .site-footer {
            background: var(--dark);
            border-top: 3px solid var(--gold);
            padding: 1.6rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }

        .footer-brand-name span { color: var(--gold); }

        .footer-sub {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.4);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 0.2rem;
        }

        .footer-copy {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.35);
        }

        .footer-powered {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.35);
        }

        .footer-powered a {
            color: var(--gold);
            text-decoration: none;
        }

        /* ============================
           RESPONSIVE
        ============================ */
        @media (max-width: 900px) {
            .profile-card {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .pc-avatar-col { flex-direction: row; justify-content: center; }
            .pc-stats, .pc-tags { justify-content: center; }
            .pc-btns-col {
                flex-direction: row;
                flex-wrap: wrap;
                min-width: unset;
                justify-content: center;
            }
            .cta-inner {
                grid-template-columns: 1fr;
                padding: 2rem 1.5rem;
            }
        }

        @media (max-width: 640px) {
            .hero-content { padding: 3rem 1.2rem 2rem; }
            .hero-stats { gap: 1.5rem; }
            .practice-grid { grid-template-columns: repeat(2, 1fr); }
            .prac-card { aspect-ratio: 3/4; }
            .courts-grid { grid-template-columns: 1fr; }
            .fees-grid { grid-template-columns: 1fr; }
            .site-footer { flex-direction: column; align-items: center; text-align: center; }
        }

        @media (max-width: 400px) {
            .practice-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')

    <!-- ============================
         ANNOUNCEMENT BAR
    ============================ -->
    <div class="announce-bar">
        <i class="fas fa-gavel"></i>
        Free Legal Consultation Available — Book Your Appointment Today!
    </div>

    <!-- ============================
         HERO BANNER
    ============================ -->
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-top-stripe"></div>
        <div class="hero-fade"></div>

        <div class="hero-content">
            <div class="hero-eyebrow">
                <i class="fas fa-scale-balanced"></i> Advocate &amp; Legal Consultant
            </div>

            @if($userdata->isFeatureVisible('name'))
            <h1 class="hero-title">
                <span class="accent">{{ explode(' ', $userdata->name)[0] ?? 'ADV.' }}</span>
                <br>{{ implode(' ', array_slice(explode(' ', $userdata->name), 1)) }}
            </h1>
            @else
            <h1 class="hero-title"><span class="accent">ADV.</span><br>Legal Expert</h1>
            @endif

            @if($userdata->isFeatureVisible('designation') && ($userdata->desig ?? null))
            <p class="hero-sub">{{ $userdata->desig }}</p>
            @else
            <p class="hero-sub">Senior Advocate &nbsp;·&nbsp; High Court &nbsp;·&nbsp; Legal Expert</p>
            @endif

            <div class="hero-stats">
                <div>
                    <div class="h-stat-num">500+</div>
                    <div class="h-stat-lbl">Cases</div>
                </div>
                <div>
                    <div class="h-stat-num">92%</div>
                    <div class="h-stat-lbl">Win Rate</div>
                </div>
                <div>
                    <div class="h-stat-num">15+</div>
                    <div class="h-stat-lbl">Years</div>
                </div>
                @if($userdata->isFeatureVisible('address') && ($userdata->city ?? null))
                <div>
                    <div class="h-stat-num" style="font-size:0.95rem;color:rgba(255,255,255,0.7);">
                        <i class="fas fa-map-marker-alt" style="color:var(--gold2)"></i>
                        {{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}
                    </div>
                </div>
                @endif
            </div>

            <div class="hero-btns">
                @if($userdata->isFeatureVisible('contact_number') && ($userdata->mobile ?? null))
                <a href="tel:{{ $userdata->mobile }}" class="btn-solid">
                    <i class="fas fa-phone-alt"></i> Book Consultation
                </a>
                @endif

                @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social) && $social && ($social->whatsapp ?? null))
                <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="btn-ghost">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ============================
         NAVIGATION BAR
    ============================ -->
    <nav class="nav-bar">
        <div class="nav-inner">
            <a href="#home"        class="nav-link active"><i class="fas fa-home"></i> Home</a>
            <a href="#about"       class="nav-link"><i class="fas fa-user"></i> About</a>
            <a href="#practice"    class="nav-link"><i class="fas fa-scale-balanced"></i> Practice</a>
            <a href="#quali"       class="nav-link"><i class="fas fa-graduation-cap"></i> Qualifications</a>
            <a href="#courts"      class="nav-link"><i class="fas fa-building-columns"></i> Courts</a>
            <a href="#fees"        class="nav-link"><i class="fas fa-indian-rupee-sign"></i> Fees</a>
            @if(isset($thoughts) && $thoughts->count() > 0)
            <a href="#insights"    class="nav-link"><i class="fas fa-quote-left"></i> Insights</a>
            @endif
            <a href="#contact"     class="nav-link"><i class="fas fa-envelope"></i> Contact</a>
        </div>
    </nav>

    <!-- ============================
         PROFILE CARD
    ============================ -->
    <div class="profile-card-wrap">
        <div class="profile-card">

            <!-- Avatar -->
            <div class="pc-avatar-col">
                @if($userdata->isFeatureVisible('profile_photo'))
                    @if($userdata->profile)
                        <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}"
                             alt="{{ $userdata->name }}" class="pc-avatar">
                    @else
                        <div class="pc-avatar-placeholder">
                            <i class="fas fa-scale-balanced"></i>
                        </div>
                    @endif
                @else
                    <div class="pc-avatar-placeholder">
                        <i class="fas fa-scale-balanced"></i>
                    </div>
                @endif
                <span class="pc-avatar-lbl">Advocate</span>
            </div>

            <!-- Info -->
            <div class="pc-info">
                @if($userdata->isFeatureVisible('name'))
                <div class="pc-name">{{ $userdata->name }}</div>
                @endif
                @if($userdata->isFeatureVisible('designation') && ($userdata->desig ?? null))
                <div class="pc-desig">{{ $userdata->desig }}</div>
                @else
                <div class="pc-desig">Advocate &amp; Legal Consultant</div>
                @endif

                <div class="pc-stats">
                    <div>
                        <div class="pc-stat-num">500<sup>+</sup></div>
                        <div class="pc-stat-lbl">Cases</div>
                    </div>
                    <div>
                        <div class="pc-stat-num">92<sup>%</sup></div>
                        <div class="pc-stat-lbl">Win Rate</div>
                    </div>
                    <div>
                        <div class="pc-stat-num">15<sup>+</sup></div>
                        <div class="pc-stat-lbl">Years</div>
                    </div>
                    <div>
                        <div class="pc-stat-num">10<sup>+</sup></div>
                        <div class="pc-stat-lbl">Awards</div>
                    </div>
                </div>

                <div class="pc-tags">
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Civil Law</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Criminal Law</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Family Law</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Corporate</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> High Court</span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="pc-btns-col">
                @if($userdata->isFeatureVisible('contact_number') && ($userdata->mobile ?? null))
                <a href="tel:{{ $userdata->mobile }}" class="pc-btn pc-btn-navy">
                    <i class="fas fa-phone-alt"></i> Call
                </a>
                @endif
                @if($userdata->isFeatureVisible('email') && ($userdata->email ?? null))
                <a href="mailto:{{ $userdata->email }}" class="pc-btn pc-btn-outline">
                    <i class="fas fa-envelope"></i> Email
                </a>
                @endif
                @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social) && $social && ($social->whatsapp ?? null))
                <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="pc-btn pc-btn-gold">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- ============================
         CONTENT
    ============================ -->
    <div class="content-wrap">

        <!-- 01 ABOUT -->
        @if($userdata->isFeatureVisible('bio') && ($userdata->about_us ?? null))
        <div id="about">
            <div class="sec-header">
                <span class="sec-num">01</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">About Me</h2>
            </div>
            <div class="about-block">{{ $userdata->about_us }}</div>
        </div>
        @endif

        <!-- 02 PRACTICE AREAS (image cards) -->
        @if($userdata->isFeatureVisible('services'))
        <div id="practice">
            <div class="sec-header">
                <span class="sec-num">02</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Practice Areas</h2>
            </div>

            @php
            $defaultPractice = [
                [
                    'name' => 'Civil Law',
                    'cat'  => 'Civil Litigation',
                    'desc' => 'Contracts, Property, Disputes',
                    'img'  => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name' => 'Criminal Law',
                    'cat'  => 'Criminal Defense',
                    'desc' => 'Bail, Trials, Appeals',
                    'img'  => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name' => 'Family Law',
                    'cat'  => 'Family Matters',
                    'desc' => 'Divorce, Custody, Adoption',
                    'img'  => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name' => 'Corporate Law',
                    'cat'  => 'Business & Commerce',
                    'desc' => 'Mergers, Contracts, Compliance',
                    'img'  => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name' => 'Property Law',
                    'cat'  => 'Real Estate',
                    'desc' => 'Title Deeds, Disputes, Leases',
                    'img'  => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=600&q=80',
                ],
            ];

            $practiceImages = [
                'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=600&q=80',
            ];
            @endphp

            <div class="practice-grid">
                @if(isset($legalServices) && $legalServices->count() > 0)
                    @foreach($legalServices as $i => $svc)
                    <div class="prac-card">
                        <div class="prac-img" style="background-image:url('{{ $practiceImages[$i % count($practiceImages)] }}')"></div>
                        <div class="prac-overlay"></div>
                        <div class="prac-badge"><i class="fas fa-gavel"></i> Legal Service</div>
                        <div class="prac-bottom">
                            <div class="prac-cat">Practice Area</div>
                            <div class="prac-name">{{ $svc->practice_area ?? $svc->service_name ?? '' }}</div>
                        </div>
                    </div>
                    @endforeach
                @elseif(isset($professions) && $professions->count() > 0)
                    @foreach($professions as $i => $prof)
                    <div class="prac-card">
                        <div class="prac-img" style="background-image:url('{{ $practiceImages[$i % count($practiceImages)] }}')"></div>
                        <div class="prac-overlay"></div>
                        <div class="prac-badge"><i class="fas fa-gavel"></i> Practice</div>
                        <div class="prac-bottom">
                            <div class="prac-cat">Practice Area</div>
                            <div class="prac-name">{{ $prof->profession ?? $prof->title }}</div>
                            @if(isset($prof->description) && $prof->description)
                            <div class="prac-desc">{{ Str::limit($prof->description,45) }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    @foreach($defaultPractice as $prac)
                    <div class="prac-card">
                        <div class="prac-img" style="background-image:url('{{ $prac['img'] }}')"></div>
                        <div class="prac-overlay"></div>
                        <div class="prac-badge"><i class="fas fa-gavel"></i> Legal Service</div>
                        <div class="prac-bottom">
                            <div class="prac-cat">{{ $prac['cat'] }}</div>
                            <div class="prac-name">{{ $prac['name'] }}</div>
                            <div class="prac-desc">{{ $prac['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        <!-- 03 QUALIFICATIONS -->
        @if($userdata->isFeatureVisible('qualifications'))
        <div id="quali">
            <div class="sec-header">
                <span class="sec-num">03</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Qualifications &amp; Registration</h2>
            </div>
            <div class="qual-timeline">
                @if(isset($qualifications) && $qualifications->count() > 0)
                    @foreach($qualifications as $qual)
                    <div class="qual-item">
                        <div class="qual-dot"><i class="fas fa-graduation-cap"></i></div>
                        <div class="qual-body">
                            @php
                                $qTitle = $qual->qualifiaction ?? $qual->title ?? '';
                                $qDesc  = $qual->description  ?? $qual->desc  ?? '';
                            @endphp
                            <div class="qual-title">{{ $qTitle }}</div>
                            @if($qDesc)<div class="qual-desc">{{ $qDesc }}</div>@endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="qual-item">
                        <div class="qual-dot"><i class="fas fa-graduation-cap"></i></div>
                        <div class="qual-body">
                            <div class="qual-title">Bachelor of Laws (LLB)</div>
                            <div class="qual-desc">3-Year Professional Law Degree</div>
                        </div>
                    </div>
                    <div class="qual-item">
                        <div class="qual-dot"><i class="fas fa-award"></i></div>
                        <div class="qual-body">
                            <div class="qual-title">Master of Laws (LLM)</div>
                            <div class="qual-desc">Specialization in Constitutional Law</div>
                        </div>
                    </div>
                @endif
                <!-- Bar Council always shown -->
                <div class="qual-item">
                    <div class="qual-dot"><i class="fas fa-id-card"></i></div>
                    <div class="qual-body">
                        <div class="qual-title">Bar Council of India — Registered Advocate</div>
                        <div class="qual-desc">Enrolled &amp; licensed to practice in all courts of India</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- 04 COURT EXPERIENCE -->
        <div id="courts">
            <div class="sec-header">
                <span class="sec-num">04</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Court Experience</h2>
            </div>
            <div class="courts-grid">
                @php
                $courts = [
                    ['icon'=>'fas fa-landmark',          'name'=>'Supreme Court of India'],
                    ['icon'=>'fas fa-building-columns',  'name'=>'High Court'],
                    ['icon'=>'fas fa-gavel',             'name'=>'District & Sessions Court'],
                    ['icon'=>'fas fa-users',             'name'=>'Consumer Court'],
                    ['icon'=>'fas fa-briefcase',         'name'=>'Commercial Courts'],
                    ['icon'=>'fas fa-family',            'name'=>'Family Court'],
                ];
                @endphp
                @foreach($courts as $c)
                <div class="court-card">
                    <div class="court-icon-box"><i class="{{ $c['icon'] }}"></i></div>
                    <div class="court-name">{{ $c['name'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 05 PORTFOLIO FILMSTRIP (Gallery) -->
        @if($userdata->isFeatureVisible('photo_gallery') && isset($professional_photos) && $professional_photos->count() > 0)
        <div>
            <div class="sec-header">
                <span class="sec-num">05</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Office &amp; Chamber Gallery</h2>
            </div>
            <div class="filmstrip-wrap">
                <div class="filmstrip">
                    @foreach($professional_photos as $photo)
                    @php
                        $pv = $photo->image ?? $photo->name ?? '';
                        if ($pv) {
                            if (\Illuminate\Support\Str::startsWith($pv, ['http://','https://'])) {
                                $pUrl = $pv;
                            } elseif (\Illuminate\Support\Str::startsWith($pv, ['uploads/','frontend/','storage/'])) {
                                $pUrl = asset($pv);
                            } else {
                                $pUrl = asset('uploads/customer/'.$pv);
                            }
                        } else { $pUrl = ''; }
                    @endphp
                    <div class="film-item">
                        @if($pUrl)<img src="{{ $pUrl }}" alt="Gallery">@else<div class="film-ph"><i class="fas fa-image"></i></div>@endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- 06 CONSULTATION FEES -->
        <div id="fees">
            <div class="sec-header">
                <span class="sec-num">06</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Consultation Fees</h2>
            </div>

            @php
            $feeImages = [
                'https://images.unsplash.com/photo-1521791055366-0d553872952f?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1573496527892-904f897eb744?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=600&q=80',
            ];
            @endphp

            <div class="fees-grid">
                <div class="fee-card">
                    <div class="fee-card-img" style="background-image:url('{{ $feeImages[0] }}')">
                        <div class="fee-card-img-ov"></div>
                        <div class="fee-card-img-content">
                            <div class="fee-type">In-Person Consultation</div>
                        </div>
                    </div>
                    <div class="fee-card-body">
                        <div class="fee-amount">₹1,000</div>
                        <div class="fee-note">Per session · At chamber</div>
                        <a href="{{ isset($userdata->slug) ? url('/'.$userdata->slug.'/legal-consultation') : '#' }}" class="fee-cta">Book Now</a>
                    </div>
                </div>

                <div class="fee-card">
                    <div class="fee-card-img" style="background-image:url('{{ $feeImages[1] }}')">
                        <div class="fee-card-img-ov"></div>
                        <div class="fee-card-img-content">
                            <div class="fee-type">Video Consultation</div>
                        </div>
                    </div>
                    <div class="fee-card-body">
                        <div class="fee-amount">₹800</div>
                        <div class="fee-note">Per session · Online</div>
                        <a href="{{ isset($userdata->slug) ? url('/'.$userdata->slug.'/legal-consultation') : '#' }}" class="fee-cta">Book Now</a>
                    </div>
                </div>

                <div class="fee-card">
                    <div class="fee-card-img" style="background-image:url('{{ $feeImages[2] }}')">
                        <div class="fee-card-img-ov"></div>
                        <div class="fee-card-img-content">
                            <div class="fee-type">Document Review</div>
                        </div>
                    </div>
                    <div class="fee-card-body">
                        <div class="fee-amount">₹1,500</div>
                        <div class="fee-note">Per document set</div>
                        <a href="{{ isset($userdata->slug) ? url('/'.$userdata->slug.'/legal-consultation') : '#' }}" class="fee-cta">Book Now</a>
                    </div>
                </div>

                <div class="fee-card">
                    <div class="fee-card-img" style="background-image:url('{{ $feeImages[3] }}')">
                        <div class="fee-card-img-ov"></div>
                        <div class="fee-card-img-content">
                            <div class="fee-type">Full Case Retainer</div>
                        </div>
                    </div>
                    <div class="fee-card-body">
                        <div class="fee-amount">Enquire</div>
                        <div class="fee-note">Based on case complexity</div>
                        <a href="{{ isset($userdata->slug) ? url('/'.$userdata->slug.'/legal-consultation') : '#' }}" class="fee-cta">Enquire Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 07 LEGAL INSIGHTS -->
        @if($userdata->isFeatureVisible('thoughts') && isset($thoughts) && $thoughts->count() > 0)
        <div id="insights">
            <div class="sec-header">
                <span class="sec-num">07</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Legal Articles &amp; Insights</h2>
            </div>
            <div class="insights-list">
                @foreach($thoughts->take(4) as $thought)
                @php
                    $tTitle = $thought->thought ?? $thought->title ?? '';
                    $tDesc  = $thought->description ?? $thought->desc ?? '';
                @endphp
                <div class="insight-card">
                    <div class="insight-quote-mark">"</div>
                    <div class="insight-text">{{ $tTitle }}</div>
                    @if($tDesc)
                    <div class="insight-sub">{{ $tDesc }}</div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- ============================
             CTA SECTION
             "JUSTICE. INTEGRITY. EXCELLENCE."
        ============================ -->
        <div id="contact" class="cta-section">
            <div class="cta-bg"></div>
            <div class="cta-ov"></div>
            <div class="cta-top-stripe"></div>

            <div class="cta-inner">
                <!-- Left: Big headline -->
                <div>
                    <div class="cta-eyebrow"><i class="fas fa-scale-balanced"></i> Schedule A Consultation</div>
                    <h2 class="cta-headline">
                        JUSTICE.<br>
                        INTEGRITY.<br>
                        <span class="cta-accent">EXCELLENCE.</span>
                    </h2>
                    <p class="cta-desc">
                        Let's bring your legal case to resolution. Whether it's a civil dispute,
                        criminal defense, or corporate matter — expert counsel is ready for you.
                    </p>
                    <div class="cta-btns">
                        @if($userdata->isFeatureVisible('contact_number') && ($userdata->mobile ?? null))
                        <a href="tel:{{ $userdata->mobile }}" class="btn-solid">
                            <i class="fas fa-phone-alt"></i> Call Now
                        </a>
                        @endif
                        @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social) && $social && ($social->whatsapp ?? null))
                        <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="btn-ghost">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Right: Contact info -->
                <div>
                    @if($userdata->isFeatureVisible('contact_number') && ($userdata->mobile ?? null))
                    <a href="tel:{{ $userdata->mobile }}" class="ci-item">
                        <div class="ci-icon navy"><i class="fas fa-phone-alt"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Call Us</div>
                            <div class="ci-value">{{ $userdata->mobile }}</div>
                        </div>
                    </a>
                    @endif

                    @if($userdata->isFeatureVisible('email') && ($userdata->email ?? null))
                    <a href="mailto:{{ $userdata->email }}" class="ci-item">
                        <div class="ci-icon gold"><i class="fas fa-envelope"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Email</div>
                            <div class="ci-value">{{ $userdata->email }}</div>
                        </div>
                    </a>
                    @endif

                    @if($userdata->isFeatureVisible('address') && ($userdata->city ?? null))
                    <div class="ci-item">
                        <div class="ci-icon burg"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Chamber Location</div>
                            <div class="ci-value">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                        </div>
                    </div>
                    @endif

                    @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social) && $social && ($social->whatsapp ?? null))
                    <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="ci-item">
                        <div class="ci-icon green"><i class="fab fa-whatsapp"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">WhatsApp</div>
                            <div class="ci-value">{{ $social->whatsapp }}</div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>

    </div><!-- /content-wrap -->

    <!-- ============================
         SOCIAL / FOLLOW
    ============================ -->
    @if($userdata->isFeatureVisible('social_media') && isset($social))
    <div class="social-section">
        <div class="soc-eyebrow">Connect With <span>Us</span></div>
        <div class="soc-heading">Stay Updated</div>
        <div class="soc-icons">
            @if($userdata->isFeatureVisible('facebook') && ($social->facebook ?? null))
            <a href="{{ $social->facebook }}" target="_blank" class="soc-btn soc-fb">
                <i class="fab fa-facebook-f"></i>
            </a>
            @endif
            @if($userdata->isFeatureVisible('instagram') && ($social->instagram ?? null))
            <a href="{{ $social->instagram }}" target="_blank" class="soc-btn soc-ig">
                <i class="fab fa-instagram"></i>
            </a>
            @endif
            @if($userdata->isFeatureVisible('linkedin') && ($social->linkedin ?? null))
            <a href="{{ $social->linkedin }}" target="_blank" class="soc-btn soc-li">
                <i class="fab fa-linkedin-in"></i>
            </a>
            @endif
            @if(($social->twitter ?? null))
            <a href="{{ $social->twitter }}" target="_blank" class="soc-btn soc-tw">
                <i class="fab fa-twitter"></i>
            </a>
            @endif
        </div>
    </div>
    @endif

    <!-- ============================
         FOOTER
    ============================ -->
    <footer class="site-footer">
        <div>
            @if($userdata->isFeatureVisible('name'))
            <div class="footer-brand-name">
                Adv.
                <span>{{ $userdata->name }}</span>
            </div>
            @endif
            <div class="footer-sub">Advocate &amp; Legal Consultant</div>
        </div>
        <div class="footer-copy">© {{ date('Y') }} All Rights Reserved</div>
        <div class="footer-powered">Powered by <a href="#">LexPro</a></div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id   ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview      ?? false
    ])
</body>
</html>