<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Content Creator' }} - Influencer Profile</title>

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

        $themeColor = $theme->color ?? '#ec4899';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ============================================
           DARK CINEMATIC INFLUENCER THEME
           ============================================ */
        :root {
            --bg-primary:    #080808;
            --bg-secondary:  #111111;
            --bg-card:       #161616;
            --bg-card-hover: #1e1e1e;
            --border-subtle: rgba(255,255,255,0.07);
            --border-glow:   rgba(236,72,153,0.4);

            --accent-pink:   #ec4899;
            --accent-purple: #a855f7;
            --accent-cyan:   #22d3ee;
            --accent-orange: #f97316;
            --accent-gold:   #f59e0b;

            --text-primary:  #f8fafc;
            --text-secondary:#94a3b8;
            --text-muted:    #475569;

            --glow-pink:     0 0 30px rgba(236,72,153,0.35);
            --glow-purple:   0 0 30px rgba(168,85,247,0.35);
            --glow-cyan:     0 0 30px rgba(34,211,238,0.35);
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ── Noise texture overlay ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* ── Ambient background orbs ── */
        .ambient-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.12;
            animation: orb-float 20s ease-in-out infinite;
        }
        .orb-1 { width:500px; height:500px; background:var(--accent-pink);   top:-150px; left:-100px; animation-delay:0s; }
        .orb-2 { width:400px; height:400px; background:var(--accent-purple); top:30%;    right:-100px; animation-delay:-7s; }
        .orb-3 { width:350px; height:350px; background:var(--accent-cyan);   bottom:10%; left:20%; animation-delay:-14s; }

        @keyframes orb-float {
            0%,100% { transform: translateY(0) scale(1); }
            33%      { transform: translateY(-40px) scale(1.05); }
            66%      { transform: translateY(20px) scale(0.97); }
        }

        /* ============================================
           PREVIEW BANNER
           ============================================ */
        .preview-banner {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: linear-gradient(90deg, var(--accent-pink), var(--accent-purple));
            color: #fff;
            padding: 12px 20px;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .preview-banner a { color: var(--accent-gold); text-decoration: underline; margin-left: 6px; }

        /* ============================================
           TOP NAV BAR (thin strip)
           ============================================ */
        .top-nav {
            position: relative;
            z-index: 50;
            background: rgba(8,8,8,0.9);
            border-bottom: 1px solid var(--border-subtle);
            backdrop-filter: blur(20px);
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }
        .top-nav-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 3px;
            background: linear-gradient(90deg, var(--accent-pink), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .top-nav-actions { display:flex; gap:12px; align-items:center; }
        .nav-pill {
            padding: 7px 18px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all .3s;
            text-decoration: none;
        }
        .nav-pill-outline {
            border: 1px solid var(--border-glow);
            color: var(--accent-pink);
            background: transparent;
        }
        .nav-pill-outline:hover { background: rgba(236,72,153,0.12); }
        .nav-pill-solid {
            background: linear-gradient(135deg, var(--accent-pink), var(--accent-purple));
            color: #fff;
            border: none;
        }
        .nav-pill-solid:hover { opacity: 0.88; transform: translateY(-1px); }

        /* ============================================
           HERO / BANNER
           ============================================ */
        .hero {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 24px 120px;
            overflow: hidden;
        }

        /* Hero grid lines */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        /* Scanline effect */
        .hero-scanlines {
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,0,0,0.15) 2px,
                rgba(0,0,0,0.15) 4px
            );
            pointer-events: none;
            opacity: 0.3;
        }

        /* Diagonal accent stripe */
        .hero-stripe {
            position: absolute;
            top: 0; right: 0;
            width: 40%;
            height: 100%;
            background: linear-gradient(135deg, transparent 40%, rgba(236,72,153,0.04) 40%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 5;
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
        }

        /* ── Profile Photo ── */
        .hero-avatar-wrap {
            position: relative;
            width: 180px;
            height: 180px;
            margin: 0 auto 36px;
        }
        .hero-avatar-ring {
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            background: conic-gradient(
                var(--accent-pink) 0deg,
                var(--accent-purple) 120deg,
                var(--accent-cyan) 240deg,
                var(--accent-pink) 360deg
            );
            animation: spin-ring 6s linear infinite;
            z-index: 1;
        }
        @keyframes spin-ring { to { transform: rotate(360deg); } }

        .hero-avatar-ring-inner {
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background: var(--bg-primary);
            z-index: 2;
        }
        .hero-avatar {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            background: var(--bg-card);
            z-index: 3;
        }
        .hero-avatar img { width:100%; height:100%; object-fit:cover; }
        .hero-avatar-placeholder {
            width:100%; height:100%;
            display:flex; align-items:center; justify-content:center;
            background: linear-gradient(135deg, var(--accent-pink), var(--accent-purple));
            color:#fff; font-size:64px;
        }
        .hero-verified {
            position: absolute;
            bottom: 4px; right: 4px;
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--accent-cyan), #0891b2);
            border-radius: 50%;
            border: 3px solid var(--bg-primary);
            display: flex; align-items:center; justify-content:center;
            color:#fff; font-size:15px;
            z-index: 4;
            box-shadow: var(--glow-cyan);
        }

        /* ── Live Badge ── */
        .hero-live-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: rgba(236,72,153,0.1);
            border: 1px solid rgba(236,72,153,0.4);
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--accent-pink);
            margin-bottom: 24px;
        }
        .live-dot {
            width: 8px; height: 8px;
            background: var(--accent-pink);
            border-radius: 50%;
            animation: live-pulse 1.5s ease-in-out infinite;
        }
        @keyframes live-pulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(236,72,153,0.7); }
            50%      { box-shadow: 0 0 0 6px rgba(236,72,153,0); }
        }

        /* ── Hero Name ── */
        .hero-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(52px, 9vw, 100px);
            letter-spacing: 6px;
            line-height: 1;
            margin-bottom: 16px;
            color: #fff;
        }
        .hero-name span {
            background: linear-gradient(90deg, var(--accent-pink), var(--accent-purple), var(--accent-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Tagline ── */
        .hero-tagline {
            font-size: 16px;
            color: var(--text-secondary);
            font-weight: 400;
            letter-spacing: 1px;
            margin-bottom: 36px;
            text-transform: uppercase;
        }

        /* ── Category Chips ── */
        .hero-chips {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 48px;
        }
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-subtle);
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            letter-spacing: 0.5px;
            transition: all .3s;
        }
        .chip:hover {
            border-color: var(--accent-pink);
            color: var(--accent-pink);
            background: rgba(236,72,153,0.08);
        }
        .chip i { color: var(--accent-pink); }

        /* ── Hero CTA Buttons ── */
        .hero-cta {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .btn-primary-dark {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 36px;
            background: linear-gradient(135deg, var(--accent-pink), var(--accent-purple));
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 4px;
            text-decoration: none;
            transition: all .3s;
            box-shadow: var(--glow-pink);
        }
        .btn-primary-dark:hover { transform: translateY(-3px); box-shadow: 0 0 50px rgba(236,72,153,0.5); }

        .btn-ghost-dark {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 36px;
            background: transparent;
            color: var(--text-primary);
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 4px;
            text-decoration: none;
            transition: all .3s;
        }
        .btn-ghost-dark:hover { border-color: var(--accent-pink); color: var(--accent-pink); background: rgba(236,72,153,0.06); }

        /* ── Scroll indicator ── */
        .scroll-indicator {
            position: absolute;
            bottom: 36px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            animation: scroll-bounce 2s ease-in-out infinite;
        }
        @keyframes scroll-bounce { 0%,100% {transform:translateX(-50%) translateY(0);} 50%{transform:translateX(-50%) translateY(8px);} }

        /* ============================================
           STATS TICKER (horizontal scrolling)
           ============================================ */
        .stats-ticker {
            position: relative;
            z-index: 20;
            background: var(--bg-secondary);
            border-top: 1px solid var(--border-subtle);
            border-bottom: 1px solid var(--border-subtle);
            padding: 0;
            overflow: hidden;
        }
        .ticker-inner {
            display: flex;
            animation: ticker-scroll 25s linear infinite;
            white-space: nowrap;
            padding: 18px 0;
        }
        @keyframes ticker-scroll {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        .ticker-item {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 0 50px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            letter-spacing: 2px;
            color: var(--text-muted);
            border-right: 1px solid var(--border-subtle);
            flex-shrink: 0;
        }
        .ticker-item .t-num {
            color: var(--accent-pink);
            font-size: 22px;
        }
        .ticker-item .t-icon { color: var(--accent-purple); font-size: 14px; }

        /* ============================================
           MAIN CONTENT AREA
           ============================================ */
        .main-wrap {
            position: relative;
            z-index: 10;
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 24px 100px;
        }

        /* ── Section Heading ── */
        .section-label {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 40px;
        }
        .section-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 13px;
            letter-spacing: 3px;
            color: var(--accent-pink);
        }
        .section-line { flex:1; height:1px; background: var(--border-subtle); }
        .section-tag {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-subtle);
            padding: 4px 12px;
            border-radius: 2px;
        }
        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(36px, 5vw, 56px);
            letter-spacing: 4px;
            color: var(--text-primary);
            margin-bottom: 40px;
            line-height: 1;
        }
        .section-title span {
            background: linear-gradient(90deg, var(--accent-pink), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Dark Card ── */
        .dark-card {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 2px;
            padding: 40px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
            transition: border-color .3s, box-shadow .3s;
        }
        .dark-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-pink), var(--accent-purple), var(--accent-cyan));
            opacity: 0;
            transition: opacity .3s;
        }
        .dark-card:hover::before { opacity: 1; }
        .dark-card:hover {
            border-color: rgba(236,72,153,0.2);
            box-shadow: 0 0 60px rgba(236,72,153,0.08);
        }

        /* Card corner accent */
        .dark-card::after {
            content: '';
            position: absolute;
            bottom: 0; right: 0;
            width: 80px; height: 80px;
            background: linear-gradient(135deg, transparent 50%, rgba(236,72,153,0.05) 50%);
            pointer-events: none;
        }

        /* ── Card Header ── */
        .dc-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border-subtle);
        }
        .dc-icon {
            width: 52px; height: 52px;
            display: flex; align-items:center; justify-content:center;
            border: 1px solid rgba(236,72,153,0.3);
            border-radius: 2px;
            color: var(--accent-pink);
            font-size: 22px;
            background: rgba(236,72,153,0.06);
            flex-shrink: 0;
            transition: all .3s;
        }
        .dark-card:hover .dc-icon { background: rgba(236,72,153,0.12); box-shadow: var(--glow-pink); }
        .dc-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 3px;
            color: var(--text-primary);
        }
        .dc-subtitle { font-size: 13px; color: var(--text-muted); margin-top: 2px; }

        /* ============================================
           ABOUT SECTION
           ============================================ */
        .about-layout {
            display: grid;
            grid-template-columns: 1fr 260px;
            gap: 32px;
            align-items: start;
        }
        .about-text { font-size: 15px; color: var(--text-secondary); line-height: 1.9; }
        .about-sidebar {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .about-info-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border-subtle);
            border-radius: 2px;
        }
        .about-info-icon {
            width: 36px; height: 36px;
            display:flex; align-items:center; justify-content:center;
            border-radius: 2px;
            font-size: 16px;
            flex-shrink: 0;
        }
        .info-label { font-size: 10px; color: var(--text-muted); text-transform:uppercase; letter-spacing:1px; }
        .info-val   { font-size: 14px; color: var(--text-primary); font-weight: 600; margin-top:2px; }

        /* ============================================
           STATS GRID
           ============================================ */
        .stats-4col {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2px;
        }
        .stat-block {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            padding: 36px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all .3s;
        }
        .stat-block:hover {
            background: var(--bg-card-hover);
            border-color: rgba(236,72,153,0.3);
        }
        .stat-block::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: var(--accent-pink);
            transform: scaleX(0);
            transition: transform .3s;
        }
        .stat-block:hover::after { transform: scaleX(1); }
        .stat-block-icon {
            font-size: 26px;
            margin-bottom: 16px;
            opacity: 0.7;
        }
        .stat-block-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px;
            letter-spacing: 2px;
            line-height: 1;
            background: linear-gradient(135deg, var(--accent-pink), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }
        .stat-block-label {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* ============================================
           CONTENT CATEGORIES
           ============================================ */
        .cat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 2px;
        }
        .cat-item {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            padding: 32px 24px;
            text-align: center;
            position: relative;
            overflow: hidden;
            cursor: default;
            transition: all .3s;
            group: true;
        }
        .cat-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(236,72,153,0.08), rgba(168,85,247,0.08));
            opacity: 0;
            transition: opacity .3s;
        }
        .cat-item:hover::before { opacity: 1; }
        .cat-item:hover { border-color: rgba(236,72,153,0.3); transform: translateY(-4px); }
        .cat-emoji { font-size: 40px; margin-bottom: 16px; display:block; }
        .cat-name {
            font-family: 'Syne', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 6px;
        }
        .cat-count { font-size: 12px; color: var(--text-muted); letter-spacing: 1px; }
        .cat-bar {
            margin-top: 16px;
            height: 2px;
            background: var(--border-subtle);
            border-radius: 2px;
            overflow: hidden;
        }
        .cat-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--accent-pink), var(--accent-purple));
            border-radius: 2px;
            transition: width .6s ease;
        }

        /* ============================================
           BRAND COLLABORATION STRIP
           ============================================ */
        .brands-row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 2px;
        }
        .brand-tile {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            aspect-ratio: 2/1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 15px;
            letter-spacing: 2px;
            color: var(--text-muted);
            transition: all .3s;
            position: relative;
            overflow: hidden;
        }
        .brand-tile::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(236,72,153,0.06), transparent);
            opacity: 0;
            transition: opacity .3s;
        }
        .brand-tile:hover::before { opacity: 1; }
        .brand-tile:hover {
            border-color: rgba(236,72,153,0.3);
            color: var(--accent-pink);
        }
        .brand-tile i { font-size: 24px; }

        /* ============================================
           CONTACT SECTION
           ============================================ */
        .contact-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px;
        }
        .contact-item {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            padding: 28px 32px;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all .3s;
            position: relative;
            overflow: hidden;
        }
        .contact-item::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, var(--accent-pink), var(--accent-purple));
            transform: scaleY(0);
            transition: transform .3s;
        }
        .contact-item:hover::before { transform: scaleY(1); }
        .contact-item:hover { background: var(--bg-card-hover); }
        .contact-ico {
            width: 48px; height: 48px;
            border: 1px solid rgba(236,72,153,0.3);
            border-radius: 2px;
            display: flex; align-items:center; justify-content:center;
            color: var(--accent-pink);
            font-size: 20px;
            flex-shrink: 0;
            background: rgba(236,72,153,0.05);
        }
        .c-label { font-size: 10px; color: var(--text-muted); text-transform:uppercase; letter-spacing:1.5px; margin-bottom:6px; }
        .c-val   { font-size: 15px; color: var(--text-primary); font-weight: 600; }

        /* ============================================
           SOCIAL LINKS
           ============================================ */
        .social-dark-wrap {
            margin-top: 60px;
            padding: 48px 0;
            border-top: 1px solid var(--border-subtle);
            border-bottom: 1px solid var(--border-subtle);
            text-align: center;
        }
        .social-tagline {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 38px;
            letter-spacing: 6px;
            color: var(--text-primary);
            margin-bottom: 8px;
        }
        .social-sub { font-size: 14px; color: var(--text-muted); margin-bottom: 36px; letter-spacing: 0.5px; }
        .social-dark-row {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .social-dark-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 2px;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all .3s;
        }
        .social-dark-btn i { font-size: 18px; }
        .social-dark-btn:hover {
            background: var(--bg-card-hover);
            border-color: var(--accent-pink);
            color: var(--accent-pink);
            transform: translateY(-3px);
            box-shadow: var(--glow-pink);
        }
        /* individual platform colors on hover */
        .sb-ig:hover  { border-color: #e1306c; color: #e1306c; box-shadow: 0 0 30px rgba(225,48,108,0.3); }
        .sb-yt:hover  { border-color: #ff0000; color: #ff0000; box-shadow: 0 0 30px rgba(255,0,0,0.3); }
        .sb-tt:hover  { border-color: #69c9d0; color: #69c9d0; box-shadow: 0 0 30px rgba(105,201,208,0.3); }
        .sb-fb:hover  { border-color: #1877f2; color: #1877f2; box-shadow: 0 0 30px rgba(24,119,242,0.3); }
        .sb-tw:hover  { border-color: #1da1f2; color: #1da1f2; box-shadow: 0 0 30px rgba(29,161,242,0.3); }
        .sb-li:hover  { border-color: #0a66c2; color: #0a66c2; box-shadow: 0 0 30px rgba(10,102,194,0.3); }
        .sb-wa:hover  { border-color: #25d366; color: #25d366; box-shadow: 0 0 30px rgba(37,211,102,0.3); }

        /* ============================================
           COLLABORATION CTA
           ============================================ */
        .collab-dark {
            position: relative;
            margin-top: 60px;
            padding: 80px;
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            overflow: hidden;
            text-align: center;
        }
        /* Glowing corner accents */
        .collab-dark::before {
            content: '';
            position: absolute;
            top: -80px; left: -80px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(236,72,153,0.15), transparent 70%);
            pointer-events: none;
        }
        .collab-dark::after {
            content: '';
            position: absolute;
            bottom: -80px; right: -80px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(168,85,247,0.15), transparent 70%);
            pointer-events: none;
        }
        .collab-dark-inner { position: relative; z-index: 2; }
        .collab-eyebrow {
            display: inline-block;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent-pink);
            border: 1px solid rgba(236,72,153,0.3);
            padding: 6px 18px;
            border-radius: 2px;
            margin-bottom: 24px;
        }
        .collab-title-dark {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(42px, 6vw, 72px);
            letter-spacing: 6px;
            color: var(--text-primary);
            margin-bottom: 16px;
            line-height: 1;
        }
        .collab-title-dark span {
            background: linear-gradient(90deg, var(--accent-pink), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .collab-desc-dark {
            font-size: 16px;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto 40px;
            line-height: 1.8;
        }
        .collab-btns {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        /* ============================================
           FOOTER
           ============================================ */
        .dark-footer {
            position: relative;
            z-index: 10;
            background: var(--bg-secondary);
            border-top: 1px solid var(--border-subtle);
            padding: 40px 24px;
            text-align: center;
        }
        .footer-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            letter-spacing: 6px;
            background: linear-gradient(90deg, var(--accent-pink), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }
        .footer-sub { font-size: 12px; color: var(--text-muted); letter-spacing: 2px; text-transform: uppercase; }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 900px) {
            .about-layout    { grid-template-columns: 1fr; }
            .stats-4col      { grid-template-columns: repeat(2, 1fr); }
            .contact-layout  { grid-template-columns: 1fr; }
            .dark-card       { padding: 24px; }
            .collab-dark     { padding: 48px 24px; }
        }
        @media (max-width: 600px) {
            .hero-name { font-size: 52px; }
            .stats-4col { grid-template-columns: repeat(2, 1fr); }
            .cat-grid   { grid-template-columns: 1fr 1fr; }
            .top-nav    { padding: 0 16px; }
            .top-nav-brand { font-size: 18px; }
        }
    </style>
</head>
<body>

    <!-- Ambient Background -->
    <div class="ambient-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    @include('frontend.profile-themes.partials.profile-top-actions')

    {{-- ── Preview Banner ── --}}
    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> Preview Mode —
        <a href="{{ url('/signin') }}">Sign up</a> to publish your production-house profile!
    </div>
    @endif

    {{-- ── Top Nav ── --}}
    <nav class="top-nav">
        <div class="top-nav-brand">{{ strtoupper($userdata->name ?? 'Creator') }}</div>
        <div class="top-nav-actions">
            @if($userdata->isFeatureVisible('email') && $userdata->email)
            <a href="mailto:{{ $userdata->email }}" class="nav-pill nav-pill-outline">
                <i class="fas fa-envelope"></i> Email
            </a>
            @endif
            @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social->whatsapp) && $social->whatsapp)
            <a href="https://wa.me/{{ $social->whatsapp }}" class="nav-pill nav-pill-solid">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            @endif
        </div>
    </nav>

    {{-- ══════════════════════════════════════════
         HERO
    ══════════════════════════════════════════ --}}
    <section class="hero">
        <div class="hero-grid"></div>
        <div class="hero-scanlines"></div>
        <div class="hero-stripe"></div>

        <div class="hero-content">
            {{-- Profile Photo --}}
            @if($userdata->isFeatureVisible('profile_photo'))
            <div class="hero-avatar-wrap">
                <div class="hero-avatar-ring"></div>
                <div class="hero-avatar-ring-inner"></div>
                <div class="hero-avatar">
                    @if($userdata->profile)
                        <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}" alt="{{ $userdata->name }}">
                    @else
                        <div class="hero-avatar-placeholder">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    @endif
                </div>
                <div class="hero-verified"><i class="fas fa-check"></i></div>
            </div>
            @endif

            {{-- Live Badge --}}
            <div class="hero-live-badge">
                <span class="live-dot"></span>
                Content Creator
            </div>

            {{-- Name --}}
            @if($userdata->isFeatureVisible('name'))
            <h1 class="hero-name">
                <span>{{ $userdata->name }}</span>
            </h1>
            @endif

            {{-- Tagline / Designation --}}
            @if($userdata->isFeatureVisible('designation') && $userdata->desig)
            <p class="hero-tagline">{{ $userdata->desig }}</p>
            @endif

            {{-- Chips --}}
            <div class="hero-chips">
                <div class="chip"><i class="fas fa-fire"></i> Lifestyle &amp; Fashion</div>
                @if($userdata->city)
                <div class="chip"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}</div>
                @endif
                <div class="chip"><i class="fas fa-users"></i> Community Builder</div>
            </div>

            {{-- CTA Buttons --}}
            <div class="hero-cta">
                @if($userdata->isFeatureVisible('email') && $userdata->email)
                <a href="mailto:{{ $userdata->email }}" class="btn-primary-dark">
                    <i class="fas fa-paper-plane"></i> Work With Me
                </a>
                @endif
                @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social->whatsapp) && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" class="btn-ghost-dark">
                    <i class="fab fa-whatsapp"></i> Chat Now
                </a>
                @endif
            </div>
        </div>

        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i>
            <span>Scroll</span>
        </div>
    </section>

    {{-- ══════════════════════════════════════════
         STATS TICKER
    ══════════════════════════════════════════ --}}
    <div class="stats-ticker">
        <div class="ticker-inner">
            {{-- Duplicated for seamless loop --}}
            <div class="ticker-item"><i class="fab fa-instagram t-icon"></i> <span class="t-num">100K+</span> INSTAGRAM</div>
            <div class="ticker-item"><i class="fab fa-youtube t-icon"></i> <span class="t-num">50K+</span> YOUTUBE</div>
            <div class="ticker-item"><i class="fas fa-heart t-icon"></i> <span class="t-num">5M+</span> TOTAL ENGAGEMENT</div>
            <div class="ticker-item"><i class="fas fa-video t-icon"></i> <span class="t-num">500+</span> CONTENT PIECES</div>
            <div class="ticker-item"><i class="fas fa-handshake t-icon"></i> <span class="t-num">50+</span> BRAND DEALS</div>
            <div class="ticker-item"><i class="fas fa-globe t-icon"></i> <span class="t-num">10+</span> COUNTRIES REACHED</div>
            {{-- Duplicate --}}
            <div class="ticker-item"><i class="fab fa-instagram t-icon"></i> <span class="t-num">100K+</span> INSTAGRAM</div>
            <div class="ticker-item"><i class="fab fa-youtube t-icon"></i> <span class="t-num">50K+</span> YOUTUBE</div>
            <div class="ticker-item"><i class="fas fa-heart t-icon"></i> <span class="t-num">5M+</span> TOTAL ENGAGEMENT</div>
            <div class="ticker-item"><i class="fas fa-video t-icon"></i> <span class="t-num">500+</span> CONTENT PIECES</div>
            <div class="ticker-item"><i class="fas fa-handshake t-icon"></i> <span class="t-num">50+</span> BRAND DEALS</div>
            <div class="ticker-item"><i class="fas fa-globe t-icon"></i> <span class="t-num">10+</span> COUNTRIES REACHED</div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════ --}}
    <div class="main-wrap">

        {{-- 01 · ABOUT --}}
        @if($userdata->isFeatureVisible('bio') && $userdata->about_us)
        <div class="section-label">
            <span class="section-number">01</span>
            <div class="section-line"></div>
            <span class="section-tag">About</span>
        </div>
        <h2 class="section-title">WHO <span>AM I</span></h2>

        <div class="dark-card">
            <div class="about-layout">
                <div class="about-text">{{ $userdata->about_us }}</div>
                <div class="about-sidebar">
                    @if($userdata->city)
                    <div class="about-info-item">
                        <div class="about-info-icon" style="background:rgba(236,72,153,0.1);color:var(--accent-pink);">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <div class="info-label">Location</div>
                            <div class="info-val">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                        </div>
                    </div>
                    @endif
                    @if($userdata->desig)
                    <div class="about-info-item">
                        <div class="about-info-icon" style="background:rgba(168,85,247,0.1);color:var(--accent-purple);">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div>
                            <div class="info-label">Role</div>
                            <div class="info-val">{{ $userdata->desig }}</div>
                        </div>
                    </div>
                    @endif
                    <div class="about-info-item">
                        <div class="about-info-icon" style="background:rgba(34,211,238,0.1);color:var(--accent-cyan);">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <div class="info-label">Status</div>
                            <div class="info-val">Open to Collabs</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- 02 · IMPACT & REACH --}}
        <div class="section-label" style="margin-top:60px;">
            <span class="section-number">02</span>
            <div class="section-line"></div>
            <span class="section-tag">Metrics</span>
        </div>
        <h2 class="section-title">IMPACT &amp; <span>REACH</span></h2>

        <div class="stats-4col">
            <div class="stat-block">
                <div class="stat-block-icon" style="color:#e1306c;"><i class="fab fa-instagram"></i></div>
                <div class="stat-block-num">100K+</div>
                <div class="stat-block-label">Instagram Followers</div>
            </div>
            <div class="stat-block">
                <div class="stat-block-icon" style="color:#ff0000;"><i class="fab fa-youtube"></i></div>
                <div class="stat-block-num">50K+</div>
                <div class="stat-block-label">YouTube Subscribers</div>
            </div>
            <div class="stat-block">
                <div class="stat-block-icon" style="color:var(--accent-pink);"><i class="fas fa-heart"></i></div>
                <div class="stat-block-num">5M+</div>
                <div class="stat-block-label">Total Engagement</div>
            </div>
            <div class="stat-block">
                <div class="stat-block-icon" style="color:var(--accent-cyan);"><i class="fas fa-video"></i></div>
                <div class="stat-block-num">500+</div>
                <div class="stat-block-label">Content Created</div>
            </div>
        </div>

        {{-- 03 · CONTENT CATEGORIES --}}
        <div class="section-label" style="margin-top:60px;">
            <span class="section-number">03</span>
            <div class="section-line"></div>
            <span class="section-tag">Content</span>
        </div>
        <h2 class="section-title">CONTENT <span>CATEGORIES</span></h2>

        <div class="cat-grid">
            <div class="cat-item">
                <span class="cat-emoji">👗</span>
                <div class="cat-name">Fashion</div>
                <div class="cat-count">150+ Posts</div>
                <div class="cat-bar"><div class="cat-bar-fill" style="width:85%;"></div></div>
            </div>
            <div class="cat-item">
                <span class="cat-emoji">🍜</span>
                <div class="cat-name">Food &amp; Lifestyle</div>
                <div class="cat-count">120+ Posts</div>
                <div class="cat-bar"><div class="cat-bar-fill" style="width:70%;"></div></div>
            </div>
            <div class="cat-item">
                <span class="cat-emoji">✈️</span>
                <div class="cat-name">Travel</div>
                <div class="cat-count">80+ Posts</div>
                <div class="cat-bar"><div class="cat-bar-fill" style="width:55%;"></div></div>
            </div>
            <div class="cat-item">
                <span class="cat-emoji">💪</span>
                <div class="cat-name">Fitness</div>
                <div class="cat-count">60+ Posts</div>
                <div class="cat-bar"><div class="cat-bar-fill" style="width:40%;"></div></div>
            </div>
        </div>

        {{-- 04 · BRAND COLLABORATIONS --}}
        <div class="section-label" style="margin-top:60px;">
            <span class="section-number">04</span>
            <div class="section-line"></div>
            <span class="section-tag">Partners</span>
        </div>
        <h2 class="section-title">BRAND <span>COLLABORATIONS</span></h2>

        <div class="brands-row">
            <div class="brand-tile"><i class="fas fa-crown"></i></div>
            <div class="brand-tile"><i class="fas fa-gem"></i></div>
            <div class="brand-tile"><i class="fas fa-star"></i></div>
            <div class="brand-tile"><i class="fas fa-award"></i></div>
            <div class="brand-tile"><i class="fas fa-medal"></i></div>
            <div class="brand-tile"><i class="fas fa-trophy"></i></div>
        </div>

        {{-- 05 · CONTACT --}}
        @if($userdata->isFeatureVisible('contact_number') || $userdata->isFeatureVisible('email'))
        <div class="section-label" style="margin-top:60px;">
            <span class="section-number">05</span>
            <div class="section-line"></div>
            <span class="section-tag">Contact</span>
        </div>
        <h2 class="section-title">GET IN <span>TOUCH</span></h2>

        <div class="contact-layout">
            @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
            <div class="contact-item">
                <div class="contact-ico"><i class="fas fa-phone"></i></div>
                <div>
                    <div class="c-label">Phone</div>
                    <div class="c-val">{{ $userdata->mobile }}</div>
                </div>
            </div>
            @endif

            @if($userdata->isFeatureVisible('email') && $userdata->email)
            <div class="contact-item">
                <div class="contact-ico"><i class="fas fa-envelope"></i></div>
                <div>
                    <div class="c-label">Business Email</div>
                    <div class="c-val">{{ $userdata->email }}</div>
                </div>
            </div>
            @endif

            @if($userdata->city)
            <div class="contact-item">
                <div class="contact-ico"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <div class="c-label">Location</div>
                    <div class="c-val">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                </div>
            </div>
            @endif

            @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social->whatsapp) && $social->whatsapp)
            <div class="contact-item">
                <div class="contact-ico" style="color:#25d366;border-color:rgba(37,211,102,0.3);background:rgba(37,211,102,0.05);">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div>
                    <div class="c-label">WhatsApp</div>
                    <div class="c-val">{{ $social->whatsapp }}</div>
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- SOCIAL LINKS --}}
        @if($userdata->isFeatureVisible('social_media'))
        <div class="social-dark-wrap">
            <h3 class="social-tagline">FOLLOW MY JOURNEY</h3>
            <p class="social-sub">Join my community across all platforms</p>
            <div class="social-dark-row">
                @if($userdata->isFeatureVisible('instagram') && isset($social->instagram) && $social->instagram)
                <a href="{{ $social->instagram }}" target="_blank" class="social-dark-btn sb-ig">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                @endif
                @if(isset($social->youtube) && $social->youtube)
                <a href="{{ $social->youtube }}" target="_blank" class="social-dark-btn sb-yt">
                    <i class="fab fa-youtube"></i> YouTube
                </a>
                @endif
                @if(isset($social->tiktok) && $social->tiktok)
                <a href="{{ $social->tiktok }}" target="_blank" class="social-dark-btn sb-tt">
                    <i class="fab fa-tiktok"></i> TikTok
                </a>
                @endif
                @if($userdata->isFeatureVisible('facebook') && isset($social->facebook) && $social->facebook)
                <a href="{{ $social->facebook }}" target="_blank" class="social-dark-btn sb-fb">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                @endif
                @if(isset($social->twitter) && $social->twitter)
                <a href="{{ $social->twitter }}" target="_blank" class="social-dark-btn sb-tw">
                    <i class="fab fa-twitter"></i> Twitter
                </a>
                @endif
                @if($userdata->isFeatureVisible('linkedin') && isset($social->linkedin) && $social->linkedin)
                <a href="{{ $social->linkedin }}" target="_blank" class="social-dark-btn sb-li">
                    <i class="fab fa-linkedin-in"></i> LinkedIn
                </a>
                @endif
            </div>
        </div>
        @endif

        {{-- COLLABORATION CTA --}}
        <div class="collab-dark">
            <div class="collab-dark-inner">
                <span class="collab-eyebrow"><i class="fas fa-bolt"></i> &nbsp;Ready to Create Together?</span>
                <h2 class="collab-title-dark">LET'S <span>COLLABORATE</span></h2>
                <p class="collab-desc-dark">
                    Ready to create amazing content together? Reach out for brand partnerships, sponsored content, and creative collaborations.
                </p>
                <div class="collab-btns">
                    @if($userdata->isFeatureVisible('email') && $userdata->email)
                    <a href="mailto:{{ $userdata->email }}" class="btn-primary-dark">
                        <i class="fas fa-envelope"></i> Send Business Inquiry
                    </a>
                    @endif
                    @if($userdata->isFeatureVisible('whatsapp_chat') && $social && $social->whatsapp)
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="btn-ghost-dark">
                        <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>

    </div>{{-- /.main-wrap --}}

    {{-- FOOTER --}}
    <footer class="dark-footer">
        <div class="footer-brand">{{ strtoupper($userdata->name ?? 'Creator') }}</div>
        <div class="footer-sub">Content Creator &nbsp;·&nbsp; Influencer &nbsp;·&nbsp; Brand Partner</div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])

</body>
</html>