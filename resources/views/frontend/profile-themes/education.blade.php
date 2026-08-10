<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Education' }} - Learning & Education</title>

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
        $themeColor = $theme->color ?? '#4338ca';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ═══════════════════════════════════════════
           EDU LUXURY — COLOR SYSTEM
        ═══════════════════════════════════════════ */
        :root {
            --navy:        #0f172a;
            --navy-mid:    #1e293b;
            --indigo:      #4338ca;
            --indigo-light:#6366f1;
            --indigo-pale: #eef2ff;
            --gold:        #d97706;
            --gold-light:  #f59e0b;
            --gold-pale:   #fefce8;
            --cream:       #fafaf7;
            --white:       #ffffff;
            --text-dark:   #0f172a;
            --text-mid:    #475569;
            --text-light:  #94a3b8;
            --border:      rgba(67,56,202,0.12);
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Global watermark bg */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1920&q=20');
            background-size: cover;
            background-position: center;
            opacity: 0.025;
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
           FLOATING SVG DECORATIONS
        ═══════════════════════════════════════════ */
        .edu-deco {
            position: fixed;
            pointer-events: none;
            z-index: 1;
            opacity: 0.07;
        }
        .edu-deco-1 { top:12%; left:1%; width:80px; animation: deco-float-1 18s ease-in-out infinite; }
        .edu-deco-2 { top:40%; right:2%; width:65px; animation: deco-float-2 22s ease-in-out infinite 3s; }
        .edu-deco-3 { top:65%; left:2%; width:75px; animation: deco-float-3 20s ease-in-out infinite 6s; }
        .edu-deco-4 { top:25%; right:3%; width:55px; animation: deco-float-1 16s ease-in-out infinite 9s; }
        .edu-deco-5 { top:80%; right:4%; width:70px; animation: deco-float-2 24s ease-in-out infinite 12s; }

        @keyframes deco-float-1 { 0%,100%{transform:translateY(0) rotate(0deg);} 50%{transform:translateY(-30px) rotate(8deg);} }
        @keyframes deco-float-2 { 0%,100%{transform:translateY(0) rotate(0deg);} 50%{transform:translateY(-25px) rotate(-6deg);} }
        @keyframes deco-float-3 { 0%,100%{transform:translateY(0) rotate(0deg);} 50%{transform:translateY(-35px) rotate(10deg);} }

        /* ═══════════════════════════════════════════
           HERO BANNER
           BG: Grand university hall / graduation
        ═══════════════════════════════════════════ */
        .hero-banner {
            position: relative;
            width: 100%;
            min-height: 580px;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
            z-index: 10;

            background-image:
                linear-gradient(
                    to bottom,
                    rgba(15,23,42,0.25) 0%,
                    rgba(15,23,42,0.55) 45%,
                    rgba(15,23,42,0.92) 100%
                ),
                url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1920&q=85');
            background-size: cover;
            background-position: center 35%;
        }

        /* Gold top accent */
        .hero-accent-line {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--indigo-light), var(--gold), transparent);
        }

        /* Radial glow */
        .hero-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 20% 20%, rgba(99,102,241,0.10) 0%, transparent 60%);
            pointer-events: none;
        }

        /* Bottom wave */
        .hero-wave {
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 100px;
            pointer-events: none;
        }
        .hero-wave svg { width:100%; height:100%; }

        .hero-inner {
            position: relative;
            z-index: 5;
            width: 100%;
            max-width: 1160px;
            margin: 0 auto;
            padding: 100px 32px 70px;
        }

        /* Eyebrow pill */
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 22px;
            border: 1px solid rgba(245,158,11,0.5);
            border-radius: 30px;
            background: rgba(245,158,11,0.10);
            backdrop-filter: blur(8px);
            color: #fcd34d;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 26px;
        }
        .hero-eyebrow-dot {
            width: 6px; height: 6px;
            background: var(--gold-light); border-radius: 50%;
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot { 0%,100%{opacity:1} 50%{opacity:.3} }

        /* Hero name */
        .hero-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(44px, 7vw, 84px);
            font-weight: 700;
            color: white;
            line-height: 1.05;
            margin-bottom: 14px;
            letter-spacing: -1px;
        }
        .hero-name em { font-style: italic; color: #fcd34d; }

        /* Designation */
        .hero-desig {
            font-size: 14px;
            color: rgba(255,255,255,0.72);
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 30px;
            font-weight: 400;
        }

        /* Tag pills */
        .hero-tags { display:flex; flex-wrap:wrap; gap:12px; margin-bottom:36px; }
        .hero-tag {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 20px;
            background: rgba(255,255,255,0.09);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 4px;
            font-size: 13px; color: rgba(255,255,255,0.88);
            backdrop-filter: blur(10px); font-weight: 500;
        }
        .hero-tag i { color: #fcd34d; }

        /* CTA Buttons */
        .hero-btns { display:flex; flex-wrap:wrap; gap:14px; }
        .btn-gold {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--navy); font-size: 13px; font-weight: 700;
            letter-spacing: 1.5px; text-transform: uppercase;
            border-radius: 4px; text-decoration: none; transition: all .3s;
            box-shadow: 0 8px 30px rgba(217,119,6,0.4);
        }
        .btn-gold:hover { transform:translateY(-3px); box-shadow:0 14px 40px rgba(217,119,6,0.55); }
        .btn-indigo {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 14px 28px;
            background: rgba(99,102,241,0.18);
            color: white; font-size: 13px; font-weight: 600;
            letter-spacing: 1px; text-transform: uppercase;
            border: 1.5px solid rgba(99,102,241,0.5);
            border-radius: 4px; text-decoration: none; transition: all .3s;
            backdrop-filter: blur(8px);
        }
        .btn-indigo:hover { background: rgba(99,102,241,0.30); border-color: var(--indigo-light); color: white; }
        .btn-green {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 14px 28px;
            background: rgba(34,197,94,0.14);
            color: #22c55e; font-size: 13px; font-weight: 600;
            letter-spacing: 1px; text-transform: uppercase;
            border: 1.5px solid rgba(34,197,94,0.35);
            border-radius: 4px; text-decoration: none; transition: all .3s;
            backdrop-filter: blur(8px);
        }
        .btn-green:hover { background: rgba(34,197,94,0.25); color: #22c55e; }

        /* Hero stats strip */
        .hero-stats-strip {
            display: flex; gap: 0;
            margin-top: 42px;
            border: 1px solid rgba(245,158,11,0.25);
            border-radius: 8px; overflow: hidden;
            backdrop-filter: blur(16px);
            background: rgba(15,23,42,0.58);
            max-width: 680px;
        }
        .hss-item { flex:1; padding:18px 20px; text-align:center; border-right:1px solid rgba(255,255,255,0.07); }
        .hss-item:last-child { border-right:none; }
        .hss-num { font-family:'Cormorant Garamond',serif; font-size:32px; font-weight:700; color:#fcd34d; line-height:1; margin-bottom:4px; }
        .hss-label { font-size:9px; color:rgba(255,255,255,0.5); text-transform:uppercase; letter-spacing:1.5px; }

        /* ═══════════════════════════════════════════
           PROFILE GLASS CARD
        ═══════════════════════════════════════════ */
        .profile-card-wrap {
            position: relative; z-index: 30;
            max-width: 1160px; margin: -65px auto 0; padding: 0 32px;
        }

        .profile-glass-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(15,23,42,0.18);
            border: 1px solid rgba(67,56,202,0.15);
            position: relative;
        }
        /* Animated shimmer top border */
        .profile-glass-card::before {
            content: '';
            position: absolute; top:0; left:0; right:0; height:3px;
            background: linear-gradient(90deg, var(--indigo), var(--gold-light), var(--indigo-light), var(--gold), var(--indigo));
            background-size: 300%;
            animation: border-shimmer 5s linear infinite;
        }
        @keyframes border-shimmer { from{background-position:0%} to{background-position:300%} }

        /* Subtle bg watermark inside card */
        .profile-glass-card::after {
            content: '';
            position: absolute; inset:0;
            background-image: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1200&q=30');
            background-size: cover; background-position: center;
            opacity: 0.022; pointer-events: none;
        }

        .pgc-inner {
            position: relative; z-index: 2;
            display: flex; align-items: center; gap: 44px;
            padding: 44px 52px;
        }

        /* Photo ring */
        .pgc-photo-wrap { position:relative; flex-shrink:0; }
        .pgc-photo-ring {
            width: 168px; height: 168px; padding: 4px;
            background: linear-gradient(135deg, var(--indigo), var(--gold-light), var(--indigo-light));
            border-radius: 50%;
            box-shadow: 0 16px 48px rgba(67,56,202,0.35);
        }
        .pgc-photo {
            width:100%; height:100%;
            border-radius:50%; overflow:hidden;
            background: var(--navy);
            clip-path: none;
        }
        .pgc-photo img { width:100%; height:100%; object-fit:cover; }
        .pgc-photo-placeholder {
            width:100%; height:100%;
            display:flex; align-items:center; justify-content:center;
            background: linear-gradient(135deg, var(--navy), var(--navy-mid));
            color: #fcd34d; font-size:54px;
            border-radius: 50%;
        }
        .pgc-verified {
            position:absolute; bottom:4px; right:4px;
            width:38px; height:38px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius:50%; border:3px solid white;
            display:flex; align-items:center; justify-content:center;
            color:var(--navy); font-size:14px;
            box-shadow:0 4px 12px rgba(0,0,0,0.2);
        }

        /* Profile info */
        .pgc-info { flex:1; }
        .pgc-luxury-label {
            display:inline-flex; align-items:center; gap:6px;
            font-size:10px; letter-spacing:3px; text-transform:uppercase;
            color:var(--gold); margin-bottom:10px; font-weight:700;
        }
        .pgc-name {
            font-family:'Cormorant Garamond',serif;
            font-size:42px; font-weight:700;
            color:var(--navy); margin-bottom:6px;
            letter-spacing:-0.5px; line-height:1.1;
        }
        .pgc-desig {
            font-size:14px; color:var(--text-mid); font-weight:500;
            letter-spacing:1.5px; text-transform:uppercase; margin-bottom:18px;
        }
        .pgc-location {
            display:flex; align-items:center; gap:8px;
            font-size:14px; color:var(--text-light); margin-bottom:24px;
        }
        .pgc-location i { color:var(--gold); }

        .pgc-badges { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:24px; }
        .pgc-badge {
            display:inline-flex; align-items:center; gap:6px;
            padding:7px 16px;
            background:var(--indigo-pale); color:var(--indigo);
            border:1.5px solid rgba(67,56,202,0.2);
            border-radius:30px; font-size:12px; font-weight:700;
        }
        .pgc-badge i { color:var(--gold); }

        .pgc-actions { display:flex; flex-wrap:wrap; gap:12px; }
        .pgc-btn {
            display:inline-flex; align-items:center; gap:8px;
            padding:12px 24px; border-radius:4px;
            font-size:12px; font-weight:700; letter-spacing:1px;
            text-transform:uppercase; text-decoration:none; transition:all .3s;
        }
        .pgc-btn-primary { background:var(--navy); color:white; }
        .pgc-btn-primary:hover { background:var(--navy-mid); transform:translateY(-2px); box-shadow:0 8px 24px rgba(15,23,42,0.28); color:white; }
        .pgc-btn-gold { background:linear-gradient(135deg, var(--gold), var(--gold-light)); color:var(--navy); }
        .pgc-btn-gold:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(217,119,6,0.4); }
        .pgc-btn-indigo { background:var(--indigo); color:white; }
        .pgc-btn-indigo:hover { background:var(--indigo-light); transform:translateY(-2px); color:white; }
        .pgc-btn-green { background:rgba(34,197,94,0.1); color:#16a34a; border:1.5px solid rgba(34,197,94,0.3); }
        .pgc-btn-green:hover { background:rgba(34,197,94,0.18); transform:translateY(-2px); }
        .pgc-btn-disabled { opacity:.6; pointer-events:none; }

        /* Gold divider */
        .gold-divider { width:100%; height:1px; background:linear-gradient(90deg, transparent, var(--gold), var(--indigo-light), var(--gold), transparent); }

        /* Bio strip */
        .pgc-bio {
            padding:30px 52px;
            background:linear-gradient(90deg, var(--gold-pale), white, var(--indigo-pale));
            font-size:18px; color:var(--text-mid);
            line-height:1.9; font-style:italic;
            font-family:'Cormorant Garamond',serif;
        }
        .pgc-bio-quote { color:var(--gold); font-size:38px; line-height:0; vertical-align:-14px; margin-right:5px; }

        /* Quick stats */
        .pgc-quick-info { display:flex; gap:0; border-top:1px solid rgba(67,56,202,0.1); }
        .pgc-qi-item { flex:1; padding:22px 20px; text-align:center; border-right:1px solid rgba(67,56,202,0.08); }
        .pgc-qi-item:last-child { border-right:none; }
        .pgc-qi-num { font-family:'Cormorant Garamond',serif; font-size:32px; font-weight:700; color:var(--indigo); }
        .pgc-qi-num sup { font-size:14px; color:var(--gold); }
        .pgc-qi-lbl { font-size:10px; color:var(--text-light); text-transform:uppercase; letter-spacing:1.5px; margin-top:4px; }

        /* ═══════════════════════════════════════════
           MAIN WRAPPER
        ═══════════════════════════════════════════ */
        .main-wrap {
            position:relative; z-index:10;
            max-width:1160px; margin:0 auto;
            padding:0 32px 80px;
        }

        /* ── Section Header ── */
        .lx-section-header {
            display:flex; align-items:center; gap:20px;
            margin:76px 0 38px;
        }
        .lxsh-ornament { display:flex; flex-direction:column; align-items:center; gap:3px; flex-shrink:0; }
        .lxsh-dot { width:6px; height:6px; background:var(--gold); border-radius:50%; }
        .lxsh-line { width:2px; height:32px; background:linear-gradient(180deg, var(--gold), transparent); }
        .lxsh-titles { flex:1; }
        .lxsh-eyebrow { font-size:10px; color:var(--gold); text-transform:uppercase; letter-spacing:3px; font-weight:700; margin-bottom:6px; }
        .lxsh-title { font-family:'Cormorant Garamond',serif; font-size:clamp(28px,4vw,44px); font-weight:700; color:var(--navy); line-height:1.1; }
        .lxsh-title em { font-style:italic; color:var(--gold); }
        .lxsh-title-white { color:white; }
        .lxsh-title-white em { color:#fcd34d; }
        .lxsh-eyebrow-white { color:#fcd34d; }
        .lxsh-rule { flex:1; height:1px; background:linear-gradient(90deg, rgba(217,119,6,0.4), transparent); }

        /* ═══════════════════════════════════════════
           STATS ROW
           BG: Lecture hall / university classroom
        ═══════════════════════════════════════════ */
        .stats-row {
            margin-top:60px;
            border-radius:18px; overflow:hidden;
            position:relative; min-height:200px;
            display:flex; align-items:center;

            background-image:
                linear-gradient(90deg, rgba(15,23,42,0.93) 0%, rgba(15,23,42,0.76) 50%, rgba(15,23,42,0.93) 100%),
                url('https://images.unsplash.com/photo-1562774053-701939374585?w=1920&q=80');
            background-size:cover; background-position:center 40%;
            box-shadow:0 20px 60px rgba(15,23,42,0.25);
        }
        .stats-row::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gold),var(--indigo-light),transparent); }
        .stats-row::after  { content:''; position:absolute; bottom:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--indigo-light),var(--gold),transparent); }
        .stats-row-inner {
            position:relative; z-index:2; width:100%;
            display:grid; grid-template-columns:repeat(5,1fr);
            gap:0; padding:44px 0;
        }
        .stat-lx { text-align:center; padding:20px 16px; border-right:1px solid rgba(255,255,255,0.07); }
        .stat-lx:last-child { border-right:none; }
        .stat-lx-icon { font-size:24px; color:var(--gold-light); margin-bottom:14px; opacity:0.85; }
        .stat-lx-num { font-family:'Cormorant Garamond',serif; font-size:46px; font-weight:700; color:white; line-height:1; margin-bottom:6px; }
        .stat-lx-num sup { font-size:20px; color:#fcd34d; }
        .stat-lx-label { font-size:10px; color:rgba(255,255,255,0.48); text-transform:uppercase; letter-spacing:1.5px; }

        /* ═══════════════════════════════════════════
           ABOUT SECTION
           BG: Library shelves image watermark
        ═══════════════════════════════════════════ */
        .about-card {
            border-radius:18px; overflow:hidden;
            position:relative;
            background: white;
            border:1px solid rgba(67,56,202,0.1);
            box-shadow:0 8px 32px rgba(15,23,42,0.08);
        }
        .about-card::after {
            content:''; position:absolute; inset:0;
            background-image: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1200&q=30');
            background-size:cover; background-position:center;
            opacity:0.03; pointer-events:none;
        }
        .about-card-inner { position:relative; z-index:2; padding:44px 52px; }
        .about-text {
            font-size:16px; line-height:2;
            color:var(--text-mid);
            font-family:'Poppins',sans-serif; font-weight:400;
        }

        /* ═══════════════════════════════════════════
           COURSES SECTION
           BG per card: subject-specific photos
        ═══════════════════════════════════════════ */
        .courses-section-wrap {
            border-radius:20px; overflow:hidden;
            position:relative;
            padding:60px 52px;
            background-image:
                linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,41,59,0.92) 100%),
                url('https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=1920&q=80');
            background-size:cover; background-position:center;
            box-shadow:0 20px 60px rgba(15,23,42,0.2);
        }
        .courses-section-wrap::before {
            content:''; position:absolute; top:0;left:0;right:0; height:3px;
            background:linear-gradient(90deg, var(--gold), var(--indigo-light), var(--gold-light), var(--indigo));
        }
        .courses-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
            gap:24px; margin-top:40px;
        }
        .course-lx-card {
            border-radius:14px; overflow:hidden;
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.10);
            backdrop-filter:blur(10px);
            transition:all .35s;
            position:relative;
        }
        .course-lx-card::before {
            content:''; position:absolute; top:0;left:0;right:0; height:2px;
            background:linear-gradient(90deg,var(--gold),transparent);
            transform:scaleX(0); transition:transform .3s;
        }
        .course-lx-card:hover::before { transform:scaleX(1); }
        .course-lx-card:hover { background:rgba(255,255,255,0.10); border-color:rgba(245,158,11,0.3); transform:translateY(-5px); }

        /* Course header bg — cycling through subject photos */
        .course-img-wrap {
            height:160px; position:relative;
            background-size:cover; background-position:center;
            overflow:hidden;
        }
        .course-img-wrap::after {
            content:''; position:absolute; inset:0;
            background:linear-gradient(to top, rgba(15,23,42,0.80), transparent 60%);
        }
        .course-img-wrap:nth-child(1) { background-image:url('https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=600&q=70'); }

        /* Subject icons on dark overlay */
        .course-icon-over {
            position:absolute; bottom:12px; left:16px; z-index:2;
            width:48px; height:48px; border-radius:10px;
            background:linear-gradient(135deg, var(--indigo), var(--indigo-light));
            display:flex; align-items:center; justify-content:center;
            font-size:20px; color:white;
            box-shadow:0 6px 20px rgba(67,56,202,0.4);
        }
        .course-lx-body { padding:20px 20px 24px; }
        .course-lx-name { font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:700; color:white; margin-bottom:8px; }
        .course-lx-info { font-size:13px; color:rgba(255,255,255,0.58); line-height:1.7; margin-bottom:12px; }
        .course-lx-meta {
            display:flex; justify-content:space-between; align-items:center;
            padding-top:12px; border-top:1px solid rgba(255,255,255,0.08);
        }
        .course-lx-dur { font-size:12px; color:rgba(255,255,255,0.5); display:flex; align-items:center; gap:5px; }
        .course-lx-dur i { color:var(--gold-light); }
        .course-lx-fee { font-size:16px; font-weight:700; color:#fcd34d; font-family:'Cormorant Garamond',serif; }

        /* Default course icon colors cycle */
        .ci-c1 { background:linear-gradient(135deg,#4338ca,#6366f1); }
        .ci-c2 { background:linear-gradient(135deg,#0f766e,#14b8a6); }
        .ci-c3 { background:linear-gradient(135deg,#b45309,#d97706); }
        .ci-c4 { background:linear-gradient(135deg,#9d174d,#ec4899); }
        .ci-c5 { background:linear-gradient(135deg,#1d4ed8,#3b82f6); }
        .ci-c6 { background:linear-gradient(135deg,#166534,#22c55e); }

        /* Default course bg images */
        .cibg-1 { background-image:url('https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=600&q=70'); }
        .cibg-2 { background-image:url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&q=70'); }
        .cibg-3 { background-image:url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&q=70'); }
        .cibg-4 { background-image:url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&q=70'); }
        .cibg-5 { background-image:url('https://images.unsplash.com/photo-1532012197267-da84d127e765?w=600&q=70'); }
        .cibg-6 { background-image:url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=600&q=70'); }

        /* ═══════════════════════════════════════════
           RESULTS SECTION
           BG: Trophy / award ceremony photo
        ═══════════════════════════════════════════ */
        .results-wrap {
            border-radius:18px; overflow:hidden;
            position:relative;
            background-image:
                linear-gradient(135deg, rgba(253,252,232,0.97) 0%, rgba(238,242,255,0.96) 100%),
                url('https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=1920&q=50');
            background-size:cover; background-position:center;
            border:1px solid rgba(217,119,6,0.15);
            padding:52px 48px;
        }
        .results-wrap::before {
            content:''; position:absolute; top:0;left:0;right:0; height:3px;
            background:linear-gradient(90deg, transparent, var(--gold), var(--indigo-light), var(--gold), transparent);
        }
        .results-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
            gap:20px; margin-top:38px;
        }
        .result-lx-card {
            background:white;
            border-radius:16px; padding:32px 24px;
            text-align:center;
            border-left:4px solid var(--gold);
            box-shadow:0 8px 28px rgba(217,119,6,0.10);
            transition:all .3s; position:relative; overflow:hidden;
        }
        .result-lx-card::after {
            content:''; position:absolute; inset:0;
            background:linear-gradient(135deg, rgba(217,119,6,0.03), transparent);
        }
        .result-lx-card:hover { transform:translateY(-6px); box-shadow:0 16px 40px rgba(217,119,6,0.2); border-left-color:var(--indigo); }
        .result-lx-num { font-family:'Cormorant Garamond',serif; font-size:52px; font-weight:700; color:var(--indigo); line-height:1; margin-bottom:8px; position:relative; z-index:1; }
        .result-lx-label { font-size:14px; color:var(--text-mid); font-weight:600; position:relative; z-index:1; }
        .result-lx-icon { font-size:28px; color:var(--gold); margin-bottom:12px; }

        /* ═══════════════════════════════════════════
           FACULTY SECTION
        ═══════════════════════════════════════════ */
        .faculty-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
            gap:24px;
        }
        .faculty-lx-card {
            background:white; border-radius:16px;
            overflow:hidden;
            border:1px solid rgba(67,56,202,0.1);
            box-shadow:0 6px 24px rgba(15,23,42,0.07);
            transition:all .3s; position:relative;
        }
        .faculty-lx-card::before {
            content:''; position:absolute; top:0;left:0;right:0; height:2px;
            background:linear-gradient(90deg, var(--indigo), var(--gold-light));
            transform:scaleX(0); transition:transform .3s;
        }
        .faculty-lx-card:hover::before { transform:scaleX(1); }
        .faculty-lx-card:hover { border-color:var(--indigo); transform:translateY(-5px); box-shadow:0 16px 44px rgba(67,56,202,0.14); }

        /* Faculty card top bg */
        .faculty-card-top {
            height:120px;
            background-image:
                linear-gradient(135deg, rgba(15,23,42,0.85), rgba(67,56,202,0.70)),
                url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=600&q=60');
            background-size:cover; background-position:center;
            display:flex; align-items:center; justify-content:center;
            position:relative;
        }
        .faculty-avatar-ring {
            width:80px; height:80px; padding:3px;
            background:linear-gradient(135deg, var(--gold), var(--gold-light), var(--indigo-light));
            border-radius:50%;
            position:absolute; bottom:-30px;
            box-shadow:0 8px 24px rgba(67,56,202,0.3);
        }
        .faculty-avatar-inner {
            width:100%; height:100%; border-radius:50%;
            background:linear-gradient(135deg, var(--navy), var(--navy-mid));
            display:flex; align-items:center; justify-content:center;
            color:#fcd34d; font-size:26px;
        }
        .faculty-avatar-inner img { width:100%; height:100%; object-fit:cover; border-radius:50%; }
        .faculty-lx-body { padding:44px 24px 28px; text-align:center; }
        .faculty-lx-name { font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:700; color:var(--navy); margin-bottom:6px; }
        .faculty-lx-qual { font-size:13px; color:var(--text-mid); line-height:1.6; }
        .faculty-lx-subj {
            display:inline-flex; align-items:center; gap:5px;
            margin-top:12px; padding:5px 14px;
            background:var(--indigo-pale); color:var(--indigo);
            border-radius:30px; font-size:11px; font-weight:700; letter-spacing:1px;
        }

        /* ═══════════════════════════════════════════
           TESTIMONIALS
           BG: Students in campus / celebration photo
        ═══════════════════════════════════════════ */
        .testi-section {
            border-radius:20px; overflow:hidden;
            position:relative;
            padding:56px 48px;
            background-image:
                linear-gradient(135deg, rgba(238,242,255,0.97) 0%, rgba(253,252,232,0.95) 100%),
                url('https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?w=1920&q=50');
            background-size:cover; background-position:center;
            border:1px solid rgba(67,56,202,0.12);
        }
        .testi-section::before {
            content:''; position:absolute; top:0;left:0;right:0; height:3px;
            background:linear-gradient(90deg, transparent, var(--indigo), var(--gold), var(--indigo), transparent);
        }
        .testi-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
            gap:24px; margin-top:38px;
        }
        .testi-lx-card {
            background:white; border-radius:14px; padding:30px;
            box-shadow:0 8px 28px rgba(15,23,42,0.08);
            border:1px solid rgba(67,56,202,0.08);
            position:relative; transition:all .3s;
        }
        .testi-lx-card:hover { transform:translateY(-5px); box-shadow:0 16px 44px rgba(15,23,42,0.12); border-color:rgba(67,56,202,0.25); }
        .testi-stars { color:var(--gold-light); font-size:14px; margin-bottom:14px; letter-spacing:2px; }
        .testi-quote-mark { font-size:64px; color:var(--indigo-pale); font-family:Georgia,serif; line-height:0; position:absolute; top:18px; right:18px; opacity:0.5; }
        .testi-text { font-size:14px; color:var(--text-mid); line-height:1.85; margin-bottom:22px; font-style:italic; }
        .testi-author { display:flex; align-items:center; gap:14px; }
        .testi-avatar { width:46px; height:46px; border-radius:50%; background:linear-gradient(135deg, var(--navy), var(--navy-mid)); display:flex; align-items:center; justify-content:center; color:#fcd34d; font-weight:700; font-size:18px; flex-shrink:0; }
        .testi-avatar img { width:100%; height:100%; border-radius:50%; object-fit:cover; }
        .testi-name { font-size:15px; font-weight:700; color:var(--navy); }
        .testi-sub { font-size:12px; color:var(--text-light); margin-top:2px; }
        .testi-sub i { color:var(--gold); margin-right:3px; }

        /* ═══════════════════════════════════════════
           QUALIFICATIONS TIMELINE
        ═══════════════════════════════════════════ */
        .quali-wrap {
            padding: 20px 0;
            position: relative;
        }
        .quali-timeline { position:relative; padding-left:36px; }
        .quali-timeline::before { content:''; position:absolute; left:11px; top:0; bottom:0; width:2px; background:linear-gradient(180deg, var(--indigo), var(--gold), transparent); }
        .quali-item { position:relative; padding:0 0 38px 30px; }
        .quali-dot { position:absolute; left:-25px; top:5px; width:14px; height:14px; background:var(--gold); border-radius:50%; border:3px solid var(--cream); box-shadow:0 0 0 3px rgba(217,119,6,0.25); }
        .quali-year { font-size:11px; color:var(--gold); font-weight:700; letter-spacing:2px; text-transform:uppercase; margin-bottom:5px; }
        .quali-title-text { font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:700; color:var(--navy); margin-bottom:5px; }
        .quali-institute { font-size:13px; color:var(--text-mid); }

        /* ═══════════════════════════════════════════
           EXPERIENCE TIMELINE
        ═══════════════════════════════════════════ */
        .exp-timeline { position:relative; padding-left:36px; }
        .exp-timeline::before { content:''; position:absolute; left:11px; top:0; bottom:0; width:2px; background:linear-gradient(180deg, var(--indigo-light), var(--indigo), transparent); }
        .exp-item { position:relative; padding:0 0 38px 30px; }
        .exp-dot { position:absolute; left:-25px; top:5px; width:14px; height:14px; background:var(--indigo); border-radius:50%; border:3px solid var(--cream); box-shadow:0 0 0 3px rgba(67,56,202,0.25); }

        /* ═══════════════════════════════════════════
           VIDEO GALLERY
        ═══════════════════════════════════════════ */
        .video-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:24px; }
        .video-card { border-radius:14px; overflow:hidden; aspect-ratio:16/9; box-shadow:0 12px 36px rgba(0,0,0,0.14); position:relative; }
        .video-card iframe { width:100%; height:100%; border:none; display:block; }
        .video-placeholder { width:100%; height:100%; background:linear-gradient(135deg,var(--navy),var(--navy-mid)); display:flex; align-items:center; justify-content:center; }
        .video-play-icon { width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,var(--gold),var(--gold-light)); display:flex; align-items:center; justify-content:center; color:var(--navy); font-size:22px; padding-left:5px; box-shadow:0 8px 24px rgba(217,119,6,0.5); }

        /* ═══════════════════════════════════════════
           THOUGHTS / BLOG
        ═══════════════════════════════════════════ */
        .thoughts-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(320px,1fr)); gap:24px; }
        .thought-card {
            background:white; border-radius:14px; overflow:hidden;
            border:1px solid rgba(67,56,202,0.1);
            box-shadow:0 6px 22px rgba(15,23,42,0.07); transition:all .3s;
        }
        .thought-card:hover { transform:translateY(-5px); box-shadow:0 14px 40px rgba(67,56,202,0.14); border-color:rgba(67,56,202,0.25); }
        .thought-img { height:180px; overflow:hidden; }
        .thought-img img { width:100%; height:100%; object-fit:cover; transition:transform .5s; }
        .thought-card:hover .thought-img img { transform:scale(1.05); }
        .thought-body { padding:22px 24px; }
        .thought-date { font-size:11px; color:var(--gold); font-weight:700; letter-spacing:2px; text-transform:uppercase; margin-bottom:8px; }
        .thought-title { font-family:'Cormorant Garamond',serif; font-size:20px; font-weight:700; color:var(--navy); margin-bottom:8px; }
        .thought-desc { font-size:13px; color:var(--text-mid); line-height:1.7; }

        /* ═══════════════════════════════════════════
           UPLOAD FILES / DOCS
        ═══════════════════════════════════════════ */
        .docs-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:20px; }
        .doc-card {
            background:white; border-radius:12px; padding:22px 26px;
            border:1px solid rgba(67,56,202,0.1);
            box-shadow:0 4px 18px rgba(15,23,42,0.06);
            display:flex; align-items:center; gap:16px; transition:all .3s;
        }
        .doc-card:hover { border-color:var(--indigo); transform:translateY(-3px); box-shadow:0 10px 32px rgba(67,56,202,0.14); }
        .doc-icon { width:50px; height:50px; flex-shrink:0; background:var(--indigo-pale); border:1px solid rgba(67,56,202,0.2); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:20px; color:var(--indigo); }
        .doc-name { font-size:14px; font-weight:600; color:var(--navy); }
        .doc-sub { font-size:12px; color:var(--text-light); margin-top:2px; }
        .doc-dl { margin-left:auto; color:var(--gold); font-size:18px; transition:transform .2s; }
        .doc-dl:hover { transform:translateY(-2px); }

        /* ═══════════════════════════════════════════
           ADMISSION CTA
           BG: Graduation ceremony photo
        ═══════════════════════════════════════════ */
        .cta-section {
            margin-top:76px; border-radius:20px; overflow:hidden;
            position:relative; min-height:420px;
            display:flex; align-items:center; justify-content:center; text-align:center;
            background-image:
                linear-gradient(135deg, rgba(15,23,42,0.87) 0%, rgba(15,23,42,0.72) 50%, rgba(15,23,42,0.87) 100%),
                url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1920&q=85');
            background-size:cover; background-position:center 25%;
            box-shadow:0 24px 72px rgba(15,23,42,0.25);
        }
        .cta-section::before { content:''; position:absolute; top:0;left:0;right:0; height:3px; background:linear-gradient(90deg,transparent,var(--gold),transparent); }
        .cta-section::after  { content:''; position:absolute; bottom:0;left:0;right:0; height:3px; background:linear-gradient(90deg,transparent,var(--indigo-light),transparent); }
        .cta-dots {
            position:absolute; inset:0;
            background-image:radial-gradient(circle, rgba(245,158,11,0.14) 1px, transparent 1px);
            background-size:42px 42px; pointer-events:none;
        }
        .cta-inner { position:relative; z-index:2; padding:72px 32px; max-width:720px; }
        .cta-eyebrow {
            display:inline-block; padding:7px 22px;
            border:1px solid rgba(245,158,11,0.45); border-radius:30px;
            color:#fcd34d; font-size:10px; letter-spacing:3px; text-transform:uppercase; font-weight:700;
            margin-bottom:24px;
        }
        .cta-title { font-family:'Cormorant Garamond',serif; font-size:clamp(36px,6vw,62px); font-weight:700; color:white; line-height:1.1; margin-bottom:18px; }
        .cta-title em { font-style:italic; color:#fcd34d; }
        .cta-sub { font-size:16px; color:rgba(255,255,255,0.72); line-height:1.75; margin-bottom:38px; }
        .cta-btns { display:flex; justify-content:center; gap:14px; flex-wrap:wrap; }

        /* ═══════════════════════════════════════════
           CONTACT SECTION
        ═══════════════════════════════════════════ */
        .contact-grid-lx { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:20px; }
        .contact-lx-card {
            background:white; border-radius:14px; padding:32px;
            text-align:center; border:1px solid rgba(67,56,202,0.12);
            box-shadow:0 4px 20px rgba(15,23,42,0.07); transition:all .3s; position:relative; overflow:hidden;
        }
        .contact-lx-card::before { content:''; position:absolute; bottom:0;left:0;right:0; height:3px; background:linear-gradient(90deg,var(--indigo),var(--gold)); transform:scaleX(0); transition:transform .3s; }
        .contact-lx-card:hover::before { transform:scaleX(1); }
        .contact-lx-card:hover { transform:translateY(-4px); box-shadow:0 14px 44px rgba(67,56,202,0.13); border-color:var(--indigo); }
        .clx-icon { width:60px; height:60px; border-radius:50%; background:var(--indigo-pale); border:1px solid rgba(67,56,202,0.2); display:flex; align-items:center; justify-content:center; font-size:22px; color:var(--indigo); margin:0 auto 16px; }
        .clx-label { font-size:10px; color:var(--text-light); text-transform:uppercase; letter-spacing:2px; margin-bottom:8px; }
        .clx-val { font-size:16px; color:var(--navy); font-weight:700; }
        .clx-val a { color:var(--navy); text-decoration:none; }
        .clx-val a:hover { color:var(--indigo); }

        /* ═══════════════════════════════════════════
           SOCIAL LINKS
        ═══════════════════════════════════════════ */
        .social-lx-row { display:flex; justify-content:center; gap:14px; flex-wrap:wrap; margin-top:42px; }
        .social-lx-btn {
            display:flex; align-items:center; gap:10px;
            padding:13px 26px; background:white;
            border:1px solid rgba(67,56,202,0.18); border-radius:4px;
            color:var(--navy); font-size:13px; font-weight:600;
            text-decoration:none; transition:all .3s;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }
        .social-lx-btn i { font-size:16px; }
        .social-lx-btn:hover { transform:translateY(-3px); box-shadow:0 8px 22px rgba(67,56,202,0.18); color:var(--navy); }
        .slb-fb:hover  { color:#1877f2; border-color:#1877f2; }
        .slb-ig:hover  { color:#e1306c; border-color:#e1306c; }
        .slb-yt:hover  { color:#ff0000; border-color:#ff0000; }
        .slb-li:hover  { color:#0a66c2; border-color:#0a66c2; }
        .slb-tw:hover  { color:#1da1f2; border-color:#1da1f2; }

        /* ═══════════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════════ */
        .lx-footer {
            background:var(--navy); color:rgba(255,255,255,0.48);
            text-align:center; padding:52px 32px;
            font-size:13px; margin-top:80px; position:relative;
        }
        .lx-footer::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gold),var(--indigo-light),transparent); }
        .lx-footer a { color:var(--gold-light); text-decoration:none; font-weight:600; }
        .lx-footer a:hover { color:var(--gold); }
        .lx-footer-brand { font-family:'Cormorant Garamond',serif; font-size:30px; color:white; font-weight:700; letter-spacing:2px; margin-bottom:8px; }
        .lx-footer-tagline { font-size:11px; color:rgba(255,255,255,0.32); letter-spacing:3px; text-transform:uppercase; margin-bottom:26px; }
        .lx-footer-links { display:flex; justify-content:center; gap:22px; flex-wrap:wrap; margin-bottom:22px; }
        .lx-footer-links a { font-size:12px; color:rgba(255,255,255,0.48); }
        .lx-footer-links a:hover { color:var(--gold-light); }
        .lx-footer-divider { width:100px; height:1px; background:linear-gradient(90deg,transparent,var(--gold),transparent); margin:0 auto 22px; }

        /* ═══════════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════════ */
        @media (max-width:1024px) {
            .stats-row-inner { grid-template-columns:repeat(3,1fr); }
        }
        @media (max-width:768px) {
            .hero-banner { min-height:480px; }
            .hero-name { font-size:42px; }
            .hero-btns { flex-direction:column; max-width:280px; }
            .hero-stats-strip { display:none; }
            .profile-card-wrap { margin-top:-44px; padding:0 16px; }
            .pgc-inner { flex-direction:column; align-items:center; text-align:center; padding:34px 22px; }
            .pgc-actions { justify-content:center; }
            .pgc-bio { padding:24px 22px; }
            .pgc-quick-info { flex-wrap:wrap; }
            .pgc-qi-item { flex:0 0 50%; border-bottom:1px solid rgba(67,56,202,0.08); }
            .main-wrap { padding:0 16px 60px; }
            .stats-row-inner { grid-template-columns:repeat(2,1fr); }
            .courses-section-wrap { padding:36px 22px; }
            .testi-section { padding:36px 22px; }
            .results-wrap { padding:36px 22px; }
            .about-card-inner { padding:32px 22px; }
            .cta-inner { padding:48px 22px; }
            .cta-btns { flex-direction:column; align-items:center; }
            .faculty-grid { grid-template-columns:1fr; }
            .docs-grid { grid-template-columns:1fr; }
            .edu-deco { display:none; }
        }
    </style>
</head>
<body>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> Preview Mode —
        <a href="{{ url('/signin') }}">Sign up</a> to publish your education profile!
    </div>
    @endif

    <!-- ── Floating SVG Decorations ── -->
    <div class="edu-deco edu-deco-1">
        <!-- Graduation Cap -->
        <svg viewBox="0 0 80 80" fill="none"><polygon points="40,10 10,26 40,42 70,26" fill="#4338ca"/><polygon points="40,42 10,26 10,36 40,52" fill="#6366f1" opacity="0.8"/><polygon points="40,42 70,26 70,36 40,52" fill="#818cf8" opacity="0.8"/><line x1="40" y1="10" x2="40" y2="2" stroke="#d97706" stroke-width="2"/><circle cx="40" cy="1" r="4" fill="#d97706"/></svg>
    </div>
    <div class="edu-deco edu-deco-2">
        <!-- Open Book -->
        <svg viewBox="0 0 80 80" fill="none"><rect x="8" y="18" width="30" height="44" rx="3" fill="#4338ca" opacity="0.7"/><rect x="42" y="18" width="30" height="44" rx="3" fill="#6366f1" opacity="0.7"/><line x1="40" y1="18" x2="40" y2="62" stroke="#d97706" stroke-width="2"/><rect x="14" y="26" width="16" height="2" rx="1" fill="white" opacity="0.5"/><rect x="14" y="32" width="20" height="2" rx="1" fill="white" opacity="0.5"/><rect x="14" y="38" width="14" height="2" rx="1" fill="white" opacity="0.5"/><rect x="50" y="26" width="16" height="2" rx="1" fill="white" opacity="0.5"/><rect x="50" y="32" width="20" height="2" rx="1" fill="white" opacity="0.5"/></svg>
    </div>
    <div class="edu-deco edu-deco-3">
        <!-- Star / Award -->
        <svg viewBox="0 0 80 80" fill="none"><polygon points="40,8 46,28 68,28 51,41 57,61 40,49 23,61 29,41 12,28 34,28" fill="#d97706" opacity="0.8"/></svg>
    </div>
    <div class="edu-deco edu-deco-4">
        <!-- Pencil -->
        <svg viewBox="0 0 80 30" fill="none"><rect x="5" y="8" width="60" height="14" rx="3" fill="#f59e0b" opacity="0.7"/><polygon points="5,15 0,8 0,22" fill="#92400e" opacity="0.7"/><rect x="60" y="10" width="10" height="10" fill="#1e293b" opacity="0.5"/></svg>
    </div>
    <div class="edu-deco edu-deco-5">
        <!-- Certificate -->
        <svg viewBox="0 0 80 80" fill="none"><rect x="8" y="10" width="64" height="50" rx="4" fill="#4338ca" opacity="0.6"/><rect x="12" y="14" width="56" height="42" rx="2" fill="#6366f1" opacity="0.4"/><line x1="22" y1="26" x2="58" y2="26" stroke="white" stroke-width="2" opacity="0.5"/><line x1="22" y1="34" x2="58" y2="34" stroke="white" stroke-width="1.5" opacity="0.4"/><line x1="22" y1="40" x2="44" y2="40" stroke="white" stroke-width="1.5" opacity="0.4"/><circle cx="40" cy="65" r="10" fill="#d97706" opacity="0.9"/><polygon points="40,59 42,64 47,64 43,67 45,72 40,69 35,72 37,67 33,64 38,64" fill="white" opacity="0.8"/></svg>
    </div>


    <!-- ══════════════════════════════════════════════════════
         HERO BANNER — Grand University Hall
    ══════════════════════════════════════════════════════ -->
    <section class="hero-banner">
        <div class="hero-accent-line"></div>
        <div class="hero-glow"></div>

        <div class="hero-inner">
            <div class="hero-eyebrow">
                <span class="hero-eyebrow-dot"></span>
                Excellence in Education
            </div>

            @if($userdata->isFeatureVisible('name'))
            <h1 class="hero-name">
                {{ $userdata->name ?? 'Your Name' }}<br>
                <em>Education Institute</em>
            </h1>
            @endif

            @if($userdata->isFeatureVisible('designation') && ($userdata->desig ?? false))
            <p class="hero-desig">{{ $userdata->desig }}</p>
            @endif

            <div class="hero-tags">
                <div class="hero-tag"><i class="fas fa-graduation-cap"></i> Academic Excellence</div>
                @if(($userdata->address ?? false) || ($userdata->city ?? false))
                <div class="hero-tag">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $userdata->city ?? $userdata->address ?? 'India' }}
                </div>
                @endif
                <div class="hero-tag"><i class="fas fa-trophy"></i> Award-Winning Faculty</div>
                <div class="hero-tag"><i class="fas fa-star"></i> Trusted Since Years</div>
            </div>

            <div class="hero-btns">
                @if(isset($isPreview) && $isPreview)
                    <span class="btn-gold" style="opacity:.6;pointer-events:none;">
                        <i class="fas fa-clipboard-list"></i> Apply for Admission
                    </span>
                @elseif(!empty($userdata->slug ?? ''))
                    <a href="{{ url($userdata->slug . '/admission') }}" class="btn-gold">
                        <i class="fas fa-clipboard-list"></i> Apply for Admission
                    </a>
                @endif
                @if($userdata->isFeatureVisible('contact_number') && ($userdata->contact ?? false))
                <a href="tel:{{ $userdata->contact }}" class="btn-indigo">
                    <i class="fas fa-phone"></i> Call Now
                </a>
                @endif
                @if($userdata->isFeatureVisible('whatsapp') && ($userdata->contact ?? false))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->contact) }}" target="_blank" class="btn-green">
                    <i class="fab fa-whatsapp"></i> Enquire on WhatsApp
                </a>
                @endif
            </div>

            <!-- Stats strip -->
            <div class="hero-stats-strip">
                <div class="hss-item">
                    <div class="hss-num">500<sup>+</sup></div>
                    <div class="hss-label">Students Taught</div>
                </div>
                <div class="hss-item">
                    <div class="hss-num">95<sup>%</sup></div>
                    <div class="hss-label">Success Rate</div>
                </div>
                <div class="hss-item">
                    <div class="hss-num">20<sup>+</sup></div>
                    <div class="hss-label">Years Experience</div>
                </div>
                <div class="hss-item">
                    <div class="hss-num">5<sup>★</sup></div>
                    <div class="hss-label">Avg. Rating</div>
                </div>
            </div>
        </div>

        <!-- Wave divider -->
        <div class="hero-wave">
            <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
                <path d="M0 40 Q360 100 720 50 Q1080 10 1440 60 L1440 100 L0 100 Z" fill="#fafaf7"/>
            </svg>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════════════
         PROFILE GLASS CARD
    ══════════════════════════════════════════════════════ -->
    <div class="profile-card-wrap">
        <div class="profile-glass-card">

            <!-- Photo + Info row -->
            <div class="pgc-inner">

                <!-- Profile Photo -->
                <div class="pgc-photo-wrap">
                    <div class="pgc-photo-ring">
                        <div class="pgc-photo">
                            @if($userdata->isFeatureVisible('profile_photo') && isset($userdata->profile) && $userdata->profile)
                                <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}"
                                     alt="{{ $userdata->name }}" loading="lazy">
                            @else
                                <div class="pgc-photo-placeholder">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="pgc-verified" title="Verified Educational Institution">
                        <i class="fas fa-check"></i>
                    </div>
                </div>

                <!-- Info -->
                <div class="pgc-info">
                    <div class="pgc-luxury-label">
                        <i class="fas fa-university"></i> Premier Education Institute
                    </div>

                    @if($userdata->isFeatureVisible('name'))
                    <h2 class="pgc-name">{{ $userdata->name ?? 'Institute Name' }}</h2>
                    @endif

                    @if($userdata->isFeatureVisible('designation') && ($userdata->desig ?? false))
                    <p class="pgc-desig">{{ $userdata->desig }}</p>
                    @endif

                    @if($userdata->address ?? false)
                    <p class="pgc-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $userdata->address }}{{ ($userdata->city ?? false) ? ', '.$userdata->city : '' }}
                    </p>
                    @endif

                    <div class="pgc-badges">
                        <span class="pgc-badge"><i class="fas fa-award"></i> Experienced Faculty</span>
                        <span class="pgc-badge"><i class="fas fa-trophy"></i> 100% Results</span>
                        <span class="pgc-badge"><i class="fas fa-clock"></i> 20+ Years</span>
                    </div>

                    <div class="pgc-actions">
                        @if(isset($isPreview) && $isPreview)
                            <span class="pgc-btn pgc-btn-gold pgc-btn-disabled">
                                <i class="fas fa-clipboard-list"></i> Apply Now
                            </span>
                        @elseif(!empty($userdata->slug ?? ''))
                            <a href="{{ url($userdata->slug . '/admission') }}" class="pgc-btn pgc-btn-gold">
                                <i class="fas fa-clipboard-list"></i> Apply Now
                            </a>
                        @endif
                        @if($userdata->isFeatureVisible('contact_number') && ($userdata->contact ?? false))
                        <a href="tel:{{ $userdata->contact }}" class="pgc-btn pgc-btn-primary">
                            <i class="fas fa-phone"></i> {{ $userdata->contact }}
                        </a>
                        @endif
                        @if($userdata->isFeatureVisible('whatsapp') && ($userdata->contact ?? false))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->contact) }}" target="_blank" class="pgc-btn pgc-btn-green">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        @endif
                        @if($userdata->isFeatureVisible('email') && ($userdata->email ?? false))
                        <a href="mailto:{{ $userdata->email }}" class="pgc-btn pgc-btn-indigo">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Gold Divider -->
            <div class="gold-divider"></div>

            <!-- Bio Quote Strip -->
            @if($userdata->isFeatureVisible('bio') && ($userdata->about_us ?? false))
            <div class="pgc-bio">
                <span class="pgc-bio-quote">"</span>{{ $userdata->about_us }}"
            </div>
            <div class="gold-divider"></div>
            @endif

            <!-- Quick Stats -->
            <div class="pgc-quick-info">
                <div class="pgc-qi-item">
                    <div class="pgc-qi-num">500<sup>+</sup></div>
                    <div class="pgc-qi-lbl">Students Taught</div>
                </div>
                <div class="pgc-qi-item">
                    <div class="pgc-qi-num">95<sup>%</sup></div>
                    <div class="pgc-qi-lbl">Success Rate</div>
                </div>
                <div class="pgc-qi-item">
                    <div class="pgc-qi-num">20<sup>+</sup></div>
                    <div class="pgc-qi-lbl">Years Experience</div>
                </div>
                <div class="pgc-qi-item">
                    <div class="pgc-qi-num">100<sup>+</sup></div>
                    <div class="pgc-qi-lbl">Toppers Produced</div>
                </div>
                <div class="pgc-qi-item">
                    <div class="pgc-qi-num">24<sup>/7</sup></div>
                    <div class="pgc-qi-lbl">Doubt Support</div>
                </div>
            </div>

        </div><!-- /.profile-glass-card -->
    </div>


    <!-- ══════════════════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════════════════ -->
    <div class="main-wrap">

        <!-- ─────────────────────────────────────
             STATS ROW — Classroom bg
        ───────────────────────────────────── -->
        <div class="stats-row">
            <div class="stats-row-inner">
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-lx-num">500<sup>+</sup></div>
                    <div class="stat-lx-label">Students Taught</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-chart-line"></i></div>
                    <div class="stat-lx-num">95<sup>%</sup></div>
                    <div class="stat-lx-label">Pass Rate</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-trophy"></i></div>
                    <div class="stat-lx-num">100<sup>+</sup></div>
                    <div class="stat-lx-label">Top Rankers</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-book-open"></i></div>
                    <div class="stat-lx-num">20<sup>+</sup></div>
                    <div class="stat-lx-label">Subjects Covered</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-lx-icon"><i class="fas fa-star"></i></div>
                    <div class="stat-lx-num">5<sup>★</sup></div>
                    <div class="stat-lx-label">Avg. Rating</div>
                </div>
            </div>
        </div>


        <!-- ─────────────────────────────────────
             ABOUT SECTION — Library watermark bg
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('bio') && ($userdata->about_us ?? false))
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Our Story</div>
                <h2 class="lxsh-title">About <em>Our Institute</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="about-card">
            <div class="about-card-inner">
                <p class="about-text">{{ $userdata->about_us }}</p>
            </div>
        </div>
        @endif


        <!-- ─────────────────────────────────────
             COURSES — Dark luxury bg with library photo
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('services') && isset($educationCourses) && $educationCourses->count() > 0)
        <div class="courses-section-wrap" style="margin-top:76px;">

            <div class="lx-section-header" style="margin-top:0;">
                <div class="lxsh-ornament">
                    <div class="lxsh-dot"></div>
                    <div class="lxsh-line" style="background:linear-gradient(180deg,var(--gold),transparent);"></div>
                </div>
                <div class="lxsh-titles">
                    <div class="lxsh-eyebrow lxsh-eyebrow-white">What We Teach</div>
                    <h2 class="lxsh-title lxsh-title-white">Courses <em>We Offer</em></h2>
                </div>
                <div class="lxsh-rule" style="background:linear-gradient(90deg,rgba(245,158,11,0.4),transparent);"></div>
            </div>

            @php $ciCycle=['ci-c1','ci-c2','ci-c3','ci-c4','ci-c5','ci-c6']; $bgCycle=['cibg-1','cibg-2','cibg-3','cibg-4','cibg-5','cibg-6']; $icons=['fa-calculator','fa-flask','fa-book','fa-globe','fa-laptop-code','fa-microscope','fa-language','fa-music','fa-paint-brush','fa-dumbbell']; @endphp

            <div class="courses-grid">
                @foreach($educationCourses as $i => $course)
                <div class="course-lx-card">
                    <div class="course-img-wrap {{ $bgCycle[$i % 6] }}">
                        <div class="course-icon-over {{ $ciCycle[$i % 6] }}">
                            <i class="fas {{ $icons[$i % count($icons)] }}"></i>
                        </div>
                    </div>
                    <div class="course-lx-body">
                        <div class="course-lx-name">{{ $course->course_name }}</div>
                        @php $courseMeta = array_filter([$course->class_standard ?? null, $course->board_exam ?? null, $course->mode ?? null]); @endphp
                        @if(!empty($courseMeta))
                        <div class="course-lx-info">{{ implode(' &nbsp;/&nbsp; ', $courseMeta) }}</div>
                        @endif
                        @if($course->description ?? false)
                        <div class="course-lx-info">{{ Str::limit($course->description, 90) }}</div>
                        @endif
                        <div class="course-lx-meta">
                            <span class="course-lx-dur">
                                <i class="far fa-clock"></i>
                                {{ ($course->duration_months ?? false) ? $course->duration_months . ' Months' : 'Flexible' }}
                            </span>
                            <span class="course-lx-fee">{{ $course->fee_structure ?? 'Enquire' }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif


        <!-- ─────────────────────────────────────
             RESULTS — Trophy / award bg
        ───────────────────────────────────── -->
        @if(isset($educationResults) && $educationResults->count() > 0)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Our Track Record</div>
                <h2 class="lxsh-title">Academic <em>Results & Achievements</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="results-wrap">
            <div class="results-grid">
                @foreach($educationResults->take(4) as $result)
                @php
                    $stat = $result->pass_percentage !== null
                        ? rtrim(rtrim(number_format($result->pass_percentage, 1), '0'), '.') . '%'
                        : ($result->total_students ? $result->total_students . '+' : '0');
                @endphp
                <div class="result-lx-card">
                    <div class="result-lx-icon"><i class="fas fa-trophy"></i></div>
                    <div class="result-lx-num">{{ $stat }}</div>
                    <div class="result-lx-label">
                        {{ $result->exam_type ?? 'Exam' }}
                        @if($result->exam_year ?? false) ({{ $result->exam_year }}) @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif


        <!-- ─────────────────────────────────────
             FACULTY
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('qualifications') && isset($educationFaculty) && $educationFaculty->count() > 0)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Meet the Team</div>
                <h2 class="lxsh-title">Our Expert <em>Faculty Members</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="faculty-grid">
            @foreach($educationFaculty as $member)
            @php $facMeta = array_filter([$member->qualification ?? null, $member->specialization ?? null]); @endphp
            <div class="faculty-lx-card">
                <div class="faculty-card-top"></div>
               
                <div class="faculty-lx-body">
                    <div class="faculty-lx-name">{{ $member->faculty_name }}</div>
                    <div class="faculty-lx-qual">{{ $facMeta ? implode(' / ', $facMeta) : 'Faculty Member' }}</div>
                    @if($member->specialization ?? false)
                    <span class="faculty-lx-subj">
                        <i class="fas fa-book"></i> {{ $member->specialization }}
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif


        <!-- ─────────────────────────────────────
             QUALIFICATIONS TIMELINE
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('qualifications') && isset($qualifications) && $qualifications->count() > 0)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Academic Credentials</div>
                <h2 class="lxsh-title">Education &amp; <em>Qualifications</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="about-card">
            <div class="about-card-inner">
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
            </div>
        </div>
        @endif


        <!-- ─────────────────────────────────────
             PROFESSIONAL EXPERIENCE
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('profess') && isset($experiences) && $experiences->count() > 0)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Career Journey</div>
                <h2 class="lxsh-title">Professional <em>Experience</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="about-card">
            <div class="about-card-inner">
                <div class="exp-timeline">
                    @foreach($experiences as $exp)
                    <div class="quali-item">
                        <div class="exp-dot"></div>
                        @if(($exp->from_year ?? false) || ($exp->to_year ?? false))
                        <div class="quali-year">
                            {{ $exp->from_year ?? '' }}
                            {{ (($exp->from_year ?? false) && ($exp->to_year ?? false)) ? '–' : '' }}
                            {{ $exp->to_year ?? '' }}
                        </div>
                        @endif
                        <div class="quali-title-text">{{ $exp->position ?? $exp->title ?? '' }}</div>
                        @if($exp->company ?? false)
                        <div class="quali-institute"><i class="fas fa-building" style="color:var(--indigo-light);margin-right:6px;"></i>{{ $exp->company }}</div>
                        @endif
                        @if($exp->description ?? false)
                        <p style="font-size:13px;color:var(--text-mid);margin-top:6px;line-height:1.75;">{{ $exp->description }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif


        <!-- ─────────────────────────────────────
             VIDEO GALLERY
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('videos') && isset($videos) && $videos->count() > 0)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Watch & Learn</div>
                <h2 class="lxsh-title">Video <em>Gallery</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="video-grid">
            @foreach($videos as $video)
            @php
                $videoUrl = $video->url ?? $video->link ?? '';
                preg_match('/(?:youtu\.be\/|youtube\.com\/(?:.*v=|.*\/))([^&\?\/]{11})/', $videoUrl, $ytm);
                $ytId = $ytm[1] ?? null;
            @endphp
            <div class="video-card">
                @if($ytId)
                <iframe
                    src="https://www.youtube.com/embed/{{ $ytId }}?rel=0&modestbranding=1"
                    title="{{ $video->title ?? 'Educational Video' }}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen loading="lazy">
                </iframe>
                @else
                <div class="video-placeholder">
                    <div class="video-play-icon"><i class="fas fa-play"></i></div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif


        <!-- ─────────────────────────────────────
             TESTIMONIALS / STUDENT REVIEWS
             BG: campus photo
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('testimonials') && isset($testimonials) && $testimonials->count() > 0)
        <div class="testi-section" style="margin-top:76px;">

            <div class="lx-section-header" style="margin-top:0;">
                <div class="lxsh-ornament">
                    <div class="lxsh-dot"></div>
                    <div class="lxsh-line"></div>
                </div>
                <div class="lxsh-titles">
                    <div class="lxsh-eyebrow">Student Voices</div>
                    <h2 class="lxsh-title">What Our <em>Students Say</em></h2>
                </div>
                <div class="lxsh-rule"></div>
            </div>

            <div class="testi-grid">
                @foreach($testimonials->take(6) as $testi)
                <div class="testi-lx-card">
                    <div class="testi-stars">★★★★★</div>
                    <div class="testi-quote-mark">"</div>
                    <p class="testi-text">{{ $testi->description }}</p>
                    <div class="testi-author">
                        <div class="testi-avatar">
                            {{ strtoupper(substr($testi->name ?? 'S', 0, 1)) }}
                        </div>
                        <div>
                            <div class="testi-name">{{ $testi->name }}</div>
                            <div class="testi-sub"><i class="fas fa-graduation-cap"></i> Happy Student</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif


        <!-- ─────────────────────────────────────
             THOUGHTS / BLOG
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('thought') && isset($thoughts) && $thoughts->count() > 0)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Knowledge Corner</div>
                <h2 class="lxsh-title">Educational <em>Insights & Articles</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="thoughts-grid">
            @foreach($thoughts as $thought)
            <div class="thought-card">
                @if($thought->image ?? false)
                <div class="thought-img">
                    <img src="{{ url('uploads/thoughts/'.$thought->image) }}" alt="{{ $thought->title ?? '' }}" loading="lazy">
                </div>
                @endif
                <div class="thought-body">
                    @if($thought->created_at ?? false)
                    <div class="thought-date">
                        <i class="fas fa-calendar-alt" style="margin-right:5px;"></i>
                        {{ \Carbon\Carbon::parse($thought->created_at)->format('d M Y') }}
                    </div>
                    @endif
                    <div class="thought-title">{{ $thought->title ?? '' }}</div>
                    @if($thought->description ?? false)
                    <p class="thought-desc">{{ Str::limit($thought->description, 130) }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif


        <!-- ─────────────────────────────────────
             UPLOAD FILES / BROCHURES
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('upload_file') && isset($upload_files) && $upload_files->count() > 0)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Resources</div>
                <h2 class="lxsh-title">Brochures &amp; <em>Downloads</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="docs-grid">
            @foreach($upload_files as $file)
            @php
                $ext = strtolower(pathinfo($file->file ?? '', PATHINFO_EXTENSION));
                $docIcon = match($ext) {
                    'pdf'  => 'fa-file-pdf',
                    'doc', 'docx' => 'fa-file-word',
                    'xls', 'xlsx' => 'fa-file-excel',
                    'ppt', 'pptx' => 'fa-file-powerpoint',
                    'jpg','jpeg','png','webp' => 'fa-file-image',
                    default => 'fa-file-alt',
                };
            @endphp
            <div class="doc-card">
                <div class="doc-icon"><i class="fas {{ $docIcon }}"></i></div>
                <div>
                    <div class="doc-name">{{ $file->title ?? $file->name ?? 'Document' }}</div>
                    <div class="doc-sub">{{ strtoupper($ext ?? 'FILE') }} • Click to download</div>
                </div>
                <a href="{{ url('uploads/files/'.$file->file) }}" target="_blank" class="doc-dl" download>
                    <i class="fas fa-download"></i>
                </a>
            </div>
            @endforeach
        </div>
        @endif


        <!-- ─────────────────────────────────────
             ADMISSION CTA — Graduation ceremony bg
        ───────────────────────────────────── -->
        <div class="cta-section" id="contact-section">
            <div class="cta-dots"></div>
            <div class="cta-inner">
                <div class="cta-eyebrow">Begin Your Journey</div>
                <h2 class="cta-title">Shape Your <em>Future Today</em></h2>
                <p class="cta-sub">
                    Join hundreds of successful students who have transformed their academic journey with us.
                    Enrol now and experience education at its finest — expert faculty, proven results, and unwavering support.
                </p>
                <div class="cta-btns">
                    @if(isset($isPreview) && $isPreview)
                        <span class="btn-gold" style="opacity:.6;pointer-events:none;">
                            <i class="fas fa-clipboard-list"></i> Apply for Admission
                        </span>
                    @elseif(!empty($userdata->slug ?? ''))
                        <a href="{{ url($userdata->slug . '/admission') }}" class="btn-gold">
                            <i class="fas fa-clipboard-list"></i> Apply for Admission
                        </a>
                    @endif
                    @if($userdata->isFeatureVisible('contact_number') && ($userdata->contact ?? false))
                    <a href="tel:{{ $userdata->contact }}" class="btn-indigo">
                        <i class="fas fa-phone"></i> Call Us Now
                    </a>
                    @endif
                    @if($userdata->isFeatureVisible('whatsapp') && ($userdata->contact ?? false))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->contact) }}" target="_blank" class="btn-green">
                        <i class="fab fa-whatsapp"></i> Chat With Us
                    </a>
                    @endif
                </div>
            </div>
        </div>


        <!-- ─────────────────────────────────────
             CONTACT INFORMATION
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('contact_number') || $userdata->isFeatureVisible('email') || $userdata->isFeatureVisible('address'))
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Reach Us</div>
                <h2 class="lxsh-title">Contact <em>Information</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="contact-grid-lx">
            @if($userdata->isFeatureVisible('contact_number') && ($userdata->contact ?? false))
            <div class="contact-lx-card">
                <div class="clx-icon"><i class="fas fa-phone"></i></div>
                <div class="clx-label">Phone / Mobile</div>
                <div class="clx-val"><a href="tel:{{ $userdata->contact }}">{{ $userdata->contact }}</a></div>
            </div>
            @endif
            @if($userdata->isFeatureVisible('email') && ($userdata->email ?? false))
            <div class="contact-lx-card">
                <div class="clx-icon"><i class="fas fa-envelope"></i></div>
                <div class="clx-label">Email Address</div>
                <div class="clx-val"><a href="mailto:{{ $userdata->email }}">{{ $userdata->email }}</a></div>
            </div>
            @endif
            @if($userdata->isFeatureVisible('address') && ($userdata->address ?? false))
            <div class="contact-lx-card">
                <div class="clx-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="clx-label">Institute Address</div>
                <div class="clx-val" style="font-size:14px;">{{ $userdata->address }}</div>
            </div>
            @endif
            @if($userdata->isFeatureVisible('whatsapp') && ($userdata->contact ?? false))
            <div class="contact-lx-card">
                <div class="clx-icon" style="color:#16a34a;background:rgba(34,197,94,0.08);border-color:rgba(34,197,94,0.2);">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div class="clx-label">WhatsApp</div>
                <div class="clx-val">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->contact) }}" target="_blank" style="color:#16a34a;">
                        {{ $userdata->contact }}
                    </a>
                </div>
            </div>
            @endif
        </div>
        @endif


        <!-- ─────────────────────────────────────
             SOCIAL MEDIA LINKS
        ───────────────────────────────────── -->
        @if($userdata->isFeatureVisible('social_media') && isset($social) && $social)
        <div class="lx-section-header">
            <div class="lxsh-ornament">
                <div class="lxsh-dot"></div>
                <div class="lxsh-line"></div>
            </div>
            <div class="lxsh-titles">
                <div class="lxsh-eyebrow">Stay Connected</div>
                <h2 class="lxsh-title">Follow Us on <em>Social Media</em></h2>
            </div>
            <div class="lxsh-rule"></div>
        </div>

        <div class="social-lx-row">
            @if($userdata->isFeatureVisible('facebook') && ($social->facebook ?? false))
            <a href="{{ $social->facebook }}" target="_blank" class="social-lx-btn slb-fb">
                <i class="fab fa-facebook"></i> Facebook
            </a>
            @endif
            @if($userdata->isFeatureVisible('instagram') && ($social->instagram ?? false))
            <a href="{{ $social->instagram }}" target="_blank" class="social-lx-btn slb-ig">
                <i class="fab fa-instagram"></i> Instagram
            </a>
            @endif
            @if($userdata->isFeatureVisible('youtube') && ($social->youtube ?? false))
            <a href="{{ $social->youtube }}" target="_blank" class="social-lx-btn slb-yt">
                <i class="fab fa-youtube"></i> YouTube
            </a>
            @endif
            @if($userdata->isFeatureVisible('linkedin') && ($social->linkedin ?? false))
            <a href="{{ $social->linkedin }}" target="_blank" class="social-lx-btn slb-li">
                <i class="fab fa-linkedin"></i> LinkedIn
            </a>
            @endif
            @if($social->twitter ?? false)
            <a href="{{ $social->twitter }}" target="_blank" class="social-lx-btn slb-tw">
                <i class="fab fa-twitter"></i> Twitter / X
            </a>
            @endif
        </div>
        @endif

    </div><!-- /.main-wrap -->


    <!-- ══════════════════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════════════════ -->
    <footer class="lx-footer">
        <div class="lx-footer-brand">{{ $userdata->name ?? 'Education Institute' }}</div>
        <div class="lx-footer-tagline">Shaping Minds · Building Futures · Inspiring Excellence</div>

        <div class="lx-footer-links">
            @if($userdata->contact ?? false)
            <a href="tel:{{ $userdata->contact }}"><i class="fas fa-phone" style="margin-right:5px;"></i>{{ $userdata->contact }}</a>
            @endif
            @if($userdata->email ?? false)
            <a href="mailto:{{ $userdata->email }}"><i class="fas fa-envelope" style="margin-right:5px;"></i>{{ $userdata->email }}</a>
            @endif
            @if($userdata->isFeatureVisible('whatsapp') && ($userdata->contact ?? false))
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $userdata->contact) }}" target="_blank"><i class="fab fa-whatsapp" style="margin-right:5px;"></i>WhatsApp</a>
            @endif
        </div>

        <div class="lx-footer-divider"></div>

        <p>
            &copy; {{ date('Y') }} {{ $userdata->name ?? 'Education Institute' }} — All Rights Reserved.
            @if($websetting && ($websetting->company_name ?? false))
            &nbsp;|&nbsp; Powered by <a href="#" target="_blank">{{ $websetting->company_name }}</a>
            @endif
        </p>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])

</body>
</html>