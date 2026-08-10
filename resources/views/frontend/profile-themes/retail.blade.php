<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Store' }} - Shop With Us</title>

    @php
        $websetting = App\Models\websetting::first();

        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile' => 1, 'quali' => 1, 'service' => 1, 'thought' => 1,
                'personal' => 1, 'profess' => 1, 'videos' => 1, 'product' => 1,
                'social_link' => 1, 'upload_file' => 1, 'client' => 1,
                'menu_section' => 1, 'reservation_section' => 1, 'property_listings' => 1,
                'showreel' => 1, 'team_section' => 1, 'pricing_section' => 1, 'booking_section' => 1,
            ];
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal',
                    'profess','videos','product','social_link','upload_file','client',
                    'menu_section','reservation_section','property_listings','showreel',
                    'team_section','pricing_section','booking_section'], 1);
            }
        }

        $themeColor = $theme->color ?? '#ec4899';

        // Product category images — unique per card
        $catImages = [
            'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=600&h=700&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=700&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&h=700&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=600&h=700&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=600&h=700&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&h=700&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1607082349566-187342175e2f?w=600&h=700&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=600&h=700&fit=crop&auto=format',
        ];

        // Gallery fallback
        $galleryFallback = [
            'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=700&h=700&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=500&h=500&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=500&h=500&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?w=500&h=500&fit=crop&auto=format',
            'https://images.pexels.com/photos/2988633/pexels-photo-2988633.jpeg',
            'https://images.unsplash.com/photo-1485125639709-a60c3a500bf1?w=500&h=500&fit=crop&auto=format',
        ];
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --p:         {{ $themeColor }};
            --p-dark:    color-mix(in srgb, var(--p) 75%, #000);
            --p-light:   color-mix(in srgb, var(--p) 15%, #fff);
            --p-mid:     color-mix(in srgb, var(--p) 60%, #fff);
            --p-soft:    color-mix(in srgb, var(--p) 8%, #fff);
            --gold:      #f59e0b;
            --gold-lt:   #fef3c7;
            --text-dark: #111827;
            --text-mid:  #374151;
            --text-gray: #6b7280;
            --text-lt:   #9ca3af;
            --bg:        #fafafa;
            --white:     #ffffff;
            --border:    #f3f4f6;
            --shadow-sm: 0 2px 10px rgba(0,0,0,0.07);
            --shadow-md: 0 8px 28px rgba(0,0,0,0.10);
            --shadow-lg: 0 20px 55px rgba(0,0,0,0.14);
            --r-sm:  8px;
            --r-md:  16px;
            --r-lg:  24px;
            --r-xl:  36px;
            --ease:  cubic-bezier(.4,0,.2,1);
        }

        html { scroll-behavior: smooth; }
        body {
            font-family: 'Nunito', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ═══════════════════════
           PREVIEW BANNER
        ═══════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg, #7c3aed, #ec4899, #f97316);
            color: #fff;
            padding: 0.75rem 1rem;
            text-align: center;
            font-weight: 700;
            font-size: 0.85rem;
            position: sticky;
            top: 0;
            z-index: 3000;
            box-shadow: 0 3px 12px rgba(0,0,0,.18);
        }
        .preview-banner a { color: #fde68a; text-decoration: underline; font-weight: 900; }

        /* ═══════════════════════
           STICKY TOP NAV
        ═══════════════════════ */
        .top-nav {
            position: sticky;
            top: 0;
            z-index: 2000;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0.7rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: var(--shadow-sm);
        }
        .nav-logo {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            overflow: hidden;
            border: 2.5px solid var(--p);
            flex-shrink: 0;
            background: var(--p-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--p);
            font-size: 1.1rem;
        }
        .nav-logo img { width: 100%; height: 100%; object-fit: cover; }
        .nav-name {
            flex: 1;
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .nav-name small {
            display: block;
            font-size: 0.68rem;
            font-weight: 500;
            color: var(--text-gray);
            margin-top: -1px;
        }
        .nav-actions { display: flex; gap: 0.5rem; flex-shrink: 0; }
        .nav-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.25s var(--ease);
        }
        .nav-btn-call { background: var(--p); color: #fff; box-shadow: 0 4px 12px color-mix(in srgb, var(--p) 40%, transparent); }
        .nav-btn-call:hover { transform: scale(1.1); }
        .nav-btn-wa { background: #25d366; color: #fff; box-shadow: 0 4px 12px rgba(37,211,102,0.4); }
        .nav-btn-wa:hover { transform: scale(1.1); }

        /* ═══════════════════════
           HERO  (Different layout — split)
        ═══════════════════════ */
        .store-hero {
            position: relative;
            min-height: 500px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
        }

        /* LEFT: big image */
        .hero-img-side {
            position: relative;
            overflow: hidden;
            min-height: 500px;
        }
        .hero-img-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 8s ease;
            animation: slowZoom 12s ease-in-out infinite alternate;
        }
        @keyframes slowZoom {
            from { transform: scale(1.0); }
            to   { transform: scale(1.07); }
        }
        .hero-img-side::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, transparent 60%, var(--p-dark) 100%);
        }

        /* RIGHT: text content */
        .hero-text-side {
            background: linear-gradient(160deg, var(--p-dark) 0%, var(--p) 100%);
            padding: 3.5rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5rem;
            position: relative;
            overflow: hidden;
        }
        .hero-text-side::before {
            content: '';
            position: absolute;
            bottom: -80px; right: -80px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .hero-text-side::after {
            content: '';
            position: absolute;
            top: -60px; left: -40px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            padding: 0.35rem 1rem;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            width: fit-content;
            position: relative;
            z-index: 2;
        }

        .hero-store-logo {
            width: 80px;
            height: 80px;
            border-radius: var(--r-md);
            border: 3px solid rgba(255,255,255,0.8);
            overflow: hidden;
            background: #fff;
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
            position: relative;
            z-index: 2;
        }
        .hero-store-logo img { width: 100%; height: 100%; object-fit: cover; }
        .hero-logo-ph {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            background: var(--p-soft);
            color: var(--p);
            font-size: 2rem;
        }

        .hero-h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            position: relative;
            z-index: 2;
        }
        .hero-h1 em { font-style: italic; color: var(--gold); }

        .hero-sub {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.82);
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .hero-meta {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }
        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(255,255,255,0.15);
            border-radius: 50px;
            padding: 0.38rem 0.9rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: #fff;
        }
        .hero-chip i { font-size: 0.8rem; color: var(--gold); }

        .hero-stars {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 2;
        }
        .stars { color: var(--gold); font-size: 1rem; letter-spacing: 1px; }
        .rating-text { color: rgba(255,255,255,0.85); font-size: 0.82rem; font-weight: 600; }

        .hero-cta-btns {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }
        .hbtn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.6rem;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.88rem;
            text-decoration: none;
            transition: all 0.3s var(--ease);
            white-space: nowrap;
        }
        .hbtn-white { background: #fff; color: var(--p); box-shadow: 0 6px 20px rgba(0,0,0,0.18); }
        .hbtn-white:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(0,0,0,0.22); }
        .hbtn-outline { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.5); }
        .hbtn-outline:hover { background: rgba(255,255,255,0.15); transform: translateY(-3px); }

        /* ═══════════════════════
           SCROLLING STATS BAR
        ═══════════════════════ */
        .stats-bar {
            background: var(--p);
            overflow: hidden;
            position: relative;
        }
        .stats-scroll {
            display: flex;
            animation: marquee 18s linear infinite;
            white-space: nowrap;
            padding: 0.75rem 0;
        }
        .stats-scroll:hover { animation-play-state: paused; }
        @keyframes marquee {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .stat-item {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0 2.5rem;
            color: rgba(255,255,255,0.95);
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
        }
        .stat-dot { color: rgba(255,255,255,0.4); font-size: 0.5rem; }
        .stat-item i { color: var(--gold); }

        /* ═══════════════════════
           CATEGORIES SCROLL
        ═══════════════════════ */
        .categories-section {
            padding: 2rem 1.2rem 0;
            max-width: 1200px;
            margin: 0 auto;
        }
        .sec-label {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.2rem;
        }
        .sec-label-line {
            width: 4px;
            height: 22px;
            background: linear-gradient(to bottom, var(--p), var(--p-mid));
            border-radius: 4px;
            flex-shrink: 0;
        }
        .sec-label-text {
            font-size: 1.2rem;
            font-weight: 900;
            color: var(--text-dark);
        }
        .sec-label-sub {
            font-size: 0.78rem;
            color: var(--text-gray);
            font-weight: 500;
        }

        .cats-scroll {
            display: flex;
            gap: 0.75rem;
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: 0.5rem;
        }
        .cats-scroll::-webkit-scrollbar { display: none; }
        .cat-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.2rem;
            background: var(--white);
            border: 2px solid var(--border);
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-mid);
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.25s var(--ease);
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
        }
        .cat-pill:hover, .cat-pill.active {
            background: var(--p);
            color: #fff;
            border-color: var(--p);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px color-mix(in srgb, var(--p) 35%, transparent);
        }
        .cat-pill i { font-size: 0.85rem; }

        /* ═══════════════════════
           PRODUCTS MOSAIC
        ═══════════════════════ */
        .mosaic-section {
            padding: 2rem 1.2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .mosaic-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-auto-rows: 220px;
            gap: 1rem;
        }

        /* First card spans 2 cols + 2 rows */
        .mosaic-card:nth-child(1) { grid-column: span 2; grid-row: span 2; }
        /* 4th card spans 2 cols */
        .mosaic-card:nth-child(5) { grid-column: span 2; }

        .mosaic-card {
            position: relative;
            border-radius: var(--r-lg);
            overflow: hidden;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: all 0.35s var(--ease);
        }
        .mosaic-card:hover { transform: scale(1.03); box-shadow: var(--shadow-lg); z-index: 5; }

        .mc-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s var(--ease);
        }
        .mosaic-card:hover .mc-img { transform: scale(1.1); }

        .mc-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(0,0,0,0.75) 0%,
                rgba(0,0,0,0.2) 50%,
                transparent 100%
            );
        }

        .mc-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.2rem;
            z-index: 2;
        }
        .mc-tag {
            display: inline-block;
            background: var(--p);
            color: #fff;
            padding: 0.2rem 0.7rem;
            border-radius: 50px;
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.4rem;
        }
        .mc-title {
            font-size: 1rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.25;
            text-shadow: 0 1px 4px rgba(0,0,0,0.3);
        }
        .mosaic-card:nth-child(1) .mc-title { font-size: 1.4rem; }
        .mc-sub {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.78);
            margin-top: 0.3rem;
            line-height: 1.4;
        }

        .mc-shop-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--p);
            font-size: 0.9rem;
            opacity: 0;
            transform: translateY(-8px);
            transition: all 0.3s var(--ease);
            z-index: 3;
        }
        .mosaic-card:hover .mc-shop-btn { opacity: 1; transform: translateY(0); }

        /* ═══════════════════════
           PROMO DIAGONAL STRIP
        ═══════════════════════ */
        .promo-strip {
            position: relative;
            margin: 2rem 0;
            overflow: hidden;
        }
        .promo-strip-bg {
            background: linear-gradient(135deg, var(--p-dark) 0%, var(--p) 50%, var(--gold) 100%);
            padding: 3rem 1.5rem;
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 0, 100% 8%, 100% 100%, 0 92%);
        }
        .promo-strip-bg::before {
            content: '';
            position: absolute;
            top: -40%; right: -10%;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .promo-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }
        .promo-left {}
        .promo-eyebrow {
            font-size: 0.75rem;
            font-weight: 800;
            color: rgba(255,255,255,0.75);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }
        .promo-headline {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
        }
        .promo-headline em { font-style: italic; color: var(--gold-lt); }
        .promo-desc { font-size: 0.92rem; color: rgba(255,255,255,0.82); margin-top: 0.6rem; max-width: 420px; }

        .promo-right { flex-shrink: 0; text-align: center; }
        .promo-badge-circle {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            border: 3px dashed rgba(255,255,255,0.4);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin: 0 auto 1rem;
            animation: spinSlow 12s linear infinite;
        }
        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        .promo-pct { font-size: 2.5rem; font-weight: 900; color: var(--gold-lt); line-height: 1; animation: spinSlowRev 12s linear infinite; }
        .promo-pct-label { font-size: 0.72rem; font-weight: 700; letter-spacing: 1px; animation: spinSlowRev 12s linear infinite; }
        @keyframes spinSlowRev {
            from { transform: rotate(0deg); }
            to   { transform: rotate(-360deg); }
        }
        .promo-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: #fff;
            color: var(--p-dark);
            padding: 0.85rem 2rem;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.9rem;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            transition: all 0.3s var(--ease);
        }
        .promo-cta-btn:hover { transform: translateY(-4px); box-shadow: 0 14px 36px rgba(0,0,0,0.28); }

        /* ═══════════════════════
           WHY SHOP HERE
        ═══════════════════════ */
        .why-section {
            padding: 2rem 1.2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .why-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }
        .why-card {
            background: var(--white);
            border-radius: var(--r-lg);
            padding: 1.8rem 1.2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: all 0.3s var(--ease);
            position: relative;
            overflow: hidden;
        }
        .why-card::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--p), var(--gold));
            transform: scaleX(0);
            transition: transform 0.3s var(--ease);
        }
        .why-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); }
        .why-card:hover::before { transform: scaleX(1); }
        .why-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: var(--p-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.4rem;
            color: var(--p);
            transition: all 0.3s var(--ease);
        }
        .why-card:hover .why-icon { background: var(--p); color: #fff; }
        .why-title { font-size: 0.92rem; font-weight: 800; color: var(--text-dark); margin-bottom: 0.3rem; }
        .why-desc { font-size: 0.78rem; color: var(--text-gray); line-height: 1.6; }

        /* ═══════════════════════
           STORE HOURS — Timeline
        ═══════════════════════ */
        .hours-section {
            padding: 2rem 1.2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .hours-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: center;
        }
        .hours-img-block {
            position: relative;
            border-radius: var(--r-lg);
            overflow: hidden;
            min-height: 300px;
            box-shadow: var(--shadow-lg);
        }
        .hours-img-block img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 300px;
        }
        .hours-img-block::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, color-mix(in srgb, var(--p) 70%, #000) 0%, transparent 60%);
        }
        .hours-img-caption {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            z-index: 2;
            color: #fff;
        }
        .hours-img-caption .big { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 800; line-height: 1.1; }
        .hours-img-caption .sml { font-size: 0.85rem; opacity: 0.85; margin-top: 0.3rem; }

        .hours-list { display: flex; flex-direction: column; gap: 0.75rem; }
        .hours-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.2rem;
            background: var(--white);
            border-radius: var(--r-md);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: all 0.25s var(--ease);
        }
        .hours-row:hover { border-color: var(--p); transform: translateX(4px); }
        .hours-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--p);
            flex-shrink: 0;
            box-shadow: 0 0 0 4px var(--p-light);
        }
        .hours-row.closed .hours-dot { background: var(--text-lt); box-shadow: none; }
        .hours-day-name { flex: 1; font-weight: 700; font-size: 0.9rem; color: var(--text-dark); }
        .hours-time-val { font-size: 0.88rem; font-weight: 600; color: var(--p); }
        .hours-row.closed .hours-time-val { color: var(--text-lt); }

        /* ═══════════════════════
           INSTAGRAM GALLERY
        ═══════════════════════ */
        .gallery-section {
            padding: 2rem 1.2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .gallery-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }
        .gallery-follow-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #f58529, #dd2a7b, #8134af);
            color: #fff;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s var(--ease);
        }
        .gallery-follow-btn:hover { transform: scale(1.05); box-shadow: 0 6px 18px rgba(221,42,123,0.35); }

        .insta-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.6rem;
        }
        .insta-item {
            aspect-ratio: 1;
            border-radius: var(--r-md);
            overflow: hidden;
            position: relative;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }
        .insta-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s var(--ease);
        }
        .insta-item:hover img { transform: scale(1.1); }
        .insta-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, color-mix(in srgb, var(--p) 80%, #000), color-mix(in srgb, var(--p) 50%, transparent));
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
        }
        .insta-item:hover .insta-overlay { opacity: 1; }
        .insta-item:nth-child(4) { grid-column: span 2; aspect-ratio: 2/1; }

        /* ═══════════════════════
           CONTACT SPLIT CARD
        ═══════════════════════ */
        .contact-section {
            padding: 2rem 1.2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .contact-split {
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            gap: 0;
            border-radius: var(--r-xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }
        .contact-map-side {
            background-image: url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=700&h=600&fit=crop&auto=format');
            background-size: cover;
            background-position: center;
            position: relative;
            min-height: 320px;
        }
        .contact-map-side::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, color-mix(in srgb, var(--p) 70%, #000) 0%, transparent 60%);
        }
        .contact-map-caption {
            position: absolute;
            bottom: 1.8rem;
            left: 1.8rem;
            z-index: 2;
            color: #fff;
        }
        .contact-map-caption .big { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 800; }
        .contact-map-caption .sml { font-size: 0.82rem; opacity: 0.85; }

        .contact-info-side {
            background: var(--white);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5rem;
        }
        .contact-info-side h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .contact-items { display: flex; flex-direction: column; gap: 1rem; }
        .ci-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1rem;
            background: var(--bg);
            border-radius: var(--r-md);
            text-decoration: none;
            color: inherit;
            border: 1px solid var(--border);
            transition: all 0.25s var(--ease);
        }
        .ci-row:hover { border-color: var(--p); background: var(--p-soft); transform: translateX(4px); }
        .ci-icon {
            width: 44px; height: 44px;
            border-radius: var(--r-sm);
            background: var(--p);
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px color-mix(in srgb, var(--p) 35%, transparent);
        }
        .ci-label { font-size: 0.7rem; color: var(--text-lt); font-weight: 700; text-transform: uppercase; letter-spacing: .7px; margin-bottom: 0.18rem; }
        .ci-val { font-size: 0.92rem; font-weight: 700; color: var(--text-dark); }

        /* ═══════════════════════
           BOTTOM CTA — Different
           (Two-tone split fullwidth)
        ═══════════════════════ */
        .bottom-cta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin: 3rem 0 0;
        }
        .bcta-left {
            background: linear-gradient(135deg, var(--p-dark), var(--p));
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            justify-content: center;
        }
        .bcta-right {
            position: relative;
            overflow: hidden;
            min-height: 260px;
        }
        .bcta-right img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 6s ease;
        }
        .bcta-right:hover img { transform: scale(1.05); }
        .bcta-right::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to left, transparent 40%, var(--p) 100%);
        }

        .bcta-eyebrow {
            font-size: 0.72rem;
            font-weight: 800;
            color: rgba(255,255,255,0.65);
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .bcta-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.5rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
        }
        .bcta-title em { font-style: italic; color: var(--gold); }
        .bcta-sub { font-size: 0.9rem; color: rgba(255,255,255,0.78); line-height: 1.6; }
        .bcta-btns { display: flex; gap: 0.8rem; flex-wrap: wrap; }
        .bcta-btn-main {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--gold);
            color: var(--text-dark);
            padding: 0.9rem 2rem;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.9rem;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(245,158,11,0.4);
            transition: all 0.3s var(--ease);
        }
        .bcta-btn-main:hover { transform: translateY(-4px); box-shadow: 0 14px 36px rgba(245,158,11,0.5); }
        .bcta-btn-sec {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(255,255,255,0.12);
            color: #fff;
            padding: 0.9rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.3s var(--ease);
        }
        .bcta-btn-sec:hover { background: rgba(255,255,255,0.22); transform: translateY(-4px); }

        /* ═══════════════════════
           SOCIAL STRIP
        ═══════════════════════ */
        .social-strip {
            background: var(--white);
            padding: 2.5rem 1.5rem;
            text-align: center;
            border-top: 1px solid var(--border);
        }
        .social-strip-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1.2rem;
        }
        .social-strip-title span { color: var(--p); }
        .social-row { display: flex; justify-content: center; gap: 0.8rem; flex-wrap: wrap; }
        .s-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.3rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s var(--ease);
        }
        .s-btn:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
        .s-fb   { background: #1877f2; color: #fff; }
        .s-ig   { background: linear-gradient(135deg,#f58529,#dd2a7b,#8134af); color: #fff; }
        .s-li   { background: #0077b5; color: #fff; }
        .s-tw   { background: #1da1f2; color: #fff; }
        .s-yt   { background: #ff0000; color: #fff; }
        .s-wa   { background: #25d366; color: #fff; }

        /* ═══════════════════════
           FLOATING BUTTONS
        ═══════════════════════ */
        .float-btns {
            position: fixed;
            bottom: 1.5rem;
            right: 1.2rem;
            z-index: 1500;
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
        }
        .float-btn {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(0,0,0,0.22);
            transition: all 0.3s var(--ease);
        }
        .float-btn:hover { transform: scale(1.15); }
        .fb-wa { background: #25d366; color: #fff; }
        .fb-call { background: var(--p); color: #fff; }

        /* ═══════════════════════
           FOOTER
        ═══════════════════════ */
        .store-footer {
            background: var(--text-dark);
            color: rgba(255,255,255,0.6);
            text-align: center;
            padding: 2rem 1.5rem;
            font-size: 0.82rem;
        }
        .store-footer a { color: var(--p-mid); text-decoration: none; font-weight: 700; }

        /* ═══════════════════════
           REVEAL ANIMATIONS
        ═══════════════════════ */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left {
            opacity: 0;
            transform: translateX(-28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right {
            opacity: 0;
            transform: translateX(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }

        /* ═══════════════════════
           RESPONSIVE
        ═══════════════════════ */
        @media (max-width: 900px) {
            .store-hero { grid-template-columns: 1fr; }
            .hero-img-side { min-height: 260px; max-height: 260px; }
            .hero-img-side::after { background: linear-gradient(to bottom, transparent 40%, var(--p-dark) 100%); }
            .hero-text-side { padding: 2.5rem 1.5rem; }
            .mosaic-grid { grid-template-columns: repeat(2,1fr); }
            .mosaic-card:nth-child(1) { grid-column: span 2; grid-row: span 1; }
            .mosaic-card:nth-child(5) { grid-column: span 2; }
            .hours-wrapper { grid-template-columns: 1fr; }
            .contact-split { grid-template-columns: 1fr; }
            .contact-map-side { min-height: 200px; }
            .bottom-cta { grid-template-columns: 1fr; }
            .bcta-right { min-height: 220px; }
        }

        @media (max-width: 600px) {
            .why-grid { grid-template-columns: repeat(2,1fr); }
            .insta-grid { grid-template-columns: repeat(3,1fr); }
            .insta-item:nth-child(4) { grid-column: span 1; aspect-ratio: 1; }
            .mosaic-grid { grid-template-columns: 1fr 1fr; grid-auto-rows: 160px; }
            .promo-inner { flex-direction: column; text-align: center; }
            .promo-desc { margin: 0 auto; }
            .bcta-left { padding: 2.5rem 1.5rem; }
            .contact-info-side { padding: 2rem 1.5rem; }
        }

        @media (max-width: 400px) {
            .mosaic-grid { grid-template-columns: 1fr; grid-auto-rows: 200px; }
            .mosaic-card:nth-child(1),
            .mosaic-card:nth-child(5) { grid-column: span 1; }
        }
    </style>
</head>
<body>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i>&nbsp; Preview Mode —
        <a href="{{ url('/signin') }}">Sign up free</a> to publish your store profile!
    </div>
    @endif

    <!-- ╔══════════════════════════════╗
         ║       STICKY TOP NAV         ║
         ╚══════════════════════════════╝ -->
    <nav class="top-nav">
        <div class="nav-logo">
            @if($userdata->profile ?? false)
                <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
            @else
                <i class="fas fa-store"></i>
            @endif
        </div>
        <div class="nav-name">
            {{ $userdata->name ?? 'Store Name' }}
            <small>{{ $userdata->desig ?? ($theme->name ?? 'Retail Store') }}</small>
        </div>
        <div class="nav-actions">
            @if($userdata->mobile ?? false)
            <a href="tel:{{ $userdata->mobile }}" class="nav-btn nav-btn-call">
                <i class="fas fa-phone"></i>
            </a>
            @endif
            @if(($social ?? null) && ($social->whatsapp ?? false))
            <a href="https://wa.me/{{ $social->whatsapp }}" class="nav-btn nav-btn-wa">
                <i class="fab fa-whatsapp"></i>
            </a>
            @endif
        </div>
    </nav>

    <!-- ╔══════════════════════════════╗
         ║     SPLIT HERO               ║
         ╚══════════════════════════════╝ -->
    <section class="store-hero">
        <!-- Image Side -->
        <div class="hero-img-side">
            @if($userdata->banner ?? false)
                <img src="{{ url('public/frontend/user_images', $userdata->banner) }}" alt="Store Banner">
            @else
                <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=900&h=700&fit=crop&auto=format" alt="Store">
            @endif
        </div>

        <!-- Text Side -->
        <div class="hero-text-side">
            <div class="hero-tag">
                <i class="fas fa-store"></i> Official Store
            </div>

            <div class="hero-store-logo">
                @if($userdata->profile ?? false)
                    <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
                @else
                    <div class="hero-logo-ph"><i class="fas fa-store"></i></div>
                @endif
            </div>

            <h1 class="hero-h1">
                Welcome to<br>
                <em>{{ $userdata->name ?? 'Our Store' }}</em>
            </h1>

            <p class="hero-sub">
                {{ $userdata->desig ?? ($theme->name ?? 'Your one-stop destination for quality products and great deals.') }}
            </p>

            <div class="hero-stars">
                <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                <span class="rating-text">4.8 · 500+ Happy Customers</span>
            </div>

            <div class="hero-meta">
                @if($userdata->city ?? false)
                <span class="hero-chip"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}</span>
                @endif
                <span class="hero-chip"><i class="fas fa-truck"></i> Delivery Available</span>
                <span class="hero-chip"><i class="fas fa-shield-alt"></i> Trusted Store</span>
            </div>

            <div class="hero-cta-btns">
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="hbtn hbtn-white">
                    <i class="fas fa-shopping-bag"></i> Shop Now
                </a>
                @endif
                @if(($social ?? null) && ($social->whatsapp ?? false))
                <a href="https://wa.me/{{ $social->whatsapp }}" class="hbtn hbtn-outline">
                    <i class="fab fa-whatsapp"></i> Order via WhatsApp
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ╔══════════════════════════════╗
         ║     SCROLLING STATS BAR      ║
         ╚══════════════════════════════╝ -->
    <div class="stats-bar">
        <div class="stats-scroll">
            @php $statItems = [
                ['icon'=>'fas fa-truck','text'=>'Free Delivery on Orders Above ₹500'],
                ['icon'=>'fas fa-shield-alt','text'=>'100% Genuine Products'],
                ['icon'=>'fas fa-undo','text'=>'Easy Returns & Exchange'],
                ['icon'=>'fas fa-star','text'=>'Rated 4.8 by 500+ Customers'],
                ['icon'=>'fas fa-tags','text'=>'Best Prices Guaranteed'],
                ['icon'=>'fas fa-phone','text'=>'Call Us for Best Deals'],
                ['icon'=>'fas fa-truck','text'=>'Free Delivery on Orders Above ₹500'],
                ['icon'=>'fas fa-shield-alt','text'=>'100% Genuine Products'],
                ['icon'=>'fas fa-undo','text'=>'Easy Returns & Exchange'],
                ['icon'=>'fas fa-star','text'=>'Rated 4.8 by 500+ Customers'],
                ['icon'=>'fas fa-tags','text'=>'Best Prices Guaranteed'],
                ['icon'=>'fas fa-phone','text'=>'Call Us for Best Deals'],
            ]; @endphp
            @foreach($statItems as $s)
            <span class="stat-item">
                <i class="{{ $s['icon'] }}"></i> {{ $s['text'] }}
                <span class="stat-dot">●</span>
            </span>
            @endforeach
        </div>
    </div>

    <!-- ╔══════════════════════════════╗
         ║   CATEGORIES HORIZONTAL      ║
         ╚══════════════════════════════╝ -->
    <div class="categories-section reveal">
        <div class="sec-label">
            <div class="sec-label-line"></div>
            <div>
                <div class="sec-label-text">Shop by Category</div>
                <div class="sec-label-sub">Browse our collections</div>
            </div>
        </div>
        <div class="cats-scroll">
            <div class="cat-pill active"><i class="fas fa-th-large"></i> All Items</div>
            <div class="cat-pill"><i class="fas fa-tshirt"></i> Clothing</div>
            <div class="cat-pill"><i class="fas fa-gem"></i> Accessories</div>
            <div class="cat-pill"><i class="fas fa-shoe-prints"></i> Footwear</div>
            <div class="cat-pill"><i class="fas fa-spray-can"></i> Beauty</div>
            <div class="cat-pill"><i class="fas fa-couch"></i> Home Decor</div>
            <div class="cat-pill"><i class="fas fa-mobile-alt"></i> Electronics</div>
            <div class="cat-pill"><i class="fas fa-utensils"></i> Food &amp; Snacks</div>
            @if(($professions ?? collect())->count() > 0)
                @foreach($professions->take(5) as $p)
                <div class="cat-pill"><i class="fas fa-tag"></i> {{ $p->title ?? 'Category' }}</div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- ╔══════════════════════════════╗
         ║    PRODUCTS MOSAIC GRID      ║
         ╚══════════════════════════════╝ -->
    <div class="mosaic-section reveal">
        <div class="sec-label">
            <div class="sec-label-line"></div>
            <div>
                <div class="sec-label-text">Featured Collections</div>
                <div class="sec-label-sub">What we offer</div>
            </div>
        </div>
        <div class="mosaic-grid">
            @if(($professions ?? collect())->count() > 0)
                @php $mIdx = 0; @endphp
                @foreach($professions as $profession)
                @php
                    $mImg = $catImages[$mIdx % count($catImages)];
                    $mIdx++;
                @endphp
                <div class="mosaic-card">
                    <img src="{{ $mImg }}"
                         alt="{{ $profession->title ?? 'Product' }}"
                         class="mc-img" loading="lazy">
                    <div class="mc-overlay"></div>
                    <div class="mc-shop-btn"><i class="fas fa-arrow-right"></i></div>
                    <div class="mc-content">
                        <div class="mc-tag">Shop Now</div>
                        <div class="mc-title">{{ $profession->title ?? 'Collection' }}</div>
                        @if($profession->desc ?? false)
                        <div class="mc-sub">{{ Str::limit($profession->desc, 55) }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                @php
                    $defaultCats = [
                        ['img'=>$catImages[0], 'title'=>'Fashion &amp; Clothing', 'sub'=>'Latest trends for every season'],
                        ['img'=>$catImages[1], 'title'=>'Footwear', 'sub'=>'Comfort meets style'],
                        ['img'=>$catImages[2], 'title'=>'Accessories', 'sub'=>'Complete your look'],
                        ['img'=>$catImages[3], 'title'=>'Beauty &amp; Care', 'sub'=>'Skincare &amp; wellness'],
                        ['img'=>$catImages[4], 'title'=>'Jewellery', 'sub'=>'Elegant collections'],
                        ['img'=>$catImages[5], 'title'=>'Home Decor', 'sub'=>'Transform your space'],
                    ];
                @endphp
                @foreach($defaultCats as $cat)
                <div class="mosaic-card">
                    <img src="{{ $cat['img'] }}" alt="{{ $cat['title'] }}" class="mc-img" loading="lazy">
                    <div class="mc-overlay"></div>
                    <div class="mc-shop-btn"><i class="fas fa-arrow-right"></i></div>
                    <div class="mc-content">
                        <div class="mc-tag">Explore</div>
                        <div class="mc-title">{!! $cat['title'] !!}</div>
                        <div class="mc-sub">{{ $cat['sub'] }}</div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- ╔══════════════════════════════╗
         ║   PROMO DIAGONAL STRIP       ║
         ╚══════════════════════════════╝ -->
    <div class="promo-strip reveal">
        <div class="promo-strip-bg">
            <div class="promo-inner">
                <div class="promo-left">
                    <div class="promo-eyebrow">🎉 Limited Time Offer</div>
                    <div class="promo-headline">
                        Exclusive <em>Deals</em><br>Just for You
                    </div>
                    <p class="promo-desc">Get amazing discounts on our bestsellers. Call or WhatsApp us to know today's special offers.</p>
                    <div style="margin-top:1.5rem; display:flex; gap:1rem; flex-wrap:wrap;">
                        @if($userdata->mobile ?? false)
                        <a href="tel:{{ $userdata->mobile }}" class="promo-cta-btn">
                            <i class="fas fa-phone"></i> Grab the Deal
                        </a>
                        @endif
                        @if(($social ?? null) && ($social->whatsapp ?? false))
                        <a href="https://wa.me/{{ $social->whatsapp }}" class="promo-cta-btn" style="background:var(--gold-lt); color:#78350f;">
                            <i class="fab fa-whatsapp"></i> WhatsApp Us
                        </a>
                        @endif
                    </div>
                </div>
                <div class="promo-right">
                    <div class="promo-badge-circle">
                        <div class="promo-pct">UP TO</div>
                        <div class="promo-pct" style="font-size:3rem; line-height:1;">50%</div>
                        <div class="promo-pct-label">OFF</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ╔══════════════════════════════╗
         ║     WHY SHOP HERE            ║
         ╚══════════════════════════════╝ -->
    <div class="why-section reveal">
        <div class="sec-label">
            <div class="sec-label-line"></div>
            <div>
                <div class="sec-label-text">Why Shop With Us?</div>
                <div class="sec-label-sub">Your trust, our promise</div>
            </div>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-award"></i></div>
                <div class="why-title">Quality Assured</div>
                <div class="why-desc">Every product is carefully quality-checked before delivery</div>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-truck-fast"></i></div>
                <div class="why-title">Fast Delivery</div>
                <div class="why-desc">Same-day and next-day delivery options available locally</div>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-tags"></i></div>
                <div class="why-title">Best Prices</div>
                <div class="why-desc">Competitive pricing with no hidden charges ever</div>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-undo-alt"></i></div>
                <div class="why-title">Easy Returns</div>
                <div class="why-desc">Hassle-free return and exchange policy for all items</div>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-headset"></i></div>
                <div class="why-title">24/7 Support</div>
                <div class="why-desc">Always here to help via call, WhatsApp, or email</div>
            </div>
        </div>
    </div>

    <!-- ╔══════════════════════════════╗
         ║   STORE HOURS — TIMELINE     ║
         ╚══════════════════════════════╝ -->
    <div class="hours-section reveal">
        <div class="sec-label">
            <div class="sec-label-line"></div>
            <div>
                <div class="sec-label-text">Store Hours</div>
                <div class="sec-label-sub">When to visit us</div>
            </div>
        </div>
        <div class="hours-wrapper">
            <div class="hours-img-block reveal-left">
                <img src="https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=700&h=500&fit=crop&auto=format" alt="Store">
                <div class="hours-img-caption">
                    <div class="big">We're<br>Open!</div>
                    <div class="sml">Come visit us today</div>
                </div>
            </div>
            <div class="hours-list reveal-right">
                <div class="hours-row">
                    <div class="hours-dot"></div>
                    <div class="hours-day-name">Monday – Friday</div>
                    <div class="hours-time-val">10:00 AM – 9:00 PM</div>
                </div>
                <div class="hours-row">
                    <div class="hours-dot"></div>
                    <div class="hours-day-name">Saturday</div>
                    <div class="hours-time-val">9:00 AM – 10:00 PM</div>
                </div>
                <div class="hours-row">
                    <div class="hours-dot"></div>
                    <div class="hours-day-name">Sunday</div>
                    <div class="hours-time-val">10:00 AM – 7:00 PM</div>
                </div>
                <div class="hours-row" style="background:var(--gold-lt); border-color:#f59e0b;">
                    <div class="hours-dot" style="background:#f59e0b; box-shadow:0 0 0 4px #fde68a;"></div>
                    <div class="hours-day-name" style="color:#92400e;">Public Holidays</div>
                    <div class="hours-time-val" style="color:#92400e;">11:00 AM – 6:00 PM</div>
                </div>
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="hbtn hbtn-white" style="background:var(--p);color:#fff;border-radius:var(--r-md);justify-content:center;margin-top:.5rem;">
                    <i class="fas fa-phone"></i> Call for Timings: {{ $userdata->mobile }}
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- ╔══════════════════════════════╗
         ║    INSTAGRAM GALLERY         ║
         ╚══════════════════════════════╝ -->
    <div class="gallery-section reveal">
        <div class="gallery-header">
            <div class="sec-label" style="margin-bottom:0;">
                <div class="sec-label-line"></div>
                <div>
                    <div class="sec-label-text">Store Gallery</div>
                    <div class="sec-label-sub">See our products &amp; space</div>
                </div>
            </div>
            @if(($social ?? null) && ($social->instagram ?? false))
            <a href="{{ $social->instagram }}" target="_blank" class="gallery-follow-btn">
                <i class="fab fa-instagram"></i> Follow on Instagram
            </a>
            @endif
        </div>
        <div class="insta-grid">
            @if(($portfolios ?? collect())->count() > 0)
                @foreach($portfolios->take(6) as $portfolio)
                @php
                    $imgs = json_decode($portfolio->image, true);
                    $gUrl = ($imgs && count($imgs) > 0)
                        ? url('public/frontend/portfolio/'.$imgs[0])
                        : $galleryFallback[$loop->index % count($galleryFallback)];
                @endphp
                <div class="insta-item">
                    <img src="{{ $gUrl }}" alt="Gallery" loading="lazy">
                    <div class="insta-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
                @endforeach
            @else
                @foreach($galleryFallback as $gi)
                <div class="insta-item">
                    <img src="{{ $gi }}" alt="Store" loading="lazy">
                    <div class="insta-overlay"><i class="fas fa-search-plus"></i></div>
                </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- ╔══════════════════════════════╗
         ║   CONTACT SPLIT CARD         ║
         ╚══════════════════════════════╝ -->
    <div class="contact-section reveal">
        <div class="sec-label">
            <div class="sec-label-line"></div>
            <div>
                <div class="sec-label-text">Find &amp; Contact Us</div>
                <div class="sec-label-sub">We'd love to hear from you</div>
            </div>
        </div>
        <div class="contact-split">
            <div class="contact-map-side">
                <div class="contact-map-caption">
                    <div class="big">Visit Our<br>Store</div>
                    <div class="sml">
                        @if($userdata->city ?? false)
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}
                        @else
                        We're waiting for you
                        @endif
                    </div>
                </div>
            </div>
            <div class="contact-info-side">
                <h3>Get in Touch</h3>
                <div class="contact-items">
                    @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="ci-row">
                        <div class="ci-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <div class="ci-label">Phone</div>
                            <div class="ci-val">{{ $userdata->mobile }}</div>
                        </div>
                    </a>
                    @endif
                    @if($userdata->email ?? false)
                    <a href="mailto:{{ $userdata->email }}" class="ci-row">
                        <div class="ci-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div class="ci-label">Email</div>
                            <div class="ci-val">{{ $userdata->email }}</div>
                        </div>
                    </a>
                    @endif
                    @if($userdata->city ?? false)
                    <div class="ci-row">
                        <div class="ci-icon"><i class="fas fa-location-dot"></i></div>
                        <div>
                            <div class="ci-label">Location</div>
                            <div class="ci-val">{{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}</div>
                        </div>
                    </div>
                    @endif
                    @if(($social ?? null) && ($social->whatsapp ?? false))
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="ci-row">
                        <div class="ci-icon" style="background:#25d366;">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <div class="ci-label">WhatsApp</div>
                            <div class="ci-val">{{ $social->whatsapp }}</div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ╔══════════════════════════════╗
         ║   BOTTOM CTA — TWO-TONE      ║
         ╚══════════════════════════════╝ -->
    <div class="bottom-cta reveal">
        <div class="bcta-left">
            <div class="bcta-eyebrow">🛍️ Ready to Shop?</div>
            <h2 class="bcta-title">
                Your <em>Perfect Find</em><br>Is Waiting
            </h2>
            <p class="bcta-sub">
                Browse our collections, call for the latest offers, or WhatsApp your order directly to us.
            </p>
            <div class="bcta-btns">
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="bcta-btn-main">
                    <i class="fas fa-phone"></i> Call: {{ $userdata->mobile }}
                </a>
                @endif
                @if(($social ?? null) && ($social->whatsapp ?? false))
                <a href="https://wa.me/{{ $social->whatsapp }}" class="bcta-btn-sec">
                    <i class="fab fa-whatsapp"></i> WhatsApp Order
                </a>
                @endif
            </div>
        </div>
        <div class="bcta-right">
            <img src="https://images.unsplash.com/photo-1607082349566-187342175e2f?w=900&h=600&fit=crop&auto=format" alt="Shopping">
        </div>
    </div>

    <!-- ╔══════════════════════════════╗
         ║     SOCIAL STRIP             ║
         ╚══════════════════════════════╝ -->
    @if($social ?? false)
    @if(($social->facebook ?? false) || ($social->instagram ?? false) || ($social->linkedin ?? false) || ($social->twitter ?? false) || ($social->youtube ?? false))
    <div class="social-strip reveal">
        <div class="social-strip-title">Follow <span>{{ $userdata->name ?? 'Our Store' }}</span> on Social Media</div>
        <div class="social-row">
            @if($social->facebook ?? false)
            <a href="{{ $social->facebook }}" target="_blank" class="s-btn s-fb">
                <i class="fab fa-facebook-f"></i> Facebook
            </a>
            @endif
            @if($social->instagram ?? false)
            <a href="{{ $social->instagram }}" target="_blank" class="s-btn s-ig">
                <i class="fab fa-instagram"></i> Instagram
            </a>
            @endif
            @if($social->linkedin ?? false)
            <a href="{{ $social->linkedin }}" target="_blank" class="s-btn s-li">
                <i class="fab fa-linkedin-in"></i> LinkedIn
            </a>
            @endif
            @if($social->twitter ?? false)
            <a href="{{ $social->twitter }}" target="_blank" class="s-btn s-tw">
                <i class="fab fa-x-twitter"></i> Twitter
            </a>
            @endif
            @if($social->youtube ?? false)
            <a href="{{ $social->youtube }}" target="_blank" class="s-btn s-yt">
                <i class="fab fa-youtube"></i> YouTube
            </a>
            @endif
        </div>
    </div>
    @endif
    @endif

    <!-- ╔══════════════════════════════╗
         ║       FOOTER                 ║
         ╚══════════════════════════════╝ -->
    <footer class="store-footer">
        <p style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:.3rem;">{{ $userdata->name ?? 'Our Store' }}</p>
        <p>{{ $userdata->desig ?? 'Your Trusted Retail Store' }}</p>
        <p style="margin-top:.5rem;">
            &copy; {{ date('Y') }} Digital Card by
            <a href="{{ url('/') }}">Fastap</a> · Professional Store Profiles
        </p>
    </footer>

    <!-- ╔══════════════════════════════╗
         ║   FLOATING ACTION BUTTONS    ║
         ╚══════════════════════════════╝ -->
    <div class="float-btns">
        @if(($social ?? null) && ($social->whatsapp ?? false))
        <a href="https://wa.me/{{ $social->whatsapp }}" class="float-btn fb-wa" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        @endif
        @if($userdata->mobile ?? false)
        <a href="tel:{{ $userdata->mobile }}" class="float-btn fb-call" title="Call Now">
            <i class="fas fa-phone"></i>
        </a>
        @endif
    </div>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id   ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview      ?? false
    ])

    <script>
    // Scroll reveal
    const allReveal = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    allReveal.forEach(el => obs.observe(el));

    // Category pill active state
    document.querySelectorAll('.cat-pill').forEach(pill => {
        pill.addEventListener('click', () => {
            document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
        });
    });
    </script>

</body>
</html>