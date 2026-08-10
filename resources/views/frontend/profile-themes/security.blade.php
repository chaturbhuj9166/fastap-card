<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Security Professional' }} - Security & Surveillance</title>

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
        $themeColor = $theme->color ?? '#00ff88';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Share+Tech+Mono&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ═══════════════════════════════════════
           CCTV COMMAND CENTER — DESIGN SYSTEM
        ═══════════════════════════════════════ */
        :root {
            --bg:         #060a0f;
            --bg-mid:     #0d1520;
            --bg-panel:   #0f1e2e;
            --bg-card:    #111d2e;
            --green:      #00ff88;
            --green-dim:  #00cc6a;
            --green-glow: rgba(0,255,136,0.18);
            --cyan:       #00d4ff;
            --red:        #ff3b30;
            --amber:      #ffb300;
            --steel:      #1e3a5f;
            --border:     rgba(0,255,136,0.14);
            --border-dim: rgba(255,255,255,0.06);
            --text:       #c0cad6;
            --text-bright:#e8f0f8;
            --text-dim:   #4a6080;
            --mono:       'Share Tech Mono', monospace;
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Global scan-line texture overlay */
        body::after {
            content: '';
            position: fixed; inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,0,0,0.08) 2px,
                rgba(0,0,0,0.08) 4px
            );
            pointer-events: none;
            z-index: 999;
        }

        /* ═══════════════════════════════════════
           TOP STATUS BAR (UNIQUE ELEMENT)
           Nothing like this in other templates
        ═══════════════════════════════════════ */
        .status-bar {
            position: sticky;
            top: 0;
            z-index: 500;
            background: rgba(6,10,15,0.97);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(20px);
            padding: 0 28px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: var(--mono);
            font-size: 11px;
        }
        .status-bar-left { display:flex; align-items:center; gap:20px; }
        .status-bar-right { display:flex; align-items:center; gap:20px; }

        /* Blinking status dot */
        .sb-dot {
            width: 7px; height: 7px; border-radius: 50%;
            display: inline-block; margin-right: 6px;
        }
        .sb-dot-green { background: var(--green); animation: blink-green 1.8s ease-in-out infinite; }
        .sb-dot-red   { background: var(--red);   animation: blink-red   2.4s ease-in-out infinite; }
        .sb-dot-amber { background: var(--amber);  animation: blink-amber 3s   ease-in-out infinite; }
        @keyframes blink-green { 0%,100%{opacity:1;box-shadow:0 0 6px var(--green);}  50%{opacity:.3;} }
        @keyframes blink-red   { 0%,100%{opacity:1;box-shadow:0 0 6px var(--red);}    50%{opacity:.4;} }
        @keyframes blink-amber { 0%,100%{opacity:1;box-shadow:0 0 6px var(--amber);}  50%{opacity:.4;} }

        .sb-status { color:var(--green); font-size:11px; }
        .sb-label  { color:var(--text-dim); font-size:10px; text-transform:uppercase; letter-spacing:1px; }
        .sb-val    { color:var(--text-bright); }
        .sb-divider{ width:1px; height:20px; background:var(--border-dim); }
        #sb-clock  { color:var(--green); font-size:12px; letter-spacing:1px; }

        /* ═══════════════════════════════════════
           PREVIEW BANNER
        ═══════════════════════════════════════ */
        .preview-banner {
            background: linear-gradient(90deg, #7c0000, var(--red));
            color: white;
            padding: 11px 20px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,59,48,0.5);
        }
        .preview-banner a { color:white; text-decoration:underline; font-weight:700; margin-left:6px; }

        /* ═══════════════════════════════════════
           HERO — FULL-SCREEN SURVEILLANCE PHOTO
           BG: Control room / server room
        ═══════════════════════════════════════ */
        .hero-surveillance {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;

            background-image:
                /* Green tint overlay */
                linear-gradient(
                    to bottom,
                    rgba(6,10,15,0.30) 0%,
                    rgba(6,10,15,0.45) 30%,
                    rgba(6,10,15,0.75) 65%,
                    rgba(6,10,15,1.00) 100%
                ),
                /* Hero bg — security control room */
                url('https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=1920&q=85');
            background-size: cover;
            background-position: center;
        }

        /* Animated horizontal scan line across hero */
        .hero-scanline {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--green), transparent);
            opacity: 0.5;
            animation: hero-scan 6s linear infinite;
            pointer-events: none;
        }
        @keyframes hero-scan { 0%{top:0} 100%{top:100%} }

        /* Corner bracket decorations — camera-feed style */
        .hero-corner {
            position: absolute;
            width: 40px; height: 40px;
            pointer-events: none;
        }
        .hero-corner-tl { top:16px; left:16px; border-top:2px solid var(--green); border-left:2px solid var(--green); }
        .hero-corner-tr { top:16px; right:16px; border-top:2px solid var(--green); border-right:2px solid var(--green); }
        .hero-corner-bl { bottom:50%; left:16px; border-bottom:2px solid var(--green); border-left:2px solid var(--green); }
        .hero-corner-br { bottom:50%; right:16px; border-bottom:2px solid var(--green); border-right:2px solid var(--green); }

        /* REC indicator */
        .hero-rec {
            position: absolute;
            top: 20px; left: 50%;
            transform: translateX(-50%);
            display: flex; align-items:center; gap:8px;
            font-family: var(--mono); font-size:11px;
            color: var(--red); letter-spacing:2px;
        }
        .hero-rec-dot {
            width: 8px; height: 8px; background:var(--red); border-radius:50%;
            animation: blink-red 1s ease-in-out infinite;
        }

        /* Camera ID label */
        .hero-cam-id {
            position: absolute;
            top: 44px; left: 22px;
            font-family: var(--mono); font-size:10px;
            color: rgba(0,255,136,0.55);
            letter-spacing: 1px;
        }

        /* Timestamp label */
        .hero-timestamp {
            position: absolute;
            top: 44px; right: 22px;
            font-family: var(--mono); font-size:10px;
            color: rgba(0,255,136,0.55);
            letter-spacing: 1px;
        }

        /* Hero inner — identity content at bottom */
        .hero-identity {
            position: relative;
            z-index: 5;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 0 32px 64px;
            display: grid;
            grid-template-columns: auto 1fr;
            align-items: flex-end;
            gap: 40px;
        }

        /* Profile photo — night-vision circle ring */
        .hero-photo-wrap { position:relative; flex-shrink:0; }
        .hero-photo-ring {
            width: 180px; height: 180px;
            padding: 3px;
            background: conic-gradient(var(--green) 0deg, var(--green-dim) 90deg, transparent 180deg, var(--green) 360deg);
            border-radius: 50%;
            box-shadow: 0 0 30px var(--green-glow), 0 0 60px rgba(0,255,136,0.08);
            animation: ring-spin 8s linear infinite;
        }
        @keyframes ring-spin { from{transform:rotate(0)} to{transform:rotate(360deg)} }
        .hero-photo-inner {
            width: 100%; height: 100%;
            border-radius: 50%;
            overflow: hidden;
            background: var(--bg-mid);
            border: 2px solid var(--bg);
        }
        .hero-photo-inner img { width:100%; height:100%; object-fit:cover; filter:saturate(0.7) brightness(0.9); }
        .hero-photo-placeholder {
            width:100%; height:100%;
            display:flex; align-items:center; justify-content:center;
            background: linear-gradient(135deg, var(--bg-mid), var(--steel));
            color:var(--green); font-size:60px;
        }

        /* Status ring label */
        .hero-photo-status {
            position:absolute; bottom:6px; left:50%; transform:translateX(-50%);
            background:var(--green); color:var(--bg);
            font-family:var(--mono); font-size:9px; font-weight:700;
            letter-spacing:2px; text-transform:uppercase;
            padding:2px 10px; border-radius:2px;
            white-space:nowrap;
        }

        /* Hero text block */
        .hero-text { padding-bottom:8px; }
        .hero-cert-tag {
            display:inline-flex; align-items:center; gap:8px;
            padding:5px 14px;
            border:1px solid rgba(255,59,48,0.4);
            background:rgba(255,59,48,0.08);
            border-radius:3px;
            font-family:var(--mono); font-size:10px;
            color:var(--red); letter-spacing:2px; text-transform:uppercase;
            margin-bottom:16px;
        }
        .hero-name {
            font-family:'Rajdhani',sans-serif;
            font-size: clamp(38px,6vw,76px);
            font-weight:700; color:var(--text-bright);
            line-height:1; margin-bottom:10px;
            text-shadow:0 0 40px rgba(0,255,136,0.15);
            letter-spacing:1px;
        }
        .hero-desig {
            font-family:var(--mono); font-size:14px;
            color:var(--green); letter-spacing:3px;
            text-transform:uppercase; margin-bottom:24px;
        }
        .hero-desig::before { content:'> '; opacity:.6; }

        /* Hero tags */
        .hero-tags { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:32px; }
        .hero-tag {
            display:flex; align-items:center; gap:8px;
            padding:8px 16px;
            background:rgba(0,255,136,0.06);
            border:1px solid rgba(0,255,136,0.2);
            border-radius:3px;
            font-family:var(--mono); font-size:11px;
            color:rgba(255,255,255,0.7); letter-spacing:1px;
        }
        .hero-tag i { color:var(--green); }

        /* Hero action buttons */
        .hero-btns { display:flex; flex-wrap:wrap; gap:12px; }
        .btn-green {
            display:inline-flex; align-items:center; gap:9px;
            padding:14px 28px;
            background:var(--green); color:var(--bg);
            font-family:'Rajdhani',sans-serif; font-size:14px; font-weight:700;
            letter-spacing:2px; text-transform:uppercase;
            border:none; border-radius:3px; text-decoration:none;
            transition:all .3s;
            box-shadow:0 0 20px rgba(0,255,136,0.3), 0 8px 24px rgba(0,0,0,0.4);
        }
        .btn-green:hover { background:var(--green-dim); transform:translateY(-2px); box-shadow:0 0 30px rgba(0,255,136,0.5); }
        .btn-outline-green {
            display:inline-flex; align-items:center; gap:9px;
            padding:12px 24px;
            background:transparent; color:var(--green);
            font-family:'Rajdhani',sans-serif; font-size:14px; font-weight:600;
            letter-spacing:2px; text-transform:uppercase;
            border:1px solid rgba(0,255,136,0.4);
            border-radius:3px; text-decoration:none; transition:all .3s;
        }
        .btn-outline-green:hover { background:rgba(0,255,136,0.08); border-color:var(--green); color:var(--green); }
        .btn-whatsapp-g {
            display:inline-flex; align-items:center; gap:9px;
            padding:12px 24px;
            background:rgba(37,211,102,0.12); color:#25d366;
            font-family:'Rajdhani',sans-serif; font-size:14px; font-weight:600;
            letter-spacing:2px; text-transform:uppercase;
            border:1px solid rgba(37,211,102,0.3);
            border-radius:3px; text-decoration:none; transition:all .3s;
        }
        .btn-whatsapp-g:hover { background:rgba(37,211,102,0.22); color:#25d366; }

        /* ═══════════════════════════════════════
           MAIN CONTENT WRAPPER
        ═══════════════════════════════════════ */
        .main-wrap {
            position:relative; z-index:10;
            max-width:1200px; margin:0 auto;
            padding:0 32px 80px;
        }

        /* ── Section Header — unique terminal style ── */
        .sec-hdr {
            display:flex; align-items:center; gap:16px;
            margin:64px 0 32px;
        }
        .sec-hdr-bracket {
            font-family:var(--mono); font-size:22px; color:var(--green); opacity:.5;
        }
        .sec-hdr-inner { flex:1; }
        .sec-hdr-eyebrow {
            font-family:var(--mono); font-size:10px;
            color:var(--green); letter-spacing:3px;
            text-transform:uppercase; margin-bottom:5px; opacity:.7;
        }
        .sec-hdr-title {
            font-family:'Rajdhani',sans-serif;
            font-size:clamp(24px,3.5vw,38px); font-weight:700;
            color:var(--text-bright); letter-spacing:1px; text-transform:uppercase;
        }
        .sec-hdr-title span { color:var(--green); }
        .sec-hdr-line { flex:1; height:1px; background:linear-gradient(90deg, var(--border), transparent); }

        /* ═══════════════════════════════════════
           ABOUT PANEL — Split layout with bg image
        ═══════════════════════════════════════ */
        .about-panel {
            display:grid; grid-template-columns:1.2fr 0.8fr;
            gap:0; border-radius:12px; overflow:hidden;
            border:1px solid var(--border);
            box-shadow:0 16px 50px rgba(0,0,0,0.5);
            margin-top:48px;
        }
        .about-panel-left {
            background:var(--bg-panel);
            padding:44px 40px;
            position:relative;
        }
        .about-panel-left::before {
            content:''; position:absolute; top:0; left:0; bottom:0; width:2px;
            background:linear-gradient(180deg, var(--green), transparent);
        }
        .about-text {
            font-size:15px; line-height:2; color:var(--text);
            font-weight:300;
        }
        .about-panel-right {
            position:relative; min-height:280px;
            background-image:
                linear-gradient(to right, var(--bg-panel) 0%, rgba(13,21,32,0.60) 40%, rgba(13,21,32,0.10) 100%),
                url('https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=900&q=80');
            background-size:cover; background-position:center;
            display:flex; flex-direction:column; justify-content:center;
            padding:40px 32px;
        }
        /* Camera-feed corner brackets on about right */
        .about-panel-right::before {
            content:''; position:absolute; top:12px; right:12px;
            width:24px; height:24px;
            border-top:2px solid var(--green); border-right:2px solid var(--green);
            opacity:.4;
        }
        .about-panel-right::after {
            content:''; position:absolute; bottom:12px; right:12px;
            width:24px; height:24px;
            border-bottom:2px solid var(--green); border-right:2px solid var(--green);
            opacity:.4;
        }
        .about-quick-stats { display:flex; flex-direction:column; gap:14px; }
        .aqs-item {
            display:flex; align-items:center; gap:14px;
            padding:14px 16px;
            background:rgba(0,255,136,0.05);
            border:1px solid rgba(0,255,136,0.12);
            border-radius:6px;
        }
        .aqs-icon { font-size:16px; color:var(--green); width:20px; text-align:center; flex-shrink:0; }
        .aqs-num { font-family:'Rajdhani',sans-serif; font-size:22px; font-weight:700; color:var(--text-bright); margin-bottom:2px; }
        .aqs-label { font-family:var(--mono); font-size:10px; color:var(--text-dim); letter-spacing:1px; text-transform:uppercase; }

        /* ═══════════════════════════════════════
           LIVE STATS ROW
           BG: server room photo
        ═══════════════════════════════════════ */
        .stats-row {
            margin-top:56px; border-radius:12px; overflow:hidden;
            position:relative;
            background-image:
                linear-gradient(90deg, rgba(6,10,15,0.96) 0%, rgba(6,10,15,0.80) 50%, rgba(6,10,15,0.96) 100%),
                url('https://images.unsplash.com/photo-1518770660439-4636190af475?w=1920&q=80');
            background-size:cover; background-position:center;
            border:1px solid var(--border);
            box-shadow:0 0 40px rgba(0,0,0,0.5);
        }
        .stats-row::before { content:''; position:absolute; top:0;left:0;right:0; height:1px; background:linear-gradient(90deg,transparent,var(--green),transparent); }
        .stats-row::after  { content:''; position:absolute; bottom:0;left:0;right:0; height:1px; background:linear-gradient(90deg,transparent,var(--green),transparent); }

        .stats-inner {
            position:relative; z-index:2; width:100%;
            display:grid; grid-template-columns:repeat(5,1fr);
            padding:40px 0;
        }
        .stat-lx {
            text-align:center; padding:20px 12px;
            border-right:1px solid var(--border-dim);
            position:relative;
        }
        .stat-lx:last-child { border-right:none; }
        /* Scan animation on hover */
        .stat-lx::after {
            content:''; position:absolute; top:0;left:0;right:0; height:2px;
            background:var(--green); transform:scaleX(0);
            transition:transform .4s; opacity:.5;
        }
        .stat-lx:hover::after { transform:scaleX(1); }
        .stat-icon { font-size:22px; color:var(--green); margin-bottom:12px; opacity:.7; }
        .stat-num {
            font-family:'Rajdhani',sans-serif; font-size:42px; font-weight:700;
            color:var(--text-bright); line-height:1; margin-bottom:6px;
            text-shadow:0 0 20px rgba(0,255,136,0.25);
        }
        .stat-num sup { font-size:18px; color:var(--green); }
        .stat-label { font-family:var(--mono); font-size:9px; color:var(--text-dim); text-transform:uppercase; letter-spacing:1.5px; }

        /* ═══════════════════════════════════════
           SERVICES — CAMERA FEED GRID
           Each service panel looks like a CCTV feed
        ═══════════════════════════════════════ */
        .cam-feed-grid {
            display:grid; grid-template-columns:repeat(2,1fr);
            gap:3px;
            background:var(--border-dim);
            border-radius:12px; overflow:hidden;
            border:1px solid var(--border);
            box-shadow:0 16px 50px rgba(0,0,0,0.6);
        }
        .cam-panel {
            background:var(--bg-panel);
            padding:28px;
            position:relative;
            transition:background .3s;
        }
        .cam-panel:hover { background:var(--bg-card); }

        /* Camera ID badge — top left */
        .cam-id {
            position:absolute; top:10px; left:12px;
            font-family:var(--mono); font-size:9px;
            color:rgba(0,255,136,0.5); letter-spacing:1px;
        }

        /* Record indicator — top right */
        .cam-rec-badge {
            position:absolute; top:10px; right:12px;
            font-family:var(--mono); font-size:9px;
            color:var(--red); letter-spacing:1px;
            display:flex; align-items:center; gap:4px;
        }
        .cam-rec-dot { width:6px; height:6px; background:var(--red); border-radius:50%; animation:blink-red 1s ease-in-out infinite; }

        /* Corner brackets */
        .cam-panel::before {
            content:''; position:absolute; bottom:10px; right:10px;
            width:20px; height:20px;
            border-bottom:1px solid rgba(0,255,136,0.2);
            border-right:1px solid rgba(0,255,136,0.2);
        }

        .cam-icon {
            width:56px; height:56px;
            border-radius:8px;
            background:linear-gradient(135deg, rgba(0,255,136,0.12), rgba(0,255,136,0.04));
            border:1px solid rgba(0,255,136,0.2);
            display:flex; align-items:center; justify-content:center;
            font-size:22px; color:var(--green);
            margin-bottom:18px;
            margin-top:16px;
        }
        .cam-title {
            font-family:'Rajdhani',sans-serif; font-size:20px; font-weight:700;
            color:var(--text-bright); text-transform:uppercase; letter-spacing:1px;
            margin-bottom:16px;
        }
        .cam-service-list { display:flex; flex-direction:column; gap:8px; }
        .cam-service-item {
            display:flex; align-items:center; gap:10px;
            padding:9px 12px;
            background:rgba(0,0,0,0.2); border-radius:4px;
            border-left:2px solid rgba(0,255,136,0.3);
            font-size:13px; color:var(--text);
            transition:border-color .3s;
        }
        .cam-service-item:hover { border-left-color:var(--green); color:var(--text-bright); }
        .cam-service-item i { color:var(--green); font-size:11px; width:14px; }

        /* ═══════════════════════════════════════
           CUSTOM SERVICES FROM DB
        ═══════════════════════════════════════ */
        .services-db-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
            gap:16px;
        }
        .srv-db-card {
            background:var(--bg-panel);
            border:1px solid var(--border-dim);
            border-radius:10px; padding:24px;
            position:relative; overflow:hidden;
            transition:all .3s;
        }
        .srv-db-card::before { content:''; position:absolute; top:0;left:0; bottom:0; width:2px; background:var(--green); transform:scaleY(0); transition:transform .3s; }
        .srv-db-card:hover::before { transform:scaleY(1); }
        .srv-db-card:hover { border-color:var(--border); transform:translateX(4px); }
        .srv-db-name { font-family:'Rajdhani',sans-serif; font-size:17px; font-weight:700; color:var(--text-bright); margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px; }
        .srv-db-desc { font-size:13px; color:var(--text-dim); line-height:1.7; }
        .srv-db-price { font-family:'Rajdhani',sans-serif; font-size:22px; font-weight:700; color:var(--green); margin-top:12px; }

        /* ═══════════════════════════════════════
           PRODUCTS — SPEC SHEET CARDS
           BG: Tech product bg
        ═══════════════════════════════════════ */
        .products-section-wrap {
            margin-top:64px; border-radius:12px; overflow:hidden;
            position:relative;
            background-image:
                linear-gradient(135deg, rgba(6,10,15,0.97) 0%, rgba(13,21,32,0.94) 100%),
                url('https://images.unsplash.com/photo-1573167507387-6b4b98cb7c13?w=1920&q=80');
            background-size:cover; background-position:center;
            border:1px solid var(--border);
            padding:52px 44px;
        }
        .products-section-wrap::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--green),transparent); }

        .products-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
            gap:16px; margin-top:32px;
        }
        .prod-spec-card {
            background:rgba(0,0,0,0.3);
            border:1px solid var(--border-dim);
            border-radius:8px; overflow:hidden;
            transition:all .3s;
        }
        .prod-spec-card:hover { border-color:var(--border); transform:translateY(-4px); box-shadow:0 12px 36px rgba(0,0,0,0.5); }

        /* Product image area with camera-feed overlay */
        .prod-img-wrap {
            height:160px; position:relative;
            background:var(--bg-mid);
            overflow:hidden;
            display:flex; align-items:center; justify-content:center;
        }
        .prod-img-wrap img { width:100%; height:100%; object-fit:cover; filter:saturate(0.5) brightness(0.7); }
        .prod-img-placeholder { font-size:40px; color:var(--green); opacity:.3; }
        /* Overlay scan */
        .prod-img-wrap::after {
            content:''; position:absolute; inset:0;
            background:linear-gradient(to bottom, transparent 70%, rgba(0,255,136,0.06) 100%);
        }
        /* Corner brackets on product image */
        .prod-corner-tl { position:absolute; top:6px; left:6px; width:14px; height:14px; border-top:1px solid rgba(0,255,136,0.4); border-left:1px solid rgba(0,255,136,0.4); }
        .prod-corner-tr { position:absolute; top:6px; right:6px; width:14px; height:14px; border-top:1px solid rgba(0,255,136,0.4); border-right:1px solid rgba(0,255,136,0.4); }
        .prod-corner-bl { position:absolute; bottom:6px; left:6px; width:14px; height:14px; border-bottom:1px solid rgba(0,255,136,0.4); border-left:1px solid rgba(0,255,136,0.4); }

        .prod-body { padding:16px 18px; }
        .prod-cat { font-family:var(--mono); font-size:9px; color:var(--green); text-transform:uppercase; letter-spacing:2px; margin-bottom:6px; opacity:.7; }
        .prod-name { font-family:'Rajdhani',sans-serif; font-size:16px; font-weight:700; color:var(--text-bright); text-transform:uppercase; margin-bottom:4px; }
        .prod-brand { font-size:12px; color:var(--text-dim); margin-bottom:10px; }
        .prod-desc { font-size:12px; color:var(--text-dim); line-height:1.6; margin-bottom:10px; }
        .prod-price { font-family:'Rajdhani',sans-serif; font-size:22px; font-weight:700; color:var(--green); }
        .prod-price-label { font-family:var(--mono); font-size:9px; color:var(--text-dim); text-transform:uppercase; letter-spacing:1px; }

        /* ═══════════════════════════════════════
           PROJECTS TIMELINE
        ═══════════════════════════════════════ */
        .projects-timeline { position:relative; padding-left:40px; }
        .projects-timeline::before { content:''; position:absolute; left:12px; top:0; bottom:0; width:1px; background:linear-gradient(180deg, var(--green), transparent); opacity:.4; }

        .proj-item { position:relative; padding:0 0 36px 28px; }
        .proj-dot {
            position:absolute; left:-28px; top:6px;
            width:12px; height:12px;
            background:var(--green); border-radius:50%;
            border:2px solid var(--bg);
            box-shadow:0 0 10px var(--green-glow);
        }
        .proj-tag { font-family:var(--mono); font-size:10px; color:var(--green); letter-spacing:2px; text-transform:uppercase; margin-bottom:5px; opacity:.7; }
        .proj-client { font-family:'Rajdhani',sans-serif; font-size:20px; font-weight:700; color:var(--text-bright); text-transform:uppercase; margin-bottom:4px; }
        .proj-meta { font-size:13px; color:var(--text-dim); }

        /* ═══════════════════════════════════════
           AMC PLANS — COMPARISON CARDS
        ═══════════════════════════════════════ */
        .amc-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
            gap:20px;
        }
        .amc-card {
            background:var(--bg-panel);
            border:1px solid var(--border-dim);
            border-radius:10px; overflow:hidden;
            transition:all .3s;
            position:relative;
        }
        .amc-card:hover { border-color:var(--border); transform:translateY(-4px); box-shadow:0 0 30px rgba(0,255,136,0.08); }
        /* Active plan highlight */
        .amc-card-featured { border-color:rgba(0,255,136,0.35); }
        .amc-card-featured::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:var(--green); }

        .amc-head {
            background:rgba(0,0,0,0.2);
            padding:22px 24px 16px;
            border-bottom:1px solid var(--border-dim);
        }
        .amc-type { font-family:var(--mono); font-size:10px; color:var(--green); text-transform:uppercase; letter-spacing:2px; margin-bottom:6px; opacity:.7; }
        .amc-name { font-family:'Rajdhani',sans-serif; font-size:22px; font-weight:700; color:var(--text-bright); text-transform:uppercase; }
        .amc-price { font-family:'Rajdhani',sans-serif; font-size:34px; font-weight:700; color:var(--green); margin-top:8px; }
        .amc-body { padding:20px 24px; }
        .amc-feature {
            display:flex; align-items:center; gap:10px;
            padding:8px 0;
            border-bottom:1px solid var(--border-dim);
            font-size:13px; color:var(--text);
        }
        .amc-feature:last-child { border-bottom:none; }
        .amc-feature i { color:var(--green); font-size:11px; width:14px; }

        /* ═══════════════════════════════════════
           QUALIFICATIONS / EXPERIENCE
        ═══════════════════════════════════════ */
        .dual-col { display:grid; grid-template-columns:1fr 1fr; gap:32px; }
        .timeline-panel {
            background:var(--bg-panel);
            border:1px solid var(--border-dim);
            border-radius:10px; padding:28px 32px;
            position:relative;
        }
        .timeline-panel::before { content:''; position:absolute; top:0;left:0;right:0; height:1px; background:linear-gradient(90deg,var(--green),transparent); opacity:.4; }
        .tl-header { font-family:'Rajdhani',sans-serif; font-size:18px; font-weight:700; color:var(--text-bright); text-transform:uppercase; letter-spacing:1px; margin-bottom:22px; }
        .tl-header i { color:var(--green); margin-right:8px; }
        .tl-item { position:relative; padding-left:22px; padding-bottom:22px; border-left:1px solid rgba(0,255,136,0.15); margin-left:6px; }
        .tl-item:last-child { padding-bottom:0; border-left-color:transparent; }
        .tl-dot { position:absolute; left:-5px; top:4px; width:9px; height:9px; background:var(--green); border-radius:50%; box-shadow:0 0 8px var(--green-glow); }
        .tl-year { font-family:var(--mono); font-size:10px; color:var(--green); letter-spacing:2px; text-transform:uppercase; margin-bottom:4px; opacity:.7; }
        .tl-title { font-family:'Rajdhani',sans-serif; font-size:17px; font-weight:700; color:var(--text-bright); margin-bottom:3px; }
        .tl-sub { font-size:12px; color:var(--text-dim); }

        /* ═══════════════════════════════════════
           TESTIMONIALS — INTERCEPTED FEED STYLE
        ═══════════════════════════════════════ */
        .testi-section-wrap {
            margin-top:64px; border-radius:12px; overflow:hidden;
            position:relative;
            background-image:
                linear-gradient(135deg, rgba(6,10,15,0.97) 0%, rgba(13,21,32,0.95) 100%),
                url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920&q=50');
            background-size:cover; background-position:center;
            border:1px solid var(--border);
            padding:52px 44px;
        }
        .testi-section-wrap::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--green),transparent); }

        .testi-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
            gap:18px; margin-top:32px;
        }
        .testi-card {
            background:rgba(0,0,0,0.25);
            border:1px solid var(--border-dim);
            border-radius:8px; padding:26px;
            position:relative; transition:all .3s;
        }
        .testi-card:hover { border-color:var(--border); }
        /* intercepted signal corner */
        .testi-card::before { content:''; position:absolute; top:10px; left:10px; width:16px; height:16px; border-top:1px solid rgba(0,255,136,0.3); border-left:1px solid rgba(0,255,136,0.3); }
        .testi-feed-id { font-family:var(--mono); font-size:9px; color:var(--green); letter-spacing:2px; text-transform:uppercase; opacity:.5; margin-bottom:12px; }
        .testi-text { font-size:13px; color:var(--text); line-height:1.85; font-style:italic; margin-bottom:18px; }
        .testi-author { display:flex; align-items:center; gap:12px; }
        .testi-avatar-tag {
            width:38px; height:38px;
            background:rgba(0,255,136,0.1);
            border:1px solid rgba(0,255,136,0.25);
            border-radius:6px;
            display:flex; align-items:center; justify-content:center;
            font-family:'Rajdhani',sans-serif; font-size:16px; font-weight:700;
            color:var(--green);
        }
        .testi-name { font-family:'Rajdhani',sans-serif; font-size:15px; font-weight:700; color:var(--text-bright); text-transform:uppercase; }
        .testi-role { font-family:var(--mono); font-size:9px; color:var(--text-dim); letter-spacing:1px; margin-top:2px; }

        /* ═══════════════════════════════════════
           THOUGHTS / BLOG
        ═══════════════════════════════════════ */
        .thoughts-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
            gap:18px;
        }
        .thought-card {
            background:var(--bg-panel);
            border:1px solid var(--border-dim);
            border-radius:10px; overflow:hidden; transition:all .3s;
        }
        .thought-card:hover { border-color:var(--border); transform:translateY(-3px); }
        .thought-img { height:160px; overflow:hidden; }
        .thought-img img { width:100%; height:100%; object-fit:cover; filter:saturate(0.4) brightness(0.7); transition:transform .5s; }
        .thought-card:hover .thought-img img { transform:scale(1.05); filter:saturate(0.6) brightness(0.8); }
        .thought-body { padding:18px; }
        .thought-date { font-family:var(--mono); font-size:9px; color:var(--green); letter-spacing:2px; text-transform:uppercase; margin-bottom:7px; opacity:.7; }
        .thought-title { font-family:'Rajdhani',sans-serif; font-size:17px; font-weight:700; color:var(--text-bright); text-transform:uppercase; margin-bottom:6px; }
        .thought-desc { font-size:12px; color:var(--text-dim); line-height:1.7; }

        /* ═══════════════════════════════════════
           VIDEO GALLERY
        ═══════════════════════════════════════ */
        .video-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:16px; }
        .video-card { border-radius:8px; overflow:hidden; aspect-ratio:16/9; border:1px solid var(--border-dim); }
        .video-card iframe { width:100%; height:100%; border:none; display:block; }
        .video-placeholder { width:100%; height:100%; background:var(--bg-panel); display:flex; align-items:center; justify-content:center; }
        .video-play-btn { width:56px; height:56px; border-radius:50%; background:var(--green); display:flex; align-items:center; justify-content:center; color:var(--bg); font-size:18px; padding-left:4px; box-shadow:0 0 20px var(--green-glow); }

        /* ═══════════════════════════════════════
           UPLOAD FILES / DOCS
        ═══════════════════════════════════════ */
        .docs-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:14px; }
        .doc-card {
            background:var(--bg-panel);
            border:1px solid var(--border-dim);
            border-radius:8px; padding:18px 20px;
            display:flex; align-items:center; gap:14px; transition:all .3s;
        }
        .doc-card:hover { border-color:var(--border); transform:translateY(-2px); }
        .doc-icon { width:44px; height:44px; flex-shrink:0; background:rgba(0,255,136,0.08); border:1px solid rgba(0,255,136,0.2); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:18px; color:var(--green); }
        .doc-name { font-family:'Rajdhani',sans-serif; font-size:15px; font-weight:700; color:var(--text-bright); text-transform:uppercase; }
        .doc-sub { font-family:var(--mono); font-size:10px; color:var(--text-dim); margin-top:2px; letter-spacing:1px; }
        .doc-dl { margin-left:auto; color:var(--green); font-size:16px; transition:transform .2s; text-decoration:none; }
        .doc-dl:hover { transform:translateY(-2px); color:var(--green-dim); }

        /* ═══════════════════════════════════════
           CTA — EMERGENCY ALERT SECTION
           BG: Dramatic surveillance photo
        ═══════════════════════════════════════ */
        .cta-emergency {
            margin-top:64px; border-radius:12px; overflow:hidden;
            position:relative; min-height:380px;
            display:flex; align-items:center; justify-content:center; text-align:center;
            background-image:
                linear-gradient(135deg, rgba(6,10,15,0.90) 0%, rgba(6,10,15,0.75) 50%, rgba(6,10,15,0.90) 100%),
                url('https://images.unsplash.com/photo-1504309092620-4d0ec726efa4?w=1920&q=85');
            background-size:cover; background-position:center;
            border:1px solid rgba(255,59,48,0.2);
            box-shadow:0 0 40px rgba(0,0,0,0.7), inset 0 0 80px rgba(255,59,48,0.03);
        }
        .cta-emergency::before { content:''; position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--red),transparent); }
        .cta-emergency::after  { content:''; position:absolute; bottom:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--green),transparent); }

        /* Animated scan over CTA */
        .cta-scan { position:absolute; top:0;left:0;right:0; height:2px; background:linear-gradient(90deg,transparent,var(--green),transparent); opacity:.3; animation:cta-scan-anim 5s linear infinite; }
        @keyframes cta-scan-anim { 0%{top:0} 100%{top:100%} }

        /* Alert dots pattern */
        .cta-dots { position:absolute; inset:0; background-image:radial-gradient(circle, rgba(0,255,136,0.06) 1px, transparent 1px); background-size:36px 36px; pointer-events:none; }
        .cta-inner { position:relative; z-index:2; padding:64px 32px; max-width:680px; }

        .cta-alert-tag {
            display:inline-flex; align-items:center; gap:8px;
            padding:6px 18px; border:1px solid rgba(255,59,48,0.4); border-radius:3px;
            font-family:var(--mono); font-size:10px; color:var(--red);
            letter-spacing:3px; text-transform:uppercase; margin-bottom:24px;
        }
        .cta-alert-dot { width:6px; height:6px; background:var(--red); border-radius:50%; animation:blink-red 1s ease-in-out infinite; }
        .cta-title {
            font-family:'Rajdhani',sans-serif;
            font-size:clamp(32px,5vw,56px); font-weight:700;
            color:var(--text-bright); line-height:1.1; margin-bottom:16px;
            text-transform:uppercase; letter-spacing:1px;
        }
        .cta-title span { color:var(--green); }
        .cta-sub { font-size:15px; color:var(--text); line-height:1.75; margin-bottom:36px; }
        .cta-btns { display:flex; justify-content:center; gap:14px; flex-wrap:wrap; }

        /* ═══════════════════════════════════════
           CONTACT — TACTICAL STRIP
        ═══════════════════════════════════════ */
        .contact-strip { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:14px; }
        .contact-tile {
            background:var(--bg-panel);
            border:1px solid var(--border-dim);
            border-radius:8px; padding:20px 22px;
            display:flex; align-items:center; gap:16px;
            transition:all .3s; text-decoration:none; color:inherit;
        }
        .contact-tile:hover { border-color:var(--border); transform:translateY(-2px); color:inherit; }
        .contact-tile-icon {
            width:46px; height:46px; flex-shrink:0;
            border-radius:8px;
            background:rgba(0,255,136,0.08);
            border:1px solid rgba(0,255,136,0.2);
            display:flex; align-items:center; justify-content:center;
            font-size:18px; color:var(--green);
        }
        .ct-label { font-family:var(--mono); font-size:9px; color:var(--text-dim); text-transform:uppercase; letter-spacing:2px; margin-bottom:4px; }
        .ct-val { font-family:'Rajdhani',sans-serif; font-size:17px; font-weight:700; color:var(--text-bright); }

        /* ═══════════════════════════════════════
           SOCIAL LINKS
        ═══════════════════════════════════════ */
        .social-lx-row { display:flex; justify-content:center; gap:12px; flex-wrap:wrap; margin-top:40px; }
        .social-lx-btn {
            display:flex; align-items:center; gap:9px;
            padding:11px 22px;
            background:rgba(0,255,136,0.05);
            border:1px solid rgba(0,255,136,0.15);
            border-radius:4px; color:var(--text); font-size:13px; font-weight:600;
            text-decoration:none; transition:all .3s; font-family:'Rajdhani',sans-serif;
            text-transform:uppercase; letter-spacing:1px;
        }
        .social-lx-btn i { font-size:15px; }
        .social-lx-btn:hover { border-color:var(--green); color:var(--green); background:rgba(0,255,136,0.08); transform:translateY(-3px); }

        /* ═══════════════════════════════════════
           FOOTER — STATUS BAR MINIMAL
        ═══════════════════════════════════════ */
        .lx-footer {
            background:rgba(0,0,0,0.8);
            border-top:1px solid var(--border-dim);
            padding:20px 32px;
            display:flex; align-items:center; justify-content:space-between;
            font-family:var(--mono); font-size:10px; color:var(--text-dim);
            margin-top:80px;
        }
        .lx-footer a { color:var(--green); text-decoration:none; }
        .lx-footer a:hover { color:var(--green-dim); }
        .footer-status { display:flex; align-items:center; gap:8px; }
        .footer-brand { font-family:'Rajdhani',sans-serif; font-size:16px; color:var(--text-bright); font-weight:700; text-transform:uppercase; letter-spacing:2px; }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width:1024px) {
            .stats-inner { grid-template-columns:repeat(3,1fr); }
            .cam-feed-grid { grid-template-columns:1fr; }
            .dual-col { grid-template-columns:1fr; }
            .about-panel { grid-template-columns:1fr; }
        }
        @media (max-width:768px) {
            .hero-surveillance { min-height:auto; }
            .hero-identity { grid-template-columns:1fr; align-items:center; text-align:center; padding:0 20px 48px; }
            .hero-tags { justify-content:center; }
            .hero-btns { flex-direction:column; align-items:center; }
            .hero-photo-ring { width:140px; height:140px; margin:0 auto; }
            .main-wrap { padding:0 16px 60px; }
            .stats-inner { grid-template-columns:repeat(2,1fr); }
            .about-panel-right { min-height:200px; }
            .products-section-wrap { padding:36px 22px; }
            .testi-section-wrap { padding:36px 22px; }
            .cta-inner { padding:48px 20px; }
            .cta-btns { flex-direction:column; align-items:center; }
            .lx-footer { flex-direction:column; gap:10px; text-align:center; }
            .status-bar { display:none; }
        }
    </style>
