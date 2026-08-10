<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Entertainment' }} - Artist Profile</title>

    @php
        use App\Models\TalentProfile;
        use App\Models\TalentPortfolio;
        use App\Models\TalentSocialStat;

        $websetting = App\Models\websetting::first();

        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile' => 1,
                'quali' => 1,
                'service' => 1,
                'thought' => 1,
                'personal' => 1,
                'profess' => 1,
                'videos' => 1,
                'product' => 1,
                'social_link' => 1,
                'upload_file' => 1,
                'client' => 1,
                'menu_section' => 1,
                'reservation_section' => 1,
                'property_listings' => 1,
                'showreel' => 1,
                'team_section' => 1,
                'pricing_section' => 1,
                'booking_section' => 1,
            ];
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client','menu_section','reservation_section','property_listings','showreel','team_section','pricing_section','booking_section'], 1);
            }
        }

        $themeColor = $theme->color ?? '#8b5cf6';

        $talentProfiles = collect();
        $defaultProfile = null;
        if (\Illuminate\Support\Facades\Schema::hasTable('talent_profiles')) {
            $talentProfiles = TalentProfile::getActiveProfilesForCustomer($userdata->id);
            $defaultProfile = TalentProfile::getDefaultProfile($userdata->id);
        }
        $selectedTalent = request()->get('talent', $defaultProfile->talent_type ?? ($talentProfiles->first()->talent_type ?? null));

        $talentPortfolios = collect();
        $talentSocialStats = collect();

        if ($selectedTalent && \Illuminate\Support\Facades\Schema::hasTable('talent_portfolio')) {
            $talentPortfolios = TalentPortfolio::where('customer_id', $userdata->id)
                ->byTalent($selectedTalent)
                ->active()
                ->ordered()
                ->get();
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('talent_social_stats')) {
            $talentSocialStats = TalentSocialStat::where('customer_id', $userdata->id)->get();
        }
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,700&family=Poppins:wght@300;400;500;600;700&family=Cinzel:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ============================================================
           DESIGN TOKENS
        ============================================================ */
        :root {
            --ent-gold:        #FFD700;
            --ent-gold-light:  #FFF0A0;
            --ent-gold-dim:    #B8960C;
            --ent-purple:      #8B5CF6;
            --ent-purple-deep: #6D28D9;
            --ent-pink:        #EC4899;
            --ent-pink-deep:   #BE185D;
            --ent-deep-purple: #4C1D95;
            --ent-dark:        #1A0B2E;
            --ent-bg:          #0A0412;
            --ent-card:        #160C28;
            --glass-bg:        rgba(22,12,40,0.72);
            --glass-border:    rgba(139,92,246,0.28);
            --glass-glow:      rgba(139,92,246,0.15);

            /* BG Images */
            --img-spotlight:   url('https://sspark.genspark.ai/cfimages?u1=iQuRsgM2Tcznpt3aeuDbMXxF6HwYpwu4jW%2BKciLtSGHJs9zBdtImVk6SMheYDwR7N5AMYULUHN8TWTXeQcyhFAa4SnM%2Fhd3R0RAdq7mWGQ61nA%3D%3D&u2=bIQq8j8lFEZtVAa0&width=2560');
            --img-purple-bokeh:url('https://sspark.genspark.ai/cfimages?u1=tmdxJORg%2BhO2TXR1s9e6f%2F7Pl%2FEngspgqXz7Z71adz%2BfwRKq9TMc7dr5Gub745p9etbZRB9m%2BrxGgkTOuyBx7z1A%2FuYqg2Mtf47Bta6G1dnb5ppwqHO2HFytyCrmPFBPARN%2F0B4EZ%2BNyvNGTzUFhzIx5wuVO&u2=tQnE20A%2BaIVxWygz&width=2560');
            --img-glitzy:      url('https://sspark.genspark.ai/cfimages?u1=%2FwsHHOu%2B2AqX7fhew4skysNlwKqG8b4fQ3gJ6QXVYc1a3YXMnIJSrPP4q4igw7jsh2C2uUG2TBHCwY46FJvcI4GhSxp1x4zXGOZm5lscrzuk0b0w4ZYhJDLQScAmG4f4uFLaT8GsPDhKjTXEhQ%3D%3D&u2=EdTNN9lgixBV3WBC&width=2560');
            --img-concert:     url('https://sspark.genspark.ai/cfimages?u1=WNodF5Qw%2BzYZQ2mDHoQRi88XknWTrqBGq1DbiP1PhdNHgNm7ZwcnCUxS7utJG2jf%2F2V9tKZfIvQfcAI9At4zilPsFWEeJ%2BDGU%2FMzQ6F5zqRMbyfaYPIZlp5P%2FVEdMXiYlfqkmPRQ5EUZ&u2=N05o2896nR754xq9&width=2560');
            --img-bokeh-mix:   url('https://sspark.genspark.ai/cfimages?u1=sfgfYhw9VstlcOPD9ghYhGqVlsJtm3QrtGHAdycJhp172ukhLeLLrqXOkNuYqs%2FJyHouS7cG3LIG8UvUS1ZQ6C7xc2iJgrJRJFOhrWJVXTusUouwhYDtDaJ3HBNEYZSBiPSm7UaO&u2=OGa3PCqGFnwQ5le%2B&width=2560');
            --img-percussion:  url('https://sspark.genspark.ai/cfimages?u1=HXyMkc5dZPhSPG5pgwa1pfWpxcswniWqjzi30Krv4lNe8IgVv6ByKIFh9%2FVcIMOLBtz0tg%2FkExIgTn5tDX%2FJOhGLVNQ42M%2BM7Nrp77sX1jm7iIoRI2NUmsNXO%2FJ3a1t05d0usLBG9xeqvga3IpkBJMEoSxiA4wFJdwYZBKZAvBV2Fn7Oktc%3D&u2=nn%2ByoEL2jhc3%2BWLA&width=2560');
            --img-particles:   url('https://sspark.genspark.ai/cfimages?u1=ZTPVd9y0JDmDBhODy0DuKxmSpNRXklFYmOI2BK%2BMl9elq14ImvXSNo5QW4hdTtApGR7rx4%2FblKLgyLEiHvcEROGOoKe6S122AMHtXbzQGQ%3D%3D&u2=mm%2BddXyQfNDF7PBl&width=2560');
        }

        /* ============================================================
           RESET & BASE
        ============================================================ */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--ent-bg);
            background-image:
                linear-gradient(to bottom,
                    rgba(10,4,18,0.94) 0%,
                    rgba(10,4,18,0.85) 40%,
                    rgba(10,4,18,0.92) 100%),
                var(--img-glitzy);
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            color: #E5E5E5;
            overflow-x: hidden;
        }

        /* ============================================================
           SCROLLBAR
        ============================================================ */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--ent-bg); }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(var(--ent-purple), var(--ent-pink));
            border-radius: 3px;
        }

        /* ============================================================
           PAGE WRAPPER
        ============================================================ */
        .page-wrapper {
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ============================================================
           STAGE CURTAINS
        ============================================================ */
        .stage-curtain-left {
            position: absolute;
            top: 0; left: 0;
            width: 200px; height: 500px;
            z-index: 50;
            pointer-events: none;
            filter: drop-shadow(4px 0 12px rgba(0,0,0,0.7));
        }
        .stage-curtain-right {
            position: absolute;
            top: 0; right: 0;
            width: 200px; height: 500px;
            z-index: 50;
            pointer-events: none;
            filter: drop-shadow(-4px 0 12px rgba(0,0,0,0.7));
        }

        /* ============================================================
           FLOATING DECORATIONS
        ============================================================ */
        .microphone-decoration {
            position: fixed;
            top: 120px; left: 5%;
            width: 100px; height: 100px;
            opacity: 0.18;
            z-index: 5;
            animation: float-mic 4s ease-in-out infinite;
            pointer-events: none;
            filter: drop-shadow(0 0 10px rgba(255,215,0,0.6));
        }
        @keyframes float-mic {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50%       { transform: translateY(-20px) rotate(5deg); }
        }

        .star-trophy-decoration {
            position: absolute;
            bottom: 200px; right: 5%;
            width: 150px; height: 150px;
            opacity: 0.22;
            z-index: 5;
            pointer-events: none;
            filter: drop-shadow(0 0 15px rgba(255,215,0,0.5));
        }

        /* ============================================================
           FLOATING GOLD PARTICLES (CSS-only canvas)
        ============================================================ */
        .particles-overlay {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }
        .gold-particle {
            position: absolute;
            width: 4px; height: 4px;
            background: var(--ent-gold);
            border-radius: 50%;
            opacity: 0;
            animation: particle-float linear infinite;
        }
        @keyframes particle-float {
            0%   { transform: translateY(100vh) scale(0); opacity: 0; }
            10%  { opacity: 0.7; }
            90%  { opacity: 0.4; }
            100% { transform: translateY(-10vh) scale(1.5); opacity: 0; }
        }

        /* ============================================================
           ENTERTAINMENT BANNER — real spotlight BG
        ============================================================ */
        .entertainment-banner {
            width: 100%;
            height: 500px;
            position: relative;
            overflow: hidden;
            margin: 0;

            background-image:
                linear-gradient(135deg,
                    rgba(76,29,149,0.82) 0%,
                    rgba(139,92,246,0.55) 40%,
                    rgba(236,72,153,0.65) 100%),
                var(--img-spotlight);
            background-size: cover;
            background-position: center 30%;
        }

        /* Shimmering gold top border */
        .entertainment-banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg,
                transparent 0%,
                var(--ent-gold) 20%,
                #fff 50%,
                var(--ent-gold) 80%,
                transparent 100%);
            animation: shimmer-bar 3s linear infinite;
            z-index: 10;
        }
        @keyframes shimmer-bar {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        /* Bottom fog fade */
        .entertainment-banner::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 160px;
            background: linear-gradient(to bottom, transparent, var(--ent-bg));
            z-index: 8;
        }

        /* Spotlight Beams */
        .spotlight-beam {
            position: absolute;
            width: 200px; height: 420px;
            background: linear-gradient(180deg, rgba(255,215,0,0.22) 0%, transparent 100%);
            transform-origin: top center;
            animation: spotlight-sweep 8s ease-in-out infinite;
            pointer-events: none;
        }
        .spotlight-beam:nth-child(1) { left: 10%; top: 0; animation-delay: 0s; }
        .spotlight-beam:nth-child(2) { left: 40%; top: 0; animation-delay: 2s; }
        .spotlight-beam:nth-child(3) { right: 10%; top: 0; animation-delay: 4s; }
        @keyframes spotlight-sweep {
            0%, 100% { transform: rotate(-12deg); opacity: 0.4; }
            50%       { transform: rotate(12deg);  opacity: 0.8; }
        }

        /* Star Particles in Banner */
        .banner-stars { position: absolute; inset: 0; opacity: 0.6; }
        .star-particle {
            position: absolute;
            width: 3px; height: 3px;
            background: var(--ent-gold);
            border-radius: 50%;
            animation: twinkle 3s ease-in-out infinite;
            box-shadow: 0 0 4px var(--ent-gold);
        }
        @keyframes twinkle {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50%       { opacity: 1;   transform: scale(2); }
        }

        /* Banner Center Branding Text */
        .banner-center-brand {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 9;
            pointer-events: none;
        }
        .banner-brand-star {
            font-size: 3.5rem;
            color: var(--ent-gold);
            display: block;
            animation: pulse-star 2s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(255,215,0,0.8);
            margin-bottom: 0.5rem;
        }
        @keyframes pulse-star {
            0%, 100% { transform: scale(1);    text-shadow: 0 0 20px rgba(255,215,0,0.6); }
            50%       { transform: scale(1.15); text-shadow: 0 0 50px rgba(255,215,0,1); }
        }
        .banner-brand-subtitle {
            font-family: 'Cinzel', serif;
            font-size: 1rem;
            letter-spacing: 0.5rem;
            color: rgba(255,255,255,0.75);
            text-transform: uppercase;
        }

        /* ============================================================
           DECORATIVE IMAGE STRIP (between banner & profile)
        ============================================================ */
        .image-strip-decoration {
            width: 100%;
            height: 120px;
            position: relative;
            z-index: 20;
            margin-top: -60px;
            overflow: hidden;
            display: flex;
        }
        .image-strip-panel {
            flex: 1;
            background-size: cover;
            background-position: center;
            opacity: 0.35;
            transition: opacity 0.4s;
            position: relative;
        }
        .image-strip-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                transparent 0%,
                rgba(10,4,18,0.8) 100%);
        }
        .image-strip-panel:hover { opacity: 0.6; }
        .strip-panel-1 { background-image: var(--img-concert); }
        .strip-panel-2 { background-image: var(--img-percussion); }
        .strip-panel-3 { background-image: var(--img-bokeh-mix); }
        .strip-panel-4 { background-image: var(--img-particles); }
        .strip-panel-5 { background-image: var(--img-purple-bokeh); }

        /* ============================================================
           PROFILE MAIN SECTION
        ============================================================ */
        .profile-main-section {
            max-width: 1200px;
            margin: -80px auto 3rem;
            padding: 0 2rem;
            position: relative;
            z-index: 100;
        }

        /* Profile Card — glassmorphism with bokeh BG */
        .profile-card-container {
            background:
                linear-gradient(135deg,
                    rgba(22,12,40,0.88) 0%,
                    rgba(76,29,149,0.30) 100%),
                var(--img-bokeh-mix);
            background-size: cover;
            background-position: center;
            border-radius: 30px;
            padding: 2.5rem;
            border: 1.5px solid rgba(255,215,0,0.2);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow:
                0 25px 70px rgba(0,0,0,0.6),
                0 0 0 1px rgba(139,92,246,0.15),
                inset 0 1px 0 rgba(255,255,255,0.05);
            position: relative;
            overflow: hidden;
        }

        /* Decorative corner accent images inside card */
        .profile-card-container::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 220px; height: 220px;
            background-image: var(--img-particles);
            background-size: cover;
            border-radius: 50%;
            opacity: 0.08;
            pointer-events: none;
        }
        .profile-card-container::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 160px; height: 160px;
            background-image: var(--img-purple-bokeh);
            background-size: cover;
            border-radius: 50%;
            opacity: 0.07;
            pointer-events: none;
        }

        /* Gold top accent line on card */
        .profile-card-gold-line {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg,
                transparent,
                var(--ent-gold) 30%,
                var(--ent-pink) 70%,
                transparent);
            border-radius: 30px 30px 0 0;
        }

        /* ============================================================
           PROFILE HEADER
        ============================================================ */
        .profile-header-flex {
            display: flex;
            align-items: flex-start;
            gap: 2.5rem;
            margin-bottom: 2rem;
        }

        /* Image Ring */
        .profile-image-container { flex-shrink: 0; position: relative; }

        .profile-image-ring {
            width: 180px; height: 180px;
            border-radius: 50%;
            background: conic-gradient(
                var(--ent-gold) 0deg 60deg,
                var(--ent-purple) 60deg 120deg,
                var(--ent-pink) 120deg 180deg,
                var(--ent-gold) 180deg 240deg,
                var(--ent-purple) 240deg 300deg,
                var(--ent-pink) 300deg 360deg
            );
            padding: 4px;
            animation: spin-ring 8s linear infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 40px rgba(255,215,0,0.35);
        }
        @keyframes spin-ring {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        .profile-img-starburst {
            width: 166px; height: 166px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--ent-dark);
            display: block;
            position: relative;
            z-index: 2;
        }

        .profile-img-placeholder-starburst {
            width: 166px; height: 166px;
            background: linear-gradient(135deg, var(--ent-gold), var(--ent-pink));
            border-radius: 50%;
            border: 4px solid var(--ent-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ent-dark);
            font-size: 4rem;
        }

        /* Online badge */
        .profile-online-badge {
            position: absolute;
            bottom: 8px; right: 8px;
            width: 20px; height: 20px;
            background: #22C55E;
            border-radius: 50%;
            border: 3px solid var(--ent-dark);
            z-index: 5;
            box-shadow: 0 0 8px rgba(34,197,94,0.7);
            animation: pulse-badge 2s ease-in-out infinite;
        }
        @keyframes pulse-badge {
            0%, 100% { box-shadow: 0 0 8px rgba(34,197,94,0.7); }
            50%       { box-shadow: 0 0 16px rgba(34,197,94,1); }
        }

        /* ============================================================
           PROFILE INFO
        ============================================================ */
        .profile-info-details { flex: 1; }

        .profile-name-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--ent-gold) 0%, #FFF0A0 50%, var(--ent-gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.4rem;
            line-height: 1.1;
            text-shadow: none;
        }

        .profile-verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(59,130,246,0.1));
            border: 1px solid rgba(59,130,246,0.4);
            border-radius: 20px;
            padding: 0.3rem 0.9rem;
            font-size: 0.8rem;
            color: #93C5FD;
            font-weight: 500;
            margin-bottom: 0.7rem;
        }

        .profile-designation-text {
            font-family: 'Cinzel', serif;
            font-size: 1.1rem;
            color: var(--ent-pink);
            font-weight: 600;
            letter-spacing: 0.08em;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .profile-bio-text {
            font-size: 0.98rem;
            color: #C4B5D4;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            border-left: 3px solid rgba(255,215,0,0.4);
            padding-left: 1rem;
            font-style: italic;
        }

        .profile-tags-wrapper {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .profile-tag {
            padding: 0.4rem 1rem;
            background: linear-gradient(135deg,
                rgba(255,215,0,0.12),
                rgba(139,92,246,0.12));
            border: 1px solid rgba(255,215,0,0.3);
            border-radius: 50px;
            font-size: 0.82rem;
            color: var(--ent-gold-light);
            font-weight: 500;
            backdrop-filter: blur(4px);
            transition: all 0.3s;
        }
        .profile-tag:hover {
            background: rgba(255,215,0,0.2);
            border-color: var(--ent-gold);
            transform: translateY(-2px);
        }

        /* ============================================================
           QUICK ACTIONS
        ============================================================ */
        .quick-actions-flex {
            display: flex;
            gap: 0.9rem;
            flex-wrap: wrap;
        }

        .action-btn-ent {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.85rem 1.7rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
            position: relative;
            overflow: hidden;
        }
        .action-btn-ent::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0.15);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s;
        }
        .action-btn-ent:hover::before { transform: scaleX(1); }

        .action-btn-gold {
            background: linear-gradient(135deg, var(--ent-gold), #E6B800);
            color: var(--ent-dark);
            box-shadow: 0 4px 20px rgba(255,215,0,0.35), inset 0 1px 0 rgba(255,255,255,0.3);
        }
        .action-btn-gold:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 30px rgba(255,215,0,0.55);
            color: var(--ent-dark);
            text-decoration: none;
        }
        .action-btn-purple {
            background: linear-gradient(135deg, var(--ent-purple), var(--ent-purple-deep));
            color: white;
            box-shadow: 0 4px 20px rgba(139,92,246,0.35), inset 0 1px 0 rgba(255,255,255,0.15);
        }
        .action-btn-purple:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 30px rgba(139,92,246,0.55);
            color: white;
            text-decoration: none;
        }
        .action-btn-pink {
            background: linear-gradient(135deg, var(--ent-pink), var(--ent-pink-deep));
            color: white;
            box-shadow: 0 4px 20px rgba(236,72,153,0.35), inset 0 1px 0 rgba(255,255,255,0.15);
        }
        .action-btn-pink:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 30px rgba(236,72,153,0.55);
            color: white;
            text-decoration: none;
        }

        /* ============================================================
           STATS ROW (in profile card)
        ============================================================ */
        .profile-mini-stats {
            display: flex;
            gap: 2rem;
            padding: 1.5rem 0;
            border-top: 1px solid rgba(255,215,0,0.12);
            border-bottom: 1px solid rgba(255,215,0,0.12);
            margin: 1.5rem 0;
            flex-wrap: wrap;
        }
        .mini-stat-item { text-align: center; }
        .mini-stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--ent-gold);
            line-height: 1;
        }
        .mini-stat-label {
            font-size: 0.75rem;
            color: #9CA3AF;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 0.25rem;
        }

        /* ============================================================
           SECTION TITLE
        ============================================================ */
        .section-title-ent {
            font-family: 'Cinzel', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--ent-gold);
            text-align: center;
            margin-bottom: 0.5rem;
            letter-spacing: 0.06em;
            position: relative;
            display: block;
        }
        .section-title-ent::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--ent-gold), transparent);
            margin: 0.7rem auto 2rem;
            border-radius: 2px;
        }

        /* Section wrapper */
        .section-header-wrapper {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }
        .section-header-wrapper .section-img-accent {
            display: inline-block;
            width: 320px;
            height: 60px;
            background-image: var(--img-bokeh-mix);
            background-size: cover;
            background-position: center;
            border-radius: 30px;
            opacity: 0.18;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: -8px;
            pointer-events: none;
        }

        /* ============================================================
           MULTI-TALENT SELECTOR
        ============================================================ */
        .talent-selector-section { margin: 3rem 0; }

        .talent-selector-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .talent-option-card {
            background:
                linear-gradient(135deg, rgba(22,12,40,0.85) 0%, rgba(76,29,149,0.3) 100%),
                var(--img-purple-bokeh);
            background-size: cover;
            background-position: center;
            border: 1.5px solid rgba(139,92,246,0.3);
            border-radius: 20px;
            padding: 1.8rem;
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .talent-option-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                rgba(255,215,0,0) 0%,
                rgba(255,215,0,0.08) 100%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .talent-option-card:hover { transform: translateY(-8px) scale(1.03); border-color: var(--ent-gold); box-shadow: 0 15px 40px rgba(255,215,0,0.25); }
        .talent-option-card:hover::before { opacity: 1; }
        .talent-option-card.active {
            border-color: var(--ent-gold);
            border-width: 2px;
            background:
                linear-gradient(135deg, rgba(255,215,0,0.12) 0%, rgba(139,92,246,0.25) 100%),
                var(--img-purple-bokeh);
            box-shadow: 0 0 30px rgba(255,215,0,0.3), inset 0 1px 0 rgba(255,215,0,0.2);
        }
        .talent-name-text { font-family: 'Cinzel', serif; font-size: 1.15rem; font-weight: 700; color: var(--ent-gold); margin-bottom: 0.4rem; }
        .talent-type-text { font-size: 0.9rem; color: #D1D5DB; }
        .talent-icon-wrapper { font-size: 3rem; margin-bottom: 1rem; }

        /* ============================================================
           CONTENT SECTION WRAPPER
        ============================================================ */
        .content-section {
            max-width: 1200px;
            margin: 3.5rem auto;
            padding: 0 2rem;
        }

        /* ============================================================
           DECORATIVE IMAGE BAND (between sections)
        ============================================================ */
        .section-img-band {
            width: 100%;
            height: 200px;
            position: relative;
            overflow: hidden;
            margin: 3rem 0;
        }
        .section-img-band-inner {
            width: 100%;
            height: 100%;
            background-image: var(--img-percussion);
            background-size: cover;
            background-position: center 40%;
            background-attachment: fixed;
            opacity: 0.25;
        }
        .section-img-band::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right,
                var(--ent-bg) 0%,
                transparent 20%,
                transparent 80%,
                var(--ent-bg) 100%);
            z-index: 2;
        }
        .section-img-band::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                var(--ent-bg) 0%,
                transparent 30%,
                transparent 70%,
                var(--ent-bg) 100%);
            z-index: 2;
        }
        .section-img-band-text {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
            font-family: 'Cinzel', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: rgba(255,215,0,0.12);
            letter-spacing: 0.5em;
            text-transform: uppercase;
            pointer-events: none;
        }

        /* ============================================================
           VIDEO SHOWREEL
        ============================================================ */
        .showreel-card {
            background:
                linear-gradient(135deg, rgba(22,12,40,0.92) 0%, rgba(76,29,149,0.35) 100%),
                var(--img-concert);
            background-size: cover;
            background-position: center;
            border-radius: 25px;
            padding: 2.5rem;
            border: 1.5px solid rgba(255,215,0,0.2);
            box-shadow: 0 20px 60px rgba(0,0,0,0.5),
                        0 0 0 1px rgba(139,92,246,0.1);
            position: relative;
            overflow: hidden;
        }
        .showreel-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg,
                transparent, var(--ent-gold) 30%, var(--ent-pink) 70%, transparent);
        }

        .showreel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .showreel-video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 15px;
            background: #000;
        }
        .showreel-video-container iframe,
        .showreel-video-container video {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
        }
        .showreel-thumbnail-link {
            position: relative;
            display: block;
            aspect-ratio: 16/9;
            border-radius: 15px;
            overflow: hidden;
            background: #000;
            text-decoration: none;
            transition: transform 0.3s;
        }
        .showreel-thumbnail-link:hover { transform: scale(1.02); }
        .showreel-thumbnail-link img { width: 100%; height: 100%; object-fit: cover; }

        .showreel-play-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.2);
            transition: background 0.3s;
        }
        .showreel-thumbnail-link:hover .showreel-play-overlay { background: rgba(0,0,0,0.35); }

        .showreel-play-btn {
            width: 70px; height: 70px;
            border-radius: 50%;
            background: rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid rgba(255,215,0,0.7);
            transition: all 0.3s;
            box-shadow: 0 0 25px rgba(255,215,0,0.4);
        }
        .showreel-thumbnail-link:hover .showreel-play-btn {
            background: var(--ent-gold);
            border-color: var(--ent-gold);
            transform: scale(1.1);
            box-shadow: 0 0 40px rgba(255,215,0,0.7);
        }
        .showreel-thumbnail-link:hover .showreel-play-btn i { color: var(--ent-dark) !important; }

        .showreel-title-overlay {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
            padding: 1rem 0.75rem 0.75rem;
        }

        /* ============================================================
           TIMELINE PORTFOLIO
        ============================================================ */
        .timeline-portfolio { position: relative; padding: 2rem 0; }
        .timeline-line {
            position: absolute;
            left: 50%; top: 0; bottom: 0;
            width: 3px;
            background: linear-gradient(180deg,
                var(--ent-gold), var(--ent-purple), var(--ent-pink), var(--ent-gold));
            transform: translateX(-50%);
            opacity: 0.6;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 3.5rem;
            display: flex;
            align-items: center;
        }
        .timeline-item:nth-child(odd)  { justify-content: flex-start; }
        .timeline-item:nth-child(even) { justify-content: flex-end; }

        .timeline-content {
            width: 45%;
            background:
                linear-gradient(135deg, rgba(22,12,40,0.92) 0%, rgba(76,29,149,0.35) 100%),
                var(--img-purple-bokeh);
            background-size: cover;
            background-position: center;
            border-radius: 22px;
            padding: 1.8rem;
            border: 1.5px solid rgba(139,92,246,0.25);
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }
        .timeline-content::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--ent-gold), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .timeline-item:nth-child(odd)  .timeline-content { margin-right: auto; }
        .timeline-item:nth-child(even) .timeline-content { margin-left: auto; }
        .timeline-content:hover {
            transform: scale(1.04);
            border-color: var(--ent-gold);
            box-shadow: 0 20px 50px rgba(255,215,0,0.2), 0 0 0 1px rgba(255,215,0,0.15);
        }
        .timeline-content:hover::before { opacity: 1; }

        .timeline-dot {
            position: absolute;
            left: 50%; top: 50%;
            transform: translate(-50%, -50%);
            width: 22px; height: 22px;
            background: var(--ent-gold);
            border-radius: 50%;
            border: 4px solid var(--ent-bg);
            box-shadow: 0 0 0 4px rgba(255,215,0,0.3), 0 0 20px rgba(255,215,0,0.5);
            z-index: 10;
        }

        .portfolio-item-img {
            width: 100%;
            height: 230px;
            object-fit: cover;
            border-radius: 14px;
            margin-bottom: 1rem;
            transition: transform 0.4s;
        }
        .timeline-content:hover .portfolio-item-img { transform: scale(1.03); }

        .portfolio-item-title { font-family: 'Cinzel', serif; font-size: 1.1rem; font-weight: 700; color: var(--ent-gold); margin-bottom: 0.5rem; }
        .portfolio-item-desc { font-size: 0.9rem; color: #C4B5D4; line-height: 1.6; }
        .portfolio-item-year {
            font-size: 0.82rem;
            color: var(--ent-purple);
            font-weight: 600;
            margin-top: 0.75rem;
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: rgba(139,92,246,0.15);
            border-radius: 20px;
            border: 1px solid rgba(139,92,246,0.3);
        }

        .portfolio-item-video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 14px;
            margin-bottom: 1rem;
            background: #000;
        }
        .portfolio-item-video-container iframe,
        .portfolio-item-video-container video {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
        }
        .portfolio-item-audio {
            width: 100%;
            margin-bottom: 1rem;
            border-radius: 12px;
        }

        /* ============================================================
           SOCIAL STATS GRID
        ============================================================ */
        .social-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .stat-card-ent {
            background:
                linear-gradient(135deg, rgba(22,12,40,0.88) 0%, rgba(139,92,246,0.2) 100%),
                var(--img-bokeh-mix);
            background-size: cover;
            background-position: center;
            border-radius: 22px;
            padding: 2.2rem 1.5rem;
            text-align: center;
            border: 1.5px solid rgba(139,92,246,0.25);
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            text-decoration: none;
            color: inherit;
            display: block;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        }
        .stat-card-ent::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--ent-gold), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .stat-card-ent:hover {
            transform: translateY(-8px) scale(1.03);
            border-color: var(--ent-gold);
            box-shadow: 0 20px 50px rgba(255,215,0,0.2), 0 0 0 1px rgba(255,215,0,0.15);
            text-decoration: none;
        }
        .stat-card-ent:hover::before { opacity: 1; }

        .stat-icon { font-size: 2.8rem; color: var(--ent-gold); margin-bottom: 1rem; }
        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
            line-height: 1;
        }
        .stat-label { font-size: 0.95rem; color: #C4B5D4; text-transform: capitalize; }
        .stat-verified { color: #60A5FA; margin-left: 0.4rem; }

        /* ============================================================
           BOOK CTA
        ============================================================ */
        .book-cta-section {
            background:
                linear-gradient(135deg,
                    rgba(76,29,149,0.90) 0%,
                    rgba(236,72,153,0.80) 100%),
                var(--img-spotlight);
            background-size: cover;
            background-position: center;
            border-radius: 30px;
            padding: 3.5rem 3rem;
            text-align: center;
            box-shadow:
                0 25px 70px rgba(139,92,246,0.35),
                0 0 0 1px rgba(255,215,0,0.2);
            border: 2px solid rgba(255,215,0,0.25);
            position: relative;
            overflow: hidden;
        }
        .book-cta-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg,
                transparent, var(--ent-gold), #fff, var(--ent-gold), transparent);
        }
        .book-cta-section::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg,
                transparent, var(--ent-gold), #fff, var(--ent-gold), transparent);
        }

        .book-cta-title {
            font-family: 'Cinzel', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 2px 20px rgba(0,0,0,0.5);
        }
        .book-cta-text {
            font-size: 1.15rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 2rem;
        }
        .book-btn-ent {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1.2rem 2.8rem;
            background: linear-gradient(135deg, var(--ent-gold), #E6B800);
            color: var(--ent-dark);
            border-radius: 50px;
            font-family: 'Cinzel', serif;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: 0 8px 30px rgba(255,215,0,0.45), inset 0 1px 0 rgba(255,255,255,0.3);
            letter-spacing: 0.05em;
        }
        .book-btn-ent:hover {
            background: linear-gradient(135deg, #FFF0A0, var(--ent-gold));
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 45px rgba(255,215,0,0.6);
            color: var(--ent-dark);
            text-decoration: none;
        }
        .book-quick-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        .quick-action-circular {
            width: 54px; height: 54px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1.3rem;
            transition: all 0.3s;
            border: 2px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(4px);
        }
        .quick-action-circular:hover {
            background: white;
            color: var(--ent-purple);
            transform: scale(1.15) rotate(-5deg);
        }

        /* ============================================================
           CONTACT
        ============================================================ */
        .contact-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .contact-card-ent {
            background:
                linear-gradient(135deg, rgba(22,12,40,0.90) 0%, rgba(76,29,149,0.30) 100%),
                var(--img-purple-bokeh);
            background-size: cover;
            background-position: center;
            border-radius: 22px;
            padding: 2rem 1.8rem;
            border: 1.5px solid rgba(139,92,246,0.25);
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        }
        .contact-card-ent:hover {
            border-color: var(--ent-gold);
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(255,215,0,0.2);
        }
        .contact-icon-wrapper {
            font-size: 2.5rem;
            color: var(--ent-gold);
            margin-bottom: 1rem;
            text-shadow: 0 0 15px rgba(255,215,0,0.5);
        }
        .contact-label-text { font-size: 0.82rem; color: #9CA3AF; margin-bottom: 0.4rem; text-transform: uppercase; letter-spacing: 0.1em; }
        .contact-value-text { font-size: 1.1rem; color: white; font-weight: 600; }
        .contact-value-text a { color: #A78BFA; text-decoration: none; transition: color 0.3s; }
        .contact-value-text a:hover { color: var(--ent-gold); }

        /* ============================================================
           SOCIAL LINKS
        ============================================================ */
        .social-links-section {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
            flex-wrap: wrap;
        }
        .social-link-btn {
            width: 64px; height: 64px;
            border-radius: 50%;
            background:
                linear-gradient(135deg, rgba(22,12,40,0.85), rgba(76,29,149,0.3)),
                var(--img-particles);
            background-size: cover;
            background-position: center;
            border: 1.5px solid rgba(139,92,246,0.3);
            color: var(--ent-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1.6rem;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: 0 4px 15px rgba(0,0,0,0.4);
        }
        .social-link-btn:hover {
            background: linear-gradient(135deg, var(--ent-gold), #E6B800);
            color: var(--ent-dark);
            transform: translateY(-8px) scale(1.15) rotate(-5deg);
            border-color: var(--ent-gold);
            box-shadow: 0 15px 35px rgba(255,215,0,0.45);
        }

        /* ============================================================
           FOOTER
        ============================================================ */
        .profile-footer {
            text-align: center;
            padding: 3rem 2rem;
            color: #4B5563;
            font-size: 0.88rem;
            position: relative;
            border-top: 1px solid rgba(139,92,246,0.1);
            background:
                linear-gradient(to top, rgba(10,4,18,0.98), transparent),
                var(--img-particles);
            background-size: cover;
            background-position: center;
        }
        .profile-footer a { color: var(--ent-purple); text-decoration: none; font-weight: 600; }
        .profile-footer a:hover { color: var(--ent-gold); }

        /* ============================================================
           PREVIEW BANNER
        ============================================================ */
        .preview-banner {
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
            color: white;
            padding: 12px 20px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 2px 12px rgba(0,0,0,0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .preview-banner a { color: white; text-decoration: underline; font-weight: 600; margin-left: 8px; }
        .preview-banner a:hover { color: #fbbf24; }

        /* ============================================================
           TRANSITIONS
        ============================================================ */
        .talent-content-section {
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }
        .talent-content-section.hiding { opacity: 0; }

        /* ============================================================
           DIVIDER ORNAMENT
        ============================================================ */
        .gold-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 3rem auto;
            max-width: 600px;
            padding: 0 2rem;
        }
        .gold-divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,215,0,0.4), transparent);
        }
        .gold-divider-icon {
            color: var(--ent-gold);
            font-size: 1.2rem;
            opacity: 0.6;
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 1024px) {
            .image-strip-panel:nth-child(4),
            .image-strip-panel:nth-child(5) { display: none; }
        }
        @media (max-width: 768px) {
            .entertainment-banner { height: 320px; }
            .stage-curtain-left, .stage-curtain-right { width: 100px; height: 300px; }
            .microphone-decoration { width: 60px; height: 60px; left: 3%; }
            .star-trophy-decoration { width: 80px; height: 80px; right: 3%; }
            .profile-main-section { margin-top: -50px; padding: 0 1rem; }
            .profile-card-container { padding: 1.5rem; }
            .profile-header-flex { flex-direction: column; align-items: center; text-align: center; }
            .profile-name-title { font-size: 2.2rem; }
            .profile-bio-text { border-left: none; padding-left: 0; }
            .quick-actions-flex { justify-content: center; }
            .section-title-ent { font-size: 1.6rem; }
            .timeline-line { left: 20px; }
            .timeline-item { justify-content: flex-end !important; }
            .timeline-content { width: calc(100% - 55px); margin-left: auto !important; }
            .timeline-dot { left: 20px; }
            .book-cta-title { font-size: 1.9rem; }
            .book-cta-section { padding: 2.5rem 1.5rem; }
            .talent-selector-grid { grid-template-columns: repeat(2, 1fr); }
            .profile-mini-stats { justify-content: center; }
            .image-strip-decoration { display: none; }
            .section-img-band { height: 120px; }
            .section-img-band-text { font-size: 2rem; }
            .showreel-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 480px) {
            .talent-selector-grid { grid-template-columns: 1fr; }
            .profile-mini-stats { gap: 1.5rem; }
            .book-cta-title { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> This is a preview.
        <a href="{{ url('/signin') }}">Sign up</a> to create your own professional profile!
    </div>
    @endif

    <!-- Floating Gold Particles -->
    <div class="particles-overlay" aria-hidden="true">
        <div class="gold-particle" style="left:5%;  width:3px; height:3px; animation-duration:12s; animation-delay:0s;"></div>
        <div class="gold-particle" style="left:12%; width:5px; height:5px; animation-duration:18s; animation-delay:2s;"></div>
        <div class="gold-particle" style="left:25%; width:2px; height:2px; animation-duration:14s; animation-delay:4s;"></div>
        <div class="gold-particle" style="left:38%; width:4px; height:4px; animation-duration:20s; animation-delay:1s;"></div>
        <div class="gold-particle" style="left:52%; width:3px; height:3px; animation-duration:16s; animation-delay:6s;"></div>
        <div class="gold-particle" style="left:65%; width:5px; height:5px; animation-duration:11s; animation-delay:3s;"></div>
        <div class="gold-particle" style="left:75%; width:2px; height:2px; animation-duration:19s; animation-delay:7s;"></div>
        <div class="gold-particle" style="left:88%; width:4px; height:4px; animation-duration:15s; animation-delay:5s;"></div>
        <div class="gold-particle" style="left:95%; width:3px; height:3px; animation-duration:13s; animation-delay:9s;"></div>
    </div>

    <div class="page-wrapper">
        <!-- Stage Curtain Left -->
        <div class="stage-curtain-left">
            <svg viewBox="0 0 200 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="lcl" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%" stop-color="#5B0000"/>
                        <stop offset="100%" stop-color="#9B0000"/>
                    </linearGradient>
                </defs>
                <path d="M0 0 Q50 250 0 500 L50 500 Q80 250 50 0 Z" fill="url(#lcl)" opacity="0.85"/>
                <path d="M50 0 Q80 250 50 500 L100 500 Q120 250 100 0 Z" fill="#A00000" opacity="0.75"/>
                <path d="M100 0 Q120 250 100 500 L150 500 Q160 250 150 0 Z" fill="#7B0000" opacity="0.70"/>
                <line x1="20" y1="0" x2="20" y2="80" stroke="#FFD700" stroke-width="2" opacity="0.8"/>
                <line x1="70" y1="0" x2="70" y2="80" stroke="#FFD700" stroke-width="2" opacity="0.8"/>
                <line x1="120" y1="0" x2="120" y2="80" stroke="#FFD700" stroke-width="2" opacity="0.8"/>
                <!-- Tassel decorations -->
                <circle cx="20" cy="82" r="5" fill="#FFD700" opacity="0.7"/>
                <circle cx="70" cy="82" r="5" fill="#FFD700" opacity="0.7"/>
                <circle cx="120" cy="82" r="5" fill="#FFD700" opacity="0.7"/>
            </svg>
        </div>

        <!-- Stage Curtain Right -->
        <div class="stage-curtain-right">
            <svg viewBox="0 0 200 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="rcl" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%" stop-color="#9B0000"/>
                        <stop offset="100%" stop-color="#5B0000"/>
                    </linearGradient>
                </defs>
                <path d="M200 0 Q150 250 200 500 L150 500 Q120 250 150 0 Z" fill="url(#rcl)" opacity="0.85"/>
                <path d="M150 0 Q120 250 150 500 L100 500 Q80 250 100 0 Z" fill="#A00000" opacity="0.75"/>
                <path d="M100 0 Q80 250 100 500 L50 500 Q40 250 50 0 Z" fill="#7B0000" opacity="0.70"/>
                <line x1="180" y1="0" x2="180" y2="80" stroke="#FFD700" stroke-width="2" opacity="0.8"/>
                <line x1="130" y1="0" x2="130" y2="80" stroke="#FFD700" stroke-width="2" opacity="0.8"/>
                <line x1="80"  y1="0" x2="80"  y2="80" stroke="#FFD700" stroke-width="2" opacity="0.8"/>
                <circle cx="180" cy="82" r="5" fill="#FFD700" opacity="0.7"/>
                <circle cx="130" cy="82" r="5" fill="#FFD700" opacity="0.7"/>
                <circle cx="80"  cy="82" r="5" fill="#FFD700" opacity="0.7"/>
            </svg>
        </div>

        <!-- Microphone Decoration -->
        <div class="microphone-decoration">
            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="42" y="20" width="16" height="30" rx="8" fill="#FFD700"/>
                <path d="M30 45 Q30 60 50 60 Q70 60 70 45" stroke="#FFD700" stroke-width="3" fill="none"/>
                <line x1="50" y1="60" x2="50" y2="75" stroke="#FFD700" stroke-width="3"/>
                <rect x="35" y="75" width="30" height="5" rx="2" fill="#FFD700"/>
            </svg>
        </div>

        <!-- Star Trophy Decoration -->
        <div class="star-trophy-decoration">
            <svg viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M40 40 L40 70 Q40 85 55 85 L95 85 Q110 85 110 70 L110 40 Z" fill="#FFD700" opacity="0.8"/>
                <rect x="65" y="85" width="20" height="25" fill="#FFD700" opacity="0.8"/>
                <ellipse cx="75" cy="110" rx="25" ry="8" fill="#FFD700" opacity="0.8"/>
                <path d="M75 10 L82 30 L103 30 L86 42 L93 62 L75 50 L57 62 L64 42 L47 30 L68 30 Z" fill="#FFC700"/>
            </svg>
        </div>

        <!-- =========================================================
             ENTERTAINMENT BANNER
        ========================================================= -->
        <section class="entertainment-banner">
            <div class="spotlight-beam"></div>
            <div class="spotlight-beam"></div>
            <div class="spotlight-beam"></div>

            <div class="banner-stars">
                @php
                $starPositions = [
                    ['top' => '15%', 'left' => '10%', 'delay' => '0s'],
                    ['top' => '25%', 'left' => '85%', 'delay' => '1s'],
                    ['top' => '45%', 'left' => '20%', 'delay' => '2s'],
                    ['top' => '60%', 'left' => '75%', 'delay' => '0.5s'],
                    ['top' => '80%', 'left' => '40%', 'delay' => '1.5s'],
                    ['top' => '20%', 'left' => '50%', 'delay' => '2.5s'],
                    ['top' => '70%', 'left' => '60%', 'delay' => '3s'],
                    ['top' => '35%', 'left' => '90%', 'delay' => '1.8s'],
                    ['top' => '55%', 'left' => '35%', 'delay' => '0.8s'],
                    ['top' => '10%', 'left' => '65%', 'delay' => '2.2s'],
                    ['top' => '88%', 'left' => '15%', 'delay' => '1.2s'],
                    ['top' => '42%', 'left' => '55%', 'delay' => '3.5s'],
                ];
                @endphp
                @foreach($starPositions as $star)
                    <div class="star-particle" style="top:{{ $star['top'] }};left:{{ $star['left'] }};animation-delay:{{ $star['delay'] }};"></div>
                @endforeach
            </div>

            <!-- Centre star brand mark -->
            <div class="banner-center-brand">
                <i class="fas fa-star banner-brand-star"></i>
                <span class="banner-brand-subtitle">Artist Profile</span>
            </div>
        </section>

        <!-- Decorative image strip -->
        <div class="image-strip-decoration" aria-hidden="true">
            <div class="image-strip-panel strip-panel-1"></div>
            <div class="image-strip-panel strip-panel-2"></div>
            <div class="image-strip-panel strip-panel-3"></div>
            <div class="image-strip-panel strip-panel-4"></div>
            <div class="image-strip-panel strip-panel-5"></div>
        </div>

        <!-- =========================================================
             PROFILE MAIN SECTION
        ========================================================= -->
        <div class="profile-main-section">
            <div class="profile-card-container">
                <!-- Gold accent line -->
                <div class="profile-card-gold-line"></div>

                <div class="profile-header-flex">
                    <!-- Profile Image with spinning ring -->
                    <div class="profile-image-container">
                        <div class="profile-image-ring">
                            @if($userdata->profile)
                                <img src="{{ url('public/frontend/user_images', $userdata->profile) }}"
                                     alt="{{ $userdata->name }}"
                                     class="profile-img-starburst">
                            @else
                                <div class="profile-img-placeholder-starburst">
                                    <i class="fas fa-star"></i>
                                </div>
                            @endif
                        </div>
                        <div class="profile-online-badge" title="Available for bookings"></div>
                    </div>

                    <div class="profile-info-details">
                        <!-- Verified badge -->
                        <div class="profile-verified-badge">
                            <i class="fas fa-check-circle"></i>
                            <span>Verified Artist Profile</span>
                        </div>

                        <h1 class="profile-name-title">{{ $userdata->name }}</h1>

                        @if($userdata->desig)
                            <p class="profile-designation-text">{{ $userdata->desig }}</p>
                        @endif

                        @if($professions->count() > 0 || $userdata->city)
                        <div class="profile-tags-wrapper">
                            @foreach($professions->take(3) as $profession)
                                @php $professionLabel = $profession->profession ?? $profession->title ?? ''; @endphp
                                @if($professionLabel !== '')
                                    <span class="profile-tag"><i class="fas fa-certificate" style="font-size:0.75rem;margin-right:3px;"></i>{{ $professionLabel }}</span>
                                @endif
                            @endforeach
                            @if($userdata->city)
                                <span class="profile-tag"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}</span>
                            @endif
                        </div>
                        @endif

                        @php $aboutText = $userdata->about ?? $userdata->title1 ?? ''; @endphp
                        @if($aboutText)
                            <p class="profile-bio-text">{{ $aboutText }}</p>
                        @endif

                        <div class="quick-actions-flex">
                            @if($userdata->mobile)
                                <a href="tel:{{ $userdata->mobile }}" class="action-btn-ent action-btn-gold">
                                    <i class="fas fa-phone"></i> Call Now
                                </a>
                            @endif
                            @if($social && $social->whatsapp)
                                <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="action-btn-ent action-btn-purple">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            @endif
                            @if($userdata->email)
                                <a href="mailto:{{ $userdata->email }}" class="action-btn-ent action-btn-pink">
                                    <i class="fas fa-envelope"></i> Email
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Mini Stats Row -->
                <div class="profile-mini-stats">
                    @if($talentPortfolios->count() > 0)
                    <div class="mini-stat-item">
                        <div class="mini-stat-value">{{ $talentPortfolios->count() }}</div>
                        <div class="mini-stat-label">Portfolio Items</div>
                    </div>
                    @endif
                    @if($videos->count() > 0)
                    <div class="mini-stat-item">
                        <div class="mini-stat-value">{{ $videos->count() }}</div>
                        <div class="mini-stat-label">Videos</div>
                    </div>
                    @endif
                    @if($talentSocialStats->count() > 0)
                    <div class="mini-stat-item">
                        <div class="mini-stat-value">{{ $talentSocialStats->count() }}</div>
                        <div class="mini-stat-label">Platforms</div>
                    </div>
                    @endif
                    @if($talentProfiles->count() > 0)
                    <div class="mini-stat-item">
                        <div class="mini-stat-value">{{ $talentProfiles->count() }}</div>
                        <div class="mini-stat-label">Talent Types</div>
                    </div>
                    @endif
                    <div class="mini-stat-item">
                        <div class="mini-stat-value"><i class="fas fa-star" style="font-size:1.4rem;"></i></div>
                        <div class="mini-stat-label">Available Now</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gold Divider -->
        <div class="gold-divider">
            <div class="gold-divider-line"></div>
            <i class="fas fa-star gold-divider-icon"></i>
            <div class="gold-divider-line"></div>
        </div>

        <!-- =========================================================
             MULTI-TALENT SELECTOR
        ========================================================= -->
        @if($talentProfiles->count() > 1)
        <section class="talent-selector-section">
            <div class="section-header-wrapper">
                <div class="section-img-accent"></div>
                <h3 class="section-title-ent">Switch Talent Profile</h3>
            </div>
            <div class="talent-selector-grid">
                @foreach($talentProfiles as $profile)
                    <div class="talent-option-card {{ $selectedTalent === $profile->talent_type ? 'active' : '' }}"
                         onclick="switchTalent('{{ $profile->talent_type }}')">
                        <div class="talent-icon-wrapper">{{ $profile->talent_icon }}</div>
                        <h4 class="talent-name-text">{{ $profile->talent_label }}</h4>
                    </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- =========================================================
             VIDEO SHOWREEL
        ========================================================= -->
        @if($userdata->isFeatureVisible('video_gallery') && $videos->count() > 0)
        <section class="content-section">
            <div class="section-header-wrapper">
                <div class="section-img-accent"></div>
                <h3 class="section-title-ent"><i class="fas fa-film" style="margin-right:.5rem;font-size:1.5rem;"></i>Video Showreel</h3>
            </div>
            <div class="showreel-card">
                <div class="showreel-grid">
                @foreach($videos->take(2) as $video)
                @php
                    $videoUrl = trim((string) ($video->video_link ?? $video->url ?? $video->name ?? ''));
                    $thumbUrl = '';
                    if ($videoUrl && preg_match('~(youtu\.be/|v=)([^&?/]{11})~', $videoUrl, $matches)) {
                        $thumbUrl = 'https://img.youtube.com/vi/' . $matches[2] . '/hqdefault.jpg';
                    }
                @endphp
                <a href="{{ $videoUrl }}" target="_blank" rel="noopener noreferrer" class="showreel-thumbnail-link">
                    @if($thumbUrl)
                        <img src="{{ $thumbUrl }}" alt="Showreel">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#111827 0%,#1f2937 100%);"></div>
                    @endif
                    <div class="showreel-play-overlay">
                        <span class="showreel-play-btn">
                            <i class="fas fa-play" style="color:#FFD700;margin-left:4px;font-size:1.4rem;"></i>
                        </span>
                    </div>
                    <div class="showreel-title-overlay">
                        <span style="font-size:0.9rem;color:#f8fafc;font-weight:600;letter-spacing:0.02em;">
                            <i class="fas fa-play-circle" style="margin-right:5px;color:var(--ent-gold);"></i>
                            {{ $video->title ?? 'Watch on YouTube' }}
                        </span>
                    </div>
                </a>
                @endforeach
                </div>
            </div>
        </section>

        <!-- Decorative image band after showreel -->
        <div class="section-img-band" aria-hidden="true">
            <div class="section-img-band-inner"></div>
            <div class="section-img-band-text">ENTERTAINMENT</div>
        </div>
        @endif

        <!-- =========================================================
             TALENT PORTFOLIO (Timeline)
        ========================================================= -->
        @if($selectedTalent && $talentPortfolios->count() > 0)
        <section class="content-section talent-content-section" id="talent-portfolio">
            <div class="section-header-wrapper">
                <div class="section-img-accent"></div>
                <h3 class="section-title-ent">
                    @if($selectedTalent === 'actor') <i class="fas fa-film" style="margin-right:.4rem;"></i>Filmography
                    @elseif($selectedTalent === 'model') <i class="fas fa-camera" style="margin-right:.4rem;"></i>Portfolio
                    @elseif($selectedTalent === 'singer') <i class="fas fa-music" style="margin-right:.4rem;"></i>Music Collection
                    @elseif($selectedTalent === 'dancer') <i class="fas fa-compact-disc" style="margin-right:.4rem;"></i>Performance Gallery
                    @else <i class="fas fa-star" style="margin-right:.4rem;"></i>Portfolio
                    @endif
                </h3>
            </div>
            <div class="timeline-portfolio">
                <div class="timeline-line"></div>

                @php
                    $allPortfolios = $talentPortfolios;
                @endphp

                @foreach($allPortfolios as $index => $item)
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        @if($item->media_type == 'image' && $item->media_url)
                            <img src="{{ $item->media_url_full }}"
                                 alt="{{ $item->title }}"
                                 class="portfolio-item-img">
                        @elseif($item->media_type == 'video' && $item->media_url)
                            <div class="portfolio-item-video-container">
                                @if(str_contains($item->media_url, 'youtube.com') || str_contains($item->media_url, 'youtu.be'))
                                    @php
                                        $videoId = '';
                                        if(str_contains($item->media_url, 'youtube.com')) {
                                            parse_str(parse_url($item->media_url, PHP_URL_QUERY) ?? '', $params);
                                            $videoId = $params['v'] ?? '';
                                        } elseif(str_contains($item->media_url, 'youtu.be')) {
                                            $videoId = basename(parse_url($item->media_url, PHP_URL_PATH) ?? '');
                                        }
                                    @endphp
                                    @if($videoId)
                                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    @endif
                                @else
                                    <video controls>
                                        <source src="{{ $item->media_url_full }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        @elseif($item->media_type == 'audio' && $item->media_url)
                            <audio controls class="portfolio-item-audio">
                                <source src="{{ $item->media_url_full }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @endif

                        @if($item->title)
                            <h4 class="portfolio-item-title">{{ $item->title }}</h4>
                        @endif
                        @if($item->description)
                            <p class="portfolio-item-desc">{{ $item->description }}</p>
                        @endif
                        @if($item->year)
                            <p class="portfolio-item-year"><i class="fas fa-calendar-alt" style="margin-right:4px;"></i>{{ $item->year }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Fallback: Old Portfolio -->
        @if($selectedTalent === null && $userdata->isFeatureVisible('portfolio') && $portfolios->count() > 0)
        <section class="content-section">
            <div class="section-header-wrapper">
                <div class="section-img-accent"></div>
                <h3 class="section-title-ent"><i class="fas fa-images" style="margin-right:.4rem;"></i>Portfolio</h3>
            </div>
            <div class="timeline-portfolio">
                <div class="timeline-line"></div>
                @foreach($portfolios->take(6) as $index => $portfolio)
                    @php $images = json_decode($portfolio->image, true); @endphp
                    @if($images && count($images) > 0)
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <img src="{{ url('public/frontend/portfolio/' . $images[0]) }}"
                                 alt="Portfolio Item"
                                 class="portfolio-item-img">
                            @if($portfolio->title)
                                <h4 class="portfolio-item-title">{{ $portfolio->title }}</h4>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </section>
        @endif

        <!-- =========================================================
             SOCIAL STATS
        ========================================================= -->
        @if($talentSocialStats->count() > 0)
        <section class="content-section talent-content-section" id="social-stats">
            <div class="section-header-wrapper">
                <div class="section-img-accent"></div>
                <h3 class="section-title-ent"><i class="fas fa-chart-line" style="margin-right:.4rem;"></i>Social Media Reach</h3>
            </div>
            <div class="social-stats-grid">
                @foreach($talentSocialStats as $stat)
                <a href="{{ $stat->platform_url }}" target="_blank" class="stat-card-ent">
                    <div class="stat-icon"><i class="{{ $stat->platform_icon }}"></i></div>
                    <div class="stat-value">
                        {{ $stat->formatted_followers }}
                        @if($stat->is_verified)
                        <i class="fas fa-check-circle stat-verified" title="Verified"></i>
                        @endif
                    </div>
                    <div class="stat-label">{{ ucfirst($stat->platform) }}</div>
                </a>
                @endforeach
            </div>
        </section>

        <!-- Divider -->
        <div class="gold-divider">
            <div class="gold-divider-line"></div>
            <i class="fas fa-music gold-divider-icon"></i>
            <div class="gold-divider-line"></div>
        </div>
        @endif

        <!-- =========================================================
             BOOK / CTA
        ========================================================= -->
        @if($selectedTalent)
        <section class="content-section talent-content-section" id="book-cta">
            <div class="book-cta-section">
                <i class="fas fa-star" style="font-size:3rem;margin-bottom:1.2rem;opacity:0.95;color:var(--ent-gold);text-shadow:0 0 20px rgba(255,215,0,0.7);display:block;"></i>
                <h3 class="book-cta-title">
                    Book This
                    @if($selectedTalent === 'actor') Actor
                    @elseif($selectedTalent === 'model') Model
                    @elseif($selectedTalent === 'singer') Singer
                    @elseif($selectedTalent === 'dancer') Dancer
                    @else Talent
                    @endif
                </h3>
                <p class="book-cta-text">
                    @if($selectedTalent === 'actor') Available for films, shows, and commercial projects
                    @elseif($selectedTalent === 'model') Available for photoshoots, runway, and brand campaigns
                    @elseif($selectedTalent === 'singer') Available for concerts, events, and studio sessions
                    @elseif($selectedTalent === 'dancer') Available for performances, events, and choreography
                    @else Available for professional bookings and collaborations
                    @endif
                </p>
                @php
                    $bookingUrl = $userdata->mobile ? 'tel:' . $userdata->mobile : ($userdata->email ? 'mailto:' . $userdata->email : '#');
                @endphp
                <a href="{{ $bookingUrl }}" class="book-btn-ent">
                    <i class="fas fa-calendar-check"></i> Book Now
                </a>
                <div class="book-quick-actions">
                    @if($userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="quick-action-circular" title="Call">
                        <i class="fas fa-phone"></i>
                    </a>
                    @endif
                    @if($social && $social->whatsapp)
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="quick-action-circular" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    @endif
                    @if($userdata->email)
                    <a href="mailto:{{ $userdata->email }}" class="quick-action-circular" title="Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                    @endif
                </div>
            </div>
        </section>
        @else
        <section class="content-section">
            <div class="book-cta-section">
                <i class="fas fa-calendar-star" style="font-size:3rem;margin-bottom:1.2rem;opacity:0.95;color:var(--ent-gold);display:block;"></i>
                <h3 class="book-cta-title">Ready to Collaborate?</h3>
                <p class="book-cta-text">Book {{ $userdata->name }} for your next project or event</p>
                @if($userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="book-btn-ent">
                        <i class="fas fa-calendar-check"></i> Book Now
                    </a>
                @elseif($userdata->email)
                    <a href="mailto:{{ $userdata->email }}" class="book-btn-ent">
                        <i class="fas fa-calendar-check"></i> Book Now
                    </a>
                @endif
            </div>
        </section>
        @endif

        <!-- =========================================================
             CONTACT
        ========================================================= -->
        <section class="content-section">
            <div class="section-header-wrapper">
                <div class="section-img-accent"></div>
                <h3 class="section-title-ent"><i class="fas fa-address-card" style="margin-right:.4rem;"></i>Get In Touch</h3>
            </div>
            <div class="contact-info-grid">
                @if($userdata->mobile)
                <div class="contact-card-ent">
                    <div class="contact-icon-wrapper"><i class="fas fa-phone"></i></div>
                    <div class="contact-label-text">Phone</div>
                    <div class="contact-value-text"><a href="tel:{{ $userdata->mobile }}">{{ $userdata->mobile }}</a></div>
                </div>
                @endif
                @if($userdata->email)
                <div class="contact-card-ent">
                    <div class="contact-icon-wrapper"><i class="fas fa-envelope"></i></div>
                    <div class="contact-label-text">Email</div>
                    <div class="contact-value-text"><a href="mailto:{{ $userdata->email }}">{{ $userdata->email }}</a></div>
                </div>
                @endif
                @if($userdata->city)
                <div class="contact-card-ent">
                    <div class="contact-icon-wrapper"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="contact-label-text">Location</div>
                    <div class="contact-value-text">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div>
                </div>
                @endif
            </div>
        </section>

        <!-- =========================================================
             SOCIAL LINKS
        ========================================================= -->
        @if($social)
        <section class="content-section">
            <div class="section-header-wrapper">
                <div class="section-img-accent"></div>
                <h3 class="section-title-ent"><i class="fas fa-share-alt" style="margin-right:.4rem;"></i>Connect With Me</h3>
            </div>
            <div class="social-links-section">
                @if($social->facebook)
                    <a href="{{ $social->facebook }}" class="social-link-btn" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if($social->instagram)
                    <a href="{{ $social->instagram }}" class="social-link-btn" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                @endif
                @if($social->youtube)
                    <a href="{{ $social->youtube }}" class="social-link-btn" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                @endif
                @if($social->twitter)
                    <a href="{{ $social->twitter }}" class="social-link-btn" target="_blank" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                @endif
                @if($social->linkedin)
                    <a href="{{ $social->linkedin }}" class="social-link-btn" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if($social->spotify ?? false)
                    <a href="{{ $social->spotify }}" class="social-link-btn" target="_blank" title="Spotify"><i class="fab fa-spotify"></i></a>
                @endif
                @if($social->tiktok ?? false)
                    <a href="{{ $social->tiktok }}" class="social-link-btn" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
                @endif
            </div>
        </section>
        @endif

        <!-- Final divider -->
        <div class="gold-divider">
            <div class="gold-divider-line"></div>
            <i class="fas fa-star gold-divider-icon"></i>
            <i class="fas fa-star gold-divider-icon" style="font-size:.7rem;opacity:.4;"></i>
            <i class="fas fa-star gold-divider-icon"></i>
            <div class="gold-divider-line"></div>
        </div>
    </div>

    <footer class="profile-footer">
        <p style="margin-bottom:.5rem;">
            <i class="fas fa-star" style="color:var(--ent-gold);opacity:.4;margin-right:.3rem;font-size:.7rem;"></i>
            Portfolio by <a href="{{ url('/') }}">Fastap</a>
            <i class="fas fa-star" style="color:var(--ent-gold);opacity:.4;margin-left:.3rem;font-size:.7rem;"></i>
        </p>
    </footer>

    <!-- =========================================================
         JAVASCRIPT
    ========================================================= -->
    <script>
        // Parallax — star trophy
        window.addEventListener('scroll', function () {
            const scrolled = window.pageYOffset;
            const starTrophy = document.querySelector('.star-trophy-decoration');
            if (starTrophy) {
                starTrophy.style.transform = 'translateY(' + (scrolled * 0.3) + 'px)';
            }
        });

        // Talent switching
        let currentTalent = '{{ $selectedTalent }}';

        function switchTalent(talentType) {
            if (currentTalent === talentType) return;
            document.querySelectorAll('.talent-content-section').forEach(s => s.classList.add('hiding'));
            const url = new URL(window.location);
            url.searchParams.set('talent', talentType);
            setTimeout(() => { window.location.href = url.toString(); }, 300);
            currentTalent = talentType;
        }

        window.addEventListener('popstate', function () { window.location.reload(); });

        // Intersection Observer — fade-in sections on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.content-section, .profile-card-container, .stat-card-ent, .contact-card-ent, .talent-option-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>

    @include('components.profile-location-tracker', ['customerId' => $userdata->id ?? null, 'profileSlug' => $userdata->slug ?? null, 'isPreview' => $isPreview ?? false])
</body>
</html>