<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Manufacturing' }} - Industrial Solutions</title>

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
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal',
                    'profess','videos','product','social_link','upload_file','client',
                    'menu_section','reservation_section','property_listings','showreel',
                    'team_section','pricing_section','booking_section'], 1);
            }
        }

        $themeColor = $theme->color ?? '#1e3a5f';

        // Product/service images — unique per card
        $productImages = [
            'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1530124566582-a618bc2615dc?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1611348586804-61bf6c080437?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=600&h=400&fit=crop&auto=format',
        ];

        $productIcons = [
            'fas fa-cogs','fas fa-wrench','fas fa-microchip','fas fa-bolt',
            'fas fa-cube','fas fa-tools','fas fa-industry','fas fa-hammer',
        ];

        // Gallery fallback images
        $galleryFallback = [
            'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=900&h=700&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=600&h=500&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=600&h=500&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&h=500&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1530124566582-a618bc2615dc?w=900&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop&auto=format',
        ];
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Barlow+Condensed:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary:       {{ $themeColor }};
            --primary-dark:  #0a1f36;
            --primary-mid:   #1a4a7a;
            --primary-light: #2a6aaa;
            --accent:        #f59e0b;
            --accent-dark:   #d97706;
            --accent-light:  #fbbf24;
            --success:       #10b981;
            --text-dark:     #0f172a;
            --text-mid:      #334155;
            --text-gray:     #64748b;
            --text-light:    #94a3b8;
            --bg-light:      #f1f5f9;
            --bg-card:       #ffffff;
            --border:        #e2e8f0;
            --shadow-sm:     0 2px 8px rgba(15,23,42,0.08);
            --shadow-md:     0 8px 28px rgba(15,23,42,0.12);
            --shadow-lg:     0 20px 60px rgba(15,23,42,0.18);
            --shadow-xl:     0 30px 80px rgba(15,23,42,0.22);
            --radius-sm:     6px;
            --radius-md:     12px;
            --radius-lg:     20px;
            --radius-xl:     28px;
            --transition:    all 0.35s cubic-bezier(.4,0,.2,1);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ══════════════════════════════
           PREVIEW BANNER
        ══════════════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg, #7c3aed, #ec4899, #f97316);
            color: #fff;
            padding: 0.85rem 1rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.88rem;
            position: sticky;
            top: 0;
            z-index: 2000;
            box-shadow: 0 4px 16px rgba(0,0,0,.18);
        }
        .preview-banner a { color: #fde68a; text-decoration: underline; font-weight: 800; }

        /* ══════════════════════════════
           HERO
        ══════════════════════════════ */
        .mfg-hero {
            position: relative;
            min-height: 640px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1800&h=900&fit=crop&auto=format');
            background-size: cover;
            background-position: center 40%;
            animation: heroZoom 20s ease-in-out infinite alternate;
            z-index: 1;
        }
        @keyframes heroZoom {
            from { transform: scale(1.0); background-position: center 40%; }
            to   { transform: scale(1.07); background-position: center 45%; }
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                170deg,
                rgba(10,31,54,0.88) 0%,
                rgba(26,74,122,0.78) 50%,
                rgba(245,158,11,0.18) 100%
            );
            z-index: 2;
        }

        /* grid texture overlay */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            z-index: 3;
        }

        .hero-wave {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            z-index: 4;
            line-height: 0;
        }
        .hero-wave svg { display: block; width: 100%; }

        .hero-content {
            position: relative;
            z-index: 5;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 6rem 2rem 5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.2rem;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(245,158,11,0.18);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(245,158,11,0.5);
            color: var(--accent-light);
            padding: 0.45rem 1.3rem;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            animation: fadeDown 0.7s ease both;
        }

        .hero-logo {
            width: 120px;
            height: 120px;
            border-radius: var(--radius-md);
            border: 4px solid var(--accent);
            overflow: hidden;
            background: #fff;
            box-shadow: 0 12px 40px rgba(0,0,0,0.35);
            animation: fadeDown 0.7s 0.05s ease both;
            flex-shrink: 0;
        }
        .hero-logo img { width: 100%; height: 100%; object-fit: cover; }
        .hero-logo-icon {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--accent);
            font-size: 3rem;
        }

        .hero-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.05;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            animation: fadeDown 0.8s 0.1s ease both;
        }
        .hero-title span { color: var(--accent); }

        .hero-sub {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.85);
            font-weight: 400;
            max-width: 600px;
            animation: fadeDown 0.8s 0.2s ease both;
        }

        .hero-location {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            font-weight: 500;
            animation: fadeDown 0.8s 0.25s ease both;
        }
        .hero-location i { color: var(--accent); }

        .hero-stats {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 0.5rem;
            animation: fadeDown 0.8s 0.3s ease both;
        }
        .hero-stat {
            text-align: center;
            padding: 1rem 1.5rem;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: var(--radius-md);
        }
        .hs-num {
            display: block;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--accent);
            line-height: 1;
            margin-bottom: 0.2rem;
        }
        .hs-label { font-size: 0.75rem; color: rgba(255,255,255,0.75); font-weight: 600; letter-spacing: .5px; }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeDown 0.8s 0.4s ease both;
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ══════════════════════════════
           BUTTONS
        ══════════════════════════════ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.85rem 2rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            white-space: nowrap;
            letter-spacing: .3px;
        }
        .btn-accent {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            color: var(--text-dark);
            box-shadow: 0 8px 24px rgba(245,158,11,0.4);
        }
        .btn-accent:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(245,158,11,0.5); }

        .btn-glass {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
            color: #fff;
            border: 2px solid rgba(255,255,255,0.35);
        }
        .btn-glass:hover { background: rgba(255,255,255,0.22); transform: translateY(-3px); }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-mid));
            color: #fff;
            box-shadow: 0 8px 24px rgba(42,106,170,0.35);
        }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(42,106,170,0.45); }

        .btn-outline {
            background: #fff;
            color: var(--primary);
            border: 2px solid var(--primary-light);
        }
        .btn-outline:hover { background: var(--primary); color: #fff; border-color: var(--primary); transform: translateY(-3px); }

        .btn-wa {
            background: linear-gradient(135deg, #25d366, #128c7e);
            color: #fff;
            box-shadow: 0 8px 24px rgba(37,211,102,0.4);
        }
        .btn-wa:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(37,211,102,0.5); }

        /* ══════════════════════════════
           IDENTITY CARD (floating)
        ══════════════════════════════ */
        .identity-section {
            position: relative;
            z-index: 10;
            margin-top: 20px;
            padding: 0 2rem;
        }

        .identity-card {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            display: grid;
            grid-template-columns: 300px 1fr;
        }

        .id-left {
            background: linear-gradient(170deg, var(--primary-dark) 0%, var(--primary-mid) 70%, var(--primary-light) 100%);
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.5rem;
            position: relative;
            overflow: hidden;
        }
        .id-left::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(245,158,11,0.08);
        }
        .id-left::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -40px;
            width: 280px; height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        .id-logo-wrap { position: relative; z-index: 2; }
        .id-logo {
            width: 140px;
            height: 140px;
            border-radius: var(--radius-md);
            border: 4px solid var(--accent);
            overflow: hidden;
            background: #fff;
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
            margin: 0 auto;
        }
        .id-logo img { width: 100%; height: 100%; object-fit: cover; }
        .id-logo-icon {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--accent);
            font-size: 3.5rem;
        }

        .id-badge {
            position: absolute;
            bottom: -10px;
            right: -10px;
            width: 40px;
            height: 40px;
            background: var(--accent);
            border-radius: 50%;
            border: 3px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(245,158,11,0.5);
        }

        .id-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1.7rem;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.15;
            position: relative;
            z-index: 2;
        }

        .id-desig {
            font-size: 0.88rem;
            color: var(--accent-light);
            font-weight: 600;
            position: relative;
            z-index: 2;
        }

        .id-tags {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            width: 100%;
            position: relative;
            z-index: 2;
        }
        .id-tag {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: var(--radius-md);
            padding: 0.65rem 1rem;
            color: rgba(255,255,255,0.9);
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
        }
        .id-tag:hover { background: rgba(255,255,255,0.16); }
        .id-tag i { width: 18px; text-align: center; color: var(--accent); font-size: 0.9rem; }

        .id-cta-btns {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .id-right {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .id-headline h1 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 900;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: .5px;
            line-height: 1.1;
        }
        .id-headline .sub {
            font-size: 1rem;
            color: var(--primary-light);
            font-weight: 600;
            margin-top: 0.3rem;
        }

        .id-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
        }
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 1rem;
            background: var(--bg-light);
            border: 1.5px solid var(--border);
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--primary-mid);
            transition: var(--transition);
        }
        .chip:hover { background: var(--primary); color: #fff; border-color: var(--primary); transform: translateY(-2px); }
        .chip i { font-size: 0.8rem; }

        .id-kpis {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.8rem;
        }
        .kpi {
            background: var(--bg-light);
            border-radius: var(--radius-md);
            padding: 1rem;
            text-align: center;
            border: 1.5px solid var(--border);
            transition: var(--transition);
        }
        .kpi:hover { border-color: var(--accent); transform: translateY(-3px); box-shadow: var(--shadow-sm); }
        .kpi-num {
            display: block;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1.9rem;
            font-weight: 900;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 0.25rem;
        }
        .kpi-label { font-size: 0.72rem; color: var(--text-gray); font-weight: 700; text-transform: uppercase; letter-spacing: .5px; }

        .id-btn-row { display: flex; gap: 0.8rem; flex-wrap: wrap; }

        /* ══════════════════════════════
           PAGE BODY
        ══════════════════════════════ */
        .page-body {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 5rem;
        }

        /* ══════════════════════════════
           SECTION HEADERS
        ══════════════════════════════ */
        .sec-head {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2.5rem;
            position: relative;
            padding-bottom: 1.4rem;
        }
      
        .sec-icon {
            width: 58px; height: 58px;
            background: linear-gradient(135deg, var(--primary-mid), var(--primary-light));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 8px 24px rgba(42,106,170,0.3);
        }
        .sec-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(1.7rem, 3vw, 2.2rem);
            font-weight: 900;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .sec-title span { color: var(--primary-light); }

        /* ══════════════════════════════
           TRUST STRIP
        ══════════════════════════════ */
        .trust-strip {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
            gap: 1.2rem;
        }
        .trust-item {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 1.8rem 1.2rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: var(--transition);
        }
        .trust-item:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); border-color: var(--accent); }
        .trust-icon { font-size: 2rem; color: var(--accent); margin-bottom: 0.7rem; }
        .trust-title { font-size: 0.92rem; font-weight: 800; color: var(--text-dark); margin-bottom: 0.25rem; }
        .trust-desc { font-size: 0.78rem; color: var(--text-gray); line-height: 1.6; }

        /* ══════════════════════════════
           PRODUCTS / SERVICES GRID
        ══════════════════════════════ */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: var(--transition);
        }
        .product-card:hover { transform: translateY(-10px); box-shadow: var(--shadow-lg); border-color: transparent; }

        .pc-image {
            position: relative;
            height: 210px;
            overflow: hidden;
        }
        .pc-image img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .product-card:hover .pc-image img { transform: scale(1.1); }

        .pc-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(10,31,54,0.3) 0%,
                rgba(10,31,54,0.75) 100%
            );
        }

        .pc-number {
            position: absolute;
            top: 1rem; left: 1rem;
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 900;
            font-size: 1rem;
            color: var(--text-dark);
            z-index: 2;
        }

        .pc-icon-badge {
            position: absolute;
            bottom: -22px; left: 50%;
            transform: translateX(-50%);
            width: 48px; height: 48px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--primary);
            box-shadow: 0 6px 18px rgba(10,31,54,0.2);
            border: 3px solid var(--bg-light);
            z-index: 2;
        }

        .pc-body {
            padding: 2.5rem 1.8rem 2rem;
            text-align: center;
        }
        .pc-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.6rem;
            text-transform: uppercase;
            letter-spacing: .3px;
        }
        .pc-desc { font-size: 0.88rem; color: var(--text-gray); line-height: 1.7; }
        .pc-tag {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.28rem 0.85rem;
            background: linear-gradient(90deg, var(--accent), var(--accent-dark));
            color: var(--text-dark);
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        /* ══════════════════════════════
           CAPABILITIES (with image BG)
        ══════════════════════════════ */
        .capabilities-section {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }
        .cap-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=1600&h=800&fit=crop&auto=format');
            background-size: cover;
            background-position: center;
            z-index: 1;
        }
        .cap-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10,31,54,0.93) 0%, rgba(26,74,122,0.88) 100%);
            z-index: 2;
        }
        .cap-content {
            position: relative;
            z-index: 3;
            padding: 4rem 3rem;
        }
        .cap-content 
        .cap-content .sec-title { color: #fff; }
        .cap-content .sec-icon {
            background: rgba(245,158,11,0.2);
            border: 1px solid rgba(245,158,11,0.4);
            color: var(--accent);
            box-shadow: none;
        }

        .cap-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
        }
        .cap-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: var(--radius-lg);
            padding: 2rem 1.5rem;
            display: flex;
            gap: 1.2rem;
            align-items: flex-start;
            transition: var(--transition);
        }
        .cap-card:hover { background: rgba(255,255,255,0.14); transform: translateY(-5px); }

        .cap-icon {
            width: 52px; height: 52px;
            background: rgba(245,158,11,0.2);
            border: 1px solid rgba(245,158,11,0.4);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .cap-body {}
        .cap-title { font-size: 1rem; font-weight: 800; color: #fff; margin-bottom: 0.4rem; }
        .cap-desc { font-size: 0.83rem; color: rgba(255,255,255,0.7); line-height: 1.6; }

        /* ══════════════════════════════
           CERTIFICATIONS
        ══════════════════════════════ */
        .certs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .cert-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 1.8rem;
            display: flex;
            gap: 1.2rem;
            align-items: flex-start;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: var(--transition);
            border-left: 4px solid var(--accent);
        }
        .cert-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }
        .cert-icon {
            width: 52px; height: 52px;
            border-radius: var(--radius-md);
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            font-size: 1.3rem;
            flex-shrink: 0;
            box-shadow: 0 6px 18px rgba(245,158,11,0.3);
        }
        .cert-title { font-size: 1rem; font-weight: 800; color: var(--text-dark); margin-bottom: 0.3rem; }
        .cert-desc { font-size: 0.85rem; color: var(--text-gray); line-height: 1.6; }

        /* ══════════════════════════════
           QUALITY STANDARDS SPLIT
        ══════════════════════════════ */
        .quality-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            min-height: 360px;
        }
        .qs-img-side {
            background-image: url('https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=800&h=600&fit=crop&auto=format');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .qs-img-side::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10,31,54,0.4), transparent);
        }
        .qs-text-side {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-mid) 100%);
            padding: 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.8rem;
        }
        .qs-headline {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .5px;
            line-height: 1.2;
        }
        .qs-headline span { color: var(--accent); }
        .qs-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
        }
        .qs-badge {
            padding: 0.45rem 1.1rem;
            background: rgba(245,158,11,0.18);
            border: 1.5px solid var(--accent);
            border-radius: 50px;
            color: var(--accent-light);
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: .5px;
        }
        .qs-list { display: flex; flex-direction: column; gap: 0.8rem; }
        .qs-list-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: rgba(255,255,255,0.85);
            font-size: 0.9rem;
            font-weight: 500;
        }
        .qs-list-item i { color: var(--accent); font-size: 1rem; width: 20px; }

        /* ══════════════════════════════
           CATALOG CTA (with image)
        ══════════════════════════════ */
        .catalog-band {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }
        .catalog-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=1600&h=600&fit=crop&auto=format');
            background-size: cover;
            background-position: center;
            z-index: 1;
        }
        .catalog-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(10,31,54,0.95) 0%, rgba(26,74,122,0.90) 60%, rgba(245,158,11,0.25) 100%);
            z-index: 2;
        }
        .catalog-content {
            position: relative;
            z-index: 3;
            padding: 5rem 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.5rem;
        }
        .catalog-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(245,158,11,0.15);
            border: 1px solid rgba(245,158,11,0.5);
            color: var(--accent-light);
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .catalog-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(2rem, 4.5vw, 3.2rem);
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .5px;
            line-height: 1.1;
        }
        .catalog-sub {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.8);
            max-width: 500px;
            font-weight: 400;
        }
        .catalog-btns { display: flex; gap: 1.2rem; flex-wrap: wrap; justify-content: center; margin-top: 0.5rem; }

        .btn-cta-main {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            background: var(--accent);
            color: var(--text-dark);
            padding: 1.1rem 2.8rem;
            border-radius: var(--radius-xl);
            font-weight: 800;
            font-size: 1rem;
            text-decoration: none;
            box-shadow: 0 12px 35px rgba(245,158,11,0.4);
            transition: var(--transition);
        }
        .btn-cta-main:hover { background: var(--accent-dark); transform: translateY(-5px); box-shadow: 0 18px 50px rgba(245,158,11,0.5); }

        .btn-cta-sec {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(8px);
            color: #fff;
            padding: 1.1rem 2.8rem;
            border-radius: var(--radius-xl);
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.35);
            transition: var(--transition);
        }
        .btn-cta-sec:hover { background: rgba(255,255,255,0.2); transform: translateY(-5px); }

        /* ══════════════════════════════
           GALLERY
        ══════════════════════════════ */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
        .gallery-item:nth-child(1) { grid-column: span 2; grid-row: span 2; }
        .gallery-item:nth-child(5) { grid-column: span 2; }

        .gallery-item {
            border-radius: var(--radius-md);
            overflow: hidden;
            position: relative;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: var(--transition);
        }
        .gallery-item img {
            width: 100%; height: 100%;
            object-fit: cover;
            min-height: 170px;
            transition: transform 0.5s ease;
            display: block;
        }
        .gallery-item:hover { transform: scale(1.03); box-shadow: var(--shadow-lg); z-index: 5; }
        .gallery-item:hover img { transform: scale(1.08); }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(10,31,54,0.5);
            opacity: 0;
            transition: opacity .35s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.8rem;
        }
        .gallery-item:hover .gallery-overlay { opacity: 1; }

        /* ══════════════════════════════
           CONTACT
        ══════════════════════════════ */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
        }
        .contact-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.4rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }
        .contact-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); border-color: var(--accent); }
        .contact-icon {
            width: 56px; height: 56px;
            border-radius: var(--radius-md);
            background: linear-gradient(135deg, var(--primary-mid), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.4rem;
            flex-shrink: 0;
            box-shadow: 0 6px 18px rgba(42,106,170,0.3);
        }
        .contact-label { font-size: 0.72rem; color: var(--text-light); font-weight: 700; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 0.25rem; }
        .contact-value { font-size: 1rem; font-weight: 700; color: var(--text-dark); }

        /* ══════════════════════════════
           SOCIAL
        ══════════════════════════════ */
        .social-band {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            padding: 3rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            text-align: center;
        }
        .social-links { display: flex; justify-content: center; gap: 1.2rem; flex-wrap: wrap; margin-top: 1.5rem; }
        .social-link {
            width: 60px; height: 60px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            text-decoration: none;
            transition: var(--transition);
        }
        .social-link:hover { transform: translateY(-8px) scale(1.1); box-shadow: 0 12px 30px rgba(0,0,0,.2); }
        .sl-fb   { background: linear-gradient(135deg,#1877f2,#0d5cc7); color:#fff; }
        .sl-ig   { background: linear-gradient(135deg,#f58529,#dd2a7b,#8134af); color:#fff; }
        .sl-li   { background: linear-gradient(135deg,#0077b5,#004d83); color:#fff; }
        .sl-tw   { background: linear-gradient(135deg,#1da1f2,#0d7dc7); color:#fff; }
        .sl-yt   { background: linear-gradient(135deg,#ff0000,#cc0000); color:#fff; }
        .sl-wa   { background: linear-gradient(135deg,#25d366,#128c7e); color:#fff; }

        /* ══════════════════════════════
           FOOTER
        ══════════════════════════════ */
        .mfg-footer {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-mid));
            color: rgba(255,255,255,0.65);
            padding: 3rem 2rem;
            text-align: center;
            margin-top: 4rem;
        }
        .mfg-footer .inner { max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column; align-items: center; gap: 0.6rem; }
        .footer-brand {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1.4rem;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.2rem;
        }
        .mfg-footer a { color: var(--accent); text-decoration: none; font-weight: 700; }

        /* ══════════════════════════════
           REVEAL ANIMATIONS
        ══════════════════════════════ */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ══════════════════════════════
           RESPONSIVE
        ══════════════════════════════ */
        @media (max-width: 900px) {
            .identity-card { grid-template-columns: 1fr; }
            .id-left { padding: 2.5rem 2rem; }
            .id-right { padding: 2.5rem 2rem; }
            .id-kpis { grid-template-columns: repeat(2,1fr); }
            .quality-split { grid-template-columns: 1fr; }
            .qs-img-side { min-height: 220px; }
            .gallery-grid { grid-template-columns: repeat(2,1fr); }
            .gallery-item:nth-child(1) { grid-column: span 2; grid-row: span 1; }
            .gallery-item:nth-child(5) { grid-column: span 2; }
        }

        @media (max-width: 640px) {
            .mfg-hero { min-height: 500px; }
            .identity-section { margin-top: -70px; padding: 0 1rem; }
            .id-kpis { grid-template-columns: repeat(2,1fr); }
            .id-btn-row { flex-direction: column; }
            .page-body { padding: 3rem 1rem; gap: 3.5rem; }
            .cap-content { padding: 2.5rem 1.5rem; }
            .catalog-content { padding: 3.5rem 1.5rem; }
            .hero-stats { gap: 0.8rem; }
            .hero-stat { padding: 0.8rem 1rem; }
            .social-band { padding: 2rem 1.5rem; }
        }

        @media (max-width: 400px) {
            .id-kpis { grid-template-columns: 1fr 1fr; }
            .gallery-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i>&nbsp; Preview Mode —
        <a href="{{ url('/signin') }}">Sign up free</a> to publish your professional industrial profile!
    </div>
    @endif

    <!-- ╔══════════════════════════════════════╗
         ║              HERO                    ║
         ╚══════════════════════════════════════╝ -->
    <section class="mfg-hero">
        @if($userdata->banner ?? false)
            <div class="hero-bg" style="background-image: url('{{ url('public/frontend/user_images', $userdata->banner) }}');"></div>
        @else
            <div class="hero-bg"></div>
        @endif
        <div class="hero-overlay"></div>
        <div class="hero-grid"></div>

        <div class="hero-content">
            <div class="hero-eyebrow">
                <i class="fas fa-industry"></i>
                Industrial &amp; Manufacturing
            </div>

           

            <h1 class="hero-title">
                <span>{{ $userdata->name ?? 'Your Company' }}</span>
            </h1>

            <p class="hero-sub">{{ $userdata->desig ?? ($theme->name ?? 'Precision Manufacturing · Industrial Solutions') }}</p>

            @if($userdata->city ?? false)
            <div class="hero-location">
                <i class="fas fa-map-marker-alt"></i>
                {{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}
            </div>
            @endif

            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hs-num">25+</span>
                    <span class="hs-label">Years Active</span>
                </div>
                <div class="hero-stat">
                    <span class="hs-num">500+</span>
                    <span class="hs-label">B2B Clients</span>
                </div>
                <div class="hero-stat">
                    <span class="hs-num">ISO</span>
                    <span class="hs-label">Certified</span>
                </div>
                <div class="hero-stat">
                    <span class="hs-num">24/7</span>
                    <span class="hs-label">Support</span>
                </div>
            </div>

            <div class="hero-actions">
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="btn btn-accent">
                    <i class="fas fa-phone-alt"></i> Get Quote
                </a>
                @endif
                @if($userdata->email ?? false)
                <a href="mailto:{{ $userdata->email }}" class="btn btn-glass">
                    <i class="fas fa-envelope"></i> Send Inquiry
                </a>
                @endif
            </div>
        </div>

        <div class="hero-wave">
            <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,40 C360,90 1080,0 1440,50 L1440,80 L0,80 Z" fill="#f1f5f9"/>
            </svg>
        </div>
    </section>

    <!-- ╔══════════════════════════════════════╗
         ║          IDENTITY CARD               ║
         ╚══════════════════════════════════════╝ -->
    <div class="identity-section">
        <div class="identity-card reveal">

            <!-- LEFT -->
            <div class="id-left">
                <div class="id-logo-wrap">
                    <div class="id-logo">
                        @if($userdata->profile ?? false)
                            <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
                        @else
                            <div class="id-logo-icon"><i class="fas fa-industry"></i></div>
                        @endif
                    </div>
                    <div class="id-badge"><i class="fas fa-check"></i></div>
                </div>

                <div class="id-name">{{ $userdata->name ?? 'Company Name' }}</div>
                <div class="id-desig">{{ $userdata->desig ?? ($theme->name ?? 'Industrial Solutions') }}</div>

                <div class="id-tags">
                    @if($userdata->city ?? false)
                    <div class="id-tag">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}
                    </div>
                    @endif
                    @if(($professions ?? collect())->count() > 0)
                    <div class="id-tag">
                        <i class="fas fa-cogs"></i>
                        {{ $professions->count() }} Product{{ $professions->count() > 1 ? 's' : '' }} &amp; Services
                    </div>
                    @endif
                    <div class="id-tag">
                        <i class="fas fa-certificate"></i>
                        ISO 9001 · CE · BIS Certified
                    </div>
                    <div class="id-tag">
                        <i class="fas fa-clock"></i>
                        Mon–Sat · 9 AM – 6 PM
                    </div>
                    <div class="id-tag">
                        <i class="fas fa-star" style="color:var(--accent);"></i>
                        4.8 / 5.0 B2B Rating
                    </div>
                </div>

                <div class="id-cta-btns">
                    @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="btn btn-accent" style="width:100%;">
                        <i class="fas fa-phone-alt"></i> {{ $userdata->mobile }}
                    </a>
                    @endif
                    @if(($social ?? null) && ($social->whatsapp ?? false))
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="btn btn-wa" style="width:100%;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif
                </div>
            </div>

            <!-- RIGHT -->
            <div class="id-right">
                <div class="id-headline">
                    <h1>{{ $userdata->name ?? 'Industrial Solutions' }}</h1>
                    <p class="sub">{{ $userdata->desig ?? 'Precision Manufacturing · B2B Specialist' }}</p>
                </div>

                <div class="id-chips">
                    @if(($qualifications ?? collect())->count() > 0)
                        <span class="chip">
                            <i class="fas fa-award"></i>
                            {{ $qualifications->first()->title ?? 'Certified' }}
                        </span>
                    @endif
                    @if($userdata->city ?? false)
                        <span class="chip"><i class="fas fa-location-dot"></i> {{ $userdata->city }}</span>
                    @endif
                    @if(($professions ?? collect())->count() > 0)
                        <span class="chip"><i class="fas fa-cogs"></i> {{ $professions->count() }} Services</span>
                    @endif
                    <span class="chip"><i class="fas fa-shield-halved"></i> ISO Certified</span>
                    <span class="chip"><i class="fas fa-globe"></i> Export Ready</span>
                    <span class="chip"><i class="fas fa-bolt"></i> Fast Delivery</span>
                </div>

                <div class="id-kpis">
                    <div class="kpi"><span class="kpi-num">25+</span><span class="kpi-label">Yrs Active</span></div>
                    <div class="kpi"><span class="kpi-num">500+</span><span class="kpi-label">Clients</span></div>
                    <div class="kpi"><span class="kpi-num">100%</span><span class="kpi-label">Quality</span></div>
                    <div class="kpi"><span class="kpi-num">50+</span><span class="kpi-label">Countries</span></div>
                </div>

                <div class="id-btn-row">
                    @if($userdata->mobile ?? false)
                    <a href="tel:{{ $userdata->mobile }}" class="btn btn-primary">
                        <i class="fas fa-file-invoice"></i> Request Quotation
                    </a>
                    @endif
                    @if($userdata->email ?? false)
                    <a href="mailto:{{ $userdata->email }}" class="btn btn-outline">
                        <i class="fas fa-envelope"></i> Email Inquiry
                    </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- ╔══════════════════════════════════════╗
         ║           TRUST STRIP                ║
         ╚══════════════════════════════════════╝ -->
    <div style="max-width:1200px;margin:3rem auto 0;padding:0 2rem;">
        <div class="trust-strip reveal">
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-industry"></i></div>
                <div class="trust-title">Advanced Manufacturing</div>
                <div class="trust-desc">State-of-the-art production facilities</div>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-shield-halved"></i></div>
                <div class="trust-title">ISO Certified</div>
                <div class="trust-desc">Internationally recognized quality standards</div>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-truck-fast"></i></div>
                <div class="trust-title">On-Time Delivery</div>
                <div class="trust-desc">Reliable supply chain management</div>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-globe"></i></div>
                <div class="trust-title">Export Ready</div>
                <div class="trust-desc">Serving clients in 50+ countries worldwide</div>
            </div>
            <div class="trust-item">
                <div class="trust-icon"><i class="fas fa-headset"></i></div>
                <div class="trust-title">Dedicated Support</div>
                <div class="trust-desc">Technical assistance &amp; after-sales service</div>
            </div>
        </div>
    </div>

    <!-- ═══ MAIN PAGE BODY ═══ -->
    <div class="page-body">

        <!-- ╔═══════════════════════════╗
             ║  PRODUCTS & SERVICES      ║
             ╚═══════════════════════════╝ -->
        @if(($professions ?? collect())->count() > 0)
        <section class="reveal">
            <div class="sec-head">
                <div class="sec-icon"><i class="fas fa-cogs"></i></div>
                <div>
                    <h2 class="sec-title">Products <span>&amp; Services</span></h2>
                </div>
            </div>
            <div class="products-grid">
                @php $pIdx = 0; @endphp
                @foreach($professions as $profession)
                @php
                    $pImg   = $productImages[$pIdx % count($productImages)];
                    $pIcon  = $productIcons[$pIdx % count($productIcons)];
                    $pIdx++;
                @endphp
                <div class="product-card">
                    <div class="pc-image">
                        <img src="{{ $pImg }}"
                             alt="{{ $profession->title ?? 'Product' }}"
                             loading="lazy">
                        <div class="pc-overlay"></div>
                        <div class="pc-number">{{ str_pad($pIdx, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="pc-icon-badge"><i class="{{ $pIcon }}"></i></div>
                    </div>
                    <div class="pc-body">
                        <h3 class="pc-title">{{ $profession->title ?? 'Product / Service' }}</h3>
                        <p class="pc-desc">{{ $profession->desc ?? $profession->description ?? 'High-quality industrial product built to specification.' }}</p>
                        <span class="pc-tag">View Details →</span>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- ╔═══════════════════════════╗
             ║     CAPABILITIES          ║
             ╚═══════════════════════════╝ -->
        <section class="reveal">
            <div class="capabilities-section">
                <div class="cap-bg"></div>
                <div class="cap-overlay"></div>
                <div class="cap-content">
                    <div class="sec-head">
                        <div class="sec-icon"><i class="fas fa-industry"></i></div>
                        <div>
                            <h2 class="sec-title">Manufacturing <span>Capabilities</span></h2>
                        </div>
                    </div>
                    <div class="cap-grid">
                        <div class="cap-card">
                            <div class="cap-icon"><i class="fas fa-chart-line"></i></div>
                            <div class="cap-body">
                                <div class="cap-title">High-Volume Production</div>
                                <div class="cap-desc">Scalable manufacturing lines capable of meeting bulk order demands with consistent quality output.</div>
                            </div>
                        </div>
                        <div class="cap-card">
                            <div class="cap-icon"><i class="fas fa-microscope"></i></div>
                            <div class="cap-body">
                                <div class="cap-title">Precision Engineering</div>
                                <div class="cap-desc">Sub-micron tolerance machining using CNC and advanced automated tooling systems.</div>
                            </div>
                        </div>
                        <div class="cap-card">
                            <div class="cap-icon"><i class="fas fa-recycle"></i></div>
                            <div class="cap-body">
                                <div class="cap-title">Sustainable Practices</div>
                                <div class="cap-desc">Eco-friendly processes, waste reduction programs and energy-efficient operations.</div>
                            </div>
                        </div>
                        <div class="cap-card">
                            <div class="cap-icon"><i class="fas fa-robot"></i></div>
                            <div class="cap-body">
                                <div class="cap-title">Automation &amp; Robotics</div>
                                <div class="cap-desc">Industry 4.0 integration with smart automation for consistent precision at scale.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ╔═══════════════════════════╗
             ║  CERTIFICATIONS           ║
             ╚═══════════════════════════╝ -->
        @if(($qualifications ?? collect())->count() > 0)
        <section class="reveal">
            <div class="sec-head">
                <div class="sec-icon"><i class="fas fa-certificate"></i></div>
                <div>
                    <h2 class="sec-title">Certifications <span>&amp; Standards</span></h2>
                </div>
            </div>
            <div class="certs-grid">
                @php $cIcons = ['fas fa-medal','fas fa-award','fas fa-certificate','fas fa-scroll','fas fa-trophy','fas fa-star']; $cIdx=0; @endphp
                @foreach($qualifications as $qual)
                <div class="cert-card">
                    <div class="cert-icon"><i class="{{ $cIcons[$cIdx % count($cIcons)] }}"></i></div>
                    <div>
                        <div class="cert-title">{{ $qual->title ?? $qual->qualifiaction ?? 'Certification' }}</div>
                        <div class="cert-desc">{{ $qual->desc ?? $qual->description ?? 'Internationally recognized certification for quality and compliance.' }}</div>
                    </div>
                </div>
                @php $cIdx++; @endphp
                @endforeach
            </div>
        </section>
        @endif

        <!-- ╔═══════════════════════════╗
             ║  QUALITY STANDARDS SPLIT  ║
             ╚═══════════════════════════╝ -->
        <section class="reveal">
            <div class="sec-head">
                <div class="sec-icon"><i class="fas fa-shield-halved"></i></div>
                <div>
                    <h2 class="sec-title">Quality <span>Standards</span></h2>
                </div>
            </div>
            <div class="quality-split">
                <div class="qs-img-side"></div>
                <div class="qs-text-side">
                    <div class="qs-headline">Precision <span>Quality</span><br>You Can Trust</div>
                    <div class="qs-badges">
                        <span class="qs-badge">ISO 9001:2015</span>
                        <span class="qs-badge">CE Certified</span>
                        <span class="qs-badge">BIS Approved</span>
                        <span class="qs-badge">RoHS Compliant</span>
                    </div>
                    <div class="qs-list">
                        <div class="qs-list-item"><i class="fas fa-check-circle"></i> 100% in-house quality inspection</div>
                        <div class="qs-list-item"><i class="fas fa-check-circle"></i> Third-party audit compliance</div>
                        <div class="qs-list-item"><i class="fas fa-check-circle"></i> Zero-defect manufacturing goal</div>
                        <div class="qs-list-item"><i class="fas fa-check-circle"></i> Full traceability on every batch</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ╔═══════════════════════════╗
             ║  CONTACT INFORMATION      ║
             ╚═══════════════════════════╝ -->
        <section class="reveal">
            <div class="sec-head">
                <div class="sec-icon"><i class="fas fa-address-card"></i></div>
                <div>
                    <h2 class="sec-title">Contact <span>Information</span></h2>
                </div>
            </div>
            <div class="contact-grid">
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="contact-card">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <div class="contact-label">Phone</div>
                        <div class="contact-value">{{ $userdata->mobile }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->email ?? false)
                <a href="mailto:{{ $userdata->email }}" class="contact-card">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="contact-label">Email</div>
                        <div class="contact-value">{{ $userdata->email }}</div>
                    </div>
                </a>
                @endif
                @if($userdata->city ?? false)
                <div class="contact-card">
                    <div class="contact-icon"><i class="fas fa-location-dot"></i></div>
                    <div>
                        <div class="contact-label">Location</div>
                        <div class="contact-value">{{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}</div>
                    </div>
                </div>
                @endif
                @if(($social ?? null) && ($social->website ?? false))
                <a href="{{ $social->website }}" class="contact-card" target="_blank">
                    <div class="contact-icon" style="background:linear-gradient(135deg,#059669,#047857);">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div>
                        <div class="contact-label">Website</div>
                        <div class="contact-value">Visit Website</div>
                    </div>
                </a>
                @endif
                @if(($social ?? null) && ($social->whatsapp ?? false))
                <a href="https://wa.me/{{ $social->whatsapp }}" class="contact-card">
                    <div class="contact-icon" style="background:linear-gradient(135deg,#25d366,#128c7e);">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="contact-label">WhatsApp</div>
                        <div class="contact-value">{{ $social->whatsapp }}</div>
                    </div>
                </a>
                @endif
            </div>
        </section>

        <!-- ╔═══════════════════════════╗
             ║  FACILITY GALLERY         ║
             ╚═══════════════════════════╝ -->
        <section class="reveal">
            <div class="sec-head">
                <div class="sec-icon"><i class="fas fa-images"></i></div>
                <div>
                    <h2 class="sec-title">Facility <span>&amp; Products</span></h2>
                </div>
            </div>
            <div class="gallery-grid">
                @if(($portfolios ?? collect())->count() > 0)
                    @foreach($portfolios->take(6) as $portfolio)
                    @php
                        $images = json_decode($portfolio->image, true);
                        $gUrl   = ($images && count($images) > 0)
                            ? url('public/frontend/portfolio/' . $images[0])
                            : $galleryFallback[$loop->index % count($galleryFallback)];
                    @endphp
                    <div class="gallery-item">
                        <img src="{{ $gUrl }}" alt="Facility" loading="lazy">
                        <div class="gallery-overlay"><i class="fas fa-expand-alt"></i></div>
                    </div>
                    @endforeach
                @else
                    @foreach($galleryFallback as $gImg)
                    <div class="gallery-item">
                        <img src="{{ $gImg }}" alt="Industrial Facility" loading="lazy">
                        <div class="gallery-overlay"><i class="fas fa-expand-alt"></i></div>
                    </div>
                    @endforeach
                @endif
            </div>
        </section>

    </div><!-- /page-body -->

    <!-- ╔══════════════════════════════════════╗
         ║         CATALOG / CTA BAND           ║
         ╚══════════════════════════════════════╝ -->
    <div style="padding:0 2rem; margin-bottom:4rem;">
        <div style="max-width:1200px;margin:0 auto;">
            <div class="catalog-band reveal">
                <div class="catalog-bg"></div>
                <div class="catalog-overlay"></div>
                <div class="catalog-content">
                    <div class="catalog-pill">
                        <i class="fas fa-file-download"></i> Request Now
                    </div>
                    <h2 class="catalog-title">Get Our Product<br>Catalog &amp; Pricing</h2>
                    <p class="catalog-sub">
                        Detailed specifications, bulk pricing and technical data sheets available on request.
                    </p>
                    <div class="catalog-btns">
                        @if($userdata->mobile ?? false)
                        <a href="tel:{{ $userdata->mobile }}" class="btn-cta-main">
                            <i class="fas fa-phone-alt"></i> Call: {{ $userdata->mobile }}
                        </a>
                        @endif
                        @if($userdata->email ?? false)
                        <a href="mailto:{{ $userdata->email }}" class="btn-cta-sec">
                            <i class="fas fa-envelope"></i> Email Inquiry
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ╔══════════════════════════════════════╗
         ║           SOCIAL LINKS               ║
         ╚══════════════════════════════════════╝ -->
    @if($social ?? false)
    @if(($social->facebook ?? false) || ($social->instagram ?? false) || ($social->linkedin ?? false) || ($social->twitter ?? false) || ($social->youtube ?? false))
    <div style="padding:0 2rem; margin-bottom:4rem;">
        <div style="max-width:1200px;margin:0 auto;">
            <div class="social-band reveal">
                <div class="sec-head" style="flex-direction:column;align-items:center;text-align:center;">
                    <div class="sec-icon" style="margin-bottom:.8rem;"><i class="fas fa-share-nodes"></i></div>
                    <h2 class="sec-title">Follow <span>Us</span></h2>
                </div>
                <div class="social-links">
                    @if($social->facebook ?? false)
                    <a href="{{ $social->facebook }}" target="_blank" class="social-link sl-fb" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if($social->instagram ?? false)
                    <a href="{{ $social->instagram }}" target="_blank" class="social-link sl-ig" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($social->linkedin ?? false)
                    <a href="{{ $social->linkedin }}" target="_blank" class="social-link sl-li" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    @endif
                    @if($social->twitter ?? false)
                    <a href="{{ $social->twitter }}" target="_blank" class="social-link sl-tw" title="Twitter/X">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    @endif
                    @if($social->youtube ?? false)
                    <a href="{{ $social->youtube }}" target="_blank" class="social-link sl-yt" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                    @if($social->whatsapp ?? false)
                    <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="social-link sl-wa" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif

    <!-- ╔══════════════════════════════════════╗
         ║              FOOTER                  ║
         ╚══════════════════════════════════════╝ -->
    <footer class="mfg-footer">
        <div class="inner">
            <div class="footer-brand">{{ $userdata->name ?? 'Industrial Co.' }}</div>
            <p>{{ $userdata->desig ?? 'Precision Manufacturing · Industrial Solutions' }}</p>
            <p style="margin-top:.5rem;">
                &copy; {{ date('Y') }} Digital Card by
                <a href="{{ url('/') }}">Fastap</a> · Professional Industrial Profiles
            </p>
        </div>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id   ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview      ?? false
    ])

    <script>
    // Intersection Observer — scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    revealEls.forEach(el => io.observe(el));
    </script>

</body>
</html>