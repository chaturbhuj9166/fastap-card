<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $userdata->name ?? 'Product' }} - Product Catalog</title>

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
        $themeColor = $theme->color ?? '#f97316';
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
            --p-glow:  color-mix(in srgb, var(--p) 38%, transparent);
            --p-dark:  color-mix(in srgb, var(--p) 75%, black);
            --txt:  #111827;
            --sub:  #6b7280;
            --bg:   #f8f9ff;
            --card-r: 1.25rem;
            --sh: 0 2px 20px rgba(0,0,0,0.07);
            --sh-lg: 0 16px 52px rgba(0,0,0,0.14);
        }
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--txt);overflow-x:hidden}
        ::-webkit-scrollbar{width:5px}
        ::-webkit-scrollbar-thumb{background:var(--p);border-radius:3px}

        /* ═══ PREVIEW BANNER ═══ */
        .preview-banner{
            background:linear-gradient(135deg,#7c3aed,#ec4899);
            color:#fff;padding:11px 20px;text-align:center;
            font-size:13px;font-weight:500;position:sticky;top:0;z-index:2000;
        }
        .preview-banner a{color:#fff;font-weight:700;margin-left:6px;text-decoration:underline}

        /* ═══ STICKY HEADER ═══ */
        .site-header{
            position:sticky;top:0;z-index:1000;
            background:rgba(255,255,255,0.92);
            backdrop-filter:blur(18px);
            -webkit-backdrop-filter:blur(18px);
            border-bottom:1px solid rgba(226,232,240,0.7);
            box-shadow:0 2px 20px rgba(0,0,0,0.06);
        }
        .header-inner{
            max-width:920px;margin:0 auto;
            display:flex;align-items:center;gap:.9rem;
            padding:.8rem 1rem;
        }
        .brand-logo{
            width:52px;height:52px;border-radius:1rem;overflow:hidden;
            border:2.5px solid var(--p);flex-shrink:0;
            box-shadow:0 0 0 4px var(--p-light);
        }
        .brand-logo img{width:100%;height:100%;object-fit:cover}
        .brand-logo-ph{
            width:100%;height:100%;
            display:flex;align-items:center;justify-content:center;
            background:linear-gradient(135deg,var(--p),var(--p-dark));
            color:#fff;font-size:1.4rem;
        }
        .brand-info{flex:1}
        .brand-name{font-size:1.1rem;font-weight:800;letter-spacing:-.02em}
        .brand-sub{color:var(--sub);font-size:.78rem;font-weight:500}
        .hdr-btns{display:flex;gap:.45rem}
        .hdr-btn{
            width:40px;height:40px;border-radius:.8rem;
            background:var(--p-light);color:var(--p);
            display:flex;align-items:center;justify-content:center;
            text-decoration:none;font-size:.95rem;
            transition:all .25s cubic-bezier(.34,1.56,.64,1);
        }
        .hdr-btn:hover{background:var(--p);color:#fff;transform:scale(1.1);box-shadow:0 6px 18px var(--p-glow)}

        /* ═══ HERO ═══ */
        .hero{
            position:relative;min-height:400px;overflow:hidden;
            display:flex;flex-direction:column;justify-content:flex-end;
            background-image:url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1600&q=85');
            background-size:cover;background-position:center;
        }
        .hero-overlay{
            position:absolute;inset:0;
            background:linear-gradient(160deg,rgba(5,5,15,.3) 0%,rgba(5,5,15,.75) 55%,rgba(5,5,15,.93) 100%);
            z-index:1;
        }
        /* colour tint from theme */
        .hero::before{
            content:'';position:absolute;inset:0;
            background:radial-gradient(ellipse 60% 55% at 80% 30%, color-mix(in srgb,var(--p) 22%,transparent) 0%,transparent 65%);
            z-index:2;pointer-events:none;
        }
        .hero-body{
            position:relative;z-index:3;
            max-width:920px;margin:0 auto;
            padding:2rem 1.25rem 0;width:100%;
            display:flex;align-items:flex-end;gap:1.25rem;
        }
        .hero-logo{
            width:90px;height:90px;border-radius:1.35rem;overflow:hidden;
            border:3px solid rgba(255,255,255,.9);flex-shrink:0;
            box-shadow:0 0 0 5px var(--p-glow),0 12px 36px rgba(0,0,0,.4);
        }
        .hero-logo img{width:100%;height:100%;object-fit:cover}
        .hero-logo-ph{
            width:100%;height:100%;
            display:flex;align-items:center;justify-content:center;
            background:linear-gradient(135deg,var(--p),var(--p-dark));
            color:#fff;font-size:2.2rem;
        }
        .hero-txt{flex:1}
        .hero-label{
            font-size:.72rem;font-weight:700;letter-spacing:.12em;
            text-transform:uppercase;margin-bottom:.3rem;
            color:var(--p);filter:brightness(1.5);
            display:inline-flex;align-items:center;gap:.35rem;
        }
        .hero-name{
            font-size:1.9rem;font-weight:900;color:#fff;
            line-height:1.1;margin-bottom:.35rem;letter-spacing:-.03em;
            text-shadow:0 2px 18px rgba(0,0,0,.5);
        }
        .hero-desc{font-size:.85rem;color:rgba(255,255,255,.75);margin-bottom:.75rem;line-height:1.6}
        .hero-pills{display:flex;gap:.45rem;flex-wrap:wrap}
        .hero-pill{
            display:inline-flex;align-items:center;gap:.3rem;
            padding:.3rem .72rem;
            background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);
            border-radius:2rem;font-size:.72rem;color:rgba(255,255,255,.9);
            font-weight:500;backdrop-filter:blur(8px);
        }
        .hero-pill i{color:var(--p);filter:brightness(1.6);font-size:.65rem}

        /* Promo tags row */
        .hero-promo-row{
            position:relative;z-index:3;
            max-width:920px;margin:1.25rem auto 0;
            padding:0 1.25rem;
            display:flex;gap:.5rem;overflow-x:auto;
        }
        .promo-tag{
            display:inline-flex;align-items:center;gap:.4rem;
            padding:.45rem 1rem;
            background:var(--p);color:#fff;
            border-radius:2rem;font-size:.75rem;font-weight:700;
            white-space:nowrap;flex-shrink:0;
            box-shadow:0 4px 14px var(--p-glow);
        }
        .promo-tag.alt{background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.25);color:#fff}

        /* Wave */
        .hero-wave{position:relative;z-index:3;line-height:0;margin-top:-1px}
        .hero-wave svg{display:block;width:100%}

        /* ═══ ACTION BAR ═══ */
        .action-wrap{
            background:#fff;
            box-shadow:0 3px 18px rgba(0,0,0,.06);
            position:sticky;top:73px;z-index:900;
        }
        .action-bar{
            display:grid;grid-template-columns:repeat(4,1fr);
            max-width:920px;margin:0 auto;
        }
        @media(max-width:440px){.action-bar{grid-template-columns:repeat(2,1fr)}}
        .act-btn{
            display:flex;flex-direction:column;align-items:center;gap:.3rem;
            padding:.9rem .5rem;text-decoration:none;color:var(--sub);
            transition:all .22s ease;position:relative;overflow:hidden;
        }
        .act-btn::after{
            content:'';position:absolute;bottom:0;left:50%;right:50%;
            height:3px;background:var(--p);border-radius:3px 3px 0 0;
            transition:all .22s ease;
        }
        .act-btn:hover::after{left:0;right:0}
        .act-btn:hover{color:var(--p)}
        .act-btn:not(:last-child){border-right:1px solid #f1f5f9}
        .act-ico{
            width:38px;height:38px;border-radius:.72rem;
            background:var(--p-light);display:flex;align-items:center;justify-content:center;
            transition:all .22s ease;
        }
        .act-btn:hover .act-ico{background:var(--p);box-shadow:0 6px 16px var(--p-glow)}
        .act-ico i{font-size:.9rem;color:var(--p);transition:color .2s}
        .act-btn:hover .act-ico i{color:#fff}
        .act-btn span{font-size:.68rem;font-weight:700;letter-spacing:.02em}

        /* ═══ CONTAINER ═══ */
        .pc{max-width:920px;margin:0 auto;padding:1.5rem 1rem 2rem}

        /* ═══ CARD BASE ═══ */
        .card{
            background:#fff;border-radius:var(--card-r);
            margin-bottom:1.25rem;overflow:hidden;
            box-shadow:var(--sh);border:1px solid rgba(226,232,240,.7);
            transition:transform .3s ease,box-shadow .3s ease;
            animation:fadeUp .5s ease both;
        }
        .card:hover{transform:translateY(-3px);box-shadow:var(--sh-lg)}
        @keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
        .card:nth-child(1){animation-delay:.04s}
        .card:nth-child(2){animation-delay:.08s}
        .card:nth-child(3){animation-delay:.12s}
        .card:nth-child(4){animation-delay:.16s}
        .card:nth-child(5){animation-delay:.20s}
        .card:nth-child(6){animation-delay:.24s}
        .card:nth-child(7){animation-delay:.28s}
        .card:nth-child(8){animation-delay:.32s}
        .card:nth-child(9){animation-delay:.36s}

        .card-hd{
            padding:1rem 1.25rem;
            border-bottom:1px solid rgba(226,232,240,.6);
            display:flex;align-items:center;gap:.8rem;
        }
        .chd-ico{
            width:40px;height:40px;border-radius:.85rem;
            background:linear-gradient(135deg,var(--p),var(--p-dark));
            color:#fff;display:flex;align-items:center;justify-content:center;
            font-size:.9rem;flex-shrink:0;
            box-shadow:0 4px 12px var(--p-glow);
        }
        .card-hd h3{font-size:.98rem;font-weight:700}
        .chd-pill{
            margin-left:auto;
            background:var(--p-light);color:var(--p);
            font-size:.7rem;font-weight:700;
            padding:.22rem .65rem;border-radius:2rem;
        }
        .card-bd{padding:1.25rem}

        /* ═══ STATS ═══ */
        .stats-card{
            background-image:url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=1200&q=80');
            background-size:cover;background-position:center;
            position:relative;overflow:hidden;
        }
        .stats-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(10,5,10,.86),rgba(25,10,5,.82));
        }
        .stats-card::after{
            content:'';position:absolute;inset:0;
            background-image:linear-gradient(rgba(255,255,255,.035) 1px,transparent 1px),
                             linear-gradient(90deg,rgba(255,255,255,.035) 1px,transparent 1px);
            background-size:30px 30px;
        }
        .stats-grid{
            position:relative;z-index:1;
            display:grid;grid-template-columns:repeat(4,1fr);
        }
        @media(max-width:480px){.stats-grid{grid-template-columns:repeat(2,1fr)}}
        .stat-cell{
            padding:1.35rem .8rem;text-align:center;
            border-right:1px solid rgba(255,255,255,.08);
        }
        .stat-cell:last-child{border-right:none}
        .stat-ico{font-size:.8rem;color:var(--p);filter:brightness(1.5);margin-bottom:.3rem}
        .stat-num{
            font-size:1.85rem;font-weight:900;line-height:1;margin-bottom:.2rem;
            background:linear-gradient(135deg,#fff,color-mix(in srgb,var(--p) 55%,#fff));
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
        }
        .stat-lbl{font-size:.68rem;color:rgba(255,255,255,.5);font-weight:600;text-transform:uppercase;letter-spacing:.06em}

        /* ═══ PROMO BANNER ═══ */
        .promo-banner{
            border-radius:var(--card-r);overflow:hidden;
            position:relative;min-height:160px;margin-bottom:1.25rem;
            background-image:url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=1200&q=85');
            background-size:cover;background-position:center;
            animation:fadeUp .5s ease both;animation-delay:.06s;
            box-shadow:var(--sh);
        }
        .promo-banner::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(105deg,rgba(5,5,15,.88) 0%,rgba(5,5,15,.5) 55%,transparent 100%);
        }
        .promo-inner{
            position:relative;z-index:1;
            padding:1.5rem;height:100%;
            display:flex;flex-direction:column;justify-content:center;
        }
        .promo-eyebrow{
            font-size:.7rem;font-weight:800;letter-spacing:.12em;
            text-transform:uppercase;color:var(--p);filter:brightness(1.5);
            margin-bottom:.4rem;
        }
        .promo-title{
            font-size:1.35rem;font-weight:900;color:#fff;
            line-height:1.2;margin-bottom:.5rem;letter-spacing:-.02em;
        }
        .promo-sub{font-size:.82rem;color:rgba(255,255,255,.7);margin-bottom:.9rem}
        .promo-btn{
            display:inline-flex;align-items:center;gap:.4rem;
            padding:.55rem 1.15rem;
            background:var(--p);color:#fff;
            border-radius:2rem;font-size:.8rem;font-weight:700;
            text-decoration:none;
            box-shadow:0 6px 18px var(--p-glow);
            transition:all .25s ease;
            align-self:flex-start;
        }
        .promo-btn:hover{transform:translateY(-2px);box-shadow:0 10px 26px var(--p-glow)}

        /* ═══ CATEGORY CARDS (horizontal scroll) ═══ */
        .cat-scroll{
            display:flex;gap:.75rem;
            overflow-x:auto;padding-bottom:.25rem;
            -webkit-overflow-scrolling:touch;
            scrollbar-width:none;
        }
        .cat-scroll::-webkit-scrollbar{display:none}
        .cat-card{
            flex-shrink:0;width:110px;border-radius:1rem;overflow:hidden;
            position:relative;cursor:pointer;
            box-shadow:0 4px 14px rgba(0,0,0,.12);
            transition:transform .3s cubic-bezier(.34,1.56,.64,1),box-shadow .3s ease;
        }
        .cat-card:hover{transform:translateY(-5px) scale(1.03);box-shadow:0 14px 36px rgba(0,0,0,.18)}
        .cat-img{
            width:110px;height:110px;
            background-size:cover;background-position:center;
            transition:transform .4s ease;
        }
        .cat-card:hover .cat-img{transform:scale(1.08)}
        .cat-overlay{
            position:absolute;inset:0;
            background:linear-gradient(to top,rgba(0,0,0,.75) 0%,rgba(0,0,0,.15) 60%);
        }
        .cat-name{
            position:absolute;bottom:0;left:0;right:0;
            padding:.55rem .5rem;text-align:center;
            font-size:.73rem;font-weight:700;color:#fff;
            line-height:1.2;
        }
        .cat-card.active .cat-overlay{background:linear-gradient(to top,color-mix(in srgb,var(--p) 85%,rgba(0,0,0,.5)) 0%,color-mix(in srgb,var(--p) 25%,transparent) 70%)}

        /* ═══ PRODUCT GRID ═══ */
        .products-grid{
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:.85rem;
        }
        @media(min-width:580px){.products-grid{grid-template-columns:repeat(3,1fr)}}
        @media(max-width:380px){.products-grid{grid-template-columns:1fr}}

        .prod-card{
            border-radius:1.1rem;overflow:hidden;background:#fff;
            border:1px solid #f1f5f9;
            box-shadow:0 2px 12px rgba(0,0,0,.06);
            transition:all .3s cubic-bezier(.34,1.56,.64,1);
            cursor:pointer;
        }
        .prod-card:hover{transform:translateY(-6px);box-shadow:0 20px 48px rgba(0,0,0,.13)}
        .prod-img{
            position:relative;aspect-ratio:1;overflow:hidden;
            background:#f3f4f6;
        }
        .prod-img img{
            width:100%;height:100%;object-fit:cover;
            transition:transform .45s ease;
        }
        .prod-card:hover .prod-img img{transform:scale(1.08)}
        .prod-badge{
            position:absolute;top:.55rem;left:.55rem;
            padding:.22rem .55rem;border-radius:.45rem;
            font-size:.62rem;font-weight:800;text-transform:uppercase;color:#fff;
            letter-spacing:.04em;
        }
        .prod-badge.new{background:var(--p)}
        .prod-badge.hot{background:#ef4444}
        .prod-badge.sale{background:#8b5cf6}
        .prod-badge.top{background:#10b981}
        .prod-wish{
            position:absolute;top:.55rem;right:.55rem;
            width:30px;height:30px;border-radius:50%;
            background:rgba(255,255,255,.88);
            display:flex;align-items:center;justify-content:center;
            font-size:.78rem;color:#9ca3af;
            transition:all .2s ease;
        }
        .prod-card:hover .prod-wish{color:#ef4444}
        .prod-info{padding:.85rem .8rem}
        .prod-cat{font-size:.65rem;font-weight:600;color:var(--p);letter-spacing:.04em;text-transform:uppercase;margin-bottom:.2rem}
        .prod-name{font-size:.88rem;font-weight:700;color:var(--txt);margin-bottom:.25rem;line-height:1.3}
        .prod-desc{font-size:.73rem;color:var(--sub);line-height:1.5;margin-bottom:.6rem}
        .prod-foot{display:flex;align-items:center;justify-content:space-between}
        .prod-stars{display:flex;gap:.1rem}
        .prod-stars i{font-size:.62rem;color:#fbbf24}
        .prod-rating{font-size:.68rem;color:var(--sub);margin-left:.2rem;font-weight:500}
        .prod-cta{
            display:inline-flex;align-items:center;gap:.3rem;
            padding:.3rem .75rem;
            background:var(--p-light);color:var(--p);
            border-radius:2rem;font-size:.7rem;font-weight:700;
            transition:all .2s ease;
        }
        .prod-card:hover .prod-cta{background:var(--p);color:#fff;box-shadow:0 4px 14px var(--p-glow)}

        /* ═══ FLASH DEALS ═══ */
        .deals-card{
            background-image:url('https://images.unsplash.com/photo-1607082349566-187342175e2f?auto=format&fit=crop&w=1200&q=80');
            background-size:cover;background-position:center;
            position:relative;overflow:hidden;
        }
        .deals-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(5,5,15,.92),rgba(15,5,5,.87));
        }
        .deals-card::after{
            content:'';position:absolute;inset:0;
            background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),
                             linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
            background-size:28px 28px;
        }
        .deals-card .card-hd{border-bottom-color:rgba(255,255,255,.1);background:transparent;position:relative;z-index:1}
        .deals-card .card-hd h3{color:#fff}
        .deals-card .card-bd{position:relative;z-index:1}
        .deal-timer{
            display:flex;align-items:center;gap:.45rem;
            margin-bottom:1rem;
        }
        .deal-timer-lbl{font-size:.75rem;color:rgba(255,255,255,.6);font-weight:500}
        .timer-blocks{display:flex;gap:.35rem}
        .tblock{
            display:flex;flex-direction:column;align-items:center;
            background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);
            border-radius:.5rem;padding:.35rem .55rem;min-width:44px;
            backdrop-filter:blur(6px);
        }
        .tnum{font-size:1.1rem;font-weight:800;color:#fff;line-height:1}
        .tlbl{font-size:.55rem;color:rgba(255,255,255,.5);font-weight:600;text-transform:uppercase;margin-top:.15rem}
        .tcolon{font-size:1rem;font-weight:800;color:rgba(255,255,255,.4);align-self:center;padding-bottom:.25rem}
        .deals-scroll{
            display:flex;gap:.75rem;overflow-x:auto;
            -webkit-overflow-scrolling:touch;scrollbar-width:none;
        }
        .deals-scroll::-webkit-scrollbar{display:none}
        .deal-item{
            flex-shrink:0;width:140px;border-radius:1rem;overflow:hidden;
            background:rgba(255,255,255,.07);
            border:1px solid rgba(255,255,255,.1);
            backdrop-filter:blur(8px);
            transition:all .25s ease;
        }
        .deal-item:hover{background:rgba(255,255,255,.13);border-color:var(--p);transform:translateY(-3px)}
        .deal-img{width:140px;height:120px;object-fit:cover}
        .deal-info{padding:.7rem .75rem}
        .deal-name{font-size:.8rem;font-weight:700;color:#fff;margin-bottom:.3rem;line-height:1.3}
        .deal-off{
            display:inline-block;
            background:var(--p);color:#fff;
            font-size:.68rem;font-weight:800;
            padding:.18rem .5rem;border-radius:.3rem;margin-bottom:.3rem;
        }
        .deal-price{font-size:.85rem;font-weight:800;color:#fff}

        /* ═══ WHY CHOOSE US ═══ */
        .why-card{
            background-image:url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=1200&q=75');
            background-size:cover;background-position:center top;
            position:relative;
        }
        .why-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(255,255,255,.97),rgba(248,250,255,.94));
        }
        .why-card .card-hd,.why-card .card-bd{position:relative;z-index:1}
        .why-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.75rem}
        @media(max-width:380px){.why-grid{grid-template-columns:1fr}}
        .why-item{
            display:flex;align-items:flex-start;gap:.75rem;
            padding:.9rem 1rem;background:rgba(255,255,255,.85);
            border-radius:1rem;border:1px solid rgba(226,232,240,.8);
            backdrop-filter:blur(6px);
            transition:all .25s ease;
        }
        .why-item:hover{border-color:var(--p);transform:translateY(-3px);box-shadow:0 8px 24px var(--p-glow)}
        .why-ico{
            width:40px;height:40px;border-radius:.75rem;flex-shrink:0;
            background:linear-gradient(135deg,var(--p),var(--p-dark));
            color:#fff;display:flex;align-items:center;justify-content:center;
            font-size:.88rem;box-shadow:0 4px 12px var(--p-glow);
        }
        .why-title{font-size:.85rem;font-weight:700;margin-bottom:.15rem}
        .why-sub{font-size:.73rem;color:var(--sub);line-height:1.5}

        /* ═══ TESTIMONIALS ═══ */
        .testi-card{
            background-image:url('https://images.unsplash.com/photo-1556742111-a301076d9d18?auto=format&fit=crop&w=1200&q=75');
            background-size:cover;background-position:center;
            position:relative;
        }
        .testi-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(10,5,20,.91),rgba(15,5,10,.87));
        }
        .testi-card::after{
            content:'';position:absolute;inset:0;
            background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),
                             linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
            background-size:36px 36px;
        }
        .testi-card .card-hd{border-bottom-color:rgba(255,255,255,.1);background:transparent;position:relative;z-index:1}
        .testi-card .card-hd h3{color:#fff}
        .testi-card .card-bd{position:relative;z-index:1}
        .testi-list{display:flex;flex-direction:column;gap:.75rem}
        .testi-row{
            display:flex;gap:.9rem;align-items:flex-start;
            padding:1rem;background:rgba(255,255,255,.07);
            border:1px solid rgba(255,255,255,.1);border-radius:1.1rem;
            backdrop-filter:blur(8px);transition:all .25s ease;
        }
        .testi-row:hover{background:rgba(255,255,255,.12);border-color:var(--p);transform:translateX(4px)}
        .tavi{
            width:46px;height:46px;border-radius:50%;overflow:hidden;flex-shrink:0;
            border:2px solid var(--p);
        }
        .tavi img{width:100%;height:100%;object-fit:cover}
        .t-body{flex:1}
        .t-head{display:flex;align-items:center;gap:.5rem;margin-bottom:.35rem}
        .t-name{font-weight:700;font-size:.85rem;color:#fff}
        .t-stars{display:flex;gap:.15rem}
        .t-stars i{font-size:.68rem;color:#fbbf24}
        .t-role{font-size:.7rem;color:rgba(255,255,255,.45);margin-bottom:.4rem}
        .t-text{font-size:.8rem;color:rgba(255,255,255,.75);line-height:1.65;font-style:italic}
        .t-verified{
            margin-left:auto;background:rgba(34,197,94,.15);
            color:#4ade80;border:1px solid rgba(34,197,94,.3);
            font-size:.62rem;font-weight:700;padding:.18rem .48rem;border-radius:1rem;
            display:flex;align-items:center;gap:.2rem;flex-shrink:0;
        }

        /* ═══ CONTACT ═══ */
        .contact-card{
            background-image:url('https://images.unsplash.com/photo-1604719312566-8912e9227c6a?auto=format&fit=crop&w=1200&q=80');
            background-size:cover;background-position:center;
            position:relative;
        }
        .contact-card::before{
            content:'';position:absolute;inset:0;
            background:linear-gradient(135deg,rgba(10,5,20,.9),rgba(20,10,5,.85));
        }
        .contact-card::after{
            content:'';position:absolute;inset:0;
            background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),
                             linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
            background-size:32px 32px;
        }
        .contact-card .card-hd{border-bottom-color:rgba(255,255,255,.1);background:transparent;position:relative;z-index:1}
        .contact-card .card-hd h3{color:#fff}
        .contact-card .card-bd{position:relative;z-index:1}
        .contact-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.7rem}
        @media(max-width:480px){.contact-grid{grid-template-columns:1fr}}
        .con-item{
            display:flex;align-items:center;gap:.85rem;
            padding:.9rem 1rem;
            background:rgba(255,255,255,.07);
            border:1px solid rgba(255,255,255,.1);
            border-radius:1.1rem;text-decoration:none;color:inherit;
            backdrop-filter:blur(8px);transition:all .25s ease;
        }
        .con-item:hover{background:rgba(255,255,255,.13);border-color:var(--p);transform:translateX(4px)}
        .con-ico{
            width:44px;height:44px;border-radius:.85rem;flex-shrink:0;
            background:linear-gradient(135deg,var(--p),var(--p-dark));
            color:#fff;display:flex;align-items:center;justify-content:center;
            font-size:.95rem;box-shadow:0 4px 14px rgba(0,0,0,.3);
        }
        .con-lbl{font-size:.68rem;color:rgba(255,255,255,.45);font-weight:500;margin-bottom:.1rem}
        .con-val{font-size:.85rem;font-weight:600;color:#fff}

        /* ═══ SOCIAL ═══ */
        .social-card{
            background:linear-gradient(135deg,color-mix(in srgb,var(--p) 7%,white),white);
        }
        .social-links{display:flex;justify-content:center;gap:.8rem;padding:1.5rem;flex-wrap:wrap}
        .soc-link{
            width:50px;height:50px;border-radius:1rem;
            background:#fff;border:1.5px solid #e5e7eb;color:var(--sub);
            display:flex;align-items:center;justify-content:center;
            text-decoration:none;font-size:1.05rem;
            box-shadow:0 2px 8px rgba(0,0,0,.06);
            transition:all .3s cubic-bezier(.34,1.56,.64,1);
        }
        .soc-link:hover{
            background:var(--p);color:#fff;border-color:var(--p);
            transform:translateY(-6px) scale(1.08);box-shadow:0 12px 28px var(--p-glow);
        }

        /* ═══ FOOTER ═══ */
        .profile-footer{
            text-align:center;padding:2rem 1rem;color:#9ca3af;font-size:.78rem;
        }
        .foot-div{
            width:48px;height:3px;border-radius:3px;margin:0 auto .9rem;
            background:linear-gradient(90deg,var(--p),color-mix(in srgb,var(--p) 50%,#ec4899));
        }
        .profile-footer a{color:var(--p);text-decoration:none;font-weight:700}

        @media(max-width:560px){
            .hero{min-height:350px}
            .hero-name{font-size:1.55rem}
            .hero-logo{width:76px;height:76px}
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
         STICKY HEADER
    ══════════════════════════════ -->
    <header class="site-header">
        <div class="header-inner">
            <div class="brand-logo">
                @if($userdata->profile)
                    <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
                @else
                    <div class="brand-logo-ph"><i class="fas fa-box-open"></i></div>
                @endif
            </div>
            <div class="brand-info">
                <div class="brand-name">{{ $userdata->name ?? 'Premium Store' }}</div>
                <div class="brand-sub">{{ $userdata->desig ?? ($theme->name ?? 'Product Catalog') }}</div>
            </div>
            <div class="hdr-btns">
                @if($userdata->mobile)
                <a href="tel:{{ $userdata->mobile }}" class="hdr-btn" title="Call"><i class="fas fa-phone"></i></a>
                @else
                <a href="tel:+15551234567" class="hdr-btn" title="Call"><i class="fas fa-phone"></i></a>
                @endif
                @if($social && $social->whatsapp)
                <a href="https://wa.me/{{ $social->whatsapp }}" class="hdr-btn" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                @else
                <a href="#" class="hdr-btn" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                @endif
            </div>
        </div>
    </header>

    <!-- ══════════════════════════════
         HERO
    ══════════════════════════════ -->
    <section class="hero"
        @if($userdata->banner)
        style="background-image:url('{{ url('public/frontend/user_images', $userdata->banner) }}')"
        @endif>
        <div class="hero-overlay"></div>

        <div class="hero-body">
            <div class="hero-logo">
                @if($userdata->profile)
                    <img src="{{ url('public/frontend/user_images', $userdata->profile) }}" alt="{{ $userdata->name }}">
                @else
                    <div class="hero-logo-ph"><i class="fas fa-store"></i></div>
                @endif
            </div>
            <div class="hero-txt">
                <div class="hero-label"><i class="fas fa-certificate"></i> Official Store</div>
                <h1 class="hero-name">{{ $userdata->name ?? 'Premium Products' }}</h1>
                <p class="hero-desc">{{ $userdata->about ?? 'Discover our curated collection of premium quality products. Trusted by thousands of customers worldwide.' }}</p>
                <div class="hero-pills">
                    @if($userdata->city)
                        <span class="hero-pill"><i class="fas fa-map-marker-alt"></i> {{ $userdata->city }}</span>
                    @else
                        <span class="hero-pill"><i class="fas fa-map-marker-alt"></i> New York, USA</span>
                    @endif
                    <span class="hero-pill"><i class="fas fa-shield-check"></i> Verified</span>
                    <span class="hero-pill"><i class="fas fa-truck"></i> Free Shipping</span>
                </div>
            </div>
        </div>

        <!-- Promo tags -->
        <div class="hero-promo-row">
            <div class="promo-tag"><i class="fas fa-bolt"></i> Flash Sale — Up to 50% Off</div>
            <div class="promo-tag alt"><i class="fas fa-gift"></i> Free Gift on Orders $99+</div>
            <div class="promo-tag alt"><i class="fas fa-undo"></i> 30-Day Returns</div>
        </div>

        <!-- Wave divider -->
        <div class="hero-wave">
            <svg viewBox="0 0 1440 52" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" height="52">
                <path d="M0 52L60 46C120 40 240 28 360 24C480 20 600 24 720 28C840 32 960 36 1080 33C1200 30 1320 20 1380 15L1440 10V52H0Z" fill="#f8f9ff"/>
            </svg>
        </div>
    </section>

    <!-- ══════════════════════════════
         ACTION BAR
    ══════════════════════════════ -->
    <div class="action-wrap">
        <div class="action-bar">
            @if($userdata->mobile)
            <a href="tel:{{ $userdata->mobile }}" class="act-btn">
                <div class="act-ico"><i class="fas fa-phone"></i></div><span>Call</span>
            </a>
            @else
            <a href="tel:+15551234567" class="act-btn">
                <div class="act-ico"><i class="fas fa-phone"></i></div><span>Call</span>
            </a>
            @endif

            @if($social && $social->whatsapp)
            <a href="https://wa.me/{{ $social->whatsapp }}" class="act-btn">
                <div class="act-ico"><i class="fab fa-whatsapp"></i></div><span>WhatsApp</span>
            </a>
            @else
            <a href="#" class="act-btn">
                <div class="act-ico"><i class="fab fa-whatsapp"></i></div><span>WhatsApp</span>
            </a>
            @endif

            @if($userdata->email)
            <a href="mailto:{{ $userdata->email }}" class="act-btn">
                <div class="act-ico"><i class="fas fa-envelope"></i></div><span>Email</span>
            </a>
            @else
            <a href="mailto:shop@store.com" class="act-btn">
                <div class="act-ico"><i class="fas fa-envelope"></i></div><span>Email</span>
            </a>
            @endif

            @if($social && $social->map)
            <a href="{{ $social->map }}" class="act-btn" target="_blank">
                <div class="act-ico"><i class="fas fa-store"></i></div><span>Visit</span>
            </a>
            @else
            <a href="#" class="act-btn">
                <div class="act-ico"><i class="fas fa-store"></i></div><span>Visit</span>
            </a>
            @endif
        </div>
    </div>

    <!-- ══════════════════════════════
         MAIN CONTENT
    ══════════════════════════════ -->
    <div class="pc">

        <!-- ── STATS BAR ── -->
        <div class="card stats-card">
            <div class="stats-grid">
                <div class="stat-cell">
                    <div class="stat-ico"><i class="fas fa-box-open"></i></div>
                    <div class="stat-num">1.2K+</div>
                    <div class="stat-lbl">Products</div>
                </div>
                <div class="stat-cell">
                    <div class="stat-ico"><i class="fas fa-users"></i></div>
                    <div class="stat-num">8.5K+</div>
                    <div class="stat-lbl">Customers</div>
                </div>
                <div class="stat-cell">
                    <div class="stat-ico"><i class="fas fa-star"></i></div>
                    <div class="stat-num">4.9★</div>
                    <div class="stat-lbl">Rating</div>
                </div>
                <div class="stat-cell">
                    <div class="stat-ico"><i class="fas fa-truck"></i></div>
                    <div class="stat-num">24hr</div>
                    <div class="stat-lbl">Shipping</div>
                </div>
            </div>
        </div>

        <!-- ── PROMO BANNER ── -->
        <div class="promo-banner">
            <div class="promo-inner">
                <div class="promo-eyebrow"><i class="fas fa-fire"></i> Limited Time Offer</div>
                <div class="promo-title">New Season<br>Collection 2025</div>
                <div class="promo-sub">Exclusive deals on top-rated products</div>
                <a href="#" class="promo-btn"><i class="fas fa-shopping-bag"></i> Shop Now</a>
            </div>
        </div>

        <!-- ── CATEGORIES ── -->
        @if($userdata->isFeatureVisible('services') && $professions->count() > 0)
        <div class="card">
            <div class="card-hd">
                <div class="chd-ico"><i class="fas fa-th-large"></i></div>
                <h3>Categories</h3>
                <span class="chd-pill">{{ $professions->count() }}</span>
            </div>
            <div class="card-bd">
                <div class="cat-scroll">
                    @php
                    $catBgs = [
                        'https://images.unsplash.com/photo-1498049794561-7780e7231661?auto=format&fit=crop&w=220&q=80',
                        'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&w=220&q=80',
                        'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=220&q=80',
                        'https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=220&q=80',
                        'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=220&q=80',
                        'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?auto=format&fit=crop&w=220&q=80',
                    ];
                    @endphp
                    @foreach($professions as $i => $prof)
                    <div class="cat-card {{ $i === 0 ? 'active' : '' }}">
                        <div class="cat-img" style="background-image:url('{{ $catBgs[$i % 6] }}')"></div>
                        <div class="cat-overlay"></div>
                        <div class="cat-name">{{ $prof->title }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <!-- DUMMY CATEGORIES -->
        <div class="card">
            <div class="card-hd">
                <div class="chd-ico"><i class="fas fa-th-large"></i></div>
                <h3>Shop by Category</h3>
                <span class="chd-pill">6</span>
            </div>
            <div class="card-bd">
                <div class="cat-scroll">
                    @php
                    $dummyCats = [
                        ['Electronics','https://images.unsplash.com/photo-1498049794561-7780e7231661?auto=format&fit=crop&w=220&q=80'],
                        ['Fashion','https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&w=220&q=80'],
                        ['Home & Living','https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=220&q=80'],
                        ['Beauty','https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=220&q=80'],
                        ['Sports','https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=220&q=80'],
                        ['Food','https://images.unsplash.com/photo-1565299585323-38d6b0865b47?auto=format&fit=crop&w=220&q=80'],
                    ];
                    @endphp
                    @foreach($dummyCats as $i => $cat)
                    <div class="cat-card {{ $i === 0 ? 'active' : '' }}">
                        <div class="cat-img" style="background-image:url('{{ $cat[1] }}')"></div>
                        <div class="cat-overlay"></div>
                        <div class="cat-name">{{ $cat[0] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- ── PRODUCTS GRID ── -->
        @if($userdata->isFeatureVisible('portfolio') && $portfolios->count() > 0)
        <div class="card">
            <div class="card-hd">
                <div class="chd-ico"><i class="fas fa-boxes-stacked"></i></div>
                <h3>Our Products</h3>
                <span class="chd-pill">{{ $portfolios->count() }} Items</span>
            </div>
            <div class="card-bd">
                <div class="products-grid">
                    @php
                    $badges = ['new','hot','top','sale','',''];
                    $cats = ['Electronics','Fashion','Home','Beauty','Sports','Food'];
                    @endphp
                    @foreach($portfolios->take(6) as $index => $portfolio)
                        @php $images = json_decode($portfolio->image, true); @endphp
                        @if($images && count($images) > 0)
                        <div class="prod-card">
                            <div class="prod-img">
                                <img src="{{ url('public/frontend/portfolio/' . $images[0]) }}" alt="{{ $portfolio->title }}">
                                @if($badges[$index % 6])
                                <span class="prod-badge {{ $badges[$index % 6] }}">{{ strtoupper($badges[$index % 6]) }}</span>
                                @endif
                                <div class="prod-wish"><i class="fas fa-heart"></i></div>
                            </div>
                            <div class="prod-info">
                                <div class="prod-cat">{{ $cats[$index % 6] }}</div>
                                <div class="prod-name">{{ $portfolio->title ?? 'Product '.($index+1) }}</div>
                                @if($portfolio->desc)
                                <div class="prod-desc">{{ Str::limit($portfolio->desc, 48) }}</div>
                                @endif
                                <div class="prod-foot">
                                    <div>
                                        <div class="prod-stars">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                            <span class="prod-rating">({{ rand(12,98) }})</span>
                                        </div>
                                    </div>
                                    <div class="prod-cta"><i class="fas fa-plus"></i> Add</div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <!-- DUMMY PRODUCTS -->
        <div class="card">
            <div class="card-hd">
                <div class="chd-ico"><i class="fas fa-boxes-stacked"></i></div>
                <h3>Featured Products</h3>
                <span class="chd-pill">9 Items</span>
            </div>
            <div class="card-bd">
                <div class="products-grid">
                    @php
                    $dummyProds = [
                        ['Premium Watch','Elegant timepiece for every occasion','https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=400&q=80','new','Accessories'],
                        ['Running Shoes','Lightweight performance footwear','https://images.unsplash.com/photo-1491553895911-0055eca6402d?auto=format&fit=crop&w=400&q=80','hot','Sports'],
                        ['Luxury Perfume','Long-lasting signature fragrance','https://images.unsplash.com/photo-1585386959984-a4155224a1ad?auto=format&fit=crop&w=400&q=80','top','Beauty'],
                        ['Noise Headphones','Premium sound, all-day comfort','https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=400&q=80','sale','Electronics'],
                        ['Smart Camera','4K capture, pro-grade optics','https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=400&q=80','','Electronics'],
                        ['Leather Bag','Handcrafted Italian leather','https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&w=400&q=80','new','Fashion'],
                    ];
                    @endphp
                    @foreach($dummyProds as $i => $p)
                    <div class="prod-card">
                        <div class="prod-img">
                            <img src="{{ $p[2] }}" alt="{{ $p[0] }}">
                            @if($p[3])
                            <span class="prod-badge {{ $p[3] }}">{{ strtoupper($p[3]) }}</span>
                            @endif
                            <div class="prod-wish"><i class="fas fa-heart"></i></div>
                        </div>
                        <div class="prod-info">
                            <div class="prod-cat">{{ $p[4] }}</div>
                            <div class="prod-name">{{ $p[0] }}</div>
                            <div class="prod-desc">{{ $p[1] }}</div>
                            <div class="prod-foot">
                                <div class="prod-stars">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="prod-rating">({{ 24 + $i * 13 }})</span>
                                </div>
                                <div class="prod-cta"><i class="fas fa-plus"></i> Add</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- ── FLASH DEALS ── -->
        <div class="card deals-card">
            <div class="card-hd">
                <div class="chd-ico"><i class="fas fa-bolt"></i></div>
                <h3>Flash Deals</h3>
            </div>
            <div class="card-bd">
                <div class="deal-timer">
                    <span class="deal-timer-lbl">Ends in:</span>
                    <div class="timer-blocks">
                        <div class="tblock"><div class="tnum">05</div><div class="tlbl">HRS</div></div>
                        <div class="tcolon">:</div>
                        <div class="tblock"><div class="tnum">43</div><div class="tlbl">MIN</div></div>
                        <div class="tcolon">:</div>
                        <div class="tblock"><div class="tnum">21</div><div class="tlbl">SEC</div></div>
                    </div>
                </div>
                <div class="deals-scroll">
                    @php
                    $deals = [
                        ['Smart Watch Pro','https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=280&q=80','40% OFF','$89'],
                        ['Air Max Sneakers','https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=280&q=80','35% OFF','$65'],
                        ['Wireless Buds','https://images.unsplash.com/photo-1590658268037-6bf12165a8df?auto=format&fit=crop&w=280&q=80','50% OFF','$49'],
                        ['Leather Wallet','https://images.unsplash.com/photo-1627123424574-724758594e93?auto=format&fit=crop&w=280&q=80','25% OFF','$29'],
                        ['Sunglasses','https://images.unsplash.com/photo-1473496169904-658ba7574b0d?auto=format&fit=crop&w=280&q=80','30% OFF','$39'],
                    ];
                    @endphp
                    @foreach($deals as $d)
                    <div class="deal-item">
                        <img class="deal-img" src="{{ $d[1] }}" alt="{{ $d[0] }}">
                        <div class="deal-info">
                            <div class="deal-name">{{ $d[0] }}</div>
                            <span class="deal-off">{{ $d[2] }}</span>
                            <div class="deal-price">{{ $d[3] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ── WHY CHOOSE US ── -->
        @if($userdata->isFeatureVisible('qualifications') && $qualifications->count() > 0)
        <div class="card why-card">
            <div class="card-hd">
                <div class="chd-ico"><i class="fas fa-medal"></i></div>
                <h3>Why Shop With Us</h3>
            </div>
            <div class="card-bd">
                <div class="why-grid">
                    @php $whyIcons=['shield-alt','truck-fast','undo','headset','award','tag']; @endphp
                    @foreach($qualifications as $i => $qual)
                    <div class="why-item">
                        <div class="why-ico"><i class="fas fa-{{ $whyIcons[$i % 6] }}"></i></div>
                        <div><div class="why-title">{{ $qual->title }}</div></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="card why-card">
            <div class="card-hd">
                <div class="chd-ico"><i class="fas fa-medal"></i></div>
                <h3>Why Shop With Us</h3>
            </div>
            <div class="card-bd">
                <div class="why-grid">
                    @php
                    $whys = [
                        ['shield-alt','100% Authentic','All products are genuine & verified'],
                        ['truck-fast','Free Fast Shipping','Orders delivered within 24 hours'],
                        ['undo','Easy Returns','30-day hassle-free return policy'],
                        ['headset','24/7 Support','Always here to help you'],
                        ['tag','Best Prices','Guaranteed lowest prices'],
                        ['award','Award Winning','Top rated store 5 years running'],
                    ];
                    @endphp
                    @foreach($whys as $w)
                    <div class="why-item">
                        <div class="why-ico"><i class="fas fa-{{ $w[0] }}"></i></div>
                        <div>
                            <div class="why-title">{{ $w[1] }}</div>
                            <div class="why-sub">{{ $w[2] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- ── TESTIMONIALS ── -->
        <div class="card testi-card">
            <div class="card-hd">
                <div class="chd-ico"><i class="fas fa-quote-right"></i></div>
                <h3>Customer Reviews</h3>
                <span class="chd-pill" style="background:rgba(255,255,255,.12);color:#fff;">4.9 ★</span>
            </div>
            <div class="card-bd">
                <div class="testi-list">
                    <div class="testi-row">
                        <div class="tavi"><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=80&h=80&q=80" alt="Sarah"></div>
                        <div class="t-body">
                            <div class="t-head">
                                <span class="t-name">Sarah M.</span>
                                <div class="t-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <div class="t-verified"><i class="fas fa-check-circle"></i> Verified</div>
                            </div>
                            <div class="t-role">Loyal Customer · New York</div>
                            <p class="t-text">"Absolutely love the quality! Fast shipping and the product exceeded my expectations. Will definitely order again!"</p>
                        </div>
                    </div>
                    <div class="testi-row">
                        <div class="tavi"><img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=80&h=80&q=80" alt="James"></div>
                        <div class="t-body">
                            <div class="t-head">
                                <span class="t-name">James R.</span>
                                <div class="t-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <div class="t-verified"><i class="fas fa-check-circle"></i> Verified</div>
                            </div>
                            <div class="t-role">Premium Member · Los Angeles</div>
                            <p class="t-text">"Best online store I've used. The customer service is outstanding and the return process was completely seamless."</p>
                        </div>
                    </div>
                    <div class="testi-row">
                        <div class="tavi"><img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=80&h=80&q=80" alt="Emily"></div>
                        <div class="t-body">
                            <div class="t-head">
                                <span class="t-name">Emily K.</span>
                                <div class="t-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                                <div class="t-verified"><i class="fas fa-check-circle"></i> Verified</div>
                            </div>
                            <div class="t-role">Regular Buyer · Chicago</div>
                            <p class="t-text">"Amazing products at unbeatable prices. The premium watch I ordered was exactly as described — stunning quality!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── CONTACT ── -->
        <div class="card contact-card">
            <div class="card-hd">
                <div class="chd-ico"><i class="fas fa-address-card"></i></div>
                <h3>Contact & Store Info</h3>
            </div>
            <div class="card-bd">
                <div class="contact-grid">
                    @if($userdata->mobile)
                    <a href="tel:{{ $userdata->mobile }}" class="con-item">
                        <div class="con-ico"><i class="fas fa-phone"></i></div>
                        <div><div class="con-lbl">Phone / Order</div><div class="con-val">{{ $userdata->mobile }}</div></div>
                    </a>
                    @else
                    <a href="tel:+15551234567" class="con-item">
                        <div class="con-ico"><i class="fas fa-phone"></i></div>
                        <div><div class="con-lbl">Phone / Order</div><div class="con-val">+1 (555) 123-4567</div></div>
                    </a>
                    @endif

                    @if($userdata->email)
                    <a href="mailto:{{ $userdata->email }}" class="con-item">
                        <div class="con-ico"><i class="fas fa-envelope"></i></div>
                        <div><div class="con-lbl">Email Us</div><div class="con-val">{{ $userdata->email }}</div></div>
                    </a>
                    @else
                    <a href="mailto:shop@store.com" class="con-item">
                        <div class="con-ico"><i class="fas fa-envelope"></i></div>
                        <div><div class="con-lbl">Email Us</div><div class="con-val">shop@store.com</div></div>
                    </a>
                    @endif

                    @if($userdata->city || $userdata->state)
                    <div class="con-item">
                        <div class="con-ico"><i class="fas fa-map-marker-alt"></i></div>
                        <div><div class="con-lbl">Location</div><div class="con-val">{{ $userdata->city }}{{ $userdata->state ? ', '.$userdata->state : '' }}</div></div>
                    </div>
                    @else
                    <div class="con-item">
                        <div class="con-ico"><i class="fas fa-map-marker-alt"></i></div>
                        <div><div class="con-lbl">Location</div><div class="con-val">New York, NY 10001</div></div>
                    </div>
                    @endif

                    <div class="con-item">
                        <div class="con-ico"><i class="fas fa-clock"></i></div>
                        <div><div class="con-lbl">Store Hours</div><div class="con-val">Mon–Sat: 9AM – 8PM</div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── SOCIAL ── -->
        @if($social)
        <div class="card social-card">
            <div class="social-links">
                @if($social->facebook)<a href="{{ $social->facebook }}" class="soc-link" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>@endif
                @if($social->instagram)<a href="{{ $social->instagram }}" class="soc-link" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>@endif
                @if($social->linkedin)<a href="{{ $social->linkedin }}" class="soc-link" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>@endif
                @if($social->twitter)<a href="{{ $social->twitter }}" class="soc-link" target="_blank" title="Twitter/X"><i class="fab fa-twitter"></i></a>@endif
                @if($social->youtube)<a href="{{ $social->youtube }}" class="soc-link" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>@endif
            </div>
        </div>
        @else
        <div class="card social-card">
            <div class="social-links">
                <a href="#" class="soc-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="soc-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="soc-link" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="#" class="soc-link" title="Twitter/X"><i class="fab fa-twitter"></i></a>
                <a href="#" class="soc-link" title="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        @endif

    </div><!-- /.pc -->

    <footer class="profile-footer">
        <div class="foot-div"></div>
        <p>Digital Catalog by <a href="{{ url('/') }}">Fastap</a></p>
    </footer>

    <!-- Flash Deal Countdown Timer -->
    <script>
    (function(){
        var h=5,m=43,s=21;
        function pad(n){return n<10?'0'+n:n}
        function tick(){
            if(s>0){s--}else if(m>0){m--;s=59}else if(h>0){h--;m=59;s=59}
            var blocks=document.querySelectorAll('.tblock .tnum');
            if(blocks.length>=3){blocks[0].textContent=pad(h);blocks[1].textContent=pad(m);blocks[2].textContent=pad(s)}
        }
        setInterval(tick,1000);
    })();
    </script>

    @include('components.profile-location-tracker', [
        'customerId'  => $userdata->id ?? null,
        'profileSlug' => $userdata->slug ?? null,
        'isPreview'   => $isPreview ?? false
    ])
</body>
</html>