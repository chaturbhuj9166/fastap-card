<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Solar Solutions' }} - Solar Energy Profile</title>

    @php
        $websetting = App\Models\websetting::first();
        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile'=>1,'quali'=>1,'service'=>1,'thought'=>1,'personal'=>1,
                'profess'=>1,'videos'=>1,'product'=>1,'social_link'=>1,
                'upload_file'=>1,'client'=>1,'menu_section'=>1,
                'reservation_section'=>1,'property_listings'=>1,'showreel'=>1,
                'team_section'=>1,'pricing_section'=>1,'booking_section'=>1,
            ];
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client','menu_section','reservation_section','property_listings','showreel','team_section','pricing_section','booking_section'], 1);
            }
        }
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;600;700;800;900&family=Barlow+Condensed:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --y:   #fbbf24;   /* yellow */
            --y2:  #f59e0b;
            --o:   #fb923c;   /* orange */
            --g:   #10b981;   /* green */
            --g2:  #059669;
            --dk:  #0c0f0a;   /* near-black */
            --dk2: #111827;
            --dkg: #064e3b;   /* dark green */
            --txt: #1c1917;
            --muted: #78716c;
            --border: #e7e5e4;
            --light-bg: #fffbeb;
        }

        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            color: var(--txt);
            overflow-x: hidden;
        }

        /* ============================
           ANNOUNCEMENT BAR
        ============================ */
        .announce {
            width: 100%;
            background: var(--dkg);
            color: #fff;
            text-align: center;
            padding: 0.45rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            z-index: 300;
            position: relative;
        }
        .announce i { color: var(--y); margin-right: 0.4rem; }
        .announce span { color: var(--y); }

        /* ============================
           FULL SCREEN HERO
           (Solar field background image)
        ============================ */
        .hero {
            position: relative;
            width: 100%;
            min-height: 100vh;
            max-height: 680px;
            background: var(--dk);
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center 40%;
            opacity: 0.45;
        }

        /* Dark gradient: dark left, transparent right */
        .hero-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                105deg,
                rgba(12,15,10,0.92) 0%,
                rgba(12,15,10,0.70) 40%,
                rgba(6,78,59,0.35) 75%,
                transparent 100%
            );
        }

        /* Yellow top stripe */
        .hero-stripe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 4px;
            background: linear-gradient(90deg, var(--y), var(--g), var(--y));
        }

        /* Bottom fade to page bg */
        .hero-fade {
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 180px;
            background: linear-gradient(to bottom, transparent, #f9fafb);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            padding: 0 2.5rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--g);
            color: #fff;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.3rem 0.85rem;
            border-radius: 3px;
            margin-bottom: 1.2rem;
        }

        .hero-title {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(2.4rem, 6vw, 5.5rem);
            font-weight: 900;
            color: #fff;
            line-height: 0.95;
            letter-spacing: -0.02em;
            margin-bottom: 0.8rem;
        }

        .hero-title .accent { color: var(--y); }

        .hero-sub {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: rgba(255,255,255,0.6);
            letter-spacing: 0.18em;
            text-transform: uppercase;
            margin-bottom: 2rem;
        }

        /* Hero inline stats */
        .hero-stats {
            display: flex;
            gap: 2.5rem;
            flex-wrap: wrap;
            margin-bottom: 2.2rem;
        }

        .hs-num {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--y);
            line-height: 1;
        }

        .hs-lbl {
            font-size: 0.65rem;
            color: rgba(255,255,255,0.5);
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 0.15rem;
        }

        /* Hero buttons */
        .hero-btns {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-y {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            background: var(--y);
            color: var(--dk);
            padding: 0.85rem 2rem;
            border-radius: 5px;
            font-weight: 800;
            font-size: 0.85rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.25s;
            border: 2px solid var(--y);
        }

        .btn-y:hover {
            background: var(--y2);
            border-color: var(--y2);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(251,191,36,0.5);
        }

        .btn-ghost-w {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            background: transparent;
            color: #fff;
            padding: 0.83rem 2rem;
            border-radius: 5px;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.4);
            transition: all 0.25s;
        }

        .btn-ghost-w:hover {
            border-color: var(--g);
            color: var(--g);
            transform: translateY(-2px);
        }

        /* ============================
           STICKY NAV
        ============================ */
        .nav-bar {
            width: 100%;
            background: var(--dk2);
            position: sticky;
            top: 0;
            z-index: 200;
            overflow-x: auto;
            scrollbar-width: none;
            border-bottom: 3px solid var(--y);
        }
        .nav-bar::-webkit-scrollbar { display: none; }

        .nav-inner {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            white-space: nowrap;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.88rem 1.1rem;
            color: rgba(255,255,255,0.7);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            margin-bottom: -3px;
            transition: all 0.2s;
        }

        .nav-link i { color: var(--y); font-size: 0.7rem; }

        .nav-link:hover, .nav-link.active {
            color: #fff;
            border-bottom-color: var(--y);
            background: rgba(255,255,255,0.05);
        }

        /* ============================
           PROFILE CARD (3-col horizontal)
        ============================ */
        .pc-wrap {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .pc {
            background: #fff;
            border-radius: 14px;
            padding: 2rem 2.2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border-top: 4px solid var(--y);
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 2rem;
            align-items: center;
            position: relative;
        }

        .pc::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, var(--g), var(--y));
            border-radius: 14px 0 0 14px;
        }

        .pc-avatar-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .pc-avatar {
            width: 92px; height: 92px;
            border-radius: 50%;
            border: 3px solid var(--y);
            object-fit: cover;
            box-shadow: 0 6px 20px rgba(251,191,36,0.35);
        }

        .pc-avatar-ph {
            width: 92px; height: 92px;
            border-radius: 50%;
            border: 3px solid var(--y);
            background: linear-gradient(135deg, var(--y), var(--o));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2rem;
        }

        .pc-avatar-lbl {
            font-size: 0.62rem;
            color: var(--muted);
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .pc-info { min-width: 0; }

        .pc-name {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--txt);
            line-height: 1.1;
            margin-bottom: 0.25rem;
        }

        .pc-desig {
            font-size: 0.78rem;
            color: var(--g);
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .pc-stats {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 0.9rem;
        }

        .pcs-num {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--y2);
            line-height: 1;
        }

        .pcs-num sup { font-size: 0.85rem; color: var(--g); }

        .pcs-lbl {
            font-size: 0.62rem;
            color: var(--muted);
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .pc-tags {
            display: flex;
            gap: 0.45rem;
            flex-wrap: wrap;
        }

        .pc-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: var(--g2);
            font-size: 0.66rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.26rem 0.65rem;
            border-radius: 3px;
        }

        .pc-tag i { color: var(--y); }

        .pc-btns-col {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            min-width: 140px;
        }

        .pcb {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            border-radius: 5px;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
            border: 2px solid transparent;
        }

        .pcb-y { background: var(--y); color: var(--dk); }
        .pcb-y:hover { background: var(--y2); transform: translateY(-1px); }

        .pcb-g { background: var(--g); color: #fff; }
        .pcb-g:hover { background: var(--g2); transform: translateY(-1px); }

        .pcb-out { background: transparent; border-color: var(--border); color: var(--muted); }
        .pcb-out:hover { border-color: var(--y); color: var(--y2); }

        /* ============================
           STATS STRIP (Bold horizontal)
        ============================ */
        .stats-strip {
            background: var(--dk2);
            padding: 0;
            overflow: hidden;
        }

        .stats-strip-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .strip-stat {
            padding: 2rem 1.5rem;
            text-align: center;
            border-right: 1px solid rgba(255,255,255,0.06);
            position: relative;
        }

        .strip-stat:last-child { border-right: none; }

        .strip-stat::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--y);
            transform: scaleX(0);
            transition: transform 0.4s;
        }

        .strip-stat:hover::before { transform: scaleX(1); }

        .ss-num {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.4rem;
            font-weight: 900;
            color: var(--y);
            line-height: 1;
            margin-bottom: 0.4rem;
        }

        .ss-lbl {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        /* ============================
           CONTENT WRAP
        ============================ */
        .cw {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem 3rem;
        }

        /* ============================
           SECTION HEADERS
        ============================ */
        .sec-hdr {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.8rem;
            padding-top: 2rem;
        }

        .sec-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--muted);
            letter-spacing: 0.06em;
            min-width: 26px;
        }

        .sec-bar {
            width: 4px; height: 28px;
            background: var(--y);
            border-radius: 2px;
            flex-shrink: 0;
        }

        .sec-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--txt);
            line-height: 1;
        }

        /* ============================
           01 ABOUT BLOCK
        ============================ */
        .about-block {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            font-size: 1rem;
            line-height: 1.85;
            color: #57534e;
            border-left: 4px solid var(--g);
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }

        /* ============================
           02 SERVICES — image portrait cards
           (Cinematic Studios style)
        ============================ */
        .svc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 0;
            border-radius: 14px;
            overflow: hidden;
        }

        .svc-card {
            position: relative;
            aspect-ratio: 3/4;
            overflow: hidden;
            cursor: pointer;
        }

        .svc-img {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform 0.55s ease;
        }

        .svc-card:hover .svc-img { transform: scale(1.08); }

        .svc-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(12,15,10,0.05) 0%,
                rgba(6,78,59,0.5)  55%,
                rgba(12,15,10,0.95) 100%
            );
        }

        .svc-badge {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            background: var(--y);
            color: var(--dk);
            font-size: 0.58rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.22rem 0.6rem;
            border-radius: 3px;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .svc-bottom {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 1rem;
        }

        .svc-cat {
            font-size: 0.6rem;
            color: var(--y);
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
        }

        .svc-name {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .svc-desc {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.65);
            margin-top: 0.25rem;
            line-height: 1.4;
        }

        /* ============================
           03 WHY SOLAR — SPLIT LAYOUT
           (unique: image left, benefits right)
        ============================ */
        .why-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-radius: 14px;
            overflow: hidden;
            min-height: 420px;
            background: var(--dk2);
        }

        .why-img-col {
            position: relative;
            background-image: url('https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=900&q=80');
            background-size: cover;
            background-position: center;
        }

        .why-img-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to right,
                transparent 60%,
                var(--dk2) 100%
            );
        }

        .why-content-col {
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .why-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--g);
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.25rem 0.7rem;
            border-radius: 3px;
            margin-bottom: 1rem;
            width: fit-content;
        }

        .why-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 1.6rem;
        }

        .why-title span { color: var(--y); }

        .why-list {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        .why-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 0.9rem 1rem;
            background: rgba(255,255,255,0.04);
            border-radius: 8px;
            border-left: 3px solid var(--y);
            transition: all 0.2s;
        }

        .why-item:hover {
            background: rgba(251,191,36,0.08);
            border-left-color: var(--g);
            transform: translateX(4px);
        }

        .why-item-icon {
            width: 36px; height: 36px;
            border-radius: 7px;
            background: rgba(251,191,36,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--y);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .why-item-title {
            font-weight: 700;
            font-size: 0.9rem;
            color: #fff;
            margin-bottom: 0.15rem;
        }

        .why-item-desc {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.5);
            line-height: 1.4;
        }

        /* ============================
           04 INSTALLATION FILMSTRIP
        ============================ */
        .filmstrip {
            display: flex;
            gap: 0.7rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: var(--y) #e5e7eb;
        }

        .filmstrip::-webkit-scrollbar { height: 4px; }
        .filmstrip::-webkit-scrollbar-track { background: #e5e7eb; }
        .filmstrip::-webkit-scrollbar-thumb { background: var(--y); border-radius: 2px; }

        .film-item {
            flex: 0 0 220px;
            aspect-ratio: 16/10;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid var(--border);
            transition: all 0.3s;
            position: relative;
        }

        .film-item:hover {
            border-color: var(--y);
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(251,191,36,0.25);
        }

        .film-item img { width:100%; height:100%; object-fit:cover; }

        .film-ph {
            width:100%; height:100%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d1d5db;
            font-size: 1.8rem;
        }

        /* ============================
           05 PROCESS TIMELINE (horizontal)
        ============================ */
        .process-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0;
            position: relative;
        }

        /* connecting line */
        .process-row::before {
            content: '';
            position: absolute;
            top: 36px;
            left: 10%;
            right: 10%;
            height: 2px;
            background: linear-gradient(90deg, var(--y), var(--g));
            z-index: 0;
        }

        .process-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 0 1rem 1.5rem;
            position: relative;
            z-index: 1;
        }

        .ps-circle {
            width: 72px; height: 72px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid var(--y);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--y2);
            margin-bottom: 1rem;
            box-shadow: 0 4px 16px rgba(251,191,36,0.3);
            flex-shrink: 0;
        }

        .ps-icon {
            width: 72px; height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--y), var(--g));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.6rem;
            margin-bottom: 1rem;
            box-shadow: 0 6px 20px rgba(251,191,36,0.35);
            flex-shrink: 0;
        }

        .ps-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--txt);
            margin-bottom: 0.4rem;
        }

        .ps-desc {
            font-size: 0.78rem;
            color: var(--muted);
            line-height: 1.5;
        }

        /* ============================
           06 PACKAGES / PRICING
        ============================ */
        .pkg-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 1.2rem;
        }

        .pkg-card {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            background: #fff;
            border: 1px solid var(--border);
        }

        .pkg-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(251,191,36,0.2);
            border-color: var(--y);
        }

        .pkg-img {
            height: 130px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .pkg-img-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(12,15,10,0.2), rgba(12,15,10,0.88));
        }

        .pkg-img-label {
            position: absolute;
            bottom: 0.8rem;
            left: 1rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.03em;
        }

        .pkg-body {
            padding: 1.2rem 1.3rem 1.5rem;
        }

        .pkg-price {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--y2);
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .pkg-note {
            font-size: 0.75rem;
            color: var(--muted);
            margin-bottom: 1rem;
        }

        .pkg-feats { margin-bottom: 1.2rem; }

        .pkg-feat {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.4rem 0;
            font-size: 0.85rem;
            color: #44403c;
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }

        .pkg-feat i { color: var(--g); font-size: 0.8rem; flex-shrink: 0; }

        .pkg-cta {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(90deg, var(--y), var(--g));
            color: var(--dk);
            text-align: center;
            font-weight: 800;
            font-size: 0.78rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.25s;
        }

        .pkg-cta:hover {
            box-shadow: 0 6px 18px rgba(251,191,36,0.4);
            transform: scale(1.02);
        }

        /* ============================
           CTA SECTION — FULL BG IMAGE
           "POWER YOUR FUTURE."
        ============================ */
        .cta-sec {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .cta-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1466611653911-95081537e5b7?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center 40%;
            opacity: 0.2;
        }

        .cta-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                110deg,
                rgba(6,78,59,0.97) 0%,
                rgba(12,15,10,0.88) 55%,
                rgba(6,78,59,0.7) 100%
            );
        }

        .cta-y-stripe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 3px;
            background: linear-gradient(90deg, var(--y), var(--g), var(--y));
        }

        .cta-inner {
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            padding: 3.5rem 2.5rem;
            align-items: center;
        }

        .cta-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--y);
            color: var(--dk);
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.25rem 0.7rem;
            border-radius: 3px;
            margin-bottom: 1rem;
        }

        .cta-headline {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(2rem, 4.5vw, 4rem);
            font-weight: 900;
            line-height: 0.92;
            color: #fff;
            letter-spacing: -0.01em;
            margin-bottom: 1.2rem;
        }

        .cta-headline .cta-y { color: var(--y); }

        .cta-desc {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.6);
            line-height: 1.7;
            margin-bottom: 1.8rem;
            max-width: 380px;
        }

        .cta-btns { display: flex; gap: 0.8rem; flex-wrap: wrap; }

        /* Contact info in CTA */
        .ci-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 0.9rem 1.2rem;
            margin-bottom: 0.8rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .ci-item:hover {
            background: rgba(251,191,36,0.1);
            border-color: var(--y);
            transform: translateX(4px);
        }

        .ci-icon {
            width: 40px; height: 40px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .ci-icon.y  { background: var(--y2); color: var(--dk); }
        .ci-icon.g  { background: var(--g); }
        .ci-icon.dg { background: var(--dkg); }
        .ci-icon.wh { background: #25d366; }

        .ci-lbl {
            font-size: 0.6rem;
            color: rgba(255,255,255,0.4);
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.1rem;
        }

        .ci-val {
            font-size: 0.9rem;
            color: #fff;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ============================
           SOCIAL SECTION
        ============================ */
        .social-sec {
            text-align: center;
            padding: 3rem 1.5rem 2rem;
        }

        .soc-eyebrow {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.25rem;
        }

        .soc-eyebrow span { color: var(--g); }

        .soc-heading {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--txt);
            margin-bottom: 1.5rem;
        }

        .soc-icons { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }

        .soc-btn {
            width: 52px; height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: #fff;
            text-decoration: none;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        }

        .soc-btn:hover {
            transform: scale(1.15) translateY(-3px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.2);
        }

        .soc-fb  { background: #1877f2; }
        .soc-ig  { background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); }
        .soc-li  { background: #0077b5; }
        .soc-yt  { background: #ff0000; }
        .soc-wa  { background: #25d366; }

        /* ============================
           FOOTER
        ============================ */
        .footer {
            background: var(--dk2);
            border-top: 3px solid var(--y);
            padding: 1.6rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            color: #fff;
        }

        .footer-brand span { color: var(--y); }

        .footer-sub {
            font-size: 0.6rem;
            color: rgba(255,255,255,0.35);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 0.2rem;
        }

        .footer-copy {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.3);
        }

        .footer-pw {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.3);
        }

        .footer-pw a { color: var(--y); text-decoration: none; }

        /* ============================
           RESPONSIVE
        ============================ */
        @media (max-width: 900px) {
            .pc {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .pc-avatar-col { flex-direction: row; justify-content: center; }
            .pc-stats, .pc-tags { justify-content: center; }
            .pc-btns-col {
                flex-direction: row;
                flex-wrap: wrap;
                min-width: unset;
                justify-content: center;
            }
            .why-split { grid-template-columns: 1fr; }
            .why-img-col { display: none; }
            .why-content-col {
                background: var(--dk2);
                padding: 2rem 1.5rem;
            }
            .cta-inner { grid-template-columns: 1fr; padding: 2rem 1.5rem; }
            .stats-strip-inner { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 600px) {
            .svc-grid { grid-template-columns: repeat(2, 1fr); }
            .pkg-grid { grid-template-columns: 1fr; }
            .footer { flex-direction: column; align-items: center; text-align: center; }
            .process-row::before { display: none; }
        }

        @media (max-width: 400px) {
            .svc-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div style="background:linear-gradient(90deg,#064e3b,#10b981);color:#fff;padding:12px 20px;text-align:center;font-size:13px;font-weight:600;position:sticky;top:0;z-index:1000;">
        <i class="fas fa-eye"></i> Preview Mode —
        <a href="{{ url('/signin') }}" style="color:var(--y);text-decoration:underline;font-weight:700;margin-left:6px;">Sign up</a>
        to publish your solar profile.
    </div>
    @endif

    <!-- ============================
         ANNOUNCEMENT BAR
    ============================ -->
    <div class="announce">
        <i class="fas fa-bolt"></i>
        Switch to Solar & Save Up to 90% on Electricity Bills —
        <span>Free Site Survey Available!</span>
    </div>

    <!-- ============================
         FULL SCREEN HERO
    ============================ -->
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-ov"></div>
        <div class="hero-stripe"></div>
        <div class="hero-fade"></div>

        <div class="hero-content">
            <div class="hero-eyebrow">
                <i class="fas fa-sun"></i> Solar Energy Solutions
            </div>

            @if($userdata->isFeatureVisible('name') ?? true)
            <h1 class="hero-title">
                <span class="accent">{{ explode(' ', $userdata->name ?? 'SOLAR')[0] }}</span><br>
                {{ implode(' ', array_slice(explode(' ', $userdata->name ?? ''), 1)) }}
            </h1>
            @else
            <h1 class="hero-title"><span class="accent">SOLAR</span><br>ENERGY</h1>
            @endif

            @if(isset($userdata->designation) && $userdata->designation)
            <p class="hero-sub">{{ $userdata->designation }}</p>
            @else
            <p class="hero-sub">Certified Solar EPC Contractor &nbsp;·&nbsp; Clean Energy Experts</p>
            @endif

            <div class="hero-stats">
                <div>
                    <div class="hs-num">500+</div>
                    <div class="hs-lbl">Installations</div>
                </div>
                <div>
                    <div class="hs-num">5 MW</div>
                    <div class="hs-lbl">Capacity</div>
                </div>
                <div>
                    <div class="hs-num">100%</div>
                    <div class="hs-lbl">Satisfaction</div>
                </div>
                @if(isset($userdata->city) && $userdata->city)
                <div>
                    <div class="hs-num" style="font-size:0.9rem;color:rgba(255,255,255,0.7);">
                        <i class="fas fa-map-marker-alt" style="color:var(--y)"></i>
                        {{ $userdata->city }}{{ isset($userdata->state) && $userdata->state ? ', '.$userdata->state : '' }}
                    </div>
                </div>
                @endif
            </div>

            <div class="hero-btns">
                @if(isset($userdata->mobile) && $userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="btn-y">
                    <i class="fas fa-phone-alt"></i> Get Free Quote
                </a>
                @endif
                @if(isset($userdata->email) && $userdata->email)
                <a href="mailto:{{ $userdata->email }}" class="btn-ghost-w">
                    <i class="fas fa-envelope"></i> Email Us
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ============================
         STICKY NAV
    ============================ -->
    <nav class="nav-bar">
        <div class="nav-inner">
            <a href="#home"     class="nav-link active"><i class="fas fa-home"></i> Home</a>
            <a href="#about"    class="nav-link"><i class="fas fa-info-circle"></i> About</a>
            <a href="#services" class="nav-link"><i class="fas fa-solar-panel"></i> Services</a>
            <a href="#why"      class="nav-link"><i class="fas fa-leaf"></i> Why Solar</a>
            <a href="#process"  class="nav-link"><i class="fas fa-cogs"></i> Process</a>
            <a href="#packages" class="nav-link"><i class="fas fa-tag"></i> Packages</a>
            <a href="#contact"  class="nav-link"><i class="fas fa-phone"></i> Contact</a>
        </div>
    </nav>

    <!-- ============================
         PROFILE CARD
    ============================ -->
    <div class="pc-wrap">
        <div class="pc">
            <!-- Avatar -->
            <div class="pc-avatar-col">
                @if(isset($userdata->profile) && $userdata->profile)
                    <img src="{{ asset('public/frontend/user_images/'.$userdata->profile) }}"
                         alt="{{ $userdata->name }}" class="pc-avatar">
                @else
                    <div class="pc-avatar-ph"><i class="fas fa-sun"></i></div>
                @endif
                <span class="pc-avatar-lbl">Solar EPC</span>
            </div>

            <!-- Info -->
            <div class="pc-info">
                @if(isset($userdata->name) && $userdata->name)
                <div class="pc-name">{{ $userdata->name }}</div>
                @endif
                <div class="pc-desig">{{ $userdata->designation ?? 'Certified Solar Energy Contractor' }}</div>

                <div class="pc-stats">
                    <div>
                        <div class="pcs-num">500<sup>+</sup></div>
                        <div class="pcs-lbl">Installs</div>
                    </div>
                    <div>
                        <div class="pcs-num">5<sup>MW</sup></div>
                        <div class="pcs-lbl">Capacity</div>
                    </div>
                    <div>
                        <div class="pcs-num">100<sup>%</sup></div>
                        <div class="pcs-lbl">Satisfied</div>
                    </div>
                    <div>
                        <div class="pcs-num">10<sup>+</sup></div>
                        <div class="pcs-lbl">Years</div>
                    </div>
                </div>

                <div class="pc-tags">
                    <span class="pc-tag"><i class="fas fa-certificate"></i> MNRE Certified</span>
                    <span class="pc-tag"><i class="fas fa-leaf"></i> Eco-Friendly</span>
                    <span class="pc-tag"><i class="fas fa-shield-halved"></i> 25yr Warranty</span>
                    <span class="pc-tag"><i class="fas fa-bolt"></i> Grid-Tied</span>
                    <span class="pc-tag"><i class="fas fa-battery-full"></i> Off-Grid</span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="pc-btns-col">
                @if(isset($userdata->mobile) && $userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="pcb pcb-y">
                    <i class="fas fa-phone-alt"></i> Call
                </a>
                @endif
                @if(isset($userdata->email) && $userdata->email)
                <a href="mailto:{{ $userdata->email }}" class="pcb pcb-out">
                    <i class="fas fa-envelope"></i> Email
                </a>
                @endif
                @if(isset($userdata->mobile) && $userdata->mobile)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$userdata->mobile) }}"
                   target="_blank" class="pcb pcb-g">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- ============================
         STATS STRIP
    ============================ -->
    <div class="stats-strip">
        <div class="stats-strip-inner">
            <div class="strip-stat">
                <div class="ss-num">500+</div>
                <div class="ss-lbl">Installations</div>
            </div>
            <div class="strip-stat">
                <div class="ss-num">5 MW</div>
                <div class="ss-lbl">Total Capacity</div>
            </div>
            <div class="strip-stat">
                <div class="ss-num">90%</div>
                <div class="ss-lbl">Bill Savings</div>
            </div>
            <div class="strip-stat">
                <div class="ss-num">25 yr</div>
                <div class="ss-lbl">Panel Warranty</div>
            </div>
        </div>
    </div>

    <!-- ============================
         CONTENT
    ============================ -->
    <div class="cw">

        <!-- 01 ABOUT -->
        @if((isset($userdata->about_us) && $userdata->about_us))
        <div id="about">
            <div class="sec-hdr">
                <span class="sec-num">01</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">About Us</h2>
            </div>
            <div class="about-block">{{ $userdata->about_us }}</div>
        </div>
        @endif

        <!-- 02 SERVICES — image portrait cards -->
        <div id="services">
            <div class="sec-hdr">
                <span class="sec-num">02</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Solar Solutions</h2>
            </div>

            @php
            $defaultSvcs = [
                [
                    'name'=>'Residential Solar',
                    'cat' =>'Home Solution',
                    'desc'=>'Rooftop solar for homes with net metering',
                    'img' =>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name'=>'Commercial Solar',
                    'cat' =>'Business Solution',
                    'desc'=>'Large-scale industrial installations',
                    'img' =>'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name'=>'Solar + Battery',
                    'cat' =>'Hybrid System',
                    'desc'=>'24/7 power with battery backup storage',
                    'img' =>'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name'=>'Off-Grid Solar',
                    'cat' =>'Independence',
                    'desc'=>'Complete energy independence anywhere',
                    'img' =>'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name'=>'AMC & Service',
                    'cat' =>'Maintenance',
                    'desc'=>'Annual maintenance & performance check',
                    'img' =>'https://images.unsplash.com/photo-1566093097221-ac2335b09e70?auto=format&fit=crop&w=600&q=80',
                ],
            ];

            $svcImages = [
                'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1566093097221-ac2335b09e70?auto=format&fit=crop&w=600&q=80',
            ];
            @endphp

            <div class="svc-grid">
                @php $hasSvcs = isset($solarServices) && $solarServices->count() > 0; @endphp

                @if($hasSvcs)
                    @foreach($solarServices as $i => $svc)
                    <div class="svc-card">
                        <div class="svc-img" style="background-image:url('{{ $svcImages[$i % count($svcImages)] }}')"></div>
                        <div class="svc-ov"></div>
                        <div class="svc-badge"><i class="fas fa-bolt"></i> Solution</div>
                        <div class="svc-bottom">
                            <div class="svc-cat">Solar Service</div>
                            <div class="svc-name">{{ $svc->service_name ?? $svc->name }}</div>
                            @if(isset($svc->description) && $svc->description)
                            <div class="svc-desc">{{ Str::limit($svc->description, 55) }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    @foreach($defaultSvcs as $svc)
                    <div class="svc-card">
                        <div class="svc-img" style="background-image:url('{{ $svc['img'] }}')"></div>
                        <div class="svc-ov"></div>
                        <div class="svc-badge"><i class="fas fa-bolt"></i> Solution</div>
                        <div class="svc-bottom">
                            <div class="svc-cat">{{ $svc['cat'] }}</div>
                            <div class="svc-name">{{ $svc['name'] }}</div>
                            <div class="svc-desc">{{ $svc['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- 03 WHY SOLAR — SPLIT LAYOUT -->
        <div id="why">
            <div class="sec-hdr">
                <span class="sec-num">03</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Why Go Solar?</h2>
            </div>

            <div class="why-split">
                <div class="why-img-col">
                    <div class="why-img-ov"></div>
                </div>
                <div class="why-content-col">
                    <div class="why-eyebrow"><i class="fas fa-sun"></i> Benefits</div>
                    <div class="why-title">
                        Clean Energy.<br>
                        <span>Real Savings.</span>
                    </div>
                    <div class="why-list">
                        <div class="why-item">
                            <div class="why-item-icon"><i class="fas fa-rupee-sign"></i></div>
                            <div>
                                <div class="why-item-title">Save Up to 90% on Bills</div>
                                <div class="why-item-desc">Dramatically reduce or eliminate your monthly electricity bill</div>
                            </div>
                        </div>
                        <div class="why-item">
                            <div class="why-item-icon"><i class="fas fa-leaf"></i></div>
                            <div>
                                <div class="why-item-title">Zero Carbon Footprint</div>
                                <div class="why-item-desc">Clean, renewable energy with zero harmful emissions</div>
                            </div>
                        </div>
                        <div class="why-item">
                            <div class="why-item-icon"><i class="fas fa-shield-halved"></i></div>
                            <div>
                                <div class="why-item-title">Energy Independence</div>
                                <div class="why-item-desc">No more power cuts or grid dependency</div>
                            </div>
                        </div>
                        <div class="why-item">
                            <div class="why-item-icon"><i class="fas fa-arrow-trend-up"></i></div>
                            <div>
                                <div class="why-item-title">Increase Property Value</div>
                                <div class="why-item-desc">Solar-equipped homes sell for significantly more</div>
                            </div>
                        </div>
                        <div class="why-item">
                            <div class="why-item-icon"><i class="fas fa-file-invoice"></i></div>
                            <div>
                                <div class="why-item-title">Government Subsidies</div>
                                <div class="why-item-desc">Eligible for PM Surya Ghar & state subsidies</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 04 INSTALLATION GALLERY FILMSTRIP -->
        @if(isset($gallery) && $gallery->count() > 0)
        <div>
            <div class="sec-hdr">
                <span class="sec-num">04</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Our Installations</h2>
            </div>
            <div class="filmstrip">
                @foreach($gallery as $img)
                <div class="film-item">
                    @if(isset($img->image) && $img->image)
                        <img src="{{ asset('uploads/user_gallery/'.$img->image) }}" alt="Installation">
                    @else
                        <div class="film-ph"><i class="fas fa-solar-panel"></i></div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 05 OUR PROCESS -->
        <div id="process">
            <div class="sec-hdr">
                <span class="sec-num">05</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">How It Works</h2>
            </div>

            <div class="process-row">
                @php
                $steps = [
                    ['icon'=>'fas fa-map-marked-alt', 'title'=>'Site Survey',    'desc'=>'Free on-site assessment of your roof & energy needs'],
                    ['icon'=>'fas fa-drafting-compass','title'=>'System Design',  'desc'=>'Custom solar system design & ROI calculation'],
                    ['icon'=>'fas fa-file-signature', 'title'=>'Approvals',       'desc'=>'Subsidy application & DISCOM approvals handled by us'],
                    ['icon'=>'fas fa-tools',          'title'=>'Installation',    'desc'=>'Expert installation by certified engineers'],
                    ['icon'=>'fas fa-plug',           'title'=>'Commissioning',   'desc'=>'Grid synchronization & net meter connection'],
                    ['icon'=>'fas fa-headset',        'title'=>'After-Sales',     'desc'=>'24/7 monitoring & dedicated support team'],
                ];
                @endphp
                @foreach($steps as $s)
                <div class="process-step">
                    <div class="ps-icon"><i class="{{ $s['icon'] }}"></i></div>
                    <div class="ps-title">{{ $s['title'] }}</div>
                    <div class="ps-desc">{{ $s['desc'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 06 PACKAGES -->
        <div id="packages">
            <div class="sec-hdr">
                <span class="sec-num">06</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Solar Packages</h2>
            </div>

            @php
            $pkgImgs = [
                'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1466611653911-95081537e5b7?auto=format&fit=crop&w=600&q=80',
            ];
            $defPkgs = [
                ['name'=>'Starter 2kW','price'=>'₹1.20L','note'=>'Ideal for 1BHK / small home','feats'=>['2 kW On-Grid System','6 Solar Panels','5-year Warranty','Subsidy Assistance']],
                ['name'=>'Smart 5kW','price'=>'₹2.85L','note'=>'Best for 2BHK/3BHK homes','feats'=>['5 kW Hybrid System','15 Solar Panels','Battery Backup 5 kWh','10-year Warranty','App Monitoring']],
                ['name'=>'Power 10kW','price'=>'₹5.20L','note'=>'Villas & small businesses','feats'=>['10 kW System','30 Solar Panels','Battery 10 kWh','25-year Panel Warranty','Priority Support']],
                ['name'=>'Enterprise','price'=>'Custom','note'=>'Factories, industries, farms','feats'=>['50 kW+','Custom Design','O&M Contract','Government Liaisoning','Dedicated PM']],
            ];
            @endphp

            <div class="pkg-grid">
                @if(isset($solarPackages) && $solarPackages->count() > 0)
                    @foreach($solarPackages as $i => $pkg)
                    <div class="pkg-card">
                        <div class="pkg-img" style="background-image:url('{{ $pkgImgs[$i % count($pkgImgs)] }}')">
                            <div class="pkg-img-ov"></div>
                            <div class="pkg-img-label">{{ $pkg->package_name ?? $pkg->name }}</div>
                        </div>
                        <div class="pkg-body">
                            <div class="pkg-price">{{ $pkg->price ? '₹'.number_format($pkg->price) : 'Enquire' }}</div>
                            <div class="pkg-note">{{ $pkg->description ?? 'Custom solar package' }}</div>
                            <div class="pkg-feats">
                                @if(!empty($pkg->features))
                                    @foreach($pkg->features as $f)
                                    <div class="pkg-feat"><i class="fas fa-check-circle"></i>{{ $f }}</div>
                                    @endforeach
                                @endif
                            </div>
                            <a href="#contact" class="pkg-cta">Get Quote</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    @foreach($defPkgs as $i => $pkg)
                    <div class="pkg-card">
                        <div class="pkg-img" style="background-image:url('{{ $pkgImgs[$i % count($pkgImgs)] }}')">
                            <div class="pkg-img-ov"></div>
                            <div class="pkg-img-label">{{ $pkg['name'] }}</div>
                        </div>
                        <div class="pkg-body">
                            <div class="pkg-price">{{ $pkg['price'] }}</div>
                            <div class="pkg-note">{{ $pkg['note'] }}</div>
                            <div class="pkg-feats">
                                @foreach($pkg['feats'] as $f)
                                <div class="pkg-feat"><i class="fas fa-check-circle"></i> {{ $f }}</div>
                                @endforeach
                            </div>
                            <a href="#contact" class="pkg-cta">Get Quote</a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- CTA SECTION -->
        <div id="contact" class="cta-sec">
            <div class="cta-bg"></div>
            <div class="cta-ov"></div>
            <div class="cta-y-stripe"></div>

            <div class="cta-inner">
                <!-- Left: Big headline -->
                <div>
                    <div class="cta-eyebrow"><i class="fas fa-sun"></i> Ready to Switch?</div>
                    <h2 class="cta-headline">
                        POWER<br>
                        YOUR<br>
                        <span class="cta-y">FUTURE.</span>
                    </h2>
                    <p class="cta-desc">
                        Get a free site survey, custom design & accurate ROI estimate.
                        No obligation — just clean energy solutions tailored to you.
                    </p>
                    <div class="cta-btns">
                        @if(isset($userdata->mobile) && $userdata->mobile)
                        <a href="tel:{{ $userdata->mobile }}" class="btn-y">
                            <i class="fas fa-phone-alt"></i> Call Now
                        </a>
                        @endif
                        @if(isset($userdata->mobile) && $userdata->mobile)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$userdata->mobile) }}"
                           target="_blank" class="btn-ghost-w">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Right: Contact info -->
                <div>
                    @if(isset($userdata->mobile) && $userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="ci-item">
                        <div class="ci-icon y"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <div class="ci-lbl">Call Us</div>
                            <div class="ci-val">{{ $userdata->mobile }}</div>
                        </div>
                    </a>
                    @endif

                    @if(isset($userdata->email) && $userdata->email)
                    <a href="mailto:{{ $userdata->email }}" class="ci-item">
                        <div class="ci-icon g"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div class="ci-lbl">Email</div>
                            <div class="ci-val">{{ $userdata->email }}</div>
                        </div>
                    </a>
                    @endif

                    @if(isset($userdata->city) && $userdata->city)
                    <div class="ci-item">
                        <div class="ci-icon dg"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="ci-lbl">Service Area</div>
                            <div class="ci-val">{{ $userdata->city }}{{ isset($userdata->state) && $userdata->state ? ', '.$userdata->state : '' }}</div>
                        </div>
                    </div>
                    @endif

                    @if(isset($userdata->mobile) && $userdata->mobile)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$userdata->mobile) }}"
                       target="_blank" class="ci-item">
                        <div class="ci-icon wh"><i class="fab fa-whatsapp"></i></div>
                        <div>
                            <div class="ci-lbl">WhatsApp</div>
                            <div class="ci-val">{{ $userdata->mobile }}</div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>

    </div><!-- /cw -->

    <!-- ============================
         SOCIAL SECTION
    ============================ -->
    @if(isset($social))
    <div class="social-sec">
        <div class="soc-eyebrow">Follow Our <span>Journey</span></div>
        <div class="soc-heading">Stay Connected</div>
        <div class="soc-icons">
            @if(isset($social->facebook) && $social->facebook)
            <a href="{{ $social->facebook }}" target="_blank" class="soc-btn soc-fb">
                <i class="fab fa-facebook-f"></i>
            </a>
            @endif
            @if(isset($social->instagram) && $social->instagram)
            <a href="{{ $social->instagram }}" target="_blank" class="soc-btn soc-ig">
                <i class="fab fa-instagram"></i>
            </a>
            @endif
            @if(isset($social->linkedin) && $social->linkedin)
            <a href="{{ $social->linkedin }}" target="_blank" class="soc-btn soc-li">
                <i class="fab fa-linkedin-in"></i>
            </a>
            @endif
            @if(isset($social->youtube) && $social->youtube)
            <a href="{{ $social->youtube }}" target="_blank" class="soc-btn soc-yt">
                <i class="fab fa-youtube"></i>
            </a>
            @endif
        </div>
    </div>
    @endif

    <!-- ============================
         FOOTER
    ============================ -->
    <footer class="footer">
        <div>
            @if(isset($userdata->name) && $userdata->name)
            <div class="footer-brand">
                {{ explode(' ', $userdata->name)[0] }}
                <span>{{ implode(' ', array_slice(explode(' ', $userdata->name), 1)) }}</span>
            </div>
            @endif
            <div class="footer-sub">Solar Energy Solutions</div>
        </div>
        <div class="footer-copy">© {{ date('Y') }} All Rights Reserved</div>
        <div class="footer-pw">Powered by <a href="#">SolarPro</a></div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id   ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview      ?? false
    ])
</body>
</html>