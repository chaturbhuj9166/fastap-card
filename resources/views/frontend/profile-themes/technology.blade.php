<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Tech' }} - Technology Solutions</title>

    @php
        $websetting = App\Models\websetting::first();
        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile'=>1,'quali'=>1,'service'=>1,'thought'=>1,'personal'=>1,
                'profess'=>1,'videos'=>1,'product'=>1,'social_link'=>1,'upload_file'=>1,
                'client'=>1,'menu_section'=>1,'reservation_section'=>1,'property_listings'=>1,
                'showreel'=>1,'team_section'=>1,'pricing_section'=>1,'booking_section'=>1,
            ];
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client','menu_section','reservation_section','property_listings','showreel','team_section','pricing_section','booking_section'], 1);
            }
        }
        $themeColor = $theme->color ?? '#06b6d4';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600&family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ═══════════════════════════════════════════
           IT DARK COMMAND CENTER — COLOR SYSTEM
        ═══════════════════════════════════════════ */
        :root {
            --bg:        #030712;
            --bg-1:      #0d1117;
            --bg-2:      #161b22;
            --bg-3:      #1e2530;
            --cyan:      #00d4ff;
            --cyan-dim:  rgba(0,212,255,0.15);
            --cyan-glow: 0 0 20px rgba(0,212,255,0.3);
            --green:     #00ff88;
            --green-dim: rgba(0,255,136,0.12);
            --purple:    #a855f7;
            --purple-dim:rgba(168,85,247,0.15);
            --amber:     #f59e0b;
            --border:    rgba(0,212,255,0.18);
            --border-s:  rgba(255,255,255,0.06);
            --text-1:    #f0f6fc;
            --text-2:    #8b949e;
            --text-3:    #484f58;
            --mono:      'IBM Plex Mono', monospace;
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background: var(--bg);
            color: var(--text-1);
            overflow-x: hidden;
        }

        /* Body grid pattern overlay */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(0,212,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,212,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none; z-index: 0;
        }

        /* ═══════════════════════════════════════════
           PREVIEW BANNER
        ═══════════════════════════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg, #7c3aed, #0ea5e9);
            color: white; padding: 11px 20px;
            text-align: center; font-size: 13px; font-weight: 500;
            position: sticky; top: 0; z-index: 2000;
        }
        .preview-banner a { color: #fcd34d; text-decoration: underline; font-weight: 700; margin-left: 8px; }

        /* ═══════════════════════════════════════════
           STICKY LEFT SIDEBAR
        ═══════════════════════════════════════════ */
        .site-layout {
            display: flex;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .sidebar {
            width: 300px;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            background: var(--bg-1);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 100;
        }
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

        /* Sidebar top: logo/name strip */
        .sb-top {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--border-s);
        }
        .sb-logo-line {
            display: flex; align-items: center; gap: 10px;
            font-family: var(--mono); font-size: 11px;
            color: var(--cyan); letter-spacing: 2px;
            text-transform: uppercase; margin-bottom: 20px;
        }
        .sb-logo-dot { width:8px; height:8px; background:var(--cyan); border-radius:50%; animation: sb-blink 2s ease-in-out infinite; }
        @keyframes sb-blink { 0%,100%{opacity:1} 50%{opacity:.2} }

        /* Photo */
        .sb-photo-wrap {
            position: relative;
            width: 110px; height: 110px;
            margin: 0 auto 18px;
        }
        .sb-photo-ring {
            width: 110px; height: 110px;
            border-radius: 50%; padding: 3px;
            background: conic-gradient(var(--cyan), var(--purple), var(--green), var(--cyan));
            animation: spin-ring 6s linear infinite;
        }
        @keyframes spin-ring { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
        .sb-photo-inner {
            width: 100%; height: 100%;
            border-radius: 50%; overflow: hidden;
            background: var(--bg-2); border: 2px solid var(--bg-1);
        }
        .sb-photo-inner img { width:100%; height:100%; object-fit:cover; }
        .sb-photo-placeholder {
            width:100%; height:100%; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            background: var(--bg-2); color: var(--cyan); font-size: 36px;
        }
        .sb-online {
            position: absolute; bottom: 6px; right: 6px;
            width: 16px; height: 16px; background: var(--green);
            border-radius: 50%; border: 2px solid var(--bg-1);
            box-shadow: 0 0 8px var(--green);
        }

        .sb-name {
            font-size: 18px; font-weight: 800;
            color: var(--text-1); text-align: center;
            margin-bottom: 4px;
        }
        .sb-desig {
            font-family: var(--mono); font-size: 11px;
            color: var(--cyan); text-align: center;
            letter-spacing: 1px; margin-bottom: 16px;
        }
        .sb-desig::before { content: '> '; opacity: .6; }

        .sb-location {
            display: flex; align-items: center; justify-content: center;
            gap: 6px; font-size: 12px; color: var(--text-2);
        }
        .sb-location i { color: var(--cyan); font-size: 10px; }

        /* Sidebar nav */
        .sb-nav { padding: 16px 16px; flex: 1; }
        .sb-nav-label {
            font-family: var(--mono); font-size: 10px;
            color: var(--text-3); letter-spacing: 2px;
            text-transform: uppercase; padding: 0 8px;
            margin-bottom: 8px;
        }
        .sb-nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 8px;
            color: var(--text-2); text-decoration: none;
            font-size: 13px; font-weight: 500;
            transition: all .25s; margin-bottom: 2px;
            border: 1px solid transparent;
        }
        .sb-nav-item i { width: 16px; color: var(--text-3); font-size: 12px; }
        .sb-nav-item:hover { background: var(--cyan-dim); color: var(--cyan); border-color: var(--border); }
        .sb-nav-item:hover i { color: var(--cyan); }

        /* Sidebar action btns */
        .sb-actions { padding: 16px 16px; border-top: 1px solid var(--border-s); }
        .sb-btn {
            display: flex; align-items: center; justify-content: center;
            gap: 8px; width: 100%; padding: 11px;
            border-radius: 8px; text-decoration: none;
            font-size: 13px; font-weight: 700;
            font-family: var(--mono); letter-spacing: .5px;
            transition: all .3s; margin-bottom: 8px;
        }
        .sb-btn-cyan { background: var(--cyan); color: var(--bg); }
        .sb-btn-cyan:hover { background: #00bcee; box-shadow: var(--cyan-glow); transform:translateY(-1px); color:var(--bg); }
        .sb-btn-outline { background: transparent; color: var(--cyan); border: 1px solid var(--border); }
        .sb-btn-outline:hover { border-color: var(--cyan); background: var(--cyan-dim); color: var(--cyan); }
        .sb-btn-green { background: var(--green-dim); color: var(--green); border: 1px solid rgba(0,255,136,0.25); }
        .sb-btn-green:hover { background: rgba(0,255,136,0.2); color: var(--green); }

        /* Sidebar social */
        .sb-social { display:flex; gap:8px; justify-content:center; flex-wrap:wrap; margin-top:12px; }
        .sb-soc-btn {
            width:36px; height:36px; border-radius:8px;
            background: var(--bg-3); border: 1px solid var(--border-s);
            display:flex; align-items:center; justify-content:center;
            color: var(--text-2); font-size:13px; text-decoration:none;
            transition:all .25s;
        }
        .sb-soc-btn:hover { background:var(--cyan-dim); border-color:var(--border); color:var(--cyan); transform:translateY(-2px); }

        /* ═══════════════════════════════════════════
           MAIN CONTENT AREA
        ═══════════════════════════════════════════ */
        .main-content {
            flex: 1;
            overflow: hidden;
        }

        /* ─── HERO PANEL ─── */
        .hero-panel {
            position: relative;
            min-height: 520px;
            overflow: hidden;
            display: flex; align-items: flex-end;
            background-image:
                linear-gradient(to right, rgba(3,7,18,0.97) 0%, rgba(3,7,18,0.80) 50%, rgba(3,7,18,0.60) 100%),
                url('https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=1920&q=85');
            background-size: cover; background-position: center;
        }

        /* Scanline effect */
        .hero-scanline {
            position: absolute; inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,212,255,0.012) 2px,
                rgba(0,212,255,0.012) 4px
            );
            pointer-events: none; z-index: 2;
            animation: scan-drift 8s linear infinite;
        }
        @keyframes scan-drift { from{background-position:0 0} to{background-position:0 100px} }

        /* Data particle overlay */
        .hero-particles {
            position: absolute; inset: 0; z-index: 1;
            background-image:
                radial-gradient(circle at 80% 20%, rgba(0,212,255,0.08) 0%, transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(168,85,247,0.08) 0%, transparent 50%);
        }

        .hero-inner {
            position: relative; z-index: 5;
            padding: 60px 52px 52px;
            max-width: 800px;
        }

        .hero-status {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 6px 16px;
            background: rgba(0,255,136,0.10);
            border: 1px solid rgba(0,255,136,0.3);
            border-radius: 4px; margin-bottom: 24px;
            font-family: var(--mono); font-size: 11px;
            color: var(--green); letter-spacing: 2px; text-transform: uppercase;
        }
        .hero-status-dot { width:6px; height:6px; background:var(--green); border-radius:50%; animation: pulse-dot 2s ease-in-out infinite; box-shadow:0 0 6px var(--green); }
        @keyframes pulse-dot { 0%,100%{opacity:1} 50%{opacity:.2} }

        .hero-title {
            font-size: clamp(36px, 5vw, 64px);
            font-weight: 800; color: var(--text-1);
            line-height: 1.05; margin-bottom: 14px;
            letter-spacing: -1px;
        }
        .hero-title .hl-cyan { color: var(--cyan); }
        .hero-title .hl-fade { color: var(--text-2); font-weight: 300; }

        .hero-desig {
            font-family: var(--mono); font-size: 14px;
            color: var(--cyan); letter-spacing: 3px;
            text-transform: uppercase; margin-bottom: 22px;
            opacity: .85;
        }
        .hero-desig::before { content: '$ '; opacity: .5; }

        .hero-desc {
            font-size: 15px; color: var(--text-2);
            line-height: 1.85; max-width: 560px; margin-bottom: 32px;
        }

        .hero-ctas { display:flex; flex-wrap:wrap; gap:12px; margin-bottom:40px; }
        .hcta-primary {
            display:inline-flex; align-items:center; gap:9px;
            padding:14px 28px; background:var(--cyan); color:var(--bg);
            font-size:13px; font-weight:700; font-family:var(--mono);
            border-radius:6px; text-decoration:none; transition:all .3s;
            box-shadow: 0 4px 20px rgba(0,212,255,0.3);
            letter-spacing:.5px;
        }
        .hcta-primary:hover { background:#00bcee; transform:translateY(-2px); box-shadow:var(--cyan-glow); color:var(--bg); }
        .hcta-ghost {
            display:inline-flex; align-items:center; gap:9px;
            padding:13px 24px; background:transparent; color:var(--text-1);
            font-size:13px; font-weight:600; font-family:var(--mono);
            border:1px solid var(--border-s); border-radius:6px;
            text-decoration:none; transition:all .3s; letter-spacing:.5px;
        }
        .hcta-ghost:hover { border-color:var(--cyan); color:var(--cyan); background:var(--cyan-dim); }
        .hcta-wa {
            display:inline-flex; align-items:center; gap:9px;
            padding:13px 24px; background:rgba(0,255,136,0.10);
            color:var(--green); font-size:13px; font-weight:600;
            font-family:var(--mono); border:1px solid rgba(0,255,136,0.3);
            border-radius:6px; text-decoration:none; transition:all .3s; letter-spacing:.5px;
        }
        .hcta-wa:hover { background:rgba(0,255,136,0.18); color:var(--green); }

        /* Stat bar at hero bottom */
        .hero-stat-bar {
            display:flex; gap:0;
            background: rgba(13,17,23,0.85);
            border:1px solid var(--border);
            border-radius:8px; overflow:hidden;
            backdrop-filter:blur(12px); max-width:600px;
        }
        .hsb-item {
            flex:1; padding:16px 18px; text-align:center;
            border-right:1px solid var(--border-s);
        }
        .hsb-item:last-child { border-right:none; }
        .hsb-num { font-family:var(--mono); font-size:26px; font-weight:600; color:var(--cyan); line-height:1; margin-bottom:4px; }
        .hsb-label { font-size:9px; color:var(--text-2); text-transform:uppercase; letter-spacing:1.5px; }

        /* ═══════════════════════════════════════════
           SECTION CONTAINER
        ═══════════════════════════════════════════ */
        .sections-wrap { padding: 0 52px 80px; }

        /* Section heading */
        .sec-heading {
            display: flex; align-items: center; gap: 16px;
            margin: 64px 0 32px;
        }
        .sec-h-line { flex:1; height:1px; background:linear-gradient(90deg, var(--border), transparent); }
        .sec-h-label {
            font-family: var(--mono); font-size: 11px;
            color: var(--cyan); letter-spacing: 3px; text-transform: uppercase;
        }
        .sec-h-label::before { content: '//  '; opacity: .5; }
        .sec-title {
            font-size: clamp(22px,3vw,32px); font-weight: 800;
            color: var(--text-1); margin: 0 0 6px;
        }
        .sec-subtitle { font-size: 14px; color: var(--text-2); }

        /* ═══════════════════════════════════════════
           SERVICES — Dark bg with server room image
        ═══════════════════════════════════════════ */
        .services-panel {
            border-radius: 16px; overflow: hidden;
            position: relative;
            background-image:
                linear-gradient(135deg, rgba(3,7,18,0.96) 0%, rgba(13,17,23,0.93) 100%),
                url('https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=1920&q=80');
            background-size: cover; background-position: center;
            border: 1px solid var(--border);
            padding: 44px 40px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.5);
        }
        .services-panel::before {
            content:''; position:absolute; top:0;left:0;right:0; height:2px;
            background:linear-gradient(90deg, var(--cyan), var(--purple), var(--green), var(--cyan));
            background-size:300%; animation:border-shimmer 5s linear infinite;
        }
        @keyframes border-shimmer { from{background-position:0%} to{background-position:300%} }

        .services-hex-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px; margin-top: 32px;
        }
        .srv-hex-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-s);
            border-radius: 12px; padding: 24px 20px;
            transition: all .3s; position: relative; overflow: hidden;
        }
        .srv-hex-card::before {
            content:''; position:absolute; left:0; top:0; bottom:0; width:3px;
            background: linear-gradient(180deg, var(--cyan), var(--purple));
            transform:scaleY(0); transition:transform .3s; transform-origin:top;
        }
        .srv-hex-card:hover::before { transform:scaleY(1); }
        .srv-hex-card:hover { background:var(--cyan-dim); border-color:var(--border); transform:translateX(4px); }
        .srv-icon {
            width:48px; height:48px; border-radius:10px;
            background:linear-gradient(135deg, var(--cyan), var(--purple));
            display:flex; align-items:center; justify-content:center;
            font-size:20px; color:var(--bg); margin-bottom:14px;
        }
        .srv-name { font-size:15px; font-weight:700; color:var(--text-1); margin-bottom:6px; }
        .srv-desc { font-size:12px; color:var(--text-2); line-height:1.7; }
        .srv-price { font-family:var(--mono); font-size:13px; color:var(--cyan); margin-top:12px; }

        /* Default services */
        @php
            $defaultServices = [
                ['icon'=>'fa-code','name'=>'Web Development','desc'=>'Custom websites, web apps & portals built with modern stacks.'],
                ['icon'=>'fa-mobile-alt','name'=>'Mobile Apps','desc'=>'Native & cross-platform iOS and Android applications.'],
                ['icon'=>'fa-cloud','name'=>'Cloud Solutions','desc'=>'AWS, Azure & GCP infrastructure, DevOps & CI/CD pipelines.'],
                ['icon'=>'fa-shield-alt','name'=>'Cyber Security','desc'=>'Penetration testing, security audits & compliance solutions.'],
                ['icon'=>'fa-database','name'=>'Data Engineering','desc'=>'Big data, analytics pipelines, AI/ML model deployment.'],
                ['icon'=>'fa-cogs','name'=>'IT Consulting','desc'=>'Digital transformation strategy and technology roadmaps.'],
            ];
        @endphp

        /* ═══════════════════════════════════════════
           SKILLS / TECH STACK
        ═══════════════════════════════════════════ */
        .skills-panel {
            display: grid; grid-template-columns: 1fr 1fr; gap: 24px;
        }
        .skill-col-card {
            background: var(--bg-1); border: 1px solid var(--border-s);
            border-radius: 14px; padding: 28px;
        }
        .skill-col-title {
            font-family: var(--mono); font-size: 12px;
            color: var(--cyan); letter-spacing: 2px; text-transform: uppercase;
            margin-bottom: 20px; display:flex; align-items:center; gap:8px;
        }
        .skill-col-title::before { content:''; width:24px; height:1px; background:var(--cyan); }
        .skill-item-row {
            display:flex; align-items:center; gap:12px;
            padding:10px 12px; border-radius:8px;
            border:1px solid transparent; margin-bottom:8px;
            transition:all .25s;
        }
        .skill-item-row:hover { background:var(--cyan-dim); border-color:var(--border); }
        .skill-i-icon {
            width:34px; height:34px; border-radius:7px; flex-shrink:0;
            display:flex; align-items:center; justify-content:center;
            font-size:14px; color:var(--bg);
        }
        .skill-i-name { font-size:13px; font-weight:600; color:var(--text-1); }
        .skill-i-level { font-family:var(--mono); font-size:10px; color:var(--text-3); margin-top:1px; }

        /* Tech tag cloud */
        .tech-tag-cloud { display:flex; flex-wrap:wrap; gap:10px; margin-top:8px; }
        .ttag {
            padding:6px 14px;
            background:var(--purple-dim);
            border:1px solid rgba(168,85,247,0.3);
            border-radius:6px; font-family:var(--mono);
            font-size:12px; color:var(--text-1);
            transition:all .25s;
        }
        .ttag:hover { border-color:var(--purple); color:var(--purple); background:rgba(168,85,247,0.2); transform:translateY(-2px); }

        /* ═══════════════════════════════════════════
           PORTFOLIO — Browser window cards
        ═══════════════════════════════════════════ */
        .portfolio-grid {
            display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
            gap:20px;
        }
        .port-browser-card {
            background:var(--bg-1); border:1px solid var(--border-s);
            border-radius:12px; overflow:hidden; transition:all .35s;
        }
        .port-browser-card:hover { border-color:var(--border); transform:translateY(-6px); box-shadow:0 16px 40px rgba(0,0,0,0.5), var(--cyan-glow); }

        /* Browser top bar */
        .port-browser-bar {
            background:var(--bg-2); padding:10px 14px;
            border-bottom:1px solid var(--border-s);
            display:flex; align-items:center; gap:10px;
        }
        .pbb-dots { display:flex; gap:5px; }
        .pbb-dots span { width:10px; height:10px; border-radius:50%; }
        .pbb-dots span:nth-child(1){background:#ef4444;}
        .pbb-dots span:nth-child(2){background:#f59e0b;}
        .pbb-dots span:nth-child(3){background:#22c55e;}
        .pbb-url {
            flex:1; background:var(--bg-3);
            border-radius:4px; padding:4px 10px;
            font-family:var(--mono); font-size:10px; color:var(--text-3);
            white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
        }
        .pbb-url-icon { color:var(--green); font-size:9px; margin-right:4px; }

        /* Browser content */
        .port-browser-img {
            height:180px; overflow:hidden;
            background:var(--bg-3); position:relative;
        }
        .port-browser-img img { width:100%; height:100%; object-fit:cover; transition:transform .5s; }
        .port-browser-card:hover .port-browser-img img { transform:scale(1.05); }
        .port-browser-img-placeholder {
            width:100%; height:100%;
            display:flex; align-items:center; justify-content:center;
            color:var(--text-3); font-size:32px;
        }
        /* Tech stack bar overlay */
        .port-stack-bar {
            position:absolute; bottom:0; left:0; right:0;
            padding:6px 12px;
            background:rgba(3,7,18,0.85);
            display:flex; gap:6px; flex-wrap:wrap;
        }
        .pst { padding:2px 8px; background:var(--cyan-dim); border:1px solid var(--border); border-radius:4px; font-family:var(--mono); font-size:10px; color:var(--cyan); }

        .port-browser-body { padding:16px; }
        .port-proj-title { font-size:14px; font-weight:700; color:var(--text-1); margin-bottom:5px; }
        .port-proj-desc { font-size:12px; color:var(--text-2); line-height:1.6; }

        /* ═══════════════════════════════════════════
           QUALIFICATIONS — Timeline on dark
        ═══════════════════════════════════════════ */
        .quali-grid { display:grid; grid-template-columns:1fr 1fr; gap:24px; }
        .quali-col {
            background:var(--bg-1); border:1px solid var(--border-s);
            border-radius:14px; padding:28px; position:relative;
        }
        .quali-col-label {
            font-family:var(--mono); font-size:11px; color:var(--cyan);
            letter-spacing:2px; text-transform:uppercase;
            margin-bottom:24px; display:flex; align-items:center; gap:8px;
        }
        .quali-col-label i { font-size:14px; }
        .quali-tl { position:relative; padding-left:28px; }
        .quali-tl::before { content:''; position:absolute; left:8px; top:0; bottom:0; width:1px; background:linear-gradient(180deg, var(--cyan), var(--purple), transparent); }
        .quali-tl-item { position:relative; padding:0 0 28px 20px; }
        .quali-tl-dot { position:absolute; left:-20px; top:4px; width:10px; height:10px; background:var(--cyan); border-radius:50%; border:2px solid var(--bg-1); box-shadow:0 0 8px var(--cyan); }
        .quali-tl-year { font-family:var(--mono); font-size:10px; color:var(--cyan); letter-spacing:1px; margin-bottom:4px; }
        .quali-tl-title { font-size:14px; font-weight:700; color:var(--text-1); margin-bottom:3px; }
        .quali-tl-inst { font-size:12px; color:var(--text-2); }

        /* ═══════════════════════════════════════════
           CASE STUDIES / PRODUCTS
        ═══════════════════════════════════════════ */
        .products-dark-panel {
            border-radius:16px; overflow:hidden; position:relative;
            background-image:
                linear-gradient(135deg, rgba(3,7,18,0.95), rgba(13,17,23,0.92)),
                url('https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=1920&q=80');
            background-size:cover; background-position:center;
            border:1px solid var(--border); padding:44px 40px;
        }
        .products-dark-panel::before {
            content:''; position:absolute; top:0;left:0;right:0; height:2px;
            background:linear-gradient(90deg, var(--purple), var(--cyan), var(--green));
        }
        .products-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:18px; margin-top:32px; }
        .prod-card {
            background:rgba(255,255,255,0.04); border:1px solid var(--border-s);
            border-radius:12px; overflow:hidden; transition:all .3s;
        }
        .prod-card:hover { border-color:var(--purple); transform:translateY(-4px); background:var(--purple-dim); }
        .prod-img { height:160px; background:var(--bg-3); overflow:hidden; display:flex; align-items:center; justify-content:center; }
        .prod-img img { width:100%; height:100%; object-fit:cover; }
        .prod-img-placeholder { color:var(--text-3); font-size:28px; }
        .prod-body { padding:16px; }
        .prod-name { font-size:14px; font-weight:700; color:var(--text-1); margin-bottom:5px; }
        .prod-desc { font-size:12px; color:var(--text-2); line-height:1.6; margin-bottom:10px; }
        .prod-price { font-family:var(--mono); font-size:14px; color:var(--cyan); font-weight:600; }

        /* ═══════════════════════════════════════════
           TESTIMONIALS — Terminal window style
        ═══════════════════════════════════════════ */
        .testi-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:20px; }
        .testi-terminal {
            background:var(--bg-1); border:1px solid var(--border-s);
            border-radius:12px; overflow:hidden; transition:all .3s;
        }
        .testi-terminal:hover { border-color:var(--border); transform:translateY(-4px); box-shadow:0 12px 36px rgba(0,0,0,0.4); }
        .testi-term-bar {
            background:var(--bg-2); padding:10px 14px;
            display:flex; align-items:center; gap:8px;
            border-bottom:1px solid var(--border-s);
        }
        .ttb-dots { display:flex; gap:4px; }
        .ttb-dots span { width:9px; height:9px; border-radius:50%; }
        .ttb-dots span:nth-child(1){background:rgba(239,68,68,.6);}
        .ttb-dots span:nth-child(2){background:rgba(245,158,11,.6);}
        .ttb-dots span:nth-child(3){background:rgba(34,197,94,.6);}
        .ttb-title { font-family:var(--mono); font-size:10px; color:var(--text-3); margin-left:4px; }
        .testi-term-body { padding:20px; }
        .testi-prompt { font-family:var(--mono); font-size:11px; color:var(--green); margin-bottom:10px; }
        .testi-prompt::before { content:'$ echo "'; opacity:.7; }
        .testi-prompt::after { content:'"'; opacity:.7; }
        .testi-text { font-size:13px; color:var(--text-2); line-height:1.8; margin-bottom:16px; font-style:italic; }
        .testi-author { display:flex; align-items:center; gap:10px; }
        .testi-av { width:36px; height:36px; border-radius:6px; background:linear-gradient(135deg,var(--cyan),var(--purple)); display:flex; align-items:center; justify-content:center; color:var(--bg); font-weight:700; font-size:14px; flex-shrink:0; }
        .testi-av img { width:100%; height:100%; object-fit:cover; border-radius:6px; }
        .testi-nm { font-size:13px; font-weight:700; color:var(--text-1); }
        .testi-co { font-family:var(--mono); font-size:10px; color:var(--text-3); margin-top:2px; }

        /* ═══════════════════════════════════════════
           THOUGHTS / BLOG SECTION
        ═══════════════════════════════════════════ */
        .thoughts-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px; }
        .thought-card {
            background:var(--bg-1); border:1px solid var(--border-s);
            border-radius:12px; overflow:hidden; transition:all .3s;
        }
        .thought-card:hover { border-color:var(--border); transform:translateY(-4px); }
        .thought-img-wrap { height:160px; overflow:hidden; }
        .thought-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .5s; }
        .thought-card:hover .thought-img-wrap img { transform:scale(1.05); }
        .thought-body { padding:18px; }
        .thought-date { font-family:var(--mono); font-size:10px; color:var(--cyan); letter-spacing:1.5px; text-transform:uppercase; margin-bottom:8px; }
        .thought-title { font-size:15px; font-weight:700; color:var(--text-1); margin-bottom:6px; }
        .thought-desc { font-size:12px; color:var(--text-2); line-height:1.7; }

        /* ═══════════════════════════════════════════
           VIDEOS GRID
        ═══════════════════════════════════════════ */
        .video-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:20px; }
        .video-card { border-radius:12px; overflow:hidden; aspect-ratio:16/9; border:1px solid var(--border-s); transition:all .3s; }
        .video-card:hover { border-color:var(--border); transform:translateY(-4px); box-shadow:0 12px 36px rgba(0,0,0,0.5); }
        .video-card iframe { width:100%; height:100%; border:none; display:block; }
        .video-card-placeholder { width:100%; height:100%; background:var(--bg-2); display:flex; align-items:center; justify-content:center; }
        .video-play-ring { width:60px; height:60px; border-radius:50%; background:var(--cyan); display:flex; align-items:center; justify-content:center; color:var(--bg); font-size:20px; padding-left:4px; box-shadow:0 0 20px rgba(0,212,255,0.4); }

        /* ═══════════════════════════════════════════
           UPLOAD DOCS
        ═══════════════════════════════════════════ */
        .docs-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:14px; }
        .doc-card {
            background:var(--bg-1); border:1px solid var(--border-s);
            border-radius:10px; padding:18px 20px;
            display:flex; align-items:center; gap:14px; transition:all .3s;
        }
        .doc-card:hover { border-color:var(--border); transform:translateX(4px); }
        .doc-icon { width:42px; height:42px; flex-shrink:0; background:var(--cyan-dim); border:1px solid var(--border); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:16px; color:var(--cyan); }
        .doc-name { font-size:13px; font-weight:600; color:var(--text-1); }
        .doc-sub { font-family:var(--mono); font-size:10px; color:var(--text-3); margin-top:2px; }
        .doc-dl { margin-left:auto; color:var(--cyan); font-size:16px; transition:transform .2s; }
        .doc-dl:hover { transform:translateY(-2px); }

        /* ═══════════════════════════════════════════
           CTA PANEL — Full-width dramatic dark
        ═══════════════════════════════════════════ */
        .cta-panel {
            border-radius:16px; overflow:hidden; position:relative;
            min-height:380px; display:flex; align-items:center; justify-content:center;
            text-align:center;
            background-image:
                linear-gradient(135deg, rgba(3,7,18,0.88), rgba(3,7,18,0.78)),
                url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1920&q=85');
            background-size:cover; background-position:center;
            border:1px solid var(--border);
        }
        .cta-panel::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--cyan),transparent); }
        .cta-panel::after  { content:''; position:absolute; bottom:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--purple),transparent); }
        .cta-grid-overlay {
            position:absolute; inset:0;
            background-image:linear-gradient(rgba(0,212,255,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,0.04) 1px, transparent 1px);
            background-size:40px 40px; pointer-events:none;
        }
        .cta-inner { position:relative; z-index:2; padding:64px 32px; max-width:680px; }
        .cta-tag {
            display:inline-block; padding:6px 18px;
            border:1px solid rgba(0,212,255,0.4); border-radius:4px;
            font-family:var(--mono); font-size:10px; color:var(--cyan);
            letter-spacing:3px; text-transform:uppercase; margin-bottom:22px;
        }
        .cta-title { font-size:clamp(30px,5vw,52px); font-weight:800; color:var(--text-1); line-height:1.1; margin-bottom:14px; }
        .cta-title span { color:var(--cyan); }
        .cta-sub { font-size:15px; color:var(--text-2); line-height:1.8; margin-bottom:32px; }
        .cta-btns { display:flex; justify-content:center; gap:12px; flex-wrap:wrap; }

        /* ═══════════════════════════════════════════
           CONTACT STRIP
        ═══════════════════════════════════════════ */
        .contact-strip {
            background:var(--bg-1); border:1px solid var(--border-s);
            border-radius:14px; padding:36px 40px;
            display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:16px;
        }
        .cnt-item {
            display:flex; align-items:center; gap:14px;
            padding:16px; border-radius:10px; border:1px solid transparent;
            text-decoration:none; color:inherit; transition:all .25s;
        }
        .cnt-item:hover { background:var(--cyan-dim); border-color:var(--border); }
        .cnt-icon { width:44px; height:44px; border-radius:8px; background:var(--cyan); color:var(--bg); display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
        .cnt-lbl { font-family:var(--mono); font-size:10px; color:var(--text-3); text-transform:uppercase; letter-spacing:1px; margin-bottom:3px; }
        .cnt-val { font-size:14px; font-weight:600; color:var(--text-1); }

        /* ═══════════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════════ */
        .lx-footer {
            background:var(--bg-1); border-top:1px solid var(--border-s);
            padding:28px 52px; display:flex;
            align-items:center; justify-content:space-between;
            flex-wrap:wrap; gap:12px;
        }
        .footer-brand { font-family:var(--mono); font-size:13px; color:var(--text-2); }
        .footer-brand span { color:var(--cyan); }
        .footer-right { font-family:var(--mono); font-size:11px; color:var(--text-3); }

        /* ═══════════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════════ */
        @media (max-width:1024px) {
            .site-layout { flex-direction:column; }
            .sidebar { width:100%; height:auto; position:relative; top:auto; border-right:none; border-bottom:1px solid var(--border); }
            .sb-nav { display:flex; gap:4px; flex-wrap:wrap; padding:12px; }
            .sb-nav-label { display:none; }
            .sections-wrap { padding:0 24px 60px; }
            .hero-inner { padding:40px 24px 40px; }
            .lx-footer { padding:20px 24px; }
            .skills-panel { grid-template-columns:1fr; }
            .quali-grid { grid-template-columns:1fr; }
        }
        @media (max-width:640px) {
            .hero-stat-bar { display:none; }
            .hero-ctas { flex-direction:column; max-width:240px; }
            .cta-btns { flex-direction:column; align-items:center; }
            .services-panel { padding:28px 20px; }
            .products-dark-panel { padding:28px 20px; }
            .contact-strip { padding:24px 20px; }
        }
    </style>
</head>
<body>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-terminal"></i> Preview Mode —
        <a href="{{ url('/signin') }}">Sign up</a> to deploy your live IT profile!
    </div>
    @endif

    <!-- ══════════════════════════════════════════════════════
         SITE LAYOUT: STICKY SIDEBAR + MAIN CONTENT
    ══════════════════════════════════════════════════════ -->
    <div class="site-layout">

        <!-- ══════════════════════════════════════════════════
             STICKY LEFT SIDEBAR
        ══════════════════════════════════════════════════ -->
        <aside class="sidebar">

            <!-- Top branding -->
            <div class="sb-top">
                <div class="sb-logo-line">
                    <span class="sb-logo-dot"></span>
                    &lt;profile /&gt;
                </div>

                <!-- Profile photo with spinning ring -->
                <div class="sb-photo-wrap">
                    <div class="sb-photo-ring">
                        <div class="sb-photo-inner">
                            @if($userdata->profile ?? false)
                                <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}"
                                     alt="{{ $userdata->name }}" loading="lazy">
                            @else
                                <div class="sb-photo-placeholder">
                                    <i class="fas fa-code"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="sb-online" title="Available for projects"></div>
                </div>

                <div class="sb-name">{{ $userdata->name ?? 'Tech Professional' }}</div>

                @if(($userdata->desig ?? false) || ($theme->name ?? false))
                <div class="sb-desig">{{ $userdata->desig ?? $theme->name ?? 'Technology Expert' }}</div>
                @endif

                @if(($userdata->city ?? false) || ($userdata->state ?? false))
                <div class="sb-location">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ implode(', ', array_filter([$userdata->city ?? null, $userdata->state ?? null])) }}
                </div>
                @endif
            </div>

            <!-- Nav links -->
            <nav class="sb-nav">
                <div class="sb-nav-label">Navigation</div>
                <a href="#services" class="sb-nav-item"><i class="fas fa-code"></i> Services</a>
                <a href="#skills"   class="sb-nav-item"><i class="fas fa-layer-group"></i> Skills</a>
                <a href="#projects" class="sb-nav-item"><i class="fas fa-folder-open"></i> Projects</a>
                <a href="#education"class="sb-nav-item"><i class="fas fa-graduation-cap"></i> Education</a>
                @if(isset($techCaseStudies) && $techCaseStudies->count() > 0)
                <a href="#products" class="sb-nav-item"><i class="fas fa-cube"></i> Solutions</a>
                @endif
                @if(isset($clients) && $clients->count() > 0)
                <a href="#reviews"  class="sb-nav-item"><i class="fas fa-star"></i> Reviews</a>
                @endif
                @if(isset($videos) && $videos->count() > 0)
                <a href="#videos"   class="sb-nav-item"><i class="fas fa-play-circle"></i> Videos</a>
                @endif
                <a href="#contact"  class="sb-nav-item"><i class="fas fa-terminal"></i> Contact</a>
            </nav>

            <!-- Action buttons -->
            <div class="sb-actions">
                @if($userdata->mobile ?? false)
                <a href="tel:{{ $userdata->mobile }}" class="sb-btn sb-btn-cyan">
                    <i class="fas fa-phone"></i> {{ $userdata->mobile }}
                </a>
                @endif
                @if($userdata->email ?? false)
                <a href="mailto:{{ $userdata->email }}" class="sb-btn sb-btn-outline">
                    <i class="fas fa-envelope"></i> Send Email
                </a>
                @endif
                @if(isset($social->whatsapp) && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="sb-btn sb-btn-green">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif

                <!-- Social icons -->
                @if(isset($social) && $social)
                <div class="sb-social">
                    @if($social->github ?? false)
                    <a href="{{ $social->github }}" target="_blank" class="sb-soc-btn"><i class="fab fa-github"></i></a>
                    @endif
                    @if($social->linkedin ?? false)
                    <a href="{{ $social->linkedin }}" target="_blank" class="sb-soc-btn"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if($social->twitter ?? false)
                    <a href="{{ $social->twitter }}" target="_blank" class="sb-soc-btn"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if($social->facebook ?? false)
                    <a href="{{ $social->facebook }}" target="_blank" class="sb-soc-btn"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($social->instagram ?? false)
                    <a href="{{ $social->instagram }}" target="_blank" class="sb-soc-btn"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($social->youtube ?? false)
                    <a href="{{ $social->youtube }}" target="_blank" class="sb-soc-btn"><i class="fab fa-youtube"></i></a>
                    @endif
                </div>
                @endif
            </div>

        </aside><!-- /sidebar -->


        <!-- ══════════════════════════════════════════════════
             MAIN CONTENT — Scrollable right panel
        ══════════════════════════════════════════════════ -->
        <main class="main-content">

            <!-- ─────────────────────────────────────
                 HERO PANEL — Server room / data bg
            ───────────────────────────────────── -->
            <div class="hero-panel">
                <div class="hero-scanline"></div>
                <div class="hero-particles"></div>

                <div class="hero-inner">
                    <div class="hero-status">
                        <span class="hero-status-dot"></span>
                        Available for Projects
                    </div>

                    @if($userdata->isFeatureVisible('name') ?? true)
                    <h1 class="hero-title">
                        {{ $userdata->name ?? 'Tech Expert' }}<br>
                        <span class="hl-fade">{{ $userdata->desig ?? $theme->name ?? 'Technology Solutions' }}</span>
                    </h1>
                    @endif

                    @if($userdata->desig ?? false)
                    <div class="hero-desig">{{ $userdata->desig }}</div>
                    @endif

                    @if($userdata->about ?? false)
                    <p class="hero-desc">{{ Str::limit($userdata->about, 180) }}</p>
                    @else
                    <p class="hero-desc">Delivering cutting-edge technology solutions — from architecture design to deployment. Specialised in building scalable, secure, and high-performance digital products.</p>
                    @endif

                    <div class="hero-ctas">
                        @if($userdata->mobile ?? false)
                        <a href="tel:{{ $userdata->mobile }}" class="hcta-primary">
                            <i class="fas fa-phone"></i> Call Now
                        </a>
                        @endif
                        @if(isset($social->whatsapp) && $social->whatsapp)
                        <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="hcta-wa">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        @endif
                        @if($userdata->email ?? false)
                        <a href="mailto:{{ $userdata->email }}" class="hcta-ghost">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                        @endif
                    </div>

                    <!-- Hero stats strip -->
                    <div class="hero-stat-bar">
                        <div class="hsb-item">
                            <div class="hsb-num">100<span style="font-size:14px;">+</span></div>
                            <div class="hsb-label">Projects Done</div>
                        </div>
                        <div class="hsb-item">
                            <div class="hsb-num">50<span style="font-size:14px;">+</span></div>
                            <div class="hsb-label">Happy Clients</div>
                        </div>
                        <div class="hsb-item">
                            <div class="hsb-num">10<span style="font-size:14px;">+</span></div>
                            <div class="hsb-label">Years Exp.</div>
                        </div>
                        <div class="hsb-item">
                            <div class="hsb-num">5<span style="font-size:14px;">★</span></div>
                            <div class="hsb-label">Avg Rating</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ─────────────────────────────────────
                 ALL SECTIONS BELOW
            ───────────────────────────────────── -->
            <div class="sections-wrap">

                <!-- ── SERVICES ── -->
                <div id="services">
                    <div class="sec-heading">
                        <span class="sec-h-label">services</span>
                        <div class="sec-h-line"></div>
                    </div>
                    <div class="sec-title">What I <span style="color:var(--cyan)">Build</span></div>
                    <div class="sec-subtitle" style="margin-bottom:0;">Technology services crafted for real-world impact.</div>

                    <div class="services-panel" style="margin-top:28px;">
                        <div class="services-hex-grid">
                            @if(isset($techServices) && $techServices->count() > 0)
                                @php $srvIcons=['fa-code','fa-mobile-alt','fa-cloud','fa-shield-alt','fa-database','fa-cogs','fa-robot','fa-network-wired']; @endphp
                                @foreach($techServices as $si => $service)
                                <div class="srv-hex-card">
                                    <div class="srv-icon"><i class="fas {{ $srvIcons[$si % count($srvIcons)] }}"></i></div>
                                    <div class="srv-name">{{ $service->service_name }}</div>
                                    @if($service->description ?? false)
                                    <div class="srv-desc">{{ Str::limit($service->description, 90) }}</div>
                                    @endif
                                    @if($service->price ?? false)
                                    <div class="srv-price">From ₹{{ number_format($service->price) }}</div>
                                    @endif
                                </div>
                                @endforeach
                            @elseif(isset($professions) && $professions->count() > 0)
                                @php $srvIcons=['fa-code','fa-mobile-alt','fa-cloud','fa-shield-alt','fa-database','fa-cogs']; @endphp
                                @foreach($professions as $pi => $prof)
                                <div class="srv-hex-card">
                                    <div class="srv-icon"><i class="fas {{ $srvIcons[$pi % count($srvIcons)] }}"></i></div>
                                    <div class="srv-name">{{ $prof->profession ?? $prof->title ?? '' }}</div>
                                </div>
                                @endforeach
                            @else
                                @foreach($defaultServices as $ds)
                                <div class="srv-hex-card">
                                    <div class="srv-icon"><i class="fas {{ $ds['icon'] }}"></i></div>
                                    <div class="srv-name">{{ $ds['name'] }}</div>
                                    <div class="srv-desc">{{ $ds['desc'] }}</div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>


                <!-- ── SKILLS / TECH STACK ── -->
                <div id="skills">
                    <div class="sec-heading">
                        <span class="sec-h-label">tech_stack</span>
                        <div class="sec-h-line"></div>
                    </div>
                    <div class="sec-title">Skills &amp; <span style="color:var(--cyan)">Expertise</span></div>

                    <div class="skills-panel" style="margin-top:28px;">
                        <!-- Core skills column -->
                        <div class="skill-col-card">
                            <div class="skill-col-title"><i class="fas fa-code"></i> Core Skills</div>
                            @if(isset($professions) && $professions->count() > 0)
                                @php $skillColors=['linear-gradient(135deg,#00d4ff,#a855f7)','linear-gradient(135deg,#00ff88,#0ea5e9)','linear-gradient(135deg,#f59e0b,#ef4444)','linear-gradient(135deg,#a855f7,#ec4899)','linear-gradient(135deg,#22c55e,#0ea5e9)']; @endphp
                                @foreach($professions->take(8) as $pi => $prof)
                                <div class="skill-item-row">
                                    <div class="skill-i-icon" style="background:{{ $skillColors[$pi % 5] }};">
                                        <i class="fas fa-terminal"></i>
                                    </div>
                                    <div>
                                        <div class="skill-i-name">{{ $prof->profession ?? $prof->title ?? '' }}</div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                @foreach(['JavaScript','Python','React','Node.js','PHP','AWS','Docker','PostgreSQL'] as $pi => $sk)
                                <div class="skill-item-row">
                                    <div class="skill-i-icon" style="background:{{ $skillColors[$pi % 5] }};">
                                        <i class="fas fa-code-branch"></i>
                                    </div>
                                    <div>
                                        <div class="skill-i-name">{{ $sk }}</div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Tech tags column -->
                        <div class="skill-col-card">
                            <div class="skill-col-title"><i class="fas fa-tags"></i> Technologies</div>
                            @if(isset($qualifications) && $qualifications->count() > 0)
                            <div class="tech-tag-cloud">
                                @foreach($qualifications as $qual)
                                <span class="ttag">{{ $qual->qualifiaction ?? $qual->degree ?? $qual->title ?? '' }}</span>
                                @endforeach
                            </div>
                            @else
                            <div class="tech-tag-cloud">
                                @foreach(['Vue.js','TypeScript','Laravel','MySQL','Redis','Kubernetes','TensorFlow','GraphQL','REST API','Git','Linux','CI/CD'] as $t)
                                <span class="ttag">{{ $t }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>


                <!-- ── PORTFOLIO / PROJECTS ── -->
                @if((isset($portfolios) && $portfolios->count() > 0) || (isset($techCaseStudies) && $techCaseStudies->count() > 0))
                <div id="projects">
                    <div class="sec-heading">
                        <span class="sec-h-label">projects</span>
                        <div class="sec-h-line"></div>
                    </div>
                    <div class="sec-title">Featured <span style="color:var(--cyan)">Work</span></div>

                    <div class="portfolio-grid" style="margin-top:28px;">
                        @if(isset($techCaseStudies) && $techCaseStudies->count() > 0)
                            @foreach($techCaseStudies->take(6) as $cs)
                            <div class="port-browser-card">
                                <div class="port-browser-bar">
                                    <div class="pbb-dots"><span></span><span></span><span></span></div>
                                    <div class="pbb-url">
                                        <i class="fas fa-lock pbb-url-icon"></i>
                                        project.dev/{{ Str::slug($cs->title ?? 'case-study') }}
                                    </div>
                                </div>
                                <div class="port-browser-img">
                                    @if(is_array($cs->images ?? null) && count($cs->images) > 0)
                                        <img src="{{ url('uploads/tech/case-studies/'.$cs->images[0]) }}" alt="{{ $cs->title }}" loading="lazy">
                                    @else
                                        <div class="port-browser-img-placeholder"><i class="fas fa-code"></i></div>
                                    @endif
                                    @if($cs->tech_stack ?? false)
                                    <div class="port-stack-bar">
                                        @foreach(array_slice((array)$cs->tech_stack, 0, 3) as $ts)
                                        <span class="pst">{{ $ts }}</span>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <div class="port-browser-body">
                                    <div class="port-proj-title">{{ $cs->title }}</div>
                                    @if($cs->description ?? false)
                                    <div class="port-proj-desc">{{ Str::limit($cs->description, 80) }}</div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @elseif(isset($portfolios) && $portfolios->count() > 0)
                            @foreach($portfolios->take(6) as $port)
                            @php $imgs = json_decode($port->image ?? '[]', true); @endphp
                            <div class="port-browser-card">
                                <div class="port-browser-bar">
                                    <div class="pbb-dots"><span></span><span></span><span></span></div>
                                    <div class="pbb-url">
                                        <i class="fas fa-lock pbb-url-icon"></i>
                                        project.dev/{{ Str::slug($port->title ?? 'project') }}
                                    </div>
                                </div>
                                <div class="port-browser-img">
                                    @if($imgs && count($imgs) > 0)
                                        <img src="{{ url('public/frontend/portfolio/'.$imgs[0]) }}" alt="Project" loading="lazy">
                                    @else
                                        <div class="port-browser-img-placeholder"><i class="fas fa-code"></i></div>
                                    @endif
                                </div>
                                <div class="port-browser-body">
                                    <div class="port-proj-title">{{ $port->title ?? 'Project' }}</div>
                                    @if($port->description ?? false)
                                    <div class="port-proj-desc">{{ Str::limit($port->description, 80) }}</div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                @endif


                <!-- ── EDUCATION + EXPERIENCE SIDE BY SIDE ── -->
                <div id="education">
                    <div class="sec-heading">
                        <span class="sec-h-label">background</span>
                        <div class="sec-h-line"></div>
                    </div>
                    <div class="sec-title">Education &amp; <span style="color:var(--cyan)">Experience</span></div>

                    <div class="quali-grid" style="margin-top:28px;">
                        <!-- Education -->
                        <div class="quali-col">
                            <div class="quali-col-label"><i class="fas fa-graduation-cap"></i> Education</div>
                            @if(isset($qualifications) && $qualifications->count() > 0)
                            <div class="quali-tl">
                                @foreach($qualifications as $qual)
                                <div class="quali-tl-item">
                                    <div class="quali-tl-dot"></div>
                                    @if($qual->year ?? false)
                                    <div class="quali-tl-year">{{ $qual->year }}</div>
                                    @endif
                                    <div class="quali-tl-title">{{ $qual->qualifiaction ?? $qual->degree ?? $qual->title ?? '' }}</div>
                                    @if($qual->institute ?? false)
                                    <div class="quali-tl-inst"><i class="fas fa-university" style="color:var(--cyan);margin-right:4px;font-size:10px;"></i>{{ $qual->institute }}</div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div style="color:var(--text-3);font-family:var(--mono);font-size:12px;padding:20px 0;">// No records yet</div>
                            @endif
                        </div>

                        <!-- Experience -->
                        <div class="quali-col">
                            <div class="quali-col-label" style="color:var(--purple)"><i class="fas fa-briefcase"></i> Experience</div>
                            @if(isset($experiences) && $experiences->count() > 0)
                            <div class="quali-tl" style="--tl-color:var(--purple)">
                                @foreach($experiences as $exp)
                                <div class="quali-tl-item">
                                    <div class="quali-tl-dot" style="background:var(--purple);box-shadow:0 0 8px var(--purple);"></div>
                                    @if(($exp->from_year ?? false) || ($exp->to_year ?? false))
                                    <div class="quali-tl-year">{{ $exp->from_year ?? '' }}{{ (($exp->from_year ?? false) && ($exp->to_year ?? false)) ? ' – ' : '' }}{{ $exp->to_year ?? '' }}</div>
                                    @endif
                                    <div class="quali-tl-title">{{ $exp->position ?? $exp->title ?? '' }}</div>
                                    @if($exp->company ?? false)
                                    <div class="quali-tl-inst"><i class="fas fa-building" style="color:var(--purple);margin-right:4px;font-size:10px;"></i>{{ $exp->company }}</div>
                                    @endif
                                    @if($exp->description ?? false)
                                    <div style="font-size:11px;color:var(--text-3);margin-top:4px;line-height:1.6;">{{ Str::limit($exp->description, 80) }}</div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div style="color:var(--text-3);font-family:var(--mono);font-size:12px;padding:20px 0;">// No records yet</div>
                            @endif
                        </div>
                    </div>
                </div>


                <!-- ── PRODUCTS / SOLUTIONS — Dark bg ── -->
                @if($menu->product ?? 0)
                @if(isset($techProducts) && $techProducts->count() > 0)
                <div id="products">
                    <div class="sec-heading">
                        <span class="sec-h-label">solutions</span>
                        <div class="sec-h-line"></div>
                    </div>

                    <div class="products-dark-panel">
                        <div class="sec-title" style="color:white;">Our <span style="color:var(--cyan)">Solutions</span></div>
                        <div class="products-grid">
                            @foreach($techProducts as $prod)
                            <div class="prod-card">
                                <div class="prod-img">
                                    @if($prod->image ?? false)
                                        <img src="{{ url('uploads/products/'.$prod->image) }}" alt="{{ $prod->name }}" loading="lazy">
                                    @else
                                        <div class="prod-img-placeholder"><i class="fas fa-cube"></i></div>
                                    @endif
                                </div>
                                <div class="prod-body">
                                    <div class="prod-name">{{ $prod->name }}</div>
                                    @if($prod->description ?? false)
                                    <div class="prod-desc">{{ Str::limit($prod->description, 80) }}</div>
                                    @endif
                                    @if($prod->price ?? false)
                                    <div class="prod-price">₹{{ number_format($prod->price) }}</div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @endif


                <!-- ── TESTIMONIALS — Terminal windows ── -->
                @if($menu->client ?? 0)
                @if((isset($clients) && $clients->count() > 0) || true)
                <div id="reviews">
                    <div class="sec-heading">
                        <span class="sec-h-label">client_reviews</span>
                        <div class="sec-h-line"></div>
                    </div>
                    <div class="sec-title">What Clients <span style="color:var(--cyan)">Say</span></div>

                    <div class="testi-grid" style="margin-top:28px;">
                        @if(isset($clients) && $clients->count() > 0)
                            @foreach($clients->take(6) as $client)
                            <div class="testi-terminal">
                                <div class="testi-term-bar">
                                    <div class="ttb-dots"><span></span><span></span><span></span></div>
                                    <div class="ttb-title">review_{{ $loop->index + 1 }}.log</div>
                                </div>
                                <div class="testi-term-body">
                                    <div class="testi-prompt">{{ Str::limit($client->review ?? $client->message ?? $client->description ?? '', 20) }}</div>
                                    <p class="testi-text">{{ $client->review ?? $client->message ?? $client->description ?? '' }}</p>
                                    <div class="testi-author">
                                        <div class="testi-av">
                                            @if($client->image ?? false)
                                                <img src="{{ url('uploads/clients/'.$client->image) }}" alt="">
                                            @else
                                                {{ strtoupper(substr($client->name ?? 'C', 0, 1)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <div class="testi-nm">{{ $client->name ?? 'Happy Client' }}</div>
                                            @if($client->company ?? $client->location ?? false)
                                            <div class="testi-co">{{ $client->company ?? $client->location ?? '' }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <!-- Default testimonials -->
                        @foreach([
                            ['name'=>'Rajesh Kumar','co'=>'Startup Founder','text'=>'Outstanding work! The application was delivered on time, perfectly optimised and exceeded all our performance benchmarks.'],
                            ['name'=>'Priya Sharma','co'=>'E-Commerce CEO','text'=>'The team built our entire platform from scratch. Scalable, secure, and the UI is exactly what we envisioned.'],
                            ['name'=>'Arjun Mehta','co'=>'CTO, FinTech','text'=>'Professional, reliable, and technically superb. Complex API integrations handled with zero issues. Highly recommended.'],
                        ] as $i => $dt)
                        <div class="testi-terminal">
                            <div class="testi-term-bar">
                                <div class="ttb-dots"><span></span><span></span><span></span></div>
                                <div class="ttb-title">review_{{ $i+1 }}.log</div>
                            </div>
                            <div class="testi-term-body">
                                <div class="testi-prompt">{{ Str::limit($dt['text'], 20) }}</div>
                                <p class="testi-text">{{ $dt['text'] }}</p>
                                <div class="testi-author">
                                    <div class="testi-av">{{ substr($dt['name'],0,1) }}</div>
                                    <div>
                                        <div class="testi-nm">{{ $dt['name'] }}</div>
                                        <div class="testi-co">{{ $dt['co'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                @endif
                @endif


                <!-- ── THOUGHTS / BLOG ── -->
                @if($menu->thought ?? 0)
                @if(isset($thoughts) && $thoughts->count() > 0)
                <div>
                    <div class="sec-heading">
                        <span class="sec-h-label">blog_posts</span>
                        <div class="sec-h-line"></div>
                    </div>
                    <div class="sec-title">Tech <span style="color:var(--cyan)">Insights</span></div>

                    <div class="thoughts-grid" style="margin-top:28px;">
                        @foreach($thoughts as $thought)
                        <div class="thought-card">
                            @if($thought->image ?? false)
                            <div class="thought-img-wrap">
                                <img src="{{ url('uploads/thoughts/'.$thought->image) }}" alt="{{ $thought->title ?? '' }}" loading="lazy">
                            </div>
                            @endif
                            <div class="thought-body">
                                @if($thought->created_at ?? false)
                                <div class="thought-date"><i class="fas fa-calendar" style="margin-right:4px;"></i>{{ \Carbon\Carbon::parse($thought->created_at)->format('d M Y') }}</div>
                                @endif
                                <div class="thought-title">{{ $thought->title ?? '' }}</div>
                                @if($thought->description ?? false)
                                <div class="thought-desc">{{ Str::limit($thought->description, 110) }}</div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif


                <!-- ── VIDEO GALLERY ── -->
                @if($menu->videos ?? 0)
                @if(isset($videos) && $videos->count() > 0)
                <div id="videos">
                    <div class="sec-heading">
                        <span class="sec-h-label">media</span>
                        <div class="sec-h-line"></div>
                    </div>
                    <div class="sec-title">Video <span style="color:var(--cyan)">Showcase</span></div>

                    <div class="video-grid" style="margin-top:28px;">
                        @foreach($videos as $video)
                        @php
                            $vUrl = $video->url ?? $video->link ?? '';
                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:.*v=|.*\/))([^&\?\/]{11})/', $vUrl, $ytm);
                            $ytId = $ytm[1] ?? null;
                        @endphp
                        <div class="video-card">
                            @if($ytId)
                            <iframe src="https://www.youtube.com/embed/{{ $ytId }}?rel=0&modestbranding=1"
                                    title="{{ $video->title ?? 'Tech Video' }}"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen loading="lazy"></iframe>
                            @else
                            <div class="video-card-placeholder">
                                <div class="video-play-ring"><i class="fas fa-play"></i></div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif


                <!-- ── UPLOAD FILES / DOCS ── -->
                @if($menu->upload_file ?? 0)
                @if(isset($upload_files) && $upload_files->count() > 0)
                <div>
                    <div class="sec-heading">
                        <span class="sec-h-label">resources</span>
                        <div class="sec-h-line"></div>
                    </div>
                    <div class="sec-title">Downloads &amp; <span style="color:var(--cyan)">Resources</span></div>

                    <div class="docs-grid" style="margin-top:28px;">
                        @foreach($upload_files as $file)
                        @php
                            $ext = strtolower(pathinfo($file->file ?? '', PATHINFO_EXTENSION));
                            $dIcon = match($ext) { 'pdf'=>'fa-file-pdf','doc','docx'=>'fa-file-word','xls','xlsx'=>'fa-file-excel','ppt','pptx'=>'fa-file-powerpoint',default=>'fa-file-code' };
                        @endphp
                        <div class="doc-card">
                            <div class="doc-icon"><i class="fas {{ $dIcon }}"></i></div>
                            <div>
                                <div class="doc-name">{{ $file->title ?? $file->name ?? 'Document' }}</div>
                                <div class="doc-sub">{{ strtoupper($ext ?? 'FILE') }} • Download</div>
                            </div>
                            <a href="{{ url('uploads/files/'.$file->file) }}" target="_blank" class="doc-dl" download>
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif


                <!-- ── CTA PANEL ── -->
                <div class="cta-panel" style="margin-top:64px;">
                    <div class="cta-grid-overlay"></div>
                    <div class="cta-inner">
                        <div class="cta-tag">Let's Build Together</div>
                        <h2 class="cta-title">Ready to Start Your <span>Project?</span></h2>
                        <p class="cta-sub">From idea to deployment — let's architect a solution that scales with your ambition. Reach out today and let's write some great code together.</p>
                        <div class="cta-btns">
                            @if($userdata->mobile ?? false)
                            <a href="tel:{{ $userdata->mobile }}" class="hcta-primary">
                                <i class="fas fa-phone"></i> Start a Call
                            </a>
                            @endif
                            @if(isset($social->whatsapp) && $social->whatsapp)
                            <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="hcta-wa">
                                <i class="fab fa-whatsapp"></i> Chat Now
                            </a>
                            @endif
                            @if($userdata->email ?? false)
                            <a href="mailto:{{ $userdata->email }}" class="hcta-ghost">
                                <i class="fas fa-paper-plane"></i> Send Brief
                            </a>
                            @endif
                        </div>
                    </div>
                </div>


                <!-- ── CONTACT STRIP ── -->
                @if($menu->personal ?? 0)
                <div id="contact" style="margin-top:48px;">
                    <div class="sec-heading">
                        <span class="sec-h-label">contact_info</span>
                        <div class="sec-h-line"></div>
                    </div>

                    <div class="contact-strip">
                        @if($userdata->mobile ?? false)
                        <a href="tel:{{ $userdata->mobile }}" class="cnt-item">
                            <div class="cnt-icon"><i class="fas fa-phone"></i></div>
                            <div><div class="cnt-lbl">Phone</div><div class="cnt-val">{{ $userdata->mobile }}</div></div>
                        </a>
                        @endif
                        @if($userdata->email ?? false)
                        <a href="mailto:{{ $userdata->email }}" class="cnt-item">
                            <div class="cnt-icon" style="background:var(--purple);"><i class="fas fa-envelope"></i></div>
                            <div><div class="cnt-lbl">Email</div><div class="cnt-val">{{ $userdata->email }}</div></div>
                        </a>
                        @endif
                        @if(($userdata->city ?? false) || ($userdata->state ?? false))
                        <div class="cnt-item">
                            <div class="cnt-icon" style="background:var(--green);color:var(--bg);"><i class="fas fa-map-marker-alt"></i></div>
                            <div><div class="cnt-lbl">Location</div><div class="cnt-val">{{ implode(', ', array_filter([$userdata->city ?? null, $userdata->state ?? null])) }}</div></div>
                        </div>
                        @endif
                        @if(isset($social->whatsapp) && $social->whatsapp)
                        <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="cnt-item">
                            <div class="cnt-icon" style="background:#25D366;"><i class="fab fa-whatsapp"></i></div>
                            <div><div class="cnt-lbl">WhatsApp</div><div class="cnt-val">+{{ $social->whatsapp }}</div></div>
                        </a>
                        @endif
                    </div>
                </div>
                @endif

            </div><!-- /.sections-wrap -->


            <!-- ══════════════════════════════════════════════════
                 FOOTER
            ══════════════════════════════════════════════════ -->
            <footer class="lx-footer">
                <div class="footer-brand">
                    &copy; {{ date('Y') }} <span>{{ $userdata->name ?? 'Tech Profile' }}</span>
                </div>
                <div class="footer-right">
                    Powered by
                    @if($websetting && ($websetting->company_name ?? false))
                    <a href="#" target="_blank" style="color:var(--cyan);text-decoration:none;">{{ $websetting->company_name }}</a>
                    @else
                    <a href="{{ url('/') }}" style="color:var(--cyan);text-decoration:none;">Fastap</a>
                    @endif
                </div>
            </footer>

        </main><!-- /.main-content -->
    </div><!-- /.site-layout -->

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])

</body>
</html>