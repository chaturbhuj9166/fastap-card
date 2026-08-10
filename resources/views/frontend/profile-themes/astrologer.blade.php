<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Astrologer' }} - Astrology & Vastu Consultant</title>

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
        $themeColor = $theme->color ?? '#7c3aed';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ══════════════════════════════════════════════════
           VARIABLES & RESET
        ══════════════════════════════════════════════════ */
        :root {
            --gold:          #f5c842;
            --gold-dim:      #d4a017;
            --gold-glow:     rgba(245,200,66,0.25);
            --purple:        #7c3aed;
            --purple-deep:   #4c1d95;
            --indigo:        #3730a3;
            --cosmic-dark:   #050311;
            --cosmic-mid:    #0d0820;
            --cosmic-card:   rgba(13,8,32,0.85);
            --cosmic-glass:  rgba(255,255,255,0.05);
            --cosmic-border: rgba(245,200,66,0.18);
            --text-bright:   #f8f4ff;
            --text-soft:     #c4b5fd;
            --text-dim:      #7c6fa0;
            --teal:          #14b8a6;
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        ::-webkit-scrollbar { width:5px; }
        ::-webkit-scrollbar-track { background:#050311; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(var(--purple), var(--gold-dim)); border-radius:3px; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--cosmic-dark);
            color: var(--text-bright);
            overflow-x: hidden;
        }

        /* ══════════════════════════════════════════════════
           PREVIEW BANNER
        ══════════════════════════════════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg, var(--purple-deep), var(--indigo));
            color: white; padding:12px 20px;
            text-align:center; font-size:13px; font-weight:600;
            position:sticky; top:0; z-index:1000;
        }
        .preview-banner a { color:var(--gold); text-decoration:underline; margin-left:6px; }

        /* ══════════════════════════════════════════════════
           FIXED FLOATING STARS (subtle)
        ══════════════════════════════════════════════════ */
        .star-field {
            position: fixed; inset:0;
            pointer-events:none; z-index:0;
            background-image:
                radial-gradient(1px 1px at 10% 15%, rgba(255,255,255,0.7), transparent),
                radial-gradient(1px 1px at 25% 60%, rgba(255,255,255,0.5), transparent),
                radial-gradient(2px 2px at 40% 30%, rgba(245,200,66,0.4), transparent),
                radial-gradient(1px 1px at 55% 80%, rgba(255,255,255,0.6), transparent),
                radial-gradient(1px 1px at 70% 20%, rgba(255,255,255,0.5), transparent),
                radial-gradient(2px 2px at 80% 70%, rgba(196,181,253,0.4), transparent),
                radial-gradient(1px 1px at 90% 40%, rgba(255,255,255,0.6), transparent),
                radial-gradient(1px 1px at 15% 85%, rgba(255,255,255,0.4), transparent),
                radial-gradient(1px 1px at 60% 10%, rgba(245,200,66,0.3), transparent),
                radial-gradient(1px 1px at 35% 95%, rgba(255,255,255,0.4), transparent);
            background-size: 100% 100%;
            animation: stars-twinkle 6s ease-in-out infinite alternate;
        }
        @keyframes stars-twinkle {
            0%   { opacity:0.4; }
            100% { opacity:0.9; }
        }

        /* ══════════════════════════════════════════════════
           ORNAMENTAL SECTION DIVIDER
        ══════════════════════════════════════════════════ */
        .astro-divider {
            display: flex;
            align-items: center;
            gap: 18px;
            margin: 70px 0 48px;
        }
        .astro-divider-line {
            flex:1; height:1px;
            background: linear-gradient(90deg, transparent, var(--cosmic-border), transparent);
        }
        .astro-divider-symbol {
            display: flex; align-items: center; gap: 10px;
            color: var(--gold); font-size: 11px; font-weight:700;
            letter-spacing:3px; text-transform:uppercase;
            white-space:nowrap;
        }
        .astro-divider-symbol i { font-size:16px; animation: spin-slow 8s linear infinite; }
        @keyframes spin-slow { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }

        /* ══════════════════════════════════════════════════
           SECTION LABEL (left-pinned pill)
        ══════════════════════════════════════════════════ */
        .section-eyebrow {
            display: inline-flex; align-items:center; gap:8px;
            background: rgba(245,200,66,0.1);
            border: 1px solid rgba(245,200,66,0.3);
            color: var(--gold);
            font-size: 11px; font-weight:700; letter-spacing:2.5px;
            text-transform: uppercase; padding: 6px 16px;
            border-radius:40px; margin-bottom:16px;
        }
        .section-eyebrow i { font-size:10px; }

        .section-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 42px; font-weight: 600;
            color: var(--text-bright);
            line-height:1.2; margin-bottom:12px;
        }
        .section-heading em { color:var(--gold); font-style:italic; }

        .section-sub {
            font-size:15px; color:var(--text-dim);
            max-width:560px; line-height:1.75;
            margin-bottom:40px;
        }

        /* ══════════════════════════════════════════════════
        ██  SECTION 1 — FULL-SCREEN HERO
            BG: Milky Way galaxy photograph
        ══════════════════════════════════════════════════ */
        .cs-hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            z-index: 10;

            background-image:
                /* layered gradients */
                radial-gradient(ellipse at top, rgba(76,29,149,0.7) 0%, transparent 60%),
                radial-gradient(ellipse at bottom, rgba(5,3,17,0.95) 0%, transparent 70%),
                linear-gradient(180deg, rgba(5,3,17,0.3) 0%, rgba(5,3,17,0.85) 100%),
                /* galaxy photo */
                url('https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1920&q=85');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Subtle scanline texture */
        .cs-hero::before {
            content:''; position:absolute; inset:0; z-index:1; pointer-events:none;
            background: repeating-linear-gradient(0deg,
                transparent, transparent 3px,
                rgba(255,255,255,0.012) 3px,
                rgba(255,255,255,0.012) 6px
            );
        }

        /* Gold bottom glow */
        .cs-hero::after {
            content:''; position:absolute; bottom:0; left:0; right:0; height:200px; z-index:1;
            background: linear-gradient(0deg, var(--cosmic-dark) 0%, transparent 100%);
        }

        .cs-hero-inner {
            position: relative; z-index:3;
            padding: 120px 24px 80px;
            max-width:800px; margin:0 auto;
        }

        /* ── zodiac ring photo ── */
        .cs-photo-wrap {
            position:relative;
            width:200px; height:200px;
            margin:0 auto 36px;
        }
        .cs-zodiac-ring {
            position:absolute; inset:-16px;
            border-radius:50%;
            border: 1px solid var(--cosmic-border);
            animation: ring-spin 25s linear infinite;
        }
        .cs-zodiac-ring::before,
        .cs-zodiac-ring::after {
            content:'★';
            position:absolute;
            color:var(--gold);
            font-size:12px;
            width:16px; height:16px;
            display:flex; align-items:center; justify-content:center;
            left:50%; transform:translateX(-50%);
        }
        .cs-zodiac-ring::before { top:-8px; }
        .cs-zodiac-ring::after  { bottom:-8px; }
        @keyframes ring-spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }

        /* Second ring */
        .cs-ring-2 {
            position:absolute; inset:-30px;
            border-radius:50%;
            border: 1px dashed rgba(245,200,66,0.15);
            animation: ring-spin 40s linear infinite reverse;
        }

        .cs-photo-circle {
            width:200px; height:200px; border-radius:50%;
            border:3px solid var(--gold);
            overflow:hidden; background: var(--cosmic-mid);
            box-shadow:
                0 0 0 8px rgba(124,58,237,0.2),
                0 0 50px rgba(245,200,66,0.3),
                0 0 100px rgba(124,58,237,0.4);
        }
        .cs-photo-circle img { width:100%; height:100%; object-fit:cover; }
        .cs-photo-placeholder {
            width:100%; height:100%;
            display:flex; align-items:center; justify-content:center;
            background: linear-gradient(135deg,var(--purple-deep),var(--indigo));
            color:var(--gold); font-size:80px;
        }

        /* Gold dot glow orbs */
        .cs-glow-orb {
            position:absolute; border-radius:50%;
            animation: orb-pulse 3s ease-in-out infinite alternate;
        }
        .cs-glow-orb.o1 { width:8px; height:8px; background:var(--gold); top:-4px; right:30px; box-shadow:0 0 14px var(--gold); }
        .cs-glow-orb.o2 { width:6px; height:6px; background:var(--teal); bottom:20px; left:-10px; box-shadow:0 0 10px var(--teal); animation-delay:1.5s; }
        @keyframes orb-pulse { 0%{opacity:0.5; transform:scale(1)} 100%{opacity:1; transform:scale(1.6)} }

        /* Hero text */
        .cs-certified {
            display:inline-flex; align-items:center; gap:8px;
            background:rgba(245,200,66,0.1); border:1px solid rgba(245,200,66,0.35);
            color:var(--gold); font-size:11px; font-weight:700;
            letter-spacing:2.5px; text-transform:uppercase;
            padding:7px 20px; border-radius:40px; margin-bottom:20px;
        }
        .cs-certified i { animation:orb-pulse 2s ease-in-out infinite alternate; }

        .cs-name {
            font-family:'Cormorant Garamond', serif;
            font-size:72px; font-weight:700;
            color:var(--text-bright); line-height:1.0;
            letter-spacing:2px;
            text-shadow: 0 0 60px rgba(245,200,66,0.3), 0 4px 30px rgba(0,0,0,0.8);
            margin-bottom:12px;
        }
        .cs-name em { color:var(--gold); font-style:italic; }

        .cs-title {
            font-size:15px; letter-spacing:4px;
            text-transform:uppercase; color:var(--text-soft);
            font-weight:500; margin-bottom:28px;
            display:flex; align-items:center; justify-content:center; gap:14px;
        }
        .cs-title-dot {
            width:5px; height:5px; background:var(--gold); border-radius:50%;
        }

        /* Specialty pills */
        .cs-pills {
            display:flex; flex-wrap:wrap; justify-content:center; gap:10px;
            margin-bottom:40px;
        }
        .cs-pill {
            display:inline-flex; align-items:center; gap:7px;
            padding:8px 18px;
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.15);
            backdrop-filter:blur(10px);
            border-radius:40px; font-size:13px;
            color:rgba(255,255,255,0.85); font-weight:500;
            transition:all 0.3s;
        }
        .cs-pill i { color:var(--gold); font-size:12px; }
        .cs-pill:hover { background:rgba(245,200,66,0.12); border-color:rgba(245,200,66,0.4); }

        /* CTA Buttons */
        .cs-hero-btns { display:flex; gap:14px; flex-wrap:wrap; justify-content:center; }
        .cs-btn {
            display:inline-flex; align-items:center; gap:10px;
            padding:15px 30px; border-radius:10px;
            font-family:'Nunito',sans-serif;
            font-size:14px; font-weight:700;
            text-decoration:none; transition:all 0.3s; cursor:pointer;
        }
        .cs-btn-gold {
            background: linear-gradient(135deg, var(--gold), var(--gold-dim));
            color: #1a0e00;
            box-shadow: 0 8px 28px rgba(245,200,66,0.4);
        }
        .cs-btn-gold:hover { transform:translateY(-3px); box-shadow:0 14px 36px rgba(245,200,66,0.55); color:#1a0e00; }
        .cs-btn-ghost {
            background:transparent; color:var(--text-bright);
            border:1.5px solid rgba(255,255,255,0.3);
        }
        .cs-btn-ghost:hover { border-color:var(--gold); color:var(--gold); background:rgba(245,200,66,0.06); }
        .cs-btn-teal {
            background:linear-gradient(135deg, var(--teal), #0d9488);
            color:white; box-shadow:0 8px 24px rgba(20,184,166,0.4);
        }
        .cs-btn-teal:hover { transform:translateY(-3px); color:white; }

        /* scroll indicator */
        .cs-scroll-hint {
            position:absolute; bottom:36px; left:50%; transform:translateX(-50%);
            z-index:3; display:flex; flex-direction:column; align-items:center; gap:8px;
            color:rgba(255,255,255,0.35); font-size:11px; letter-spacing:2px;
            text-transform:uppercase; animation: hint-bounce 2s ease-in-out infinite;
        }
        @keyframes hint-bounce { 0%,100%{transform:translateX(-50%) translateY(0)} 50%{transform:translateX(-50%) translateY(8px)} }
        .cs-scroll-hint i { font-size:18px; }

        /* ══════════════════════════════════════════════════
        ██  SECTION 2 — FLOATING STATS BAR
        ══════════════════════════════════════════════════ */
        .cs-stats-wrap {
            position:relative; z-index:20;
            max-width:1000px; margin:-30px auto 0;
            padding:0 24px;
        }
        .cs-stats-card {
            background: rgba(13,8,32,0.92);
            backdrop-filter:blur(20px);
            border:1px solid var(--cosmic-border);
            border-radius:16px;
            display:flex; overflow:hidden;
            box-shadow:0 20px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(245,200,66,0.05);
        }
        .cs-stat {
            flex:1; padding:30px 20px;
            text-align:center; border-right:1px solid var(--cosmic-border);
            transition:background 0.3s;
        }
        .cs-stat:last-child { border-right:none; }
        .cs-stat:hover { background:rgba(245,200,66,0.05); }
        .cs-stat-n {
            font-family:'Cormorant Garamond',serif;
            font-size:40px; font-weight:700;
            color:var(--gold); line-height:1;
            text-shadow:0 0 20px rgba(245,200,66,0.4);
            margin-bottom:7px;
        }
        .cs-stat-l {
            font-size:11px; letter-spacing:1.5px;
            text-transform:uppercase; color:var(--text-dim); font-weight:600;
        }

        /* ══════════════════════════════════════════════════
        ██  CONTENT WRAPPER
        ══════════════════════════════════════════════════ */
        .cs-content {
            position:relative; z-index:20;
            max-width:1100px; margin:0 auto;
            padding:80px 32px 100px;
        }

        /* ══════════════════════════════════════════════════
        ██  SECTION 3 — ABOUT (2-col layout)
            RIGHT: mystical hands / cosmic BG
        ══════════════════════════════════════════════════ */
        .cs-about-grid {
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:40px;
            align-items:center;
        }
        .cs-about-image {
            border-radius:20px; overflow:hidden;
            position:relative;
            box-shadow:0 20px 60px rgba(0,0,0,0.6);
        }
        .cs-about-image img {
            width:100%; height:420px; object-fit:cover; display:block;
        }
        /* Gold frame lines */
        .cs-about-image::before {
            content:''; position:absolute;
            top:16px; left:16px; right:16px; bottom:16px;
            border:1px solid rgba(245,200,66,0.25);
            border-radius:12px; pointer-events:none; z-index:2;
        }
        /* Gradient overlay on image */
        .cs-about-image::after {
            content:''; position:absolute; inset:0;
            background:linear-gradient(135deg, transparent 50%, rgba(76,29,149,0.4) 100%);
        }
        .cs-about-badge {
            position:absolute; bottom:28px; left:28px; z-index:3;
            background:rgba(13,8,32,0.9); backdrop-filter:blur(12px);
            border:1px solid var(--cosmic-border);
            border-radius:12px; padding:16px 20px;
        }
        .cs-about-badge-num {
            font-family:'Cormorant Garamond',serif;
            font-size:34px; font-weight:700; color:var(--gold); line-height:1;
        }
        .cs-about-badge-lbl { font-size:12px; color:var(--text-dim); margin-top:4px; }

        .cs-about-text {
            font-size:16px; color:rgba(196,181,253,0.85);
            line-height:1.9;
        }
        .cs-about-features {
            display:grid; grid-template-columns:1fr 1fr; gap:16px;
            margin-top:32px;
        }
        .cs-about-feat {
            display:flex; gap:12px; align-items:flex-start;
            padding:16px 18px;
            background:rgba(255,255,255,0.03);
            border:1px solid var(--cosmic-border);
            border-radius:12px; transition:all 0.3s;
        }
        .cs-about-feat:hover { background:rgba(245,200,66,0.05); border-color:rgba(245,200,66,0.3); }
        .cs-about-feat-icon {
            width:38px; height:38px; flex-shrink:0;
            background:rgba(245,200,66,0.12); border-radius:8px;
            display:flex; align-items:center; justify-content:center;
            color:var(--gold); font-size:16px;
        }
        .cs-about-feat-title { font-size:14px; font-weight:700; color:var(--text-bright); margin-bottom:3px; }
        .cs-about-feat-desc { font-size:12px; color:var(--text-dim); line-height:1.5; }

        /* ══════════════════════════════════════════════════
        ██  SECTION 4 — SERVICES
            Each card has a unique photo at top
        ══════════════════════════════════════════════════ */
        .cs-services-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill, minmax(300px,1fr));
            gap:24px;
        }
        .cs-svc-card {
            background: var(--cosmic-card);
            border:1px solid var(--cosmic-border);
            border-radius:18px; overflow:hidden;
            transition:all 0.4s; position:relative;
            backdrop-filter:blur(10px);
        }
        .cs-svc-card:hover {
            transform:translateY(-8px);
            border-color:rgba(245,200,66,0.4);
            box-shadow:0 24px 60px rgba(0,0,0,0.6), 0 0 30px rgba(245,200,66,0.1);
        }
        /* Photo header of each service card */
        .cs-svc-img {
            width:100%; height:160px; object-fit:cover; display:block;
            transition:transform 0.5s;
        }
        .cs-svc-card:hover .cs-svc-img { transform:scale(1.05); }
        .cs-svc-img-wrap {
            overflow:hidden; position:relative;
        }
        .cs-svc-img-wrap::after {
            content:''; position:absolute; inset:0;
            background:linear-gradient(0deg, rgba(13,8,32,1) 0%, transparent 60%);
        }
        .cs-svc-body { padding:22px 24px 26px; }
        .cs-svc-icon-row {
            display:flex; justify-content:space-between; align-items:center;
            margin-bottom:14px; margin-top:-30px; position:relative; z-index:2;
        }
        .cs-svc-ico {
            width:52px; height:52px;
            background:linear-gradient(135deg,var(--gold),var(--gold-dim));
            border-radius:14px; border:3px solid var(--cosmic-dark);
            display:flex; align-items:center; justify-content:center;
            color:white; font-size:22px;
            box-shadow:0 4px 16px rgba(245,200,66,0.4);
        }
        .cs-svc-tag {
            font-size:11px; font-weight:700;
            background:rgba(20,184,166,0.15); color:var(--teal);
            border:1px solid rgba(20,184,166,0.3);
            padding:4px 10px; border-radius:20px;
        }
        .cs-svc-name {
            font-family:'Cormorant Garamond',serif;
            font-size:22px; font-weight:600; color:var(--text-bright);
            margin-bottom:8px;
        }
        .cs-svc-desc {
            font-size:13px; color:var(--text-dim); line-height:1.65;
            margin-bottom:16px;
        }
        .cs-svc-footer {
            display:flex; align-items:center; justify-content:space-between;
            padding-top:16px; border-top:1px solid rgba(255,255,255,0.06);
        }
        .cs-svc-price {
            font-family:'Cormorant Garamond',serif;
            font-size:26px; font-weight:700; color:var(--gold);
        }
        .cs-svc-dur {
            display:flex; align-items:center; gap:5px;
            font-size:12px; color:var(--text-dim);
        }

        /* ══════════════════════════════════════════════════
        ██  SECTION 5 — FULL-WIDTH CTA IMMERSIVE
            BG: nebula / deep space image
        ══════════════════════════════════════════════════ */
        .cs-cta-section {
            position:relative; margin:0 -32px;
            padding:100px 32px;
            text-align:center; overflow:hidden;

            background-image:
                radial-gradient(ellipse at center, rgba(124,58,237,0.6) 0%, transparent 70%),
                linear-gradient(0deg, var(--cosmic-dark) 0%, transparent 30%,transparent 70%, var(--cosmic-dark) 100%),
                url('https://images.unsplash.com/photo-1462331940025-496dfbfc7564?w=1920&q=80');
            background-size:cover; background-position:center;
            background-attachment:fixed;
        }
        .cs-cta-section::before {
            content:''; position:absolute; inset:0; z-index:0;
            background:rgba(5,3,17,0.55);
        }
        .cs-cta-inner { position:relative; z-index:1; max-width:700px; margin:0 auto; }
        .cs-cta-symbol {
            font-size:56px; margin-bottom:20px;
            filter:drop-shadow(0 0 20px rgba(245,200,66,0.6));
            animation:orb-pulse 3s ease-in-out infinite alternate;
        }
        .cs-cta-title {
            font-family:'Cormorant Garamond',serif;
            font-size:52px; font-weight:700; color:var(--text-bright);
            line-height:1.15; margin-bottom:16px;
            text-shadow:0 0 40px rgba(245,200,66,0.3);
        }
        .cs-cta-title em { color:var(--gold); font-style:italic; }
        .cs-cta-sub {
            font-size:17px; color:rgba(255,255,255,0.7);
            line-height:1.8; margin-bottom:40px;
        }
        .cs-cta-btns { display:flex; gap:16px; justify-content:center; flex-wrap:wrap; }

        /* ══════════════════════════════════════════════════
        ██  SECTION 6 — WHY CHOOSE ME
            4 feature boxes
        ══════════════════════════════════════════════════ */
        .cs-why-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(230px,1fr));
            gap:20px;
        }
        .cs-why-box {
            padding:32px 28px;
            background:var(--cosmic-card);
            border:1px solid var(--cosmic-border);
            border-radius:16px; text-align:center;
            backdrop-filter:blur(10px);
            transition:all 0.35s; position:relative; overflow:hidden;
        }
        .cs-why-box::before {
            content:''; position:absolute; inset:0;
            background: radial-gradient(circle at 50% 0%, rgba(245,200,66,0.06), transparent 70%);
            opacity:0; transition:opacity 0.35s;
        }
        .cs-why-box:hover { transform:translateY(-6px); border-color:rgba(245,200,66,0.35); box-shadow:0 16px 40px rgba(0,0,0,0.5); }
        .cs-why-box:hover::before { opacity:1; }
        .cs-why-ico {
            width:64px; height:64px;
            margin:0 auto 20px;
            border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            font-size:28px;
        }
        .cs-why-ico.g { background:rgba(245,200,66,0.12); color:var(--gold); }
        .cs-why-ico.p { background:rgba(124,58,237,0.15); color:#a78bfa; }
        .cs-why-ico.t { background:rgba(20,184,166,0.12); color:var(--teal); }
        .cs-why-ico.r { background:rgba(239,68,68,0.12); color:#f87171; }
        .cs-why-title {
            font-family:'Cormorant Garamond',serif;
            font-size:20px; font-weight:600;
            color:var(--text-bright); margin-bottom:10px;
        }
        .cs-why-desc { font-size:13px; color:var(--text-dim); line-height:1.7; }

        /* ══════════════════════════════════════════════════
        ██  SECTION 7 — CONSULTATIONS
            BG: mystical hands / candlelight
        ══════════════════════════════════════════════════ */
        .cs-consult-card {
            padding:40px;
            border-radius:20px; position:relative; overflow:hidden;
            border:1px solid var(--cosmic-border);
            background-image:
                linear-gradient(135deg,rgba(13,8,32,0.97) 0%,rgba(30,10,60,0.94) 100%),
                url('https://images.unsplash.com/photo-1635674234813-f2e0d4e08f9b?w=1200&q=60');
            background-size:cover; background-position:center;
        }
        .cs-consult-list { display:grid; gap:14px; }
        .cs-consult-item {
            display:flex; gap:16px; align-items:center;
            padding:20px 24px;
            background:rgba(255,255,255,0.04);
            border:1px solid var(--cosmic-border);
            border-left:4px solid var(--gold);
            border-radius:12px; transition:all 0.3s;
        }
        .cs-consult-item:hover { background:rgba(245,200,66,0.05); transform:translateX(4px); }
        .cs-consult-ico {
            width:48px; height:48px; flex-shrink:0;
            background:linear-gradient(135deg,var(--teal),#0d9488);
            border-radius:50%; display:flex; align-items:center; justify-content:center;
            color:white; font-size:18px;
        }
        .cs-consult-name { font-size:15px; font-weight:700; color:var(--text-bright); margin-bottom:4px; }
        .cs-consult-meta { font-size:13px; color:var(--text-dim); }

        /* ══════════════════════════════════════════════════
        ██  SECTION 8 — CONTACT
            BG: temple night / starlit BG
        ══════════════════════════════════════════════════ */
        .cs-contact-section {
            padding:56px;
            border-radius:20px; overflow:hidden;
            position:relative;
            background-image:
                linear-gradient(135deg, rgba(5,3,17,0.97) 0%, rgba(20,10,50,0.94) 100%),
                url('https://images.unsplash.com/photo-1534796636912-3b95b3ab5986?w=1200&q=60');
            background-size:cover; background-position:center;
            border:1px solid var(--cosmic-border);
        }
        .cs-contact-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
            gap:16px;
        }
        .cs-contact-item {
            display:flex; gap:16px; align-items:center;
            padding:22px 24px;
            background:rgba(255,255,255,0.04);
            border:1px solid var(--cosmic-border);
            border-radius:14px; transition:all 0.3s;
            text-decoration:none; color:inherit;
        }
        .cs-contact-item:hover {
            background:rgba(245,200,66,0.06);
            border-color:rgba(245,200,66,0.35);
            transform:translateY(-3px);
        }
        .cs-contact-ico {
            width:52px; height:52px; flex-shrink:0;
            background:linear-gradient(135deg,var(--gold),var(--gold-dim));
            border-radius:12px; display:flex; align-items:center; justify-content:center;
            color:#1a0e00; font-size:20px;
            box-shadow:0 6px 16px rgba(245,200,66,0.35);
        }
        .cs-contact-lbl { font-size:11px; color:var(--text-dim); text-transform:uppercase; letter-spacing:1px; margin-bottom:5px; }
        .cs-contact-val { font-size:15px; font-weight:700; color:var(--text-bright); }

        /* ══════════════════════════════════════════════════
        ██  SECTION 9 — SOCIAL
        ══════════════════════════════════════════════════ */
        .cs-social-wrap {
            text-align:center; padding:50px 40px;
            background:var(--cosmic-card);
            border:1px solid var(--cosmic-border);
            border-radius:20px;
            backdrop-filter:blur(10px);
        }
        .cs-social-title {
            font-family:'Cormorant Garamond',serif;
            font-size:32px; font-weight:600; color:var(--text-bright); margin-bottom:8px;
        }
        .cs-social-sub { font-size:13px; color:var(--text-dim); letter-spacing:1.5px; text-transform:uppercase; margin-bottom:28px; }
        .cs-social-links { display:flex; justify-content:center; gap:14px; flex-wrap:wrap; }
        .cs-soc-btn {
            display:flex; align-items:center; gap:9px;
            padding:12px 22px; border-radius:10px;
            text-decoration:none; font-size:14px; font-weight:700;
            color:white; transition:all 0.3s;
        }
        .cs-soc-btn:hover { transform:translateY(-4px); }
        .soc-fb { background:#1877f2; box-shadow:0 6px 16px rgba(24,119,242,0.35); }
        .soc-ig { background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); box-shadow:0 6px 16px rgba(220,39,67,0.35); }
        .soc-li { background:#0077b5; box-shadow:0 6px 16px rgba(0,119,181,0.35); }
        .soc-yt { background:#ff0000; box-shadow:0 6px 16px rgba(255,0,0,0.3); }
        .soc-tw { background:#1da1f2; box-shadow:0 6px 16px rgba(29,161,242,0.3); }
        .soc-wa { background:#25d366; box-shadow:0 6px 16px rgba(37,211,102,0.3); }

        /* ══════════════════════════════════════════════════
           FOOTER SIGNATURE
        ══════════════════════════════════════════════════ */
        .cs-footer {
            text-align:center; padding:40px 24px 60px;
            border-top:1px solid var(--cosmic-border);
            margin-top:60px;
        }
        .cs-footer-name {
            font-family:'Cormorant Garamond',serif;
            font-size:28px; color:var(--text-bright); margin-bottom:6px;
        }
        .cs-footer-sub { font-size:12px; color:var(--text-dim); letter-spacing:2px; text-transform:uppercase; }

        /* ══════════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════════ */
        @media (max-width:900px) {
            .cs-name { font-size:46px; }
            .cs-about-grid { grid-template-columns:1fr; }
            .cs-about-image { order:-1; }
            .cs-cta-section { margin:0 -18px; padding:70px 18px; }
            .cs-cta-title { font-size:36px; }
        }
        @media (max-width:640px) {
            .cs-name { font-size:36px; }
            .cs-content { padding:60px 18px 80px; }
            .cs-stats-card { flex-wrap:wrap; }
            .cs-stat { min-width:50%; border-bottom:1px solid var(--cosmic-border); }
            .cs-services-grid { grid-template-columns:1fr; }
            .cs-why-grid { grid-template-columns:1fr 1fr; }
            .cs-contact-section { padding:32px 20px; }
            .cs-about-features { grid-template-columns:1fr; }
            .star-field { display:none; }
        }
    </style>
</head>
<body>

    <!-- Fixed star field -->
    <div class="star-field" aria-hidden="true"></div>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> Preview Mode — <a href="{{ url('/signin') }}">Sign up</a> to publish your mystical profile!
    </div>
    @endif

    <!-- ════════════════════════════════════════════════════
         SECTION 1 — FULL SCREEN HERO (Galaxy BG)
    ════════════════════════════════════════════════════ -->
    <section class="cs-hero">
        <div class="cs-hero-inner">

            <!-- Profile Photo with zodiac rings -->
            @if($userdata->isFeatureVisible('profile_photo'))
            <div class="cs-photo-wrap">
                <div class="cs-zodiac-ring"></div>
                <div class="cs-ring-2"></div>
                <div class="cs-photo-circle">
                    @if($userdata->profile)
                        <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}" alt="{{ $userdata->name }}">
                    @else
                        <div class="cs-photo-placeholder"><i class="fas fa-star"></i></div>
                    @endif
                </div>
                <div class="cs-glow-orb o1"></div>
                <div class="cs-glow-orb o2"></div>
            </div>
            @endif

            <!-- Badge -->
            <div class="cs-certified">
                <i class="fas fa-moon"></i> Certified Vedic Astrologer
            </div>

            <!-- Name -->
            @if($userdata->isFeatureVisible('name'))
            @php
                $parts = explode(' ', $userdata->name ?? 'Astrologer');
                $first = array_shift($parts);
            @endphp
            <h1 class="cs-name">
                <em>{{ $first }}</em>{{ count($parts) ? ' '.implode(' ',$parts) : '' }}
            </h1>
            @endif

            <!-- Designation -->
            @if($userdata->isFeatureVisible('designation') && $userdata->desig)
            <div class="cs-title">
                <div class="cs-title-dot"></div>
                {{ $userdata->desig }}
                <div class="cs-title-dot"></div>
            </div>
            @endif

            <!-- Pills -->
            <div class="cs-pills">
                <div class="cs-pill"><i class="fas fa-star"></i> Vedic Astrology</div>
                <div class="cs-pill"><i class="fas fa-compass"></i> Vastu Shastra</div>
                <div class="cs-pill"><i class="fas fa-gem"></i> Gemstone Therapy</div>
                <div class="cs-pill"><i class="fas fa-infinity"></i> Numerology</div>
                @if($userdata->city)
                <div class="cs-pill"><i class="fas fa-location-dot"></i> {{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                @endif
            </div>

            <!-- CTA Buttons -->
            <div class="cs-hero-btns">
                @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="cs-btn cs-btn-gold">
                    <i class="fas fa-phone"></i> Book Consultation
                </a>
                @endif
                @if($userdata->isFeatureVisible('whatsapp_chat') && isset($social) && $social && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="cs-btn cs-btn-teal">
                    <i class="fab fa-whatsapp"></i> WhatsApp Me
                </a>
                @endif
                <a href="#services" class="cs-btn cs-btn-ghost">
                    <i class="fas fa-wand-sparkles"></i> View Services
                </a>
            </div>
        </div>

        <!-- Scroll hint -->
        <div class="cs-scroll-hint" aria-hidden="true">
            <span>Scroll to explore</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════
         SECTION 2 — STATS BAR (floating card)
    ════════════════════════════════════════════════════ -->
    <div class="cs-stats-wrap">
        <div class="cs-stats-card">
            @php
                $serviceCount = isset($astroServices)      ? $astroServices->count()     : 0;
                $consultCount = isset($astroConsultations) ? $astroConsultations->count() : 0;
                $reportCount  = isset($astroReports)       ? $astroReports->count()       : 0;
            @endphp
            <div class="cs-stat">
                <div class="cs-stat-n">{{ $consultCount > 0 ? $consultCount : '500+' }}</div>
                <div class="cs-stat-l">Consultations</div>
            </div>
            <div class="cs-stat">
                <div class="cs-stat-n">{{ $reportCount > 0 ? $reportCount : '1K+' }}</div>
                <div class="cs-stat-l">Horoscopes</div>
            </div>
            <div class="cs-stat">
                <div class="cs-stat-n">15+</div>
                <div class="cs-stat-l">Yrs Experience</div>
            </div>
            <div class="cs-stat">
                <div class="cs-stat-n">100%</div>
                <div class="cs-stat-l">Satisfaction</div>
            </div>
        </div>
    </div>

    <!-- ════════════════════════════════════════════════════
         MAIN CONTENT
    ════════════════════════════════════════════════════ -->
    <div class="cs-content">

        <!-- ════ ABOUT ME ════ -->
        @if($userdata->isFeatureVisible('bio') && $userdata->about_us)
        <div class="astro-divider">
            <div class="astro-divider-line"></div>
            <div class="astro-divider-symbol"><i class="fas fa-star-of-life"></i> About Me</div>
            <div class="astro-divider-line"></div>
        </div>

        <div class="cs-about-grid">
            <div>
                <div class="section-eyebrow"><i class="fas fa-moon"></i> My Story</div>
                <h2 class="section-heading">Guided by the <em>Stars</em></h2>
                <p class="cs-about-text">{{ $userdata->about_us }}</p>
                <div class="cs-about-features">
                    <div class="cs-about-feat">
                        <div class="cs-about-feat-icon"><i class="fas fa-scroll"></i></div>
                        <div>
                            <div class="cs-about-feat-title">Vedic Expertise</div>
                            <div class="cs-about-feat-desc">Deep knowledge in classical Jyotish Shastra</div>
                        </div>
                    </div>
                    <div class="cs-about-feat">
                        <div class="cs-about-feat-icon"><i class="fas fa-compass"></i></div>
                        <div>
                            <div class="cs-about-feat-title">Vastu Certified</div>
                            <div class="cs-about-feat-desc">Balancing energy in homes &amp; workspaces</div>
                        </div>
                    </div>
                    <div class="cs-about-feat">
                        <div class="cs-about-feat-icon"><i class="fas fa-gem"></i></div>
                        <div>
                            <div class="cs-about-feat-title">Gemstone Therapy</div>
                            <div class="cs-about-feat-desc">Personalized stones aligned to your chart</div>
                        </div>
                    </div>
                    <div class="cs-about-feat">
                        <div class="cs-about-feat-icon"><i class="fas fa-calculator"></i></div>
                        <div>
                            <div class="cs-about-feat-title">Numerology</div>
                            <div class="cs-about-feat-desc">Discover your destiny through numbers</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right: astrology/mystical image -->
            <div class="cs-about-image">
                <img src="https://images.unsplash.com/photo-1602524816505-618e9b21e28d?w=800&q=80" alt="Astrology">
                <div class="cs-about-badge">
                    <div class="cs-about-badge-num">15+</div>
                    <div class="cs-about-badge-lbl">Years of Cosmic Guidance</div>
                </div>
            </div>
        </div>
        @endif

        <!-- ════ SERVICES ════ -->
        <div id="services">
            <div class="astro-divider">
                <div class="astro-divider-line"></div>
                <div class="astro-divider-symbol"><i class="fas fa-wand-sparkles"></i> Mystical Services</div>
                <div class="astro-divider-line"></div>
            </div>

            <div style="text-align:center; margin-bottom:44px;">
                <div class="section-eyebrow" style="display:inline-flex;"><i class="fas fa-sparkles"></i> What I Offer</div>
                <h2 class="section-heading">Sacred <em>Services</em> for Your Soul</h2>
                <p class="section-sub" style="margin:0 auto;">
                    Each service is crafted with ancient wisdom and modern insight to illuminate your path forward.
                </p>
            </div>

            @php
                $svcImgs = [
                    'https://images.unsplash.com/photo-1419242902214-272b3f66ee7a?w=600&q=70',
                    'https://images.unsplash.com/photo-1506318137071-a8e063b4bec0?w=600&q=70',
                    'https://images.unsplash.com/photo-1464802686167-b939a6910659?w=600&q=70',
                    'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&q=70',
                    'https://images.unsplash.com/photo-1515775538093-d2d95c5c4668?w=600&q=70',
                    'https://images.unsplash.com/photo-1444703686981-a3abbc4d4fe3?w=600&q=70',
                ];
                $svcIcons = ['chart-line','compass','gem','calculator','infinity','star'];
                $svcTags  = ['Natal Chart','Vastu','Gemstone','Numerology','Karma','Predictions'];
            @endphp

            <div class="cs-services-grid">
                @if(isset($astroServices) && $astroServices->count() > 0)
                    @foreach($astroServices->take(6) as $idx => $service)
                    <div class="cs-svc-card">
                        <div class="cs-svc-img-wrap">
                            <img class="cs-svc-img"
                                 src="{{ $svcImgs[$idx % count($svcImgs)] }}"
                                 alt="{{ $service->service_name }}">
                        </div>
                        <div class="cs-svc-body">
                            <div class="cs-svc-icon-row">
                                <div class="cs-svc-ico"><i class="fas fa-{{ $svcIcons[$idx % count($svcIcons)] }}"></i></div>
                                <span class="cs-svc-tag">{{ $svcTags[$idx % count($svcTags)] }}</span>
                            </div>
                            <div class="cs-svc-name">{{ $service->service_name }}</div>
                            @if($service->description)
                            <div class="cs-svc-desc">{{ Str::limit($service->description, 90) }}</div>
                            @endif
                            <div class="cs-svc-footer">
                                @if($service->consultation_fee)
                                <div class="cs-svc-price">₹{{ number_format($service->consultation_fee) }}</div>
                                @endif
                                @if($service->consultation_duration_minutes)
                                <div class="cs-svc-dur"><i class="fas fa-clock"></i> {{ $service->consultation_duration_minutes }} min</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    {{-- Placeholders with real images --}}
                    <div class="cs-svc-card">
                        <div class="cs-svc-img-wrap">
                            <img class="cs-svc-img" src="https://images.unsplash.com/photo-1419242902214-272b3f66ee7a?w=600&q=70" alt="Birth Chart">
                        </div>
                        <div class="cs-svc-body">
                            <div class="cs-svc-icon-row">
                                <div class="cs-svc-ico"><i class="fas fa-chart-line"></i></div>
                                <span class="cs-svc-tag">Natal Chart</span>
                            </div>
                            <div class="cs-svc-name">Birth Chart Reading</div>
                            <div class="cs-svc-desc">Detailed natal chart analysis with planetary positions, dashas and precise life predictions.</div>
                            <div class="cs-svc-footer">
                                <div class="cs-svc-price">₹1,500</div>
                                <div class="cs-svc-dur"><i class="fas fa-clock"></i> 60 min</div>
                            </div>
                        </div>
                    </div>
                    <div class="cs-svc-card">
                        <div class="cs-svc-img-wrap">
                            <img class="cs-svc-img" src="https://images.unsplash.com/photo-1506318137071-a8e063b4bec0?w=600&q=70" alt="Vastu">
                        </div>
                        <div class="cs-svc-body">
                            <div class="cs-svc-icon-row">
                                <div class="cs-svc-ico"><i class="fas fa-compass"></i></div>
                                <span class="cs-svc-tag">Vastu</span>
                            </div>
                            <div class="cs-svc-name">Vastu Consultation</div>
                            <div class="cs-svc-desc">Transform your home or office into a space of prosperity and harmony with Vastu principles.</div>
                            <div class="cs-svc-footer">
                                <div class="cs-svc-price">₹2,500</div>
                                <div class="cs-svc-dur"><i class="fas fa-clock"></i> 90 min</div>
                            </div>
                        </div>
                    </div>
                    <div class="cs-svc-card">
                        <div class="cs-svc-img-wrap">
                            <img class="cs-svc-img" src="https://images.unsplash.com/photo-1464802686167-b939a6910659?w=600&q=70" alt="Gemstone">
                        </div>
                        <div class="cs-svc-body">
                            <div class="cs-svc-icon-row">
                                <div class="cs-svc-ico"><i class="fas fa-gem"></i></div>
                                <span class="cs-svc-tag">Gemstone</span>
                            </div>
                            <div class="cs-svc-name">Gemstone Therapy</div>
                            <div class="cs-svc-desc">Personalized gemstone recommendations aligned with your birth chart and planetary energies.</div>
                            <div class="cs-svc-footer">
                                <div class="cs-svc-price">₹800</div>
                                <div class="cs-svc-dur"><i class="fas fa-clock"></i> 45 min</div>
                            </div>
                        </div>
                    </div>
                    <div class="cs-svc-card">
                        <div class="cs-svc-img-wrap">
                            <img class="cs-svc-img" src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&q=70" alt="Numerology">
                        </div>
                        <div class="cs-svc-body">
                            <div class="cs-svc-icon-row">
                                <div class="cs-svc-ico"><i class="fas fa-calculator"></i></div>
                                <span class="cs-svc-tag">Numerology</span>
                            </div>
                            <div class="cs-svc-name">Numerology Reading</div>
                            <div class="cs-svc-desc">Unlock life's blueprint through the mystical science of numbers and their cosmic vibrations.</div>
                            <div class="cs-svc-footer">
                                <div class="cs-svc-price">₹1,000</div>
                                <div class="cs-svc-dur"><i class="fas fa-clock"></i> 45 min</div>
                            </div>
                        </div>
                    </div>
                    <div class="cs-svc-card">
                        <div class="cs-svc-img-wrap">
                            <img class="cs-svc-img" src="https://images.unsplash.com/photo-1515775538093-d2d95c5c4668?w=600&q=70" alt="Marriage Prediction">
                        </div>
                        <div class="cs-svc-body">
                            <div class="cs-svc-icon-row">
                                <div class="cs-svc-ico"><i class="fas fa-heart"></i></div>
                                <span class="cs-svc-tag">Compatibility</span>
                            </div>
                            <div class="cs-svc-name">Kundali Matching</div>
                            <div class="cs-svc-desc">Comprehensive horoscope matching for marriage compatibility, Mangal dosha &amp; remedies.</div>
                            <div class="cs-svc-footer">
                                <div class="cs-svc-price">₹1,200</div>
                                <div class="cs-svc-dur"><i class="fas fa-clock"></i> 60 min</div>
                            </div>
                        </div>
                    </div>
                    <div class="cs-svc-card">
                        <div class="cs-svc-img-wrap">
                            <img class="cs-svc-img" src="https://images.unsplash.com/photo-1444703686981-a3abbc4d4fe3?w=600&q=70" alt="Career Astrology">
                        </div>
                        <div class="cs-svc-body">
                            <div class="cs-svc-icon-row">
                                <div class="cs-svc-ico"><i class="fas fa-briefcase"></i></div>
                                <span class="cs-svc-tag">Career</span>
                            </div>
                            <div class="cs-svc-name">Career Astrology</div>
                            <div class="cs-svc-desc">Discover your ideal career path and the best timing for professional growth using your chart.</div>
                            <div class="cs-svc-footer">
                                <div class="cs-svc-price">₹1,100</div>
                                <div class="cs-svc-dur"><i class="fas fa-clock"></i> 50 min</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- ════ WHY CHOOSE ME ════ -->
        <div class="astro-divider">
            <div class="astro-divider-line"></div>
            <div class="astro-divider-symbol"><i class="fas fa-star-of-life"></i> Why Choose Me</div>
            <div class="astro-divider-line"></div>
        </div>

        <div style="text-align:center; margin-bottom:40px;">
            <div class="section-eyebrow" style="display:inline-flex;"><i class="fas fa-award"></i> My Promise</div>
            <h2 class="section-heading">The <em>Cosmic</em> Difference</h2>
        </div>

        <div class="cs-why-grid">
            <div class="cs-why-box">
                <div class="cs-why-ico g"><i class="fas fa-scroll"></i></div>
                <div class="cs-why-title">Ancient Wisdom</div>
                <div class="cs-why-desc">Rooted in authentic Vedic texts — Brihat Parashara Hora Shastra and classical Jyotish tradition</div>
            </div>
            <div class="cs-why-box">
                <div class="cs-why-ico p"><i class="fas fa-eye"></i></div>
                <div class="cs-why-title">Precise Predictions</div>
                <div class="cs-why-desc">Chart-based predictions with clear timelines, not vague generalities — verified by thousands of clients</div>
            </div>
            <div class="cs-why-box">
                <div class="cs-why-ico t"><i class="fas fa-shield-halved"></i></div>
                <div class="cs-why-title">Remedy Focused</div>
                <div class="cs-why-desc">Practical, actionable remedies — mantras, gems, yantras — tailored to your specific chart</div>
            </div>
            <div class="cs-why-box">
                <div class="cs-why-ico r"><i class="fas fa-lock"></i></div>
                <div class="cs-why-title">100% Confidential</div>
                <div class="cs-why-desc">Your personal details and chart readings are completely private — absolute discretion guaranteed</div>
            </div>
        </div>

        <!-- ════ CONSULTATIONS ════ -->
        @if(isset($astroConsultations) && $astroConsultations->count() > 0)
        <div class="astro-divider">
            <div class="astro-divider-line"></div>
            <div class="astro-divider-symbol"><i class="fas fa-calendar-check"></i> Schedule</div>
            <div class="astro-divider-line"></div>
        </div>
        <div class="cs-consult-card">
            <div class="section-eyebrow"><i class="fas fa-user-clock"></i> Upcoming</div>
            <h2 class="section-heading" style="margin-bottom:28px;">Consultation <em>Sessions</em></h2>
            <div class="cs-consult-list">
                @foreach($astroConsultations->take(4) as $consultation)
                <div class="cs-consult-item">
                    <div class="cs-consult-ico"><i class="fas fa-user-clock"></i></div>
                    <div>
                        <div class="cs-consult-name">{{ $consultation->client_name ?? 'Consultation Session' }}</div>
                        <div class="cs-consult-meta">
                            {{ $consultation->consultation_mode ?? 'Online' }}
                            @if($consultation->appointment_date)
                                &nbsp;•&nbsp; {{ $consultation->appointment_date->format('d M Y') }}
                            @endif
                            @if($consultation->appointment_time)
                                &nbsp;•&nbsp; {{ $consultation->appointment_time }}
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- ════ CONTACT ════ -->
        @if($userdata->isFeatureVisible('contact_number') || $userdata->isFeatureVisible('email') || $userdata->isFeatureVisible('address'))
        <div class="astro-divider">
            <div class="astro-divider-line"></div>
            <div class="astro-divider-symbol"><i class="fas fa-envelope-open-text"></i> Connect</div>
            <div class="astro-divider-line"></div>
        </div>
        <div class="cs-contact-section">
            <div style="text-align:center; margin-bottom:36px;">
                <div class="section-eyebrow" style="display:inline-flex;"><i class="fas fa-satellite-dish"></i> Reach Me</div>
                <h2 class="section-heading">Begin Your <em>Journey</em> Today</h2>
            </div>
            <div class="cs-contact-grid">
                @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="cs-contact-item">
                    <div class="cs-contact-ico"><i class="fas fa-phone"></i></div>
                    <div>
                        <div class="cs-contact-lbl">Call for Consultation</div>
                        <div class="cs-contact-val">{{ $userdata->mobile }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->isFeatureVisible('email') && $userdata->email)
                <a href="mailto:{{ $userdata->email }}" class="cs-contact-item">
                    <div class="cs-contact-ico"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="cs-contact-lbl">Email Address</div>
                        <div class="cs-contact-val">{{ $userdata->email }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->isFeatureVisible('address') && ($userdata->address || $userdata->city))
                <div class="cs-contact-item">
                    <div class="cs-contact-ico"><i class="fas fa-location-dot"></i></div>
                    <div>
                        <div class="cs-contact-lbl">Office Location</div>
                        <div class="cs-contact-val">{{ $userdata->address ?? ($userdata->city.($userdata->state ? ', '.$userdata->state : '')) }}</div>
                    </div>
                </div>
                @endif
                @if(isset($social) && $social && $social->whatsapp)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$social->whatsapp) }}" target="_blank" class="cs-contact-item">
                    <div class="cs-contact-ico" style="background:linear-gradient(135deg,#25d366,#128c7e);"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <div class="cs-contact-lbl">WhatsApp Chat</div>
                        <div class="cs-contact-val">Chat with Me</div>
                    </div>
                </a>
                @endif
            </div>
        </div>
        @endif

        <!-- ════ SOCIAL ════ -->
        @if($userdata->isFeatureVisible('social_media'))
        <div class="astro-divider">
            <div class="astro-divider-line"></div>
            <div class="astro-divider-symbol"><i class="fas fa-share-nodes"></i> Follow</div>
            <div class="astro-divider-line"></div>
        </div>
        <div class="cs-social-wrap">
            <div class="cs-social-title">Follow My Cosmic Journey</div>
            <div class="cs-social-sub">Daily horoscopes, tips &amp; cosmic wisdom</div>
            <div class="cs-social-links">
                @if($userdata->isFeatureVisible('facebook') && isset($social->facebook) && $social->facebook)
                <a href="{{ $social->facebook }}" target="_blank" class="cs-soc-btn soc-fb">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                @endif
                @if($userdata->isFeatureVisible('instagram') && isset($social->instagram) && $social->instagram)
                <a href="{{ $social->instagram }}" target="_blank" class="cs-soc-btn soc-ig">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                @endif
                @if($userdata->isFeatureVisible('linkedin') && isset($social->linkedin) && $social->linkedin)
                <a href="{{ $social->linkedin }}" target="_blank" class="cs-soc-btn soc-li">
                    <i class="fab fa-linkedin-in"></i> LinkedIn
                </a>
                @endif
                @if(isset($social->youtube) && $social->youtube)
                <a href="{{ $social->youtube }}" target="_blank" class="cs-soc-btn soc-yt">
                    <i class="fab fa-youtube"></i> YouTube
                </a>
                @endif
                @if(isset($social->twitter) && $social->twitter)
                <a href="{{ $social->twitter }}" target="_blank" class="cs-soc-btn soc-tw">
                    <i class="fab fa-twitter"></i> Twitter
                </a>
                @endif
            </div>
        </div>
        @endif

    </div><!-- /cs-content -->

    <!-- ════ IMMERSIVE FULL-WIDTH CTA ════ -->
    <div class="cs-content" style="padding-top:0; padding-bottom:0;">
        <div class="cs-cta-section">
            <div class="cs-cta-inner">
               
                <h2 class="cs-cta-title">Begin Your <em>Cosmic Journey</em></h2>
                <p class="cs-cta-sub">
                    The stars hold answers to your deepest questions.<br>
                    Book a personal consultation and discover your true destiny.
                </p>
                <div class="cs-cta-btns">
                    @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="cs-btn cs-btn-gold" style="font-size:16px;padding:16px 36px;">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                    @endif
                    @if(isset($social) && $social && $social->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$social->whatsapp) }}" target="_blank" class="cs-btn cs-btn-teal" style="font-size:16px;padding:16px 36px;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER SIGNATURE -->
    <footer class="cs-footer">
        <div class="cs-footer-name">✦ {{ $userdata->name ?? 'Astrologer' }} ✦</div>
        <div class="cs-footer-sub">Vedic Astrologer &amp; Vastu Consultant &nbsp;•&nbsp; Illuminating Paths Since 2009</div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])
</body>
</html>