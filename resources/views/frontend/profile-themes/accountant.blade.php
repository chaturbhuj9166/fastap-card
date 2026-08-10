<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'CA Services' }} - Chartered Accountant</title>

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
        $themeColor = $theme->color ?? '#0891b2';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&family=IBM+Plex+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ══════════════════════════════════════════
           ROOT VARIABLES
        ══════════════════════════════════════════ */
        :root {
            --ca-cyan:      #0891b2;
            --ca-cyan-dark: #0e7490;
            --ca-blue:      #2563eb;
            --ca-blue-dark: #1d4ed8;
            --ca-green:     #059669;
            --ca-amber:     #f59e0b;
            --ca-amber-dark:#d97706;
            --ca-light:     #ecfeff;
            --ca-light-2:   #eff6ff;
            --ca-white:     #ffffff;
            --ca-dark:      #0f172a;
            --ca-slate:     #334155;
            --ca-muted:     #64748b;
            --ca-border:    #e2e8f0;
            --ca-bg:        #f8fafc;
            --shadow-sm:    0 2px 8px rgba(8,145,178,0.10);
            --shadow-md:    0 8px 30px rgba(8,145,178,0.14);
            --shadow-lg:    0 20px 60px rgba(8,145,178,0.18);
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        ::-webkit-scrollbar { width:6px; }
        ::-webkit-scrollbar-track { background:#f0f9ff; }
        ::-webkit-scrollbar-thumb { background:var(--ca-cyan); border-radius:3px; }

        body {
            font-family: 'IBM Plex Sans', sans-serif;
            background: var(--ca-bg);
            color: var(--ca-dark);
            overflow-x: hidden;
        }

        /* ══════════════════════════════════════════
           FLOATING SVG CORNERS
        ══════════════════════════════════════════ */
        .ca-corner-svg {
            position: fixed;
            opacity: 0.07;
            z-index: 1;
            pointer-events: none;
        }
        .ca-corner-svg.tl { top:120px; left:2%; width:90px; animation: fl1 7s ease-in-out infinite; }
        .ca-corner-svg.tr { top:160px; right:2%; width:90px; animation: fl2 9s ease-in-out infinite; }
        .ca-corner-svg.bl { bottom:160px; left:2%; width:80px; animation: fl3 11s ease-in-out infinite; }
        .ca-corner-svg.br { bottom:140px; right:2%; width:100px; animation: fl4 8s ease-in-out infinite; }

        @keyframes fl1 { 0%,100%{transform:translateY(0) rotate(0deg)} 50%{transform:translateY(-18px) rotate(-4deg)} }
        @keyframes fl2 { 0%,100%{transform:rotate(0deg)} 100%{transform:rotate(360deg)} }
        @keyframes fl3 { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-14px)} }
        @keyframes fl4 { 0%,100%{transform:scaleY(1)} 50%{transform:scaleY(1.12)} }

        /* ══════════════════════════════════════════
           HERO BANNER — Finance BG Image
           Unsplash: accountant desk with laptop, calculator, documents
        ══════════════════════════════════════════ */
        .ca-hero {
            position: relative;
            min-height: 460px;
            overflow: hidden;
            display: flex;
            align-items: flex-end;

            /* Finance/accounting desk photograph */
            background-image:
                /* Gradient overlay — keeps text readable */
                linear-gradient(
                    105deg,
                    rgba(8, 145, 178, 0.92) 0%,
                    rgba(15, 23, 42, 0.85) 45%,
                    rgba(37, 99, 235, 0.80) 100%
                ),
                url('https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=1920&q=85');
            background-size: cover;
            background-position: center 30%;
            background-color: var(--ca-cyan-dark);
        }

        /* Fine grid overlay */
        .ca-hero::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        }

        /* Particle dots */
        .ca-hero::after {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.12) 1px, transparent 1px);
            background-size: 36px 36px;
            pointer-events: none;
            opacity: 0.5;
        }

        /* Data-flow wave at bottom */
        .ca-hero-wave {
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 72px;
            background: var(--ca-bg);
            clip-path: ellipse(55% 100% at 50% 100%);
            z-index: 3;
        }

        /* ECG pulse line */
        .ca-hero-pulse {
            position: absolute;
            bottom: 72px; left: 0; width: 100%;
            z-index: 2; opacity: 0.18;
        }

        .ca-hero-inner {
            position: relative;
            z-index: 4;
            max-width: 1100px;
            margin: 0 auto;
            width: 100%;
            padding: 70px 40px 100px;
            display: flex;
            align-items: center;
            gap: 44px;
        }

        /* ── Profile photo: clean square with cyan glow ── */
        .ca-hero-photo {
            flex-shrink: 0;
            position: relative;
        }
        .ca-photo-ring {
            width: 168px; height: 168px;
            border-radius: 20px;
            border: 4px solid rgba(255,255,255,0.9);
            overflow: hidden;
            box-shadow: 0 0 0 8px rgba(8,145,178,0.25), 0 20px 50px rgba(0,0,0,0.45);
            background: linear-gradient(135deg, var(--ca-cyan-dark), var(--ca-blue-dark));
        }
        .ca-photo-ring img { width:100%; height:100%; object-fit:cover; }
        .ca-photo-placeholder {
            width:100%; height:100%;
            display:flex; align-items:center; justify-content:center;
            font-size:72px; color:rgba(255,255,255,0.3);
        }
        /* Verified badge */
        .ca-verified {
            position: absolute;
            bottom: -10px; right: -10px;
            width: 38px; height: 38px;
            background: var(--ca-cyan);
            border: 3px solid white;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 14px;
            box-shadow: 0 4px 12px rgba(8,145,178,0.5);
        }

        /* ── Hero text ── */
        .ca-hero-text { flex: 1; }
        .ca-hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.28);
            backdrop-filter: blur(8px);
            color: white;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 40px;
            margin-bottom: 18px;
        }
        .ca-hero-eyebrow i { color: #86efac; }

        .ca-hero-name {
            font-size: 52px;
            font-weight: 700;
            color: white;
            line-height: 1.1;
            margin-bottom: 10px;
            text-shadow: 0 2px 20px rgba(0,0,0,0.5);
        }
        .ca-hero-desig {
            font-size: 16px;
            font-weight: 500;
            color: rgba(255,255,255,0.85);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 24px;
            display: flex; align-items: center; gap: 10px;
        }
        .ca-hero-desig::before {
            content: '';
            width: 32px; height: 2px;
            background: #67e8f9;
            flex-shrink: 0;
        }

        /* Credential pills */
        .ca-hero-pills {
            display: flex; flex-wrap: wrap; gap: 10px;
            margin-bottom: 28px;
        }
        .ca-hero-pill {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 7px 16px;
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.25);
            backdrop-filter: blur(8px);
            border-radius: 40px;
            font-size: 13px; color: white; font-weight: 500;
            transition: all 0.25s;
        }
        .ca-hero-pill i { color: #67e8f9; font-size: 11px; }
        .ca-hero-pill:hover { background: rgba(255,255,255,0.2); }

        /* CTA buttons */
        .ca-hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }
        .ca-btn {
            display: inline-flex; align-items: center; gap: 9px;
            padding: 13px 26px;
            border-radius: 10px;
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: 14px; font-weight: 700;
            text-decoration: none; cursor: pointer; border: none;
            transition: all 0.25s;
        }
        .ca-btn-primary {
            background: white;
            color: var(--ca-cyan-dark);
            box-shadow: 0 6px 24px rgba(0,0,0,0.25);
        }
        .ca-btn-primary:hover { transform:translateY(-3px); box-shadow:0 10px 32px rgba(0,0,0,0.35); color: var(--ca-cyan-dark); }
        .ca-btn-green {
            background: var(--ca-green);
            color: white;
            box-shadow: 0 6px 20px rgba(5,150,105,0.4);
        }
        .ca-btn-green:hover { transform:translateY(-3px); box-shadow:0 10px 28px rgba(5,150,105,0.5); color:white; }
        .ca-btn-outline {
            background: transparent;
            color: white;
            border: 1.5px solid rgba(255,255,255,0.5);
        }
        .ca-btn-outline:hover { background:rgba(255,255,255,0.1); border-color:white; }

        /* ══════════════════════════════════════════
           STATS BAR — right below hero, white bg
        ══════════════════════════════════════════ */
        .ca-stats-bar {
            max-width: 1100px;
            margin: -28px auto 0;
            padding: 0 40px;
            position: relative;
            z-index: 10;
        }
        .ca-stats-inner {
            background: white;
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(8,145,178,0.15);
            border: 1px solid var(--ca-border);
            display: flex;
            overflow: hidden;
        }
        .ca-stat {
            flex: 1;
            padding: 24px 20px;
            text-align: center;
            border-right: 1px solid var(--ca-border);
            position: relative;
            transition: background 0.25s;
        }
        .ca-stat:last-child { border-right: none; }
        .ca-stat::after {
            content: '';
            position: absolute;
            bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 0; height: 3px;
            background: var(--ca-cyan);
            border-radius: 2px 2px 0 0;
            transition: width 0.3s;
        }
        .ca-stat:hover { background: #f0f9ff; }
        .ca-stat:hover::after { width: 60%; }
        .ca-stat-num {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 30px; font-weight: 700;
            color: var(--ca-cyan-dark);
            line-height: 1; margin-bottom: 6px;
        }
        .ca-stat-lbl {
            font-size: 11px;
            color: var(--ca-muted);
            text-transform: uppercase;
            letter-spacing: 1px; font-weight: 600;
        }

        /* ══════════════════════════════════════════
           MAIN CONTENT
        ══════════════════════════════════════════ */
        .ca-main {
            max-width: 1100px;
            margin: 48px auto 0;
            padding: 0 40px 80px;
        }

        /* ── Section Heading ── */
        .ca-section-head {
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 24px;
        }
        .ca-section-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--ca-cyan), var(--ca-blue));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 18px; flex-shrink: 0;
            box-shadow: 0 6px 16px rgba(8,145,178,0.3);
        }
        .ca-section-title {
            font-size: 24px; font-weight: 700;
            color: var(--ca-dark);
        }
        .ca-section-line {
            flex: 1; height: 1px;
            background: linear-gradient(90deg, var(--ca-border), transparent);
        }

        /* ── Base card ── */
        .ca-card {
            background: white;
            border-radius: 18px;
            padding: 36px 40px;
            margin-bottom: 28px;
            border: 1px solid var(--ca-border);
            border-top: 4px solid var(--ca-cyan);
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.3s;
        }
        .ca-card:hover { box-shadow: var(--shadow-md); }

        /* ── About Card — office desk BG ── */
        .ca-card.card-about {
            background-image:
                linear-gradient(135deg, rgba(255,255,255,0.97) 0%, rgba(240,249,255,0.95) 100%),
                url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=1200&q=60');
            background-size: cover; background-position: center right;
        }
        .ca-about-text {
            font-size: 16px; line-height: 1.85; color: var(--ca-slate);
        }

        /* ══════════════════════════════════════════
           QUICK ACTIONS ROW
        ══════════════════════════════════════════ */
        .ca-actions-row {
            display: flex; gap: 16px; flex-wrap: wrap;
            margin-bottom: 36px;
        }
        .ca-action-tile {
            flex: 1; min-width: 200px;
            display: flex; align-items: center; gap: 14px;
            padding: 20px 24px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 700; font-size: 15px;
            transition: all 0.3s;
            border: 2px solid transparent;
        }
        .ca-action-tile.cyan {
            background: linear-gradient(135deg, var(--ca-cyan), var(--ca-blue));
            color: white;
            box-shadow: 0 8px 24px rgba(8,145,178,0.35);
        }
        .ca-action-tile.green {
            background: linear-gradient(135deg, #059669, #047857);
            color: white;
            box-shadow: 0 8px 24px rgba(5,150,105,0.3);
        }
        .ca-action-tile.amber {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            box-shadow: 0 8px 24px rgba(245,158,11,0.3);
        }
        .ca-action-tile:hover { transform: translateY(-4px); }
        .ca-action-tile-icon {
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .ca-action-tile-lbl { font-size: 11px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; opacity: 0.85; margin-bottom: 3px; }
        .ca-action-tile-val { font-size: 15px; font-weight: 700; }
        .ca-action-tile span.disabled { opacity: 0.5; pointer-events: none; }

        /* ══════════════════════════════════════════
           SERVICES SECTION
           BG: financial documents / spreadsheets
        ══════════════════════════════════════════ */
        .ca-card.card-services {
            background-image:
                linear-gradient(135deg, rgba(255,255,255,0.97) 0%, rgba(239,246,255,0.96) 100%),
                url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1200&q=60');
            background-size: cover; background-position: center;
        }
        .ca-services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 20px;
        }
        .ca-service-card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--ca-border);
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(8,145,178,0.07);
            /* Each service card gets a tiny image header strip */
        }
        .ca-service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 36px rgba(8,145,178,0.18);
            border-color: var(--ca-cyan);
        }
        /* Image strip at top of each service card */
        .ca-service-img {
            width: 100%; height: 100px;
            object-fit: cover;
            display: block;
        }
        .ca-service-body { padding: 20px 22px 22px; }
        .ca-service-icon-row {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }
        .ca-service-ico {
            width: 46px; height: 46px;
            background: linear-gradient(135deg, var(--ca-cyan), var(--ca-blue));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 20px;
            box-shadow: 0 4px 14px rgba(8,145,178,0.25);
        }
        .ca-service-badge {
            font-size: 11px; font-weight: 700;
            background: #ecfdf5; color: var(--ca-green);
            border: 1px solid #a7f3d0;
            padding: 4px 10px; border-radius: 20px;
            letter-spacing: 0.5px;
        }
        .ca-service-title {
            font-size: 16px; font-weight: 700;
            color: var(--ca-dark); margin-bottom: 6px;
        }
        .ca-service-desc {
            font-size: 13px; color: var(--ca-muted); line-height: 1.6; margin-bottom: 14px;
        }
        .ca-service-footer {
            display: flex; align-items: center;
            justify-content: space-between;
            padding-top: 14px; border-top: 1px solid var(--ca-border);
        }
        .ca-service-price {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 20px; font-weight: 700;
            color: var(--ca-green);
        }
        .ca-service-days {
            font-size: 12px; color: var(--ca-muted); font-weight: 600;
        }

        /* ══════════════════════════════════════════
           WHY CHOOSE US — 4-icon strip
           BG: coins / wealth image
        ══════════════════════════════════════════ */
        .ca-card.card-why {
            background-image:
                linear-gradient(135deg, rgba(255,255,255,0.97) 0%, rgba(254,252,232,0.95) 100%),
                url('https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=1200&q=60');
            background-size: cover; background-position: center;
        }
        .ca-why-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }
        .ca-why-item {
            text-align: center;
            padding: 28px 20px;
            background: white;
            border-radius: 14px;
            border: 1px solid var(--ca-border);
            transition: all 0.3s;
        }
        .ca-why-item:hover { border-color: var(--ca-cyan); box-shadow: var(--shadow-sm); transform: translateY(-4px); }
        .ca-why-ico {
            width: 60px; height: 60px;
            margin: 0 auto 16px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px;
        }
        .ca-why-ico.c  { background: #ecfeff; color: var(--ca-cyan); }
        .ca-why-ico.b  { background: #eff6ff; color: var(--ca-blue); }
        .ca-why-ico.g  { background: #ecfdf5; color: var(--ca-green); }
        .ca-why-ico.a  { background: #fffbeb; color: var(--ca-amber); }
        .ca-why-title {
            font-size: 15px; font-weight: 700;
            color: var(--ca-dark); margin-bottom: 8px;
        }
        .ca-why-desc { font-size: 13px; color: var(--ca-muted); line-height: 1.6; }

        /* ══════════════════════════════════════════
           CONSULTATIONS
           BG: business meeting image
        ══════════════════════════════════════════ */
        .ca-card.card-consult {
            background-image:
                linear-gradient(135deg, rgba(255,255,255,0.97) 0%, rgba(239,246,255,0.94) 100%),
                url('https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=1200&q=60');
            background-size: cover; background-position: center bottom;
        }
        .ca-consult-list { display: grid; gap: 14px; }
        .ca-consult-item {
            display: flex; gap: 16px; align-items: center;
            padding: 18px 22px;
            background: white;
            border-radius: 12px;
            border: 1px solid var(--ca-border);
            border-left: 4px solid var(--ca-blue);
            transition: all 0.3s;
        }
        .ca-consult-item:hover { background: var(--ca-light-2); transform: translateX(4px); }
        .ca-consult-ico {
            width: 46px; height: 46px;
            background: var(--ca-blue);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 18px; flex-shrink: 0;
        }
        .ca-consult-name { font-size: 15px; font-weight: 700; color: var(--ca-dark); margin-bottom: 4px; }
        .ca-consult-meta { font-size: 13px; color: var(--ca-muted); }

        /* ══════════════════════════════════════════
           DEADLINES
           BG: calendar/agenda image
        ══════════════════════════════════════════ */
        .ca-card.card-deadlines {
            background-image:
                linear-gradient(135deg, rgba(255,255,255,0.97) 0%, rgba(255,251,235,0.95) 100%),
                url('https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=1200&q=60');
            background-size: cover; background-position: center;
        }
        .ca-deadlines-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
        }
        .ca-deadline-item {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #fde68a;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(245,158,11,0.1);
        }
        .ca-deadline-item:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(245,158,11,0.25); }
        .ca-deadline-header {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            padding: 14px 18px;
            display: flex; align-items: center; gap: 10px;
        }
        .ca-deadline-header i { color: white; font-size: 18px; }
        .ca-deadline-type {
            font-size: 14px; font-weight: 700; color: white;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .ca-deadline-body { padding: 16px 18px; }
        .ca-deadline-meta { font-size: 13px; color: var(--ca-muted); line-height: 1.6; }
        .ca-deadline-due {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 15px; font-weight: 700;
            color: var(--ca-amber-dark); margin-top: 8px;
        }

        /* ══════════════════════════════════════════
           CONTACT CARD
           BG: modern office image
        ══════════════════════════════════════════ */
        .ca-card.card-contact {
            background-image:
                linear-gradient(135deg, rgba(255,255,255,0.97) 0%, rgba(240,249,255,0.95) 100%),
                url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=1200&q=60');
            background-size: cover; background-position: center;
        }
        .ca-contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }
        .ca-contact-item {
            display: flex; align-items: center; gap: 16px;
            padding: 20px 22px;
            background: white;
            border-radius: 14px;
            border: 2px solid var(--ca-border);
            text-decoration: none; color: inherit;
            transition: all 0.3s;
        }
        .ca-contact-item:hover {
            border-color: var(--ca-cyan);
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }
        .ca-contact-ico {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, var(--ca-cyan), var(--ca-blue));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 20px; flex-shrink: 0;
            box-shadow: 0 6px 16px rgba(8,145,178,0.3);
        }
        .ca-contact-lbl { font-size: 11px; color: var(--ca-muted); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 4px; }
        .ca-contact-val { font-size: 15px; font-weight: 700; color: var(--ca-dark); }

        /* ══════════════════════════════════════════
           SOCIAL SECTION
        ══════════════════════════════════════════ */
        .ca-social-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 40px 60px;
        }
        .ca-social-card {
            background: white;
            border-radius: 18px;
            padding: 44px 40px;
            text-align: center;
            border: 1px solid var(--ca-border);
            border-top: 4px solid var(--ca-cyan);
            box-shadow: var(--shadow-sm);
            /* subtle finance image watermark */
            background-image:
                linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(240,249,255,0.97) 100%),
                url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&q=50');
            background-size: cover; background-position: center;
        }
        .ca-social-title {
            font-size: 22px; font-weight: 700;
            color: var(--ca-dark); margin-bottom: 6px;
        }
        .ca-social-sub {
            font-size: 13px; color: var(--ca-muted);
            text-transform: uppercase; letter-spacing: 1px;
            margin-bottom: 28px;
        }
        .ca-social-links {
            display: flex; justify-content: center;
            gap: 16px; flex-wrap: wrap;
        }
        .ca-soc-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 12px 22px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px; font-weight: 700; color: white;
            transition: all 0.3s;
        }
        .ca-soc-btn:hover { transform: translateY(-4px); }
        .soc-fb  { background: #1877f2; box-shadow: 0 6px 18px rgba(24,119,242,0.35); }
        .soc-ig  { background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); box-shadow: 0 6px 18px rgba(220,39,67,0.35); }
        .soc-li  { background: #0077b5; box-shadow: 0 6px 18px rgba(0,119,181,0.35); }
        .soc-yt  { background: #ff0000; box-shadow: 0 6px 18px rgba(255,0,0,0.3); }

        /* ══════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════ */
        @media (max-width: 900px) {
            .ca-hero-inner { flex-direction: column; align-items: center; text-align: center; padding: 50px 24px 90px; gap: 28px; }
            .ca-hero-name { font-size: 38px; }
            .ca-hero-desig { justify-content: center; }
            .ca-hero-pills { justify-content: center; }
            .ca-hero-btns { justify-content: center; }
            .ca-stats-bar { padding: 0 20px; }
            .ca-stats-inner { flex-wrap: wrap; }
            .ca-stat { min-width: 50%; border-bottom: 1px solid var(--ca-border); }
        }
        @media (max-width: 640px) {
            .ca-main, .ca-social-wrap { padding-left: 18px; padding-right: 18px; }
            .ca-card { padding: 24px 20px; }
            .ca-services-grid { grid-template-columns: 1fr; }
            .ca-why-grid { grid-template-columns: 1fr 1fr; }
            .ca-contact-grid { grid-template-columns: 1fr; }
            .ca-corner-svg { display: none; }
            .ca-actions-row { flex-direction: column; }
        }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')

    <!-- ══ Floating Corner SVGs ══ -->
    <svg class="ca-corner-svg tl" viewBox="0 0 200 220" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="40" y="20" width="120" height="180" rx="12" fill="#0891b2" opacity="0.7"/>
        <rect x="55" y="35" width="90" height="30" rx="4" fill="#ecfeff"/>
        <text x="100" y="56" font-size="17" fill="#0891b2" text-anchor="middle" font-family="monospace" font-weight="bold">1,23,456</text>
        <rect x="60" y="75" width="20" height="20" rx="3" fill="#f0f9ff"/>
        <rect x="90" y="75" width="20" height="20" rx="3" fill="#f0f9ff"/>
        <rect x="120" y="75" width="20" height="20" rx="3" fill="#f0f9ff"/>
        <rect x="60" y="105" width="20" height="20" rx="3" fill="#f0f9ff"/>
        <rect x="90" y="105" width="20" height="20" rx="3" fill="#f0f9ff"/>
        <rect x="120" y="105" width="20" height="20" rx="3" fill="#f0f9ff"/>
        <rect x="60" y="135" width="50" height="20" rx="3" fill="#f59e0b"/>
    </svg>

    <svg class="ca-corner-svg tr" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="100" cy="100" r="78" fill="#e0f2fe" opacity="0.4"/>
        <path d="M100 100 L100 22 A78 78 0 0 1 178 100 Z" fill="#0891b2" opacity="0.8"/>
        <path d="M100 100 L178 100 A78 78 0 0 1 139 168 Z" fill="#2563eb" opacity="0.8"/>
        <path d="M100 100 L139 168 A78 78 0 0 1 61 168 Z" fill="#059669" opacity="0.8"/>
        <path d="M100 100 L61 168 A78 78 0 0 1 22 100 Z" fill="#f59e0b" opacity="0.8"/>
        <path d="M100 100 L22 100 A78 78 0 0 1 100 22 Z" fill="#8b5cf6" opacity="0.8"/>
        <circle cx="100" cy="100" r="38" fill="#fff" opacity="0.85"/>
    </svg>

    <svg class="ca-corner-svg bl" viewBox="0 0 180 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <ellipse cx="90" cy="175" rx="50" ry="12" fill="#f59e0b" opacity="0.7"/>
        <ellipse cx="90" cy="160" rx="50" ry="12" fill="#fbbf24"/>
        <ellipse cx="90" cy="145" rx="50" ry="12" fill="#f59e0b" opacity="0.7"/>
        <ellipse cx="90" cy="130" rx="50" ry="12" fill="#fbbf24"/>
        <ellipse cx="90" cy="115" rx="50" ry="12" fill="#f59e0b" opacity="0.7"/>
        <text x="90" y="122" font-size="22" fill="#78350f" text-anchor="middle" font-weight="bold">₹</text>
    </svg>

    <svg class="ca-corner-svg br" viewBox="0 0 220 180" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="25" y="90" width="30" height="78" rx="4" fill="#0891b2" opacity="0.7"/>
        <rect x="65" y="70" width="30" height="98" rx="4" fill="#2563eb" opacity="0.7"/>
        <rect x="105" y="50" width="30" height="118" rx="4" fill="#059669" opacity="0.7"/>
        <rect x="145" y="30" width="30" height="138" rx="4" fill="#f59e0b" opacity="0.7"/>
        <line x1="15" y1="168" x2="190" y2="168" stroke="#64748b" stroke-width="2"/>
        <line x1="15" y1="20" x2="15" y2="168" stroke="#64748b" stroke-width="2"/>
    </svg>

    <!-- ══════════════════════════════════════════
         HERO BANNER — Finance Desk Background
    ══════════════════════════════════════════ -->
    <section class="ca-hero">
        <!-- ECG / data pulse SVG -->
        <svg class="ca-hero-pulse" viewBox="0 0 1200 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 25 L120 25 L150 5 L170 45 L200 25 L350 25 L380 15 L410 35 L440 25 L590 25 L620 5 L650 45 L680 25 L830 25 L860 15 L890 35 L920 25 L1070 25 L1100 12 L1120 38 L1150 25 L1200 25"
                  stroke="rgba(255,255,255,0.6)" stroke-width="1.5" fill="none"/>
        </svg>

        <div class="ca-hero-inner">
            <!-- Profile Photo -->
            @if($userdata->isFeatureVisible('profile_photo'))
            <div class="ca-hero-photo">
                <div class="ca-photo-ring">
                    @if($userdata->profile)
                        <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}" alt="{{ $userdata->name }}">
                    @else
                        <div class="ca-photo-placeholder"><i class="fas fa-file-invoice"></i></div>
                    @endif
                </div>
                <div class="ca-verified"><i class="fas fa-check"></i></div>
            </div>
            @endif

            <!-- Hero Text -->
            <div class="ca-hero-text">
                <div class="ca-hero-eyebrow">
                    <i class="fas fa-circle-check"></i> Certified Chartered Accountant
                </div>

                @if($userdata->isFeatureVisible('name'))
                <h1 class="ca-hero-name">{{ $userdata->name }}</h1>
                @endif

                @if($userdata->isFeatureVisible('designation') && $userdata->desig)
                <div class="ca-hero-desig">{{ $userdata->desig }}</div>
                @endif

                <div class="ca-hero-pills">
                    <div class="ca-hero-pill"><i class="fas fa-shield-halved"></i> Trusted Compliance</div>
                    @if($userdata->city)
                    <div class="ca-hero-pill"><i class="fas fa-location-dot"></i> {{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                    @endif
                    <div class="ca-hero-pill"><i class="fas fa-star"></i> Expert Advisory</div>
                    <div class="ca-hero-pill"><i class="fas fa-clock"></i> 15+ Years Experience</div>
                </div>

                <div class="ca-hero-btns">
                    @if(isset($isPreview) && $isPreview)
                    <span class="ca-btn ca-btn-primary" style="opacity:.6;cursor:not-allowed;">
                        <i class="fas fa-calendar-check"></i> Book Consultation
                    </span>
                    @elseif(!empty($userdata->slug))
                    <a href="{{ url($userdata->slug . '/ca-consultation') }}" class="ca-btn ca-btn-primary">
                        <i class="fas fa-calendar-check"></i> Book Consultation
                    </a>
                    @endif

                    @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="ca-btn ca-btn-outline">
                        <i class="fas fa-phone"></i> Call Office
                    </a>
                    @endif

                    @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social) && $social && $social->whatsapp)
                    <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="ca-btn ca-btn-green">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="ca-hero-wave"></div>
    </section>

    <!-- ══════════════════════════════════════════
         STATS BAR (floating card)
    ══════════════════════════════════════════ -->
    <div class="ca-stats-bar">
        <div class="ca-stats-inner">
            @php
                $serviceCount  = isset($caServices)      ? $caServices->count()      : 0;
                $caseCount     = isset($caCases)          ? $caCases->count()          : 0;
                $consultCount  = isset($caConsultations)  ? $caConsultations->count()  : 0;
            @endphp
            <div class="ca-stat">
                <div class="ca-stat-num">{{ $serviceCount  > 0 ? $serviceCount  : '15+' }}</div>
                <div class="ca-stat-lbl">Services Offered</div>
            </div>
            <div class="ca-stat">
                <div class="ca-stat-num">{{ $caseCount > 0 ? $caseCount : '50+' }}</div>
                <div class="ca-stat-lbl">Active Cases</div>
            </div>
            <div class="ca-stat">
                <div class="ca-stat-num">{{ $consultCount > 0 ? $consultCount : '500+' }}</div>
                <div class="ca-stat-lbl">Clients Served</div>
            </div>
            <div class="ca-stat">
                <div class="ca-stat-num">15+</div>
                <div class="ca-stat-lbl">Years of Practice</div>
            </div>
            <div class="ca-stat">
                <div class="ca-stat-num">100%</div>
                <div class="ca-stat-lbl">Compliance Rate</div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════ -->
    <div class="ca-main">

        <!-- Quick Action Tiles -->
        <div class="ca-actions-row" style="margin-top:44px;">
            @if(isset($isPreview) && $isPreview)
            <span class="ca-action-tile cyan" style="opacity:.65;cursor:not-allowed;">
                <div class="ca-action-tile-icon"><i class="fas fa-calendar-check"></i></div>
                <div>
                    <div class="ca-action-tile-lbl">Schedule</div>
                    <div class="ca-action-tile-val">Book Consultation</div>
                </div>
            </span>
            @elseif(!empty($userdata->slug))
            <a href="{{ url($userdata->slug . '/ca-consultation') }}" class="ca-action-tile cyan">
                <div class="ca-action-tile-icon"><i class="fas fa-calendar-check"></i></div>
                <div>
                    <div class="ca-action-tile-lbl">Schedule</div>
                    <div class="ca-action-tile-val">Book Consultation</div>
                </div>
            </a>
            @endif

            @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
            <a href="tel:{{ $userdata->mobile }}" class="ca-action-tile amber">
                <div class="ca-action-tile-icon"><i class="fas fa-phone-volume"></i></div>
                <div>
                    <div class="ca-action-tile-lbl">Direct Call</div>
                    <div class="ca-action-tile-val">{{ $userdata->mobile }}</div>
                </div>
            </a>
            @endif

            @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social) && $social && $social->whatsapp)
            <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="ca-action-tile green">
                <div class="ca-action-tile-icon"><i class="fab fa-whatsapp"></i></div>
                <div>
                    <div class="ca-action-tile-lbl">Chat on</div>
                    <div class="ca-action-tile-val">WhatsApp</div>
                </div>
            </a>
            @endif
        </div>

        <!-- ═══ ABOUT ═══ -->
        @if($userdata->isFeatureVisible('bio') && $userdata->about_us)
        <div class="ca-section-head">
            <div class="ca-section-icon"><i class="fas fa-user-tie"></i></div>
            <div class="ca-section-title">About Us</div>
            <div class="ca-section-line"></div>
        </div>
        <div class="ca-card card-about">
            <p class="ca-about-text">{{ $userdata->about_us }}</p>
        </div>
        @endif

        <!-- ═══ WHY CHOOSE US ═══ -->
        <div class="ca-section-head">
            <div class="ca-section-icon"><i class="fas fa-award"></i></div>
            <div class="ca-section-title">Why Choose Us</div>
            <div class="ca-section-line"></div>
        </div>
        <div class="ca-card card-why">
            <div class="ca-why-grid">
                <div class="ca-why-item">
                    <div class="ca-why-ico c"><i class="fas fa-shield-halved"></i></div>
                    <div class="ca-why-title">100% Compliant</div>
                    <div class="ca-why-desc">Strict adherence to ICAI standards and government regulations</div>
                </div>
                <div class="ca-why-item">
                    <div class="ca-why-ico b"><i class="fas fa-clock"></i></div>
                    <div class="ca-why-title">Timely Filing</div>
                    <div class="ca-why-desc">Never miss a deadline — our team tracks every compliance date</div>
                </div>
                <div class="ca-why-item">
                    <div class="ca-why-ico g"><i class="fas fa-chart-line"></i></div>
                    <div class="ca-why-title">Tax Optimization</div>
                    <div class="ca-why-desc">Strategic planning to maximize savings and minimize tax liability</div>
                </div>
                <div class="ca-why-item">
                    <div class="ca-why-ico a"><i class="fas fa-handshake"></i></div>
                    <div class="ca-why-title">Trusted Partner</div>
                    <div class="ca-why-desc">500+ satisfied clients with long-term ongoing relationships</div>
                </div>
            </div>
        </div>

        <!-- ═══ SERVICES ═══ -->
        <div class="ca-section-head">
            <div class="ca-section-icon"><i class="fas fa-briefcase"></i></div>
            <div class="ca-section-title">Our Services</div>
            <div class="ca-section-line"></div>
        </div>
        <div class="ca-card card-services">
            <div class="ca-services-grid">
                @if(isset($caServices) && $caServices->count() > 0)
                    @php
                        $svcImages = [
                            'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&q=60',
                            'https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=600&q=60',
                            'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?w=600&q=60',
                            'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=600&q=60',
                            'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&q=60',
                            'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=600&q=60',
                        ];
                    @endphp
                    @foreach($caServices->take(6) as $idx => $service)
                    <div class="ca-service-card">
                        <img class="ca-service-img"
                             src="{{ $svcImages[$idx % count($svcImages)] }}"
                             alt="{{ $service->service_name }}">
                        <div class="ca-service-body">
                            <div class="ca-service-icon-row">
                                <div class="ca-service-ico"><i class="fas fa-file-invoice-dollar"></i></div>
                                @if($service->turnaround_time_days)
                                <span class="ca-service-badge"><i class="fas fa-bolt"></i> {{ $service->turnaround_time_days }}d</span>
                                @endif
                            </div>
                            <div class="ca-service-title">{{ $service->service_name }}</div>
                            @if($service->description)
                            <div class="ca-service-desc">{{ Str::limit($service->description, 80) }}</div>
                            @endif
                            <div class="ca-service-footer">
                                @if($service->base_price)
                                <div class="ca-service-price">₹{{ number_format($service->base_price) }}</div>
                                @endif
                                <div class="ca-service-days">{{ $service->service_category ?? 'Service' }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    {{-- Placeholder services with images --}}
                    <div class="ca-service-card">
                        <img class="ca-service-img" src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&q=60" alt="ITR Filing">
                        <div class="ca-service-body">
                            <div class="ca-service-icon-row">
                                <div class="ca-service-ico"><i class="fas fa-file-alt"></i></div>
                                <span class="ca-service-badge"><i class="fas fa-bolt"></i> 7d</span>
                            </div>
                            <div class="ca-service-title">Income Tax Return Filing</div>
                            <div class="ca-service-desc">Accurate ITR filing for individuals, firms & corporates with maximum deductions.</div>
                            <div class="ca-service-footer">
                                <div class="ca-service-price">₹2,500</div>
                                <div class="ca-service-days">Tax Compliance</div>
                            </div>
                        </div>
                    </div>
                    <div class="ca-service-card">
                        <img class="ca-service-img" src="https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=600&q=60" alt="GST">
                        <div class="ca-service-body">
                            <div class="ca-service-icon-row">
                                <div class="ca-service-ico"><i class="fas fa-building"></i></div>
                                <span class="ca-service-badge"><i class="fas fa-bolt"></i> 5d</span>
                            </div>
                            <div class="ca-service-title">GST Registration & Filing</div>
                            <div class="ca-service-desc">End-to-end GST registration, GSTR-1, GSTR-3B filing and compliance management.</div>
                            <div class="ca-service-footer">
                                <div class="ca-service-price">₹3,000</div>
                                <div class="ca-service-days">GST Services</div>
                            </div>
                        </div>
                    </div>
                    <div class="ca-service-card">
                        <img class="ca-service-img" src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?w=600&q=60" alt="Audit">
                        <div class="ca-service-body">
                            <div class="ca-service-icon-row">
                                <div class="ca-service-ico"><i class="fas fa-balance-scale"></i></div>
                                <span class="ca-service-badge"><i class="fas fa-bolt"></i> 15d</span>
                            </div>
                            <div class="ca-service-title">Audit & Assurance</div>
                            <div class="ca-service-desc">Statutory, internal and tax audit with certified reports for all business sizes.</div>
                            <div class="ca-service-footer">
                                <div class="ca-service-price">₹15,000</div>
                                <div class="ca-service-days">Financial Audit</div>
                            </div>
                        </div>
                    </div>
                    <div class="ca-service-card">
                        <img class="ca-service-img" src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=600&q=60" alt="Financial Planning">
                        <div class="ca-service-body">
                            <div class="ca-service-icon-row">
                                <div class="ca-service-ico"><i class="fas fa-chart-pie"></i></div>
                                <span class="ca-service-badge"><i class="fas fa-bolt"></i> On-going</span>
                            </div>
                            <div class="ca-service-title">Financial Planning</div>
                            <div class="ca-service-desc">Strategic wealth management and financial roadmap planning for individuals & businesses.</div>
                            <div class="ca-service-footer">
                                <div class="ca-service-price">₹5,000</div>
                                <div class="ca-service-days">Advisory</div>
                            </div>
                        </div>
                    </div>
                    <div class="ca-service-card">
                        <img class="ca-service-img" src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&q=60" alt="Company Registration">
                        <div class="ca-service-body">
                            <div class="ca-service-icon-row">
                                <div class="ca-service-ico"><i class="fas fa-registered"></i></div>
                                <span class="ca-service-badge"><i class="fas fa-bolt"></i> 10d</span>
                            </div>
                            <div class="ca-service-title">Company Incorporation</div>
                            <div class="ca-service-desc">PVT LTD, LLP, OPC registration with MCA compliance and post-formation support.</div>
                            <div class="ca-service-footer">
                                <div class="ca-service-price">₹8,000</div>
                                <div class="ca-service-days">Registration</div>
                            </div>
                        </div>
                    </div>
                    <div class="ca-service-card">
                        <img class="ca-service-img" src="https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=600&q=60" alt="Payroll">
                        <div class="ca-service-body">
                            <div class="ca-service-icon-row">
                                <div class="ca-service-ico"><i class="fas fa-users"></i></div>
                                <span class="ca-service-badge"><i class="fas fa-bolt"></i> Monthly</span>
                            </div>
                            <div class="ca-service-title">Payroll Management</div>
                            <div class="ca-service-desc">Complete payroll processing, PF, ESI, TDS deductions and employee compliance.</div>
                            <div class="ca-service-footer">
                                <div class="ca-service-price">₹4,000</div>
                                <div class="ca-service-days">HR & Payroll</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- ═══ CONSULTATIONS ═══ -->
        @if(isset($caConsultations) && $caConsultations->count() > 0)
        <div class="ca-section-head">
            <div class="ca-section-icon"><i class="fas fa-user-clock"></i></div>
            <div class="ca-section-title">Upcoming Consultations</div>
            <div class="ca-section-line"></div>
        </div>
        <div class="ca-card card-consult">
            <div class="ca-consult-list">
                @foreach($caConsultations->take(3) as $consultation)
                <div class="ca-consult-item">
                    <div class="ca-consult-ico"><i class="fas fa-calendar"></i></div>
                    <div>
                        <div class="ca-consult-name">{{ $consultation->client_name ?? 'Consultation' }}</div>
                        <div class="ca-consult-meta">
                            {{ $consultation->consultation_type ?? 'Consultation' }}
                            @if(isset($consultation->appointment_date))
                                &nbsp;•&nbsp; {{ $consultation->appointment_date->format('d M Y') }}
                            @endif
                            @if(isset($consultation->appointment_time))
                                &nbsp;•&nbsp; {{ $consultation->appointment_time }}
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- ═══ DEADLINES ═══ -->
        @if(isset($caDeadlines) && $caDeadlines->count() > 0)
        <div class="ca-section-head">
            <div class="ca-section-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="ca-section-title">Key Compliance Deadlines</div>
            <div class="ca-section-line"></div>
        </div>
        <div class="ca-card card-deadlines">
            <div class="ca-deadlines-grid">
                @foreach($caDeadlines->take(3) as $deadline)
                <div class="ca-deadline-item">
                    <div class="ca-deadline-header">
                        <i class="fas fa-triangle-exclamation"></i>
                        <div class="ca-deadline-type">{{ $deadline->compliance_type ?? 'Compliance' }}</div>
                    </div>
                    <div class="ca-deadline-body">
                        <div class="ca-deadline-meta">{{ $deadline->financial_year ?? 'FY' }}</div>
                        @if(isset($deadline->due_date))
                        <div class="ca-deadline-due"><i class="fas fa-calendar"></i> {{ $deadline->due_date->format('d M Y') }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- ═══ CONTACT ═══ -->
        @if($userdata->isFeatureVisible('contact_number') || $userdata->isFeatureVisible('email') || $userdata->isFeatureVisible('address'))
        <div class="ca-section-head">
            <div class="ca-section-icon"><i class="fas fa-address-book"></i></div>
            <div class="ca-section-title">Contact Information</div>
            <div class="ca-section-line"></div>
        </div>
        <div class="ca-card card-contact">
            <div class="ca-contact-grid">
                @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="ca-contact-item">
                    <div class="ca-contact-ico"><i class="fas fa-phone"></i></div>
                    <div>
                        <div class="ca-contact-lbl">Phone Number</div>
                        <div class="ca-contact-val">{{ $userdata->mobile }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->isFeatureVisible('email') && $userdata->email)
                <a href="mailto:{{ $userdata->email }}" class="ca-contact-item">
                    <div class="ca-contact-ico"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="ca-contact-lbl">Email Address</div>
                        <div class="ca-contact-val">{{ $userdata->email }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->isFeatureVisible('address') && ($userdata->address || $userdata->city))
                <div class="ca-contact-item">
                    <div class="ca-contact-ico"><i class="fas fa-map-location-dot"></i></div>
                    <div>
                        <div class="ca-contact-lbl">Office Location</div>
                        <div class="ca-contact-val">{{ $userdata->address ?? ($userdata->city.($userdata->state ? ', '.$userdata->state : '')) }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div><!-- /ca-main -->

    <!-- ═══ SOCIAL LINKS ═══ -->
    @if($userdata->isFeatureVisible('social_media'))
    <div class="ca-social-wrap">
        <div class="ca-social-card">
            <div class="ca-social-title">Stay Connected</div>
            <div class="ca-social-sub">Follow us on social media for tax tips &amp; updates</div>
            <div class="ca-social-links">
                @if($userdata->isFeatureVisible('facebook') && isset($social->facebook) && $social->facebook)
                <a href="{{ $social->facebook }}" target="_blank" class="ca-soc-btn soc-fb">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                @endif
                @if($userdata->isFeatureVisible('instagram') && isset($social->instagram) && $social->instagram)
                <a href="{{ $social->instagram }}" target="_blank" class="ca-soc-btn soc-ig">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                @endif
                @if($userdata->isFeatureVisible('linkedin') && isset($social->linkedin) && $social->linkedin)
                <a href="{{ $social->linkedin }}" target="_blank" class="ca-soc-btn soc-li">
                    <i class="fab fa-linkedin-in"></i> LinkedIn
                </a>
                @endif
                @if(isset($social->youtube) && $social->youtube)
                <a href="{{ $social->youtube }}" target="_blank" class="ca-soc-btn soc-yt">
                    <i class="fab fa-youtube"></i> YouTube
                </a>
                @endif
            </div>
        </div>
    </div>
    @endif

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])
</body>
</html>