</head>
<body>

    @include('frontend.profile-themes.partials.profile-top-actions')

    @if($isPreview ?? false)
    <div class="preview-banner">
        <i class="fas fa-eye"></i> Preview Mode —
        <a href="{{ url('/signin') }}">Sign up</a> to publish your security profile!
    </div>
    @endif

    <!-- ══════════════════════════════════════════
         TOP STATUS BAR — Live dashboard strip
    ══════════════════════════════════════════ -->
    <div class="status-bar">
        <div class="status-bar-left">
            <span class="sb-status">
                <span class="sb-dot sb-dot-green"></span>SYSTEM ONLINE
            </span>
            <span class="sb-divider"></span>
            <span>
                <span class="sb-dot sb-dot-green"></span>
                <span class="sb-val">{{ $userdata->name ?? 'SECURITY SYSTEMS' }}</span>
            </span>
            <span class="sb-divider"></span>
            <span class="sb-label">MODE: <span class="sb-val" style="color:var(--green);">ACTIVE MONITORING</span></span>
        </div>
        <div class="status-bar-right">
            <span>
                <span class="sb-dot sb-dot-amber"></span>
                <span class="sb-label">ALERTS: </span>
                <span class="sb-val" style="color:var(--amber);">0 CRITICAL</span>
            </span>
            <span class="sb-divider"></span>
            <span id="sb-clock">--:--:--</span>
        </div>
    </div>


    <!-- ══════════════════════════════════════════
         HERO — FULL-SCREEN SURVEILLANCE ROOM
    ══════════════════════════════════════════ -->
    <section class="hero-surveillance">

        <!-- Scan line -->
        <div class="hero-scanline"></div>

        <!-- Camera UI overlays -->
        <div class="hero-corner hero-corner-tl"></div>
        <div class="hero-corner hero-corner-tr"></div>
        <div class="hero-corner hero-corner-bl"></div>
        <div class="hero-corner hero-corner-br"></div>

        <div class="hero-rec">
            <span class="hero-rec-dot"></span>
            REC
        </div>
        <div class="hero-cam-id">CAM_01 / MAIN-PROFILE</div>
        <div class="hero-timestamp" id="hero-ts">00:00:00 — 00/00/0000</div>

        <!-- Identity content -->
        <div class="hero-identity">

            <!-- Profile Photo -->
            <div class="hero-photo-wrap">
                <div class="hero-photo-ring">
                    <div class="hero-photo-inner">
                        @if($userdata->isFeatureVisible('profile_photo') && ($userdata->profile ?? false))
                            <img src="{{ url('public/frontend/user_images/'.$userdata->profile) }}"
                                 alt="{{ $userdata->name }}" loading="lazy">
                        @else
                            <div class="hero-photo-placeholder">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="hero-photo-status">VERIFIED</div>
            </div>

            <!-- Text Info -->
            <div class="hero-text">
                <div class="hero-cert-tag">
                    <i class="fas fa-certificate"></i>
                    Certified Security Professional
                </div>

                @if($userdata->isFeatureVisible('name'))
                <h1 class="hero-name">{{ $userdata->name ?? 'Security Systems' }}</h1>
                @endif

                @if($userdata->isFeatureVisible('designation') && ($userdata->desig ?? false))
                <p class="hero-desig">{{ $userdata->desig }}</p>
                @endif

                <div class="hero-tags">
                    <div class="hero-tag"><i class="fas fa-shield-halved"></i>&nbsp;24/7 Protection</div>
                    @if($userdata->city ?? false)
                    <div class="hero-tag"><i class="fas fa-map-marker-alt"></i>&nbsp;{{ $userdata->city }}{{ ($userdata->state ?? false) ? ', '.$userdata->state : '' }}</div>
                    @endif
                    <div class="hero-tag"><i class="fas fa-award"></i>&nbsp;Licensed & Insured</div>
                    <div class="hero-tag"><i class="fas fa-bolt"></i>&nbsp;&lt;15 Min Response</div>
                </div>

                <div class="hero-btns">
                    @if($userdata->isFeatureVisible('contact_number') && ($userdata->mobile ?? false))
                    <a href="tel:{{ $userdata->mobile }}" class="btn-green">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                    @endif
                    @if(isset($social->whatsapp) && $social->whatsapp)
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="btn-whatsapp-g" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif
                    @if($userdata->isFeatureVisible('email') && ($userdata->email ?? false))
                    <a href="mailto:{{ $userdata->email }}" class="btn-outline-green">
                        <i class="fas fa-envelope"></i> Email
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════ -->
    <div class="main-wrap">


        <!-- ──────────────────────────────────
             ABOUT — SPLIT PANEL
        ────────────────────────────────── -->
        @if($userdata->isFeatureVisible('bio') && ($userdata->about_us ?? false))
        <div class="about-panel">
            <div class="about-panel-left">
                <div class="sec-hdr-eyebrow" style="margin-bottom:14px;">[ MISSION BRIEF ]</div>
                <p class="about-text">{{ $userdata->about_us }}</p>
            </div>
            <div class="about-panel-right">
                <div class="about-quick-stats">
                    <div class="aqs-item">
                        <div class="aqs-icon"><i class="fas fa-shield-halved"></i></div>
                        <div>
                            <div class="aqs-num">24/7</div>
                            <div class="aqs-label">Active Monitoring</div>
                        </div>
                    </div>
                    <div class="aqs-item">
                        <div class="aqs-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <div class="aqs-num">&lt;15 Min</div>
                            <div class="aqs-label">Response Time</div>
                        </div>
                    </div>
                    <div class="aqs-item">
                        <div class="aqs-icon"><i class="fas fa-star"></i></div>
                        <div>
                            <div class="aqs-num">100%</div>
                            <div class="aqs-label">Client Satisfaction</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif


        <!-- ──────────────────────────────────
             STATS ROW — Server room bg
        ────────────────────────────────── -->
        <div class="stats-row">
            <div class="stats-inner">
                <div class="stat-lx">
                    <div class="stat-icon"><i class="fas fa-shield-halved"></i></div>
                    <div class="stat-num">24<sup>/7</sup></div>
                    <div class="stat-label">Monitoring</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div class="stat-num">&lt;15<sup>min</sup></div>
                    <div class="stat-label">Response</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-icon"><i class="fas fa-video"></i></div>
                    <div class="stat-num">500<sup>+</sup></div>
                    <div class="stat-label">Cams Installed</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-icon"><i class="fas fa-building"></i></div>
                    <div class="stat-num">200<sup>+</sup></div>
                    <div class="stat-label">Projects Done</div>
                </div>
                <div class="stat-lx">
                    <div class="stat-icon"><i class="fas fa-award"></i></div>
                    <div class="stat-num">5<sup>+</sup></div>
                    <div class="stat-label">Years Active</div>
                </div>
            </div>
        </div>


        <!-- ──────────────────────────────────
             SERVICES — CAMERA FEED GRID
        ────────────────────────────────── -->
        <div class="sec-hdr">
            <div class="sec-hdr-bracket">[</div>
            <div class="sec-hdr-inner">
                <div class="sec-hdr-eyebrow">What We Provide</div>
                <h2 class="sec-hdr-title">Our Security <span>Solutions</span></h2>
            </div>
            <div class="sec-hdr-bracket">]</div>
            <div class="sec-hdr-line"></div>
        </div>

        @if(isset($services) && $services->count() > 0)
        <!-- Dynamic services from DB -->
        <div class="services-db-grid">
            @foreach($services as $service)
            <div class="srv-db-card">
                <div class="srv-db-name">{{ $service->service_name ?? $service->title ?? $service->name ?? '' }}</div>
                @if($service->description ?? false)
                <div class="srv-db-desc">{{ Str::limit($service->description, 100) }}</div>
                @endif
                @if($service->price ?? false)
                <div class="srv-db-price">₹{{ number_format($service->price) }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <!-- Default 4-panel camera-feed grid -->
        <div class="cam-feed-grid">
            <!-- Panel 1 — CCTV Systems -->
            <div class="cam-panel">
                <span class="cam-id">CAM_01 / CCTV</span>
                <span class="cam-rec-badge"><span class="cam-rec-dot"></span>LIVE</span>
                <div class="cam-icon"><i class="fas fa-video"></i></div>
                <div class="cam-title">CCTV Systems</div>
                <div class="cam-service-list">
                    <div class="cam-service-item"><i class="fas fa-circle"></i> IP Cameras & NVR Setup</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> HD Analog Cameras</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Wireless Solutions</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Mobile Remote Viewing</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Night Vision & PTZ Cameras</div>
                </div>
            </div>
            <!-- Panel 2 — Alarm Systems -->
            <div class="cam-panel">
                <span class="cam-id">CAM_02 / ALARM</span>
                <span class="cam-rec-badge"><span class="cam-rec-dot"></span>LIVE</span>
                <div class="cam-icon"><i class="fas fa-bell"></i></div>
                <div class="cam-title">Alarm Systems</div>
                <div class="cam-service-list">
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Intrusion Detection</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Fire & Smoke Alarms</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Panic Button Systems</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> 24/7 Central Monitoring</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> GSM Alert Notifications</div>
                </div>
            </div>
            <!-- Panel 3 — Access Control -->
            <div class="cam-panel">
                <span class="cam-id">CAM_03 / ACCESS</span>
                <span class="cam-rec-badge"><span class="cam-rec-dot"></span>LIVE</span>
                <div class="cam-icon"><i class="fas fa-fingerprint"></i></div>
                <div class="cam-title">Access Control</div>
                <div class="cam-service-list">
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Biometric Systems</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> RFID Card Access</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Face Recognition</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Smart Lock Systems</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Visitor Management</div>
                </div>
            </div>
            <!-- Panel 4 — Networking -->
            <div class="cam-panel">
                <span class="cam-id">CAM_04 / NETWORK</span>
                <span class="cam-rec-badge"><span class="cam-rec-dot"></span>LIVE</span>
                <div class="cam-icon"><i class="fas fa-network-wired"></i></div>
                <div class="cam-title">Networking & PA</div>
                <div class="cam-service-list">
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Structured Cabling</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Wi-Fi Setup & Management</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Public Address Systems</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Intercom Solutions</div>
                    <div class="cam-service-item"><i class="fas fa-circle"></i> Surveillance Networking</div>
                </div>
            </div>
        </div>
        @endif


        <!-- ──────────────────────────────────
             PRODUCTS — Spec sheet with bg
        ────────────────────────────────── -->
        @if(isset($securityProducts) && $securityProducts->count() > 0)
        <div class="products-section-wrap">
            <div class="sec-hdr" style="margin-top:0;">
                <div class="sec-hdr-bracket">[</div>
                <div class="sec-hdr-inner">
                    <div class="sec-hdr-eyebrow lxsh-eyebrow-white">Equipment Catalog</div>
                    <h2 class="sec-hdr-title" style="color:white;">Security <span>Products</span></h2>
                </div>
                <div class="sec-hdr-bracket">]</div>
                <div class="sec-hdr-line"></div>
            </div>

            <div class="products-grid">
                @foreach($securityProducts as $product)
                <div class="prod-spec-card">
                    <div class="prod-img-wrap">
                        @if($product->image ?? false)
                            <img src="{{ url('uploads/security/products/'.$product->image) }}" alt="{{ $product->product_name }}" loading="lazy">
                        @else
                            <div class="prod-img-placeholder"><i class="fas fa-camera"></i></div>
                        @endif
                        <div class="prod-corner-tl"></div>
                        <div class="prod-corner-tr"></div>
                        <div class="prod-corner-bl"></div>
                    </div>
                    <div class="prod-body">
                        <div class="prod-cat">{{ $product->product_category ?? 'Security Product' }}</div>
                        <div class="prod-name">{{ $product->product_name }}</div>
                        @if($product->brand ?? false)
                        <div class="prod-brand">{{ $product->brand }}</div>
                        @endif
                        @if($product->description ?? false)
                        <div class="prod-desc">{{ Str::limit($product->description, 80) }}</div>
                        @endif
                        @if($product->price ?? false)
                        <div class="prod-price-label">Price</div>
                        <div class="prod-price">₹{{ number_format($product->price) }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif


        <!-- ──────────────────────────────────
             PROJECTS — Timeline
        ────────────────────────────────── -->
        @if(isset($securityProjects) && $securityProjects->count() > 0)
        <div class="sec-hdr">
            <div class="sec-hdr-bracket">[</div>
            <div class="sec-hdr-inner">
                <div class="sec-hdr-eyebrow">Track Record</div>
                <h2 class="sec-hdr-title">Completed <span>Projects</span></h2>
            </div>
            <div class="sec-hdr-bracket">]</div>
            <div class="sec-hdr-line"></div>
        </div>

        <div class="projects-timeline">
            @foreach($securityProjects as $project)
            <div class="proj-item">
                <div class="proj-dot"></div>
                <div class="proj-tag">
                    {{ $project->project_type ?? 'Security Installation' }}
                    @if($project->location ?? false) &nbsp;/ {{ $project->location }} @endif
                </div>
                <div class="proj-client">{{ $project->client_name ?? 'Client Project' }}</div>
                @if($project->description ?? false)
                <div class="proj-meta">{{ Str::limit($project->description, 100) }}</div>
                @endif
            </div>
            @endforeach
        </div>
        @endif


        <!-- ──────────────────────────────────
             AMC PLANS — Comparison cards
        ────────────────────────────────── -->
        @if(isset($securityAmc) && $securityAmc->count() > 0)
        <div class="sec-hdr">
            <div class="sec-hdr-bracket">[</div>
            <div class="sec-hdr-inner">
                <div class="sec-hdr-eyebrow">Maintenance Plans</div>
                <h2 class="sec-hdr-title">AMC <span>Plans</span></h2>
            </div>
            <div class="sec-hdr-bracket">]</div>
            <div class="sec-hdr-line"></div>
        </div>

        <div class="amc-grid">
            @foreach($securityAmc as $i => $plan)
            <div class="amc-card {{ $i === 1 ? 'amc-card-featured' : '' }}">
                <div class="amc-head">
                    <div class="amc-type">AMC Plan</div>
                    <div class="amc-name">{{ ucfirst($plan->amc_type ?? 'Standard') }}</div>
                    @if($plan->amc_amount ?? false)
                    <div class="amc-price">₹{{ number_format($plan->amc_amount) }}</div>
                    @endif
                </div>
                <div class="amc-body">
                    @if($plan->visit_frequency ?? false)
                    <div class="amc-feature"><i class="fas fa-check"></i> {{ $plan->visit_frequency }}</div>
                    @endif
                    @if($plan->response_time ?? false)
                    <div class="amc-feature"><i class="fas fa-check"></i> Response: {{ $plan->response_time }}</div>
                    @endif
                    @if($plan->parts_coverage ?? false)
                    <div class="amc-feature"><i class="fas fa-check"></i> Parts Coverage Included</div>
                    @endif
                    <div class="amc-feature"><i class="fas fa-check"></i> 24/7 Emergency Support</div>
                    <div class="amc-feature"><i class="fas fa-check"></i> Certified Technicians</div>
                </div>
            </div>
            @endforeach
        </div>
        @endif


        <!-- ──────────────────────────────────
             QUALIFICATIONS + EXPERIENCE
        ────────────────────────────────── -->
        @php
            $hasQual = ($menu->quali ?? 0) && isset($qualifications) && $qualifications->count() > 0;
            $hasExp  = ($menu->profess ?? 0) && isset($experiences) && $experiences->count() > 0;
        @endphp

        @if($hasQual || $hasExp)
        <div class="sec-hdr">
            <div class="sec-hdr-bracket">[</div>
            <div class="sec-hdr-inner">
                <div class="sec-hdr-eyebrow">Background</div>
                <h2 class="sec-hdr-title">Credentials & <span>Experience</span></h2>
            </div>
            <div class="sec-hdr-bracket">]</div>
            <div class="sec-hdr-line"></div>
        </div>

        <div class="dual-col">
            @if($hasQual)
            <div class="timeline-panel">
                <div class="tl-header"><i class="fas fa-graduation-cap"></i> Qualifications</div>
                @foreach($qualifications as $quali)
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    @if($quali->year ?? false)
                    <div class="tl-year">{{ $quali->year }}</div>
                    @endif
                    <div class="tl-title">{{ $quali->degree ?? $quali->title ?? '' }}</div>
                    @if($quali->institute ?? false)
                    <div class="tl-sub"><i class="fas fa-university" style="color:var(--green);margin-right:5px;font-size:10px;"></i>{{ $quali->institute }}</div>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div></div>
            @endif

            @if($hasExp)
            <div class="timeline-panel">
                <div class="tl-header"><i class="fas fa-briefcase"></i> Experience</div>
                @foreach($experiences as $exp)
                <div class="tl-item">
                    <div class="tl-dot" style="background:var(--cyan);box-shadow:0 0 8px rgba(0,212,255,0.4);"></div>
                    @if(($exp->from_year ?? false) || ($exp->to_year ?? false))
                    <div class="tl-year">
                        {{ $exp->from_year ?? '' }}
                        {{ (($exp->from_year ?? false) && ($exp->to_year ?? false)) ? '–' : '' }}
                        {{ $exp->to_year ?? '' }}
                    </div>
                    @endif
                    <div class="tl-title">{{ $exp->position ?? $exp->title ?? '' }}</div>
                    @if($exp->company ?? false)
                    <div class="tl-sub"><i class="fas fa-building" style="color:var(--cyan);margin-right:5px;font-size:10px;"></i>{{ $exp->company }}</div>
                    @endif
                    @if($exp->description ?? false)
                    <div class="tl-sub" style="margin-top:5px;line-height:1.6;">{{ Str::limit($exp->description, 100) }}</div>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div></div>
            @endif
        </div>
        @endif


        <!-- ──────────────────────────────────
             VIDEO GALLERY
        ────────────────────────────────── -->
        @if(($menu->videos ?? 0) && isset($videos) && $videos->count() > 0)
        <div class="sec-hdr">
            <div class="sec-hdr-bracket">[</div>
            <div class="sec-hdr-inner">
                <div class="sec-hdr-eyebrow">Footage Archive</div>
                <h2 class="sec-hdr-title">Video <span>Gallery</span></h2>
            </div>
            <div class="sec-hdr-bracket">]</div>
            <div class="sec-hdr-line"></div>
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
                <iframe src="https://www.youtube.com/embed/{{ $ytId }}?rel=0&modestbranding=1"
                    title="{{ $video->title ?? 'Video' }}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen loading="lazy"></iframe>
                @else
                <div class="video-placeholder">
                    <div class="video-play-btn"><i class="fas fa-play"></i></div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif


        <!-- ──────────────────────────────────
             TESTIMONIALS — Intercepted feed style
        ────────────────────────────────── -->
        @if(($menu->client ?? 0) && isset($clients) && $clients->count() > 0)
        <div class="testi-section-wrap">
            <div class="sec-hdr" style="margin-top:0;">
                <div class="sec-hdr-bracket">[</div>
                <div class="sec-hdr-inner">
                    <div class="sec-hdr-eyebrow" style="color:rgba(0,255,136,0.7);">Client Reports</div>
                    <h2 class="sec-hdr-title" style="color:white;">What Clients <span>Say</span></h2>
                </div>
                <div class="sec-hdr-bracket">]</div>
                <div class="sec-hdr-line"></div>
            </div>

            <div class="testi-grid">
                @foreach($clients as $i => $client)
                <div class="testi-card">
                    <div class="testi-feed-id">REPORT_{{ str_pad($i+1, 3, '0', STR_PAD_LEFT) }} / CLIENT</div>
                    <p class="testi-text">{{ $client->review ?? $client->message ?? $client->description ?? '' }}</p>
                    <div class="testi-author">
                        <div class="testi-avatar-tag">
                            @if($client->image ?? false)
                                <img src="{{ url('uploads/clients/'.$client->image) }}"
                                     style="width:100%;height:100%;object-fit:cover;border-radius:4px;" alt="">
                            @else
                                {{ strtoupper(substr($client->name ?? 'C', 0, 1)) }}
                            @endif
                        </div>
                        <div>
                            <div class="testi-name">{{ $client->name ?? 'Verified Client' }}</div>
                            <div class="testi-role">
                                <i class="fas fa-shield-halved" style="color:var(--green);margin-right:3px;font-size:9px;"></i>
                                {{ $client->location ?? $client->destination ?? 'Security Client' }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif


        <!-- ──────────────────────────────────
             THOUGHTS / BLOG
        ────────────────────────────────── -->
        @if(($menu->thought ?? 0) && isset($thoughts) && $thoughts->count() > 0)
        <div class="sec-hdr">
            <div class="sec-hdr-bracket">[</div>
            <div class="sec-hdr-inner">
                <div class="sec-hdr-eyebrow">Intelligence Feed</div>
                <h2 class="sec-hdr-title">Security <span>Insights</span></h2>
            </div>
            <div class="sec-hdr-bracket">]</div>
            <div class="sec-hdr-line"></div>
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
                    <div class="thought-date"><i class="fas fa-calendar" style="margin-right:4px;"></i>{{ \Carbon\Carbon::parse($thought->created_at)->format('d M Y') }}</div>
                    @endif
                    <div class="thought-title">{{ $thought->title ?? '' }}</div>
                    @if($thought->description ?? false)
                    <div class="thought-desc">{{ Str::limit($thought->description, 130) }}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif


        <!-- ──────────────────────────────────
             UPLOAD FILES / DOCS
        ────────────────────────────────── -->
        @if(($menu->upload_file ?? 0) && isset($upload_files) && $upload_files->count() > 0)
        <div class="sec-hdr">
            <div class="sec-hdr-bracket">[</div>
            <div class="sec-hdr-inner">
                <div class="sec-hdr-eyebrow">Data Vault</div>
                <h2 class="sec-hdr-title">Brochures & <span>Downloads</span></h2>
            </div>
            <div class="sec-hdr-bracket">]</div>
            <div class="sec-hdr-line"></div>
        </div>

        <div class="docs-grid">
            @foreach($upload_files as $file)
            @php
                $ext = strtolower(pathinfo($file->file ?? '', PATHINFO_EXTENSION));
                $docIcon = match($ext) {
                    'pdf'  => 'fa-file-pdf',
                    'doc','docx' => 'fa-file-word',
                    'xls','xlsx' => 'fa-file-excel',
                    'ppt','pptx' => 'fa-file-powerpoint',
                    'jpg','jpeg','png','webp' => 'fa-file-image',
                    default => 'fa-file-alt',
                };
            @endphp
            <div class="doc-card">
                <div class="doc-icon"><i class="fas {{ $docIcon }}"></i></div>
                <div>
                    <div class="doc-name">{{ $file->title ?? $file->name ?? 'Document' }}</div>
                    <div class="doc-sub">{{ strtoupper($ext ?? 'FILE') }} — DOWNLOAD</div>
                </div>
                <a href="{{ url('uploads/files/'.$file->file) }}" target="_blank" class="doc-dl" download>
                    <i class="fas fa-download"></i>
                </a>
            </div>
            @endforeach
        </div>
        @endif


        <!-- ──────────────────────────────────
             CTA — EMERGENCY ALERT SECTION
        ────────────────────────────────── -->
        <div class="cta-emergency" id="contact-section">
            <div class="cta-scan"></div>
            <div class="cta-dots"></div>
            <div class="cta-inner">
                <div class="cta-alert-tag">
                    <span class="cta-alert-dot"></span>
                    Security Alert — Act Now
                </div>
                <h2 class="cta-title">Protect What <span>Matters Most</span></h2>
                <p class="cta-sub">
                    Get a free on-site security assessment and custom quote for your home, office, or commercial property. Our certified experts respond fast — every second counts.
                </p>
                <div class="cta-btns">
                    @if($userdata->isFeatureVisible('contact_number') && ($userdata->mobile ?? false))
                    <a href="tel:{{ $userdata->mobile }}" class="btn-green">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                    @endif
                    @if(isset($social->whatsapp) && $social->whatsapp)
                    <a href="https://wa.me/{{ $social->whatsapp }}" class="btn-whatsapp-g" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i> WhatsApp Us
                    </a>
                    @endif
                    @if($userdata->isFeatureVisible('email') && ($userdata->email ?? false))
                    <a href="mailto:{{ $userdata->email }}" class="btn-outline-green">
                        <i class="fas fa-envelope"></i> Email Query
                    </a>
                    @endif
                </div>
            </div>
        </div>


        <!-- ──────────────────────────────────
             CONTACT — Tactical strip
        ────────────────────────────────── -->
        @if($userdata->isFeatureVisible('contact_number') || $userdata->isFeatureVisible('email') || $userdata->isFeatureVisible('address'))
        <div class="sec-hdr">
            <div class="sec-hdr-bracket">[</div>
            <div class="sec-hdr-inner">
                <div class="sec-hdr-eyebrow">Communication Channel</div>
                <h2 class="sec-hdr-title">Contact <span>Information</span></h2>
            </div>
            <div class="sec-hdr-bracket">]</div>
            <div class="sec-hdr-line"></div>
        </div>

        <div class="contact-strip">
            @if($userdata->isFeatureVisible('contact_number') && ($userdata->mobile ?? false))
            <a href="tel:{{ $userdata->mobile }}" class="contact-tile">
                <div class="contact-tile-icon"><i class="fas fa-phone"></i></div>
                <div>
                    <div class="ct-label">Phone / Mobile</div>
                    <div class="ct-val">{{ $userdata->mobile }}</div>
                </div>
            </a>
            @endif
            @if($userdata->isFeatureVisible('email') && ($userdata->email ?? false))
            <a href="mailto:{{ $userdata->email }}" class="contact-tile">
                <div class="contact-tile-icon"><i class="fas fa-envelope"></i></div>
                <div>
                    <div class="ct-label">Email Address</div>
                    <div class="ct-val">{{ $userdata->email }}</div>
                </div>
            </a>
            @endif
            @if($userdata->isFeatureVisible('address') && (($userdata->address ?? false) || ($userdata->city ?? false)))
            <div class="contact-tile">
                <div class="contact-tile-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div>
                    <div class="ct-label">Location / Office</div>
                    <div class="ct-val">{{ $userdata->address ?? implode(', ', array_filter([$userdata->city ?? null, $userdata->state ?? null])) }}</div>
                </div>
            </div>
            @endif
            @if(isset($social->whatsapp) && $social->whatsapp)
            <a href="https://wa.me/{{ $social->whatsapp }}" class="contact-tile" target="_blank" rel="noopener">
                <div class="contact-tile-icon" style="background:rgba(37,211,102,0.1);border-color:rgba(37,211,102,0.25);color:#25d366;">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div>
                    <div class="ct-label">WhatsApp</div>
                    <div class="ct-val">+{{ $social->whatsapp }}</div>
                </div>
            </a>
            @endif
        </div>
        @endif


        <!-- ──────────────────────────────────
             SOCIAL LINKS
        ────────────────────────────────── -->
        @if($userdata->isFeatureVisible('social_media') && isset($social) && $social)
        <div class="social-lx-row">
            @if($social->facebook ?? false)
            <a href="{{ $social->facebook }}" target="_blank" class="social-lx-btn">
                <i class="fab fa-facebook"></i> Facebook
            </a>
            @endif
            @if($social->instagram ?? false)
            <a href="{{ $social->instagram }}" target="_blank" class="social-lx-btn">
                <i class="fab fa-instagram"></i> Instagram
            </a>
            @endif
            @if($social->youtube ?? false)
            <a href="{{ $social->youtube }}" target="_blank" class="social-lx-btn">
                <i class="fab fa-youtube"></i> YouTube
            </a>
            @endif
            @if($social->linkedin ?? false)
            <a href="{{ $social->linkedin }}" target="_blank" class="social-lx-btn">
                <i class="fab fa-linkedin"></i> LinkedIn
            </a>
            @endif
            @if($social->twitter ?? false)
            <a href="{{ $social->twitter }}" target="_blank" class="social-lx-btn">
                <i class="fab fa-twitter"></i> Twitter / X
            </a>
            @endif
        </div>
        @endif

    </div><!-- /.main-wrap -->


    <!-- ══════════════════════════════════════════
         FOOTER — STATUS BAR MINIMAL
    ══════════════════════════════════════════ -->
    <footer class="lx-footer">
        <div class="footer-status">
            <span class="sb-dot sb-dot-green"></span>
            <span class="footer-brand">{{ $userdata->name ?? 'Security Systems' }}</span>
        </div>
        <div>
            &copy; {{ date('Y') }} {{ $userdata->name ?? 'Security Systems' }} — All Rights Reserved
            @if($websetting && ($websetting->company_name ?? false))
            &nbsp;|&nbsp; <a href="#">{{ $websetting->company_name }}</a>
            @endif
        </div>
        <div style="color:var(--text-dim);font-size:10px;">
            [ SYSTEM STATUS: <span style="color:var(--green);">ONLINE</span> ]
        </div>
    </footer>

    <!-- Live Clock JS -->
    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('en-GB', {hour12:false});
            const date = now.toLocaleDateString('en-GB');
            const el = document.getElementById('sb-clock');
            const ts = document.getElementById('hero-ts');
            if (el) el.textContent = time;
            if (ts) ts.textContent = time + ' — ' + date;
        }
        updateClock();
        setInterval(updateClock, 1000);
    </script>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])

</body>
</html>