<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Political Leader' }} - People's Representative</title>

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
        $themeColor = $theme->color ?? '#e63946';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Source+Sans+3:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ══════════════════════════════════════════════════════
           ROOT VARIABLES — CINEMATIC DARK THEME
        ══════════════════════════════════════════════════════ */
        :root {
            --cin-red:       #e63946;
            --cin-red-dark:  #b91c1c;
            --cin-red-glow:  rgba(230,57,70,0.25);
            --cin-bg:        #0a0a0a;
            --cin-bg-2:      #111111;
            --cin-bg-3:      #1a1a1a;
            --cin-bg-card:   #141414;
            --cin-border:    #2a2a2a;
            --cin-border-2:  #333333;
            --cin-white:     #ffffff;
            --cin-text:      #cccccc;
            --cin-text-dim:  #888888;
            --cin-gold:      #f5a623;
            --cin-gold-dim:  rgba(245,166,35,0.15);
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        /* ══════════════════════════════════════════════════════
           SCROLLBAR — cinematic red
        ══════════════════════════════════════════════════════ */
        ::-webkit-scrollbar { width:6px; }
        ::-webkit-scrollbar-track { background:#0a0a0a; }
        ::-webkit-scrollbar-thumb { background:var(--cin-red); border-radius:3px; }

        /* ══════════════════════════════════════════════════════
           BODY
        ══════════════════════════════════════════════════════ */
        body {
            font-family: 'Source Sans 3', sans-serif;
            background-color: var(--cin-bg);
            color: var(--cin-text);
            overflow-x: hidden;
        }

        /* ══════════════════════════════════════════════════════
           PREVIEW BANNER
        ══════════════════════════════════════════════════════ */
        .preview-banner {
            background: var(--cin-red);
            color: white;
            padding: 11px 20px;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .preview-banner a { color: var(--cin-gold); text-decoration: underline; font-weight: 700; margin-left: 6px; }

        /* ══════════════════════════════════════════════════════
           TOP NAV BAR (mimics cinematic studios nav)
        ══════════════════════════════════════════════════════ */
        .cin-navbar {
            background: #0d0d0d;
            border-bottom: 1px solid var(--cin-border);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
            height: 56px;
        }
        .cin-nav-logo {
            font-family: 'Oswald', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: white;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .cin-nav-logo span { color: var(--cin-red); }
        .cin-nav-links {
            display: flex;
            gap: 2px;
            list-style: none;
        }
        .cin-nav-links a {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #aaa;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 4px;
            transition: all 0.25s;
        }
        .cin-nav-links a:hover,
        .cin-nav-links a.active { color: white; background: var(--cin-red); }

        /* ══════════════════════════════════════════════════════
           HERO BANNER — FULL CINEMATIC
        ══════════════════════════════════════════════════════ */
        .cin-banner {
            position: relative;
            min-height: 520px;
            overflow: hidden;
            background-color: #050505;
            background-image:
                linear-gradient(
                    105deg,
                    rgba(10,10,10,0.96) 0%,
                    rgba(10,10,10,0.82) 45%,
                    rgba(230,57,70,0.18) 100%
                ),
                url('https://images.unsplash.com/photo-1524492412937-b28074a47d70?w=1920&q=80');
            background-size: cover;
            background-position: center 35%;
            display: flex;
            align-items: center;
        }

        /* Scanline texture overlay */
        .cin-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,0,0,0.08) 2px,
                rgba(0,0,0,0.08) 4px
            );
            pointer-events: none;
            z-index: 1;
        }

        /* Red side glow */
        .cin-banner::after {
            content: '';
            position: absolute;
            right: 0; top: 0; bottom: 0;
            width: 40%;
            background: radial-gradient(ellipse at right center, rgba(230,57,70,0.15) 0%, transparent 70%);
            pointer-events: none;
            z-index: 1;
        }

        .cin-banner-inner {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 60px 40px 70px;
            display: flex;
            align-items: center;
            gap: 48px;
        }

        /* ── Profile Photo – Cinematic Frame ── */
        .cin-photo-wrap {
            position: relative;
            flex-shrink: 0;
        }
        .cin-photo-frame {
            width: 200px;
            height: 240px;
            position: relative;
            clip-path: polygon(0 0, 100% 0, 100% 88%, 88% 100%, 0 100%);
            overflow: hidden;
        }
        .cin-photo-frame img,
        .cin-photo-frame .cin-photo-placeholder {
            width: 100%; height: 100%;
            object-fit: cover;
            display: flex; align-items: center; justify-content: center;
            font-size: 80px; color: rgba(255,255,255,0.2);
            background: linear-gradient(135deg, #1a1a1a, #2d0000);
        }
        /* Decorative corner lines */
        .cin-photo-corner {
            position: absolute;
            width: 28px; height: 28px;
        }
        .cin-photo-corner.tl { top: -2px; left: -2px; border-top: 3px solid var(--cin-red); border-left: 3px solid var(--cin-red); }
        .cin-photo-corner.tr { top: -2px; right: -2px; border-top: 3px solid var(--cin-red); border-right: 3px solid var(--cin-red); }
        .cin-photo-corner.bl { bottom: -2px; left: -2px; border-bottom: 3px solid var(--cin-red); border-left: 3px solid var(--cin-red); }
        /* Red line under photo */
        .cin-photo-line {
            position: absolute;
            bottom: -12px; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--cin-red), transparent);
        }
        /* Record dot */
        .cin-rec-dot {
            position: absolute;
            top: 12px; left: 12px;
            display: flex; align-items: center; gap: 6px;
            background: rgba(0,0,0,0.7);
            border: 1px solid var(--cin-red);
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--cin-red);
            text-transform: uppercase;
            z-index: 3;
        }
        .cin-rec-dot::before {
            content: '';
            width: 7px; height: 7px;
            background: var(--cin-red);
            border-radius: 50%;
            animation: rec-blink 1.4s ease-in-out infinite;
        }
        @keyframes rec-blink { 0%,100%{opacity:1} 50%{opacity:0.2} }

        /* ── Banner Text ── */
        .cin-banner-text { flex: 1; }
        .cin-label-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--cin-red);
            color: white;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 3px;
            margin-bottom: 20px;
        }
        .cin-label-badge i { font-size: 10px; }

        .cin-hero-name {
            font-family: 'Oswald', sans-serif;
            font-size: 64px;
            font-weight: 700;
            color: white;
            line-height: 1.0;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 14px;
        }
        .cin-hero-name span { color: var(--cin-red); }

        .cin-hero-desig {
            font-size: 14px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--cin-text-dim);
            font-weight: 600;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cin-hero-desig::before {
            content: '';
            width: 40px;
            height: 2px;
            background: var(--cin-red);
            flex-shrink: 0;
        }

        .cin-hero-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 32px;
        }
        .cin-hero-tag {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border: 1px solid var(--cin-border-2);
            border-radius: 4px;
            font-size: 13px;
            color: var(--cin-text);
            background: rgba(255,255,255,0.03);
            font-weight: 500;
            transition: all 0.25s;
        }
        .cin-hero-tag i { color: var(--cin-red); font-size: 12px; }
        .cin-hero-tag:hover { border-color: var(--cin-red); background: rgba(230,57,70,0.08); }

        .cin-hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }
        .cin-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 30px;
            background: var(--cin-red);
            color: white;
            border: none;
            border-radius: 4px;
            font-family: 'Oswald', sans-serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 24px rgba(230,57,70,0.35);
        }
        .cin-btn-primary:hover { background: var(--cin-red-dark); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(230,57,70,0.5); color: white; }
        .cin-btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 28px;
            background: transparent;
            color: white;
            border: 1px solid var(--cin-border-2);
            border-radius: 4px;
            font-family: 'Oswald', sans-serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.25s;
        }
        .cin-btn-outline:hover { border-color: white; color: white; background: rgba(255,255,255,0.05); }

        /* Bottom border strip */
        .cin-banner-strip {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--cin-red) 0%, transparent 60%);
        }

        /* ══════════════════════════════════════════════════════
           STATS BAR
        ══════════════════════════════════════════════════════ */
        .cin-stats-bar {
            background: var(--cin-bg-2);
            border-bottom: 1px solid var(--cin-border);
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .cin-stat-item {
            flex: 1;
            min-width: 140px;
            max-width: 200px;
            padding: 24px 20px;
            text-align: center;
            border-right: 1px solid var(--cin-border);
            position: relative;
            transition: background 0.25s;
        }
        .cin-stat-item:last-child { border-right: none; }
        .cin-stat-item:hover { background: rgba(230,57,70,0.05); }
        .cin-stat-item::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 40px; height: 2px;
            background: var(--cin-red);
            opacity: 0;
            transition: opacity 0.25s;
        }
        .cin-stat-item:hover::before { opacity: 1; }
        .cin-stat-num {
            font-family: 'Oswald', sans-serif;
            font-size: 34px;
            font-weight: 700;
            color: white;
            line-height: 1;
            margin-bottom: 5px;
        }
        .cin-stat-num span { color: var(--cin-red); }
        .cin-stat-label {
            font-size: 11px;
            color: var(--cin-text-dim);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        /* ══════════════════════════════════════════════════════
           SECTION WRAPPER
        ══════════════════════════════════════════════════════ */
        .cin-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 32px 80px;
        }

        /* ── Section Label (numbered — mimics "01 / OUR SERVICES") ── */
        .cin-section-label {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
            margin-top: 56px;
        }
        .cin-section-num {
            font-family: 'Oswald', sans-serif;
            font-size: 13px;
            color: var(--cin-red);
            letter-spacing: 2px;
            font-weight: 600;
            line-height: 1;
            border-left: 3px solid var(--cin-red);
            padding-left: 10px;
        }
        .cin-section-title {
            font-family: 'Oswald', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .cin-section-line {
            flex: 1;
            height: 1px;
            background: var(--cin-border);
        }

        /* ══════════════════════════════════════════════════════
           BASE DARK CARD
        ══════════════════════════════════════════════════════ */
        .cin-card {
            background: var(--cin-bg-card);
            border: 1px solid var(--cin-border);
            border-top: 3px solid var(--cin-red);
            border-radius: 6px;
            padding: 36px 40px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .cin-card:hover {
            border-color: var(--cin-red);
            box-shadow: 0 0 30px rgba(230,57,70,0.1);
        }
        /* Subtle noise texture */
        .cin-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            opacity: 0.4;
        }

        .cin-card-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--cin-border);
        }
        .cin-card-icon {
            width: 48px; height: 48px;
            background: rgba(230,57,70,0.12);
            border: 1px solid rgba(230,57,70,0.3);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            color: var(--cin-red);
            font-size: 20px;
            flex-shrink: 0;
        }
        .cin-card-title {
            font-family: 'Oswald', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .cin-card-sub {
            font-size: 12px;
            color: var(--cin-text-dim);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 3px;
        }
        .cin-card-body {
            color: var(--cin-text);
            font-size: 16px;
            line-height: 1.8;
        }

        /* ══════════════════════════════════════════════════════
           BIOGRAPHY CARD — India Gate BG
        ══════════════════════════════════════════════════════ */
        .cin-card.card-bio {
            background-image:
                linear-gradient(135deg, rgba(20,20,20,0.97) 0%, rgba(20,20,20,0.92) 100%),
                url('https://images.unsplash.com/photo-1524492412937-b28074a47d70?w=1200&q=50');
            background-size: cover;
            background-position: center;
        }

        /* ══════════════════════════════════════════════════════
           PARTY AFFILIATION CARD — Flag BG
        ══════════════════════════════════════════════════════ */
        .cin-card.card-party {
            background-image:
                linear-gradient(105deg, rgba(15,15,15,0.96) 60%, rgba(30,20,20,0.90) 100%),
                url('https://images.unsplash.com/photo-1532375810709-75b1da00537c?w=1200&q=50');
            background-size: cover;
            background-position: center;
        }
        .cin-party-block {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 28px 32px;
            background: rgba(230,57,70,0.06);
            border: 1px solid rgba(230,57,70,0.25);
            border-left: 4px solid var(--cin-red);
            border-radius: 4px;
        }
        .cin-party-icon {
            width: 72px; height: 72px;
            background: var(--cin-red);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 36px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 0 20px rgba(230,57,70,0.4);
        }
        .cin-party-name {
            font-family: 'Oswald', sans-serif;
            font-size: 30px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .cin-party-role { font-size: 14px; color: var(--cin-text-dim); letter-spacing: 1px; margin-top: 6px; text-transform: uppercase; }

        /* ══════════════════════════════════════════════════════
           ACHIEVEMENTS — Grid of 4 dark mini-cards
        ══════════════════════════════════════════════════════ */
        .cin-achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 18px;
        }
        .cin-ach-card {
            background: var(--cin-bg-3);
            border: 1px solid var(--cin-border);
            border-top: 3px solid var(--cin-red);
            border-radius: 4px;
            padding: 28px 24px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .cin-ach-card::before {
            content: '';
            position: absolute;
            bottom: 0; right: 0;
            width: 60px; height: 60px;
            background: radial-gradient(circle at bottom right, rgba(230,57,70,0.12), transparent 70%);
        }
        .cin-ach-card:hover { border-top-color: var(--cin-gold); background: #1e1e1e; box-shadow: 0 4px 20px rgba(0,0,0,0.4); }
        .cin-ach-icon {
            width: 48px; height: 48px;
            background: rgba(230,57,70,0.1);
            border: 1px solid rgba(230,57,70,0.2);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            color: var(--cin-red);
            font-size: 22px;
            margin-bottom: 18px;
            transition: all 0.3s;
        }
        .cin-ach-card:hover .cin-ach-icon { background: var(--cin-red); color: white; box-shadow: 0 0 16px rgba(230,57,70,0.4); }
        .cin-ach-title {
            font-family: 'Oswald', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .cin-ach-desc { font-size: 13px; color: var(--cin-text-dim); line-height: 1.65; }

        /* ══════════════════════════════════════════════════════
           PROJECTS — Dark list card
        ══════════════════════════════════════════════════════ */
        .cin-card.card-projects {
            background-image:
                linear-gradient(135deg, rgba(14,14,14,0.97) 0%, rgba(10,18,14,0.95) 100%),
                url('https://images.unsplash.com/photo-1587474260584-136574528ed5?w=1200&q=50');
            background-size: cover;
        }
        .cin-projects-list { display: grid; gap: 14px; }
        .cin-project-row {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px 24px;
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--cin-border);
            border-left: 4px solid transparent;
            border-radius: 4px;
            transition: all 0.3s;
        }
        .cin-project-row:hover { border-left-color: var(--cin-red); background: rgba(230,57,70,0.04); }
        .cin-proj-num {
            font-family: 'Oswald', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--cin-red);
            width: 40px;
            flex-shrink: 0;
            opacity: 0.7;
        }
        .cin-proj-divider { width: 1px; height: 36px; background: var(--cin-border); flex-shrink: 0; }
        .cin-proj-title { font-size: 16px; font-weight: 700; color: white; margin-bottom: 4px; }
        .cin-proj-desc { font-size: 13px; color: var(--cin-text-dim); }
        .cin-proj-arrow { margin-left: auto; color: var(--cin-border-2); font-size: 14px; transition: all 0.3s; }
        .cin-project-row:hover .cin-proj-arrow { color: var(--cin-red); transform: translateX(4px); }

        /* ══════════════════════════════════════════════════════
           EVENTS TIMELINE — Dark
        ══════════════════════════════════════════════════════ */
        .cin-card.card-events {
            background-image:
                linear-gradient(135deg, rgba(14,14,14,0.97) 0%, rgba(14,10,10,0.95) 100%),
                url('https://images.unsplash.com/photo-1541872703-74c5e44368f9?w=1200&q=50');
            background-size: cover;
        }
        .cin-timeline { position: relative; padding-left: 48px; }
        .cin-timeline::before {
            content: '';
            position: absolute;
            left: 18px; top: 8px; bottom: 8px;
            width: 2px;
            background: linear-gradient(180deg, var(--cin-red), rgba(230,57,70,0.1));
        }
        .cin-t-item { position: relative; margin-bottom: 36px; }
        .cin-t-item:last-child { margin-bottom: 0; }
        .cin-t-dot {
            position: absolute;
            left: -38px; top: 5px;
            width: 14px; height: 14px;
            background: var(--cin-red);
            border: 2px solid #0a0a0a;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(230,57,70,0.5);
        }
        .cin-t-badge {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(230,57,70,0.12);
            border: 1px solid rgba(230,57,70,0.3);
            color: var(--cin-red);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 3px;
            margin-bottom: 10px;
        }
        .cin-t-title { font-size: 17px; font-weight: 700; color: white; margin-bottom: 8px; }
        .cin-t-desc { font-size: 14px; color: var(--cin-text-dim); line-height: 1.65; }

        /* ══════════════════════════════════════════════════════
           CONTACT GRID
        ══════════════════════════════════════════════════════ */
        .cin-contact-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; }
        .cin-contact-item {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 20px 24px;
            background: var(--cin-bg-3);
            border: 1px solid var(--cin-border);
            border-radius: 4px;
            transition: all 0.3s;
        }
        .cin-contact-item:hover { border-color: var(--cin-red); background: rgba(230,57,70,0.04); }
        .cin-contact-icon {
            width: 48px; height: 48px;
            background: var(--cin-red);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 20px;
            flex-shrink: 0;
        }
        .cin-contact-lbl { font-size: 11px; color: var(--cin-text-dim); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; font-weight: 600; }
        .cin-contact-val { font-size: 15px; color: white; font-weight: 600; }

        /* ══════════════════════════════════════════════════════
           GRIEVANCE CTA — Full BG Image
        ══════════════════════════════════════════════════════ */
        .cin-grievance {
            position: relative;
            border-radius: 6px;
            overflow: hidden;
            min-height: 360px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 48px;
            background-image:
                linear-gradient(135deg,
                    rgba(10,10,10,0.88) 0%,
                    rgba(100,10,10,0.75) 50%,
                    rgba(10,10,10,0.88) 100%
                ),
                url('https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg?auto=compress&cs=tinysrgb&w=1920');
            background-size: cover;
            background-position: center;
        }
        /* Red scanline effect */
        .cin-grievance::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 3px,
                rgba(230,57,70,0.02) 3px,
                rgba(230,57,70,0.02) 6px
            );
            pointer-events: none;
        }
        /* Red bottom bar */
        .cin-grievance::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: var(--cin-red);
        }
        .cin-grievance-inner {
            position: relative;
            z-index: 1;
            padding: 60px 40px;
        }
        .cin-g-icon { font-size: 52px; color: var(--cin-red); margin-bottom: 20px; }
        .cin-g-title {
            font-family: 'Oswald', sans-serif;
            font-size: 44px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 14px;
            text-shadow: 0 0 40px rgba(230,57,70,0.5);
        }
        .cin-g-sub {
            font-size: 17px;
            color: rgba(255,255,255,0.75);
            margin-bottom: 36px;
            line-height: 1.7;
        }

        /* ══════════════════════════════════════════════════════
           SOCIAL SECTION
        ══════════════════════════════════════════════════════ */
        .cin-social-section {
            margin-top: 40px;
            padding: 44px 40px;
            background: var(--cin-bg-2);
            border: 1px solid var(--cin-border);
            border-top: 3px solid var(--cin-red);
            border-radius: 6px;
            text-align: center;
        }
        .cin-social-title {
            font-family: 'Oswald', sans-serif;
            font-size: 26px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 6px;
        }
        .cin-social-sub { font-size: 13px; color: var(--cin-text-dim); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 28px; }
        .cin-social-links { display: flex; justify-content: center; gap: 14px; flex-wrap: wrap; }
        .cin-social-btn {
            width: 52px; height: 52px;
            background: var(--cin-bg-3);
            border: 1px solid var(--cin-border);
            border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            color: var(--cin-text-dim);
            font-size: 22px;
            text-decoration: none;
            transition: all 0.25s;
        }
        .cin-social-btn:hover { background: var(--cin-red); color: white; border-color: var(--cin-red); box-shadow: 0 0 16px rgba(230,57,70,0.4); transform: translateY(-3px); }

        /* ══════════════════════════════════════════════════════
           FOOTER BAR
        ══════════════════════════════════════════════════════ */
        .cin-footer {
            background: #050505;
            border-top: 1px solid var(--cin-border);
            padding: 28px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .cin-footer-logo {
            font-family: 'Oswald', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: white;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .cin-footer-logo span { color: var(--cin-red); }
        .cin-footer-copy { font-size: 12px; color: var(--cin-text-dim); letter-spacing: 1px; }

        /* ══════════════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════════════ */
        @media (max-width: 768px) {
            .cin-navbar { padding: 0 16px; }
            .cin-nav-links { display: none; }
            .cin-banner-inner { flex-direction: column; align-items: center; text-align: center; padding: 40px 20px 60px; gap: 32px; }
            .cin-hero-name { font-size: 42px; }
            .cin-hero-desig { justify-content: center; }
            .cin-hero-tags { justify-content: center; }
            .cin-hero-btns { justify-content: center; }
            .cin-stat-item { min-width: 110px; border-right: none; border-bottom: 1px solid var(--cin-border); }
            .cin-content { padding: 30px 16px 60px; }
            .cin-card { padding: 24px 20px; }
            .cin-achievements-grid { grid-template-columns: 1fr 1fr; }
            .cin-contact-grid { grid-template-columns: 1fr; }
            .cin-party-block { flex-direction: column; text-align: center; }
            .cin-g-title { font-size: 30px; }
            .cin-footer { flex-direction: column; text-align: center; }
        }
        @media (max-width: 480px) {
            .cin-achievements-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> Preview Mode — <a href="{{ url('/signin') }}">Sign up</a> to publish your own political profile!
    </div>
    @endif

    <!-- ══════════════════════════════════════════════════════
         TOP NAV BAR
    ══════════════════════════════════════════════════════ -->
    <nav class="cin-navbar">
        <div class="cin-nav-logo">
            <span>{{ strtoupper(explode(' ', $userdata->name ?? 'Leader')[0]) }}</span>
            {{ isset(explode(' ', $userdata->name ?? 'Leader')[1]) ? strtoupper(explode(' ', $userdata->name ?? 'Leader')[1]) : '' }}
        </div>
        <ul class="cin-nav-links">
            <li><a href="#bio" class="active">Profile</a></li>
            <li><a href="#achievements">Achievements</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#events">Events</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <!-- ══════════════════════════════════════════════════════
         HERO BANNER
    ══════════════════════════════════════════════════════ -->
    <section class="cin-banner">
        <div class="cin-banner-inner">
            @if($userdata->isFeatureVisible('profile_photo'))
            <div class="cin-photo-wrap">
                <div class="cin-rec-dot">Live</div>
                <div class="cin-photo-frame">
                    @if($userdata->profile)
                        <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}" alt="{{ $userdata->name }}">
                    @else
                        <div class="cin-photo-placeholder" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#1a1a1a,#2d0000);color:rgba(255,255,255,0.15);font-size:80px;">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    @endif
                </div>
                <div class="cin-photo-corner tl"></div>
                <div class="cin-photo-corner tr"></div>
                <div class="cin-photo-corner bl"></div>
                <div class="cin-photo-line"></div>
            </div>
            @endif

            <div class="cin-banner-text">
                <div class="cin-label-badge">
                    <i class="fas fa-certificate"></i> People's Representative
                </div>

                @if($userdata->isFeatureVisible('name'))
                <h1 class="cin-hero-name">
                    @php
                        $nameParts = explode(' ', $userdata->name ?? 'Political Leader');
                        $first = array_shift($nameParts);
                    @endphp
                    <span>{{ $first }}</span>{{ count($nameParts) ? ' '.implode(' ', $nameParts) : '' }}
                </h1>
                @endif

                @if($userdata->isFeatureVisible('designation') && $userdata->desig)
                <div class="cin-hero-desig">{{ $userdata->desig }}</div>
                @endif

                <div class="cin-hero-tags">
                    @if($userdata->city)
                    <div class="cin-hero-tag"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }} Constituency</div>
                    @endif
                    @if($userdata->state)
                    <div class="cin-hero-tag"><i class="fas fa-flag"></i> {{ $userdata->state }}</div>
                    @endif
                    <div class="cin-hero-tag"><i class="fas fa-users"></i> Serving the People</div>
                </div>

                <div class="cin-hero-btns">
                    @if($isPreview ?? false)
                    <a href="javascript:void(0)" class="cin-btn-primary"><i class="fas fa-paper-plane"></i> Submit Grievance</a>
                    @else
                    <a href="{{ url($userdata->slug . '/grievance') }}" class="cin-btn-primary"><i class="fas fa-paper-plane"></i> Submit Grievance</a>
                    @endif
                    @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="cin-btn-outline"><i class="fas fa-phone"></i> Call Office</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="cin-banner-strip"></div>
    </section>

    <!-- ══════════════════════════════════════════════════════
         STATS BAR
    ══════════════════════════════════════════════════════ -->
    <div class="cin-stats-bar">
        <div class="cin-stat-item">
            <div class="cin-stat-num">15<span>+</span></div>
            <div class="cin-stat-label">Years of Service</div>
        </div>
        <div class="cin-stat-item">
            <div class="cin-stat-num">5K<span>+</span></div>
            <div class="cin-stat-label">Farmers Helped</div>
        </div>
        <div class="cin-stat-item">
            <div class="cin-stat-num">50<span>+</span></div>
            <div class="cin-stat-label">Projects Done</div>
        </div>
        <div class="cin-stat-item">
            <div class="cin-stat-num">1M<span>+</span></div>
            <div class="cin-stat-label">Lives Impacted</div>
        </div>
        <div class="cin-stat-item">
            <div class="cin-stat-num">100<span>%</span></div>
            <div class="cin-stat-label">Commitment</div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════════════════ -->
    <div class="cin-content">

        <!-- BIOGRAPHY -->
        @if($userdata->isFeatureVisible('bio') && $userdata->about_us)
        <div id="bio" style="scroll-margin-top:70px">
            <div class="cin-section-label">
                <div class="cin-section-num">01 / PROFILE</div>
                <div class="cin-section-title">Biography</div>
                <div class="cin-section-line"></div>
            </div>
            <div class="cin-card card-bio">
                <div class="cin-card-header">
                    <div class="cin-card-icon"><i class="fas fa-user-circle"></i></div>
                    <div>
                        <div class="cin-card-title">Profile &amp; Biography</div>
                        <div class="cin-card-sub">About the Representative</div>
                    </div>
                </div>
                <div class="cin-card-body">{{ $userdata->about_us }}</div>
            </div>
        </div>
        @endif

        <!-- PARTY AFFILIATION -->
        <div class="cin-section-label">
            <div class="cin-section-num">02 / PARTY</div>
            <div class="cin-section-title">Affiliation</div>
            <div class="cin-section-line"></div>
        </div>
        <div class="cin-card card-party">
            <div class="cin-card-header">
                <div class="cin-card-icon"><i class="fas fa-flag"></i></div>
                <div>
                    <div class="cin-card-title">Party Affiliation</div>
                    <div class="cin-card-sub">Political Association</div>
                </div>
            </div>
            <div class="cin-card-body">
                <div class="cin-party-block">
                    <div class="cin-party-icon"><i class="fas fa-flag-checkered"></i></div>
                    <div>
                        <div class="cin-party-name">{{ $userdata->desig ?? 'Political Party' }}</div>
                        @if($userdata->city || $userdata->state)
                        <div class="cin-party-role">Representative — {{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- ACHIEVEMENTS -->
        <div id="achievements" style="scroll-margin-top:70px">
            <div class="cin-section-label">
                <div class="cin-section-num">03 / WORK</div>
                <div class="cin-section-title">Key Achievements</div>
                <div class="cin-section-line"></div>
            </div>
            <div class="cin-card">
                <div class="cin-card-header">
                    <div class="cin-card-icon"><i class="fas fa-trophy"></i></div>
                    <div>
                        <div class="cin-card-title">Key Achievements</div>
                        <div class="cin-card-sub">Milestones &amp; Impact</div>
                    </div>
                </div>
                <div class="cin-achievements-grid">
                    <div class="cin-ach-card">
                        <div class="cin-ach-icon"><i class="fas fa-graduation-cap"></i></div>
                        <div class="cin-ach-title">Education Initiatives</div>
                        <div class="cin-ach-desc">Established 15+ schools and educational programs for underprivileged communities</div>
                    </div>
                    <div class="cin-ach-card">
                        <div class="cin-ach-icon"><i class="fas fa-hospital"></i></div>
                        <div class="cin-ach-title">Healthcare Access</div>
                        <div class="cin-ach-desc">Improved healthcare with new medical centers and free health camps across the region</div>
                    </div>
                    <div class="cin-ach-card">
                        <div class="cin-ach-icon"><i class="fas fa-road"></i></div>
                        <div class="cin-ach-title">Infrastructure</div>
                        <div class="cin-ach-desc">Modernized roads, bridges, and public transportation systems across the region</div>
                    </div>
                    <div class="cin-ach-card">
                        <div class="cin-ach-icon"><i class="fas fa-briefcase"></i></div>
                        <div class="cin-ach-title">Employment</div>
                        <div class="cin-ach-desc">Created job opportunities through skill development and entrepreneurship programs</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DEVELOPMENT PROJECTS -->
        <div id="projects" style="scroll-margin-top:70px">
            <div class="cin-section-label">
                <div class="cin-section-num">04 / WORK</div>
                <div class="cin-section-title">Development Projects</div>
                <div class="cin-section-line"></div>
            </div>
            <div class="cin-card card-projects">
                <div class="cin-card-header">
                    <div class="cin-card-icon"><i class="fas fa-hammer"></i></div>
                    <div>
                        <div class="cin-card-title">Development Projects</div>
                        <div class="cin-card-sub">Ongoing &amp; Completed</div>
                    </div>
                </div>
                <div class="cin-card-body">
                    <div class="cin-projects-list">
                        <div class="cin-project-row">
                            <div class="cin-proj-num">01</div>
                            <div class="cin-proj-divider"></div>
                            <div>
                                <div class="cin-proj-title">Clean Water Initiative</div>
                                <div class="cin-proj-desc">Providing clean drinking water to all villages through modern water treatment facilities</div>
                            </div>
                            <i class="fas fa-arrow-right cin-proj-arrow"></i>
                        </div>
                        <div class="cin-project-row">
                            <div class="cin-proj-num">02</div>
                            <div class="cin-proj-divider"></div>
                            <div>
                                <div class="cin-proj-title">Rural Electrification</div>
                                <div class="cin-proj-desc">24/7 electricity supply to rural areas with renewable energy integration</div>
                            </div>
                            <i class="fas fa-arrow-right cin-proj-arrow"></i>
                        </div>
                        <div class="cin-project-row">
                            <div class="cin-proj-num">03</div>
                            <div class="cin-proj-divider"></div>
                            <div>
                                <div class="cin-proj-title">Women Empowerment</div>
                                <div class="cin-proj-desc">Skill training and entrepreneurship programs for women's economic independence</div>
                            </div>
                            <i class="fas fa-arrow-right cin-proj-arrow"></i>
                        </div>
                        <div class="cin-project-row">
                            <div class="cin-proj-num">04</div>
                            <div class="cin-proj-divider"></div>
                            <div>
                                <div class="cin-proj-title">Digital Literacy</div>
                                <div class="cin-proj-desc">Computer education centers in every village for digital empowerment</div>
                            </div>
                            <i class="fas fa-arrow-right cin-proj-arrow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- EVENTS TIMELINE -->
        <div id="events" style="scroll-margin-top:70px">
            <div class="cin-section-label">
                <div class="cin-section-num">05 / EVENTS</div>
                <div class="cin-section-title">Recent Activities</div>
                <div class="cin-section-line"></div>
            </div>
            <div class="cin-card card-events">
                <div class="cin-card-header">
                    <div class="cin-card-icon"><i class="fas fa-calendar-alt"></i></div>
                    <div>
                        <div class="cin-card-title">Recent Events &amp; Activities</div>
                        <div class="cin-card-sub">Latest on the Ground</div>
                    </div>
                </div>
                <div class="cin-card-body">
                    <div class="cin-timeline">
                        <div class="cin-t-item">
                            <div class="cin-t-dot"></div>
                            <div class="cin-t-badge">This Week</div>
                            <div class="cin-t-title">Public Meeting on Healthcare</div>
                            <div class="cin-t-desc">Interactive session with constituents to discuss healthcare improvements and new hospital facilities</div>
                        </div>
                        <div class="cin-t-item">
                            <div class="cin-t-dot"></div>
                            <div class="cin-t-badge">Last Month</div>
                            <div class="cin-t-title">Infrastructure Inauguration</div>
                            <div class="cin-t-desc">Inaugurated new bypass road connecting three major towns, reducing travel time by 40%</div>
                        </div>
                        <div class="cin-t-item">
                            <div class="cin-t-dot"></div>
                            <div class="cin-t-badge">2 Months Ago</div>
                            <div class="cin-t-title">Youth Employment Fair</div>
                            <div class="cin-t-desc">Organized job fair with 50+ companies, creating employment for local youth</div>
                        </div>
                        <div class="cin-t-item">
                            <div class="cin-t-dot"></div>
                            <div class="cin-t-badge">3 Months Ago</div>
                            <div class="cin-t-title">Farmers' Support Program</div>
                            <div class="cin-t-desc">Launched agricultural subsidy program benefiting 5000+ farmers in the constituency</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTACT -->
        @if($userdata->isFeatureVisible('contact_number') || $userdata->isFeatureVisible('email') || $userdata->isFeatureVisible('address'))
        <div id="contact" style="scroll-margin-top:70px">
            <div class="cin-section-label">
                <div class="cin-section-num">06 / REACH</div>
                <div class="cin-section-title">Get In Touch</div>
                <div class="cin-section-line"></div>
            </div>
            <div class="cin-card">
                <div class="cin-card-header">
                    <div class="cin-card-icon"><i class="fas fa-address-book"></i></div>
                    <div>
                        <div class="cin-card-title">Contact Information</div>
                        <div class="cin-card-sub">Reach Us Directly</div>
                    </div>
                </div>
                <div class="cin-contact-grid">
                    @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                    <div class="cin-contact-item">
                        <div class="cin-contact-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <div class="cin-contact-lbl">Phone Number</div>
                            <div class="cin-contact-val">{{ $userdata->mobile }}</div>
                        </div>
                    </div>
                    @endif
                    @if($userdata->isFeatureVisible('email') && $userdata->email)
                    <div class="cin-contact-item">
                        <div class="cin-contact-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div class="cin-contact-lbl">Email Address</div>
                            <div class="cin-contact-val">{{ $userdata->email }}</div>
                        </div>
                    </div>
                    @endif
                    @if($userdata->isFeatureVisible('address') && ($userdata->address || $userdata->city))
                    <div class="cin-contact-item">
                        <div class="cin-contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="cin-contact-lbl">Office Location</div>
                            <div class="cin-contact-val">{{ $userdata->address ?? ($userdata->city.($userdata->state ? ', '.$userdata->state : '')) }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- GRIEVANCE CTA -->
        <div class="cin-grievance">
            <div class="cin-grievance-inner">
                <div class="cin-g-icon"><i class="fas fa-comment-dots"></i></div>
                <h2 class="cin-g-title">Voice Your Concerns</h2>
                <p class="cin-g-sub">Your feedback helps us serve you better.<br>Share your grievances and suggestions directly.</p>
                @if($isPreview ?? false)
                <a href="javascript:void(0)" class="cin-btn-primary" style="font-size:17px;padding:16px 40px;">
                    <i class="fas fa-paper-plane"></i> Submit Grievance
                </a>
                @else
                <a href="{{ url($userdata->slug . '/grievance') }}" class="cin-btn-primary" style="font-size:17px;padding:16px 40px;">
                    <i class="fas fa-paper-plane"></i> Submit Grievance
                </a>
                @endif
            </div>
        </div>

        <!-- SOCIAL MEDIA -->
        @if($userdata->isFeatureVisible('social_media'))
        <div class="cin-social-section">
            <div class="cin-social-title">Follow Our Journey</div>
            <div class="cin-social-sub">Stay connected on social media</div>
            <div class="cin-social-links">
                @if($userdata->isFeatureVisible('facebook') && isset($social->facebook) && $social->facebook)
                <a href="{{ $social->facebook }}" target="_blank" class="cin-social-btn"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if($userdata->isFeatureVisible('instagram') && isset($social->instagram) && $social->instagram)
                <a href="{{ $social->instagram }}" target="_blank" class="cin-social-btn"><i class="fab fa-instagram"></i></a>
                @endif
                @if($userdata->isFeatureVisible('linkedin') && isset($social->linkedin) && $social->linkedin)
                <a href="{{ $social->linkedin }}" target="_blank" class="cin-social-btn"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if(isset($social->youtube) && $social->youtube)
                <a href="{{ $social->youtube }}" target="_blank" class="cin-social-btn"><i class="fab fa-youtube"></i></a>
                @endif
                @if(isset($social->twitter) && $social->twitter)
                <a href="{{ $social->twitter }}" target="_blank" class="cin-social-btn"><i class="fab fa-twitter"></i></a>
                @endif
                @if(isset($social->whatsapp) && $social->whatsapp)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $social->whatsapp) }}" target="_blank" class="cin-social-btn"><i class="fab fa-whatsapp"></i></a>
                @endif
            </div>
        </div>
        @endif

    </div><!-- /cin-content -->

    <!-- FOOTER -->
    <footer class="cin-footer">
        <div class="cin-footer-logo">
            <span>{{ strtoupper(explode(' ', $userdata->name ?? 'Leader')[0]) }}</span>
            {{ isset(explode(' ', $userdata->name ?? 'Leader')[1]) ? strtoupper(explode(' ', $userdata->name ?? 'Leader')[1]) : '' }}
        </div>
        <div class="cin-footer-copy">&copy; {{ date('Y') }} All Rights Reserved &nbsp;|&nbsp; People's Representative</div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])
</body>
</html>