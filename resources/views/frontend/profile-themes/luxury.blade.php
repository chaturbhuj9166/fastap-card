<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Luxury Jewellery' }} - Fine Jewellery & Collections</title>

    @php
        $websetting = App\Models\websetting::first();
        if (isset($isPreview) && $isPreview) {
            $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client','menu_section','reservation_section','property_listings','showreel','team_section','pricing_section','booking_section'], 1);
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client','menu_section','reservation_section','property_listings','showreel','team_section','pricing_section','booking_section'], 1);
            }
        }
        $themeColor = $theme->color ?? '#b8860b';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=EB+Garamond:ital,wght@0,400;0,500;1,400&family=Josefin+Sans:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ═══════════════════════════════════════════════════
           LUXURY JEWELLERY — EDITORIAL MAGAZINE THEME
           Color System: Obsidian · Champagne Gold · Ivory · Rose
        ═══════════════════════════════════════════════════ */
        :root {
            --obsidian:      #0a0a0a;
            --charcoal:      #141414;
            --onyx:          #1e1e1e;
            --gold:          #C9A84C;
            --gold-bright:   #E8C96A;
            --gold-pale:     #F5E6BC;
            --champagne:     #F7F1E3;
            --ivory:         #FDFAF4;
            --rose:          #C4928A;
            --text-cream:    #EDE8DC;
            --text-muted:    #8A8070;
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Josefin Sans', sans-serif;
            background: var(--obsidian);
            color: var(--text-cream);
            overflow-x: hidden;
        }

        /* ── Ornamental border frame ── */
        body::before {
            content: '';
            position: fixed;
            inset: 8px;
            border: 1px solid rgba(201,168,76,0.12);
            pointer-events: none;
            z-index: 9999;
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--obsidian); }
        ::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 2px; }

        /* ═══════════════════════════════════════════════════
           PREVIEW BANNER
        ═══════════════════════════════════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg, var(--obsidian), #1a0e00, var(--obsidian));
            border-bottom: 1px solid rgba(201,168,76,0.3);
            color: var(--gold);
            padding: 12px 20px;
            text-align: center;
            font-size: 11px;
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .preview-banner a { color: var(--gold-bright); text-decoration: underline; margin-left: 8px; }

        /* ═══════════════════════════════════════════════════
           SPLIT HERO — Magazine editorial layout
           LEFT: Jewellery macro photo (full height)
           RIGHT: Profile information
        ═══════════════════════════════════════════════════ */
        .split-hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
            position: relative;
        }

        /* ── LEFT: Jewellery photograph panel ── */
        .hero-photo-panel {
            position: relative;
            overflow: hidden;
            min-height: 100vh;

            background-image:
                linear-gradient(to right, transparent 60%, var(--obsidian) 100%),
                url('https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=1200&q=90');
            background-size: cover;
            background-position: center 30%;
        }

        /* Floating editorial text on photo */
        .hero-photo-label {
            position: absolute;
            bottom: 60px;
            left: 48px;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transform: rotate(180deg);
            font-size: 10px;
            letter-spacing: 4px;
            color: rgba(201,168,76,0.6);
            text-transform: uppercase;
            font-family: 'Josefin Sans', sans-serif;
        }

        /* Gold corner accent top-left */
        .hero-photo-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 80px; height: 80px;
            border-top: 2px solid var(--gold);
            border-left: 2px solid var(--gold);
            opacity: 0.5;
            z-index: 2;
        }
        .hero-photo-panel::after {
            content: '';
            position: absolute;
            bottom: 0; right: 0;
            width: 60px; height: 60px;
            border-bottom: 2px solid var(--gold);
            border-right: 2px solid var(--gold);
            opacity: 0.3;
            z-index: 2;
        }

        /* ── RIGHT: Profile info panel ── */
        .hero-info-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px 64px 80px 56px;
            background: var(--obsidian);
            z-index: 10;
        }

        /* Grain texture on right panel */
        .hero-info-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1610364042078-7d4c2c1012ac?w=800&q=30');
            background-size: cover;
            opacity: 0.03;
            pointer-events: none;
        }

        /* ── Hero Issue Number (editorial) ── */
        .hero-issue {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 40px;
        }
        .hi-line { width: 40px; height: 1px; background: var(--gold); }
        .hi-text {
            font-size: 10px;
            letter-spacing: 4px;
            color: var(--gold);
            text-transform: uppercase;
        }

        /* ── Profile Photo (circular, small, editorial) ── */
        .hero-avatar-wrap {
            position: relative;
            width: 100px;
            height: 100px;
            margin-bottom: 32px;
        }
        .hero-avatar-border {
            width: 100%;
            height: 100%;
            padding: 3px;
            background: conic-gradient(var(--gold) 0deg, var(--gold-bright) 180deg, var(--gold) 360deg);
            border-radius: 50%;
            animation: slow-spin 12s linear infinite;
        }
        @keyframes slow-spin { to { transform: rotate(360deg); } }
        .hero-avatar-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            background: var(--charcoal);
            position: absolute;
            top: 3px; left: 3px;
            width: calc(100% - 6px);
            height: calc(100% - 6px);
        }
        .hero-avatar-inner img { width:100%; height:100%; object-fit:cover; }
        .hero-avatar-placeholder {
            width:100%; height:100%;
            display:flex; align-items:center; justify-content:center;
            background: var(--charcoal);
            color: var(--gold); font-size: 32px;
        }

        /* ── Name (large editorial display) ── */
        .hero-brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(48px, 7vw, 76px);
            font-weight: 300;
            color: var(--ivory);
            line-height: 1;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }
        .hero-brand-name em {
            font-style: italic;
            color: var(--gold);
            display: block;
        }

        /* ── Designation ── */
        .hero-designation {
            font-size: 10px;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 32px;
            font-weight: 300;
        }

        /* ── Bio quote ── */
        .hero-bio {
            font-family: 'EB Garamond', serif;
            font-style: italic;
            font-size: 17px;
            color: rgba(237,232,220,0.7);
            line-height: 1.9;
            margin-bottom: 36px;
            max-width: 420px;
            padding-left: 20px;
            border-left: 2px solid var(--gold);
        }

        /* ── Location tag ── */
        .hero-location {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 11px;
            letter-spacing: 2px;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-bottom: 40px;
        }
        .hero-location i { color: var(--gold); }

        /* ── Hero CTA buttons ── */
        .hero-cta { display:flex; flex-wrap:wrap; gap:12px; }
        .btn-gold-solid {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: var(--gold);
            color: var(--obsidian);
            font-family: 'Josefin Sans', sans-serif;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all .3s;
        }
        .btn-gold-solid:hover { background: var(--gold-bright); transform: translateY(-2px); box-shadow: 0 10px 30px rgba(201,168,76,0.4); }
        .btn-ghost-gold {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 28px;
            background: transparent;
            color: var(--gold);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            border: 1px solid rgba(201,168,76,0.4);
            text-decoration: none;
            transition: all .3s;
        }
        .btn-ghost-gold:hover { border-color: var(--gold); background: rgba(201,168,76,0.08); }

        /* ── Scroll indicator ── */
        .hero-scroll {
            position: absolute;
            bottom: 32px; right: 64px;
            display: flex; flex-direction:column; align-items:center; gap:8px;
            font-size: 9px; letter-spacing: 3px; text-transform:uppercase;
            color: var(--text-muted);
            animation: scroll-bob 2s ease-in-out infinite;
        }
        .hero-scroll-line { width:1px; height:40px; background:linear-gradient(180deg, var(--gold), transparent); }
        @keyframes scroll-bob { 0%,100%{transform:translateY(0)} 50%{transform:translateY(8px)} }

        /* ═══════════════════════════════════════════════════
           METAL RATES TICKER
           BG: gold gradient strip
        ═══════════════════════════════════════════════════ */
        .rates-ticker {
            position: relative;
            background: linear-gradient(90deg, var(--charcoal), #1a1200, var(--charcoal));
            border-top: 1px solid rgba(201,168,76,0.2);
            border-bottom: 1px solid rgba(201,168,76,0.2);
            overflow: hidden;
            padding: 0;
        }
        /* Gold foil shimmer */
        .rates-ticker::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent 0%, rgba(201,168,76,0.05) 50%, transparent 100%);
            animation: ticker-shimmer 4s ease-in-out infinite;
            pointer-events: none;
        }
        @keyframes ticker-shimmer { 0%,100%{opacity:0.5} 50%{opacity:1} }

        .ticker-track {
            display: flex;
            animation: ticker-move 30s linear infinite;
            white-space: nowrap;
            padding: 20px 0;
        }
        @keyframes ticker-move { from{transform:translateX(0)} to{transform:translateX(-50%)} }
        .ticker-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0 48px;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            flex-shrink: 0;
            border-right: 1px solid rgba(201,168,76,0.15);
        }
        .ticker-metal { color: var(--gold-bright); font-family: 'Cormorant Garamond', serif; font-size: 18px; font-weight: 400; }
        .ticker-rate { color: var(--gold); font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 500; }
        .ticker-purity { font-size: 9px; color: var(--text-muted); }
        .ticker-up   { color: #4ade80; font-size: 10px; }
        .ticker-down { color: #f87171; font-size: 10px; }

        /* ═══════════════════════════════════════════════════
           MAIN CONTENT WRAP
        ═══════════════════════════════════════════════════ */
        .content-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 48px 100px;
            position: relative;
            z-index: 10;
        }

        /* ── Editorial Section Header ── */
        .ed-header {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 24px;
            margin: 96px 0 56px;
        }
        .ed-number {
            font-family: 'Cormorant Garamond', serif;
            font-size: 80px;
            font-weight: 300;
            color: rgba(201,168,76,0.12);
            line-height: 1;
            user-select: none;
        }
        .ed-titles { }
        .ed-eyebrow {
            font-size: 9px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 6px;
        }
        .ed-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(32px, 4vw, 52px);
            font-weight: 300;
            color: var(--ivory);
            line-height: 1.1;
        }
        .ed-title em { font-style: italic; color: var(--gold); }
        .ed-rule { height: 1px; background: linear-gradient(90deg, rgba(201,168,76,0.3), transparent); }

        /* ═══════════════════════════════════════════════════
           ABOUT SECTION — Split card with jewellery BG
        ═══════════════════════════════════════════════════ */
        .about-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 480px;
            border: 1px solid rgba(201,168,76,0.15);
            overflow: hidden;
        }
        .about-image-side {
            position: relative;
            background-image:
                linear-gradient(to right, transparent 50%, var(--charcoal) 100%),
                url('https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=1000&q=85');
            background-size: cover;
            background-position: center;
            min-height: 400px;
        }
        .about-image-side::after {
            content: 'Est.';
            position: absolute;
            bottom: 32px; left: 32px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 11px;
            letter-spacing: 4px;
            color: rgba(201,168,76,0.5);
            text-transform: uppercase;
        }
        .about-text-side {
            background: var(--charcoal);
            padding: 56px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        /* Gold texture watermark */
        .about-text-side::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1610364042078-7d4c2c1012ac?w=600&q=20');
            background-size: cover;
            opacity: 0.04;
        }
        .about-eyebrow {
            font-size: 9px; letter-spacing: 4px; text-transform: uppercase;
            color: var(--gold); margin-bottom: 16px; font-weight: 600;
            position: relative; z-index:1;
        }
        .about-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 38px; font-weight: 300;
            color: var(--ivory); line-height: 1.2; margin-bottom: 24px;
            position: relative; z-index:1;
        }
        .about-text {
            font-family: 'EB Garamond', serif;
            font-size: 16px;
            color: rgba(237,232,220,0.7);
            line-height: 2;
            position: relative; z-index:1;
        }
        .about-stats {
            display: flex;
            gap: 40px;
            margin-top: 36px;
            padding-top: 28px;
            border-top: 1px solid rgba(201,168,76,0.15);
            position: relative; z-index:1;
        }
        .as-item { }
        .as-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 36px; font-weight: 500;
            color: var(--gold); line-height: 1; margin-bottom: 4px;
        }
        .as-label { font-size: 9px; letter-spacing: 2px; color: var(--text-muted); text-transform: uppercase; }

        /* ═══════════════════════════════════════════════════
           METAL RATES — Card grid with gold backgrounds
        ═══════════════════════════════════════════════════ */
        .rates-section {
            margin-top: 0;
        }
        .rates-grid-lx {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 2px;
        }
        .rate-tile {
            position: relative;
            padding: 36px 24px;
            text-align: center;
            overflow: hidden;
            cursor: default;
            transition: all .3s;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        /* Alternating gold-texture BGs */
        .rate-tile:nth-child(1) {
            background-image:
                linear-gradient(135deg, rgba(20,18,10,0.92), rgba(30,25,10,0.88)),
                url('https://images.unsplash.com/photo-1610364042078-7d4c2c1012ac?w=400&q=60');
            background-size: cover;
        }
        .rate-tile:nth-child(2) {
            background-image:
                linear-gradient(135deg, rgba(15,15,15,0.90), rgba(25,20,8,0.86)),
                url('https://images.unsplash.com/photo-1610364042078-7d4c2c1012ac?w=400&q=60');
            background-size: cover; background-position: 30%;
        }
        .rate-tile:nth-child(3) {
            background-image:
                linear-gradient(135deg, rgba(25,20,10,0.94), rgba(15,12,5,0.90)),
                url('https://images.unsplash.com/photo-1610364042078-7d4c2c1012ac?w=400&q=60');
            background-size: cover; background-position: 60%;
        }
        .rate-tile:nth-child(4) {
            background-image:
                linear-gradient(135deg, rgba(18,16,10,0.92), rgba(28,22,8,0.88)),
                url('https://images.unsplash.com/photo-1610364042078-7d4c2c1012ac?w=400&q=60');
            background-size: cover; background-position: 80%;
        }
        .rate-tile:nth-child(n+5) {
            background: var(--charcoal);
        }
        .rate-tile::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: var(--gold);
            transform: scaleX(0);
            transition: transform .3s;
        }
        .rate-tile:hover::before { transform: scaleX(1); }
        .rate-tile:hover { background-color: var(--onyx); }
        .rt-metal {
            font-size: 9px; letter-spacing: 3px; text-transform: uppercase;
            color: var(--text-muted); margin-bottom: 12px; font-weight: 600;
        }
        .rt-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 40px; font-weight: 500;
            color: var(--gold); line-height: 1; margin-bottom: 6px;
        }
        .rt-value sup { font-size: 16px; color: var(--gold-pale); }
        .rt-purity { font-size: 11px; color: var(--text-muted); letter-spacing: 1px; }

        /* ═══════════════════════════════════════════════════
           SERVICES — Editorial masonry with jewellery BGs
        ═══════════════════════════════════════════════════ */
        .services-editorial {
            /* Jewellery workshop BG */
            position: relative;
            border-radius: 2px;
            overflow: hidden;
            padding: 64px 56px;

            background-image:
                linear-gradient(135deg, rgba(10,10,10,0.95) 0%, rgba(20,16,6,0.90) 100%),
                url('https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?w=1920&q=75');
            background-size: cover;
            background-position: center;
        }
        .services-editorial::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-bright), var(--gold), transparent);
        }
        .services-editorial::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,168,76,0.3), transparent);
        }

        .services-ed-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1px;
            background: rgba(201,168,76,0.08);
        }
        .service-ed-card {
            background: rgba(10,10,10,0.85);
            padding: 40px 32px;
            transition: all .3s;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(8px);
        }
        .service-ed-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; bottom: 0;
            width: 2px;
            background: var(--gold);
            transform: scaleY(0);
            transition: transform .4s;
        }
        .service-ed-card:hover::after { transform: scaleY(1); }
        .service-ed-card:hover { background: rgba(20,16,6,0.90); }
        .sed-icon {
            font-size: 28px;
            color: var(--gold);
            margin-bottom: 20px;
            opacity: 0.8;
        }
        .sed-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 400;
            color: var(--ivory);
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        .sed-desc {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.8;
            letter-spacing: 0.3px;
        }

        /* ═══════════════════════════════════════════════════
           SIGNATURE COLLECTION — Magazine product grid
           Varied sizes: featured (large) + standard
        ═══════════════════════════════════════════════════ */
        .collection-magazine {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 3px;
        }

        .cm-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            background: var(--charcoal);
        }
        .cm-item:nth-child(1) { grid-row: span 2; min-height: 600px; }
        .cm-item:nth-child(n+2) { min-height: 294px; }

        .cm-img {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform .7s cubic-bezier(.25,.46,.45,.94);
        }
        /* Default showcase images when no user products */
        .cm-item:nth-child(1) .cm-img { background-image: url('https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?q=80&w=800'); } 
        .cm-item:nth-child(2) .cm-img { background-image: url('https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800&q=85'); }
        .cm-item:nth-child(3) .cm-img { background-image: url('https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=600&q=80'); }
        .cm-item:nth-child(4) .cm-img { background-image: url('https://images.unsplash.com/photo-1611955167811-4711904bb9f8?w=600&q=80'); }
        .cm-item:nth-child(5) .cm-img { background-image: url('https://images.unsplash.com/photo-1602751584552-8ba73aad10e1?q=80&w=800'); }
        .cm-item:nth-child(6) .cm-img { background-image: url('https://images.unsplash.com/photo-1596944924616-7b38e7cfac36?q=80&w=800'); }

        .cm-item:hover .cm-img { transform: scale(1.08); }

        .cm-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10,10,10,0.90) 0%, rgba(10,10,10,0.20) 60%, transparent 100%);
            transition: opacity .3s;
        }

        .cm-content {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 28px 24px;
            z-index: 2;
        }
        .cm-category {
            font-size: 9px; letter-spacing: 3px; text-transform: uppercase;
            color: var(--gold); margin-bottom: 8px; font-weight: 600;
        }
        .cm-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-weight: 400;
            color: white; letter-spacing: 0.5px;
        }
        .cm-item:nth-child(1) .cm-name { font-size: 34px; }

        /* User product override */
        .cm-user-img {
            position: absolute;
            inset: 0; width:100%; height:100%;
            object-fit: cover; z-index: 1;
            transition: transform .7s cubic-bezier(.25,.46,.45,.94);
        }
        .cm-item:hover .cm-user-img { transform: scale(1.08); }

        /* ═══════════════════════════════════════════════════
           CRAFTSMANSHIP SECTION
           BG: jewellery workshop / macro tools
        ═══════════════════════════════════════════════════ */
        .craft-section {
            display: grid;
            grid-template-columns: 1fr 2fr;
            min-height: 380px;
            border: 1px solid rgba(201,168,76,0.1);
            overflow: hidden;
        }
        .craft-num-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 32px;
            text-align: center;

            background-image:
                linear-gradient(135deg, rgba(10,10,10,0.96), rgba(20,16,6,0.92)),
                url('https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=600&q=70');
            background-size: cover;
            background-position: center;
        }
        .cn-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 80px; font-weight: 300;
            color: var(--gold); line-height: 1; margin-bottom: 8px;
        }
        .cn-label { font-size: 9px; letter-spacing: 3px; text-transform: uppercase; color: var(--text-muted); }

        .craft-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1px;
            background: rgba(201,168,76,0.06);
        }
        .cf-item {
            background: var(--charcoal);
            padding: 36px 32px;
            transition: all .3s;
            position: relative;
            overflow: hidden;
        }
        .cf-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1610364042078-7d4c2c1012ac?w=400&q=20');
            background-size: cover;
            opacity: 0;
            transition: opacity .3s;
        }
        .cf-item:hover::before { opacity: 0.05; }
        .cf-item:hover { background: var(--onyx); }
        .cf-icon { font-size: 24px; color: var(--gold); margin-bottom: 14px; opacity: 0.8; }
        .cf-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; font-weight: 400;
            color: var(--ivory); margin-bottom: 8px;
            position: relative; z-index: 1;
        }
        .cf-text { font-size: 12px; color: var(--text-muted); line-height: 1.7; position: relative; z-index: 1; }

        /* ═══════════════════════════════════════════════════
           GALLERY — Tight editorial photo grid
        ═══════════════════════════════════════════════════ */
        .gallery-tight {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3px;
        }
        .gallery-tight .gt-item {
            aspect-ratio: 1;
            overflow: hidden;
            position: relative;
            background: var(--charcoal);
        }
        .gallery-tight .gt-item img {
            width: 100%; height: 100%;
            object-fit: cover;
            filter: grayscale(20%) contrast(1.05);
            transition: all .5s;
        }
        .gallery-tight .gt-item:hover img { filter: grayscale(0%) contrast(1.1); transform: scale(1.08); }
        .gallery-tight .gt-item:first-child { grid-column: span 2; grid-row: span 2; aspect-ratio: auto; }
        /* Default gallery showcase images */
        .gt-default-bg {
            width: 100%; height: 100%; min-height: 200px;
            background-size: cover; background-position: center;
            transition: transform .5s;
        }
        .gt-item:hover .gt-default-bg { transform: scale(1.08); }
        .gt-item:nth-child(1) .gt-default-bg { background-image: url('https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?w=800&q=80'); min-height: 420px; }
        .gt-item:nth-child(2) .gt-default-bg { background-image: url('https://images.unsplash.com/photo-1589128777073-263566ae5e4d?q=80&w=800'); }
        .gt-item:nth-child(3) .gt-default-bg { background-image: url('https://images.unsplash.com/photo-1611955167811-4711904bb9f8?w=400&q=80'); }
        .gt-item:nth-child(4) .gt-default-bg { background-image: url('https://images.unsplash.com/photo-1603974372039-adc49044b6bd?q=80&w=800'); }
        .gt-item:nth-child(5) .gt-default-bg { background-image: url('https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=400&q=80'); }

        /* ═══════════════════════════════════════════════════
           CREDENTIALS / QUALIFICATIONS
        ═══════════════════════════════════════════════════ */
        .cred-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2px;
        }
        .cred-item {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 28px 32px;
            background: var(--charcoal);
            border-left: 2px solid transparent;
            transition: all .3s;
            position: relative;
            overflow: hidden;
        }
        .cred-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1610364042078-7d4c2c1012ac?w=400&q=15');
            background-size: cover;
            opacity: 0;
            transition: opacity .3s;
        }
        .cred-item:hover::after { opacity: 0.04; }
        .cred-item:hover { border-left-color: var(--gold); background: var(--onyx); }
        .cred-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 36px; font-weight: 300;
            color: rgba(201,168,76,0.25); flex-shrink: 0;
            width: 36px; text-align: center;
            position: relative; z-index: 1;
        }
        .cred-icon {
            width: 44px; height: 44px;
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 50%;
            display: flex; align-items:center; justify-content:center;
            color: var(--gold); font-size: 16px;
            flex-shrink: 0;
            position: relative; z-index: 1;
        }
        .cred-text {
            font-size: 14px; color: var(--text-cream);
            letter-spacing: 0.3px; line-height: 1.5;
            position: relative; z-index: 1;
        }

        /* ═══════════════════════════════════════════════════
           GRAND CTA — Full-width jewellery showcase
           BG: rings on marble
        ═══════════════════════════════════════════════════ */
        .grand-cta {
            position: relative;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;

            background-image:
                linear-gradient(135deg, rgba(10,10,10,0.80) 0%, rgba(10,6,0,0.72) 50%, rgba(10,10,10,0.80) 100%),
                url('https://images.unsplash.com/photo-1573408301185-9519f94f5bb3?w=1920&q=90');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        /* Shimmer overlay */
        .grand-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(201,168,76,0.06) 50%, transparent 70%);
            animation: grand-shimmer 6s ease-in-out infinite;
            pointer-events: none;
        }
        @keyframes grand-shimmer { 0%,100%{opacity:0} 50%{opacity:1} }

        /* Gold top+bottom rule */
        .grand-cta::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-bright), var(--gold), transparent);
        }

        .gcta-inner {
            position: relative;
            z-index: 2;
            padding: 80px 32px;
            max-width: 700px;
        }
        .gcta-ornament {
            display: flex; align-items:center; justify-content:center; gap:16px;
            margin-bottom: 28px;
        }
        .gcta-ornament-line { width: 60px; height: 1px; background: linear-gradient(90deg, transparent, var(--gold)); }
        .gcta-ornament-diamond {
            width: 10px; height: 10px;
            background: var(--gold);
            transform: rotate(45deg);
        }
        .gcta-ornament-line.rev { background: linear-gradient(90deg, var(--gold), transparent); }
        .gcta-eyebrow {
            font-size: 10px; letter-spacing: 5px; text-transform: uppercase;
            color: var(--gold); margin-bottom: 20px; font-weight: 300;
        }
        .gcta-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(40px, 6vw, 68px);
            font-weight: 300;
            color: white;
            line-height: 1.1;
            margin-bottom: 18px;
        }
        .gcta-title em { font-style:italic; color: var(--gold-bright); }
        .gcta-sub {
            font-family: 'EB Garamond', serif;
            font-style: italic;
            font-size: 17px;
            color: rgba(255,255,255,0.7);
            line-height: 1.8;
            margin-bottom: 40px;
        }
        .gcta-btns { display:flex; justify-content:center; gap:14px; flex-wrap:wrap; }

        /* ═══════════════════════════════════════════════════
           CONTACT — Horizontal card strip
        ═══════════════════════════════════════════════════ */
        .contact-strip {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2px;
            border: 1px solid rgba(201,168,76,0.1);
        }
        .contact-strip-item {
            padding: 40px 32px;
            text-align: center;
            background: var(--charcoal);
            transition: all .3s;
            position: relative;
            overflow: hidden;
        }
        .contact-strip-item::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--gold);
            transform: scaleX(0);
            transition: transform .3s;
        }
        .contact-strip-item:hover::before { transform: scaleX(1); }
        .contact-strip-item:hover { background: var(--onyx); }
        .csi-icon { font-size: 22px; color: var(--gold); margin-bottom: 16px; opacity: 0.8; }
        .csi-label { font-size: 9px; letter-spacing: 3px; text-transform: uppercase; color: var(--text-muted); margin-bottom: 10px; }
        .csi-val { font-family: 'Cormorant Garamond', serif; font-size: 18px; color: var(--ivory); }
        .csi-val a { color: var(--ivory); text-decoration: none; }
        .csi-val a:hover { color: var(--gold); }

        /* ═══════════════════════════════════════════════════
           SOCIAL LINKS
        ═══════════════════════════════════════════════════ */
        .social-editorial {
            display: flex;
            justify-content: center;
            gap: 2px;
            margin-top: 48px;
        }
        .social-ed-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 28px;
            background: var(--charcoal);
            border: 1px solid rgba(201,168,76,0.1);
            color: var(--text-muted);
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all .3s;
        }
        .social-ed-btn i { font-size: 16px; color: var(--gold); opacity: 0.7; }
        .social-ed-btn:hover { background: var(--onyx); border-color: var(--gold); color: var(--gold); }
        .social-ed-btn:hover i { opacity: 1; }

        /* ═══════════════════════════════════════════════════
           WHATSAPP FLOATING BUTTON
        ═══════════════════════════════════════════════════ */
        .wa-float {
            position: fixed;
            bottom: 32px; right: 32px;
            width: 58px; height: 58px;
            background: linear-gradient(135deg, #25d366, #128c7e);
            border-radius: 50%;
            display: flex; align-items:center; justify-content:center;
            color: white; font-size: 26px;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(37,211,102,0.4);
            z-index: 500;
            transition: all .3s;
            animation: wa-pulse 3s ease-in-out infinite;
        }
        @keyframes wa-pulse { 0%,100%{box-shadow:0 8px 30px rgba(37,211,102,0.4)} 50%{box-shadow:0 8px 50px rgba(37,211,102,0.6)} }
        .wa-float:hover { transform: scale(1.1) translateY(-3px); }

        /* ═══════════════════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════════════════ */
        .lux-footer {
            background: #060606;
            border-top: 1px solid rgba(201,168,76,0.1);
            padding: 60px 48px 40px;
            text-align: center;
        }
        .lf-ornament {
            display: flex; align-items:center; justify-content:center; gap:16px;
            margin-bottom: 28px;
        }
        .lf-orn-line { width: 80px; height: 1px; background: linear-gradient(90deg, transparent, rgba(201,168,76,0.3)); }
        .lf-orn-diamond {
            width: 8px; height: 8px;
            background: var(--gold); transform: rotate(45deg); opacity: 0.5;
        }
        .lf-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px; font-weight: 300;
            color: var(--ivory); letter-spacing: 8px;
            text-transform: uppercase; margin-bottom: 8px;
        }
        .lf-tagline { font-size: 10px; letter-spacing: 3px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 24px; }
        .lf-copy { font-size: 11px; color: #3a3a3a; letter-spacing: 1px; }
        .lf-copy a { color: var(--gold); text-decoration: none; opacity: 0.7; }
        .lf-copy a:hover { opacity: 1; }

        /* ═══════════════════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════════════════ */
        @media (max-width: 1024px) {
            .collection-magazine { grid-template-columns: 1fr 1fr; }
            .cm-item:nth-child(1) { grid-column: span 2; min-height: 320px; }
            .gallery-tight { grid-template-columns: repeat(3, 1fr); }
            .gt-item:first-child { grid-column: span 2; }
        }
        @media (max-width: 768px) {
            .split-hero { grid-template-columns: 1fr; }
            .hero-photo-panel { min-height: 50vh; display:block; }
            .hero-info-panel { padding: 48px 28px; min-height: unset; }
            .hero-brand-name { font-size: 48px; }
            .hero-cta { flex-direction: column; max-width: 280px; }
            .about-split { grid-template-columns: 1fr; }
            .about-image-side { min-height: 260px; }
            .craft-section { grid-template-columns: 1fr; }
            .collection-magazine { grid-template-columns: 1fr; }
            .cm-item:nth-child(1) { grid-column: span 1; min-height: 300px; }
            .gallery-tight { grid-template-columns: 1fr 1fr; }
            .gt-item:first-child { grid-column: span 2; }
            .content-wrap { padding: 0 20px 60px; }
            .services-editorial { padding: 36px 20px; }
            .gcta-btns { flex-direction: column; align-items:center; }
            .social-editorial { flex-wrap: wrap; }
            .wa-float { bottom: 20px; right: 20px; }
            body::before { display: none; }
        }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> Preview Mode —
        <a href="{{ url('/signin') }}">Sign up</a> to publish your luxury jewellery profile
    </div>
    @endif

    <!-- ── WhatsApp Float ── -->
    @if(isset($social->whatsapp) && $social->whatsapp)
    <a href="https://wa.me/{{ $social->whatsapp }}" class="wa-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
    @elseif($userdata->mobile)
    <a href="tel:{{ $userdata->mobile }}" class="wa-float" style="background:linear-gradient(135deg,var(--gold),var(--gold-bright));color:var(--obsidian);">
        <i class="fas fa-phone"></i>
    </a>
    @endif

    <!-- ══════════════════════════════════════════════════════
         SPLIT HERO — Magazine editorial
         LEFT: Diamond ring macro · RIGHT: Profile
    ══════════════════════════════════════════════════════ -->
    <section class="split-hero">

        <!-- Photo Panel -->
        <div class="hero-photo-panel">
            <span class="hero-photo-label">Fine Jewellery &amp; Collections</span>
        </div>

        <!-- Info Panel -->
        <div class="hero-info-panel">
            <div class="hero-issue">
                <span class="hi-line"></span>
                <span class="hi-text">Luxury Jewellery House</span>
            </div>

            <!-- Avatar -->
            <div class="hero-avatar-wrap" style="position:relative;">
                <div class="hero-avatar-border" style="position:absolute;inset:0;border-radius:50%;"></div>
                <div class="hero-avatar-inner">
                    @if($userdata->profile)
                        <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}" alt="{{ $userdata->name }}">
                    @else
                        <div class="hero-avatar-placeholder">
                            <i class="fas fa-gem"></i>
                        </div>
                    @endif
                </div>
            </div>

            @if($userdata->isFeatureVisible('name'))
            <h1 class="hero-brand-name">
                {{ $userdata->name }}<em>Jewellers</em>
            </h1>
            @endif

            @if($userdata->desig)
            <p class="hero-designation">{{ $userdata->desig }}</p>
            @endif

            @if($userdata->isFeatureVisible('bio') && $userdata->about_us)
            <p class="hero-bio">{{ Str::limit($userdata->about_us, 180) }}</p>
            @else
            <p class="hero-bio">Crafting timeless pieces of art in gold, diamond &amp; precious stones. Every jewel tells a story of elegance, tradition and unmatched craftsmanship.</p>
            @endif

            @if($userdata->city)
            <div class="hero-location">
                <i class="fas fa-map-marker-alt"></i>
                {{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}
            </div>
            @endif

            <div class="hero-cta">
                @if($userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="btn-gold-solid">
                    <i class="fas fa-phone"></i> Call Now
                </a>
                @endif
                @if($userdata->email)
                <a href="mailto:{{ $userdata->email }}" class="btn-ghost-gold">
                    <i class="fas fa-envelope"></i> Enquire
                </a>
                @endif
            </div>

            <div class="hero-scroll">
                <div class="hero-scroll-line"></div>
                <span>Scroll</span>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════════════
         METAL RATES TICKER — Gold gradient strip
    ══════════════════════════════════════════════════════ -->
    <div class="rates-ticker">
        <div class="ticker-track">
            {{-- Duplicate for seamless loop --}}
            @if(isset($metalRates) && $metalRates->count() > 0)
                @foreach(array_fill(0, 2, null) as $_)
                @foreach($metalRates->take(8) as $rate)
                <div class="ticker-item">
                    <span class="ticker-metal">{{ strtoupper($rate->metal_type) }}</span>
                    <span class="ticker-purity">{{ $rate->purity ?? '' }}</span>
                    <span class="ticker-rate">₹{{ number_format($rate->rate_per_gram, 2) }}</span>
                    <span class="ticker-up"><i class="fas fa-caret-up"></i></span>
                </div>
                @endforeach
                @endforeach
            @else
                {{-- Default demo rates --}}
                @foreach(array_fill(0, 2, null) as $_)
                <div class="ticker-item"><span class="ticker-metal">Gold 24K</span><span class="ticker-rate">₹7,280</span><span class="ticker-up"><i class="fas fa-caret-up"></i> 0.3%</span></div>
                <div class="ticker-item"><span class="ticker-metal">Gold 22K</span><span class="ticker-rate">₹6,674</span><span class="ticker-up"><i class="fas fa-caret-up"></i> 0.2%</span></div>
                <div class="ticker-item"><span class="ticker-metal">Gold 18K</span><span class="ticker-rate">₹5,460</span><span class="ticker-up"><i class="fas fa-caret-up"></i> 0.1%</span></div>
                <div class="ticker-item"><span class="ticker-metal">Silver</span><span class="ticker-rate">₹92.50</span><span class="ticker-down"><i class="fas fa-caret-down"></i> 0.1%</span></div>
                <div class="ticker-item"><span class="ticker-metal">Platinum</span><span class="ticker-rate">₹3,120</span><span class="ticker-up"><i class="fas fa-caret-up"></i> 0.5%</span></div>
                <div class="ticker-item"><span class="ticker-metal">Diamond</span><span class="ticker-rate">₹52,000</span><span class="ticker-up"><i class="fas fa-caret-up"></i> 1.2%</span></div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- ══════════════════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════════════════ -->
    <div class="content-wrap">

        <!-- ── 01 ABOUT ── -->
        @if($userdata->isFeatureVisible('bio') && $userdata->about_us)
        <div class="ed-header">
            <div class="ed-number">01</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">Our Story</div>
                <h2 class="ed-title">The <em>Legacy</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        <div class="about-split">
            <div class="about-image-side"></div>
            <div class="about-text-side">
                <div class="about-eyebrow">Est. Heritage</div>
                <h3 class="about-heading">Crafted with<br>Passion &amp; Precision</h3>
                <p class="about-text">{{ $userdata->about_us }}</p>
                <div class="about-stats">
                    <div class="as-item">
                        <div class="as-num">25+</div>
                        <div class="as-label">Years</div>
                    </div>
                    <div class="as-item">
                        <div class="as-num">10K+</div>
                        <div class="as-label">Clients</div>
                    </div>
                    <div class="as-item">
                        <div class="as-num">500+</div>
                        <div class="as-label">Designs</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- ── 02 METAL RATES GRID ── -->
        @if(isset($metalRates) && $metalRates->count() > 0)
        <div class="ed-header">
            <div class="ed-number">02</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">Live Pricing</div>
                <h2 class="ed-title">Today's <em>Rates</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        <div class="rates-grid-lx">
            @foreach($metalRates->take(6) as $rate)
            <div class="rate-tile">
                <div class="rt-metal">{{ $rate->metal_type }}</div>
                <div class="rt-value"><sup>₹</sup>{{ number_format($rate->rate_per_gram, 0) }}</div>
                <div class="rt-purity">{{ $rate->purity ?? 'per gram' }}</div>
            </div>
            @endforeach
        </div>
        @else
        {{-- Default demo rates grid --}}
        <div class="ed-header">
            <div class="ed-number">02</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">Live Pricing</div>
                <h2 class="ed-title">Today's <em>Rates</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        <div class="rates-grid-lx">
            <div class="rate-tile"><div class="rt-metal">Gold 24K</div><div class="rt-value"><sup>₹</sup>7,280</div><div class="rt-purity">per gram</div></div>
            <div class="rate-tile"><div class="rt-metal">Gold 22K</div><div class="rt-value"><sup>₹</sup>6,674</div><div class="rt-purity">per gram</div></div>
            <div class="rate-tile"><div class="rt-metal">Gold 18K</div><div class="rt-value"><sup>₹</sup>5,460</div><div class="rt-purity">per gram</div></div>
            <div class="rate-tile"><div class="rt-metal">Silver</div><div class="rt-value"><sup>₹</sup>92</div><div class="rt-purity">per gram</div></div>
            <div class="rate-tile"><div class="rt-metal">Platinum</div><div class="rt-value"><sup>₹</sup>3,120</div><div class="rt-purity">per gram</div></div>
            <div class="rate-tile"><div class="rt-metal">Diamond</div><div class="rt-value"><sup>₹</sup>52K</div><div class="rt-purity">per carat</div></div>
        </div>
        @endif

        <!-- ── 03 SERVICES — Jewellery BG ── -->
        @if($userdata->isFeatureVisible('services') && isset($professions) && $professions->count() > 0)
        <div class="ed-header">
            <div class="ed-number">03</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">What We Offer</div>
                <h2 class="ed-title">Our <em>Services</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        <div class="services-editorial">
            <div class="services-ed-grid">
                @php $srvIcons = ['fa-gem','fa-ring','fa-crown','fa-star','fa-award','fa-certificate','fa-shield-alt','fa-magic']; @endphp
                @foreach($professions as $profession)
                @php $serviceTitle = $profession->title ?? $profession->profession ?? $profession->service_name ?? $profession->name ?? ''; $serviceDesc = $profession->desc ?? $profession->description ?? $profession->service_desc ?? ''; @endphp
                <div class="service-ed-card">
                    <div class="sed-icon"><i class="fas {{ $srvIcons[$loop->index % count($srvIcons)] }}"></i></div>
                    <div class="sed-title">{{ $serviceTitle }}</div>
                    @if($serviceDesc)<div class="sed-desc">{{ $serviceDesc }}</div>@endif
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="ed-header">
            <div class="ed-number">03</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">What We Offer</div>
                <h2 class="ed-title">Our <em>Services</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        <div class="services-editorial">
            <div class="services-ed-grid">
                <div class="service-ed-card"><div class="sed-icon"><i class="fas fa-gem"></i></div><div class="sed-title">Custom Design</div><div class="sed-desc">Bespoke jewellery crafted exactly to your vision and measurements.</div></div>
                <div class="service-ed-card"><div class="sed-icon"><i class="fas fa-ring"></i></div><div class="sed-title">Bridal Collections</div><div class="sed-desc">Exquisite bridal sets for weddings, engagements &amp; special occasions.</div></div>
                <div class="service-ed-card"><div class="sed-icon"><i class="fas fa-crown"></i></div><div class="sed-title">Gold Jewellery</div><div class="sed-desc">Premium 22K &amp; 24K gold ornaments in traditional &amp; contemporary styles.</div></div>
                <div class="service-ed-card"><div class="sed-icon"><i class="fas fa-star"></i></div><div class="sed-title">Diamond Jewellery</div><div class="sed-desc">Certified solitaire &amp; designer diamond pieces for every occasion.</div></div>
                <div class="service-ed-card"><div class="sed-icon"><i class="fas fa-wrench"></i></div><div class="sed-title">Repair &amp; Restore</div><div class="sed-desc">Expert restoration and refinishing of your precious heirlooms.</div></div>
                <div class="service-ed-card"><div class="sed-icon"><i class="fas fa-exchange-alt"></i></div><div class="sed-title">Exchange &amp; Buyback</div><div class="sed-desc">Transparent old gold exchange at live market rates — no deductions.</div></div>
            </div>
        </div>
        @endif

        <!-- ── 04 SIGNATURE COLLECTION — Magazine Grid ── -->
        <div class="ed-header">
            <div class="ed-number">04</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">Fine Jewellery</div>
                <h2 class="ed-title">Signature <em>Collection</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        @if(isset($jewelleryProducts) && $jewelleryProducts->count() > 0)
        <div class="collection-magazine">
            @foreach($jewelleryProducts->take(6) as $product)
            @php
                $pImage = null;
                if (is_array($product->images) && count($product->images) > 0) {
                    $pImage = url('public/uploads/jewellery/products/'.$product->images[0]);
                }
            @endphp
            <div class="cm-item">
                @if($pImage)
                    <img src="{{ $pImage }}" class="cm-user-img" alt="{{ $product->product_name }}">
                @else
                    <div class="cm-img"></div>
                @endif
                <div class="cm-overlay"></div>
                <div class="cm-content">
                    <div class="cm-category">{{ $product->category ?? 'Fine Jewellery' }}</div>
                    <div class="cm-name">{{ $product->product_name }}</div>
                </div>
            </div>
            @endforeach
        </div>
        @elseif(isset($portfolios) && $portfolios->count() > 0)
        <div class="collection-magazine">
            @foreach($portfolios->take(6) as $portfolio)
            @php $images = json_decode($portfolio->image, true); @endphp
            @if($images && count($images) > 0)
            <div class="cm-item">
                <img src="{{ url('public/frontend/portfolio/'.$images[0]) }}" class="cm-user-img" alt="{{ $portfolio->title }}">
                <div class="cm-overlay"></div>
                <div class="cm-content">
                    <div class="cm-category">Collection</div>
                    @if($portfolio->title)<div class="cm-name">{{ $portfolio->title }}</div>@endif
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @else
        {{-- Default showcase --}}
        <div class="collection-magazine">
            <div class="cm-item"><div class="cm-img"></div><div class="cm-overlay"></div><div class="cm-content"><div class="cm-category">Bridal</div><div class="cm-name">Celestial Necklace</div></div></div>
            <div class="cm-item"><div class="cm-img"></div><div class="cm-overlay"></div><div class="cm-content"><div class="cm-category">Engagement</div><div class="cm-name">Solitaire Ring</div></div></div>
            <div class="cm-item"><div class="cm-img"></div><div class="cm-overlay"></div><div class="cm-content"><div class="cm-category">Classic</div><div class="cm-name">Diamond Band</div></div></div>
            <div class="cm-item"><div class="cm-img"></div><div class="cm-overlay"></div><div class="cm-content"><div class="cm-category">Heritage</div><div class="cm-name">Gold Anklet</div></div></div>
            <div class="cm-item"><div class="cm-img"></div><div class="cm-overlay"></div><div class="cm-content"><div class="cm-category">Earrings</div><div class="cm-name">Pearl Drops</div></div></div>
            <div class="cm-item"><div class="cm-img"></div><div class="cm-overlay"></div><div class="cm-content"><div class="cm-category">Bangles</div><div class="cm-name">22K Gold Set</div></div></div>
        </div>
        @endif

        <!-- ── 05 CRAFTSMANSHIP ── -->
        <div class="ed-header">
            <div class="ed-number">05</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">Our Promise</div>
                <h2 class="ed-title">The <em>Craft</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        <div class="craft-section">
            <div class="craft-num-panel">
                <div class="cn-num">100%</div>
                <div class="cn-label">Hallmark<br>Certified</div>
            </div>
            <div class="craft-features">
                <div class="cf-item">
                    <div class="cf-icon"><i class="fas fa-certificate"></i></div>
                    <div class="cf-title">BIS Hallmarked</div>
                    <div class="cf-text">Every piece certified for purity under the Bureau of Indian Standards hallmarking system.</div>
                </div>
                <div class="cf-item">
                    <div class="cf-icon"><i class="fas fa-hand-sparkles"></i></div>
                    <div class="cf-title">Handcrafted</div>
                    <div class="cf-text">Master artisans with decades of experience hand-finish every ornament to perfection.</div>
                </div>
                <div class="cf-item">
                    <div class="cf-icon"><i class="fas fa-shield-alt"></i></div>
                    <div class="cf-title">Lifetime Buy-back</div>
                    <div class="cf-text">We buy back our jewellery at transparent live market rates — your trust is our foundation.</div>
                </div>
                <div class="cf-item">
                    <div class="cf-icon"><i class="fas fa-gift"></i></div>
                    <div class="cf-title">Gift Packaging</div>
                    <div class="cf-text">Signature luxury packaging and custom engraving available for all gifting occasions.</div>
                </div>
            </div>
        </div>

        <!-- ── 06 GALLERY ── -->
        @if($userdata->isFeatureVisible('portfolio') && isset($portfolios) && $portfolios->count() > 0)
        <div class="ed-header">
            <div class="ed-number">06</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">Portfolio</div>
                <h2 class="ed-title">Our <em>Gallery</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        <div class="gallery-tight">
            @foreach($portfolios->take(5) as $portfolio)
            @php $images = json_decode($portfolio->image, true); @endphp
            @if($images && count($images) > 0)
            <div class="gt-item">
                <img src="{{ url('public/frontend/portfolio/'.$images[0]) }}" alt="{{ $portfolio->title }}">
            </div>
            @endif
            @endforeach
        </div>
        @else
        <div class="ed-header">
            <div class="ed-number">06</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">Portfolio</div>
                <h2 class="ed-title">Our <em>Gallery</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        <div class="gallery-tight">
            <div class="gt-item"><div class="gt-default-bg"></div></div>
            <div class="gt-item"><div class="gt-default-bg"></div></div>
            <div class="gt-item"><div class="gt-default-bg"></div></div>
            <div class="gt-item"><div class="gt-default-bg"></div></div>
            <div class="gt-item"><div class="gt-default-bg"></div></div>
        </div>
        @endif

        <!-- ── 07 CREDENTIALS ── -->
        @if($userdata->isFeatureVisible('qualifications') && isset($qualifications) && $qualifications->count() > 0)
        <div class="ed-header">
            <div class="ed-number">07</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">Trust &amp; Excellence</div>
                <h2 class="ed-title">Our <em>Credentials</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>
        <div class="cred-grid">
            @foreach($qualifications as $qual)
            @php $qualTitle = $qual->qualifiaction ?? $qual->title ?? ''; $qualDesc = $qual->description ?? $qual->desc ?? ''; @endphp
            <div class="cred-item">
                <div class="cred-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="cred-icon"><i class="fas fa-certificate"></i></div>
                <div class="cred-text">{{ $qualTitle }}{{ $qualDesc ? ' — '.$qualDesc : '' }}</div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- ── GRAND CTA — Rings on marble BG ── -->
        <div style="margin-top: 80px;"></div>
    </div>

    <div class="grand-cta">
        <div class="gcta-inner">
            <div class="gcta-ornament">
                <div class="gcta-ornament-line"></div>
                <div class="gcta-ornament-diamond"></div>
                <div class="gcta-ornament-line rev"></div>
            </div>
            <div class="gcta-eyebrow">Begin Your Journey</div>
            <h2 class="gcta-title">Where Every Jewel<br>Tells a <em>Story</em></h2>
            <p class="gcta-sub">Visit our showroom or speak to our jewellery experts today. Let us help you find or create the perfect piece for your most precious moments.</p>
            <div class="gcta-btns">
                @if($userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="btn-gold-solid" style="padding:18px 44px; font-size:11px;">
                    <i class="fas fa-phone"></i> Call Showroom
                </a>
                @endif
                @if($userdata->email)
                <a href="mailto:{{ $userdata->email }}" class="btn-ghost-gold" style="padding:16px 36px;">
                    <i class="fas fa-envelope"></i> Send Enquiry
                </a>
                @endif
                @if(isset($social->whatsapp) && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" class="btn-ghost-gold" style="padding:16px 36px; border-color:rgba(37,211,102,0.4); color:#4ade80;">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- ── CONTACT + SOCIAL ── -->
    <div class="content-wrap">
        <div class="ed-header">
            <div class="ed-number">08</div>
            <div class="ed-titles">
                <div class="ed-eyebrow">Reach Us</div>
                <h2 class="ed-title">Contact <em>Details</em></h2>
            </div>
            <div class="ed-rule"></div>
        </div>

        <div class="contact-strip">
            @if($userdata->mobile)
            <div class="contact-strip-item">
                <div class="csi-icon"><i class="fas fa-phone"></i></div>
                <div class="csi-label">Phone</div>
                <div class="csi-val"><a href="tel:{{ $userdata->mobile }}">{{ $userdata->mobile }}</a></div>
            </div>
            @endif
            @if($userdata->email)
            <div class="contact-strip-item">
                <div class="csi-icon"><i class="fas fa-envelope"></i></div>
                <div class="csi-label">Email</div>
                <div class="csi-val"><a href="mailto:{{ $userdata->email }}">{{ $userdata->email }}</a></div>
            </div>
            @endif
            @if($userdata->city)
            <div class="contact-strip-item">
                <div class="csi-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="csi-label">Location</div>
                <div class="csi-val">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
            </div>
            @endif
            @if(isset($social->whatsapp) && $social->whatsapp)
            <div class="contact-strip-item">
                <div class="csi-icon" style="color:#25d366;"><i class="fab fa-whatsapp"></i></div>
                <div class="csi-label">WhatsApp</div>
                <div class="csi-val"><a href="https://wa.me/{{ $social->whatsapp }}" style="color:#4ade80;">{{ $social->whatsapp }}</a></div>
            </div>
            @endif
        </div>

        @if(isset($social) && $social)
        <div class="social-editorial">
            @if(isset($social->facebook) && $social->facebook)
            <a href="{{ $social->facebook }}" target="_blank" class="social-ed-btn"><i class="fab fa-facebook-f"></i> Facebook</a>
            @endif
            @if(isset($social->instagram) && $social->instagram)
            <a href="{{ $social->instagram }}" target="_blank" class="social-ed-btn"><i class="fab fa-instagram"></i> Instagram</a>
            @endif
            @if(isset($social->youtube) && $social->youtube)
            <a href="{{ $social->youtube }}" target="_blank" class="social-ed-btn"><i class="fab fa-youtube"></i> YouTube</a>
            @endif
            @if(isset($social->linkedin) && $social->linkedin)
            <a href="{{ $social->linkedin }}" target="_blank" class="social-ed-btn"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
            @endif
            @if(isset($social->twitter) && $social->twitter)
            <a href="{{ $social->twitter }}" target="_blank" class="social-ed-btn"><i class="fab fa-twitter"></i> Twitter</a>
            @endif
        </div>
        @endif
    </div>

    <!-- FOOTER -->
    <footer class="lux-footer">
        <div class="lf-ornament">
            <div class="lf-orn-line"></div>
            <div class="lf-orn-diamond"></div>
            <div class="lf-orn-line" style="background:linear-gradient(90deg,rgba(201,168,76,0.3),transparent);"></div>
        </div>
        <div class="lf-brand">{{ strtoupper($userdata->name ?? 'Jewellers') }}</div>
        <div class="lf-tagline">Fine Jewellery &amp; Precious Collections</div>
        <div class="lf-copy">Digital Card by <a href="{{ url('/') }}">Fastap</a></div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])
</body>
</html>