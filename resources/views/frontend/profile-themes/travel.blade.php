<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Travel Agent' }} - Luxury Travel & Tours</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ═══════════════════════════════════════════
           LUXURY TRAVEL — COLOR SYSTEM
        ═══════════════════════════════════════════ */
        :root {
            --navy:       #0d1b2a;
            --navy-mid:   #1a2e45;
            --gold:       #c9a84c;
            --gold-light: #e8c96a;
            --gold-pale:  #f7f0dc;
            --teal:       #0891b2;
            --teal-light: #38bdf8;
            --cream:      #fdf8f0;
            --white:      #ffffff;
            --text-dark:  #0f172a;
            --text-mid:   #475569;
            --text-light: #94a3b8;
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1524661135-423995f22d0b?w=1920&q=30');
            background-size: cover;
            background-position: center;
            opacity: 0.03;
            pointer-events: none;
            z-index: 0;
        }

        /* ═══════════════════════════════════════════
           PREVIEW BANNER
        ═══════════════════════════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg, var(--navy), var(--navy-mid));
            color: white;
            padding: 12px 20px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 2px solid var(--gold);
        }
        .preview-banner a { color: var(--gold); text-decoration: underline; font-weight: 700; margin-left: 8px; }

        /* ═══════════════════════════════════════════
           HERO BANNER
        ═══════════════════════════════════════════ */
        .hero-banner {
            position: relative;
            width: 100%;
            min-height: 560px;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
            z-index: 10;
            background-image:
                linear-gradient(to bottom, rgba(13,27,42,0.30) 0%, rgba(13,27,42,0.50) 50%, rgba(13,27,42,0.88) 100%),
                url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1920&q=85');
            background-size: cover;
            background-position: center 40%;
        }

        .hero-rays {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 30% 30%, rgba(201,168,76,0.08) 0%, transparent 65%);
            pointer-events: none;
        }

        .hero-wave {
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 90px;
            pointer-events: none;
        }
        .hero-wave svg { width:100%; height:100%; }

        .hero-accent-line {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .hero-inner {
            position: relative;
            z-index: 5;
            width: 100%;
            max-width: 1160px;
            margin: 0 auto;
            padding: 80px 32px 60px;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 22px;
            border: 1px solid rgba(201,168,76,0.5);
            border-radius: 30px;
            background: rgba(201,168,76,0.12);
            backdrop-filter: blur(8px);
            color: var(--gold-light);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }
        .hero-eyebrow-dot { width:6px; height:6px; background:var(--gold); border-radius:50%; animation:pulse-dot 2s ease-in-out infinite; }
        @keyframes pulse-dot { 0%,100%{opacity:1} 50%{opacity:.3} }

        .hero-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(42px, 7vw, 80px);
            font-weight: 600;
            color: white;
            line-height: 1.05;
            margin-bottom: 12px;
            letter-spacing: -1px;
        }
        .hero-name em { font-style: italic; color: var(--gold-light); }

        .hero-desig {
            font-size: 15px;
            color: rgba(255,255,255,0.75);
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 28px;
            font-weight: 400;
        }

        .hero-tags { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 36px; }
        .hero-tag {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.20);
            border-radius: 4px;
            font-size: 13px;
            color: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            font-weight: 500;
        }
        .hero-tag i { color: var(--gold); }

        .hero-btns { display:flex; flex-wrap:wrap; gap:14px; }
        .btn-gold {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--navy);
            font-size: 13px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; border-radius: 4px;
            text-decoration: none; transition: all .3s;
            box-shadow: 0 8px 30px rgba(201,168,76,0.4);
        }
        .btn-gold:hover { transform:translateY(-3px); box-shadow:0 14px 40px rgba(201,168,76,0.55); }
        .btn-outline-white {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 14px 28px; background: transparent; color: white;
            font-size: 13px; font-weight: 600; letter-spacing: 1px;
            text-transform: uppercase; border: 1.5px solid rgba(255,255,255,0.4);
            border-radius: 4px; text-decoration: none; transition: all .3s;
            backdrop-filter: blur(8px);
        }
        .btn-outline-white:hover { border-color: var(--gold); color: var(--gold); background: rgba(201,168,76,0.08); }
        .btn-whatsapp {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 14px 28px; background: rgba(37,211,102,0.15);
            color: #25d366; font-size: 13px; font-weight: 600; letter-spacing: 1px;
            text-transform: uppercase; border: 1.5px solid rgba(37,211,102,0.4);
            border-radius: 4px; text-decoration: none; transition: all .3s;
            backdrop-filter: blur(8px);
        }
        .btn-whatsapp:hover { background: rgba(37,211,102,0.25); color: #25d366; }

        .hero-stats-strip {
            display: flex; gap: 0;
            margin-top: 40px;
            border: 1px solid rgba(201,168,76,0.25);
            border-radius: 8px; overflow: hidden;
            backdrop-filter: blur(16px);
            background: rgba(13,27,42,0.55);
            max-width: 640px;
        }
        .hss-item { flex: 1; padding: 18px 20px; text-align: center; border-right: 1px solid rgba(255,255,255,0.08); }
        .hss-item:last-child { border-right: none; }
        .hss-num { font-family: 'Cormorant Garamond', serif; font-size: 32px; font-weight: 700; color: var(--gold-light); line-height: 1; margin-bottom: 4px; }
        .hss-label { font-size: 9px; color: rgba(255,255,255,0.55); text-transform: uppercase; letter-spacing: 1.5px; }

        /* ── Flying planes ── */
        .flying-plane { position: fixed; opacity: 0.10; z-index: 2; pointer-events: none; animation: fly-across 22s linear infinite; }
        .flying-plane-1 { top:18%; animation-delay:0s; }
        .flying-plane-2 { top:45%; animation-delay:9s; }
        .flying-plane-3 { top:70%; animation-delay:17s; }
        @keyframes fly-across { 0%{left:-100px;transform:rotate(-3deg);} 100%{left:calc(100% + 100px);transform:rotate(3deg);} }

        /* ═══════════════════════════════════════════
           PROFILE CARD
        ═══════════════════════════════════════════ */
        .profile-card-wrap {  ; position: relative; z-index: 30; max-width: 1160px; margin: -60px auto 0; padding: 0 32px; }

        .profile-glass-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            margin-top: 50px;
            box-shadow: 0 30px 80px rgba(13,27,42,0.18);
            border: 1px solid rgba(201,168,76,0.2);
            position: relative;
        }
        .profile-glass-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light), var(--teal), var(--gold));
            background-size: 200%;
            animation: border-shimmer 4s linear infinite;
        }
        @keyframes border-shimmer { from{background-position:0%} to{background-position:200%} }
        .profile-glass-card::after {
            content: ''; position: absolute; inset: 0;
            background-image: url('https://images.unsplash.com/photo-1524661135-423995f22d0b?w=1200&q=40');
            background-size: cover; background-position: center;
            opacity: 0.025; pointer-events: none;
        }

        .pgc-inner { position: relative; z-index: 2; display: flex; align-items: center; gap: 40px; padding: 40px 48px; }

        .pgc-photo-wrap { position: relative; flex-shrink: 0; }
        .pgc-photo-ring {
            width: 160px; height: 160px; padding: 4px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light), var(--teal));
            border-radius: 50%;
            box-shadow: 0 16px 48px rgba(201,168,76,0.35);
        }
        .pgc-photo { width: 100%; height: 100%; border-radius: 50%; overflow: hidden; background: var(--navy); }
        .pgc-photo img { width:100%; height:100%; object-fit:cover; }
        .pgc-photo-placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, var(--navy), var(--navy-mid)); color: var(--gold); font-size:52px; }

        .pgc-verified {
            position: absolute; bottom: 4px; right: 4px;
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: 50%; border: 3px solid white;
            display: flex; align-items:center; justify-content:center;
            color: var(--navy); font-size: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .pgc-info { flex:1; }
        .pgc-luxury-label { display: inline-flex; align-items: center; gap: 6px; font-size: 10px; letter-spacing: 3px; text-transform: uppercase; color: var(--gold); margin-bottom: 10px; font-weight: 700; }
        .pgc-name { font-family: 'Cormorant Garamond', serif; font-size: 40px; font-weight: 600; color: var(--navy); margin-bottom: 6px; letter-spacing: -0.5px; line-height: 1.1; }
        .pgc-desig { font-size: 14px; color: var(--text-mid); font-weight: 500; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px; }
        .pgc-location { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-light); margin-bottom: 24px; }
        .pgc-location i { color: var(--gold); }

        .pgc-actions { display:flex; flex-wrap:wrap; gap:12px; }
        .pgc-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 4px; font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; transition: all .3s; }
        .pgc-btn-primary { background: var(--navy); color: white; }
        .pgc-btn-primary:hover { background: var(--navy-mid); transform:translateY(-2px); box-shadow:0 8px 24px rgba(13,27,42,0.25); color:white; }
        .pgc-btn-gold { background: linear-gradient(135deg, var(--gold), var(--gold-light)); color: var(--navy); }
        .pgc-btn-gold:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(201,168,76,0.35); }
        .pgc-btn-wa { background: rgba(37,211,102,0.1); color: #16a34a; border: 1.5px solid rgba(37,211,102,0.3); }
        .pgc-btn-wa:hover { background: rgba(37,211,102,0.18); transform:translateY(-2px); }

        .gold-divider { width: 100%; height: 1px; background: linear-gradient(90deg, transparent, var(--gold), transparent); }

        .pgc-bio {
            padding: 28px 48px;
            background: linear-gradient(90deg, var(--gold-pale), white, var(--gold-pale));
            font-size: 17px;
            color: var(--text-mid);
            line-height: 1.9;
            font-style: italic;
            font-family: 'Cormorant Garamond', serif;
        }
        .pgc-bio-quote { color: var(--gold); font-size: 36px; line-height: 0; vertical-align: -12px; margin-right: 4px; }

        /* ═══ QUICK INFO ROW ═══ */
        .pgc-quick-info {
            display: flex;
            gap: 0;
            border-top: 1px solid rgba(201,168,76,0.12);
        }
        .pgc-qi-item {
            flex: 1;
            padding: 20px 24px;
            text-align: center;
            border-right: 1px solid rgba(201,168,76,0.1);
            position: relative;
        }
        .pgc-qi-item:last-child { border-right: none; }
        .pgc-qi-num { font-family: 'Cormorant Garamond', serif; font-size: 30px; font-weight: 700; color: var(--navy); }
        .pgc-qi-num sup { font-size: 14px; color: var(--gold); }
        .pgc-qi-lbl { font-size: 10px; color: var(--text-light); text-transform: uppercase; letter-spacing: 1.5px; margin-top: 3px; }

        /* ═══════════════════════════════════════════
           MAIN CONTENT WRAPPER
        ═══════════════════════════════════════════ */
        .main-wrap { position: relative; z-index: 10; max-width: 1160px; margin: 0 auto; padding: 0 32px 80px; }

        .lx-section-header { display: flex; align-items: center; gap: 20px; margin: 72px 0 36px; }
        .lxsh-ornament { display: flex; flex-direction: column; align-items: center; gap: 3px; flex-shrink: 0; }
        .lxsh-dot { width:6px; height:6px; background:var(--gold); border-radius:50%; }
        .lxsh-line { width:2px; height:30px; background: linear-gradient(180deg, var(--gold), transparent); }
        .lxsh-titles { flex:1; }
        .lxsh-eyebrow { font-size: 10px; color: var(--gold); text-transform: uppercase; letter-spacing: 3px; font-weight: 700; margin-bottom: 6px; }
        .lxsh-title { font-family: 'Cormorant Garamond', serif; font-size: clamp(28px, 4vw, 42px); font-weight: 600; color: var(--navy); line-height: 1.1; }
        .lxsh-title em { font-style: italic; color: var(--gold); }
        .lxsh-rule { flex: 1; height: 1px; background: linear-gradient(90deg, rgba(201,168,76,0.4), transparent); }

        /* ═══════════════════════════════════════════
           STATS ROW — Airplane wing sunset bg
        ═══════════════════════════════════════════ */
        .stats-row {
            margin-top: 56px;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            min-height: 200px;
            display: flex;
            align-items: center;
            background-image:
                linear-gradient(90deg, rgba(13,27,42,0.92) 0%, rgba(13,27,42,0.75) 50%, rgba(13,27,42,0.92) 100%),
                url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1920&q=80');
            background-size: cover;
            background-position: center 60%;
            box-shadow: 0 20px 60px rgba(13,27,42,0.25);
        }
        .stats-row::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gold),transparent); }
        .stats-row::after  { content:''; position:absolute; bottom:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gold),transparent); }
        .stats-row-inner { position:relative; z-index:2; width:100%; display:grid; grid-template-columns:repeat(5,1fr); gap:0; padding:40px 0; }
        .stat-lx { text-align:center; padding:20px 16px; border-right:1px solid rgba(255,255,255,0.08); }
        .stat-lx:last-child { border-right:none; }
        .stat-lx-icon { font-size:24px; color:var(--gold); margin-bottom:14px; opacity:0.85; }
        .stat-lx-num { font-family:'Cormorant Garamond',serif; font-size:44px; font-weight:700; color:white; line-height:1; margin-bottom:6px; }
        .stat-lx-num sup { font-size:20px; color:var(--gold-light); }
        .stat-lx-label { font-size:10px; color:rgba(255,255,255,0.5); text-transform:uppercase; letter-spacing:1.5px; }

        /* ═══════════════════════════════════════════
           DESTINATIONS GRID
        ═══════════════════════════════════════════ */
        .dest-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
        .dest-card { border-radius:12px; overflow:hidden; position:relative; cursor:pointer; box-shadow:0 12px 40px rgba(0,0,0,0.15); transition:all .4s cubic-bezier(.25,.8,.25,1); aspect-ratio:3/4; }
        .dest-card:hover { transform:translateY(-8px); box-shadow:0 24px 60px rgba(0,0,0,0.25); }
        .dest-card:nth-child(1) { grid-row:span 2; aspect-ratio:auto; min-height:500px; }
        .dest-bg { position:absolute; inset:0; background-size:cover; background-position:center; transition:transform .6s ease; }
        .dest-card:hover .dest-bg { transform:scale(1.06); }
        .dest-card:nth-child(1) .dest-bg { background-image:url('https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80'); }
        .dest-card:nth-child(2) .dest-bg { background-image:url('https://images.unsplash.com/photo-1499856871958-5b9627545d1a?w=800&q=80'); }
        .dest-card:nth-child(3) .dest-bg { background-image:url('https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=800&q=80'); }
        .dest-card:nth-child(4) .dest-bg { background-image:url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80'); }
        .dest-card:nth-child(5) .dest-bg { background-image:url('https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800&q=80'); }
        .dest-card:nth-child(6) .dest-bg { background-image:url('https://images.unsplash.com/photo-1531366936337-7c912a4589a7?w=800&q=80'); }
        .dest-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(13,27,42,0.90) 0%, rgba(13,27,42,0.30) 50%, transparent 100%); }
        .dest-content { position:absolute; bottom:0; left:0; right:0; padding:28px 24px; z-index:3; }
        .dest-badge { display:inline-block; padding:4px 14px; background:var(--gold); color:var(--navy); font-size:10px; font-weight:800; letter-spacing:2px; text-transform:uppercase; border-radius:2px; margin-bottom:10px; }
        .dest-name { font-family:'Cormorant Garamond',serif; font-size:26px; font-weight:600; color:white; line-height:1.2; margin-bottom:6px; }
        .dest-card:nth-child(1) .dest-name { font-size:34px; }
        .dest-desc { font-size:13px; color:rgba(255,255,255,0.75); line-height:1.6; margin-bottom:14px; }
        .dest-meta { display:flex; gap:16px; font-size:12px; color:rgba(255,255,255,0.6); }
        .dest-meta span { display:flex; align-items:center; gap:5px; }
        .dest-meta i { color:var(--gold); font-size:10px; }

        /* User portfolio grid */
        .user-dest-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
        .user-dest-card { border-radius:12px; overflow:hidden; position:relative; aspect-ratio:4/3; box-shadow:0 12px 40px rgba(0,0,0,0.15); transition:all .4s; }
        .user-dest-card:hover { transform:translateY(-6px); box-shadow:0 20px 50px rgba(0,0,0,0.22); }
        .user-dest-card img { width:100%; height:100%; object-fit:cover; transition:transform .5s; }
        .user-dest-card:hover img { transform:scale(1.05); }
        .user-dest-card .dest-overlay { background:linear-gradient(to top, rgba(13,27,42,0.85) 0%, transparent 60%); }
        .user-dest-card .dest-content { padding:20px; }

        /* ═══════════════════════════════════════════
           SERVICES — Luxury resort pool bg
        ═══════════════════════════════════════════ */
        .services-section { margin-top: 72px; }
        .services-bg-wrap {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            padding: 64px 48px;
            background-image:
                linear-gradient(135deg, rgba(13,27,42,0.94) 0%, rgba(13,27,42,0.88) 100%),
                url('https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1920&q=80');
            background-size: cover;
            background-position: center;
            box-shadow: 0 20px 60px rgba(13,27,42,0.2);
        }
        .services-bg-wrap::before { content:''; position:absolute; top:0;left:0;right:0; height:3px; background:linear-gradient(90deg, var(--gold), var(--gold-light), var(--teal), var(--gold)); }
        .lxsh-title-white { color:white; }
        .lxsh-title-white em { color:var(--gold-light); }
        .lxsh-eyebrow-white { color:var(--gold); }
        .services-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:20px; margin-top:40px; }
        .service-lx-card { background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.10); border-radius:12px; padding:32px 24px; text-align:center; transition:all .3s; backdrop-filter:blur(10px); position:relative; overflow:hidden; }
        .service-lx-card::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,var(--gold),transparent); transform:scaleX(0); transition:transform .3s; }
        .service-lx-card:hover::before { transform:scaleX(1); }
        .service-lx-card:hover { background:rgba(255,255,255,0.10); border-color:rgba(201,168,76,0.3); transform:translateY(-4px); }
        .srv-icon { width:64px; height:64px; border-radius:50%; border:1px solid rgba(201,168,76,0.4); display:flex; align-items:center; justify-content:center; font-size:26px; color:var(--gold); margin:0 auto 20px; background:rgba(201,168,76,0.08); }
        .srv-title { font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:600; color:white; margin-bottom:10px; }
        .srv-desc { font-size:13px; color:rgba(255,255,255,0.6); line-height:1.7; }

        /* ═══════════════════════════════════════════
           WHY CHOOSE US
        ═══════════════════════════════════════════ */
        .why-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:24px; }
        .why-card { background:white; border-radius:12px; padding:32px 28px; border:1px solid rgba(201,168,76,0.15); box-shadow:0 4px 24px rgba(13,27,42,0.07); transition:all .3s; position:relative; overflow:hidden; }
        .why-card::after { content:''; position:absolute; inset:0; background-image:url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=600&q=30'); background-size:cover; opacity:0; transition:opacity .3s; }
        .why-card:hover::after { opacity:0.04; }
        .why-card:hover { border-color:var(--gold); transform:translateY(-4px); box-shadow:0 12px 40px rgba(201,168,76,0.15); }
        .why-icon { width:56px; height:56px; background:linear-gradient(135deg, var(--gold-pale), #fef9ec); border:1px solid rgba(201,168,76,0.3); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:22px; color:var(--gold); margin-bottom:20px; position:relative; z-index:1; }
        .why-title { font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:600; color:var(--navy); margin-bottom:10px; position:relative; z-index:1; }
        .why-desc { font-size:13px; color:var(--text-mid); line-height:1.7; position:relative; z-index:1; }

        /* ═══════════════════════════════════════════
           PACKAGES
        ═══════════════════════════════════════════ */
        .packages-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(340px,1fr)); gap:24px; }
        .pkg-card { border-radius:16px; overflow:hidden; position:relative; box-shadow:0 16px 48px rgba(0,0,0,0.12); transition:all .4s; }
        .pkg-card:hover { transform:translateY(-6px); box-shadow:0 24px 64px rgba(0,0,0,0.2); }
        .pkg-img { height:220px; background-size:cover; background-position:center; position:relative; }
        .pkg-card:nth-child(1) .pkg-img { background-image:url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80'); }
        .pkg-card:nth-child(2) .pkg-img { background-image:url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&q=80'); }
        .pkg-card:nth-child(3) .pkg-img { background-image:url('https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800&q=80'); }
        .pkg-img-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(13,27,42,0.7), transparent 60%); }
        .pkg-badge-wrap { position:absolute; top:16px; left:16px; display:flex; gap:8px; }
        .pkg-badge { padding:5px 14px; background:var(--gold); color:var(--navy); font-size:10px; font-weight:800; letter-spacing:1.5px; text-transform:uppercase; border-radius:2px; }
        .pkg-badge-hot { background:#ef4444; color:white; }
        .pkg-img-title { position:absolute; bottom:16px; left:20px; font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:600; color:white; }
        .pkg-body { background:white; padding:24px; border:1px solid rgba(201,168,76,0.1); border-top:none; border-radius:0 0 16px 16px; }
        .pkg-features { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:18px; }
        .pkg-feature { display:flex; align-items:center; gap:5px; font-size:12px; color:var(--text-mid); }
        .pkg-feature i { color:var(--teal); font-size:10px; }
        .pkg-footer { display:flex; align-items:center; justify-content:space-between; padding-top:16px; border-top:1px solid #f1f5f9; }
        .pkg-price { font-family:'Cormorant Garamond',serif; }
        .pkg-price-from { font-size:11px; color:var(--text-light); text-transform:uppercase; letter-spacing:1px; }
        .pkg-price-num { font-size:28px; font-weight:700; color:var(--navy); }
        .pkg-price-num sup { font-size:14px; color:var(--gold); }
        .pkg-book-btn { display:inline-flex; align-items:center; gap:7px; padding:10px 22px; background:linear-gradient(135deg, var(--gold), var(--gold-light)); color:var(--navy); font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; border-radius:4px; text-decoration:none; transition:all .3s; }
        .pkg-book-btn:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(201,168,76,0.35); }

        /* ═══════════════════════════════════════════
           TESTIMONIALS
        ═══════════════════════════════════════════ */
        .testi-section {
            margin-top: 72px; padding: 64px 48px; border-radius: 20px;
            position: relative; overflow: hidden;
            background-image:
                linear-gradient(135deg, rgba(253,248,240,0.97) 0%, rgba(231,245,254,0.96) 100%),
                url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1920&q=50');
            background-size: cover; background-position: center;
            border: 1px solid rgba(201,168,76,0.15);
        }
        .testi-section::before { content:''; position:absolute; top:0;left:0;right:0; height:3px; background:linear-gradient(90deg, transparent, var(--gold), var(--teal), var(--gold), transparent); }
        .testi-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:24px; margin-top:40px; }
        .testi-card { background:white; border-radius:12px; padding:28px; box-shadow:0 8px 32px rgba(13,27,42,0.08); border:1px solid rgba(201,168,76,0.1); position:relative; transition:all .3s; }
        .testi-card:hover { transform:translateY(-4px); box-shadow:0 16px 48px rgba(13,27,42,0.12); border-color:rgba(201,168,76,0.3); }
        .testi-stars { color:var(--gold); font-size:13px; margin-bottom:14px; letter-spacing:2px; }
        .testi-quote-mark { font-size:60px; color:var(--gold-pale); font-family:Georgia,serif; line-height:0; position:absolute; top:20px; right:20px; opacity:0.5; }
        .testi-text { font-size:14px; color:var(--text-mid); line-height:1.8; margin-bottom:20px; font-style:italic; }
        .testi-author { display:flex; align-items:center; gap:14px; }
        .testi-avatar { width:46px; height:46px; border-radius:50%; background:linear-gradient(135deg, var(--navy), var(--navy-mid)); display:flex; align-items:center; justify-content:center; color:var(--gold); font-weight:700; font-size:16px; flex-shrink:0; }
        .testi-name { font-size:14px; font-weight:700; color:var(--navy); }
        .testi-trip { font-size:12px; color:var(--text-light); margin-top:2px; }
        .testi-trip i { color:var(--gold); margin-right:4px; }

        /* ═══════════════════════════════════════════
           QUALIFICATIONS / TIMELINE
        ═══════════════════════════════════════════ */
        .quali-timeline { position:relative; padding-left:32px; }
        .quali-timeline::before { content:''; position:absolute; left:10px; top:0; bottom:0; width:2px; background:linear-gradient(180deg, var(--gold), var(--teal), transparent); }
        .quali-item { position:relative; padding:0 0 36px 28px; }
        .quali-dot { position:absolute; left:-22px; top:4px; width:14px; height:14px; background:var(--gold); border-radius:50%; border:3px solid var(--cream); box-shadow:0 0 0 3px rgba(201,168,76,0.25); }
        .quali-year { font-size:11px; color:var(--gold); font-weight:700; letter-spacing:2px; text-transform:uppercase; margin-bottom:5px; }
        .quali-title-text { font-family:'Cormorant Garamond',serif; font-size:20px; font-weight:600; color:var(--navy); margin-bottom:5px; }
        .quali-institute { font-size:13px; color:var(--text-mid); }

        /* ═══════════════════════════════════════════
           VIDEO GALLERY
        ═══════════════════════════════════════════ */
        .video-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:24px; }
        .video-card { border-radius:12px; overflow:hidden; position:relative; aspect-ratio:16/9; cursor:pointer; box-shadow:0 12px 40px rgba(0,0,0,0.15); }
        .video-card iframe { width:100%; height:100%; border:none; }
        .video-card-thumb { position:relative; width:100%; height:100%; background:var(--navy); }
        .video-card-thumb img { width:100%; height:100%; object-fit:cover; }
        .video-play-btn { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(13,27,42,0.4); transition:background .3s; }
        .video-play-btn:hover { background:rgba(13,27,42,0.6); }
        .video-play-icon { width:60px; height:60px; background:linear-gradient(135deg, var(--gold), var(--gold-light)); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--navy); font-size:20px; padding-left:4px; box-shadow:0 8px 24px rgba(201,168,76,0.5); transition:transform .3s; }
        .video-play-btn:hover .video-play-icon { transform:scale(1.12); }

        /* ═══════════════════════════════════════════
           BOOKING CTA
        ═══════════════════════════════════════════ */
        .booking-cta {
            margin-top: 72px; border-radius: 20px; overflow: hidden;
            position: relative; min-height: 420px;
            display: flex; align-items: center; justify-content: center; text-align: center;
            background-image:
                linear-gradient(135deg, rgba(13,27,42,0.85) 0%, rgba(13,27,42,0.70) 50%, rgba(13,27,42,0.85) 100%),
                url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1920&q=85');
            background-size: cover; background-position: center 30%;
            box-shadow: 0 24px 72px rgba(13,27,42,0.25);
        }
        .booking-cta::before { content:''; position:absolute; top:0;left:0;right:0; height:3px; background:linear-gradient(90deg,transparent,var(--gold),transparent); }
        .booking-cta::after  { content:''; position:absolute; bottom:0;left:0;right:0; height:3px; background:linear-gradient(90deg,transparent,var(--teal),transparent); }
        .booking-dots { position:absolute; inset:0; background-image:radial-gradient(circle, rgba(201,168,76,0.15) 1px, transparent 1px); background-size:40px 40px; pointer-events:none; }
        .booking-cta-inner { position:relative; z-index:2; padding:72px 32px; max-width:700px; }
        .bcta-eyebrow { display:inline-block; padding:7px 22px; border:1px solid rgba(201,168,76,0.5); border-radius:30px; color:var(--gold-light); font-size:10px; letter-spacing:3px; text-transform:uppercase; font-weight:700; margin-bottom:24px; }
        .bcta-title { font-family:'Cormorant Garamond',serif; font-size:clamp(38px,6vw,62px); font-weight:600; color:white; line-height:1.1; margin-bottom:18px; }
        .bcta-title em { font-style:italic; color:var(--gold-light); }
        .bcta-sub { font-size:16px; color:rgba(255,255,255,0.75); line-height:1.7; margin-bottom:36px; }
        .bcta-btns { display:flex; justify-content:center; gap:14px; flex-wrap:wrap; }

        /* ═══════════════════════════════════════════
           CONTACT SECTION
        ═══════════════════════════════════════════ */
        .contact-grid-lx { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:20px; }
        .contact-lx-card { background:white; border-radius:12px; padding:32px; text-align:center; border:1px solid rgba(201,168,76,0.15); box-shadow:0 4px 24px rgba(13,27,42,0.07); transition:all .3s; position:relative; overflow:hidden; }
        .contact-lx-card::before { content:''; position:absolute; bottom:0;left:0;right:0; height:3px; background:linear-gradient(90deg,var(--gold),var(--teal)); transform:scaleX(0); transition:transform .3s; }
        .contact-lx-card:hover::before { transform:scaleX(1); }
        .contact-lx-card:hover { transform:translateY(-4px); box-shadow:0 16px 48px rgba(13,27,42,0.12); border-color:var(--gold); }
        .clx-icon { width:60px; height:60px; border-radius:50%; background:linear-gradient(135deg,var(--gold-pale),#fef9ec); border:1px solid rgba(201,168,76,0.3); display:flex; align-items:center; justify-content:center; font-size:22px; color:var(--gold); margin:0 auto 16px; }
        .clx-label { font-size:10px; color:var(--text-light); text-transform:uppercase; letter-spacing:2px; margin-bottom:8px; }
        .clx-val { font-size:16px; color:var(--navy); font-weight:700; }
        .clx-val a { color:var(--navy); text-decoration:none; }
        .clx-val a:hover { color:var(--gold); }

        /* ═══════════════════════════════════════════
           SOCIAL LINKS
        ═══════════════════════════════════════════ */
        .social-lx-row { display:flex; justify-content:center; gap:14px; flex-wrap:wrap; margin-top:40px; }
        .social-lx-btn { display:flex; align-items:center; gap:10px; padding:13px 24px; background:white; border:1px solid rgba(201,168,76,0.2); border-radius:4px; color:var(--navy); font-size:13px; font-weight:600; text-decoration:none; transition:all .3s; box-shadow:0 2px 12px rgba(0,0,0,0.06); }
        .social-lx-btn i { font-size:16px; }
        .social-lx-btn:hover { border-color:var(--gold); transform:translateY(-3px); box-shadow:0 8px 24px rgba(201,168,76,0.2); color:var(--navy); }
        .slb-ig:hover { color:#e1306c; border-color:#e1306c; }
        .slb-fb:hover { color:#1877f2; border-color:#1877f2; }
        .slb-yt:hover { color:#ff0000; border-color:#ff0000; }
        .slb-tw:hover { color:#1da1f2; border-color:#1da1f2; }
        .slb-li:hover { color:#0a66c2; border-color:#0a66c2; }

        /* ═══════════════════════════════════════════
           DOCUMENTS / UPLOAD FILES
        ═══════════════════════════════════════════ */
        .docs-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:20px; }
        .doc-card { background:white; border-radius:12px; padding:24px 28px; border:1px solid rgba(201,168,76,0.15); box-shadow:0 4px 20px rgba(13,27,42,0.07); display:flex; align-items:center; gap:18px; transition:all .3s; }
        .doc-card:hover { border-color:var(--gold); transform:translateY(-3px); box-shadow:0 12px 36px rgba(201,168,76,0.15); }
        .doc-icon { width:50px; height:50px; flex-shrink:0; background:linear-gradient(135deg,var(--gold-pale),#fef9ec); border:1px solid rgba(201,168,76,0.3); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:20px; color:var(--gold); }
        .doc-name { font-size:14px; font-weight:600; color:var(--navy); }
        .doc-sub { font-size:12px; color:var(--text-light); margin-top:2px; }
        .doc-dl-btn { margin-left:auto; color:var(--gold); font-size:18px; transition:transform .2s; }
        .doc-dl-btn:hover { transform:translateY(-2px); }

        /* ═══════════════════════════════════════════
           PRODUCTS
        ═══════════════════════════════════════════ */
        .products-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:24px; }
        .product-card { background:white; border-radius:12px; overflow:hidden; border:1px solid rgba(201,168,76,0.12); box-shadow:0 4px 24px rgba(13,27,42,0.07); transition:all .3s; }
        .product-card:hover { transform:translateY(-5px); box-shadow:0 16px 48px rgba(13,27,42,0.12); border-color:var(--gold); }
        .product-img { width:100%; height:200px; object-fit:cover; }
        .product-img-placeholder { width:100%; height:200px; background:linear-gradient(135deg, var(--navy), var(--navy-mid)); display:flex; align-items:center; justify-content:center; color:var(--gold); font-size:40px; }
        .product-body { padding:20px; }
        .product-name { font-family:'Cormorant Garamond',serif; font-size:20px; font-weight:600; color:var(--navy); margin-bottom:6px; }
        .product-desc { font-size:13px; color:var(--text-mid); line-height:1.6; margin-bottom:14px; }
        .product-price { font-size:22px; font-weight:700; color:var(--navy); font-family:'Cormorant Garamond',serif; }
        .product-price sup { font-size:12px; color:var(--gold); }

        /* ═══════════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════════ */
        .lx-footer { background:var(--navy); color:rgba(255,255,255,0.5); text-align:center; padding:48px 32px; font-size:13px; margin-top:80px; position:relative; }
        .lx-footer::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gold),transparent); }
        .lx-footer a { color:var(--gold); text-decoration:none; font-weight:600; }
        .lx-footer a:hover { color:var(--gold-light); }
        .lx-footer-brand { font-family:'Cormorant Garamond',serif; font-size:28px; color:white; font-weight:600; letter-spacing:2px; margin-bottom:8px; }
        .lx-footer-tagline { font-size:12px; color:rgba(255,255,255,0.35); letter-spacing:3px; text-transform:uppercase; margin-bottom:24px; }
        .lx-footer-links { display:flex; justify-content:center; gap:24px; flex-wrap:wrap; margin-bottom:24px; }
        .lx-footer-links a { font-size:12px; color:rgba(255,255,255,0.5); letter-spacing:1px; }
        .lx-footer-links a:hover { color:var(--gold); }
        .lx-footer-divider { width:120px; height:1px; background:linear-gradient(90deg,transparent,var(--gold),transparent); margin:0 auto 24px; }

        /* ═══════════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════════ */
        @media (max-width:1024px) {
            .dest-grid { grid-template-columns:1fr 1fr; }
            .dest-card:nth-child(1) { grid-column:span 2; min-height:280px; aspect-ratio:16/7; }
            .stats-row-inner { grid-template-columns:repeat(3,1fr); }
        }
        @media (max-width:768px) {
            .hero-banner { min-height:480px; }
            .hero-name { font-size:42px; }
            .hero-btns { flex-direction:column; max-width:280px; }
            .hero-stats-strip { display:none; }
            .profile-card-wrap { margin-top:-40px; padding:0 16px; }
            .pgc-inner { flex-direction:column; align-items:center; text-align:center; padding:32px 24px; }
            .pgc-actions { justify-content:center; }
            .pgc-bio { padding:24px; }
            .pgc-quick-info { flex-wrap:wrap; }
            .pgc-qi-item { flex:0 0 50%; border-bottom:1px solid rgba(201,168,76,0.1); }
            .main-wrap { padding:0 16px 60px; }
            .dest-grid, .user-dest-grid { grid-template-columns:1fr; }
            .dest-card:nth-child(1) { grid-column:span 1; min-height:260px; aspect-ratio:4/3; }
            .stats-row-inner { grid-template-columns:repeat(2,1fr); }
            .packages-grid { grid-template-columns:1fr; }
            .services-bg-wrap { padding:36px 24px; }
            .testi-section { padding:36px 24px; }
            .booking-cta-inner { padding:48px 24px; }
            .bcta-btns { flex-direction:column; align-items:center; }
            .flying-plane { display:none; }
            .products-grid, .docs-grid { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> Preview Mode —
        <a href="{{ url('/signin') }}">Sign up</a> to publish your luxury travel profile!
    </div>
    @endif

    <!-- ── Flying planes decoration ── -->
    <div class="flying-plane flying-plane-1" style="width:70px;height:70px;">
        <svg viewBox="0 0 80 80" fill="none"><path d="M10 40 L25 30 L55 30 L70 20 L75 25 L60 35 L60 45 L75 50 L70 55 L55 45 L25 45 L10 55 Z" fill="#c9a84c"/></svg>
    </div>
    <div class="flying-plane flying-plane-2" style="width:55px;height:55px;">
        <svg viewBox="0 0 80 80" fill="none"><path d="M10 40 L25 30 L55 30 L70 20 L75 25 L60 35 L60 45 L75 50 L70 55 L55 45 L25 45 L10 55 Z" fill="#0891b2"/></svg>
    </div>
    <div class="flying-plane flying-plane-3" style="width:60px;height:60px;">
        <svg viewBox="0 0 80 80" fill="none"><path d="M10 40 L25 30 L55 30 L70 20 L75 25 L60 35 L60 45 L75 50 L70 55 L55 45 L25 45 L10 55 Z" fill="#c9a84c" opacity="0.7"/></svg>
    </div>

    <!-- ══════════════════════════════════════════════════════
         HERO BANNER — Aerial travel landscape
    ══════════════════════════════════════════════════════ -->
    <section class="hero-banner">
        <div class="hero-accent-line"></div>
        <div class="hero-rays"></div>

        <div class="hero-inner">
            <div class="hero-eyebrow">
                <span class="hero-eyebrow-dot"></span>
                Premium Travel &amp; Tours
            </div>

            @if($userdata->isFeatureVisible('name'))
            <h1 class="hero-name">
                {{ $userdata->name ?? 'Your Name' }}<br>
                <em>Travel Experiences</em>
            </h1>
            @endif

            @if($userdata->isFeatureVisible('designation') && ($userdata->desig ?? false))
            <p class="hero-desig">{{ $userdata->desig }}</p>
            @endif

            <div class="hero-tags">
                <div class="hero-tag"><i class="fas fa-globe-americas"></i> World Explorer</div>
                @if($userdata->city ?? false)
                <div class="hero-tag"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}</div>
                @endif
                <div class="hero-tag"><i class="fas fa-medal"></i> Certified Travel Expert</div>
                <div class="hero-tag"><i class="fas fa-star"></i> 5-Star Rated Agency</div>
            </div>

            <div class="hero-btns">
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="btn-gold">
                    <i class="fas fa-phone"></i> Call Now
                </a>
                @endif
                @if(isset($social->whatsapp) && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" class="btn-whatsapp" target="_blank" rel="noopener">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
                @if($userdata->email ?? false)
                <a href="mailto:{{ $userdata->email }}" class="btn-outline-white">
                    <i class="fas fa-envelope"></i> Enquire Now
                </a>
                @endif
            </div>

           
        </div>

        <!-- Wave divider -->
        <div class="hero-wave">
            <svg viewBox="0 0 1440 90" preserveAspectRatio="none">
                <path d="M0 30 Q360 90 720 40 Q1080 0 1440 50 L1440 90 L0 90 Z" fill="#fdf8f0"/>
            </svg>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════════════
         PROFILE GLASS CARD
    ══════════════════════════════════════════════════════ -->
    <div class="profile-card-wrap">
        <div class="profile-glass-card">

            <!-- ── Main Row: Photo + Info ── -->
            <div class="pgc-inner">

                <!-- Profile Photo -->
                <div class="pgc-photo-wrap">
                    <div class="pgc-photo-ring">
                        <div class="pgc-photo">
                            @if($userdata->isFeatureVisible('profile_image') && ($userdata->image ?? false))
                                <img src="{{ url('uploads/profile/'.$userdata->image) }}"
                                     alt="{{ $userdata->name }}" loading="lazy">
                            @else
                                <div class="pgc-photo-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="pgc-verified" title="Verified Travel Expert">
                        <i class="fas fa-check"></i>
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="pgc-info">
                    <div class="pgc-luxury-label">
                        <i class="fas fa-gem"></i> Luxury Travel Specialist
                    </div>

                    @if($userdata->isFeatureVisible('name'))
                    <h2 class="pgc-name">{{ $userdata->name ?? 'Travel Expert' }}</h2>
                    @endif

                    @if($userdata->isFeatureVisible('designation') && ($userdata->desig ?? false))
                    <p class="pgc-desig">{{ $userdata->desig }}</p>
                    @endif

                    @if(($userdata->city ?? false) || ($userdata->state ?? false) || ($userdata->country ?? false))
                    <p class="pgc-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ implode(', ', array_filter([$userdata->city ?? null, $userdata->state ?? null, $userdata->country ?? null])) }}
                    </p>
                    @endif

                    <div class="pgc-actions">
                        @if($userdata->mobile ?? false)
                        <a href="tel:{{ $userdata->mobile }}" class="pgc-btn pgc-btn-primary">
                            <i class="fas fa-phone"></i> {{ $userdata->mobile }}
                        </a>
                        @endif
                        @if($userdata->email ?? false)
                        <a href="mailto:{{ $userdata->email }}" class="pgc-btn pgc-btn-gold">
                            <i class="fas fa-envelope"></i> Email Me
                        </a>
                        @endif
                        @if(isset($social->whatsapp) && $social->whatsapp)
                        <a href="https://wa.me/{{ $social->whatsapp }}" class="pgc-btn pgc-btn-wa" target="_blank" rel="noopener">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- ── Gold Divider ── -->
            <div class="gold-divider"></div>

            <!-- ── Bio Quote Strip ── -->
            @if($userdata->isFeatureVisible('about') && ($userdata->about ?? false))
            <div class="pgc-bio">
                <span class="pgc-bio-quote">"</span>{{ $userdata->about }}"
            </div>
            <div class="gold-divider"></div>
            @endif

         

        </div><!-- /.profile-glass-card -->
    </div><!-- /.profile-card-wrap -->


    <!-- ══════════════════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════════════════ -->
    <div class="main-wrap">

        <!-- ─────────────────────────────────────
             STATS ROW — Dark bg, airplane wing photo
        ───────────────────────────────────── -->
        <div class="stats-row">
            <div class="stats-row-inner">
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-lx-num">500<sup>+</sup></div>
                    <div class="stat-lx-label">Happy Clients</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-plane-departure"></i></div>
                    <div class="stat-lx-num">50<sup>+</sup></div>
                    <div class="stat-lx-label">Destinations</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-passport"></i></div>
                    <div class="stat-lx-num">1000<sup>+</sup></div>
                    <div class="stat-lx-label">Tours Planned</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-award"></i></div>
                    <div class="stat-lx-num">15<sup>+</sup></div>
                    <div class="stat-lx-label">Awards Won</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-star"></i></div>
                    <div class="stat-lx-num">5<sup>★</sup></div>
                    <div class="stat-lx-label">Avg. Rating</div>
                </div>
            </div>
        </div>


        <!-- ─────────────────────────────────────
             DESTINATIONS / PORTFOLIO GALLERY
        ───────────────────────────────────── -->
        @if(($menu->upload_file ?? 0) && isset($portfolios) && $portfolios->count())

        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Portfolio &amp; Gallery</div>
                <h2 class="lxsh-title">Moments from <em>My Journeys</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="user-dest-grid">
            @foreach($portfolios as $portfolio)
            <div class="user-dest-card">
                <img src="{{ url('uploads/portfolio/'.$portfolio->image) }}"
                     alt="{{ $portfolio->title ?? 'Travel Photo' }}" loading="lazy">
                <div class="dest-overlay"></div>
                @if($portfolio->title ?? false)
                <div class="dest-content">
                    <div class="dest-badge">Destination</div>
                    <div class="dest-name">{{ $portfolio->title }}</div>
                    @if($portfolio->description ?? false)
                    <div class="dest-desc">{{ Str::limit($portfolio->description, 80) }}</div>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </div>

        @else

        <!-- Default showcase destinations when no portfolio uploaded -->
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Dream Destinations</div>
                <h2 class="lxsh-title">Curated <em>World Escapes</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="dest-grid">
            <!-- Card 1 — Feature / large -->
            <div class="dest-card">
                <div class="dest-bg"></div>
                <div class="dest-overlay"></div>
                <div class="dest-content">
                    <span class="dest-badge">Featured</span>
                    <div class="dest-name">Maldives Overwater Villas</div>
                    <div class="dest-desc">Drift into serenity above crystal-clear lagoons with private pool villas and world-class diving.</div>
                    <div class="dest-meta">
                        <span><i class="fas fa-clock"></i> 7 Nights</span>
                        <span><i class="fas fa-plane"></i> Direct Flights</span>
                        <span><i class="fas fa-star"></i> 5-Star Resort</span>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="dest-card">
                <div class="dest-bg"></div>
                <div class="dest-overlay"></div>
                <div class="dest-content">
                    <span class="dest-badge">Europe</span>
                    <div class="dest-name">Paris, France</div>
                    <div class="dest-desc">City of lights, haute cuisine, and timeless romance.</div>
                    <div class="dest-meta">
                        <span><i class="fas fa-clock"></i> 5 Nights</span>
                        <span><i class="fas fa-star"></i> Luxury Hotels</span>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="dest-card">
                <div class="dest-bg"></div>
                <div class="dest-overlay"></div>
                <div class="dest-content">
                    <span class="dest-badge">Asia</span>
                    <div class="dest-name">Santorini, Greece</div>
                    <div class="dest-desc">Iconic sunsets over volcanic caldera, cave suites &amp; Aegean sea views.</div>
                    <div class="dest-meta">
                        <span><i class="fas fa-clock"></i> 6 Nights</span>
                        <span><i class="fas fa-star"></i> Boutique Villas</span>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="dest-card">
                <div class="dest-bg"></div>
                <div class="dest-overlay"></div>
                <div class="dest-content">
                    <span class="dest-badge">Southeast Asia</span>
                    <div class="dest-name">Bali, Indonesia</div>
                    <div class="dest-desc">Spiritual terraced rice fields, infinity pools &amp; healing retreats.</div>
                    <div class="dest-meta">
                        <span><i class="fas fa-clock"></i> 8 Nights</span>
                        <span><i class="fas fa-star"></i> Private Villas</span>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="dest-card">
                <div class="dest-bg"></div>
                <div class="dest-overlay"></div>
                <div class="dest-content">
                    <span class="dest-badge">Middle East</span>
                    <div class="dest-name">Dubai, UAE</div>
                    <div class="dest-desc">Skyline spectacles, desert safaris &amp; gold-accented luxury at its finest.</div>
                    <div class="dest-meta">
                        <span><i class="fas fa-clock"></i> 4 Nights</span>
                        <span><i class="fas fa-star"></i> 7-Star Stays</span>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="dest-card">
                <div class="dest-bg"></div>
                <div class="dest-overlay"></div>
                <div class="dest-content">
                    <span class="dest-badge">Polar</span>
                    <div class="dest-name">Northern Lights, Iceland</div>
                    <div class="dest-desc">Chase auroras from glass-ceiling lodges in the land of fire and ice.</div>
                    <div class="dest-meta">
                        <span><i class="fas fa-clock"></i> 5 Nights</span>
                        <span><i class="fas fa-star"></i> Glacier Lodges</span>
                    </div>
                </div>
            </div>
        </div>

        @endif


        <!-- ─────────────────────────────────────
             SERVICES SECTION — Dark luxury bg
        ───────────────────────────────────── -->
        @if($menu->service ?? 0)
        <div class="services-section">
            <div class="services-bg-wrap">

                <div class="lx-section-header" style="margin-top:0;">
                    <div class="lxsh-ornament">
                        <div class="lxsh-dot"></div>
                        <div class="lxsh-line" style="background:linear-gradient(180deg,var(--gold),transparent);"></div>
                    </div>
                    <div class="lxsh-titles">
                        <div class="lxsh-eyebrow lxsh-eyebrow-white">What I Offer</div>
                        <h2 class="lxsh-title lxsh-title-white">Premium <em>Travel Services</em></h2>
                    </div>
                    <div class="lxsh-rule" style="background:linear-gradient(90deg,rgba(201,168,76,0.4),transparent);"></div>
                </div>

                @php
                    $defaultServices = [
                        ['icon'=>'fa-plane-departure','title'=>'Flight Booking','desc'=>'Business, first class &amp; private jet reservations across all major global carriers.'],
                        ['icon'=>'fa-hotel','title'=>'Luxury Hotels','desc'=>'5-star resorts, private villas &amp; boutique retreats handpicked worldwide.'],
                        ['icon'=>'fa-map-marked-alt','title'=>'Custom Itineraries','desc'=>'Bespoke, day-by-day travel plans crafted around your unique preferences.'],
                        ['icon'=>'fa-ship','title'=>'Cruise Packages','desc'=>'World-class ocean &amp; river cruise experiences with premium cabin selections.'],
                        ['icon'=>'fa-passport','title'=>'Visa Assistance','desc'=>'Expert visa guidance, documentation support and application follow-up.'],
                        ['icon'=>'fa-shield-alt','title'=>'Travel Insurance','desc'=>'Comprehensive coverage plans for complete peace of mind on every trip.'],
                        ['icon'=>'fa-car','title'=>'Transfers &amp; Tours','desc'=>'Private transfers, chauffeur service &amp; guided sightseeing excursions.'],
                        ['icon'=>'fa-gifts','title'=>'Honeymoon Packages','desc'=>'Romantic getaways with surprise experiences, flowers &amp; curated memories.'],
                    ];
                @endphp

                <div class="services-grid">
                    @if(isset($services) && $services->count())
                        @foreach($services as $service)
                        <div class="service-lx-card">
                            <div class="srv-icon">
                                @if($service->icon ?? false)
                                    <i class="{{ $service->icon }}"></i>
                                @else
                                    <i class="fas fa-concierge-bell"></i>
                                @endif
                            </div>
                            <div class="srv-title">{{ $service->title ?? $service->name }}</div>
                            <p class="srv-desc">{{ Str::limit($service->description ?? $service->desc ?? '', 120) }}</p>
                        </div>
                        @endforeach
                    @else
                        @foreach($defaultServices as $ds)
                        <div class="service-lx-card">
                            <div class="srv-icon"><i class="fas {{ $ds['icon'] }}"></i></div>
                            <div class="srv-title">{{ $ds['title'] }}</div>
                            <p class="srv-desc">{!! $ds['desc'] !!}</p>
                        </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
        @endif


        <!-- ─────────────────────────────────────
             WHY CHOOSE ME
        ───────────────────────────────────── -->
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">The Difference</div>
                <h2 class="lxsh-title">Why Choose <em>My Expertise</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-gem"></i></div>
                <div class="why-title">Luxury-First Approach</div>
                <p class="why-desc">Every booking is curated with meticulous attention to detail — from premium transfers to exclusive room upgrades and private experiences.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-headset"></i></div>
                <div class="why-title">24/7 Concierge Support</div>
                <p class="why-desc">Round-the-clock assistance throughout your journey — whether you need a last-minute booking change or an emergency contact.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-handshake"></i></div>
                <div class="why-title">Trusted Partnerships</div>
                <p class="why-desc">Exclusive tie-ups with leading airlines, 5-star hotel chains and private tour operators, giving you the best rates and privileges.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-route"></i></div>
                <div class="why-title">Bespoke Itineraries</div>
                <p class="why-desc">No two travelers are alike. Every trip is designed personally around your vision, pace, and passion.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-shield-alt"></i></div>
                <div class="why-title">Safe &amp; Secure Travel</div>
                <p class="why-desc">Comprehensive travel insurance, real-time safety monitoring, and destination risk assessments for total peace of mind.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-tag"></i></div>
                <div class="why-title">Best Value Guarantee</div>
                <p class="why-desc">Transparent pricing with no hidden charges. If you find a better rate, we'll match it — no questions asked.</p>
            </div>
        </div>


        <!-- ─────────────────────────────────────
             LUXURY PACKAGES
        ───────────────────────────────────── -->
        @if($menu->product ?? 0)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Signature Collections</div>
                <h2 class="lxsh-title">Featured <em>Travel Packages</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        @if(isset($products) && $products->count())
        <!-- Dynamic user products -->
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                @if($product->image ?? false)
                    <img class="product-img" src="{{ url('uploads/products/'.$product->image) }}" alt="{{ $product->name }}" loading="lazy">
                @else
                    <div class="product-img-placeholder"><i class="fas fa-plane-departure"></i></div>
                @endif
                <div class="product-body">
                    <div class="product-name">{{ $product->name }}</div>
                    @if($product->description ?? false)
                    <p class="product-desc">{{ Str::limit($product->description, 100) }}</p>
                    @endif
                    @if($product->price ?? false)
                    <div class="product-price"><sup>₹</sup>{{ number_format($product->price) }}</div>
                    @endif
                    @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="pkg-book-btn" style="margin-top:16px;display:inline-flex;">
                        <i class="fas fa-phone"></i> Book Now
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Default showcase packages -->
        <div class="packages-grid">
            <!-- Package 1 -->
            <div class="pkg-card">
                <div class="pkg-img">
                    <div class="pkg-img-overlay"></div>
                    <div class="pkg-badge-wrap">
                        <span class="pkg-badge">Best Seller</span>
                        <span class="pkg-badge pkg-badge-hot">Hot Deal</span>
                    </div>
                    <div class="pkg-img-title">Maldives Escape</div>
                </div>
                <div class="pkg-body">
                    <div class="pkg-features">
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> 7 Nights / 8 Days</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Overwater Villa</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> All Meals Included</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Seaplane Transfer</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Snorkeling &amp; Diving</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Sunset Cruise</div>
                    </div>
                    <div class="pkg-footer">
                        <div class="pkg-price">
                            <div class="pkg-price-from">Starting from</div>
                            <div class="pkg-price-num"><sup>₹</sup>1,85,000</div>
                        </div>
                        @if($userdata->mobile ?? false)
                        <a href="tel:{{ $userdata->mobile }}" class="pkg-book-btn">
                            <i class="fas fa-phone"></i> Book Now
                        </a>
                        @else
                        <a href="#contact-section" class="pkg-book-btn">
                            <i class="fas fa-paper-plane"></i> Enquire
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Package 2 -->
            <div class="pkg-card">
                <div class="pkg-img">
                    <div class="pkg-img-overlay"></div>
                    <div class="pkg-badge-wrap">
                        <span class="pkg-badge">Premium</span>
                    </div>
                    <div class="pkg-img-title">European Grand Tour</div>
                </div>
                <div class="pkg-body">
                    <div class="pkg-features">
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> 12 Nights / 13 Days</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> 5-Star Hotels</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Business Class Flights</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Private Transfers</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> 6 Cities Covered</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Expert Guide</div>
                    </div>
                    <div class="pkg-footer">
                        <div class="pkg-price">
                            <div class="pkg-price-from">Starting from</div>
                            <div class="pkg-price-num"><sup>₹</sup>2,45,000</div>
                        </div>
                        @if($userdata->mobile ?? false)
                        <a href="tel:{{ $userdata->mobile }}" class="pkg-book-btn">
                            <i class="fas fa-phone"></i> Book Now
                        </a>
                        @else
                        <a href="#contact-section" class="pkg-book-btn">
                            <i class="fas fa-paper-plane"></i> Enquire
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Package 3 -->
            <div class="pkg-card">
                <div class="pkg-img">
                    <div class="pkg-img-overlay"></div>
                    <div class="pkg-badge-wrap">
                        <span class="pkg-badge">Honeymoon</span>
                    </div>
                    <div class="pkg-img-title">Dubai Luxury Getaway</div>
                </div>
                <div class="pkg-body">
                    <div class="pkg-features">
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> 5 Nights / 6 Days</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Burj Al Arab</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Desert Safari</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Dhow Cruise Dinner</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Helicopter Tour</div>
                        <div class="pkg-feature"><i class="fas fa-check-circle"></i> Visa Included</div>
                    </div>
                    <div class="pkg-footer">
                        <div class="pkg-price">
                            <div class="pkg-price-from">Starting from</div>
                            <div class="pkg-price-num"><sup>₹</sup>95,000</div>
                        </div>
                        @if($userdata->mobile ?? false)
                        <a href="tel:{{ $userdata->mobile }}" class="pkg-book-btn">
                            <i class="fas fa-phone"></i> Book Now
                        </a>
                        @else
                        <a href="#contact-section" class="pkg-book-btn">
                            <i class="fas fa-paper-plane"></i> Enquire
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif


        <!-- ─────────────────────────────────────
             QUALIFICATIONS / CREDENTIALS
        ───────────────────────────────────── -->
        @if($menu->quali ?? 0)
        @if(isset($qualifications) && $qualifications->count())
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Credentials</div>
                <h2 class="lxsh-title">Education &amp; <em>Certifications</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="quali-timeline">
            @foreach($qualifications as $quali)
            <div class="quali-item">
                <div class="quali-dot"></div>
                @if($quali->year ?? false)
                <div class="quali-year">{{ $quali->year }}</div>
                @endif
                <div class="quali-title-text">{{ $quali->degree ?? $quali->title ?? '' }}</div>
                @if($quali->institute ?? false)
                <div class="quali-institute"><i class="fas fa-university" style="color:var(--gold);margin-right:6px;"></i>{{ $quali->institute }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
        @endif


        <!-- ─────────────────────────────────────
             PROFESSIONAL EXPERIENCE
        ───────────────────────────────────── -->
        @if($menu->profess ?? 0)
        @if(isset($experiences) && $experiences->count())
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Career Path</div>
                <h2 class="lxsh-title">Professional <em>Experience</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="quali-timeline">
            @foreach($experiences as $exp)
            <div class="quali-item">
                <div class="quali-dot" style="background:var(--teal);"></div>
                @if(($exp->from_year ?? false) || ($exp->to_year ?? false))
                <div class="quali-year">{{ $exp->from_year ?? '' }} {{ ($exp->from_year ?? false) && ($exp->to_year ?? false) ? '–' : '' }} {{ $exp->to_year ?? '' }}</div>
                @endif
                <div class="quali-title-text">{{ $exp->position ?? $exp->title ?? '' }}</div>
                @if($exp->company ?? false)
                <div class="quali-institute"><i class="fas fa-building" style="color:var(--teal);margin-right:6px;"></i>{{ $exp->company }}</div>
                @endif
                @if($exp->description ?? false)
                <p style="font-size:13px;color:var(--text-mid);margin-top:6px;line-height:1.7;">{{ $exp->description }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @endif
        @endif


        <!-- ─────────────────────────────────────
             VIDEO GALLERY
        ───────────────────────────────────── -->
        @if($menu->videos ?? 0)
        @if(isset($videos) && $videos->count())
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Visual Stories</div>
                <h2 class="lxsh-title">Travel <em>Video Gallery</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="video-grid">
            @foreach($videos as $video)
            <div class="video-card">
                @php
                    $videoUrl = $video->url ?? $video->link ?? '';
                    preg_match('/(?:youtu\.be\/|youtube\.com\/(?:.*v=|.*\/))([^&\?\/]{11})/', $videoUrl, $ytm);
                    $ytId = $ytm[1] ?? null;
                @endphp
                @if($ytId)
                    <iframe
                        src="https://www.youtube.com/embed/{{ $ytId }}?rel=0&modestbranding=1"
                        title="{{ $video->title ?? 'Travel Video' }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen loading="lazy">
                    </iframe>
                @else
                    <div class="video-card-thumb">
                        <div class="video-play-btn">
                            <div class="video-play-icon"><i class="fas fa-play"></i></div>
                        </div>
                    </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
        @endif


        <!-- ─────────────────────────────────────
             TESTIMONIALS / CLIENT REVIEWS
        ───────────────────────────────────── -->
        @if($menu->client ?? 0)
        <div class="testi-section">
            <div class="lx-section-header" style="margin-top:0;">
                <div class="lxsh-ornament">
                    <div class="lxsh-dot"></div>
                    <div class="lxsh-line"></div>
                </div>
                <div class="lxsh-titles">
                    <div class="lxsh-eyebrow">Client Love</div>
                    <h2 class="lxsh-title">What <em>Travelers Say</em></h2>
                </div>
                <div class="lxsh-rule"></div>
            </div>

            <div class="testi-grid">

                @if(isset($clients) && $clients->count())
                    @foreach($clients as $client)
                    <div class="testi-card">
                        <div class="testi-stars">★★★★★</div>
                        <div class="testi-quote-mark">"</div>
                        <p class="testi-text">{{ $client->review ?? $client->message ?? $client->description ?? '' }}</p>
                        <div class="testi-author">
                            <div class="testi-avatar">
                                @if($client->image ?? false)
                                    <img src="{{ url('uploads/clients/'.$client->image) }}"
                                         style="width:100%;height:100%;object-fit:cover;border-radius:50%;" alt="">
                                @else
                                    {{ strtoupper(substr($client->name ?? 'C', 0, 1)) }}
                                @endif
                            </div>
                            <div>
                                <div class="testi-name">{{ $client->name ?? 'Happy Traveler' }}</div>
                                @if($client->location ?? $client->destination ?? false)
                                <div class="testi-trip">
                                    <i class="fas fa-plane"></i>
                                    {{ $client->location ?? $client->destination ?? '' }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <!-- Default testimonials -->
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <div class="testi-quote-mark">"</div>
                    <p class="testi-text">An absolutely flawless experience from booking to return. Our Maldives honeymoon was everything we dreamed of and more — every tiny detail was perfectly arranged.</p>
                    <div class="testi-author">
                        <div class="testi-avatar">R</div>
                        <div>
                            <div class="testi-name">Rahul &amp; Priya Mehta</div>
                            <div class="testi-trip"><i class="fas fa-plane"></i> Maldives Honeymoon</div>
                        </div>
                    </div>
                </div>
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <div class="testi-quote-mark">"</div>
                    <p class="testi-text">Our European grand tour was seamlessly planned — hotels, trains, guides — all premium quality. The 24/7 support gave us complete confidence throughout the trip.</p>
                    <div class="testi-author">
                        <div class="testi-avatar">S</div>
                        <div>
                            <div class="testi-name">Suresh &amp; Kavitha Nair</div>
                            <div class="testi-trip"><i class="fas fa-plane"></i> Europe Grand Tour</div>
                        </div>
                    </div>
                </div>
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <div class="testi-quote-mark">"</div>
                    <p class="testi-text">Impeccable service! The Dubai package was extraordinary — helicopter ride, Burj dinner, desert safari. Already planning our next trip with the same agent!</p>
                    <div class="testi-author">
                        <div class="testi-avatar">A</div>
                        <div>
                            <div class="testi-name">Arjun Sharma</div>
                            <div class="testi-trip"><i class="fas fa-plane"></i> Dubai Luxury Package</div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
        @endif


        <!-- ─────────────────────────────────────
             PERSONAL THOUGHTS / BLOG
        ───────────────────────────────────── -->
        @if($menu->thought ?? 0)
        @if(isset($thoughts) && $thoughts->count())
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Travel Insights</div>
                <h2 class="lxsh-title">My <em>Travel Journal</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:24px;">
            @foreach($thoughts as $thought)
            <div class="why-card" style="padding:0;overflow:hidden;">
                @if($thought->image ?? false)
                <div style="height:180px;overflow:hidden;">
                    <img src="{{ url('uploads/thoughts/'.$thought->image) }}"
                         style="width:100%;height:100%;object-fit:cover;transition:transform .5s;"
                         onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"
                         alt="{{ $thought->title ?? '' }}" loading="lazy">
                </div>
                @endif
                <div style="padding:24px;">
                    @if($thought->created_at ?? false)
                    <div style="font-size:11px;color:var(--gold);font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">
                        <i class="fas fa-calendar-alt" style="margin-right:5px;"></i>
                        {{ \Carbon\Carbon::parse($thought->created_at)->format('d M Y') }}
                    </div>
                    @endif
                    <div class="why-title" style="font-size:20px;">{{ $thought->title ?? '' }}</div>
                    @if($thought->description ?? false)
                    <p class="why-desc" style="margin-top:8px;">{{ Str::limit($thought->description, 120) }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @endif


        <!-- ─────────────────────────────────────
             DOCUMENTS / UPLOAD FILES
        ───────────────────────────────────── -->
        @if($menu->upload_file ?? 0)
        @if(isset($upload_files) && $upload_files->count())
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Downloads</div>
                <h2 class="lxsh-title">Brochures &amp; <em>Documents</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="docs-grid">
            @foreach($upload_files as $file)
            <div class="doc-card">
                <div class="doc-icon">
                    @php
                        $ext = strtolower(pathinfo($file->file ?? '', PATHINFO_EXTENSION));
                        $docIcon = match($ext) {
                            'pdf'  => 'fa-file-pdf',
                            'doc', 'docx' => 'fa-file-word',
                            'xls', 'xlsx' => 'fa-file-excel',
                            'ppt', 'pptx' => 'fa-file-powerpoint',
                            'jpg', 'jpeg', 'png', 'webp' => 'fa-file-image',
                            default => 'fa-file-alt',
                        };
                    @endphp
                    <i class="fas {{ $docIcon }}"></i>
                </div>
                <div>
                    <div class="doc-name">{{ $file->title ?? $file->name ?? 'Document' }}</div>
                    <div class="doc-sub">{{ strtoupper($ext ?? 'FILE') }} • Click to download</div>
                </div>
                <a href="{{ url('uploads/files/'.$file->file) }}" target="_blank" class="doc-dl-btn" download>
                    <i class="fas fa-download"></i>
                </a>
            </div>
            @endforeach
        </div>
        @endif
        @endif


        <!-- ─────────────────────────────────────
             BOOKING CTA — Scenic mountain path bg
        ───────────────────────────────────── -->
        <div class="booking-cta" id="contact-section">
            <div class="booking-dots"></div>
            <div class="booking-cta-inner">
                <div class="bcta-eyebrow">Ready to Fly?</div>
                <h2 class="bcta-title">Let's Plan Your <em>Dream Journey</em></h2>
                <p class="bcta-sub">
                    Whether it's a romantic honeymoon, a family adventure, a solo expedition, or a corporate retreat — I'll craft every detail to perfection. Reach out today and let the journey begin.
                </p>
                <div class="bcta-btns">
                    @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="btn-gold">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                    @endif
                    @if(isset($social->whatsapp) && $social->whatsapp)
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="btn-whatsapp" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                    @endif
                    @if($userdata->email ?? false)
                    <a href="mailto:{{ $userdata->email }}" class="btn-outline-white">
                        <i class="fas fa-envelope"></i> Send Enquiry
                    </a>
                    @endif
                </div>
            </div>
        </div>


        <!-- ─────────────────────────────────────
             CONTACT INFORMATION
        ───────────────────────────────────── -->
        @if($menu->personal ?? 0)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Get in Touch</div>
                <h2 class="lxsh-title">Contact <em>Information</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="contact-grid-lx">
            @if($userdata->mobile ?? false)
            <div class="contact-lx-card">
                <div class="clx-icon"><i class="fas fa-phone"></i></div>
                <div class="clx-label">Phone / Mobile</div>
                <div class="clx-val"><a href="tel:{{ $userdata->mobile }}">{{ $userdata->mobile }}</a></div>
            </div>
            @endif

            @if($userdata->email ?? false)
            <div class="contact-lx-card">
                <div class="clx-icon"><i class="fas fa-envelope"></i></div>
                <div class="clx-label">Email Address</div>
                <div class="clx-val"><a href="mailto:{{ $userdata->email }}">{{ $userdata->email }}</a></div>
            </div>
            @endif

            @if(($userdata->city ?? false) || ($userdata->state ?? false) || ($userdata->country ?? false))
            <div class="contact-lx-card">
                <div class="clx-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="clx-label">Location / Office</div>
                <div class="clx-val">{{ implode(', ', array_filter([$userdata->city ?? null, $userdata->state ?? null, $userdata->country ?? null])) }}</div>
            </div>
            @endif

            @if(isset($social->whatsapp) && $social->whatsapp)
            <div class="contact-lx-card">
                <div class="clx-icon" style="color:#25d366;border-color:rgba(37,211,102,0.3);background:rgba(37,211,102,0.07);">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div class="clx-label">WhatsApp</div>
                <div class="clx-val">
                    <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" rel="noopener" style="color:#16a34a;">
                        +{{ $social->whatsapp }}
                    </a>
                </div>
            </div>
            @endif

            @if($userdata->website ?? false)
            <div class="contact-lx-card">
                <div class="clx-icon"><i class="fas fa-globe"></i></div>
                <div class="clx-label">Website</div>
                <div class="clx-val">
                    <a href="{{ $userdata->website }}" target="_blank" rel="noopener">
                        {{ str_replace(['https://','http://'], '', $userdata->website) }}
                    </a>
                </div>
            </div>
            @endif

            @if($userdata->pincode ?? false)
            <div class="contact-lx-card">
                <div class="clx-icon"><i class="fas fa-mail-bulk"></i></div>
                <div class="clx-label">PIN / ZIP Code</div>
                <div class="clx-val">{{ $userdata->pincode }}</div>
            </div>
            @endif
        </div>
        @endif


        <!-- ─────────────────────────────────────
             SOCIAL MEDIA LINKS
        ───────────────────────────────────── -->
      

    </div><!-- /.main-wrap -->


    <!-- ══════════════════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════════════════ -->
    <footer class="lx-footer">
        <div class="lx-footer-brand">
            {{ $userdata->name ?? 'Luxury Travel' }}
        </div>
        <div class="lx-footer-tagline">Crafting Extraordinary Journeys Since Day One</div>

        <div class="lx-footer-links">
            @if($userdata->mobile ?? false)
            <a href="tel:{{ $userdata->mobile }}"><i class="fas fa-phone" style="margin-right:5px;"></i>{{ $userdata->mobile }}</a>
            @endif
            @if($userdata->email ?? false)
            <a href="mailto:{{ $userdata->email }}"><i class="fas fa-envelope" style="margin-right:5px;"></i>{{ $userdata->email }}</a>
            @endif
            @if(isset($social->whatsapp) && $social->whatsapp)
            <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank"><i class="fab fa-whatsapp" style="margin-right:5px;"></i>WhatsApp</a>
            @endif
        </div>

        <div class="lx-footer-divider"></div>

        <p>
            &copy; Digital Presence by Fastapp
            @if($websetting && ($websetting->company_name ?? false))
            &nbsp;|&nbsp; Powered by <a href="#" target="_blank">{{ $websetting->company_name }}</a>
            @endif
        </p>
    </footer>

</body>
</html>