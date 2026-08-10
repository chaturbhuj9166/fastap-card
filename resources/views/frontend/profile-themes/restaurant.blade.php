<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Hotel' }} - Fine Dining & Reservations</title>

    @php
        $websetting = App\Models\websetting::first();
        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile' => 1,'quali' => 1,'service' => 1,'thought' => 1,'personal' => 1,
                'profess' => 1,'videos' => 1,'product' => 1,'social_link' => 1,
                'upload_file' => 1,'client' => 1,'menu_section' => 1,
                'reservation_section' => 1,'property_listings' => 1,'showreel' => 1,
                'team_section' => 1,'pricing_section' => 1,'booking_section' => 1,
            ];
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal',
                    'profess','videos','product','social_link','upload_file','client','menu_section',
                    'reservation_section','property_listings','showreel','team_section',
                    'pricing_section','booking_section'], 1);
            }
        }
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ─── LUXURY VARIABLES ─────────────────────────────────── */
        :root {
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --gold-dark:   #8B6914;
            --gold-muted:  rgba(201,168,76,0.18);
            --gold-border: rgba(201,168,76,0.35);
            --obsidian:    #080808;
            --dark-1:      #0d0d0d;
            --dark-2:      #141414;
            --dark-3:      #1e1e1e;
            --dark-4:      #2a2a2a;
            --cream:       #f5f0e8;
            --ivory:       #fdfaf4;
            --text-main:   #e8dcc8;
            --text-muted:  #9a8f7e;
            --text-dim:    #5a5248;
            --glass-bg:    rgba(14,12,10,0.75);
            --glass-border:rgba(201,168,76,0.22);
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark-1);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ─── SCROLLBAR ─────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark-1); }
        ::-webkit-scrollbar-thumb { background: var(--gold-dark); border-radius: 3px; }

        /* ─── PREVIEW BANNER ────────────────────────────────────── */
        .preview-banner {
            background: linear-gradient(90deg, #2d1b69, #7c3aed, #ec4899);
            color: white;
            padding: 12px 20px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.04em;
            position: sticky;
            top: 0;
            z-index: 9999;
        }
        .preview-banner a { color: #fbbf24; text-decoration: underline; font-weight: 600; margin-left: 8px; }

        /* ─── HERO BANNER ───────────────────────────────────────── */
        .hero-banner {
            position: relative;
            width: 100%;
            height: 100vh;
            min-height: 700px;
            max-height: 900px;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://sspark.genspark.ai/cfimages?u1=4pKuB%2BRR4cLs4dZa1ChN4tnpC7E4tpaslvM7x3QTPF8E%2BSu8NeBkj6P81xkH5R6dxxv%2B9%2F1M8dFe9FP9RQ0xAVL6v%2Bu1LNZvwSce3lxr7xI%3D&u2=rnr4xbIS0JyQ8Qu2&width=2560');
            background-size: cover;
            background-position: center;
            transform: scale(1.07);
            animation: slowZoom 20s ease-in-out infinite alternate;
        }

        @keyframes slowZoom {
            from { transform: scale(1.07); }
            to   { transform: scale(1.13); }
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(4,3,2,0.30) 0%,
                rgba(4,3,2,0.55) 40%,
                rgba(4,3,2,0.90) 80%,
                rgba(8,8,8,1.00) 100%
            );
        }

        /* Gold shimmer line at top */
        .hero-top-line {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold-light), var(--gold), var(--gold-light), transparent);
            z-index: 10;
        }

        .hero-content {
            position: relative;
            z-index: 5;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 2rem;
        }

        .hero-ornament {
            color: var(--gold);
            font-size: 1.3rem;
            letter-spacing: 0.6em;
            text-transform: uppercase;
            opacity: 0.7;
            margin-bottom: 1.5rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 300;
        }

        .hero-crown {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 1rem;
        }

        .crown-line {
            height: 1px;
            width: 80px;
            background: linear-gradient(90deg, transparent, var(--gold));
        }

        .crown-line.right {
            background: linear-gradient(90deg, var(--gold), transparent);
        }

        .crown-icon {
            color: var(--gold);
            font-size: 1.6rem;
        }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3.5rem, 8vw, 7rem);
            font-weight: 700;
            color: var(--ivory);
            line-height: 1.0;
            letter-spacing: 0.04em;
            margin-bottom: 0.5rem;
        }

        .hero-title em {
            font-style: italic;
            color: var(--gold-light);
        }

        .hero-subtitle {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(0.85rem, 2vw, 1.1rem);
            font-weight: 400;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 2.5rem;
        }

        .hero-badges {
            display: flex;
            gap: 1.2rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.3rem;
            border: 1px solid var(--gold-border);
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(10px);
            border-radius: 2px;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            color: var(--cream);
        }

        .hero-badge i { color: var(--gold); font-size: 0.8rem; }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 1rem 2.5rem;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold), var(--gold-light));
            color: var(--obsidian);
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .btn-gold::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-gold:hover::before { left: 100%; }

        .btn-gold:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(201,168,76,0.45);
            color: var(--obsidian);
            text-decoration: none;
        }

        .btn-outline-gold {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 1rem 2.5rem;
            background: transparent;
            color: var(--gold-light);
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            border: 1.5px solid var(--gold-border);
            cursor: pointer;
            transition: all 0.4s ease;
            backdrop-filter: blur(8px);
        }

        .btn-outline-gold:hover {
            background: var(--gold-muted);
            border-color: var(--gold);
            color: var(--gold-light);
            transform: translateY(-3px);
            text-decoration: none;
        }

        /* Scroll indicator */
        .hero-scroll {
            position: absolute;
            bottom: 2.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: var(--gold);
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            z-index: 5;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50%       { transform: translateX(-50%) translateY(8px); }
        }

        /* ─── MAIN CONTENT WRAPPER ──────────────────────────────── */
        .main-content {
            position: relative;
            z-index: 2;
            background: var(--dark-1);
        }

        /* Section divider ornament */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin: 0 auto 3rem;
            max-width: 400px;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-border));
        }

        .divider-line.right {
            background: linear-gradient(90deg, var(--gold-border), transparent);
        }

        .divider-diamond {
            width: 8px; height: 8px;
            background: var(--gold);
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        /* ─── PROFILE STRIP ─────────────────────────────────────── */
        .profile-strip {
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 2rem 3rem;
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 3rem;
            align-items: center;
        }

        .profile-avatar-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .profile-avatar-ring {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            padding: 4px;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
        }

        .profile-avatar-ring img,
        .profile-avatar-initial {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-avatar-initial {
            background: var(--dark-3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 4rem;
            font-weight: 700;
            color: var(--gold);
        }

        .profile-status-dot {
            position: absolute;
            bottom: 10px; right: 10px;
            width: 20px; height: 20px;
            border-radius: 50%;
            background: #22c55e;
            border: 3px solid var(--dark-1);
            box-shadow: 0 0 10px rgba(34,197,94,0.6);
        }

        .profile-info { }

        .profile-label {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.5rem;
        }

        .profile-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 700;
            color: var(--ivory);
            line-height: 1.1;
            margin-bottom: 0.6rem;
        }

        .profile-tagline {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 400;
            letter-spacing: 0.08em;
            margin-bottom: 1.5rem;
        }

        .profile-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .meta-item i { color: var(--gold); font-size: 0.8rem; }

        /* ─── QUICK ACTIONS BAR ─────────────────────────────────── */
        .actions-bar {
            background: var(--dark-2);
            border-top: 1px solid var(--gold-border);
            border-bottom: 1px solid var(--gold-border);
        }

        .actions-bar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.25rem 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        /* ─── SECTION WRAPPER ───────────────────────────────────── */
        .lux-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 2rem;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 1rem;
        }

        .section-eyebrow {
            display: block;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1rem;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--ivory);
            line-height: 1.15;
        }

        .section-title em {
            font-style: italic;
            color: var(--gold-light);
        }

        /* ─── MENU SEARCH & FILTERS ─────────────────────────────── */
        .menu-controls {
            margin-bottom: 3rem;
        }

        .search-wrap {
            position: relative;
            max-width: 560px;
            margin: 0 auto 2rem;
        }

        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold);
            font-size: 0.9rem;
        }

        .lux-search {
            width: 100%;
            padding: 1.05rem 1.25rem 1.05rem 3.2rem;
            background: var(--dark-3);
            border: 1px solid var(--gold-border);
            color: var(--cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 0.04em;
            border-radius: 2px;
            outline: none;
            transition: all 0.3s;
        }

        .lux-search::placeholder { color: var(--text-dim); }

        .lux-search:focus {
            border-color: var(--gold);
            background: var(--dark-4);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.1), 0 4px 20px rgba(201,168,76,0.08);
        }

        .filter-tabs {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 0.65rem 1.6rem;
            background: transparent;
            border: 1px solid var(--gold-border);
            color: var(--text-muted);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .filter-tab:hover,
        .filter-tab.active {
            background: var(--gold-muted);
            border-color: var(--gold);
            color: var(--gold-light);
        }

        .filter-tab.fveg { border-color: rgba(34,197,94,0.4); color: rgba(34,197,94,0.8); }
        .filter-tab.fveg:hover, .filter-tab.fveg.active {
            background: rgba(34,197,94,0.1); border-color: #22c55e; color: #4ade80;
        }

        .filter-tab.fnonveg { border-color: rgba(239,68,68,0.4); color: rgba(239,68,68,0.8); }
        .filter-tab.fnonveg:hover, .filter-tab.fnonveg.active {
            background: rgba(239,68,68,0.1); border-color: #ef4444; color: #f87171;
        }

        /* ─── MENU CATEGORY ─────────────────────────────────────── */
        .menu-category {
            margin-bottom: 5rem;
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--gold-border);
        }

        .category-icon-wrap {
            width: 56px;
            height: 56px;
            border: 1px solid var(--gold-border);
            background: var(--dark-3);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .category-icon-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-icon-wrap i { color: var(--gold); font-size: 1.4rem; }

        .category-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--ivory);
            letter-spacing: 0.04em;
        }

        .category-count {
            margin-left: auto;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-dim);
            white-space: nowrap;
        }

        /* ─── MENU ITEMS GRID ───────────────────────────────────── */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
            gap: 1.5rem;
        }

        .menu-card {
            background: var(--dark-2);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 2px;
            overflow: hidden;
            transition: all 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            cursor: default;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border: 1px solid transparent;
            border-radius: 2px;
            transition: border-color 0.45s;
            pointer-events: none;
            z-index: 2;
        }

        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 60px rgba(0,0,0,0.6), 0 0 0 1px var(--gold-border);
        }

        .menu-card:hover::before {
            border-color: var(--gold-border);
        }

        .card-image {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .menu-card:hover .card-image img {
            transform: scale(1.08);
        }

        .card-image-placeholder {
            width: 100%;
            height: 100%;
            background: var(--dark-3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-image-placeholder i {
            font-size: 2.5rem;
            color: var(--text-dim);
        }

        .card-image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 50%);
        }

        /* Gold corner accent */
        .card-corner {
            position: absolute;
            top: 0; right: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 0 40px 40px 0;
            border-color: transparent var(--gold) transparent transparent;
        }

        .badge-ribbon {
            position: absolute;
            top: 12px; left: 0;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            color: var(--obsidian);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.35rem 0.9rem 0.35rem 0.7rem;
            clip-path: polygon(0 0, 100% 0, 90% 50%, 100% 100%, 0 100%);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-top-row {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .dietary-dot {
            width: 20px; height: 20px;
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            flex-shrink: 0;
            margin-top: 3px;
        }

        .dot-veg     { background: rgba(34,197,94,0.15); border: 1px solid #22c55e; color: #22c55e; }
        .dot-nonveg  { background: rgba(239,68,68,0.15); border: 1px solid #ef4444; color: #ef4444; }
        .dot-egg     { background: rgba(245,158,11,0.15); border: 1px solid #f59e0b; color: #f59e0b; }

        .card-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--ivory);
            line-height: 1.2;
            flex: 1;
        }

        .card-badges {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 0.75rem;
        }

        .lux-badge {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.28rem 0.7rem;
            border-radius: 1px;
        }

        .lux-badge-best {
            background: rgba(201,168,76,0.12);
            border: 1px solid rgba(201,168,76,0.4);
            color: var(--gold-light);
        }

        .lux-badge-special {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.35);
            color: #f87171;
        }

        .card-description {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.65;
            margin-bottom: 1.25rem;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .card-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--gold-light);
        }

        .card-price span {
            font-size: 1rem;
            color: var(--text-dim);
        }

        .spice-level {
            display: flex;
            gap: 4px;
        }

        .spice-level i { font-size: 0.75rem; color: #ef4444; }
        .spice-level i.off { color: var(--dark-4); }

        /* ─── EMPTY STATE ───────────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--text-dim);
        }

        .empty-state i { font-size: 3rem; margin-bottom: 1.5rem; opacity: 0.3; display: block; }

        /* ─── INFO SECTIONS ─────────────────────────────────────── */

        /* Chandelier bg section */
        .chandelier-section {
            position: relative;
            overflow: hidden;
        }

        .chandelier-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://sspark.genspark.ai/cfimages?u1=oXcrYc7qys6UEMLmuOv1rQC4kMcXgJCPRWCu94GMJFju%2Fj%2Fz8n6VfVP05XMiu9mR3bu0rMMhP%2FRhYGdoXA%2FNMcaldUNmF2zoXdQxpAv64XojhQd51M7IOKl8Gi49HUqhc1pkVVxuredB24AAZOMZPjOHhJte3OyVGBw857xYB8LRh%2FAQNoB4KguO2h5r%2Bw%3D%3D&u2=Y5NoEdL1EwxuPt4%2B&width=2560');
            background-size: cover;
            background-position: center top;
            opacity: 0.08;
        }

        .chandelier-overlay {
            position: absolute;
            inset: 0;
            background: var(--dark-1);
            opacity: 0.82;
        }

        .chandelier-section .lux-section {
            position: relative;
            z-index: 2;
        }

        /* Info cards */
        .info-card {
            background: var(--dark-2);
            border: 1px solid var(--glass-border);
            padding: 2.5rem;
            margin-bottom: 1.5rem;
            position: relative;
        }

        /* Gold left accent */
        .info-card::before {
            content: '';
            position: absolute;
            left: 0; top: 10%; bottom: 10%;
            width: 3px;
            background: linear-gradient(to bottom, transparent, var(--gold), transparent);
        }

        .info-card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--ivory);
            margin-bottom: 1.75rem;
            display: flex;
            align-items: center;
            gap: 0.9rem;
        }

        .info-card-title i { color: var(--gold); font-size: 1.2rem; }

        /* Hours */
        .hours-grid { display: flex; flex-direction: column; gap: 0.6rem; }

        .hours-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.85rem 1.25rem;
            background: var(--dark-3);
            border: 1px solid transparent;
            transition: border-color 0.3s;
            font-size: 0.88rem;
        }

        .hours-row:hover { border-color: var(--gold-border); }

        .hours-row .day { font-weight: 600; color: var(--cream); letter-spacing: 0.04em; }
        .hours-row .time { color: var(--text-muted); }
        .hours-row.closed .time { color: #f87171; }

        /* Services */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .service-tile {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 1.5rem;
            background: var(--dark-3);
            border: 1px solid transparent;
            transition: all 0.3s;
        }

        .service-tile:hover { border-color: var(--gold-border); }

        .service-icon {
            width: 44px; height: 44px;
            border: 1px solid var(--gold-border);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .service-tile.available .service-icon { color: var(--gold); }
        .service-tile.unavailable { opacity: 0.4; }
        .service-tile.unavailable .service-icon { color: var(--text-dim); border-color: var(--text-dim); }

        .service-label { font-size: 0.9rem; font-weight: 600; color: var(--cream); }
        .service-status { font-size: 0.72rem; color: var(--text-dim); letter-spacing: 0.06em; }

        /* ─── CONTACT GRID ──────────────────────────────────────── */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
        }

        .contact-tile {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding: 1.5rem;
            background: var(--dark-3);
            border: 1px solid var(--glass-border);
            text-decoration: none;
            color: inherit;
            transition: all 0.35s;
        }

        .contact-tile:hover {
            border-color: var(--gold);
            background: var(--dark-4);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.4);
            text-decoration: none;
            color: inherit;
        }

        .contact-tile-icon {
            width: 54px; height: 54px;
            border: 1px solid var(--gold-border);
            background: var(--dark-2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .contact-tile-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.3rem;
        }

        .contact-tile-value {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--cream);
        }

        /* ─── RESERVATION CTA SECTION ───────────────────────────── */
        .reserve-cta-section {
            position: relative;
            overflow: hidden;
        }

        .reserve-cta-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://sspark.genspark.ai/cfimages?u1=ZtYVLzjf%2BpcxZzRnCdRWehbMn4krYyhwdkD8EhFzO%2FdwEqnUaTUj4EgNv7Mkqh603JRbJnszQED863n69rXr7xWnS%2Fw5FdlrGrKHO3m4FfrrevPW&u2=%2BRT0QIaRMwDjwrMy&width=2560');
            background-size: cover;
            background-position: center;
        }

        .reserve-cta-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(8,8,8,0.88) 0%, rgba(20,14,4,0.82) 100%);
        }

        .reserve-cta-inner {
            position: relative;
            z-index: 2;
            max-width: 700px;
            margin: 0 auto;
            padding: 7rem 2rem;
            text-align: center;
        }

        .reserve-cta-inner .section-eyebrow { margin-bottom: 1.2rem; }

        .reserve-cta-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 700;
            color: var(--ivory);
            line-height: 1.15;
            margin-bottom: 1rem;
        }

        .reserve-cta-title em { font-style: italic; color: var(--gold-light); }

        .reserve-cta-sub {
            font-size: 0.95rem;
            color: var(--text-muted);
            letter-spacing: 0.06em;
            margin-bottom: 3rem;
        }

        /* ─── RESERVE MODAL ─────────────────────────────────────── */
        .reserve-modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.85);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9998;
            backdrop-filter: blur(6px);
            padding: 1rem;
        }

        .reserve-modal.active { display: flex; }

        .reserve-modal-box {
            background: var(--dark-2);
            border: 1px solid var(--gold-border);
            max-width: 600px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        /* Gold top bar */
        .reserve-modal-box::before {
            content: '';
            display: block;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .reserve-modal-head {
            padding: 2rem 2.5rem 1.5rem;
            border-bottom: 1px solid var(--glass-border);
        }

        .reserve-modal-head .section-eyebrow { margin-bottom: 0.5rem; }

        .reserve-modal-head h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--ivory);
        }

        .reserve-modal-head p {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-top: 0.4rem;
        }

        .reserve-modal-close {
            position: absolute;
            top: 1.5rem; right: 1.5rem;
            width: 36px; height: 36px;
            background: var(--dark-4);
            border: 1px solid var(--glass-border);
            color: var(--text-muted);
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .reserve-modal-close:hover {
            background: var(--gold-muted);
            border-color: var(--gold);
            color: var(--gold-light);
        }

        .reserve-modal-body { padding: 2rem 2.5rem 2.5rem; }

        .reserve-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .reserve-field label {
            display: block;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.5rem;
        }

        .reserve-field input {
            width: 100%;
            padding: 0.9rem 1rem;
            background: var(--dark-3);
            border: 1px solid var(--glass-border);
            color: var(--cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.88rem;
            outline: none;
            transition: all 0.3s;
        }

        .reserve-field input::placeholder { color: var(--text-dim); }

        .reserve-field input:focus {
            border-color: var(--gold);
            background: var(--dark-4);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.08);
        }

        .reserve-submit-row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-wa {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 1rem 2rem;
            background: #25D366;
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-wa:hover {
            background: #20ba5a;
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        /* ─── FOOTER ────────────────────────────────────────────── */
        .site-footer {
            background: var(--dark-2);
            border-top: 1px solid var(--gold-border);
            text-align: center;
            padding: 2.5rem 2rem;
        }

        .footer-ornament {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .footer-ornament .divider-line { width: 60px; }

        .site-footer p {
            font-size: 0.82rem;
            color: var(--text-dim);
            letter-spacing: 0.08em;
        }

        .site-footer a { color: var(--gold); text-decoration: none; font-weight: 600; }

        /* ─── ANIMATIONS ────────────────────────────────────────── */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ─── RESPONSIVE ────────────────────────────────────────── */
        @media (max-width: 768px) {
            .profile-strip {
                grid-template-columns: 1fr;
                text-align: center;
                padding: 3rem 1.5rem 2rem;
            }

            .profile-avatar-ring { margin: 0 auto; }

            .profile-meta { justify-content: center; }

            .hero-title { font-size: 3rem; }

            .menu-grid { grid-template-columns: 1fr; }

            .reserve-fields { grid-template-columns: 1fr; }

            .lux-section { padding: 3rem 1.5rem; }

            .hero-crown .crown-line { width: 40px; }

            .info-card { padding: 1.75rem 1.5rem; }
        }

        @media (max-width: 480px) {
            .hero-actions { flex-direction: column; align-items: center; }
            .btn-gold, .btn-outline-gold { width: 100%; max-width: 280px; justify-content: center; }
        }
    </style>
</head>
<body>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> Preview Mode &mdash; This is how your profile looks.
        <a href="{{ url('/signin') }}">Sign up free</a> to publish your luxury profile!
    </div>
    @endif

    <!-- ═══════════════════════════════════════════════════════
         HERO BANNER
    ═══════════════════════════════════════════════════════ -->
    <section class="hero-banner">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-top-line"></div>

        <div class="hero-content">
            <p class="hero-ornament">Est. Excellence</p>

            <div class="hero-crown">
                <div class="crown-line"></div>
                <i class="fas fa-crown crown-icon"></i>
                <div class="crown-line right"></div>
            </div>

            <h1 class="hero-title">
                {{ $userdata->name ?? '<em>Grand</em> Hotel' }}
            </h1>

            <p class="hero-subtitle">
                {{ (isset($restaurantInfo) ? $restaurantInfo->cuisine_type : null) ?? $userdata->desig ?? 'Fine Dining &amp; Luxury Hospitality' }}
            </p>

            <div class="hero-badges">
                @if($restaurantInfo && method_exists($restaurantInfo, 'isOpen') && $restaurantInfo->isOpen())
                    <span class="hero-badge"><i class="fas fa-circle" style="font-size:0.5rem;color:#22c55e;"></i> Open Now</span>
                @elseif($restaurantInfo && method_exists($restaurantInfo, 'isOpen') && $restaurantInfo->isOpen() === false)
                    <span class="hero-badge"><i class="fas fa-circle" style="font-size:0.5rem;color:#f87171;"></i> Closed</span>
                @endif
                @if($restaurantInfo && ($restaurantInfo->average_cost ?? false))
                    <span class="hero-badge"><i class="fas fa-rupee-sign"></i> &#8377;{{ $restaurantInfo->average_cost }} for Two</span>
                @endif
                @if($userdata->city)
                    <span class="hero-badge"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</span>
                @endif
            </div>

            <div class="hero-actions">
                @if($userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="btn-gold">
                        <i class="fas fa-phone"></i> Reserve Now
                    </a>
                @endif
                @if($restaurantInfo && $restaurantInfo->reservation_available)
                    <a href="#" class="btn-outline-gold reserve-trigger">
                        <i class="fas fa-calendar-check"></i> Book a Table
                    </a>
                @endif
                @if($social && $social->map)
                    <a href="{{ $social->map }}" target="_blank" class="btn-outline-gold">
                        <i class="fas fa-directions"></i> Directions
                    </a>
                @endif
            </div>
        </div>

        <div class="hero-scroll">
            <span>Scroll</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         MAIN CONTENT
    ═══════════════════════════════════════════════════════ -->
    <div class="main-content">

        <!-- Profile Strip -->
        <div class="profile-strip fade-up">
            <div class="profile-avatar-wrap">
                <div class="profile-avatar-ring">
                    @if($userdata->profile)
                        <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
                    @else
                        <div class="profile-avatar-initial">{{ substr($userdata->name, 0, 1) }}</div>
                    @endif
                </div>
                <div class="profile-status-dot"></div>
            </div>

            <div class="profile-info">
                <p class="profile-label">Luxury Hotel &amp; Dining</p>
                <h2 class="profile-name">{{ $userdata->name }}</h2>
                <p class="profile-tagline">
                    {{ (isset($restaurantInfo) ? $restaurantInfo->cuisine_type : null) ?? $userdata->desig ?? 'Fine Dining · Premium Hospitality' }}
                </p>
                <div class="profile-meta">
                    @if($userdata->city)
                        <span class="meta-item"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</span>
                    @endif
                    @if($userdata->mobile)
                        <span class="meta-item"><i class="fas fa-phone"></i> {{ $userdata->mobile }}</span>
                    @endif
                    @if($restaurantInfo && ($restaurantInfo->average_cost ?? false))
                        <span class="meta-item"><i class="fas fa-rupee-sign"></i> &#8377;{{ $restaurantInfo->average_cost }} avg for two</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions Bar -->
        <div class="actions-bar">
            <div class="actions-bar-inner">
                @if($userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="btn-gold">
                        <i class="fas fa-phone"></i> Call Us
                    </a>
                @endif
                @if($restaurantInfo && $restaurantInfo->reservation_available)
                    <a href="#" class="btn-outline-gold reserve-trigger">
                        <i class="fas fa-calendar-check"></i> Reserve Table
                    </a>
                @endif
                @if($social && $social->map)
                    <a href="{{ $social->map }}" target="_blank" class="btn-outline-gold">
                        <i class="fas fa-directions"></i> Get Directions
                    </a>
                @endif
            </div>
        </div>

        <!-- ═══════ MENU SECTION ═══════ -->
        @if(isset($menuCategories) && $menuCategories->count() > 0)
        <div class="lux-section fade-up">
            <div class="section-heading">
                <span class="section-eyebrow">Culinary Excellence</span>
                <h2 class="section-title">Our <em>Menu</em></h2>
            </div>
            <div class="section-divider">
                <div class="divider-line"></div>
                <div class="divider-diamond"></div>
                <div class="divider-line right"></div>
            </div>

            <!-- Controls -->
            <div class="menu-controls">
                <div class="search-wrap">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="lux-search" id="menuSearch" placeholder="Search dishes, ingredients…">
                </div>
                <div class="filter-tabs">
                    <button class="filter-tab active" data-filter="all">All Items</button>
                    <button class="filter-tab fveg" data-filter="veg">
                        <i class="fas fa-circle" style="font-size:0.55rem;margin-right:0.3rem;"></i>Vegetarian
                    </button>
                    <button class="filter-tab fnonveg" data-filter="non_veg">
                        <i class="fas fa-drumstick-bite" style="font-size:0.7rem;margin-right:0.3rem;"></i>Non-Veg
                    </button>
                    <button class="filter-tab" data-filter="bestseller">
                        <i class="fas fa-star" style="color:var(--gold);margin-right:0.3rem;"></i>Bestsellers
                    </button>
                </div>
            </div>

            <!-- Categories -->
            @foreach($menuCategories as $category)
                @php
                    $itemsCount = is_array($category->items) ? count($category->items) : $category->items->count();
                @endphp
                @if($itemsCount > 0)
                <div class="menu-category" data-category="{{ $category->id }}">
                    <div class="category-header">
                        <div class="category-icon-wrap">
                            @if(isset($category->image) && $category->image)
                                <img src="{{ asset('uploads/menu/categories/' . $category->image) }}" alt="{{ $category->name }}">
                            @else
                                <i class="fas fa-utensils"></i>
                            @endif
                        </div>
                        <h3 class="category-name">{{ $category->name }}</h3>
                        <span class="category-count">{{ $itemsCount }} dishes</span>
                    </div>

                    <div class="menu-grid">
                        @foreach($category->items as $item)
                        <div class="menu-card"
                             data-dietary="{{ $item->dietary_type ?? 'veg' }}"
                             data-bestseller="{{ ($item->is_bestseller ?? false) ? 'yes' : 'no' }}"
                             data-name="{{ strtolower($item->name ?? '') }}">

                            <div class="card-image">
                                @if(isset($item->image) && $item->image)
                                    <img src="{{ asset('uploads/menu/items/' . $item->image) }}" alt="{{ $item->name }}">
                                @else
                                    <div class="card-image-placeholder">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                @endif
                                <div class="card-image-overlay"></div>
                                @if($item->is_bestseller ?? false)
                                    <div class="badge-ribbon"><i class="fas fa-star"></i> Bestseller</div>
                                @endif
                                @if($item->is_chefs_special ?? false)
                                    <div class="card-corner"></div>
                                @endif
                            </div>

                            <div class="card-body">
                                <div class="card-top-row">
                                    <span class="dietary-dot dot-{{ $item->dietary_type ?? 'veg' }}">
                                        @if(($item->dietary_type ?? 'veg') == 'veg')
                                            <i class="fas fa-circle"></i>
                                        @elseif(($item->dietary_type ?? 'veg') == 'egg')
                                            <i class="fas fa-egg"></i>
                                        @else
                                            <i class="fas fa-drumstick-bite"></i>
                                        @endif
                                    </span>
                                    <span class="card-name">{{ $item->name ?? '' }}</span>
                                </div>

                                @if(($item->is_chefs_special ?? false))
                                <div class="card-badges">
                                    <span class="lux-badge lux-badge-special"><i class="fas fa-fire"></i> Chef's Special</span>
                                </div>
                                @endif

                                @if(isset($item->description) && $item->description)
                                    <p class="card-description">{{ Str::limit($item->description, 110) }}</p>
                                @endif

                                <div class="card-footer">
                                    <div class="card-price">
                                        <span>&#8377;</span>{{ number_format($item->price ?? 0, 0) }}
                                    </div>
                                    @if(isset($item->spice_level) && $item->spice_level)
                                        @php
                                            $levels = ['mild'=>1,'medium'=>2,'hot'=>3,'extra_hot'=>4];
                                            $lvl = $levels[$item->spice_level] ?? 0;
                                        @endphp
                                        <div class="spice-level" title="{{ ucfirst(str_replace('_',' ',$item->spice_level)) }}">
                                            @for($i=1; $i<=4; $i++)
                                                <i class="fas fa-pepper-hot {{ $i<=$lvl ? '' : 'off' }}"></i>
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        @else
            <div class="lux-section">
                <div class="empty-state">
                    <i class="fas fa-utensils"></i>
                    <p style="font-size:1.1rem;color:var(--text-muted);">Our menu will be available shortly.</p>
                </div>
            </div>
        @endif

        <!-- ═══════ RESERVATION CTA ═══════ -->
        @if($userdata->isFeatureVisible('reservation') && $restaurantInfo && $restaurantInfo->reservation_available && $userdata->mobile)
        <div class="reserve-cta-section fade-up">
            <div class="reserve-cta-bg"></div>
            <div class="reserve-cta-overlay"></div>
            <div class="reserve-cta-inner">
                <span class="section-eyebrow">Private Dining</span>
                <h2 class="reserve-cta-title">Reserve Your <em>Table</em></h2>
                <p class="reserve-cta-sub">Experience an unforgettable evening — book ahead to secure your preferred time.</p>
                <a href="#" class="btn-gold reserve-trigger" style="display:inline-flex;">
                    <i class="fas fa-calendar-check"></i> Make a Reservation
                </a>
            </div>
        </div>
        @endif

        <!-- ═══════ OPERATING HOURS & SERVICES ═══════ -->
        @if($restaurantInfo)
        <div class="chandelier-section">
            <div class="chandelier-bg"></div>
            <div class="chandelier-overlay"></div>

            <div class="lux-section">
                <div class="section-heading fade-up">
                    <span class="section-eyebrow">Information</span>
                    <h2 class="section-title">Hours &amp; <em>Services</em></h2>
                </div>
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <div class="divider-diamond"></div>
                    <div class="divider-line right"></div>
                </div>

                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));gap:1.5rem;" class="fade-up">
                    @if(isset($restaurantInfo->operating_hours) && $restaurantInfo->operating_hours)
                    <div class="info-card">
                        <h4 class="info-card-title"><i class="fas fa-clock"></i> Operating Hours</h4>
                        <div class="hours-grid">
                            @php
                                $days = ['monday'=>'Monday','tuesday'=>'Tuesday','wednesday'=>'Wednesday',
                                         'thursday'=>'Thursday','friday'=>'Friday','saturday'=>'Saturday','sunday'=>'Sunday'];
                                $hours = $restaurantInfo->operating_hours;
                            @endphp
                            @foreach($days as $key => $day)
                                @if(isset($hours[$key]))
                                <div class="hours-row {{ !$hours[$key]['is_open'] ? 'closed' : '' }}">
                                    <span class="day">{{ $day }}</span>
                                    <span class="time">
                                        @if($hours[$key]['is_open'])
                                            {{ date('g:i A', strtotime($hours[$key]['open'])) }} &ndash; {{ date('g:i A', strtotime($hours[$key]['close'])) }}
                                        @else
                                            Closed
                                        @endif
                                    </span>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="info-card">
                        <h4 class="info-card-title"><i class="fas fa-concierge-bell"></i> Our Services</h4>
                        <div class="services-grid">
                            <div class="service-tile {{ ($restaurantInfo->dine_in_available ?? false) ? 'available' : 'unavailable' }}">
                                <div class="service-icon"><i class="fas fa-utensils"></i></div>
                                <div>
                                    <div class="service-label">Dine-In</div>
                                    <div class="service-status">{{ ($restaurantInfo->dine_in_available ?? false) ? 'Available' : 'Unavailable' }}</div>
                                </div>
                            </div>
                            <div class="service-tile {{ ($restaurantInfo->takeaway_available ?? false) ? 'available' : 'unavailable' }}">
                                <div class="service-icon"><i class="fas fa-shopping-bag"></i></div>
                                <div>
                                    <div class="service-label">Takeaway</div>
                                    <div class="service-status">{{ ($restaurantInfo->takeaway_available ?? false) ? 'Available' : 'Unavailable' }}</div>
                                </div>
                            </div>
                            <div class="service-tile {{ ($restaurantInfo->delivery_available ?? false) ? 'available' : 'unavailable' }}">
                                <div class="service-icon"><i class="fas fa-motorcycle"></i></div>
                                <div>
                                    <div class="service-label">Delivery</div>
                                    <div class="service-status">{{ ($restaurantInfo->delivery_available ?? false) ? 'Available' : 'Unavailable' }}</div>
                                </div>
                            </div>
                            <div class="service-tile {{ ($restaurantInfo->reservation_available ?? false) ? 'available' : 'unavailable' }}">
                                <div class="service-icon"><i class="fas fa-calendar-check"></i></div>
                                <div>
                                    <div class="service-label">Reservations</div>
                                    <div class="service-status">{{ ($restaurantInfo->reservation_available ?? false) ? 'Available' : 'Unavailable' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- ═══════ CONTACT ═══════ -->
        <div class="lux-section fade-up">
            <div class="section-heading">
                <span class="section-eyebrow">Reach Us</span>
                <h2 class="section-title">Contact &amp; <em>Location</em></h2>
            </div>
            <div class="section-divider">
                <div class="divider-line"></div>
                <div class="divider-diamond"></div>
                <div class="divider-line right"></div>
            </div>

            <div class="contact-grid">
                @if($userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="contact-tile">
                    <div class="contact-tile-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <div class="contact-tile-label">Phone</div>
                        <div class="contact-tile-value">{{ $userdata->mobile }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->email)
                <a href="mailto:{{ $userdata->email }}" class="contact-tile">
                    <div class="contact-tile-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="contact-tile-label">Email</div>
                        <div class="contact-tile-value">{{ $userdata->email }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->city || $userdata->state)
                <div class="contact-tile">
                    <div class="contact-tile-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="contact-tile-label">Location</div>
                        <div class="contact-tile-value">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                    </div>
                </div>
                @endif
                @if($social && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="contact-tile">
                    <div class="contact-tile-icon" style="color:#25D366;border-color:rgba(37,211,102,0.3);">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="contact-tile-label">WhatsApp</div>
                        <div class="contact-tile-value">Chat with Us</div>
                    </div>
                </a>
                @endif
            </div>
        </div>

    </div><!-- /main-content -->

    <!-- ═══════════════════════════════════════════════════════
         FOOTER
    ═══════════════════════════════════════════════════════ -->
    <footer class="site-footer">
        <div class="footer-ornament">
            <div class="divider-line"></div>
            <i class="fas fa-crown" style="color:var(--gold);font-size:1rem;"></i>
            <div class="divider-line right"></div>
        </div>
        <p>Digital Presence by <a href="{{ url('/') }}">Fastap</a></p>
    </footer>

    <!-- ═══════════════════════════════════════════════════════
         RESERVATION MODAL
    ═══════════════════════════════════════════════════════ -->
    @if($restaurantInfo && $restaurantInfo->reservation_available)
    <div class="reserve-modal" id="reserveModal" aria-hidden="true">
        <div class="reserve-modal-box">
            <div class="reserve-modal-head">
                <span class="section-eyebrow">Private Dining</span>
                <h3>Reserve Your Table</h3>
                <p>Share your details — we will confirm your booking shortly.</p>
                <button class="reserve-modal-close" aria-label="Close">&times;</button>
            </div>
            <div class="reserve-modal-body">
                <form id="reserveForm">
                    <div class="reserve-fields">
                        <div class="reserve-field">
                            <label for="reserve_name">Full Name</label>
                            <input type="text" id="reserve_name" name="name" placeholder="Your name" required>
                        </div>
                        <div class="reserve-field">
                            <label for="reserve_phone">Mobile Number</label>
                            <input type="tel" id="reserve_phone" name="phone" placeholder="+91 00000 00000" required>
                        </div>
                        <div class="reserve-field">
                            <label for="reserve_date">Preferred Date</label>
                            <input type="date" id="reserve_date" name="date" required>
                        </div>
                        <div class="reserve-field">
                            <label for="reserve_time">Preferred Time</label>
                            <input type="time" id="reserve_time" name="time" required>
                        </div>
                        <div class="reserve-field">
                            <label for="reserve_guests">Number of Guests</label>
                            <input type="number" id="reserve_guests" name="guests" min="1" value="2" required>
                        </div>
                        <div class="reserve-field">
                            <label for="reserve_notes">Special Requests</label>
                            <input type="text" id="reserve_notes" name="notes" placeholder="Anniversary, allergies…">
                        </div>
                    </div>
                    <div class="reserve-submit-row">
                        <button type="submit" class="btn-gold">
                            <i class="fas fa-paper-plane"></i> Confirm Reservation
                        </button>
                        @if($social && $social->whatsapp)
                        <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="btn-wa">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Scripts -->
    <script>
        // ── Scroll fade-up ───────────────────────────────────────
        const fadeEls = document.querySelectorAll('.fade-up');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.12 });
        fadeEls.forEach(el => observer.observe(el));

        // ── Search ───────────────────────────────────────────────
        document.getElementById('menuSearch').addEventListener('input', function() {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.menu-card').forEach(c => {
                c.style.display = c.dataset.name.includes(q) ? '' : 'none';
            });
            syncCategoryVisibility();
        });

        // ── Filter tabs ──────────────────────────────────────────
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const f = this.dataset.filter;
                document.querySelectorAll('.menu-card').forEach(c => {
                    if (f === 'all') { c.style.display = ''; }
                    else if (f === 'bestseller') { c.style.display = c.dataset.bestseller === 'yes' ? '' : 'none'; }
                    else { c.style.display = c.dataset.dietary === f ? '' : 'none'; }
                });
                syncCategoryVisibility();
            });
        });

        function syncCategoryVisibility() {
            document.querySelectorAll('.menu-category').forEach(cat => {
                const visible = [...cat.querySelectorAll('.menu-card')].some(c => c.style.display !== 'none');
                cat.style.display = visible ? '' : 'none';
            });
        }

        // ── Reservation modal ────────────────────────────────────
        const modal = document.getElementById('reserveModal');
        const triggers = document.querySelectorAll('.reserve-trigger');
        const closeBtn = document.querySelector('.reserve-modal-close');
        const form = document.getElementById('reserveForm');

        if (modal && triggers.length) {
            triggers.forEach(t => t.addEventListener('click', e => {
                e.preventDefault();
                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }));
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.classList.remove('active');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            });
        }

        if (modal) {
            modal.addEventListener('click', e => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                    modal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                }
            });
        }

        if (form) {
            form.addEventListener('submit', e => {
                e.preventDefault();
                const d = new FormData(form);
                const msg = `Reservation Request:%0AName: ${d.get('name')}%0APhone: ${d.get('phone')}%0ADate: ${d.get('date')}%0ATime: ${d.get('time')}%0AGuests: ${d.get('guests')}%0ANotes: ${d.get('notes') || '-'}`;
                const phone = "{{ $social->whatsapp ?? $userdata->mobile }}";
                if (phone) window.open(`https://wa.me/${phone}?text=${msg}`, '_blank');
            });
        }
    </script>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])
</body>
</html>