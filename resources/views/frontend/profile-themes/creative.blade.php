<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Creative' }} - Portfolio</title>

    @php
        $websetting = App\Models\websetting::first();

        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile' => 1, 'quali' => 1, 'service' => 1, 'thought' => 1,
                'personal' => 1, 'profess' => 1, 'videos' => 1, 'product' => 1,
                'social_link' => 1, 'upload_file' => 1, 'client' => 1,
                'menu_section' => 1, 'reservation_section' => 1,
                'property_listings' => 1, 'showreel' => 1, 'team_section' => 1,
                'pricing_section' => 1, 'booking_section' => 1,
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.min.css">

    <style>
        /* ============================================================
           ROOT VARIABLES
        ============================================================ */
        :root {
            --primary:        #6C3FC5;
            --primary-dark:   #4A2590;
            --primary-light:  #8B5CF6;
            --accent:         #A855F7;
            --accent-glow:    rgba(108,63,197,0.35);
            --bg-deep:        #110D1E;
            --bg-card:        #1A1530;
            --bg-card2:       #211C38;
            --white:          #FFFFFF;
            --text-muted:     #B0A8C8;
            --border:         rgba(108,63,197,0.25);
            --wave-purple:    #5B2DA0;
            --radius-card:    20px;
            --radius-btn:     50px;
            --shadow-card:    0 12px 40px rgba(0,0,0,0.45);
            --shadow-glow:    0 8px 32px rgba(108,63,197,0.4);
            --content-max:    1400px;
            --page-pad:       clamp(16px, 4vw, 60px);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-deep);
            color: var(--white);
            min-height: 100vh;
            overflow-x: hidden;
            width: 100%;
        }

        /* ============================================================
           GLOBAL CONTAINER — centres content with padding on all screens
        ============================================================ */
        .container {
            width: 100%;
            max-width: var(--content-max);
            margin-left: auto;
            margin-right: auto;
            padding-left: var(--page-pad);
            padding-right: var(--page-pad);
        }

        /* ============================================================
           PREVIEW BANNER
        ============================================================ */
        .preview-banner {
            background: linear-gradient(90deg, #7c3aed 0%, #ec4899 100%);
            color: white;
            padding: 11px 20px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
            position: sticky;
            top: 0;
            z-index: 9999;
            width: 100%;
        }
        .preview-banner a { color: #fbbf24; text-decoration: underline; font-weight: 700; margin-left: 6px; }

        /* ============================================================
           HERO BANNER — Full-width, tall on desktop
        ============================================================ */
        .hero-banner {
            position: relative;
            width: 100%;
            height: clamp(260px, 42vw, 560px);
            overflow: hidden;
        }
        .hero-banner .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://sspark.genspark.ai/cfimages?u1=O4purG5uZ%2F9lUDe%2Be7ppio4wdlhJ5MySHRkZaxBs1qWdUja%2BkpUzqPJFBpkDKKPNMLi1RKWr%2BcbgUIp8XgiChBNc3WCK0Ev2pdbhjYngjXs0PBsFX%2F6a6RPxd9YS7aSYR%2F1%2BK7UuU3G5PYN0n9RmWGxQ%2FOb90Uv%2Fd3WPPVU%2FJ4Xst84YoemBgrXzc0ybGk8mL6kv6UiYhit%2FBO9PewRLa4val7emccefOCKyFuBe0APG33Ynl9SM5QNCdJ8xTO%2BzD3DGyiZqObKDj8RBbCo4V64aZRN3upOyFcAuprJwRPoSGejf7BBqSiV8NjkEgXcNYutz0Kv829Q4h8ztIvjNKaT3jSSaeqi0%2FR8MNOd9u2ob4WDogmgCqstEa642zoQ%3D&u2=cHvHH0vu9U1dmG3j&width=2560');
            background-size: cover;
            background-position: center top;
            filter: brightness(0.55) saturate(1.3);
            transition: transform 0.6s ease;
        }
        .hero-banner.has-user-banner .hero-bg {
            background-image: var(--user-banner-url);
        }
        .hero-banner::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(17,13,30,0.10) 0%,
                rgba(17,13,30,0.15) 50%,
                rgba(17,13,30,0.70) 88%,
                var(--bg-deep) 100%
            );
            z-index: 1;
        }

        /* ============================================================
           PROFILE SECTION — overlaps hero bottom
        ============================================================ */
        .profile-section {
            position: relative;
            z-index: 10;
            padding: 0;
            margin-top: clamp(-55px, -6vw, -80px);
        }
        .profile-section .container { padding-top: 0; padding-bottom: 0; }

        .profile-card {
            background: #FFFFFF;
            border-radius: var(--radius-card);
            padding: clamp(16px, 2.5vw, 28px) clamp(18px, 3vw, 36px);
            display: flex;
            align-items: center;
            gap: clamp(12px, 2vw, 24px);
            box-shadow: 0 8px 48px rgba(0,0,0,0.40);
        }
        .profile-avatar {
            width: clamp(64px, 8vw, 100px);
            height: clamp(64px, 8vw, 100px);
            border-radius: clamp(14px, 1.5vw, 20px);
            overflow: hidden;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid var(--primary-light);
        }
        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .profile-avatar-placeholder { color: white; font-size: 2rem; }

        .profile-info { flex: 1; min-width: 0; }
        .profile-name {
            font-size: clamp(1.1rem, 2.2vw, 1.8rem);
            font-weight: 700;
            color: #1A103A;
            margin-bottom: 3px;
            line-height: 1.2;
        }
        .profile-tagline {
            font-size: clamp(0.8rem, 1.2vw, 1rem);
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 4px;
        }
        .profile-role {
            font-size: clamp(0.72rem, 0.9vw, 0.88rem);
            color: #888;
            font-weight: 400;
        }
        .profile-qr-btn {
            width: clamp(40px, 5vw, 56px);
            height: clamp(40px, 5vw, 56px);
            border-radius: clamp(10px, 1.2vw, 14px);
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: clamp(1rem, 1.4vw, 1.4rem);
            flex-shrink: 0;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: background 0.2s, transform 0.2s;
        }
        .profile-qr-btn:hover { background: var(--primary-dark); transform: scale(1.08); }

        /* ============================================================
           WAVE DIVIDERS
        ============================================================ */
        .wave-divider {
            width: 100%;
            overflow: hidden;
            line-height: 0;
            margin-top: -1px;
        }
        .wave-divider svg { display: block; width: 100%; }

        /* ============================================================
           PURPLE BODY SECTION
        ============================================================ */
        .purple-body {
            background: linear-gradient(180deg, var(--wave-purple) 0%, var(--primary-dark) 100%);
            padding-bottom: 40px;
            width: 100%;
        }

        /* ─── Desktop two-column layout inside purple body ─── */
        .purple-inner {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0;
        }
        @media (min-width: 960px) {
            .purple-inner {
                grid-template-columns: 1fr 1fr;
                align-items: start;
                gap: 0 32px;
            }
            .purple-left  { padding-top: 8px; }
            .purple-right { padding-top: 8px; }
        }
        @media (min-width: 1200px) {
            .purple-inner { grid-template-columns: 3fr 2fr; }
        }

        /* ============================================================
           HERO INFO BLOCK (inside purple)
        ============================================================ */
        .hero-info-block {
            padding: clamp(20px, 3vw, 40px) 0 10px;
        }
        .hero-name {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.7rem, 4vw, 3.2rem);
            font-weight: 700;
            color: white;
            margin-bottom: 6px;
            line-height: 1.15;
        }
        .hero-desig {
            font-size: clamp(0.85rem, 1.3vw, 1.05rem);
            color: rgba(255,255,255,0.65);
            margin-bottom: 16px;
        }

        /* ============================================================
           SKILLS / BADGES
        ============================================================ */
        .skills-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 4px 0 0;
        }
        .skill-pill {
            padding: 6px 16px;
            background: rgba(168,85,247,0.14);
            border: 1px solid rgba(168,85,247,0.35);
            border-radius: 50px;
            font-size: 0.8rem;
            color: #C084FC;
            font-weight: 500;
            transition: all 0.2s;
            cursor: default;
        }
        .skill-pill:hover { background: var(--accent); color: white; }

        /* ============================================================
           ACTION BUTTONS
        ============================================================ */
        .actions-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding: 4px 0 0;
        }
        .act-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: clamp(9px,1vw,12px) clamp(16px,2vw,24px);
            border-radius: var(--radius-btn);
            text-decoration: none;
            font-weight: 600;
            font-size: clamp(0.8rem, 1vw, 0.95rem);
            transition: all 0.25s;
        }
        .act-btn-phone { background: var(--primary); color: white; box-shadow: 0 4px 16px rgba(108,63,197,0.4); }
        .act-btn-phone:hover { background: var(--primary-dark); transform: translateY(-2px); }
        .act-btn-wa { background: #25D366; color: white; }
        .act-btn-wa:hover { filter: brightness(1.1); transform: translateY(-2px); }
        .act-btn-email { background: transparent; color: var(--white); border: 1.5px solid rgba(255,255,255,0.4); }
        .act-btn-email:hover { background: rgba(255,255,255,0.1); }

        /* ============================================================
           CTA / INTRO TEXT BLOCK
        ============================================================ */
        .cta-block {
            padding: clamp(20px,3vw,36px) 0 14px;
        }
        .cta-headline {
            font-size: clamp(1rem, 1.8vw, 1.4rem);
            font-weight: 700;
            color: var(--white);
            margin-bottom: 10px;
            line-height: 1.4;
        }
        .cta-sub {
            font-size: clamp(0.82rem, 1vw, 0.95rem);
            color: rgba(255,255,255,0.82);
            line-height: 1.75;
            margin-bottom: 20px;
            max-width: 520px;
        }
        .cta-action-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 12px 26px;
            border-radius: var(--radius-btn);
            font-size: clamp(0.85rem, 1vw, 0.92rem);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s;
            border: none;
            cursor: pointer;
        }
        .cta-btn-white { background: #FFFFFF; color: var(--primary-dark); box-shadow: 0 4px 16px rgba(0,0,0,0.2); }
        .cta-btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.3); }
        .cta-btn-outline { background: transparent; color: #FFFFFF; border: 2px solid rgba(255,255,255,0.6); }
        .cta-btn-outline:hover { background: rgba(255,255,255,0.12); }

        /* ============================================================
           SOCIAL ICONS
        ============================================================ */
        .social-row-section { padding: 8px 0 24px; }
        .social-row { display: flex; gap: 12px; flex-wrap: wrap; }
        .social-pill {
            width: clamp(44px, 4.5vw, 56px);
            height: clamp(44px, 4.5vw, 56px);
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            border: 1.5px solid rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1rem, 1.3vw, 1.3rem);
            color: white;
            text-decoration: none;
            transition: all 0.25s;
            backdrop-filter: blur(4px);
        }
        .social-pill:hover { background: white; color: var(--primary); transform: translateY(-4px); box-shadow: 0 6px 20px rgba(108,63,197,0.4); }

        /* ============================================================
           CONTACTS SECTION
        ============================================================ */
        .contacts-section { padding: 0 0 28px; }
        .section-heading {
            font-size: clamp(1rem, 1.6vw, 1.35rem);
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
        }
        .contact-cards-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        @media (min-width: 640px) {
            .contact-cards-grid { grid-template-columns: repeat(4, 1fr); }
        }
        @media (min-width: 960px) {
            .contact-cards-grid { grid-template-columns: 1fr 1fr; }
        }
        .contact-card-item {
            background: rgba(20,15,42,0.75);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 14px;
            padding: 13px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: white;
            transition: all 0.25s;
            overflow: hidden;
        }
        .contact-card-item:hover { background: rgba(108,63,197,0.3); border-color: var(--primary-light); transform: translateY(-2px); }
        .contact-card-icon {
            width: clamp(32px, 3vw, 42px);
            height: clamp(32px, 3vw, 42px);
            border-radius: 9px;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(0.85rem, 1vw, 1rem);
            color: white;
            flex-shrink: 0;
        }
        .contact-card-label { font-size: 0.68rem; color: rgba(255,255,255,0.55); margin-bottom: 1px; }
        .contact-card-value { font-size: 0.58rem; font-weight: 600; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        /* ============================================================
           DARK SECTION
        ============================================================ */
        .dark-section {
            background: var(--bg-deep);
            padding-bottom: 40px;
            width: 100%;
        }

        .wave-to-dark svg { fill: var(--bg-deep); }
        .wave-to-purple svg { fill: var(--wave-purple); }

        /* ============================================================
           SECTION HEADINGS
        ============================================================ */
        .section-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: clamp(20px, 3vw, 36px) 0 clamp(14px, 2vw, 20px);
        }
        .section-title-text {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            font-weight: 700;
            color: var(--white);
        }
        .section-title-accent {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            font-weight: 700;
            background: linear-gradient(135deg, #A855F7, #6C3FC5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .section-logo-icon { width: 40px; height: 40px; }

        /* ============================================================
           SWIPER BANNER / SHOWREEL CAROUSEL
        ============================================================ */
        .swiper-wrap {
            padding: 8px 0 0;
        }
        .swiper-banner {
            width: 100%;
            padding-bottom: 32px !important;
            border-radius: 18px;
            overflow: hidden;
        }
        .swiper-banner .swiper-slide {
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 16/9;
            background: var(--bg-card);
        }
        @media (min-width: 960px) {
            .swiper-banner .swiper-slide { aspect-ratio: 21/9; }
        }
        .swiper-banner .swiper-slide img { width: 100%; height: 100%; object-fit: cover; }
        .swiper-banner .swiper-pagination-bullet { background: rgba(255,255,255,0.4); opacity: 1; width: 7px; height: 7px; }
        .swiper-banner .swiper-pagination-bullet-active { background: var(--primary-light); width: 20px; border-radius: 4px; }

        /* ============================================================
           SERVICES GRID
        ============================================================ */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: clamp(10px, 1.5vw, 18px);
        }
        @media (min-width: 640px) { .services-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (min-width: 960px) { .services-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (min-width: 1200px) { .services-grid { grid-template-columns: repeat(4, 1fr); } }

        .service-card {
            background: var(--bg-card);
            border-radius: var(--radius-card);
            overflow: hidden;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }
        .service-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-glow); border-color: var(--primary-light); }
        .service-card.full-width { grid-column: 1 / -1; }
        .service-card-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; }
        .service-card-body { padding: clamp(12px, 1.5vw, 18px); }
        .service-card-name { font-size: clamp(0.82rem, 1.1vw, 1rem); font-weight: 700; color: var(--white); margin-bottom: 5px; line-height: 1.3; }
        .service-card-desc { font-size: clamp(0.7rem, 0.85vw, 0.82rem); color: var(--text-muted); line-height: 1.55; }

        /* ============================================================
           PORTFOLIO GRID
        ============================================================ */
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: clamp(8px, 1.2vw, 14px);
        }
        @media (min-width: 640px) { .portfolio-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (min-width: 960px) { .portfolio-grid { grid-template-columns: repeat(4, 1fr); } }

        .portfolio-item {
            border-radius: 14px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            aspect-ratio: 1;
            background: var(--bg-card2);
        }
        .portfolio-item:first-child {
            grid-column: 1 / -1;
            aspect-ratio: 21/9;
        }
        @media (max-width: 639px) {
            .portfolio-item:first-child { aspect-ratio: 16/9; }
        }
        .portfolio-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
        .portfolio-item:hover img { transform: scale(1.07); }
        .portfolio-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(0deg, rgba(17,13,30,0.9) 0%, transparent 60%);
            display: flex; align-items: flex-end;
            padding: 12px; opacity: 0; transition: opacity 0.3s;
        }
        .portfolio-item:hover .portfolio-overlay { opacity: 1; }
        .portfolio-overlay-title { font-size: 0.85rem; font-weight: 600; color: white; }

        /* ============================================================
           VIDEO CARDS (showreel list)
        ============================================================ */
        .video-cards-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: clamp(10px, 1.5vw, 16px);
        }
        @media (min-width: 640px) { .video-cards-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 960px) { .video-cards-grid { grid-template-columns: repeat(3, 1fr); } }

        .video-card {
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 16/9;
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            transition: all 0.3s;
            text-decoration: none;
            display: block;
        }
        .video-card:hover { border-color: var(--primary-light); transform: scale(1.02); }
        .video-card img { width: 100%; height: 100%; object-fit: cover; }
        .video-card-overlay {
            position: absolute; inset: 0;
            display: flex; align-items: center; justify-content: center;
            background: rgba(17,13,30,0.3);
        }
        .play-btn {
            width: clamp(48px, 5vw, 64px);
            height: clamp(48px, 5vw, 64px);
            border-radius: 50%;
            background: rgba(108,63,197,0.9);
            display: flex; align-items: center; justify-content: center;
            border: 3px solid rgba(255,255,255,0.7);
            transition: all 0.3s;
        }
        .video-card:hover .play-btn { background: var(--primary); transform: scale(1.12); }
        .play-btn i { color: white; font-size: clamp(0.9rem, 1.2vw, 1.2rem); margin-left: 3px; }
        .video-card-title {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 12px 14px;
            background: linear-gradient(0deg, rgba(17,13,30,0.92), transparent);
            font-size: clamp(0.78rem, 1vw, 0.92rem); font-weight: 600; color: white;
        }

        /* ============================================================
           GALLERY GRID
        ============================================================ */
        .photo-gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: clamp(7px, 1vw, 12px);
        }
        @media (min-width: 640px) { .photo-gallery-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (min-width: 960px) { .photo-gallery-grid { grid-template-columns: repeat(5, 1fr); } }
        @media (min-width: 1200px) { .photo-gallery-grid { grid-template-columns: repeat(6, 1fr); } }

        .gallery-item {
            border-radius: 12px; overflow: hidden; aspect-ratio: 1;
            background: var(--bg-card2); cursor: pointer;
            transition: all 0.3s; border: 1px solid var(--border);
        }
        .gallery-item:hover { transform: scale(1.05); border-color: var(--primary-light); }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; }

        /* ============================================================
           ABOUT / THOUGHTS CARDS
        ============================================================ */
        .about-cards-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: clamp(12px, 1.5vw, 18px);
        }
        @media (min-width: 640px) { .about-cards-grid { grid-template-columns: repeat(2, 1fr); } }

        .about-card {
            background: var(--bg-card);
            border-radius: var(--radius-card);
            padding: clamp(18px, 2.5vw, 28px) clamp(18px, 2.5vw, 28px);
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }
        .about-card::before {
            content: '"';
            position: absolute; top: -10px; left: 14px;
            font-size: 8rem; font-family: 'Playfair Display', serif;
            color: var(--primary); opacity: 0.18; line-height: 1;
        }
        .about-text {
            font-size: clamp(0.85rem, 1.1vw, 0.95rem);
            color: var(--text-muted);
            line-height: 1.8; font-style: italic; position: relative; z-index: 2;
        }
        .about-sub {
            font-style: normal; color: rgba(255,255,255,0.7);
            margin-top: 10px; font-size: clamp(0.8rem, 0.95vw, 0.88rem);
        }

        /* ============================================================
           BOTTOM CTA CARD
        ============================================================ */
      .bottom-cta {
    background: 
        linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
        url("https://images.unsplash.com/photo-1511379938547-c1f69419868d") center/cover no-repeat;

    border-radius: clamp(16px, 2vw, 24px);
    padding: clamp(24px, 3.5vw, 48px) clamp(20px, 4vw, 56px);
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-top: clamp(20px, 3vw, 36px);
}

