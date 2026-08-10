<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Beauty Salon' }} - Salon Profile</title>

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

        $salonServices  = $salonServices  ?? collect();
        $salonArtists   = $salonArtists   ?? collect();
        $salonPackages  = $salonPackages  ?? collect();
        $salonPortfolio = $salonPortfolio ?? collect();
        $salonProducts  = $salonProducts  ?? collect();
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700;800&family=Barlow+Condensed:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --rose:   #f43f5e;
            --pink:   #ec4899;
            --plum:   #9333ea;
            --gold:   #d4af37;
            --gold2:  #f0d060;
            --dark:   #1a0a12;
            --card:   #ffffff;
            --page:   #fdf2f8;
            --border: #fce7f3;
            --muted:  #9ca3af;
            --text:   #1e1b2e;
        }

        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--page);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ============================
           ANNOUNCEMENT BAR
        ============================ */
        .announce-bar {
            width: 100%;
            background: linear-gradient(90deg, var(--rose), var(--pink), var(--plum));
            color: #fff;
            text-align: center;
            padding: 0.48rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            position: relative;
            z-index: 300;
        }
        .announce-bar i { margin-right: 0.4rem; color: var(--gold2); }

        /* ============================
           HERO BANNER
        ============================ */
        .hero {
            position: relative;
            width: 100%;
            min-height: 480px;
            background: var(--dark);
            overflow: hidden;
            display: flex;
            align-items: flex-end;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center 30%;
            opacity: 0.38;
        }

        /* Gradient diagonal overlay */
        .hero-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                110deg,
                rgba(244,63,94,0.65)   0%,
                rgba(147,51,234,0.30)  50%,
                transparent            80%
            );
        }

        /* Gold top stripe */
        .hero-top-stripe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 4px;
            background: linear-gradient(90deg, var(--gold), var(--gold2), var(--pink));
        }

        /* Bottom fade into page bg */
        .hero-fade {
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 220px;
            background: linear-gradient(to bottom, transparent, var(--page));
        }

        .hero-content {
            position: relative;
            z-index: 10;
            padding: 4rem 2rem 3rem;
            max-width: 1150px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gold);
            color: #1a0a12;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            padding: 0.3rem 0.9rem;
            border-radius: 3px;
            margin-bottom: 1.1rem;
        }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 8vw, 6.5rem);
            font-weight: 800;
            line-height: 0.9;
            color: #fff;
            letter-spacing: -0.01em;
            margin-bottom: 0.9rem;
        }

        .hero-title .accent { color: var(--gold2); }

        .hero-sub {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: rgba(255,255,255,0.65);
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-bottom: 2rem;
        }

        /* Hero stats */
        .hero-stats {
            display: flex;
            gap: 2.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .h-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--gold2);
            line-height: 1;
        }

        .h-lbl {
            font-size: 0.67rem;
            color: rgba(255,255,255,0.5);
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 0.1rem;
        }

        /* Hero buttons */
        .hero-btns { display: flex; gap: 0.9rem; flex-wrap: wrap; }

        .btn-rose {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            background: var(--rose);
            color: #fff;
            padding: 0.82rem 2rem;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.25s;
            border: 2px solid var(--rose);
        }

        .btn-rose:hover {
            background: var(--pink);
            border-color: var(--pink);
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(244,63,94,0.45);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            background: transparent;
            color: #fff;
            padding: 0.8rem 2rem;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.45);
            transition: all 0.25s;
        }

        .btn-ghost:hover {
            border-color: var(--gold2);
            color: var(--gold2);
            transform: translateY(-2px);
        }

        /* ============================
           NAVIGATION BAR
        ============================ */
        .nav-bar {
            width: 100%;
            background: var(--rose);
            position: sticky;
            top: 0;
            z-index: 200;
            overflow-x: auto;
            scrollbar-width: none;
            border-bottom: 3px solid var(--gold);
        }
        .nav-bar::-webkit-scrollbar { display: none; }

        .nav-inner {
            display: flex;
            max-width: 1150px;
            margin: 0 auto;
            padding: 0 1rem;
            white-space: nowrap;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.88rem 1.1rem;
            color: rgba(255,255,255,0.85);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            margin-bottom: -3px;
            transition: all 0.2s;
        }

        .nav-link i { color: var(--gold2); font-size: 0.7rem; }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
            border-bottom-color: var(--gold2);
            background: rgba(0,0,0,0.12);
        }

        /* ============================
           PROFILE CARD
        ============================ */
        .profile-card-wrap {
            max-width: 1150px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .profile-card {
            background: var(--card);
            border-radius: 14px;
            padding: 2rem 2.2rem;
            box-shadow: 0 10px 40px rgba(244,63,94,0.14);
            border-top: 4px solid var(--gold);
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 2rem;
            align-items: center;
            position: relative;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, var(--rose), var(--plum));
            border-radius: 14px 0 0 14px;
        }

        /* Avatar */
        .pc-avatar-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .pc-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid var(--rose);
            object-fit: cover;
            box-shadow: 0 6px 20px rgba(244,63,94,0.3);
        }

        .pc-avatar-placeholder {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid var(--rose);
            background: linear-gradient(135deg, var(--rose), var(--plum));
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

        /* Info */
        .pc-info { min-width: 0; }

        .pc-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.1;
            margin-bottom: 0.2rem;
        }

        .pc-desig {
            font-size: 0.78rem;
            color: var(--rose);
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

        .pc-stat-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--rose);
            line-height: 1;
        }

        .pc-stat-num sup {
            font-size: 0.9rem;
            color: var(--gold);
        }

        .pc-stat-lbl {
            font-size: 0.64rem;
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
            background: #fff1f5;
            border: 1px solid #fce7f3;
            color: var(--rose);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.26rem 0.65rem;
            border-radius: 3px;
        }

        .pc-tag i { color: var(--gold); }

        /* Buttons col */
        .pc-btns-col {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            min-width: 138px;
        }

        .pc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            border-radius: 5px;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .pc-btn-rose {
            background: var(--rose);
            color: #fff;
        }
        .pc-btn-rose:hover {
            background: #e11d48;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(244,63,94,0.4);
        }

        .pc-btn-gold {
            background: var(--gold);
            color: #1a0a12;
            font-weight: 800;
        }
        .pc-btn-gold:hover {
            background: var(--gold2);
            transform: translateY(-1px);
        }

        .pc-btn-green {
            background: #22c55e;
            color: #fff;
        }
        .pc-btn-green:hover {
            background: #16a34a;
            transform: translateY(-1px);
        }

        .pc-btn-outline {
            background: transparent;
            border-color: var(--border);
            color: var(--muted);
        }
        .pc-btn-outline:hover {
            border-color: var(--rose);
            color: var(--rose);
        }

        /* ============================
           CONTENT WRAPPER
        ============================ */
        .content-wrap {
            max-width: 1150px;
            margin: 0 auto;
            padding: 0 1.5rem 3rem;
        }

        /* ============================
           SECTION HEADERS (Cinematic)
        ============================ */
        .sec-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.8rem;
            padding-top: 1.5rem;
        }

        .sec-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--muted);
            letter-spacing: 0.06em;
            min-width: 28px;
        }

        .sec-bar {
            width: 4px;
            height: 28px;
            background: var(--rose);
            border-radius: 2px;
            flex-shrink: 0;
        }

        .sec-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1;
        }

        /* ============================
           ABOUT BLOCK
        ============================ */
        .about-block {
            background: var(--card);
            border-radius: 12px;
            padding: 2rem;
            font-size: 1rem;
            line-height: 1.85;
            color: #475569;
            border-left: 4px solid var(--gold);
            box-shadow: 0 4px 16px rgba(244,63,94,0.08);
            margin-bottom: 0.5rem;
        }

        /* ============================
           SERVICE IMAGE CARDS
           (Cinematic Studios style)
        ============================ */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 0;
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 0.5rem;
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

        .svc-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(244,63,94,0.05) 0%,
                rgba(26,10,18,0.7)   55%,
                rgba(26,10,18,0.96)  100%
            );
        }

        /* Gold badge top-left */
        .svc-badge {
            position: absolute;
            top: 0.7rem;
            left: 0.7rem;
            background: var(--rose);
            color: #fff;
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.2rem 0.55rem;
            border-radius: 2px;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* Price badge top-right */
        .svc-price-badge {
            position: absolute;
            top: 0.7rem;
            right: 0.7rem;
            background: var(--gold);
            color: #1a0a12;
            font-size: 0.7rem;
            font-weight: 800;
            padding: 0.2rem 0.6rem;
            border-radius: 2px;
        }

        .svc-bottom {
            position: absolute;
            bottom: 0;
            left: 0; right: 0;
            padding: 1rem;
        }

        .svc-cat {
            font-size: 0.62rem;
            color: var(--gold2);
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
        }

        .svc-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.15;
        }

        .svc-meta {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.55);
            margin-top: 0.25rem;
        }

        /* ============================
           PACKAGES — image header cards
        ============================ */
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .pkg-card {
            background: var(--card);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }

        .pkg-card:hover {
            border-color: var(--rose);
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(244,63,94,0.2);
        }

        .pkg-img-head {
            height: 120px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .pkg-img-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(244,63,94,0.25), rgba(26,10,18,0.94));
        }

        .pkg-img-content {
            position: absolute;
            bottom: 0.8rem;
            left: 1rem;
            right: 1rem;
        }

        .pkg-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
        }

        .pkg-body {
            padding: 1.1rem 1.2rem 1.4rem;
        }

        .pkg-price-row {
            display: flex;
            align-items: baseline;
            gap: 0.6rem;
            margin-bottom: 0.9rem;
        }

        .pkg-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--rose);
            line-height: 1;
        }

        .pkg-price-old {
            font-size: 1rem;
            color: var(--muted);
            text-decoration: line-through;
        }

        .pkg-features { margin-bottom: 1.1rem; }

        .pkg-feat {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.4rem 0;
            font-size: 0.86rem;
            color: #475569;
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }

        .pkg-feat i { color: var(--rose); font-size: 0.82rem; flex-shrink: 0; }

        .pkg-cta {
            display: block;
            width: 100%;
            padding: 0.72rem;
            background: linear-gradient(90deg, var(--rose), var(--pink));
            color: #fff;
            text-align: center;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.25s;
        }

        .pkg-cta:hover {
            box-shadow: 0 6px 18px rgba(244,63,94,0.4);
            transform: scale(1.02);
        }

        /* ============================
           ARTISTS GRID
        ============================ */
        .artists-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
            gap: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .artist-card {
            background: var(--card);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            text-align: center;
            transition: all 0.3s;
        }

        .artist-card:hover {
            border-color: var(--rose);
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(244,63,94,0.16);
        }

        .artist-img-wrap {
            height: 170px;
            overflow: hidden;
            position: relative;
        }

        .artist-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .artist-card:hover .artist-img-wrap img { transform: scale(1.06); }

        .artist-img-ph {
            width: 100%; height: 100%;
            background: linear-gradient(135deg, var(--rose), var(--plum));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2.8rem;
            font-weight: 700;
        }

        .artist-info { padding: 0.8rem; }

        .artist-name {
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--text);
            margin-bottom: 0.2rem;
        }

        .artist-exp {
            font-size: 0.75rem;
            color: var(--rose);
            margin-bottom: 0.5rem;
        }

        .artist-specs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.3rem;
            justify-content: center;
        }

        .spec-tag {
            background: #fff1f5;
            border: 1px solid #fce7f3;
            color: var(--rose);
            font-size: 0.62rem;
            font-weight: 700;
            padding: 0.18rem 0.5rem;
            border-radius: 20px;
        }

        /* ============================
           PORTFOLIO FILMSTRIP
        ============================ */
        .filmstrip-wrap { margin-bottom: 0.5rem; }

        .filmstrip {
            display: flex;
            gap: 0.7rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: var(--rose) #fce7f3;
        }

        .filmstrip::-webkit-scrollbar { height: 4px; }
        .filmstrip::-webkit-scrollbar-track { background: #fce7f3; }
        .filmstrip::-webkit-scrollbar-thumb { background: var(--rose); border-radius: 2px; }

        .film-item {
            flex: 0 0 190px;
            aspect-ratio: 3/4;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid var(--border);
            position: relative;
            transition: all 0.3s;
        }

        .film-item:hover {
            transform: scale(1.04);
            border-color: var(--rose);
            box-shadow: 0 8px 20px rgba(244,63,94,0.2);
        }

        .film-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .film-labels {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            display: flex;
        }

        .film-label {
            flex: 1;
            background: rgba(0,0,0,0.75);
            color: #fff;
            text-align: center;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.3rem;
        }

        .film-ph {
            width: 100%; height: 100%;
            background: #fce7f3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--rose);
            font-size: 1.5rem;
        }

        /* ============================
           PRODUCTS GRID
        ============================ */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .prod-card {
            background: var(--card);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }

        .prod-card:hover {
            border-color: var(--rose);
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(244,63,94,0.16);
        }

        .prod-img-wrap {
            height: 160px;
            background: #fff1f5;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .prod-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .prod-card:hover .prod-img-wrap img { transform: scale(1.06); }

        .prod-img-ph {
            color: var(--rose);
            font-size: 2.5rem;
        }

        .prod-info { padding: 1rem; }

        .prod-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text);
            margin-bottom: 0.2rem;
        }

        .prod-brand {
            font-size: 0.78rem;
            color: var(--muted);
            margin-bottom: 0.5rem;
        }

        .prod-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--rose);
        }

        /* ============================
           CTA SECTION
           "GLOW. TRANSFORM. RADIATE!"
        ============================ */
        .cta-section {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .cta-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center 40%;
            opacity: 0.14;
        }

        .cta-ov {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                110deg,
                rgba(26,10,18,0.97)  0%,
                rgba(244,63,94,0.82) 50%,
                rgba(26,10,18,0.7)   100%
            );
        }

        .cta-top-stripe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--gold2), var(--pink));
        }

        .cta-inner {
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
            padding: 3.5rem 2.5rem;
            align-items: center;
        }

        .cta-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--gold);
            color: #1a0a12;
            font-size: 0.67rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.25rem 0.7rem;
            border-radius: 3px;
            margin-bottom: 1rem;
        }

        .cta-headline {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.8rem, 5.5vw, 5.5rem);
            font-weight: 800;
            line-height: 0.9;
            color: #fff;
            letter-spacing: -0.01em;
            margin-bottom: 1.2rem;
        }

        .cta-headline .cta-accent { color: var(--gold2); }

        .cta-desc {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.7;
            margin-bottom: 1.8rem;
            max-width: 380px;
        }

        .cta-btns { display: flex; gap: 0.8rem; flex-wrap: wrap; }

        /* Contact info items */
        .ci-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 8px;
            padding: 0.9rem 1.2rem;
            margin-bottom: 0.8rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .ci-item:hover {
            background: rgba(212,175,55,0.12);
            border-color: var(--gold);
            transform: translateX(4px);
        }

        .ci-icon {
            width: 40px; height: 40px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .ci-rose  { background: var(--rose); }
        .ci-gold  { background: var(--gold); color: #1a0a12; }
        .ci-plum  { background: var(--plum); }
        .ci-green { background: #22c55e; }

        .ci-text { flex: 1; min-width: 0; }

        .ci-label {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.45);
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            margin-bottom: 0.1rem;
        }

        .ci-value {
            font-size: 0.9rem;
            color: #fff;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ============================
           FOLLOW / SOCIAL
        ============================ */
        .social-section {
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

        .soc-eyebrow span { color: var(--rose); }

        .soc-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 1.5rem;
        }

        .soc-icons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .soc-btn {
            width: 54px; height: 54px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #fff;
            text-decoration: none;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(0,0,0,0.12);
        }

        .soc-btn:hover {
            transform: scale(1.15) translateY(-3px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.2);
        }

        .soc-fb  { background: #1877f2; }
        .soc-ig  { background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); }
        .soc-yt  { background: #ff0000; }
        .soc-tw  { background: #1da1f2; }

        /* ============================
           FOOTER
        ============================ */
        .site-footer {
            background: var(--dark);
            border-top: 3px solid var(--gold);
            padding: 1.6rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }

        .footer-brand-name span { color: var(--gold); }

        .footer-sub {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.4);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 0.2rem;
        }

        .footer-copy { font-size: 0.75rem; color: rgba(255,255,255,0.35); }

        .footer-powered { font-size: 0.72rem; color: rgba(255,255,255,0.35); }
        .footer-powered a { color: var(--gold); text-decoration: none; }

        /* ============================
           RESPONSIVE
        ============================ */
        @media (max-width: 900px) {
            .profile-card {
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
            .cta-inner {
                grid-template-columns: 1fr;
                padding: 2rem 1.5rem;
            }
        }

        @media (max-width: 640px) {
            .hero-content { padding: 3rem 1.2rem 2rem; }
            .hero-stats { gap: 1.5rem; }
            .services-grid { grid-template-columns: repeat(2, 1fr); }
            .svc-card { aspect-ratio: 3/4; }
            .packages-grid { grid-template-columns: 1fr; }
            .artists-grid { grid-template-columns: repeat(2, 1fr); }
            .site-footer { flex-direction: column; align-items: center; text-align: center; }
        }

        @media (max-width: 400px) {
            .services-grid { grid-template-columns: 1fr; }
            .artists-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div style="background:linear-gradient(90deg,var(--rose),var(--plum));color:#fff;padding:12px 20px;text-align:center;font-size:13px;font-weight:600;position:sticky;top:0;z-index:400;">
        <i class="fas fa-eye"></i> Preview Mode —
        <a href="{{ url('/signin') }}" style="color:var(--gold2);text-decoration:underline;margin-left:6px;">Sign up</a> to publish your profile!
    </div>
    @endif

    <!-- ============================
         ANNOUNCEMENT BAR
    ============================ -->
    <div class="announce-bar">
        <i class="fas fa-sparkles"></i>
        Exclusive Offers This Week — Book Now &amp; Get 20% Off on All Services!
    </div>

    <!-- ============================
         HERO BANNER
    ============================ -->
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-ov"></div>
        <div class="hero-top-stripe"></div>
        <div class="hero-fade"></div>

        <div class="hero-content">
            <div class="hero-eyebrow">
                <i class="fas fa-scissors"></i> Premium Beauty &amp; Wellness Studio
            </div>

            @if($userdata->isFeatureVisible('name') ?? true)
            <h1 class="hero-title">
                <span class="accent">{{ explode(' ', $userdata->name)[0] ?? 'GLAM' }}</span>
                <br>{{ implode(' ', array_slice(explode(' ', $userdata->name), 1)) ?: 'STUDIO' }}
            </h1>
            @else
            <h1 class="hero-title"><span class="accent">GLAM</span><br>STUDIO</h1>
            @endif

            @if($userdata->designation ?? null)
            <p class="hero-sub">{{ $userdata->designation }}</p>
            @else
            <p class="hero-sub">Hair · Skin · Nails · Bridal &amp; More</p>
            @endif

            <div class="hero-stats">
                <div>
                    <div class="h-num">5K+</div>
                    <div class="h-lbl">Happy Clients</div>
                </div>
                <div>
                    <div class="h-num">10+</div>
                    <div class="h-lbl">Years</div>
                </div>
                <div>
                    <div class="h-num">50+</div>
                    <div class="h-lbl">Services</div>
                </div>
                @if($userdata->city ?? null)
                <div>
                    <div class="h-num" style="font-size:0.9rem;color:rgba(255,255,255,0.7);">
                        <i class="fas fa-map-marker-alt" style="color:var(--gold2)"></i>
                        {{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}
                    </div>
                </div>
                @endif
            </div>

            <div class="hero-btns">
                @if($userdata->contact ?? null)
                <a href="tel:{{ $userdata->contact }}" class="btn-rose">
                    <i class="fas fa-calendar-check"></i> Book Appointment
                </a>
                @endif
                @if($userdata->whatsapp ?? null)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$userdata->whatsapp) }}" target="_blank" class="btn-ghost">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ============================
         NAVIGATION BAR
    ============================ -->
    <nav class="nav-bar">
        <div class="nav-inner">
            <a href="#home"       class="nav-link active"><i class="fas fa-home"></i> Home</a>
            <a href="#about"      class="nav-link"><i class="fas fa-store"></i> About</a>
            <a href="#services"   class="nav-link"><i class="fas fa-scissors"></i> Services</a>
            @if($salonPackages->count() > 0)
            <a href="#packages"   class="nav-link"><i class="fas fa-gift"></i> Packages</a>
            @endif
            @if($salonArtists->count() > 0)
            <a href="#team"       class="nav-link"><i class="fas fa-user-tie"></i> Team</a>
            @endif
            @if($salonPortfolio->count() > 0)
            <a href="#gallery"    class="nav-link"><i class="fas fa-images"></i> Gallery</a>
            @endif
            @if($salonProducts->count() > 0)
            <a href="#products"   class="nav-link"><i class="fas fa-shopping-bag"></i> Products</a>
            @endif
            <a href="#contact"    class="nav-link"><i class="fas fa-envelope"></i> Contact</a>
        </div>
    </nav>

    <!-- ============================
         PROFILE CARD
    ============================ -->
    <div class="profile-card-wrap">
        <div class="profile-card">

            <!-- Avatar -->
            <div class="pc-avatar-col">
                @if($userdata->profile ?? null)
                    <img src="{{ asset('public/frontend/user_images/'.$userdata->profile) }}"
                         alt="{{ $userdata->name }}" class="pc-avatar">
                @else
                    <div class="pc-avatar-placeholder"><i class="fas fa-cut"></i></div>
                @endif
                <span class="pc-avatar-lbl">Salon</span>
            </div>

            <!-- Info -->
            <div class="pc-info">
                <div class="pc-name">{{ $userdata->name }}</div>
                @if($userdata->designation ?? null)
                <div class="pc-desig">{{ $userdata->designation }}</div>
                @else
                <div class="pc-desig">Premium Beauty &amp; Wellness Studio</div>
                @endif

                <div class="pc-stats">
                    <div>
                        <div class="pc-stat-num">5K<sup>+</sup></div>
                        <div class="pc-stat-lbl">Clients</div>
                    </div>
                    <div>
                        <div class="pc-stat-num">50<sup>+</sup></div>
                        <div class="pc-stat-lbl">Services</div>
                    </div>
                    <div>
                        <div class="pc-stat-num">10<sup>+</sup></div>
                        <div class="pc-stat-lbl">Years</div>
                    </div>
                    <div>
                        <div class="pc-stat-num">4.9<sup>★</sup></div>
                        <div class="pc-stat-lbl">Rating</div>
                    </div>
                </div>

                <div class="pc-tags">
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Hair</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Skin</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Nails</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Bridal</span>
                    <span class="pc-tag"><i class="fas fa-check-circle"></i> Makeup</span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="pc-btns-col">
                @if($userdata->contact ?? null)
                <a href="tel:{{ $userdata->contact }}" class="pc-btn pc-btn-rose">
                    <i class="fas fa-phone-alt"></i> Call
                </a>
                @endif
                @if($userdata->email ?? null)
                <a href="mailto:{{ $userdata->email }}" class="pc-btn pc-btn-outline">
                    <i class="fas fa-envelope"></i> Email
                </a>
                @endif
                @if($userdata->whatsapp ?? null)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$userdata->whatsapp) }}" target="_blank" class="pc-btn pc-btn-green">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
                <a href="{{ url(($userdata->slug ?? '').'/salon-booking') }}" class="pc-btn pc-btn-gold">
                    <i class="fas fa-calendar-check"></i> Book
                </a>
            </div>
        </div>
    </div>

    <!-- ============================
         CONTENT
    ============================ -->
    <div class="content-wrap">

        <!-- 01 ABOUT -->
        @if(($userdata->about_us ?? null))
        <div id="about">
            <div class="sec-header">
                <span class="sec-num">01</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">About Our Studio</h2>
            </div>
            <div class="about-block">{{ $userdata->about_us }}</div>
        </div>
        @endif

        <!-- 02 SERVICES (image cards) -->
        <div id="services">
            <div class="sec-header">
                <span class="sec-num">02</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Our Services</h2>
            </div>

            @php
            $defaultServices = [
                [
                    'name'  => 'Hair Styling',
                    'cat'   => 'Hair Services',
                    'desc'  => 'Cut · Blow-dry · Updo',
                    'price' => '₹499',
                    'img'   => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name'  => 'Hair Colouring',
                    'cat'   => 'Colour Services',
                    'desc'  => 'Global · Highlights · Ombre',
                    'price' => '₹1,499',
                    'img'   => 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name'  => 'Facial & Skin',
                    'cat'   => 'Skin Care',
                    'desc'  => 'Glow · Anti-aging · Clean',
                    'price' => '₹799',
                    'img'   => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name'  => 'Nail Art',
                    'cat'   => 'Nail Services',
                    'desc'  => 'Manicure · Pedicure · Gel',
                    'price' => '₹399',
                    'img'   => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name'  => 'Makeup',
                    'cat'   => 'Makeup Studio',
                    'desc'  => 'Party · HD · Airbrush',
                    'price' => '₹999',
                    'img'   => 'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'name'  => 'Bridal Package',
                    'cat'   => 'Bridal Services',
                    'desc'  => 'Hair · Makeup · Draping',
                    'price' => '₹8,999',
                    'img'   => 'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?auto=format&fit=crop&w=600&q=80',
                ],
            ];

            $svcImages = [
                'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?auto=format&fit=crop&w=600&q=80',
            ];
            @endphp

            <div class="services-grid">
                @if($salonServices->count() > 0)
                    @php $svcIdx = 0; @endphp
                    @foreach($salonServices->groupBy('service_category') as $cat => $svcs)
                        @php $svc = $svcs->first(); @endphp
                        <div class="svc-card">
                            <div class="svc-img" style="background-image:url('{{ $svcImages[$svcIdx % count($svcImages)] }}')"></div>
                            <div class="svc-overlay"></div>
                            <div class="svc-badge"><i class="fas fa-sparkles"></i> Service</div>
                            @if($svc->price)
                            <div class="svc-price-badge">₹{{ number_format($svc->price) }}</div>
                            @endif
                            <div class="svc-bottom">
                                <div class="svc-cat">{{ $cat }}</div>
                                <div class="svc-name">{{ $svc->service_name }}</div>
                                @if($svc->duration_minutes)
                                <div class="svc-meta"><i class="far fa-clock"></i> {{ $svc->duration_minutes }} mins</div>
                                @endif
                            </div>
                        </div>
                        @php $svcIdx++; @endphp
                    @endforeach
                @else
                    @foreach($defaultServices as $svc)
                    <div class="svc-card">
                        <div class="svc-img" style="background-image:url('{{ $svc['img'] }}')"></div>
                        <div class="svc-overlay"></div>
                        <div class="svc-badge"><i class="fas fa-sparkles"></i> Service</div>
                        <div class="svc-price-badge">{{ $svc['price'] }}</div>
                        <div class="svc-bottom">
                            <div class="svc-cat">{{ $svc['cat'] }}</div>
                            <div class="svc-name">{{ $svc['name'] }}</div>
                            <div class="svc-meta">{{ $svc['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- 03 SPECIAL PACKAGES -->
        @if($salonPackages->count() > 0)
        <div id="packages">
            <div class="sec-header">
                <span class="sec-num">03</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Special Packages</h2>
            </div>

            @php
            $pkgImgs = [
                'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1519415510236-718bdfcd89c8?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1581182800629-7d90925ad072?auto=format&fit=crop&w=600&q=80',
                'https://images.unsplash.com/photo-1560750588-73207b1ef5b8?auto=format&fit=crop&w=600&q=80',
            ];
            @endphp

            <div class="packages-grid">
                @foreach($salonPackages as $i => $pkg)
                <div class="pkg-card">
                    <div class="pkg-img-head" style="background-image:url('{{ $pkgImgs[$i % count($pkgImgs)] }}')">
                        <div class="pkg-img-ov"></div>
                        <div class="pkg-img-content">
                            <div class="pkg-name">{{ $pkg->package_name }}</div>
                        </div>
                    </div>
                    <div class="pkg-body">
                        <div class="pkg-price-row">
                            @if($pkg->discount_price)
                                <div class="pkg-price">₹{{ number_format($pkg->discount_price) }}</div>
                                <div class="pkg-price-old">₹{{ number_format($pkg->price ?? 0) }}</div>
                            @elseif($pkg->price)
                                <div class="pkg-price">₹{{ number_format($pkg->price) }}</div>
                            @else
                                <div class="pkg-price">On Request</div>
                            @endif
                        </div>
                        @php $features = $pkg->features ?: ($pkg->services_included ?? []); @endphp
                        @if(!empty($features))
                        <div class="pkg-features">
                            @foreach($features as $f)
                            <div class="pkg-feat"><i class="fas fa-check-circle"></i> {{ $f }}</div>
                            @endforeach
                        </div>
                        @endif
                        <a href="{{ url(($userdata->slug ?? '').'/salon-booking') }}" class="pkg-cta">
                            Book Package
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @else
        <!-- Default packages if no DB data -->
        <div id="packages">
            <div class="sec-header">
                <span class="sec-num">03</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Special Packages</h2>
            </div>
            @php
            $defPkgs = [
                ['name'=>'Glow Day Spa','price'=>'₹2,499','img'=>'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80','feats'=>['Facial','Hair Spa','Manicure','Head Massage']],
                ['name'=>'Bridal Bliss','price'=>'₹14,999','img'=>'https://images.unsplash.com/photo-1519415510236-718bdfcd89c8?auto=format&fit=crop&w=600&q=80','feats'=>['Bridal Makeup','Hair Styling','Mehendi','Nails + Skin']],
                ['name'=>'Party Ready','price'=>'₹1,999','img'=>'https://images.unsplash.com/photo-1581182800629-7d90925ad072?auto=format&fit=crop&w=600&q=80','feats'=>['Party Makeup','Blow-dry','Eye Lashes','Touch-up Kit']],
            ];
            @endphp
            <div class="packages-grid">
                @foreach($defPkgs as $pkg)
                <div class="pkg-card">
                    <div class="pkg-img-head" style="background-image:url('{{ $pkg['img'] }}')">
                        <div class="pkg-img-ov"></div>
                        <div class="pkg-img-content">
                            <div class="pkg-name">{{ $pkg['name'] }}</div>
                        </div>
                    </div>
                    <div class="pkg-body">
                        <div class="pkg-price-row">
                            <div class="pkg-price">{{ $pkg['price'] }}</div>
                        </div>
                        <div class="pkg-features">
                            @foreach($pkg['feats'] as $f)
                            <div class="pkg-feat"><i class="fas fa-check-circle"></i> {{ $f }}</div>
                            @endforeach
                        </div>
                        <a href="{{ url(($userdata->slug ?? '').'/salon-booking') }}" class="pkg-cta">Book Package</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 04 OUR EXPERT TEAM -->
        @if($salonArtists->count() > 0)
        <div id="team">
            <div class="sec-header">
                <span class="sec-num">04</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Our Expert Team</h2>
            </div>
            <div class="artists-grid">
                @foreach($salonArtists as $artist)
                <div class="artist-card">
                    <div class="artist-img-wrap">
                        @if($artist->photo)
                            <img src="{{ asset('uploads/salon/artists/'.$artist->photo) }}" alt="{{ $artist->artist_name }}">
                        @else
                            <div class="artist-img-ph">{{ strtoupper(substr($artist->artist_name,0,2)) }}</div>
                        @endif
                    </div>
                    <div class="artist-info">
                        <div class="artist-name">{{ $artist->artist_name }}</div>
                        @if($artist->experience_years)
                        <div class="artist-exp">{{ $artist->experience_years }}+ yrs experience</div>
                        @endif
                        @if(!empty($artist->specialization))
                        <div class="artist-specs">
                            @foreach($artist->specialization as $s)
                            <span class="spec-tag">{{ $s }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 05 PORTFOLIO FILMSTRIP (Before & After) -->
        @if($salonPortfolio->count() > 0)
        <div id="gallery">
            <div class="sec-header">
                <span class="sec-num">05</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Before &amp; After Gallery</h2>
            </div>
            <div class="filmstrip-wrap">
                <div class="filmstrip">
                    @foreach($salonPortfolio as $item)
                    <div class="film-item">
                        @if($item->before_image && $item->after_image)
                            <div style="display:grid;grid-template-columns:1fr 1fr;height:100%">
                                <img src="{{ asset('uploads/salon/portfolio/'.$item->before_image) }}" style="width:100%;height:100%;object-fit:cover;" alt="Before">
                                <img src="{{ asset('uploads/salon/portfolio/'.$item->after_image) }}" style="width:100%;height:100%;object-fit:cover;" alt="After">
                            </div>
                            <div class="film-labels">
                                <div class="film-label">Before</div>
                                <div class="film-label" style="background:rgba(244,63,94,0.85)">After</div>
                            </div>
                        @elseif($item->after_image)
                            <img src="{{ asset('uploads/salon/portfolio/'.$item->after_image) }}" alt="After">
                        @else
                            <div class="film-ph"><i class="fas fa-image"></i></div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- 06 RETAIL PRODUCTS -->
        @if($salonProducts->count() > 0)
        <div id="products">
            <div class="sec-header">
                <span class="sec-num">06</span>
                <div class="sec-bar"></div>
                <h2 class="sec-title">Retail Products</h2>
            </div>
            <div class="products-grid">
                @foreach($salonProducts as $prod)
                <div class="prod-card">
                    <div class="prod-img-wrap">
                        @if($prod->image)
                            <img src="{{ asset('uploads/salon/products/'.$prod->image) }}" alt="{{ $prod->product_name }}">
                        @else
                            <div class="prod-img-ph"><i class="fas fa-box"></i></div>
                        @endif
                    </div>
                    <div class="prod-info">
                        <div class="prod-name">{{ $prod->product_name }}</div>
                        @if($prod->brand)<div class="prod-brand">{{ $prod->brand }}</div>@endif
                        <div class="prod-price">{{ $prod->price ? '₹'.number_format($prod->price) : 'Call for Price' }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- ============================
             CTA SECTION
             "GLOW. TRANSFORM. RADIATE."
        ============================ -->
        <div id="contact" class="cta-section">
            <div class="cta-bg"></div>
            <div class="cta-ov"></div>
            <div class="cta-top-stripe"></div>

            <div class="cta-inner">
                <!-- Left: Big headline -->
                <div>
                    <div class="cta-eyebrow"><i class="fas fa-sparkles"></i> Book Your Session</div>
                    <h2 class="cta-headline">
                        GLOW.<br>
                        TRANSFORM.<br>
                        <span class="cta-accent">RADIATE.</span>
                    </h2>
                    <p class="cta-desc">
                        Let's bring your beauty vision to life. Whether it's a bridal look,
                        a fresh hair colour, or a relaxing spa day — we're here for every occasion.
                    </p>
                    <div class="cta-btns">
                        @if($userdata->contact ?? null)
                        <a href="tel:{{ $userdata->contact }}" class="btn-rose">
                            <i class="fas fa-phone-alt"></i> Call Now
                        </a>
                        @endif
                        @if($userdata->whatsapp ?? null)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$userdata->whatsapp) }}" target="_blank" class="btn-ghost">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Right: Contact info -->
                <div>
                    @if($userdata->contact ?? null)
                    <a href="tel:{{ $userdata->contact }}" class="ci-item">
                        <div class="ci-icon ci-rose"><i class="fas fa-phone-alt"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Call Us</div>
                            <div class="ci-value">{{ $userdata->contact }}</div>
                        </div>
                    </a>
                    @endif

                    @if($userdata->email ?? null)
                    <a href="mailto:{{ $userdata->email }}" class="ci-item">
                        <div class="ci-icon ci-gold"><i class="fas fa-envelope"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Email</div>
                            <div class="ci-value">{{ $userdata->email }}</div>
                        </div>
                    </a>
                    @endif

                    @if(($userdata->city ?? null) || ($userdata->state ?? null))
                    <div class="ci-item">
                        <div class="ci-icon ci-plum"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Visit Us</div>
                            <div class="ci-value">{{ $userdata->city ?? '' }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                        </div>
                    </div>
                    @endif

                    @if($userdata->whatsapp ?? null)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$userdata->whatsapp) }}" target="_blank" class="ci-item">
                        <div class="ci-icon ci-green"><i class="fab fa-whatsapp"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">WhatsApp</div>
                            <div class="ci-value">{{ $userdata->whatsapp }}</div>
                        </div>
                    </a>
                    @endif

                    <a href="{{ url(($userdata->slug ?? '').'/salon-booking') }}" class="ci-item">
                        <div class="ci-icon ci-rose"><i class="fas fa-calendar-check"></i></div>
                        <div class="ci-text">
                            <div class="ci-label">Online Booking</div>
                            <div class="ci-value">Book Your Slot Now</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div><!-- /content-wrap -->

    <!-- ============================
         FOLLOW OUR REEL / SOCIAL
    ============================ -->
    @if(($userdata->facebook ?? null) || ($userdata->instagram ?? null) || ($userdata->youtube ?? null))
    <div class="social-section">
        <div class="soc-eyebrow">Follow Our <span>Reel</span></div>
        <div class="soc-heading">Stay Inspired</div>
        <div class="soc-icons">
            @if($userdata->facebook ?? null)
            <a href="{{ $userdata->facebook }}" target="_blank" class="soc-btn soc-fb">
                <i class="fab fa-facebook-f"></i>
            </a>
            @endif
            @if($userdata->instagram ?? null)
            <a href="{{ $userdata->instagram }}" target="_blank" class="soc-btn soc-ig">
                <i class="fab fa-instagram"></i>
            </a>
            @endif
            @if($userdata->youtube ?? null)
            <a href="{{ $userdata->youtube }}" target="_blank" class="soc-btn soc-yt">
                <i class="fab fa-youtube"></i>
            </a>
            @endif
        </div>
    </div>
    @endif

    <!-- ============================
         FOOTER
    ============================ -->
    <footer class="site-footer">
        <div>
            <div class="footer-brand-name">
                {{ explode(' ', $userdata->name)[0] ?? 'GLAM' }}
                <span>{{ implode(' ', array_slice(explode(' ',$userdata->name),1)) ?: 'Studio' }}</span>
            </div>
            <div class="footer-sub">Beauty &amp; Wellness Studio</div>
        </div>
        <div class="footer-copy">© {{ date('Y') }} All Rights Reserved</div>
        <div class="footer-powered">Powered by <a href="{{ url('/') }}">Fastap</a></div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id   ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview      ?? false
    ])
</body>
</html>