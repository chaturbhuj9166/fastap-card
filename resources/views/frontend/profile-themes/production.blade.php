<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Production' }} - Production House</title>

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

        $themeColor  = $theme->color ?? '#dc2626';

        // Unique poster-style images per service
        $posterImages = [
            'https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=420&h=620&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=420&h=620&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=420&h=620&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=420&h=620&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=420&h=620&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1533488765986-dfa2a9939acd?w=420&h=620&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1440404653325-ab127d49abc1?w=420&h=620&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=420&h=620&fit=crop&auto=format',
        ];

        // Filmstrip portfolio fallback
     $filmFallback = [
    'https://images.unsplash.com/photo-1594909122845-11baa439b7bf?w=600&h=380&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=600&h=380&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=600&h=380&fit=crop&auto=format',

    // replacements
    'https://images.unsplash.com/photo-1519183071298-a2962eadc3e8?w=600&h=380&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1517602302552-471fe67acf66?w=600&h=380&fit=crop&auto=format',
    'https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=600&h=380&fit=crop&auto=format',
];
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --red:      {{ $themeColor }};
            --red-dark: color-mix(in srgb, var(--red) 75%, #000);
            --red-glow: color-mix(in srgb, var(--red) 40%, transparent);
            --gold:     #d4a017;
            --gold-lt:  #f5d060;
            --black:    #080808;
            --gray-1:   #111111;
            --gray-2:   #1a1a1a;
            --gray-3:   #252525;
            --gray-4:   #333333;
            --text-w:   #f5f5f5;
            --text-d:   #a0a0a0;
            --text-dd:  #666666;
            --ease:     cubic-bezier(.4,0,.2,1);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--black);
            color: var(--text-w);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ═══════════════════════════════
           PREVIEW BANNER
        ═══════════════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg, #7c3aed, #ec4899, #f97316);
            color: #fff;
            padding: 0.8rem 1rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.85rem;
            position: sticky;
            top: 0;
            z-index: 3000;
            box-shadow: 0 3px 12px rgba(0,0,0,.5);
        }
        .preview-banner a { color: #fde68a; text-decoration: underline; font-weight: 800; }

        /* ═══════════════════════════════
           ① ANIMATED FILM PERFORATIONS
        ═══════════════════════════════ */
        .film-perfs {
            position: relative;
            height: 36px;
            background: var(--gray-1);
            overflow: hidden;
            z-index: 100;
            display: flex;
            align-items: center;
        }
        .film-perfs-track {
            display: flex;
            gap: 0;
            animation: filmRoll 6s linear infinite;
            flex-shrink: 0;
            white-space: nowrap;
        }
        @keyframes filmRoll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .perf {
            width: 22px;
            height: 16px;
            background: var(--black);
            border-radius: 3px;
            margin: 0 14px;
            flex-shrink: 0;
            display: inline-block;
        }

        /* ═══════════════════════════════
           ② FULL-VIEWPORT CINEMATIC HERO
        ═══════════════════════════════ */
        .cinema-hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;
        }

        .hero-bg-img {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=1800&h=1000&fit=crop&auto=format');
            background-size: cover;
            background-position: center 30%;
            animation: heroKen 20s ease-in-out infinite alternate;
            z-index: 1;
        }
        @keyframes heroKen {
            from { transform: scale(1.0) translateX(0); }
            to   { transform: scale(1.08) translateX(-2%); }
        }

        /* cinematic letterbox bars */
        .hero-letterbox-top {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 80px;
            background: var(--black);
            z-index: 3;
        }
        .hero-letterbox-bot {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 70px;
            background: var(--black);
            z-index: 3;
        }

        /* vignette */
        .hero-vignette {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at center, transparent 30%, rgba(0,0,0,0.7) 100%);
            z-index: 2;
        }

        /* gradient overlay */
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(8,8,8,0.55) 0%,
                rgba(8,8,8,0.2) 40%,
                rgba(8,8,8,0.85) 85%,
                rgba(8,8,8,1) 100%
            );
            z-index: 2;
        }

        /* film grain CSS effect */
        .hero-grain {
            position: absolute;
            inset: 0;
            z-index: 3;
            opacity: 0.04;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");
            background-size: 200px 200px;
            animation: grainShift 0.15s steps(1) infinite;
            pointer-events: none;
        }
        @keyframes grainShift {
            0%   { background-position: 0 0; }
            25%  { background-position: -50px 30px; }
            50%  { background-position: 20px -40px; }
            75%  { background-position: -30px -20px; }
            100% { background-position: 40px 10px; }
        }

        .hero-content {
            position: relative;
            z-index: 5;
            padding: 0 2.5rem 5rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-scene-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--red);
            color: #fff;
            padding: 0.35rem 1rem;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 50%, calc(100% - 12px) 100%, 0 100%);
            padding-right: 1.8rem;
        }

        .hero-studio-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3.5rem, 9vw, 8rem);
            font-weight: 400;
            color: var(--text-w);
            line-height: 0.92;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            text-shadow: 0 4px 30px rgba(0,0,0,0.5);
        }
        .hero-studio-name .red-word { color: var(--red); }

        .hero-tagline {
            font-size: clamp(0.95rem, 1.8vw, 1.2rem);
            color: rgba(255,255,255,0.7);
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 2.5rem;
        }

        .hero-divider {
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--red), var(--gold));
            margin-bottom: 2.5rem;
        }

        .hero-meta-row {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }
        .hero-meta-item {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }
        .hmi-label {
            font-size: 0.65rem;
            color: var(--text-dd);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }
        .hmi-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.6rem;
            color: var(--gold-lt);
            letter-spacing: 1px;
        }

        .hero-btns {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .cbtn {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.9rem 2.2rem;
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            transition: all 0.3s var(--ease);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .cbtn-red {
            background: var(--red);
            color: #fff;
            clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 50%, calc(100% - 12px) 100%, 0 100%);
            padding-right: 2.8rem;
            box-shadow: 0 6px 24px var(--red-glow);
        }
        .cbtn-red:hover { background: var(--red-dark); transform: translateX(4px); box-shadow: 0 10px 32px var(--red-glow); }
        .cbtn-ghost {
            background: transparent;
            color: var(--text-w);
            border: 1.5px solid rgba(255,255,255,0.3);
        }
        .cbtn-ghost:hover { border-color: var(--gold); color: var(--gold); transform: translateY(-3px); }

        /* scroll indicator */
        .hero-scroll-hint {
            position: absolute;
            bottom: 85px;
            right: 2.5rem;
            z-index: 5;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255,255,255,0.4);
            font-size: 0.65rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .scroll-line {
            width: 1px;
            height: 50px;
            background: linear-gradient(to bottom, var(--red), transparent);
            animation: scrollPulse 1.5s ease infinite;
        }
        @keyframes scrollPulse {
            0%, 100% { opacity: 1; transform: scaleY(1); }
            50%       { opacity: 0.4; transform: scaleY(0.6); }
        }

        /* ═══════════════════════════════
           ③ "NOW SHOWING" MARQUEE BAND
        ═══════════════════════════════ */
        .marquee-band {
            background: var(--gold);
            overflow: hidden;
            position: relative;
        }
        .marquee-track {
            display: flex;
            animation: marqueeRoll 14s linear infinite;
            white-space: nowrap;
            padding: 0.6rem 0;
        }
        .marquee-track:hover { animation-play-state: paused; }
        @keyframes marqueeRoll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .marquee-item {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0 2.5rem;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.1rem;
            font-weight: 400;
            letter-spacing: 2px;
            color: var(--black);
            text-transform: uppercase;
        }
        .marquee-dot { font-size: 0.4rem; color: var(--red); }

        /* ═══════════════════════════════
           ④ CINEMA TICKET PROFILE CARD
        ═══════════════════════════════ */
        .ticket-section {
            padding: 4rem 2rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .ticket-card {
            display: grid;
            grid-template-columns: 200px 1px 1fr;
            align-items: stretch;
            background: var(--gray-2);
            border: 1px solid var(--gray-4);
            position: relative;
            overflow: hidden;
        }

        /* Corner cuts for ticket effect */
        .ticket-card::before {
            content: '';
            position: absolute;
            top: -14px; left: 186px;
            width: 28px; height: 28px;
            background: var(--black);
            border-radius: 50%;
            z-index: 5;
        }
        .ticket-card::after {
            content: '';
            position: absolute;
            bottom: -14px; left: 186px;
            width: 28px; height: 28px;
            background: var(--black);
            border-radius: 50%;
            z-index: 5;
        }

        /* ticket stub side */
        .ticket-stub {
            background: var(--gray-1);
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.2rem;
            text-align: center;
            position: relative;
        }
        .ticket-stub::after {
            content: 'ADMIT ONE';
            position: absolute;
            bottom: 1.2rem;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 3px;
            color: var(--text-dd);
        }

        .ticket-profile-img {
            width: 130px;
            height: 130px;
            object-fit: cover;
            clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
            border: 3px solid var(--red);
            box-shadow: 0 0 30px var(--red-glow);
        }
        .ticket-profile-icon {
            width: 130px;
            height: 130px;
            background: var(--gray-3);
            clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--red);
        }

        .stub-id {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1rem;
            letter-spacing: 2px;
            color: var(--text-d);
        }

        /* tear line */
        .ticket-tear {
            width: 1px;
            background: repeating-linear-gradient(
                to bottom,
                var(--gray-4) 0px,
                var(--gray-4) 8px,
                transparent 8px,
                transparent 14px
            );
            flex-shrink: 0;
        }

        /* main ticket body */
        .ticket-body {
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            position: relative;
        }

        /* diagonal background text */
        .ticket-body::before {
            content: 'PRODUCTION';
            position: absolute;
            bottom: 1rem; right: 1rem;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 5rem;
            color: rgba(255,255,255,0.02);
            letter-spacing: 6px;
            pointer-events: none;
            line-height: 1;
        }

        .ticket-header-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .ticket-studio-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            color: var(--text-w);
            letter-spacing: 2px;
            line-height: 1;
        }

        .ticket-rating {
            background: var(--red);
            color: #fff;
            padding: 0.3rem 0.8rem;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1rem;
            letter-spacing: 1px;
            flex-shrink: 0;
        }

        .ticket-desig {
            font-size: 0.82rem;
            color: var(--gold-lt);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 0.3rem;
        }

        .ticket-stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            border-top: 1px solid var(--gray-4);
            border-bottom: 1px solid var(--gray-4);
            padding: 1.2rem 0;
        }
        .ts-item { text-align: center; }
        .ts-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--red);
            line-height: 1;
            display: block;
        }
        .ts-lbl { font-size: 0.65rem; color: var(--text-dd); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }

        .ticket-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .t-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.8rem;
            background: var(--gray-3);
            border: 1px solid var(--gray-4);
            color: var(--text-d);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.25s;
        }
        .t-chip:hover { background: var(--red); color: #fff; border-color: var(--red); }
        .t-chip i { color: var(--gold); font-size: 0.7rem; }

        .ticket-btns { display: flex; gap: 0.8rem; flex-wrap: wrap; }

        /* ═══════════════════════════════
           PAGE BODY
        ═══════════════════════════════ */
        .cin-body { max-width: 1200px; margin: 0 auto; padding: 0 2rem 4rem; display: flex; flex-direction: column; gap: 5rem; }

        /* ═══════════════════════════════
           CINEMA SECTION HEADER
        ═══════════════════════════════ */
        .cin-sec-head {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        .csh-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 4rem;
            color: rgba(255,255,255,0.05);
            line-height: 1;
            letter-spacing: 2px;
            flex-shrink: 0;
            min-width: 60px;
        }
        .csh-line { width: 3px; height: 50px; background: linear-gradient(to bottom, var(--red), var(--gold)); flex-shrink: 0; }
        .csh-text {}
        .csh-overline {
            font-size: 0.65rem;
            color: var(--red);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .csh-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            color: var(--text-w);
            letter-spacing: 2px;
            line-height: 1;
        }

        /* ═══════════════════════════════
           ⑤ MOVIE POSTER SERVICE CARDS
        ═══════════════════════════════ */
        .posters-scroll {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--red) var(--gray-3);
            padding-bottom: 1rem;
        }
        .posters-scroll::-webkit-scrollbar { height: 4px; }
        .posters-scroll::-webkit-scrollbar-track { background: var(--gray-3); }
        .posters-scroll::-webkit-scrollbar-thumb { background: var(--red); border-radius: 2px; }

        .poster-card {
            flex-shrink: 0;
            width: 240px;
            height: 360px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s var(--ease);
        }
        .poster-card:hover { transform: scale(1.04); z-index: 5; box-shadow: 0 20px 50px rgba(0,0,0,0.6); }

        .poster-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s var(--ease);
        }
        .poster-card:hover .poster-img { transform: scale(1.08); }

        /* film frame border */
        .poster-frame {
            position: absolute;
            inset: 10px;
            border: 2px solid rgba(255,255,255,0.08);
            pointer-events: none;
            z-index: 2;
        }
        .poster-frame::before {
            content: '';
            position: absolute;
            top: -4px; left: -4px;
            width: 20px; height: 20px;
            border-top: 3px solid var(--red);
            border-left: 3px solid var(--red);
        }
        .poster-frame::after {
            content: '';
            position: absolute;
            bottom: -4px; right: -4px;
            width: 20px; height: 20px;
            border-bottom: 3px solid var(--red);
            border-right: 3px solid var(--red);
        }

        .poster-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(0,0,0,0.92) 0%,
                rgba(0,0,0,0.3) 50%,
                rgba(0,0,0,0.1) 100%
            );
            z-index: 1;
        }

        .poster-scene-num {
            position: absolute;
            top: 1rem;
            left: 1rem;
            width: 30px;
            height: 30px;
            background: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1rem;
            color: #fff;
            z-index: 3;
        }

        .poster-content {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 1.2rem;
            z-index: 3;
        }
        .poster-genre {
            font-size: 0.6rem;
            color: var(--gold-lt);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }
        .poster-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            color: #fff;
            letter-spacing: 1px;
            line-height: 1.15;
        }
        .poster-desc {
            font-size: 0.73rem;
            color: rgba(255,255,255,0.6);
            line-height: 1.5;
            margin-top: 0.4rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s var(--ease);
        }
        .poster-card:hover .poster-desc { max-height: 80px; }

        /* ═══════════════════════════════
           ⑥ HORIZONTAL FILMSTRIP
        ═══════════════════════════════ */
        .filmstrip-wrap {
            position: relative;
        }

        /* Top/bottom film perforations */
        .filmstrip-perfs {
            height: 24px;
            background: var(--gray-1);
            display: flex;
            align-items: center;
            gap: 0;
            overflow: hidden;
        }
        .fs-perf {
            width: 18px;
            height: 13px;
            background: var(--black);
            border-radius: 2px;
            flex-shrink: 0;
            margin: 0 12px;
        }

        .filmstrip-scroll {
            display: flex;
            overflow-x: auto;
            gap: 0;
            background: var(--gray-1);
            scrollbar-width: thin;
            scrollbar-color: var(--red) var(--gray-3);
        }
        .filmstrip-scroll::-webkit-scrollbar { height: 4px; }
        .filmstrip-scroll::-webkit-scrollbar-track { background: var(--gray-3); }
        .filmstrip-scroll::-webkit-scrollbar-thumb { background: var(--red); }

        .film-frame {
            flex-shrink: 0;
            width: 320px;
            height: 220px;
            position: relative;
            overflow: hidden;
            border-right: 3px solid var(--black);
            cursor: pointer;
            transition: all 0.35s var(--ease);
        }
        .film-frame:hover { transform: scaleY(1.05); z-index: 5; }

        .film-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: saturate(0.7) contrast(1.1);
            transition: all 0.5s var(--ease);
        }
        .film-frame:hover img { filter: saturate(1.1) contrast(1.05); transform: scale(1.08); }

        .film-frame-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .film-frame:hover .film-frame-overlay { opacity: 1; }
        .film-play {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.3rem;
            box-shadow: 0 0 24px var(--red-glow);
        }

        .film-frame-num {
            position: absolute;
            bottom: 0.6rem;
            right: 0.8rem;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            color: rgba(255,255,255,0.15);
            letter-spacing: 1px;
        }

        /* ═══════════════════════════════
           ⑦ TECH SPECS (Equipment)
        ═══════════════════════════════ */
        .specs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1px;
            background: var(--gray-4);
            border: 1px solid var(--gray-4);
        }
        .spec-item {
            background: var(--gray-2);
            padding: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: all 0.25s var(--ease);
        }
        .spec-item:hover { background: var(--gray-3); }
        .spec-icon {
            width: 38px;
            height: 38px;
            background: rgba(220,38,38,0.12);
            border: 1px solid rgba(220,38,38,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--red);
            font-size: 1rem;
            flex-shrink: 0;
        }
        .spec-name {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-w);
            line-height: 1.4;
        }
        .spec-cat { font-size: 0.68rem; color: var(--text-dd); text-transform: uppercase; letter-spacing: 1px; margin-top: 0.2rem; }

        /* ═══════════════════════════════
           ⑧ SPOTLIGHT QUOTE SECTION
        ═══════════════════════════════ */
        .spotlight-section {
            position: relative;
            background-image: url('https://images.unsplash.com/photo-1594909122845-11baa439b7bf?w=1600&h=700&fit=crop&auto=format');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            overflow: hidden;
        }
        .spotlight-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.88);
        }
        /* spotlight light effect */
        .spotlight-light {
            position: absolute;
            top: -20%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(ellipse at center, rgba(212,160,23,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .spotlight-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 6rem 2rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .spotlight-clapper {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
            margin-bottom: 3rem;
        }
        .clap-top {
            background: var(--red);
            padding: 0.3rem 1.5rem;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 2px;
            color: #fff;
            position: relative;
        }
        .clap-top::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: repeating-linear-gradient(
                45deg,
                transparent 0px,
                transparent 8px,
                rgba(0,0,0,0.25) 8px,
                rgba(0,0,0,0.25) 14px
            );
        }
        .clap-body {
            background: var(--gray-2);
            border: 1px solid var(--gray-4);
            padding: 0.25rem 1.5rem;
            font-size: 0.65rem;
            color: var(--text-dd);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .quote-text {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: clamp(1.4rem, 3vw, 2.2rem);
            color: var(--text-w);
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .quote-mark { color: var(--red); font-size: 1.5em; line-height: 0; vertical-align: -0.4em; }

        .quote-author {
            font-size: 0.85rem;
            color: var(--gold-lt);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        /* ═══════════════════════════════
           TEAM CARDS
        ═══════════════════════════════ */
        .crew-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        .crew-card {
            background: var(--gray-2);
            border: 1px solid var(--gray-4);
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s var(--ease);
            position: relative;
            overflow: hidden;
        }
        .crew-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--red), var(--gold));
            transform: scaleX(0);
            transition: transform 0.3s var(--ease);
        }
        .crew-card:hover::after { transform: scaleX(1); }
        .crew-card:hover { transform: translateY(-6px); border-color: var(--gray-3); box-shadow: 0 15px 40px rgba(0,0,0,0.4); }
        .crew-icon {
            width: 70px; height: 70px;
            background: var(--gray-3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.2rem;
            font-size: 1.8rem;
            color: var(--red);
            border: 2px solid var(--gray-4);
            transition: all 0.3s var(--ease);
        }
        .crew-card:hover .crew-icon { border-color: var(--red); box-shadow: 0 0 20px var(--red-glow); }
        .crew-name { font-size: 1rem; font-weight: 700; color: var(--text-w); margin-bottom: 0.3rem; }
        .crew-role { font-size: 0.75rem; color: var(--gold); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }

        /* ═══════════════════════════════
           ⑨ "ACTION!" CONTACT SECTION
        ═══════════════════════════════ */
        .action-section {
            position: relative;
        }
        .action-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=1600&h=700&fit=crop&auto=format');
            background-size: cover;
            background-position: center;
            z-index: 1;
        }
        .action-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(8,8,8,0.97) 0%, rgba(8,8,8,0.9) 55%, rgba(8,8,8,0.6) 100%);
            z-index: 2;
        }
        .action-content {
            position: relative;
            z-index: 3;
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        .action-left {}
        .action-clap-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--red);
            color: #fff;
            padding: 0.35rem 1rem;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 2px;
            margin-bottom: 1.5rem;
        }
        .action-headline {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3rem, 6vw, 5.5rem);
            color: var(--text-w);
            letter-spacing: 3px;
            line-height: 0.9;
            margin-bottom: 1.5rem;
        }
        .action-headline span { color: var(--red); }

        .action-sub {
            font-size: 0.95rem;
            color: var(--text-d);
            line-height: 1.7;
            max-width: 420px;
            margin-bottom: 2rem;
        }
        .action-btns { display: flex; gap: 1rem; flex-wrap: wrap; }

        .action-right {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        .contact-row {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            padding: 1.2rem 1.5rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--gray-4);
            text-decoration: none;
            color: inherit;
            transition: all 0.3s var(--ease);
            position: relative;
            overflow: hidden;
        }
        .contact-row::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: var(--red);
            transform: scaleY(0);
            transition: transform 0.3s var(--ease);
        }
        .contact-row:hover::before { transform: scaleY(1); }
        .contact-row:hover { background: rgba(220,38,38,0.07); border-color: var(--red); color: var(--text-w); transform: translateX(6px); }

        .cr-icon {
            width: 46px; height: 46px;
            background: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 14px var(--red-glow);
        }
        .cr-label { font-size: 0.65rem; color: var(--text-dd); text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 0.2rem; }
        .cr-val { font-size: 1rem; font-weight: 600; color: var(--text-w); }

        /* ═══════════════════════════════
           ⑩ SOCIAL FILM CAN STYLE
        ═══════════════════════════════ */
        .social-reel-section {
            text-align: center;
            padding: 3rem 2rem;
            border-top: 1px solid var(--gray-3);
        }
        .social-reel-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--text-w);
            letter-spacing: 3px;
            margin-bottom: 2rem;
        }
        .social-reel-title span { color: var(--red); }

        .social-cans {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        .social-can {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.3s var(--ease);
        }
        .social-can:hover { transform: translateY(-8px) rotate(-3deg); }
        .can-circle {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            border: 2px solid var(--gray-4);
            transition: all 0.3s var(--ease);
        }
        .social-can:hover .can-circle {
            box-shadow: 0 0 20px currentColor;
        }
        .can-label { font-size: 0.62rem; color: var(--text-dd); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }

        .sc-fb { background: #1877f2; color: #fff; border-color: #1877f2; }
        .sc-ig { background: linear-gradient(135deg, #f58529, #dd2a7b, #8134af); color: #fff; border: none; }
        .sc-yt { background: #ff0000; color: #fff; border-color: #ff0000; }
        .sc-li { background: #0077b5; color: #fff; border-color: #0077b5; }
        .sc-tw { background: #1da1f2; color: #fff; border-color: #1da1f2; }
        .sc-vm { background: #1ab7ea; color: #fff; border-color: #1ab7ea; }

        /* ═══════════════════════════════
           ⑪ FILM CREDITS FOOTER
        ═══════════════════════════════ */
        .credits-footer {
            background: var(--gray-1);
            border-top: 1px solid var(--gray-3);
            overflow: hidden;
            position: relative;
        }
        .credits-footer::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                45deg,
                transparent 0px,
                transparent 30px,
                rgba(220,38,38,0.015) 30px,
                rgba(220,38,38,0.015) 31px
            );
        }

        .credits-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 2rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .credits-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--text-w);
            letter-spacing: 3px;
            margin-bottom: 0.3rem;
        }
        .credits-brand span { color: var(--red); }
        .credits-tagline { font-size: 0.75rem; color: var(--text-dd); text-transform: uppercase; letter-spacing: 2px; }

        .credits-copy {
            font-size: 0.78rem;
            color: var(--text-dd);
            text-align: right;
            line-height: 1.7;
        }
        .credits-copy a { color: var(--red); text-decoration: none; font-weight: 600; }

        /* bottom film strip */
        .credits-strip {
            height: 20px;
            background: var(--black);
            display: flex;
            overflow: hidden;
        }
        .credits-strip-track {
            display: flex;
            animation: filmRoll 4s linear infinite;
            flex-shrink: 0;
        }
        .cs-perf {
            width: 14px;
            height: 10px;
            background: var(--gray-3);
            border-radius: 2px;
            margin: 5px 8px;
            flex-shrink: 0;
        }

        /* ═══════════════════════════════
           REVEAL ANIMATIONS
        ═══════════════════════════════ */
        .cin-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s var(--ease), transform 0.7s var(--ease);
        }
        .cin-reveal.visible { opacity: 1; transform: translateY(0); }
        .cin-reveal-left {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.7s var(--ease), transform 0.7s var(--ease);
        }
        .cin-reveal-left.visible { opacity: 1; transform: translateX(0); }

        /* ═══════════════════════════════
           RESPONSIVE
        ═══════════════════════════════ */
        @media (max-width: 900px) {
            .ticket-card { grid-template-columns: 1fr; }
            .ticket-card::before, .ticket-card::after { display: none; }
            .ticket-tear { width: 100%; height: 1px;
                background: repeating-linear-gradient(to right, var(--gray-4) 0px, var(--gray-4) 8px, transparent 8px, transparent 14px);
            }
            .ticket-stats-row { grid-template-columns: repeat(2,1fr); }
            .action-content { grid-template-columns: 1fr; gap: 2.5rem; }
            .action-bg { opacity: 0.3; }
            .action-overlay { background: rgba(8,8,8,0.95); }
            .credits-inner { grid-template-columns: 1fr; text-align: center; }
            .credits-copy { text-align: center; }
        }

        @media (max-width: 600px) {
            .hero-content { padding: 0 1.2rem 4rem; }
            .hero-meta-row { gap: 1.2rem; }
            .cin-body { padding: 0 1rem 3rem; gap: 3.5rem; }
            .ticket-section { padding: 3rem 1rem; }
            .ticket-body { padding: 1.8rem 1.2rem; }
            .film-frame { width: 260px; height: 175px; }
            .spotlight-content { padding: 4rem 1.2rem; }
        }
    </style>
</head>
<body>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i>&nbsp; Preview Mode —
        <a href="{{ url('/signin') }}">Sign up free</a> to publish your production house profile!
    </div>
    @endif

    <!-- ╔══════════════════════════════════╗
         ║  ① ANIMATED FILM PERFORATIONS   ║
         ╚══════════════════════════════════╝ -->
    <div class="film-perfs">
        <div class="film-perfs-track">
            @for($i = 0; $i < 60; $i++)
            <span class="perf"></span>
            @endfor
        </div>
    </div>

    <!-- ╔══════════════════════════════════╗
         ║  ② FULL-VIEWPORT CINEMATIC HERO ║
         ╚══════════════════════════════════╝ -->
    <section class="cinema-hero">
        @if($userdata->banner ?? false)
            <div class="hero-bg-img" style="background-image: url('{{ url('public/frontend/user_images', $userdata->banner) }}');"></div>
        @else
            <div class="hero-bg-img"></div>
        @endif

        <div class="hero-letterbox-top"></div>
        <div class="hero-vignette"></div>
        <div class="hero-overlay"></div>
        <div class="hero-grain"></div>

        <div class="hero-content">
            <div class="hero-scene-badge">
                <i class="fas fa-circle" style="font-size:.5rem;"></i>
                Production House
            </div>

            <h1 class="hero-studio-name">
                @php $words = explode(' ', $userdata->name ?? 'Your Production'); @endphp
                @foreach($words as $wi => $word)
                    @if($wi === 0)
                        <span class="red-word">{{ $word }}</span>
                    @else
                        {{ ' '.$word }}
                    @endif
                @endforeach
            </h1>

            <p class="hero-tagline">{{ $userdata->desig ?? 'Film · Photography · Creative Production' }}</p>

            <div class="hero-divider"></div>

            <div class="hero-meta-row">
                <div class="hero-meta-item">
                    <span class="hmi-label">Experience</span>
                    <span class="hmi-val">10+ YRS</span>
                </div>
                <div class="hero-meta-item">
                    <span class="hmi-label">Projects</span>
                    <span class="hmi-val">500+</span>
                </div>
                <div class="hero-meta-item">
                    <span class="hmi-label">Awards</span>
                    <span class="hmi-val">25+</span>
                </div>
                @if($userdata->city ?? false)
                <div class="hero-meta-item">
                    <span class="hmi-label">Based In</span>
                    <span class="hmi-val" style="font-size:1.1rem;">{{ strtoupper($userdata->city) }}</span>
                </div>
                @endif
            </div>

            <div class="hero-btns">
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="cbtn cbtn-red">
                    <i class="fas fa-film"></i> Book a Project
                </a>
                @endif
                @if(($social ?? null) && ($social->youtube ?? false))
                <a href="{{ $social->youtube }}" target="_blank" class="cbtn cbtn-ghost">
                    <i class="fab fa-youtube"></i> Watch Showreel
                </a>
                @endif
            </div>
        </div>

        <div class="hero-scroll-hint">
            <div class="scroll-line"></div>
            Scroll
        </div>

        <div class="hero-letterbox-bot"></div>
    </section>

    <!-- ╔══════════════════════════════════╗
         ║  ③ "NOW SHOWING" MARQUEE         ║
         ╚══════════════════════════════════╝ -->
    <div class="marquee-band">
        <div class="marquee-track">
            @php
                $marqueeItems = [
                    'NOW SHOWING', $userdata->name ?? 'PRODUCTION HOUSE',
                    'FILM PRODUCTION', 'PHOTOGRAPHY', 'POST PRODUCTION',
                    'CINEMATOGRAPHY', 'COMMERCIAL FILMS', 'MUSIC VIDEOS',
                    'NOW SHOWING', $userdata->name ?? 'PRODUCTION HOUSE',
                    'FILM PRODUCTION', 'PHOTOGRAPHY', 'POST PRODUCTION',
                    'CINEMATOGRAPHY', 'COMMERCIAL FILMS', 'MUSIC VIDEOS',
                ];
            @endphp
            @foreach($marqueeItems as $item)
            <span class="marquee-item">
                {{ strtoupper($item) }}
                <span class="marquee-dot">●</span>
            </span>
            @endforeach
        </div>
    </div>

    <!-- ╔══════════════════════════════════╗
         ║  ④ CINEMA TICKET PROFILE CARD   ║
         ╚══════════════════════════════════╝ -->
    <div class="ticket-section">
        <div class="ticket-card cin-reveal">

            <!-- STUB -->
            <div class="ticket-stub">
                @if($userdata->profile ?? false)
                    <img src="{{ url('public/frontend/user_images', $userdata->profile) }}"
                         alt="{{ $userdata->name }}"
                         class="ticket-profile-img">
                @else
                    <div class="ticket-profile-icon"><i class="fas fa-video"></i></div>
                @endif
                <div class="stub-id">
                    #{{ str_pad($userdata->id ?? 1, 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>

            <!-- TEAR LINE -->
            <div class="ticket-tear"></div>

            <!-- BODY -->
            <div class="ticket-body">
                <div class="ticket-header-row">
                    <div>
                        <div class="ticket-studio-name">{{ $userdata->name ?? 'Studio Name' }}</div>
                        <div class="ticket-desig">{{ $userdata->desig ?? 'Production · Direction · Cinematography' }}</div>
                    </div>
                    <div class="ticket-rating">A</div>
                </div>

                <div class="ticket-stats-row">
                    <div class="ts-item">
                        <span class="ts-val">10+</span>
                        <span class="ts-lbl">Years</span>
                    </div>
                    <div class="ts-item">
                        <span class="ts-val">500+</span>
                        <span class="ts-lbl">Projects</span>
                    </div>
                    <div class="ts-item">
                        <span class="ts-val">
                            {{ ($professions ?? collect())->count() > 0 ? $professions->count() : '8+' }}
                        </span>
                        <span class="ts-lbl">Services</span>
                    </div>
                    <div class="ts-item">
                        <span class="ts-val">25+</span>
                        <span class="ts-lbl">Awards</span>
                    </div>
                </div>

                <div class="ticket-chips">
                    @if(($qualifications ?? collect())->count() > 0)
                        <span class="t-chip"><i class="fas fa-certificate"></i> {{ $qualifications->first()->title ?? $qualifications->first()->qualifiaction ?? 'Certified' }}</span>
                    @endif
                    @if($userdata->city ?? false)
                        <span class="t-chip"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}</span>
                    @endif
                    <span class="t-chip"><i class="fas fa-film"></i> Feature Films</span>
                    <span class="t-chip"><i class="fas fa-camera"></i> Photography</span>
                    <span class="t-chip"><i class="fas fa-broadcast-tower"></i> Live Events</span>
                </div>

                <div class="ticket-btns">
                    @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="cbtn cbtn-red">
                        <i class="fas fa-phone"></i> Contact
                    </a>
                    @endif
                    @if($userdata->email ?? false)
                    <a href="mailto:{{ $userdata->email }}" class="cbtn cbtn-ghost" style="border-color:var(--gray-4);color:var(--text-d);">
                        <i class="fas fa-envelope"></i> Email
                    </a>
                    @endif
                    @if(($social ?? null) && ($social->whatsapp ?? false))
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="cbtn cbtn-ghost" style="border-color:#25d366;color:#25d366;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ═══ MAIN BODY ═══ -->
    <div class="cin-body">

        <!-- ╔══════════════════════════════╗
             ║  ⑤ MOVIE POSTER SERVICES     ║
             ╚══════════════════════════════╝ -->
        @if(($professions ?? collect())->count() > 0 || true)
        <section class="cin-reveal">
            <div class="cin-sec-head">
                <div class="csh-number">01</div>
                <div class="csh-line"></div>
                <div class="csh-text">
                    <div class="csh-overline">Our Specialities</div>
                    <div class="csh-title">Services & Productions</div>
                </div>
            </div>

            <div class="posters-scroll">
                @if(($professions ?? collect())->count() > 0)
                    @php $piIdx = 0; @endphp
                    @foreach($professions as $prof)
                    @php $pImg = $posterImages[$piIdx % count($posterImages)]; $piIdx++; @endphp
                    <div class="poster-card">
                        <img src="{{ $pImg }}" alt="{{ $prof->title ?? 'Service' }}" class="poster-img" loading="lazy">
                        <div class="poster-frame"></div>
                        <div class="poster-overlay"></div>
                        <div class="poster-scene-num">{{ str_pad($piIdx, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="poster-content">
                            <div class="poster-genre">Production Service</div>
                            <div class="poster-title">{{ $prof->title ?? $prof->profession ?? 'Service' }}</div>
                            @if($prof->desc ?? $prof->description ?? false)
                            <div class="poster-desc">{{ $prof->desc ?? $prof->description }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    @php
                        $defaultServices = [
                            ['title'=>'Feature Films', 'desc'=>'Full-length cinematic narratives', 'genre'=>'Cinema'],
                            ['title'=>'Commercial Ads', 'desc'=>'Brand stories that captivate audiences', 'genre'=>'Brand'],
                            ['title'=>'Music Videos', 'desc'=>'Visual storytelling through music', 'genre'=>'Music'],
                            ['title'=>'Photography', 'desc'=>'Still imagery that speaks volumes', 'genre'=>'Still'],
                            ['title'=>'Post Production', 'desc'=>'Editing, color grading & VFX', 'genre'=>'Post'],
                            ['title'=>'Live Events', 'desc'=>'Multi-cam live coverage & streaming', 'genre'=>'Live'],
                        ];
                    @endphp
                    @foreach($defaultServices as $di => $ds)
                    <div class="poster-card">
                        <img src="{{ $posterImages[$di % count($posterImages)] }}" alt="{{ $ds['title'] }}" class="poster-img" loading="lazy">
                        <div class="poster-frame"></div>
                        <div class="poster-overlay"></div>
                        <div class="poster-scene-num">{{ str_pad($di + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="poster-content">
                            <div class="poster-genre">{{ $ds['genre'] }}</div>
                            <div class="poster-title">{{ $ds['title'] }}</div>
                            <div class="poster-desc">{{ $ds['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </section>
        @endif

        <!-- ╔══════════════════════════════╗
             ║  ⑥ HORIZONTAL FILMSTRIP      ║
             ╚══════════════════════════════╝ -->
        <section class="cin-reveal">
            <div class="cin-sec-head">
                <div class="csh-number">02</div>
                <div class="csh-line"></div>
                <div class="csh-text">
                    <div class="csh-overline">Our Reel</div>
                    <div class="csh-title">Portfolio Filmstrip</div>
                </div>
            </div>

            <div class="filmstrip-wrap">
                <!-- Top perfs -->
                <div class="filmstrip-perfs">
                    @for($i = 0; $i < 40; $i++)<span class="fs-perf"></span>@endfor
                </div>

                <div class="filmstrip-scroll">
                    @if(($portfolios ?? collect())->count() > 0)
                        @foreach($portfolios->take(8) as $pf)
                        @php $imgs = json_decode($pf->image ?? '[]', true); $fUrl = ($imgs && count($imgs) > 0) ? url('public/frontend/portfolio/'.$imgs[0]) : $filmFallback[$loop->index % count($filmFallback)]; @endphp
                        <div class="film-frame">
                            <img src="{{ $fUrl }}" alt="Portfolio" loading="lazy">
                            <div class="film-frame-overlay">
                                <div class="film-play"><i class="fas fa-play"></i></div>
                            </div>
                            <div class="film-frame-num">{{ str_pad($loop->index + 1, 3, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        @endforeach
                    @else
                        @foreach($filmFallback as $fi => $fImg)
                        <div class="film-frame">
                            <img src="{{ $fImg }}" alt="Production Work" loading="lazy">
                            <div class="film-frame-overlay">
                                <div class="film-play"><i class="fas fa-play"></i></div>
                            </div>
                            <div class="film-frame-num">{{ str_pad($fi + 1, 3, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <!-- Bottom perfs -->
                <div class="filmstrip-perfs">
                    @for($i = 0; $i < 40; $i++)<span class="fs-perf"></span>@endfor
                </div>
            </div>
        </section>

        <!-- ╔══════════════════════════════╗
             ║  ⑦ TECH SPECS (Equipment)   ║
             ╚══════════════════════════════╝ -->
        @if(($qualifications ?? collect())->count() > 0)
        <section class="cin-reveal">
            <div class="cin-sec-head">
                <div class="csh-number">03</div>
                <div class="csh-line"></div>
                <div class="csh-text">
                    <div class="csh-overline">What We Use</div>
                    <div class="csh-title">Equipment & Capabilities</div>
                </div>
            </div>
            <div class="specs-grid">
                @php $specIcons = ['fas fa-video','fas fa-camera','fas fa-microphone','fas fa-lightbulb','fas fa-sliders-h','fas fa-desktop','fas fa-film','fas fa-broadcast-tower']; $sIdx=0; @endphp
                @foreach($qualifications as $qual)
                <div class="spec-item">
                    <div class="spec-icon"><i class="{{ $specIcons[$sIdx % count($specIcons)] }}"></i></div>
                    <div>
                        <div class="spec-name">{{ $qual->qualifiaction ?? $qual->title ?? 'Equipment' }}</div>
                        <div class="spec-cat">{{ $qual->desc ?? $qual->description ?? 'Production Gear' }}</div>
                    </div>
                </div>
                @php $sIdx++; @endphp
                @endforeach
            </div>
        </section>
        @endif

    </div><!-- /cin-body -->

    <!-- ╔══════════════════════════════════╗
         ║  ⑧ SPOTLIGHT / DIRECTOR'S NOTE  ║
         ╚══════════════════════════════════╝ -->
    @if(($thoughts ?? collect())->count() > 0)
    <section class="spotlight-section cin-reveal">
        <div class="spotlight-overlay"></div>
        <div class="spotlight-light"></div>
        <div class="spotlight-content">
            <div class="spotlight-clapper">
                <div class="clap-top">Director's Note</div>
                <div class="clap-body">Scene · Take 1 · Action</div>
            </div>
            @foreach($thoughts->take(1) as $thought)
            <p class="quote-text">
                <span class="quote-mark">"</span>
                {{ $thought->thought ?? $thought->title ?? 'Great cinema is about telling stories that move people.' }}
                <span class="quote-mark">"</span>
            </p>
            @endforeach
            <div class="quote-author">— {{ $userdata->name ?? 'Director' }} · {{ $userdata->desig ?? 'Production House' }}</div>
        </div>
    </section>
    @endif

    <!-- Team -->
    @if(isset($productionTeam) && $productionTeam->count() > 0)
    <div class="cin-body" style="padding-top:0;">
        <section class="cin-reveal">
            <div class="cin-sec-head">
                <div class="csh-number">04</div>
                <div class="csh-line"></div>
                <div class="csh-text">
                    <div class="csh-overline">The People Behind</div>
                    <div class="csh-title">Cast & Crew</div>
                </div>
            </div>
            <div class="crew-grid">
                @foreach($productionTeam as $member)
                <div class="crew-card">
                    <div class="crew-icon"><i class="fas fa-user-tie"></i></div>
                    <div class="crew-name">{{ $member->member_name }}</div>
                    <div class="crew-role">{{ $member->role ?? 'Crew' }}</div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
    @endif

    <!-- ╔══════════════════════════════════╗
         ║  ⑨ "ACTION!" CONTACT SECTION    ║
         ╚══════════════════════════════════╝ -->
    <section class="action-section">
        <div class="action-bg"></div>
        <div class="action-overlay"></div>
        <div class="action-content cin-reveal-left">
            <div class="action-left">
                <div class="action-clap-badge">
                    <i class="fas fa-circle" style="font-size:.5rem;"></i> Ready to Create
                </div>
                <div class="action-headline">
                    LIGHTS.<br>CAMERA.<br><span>ACTION!</span>
                </div>
                <p class="action-sub">
                    Let's bring your vision to life. Whether it's a feature film, commercial, music video, or live event — we're ready to roll.
                </p>
                <div class="action-btns">
                    @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="cbtn cbtn-red">
                        <i class="fas fa-film"></i> Start a Project
                    </a>
                    @endif
                    @if(($social ?? null) && ($social->whatsapp ?? false))
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="cbtn cbtn-ghost" style="border-color:#25d366;color:#25d366;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif
                </div>
            </div>

            <div class="action-right">
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="contact-row">
                    <div class="cr-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <div class="cr-label">Phone</div>
                        <div class="cr-val">{{ $userdata->mobile }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->email ?? false)
                <a href="mailto:{{ $userdata->email }}" class="contact-row">
                    <div class="cr-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="cr-label">Email</div>
                        <div class="cr-val">{{ $userdata->email }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->city ?? false)
                <div class="contact-row">
                    <div class="cr-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="cr-label">Studio Location</div>
                        <div class="cr-val">{{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}</div>
                    </div>
                </div>
                @endif
                @if(($social ?? null) && ($social->whatsapp ?? false))
                <a href="https://wa.me/{{ $social->whatsapp }}" class="contact-row">
                    <div class="cr-icon" style="background:#25d366;">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="cr-label">WhatsApp</div>
                        <div class="cr-val">{{ $social->whatsapp }}</div>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ╔══════════════════════════════════╗
         ║  ⑩ SOCIAL FILM CAN STYLE         ║
         ╚══════════════════════════════════╝ -->
    @if($social ?? false)
    <div class="social-reel-section cin-reveal">
        <div class="social-reel-title">Follow Our <span>Reel</span></div>
        <div class="social-cans">
            @if($social->facebook ?? false)
            <a href="{{ $social->facebook }}" target="_blank" class="social-can">
                <div class="can-circle sc-fb"><i class="fab fa-facebook-f"></i></div>
                <span class="can-label">Facebook</span>
            </a>
            @endif
            @if($social->instagram ?? false)
            <a href="{{ $social->instagram }}" target="_blank" class="social-can">
                <div class="can-circle sc-ig"><i class="fab fa-instagram"></i></div>
                <span class="can-label">Instagram</span>
            </a>
            @endif
            @if($social->youtube ?? false)
            <a href="{{ $social->youtube }}" target="_blank" class="social-can">
                <div class="can-circle sc-yt"><i class="fab fa-youtube"></i></div>
                <span class="can-label">YouTube</span>
            </a>
            @endif
            @if($social->linkedin ?? false)
            <a href="{{ $social->linkedin }}" target="_blank" class="social-can">
                <div class="can-circle sc-li"><i class="fab fa-linkedin-in"></i></div>
                <span class="can-label">LinkedIn</span>
            </a>
            @endif
            @if($social->twitter ?? false)
            <a href="{{ $social->twitter }}" target="_blank" class="social-can">
                <div class="can-circle sc-tw"><i class="fab fa-x-twitter"></i></div>
                <span class="can-label">Twitter</span>
            </a>
            @endif
            @if($social->vimeo ?? false)
            <a href="{{ $social->vimeo }}" target="_blank" class="social-can">
                <div class="can-circle sc-vm"><i class="fab fa-vimeo-v"></i></div>
                <span class="can-label">Vimeo</span>
            </a>
            @endif
        </div>
    </div>
    @endif

    <!-- ╔══════════════════════════════════╗
         ║  ⑪ FILM CREDITS FOOTER           ║
         ╚══════════════════════════════════╝ -->
    <footer class="credits-footer">
        <div class="credits-inner">
            <div>
                <div class="credits-brand">
                    {{ collect(explode(' ', $userdata->name ?? 'Your Production'))->first() }}
                    <span>{{ collect(explode(' ', $userdata->name ?? 'Your Production'))->skip(1)->join(' ') ?: 'Studios' }}</span>
                </div>
                <div class="credits-tagline">{{ $userdata->desig ?? 'A Fastap Digital Card Production' }}</div>
            </div>
            <div class="credits-copy">
                <p>&copy; {{ date('Y') }} · All Rights Reserved</p>
                <p>A Digital Card by <a href="{{ url('/') }}">Fastap</a></p>
                <p style="margin-top:.3rem; color: var(--red); font-size:0.7rem; font-weight:700; letter-spacing:1px;">THE END</p>
            </div>
        </div>

        <!-- bottom film strip -->
        <div class="credits-strip">
            <div class="credits-strip-track">
                @for($i = 0; $i < 80; $i++)<span class="cs-perf"></span>@endfor
            </div>
        </div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id   ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview      ?? false
    ])

    <script>
    // Scroll reveal
    const revealAll = document.querySelectorAll('.cin-reveal, .cin-reveal-left');
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    revealAll.forEach(el => obs.observe(el));
    </script>

</body>
</html>