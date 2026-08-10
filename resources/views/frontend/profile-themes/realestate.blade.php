<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Real Estate' }} - Property Expert</title>

    @php
        $websetting = App\Models\websetting::first();

        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile' => 1, 'quali' => 1, 'service' => 1, 'thought' => 1,
                'personal' => 1, 'profess' => 1, 'videos' => 1, 'product' => 1,
                'social_link' => 1, 'upload_file' => 1, 'client' => 1, 'property_listings' => 1,
            ];
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client','property_listings'], 1);
            }
        }

        $dummyServices = [
            [
                'title' => 'Residential Property Buying & Selling',
                'desc'  => 'We help clients buy and sell homes with expert market analysis, negotiation skills, and personalized service. From first-time buyers to luxury home sales, we ensure a smooth transaction.',
                'img'   => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800&auto=format&fit=crop',
                'icon'  => 'fa-house',
            ],
            [
                'title' => 'Commercial Real Estate Solutions',
                'desc'  => 'Whether you\'re leasing, buying, or selling commercial properties, we provide insights and strategies to maximize your investment.',
                'img'   => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&auto=format&fit=crop',
                'icon'  => 'fa-building',
            ],
            [
                'title' => 'Property Management Services',
                'desc'  => 'We take the hassle out of rental property management by handling tenant screening, rent collection, maintenance, and legal compliance.',
                'img'   => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=800&auto=format&fit=crop',
                'icon'  => 'fa-key',
            ],
            [
                'title' => 'Real Estate Investment Consulting',
                'desc'  => 'Looking to grow your wealth through real estate investments? We offer expert advice on market trends, ROI calculations, and investment opportunities.',
                'img'   => 'https://images.unsplash.com/photo-1554469384-e58fac16e23a?w=800&auto=format&fit=crop',
                'icon'  => 'fa-chart-line',
            ],
        ];
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700;800&family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ══════════════════════════════════════════════════════
           ROOT VARIABLES
        ══════════════════════════════════════════════════════ */
        :root {
            --gold:         #C9A84C;
            --gold-light:   #E8C96B;
            --gold-lighter: #F5E4A8;
            --gold-dark:    #9A7A2E;
            --gold-xdark:   #6B5220;
            --onyx:         #0D0D0D;
            --deep:         #111827;
            --navy:         #1E2D45;
            --slate:        #334155;
            --mid:          #64748B;
            --soft:         #94A3B8;
            --border:       #E2E8F0;
            --bg:           #F7F8FB;
            --white:        #FFFFFF;
            --emerald:      #059669;
            --emerald-lt:   #10B981;
            --shadow-sm:    0 2px 12px rgba(0,0,0,0.07);
            --shadow-md:    0 8px 32px rgba(0,0,0,0.10);
            --shadow-lg:    0 20px 60px rgba(0,0,0,0.14);
            --shadow-gold:  0 8px 30px rgba(201,168,76,0.35);
            --shadow-green: 0 8px 28px rgba(5,150,105,0.28);
            --radius-sm:    10px;
            --radius-md:    18px;
            --radius-lg:    26px;
            --radius-xl:    36px;
            --transition:   all 0.35s cubic-bezier(0.4,0,0.2,1);
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; font-size: 16px; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--deep);
            min-height: 100vh;
            line-height: 1.7;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ══════════════════════════════════════════════════════
           SCROLLBAR
        ══════════════════════════════════════════════════════ */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 3px; }

        /* ══════════════════════════════════════════════════════
           PREVIEW BANNER
        ══════════════════════════════════════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg, #6D28D9 0%, #DB2777 100%);
            color: #fff;
            padding: 13px 24px;
            text-align: center;
            font-size: 13.5px;
            font-weight: 500;
            position: sticky;
            top: 0;
            z-index: 9999;
            letter-spacing: 0.01em;
        }
        .preview-banner a {
            color: #FDE68A;
            text-decoration: underline;
            font-weight: 700;
            margin-left: 8px;
        }

        /* ══════════════════════════════════════════════════════
           ① HERO  — Full‑viewport width with layered overlays
        ══════════════════════════════════════════════════════ */
        .hero {
            width: 100%;
            height: 100vh;
            min-height: 640px;
            max-height: 860px;
            position: relative;
            overflow: hidden;
            background:
                url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1920&auto=format&fit=crop')
                center/cover no-repeat;
            display: flex;
            align-items: flex-end;
        }
        .hero.has-image {
            background-size: cover;
            background-position: center;
        }

        /* layered gradient overlay */
        .hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg,
                    rgba(13,13,13,0.25) 0%,
                    rgba(13,13,13,0.18) 30%,
                    rgba(13,13,13,0.55) 65%,
                    rgba(13,13,13,0.90) 100%
                );
            z-index: 1;
        }

        /* animated gold line at very top */
        .hero-topline {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg,
                transparent 0%,
                var(--gold-dark) 20%,
                var(--gold) 50%,
                var(--gold-light) 70%,
                transparent 100%
            );
            z-index: 10;
        }

        /* floating STATUS pill (top-right) */
        .hero-status {
            position: absolute;
            top: 28px; right: 28px;
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.22);
            color: #fff;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 8px 18px;
            border-radius: 50px;
        }
        .hero-status .dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74,222,128,0.35);
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0%,100% { box-shadow: 0 0 0 3px rgba(74,222,128,0.35); }
            50%      { box-shadow: 0 0 0 6px rgba(74,222,128,0.15); }
        }

        /* hero bottom content */
        .hero-content {
            position: relative;
            z-index: 5;
            width: 100%;
            padding: 0 5vw 4rem;
        }
        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gold-light);
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        .hero-label::before,
        .hero-label::after {
            content: '';
            display: block;
            width: 30px; height: 1px;
            background: var(--gold);
        }
        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.6rem, 6vw, 5rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.12;
            margin-bottom: 0.6rem;
            letter-spacing: -0.01em;
        }
        .hero-title .accent { color: var(--gold-light); }
        .hero-subtitle {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.72);
            max-width: 520px;
            margin-bottom: 2.2rem;
        }
        .hero-cta-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.9rem 2rem;
            border-radius: 50px;
            font-size: 0.92rem;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            letter-spacing: 0.02em;
        }
        .hero-btn-primary {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            color: var(--white);
            box-shadow: var(--shadow-gold);
        }
        .hero-btn-primary:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 14px 40px rgba(201,168,76,0.5);
        }
        .hero-btn-ghost {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1.5px solid rgba(255,255,255,0.35);
            color: var(--white);
        }
        .hero-btn-ghost:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-3px);
        }

        /* floating stat chips (bottom-right of hero) */
        .hero-stats {
            position: absolute;
            bottom: 2.5rem; right: 5vw;
            z-index: 10;
            display: flex;
            gap: 1rem;
        }
        .hero-stat {
            background: rgba(255,255,255,0.10);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: var(--radius-md);
            padding: 1rem 1.4rem;
            color: var(--white);
            text-align: center;
            min-width: 90px;
        }
        .hero-stat-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--gold-light);
            line-height: 1;
        }
        .hero-stat-lbl {
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.65);
            margin-top: 3px;
        }

        /* ══════════════════════════════════════════════════════
           ② PROFILE CARD  — floats out of hero
        ══════════════════════════════════════════════════════ */
        .profile-float {
            width: 100%;
            max-width: 1200px;
            margin: -80px auto 0;
            padding: 0 5vw;
            position: relative;
            z-index: 100;
        }

        .profile-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 0;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(201,168,76,0.2);
            overflow: hidden;
            display: grid;
            grid-template-columns: 340px 1fr;
        }

        /* LEFT PANEL */
        .pc-left {
            background: linear-gradient(175deg, var(--deep) 0%, var(--navy) 100%);
            padding: 2.8rem 2.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 0;
            position: relative;
            overflow: hidden;
        }
        /* gold corner accent */
        .pc-left::before {
            content:'';
            position: absolute;
            top: -60px; right: -60px;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(201,168,76,0.2) 0%, transparent 70%);
            border-radius: 50%;
        }
        .pc-left::after {
            content:'';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 140px; height: 140px;
            background: radial-gradient(circle, rgba(201,168,76,0.14) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* avatar */
        .pc-avatar-wrap {
            position: relative;
            margin-bottom: 1.4rem;
            z-index: 1;
        }
        .pc-avatar {
            width: 116px; height: 116px;
            border-radius: 50%;
            border: 4px solid var(--gold);
            object-fit: cover;
            display: block;
            box-shadow: 0 0 0 8px rgba(201,168,76,0.18), var(--shadow-gold);
        }
        .pc-avatar-placeholder {
            width: 116px; height: 116px;
            border-radius: 50%;
            border: 4px solid var(--gold);
            background: linear-gradient(135deg, #1e3a5f 0%, #0f2240 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 2.6rem;
            box-shadow: 0 0 0 8px rgba(201,168,76,0.18), var(--shadow-gold);
        }
        .pc-verified {
            position: absolute;
            bottom: 4px; right: 4px;
            width: 28px; height: 28px;
            background: #1D9BF0;
            border-radius: 50%;
            border: 3px solid var(--white);
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 0.7rem;
        }

        .pc-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1.25;
            margin-bottom: 0.3rem;
            z-index: 1;
        }
        .pc-title {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--gold-light);
            font-style: italic;
            margin-bottom: 1.2rem;
            z-index: 1;
        }

        /* gold badge */
        .pc-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            color: var(--white);
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 50px;
            box-shadow: var(--shadow-gold);
            margin-bottom: 1.5rem;
            z-index: 1;
        }

        /* location */
        .pc-location {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.55);
            font-size: 0.82rem;
            margin-bottom: 1.5rem;
            z-index: 1;
        }
        .pc-location i { color: var(--gold); font-size: 0.85rem; }

        /* divider */
        .pc-divider {
            width: 100%;
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin: 0.8rem 0 1.4rem;
            z-index: 1;
        }

        /* social row */
        .pc-social-row {
            display: flex;
            gap: 0.65rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 1.6rem;
            z-index: 1;
        }
        .pc-soc-btn {
            width: 40px; height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            color: rgba(255,255,255,0.7);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem;
            text-decoration: none;
            transition: var(--transition);
        }
        .pc-soc-btn:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: var(--shadow-gold);
        }

        /* action buttons */
        .pc-action-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.7rem;
            width: 100%;
            z-index: 1;
        }
        .pc-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            padding: 0.75rem;
            border-radius: var(--radius-sm);
            font-size: 0.84rem;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            letter-spacing: 0.02em;
        }
        .pc-btn-call {
            background: linear-gradient(135deg, var(--emerald-lt), var(--emerald));
            color: var(--white);
            grid-column: 1;
            box-shadow: var(--shadow-green);
        }
        .pc-btn-call:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(16,185,129,0.45);
        }
        .pc-btn-wa {
            background: rgba(255,255,255,0.08);
            border: 1.5px solid #25D366;
            color: #25D366;
        }
        .pc-btn-wa:hover {
            background: #25D366;
            color: var(--white);
            transform: translateY(-2px);
        }

        /* RIGHT PANEL */
        .pc-right {
            padding: 2.8rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 1.6rem;
        }

        /* bio */
        .pc-bio-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.6rem;
        }
        .pc-bio {
            font-size: 0.96rem;
            color: var(--slate);
            line-height: 1.8;
            border-left: 4px solid var(--gold);
            padding-left: 1.1rem;
        }

        /* contact grid */
        .contact-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--deep);
            margin-bottom: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .contact-section-title::after {
            content:'';
            flex:1;
            height:1px;
            background: var(--border);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.9rem 1.1rem;
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            text-decoration: none;
            color: var(--deep);
            transition: var(--transition);
            overflow: hidden;
        }
        .contact-item:hover {
            border-color: var(--gold);
            background: #FFFBF0;
            transform: translateY(-2px);
            box-shadow: var(--shadow-gold);
        }
        .contact-item-icon {
            width: 38px; height: 38px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            display: flex; align-items: center; justify-content: center;
            color: var(--white);
            font-size: 0.92rem;
            flex-shrink: 0;
        }
        .contact-item-info { min-width:0; }
        .contact-item-type {
            font-size: 0.68rem;
            font-weight: 600;
            color: var(--soft);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 1px;
        }
        .contact-item-val {
            font-size: 0.86rem;
            font-weight: 600;
            color: var(--deep);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ══════════════════════════════════════════════════════
           MAIN CONTENT — full-width container
        ══════════════════════════════════════════════════════ */
        .main-wrap {
            width: 100%;
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 5vw 5rem;
        }

        /* ── Section label (shared) ── */
        .sec-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold-dark);
            margin-bottom: 0.6rem;
        }
        .sec-eyebrow span {
            display: block;
            width: 24px; height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }
        .sec-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.9rem, 3.5vw, 2.7rem);
            font-weight: 700;
            color: var(--deep);
            line-height: 1.18;
            margin-bottom: 0.5rem;
        }
        .sec-title .hl { color: var(--gold); }
        .sec-sub {
            font-size: 0.96rem;
            color: var(--mid);
            max-width: 560px;
            margin-bottom: 2.5rem;
        }

        /* ══════════════════════════════════════════════════════
           ③ SERVICES SECTION
        ══════════════════════════════════════════════════════ */
        .services-section {
            padding: 4.5rem 0;
            border-bottom: 1px solid var(--border);
            margin-bottom: 4rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.6rem;
        }

        .svc-card {
            background: var(--white);
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .svc-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold-light));
            transform: scaleX(0);
            transform-origin: left;
            transition: var(--transition);
        }
        .svc-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 55px rgba(0,0,0,0.13);
            border-color: var(--gold-lighter);
        }
        .svc-card:hover::after { transform: scaleX(1); }

        .svc-img-wrap {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        .svc-img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4,0,0.2,1);
        }
        .svc-card:hover .svc-img { transform: scale(1.07); }

        .svc-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                rgba(13,13,13,0.65) 0%,
                transparent 55%
            );
        }
        .svc-icon-chip {
            position: absolute;
            top: 14px; left: 14px;
            width: 42px; height: 42px;
            border-radius: 11px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            display: flex; align-items: center; justify-content: center;
            color: var(--white);
            font-size: 1rem;
            box-shadow: var(--shadow-gold);
        }
        .svc-num-chip {
            position: absolute;
            top: 14px; right: 14px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.78rem;
            font-weight: 700;
            color: rgba(255,255,255,0.7);
            background: rgba(0,0,0,0.35);
            padding: 3px 9px;
            border-radius: 50px;
            letter-spacing: 0.05em;
        }

        .svc-body {
            padding: 1.3rem 1.4rem 1.6rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .svc-title {
            font-size: 1.04rem;
            font-weight: 700;
            color: var(--deep);
            margin-bottom: 0.55rem;
            line-height: 1.35;
        }
        .svc-desc {
            font-size: 0.875rem;
            color: var(--mid);
            line-height: 1.7;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .svc-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 1rem;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--gold-dark);
            text-decoration: none;
            letter-spacing: 0.04em;
            transition: var(--transition);
        }
        .svc-link i { transition: var(--transition); }
        .svc-link:hover i { transform: translateX(4px); }

        /* ══════════════════════════════════════════════════════
           ④ WHY CHOOSE US — stat strip
        ══════════════════════════════════════════════════════ */
        .why-section {
            background: linear-gradient(135deg, var(--deep) 0%, var(--navy) 100%);
            border-radius: var(--radius-xl);
            padding: 4rem 3.5rem;
            margin-bottom: 4rem;
            position: relative;
            overflow: hidden;
        }
        .why-section::before {
            content:'';
            position: absolute;
            top: -80px; right: -80px;
            width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(201,168,76,0.18) 0%, transparent 70%);
            border-radius: 50%;
        }
        .why-section::after {
            content:'';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(5,150,105,0.14) 0%, transparent 70%);
            border-radius: 50%;
        }

        .why-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .why-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(1.7rem, 3vw, 2.4rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
        }
        .why-title .gold { color: var(--gold-light); }
        .why-desc {
            font-size: 0.94rem;
            color: rgba(255,255,255,0.6);
            max-width: 340px;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.4rem;
            position: relative;
            z-index: 2;
        }
        .why-item {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: var(--radius-md);
            padding: 1.8rem 1.4rem;
            text-align: center;
            transition: var(--transition);
        }
        .why-item:hover {
            background: rgba(201,168,76,0.12);
            border-color: rgba(201,168,76,0.4);
            transform: translateY(-4px);
        }
        .why-icon {
            width: 54px; height: 54px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            display: flex; align-items: center; justify-content: center;
            color: var(--white);
            font-size: 1.3rem;
            margin: 0 auto 1rem;
            box-shadow: var(--shadow-gold);
        }
        .why-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--gold-light);
            line-height: 1;
            margin-bottom: 0.3rem;
        }
        .why-label {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.6);
            font-weight: 500;
            letter-spacing: 0.05em;
        }

        /* ══════════════════════════════════════════════════════
           ⑤ PROPERTY GALLERY
        ══════════════════════════════════════════════════════ */
        .gallery-section {
            padding: 0 0 4rem;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.4rem;
        }
        .prop-card {
            background: var(--white);
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }
        .prop-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.13);
            border-color: var(--emerald-lt);
        }
        .prop-img-wrap {
            position: relative;
            height: 210px;
            overflow: hidden;
        }
        .prop-img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }
        .prop-card:hover .prop-img { transform: scale(1.07); }
        .prop-tag {
            position: absolute;
            top: 12px; left: 12px;
            background: var(--emerald);
            color: var(--white);
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 6px;
        }
        .prop-body { padding: 1.3rem; flex:1; }
        .prop-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--deep);
            margin-bottom: 0.4rem;
        }
        .prop-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--emerald);
            margin-bottom: 0.85rem;
        }
        .prop-meta {
            display: flex;
            gap: 1.1rem;
            font-size: 0.84rem;
            color: var(--mid);
        }
        .prop-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .prop-meta-item i { color: var(--gold); font-size: 0.82rem; }

        /* ══════════════════════════════════════════════════════
           ⑥ CTA BANNER — full‑width, full bleed
        ══════════════════════════════════════════════════════ */
        .cta-full {
            width: 100%;
            background:
                linear-gradient(135deg, rgba(154,122,46,0.94) 0%, rgba(107,82,32,0.97) 100%),
                url('https://images.unsplash.com/photo-1589994965851-a8f479c573a9?w=1600&auto=format&fit=crop')
                center/cover no-repeat;
            background-blend-mode: multiply;
            padding: 5.5rem 5vw;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 0;
        }
        .cta-full::before {
            content:'';
            position: absolute;
            top: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 65%);
            border-radius: 50%;
        }
        .cta-inner {
            position: relative;
            z-index: 2;
            max-width: 680px;
            margin: 0 auto;
        }
        .cta-eyebrow {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold-lighter);
            margin-bottom: 1rem;
        }
        .cta-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4.5vw, 3.2rem);
            font-weight: 700;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 0.9rem;
        }
        .cta-copy {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.8);
            margin-bottom: 2.4rem;
            line-height: 1.7;
        }
        .cta-btns {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .cta-btn-white {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--white);
            color: var(--gold-xdark);
            padding: 0.95rem 2.4rem;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.96rem;
            text-decoration: none;
            box-shadow: 0 6px 22px rgba(0,0,0,0.2);
            transition: var(--transition);
        }
        .cta-btn-white:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 32px rgba(0,0,0,0.28);
        }
        .cta-btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: transparent;
            color: var(--white);
            padding: 0.95rem 2.4rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.96rem;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.55);
            transition: var(--transition);
        }
        .cta-btn-outline:hover {
            background: rgba(255,255,255,0.15);
            border-color: var(--white);
            transform: translateY(-3px);
        }

        /* ══════════════════════════════════════════════════════
           FOOTER
        ══════════════════════════════════════════════════════ */
        .site-footer {
            background: var(--onyx);
            padding: 2.2rem 5vw;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-brand i { color: var(--gold); }
        .footer-copy {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.4);
        }
        .footer-copy a { color: var(--gold-light); text-decoration: none; font-weight: 600; }

        /* ══════════════════════════════════════════════════════
           SCROLL-IN  ANIMATIONS
        ══════════════════════════════════════════════════════ */
        .reveal {
            opacity: 0;
            transform: translateY(34px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-delay-1 { transition-delay: 0.10s; }
        .reveal-delay-2 { transition-delay: 0.22s; }
        .reveal-delay-3 { transition-delay: 0.34s; }
        .reveal-delay-4 { transition-delay: 0.46s; }

        /* ══════════════════════════════════════════════════════
           RESPONSIVE BREAKPOINTS
        ══════════════════════════════════════════════════════ */
        @media (max-width: 1024px) {
            .why-grid { grid-template-columns: repeat(2,1fr); }
            .gallery-grid { grid-template-columns: repeat(2,1fr); }
        }

        @media (max-width: 768px) {
            .hero { max-height: 580px; }
            .hero-stats { display: none; }
            .hero-content { padding-bottom: 2.4rem; }

            .profile-card {
                grid-template-columns: 1fr;
            }
            .pc-left {
                border-radius: 0;
                padding: 2.4rem 1.8rem 2rem;
            }

            .services-grid { grid-template-columns: 1fr 1fr; }
            .why-grid { grid-template-columns: 1fr 1fr; }
            .why-section { padding: 2.8rem 1.8rem; }
            .why-top { flex-direction: column; }
            .gallery-grid { grid-template-columns: 1fr; }
            .contact-grid { grid-template-columns: 1fr; }
            .cta-btns { flex-direction: column; align-items: center; }
        }

        @media (max-width: 520px) {
            .hero-title { font-size: 2.2rem; }
            .hero-cta-row { flex-direction: column; }
            .services-grid { grid-template-columns: 1fr; }
            .why-grid { grid-template-columns: 1fr; }
            .profile-float { margin-top: -50px; }
            .pc-right { padding: 1.8rem 1.4rem; }
            .site-footer { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> &nbsp;This is a preview of your professional profile.
        <a href="{{ url('/signin') }}">Sign up free</a> to publish and share it!
    </div>
    @endif

    <!-- ═══════════════════════════════════════════════════
         ① HERO
    ════════════════════════════════════════════════════ -->
    <section class="hero @if($userdata->banner) has-image @endif"
        @if($userdata->banner)
            style="background-image:url('{{ url('public/frontend/user_images', $userdata->banner) }}');"
        @endif>

        <div class="hero-overlay"></div>
        <div class="hero-topline"></div>

        <!-- Live status -->
        <div class="hero-status">
            <span class="dot"></span>
            Available Now
        </div>

        <!-- Main copy -->
        <div class="hero-content">
            <div class="hero-label">
                <span></span>
                Premium Real Estate
                <span></span>
            </div>
            <h1 class="hero-title">
                {{ $userdata->name ?? 'Urban Nest' }}<br>
                <span class="accent">{{ $userdata->desig ?? 'Paradise.' }}</span>
            </h1>
            <p class="hero-subtitle">
                {{ Str::limit($userdata->about ?? 'Connecting clients with their ideal properties through trusted expertise, market insight, and white-glove service.', 120) }}
            </p>
            <div class="hero-cta-row">
                @if($userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="hero-btn hero-btn-primary">
                    <i class="fas fa-phone"></i> Call Now
                </a>
                @endif
                @if(isset($social->whatsapp) && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" class="hero-btn hero-btn-ghost" target="_blank">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </div>

        <!-- Floating stats (desktop) -->
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-num">500+</div>
                <div class="hero-stat-lbl">Properties</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num">12+</div>
                <div class="hero-stat-lbl">Years Exp.</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num">98%</div>
                <div class="hero-stat-lbl">Satisfaction</div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════
         ② PROFILE CARD
    ════════════════════════════════════════════════════ -->
    <div class="profile-float">
        <div class="profile-card reveal">

            <!-- LEFT: avatar + identity + social + actions -->
            <div class="pc-left">
                @if($userdata->isFeatureVisible('profile_photo'))
                <div class="pc-avatar-wrap">
                    @if($userdata->profile)
                        <img class="pc-avatar"
                             src="{{ url('public/frontend/user_images', $userdata->profile) }}"
                             alt="{{ $userdata->name }}">
                    @else
                        <div class="pc-avatar-placeholder">
                            <i class="fas fa-building"></i>
                        </div>
                    @endif
                    <div class="pc-verified"><i class="fas fa-check" style="font-size:0.7rem;"></i></div>
                </div>
                @endif

                @if($userdata->isFeatureVisible('name'))
                <div class="pc-name">{{ $userdata->name ?? 'Urban Nest Paradise' }}</div>
                @endif

                @if($userdata->isFeatureVisible('designation'))
                <div class="pc-title">"{{ $userdata->desig ?? 'Where The City Meets The Skyline.' }}"</div>
                @endif

                <div class="pc-badge">
                    <i class="fas fa-crown"></i> Verified Expert
                </div>

                @if($userdata->city ?? false)
                <div class="pc-location">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $userdata->city }}
                </div>
                @endif

                <div class="pc-divider"></div>

                @if($userdata->isFeatureVisible('social_media') && $social)
                <div class="pc-social-row">
                    @if($social->website ?? false)
                    <a href="{{ $social->website }}" class="pc-soc-btn" target="_blank" title="Website">
                        <i class="fas fa-globe"></i>
                    </a>
                    @endif
                    @if($social->twitter ?? false)
                    <a href="{{ $social->twitter }}" class="pc-soc-btn" target="_blank" title="Twitter/X">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    @endif
                    @if($userdata->isFeatureVisible('instagram') && ($social->instagram ?? false))
                    <a href="{{ $social->instagram }}" class="pc-soc-btn" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($userdata->isFeatureVisible('linkedin') && ($social->linkedin ?? false))
                    <a href="{{ $social->linkedin }}" class="pc-soc-btn" target="_blank" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    @endif
                    @if($userdata->isFeatureVisible('whatsapp_chat') && ($social->whatsapp ?? false))
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="pc-soc-btn" target="_blank" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    @endif
                </div>
                @endif

                <div class="pc-action-row">
                    @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="pc-action-btn pc-btn-call">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                    @endif
                    @if($userdata->isFeatureVisible('whatsapp_chat') && ($social->whatsapp ?? false))
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="pc-action-btn pc-btn-wa" target="_blank">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif
                </div>
            </div>

            <!-- RIGHT: bio + contact -->
            <div class="pc-right">
                <div>
                    <div class="pc-bio-label">About Me</div>
                    <p class="pc-bio">
                        {{ $userdata->about ?? 'Real estate agents play a crucial role in the property market, with various specializations catering to different client needs. Each role requires a unique set of skills and qualifications, but all share a common goal: to facilitate successful real estate transactions.' }}
                    </p>
                </div>

                <div>
                    <div class="contact-section-title">
                        <i class="fas fa-address-book" style="color:var(--gold);"></i>
                        Contact Information
                    </div>
                    <div class="contact-grid">
                        @if($userdata->isFeatureVisible('email') && $userdata->email)
                        <a href="mailto:{{ $userdata->email }}" class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-item-info">
                                <div class="contact-item-type">Email</div>
                                <div class="contact-item-val">{{ $userdata->email }}</div>
                            </div>
                        </a>
                        @else
                        <a href="mailto:urbannest@gmail.com" class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-item-info">
                                <div class="contact-item-type">Email</div>
                                <div class="contact-item-val">urbannest@gmail.com</div>
                            </div>
                        </a>
                        @endif

                        @if($userdata->isFeatureVisible('email') && ($userdata->email2 ?? false))
                        <a href="mailto:{{ $userdata->email2 }}" class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-item-info">
                                <div class="contact-item-type">Secondary Email</div>
                                <div class="contact-item-val">{{ $userdata->email2 }}</div>
                            </div>
                        </a>
                        @else
                        <a href="mailto:urbannest.official@gmail.com" class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-item-info">
                                <div class="contact-item-type">Office Email</div>
                                <div class="contact-item-val">urbannest.official@gmail.com</div>
                            </div>
                        </a>
                        @endif

                        @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                        <a href="tel:{{ $userdata->mobile }}" class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-item-info">
                                <div class="contact-item-type">Mobile</div>
                                <div class="contact-item-val">{{ $userdata->mobile }}</div>
                            </div>
                        </a>
                        @else
                        <a href="tel:+918527419630" class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-item-info">
                                <div class="contact-item-type">Mobile</div>
                                <div class="contact-item-val">+91 85274 19630</div>
                            </div>
                        </a>
                        @endif

                        @if($userdata->mobile2 ?? false)
                        <a href="tel:{{ $userdata->mobile2 }}" class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-item-info">
                                <div class="contact-item-type">Office</div>
                                <div class="contact-item-val">{{ $userdata->mobile2 }}</div>
                            </div>
                        </a>
                        @else
                        <a href="tel:+918638527410" class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-item-info">
                                <div class="contact-item-type">Office</div>
                                <div class="contact-item-val">+91 86385 27410</div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════
         MAIN CONTENT
    ════════════════════════════════════════════════════ -->
    <div class="main-wrap">

        <!-- ─── ③ SERVICES ─── -->
        @if($userdata->isFeatureVisible('services'))
        <div class="services-section">
            <div class="reveal">
                <div class="sec-eyebrow"><span></span> What We Offer <span></span></div>
                <h2 class="sec-title">Our <span class="hl">Premium</span> Services</h2>
                <p class="sec-sub">
                    End-to-end real estate solutions tailored to your unique needs — from residential sales to investment consulting.
                </p>
            </div>

            <div class="services-grid">
                @if($professions->count() > 0)
                    @php $svcImgs = [
                        'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=800&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1554469384-e58fac16e23a?w=800&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=800&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&auto=format&fit=crop',
                    ];
                    $svcIcons = ['fa-house','fa-building','fa-key','fa-chart-line','fa-handshake','fa-city'];
                    @endphp
                    @foreach($professions as $idx => $profession)
                    @php
                        $professionLabel = $profession->profession ?? $profession->title ?? 'Service';
                        $professionDesc  = $profession->description ?? $profession->desc ?? '';
                        $imgUrl = $svcImgs[$idx % count($svcImgs)];
                        $iconClass = $svcIcons[$idx % count($svcIcons)];
                    @endphp
                    <div class="svc-card reveal reveal-delay-{{ ($idx % 4) + 1 }}">
                        <div class="svc-img-wrap">
                            <img class="svc-img" src="{{ $imgUrl }}" alt="{{ $professionLabel }}" loading="lazy">
                            <div class="svc-img-overlay"></div>
                            <div class="svc-icon-chip"><i class="fas {{ $iconClass }}"></i></div>
                            <div class="svc-num-chip">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <div class="svc-body">
                            <div class="svc-title">{{ $professionLabel }}</div>
                            @if($professionDesc)
                            <div class="svc-desc">{{ $professionDesc }}</div>
                            @endif
                            <a href="#contact" class="svc-link">
                                Learn More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                    @foreach($dummyServices as $idx => $svc)
                    <div class="svc-card reveal reveal-delay-{{ ($idx % 4) + 1 }}">
                        <div class="svc-img-wrap">
                            <img class="svc-img" src="{{ $svc['img'] }}" alt="{{ $svc['title'] }}" loading="lazy">
                            <div class="svc-img-overlay"></div>
                            <div class="svc-icon-chip"><i class="fas {{ $svc['icon'] }}"></i></div>
                            <div class="svc-num-chip">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        <div class="svc-body">
                            <div class="svc-title">{{ $svc['title'] }}</div>
                            <div class="svc-desc">{{ $svc['desc'] }}</div>
                            <a href="#contact" class="svc-link">
                                Learn More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        <!-- ─── ④ WHY CHOOSE US ─── -->
        <div class="why-section reveal">
            <div class="why-top">
                <h2 class="why-title">
                    Why Choose<br>
                    <span class="gold">Us?</span>
                </h2>
                <p class="why-desc">
                    We combine local market expertise with a white-glove approach, ensuring every client receives personalised, results-driven service.
                </p>
            </div>
            <div class="why-grid">
                <div class="why-item">
                    <div class="why-icon"><i class="fas fa-award"></i></div>
                    <div class="why-num">500+</div>
                    <div class="why-label">Properties Sold</div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><i class="fas fa-clock"></i></div>
                    <div class="why-num">12+</div>
                    <div class="why-label">Years Experience</div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><i class="fas fa-star"></i></div>
                    <div class="why-num">98%</div>
                    <div class="why-label">Client Satisfaction</div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><i class="fas fa-city"></i></div>
                    <div class="why-num">50+</div>
                    <div class="why-label">Cities Covered</div>
                </div>
            </div>
        </div>

        <!-- ─── ⑤ PROPERTY GALLERY ─── -->
        @if($userdata->isFeatureVisible('photo_gallery') && $professional_photos->count() > 0)
        <div class="gallery-section">
            <div class="reveal">
                <div class="sec-eyebrow"><span></span> Featured Listings <span></span></div>
                <h2 class="sec-title">Property <span class="hl">Gallery</span></h2>
                <p class="sec-sub">Explore our curated selection of premium properties currently available.</p>
            </div>

            <div class="gallery-grid">
                @foreach($professional_photos->take(6) as $photo)
                @php
                    $photoValue = $photo->image ?? $photo->name ?? '';
                    if ($photoValue) {
                        if (\Illuminate\Support\Str::startsWith($photoValue, ['http://','https://'])) {
                            $photoUrl = $photoValue;
                        } elseif (\Illuminate\Support\Str::startsWith($photoValue, ['uploads/','frontend/','storage/'])) {
                            $photoUrl = asset($photoValue);
                        } else {
                            $photoUrl = asset('uploads/customer/'.$photoValue);
                        }
                    } else {
                        $photoUrl = 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&auto=format&fit=crop';
                    }
                @endphp
                <div class="prop-card reveal reveal-delay-{{ ($loop->index % 3) + 1 }}">
                    <div class="prop-img-wrap">
                        <img class="prop-img" src="{{ $photoUrl }}" alt="{{ $photo->title ?? 'Property' }}" loading="lazy">
                        <span class="prop-tag">For Sale</span>
                    </div>
                    <div class="prop-body">
                        <div class="prop-title">{{ $photo->title ?? 'Premium Property' }}</div>
                        @if($photo->price ?? false)
                        <div class="prop-price">{{ $photo->price }}</div>
                        @endif
                        <div class="prop-meta">
                            @if($photo->bedrooms ?? false)
                            <span class="prop-meta-item"><i class="fas fa-bed"></i>{{ $photo->bedrooms }} Bed</span>
                            @endif
                            @if($photo->bathrooms ?? false)
                            <span class="prop-meta-item"><i class="fas fa-bath"></i>{{ $photo->bathrooms }} Bath</span>
                            @endif
                            @if($photo->area ?? false)
                            <span class="prop-meta-item"><i class="fas fa-ruler-combined"></i>{{ $photo->area }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div><!-- /main-wrap -->

    <!-- ═══════════════════════════════════════════════════
         ⑥ CTA — full-bleed
    ════════════════════════════════════════════════════ -->
    <section class="cta-full" id="contact">
        <div class="cta-inner reveal">
            <div class="cta-eyebrow">✦ Ready To Move? ✦</div>
            <h2 class="cta-title">Find Your Dream<br>Property Today</h2>
            <p class="cta-copy">
                Let's discuss your real estate goals. Whether buying, selling, or investing — we're here to guide you every step of the way.
            </p>
            <div class="cta-btns">
                @if($userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="cta-btn-white">
                    <i class="fas fa-phone"></i> Call Me Now
                </a>
                @endif
                @if(isset($social->whatsapp) && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" class="cta-btn-outline" target="_blank">
                    <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                </a>
                @else
                <a href="mailto:{{ $userdata->email ?? 'contact@urbannest.com' }}" class="cta-btn-outline">
                    <i class="fas fa-envelope"></i> Send Email
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════
         FOOTER
    ════════════════════════════════════════════════════ -->
    <footer class="site-footer">
        <div class="footer-brand">
            <i class="fas fa-building"></i>
            {{ $userdata->name ?? 'Urban Nest Paradise' }}
        </div>
        <p class="footer-copy">
            Digital Card by <a href="{{ url('/') }}">Fastap</a> &nbsp;·&nbsp; All rights reserved © {{ date('Y') }}
        </p>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])

    <!-- ═══════════════════════════════════════════════════
         SCROLL REVEAL JS
    ════════════════════════════════════════════════════ -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                },
                { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
            );

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>