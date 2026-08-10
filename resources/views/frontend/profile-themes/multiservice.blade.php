<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Business' }} - Professional Profile</title>

    @php
        $websetting = App\Models\websetting::first();
        if (isset($isPreview) && $isPreview) {
            $menu = (object)[
                'profile'=>1,'quali'=>1,'service'=>1,'thought'=>1,'personal'=>1,
                'profess'=>1,'videos'=>1,'product'=>1,'social_link'=>1,'upload_file'=>1,
                'client'=>1,'menu_section'=>1,'reservation_section'=>1,
                'property_listings'=>1,'showreel'=>1,'team_section'=>1,
                'pricing_section'=>1,'booking_section'=>1,
            ];
        } else {
            $menu = DB::table('profile_menu')->where('id', $userdata->id)->first();
            if (!$menu) {
                $menu = (object)array_fill_keys(['profile','quali','service','thought','personal','profess','videos','product','social_link','upload_file','client','menu_section','reservation_section','property_listings','showreel','team_section','pricing_section','booking_section'], 1);
            }
        }
        $themeColor = $theme->color ?? '#6366f1';
    @endphp

    @if($websetting && $websetting->favicon)
        <link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --p: {{ $themeColor }};
            --p-light: color-mix(in srgb, var(--p) 12%, white);
            --p-glow: color-mix(in srgb, var(--p) 35%, transparent);
            --p-dark: color-mix(in srgb, var(--p) 80%, black);
            --txt: #0f172a;
            --muted: #64748b;
            --border: rgba(226,232,240,0.8);
            --card-r: 1.5rem;
            --shadow: 0 4px 24px rgba(0,0,0,0.08);
            --shadow-lg: 0 16px 56px rgba(0,0,0,0.14);
        }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{
            font-family:'Inter',sans-serif;
            background:#eef2ff;
            color:var(--txt);
            overflow-x:hidden;
        }
        ::-webkit-scrollbar{width:5px}
        ::-webkit-scrollbar-thumb{background:var(--p);border-radius:3px}

        /* ═══ PREVIEW BANNER ═══ */
        .preview-banner{
            background:linear-gradient(135deg,#7c3aed,#ec4899);
            color:#fff;padding:11px 20px;text-align:center;
            font-size:13px;font-weight:500;position:sticky;top:0;z-index:1000;
        }
        .preview-banner a{color:#fff;font-weight:700;margin-left:6px;text-decoration:underline}

        /* ═══ HERO ═══ */
        .ms-hero{
            position:relative;min-height:420px;
            display:flex;flex-direction:column;justify-content:flex-end;
            overflow:hidden;
            background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=85');
            background-size:cover;background-position:center;
        }
        /* Use user's banner if provided — Blade inline style will override */
        .ms-hero-overlay{
            position:absolute;inset:0;
            background:linear-gradient(
                160deg,
                rgba(10,5,30,0.72) 0%,
                rgba(15,10,40,0.55) 40%,
                rgba(5,5,25,0.88) 100%
            );
            z-index:1;
        }
        /* animated shimmer top */
        .ms-hero::after{
            content:'';position:absolute;inset:0;
            background:
                radial-gradient(ellipse 55% 45% at 15% 20%, color-mix(in srgb,var(--p) 30%,transparent) 0%,transparent 65%),
                radial-gradient(ellipse 40% 50% at 85% 80%, color-mix(in srgb,var(--p) 18%,transparent) 0%,transparent 60%);
            z-index:2;pointer-events:none;
        }
        .hero-content{
            position:relative;z-index:3;
            max-width:740px;margin:0 auto;
            padding:2rem 1.5rem 0;
            width:100%;
            display:flex;align-items:flex-end;gap:1.5rem;
        }
        /* Avatar */
        .ms-avatar{
            width:105px;height:105px;border-radius:1.5rem;
            overflow:hidden;flex-shrink:0;
            border:3px solid rgba(255,255,255,0.92);
            box-shadow:0 0 0 5px color-mix(in srgb,var(--p) 40%,transparent), 0 12px 40px rgba(0,0,0,0.4);
            position:relative;
        }
        .ms-avatar img{width:100%;height:100%;object-fit:cover}
        .ms-avatar-placeholder{
            width:100%;height:100%;
            display:flex;align-items:center;justify-content:center;
            background:linear-gradient(135deg,var(--p),color-mix(in srgb,var(--p) 60%,#ec4899));
            color:#fff;font-size:2.4rem;
        }
        .avatar-pulse{
            position:absolute;bottom:8px;right:8px;
            width:15px;height:15px;background:#22c55e;
            border-radius:50%;border:2.5px solid #fff;
        }
        .avatar-pulse::before{
            content:'';position:absolute;inset:-4px;
            background:#22c55e;border-radius:50%;opacity:0.35;
            animation:pulse 2s ease-in-out infinite;
        }
        @keyframes pulse{0%,100%{transform:scale(1);opacity:.35}50%{transform:scale(1.5);opacity:0}}

        .hero-text{flex:1}
        .ms-name{
            font-size:1.85rem;font-weight:900;color:#fff;
            line-height:1.15;margin-bottom:.25rem;letter-spacing:-0.03em;
            text-shadow:0 2px 16px rgba(0,0,0,0.5);
        }
        .ms-tagline{
            font-size:.82rem;font-weight:600;letter-spacing:.1em;
            text-transform:uppercase;margin-bottom:.6rem;
            background:linear-gradient(90deg,var(--p),color-mix(in srgb,var(--p) 55%,#38bdf8));
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;
            background-clip:text;filter:brightness(1.5);
        }
        .ms-badges{display:flex;gap:.45rem;flex-wrap:wrap}
        .badge{
            display:inline-flex;align-items:center;gap:.35rem;
            padding:.32rem .75rem;
            background:rgba(255,255,255,0.1);
            border:1px solid rgba(255,255,255,0.2);
            border-radius:2rem;font-size:.73rem;color:rgba(255,255,255,.9);
            font-weight:500;backdrop-filter:blur(10px);
        }
        .badge i{font-size:.65rem;color:var(--p);filter:brightness(1.6)}

        /* Hero bottom strip / stat mini pills */
        .hero-stats-strip{
            position:relative;z-index:3;
            max-width:740px;margin:1.5rem auto 0;
            padding:0 1.5rem;width:100%;
            display:flex;gap:.5rem;overflow-x:auto;padding-bottom:0;
        }
        .hero-stat-pill{
            display:flex;align-items:center;gap:.5rem;
            background:rgba(255,255,255,0.1);
            border:1px solid rgba(255,255,255,0.18);
            backdrop-filter:blur(12px);
            padding:.55rem 1rem;border-radius:2rem;
            white-space:nowrap;flex-shrink:0;
        }
        .hero-stat-pill .snum{font-size:1rem;font-weight:800;color:#fff}
        .hero-stat-pill .slbl{font-size:.7rem;color:rgba(255,255,255,.65);font-weight:500}
        .hero-stat-pill i{color:var(--p);filter:brightness(1.5);font-size:.8rem}

        /* Wave divider bottom of hero */
        .hero-wave{
            position:relative;z-index:3;
            margin-top:-1px;line-height:0;
        }
        .hero-wave svg{display:block;width:100%}

        /* ═══ ACTION BAR ═══ */
        .action-wrap{
            background:#fff;
            box-shadow:0 4px 20px rgba(0,0,0,0.07);
            position:sticky;top:0;z-index:200;
        }
        .action-bar{
            display:grid;grid-template-columns:repeat(4,1fr);
            max-width:740px;margin:0 auto;
        }
        @media(max-width:440px){.action-bar{grid-template-columns:repeat(2,1fr)}}
        .action-btn{
            display:flex;flex-direction:column;align-items:center;gap:.3rem;
            padding:.9rem .5rem;text-decoration:none;color:var(--muted);
            transition:all .25s ease;position:relative;overflow:hidden;
        }
        .action-btn::after{
            content:'';position:absolute;bottom:0;left:50%;right:50%;
            height:3px;background:var(--p);border-radius:3px 3px 0 0;
            transition:all .25s ease;
        }
        .action-btn:hover::after{left:0;right:0}
        .action-btn:hover{color:var(--p)}
        .action-btn:not(:last-child){border-right:1px solid #f1f5f9}
        .abtn-icon{
            width:38px;height:38px;border-radius:.75rem;
            background:var(--p-light);display:flex;align-items:center;justify-content:center;
            transition:all .25s ease;
        }
        .action-btn:hover .abtn-icon{background:var(--p);box-shadow:0 6px 18px var(--p-glow)}
        .abtn-icon i{font-size:.95rem;color:var(--p);transition:color .2s}
        .action-btn:hover .abtn-icon i{color:#fff}
        .action-btn span{font-size:.7rem;font-weight:700;letter-spacing:.02em}

        /* ═══ MAIN WRAP ═══ */
        .profile-wrap{max-width:740px;margin:0 auto;padding:1.5rem 1rem 2rem}

        /* ═══ SECTION HEADING ═══ */
        .sec-head{
            display:flex;align-items:center;gap:.65rem;
            margin-bottom:1rem;
        }
        .sec-head-bar{
            width:4px;height:30px;border-radius:2px;
            background:linear-gradient(to bottom,var(--p),color-mix(in srgb,var(--p) 50%,#ec4899));
        }
        .sec-head h3{font-size:1.15rem;font-weight:800;letter-spacing:-.02em}
        .sec-head .sec-pill{
            margin-left:auto;background:var(--p-light);color:var(--p);
            font-size:.7rem;font-weight:700;padding:.2rem .65rem;border-radius:2rem;
        }

        /* ═══ CARD BASE ═══ */
        .pcard{
            background:#fff;border-radius:var(--card-r);
            margin-bottom:1.25rem;overflow:hidden;
            box-shadow:var(--shadow);
            border:1px solid var(--border);
            transition:transform .3s ease, box-shadow .3s ease;
            animation:fadeUp .5s ease both;
        }
        .pcard:hover{transform:translateY(-3px);box-shadow:var(--shadow-lg)}
        @keyframes fadeUp{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:translateY(0)}}
        .pcard:nth-child(1){animation-delay:.05s}
        .pcard:nth-child(2){animation-delay:.1s}
        .pcard:nth-child(3){animation-delay:.15s}
        .pcard:nth-child(4){animation-delay:.2s}
        .pcard:nth-child(5){animation-delay:.25s}
        .pcard:nth-child(6){animation-delay:.3s}
        .pcard:nth-child(7){animation-delay:.35s}

        .card-hd{
            padding:1.1rem 1.25rem;
            border-bottom:1px solid rgba(226,232,240,.6);
            display:flex;align-items:center;gap:.85rem;
        }
        .card-hd-ico{
            width:42px;height:42px;border-radius:.9rem;
            background:linear-gradient(135deg,var(--p),color-mix(in srgb,var(--p) 65%,#6d28d9));
            color:#fff;display:flex;align-items:center;justify-content:center;
            font-size:.95rem;flex-shrink:0;
            box-shadow:0 4px 14px var(--p-glow);
        }
        .card-hd h3{font-size:1rem;font-weight:700}
        .card-bd{padding:1.25rem}

        /* ═══ STATS BAR ═══ */
        .stats-card{
            background:linear-gradient(135deg,#0a0f1e 0%,#1a1040 50%,#0f172a 100%);
            background-image:
                url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1200&q=70'),
                linear-gradient(135deg,#0a0f1e,#1a1040);
            background-size:cover;background-position:center;
            position:relative;overflow:hidden;
        }
        .stats-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(10,5,30,.88),rgba(26,16,64,.82));
        }
        .stats-card::after{
            content:'';position:absolute;inset:0;
            background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),
                             linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
            background-size:32px 32px;
        }
        .stats-grid{
            position:relative;z-index:1;
            display:grid;grid-template-columns:repeat(4,1fr);
            padding:.5rem 0;
        }
        @media(max-width:480px){.stats-grid{grid-template-columns:repeat(2,1fr)}}
        .stat-item{
            padding:1.4rem .8rem;text-align:center;
            border-right:1px solid rgba(255,255,255,.08);
        }
        .stat-item:last-child{border-right:none}
        .stat-num{
            font-size:1.9rem;font-weight:900;color:#fff;
            line-height:1;margin-bottom:.25rem;
            background:linear-gradient(135deg,#fff,color-mix(in srgb,var(--p) 60%,#fff));
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;
            background-clip:text;
        }
        .stat-lbl{font-size:.7rem;color:rgba(255,255,255,.55);font-weight:600;text-transform:uppercase;letter-spacing:.06em}
        .stat-icon{font-size:.85rem;color:var(--p);filter:brightness(1.4);margin-bottom:.35rem}

        /* ═══ SERVICES – IMAGE CARDS ═══ */
        .services-grid{
            display:grid;grid-template-columns:repeat(2,1fr);gap:.85rem;
        }
        @media(max-width:400px){.services-grid{grid-template-columns:1fr}}
        .svc-card{
            border-radius:1.1rem;overflow:hidden;
            position:relative;min-height:175px;
            cursor:pointer;
            box-shadow:0 4px 18px rgba(0,0,0,.12);
            transition:transform .35s cubic-bezier(.34,1.56,.64,1), box-shadow .35s ease;
        }
        .svc-card:hover{transform:translateY(-6px) scale(1.01);box-shadow:0 20px 50px rgba(0,0,0,.2)}
        .svc-bg{
            position:absolute;inset:0;
            background-size:cover;background-position:center;
            transition:transform .5s ease;
        }
        .svc-card:hover .svc-bg{transform:scale(1.07)}
        .svc-overlay{
            position:absolute;inset:0;
            background:linear-gradient(to top,rgba(5,5,20,.92) 0%,rgba(5,5,20,.4) 50%,rgba(5,5,20,.15) 100%);
            transition:background .3s ease;
        }
        .svc-card:hover .svc-overlay{
            background:linear-gradient(to top,rgba(5,5,20,.96) 0%,rgba(5,5,20,.55) 60%,color-mix(in srgb,var(--p) 20%,rgba(5,5,20,.2)) 100%);
        }
        .svc-content{
            position:relative;z-index:1;
            padding:1.1rem;height:100%;
            display:flex;flex-direction:column;justify-content:flex-end;
        }
        .svc-icon-wrap{
            width:38px;height:38px;border-radius:.65rem;
            background:linear-gradient(135deg,var(--p),color-mix(in srgb,var(--p) 60%,#7c3aed));
            display:flex;align-items:center;justify-content:center;
            color:#fff;font-size:.9rem;margin-bottom:.7rem;
            box-shadow:0 4px 12px rgba(0,0,0,.3);
        }
        .svc-name{font-size:.92rem;font-weight:800;color:#fff;margin-bottom:.25rem;line-height:1.2}
        .svc-desc{font-size:.75rem;color:rgba(255,255,255,.65);line-height:1.5;margin-bottom:.6rem}
        .svc-tag{
            display:inline-flex;align-items:center;gap:.3rem;
            font-size:.68rem;font-weight:600;
            color:var(--p);filter:brightness(1.4);
            background:rgba(255,255,255,.1);padding:.25rem .55rem;border-radius:2rem;
        }
        .svc-tag i{font-size:.6rem}

        /* ═══ ABOUT / BIO ═══ */
        .about-card{
            background-image:url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=75');
            background-size:cover;background-position:center;
            position:relative;overflow:hidden;
        }
        .about-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(255,255,255,.95) 0%,rgba(240,244,255,.9) 100%);
        }
        .about-inner{position:relative;z-index:1;padding:1.5rem}
        .about-grid{display:flex;gap:1.25rem;align-items:flex-start}
        .about-photo{
            width:80px;height:80px;border-radius:1.1rem;overflow:hidden;flex-shrink:0;
            border:3px solid var(--p);box-shadow:0 6px 22px var(--p-glow);
        }
        .about-photo img{width:100%;height:100%;object-fit:cover}
        .about-body{flex:1}
        .about-title{font-size:.8rem;font-weight:700;color:var(--p);text-transform:uppercase;letter-spacing:.07em;margin-bottom:.4rem}
        .about-text{font-size:.85rem;color:#334155;line-height:1.75;margin-bottom:.9rem}
        .about-chips{display:flex;flex-wrap:wrap;gap:.4rem}
        .about-chip{
            display:inline-flex;align-items:center;gap:.3rem;
            padding:.35rem .75rem;border-radius:2rem;
            background:var(--p-light);color:var(--p);
            font-size:.73rem;font-weight:600;
            border:1px solid color-mix(in srgb,var(--p) 20%,transparent);
            transition:all .2s;
        }
        .about-chip:hover{background:var(--p);color:#fff;transform:translateY(-2px)}

        /* ═══ WHY CHOOSE US ═══ */
        .why-card{
            background-image:url('https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1200&q=75');
            background-size:cover;background-position:center;
            position:relative;
        }
        .why-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(255,255,255,.96),rgba(246,248,255,.93));
        }
        .why-card .card-hd,.why-card .card-bd{position:relative;z-index:1}
        .features-list{display:flex;flex-wrap:wrap;gap:.6rem}
        .feat-tag{
            display:inline-flex;align-items:center;gap:.4rem;
            padding:.55rem .95rem;
            border-radius:2rem;font-size:.8rem;font-weight:600;
            background:linear-gradient(135deg,var(--p-light),color-mix(in srgb,var(--p) 6%,white));
            color:var(--p);
            border:1.5px solid color-mix(in srgb,var(--p) 18%,transparent);
            transition:all .22s ease;cursor:default;
        }
        .feat-tag:hover{background:var(--p);color:#fff;transform:translateY(-3px);box-shadow:0 8px 22px var(--p-glow)}
        .feat-tag i{font-size:.72rem}

        /* ═══ GALLERY ═══ */
        .gallery-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:.65rem;
        }
        .gal-item{
            aspect-ratio:1;border-radius:1rem;overflow:hidden;
            position:relative;cursor:pointer;
        }
        .gal-item img{width:100%;height:100%;object-fit:cover;transition:transform .45s ease}
        .gal-overlay{
            position:absolute;inset:0;
            background:linear-gradient(to top,rgba(0,0,0,.6) 0%,transparent 50%);
            opacity:0;transition:opacity .3s ease;
            display:flex;align-items:flex-end;justify-content:flex-start;padding:.65rem;
        }
        .gal-item:hover img{transform:scale(1.1)}
        .gal-item:hover .gal-overlay{opacity:1}
        .gal-overlay span{
            font-size:.7rem;font-weight:600;color:#fff;
            background:rgba(0,0,0,.3);padding:.2rem .5rem;border-radius:1rem;
        }

        /* ═══ TESTIMONIALS ═══ */
        .testimonials-card{
            background-image:url('https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1200&q=70');
            background-size:cover;background-position:center;
            position:relative;
        }
        .testimonials-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(10,5,30,.9),rgba(20,10,50,.85));
        }
        .testimonials-card::after{
            content:'';position:absolute;inset:0;
            background-image:linear-gradient(rgba(255,255,255,.025) 1px,transparent 1px),
                             linear-gradient(90deg,rgba(255,255,255,.025) 1px,transparent 1px);
            background-size:40px 40px;
        }
        .testimonials-card .card-hd{
            border-bottom-color:rgba(255,255,255,.1);
            background:transparent;position:relative;z-index:1;
        }
        .testimonials-card .card-hd h3{color:#fff}
        .testimonials-card .card-bd{position:relative;z-index:1}
        .testi-grid{display:flex;flex-direction:column;gap:.85rem}
        .testi-item{
            background:rgba(255,255,255,.07);
            border:1px solid rgba(255,255,255,.1);
            border-radius:1.1rem;padding:1.1rem;
            backdrop-filter:blur(10px);
            transition:all .25s ease;
        }
        .testi-item:hover{background:rgba(255,255,255,.12);border-color:var(--p);transform:translateX(4px)}
        .testi-stars{display:flex;gap:.2rem;margin-bottom:.6rem}
        .testi-stars i{color:#fbbf24;font-size:.8rem}
        .testi-text{
            font-size:.83rem;color:rgba(255,255,255,.82);
            line-height:1.7;margin-bottom:.8rem;font-style:italic;
        }
        .testi-author{display:flex;align-items:center;gap:.75rem}
        .testi-avatar{
            width:40px;height:40px;border-radius:50%;overflow:hidden;
            border:2px solid var(--p);flex-shrink:0;
        }
        .testi-avatar img{width:100%;height:100%;object-fit:cover}
        .testi-name{font-weight:700;font-size:.85rem;color:#fff}
        .testi-role{font-size:.72rem;color:rgba(255,255,255,.5)}
        .verified-badge{
            margin-left:auto;background:rgba(34,197,94,.15);
            color:#4ade80;border:1px solid rgba(34,197,94,.3);
            font-size:.65rem;font-weight:700;padding:.2rem .5rem;border-radius:1rem;
            display:flex;align-items:center;gap:.25rem;
        }

        /* ═══ CONTACT ═══ */
        .contact-card{
            background-image:url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=1200&q=75');
            background-size:cover;background-position:center;
            position:relative;
        }
        .contact-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(10,5,30,.88),rgba(30,15,60,.82));
        }
        .contact-card::after{
            content:'';position:absolute;inset:0;
            background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),
                             linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
            background-size:36px 36px;
        }
        .contact-card .card-hd{border-bottom-color:rgba(255,255,255,.1);background:transparent;position:relative;z-index:1}
        .contact-card .card-hd h3{color:#fff}
        .contact-card .card-bd{position:relative;z-index:1}
        .contact-list{display:flex;flex-direction:column;gap:.7rem}
        .contact-item{
            display:flex;align-items:center;gap:1rem;
            padding:.9rem 1rem;
            background:rgba(255,255,255,.07);
            border:1px solid rgba(255,255,255,.1);
            border-radius:1.1rem;text-decoration:none;color:inherit;
            backdrop-filter:blur(8px);transition:all .25s ease;
        }
        .contact-item:hover{background:rgba(255,255,255,.13);border-color:var(--p);transform:translateX(5px)}
        .contact-ico{
            width:46px;height:46px;border-radius:.85rem;
            background:linear-gradient(135deg,var(--p),color-mix(in srgb,var(--p) 60%,#7c3aed));
            color:#fff;display:flex;align-items:center;justify-content:center;
            flex-shrink:0;font-size:1rem;box-shadow:0 4px 16px rgba(0,0,0,.3);
        }
        .contact-lbl{color:rgba(255,255,255,.45);font-size:.7rem;font-weight:500;margin-bottom:.1rem}
        .contact-val{font-weight:600;font-size:.88rem;color:#fff}
        .contact-arr{margin-left:auto;color:rgba(255,255,255,.25);font-size:.75rem}

        /* ═══ SOCIAL ═══ */
        .social-card{
            background:linear-gradient(135deg,color-mix(in srgb,var(--p) 6%,white),white);
        }
        .social-links{display:flex;justify-content:center;gap:.85rem;padding:1.5rem;flex-wrap:wrap}
        .social-link{
            width:52px;height:52px;border-radius:1rem;
            background:#fff;border:1.5px solid #e2e8f0;color:var(--muted);
            display:flex;align-items:center;justify-content:center;
            text-decoration:none;font-size:1.1rem;
            box-shadow:0 2px 10px rgba(0,0,0,.07);
            transition:all .3s cubic-bezier(.34,1.56,.64,1);
        }
        .social-link:hover{
            background:var(--p);color:#fff;border-color:var(--p);
            transform:translateY(-6px) scale(1.1);box-shadow:0 12px 30px var(--p-glow);
        }

        /* ═══ FOOTER ═══ */
        .profile-footer{
            text-align:center;padding:2rem 1rem;color:#94a3b8;font-size:.78rem;
        }
        .footer-divider{
            width:50px;height:3px;border-radius:3px;margin:0 auto .9rem;
            background:linear-gradient(90deg,var(--p),color-mix(in srgb,var(--p) 50%,#ec4899));
        }
        .profile-footer a{color:var(--p);text-decoration:none;font-weight:700}

        /* ═══ RESPONSIVE ═══ */
        @media(max-width:560px){
            .ms-hero{min-height:360px}
            .ms-name{font-size:1.5rem}
            .hero-content{gap:1rem}
            .ms-avatar{width:88px;height:88px}
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

    <!-- ══════════════════════════════
         H E R O
    ══════════════════════════════ -->
    <section class="ms-hero"
        @if($userdata->banner)
        style="background-image:url('{{ url('public/frontend/user_images', $userdata->banner) }}')"
        @endif>
        <div class="ms-hero-overlay"></div>

        <div class="hero-content">
            <div class="ms-avatar">
                @if($userdata->profile)
                    <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
                @else
                    <div class="ms-avatar-placeholder">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&h=200&q=80" alt="Profile" style="width:100%;height:100%;object-fit:cover">
                    </div>
                @endif
                <div class="avatar-pulse"></div>
            </div>
            <div class="hero-text">
                <h1 class="ms-name">{{ $userdata->name ?? 'James Mitchell' }}</h1>
                <p class="ms-tagline">{{ $userdata->desig ?? ($theme->name ?? 'Multi-Service Business') }}</p>
                <div class="ms-badges">
                    @if($userdata->city)
                        <span class="badge"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}</span>
                    @else
                        <span class="badge"><i class="fas fa-map-marker-alt"></i> New York, USA</span>
                    @endif
                    <span class="badge"><i class="fas fa-circle-check"></i> Verified Business</span>
                    @if($userdata->isFeatureVisible('services') && $professions->count() > 0)
                        <span class="badge"><i class="fas fa-layer-group"></i> {{ $professions->count() }} Services</span>
                    @else
                        <span class="badge"><i class="fas fa-layer-group"></i> 6 Services</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Stat Pills -->
        <div class="hero-stats-strip">
            <div class="hero-stat-pill">
                <i class="fas fa-briefcase"></i>
                <div><div class="snum">500+</div><div class="slbl">Projects</div></div>
            </div>
            <div class="hero-stat-pill">
                <i class="fas fa-users"></i>
                <div><div class="snum">320+</div><div class="slbl">Clients</div></div>
            </div>
            <div class="hero-stat-pill">
                <i class="fas fa-star"></i>
                <div><div class="snum">4.9★</div><div class="slbl">Rating</div></div>
            </div>
            <div class="hero-stat-pill">
                <i class="fas fa-calendar-check"></i>
                <div><div class="snum">12 Yrs</div><div class="slbl">Experience</div></div>
            </div>
        </div>

        <!-- Wave bottom -->
        <div class="hero-wave">
            <svg viewBox="0 0 1440 54" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" height="54">
                <path d="M0 54L48 48.5C96 43 192 32 288 27.5C384 22.5 480 27 576 31.5C672 36 768 40.5 864 38C960 35.5 1056 27 1152 24C1248 21 1344 22.5 1392 23L1440 24V54H0Z" fill="#eef2ff"/>
            </svg>
        </div>
    </section>

    <!-- ══════════════════════════════
         STICKY ACTION BAR
    ══════════════════════════════ -->
    <div class="action-wrap">
        <div class="action-bar">
            @if($userdata->mobile)
            <a href="tel:{{ $userdata->mobile }}" class="action-btn">
                <div class="abtn-icon"><i class="fas fa-phone"></i></div>
                <span>Call</span>
            </a>
            @else
            <a href="tel:+15551234567" class="action-btn">
                <div class="abtn-icon"><i class="fas fa-phone"></i></div>
                <span>Call</span>
            </a>
            @endif

            @if($social && $social->whatsapp)
            <a href="https://wa.me/{{ $social->whatsapp }}" class="action-btn">
                <div class="abtn-icon"><i class="fab fa-whatsapp"></i></div>
                <span>WhatsApp</span>
            </a>
            @else
            <a href="https://wa.me/15551234567" class="action-btn">
                <div class="abtn-icon"><i class="fab fa-whatsapp"></i></div>
                <span>WhatsApp</span>
            </a>
            @endif

            @if($userdata->email)
            <a href="mailto:{{ $userdata->email }}" class="action-btn">
                <div class="abtn-icon"><i class="fas fa-envelope"></i></div>
                <span>Email</span>
            </a>
            @else
            <a href="mailto:hello@business.com" class="action-btn">
                <div class="abtn-icon"><i class="fas fa-envelope"></i></div>
                <span>Email</span>
            </a>
            @endif

            @if($social && $social->map)
            <a href="{{ $social->map }}" class="action-btn" target="_blank">
                <div class="abtn-icon"><i class="fas fa-directions"></i></div>
                <span>Directions</span>
            </a>
            @else
            <a href="#" class="action-btn">
                <div class="abtn-icon"><i class="fas fa-directions"></i></div>
                <span>Directions</span>
            </a>
            @endif
        </div>
    </div>

    <!-- ══════════════════════════════
         MAIN CONTENT
    ══════════════════════════════ -->
    <div class="profile-wrap">

        <!-- ── STATS BAR ── -->
        <div class="pcard stats-card">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-trophy"></i></div>
                    <div class="stat-num">500+</div>
                    <div class="stat-lbl">Projects Done</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
                    <div class="stat-num">320+</div>
                    <div class="stat-lbl">Happy Clients</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-medal"></i></div>
                    <div class="stat-num">12+</div>
                    <div class="stat-lbl">Years Active</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-star"></i></div>
                    <div class="stat-num">4.9</div>
                    <div class="stat-lbl">Avg Rating</div>
                </div>
            </div>
        </div>

        <!-- ── ABOUT / BIO ── -->
        <div class="pcard about-card">
            <div class="about-inner">
                <div class="about-grid">
                    <div class="about-photo">
                        @if($userdata->profile)
                            <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&h=200&q=80" alt="Profile">
                        @endif
                    </div>
                    <div class="about-body">
                        <div class="about-title">About Us</div>
                        <p class="about-text">
                            {{ $userdata->about ?? 'We are a results-driven multi-service business dedicated to delivering premium solutions across consulting, design, and digital services. With over 12 years of hands-on experience, we partner with startups and enterprises to transform ideas into impactful outcomes.' }}
                        </p>
                        <div class="about-chips">
                            <span class="about-chip"><i class="fas fa-bolt"></i> Fast Delivery</span>
                            <span class="about-chip"><i class="fas fa-shield-alt"></i> Trusted</span>
                            <span class="about-chip"><i class="fas fa-headset"></i> 24/7 Support</span>
                            <span class="about-chip"><i class="fas fa-award"></i> Award Winning</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── SERVICES (Image Cards) ── -->
        @if($userdata->isFeatureVisible('services') && $professions->count() > 0)
        <div class="pcard">
            <div class="card-hd">
                <div class="card-hd-ico"><i class="fas fa-th-large"></i></div>
                <h3>Our Services</h3>
                <span style="margin-left:auto;background:var(--p-light);color:var(--p);font-size:.7rem;font-weight:700;padding:.2rem .65rem;border-radius:2rem;">{{ $professions->count() }} Available</span>
            </div>
            <div class="card-bd">
                <div class="services-grid">
                    @php
                    $svcBgs = [
                        'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1533750349088-cd871a92f312?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=500&q=80',
                        'https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&w=500&q=80',
                    ];
                    $svcIcons = ['chart-line','paint-brush','bullhorn','code','chart-bar','headset'];
                    @endphp
                    @foreach($professions as $index => $profession)
                    <div class="svc-card">
                        <div class="svc-bg" style="background-image:url('{{ $svcBgs[$index % 6] }}')"></div>
                        <div class="svc-overlay"></div>
                        <div class="svc-content">
                            <div class="svc-icon-wrap"><i class="fas fa-{{ $svcIcons[$index % 6] }}"></i></div>
                            <div class="svc-name">{{ $profession->title }}</div>
                            @if($profession->desc)
                            <div class="svc-desc">{{ Str::limit($profession->desc, 55) }}</div>
                            @endif
                            <div class="svc-tag"><i class="fas fa-arrow-right"></i> Learn More</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <!-- DUMMY SERVICES when none exist -->
        <div class="pcard">
            <div class="card-hd">
                <div class="card-hd-ico"><i class="fas fa-th-large"></i></div>
                <h3>Our Services</h3>
                <span style="margin-left:auto;background:var(--p-light);color:var(--p);font-size:.7rem;font-weight:700;padding:.2rem .65rem;border-radius:2rem;">6 Available</span>
            </div>
            <div class="card-bd">
                <div class="services-grid">
                    @php
                    $dummySvcs = [
                        ['Business Consulting','Strategic growth planning & advisory','https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=500&q=80','chart-line'],
                        ['Creative Design','Brand identity, UI/UX & visual design','https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=500&q=80','paint-brush'],
                        ['Digital Marketing','SEO, social media & paid campaigns','https://images.unsplash.com/photo-1533750349088-cd871a92f312?auto=format&fit=crop&w=500&q=80','bullhorn'],
                        ['Web Development','Full-stack websites & web apps','https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=500&q=80','code'],
                        ['Data Analytics','Insights, reporting & dashboards','https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=500&q=80','chart-bar'],
                        ['24/7 Support','Dedicated client success & helpdesk','https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&w=500&q=80','headset'],
                    ];
                    @endphp
                    @foreach($dummySvcs as $svc)
                    <div class="svc-card">
                        <div class="svc-bg" style="background-image:url('{{ $svc[2] }}')"></div>
                        <div class="svc-overlay"></div>
                        <div class="svc-content">
                            <div class="svc-icon-wrap"><i class="fas fa-{{ $svc[3] }}"></i></div>
                            <div class="svc-name">{{ $svc[0] }}</div>
                            <div class="svc-desc">{{ $svc[1] }}</div>
                            <div class="svc-tag"><i class="fas fa-arrow-right"></i> Learn More</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- ── WHY CHOOSE US ── -->
        @if($userdata->isFeatureVisible('qualifications') && $qualifications->count() > 0)
        <div class="pcard why-card">
            <div class="card-hd">
                <div class="card-hd-ico"><i class="fas fa-award"></i></div>
                <h3>Why Choose Us</h3>
            </div>
            <div class="card-bd">
                <div class="features-list">
                    @foreach($qualifications as $qual)
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> {{ $qual->title }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="pcard why-card">
            <div class="card-hd">
                <div class="card-hd-ico"><i class="fas fa-award"></i></div>
                <h3>Why Choose Us</h3>
            </div>
            <div class="card-bd">
                <div class="features-list">
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> ISO Certified</span>
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> On-Time Delivery</span>
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> Transparent Pricing</span>
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> Expert Team</span>
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> 100% Satisfaction</span>
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> NDA Protected</span>
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> Scalable Solutions</span>
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> 24/7 Availability</span>
                    <span class="feat-tag"><i class="fas fa-check-circle"></i> Free Consultation</span>
                </div>
            </div>
        </div>
        @endif

        <!-- ── GALLERY ── -->
        @if($userdata->isFeatureVisible('portfolio') && $portfolios->count() > 0)
        <div class="pcard">
            <div class="card-hd">
                <div class="card-hd-ico"><i class="fas fa-images"></i></div>
                <h3>Our Work</h3>
            </div>
            <div class="card-bd">
                <div class="gallery-grid">
                    @foreach($portfolios->take(6) as $portfolio)
                        @php $images = json_decode($portfolio->image, true); @endphp
                        @if($images && count($images) > 0)
                        <div class="gal-item">
                            <img src="{{ url('public/frontend/portfolio/' . $images[0]) }}" alt="Work">
                            <div class="gal-overlay"><span>View</span></div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="pcard">
            <div class="card-hd">
                <div class="card-hd-ico"><i class="fas fa-images"></i></div>
                <h3>Our Work</h3>
            </div>
            <div class="card-bd">
                <div class="gallery-grid">
                    @php
                    $galImgs = [
                        ['https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=400&q=80','Office Space'],
                        ['https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=400&q=80','Team Work'],
                        ['https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=400&q=80','Meeting'],
                        ['https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=400&q=80','Strategy'],
                        ['https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=400&q=80','Workshop'],
                        ['https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=400&q=80','Presentation'],
                    ];
                    @endphp
                    @foreach($galImgs as $gi)
                    <div class="gal-item">
                        <img src="{{ $gi[0] }}" alt="{{ $gi[1] }}">
                        <div class="gal-overlay"><span>{{ $gi[1] }}</span></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- ── TESTIMONIALS ── -->
        <div class="pcard testimonials-card">
            <div class="card-hd">
                <div class="card-hd-ico"><i class="fas fa-quote-right"></i></div>
                <h3>Client Reviews</h3>
            </div>
            <div class="card-bd">
                <div class="testi-grid">
                    <div class="testi-item">
                        <div class="testi-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="testi-text">"Absolutely outstanding experience. The team delivered beyond our expectations — on time, on budget, and with a level of professionalism that's truly rare."</p>
                        <div class="testi-author">
                            <div class="testi-avatar"><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=80&h=80&q=80" alt="Sarah"></div>
                            <div><div class="testi-name">Sarah Johnson</div><div class="testi-role">CEO, TechStart Inc.</div></div>
                            <div class="verified-badge"><i class="fas fa-check-circle"></i> Verified</div>
                        </div>
                    </div>
                    <div class="testi-item">
                        <div class="testi-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="testi-text">"We've worked with many agencies, but none matched this level of dedication. The results speak for themselves — 3x growth in just 6 months!"</p>
                        <div class="testi-author">
                            <div class="testi-avatar"><img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=80&h=80&q=80" alt="Mark"></div>
                            <div><div class="testi-name">Mark Williams</div><div class="testi-role">Director, GrowthLabs</div></div>
                            <div class="verified-badge"><i class="fas fa-check-circle"></i> Verified</div>
                        </div>
                    </div>
                    <div class="testi-item">
                        <div class="testi-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="testi-text">"From the first consultation to final delivery, every step was handled with care. Highly recommend for any business serious about quality."</p>
                        <div class="testi-author">
                            <div class="testi-avatar"><img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=80&h=80&q=80" alt="Emily"></div>
                            <div><div class="testi-name">Emily Rodriguez</div><div class="testi-role">Founder, Bloom Co.</div></div>
                            <div class="verified-badge"><i class="fas fa-check-circle"></i> Verified</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── CONTACT ── -->
        <div class="pcard contact-card">
            <div class="card-hd">
                <div class="card-hd-ico"><i class="fas fa-address-card"></i></div>
                <h3>Contact Us</h3>
            </div>
            <div class="card-bd">
                <div class="contact-list">
                    @if($userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="contact-item">
                        <div class="contact-ico"><i class="fas fa-phone"></i></div>
                        <div><div class="contact-lbl">Phone</div><div class="contact-val">{{ $userdata->mobile }}</div></div>
                        <i class="fas fa-chevron-right contact-arr"></i>
                    </a>
                    @else
                    <a href="tel:+15551234567" class="contact-item">
                        <div class="contact-ico"><i class="fas fa-phone"></i></div>
                        <div><div class="contact-lbl">Phone</div><div class="contact-val">+1 (555) 123-4567</div></div>
                        <i class="fas fa-chevron-right contact-arr"></i>
                    </a>
                    @endif

                    @if($userdata->email)
                    <a href="mailto:{{ $userdata->email }}" class="contact-item">
                        <div class="contact-ico"><i class="fas fa-envelope"></i></div>
                        <div><div class="contact-lbl">Email</div><div class="contact-val">{{ $userdata->email }}</div></div>
                        <i class="fas fa-chevron-right contact-arr"></i>
                    </a>
                    @else
                    <a href="mailto:hello@business.com" class="contact-item">
                        <div class="contact-ico"><i class="fas fa-envelope"></i></div>
                        <div><div class="contact-lbl">Email</div><div class="contact-val">hello@business.com</div></div>
                        <i class="fas fa-chevron-right contact-arr"></i>
                    </a>
                    @endif

                    @if($userdata->city || $userdata->state)
                    <div class="contact-item">
                        <div class="contact-ico"><i class="fas fa-map-marker-alt"></i></div>
                        <div><div class="contact-lbl">Location</div><div class="contact-val">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div></div>
                    </div>
                    @else
                    <div class="contact-item">
                        <div class="contact-ico"><i class="fas fa-map-marker-alt"></i></div>
                        <div><div class="contact-lbl">Location</div><div class="contact-val">New York, NY 10001</div></div>
                    </div>
                    @endif

                    <div class="contact-item">
                        <div class="contact-ico"><i class="fas fa-clock"></i></div>
                        <div><div class="contact-lbl">Business Hours</div><div class="contact-val">Mon–Sat: 9:00 AM – 6:00 PM</div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── SOCIAL ── -->
        @if($social)
        <div class="pcard social-card">
            <div class="social-links">
                @if($social->facebook)<a href="{{ $social->facebook }}" class="social-link" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>@endif
                @if($social->instagram)<a href="{{ $social->instagram }}" class="social-link" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>@endif
                @if($social->linkedin)<a href="{{ $social->linkedin }}" class="social-link" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>@endif
                @if($social->twitter)<a href="{{ $social->twitter }}" class="social-link" target="_blank" title="X / Twitter"><i class="fab fa-twitter"></i></a>@endif
                @if($social->youtube)<a href="{{ $social->youtube }}" class="social-link" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>@endif
            </div>
        </div>
        @else
        <div class="pcard social-card">
            <div class="social-links">
                <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link" title="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        @endif

    </div><!-- /.profile-wrap -->

    <footer class="profile-footer">
        <div class="footer-divider"></div>
        <p>Digital Card by <a href="{{ url('/') }}">Fastap</a></p>
    </footer>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])
</body>
</html>