.bottom-cta::before {
    content: '';
    position: absolute;
    top: -60px;
    right: -60px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,0.06);
}

.bottom-cta::after {
    content: '';
    position: absolute;
    bottom: -50px;
    left: -50px;
    width: 160px;
    height: 160px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}
        .bottom-cta-emoji { font-size: clamp(2rem, 3.5vw, 3rem); margin-bottom: 12px; }
        .bottom-cta-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.2rem, 2.5vw, 1.9rem);
            font-weight: 700; color: white; margin-bottom: 10px; position: relative; z-index: 2;
        }
        .bottom-cta-sub {
            font-size: clamp(0.8rem, 1.1vw, 0.95rem);
            color: rgba(255,255,255,0.82); margin-bottom: 22px;
            line-height: 1.65; position: relative; z-index: 2;
            max-width: 480px; margin-left: auto; margin-right: auto;
        }
        .bottom-cta-btns {
            display: flex; gap: 12px; justify-content: center;
            flex-wrap: wrap; position: relative; z-index: 2;
        }
        .cta-big-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: clamp(11px,1.2vw,15px) clamp(22px,2.5vw,34px);
            border-radius: 50px; text-decoration: none; font-weight: 700;
            font-size: clamp(0.83rem, 1vw, 0.95rem);
            transition: all 0.25s; border: none; cursor: pointer;
        }
        .cta-big-btn-white { background: white; color: #4A2590; box-shadow: 0 4px 20px rgba(0,0,0,0.2); }
        .cta-big-btn-white:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,0.28); }
        .cta-big-btn-wa { background: #25D366; color: white; }
        .cta-big-btn-wa:hover { filter: brightness(1.1); transform: translateY(-3px); }

        /* ============================================================
           MUSIC / TREBLE LOGO SVG
        ============================================================ */
        .music-logo-svg { opacity: 0.9; }

        /* ============================================================
           FOOTER
        ============================================================ */
        .site-footer {
            background: var(--bg-deep);
            text-align: center;
            padding: clamp(20px, 3vw, 32px) var(--page-pad) clamp(28px, 4vw, 44px);
            color: rgba(255,255,255,0.4);
            font-size: 0.82rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .site-footer a { color: var(--primary-light); text-decoration: none; font-weight: 600; }

        /* ============================================================
           SCROLL REVEAL ANIMATION
        ============================================================ */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ============================================================
           STATS BAR (desktop only — shown inside purple section)
        ============================================================ */
        .stats-bar {
            display: none;
        }
        @media (min-width: 960px) {
            .stats-bar {
                display: flex;
                gap: clamp(16px, 2.5vw, 36px);
                background: rgba(255,255,255,0.08);
                border: 1px solid rgba(255,255,255,0.14);
                border-radius: 16px;
                padding: 18px 28px;
                margin-top: 24px;
                backdrop-filter: blur(6px);
                flex-wrap: wrap;
            }
            .stat-item { text-align: center; flex: 1; min-width: 80px; }
            .stat-num { font-size: clamp(1.4rem, 2.2vw, 2rem); font-weight: 800; color: white; line-height: 1; margin-bottom: 4px; }
            .stat-label { font-size: 0.75rem; color: rgba(255,255,255,0.6); font-weight: 500; }
        }
    </style>
</head>
<body>

    <!-- ───────── TOP ACTIONS ───────── -->
    @include('frontend.profile-themes.partials.profile-top-actions')

    <!-- ───────── PREVIEW BANNER ───────── -->
    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> This is a preview.
        <a href="{{ url('/signin') }}">Sign up</a> to create your own professional profile!
    </div>
    @endif

    <!-- ═══════════════════════════════════════════════════
         HERO BANNER
    ═══════════════════════════════════════════════════ -->
    <div class="hero-banner @if($userdata->banner) has-user-banner @endif"
        @if($userdata->banner)
            style="--user-banner-url: url('{{ url('public/frontend/user_images', $userdata->banner) }}');"
        @endif>
        <div class="hero-bg"></div>
    </div>

    <!-- ═══════════════════════════════════════════════════
         PROFILE CARD
    ═══════════════════════════════════════════════════ -->
    <div class="profile-section">
        <div class="container">
            <div class="profile-card reveal">
                @if($userdata->isFeatureVisible('profile_photo'))
                <div class="profile-avatar">
                    @if($userdata->profile)
                        <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
                    @else
                        <div class="profile-avatar-placeholder"><i class="fas fa-music"></i></div>
                    @endif
                </div>
                @endif

                <div class="profile-info">
                    @if($userdata->isFeatureVisible('name'))
                    <div class="profile-name">{{ $userdata->name }}</div>
                    @endif
                    @if($userdata->isFeatureVisible('designation'))
                    <div class="profile-tagline">{{ $userdata->desig ?? 'Creative Professional' }}</div>
                    @endif
                    <div class="profile-role">
                        @if($professions->count() > 0)
                            {{ $professions->pluck('profession')->filter()->implode(' · ') }}
                        @elseif($userdata->city)
                            <i class="fas fa-map-marker-alt" style="margin-right:4px;"></i>{{ $userdata->city }}
                        @else
                            Musician
                        @endif
                    </div>
                </div>

                @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="profile-qr-btn" title="Call Now">
                    <i class="fas fa-phone"></i>
                </a>
                @else
                <div class="profile-qr-btn" title="Profile">
                    <i class="fas fa-qrcode"></i>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Wave: bg-deep → purple -->
    <div class="wave-divider wave-to-purple" style="background: var(--bg-deep);">
        <svg viewBox="0 0 1200 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" height="52">
            <path d="M0,30 C300,70 900,-10 1200,30 L1200,60 L0,60 Z" fill="#5B2DA0"/>
        </svg>
    </div>

    <!-- ═══════════════════════════════════════════════════
         PURPLE BODY
    ═══════════════════════════════════════════════════ -->
    <div class="purple-body">
        <div class="container">
            <div class="purple-inner">

                <!-- ── LEFT COLUMN ── -->
                <div class="purple-left">

                    <!-- Hero name + actions -->
                    @if($userdata->isFeatureVisible('name') || $userdata->isFeatureVisible('designation'))
                    <div class="hero-info-block reveal">
                        @if($userdata->isFeatureVisible('name'))
                        <div class="hero-name">{{ $userdata->name }}</div>
                        @endif
                        @if($userdata->isFeatureVisible('designation'))
                        <div class="hero-desig">{{ $userdata->desig ?? '' }}</div>
                        @endif

                        @if($professions->count() > 0)
                        <div class="skills-row" style="margin-bottom:16px;">
                            @foreach($professions->take(6) as $profession)
                                @php $pl = $profession->profession ?? $profession->title ?? ''; @endphp
                                @if($pl)
                                <span class="skill-pill">{{ $pl }}</span>
                                @endif
                            @endforeach
                        </div>
                        @endif

                        <div class="actions-row">
                            @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                            <a href="tel:{{ $userdata->mobile }}" class="act-btn act-btn-phone">
                                <i class="fas fa-phone"></i> Call Now
                            </a>
                            @endif
                            @if($userdata->isFeatureVisible('whatsapp_chat') && $social && $social->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$social->whatsapp) }}" target="_blank" class="act-btn act-btn-wa">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            @endif
                            @if($userdata->isFeatureVisible('email') && $userdata->email)
                            <a href="mailto:{{ $userdata->email }}" class="act-btn act-btn-email">
                                <i class="fas fa-envelope"></i> Email
                            </a>
                            @endif
                        </div>

                        <!-- Stats bar (desktop) -->
                        <div class="stats-bar">
                            @if($professions->count() > 0)
                            <div class="stat-item">
                                <div class="stat-num">{{ $professions->count() }}+</div>
                                <div class="stat-label">Services</div>
                            </div>
                            @endif
                            @if($portfolios->count() > 0)
                            <div class="stat-item">
                                <div class="stat-num">{{ $portfolios->count() }}+</div>
                                <div class="stat-label">Projects</div>
                            </div>
                            @endif
                            @if($videos->count() > 0)
                            <div class="stat-item">
                                <div class="stat-num">{{ $videos->count() }}+</div>
                                <div class="stat-label">Videos</div>
                            </div>
                            @endif
                            <div class="stat-item">
                                <div class="stat-num">★ 5.0</div>
                                <div class="stat-label">Rating</div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- CTA Block -->
                    @if($userdata->isFeatureVisible('thoughts') && $thoughts->count() > 0)
                    @php $firstThought = $thoughts->first(); @endphp
                    <div class="cta-block reveal">
                        <div class="cta-headline">
                            🎵 {{ $firstThought->thought ?? $firstThought->title ?? ('Experience ' . ($userdata->name ?? 'the Artist') . ' Live!') }} 🎤
                        </div>
                        @if($firstThought->description ?? $firstThought->desc ?? false)
                        <p class="cta-sub">{{ $firstThought->description ?? $firstThought->desc }}</p>
                        @endif
                        <div class="cta-action-row">
                            @if($userdata->mobile)
                            <a href="tel:{{ $userdata->mobile }}" class="cta-btn cta-btn-white">
                                <i class="fas fa-phone"></i> Book Now
                            </a>
                            @endif
                            @if($social && $social->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$social->whatsapp) }}" target="_blank" class="cta-btn cta-btn-outline">
                                <i class="fab fa-whatsapp"></i> Chat
                            </a>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="cta-block reveal">
                        <div class="cta-headline"> Experience the Magic of {{ $userdata->name ?? 'the Artist' }} Live! </div>
                        <p class="cta-sub">Join us for an unforgettable experience as the maestro takes the stage, weaving magic with soulful performances and timeless hits. Mark your calendar and be part of the enchantment! 🌟</p>
                        <div class="cta-action-row">
                            @if($userdata->mobile)
                            <a href="tel:{{ $userdata->mobile }}" class="cta-btn cta-btn-white">
                                <i class="fas fa-phone"></i> Book Now
                            </a>
                            @endif
                            @if($social && $social->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$social->whatsapp) }}" target="_blank" class="cta-btn cta-btn-outline">
                                <i class="fab fa-whatsapp"></i> Chat
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Social Icons -->
                    @if($userdata->isFeatureVisible('social_media') && $social)
                    <div class="social-row-section reveal">
                        <div class="social-row">
                            @if($userdata->isFeatureVisible('facebook') && $social->facebook)
                            <a href="{{ $social->facebook }}" class="social-pill" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if($social->twitter)
                            <a href="{{ $social->twitter }}" class="social-pill" target="_blank" title="Twitter/X"><i class="fab fa-x-twitter"></i></a>
                            @endif
                            @if($userdata->isFeatureVisible('instagram') && $social->instagram)
                            <a href="{{ $social->instagram }}" class="social-pill" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($userdata->isFeatureVisible('linkedin') && $social->linkedin)
                            <a href="{{ $social->linkedin }}" class="social-pill" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                            @if($social->youtube)
                            <a href="{{ $social->youtube }}" class="social-pill" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                            @endif
                            @if($social->whatsapp ?? false)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$social->whatsapp) }}" class="social-pill" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            @endif
                            @if($social->behance ?? false)
                            <a href="{{ $social->behance }}" class="social-pill" target="_blank" title="Behance"><i class="fab fa-behance"></i></a>
                            @endif
                            @if($social->dribbble ?? false)
                            <a href="{{ $social->dribbble }}" class="social-pill" target="_blank" title="Dribbble"><i class="fab fa-dribbble"></i></a>
                            @endif
                        </div>
                    </div>
                    @endif

                </div><!-- /.purple-left -->

                <!-- ── RIGHT COLUMN ── -->
                <div class="purple-right">
                    <!-- Contacts -->
                    <div class="contacts-section reveal" style="padding-top: clamp(20px,3vw,40px);">
                        <div class="section-heading">Contacts</div>
                        <div class="contact-cards-grid">
                            @if($userdata->isFeatureVisible('contact_number') && $userdata->mobile)
                            <a href="tel:{{ $userdata->mobile }}" class="contact-card-item">
                                <div class="contact-card-icon"><i class="fas fa-phone"></i></div>
                                <div class="contact-card-text">
                                    <div class="contact-card-label">Phone</div>
                                    <div class="contact-card-value">{{ $userdata->mobile }}</div>
                                </div>
                            </a>
                            @endif
                            @if($userdata->isFeatureVisible('email') && $userdata->email)
                            <a href="mailto:{{ $userdata->email }}" class="contact-card-item">
                                <div class="contact-card-icon"><i class="fas fa-envelope"></i></div>
                                <div class="contact-card-text">
                                    <div class="contact-card-label">Email</div>
                                    <div class="contact-card-value">{{ $userdata->email }}</div>
                                </div>
                            </a>
                            @endif
                            @if($userdata->isFeatureVisible('address') && ($userdata->city || $userdata->state))
                            <div class="contact-card-item">
                                <div class="contact-card-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="contact-card-text">
                                    <div class="contact-card-label">Location</div>
                                    <div class="contact-card-value">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                                </div>
                            </div>
                            @endif
                            @if($social && $social->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$social->whatsapp) }}" target="_blank" class="contact-card-item">
                                <div class="contact-card-icon" style="background:#25D366;"><i class="fab fa-whatsapp"></i></div>
                                <div class="contact-card-text">
                                    <div class="contact-card-label">WhatsApp</div>
                                    <div class="contact-card-value">Chat Now</div>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                </div><!-- /.purple-right -->

            </div><!-- /.purple-inner -->
        </div><!-- /.container -->
    </div><!-- /.purple-body -->

    <!-- Wave: purple → dark -->
    <div class="wave-divider wave-to-dark" style="background: var(--wave-purple);">
        <svg viewBox="0 0 1200 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" height="52">
            <path d="M0,20 C400,60 800,0 1200,30 L1200,60 L0,60 Z" fill="#110D1E"/>
        </svg>
    </div>

    <!-- ═══════════════════════════════════════════════════
         DARK SECTION
    ═══════════════════════════════════════════════════ -->
    <div class="dark-section">
        <div class="container">

            <!-- ── Image/Video Carousel ── -->
            @if($userdata->isFeatureVisible('video_gallery') && $videos->count() > 0)
            <div class="swiper-wrap reveal">
                <div class="swiper swiper-banner">
                    <div class="swiper-wrapper">
                        @foreach($videos->take(5) as $video)
                        @php
                            $videoUrl = $video->video_link ?? $video->link ?? $video->name ?? '';
                            $videoUrl = trim((string) $videoUrl);
                            $thumbUrl = '';
                            if ((str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be'))
                                && preg_match('~(youtu\.be/|v=)([^&?/]{11})~', $videoUrl, $m)) {
                                $thumbUrl = 'https://img.youtube.com/vi/' . ($m[2] ?? '') . '/hqdefault.jpg';
                            }
                        @endphp
                        <div class="swiper-slide">
                            <a href="{{ $videoUrl }}" target="_blank" rel="noopener" style="display:block;width:100%;height:100%;position:relative;">
                                @if($thumbUrl)
                                    <img src="{{ $thumbUrl }}" alt="Video" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <div style="width:100%;height:100%;background:linear-gradient(135deg,#1A1530,#2D2060);"></div>
                                @endif
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                    <div class="play-btn"><i class="fas fa-play"></i></div>
                                </div>
                                @if($video->title)
                                <div class="video-card-title">{{ $video->title }}</div>
                                @endif
                            </a>
                        </div>
                        @endforeach
                        @if($videos->count() < 2)
                        <div class="swiper-slide">
                            <img src="https://sspark.genspark.ai/cfimages?u1=WC%2FMf1Z27GCHQgmXPyTG0y26pLVkejRSiMq9IQq5vDewGDucW46RNkaM5h5zoiVaB9oaBpdZACpsCHS3%2FlLEcYwJlYppldQllz3mt%2FheMWviDAwOaBZObHebbHxpYH3c591DobFg3Sf4V9KyLiw0X699aJ%2F06y0hrzNXh%2Fve2K5cancKVkkNa7WCw52J%2BqGJ0JrGRz3xCPKLmHPN4efbc7jvnDSMm6MXTiiSqnifWLBipTRSwwGRIkEC%2FeKPyX9RxwVlPRKrROiPAu5mNZ7Euf9a9Y7ookkPZq4qXexFfjt%2Bk7JsPgcHYAx50KClyQusUX8xh%2FWxopPHC6eMAoXwoI9J3baot7OuvK%2FwbBgEzoNEcGJ%2FVibS3i5NB3X28CoyaDFojEkkixt1yqa29AxkLE4SSS9u%2B8%2FZt1thV09sZWsU&u2=Rr82pDFnQALQH%2BEu&width=2560" alt="Concert" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://sspark.genspark.ai/cfimages?u1=J1ycmYmjr5N%2B%2BNlFBf2fbqmabedA%2FW%2B93x0fgTS%2Bkbtw6CP4tPr6zH8576fzxuRQURMXyAvWxjzxmX5RySW5icvwXPCKensoQ%2BpbLxjVAstisNNMQ56tVe6Bd58eJLj6JjOxUeAnHBY%3D&u2=y8opgFayfYttTzdM&width=2560" alt="Concert" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            @else
            <div class="swiper-wrap reveal">
                <div class="swiper swiper-banner">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://sspark.genspark.ai/cfimages?u1=O4purG5uZ%2F9lUDe%2Be7ppio4wdlhJ5MySHRkZaxBs1qWdUja%2BkpUzqPJFBpkDKKPNMLi1RKWr%2BcbgUIp8XgiChBNc3WCK0Ev2pdbhjYngjXs0PBsFX%2F6a6RPxd9YS7aSYR%2F1%2BK7UuU3G5PYN0n9RmWGxQ%2FOb90Uv%2Fd3WPPVU%2FJ4Xst84YoemBgrXzc0ybGk8mL6kv6UiYhit%2FBO9PewRLa4val7emccefOCKyFuBe0APG33Ynl9SM5QNCdJ8xTO%2BzD3DGyiZqObKDj8RBbCo4V64aZRN3upOyFcAuprJwRPoSGejf7BBqSiV8NjkEgXcNYutz0Kv829Q4h8ztIvjNKaT3jSSaeqi0%2FR8MNOd9u2ob4WDogmgCqstEa642zoQ%3D&u2=cHvHH0vu9U1dmG3j&width=2560" alt="Concert" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://sspark.genspark.ai/cfimages?u1=WC%2FMf1Z27GCHQgmXPyTG0y26pLVkejRSiMq9IQq5vDewGDucW46RNkaM5h5zoiVaB9oaBpdZACpsCHS3%2FlLEcYwJlYppldQllz3mt%2FheMWviDAwOaBZObHebbHxpYH3c591DobFg3Sf4V9KyLiw0X699aJ%2F06y0hrzNXh%2Fve2K5cancKVkkNa7WCw52J%2BqGJ0JrGRz3xCPKLmHPN4efbc7jvnDSMm6MXTiiSqnifWLBipTRSwwGRIkEC%2FeKPyX9RxwVlPRKrROiPAu5mNZ7Euf9a9Y7ookkPZq4qXexFfjt%2Bk7JsPgcHYAx50KClyQusUX8xh%2FWxopPHC6eMAoXwoI9J3baot7OuvK%2FwbBgEzoNEcGJ%2FVibS3i5NB3X28CoyaDFojEkkixt1yqa29AxkLE4SSS9u%2B8%2FZt1thV09sZWsU&u2=Rr82pDFnQALQH%2BEu&width=2560" alt="Concert" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://sspark.genspark.ai/cfimages?u1=J1ycmYmjr5N%2B%2BNlFBf2fbqmabedA%2FW%2B93x0fgTS%2Bkbtw6CP4tPr6zH8576fzxuRQURMXyAvWxjzxmX5RySW5icvwXPCKensoQ%2BpbLxjVAstisNNMQ56tVe6Bd58eJLj6JjOxUeAnHBY%3D&u2=y8opgFayfYttTzdM&width=2560" alt="Concert" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://sspark.genspark.ai/cfimages?u1=TjRn83lRQOuTqtnQ5xODZeGcp2w13C3iwMFhgIMRtoml9X5AgdUZAyjxuK4rlt4WjF%2BW4RKO7FKp3k1SkGHY36qg0RozJQtvbsWrzPVcxc6izP7fPqW4W5YbdA%2F7x4VtaZCjVuzSQvblNTZANyDT6mHRRG4%3D&u2=MYi4161t1Ms5WhDA&width=2560" alt="Concert" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            @endif

            <!-- ── Services ── -->
            @if($userdata->isFeatureVisible('services') && $professions->count() > 0)
            <div class="section-title-row reveal">
                <span class="section-title-accent">Our Services</span>
                <svg class="section-logo-icon music-logo-svg" viewBox="0 0 40 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 3 C20 3 30 10 30 20 C30 28 24 34 18 36 L18 44 C18 46 20 48 22 48 C26 48 30 44 30 40" stroke="#A855F7" stroke-width="3" stroke-linecap="round" fill="none"/>
                    <path d="M18 36 C14 34 10 30 10 24 C10 18 14 13 18 12" stroke="#A855F7" stroke-width="3" stroke-linecap="round" fill="none"/>
                    <circle cx="22" cy="48" r="3" fill="#A855F7"/>
                    <line x1="18" y1="3" x2="18" y2="44" stroke="#6C3FC5" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
            </div>
            @php
                $serviceImages = [
                    'https://sspark.genspark.ai/cfimages?u1=Ns2EIUu5r3kdcKCuMj3l1%2B0weRekHGW1Tahjh90w5IwfN2Gimi3ecCKnRz8j37dlQbTbJsXuOg73SxaVCa99z50rADp5fSuT%2Fzun0B9ETQ9ASL1l70XsfNLdFDlJwyfQorUNCxkZP%2FGfCKPNmoFCyF9nDJ7K0A%3D%3D&u2=x0lSJ7F4AbppAZSs&width=2560',
                    'https://sspark.genspark.ai/cfimages?u1=TjRn83lRQOuTqtnQ5xODZeGcp2w13C3iwMFhgIMRtoml9X5AgdUZAyjxuK4rlt4WjF%2BW4RKO7FKp3k1SkGHY36qg0RozJQtvbsWrzPVcxc6izP7fPqW4W5YbdA%2F7x4VtaZCjVuzSQvblNTZANyDT6mHRRG4%3D&u2=MYi4161t1Ms5WhDA&width=2560',
                    'https://sspark.genspark.ai/cfimages?u1=iAWFcES9bLf88Yn4DaUoaoXKJf%2BqQE%2FJTsAa8cr7Pi2cUbrs5yCffr3NntP5wH%2FuQeQUFFlUH0A1Q3Y%2F%2FizpjK4aXMLnF9YpaUeUVetj9I34ShfCFRDkZNR1cjU7RWbHcovWP%2BaitgzP&u2=n79BrOPkUzRgW8tj&width=2560',
                    'https://sspark.genspark.ai/cfimages?u1=rRcbhGvO5lKdpf%2BpRrg0gUeg1Yxq%2FokS7ACkzOSy%2BY6O7c3o9CS6aZTMyQXKUia8JrMqjUckl1nqPaUpyduZNCYoNLW7lyUAXgMvEZ0Gt32D4G8duwZKhyj7ARctRo1JV6nAHNYoMGU%2FUGUZug2Qujv%2Fii0Xbzwlah3DkQ9d9t%2FF5TPqYLkDKvUM%2FGS%2BwpAbMv6nUOUEUqk2&u2=b1N%2F8Wq1W8kOOVky&width=2560',
                    'https://sspark.genspark.ai/cfimages?u1=3vGeL%2BqZE%2BoaNQKfRObpDULdMzDRVRSvm2AYaBM4Kq0aIhsrXelVgvcrq2snHs%2BPn0EkNwsyeTTtu02YRh%2F1dUuzoSc4aMRrkjOAnEJPHdzDd9liV7vQTAjdqKepwumRpr3Iy4MQMnlnKJ1y338HqgX4FNbr&u2=ckJBWpdY7Cm%2F0Kml&width=2560',
                    'https://sspark.genspark.ai/cfimages?u1=ivLX2BIzqtSCxCsZ5hPDDsoAZzKidhCmUni4mqwdTYJMWe3zu46hAxk%2Fk%2FB5bulUMpQv6aO6F9ScK671pNOuBpK5peLhBRwy%2F1x13D3skqND4kUnKp22ibS302%2FWyagcf7VOvc3xbcE8rv6MFRoL&u2=PaZGwbF9HrmQHmV1&width=2560',
                ];
                $svcIdx = 0;
            @endphp
            <div class="services-grid reveal">
                @foreach($professions as $profession)
                @php
                    $pLabel = $profession->profession ?? $profession->title ?? '';
                    $pDesc  = $profession->description ?? $profession->desc ?? '';
                    $imgSrc = $serviceImages[$svcIdx % count($serviceImages)];
                    $svcIdx++;
                @endphp
                <div class="service-card">
                    <img src="{{ $imgSrc }}" alt="{{ $pLabel }}" class="service-card-img">
                    <div class="service-card-body">
                        <div class="service-card-name">{{ $pLabel }}</div>
                        @if($pDesc)
                        <div class="service-card-desc">{{ $pDesc }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Default Services -->
            <div class="section-title-row reveal">
                <span class="section-title-accent">Our Services</span>
                <svg class="section-logo-icon music-logo-svg" viewBox="0 0 40 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 3 C20 3 30 10 30 20 C30 28 24 34 18 36 L18 44 C18 46 20 48 22 48 C26 48 30 44 30 40" stroke="#A855F7" stroke-width="3" stroke-linecap="round" fill="none"/>
                    <path d="M18 36 C14 34 10 30 10 24 C10 18 14 13 18 12" stroke="#A855F7" stroke-width="3" stroke-linecap="round" fill="none"/>
                    <circle cx="22" cy="48" r="3" fill="#A855F7"/>
                    <line x1="18" y1="3" x2="18" y2="44" stroke="#6C3FC5" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="services-grid reveal">
                <div class="service-card">
                    <img src="https://sspark.genspark.ai/cfimages?u1=Ns2EIUu5r3kdcKCuMj3l1%2B0weRekHGW1Tahjh90w5IwfN2Gimi3ecCKnRz8j37dlQbTbJsXuOg73SxaVCa99z50rADp5fSuT%2Fzun0B9ETQ9ASL1l70XsfNLdFDlJwyfQorUNCxkZP%2FGfCKPNmoFCyF9nDJ7K0A%3D%3D&u2=x0lSJ7F4AbppAZSs&width=2560" alt="Music Production" class="service-card-img">
                    <div class="service-card-body">
                        <div class="service-card-name">Music Production</div>
                        <div class="service-card-desc">Transforming ideas into soundscapes, one beat at a time.</div>
                    </div>
                </div>
                <div class="service-card">
                    <img src="https://sspark.genspark.ai/cfimages?u1=TjRn83lRQOuTqtnQ5xODZeGcp2w13C3iwMFhgIMRtoml9X5AgdUZAyjxuK4rlt4WjF%2BW4RKO7FKp3k1SkGHY36qg0RozJQtvbsWrzPVcxc6izP7fPqW4W5YbdA%2F7x4VtaZCjVuzSQvblNTZANyDT6mHRRG4%3D&u2=MYi4161t1Ms5WhDA&width=2560" alt="Performance & Booking" class="service-card-img">
                    <div class="service-card-body">
                        <div class="service-card-name">Performance & Booking</div>
                        <div class="service-card-desc">Bringing unforgettable live experiences to your stage.</div>
                    </div>
                </div>
                <div class="service-card">
                    <img src="https://sspark.genspark.ai/cfimages?u1=iAWFcES9bLf88Yn4DaUoaoXKJf%2BqQE%2FJTsAa8cr7Pi2cUbrs5yCffr3NntP5wH%2FuQeQUFFlUH0A1Q3Y%2F%2FizpjK4aXMLnF9YpaUeUVetj9I34ShfCFRDkZNR1cjU7RWbHcovWP%2BaitgzP&u2=n79BrOPkUzRgW8tj&width=2560" alt="Music Distribution" class="service-card-img">
                    <div class="service-card-body">
                        <div class="service-card-name">Music Distribution</div>
                        <div class="service-card-desc">Get your music heard worldwide, effortlessly.</div>
                    </div>
                </div>
                <div class="service-card">
                    <img src="https://sspark.genspark.ai/cfimages?u1=rRcbhGvO5lKdpf%2BpRrg0gUeg1Yxq%2FokS7ACkzOSy%2BY6O7c3o9CS6aZTMyQXKUia8JrMqjUckl1nqPaUpyduZNCYoNLW7lyUAXgMvEZ0Gt32D4G8duwZKhyj7ARctRo1JV6nAHNYoMGU%2FUGUZug2Qujv%2Fii0Xbzwlah3DkQ9d9t%2FF5TPqYLkDKvUM%2FGS%2BwpAbMv6nUOUEUqk2&u2=b1N%2F8Wq1W8kOOVky&width=2560" alt="Technical Support" class="service-card-img">
                    <div class="service-card-body">
                        <div class="service-card-name">Technical Support</div>
                        <div class="service-card-desc">Expert help whenever you need it, solving problems fast.</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- ── Portfolio ── -->
            @if($userdata->isFeatureVisible('portfolio') && $portfolios->count() > 0)
            <div class="section-title-row reveal" style="margin-top:10px;">
                <span class="section-title-text">Portfolio</span>
            </div>
            <div class="portfolio-grid reveal">
                @foreach($portfolios->take(9) as $portfolio)
                @php $images = json_decode($portfolio->image, true); @endphp
                @if($images && count($images) > 0)
                <div class="portfolio-item">
                    <img src="{{ url('public/frontend/portfolio/' . $images[0]) }}" alt="{{ $portfolio->title ?? 'Portfolio' }}">
                    @if($portfolio->title)
                    <div class="portfolio-overlay">
                        <div class="portfolio-overlay-title">{{ $portfolio->title }}</div>
                    </div>
                    @endif
                </div>
                @endif
                @endforeach
            </div>
            @endif

            <!-- ── Showreel (video list) ── -->
            @if($userdata->isFeatureVisible('video_gallery') && $videos->count() > 1)
            <div class="section-title-row reveal" style="margin-top:10px;">
                <span class="section-title-text">Showreel</span>
            </div>
            <div class="video-cards-grid reveal">
                @foreach($videos->skip(1)->take(6) as $video)
                @php
                    $vUrl = $video->video_link ?? $video->link ?? $video->name ?? '';
                    $vUrl = trim((string)$vUrl);
                    $tUrl = '';
                    if ((str_contains($vUrl,'youtube.com') || str_contains($vUrl,'youtu.be'))
                        && preg_match('~(youtu\.be/|v=)([^&?/]{11})~', $vUrl, $mx)) {
                        $tUrl = 'https://img.youtube.com/vi/'.($mx[2]??'').'/hqdefault.jpg';
                    }
                @endphp
                <a href="{{ $vUrl }}" target="_blank" rel="noopener" class="video-card">
                    @if($tUrl)
                        <img src="{{ $tUrl }}" alt="Video">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#1A1530,#2D2060);"></div>
                    @endif
                    <div class="video-card-overlay"><div class="play-btn"><i class="fas fa-play"></i></div></div>
                    @if($video->title)
                    <div class="video-card-title">{{ $video->title }}</div>
                    @endif
                </a>
                @endforeach
            </div>
            @endif

            <!-- ── Photo Gallery ── -->
            @if($userdata->isFeatureVisible('photo_gallery') && $professional_photos->count() > 0)
            <div class="section-title-row reveal" style="margin-top:10px;">
                <span class="section-title-text">Gallery</span>
            </div>
            <div class="photo-gallery-grid reveal">
                @foreach($professional_photos->take(12) as $photo)
                @php
                    $pv = $photo->image ?? $photo->name ?? '';
                    if ($pv) {
                        if (\Illuminate\Support\Str::startsWith($pv, ['http://','https://'])) {
                            $pUrl = $pv;
                        } elseif (\Illuminate\Support\Str::startsWith($pv, ['uploads/','frontend/','storage/'])) {
                            $pUrl = asset($pv);
                        } else {
                            $pUrl = asset('uploads/customer/' . $pv);
                        }
                    } else { $pUrl = ''; }
                @endphp
                @if($pUrl)
                <div class="gallery-item">
                    <img src="{{ $pUrl }}" alt="Photo">
                </div>
                @endif
                @endforeach
            </div>
            @endif

            <!-- ── About / Thoughts ── -->
            @if($userdata->isFeatureVisible('thoughts') && $thoughts->count() > 1)
            <div class="section-title-row reveal" style="margin-top:10px;">
                <span class="section-title-text">About</span>
            </div>
            <div class="about-cards-grid reveal">
                @foreach($thoughts->skip(1)->take(4) as $thought)
                @php
                    $tTitle = $thought->thought ?? $thought->title ?? '';
                    $tDesc  = $thought->description ?? $thought->desc ?? '';
                @endphp
                <div class="about-card">
                    @if($tTitle)
                    <p class="about-text">"{{ $tTitle }}"</p>
                    @endif
                    @if($tDesc)
                    <p class="about-sub">{{ $tDesc }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            <!-- ── Bottom CTA ── -->
            <div class="bottom-cta reveal">
              
                <div class="bottom-cta-title">Let's Create Something Amazing</div>
                <p class="bottom-cta-sub">Ready to bring your vision to life? Let's discuss your project and make it extraordinary.</p>
                <div class="bottom-cta-btns">
                    @if($userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="cta-big-btn cta-big-btn-white">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                    @endif
                    @if($social && $social->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$social->whatsapp) }}" target="_blank" class="cta-big-btn cta-big-btn-wa">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif
                </div>
            </div>

        </div><!-- /.container -->
    </div><!-- /.dark-section -->

    <!-- ═══════════════════════════════════════════════════
         FOOTER
    ═══════════════════════════════════════════════════ -->
    <footer class="site-footer">
        <p>Portfolio by <a href="{{ url('/') }}">Fastap</a></p>
    </footer>

    <!-- ═══════════════════════════════════════════════════
         SCRIPTS
    ═══════════════════════════════════════════════════ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.min.js"></script>
    <script>
        // ── Swiper carousel ──
        new Swiper('.swiper-banner', {
            loop: true,
            autoplay: { delay: 3800, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            effect: 'slide',
        });

        // ── Scroll reveal ──
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.10 });
        revealEls.forEach(el => observer.observe(el));
    </script>

    @include('components.profile-location-tracker', [
        'customerId' => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview' => $isPreview ?? false
    ])
</body>
</html>