<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>{{ $userdata->name ?? 'Interior Designer' }} – Interior Design Studio</title>

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
          $menu = (object)array_fill_keys([
              'profile','quali','service','thought','personal','profess','videos','product',
              'social_link','upload_file','client','menu_section','reservation_section',
              'property_listings','showreel','team_section','pricing_section','booking_section'
          ], 1);
      }
  }

  /* ── Interior-specific image assets (public Unsplash URLs) ─────────── */
  $heroBg      = 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1800&h=900&fit=crop&auto=format&q=85';
  $heroRight   = 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=900&h=1100&fit=crop&auto=format&q=85';
  $aboutBg     = 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=900&h=700&fit=crop&auto=format&q=80';
  $ctaBg       = 'https://images.unsplash.com/photo-1631679706909-1844bbd07221?w=1800&h=700&fit=crop&auto=format&q=80';

  $portfolioFallbacks = [
      'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=700&h=520&fit=crop&auto=format&q=80',
      'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=700&h=520&fit=crop&auto=format&q=80',
      'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=700&h=520&fit=crop&auto=format&q=80',
      'https://images.unsplash.com/photo-1617104678098-de229db51175?w=700&h=520&fit=crop&auto=format&q=80',
      'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=700&h=520&fit=crop&auto=format&q=80',
      'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=700&h=520&fit=crop&auto=format&q=80',
  ];

  $serviceBgs = [
      'https://images.unsplash.com/photo-1560440021-33f9b867899d?w=600&h=450&fit=crop&auto=format&q=80',
      'https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&h=450&fit=crop&auto=format&q=80',
      'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=600&h=450&fit=crop&auto=format&q=80',
      'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&h=450&fit=crop&auto=format&q=80',
      'https://images.unsplash.com/photo-1631679706909-1844bbd07221?w=600&h=450&fit=crop&auto=format&q=80',
  ];

  $styleCards = [
      ['icon'=>'fa-crown',      'name'=>'Luxury',         'desc'=>'Opulent finishes & curated elegance',   'color'=>'#c9a84c'],
      ['icon'=>'fa-leaf',       'name'=>'Contemporary',   'desc'=>'Clean forms, bold accents',              'color'=>'#87a96b'],
      ['icon'=>'fa-circle',     'name'=>'Minimalist',     'desc'=>'Less is more — pure, open spaces',      'color'=>'#8b7355'],
      ['icon'=>'fa-tree',       'name'=>'Rustic',         'desc'=>'Natural textures, warm character',       'color'=>'#a0522d'],
      ['icon'=>'fa-industry',   'name'=>'Industrial',     'desc'=>'Raw materials, urban sophistication',    'color'=>'#607d8b'],
      ['icon'=>'fa-landmark',   'name'=>'Classic',        'desc'=>'Timeless symmetry & heritage detail',   'color'=>'#9c7b5e'],
  ];
@endphp

@if($websetting && $websetting->favicon)
<link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}" type="image/png"/>
@endif

<!-- Google Fonts: Cormorant Garamond (display) + DM Sans (body) -->
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
/* ════════════════════════════════════════════════════════════════
   DESIGN TOKENS  –  Luxury Editorial Interior
════════════════════════════════════════════════════════════════ */
:root{
  --id-gold       : #c9a84c;
  --id-gold-l     : #f0e1b0;
  --id-gold-d     : #a88730;
  --id-charcoal   : #1a1714;
  --id-dark       : #2c2620;
  --id-mid        : #6b5e52;
  --id-muted      : #9e9185;
  --id-border     : #e8e0d4;
  --id-cream      : #faf7f2;
  --id-cream-d    : #f0ebe1;
  --id-white      : #ffffff;
  --id-terracotta : #c1694f;
  --id-sage       : #87a96b;
  --id-taupe      : #8b7355;

  --id-shadow-sm  : 0 2px 8px rgba(26,23,20,.07);
  --id-shadow     : 0 8px 32px rgba(26,23,20,.12);
  --id-shadow-lg  : 0 24px 64px rgba(26,23,20,.18);

  --id-radius     : 4px;
  --id-trans      : all .32s cubic-bezier(.4,0,.2,1);
  --font-display  : 'Cormorant Garamond',serif;
  --font-body     : 'DM Sans',sans-serif;
}

/* ── RESET ── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{
  font-family:var(--font-body);
  background:var(--id-cream);
  color:var(--id-dark);
  line-height:1.65;
  overflow-x:hidden;
}
a{text-decoration:none;color:inherit}
img{max-width:100%;height:auto;display:block}
ul{list-style:none}

/* ── PREVIEW BANNER ── */
.id-preview-bar{
  background:linear-gradient(90deg,#7c3aed,#ec4899);
  color:#fff;text-align:center;padding:10px 16px;font-size:.84rem;
  position:sticky;top:0;z-index:9999;
}
.id-preview-bar a{color:#fde68a;font-weight:700;text-decoration:underline}

/* ════════════════════════════════════════════════════════════════
   EDITORIAL HERO  (Full-bleed split layout)
════════════════════════════════════════════════════════════════ */
.id-hero{
  min-height:100vh;
  display:grid;
  grid-template-columns:55% 45%;
  position:relative;
  overflow:hidden;
}

/* Left panel: dark overlay + text */
.hero-left{
  position:relative;
  background-color:var(--id-charcoal);
  background-image:url('{{ $heroBg }}');
  background-size:cover;
  background-position:center;
  display:flex;
  flex-direction:column;
  justify-content:flex-end;
  padding:60px 56px;
  z-index:1;
}
.hero-left::before{
  content:'';
  position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(26,23,20,.25) 0%,rgba(26,23,20,.78) 70%,rgba(26,23,20,.94) 100%);
  z-index:0;
}
.hero-left-content{position:relative;z-index:1}

/* Thin gold rule */
.hero-rule{
  width:48px;height:2px;
  background:var(--id-gold);
  margin-bottom:20px;
}
.hero-eyebrow{
  font-family:var(--font-body);
  font-size:.75rem;font-weight:600;
  letter-spacing:.18em;text-transform:uppercase;
  color:var(--id-gold);margin-bottom:14px;
}
.hero-name{
  font-family:var(--font-display);
  font-size:clamp(2.8rem,5vw,5rem);
  font-weight:300;line-height:1.05;
  color:#fff;margin-bottom:10px;
  letter-spacing:-.01em;
}
.hero-name strong{font-weight:700;display:block}
.hero-desig{
  font-family:var(--font-display);
  font-size:clamp(1rem,1.8vw,1.3rem);
  color:var(--id-gold-l);font-style:italic;
  font-weight:400;margin-bottom:28px;
}
.hero-meta{
  display:flex;flex-wrap:wrap;gap:10px;margin-bottom:36px;
}
.hero-meta-chip{
  display:inline-flex;align-items:center;gap:7px;
  background:rgba(255,255,255,.08);
  border:1px solid rgba(255,255,255,.2);
  color:#e8e0d4;font-size:.78rem;font-weight:500;
  padding:6px 14px;border-radius:2px;
  backdrop-filter:blur(4px);
}
.hero-meta-chip i{color:var(--id-gold);font-size:.7rem}
.hero-cta-row{display:flex;flex-wrap:wrap;gap:12px}
.hero-btn{
  display:inline-flex;align-items:center;gap:8px;
  padding:14px 28px;
  font-size:.85rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;
  transition:var(--id-trans);
}
.hero-btn-gold{
  background:var(--id-gold);color:var(--id-charcoal);
  box-shadow:0 6px 24px rgba(201,168,76,.35);
}
.hero-btn-gold:hover{background:var(--id-gold-d);transform:translateY(-2px)}
.hero-btn-outline{
  background:transparent;color:#fff;
  border:1.5px solid rgba(255,255,255,.4);
}
.hero-btn-outline:hover{background:rgba(255,255,255,.1);transform:translateY(-2px)}

/* Vertical text on left edge */
.hero-vertical-text{
  position:absolute;top:50%;left:20px;
  transform:rotate(-90deg) translateX(50%);
  font-size:.7rem;letter-spacing:.18em;text-transform:uppercase;
  color:rgba(255,255,255,.3);font-weight:500;
  white-space:nowrap;z-index:1;
}

/* Right panel: profile photo stack */
.hero-right{
  position:relative;
  background:var(--id-cream-d);
  overflow:hidden;
  display:flex;flex-direction:column;
  justify-content:flex-end;
  padding:0;
}
.hero-right-img{
  width:100%;height:100%;
  object-fit:cover;object-position:center top;
  position:absolute;inset:0;
}
/* gold number watermark */
.hero-right::before{
  content:'01';
  position:absolute;bottom:32px;right:28px;
  font-family:var(--font-display);font-size:6rem;font-weight:700;
  color:rgba(201,168,76,.12);line-height:1;
  z-index:2;
}
.hero-stats-float{
  position:absolute;bottom:40px;left:28px;z-index:3;
  display:grid;grid-template-columns:repeat(3,auto);gap:1px;
  background:rgba(26,23,20,.15);
  backdrop-filter:blur(12px);
  border:1px solid rgba(201,168,76,.35);
}
.hs-item{
  padding:16px 22px;text-align:center;
  background:rgba(26,23,20,.55);
}
.hs-num{
  font-family:var(--font-display);
  font-size:1.7rem;font-weight:700;
  color:var(--id-gold);line-height:1;
}
.hs-lbl{
  font-size:.65rem;color:#c8bfb5;
  text-transform:uppercase;letter-spacing:.1em;margin-top:3px;
}

/* ════════════════════════════════════════════════════════════════
   SECTION UTILITIES
════════════════════════════════════════════════════════════════ */
.id-section{padding:96px 24px;max-width:1280px;margin:0 auto}
.id-section-hd{margin-bottom:56px}
.id-section-hd.center{text-align:center}
.id-eyebrow{
  font-size:.72rem;font-weight:600;
  letter-spacing:.18em;text-transform:uppercase;
  color:var(--id-gold);margin-bottom:10px;
  display:flex;align-items:center;gap:10px;
}
.id-eyebrow::after{
  content:'';flex:1;max-width:48px;height:1px;background:var(--id-gold);opacity:.5;
}
.id-section-hd.center .id-eyebrow{justify-content:center}
.id-section-hd.center .id-eyebrow::before{
  content:'';flex:1;max-width:48px;height:1px;background:var(--id-gold);opacity:.5;
}
.id-title{
  font-family:var(--font-display);
  font-size:clamp(2rem,4vw,3.2rem);
  font-weight:300;
  color:var(--id-charcoal);
  line-height:1.1;
  margin-bottom:14px;
}
.id-title em{font-style:italic;font-weight:400;color:var(--id-taupe)}
.id-sub{
  font-size:.97rem;color:var(--id-mid);
  max-width:560px;line-height:1.75;
}
.id-section-hd.center .id-sub{margin:0 auto}
.id-divider{
  height:1px;
  background:linear-gradient(90deg,transparent,var(--id-border),transparent);
  margin:0 48px;
}

/* ════════════════════════════════════════════════════════════════
   PROFILE / IDENTITY CARD  (below hero)
════════════════════════════════════════════════════════════════ */
.id-identity-wrap{
    margin-top: 80px;
  max-width:1280px;margin:-80px auto 0;padding:0 48px;
  position:relative;z-index:20;
}
.id-identity-card{
  margin-top: 60px;
  background:var(--id-white);
  border:1px solid var(--id-border);
  box-shadow:var(--id-shadow-lg);
  display:grid;grid-template-columns:auto 1fr auto;
  align-items:center;gap:0;
  position:relative;
}
/* top gold accent line */
.id-identity-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  background:linear-gradient(90deg,var(--id-gold),var(--id-gold-d));
}

.idc-avatar-col{
  padding:32px 40px;border-right:1px solid var(--id-border);
  display:flex;flex-direction:column;align-items:center;gap:12px;
  min-width:200px;
}
.idc-avatar-frame{
  position:relative;width:130px;height:130px;
}
.idc-avatar-frame::before{
  content:'';
  position:absolute;
  top:-6px;left:-6px;right:6px;bottom:6px;
  border:1.5px solid var(--id-gold);
  z-index:0;
}
.idc-avatar{
  width:130px;height:130px;
  object-fit:cover;object-position:top;
  position:relative;z-index:1;
  filter:grayscale(10%);
}
.idc-avatar-placeholder{
  width:130px;height:130px;
  background:linear-gradient(135deg,var(--id-taupe),var(--id-terracotta));
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:3.5rem;
  position:relative;z-index:1;
}
.idc-verified{
  display:inline-flex;align-items:center;gap:5px;
  font-size:.7rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;
  color:var(--id-gold);
  border:1px solid rgba(201,168,76,.4);
  padding:4px 12px;
}
.idc-verified i{font-size:.65rem}

/* center info */
.idc-info-col{
    margin-top: 40px;
  padding:32px 40px;
}
.idc-name{
  font-family:var(--font-display);
  font-size:clamp(1.6rem,3vw,2.4rem);
  font-weight:600;color:var(--id-charcoal);
  letter-spacing:-.01em;line-height:1.1;
  margin-bottom:4px;
}
.idc-desig{
  font-family:var(--font-display);
  font-size:1rem;font-style:italic;
  color:var(--id-taupe);margin-bottom:18px;
}
.idc-badges{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px}
.idc-badge{
  display:inline-flex;align-items:center;gap:6px;
  font-size:.72rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;
  padding:5px 12px;
  border:1px solid var(--id-border);
  color:var(--id-mid);
  transition:var(--id-trans);
}
.idc-badge:hover{border-color:var(--id-gold);color:var(--id-gold)}
.idc-badge i{color:var(--id-gold);font-size:.68rem}
.idc-qs{display:flex;gap:32px}
.idc-q{text-align:center}
.idc-q-num{
  font-family:var(--font-display);
  font-size:2rem;font-weight:700;
  color:var(--id-charcoal);line-height:1;
}
.idc-q-lbl{
  font-size:.68rem;color:var(--id-muted);
  text-transform:uppercase;letter-spacing:.08em;margin-top:2px;
}

/* right actions col */
.idc-actions-col{
  padding:32px 40px;border-left:1px solid var(--id-border);
  display:flex;flex-direction:column;gap:10px;min-width:210px;
}
.idc-action-btn{
  display:flex;align-items:center;gap:10px;
  padding:12px 18px;
  font-size:.82rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;
  transition:var(--id-trans);
}
.idc-btn-gold{background:var(--id-gold);color:var(--id-charcoal)}
.idc-btn-gold:hover{background:var(--id-gold-d);transform:translateX(3px)}
.idc-btn-dark{background:var(--id-charcoal);color:#fff}
.idc-btn-dark:hover{background:var(--id-dark);transform:translateX(3px)}
.idc-btn-outline{
  background:transparent;color:var(--id-dark);
  border:1px solid var(--id-border);
}
.idc-btn-outline:hover{border-color:var(--id-gold);color:var(--id-gold);transform:translateX(3px)}

/* ════════════════════════════════════════════════════════════════
   ABOUT / STUDIO SPLIT  (image + text)
════════════════════════════════════════════════════════════════ */
.id-about-split{
  display:grid;grid-template-columns:1fr 1fr;
  max-width:1280px;margin:0 auto;
  min-height:520px;
}
.about-image-col{
  position:relative;overflow:hidden;
}
.about-image-col img{
  width:100%;height:100%;object-fit:cover;
  filter:saturate(0.9);
  transition:transform .8s ease;
}
.about-image-col:hover img{transform:scale(1.03)}
/* gold frame accent */
.about-image-col::after{
  content:'';position:absolute;
  top:24px;left:24px;right:-24px;bottom:-24px;
  border:1.5px solid rgba(201,168,76,.3);
  pointer-events:none;z-index:2;
}
.about-text-col{
  background:var(--id-white);
  padding:72px 64px;
  display:flex;flex-direction:column;justify-content:center;
  border:1px solid var(--id-border);border-left:none;
}
.about-pull-quote{
  font-family:var(--font-display);
  font-size:clamp(1.5rem,2.5vw,2.1rem);
  font-style:italic;font-weight:400;
  color:var(--id-charcoal);
  line-height:1.45;
  margin-bottom:28px;
  padding-left:20px;
  border-left:3px solid var(--id-gold);
}
.about-body{
  font-size:.95rem;color:var(--id-mid);line-height:1.8;
  margin-bottom:32px;
}
.about-cta{
  display:inline-flex;align-items:center;gap:10px;
  font-size:.8rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--id-gold);
  transition:var(--id-trans);
}
.about-cta:hover{gap:16px}
.about-cta::after{
  content:'→';font-size:1rem;
}

/* ════════════════════════════════════════════════════════════════
   SERVICES  (editorial magazine cards)
════════════════════════════════════════════════════════════════ */
.id-services-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:1px;
  background:var(--id-border);
  border:1px solid var(--id-border);
}
.svc-ed-card{
  background:var(--id-white);
  overflow:hidden;
  position:relative;
  transition:var(--id-trans);
}
.svc-ed-card:hover{background:var(--id-cream)}
.svc-ed-img{
  height:220px;overflow:hidden;
}
.svc-ed-img img{
  width:100%;height:100%;object-fit:cover;
  filter:saturate(.85) brightness(.97);
  transition:transform .6s ease,filter .4s ease;
}
.svc-ed-card:hover .svc-ed-img img{
  transform:scale(1.06);filter:saturate(1) brightness(1);
}
.svc-ed-body{padding:26px 28px 30px}
/* card number */
.svc-ed-num{
  font-family:var(--font-display);
  font-size:3.5rem;font-weight:700;
  color:rgba(201,168,76,.12);
  line-height:1;margin-bottom:-8px;
}
.svc-ed-title{
  font-family:var(--font-display);
  font-size:1.3rem;font-weight:600;
  color:var(--id-charcoal);margin-bottom:8px;
}
.svc-ed-desc{
  font-size:.85rem;color:var(--id-mid);line-height:1.7;
}
.svc-ed-link{
  display:inline-flex;align-items:center;gap:7px;
  margin-top:14px;
  font-size:.73rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  color:var(--id-gold);transition:var(--id-trans);
}
.svc-ed-link:hover{gap:12px}

/* ════════════════════════════════════════════════════════════════
   DESIGN STYLES  (horizontal pill cards)
════════════════════════════════════════════════════════════════ */
.id-styles-bg{
  background:var(--id-charcoal);
  padding:80px 24px;
}
.id-styles-inner{max-width:1280px;margin:0 auto}
.id-styles-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:1px;
  background:rgba(255,255,255,.08);
  margin-top:52px;
}
.style-ed-card{
  background:rgba(255,255,255,.03);
  padding:36px 32px;
  position:relative;
  overflow:hidden;
  transition:var(--id-trans);
  cursor:default;
}
.style-ed-card:hover{background:rgba(201,168,76,.07)}
/* large background letter */
.style-ed-card::before{
  content:attr(data-letter);
  position:absolute;bottom:-10px;right:10px;
  font-family:var(--font-display);font-size:7rem;font-weight:700;
  color:rgba(255,255,255,.04);line-height:1;
  pointer-events:none;
}
.style-ed-icon{
  width:48px;height:2px;
  background:var(--id-gold);
  margin-bottom:20px;
  transition:width .3s ease;
}
.style-ed-card:hover .style-ed-icon{width:72px}
.style-ed-name{
  font-family:var(--font-display);
  font-size:1.5rem;font-weight:600;
  color:#fff;margin-bottom:8px;letter-spacing:.01em;
}
.style-ed-desc{
  font-size:.83rem;color:rgba(255,255,255,.5);line-height:1.6;
}

/* ════════════════════════════════════════════════════════════════
   PORTFOLIO  (asymmetric editorial grid)
════════════════════════════════════════════════════════════════ */
.id-portfolio-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  grid-template-rows:auto auto;
  gap:12px;
}
/* first item spans 2 rows on left */
.port-item{
  position:relative;overflow:hidden;
  background:var(--id-border);
  cursor:pointer;
}
.port-item:first-child{
  grid-column:1 / 2;
  grid-row:1 / 3;
}
.port-item:nth-child(2){grid-column:2/3;grid-row:1/2}
.port-item:nth-child(3){grid-column:3/4;grid-row:1/2}
.port-item:nth-child(4){grid-column:2/3;grid-row:2/3}
.port-item:nth-child(5){grid-column:3/4;grid-row:2/3}
/* 6th item spans full width */
.port-item:nth-child(6){grid-column:1/4;grid-row:3/4;aspect-ratio:16/5}

.port-item img{
  width:100%;height:100%;object-fit:cover;
  transition:transform .7s ease,filter .4s ease;
  filter:saturate(.85);
}
.port-item:hover img{transform:scale(1.06);filter:saturate(1)}

/* number label */
.port-num{
  position:absolute;top:14px;left:14px;
  font-family:var(--font-display);
  font-size:.9rem;font-weight:700;
  color:#fff;background:var(--id-gold);
  padding:4px 10px;
  z-index:2;
}
.port-overlay{
  position:absolute;inset:0;
  background:linear-gradient(180deg,transparent 50%,rgba(26,23,20,.8) 100%);
  opacity:0;transition:var(--id-trans);
  display:flex;align-items:flex-end;padding:20px;z-index:2;
}
.port-item:hover .port-overlay{opacity:1}
.port-overlay-text{
  font-family:var(--font-display);
  font-size:1rem;font-weight:600;color:#fff;
  letter-spacing:.03em;text-transform:uppercase;
}

/* ════════════════════════════════════════════════════════════════
   STATS BAND
════════════════════════════════════════════════════════════════ */
.id-stats-band{
  background:var(--id-white);
  border-top:1px solid var(--id-border);
  border-bottom:1px solid var(--id-border);
  padding:0;
}
.id-stats-inner{
  max-width:1280px;margin:0 auto;
  display:grid;grid-template-columns:repeat(4,1fr);
  gap:0;
}
.stat-ed{
  padding:52px 24px;
  text-align:center;
  border-right:1px solid var(--id-border);
  position:relative;transition:var(--id-trans);
}
.stat-ed:last-child{border-right:none}
.stat-ed:hover{background:var(--id-cream)}
.stat-ed::before{
  content:'';position:absolute;
  top:0;left:50%;transform:translateX(-50%);
  width:32px;height:2px;background:var(--id-gold);
  transition:width .3s ease;
}
.stat-ed:hover::before{width:56px}
.stat-num{
  font-family:var(--font-display);
  font-size:clamp(2rem,4vw,3.2rem);
  font-weight:700;color:var(--id-charcoal);
  line-height:1;margin-bottom:8px;
}
.stat-lbl{
  font-size:.72rem;font-weight:600;
  color:var(--id-muted);text-transform:uppercase;letter-spacing:.12em;
}

/* ════════════════════════════════════════════════════════════════
   QUALIFICATIONS / WHY CHOOSE (minimal card row)
════════════════════════════════════════════════════════════════ */
.id-why-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
  gap:1px;
  background:var(--id-border);
  border:1px solid var(--id-border);
}
.why-ed-card{
  background:var(--id-white);
  padding:36px 32px;
  transition:var(--id-trans);
}
.why-ed-card:hover{background:var(--id-cream)}
.why-ed-line{
  width:36px;height:2px;background:var(--id-gold);margin-bottom:20px;
  transition:width .3s ease;
}
.why-ed-card:hover .why-ed-line{width:56px}
.why-ed-title{
  font-family:var(--font-display);
  font-size:1.2rem;font-weight:600;color:var(--id-charcoal);
  margin-bottom:10px;
}
.why-ed-desc{font-size:.85rem;color:var(--id-mid);line-height:1.7}

/* ════════════════════════════════════════════════════════════════
   PHILOSOPHY / TESTIMONIAL QUOTE
════════════════════════════════════════════════════════════════ */
.id-philosophy-bg{
  background:var(--id-cream-d);
  border-top:1px solid var(--id-border);
  border-bottom:1px solid var(--id-border);
  padding:96px 24px;
}
.id-philosophy-inner{
  max-width:820px;margin:0 auto;text-align:center;
}
.philosophy-mark{
  font-family:var(--font-display);
  font-size:7rem;line-height:.6;
  color:var(--id-gold);opacity:.3;
  margin-bottom:16px;
}
.philosophy-text{
  font-family:var(--font-display);
  font-size:clamp(1.3rem,2.5vw,2rem);
  font-style:italic;font-weight:400;
  color:var(--id-charcoal);
  line-height:1.55;margin-bottom:24px;
}
.philosophy-attr{
  font-size:.78rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;
  color:var(--id-gold);
  display:flex;align-items:center;justify-content:center;gap:10px;
}
.philosophy-attr::before,.philosophy-attr::after{
  content:'';width:28px;height:1px;background:var(--id-gold);
}

/* ════════════════════════════════════════════════════════════════
   CONTACT  (dark full-bleed)
════════════════════════════════════════════════════════════════ */
.id-contact-bg{
  background:var(--id-charcoal);
  padding:80px 24px;
  position:relative;overflow:hidden;
}
.id-contact-bg::before{
  content:'';position:absolute;inset:0;
  background-image:url('{{ $ctaBg }}');
  background-size:cover;background-position:center;
  opacity:.06;
}
.id-contact-inner{max-width:1280px;margin:0 auto;position:relative;z-index:1}
.id-contact-grid{
  display:grid;
  grid-template-columns:1fr 1fr 1fr 1fr;
  gap:1px;background:rgba(255,255,255,.08);
  border:1px solid rgba(255,255,255,.08);
  margin-top:52px;
}
.contact-ed{
  background:rgba(255,255,255,.03);
  padding:36px 28px;
  transition:var(--id-trans);
  position:relative;overflow:hidden;
}
.contact-ed:hover{background:rgba(201,168,76,.08)}
.contact-ed::before{
  content:'';position:absolute;
  top:0;left:0;width:2px;height:0;
  background:var(--id-gold);
  transition:height .3s ease;
}
.contact-ed:hover::before{height:100%}
.contact-ed a{
  display:block;height:100%;
  color:inherit;
}
.contact-icon-ed{
  font-size:1.6rem;color:var(--id-gold);
  margin-bottom:16px;
}
.contact-lbl-ed{
  font-size:.68rem;font-weight:600;letter-spacing:.12em;
  text-transform:uppercase;color:rgba(255,255,255,.4);
  margin-bottom:6px;
}
.contact-val-ed{
  font-family:var(--font-display);
  font-size:1.05rem;color:#fff;font-weight:500;
  line-height:1.3;
}

/* ════════════════════════════════════════════════════════════════
   CTA BAND  (consultation booking)
════════════════════════════════════════════════════════════════ */
.id-cta-band{
  position:relative;overflow:hidden;
  padding:100px 24px;
  text-align:center;
  background:var(--id-white);
  border-top:1px solid var(--id-border);
}
/* large italic watermark */
.id-cta-band::before{
  content:'DESIGN';
  position:absolute;
  top:50%;left:50%;transform:translate(-50%,-50%);
  font-family:var(--font-display);
  font-size:14vw;font-weight:700;font-style:italic;
  color:rgba(26,23,20,.04);
  white-space:nowrap;pointer-events:none;
  z-index:0;
}
.cta-inner{position:relative;z-index:1}
.cta-title{
  font-family:var(--font-display);
  font-size:clamp(2rem,4vw,3.8rem);
  font-weight:300;color:var(--id-charcoal);
  line-height:1.05;margin-bottom:12px;
}
.cta-title em{font-style:italic;color:var(--id-taupe)}
.cta-sub{
  font-size:.97rem;color:var(--id-mid);
  max-width:480px;margin:0 auto 36px;line-height:1.7;
}
.cta-btns{display:flex;flex-wrap:wrap;gap:14px;justify-content:center}
.cta-btn{
  display:inline-flex;align-items:center;gap:9px;
  padding:15px 32px;
  font-size:.82rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  transition:var(--id-trans);
}
.cta-btn-dark{
  background:var(--id-charcoal);color:#fff;
  box-shadow:0 6px 24px rgba(26,23,20,.25);
}
.cta-btn-dark:hover{background:var(--id-dark);transform:translateY(-2px)}
.cta-btn-gold{
  background:var(--id-gold);color:var(--id-charcoal);
  box-shadow:0 6px 24px rgba(201,168,76,.3);
}
.cta-btn-gold:hover{background:var(--id-gold-d);transform:translateY(-2px)}
.cta-btn-ghost{
  background:transparent;color:var(--id-charcoal);
  border:1.5px solid var(--id-charcoal);
}
.cta-btn-ghost:hover{background:var(--id-charcoal);color:#fff;transform:translateY(-2px)}

/* ════════════════════════════════════════════════════════════════
   SOCIAL
════════════════════════════════════════════════════════════════ */
.id-social-strip{
  background:var(--id-cream-d);
  border-top:1px solid var(--id-border);
  padding:32px 24px;
}
.id-social-inner{
  max-width:400px;margin:0 auto;text-align:center;
}
.social-lbl-ed{
  font-size:.7rem;font-weight:600;letter-spacing:.14em;
  text-transform:uppercase;color:var(--id-muted);
  margin-bottom:16px;
}
.social-row{display:flex;flex-wrap:wrap;gap:8px;justify-content:center}
.si-ed{
  width:42px;height:42px;
  display:flex;align-items:center;justify-content:center;
  font-size:1rem;
  background:var(--id-white);
  border:1px solid var(--id-border);
  color:var(--id-mid);
  transition:var(--id-trans);
}
.si-ed:hover{background:var(--id-charcoal);color:#fff;border-color:var(--id-charcoal)}
.si-wa:hover{background:#25d366;border-color:#25d366;color:#fff}

/* ════════════════════════════════════════════════════════════════
   FOOTER
════════════════════════════════════════════════════════════════ */
.id-footer{
  background:var(--id-charcoal);padding:28px 24px;
  display:flex;align-items:center;justify-content:space-between;
  gap:12px;flex-wrap:wrap;
}
.footer-brand{
  font-family:var(--font-display);
  font-size:1.1rem;color:rgba(255,255,255,.5);
}
.footer-brand span{color:var(--id-gold)}
.footer-copy{
  font-size:.78rem;color:rgba(255,255,255,.3);
}
.footer-copy a{color:var(--id-gold)}

/* ════════════════════════════════════════════════════════════════
   FLOATING CALL + WA
════════════════════════════════════════════════════════════════ */
.fab-stack{
  position:fixed;bottom:28px;right:28px;z-index:9999;
  display:flex;flex-direction:column;gap:10px;
}
.fab-item{
  width:52px;height:52px;
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:1.3rem;
  transition:var(--id-trans);
  box-shadow:0 4px 18px rgba(0,0,0,.18);
}
.fab-call{background:var(--id-gold)}
.fab-call:hover{background:var(--id-gold-d);transform:scale(1.1)}
.fab-wa{background:#25d366}
.fab-wa:hover{background:#1da851;transform:scale(1.1)}

/* ════════════════════════════════════════════════════════════════
   SCROLL REVEAL
════════════════════════════════════════════════════════════════ */
.reveal{
  opacity:0;transform:translateY(24px);
  transition:opacity .65s ease,transform .65s ease;
}
.reveal.visible{opacity:1;transform:none}

/* ════════════════════════════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════════════════════════════ */
@media(max-width:1024px){
  .id-hero{grid-template-columns:1fr;min-height:auto}
  .hero-right{display:none}
  .hero-left{min-height:90vh;padding:48px 32px 80px}
  .id-identity-wrap{padding:0 24px;margin-top:-60px}
  .id-identity-card{grid-template-columns:1fr}
  .idc-avatar-col{border-right:none;border-bottom:1px solid var(--id-border);padding:28px 24px}
  .idc-actions-col{border-left:none;border-top:1px solid var(--id-border);padding:24px}
  .id-about-split{grid-template-columns:1fr}
  .about-image-col{min-height:360px}
  .about-image-col::after{display:none}
  .about-text-col{border-left:1px solid var(--id-border);padding:48px 32px}
  .id-services-grid{grid-template-columns:1fr 1fr}
  .id-styles-grid{grid-template-columns:1fr 1fr}
  .id-stats-inner{grid-template-columns:repeat(2,1fr)}
  .stat-ed{border-right:none;border-bottom:1px solid var(--id-border)}
  .id-contact-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:768px){
  .id-portfolio-grid{grid-template-columns:1fr 1fr}
  .port-item:first-child{grid-column:1/3;grid-row:1/2}
  .port-item:nth-child(n){grid-column:auto;grid-row:auto}
  .port-item:nth-child(6){grid-column:1/3;aspect-ratio:auto;min-height:200px}
  .id-services-grid{grid-template-columns:1fr}
  .id-styles-grid{grid-template-columns:1fr}
  .id-contact-grid{grid-template-columns:1fr}
  .idc-qs{gap:20px}
  .id-cta-band{padding:64px 24px}
  .id-footer{flex-direction:column;text-align:center}
}
@media(max-width:480px){
  .idc-qs{flex-wrap:wrap;gap:16px}
  .hero-cta-row{flex-direction:column;align-items:flex-start}
}
</style>
</head>
<body>

@include('frontend.profile-themes.partials.profile-top-actions')

{{-- ── PREVIEW BAR ─────────────────────────────────────── --}}
@if($isPreview ?? false)
<div class="id-preview-bar">
  <i class="fas fa-eye"></i> Preview Mode —
  <a href="{{ url('/signin') }}">Sign up</a> to create your own professional profile.
</div>
@endif

{{-- ══════════════════════════════════════════════════════════
     EDITORIAL HERO
══════════════════════════════════════════════════════════ --}}
<section class="id-hero">

  {{-- Left: text over full-bleed image --}}
  <div class="hero-left">
    <div class="hero-vertical-text">Interior · Design · Studio</div>
    <div class="hero-left-content">
      <div class="hero-rule"></div>
      <div class="hero-eyebrow">
        <i class="fa-solid fa-drafting-compass"></i> &nbsp;Interior Design Studio
      </div>
      <h1 class="hero-name">
        {{ $userdata->name ?? 'Studio Name' }}
        @if(isset($userdata->designation) && $userdata->designation)
          <strong style="font-style:italic;font-weight:300">{{ $userdata->designation }}</strong>
        @endif
      </h1>
      <p class="hero-desig">
        Transforming Spaces · Crafting Experiences
      </p>
      <div class="hero-meta">
        <span class="hero-meta-chip">
          <i class="fa-solid fa-award"></i> Award-Winning Design
        </span>
        @if(isset($userdata->city) && $userdata->city)
        <span class="hero-meta-chip">
          <i class="fa-solid fa-location-dot"></i> {{ $userdata->city }}
        </span>
        @endif
        <span class="hero-meta-chip">
          <i class="fa-solid fa-check-circle"></i> Certified Designer
        </span>
        <span class="hero-meta-chip">
          <i class="fa-solid fa-clock"></i> 10+ Years Experience
        </span>
      </div>
      <div class="hero-cta-row">
        @if(isset($userdata->contact) && $userdata->contact)
        <a href="tel:{{ $userdata->contact }}" class="hero-btn hero-btn-gold">
          <i class="fa-solid fa-calendar-check"></i> Book Consultation
        </a>
        @endif
        @if(isset($userdata->email) && $userdata->email)
        <a href="mailto:{{ $userdata->email }}" class="hero-btn hero-btn-outline">
          <i class="fa-solid fa-envelope"></i> Email Studio
        </a>
        @endif
      </div>
    </div>
  </div>

  {{-- Right: editorial portrait image --}}
  <div class="hero-right">
    <img class="hero-right-img"
         src="{{ $heroRight }}"
         alt="Interior Design Studio"
         loading="eager"/>
    <div class="hero-stats-float">
      <div class="hs-item">
        <div class="hs-num">10+</div>
        <div class="hs-lbl">Years</div>
      </div>
      <div class="hs-item">
        <div class="hs-num">200+</div>
        <div class="hs-lbl">Projects</div>
      </div>
      <div class="hs-item">
        <div class="hs-num">100%</div>
        <div class="hs-lbl">Satisfaction</div>
      </div>
    </div>
  </div>

</section>

{{-- ══════════════════════════════════════════════════════════
     IDENTITY / PROFILE CARD  (floating)
══════════════════════════════════════════════════════════ --}}
<div class="id-identity-wrap reveal">
  <div class="id-identity-card">

    {{-- Avatar --}}
    <div class="idc-avatar-col">
      <div class="idc-avatar-frame">
        @if(isset($userdata->profile) && $userdata->profile)
          <img class="idc-avatar"
               src="{{ asset('public/frontend/user_images/'.$userdata->profile) }}"
               alt="{{ $userdata->name }}"/>
        @else
          <div class="idc-avatar-placeholder">
            <i class="fa-solid fa-drafting-compass"></i>
          </div>
        @endif
      </div>
      <div class="idc-verified">
        <i class="fa-solid fa-shield-halved"></i> Verified Studio
      </div>
    </div>

    {{-- Info --}}
    <div class="idc-info-col">
      <div class="idc-name">{{ $userdata->name ?? 'Studio Name' }}</div>
      @if(isset($userdata->designation) && $userdata->designation)
      <div class="idc-desig">{{ $userdata->designation }}</div>
      @endif

      <div class="idc-badges">
        <span class="idc-badge"><i class="fa-solid fa-crown"></i> Luxury Interiors</span>
        <span class="idc-badge"><i class="fa-solid fa-cube"></i> 3D Visualization</span>
        <span class="idc-badge"><i class="fa-solid fa-building"></i> Commercial</span>
        <span class="idc-badge"><i class="fa-solid fa-home"></i> Residential</span>
      </div>

      <div class="idc-qs">
        <div class="idc-q">
          <div class="idc-q-num">10+</div>
          <div class="idc-q-lbl">Years Exp.</div>
        </div>
        <div class="idc-q">
          <div class="idc-q-num">200+</div>
          <div class="idc-q-lbl">Projects</div>
        </div>
        <div class="idc-q">
          <div class="idc-q-num">100%</div>
          <div class="idc-q-lbl">Satisfaction</div>
        </div>
        @if(isset($interiorServices) && $interiorServices->count() > 0)
        <div class="idc-q">
          <div class="idc-q-num">{{ $interiorServices->count() }}</div>
          <div class="idc-q-lbl">Services</div>
        </div>
        @endif
      </div>
    </div>

    {{-- Actions --}}
    <div class="idc-actions-col">
      @if(isset($userdata->contact) && $userdata->contact)
      <a href="tel:{{ $userdata->contact }}" class="idc-action-btn idc-btn-gold">
        <i class="fa-solid fa-phone"></i> Call Studio
      </a>
      @endif
      @if(isset($userdata->email) && $userdata->email)
      <a href="mailto:{{ $userdata->email }}" class="idc-action-btn idc-btn-dark">
        <i class="fa-solid fa-envelope"></i> Email Us
      </a>
      @endif
      @if(isset($userdata->city) && $userdata->city)
      <span class="idc-action-btn idc-btn-outline">
        <i class="fa-solid fa-location-dot"></i> {{ $userdata->city }}
      </span>
      @endif
    </div>

  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     ABOUT  (split layout)
══════════════════════════════════════════════════════════ --}}
<div class="id-about-split reveal" style="margin-top:80px">
  <div class="about-image-col">
    <img src="{{ $aboutBg }}" alt="Our Studio" loading="lazy"/>
  </div>
  <div class="about-text-col">
    <div class="id-eyebrow" style="justify-content:flex-start">
      About The Studio
    </div>
    <p class="about-pull-quote">
      "Design is not just what it looks like — it is how it feels, how it lives, how it breathes."
    </p>
    <p class="about-body">
      We are a design studio that specialises in creating beautiful, functional interiors for both residential
      and commercial spaces. Every project begins with listening — to your lifestyle, your vision, your story.
      We translate that into spaces that are uniquely, authentically yours.
    </p>
    <a href="@if(isset($userdata->contact))tel:{{ $userdata->contact }}@endif" class="about-cta">
      Start Your Project
    </a>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     SERVICES  (editorial cards)
══════════════════════════════════════════════════════════ --}}
<div class="id-section" style="padding-bottom:0">
  <div class="id-section-hd reveal">
    <div class="id-eyebrow"><i class="fa-solid fa-list-check"></i> What We Do</div>
    <h2 class="id-title">Our <em>Services</em></h2>
    <p class="id-sub">From concept sketches to final styling — every service is delivered with precision and passion.</p>
  </div>
</div>

<div style="max-width:1280px;margin:0 auto 0;padding:0 24px 80px">
  <div class="id-services-grid">
    @if(isset($interiorServices) && $interiorServices->count() > 0)
      @foreach($interiorServices->take(6) as $si => $service)
      <div class="svc-ed-card reveal" style="transition-delay:{{ $si * 60 }}ms">
        <div class="svc-ed-img">
          <img src="{{ $serviceBgs[$si % count($serviceBgs)] }}"
               alt="{{ $service->service_name }}" loading="lazy"/>
        </div>
        <div class="svc-ed-body">
          <div class="svc-ed-num">0{{ $si + 1 }}</div>
          <div class="svc-ed-title">{{ $service->service_name }}</div>
          @if($service->description)
          <div class="svc-ed-desc">{{ $service->description }}</div>
          @endif
          <span class="svc-ed-link">Explore <i class="fa-solid fa-arrow-right"></i></span>
        </div>
      </div>
      @endforeach
    @else
      {{-- Fallback static services --}}
      @php
        $defaultServices = [
          ['Residential Design',    'Complete home interior solutions from living spaces to bedrooms.',  0],
          ['Commercial Interiors',  'Office & retail environments that inspire productivity.',            1],
          ['3D Visualization',      'Photorealistic renders so you can see it before it is built.',       2],
          ['Space Planning',        'Optimal layouts that maximise flow, light, and functionality.',      3],
          ['Material Sourcing',     'Curated selection of finishes, fabrics, and furnishings.',           4],
          ['Project Management',    'End-to-end coordination with contractors and suppliers.',            5],
        ];
      @endphp
      @foreach($defaultServices as [$title,$desc,$idx])
      <div class="svc-ed-card reveal" style="transition-delay:{{ $idx * 60 }}ms">
        <div class="svc-ed-img">
          <img src="{{ $serviceBgs[$idx] }}" alt="{{ $title }}" loading="lazy"/>
        </div>
        <div class="svc-ed-body">
          <div class="svc-ed-num">0{{ $idx + 1 }}</div>
          <div class="svc-ed-title">{{ $title }}</div>
          <div class="svc-ed-desc">{{ $desc }}</div>
          <span class="svc-ed-link">Explore <i class="fa-solid fa-arrow-right"></i></span>
        </div>
      </div>
      @endforeach
    @endif
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     DESIGN STYLES  (dark section)
══════════════════════════════════════════════════════════ --}}
<div class="id-styles-bg">
  <div class="id-styles-inner">
    <div class="id-section-hd center reveal">
      <div class="id-eyebrow" style="justify-content:center">
        <span style="width:28px;height:1px;background:var(--id-gold);opacity:.5;display:block"></span>
        Design Language
        <span style="width:28px;height:1px;background:var(--id-gold);opacity:.5;display:block"></span>
      </div>
      <h2 class="id-title" style="color:#fff">Styles We <em style="color:var(--id-gold-l)">Master</em></h2>
      <p class="id-sub" style="color:rgba(255,255,255,.5)">
        Every aesthetic, every palette — brought to life with craftsmanship and intention.
      </p>
    </div>
    <div class="id-styles-grid">
      @foreach($styleCards as $idx => $style)
      <div class="style-ed-card reveal"
           data-letter="{{ strtoupper(substr($style['name'],0,1)) }}"
           style="transition-delay:{{ $idx * 70 }}ms">
        <div class="style-ed-icon"></div>
        <div class="style-ed-name">{{ $style['name'] }}</div>
        <div class="style-ed-desc">{{ $style['desc'] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     PORTFOLIO  (editorial asymmetric grid)
══════════════════════════════════════════════════════════ --}}
@if(isset($menu->upload_file) && $menu->upload_file)
<div class="id-section">
  <div class="id-section-hd reveal">
    <div class="id-eyebrow"><i class="fa-solid fa-images"></i> Portfolio</div>
    <h2 class="id-title">Selected <em>Projects</em></h2>
    <p class="id-sub">A curated showcase of interiors where vision became reality.</p>
  </div>

  <div class="id-portfolio-grid reveal">
    @php
      $portImages = [];
      if(isset($interiorPortfolio) && $interiorPortfolio->count() > 0){
        foreach($interiorPortfolio->take(6) as $port){
          $src = null;
          if(!empty($port->after_images))
            $src = asset('uploads/interior/portfolio/after/'.$port->after_images[0]);
          elseif(!empty($port->design_render_images))
            $src = asset('uploads/interior/portfolio/renders/'.$port->design_render_images[0]);
          elseif(!empty($port->before_images))
            $src = asset('uploads/interior/portfolio/before/'.$port->before_images[0]);
          if($src) $portImages[] = ['url'=>$src,'title'=>$port->project_title ?? 'Project'];
        }
      }
      // pad with fallbacks
      foreach($portfolioFallbacks as $fi => $fb){
        if(count($portImages) >= 6) break;
        $portImages[] = ['url'=>$fb,'title'=>'Featured Project '.($fi+1)];
      }
    @endphp

    @foreach(array_slice($portImages,0,6) as $pi => $pimg)
    <div class="port-item">
      <span class="port-num">{{ str_pad($pi+1,2,'0',STR_PAD_LEFT) }}</span>
      <img src="{{ $pimg['url'] }}" alt="{{ $pimg['title'] }}" loading="lazy"/>
      <div class="port-overlay">
        <div class="port-overlay-text">{{ $pimg['title'] }}</div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<div class="id-divider"></div>
@endif

{{-- ══════════════════════════════════════════════════════════
     STATS BAND
══════════════════════════════════════════════════════════ --}}
<div class="id-stats-band">
  <div class="id-stats-inner">
    <div class="stat-ed reveal">
      <div class="stat-num">10+</div>
      <div class="stat-lbl">Years Experience</div>
    </div>
    <div class="stat-ed reveal" style="transition-delay:80ms">
      <div class="stat-num">200+</div>
      <div class="stat-lbl">Projects Completed</div>
    </div>
    <div class="stat-ed reveal" style="transition-delay:160ms">
      <div class="stat-num">50+</div>
      <div class="stat-lbl">Awards Won</div>
    </div>
    <div class="stat-ed reveal" style="transition-delay:240ms">
      <div class="stat-num">100%</div>
      <div class="stat-lbl">Client Satisfaction</div>
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     WHY CHOOSE US / QUALIFICATIONS
══════════════════════════════════════════════════════════ --}}
@if(isset($menu->quali) && $menu->quali && isset($qualifications) && method_exists($qualifications,'count') && $qualifications->count() > 0)
<div class="id-section">
  <div class="id-section-hd reveal">
    <div class="id-eyebrow"><i class="fa-solid fa-award"></i> Our Promise</div>
    <h2 class="id-title">Why Choose <em>Our Studio</em></h2>
    <p class="id-sub">We go beyond aesthetics — we create spaces that elevate how you live and work.</p>
  </div>
  <div class="id-why-grid">
    @foreach($qualifications as $qi => $qual)
    <div class="why-ed-card reveal" style="transition-delay:{{ $qi * 70 }}ms">
      <div class="why-ed-line"></div>
      <div class="why-ed-title">{{ $qual->title ?? 'Our Advantage' }}</div>
      <div class="why-ed-desc">
        {{ $qual->description ?? 'Excellence in every detail of your interior design journey.' }}
      </div>
    </div>
    @endforeach
  </div>
</div>
<div class="id-divider"></div>
@endif

{{-- ══════════════════════════════════════════════════════════
     PHILOSOPHY / QUOTE
══════════════════════════════════════════════════════════ --}}
@if((isset($menu->thought) && $menu->thought) && isset($thoughts) && $thoughts)
<div class="id-philosophy-bg">
  <div class="id-philosophy-inner reveal">
    <div class="philosophy-mark">&ldquo;</div>
    <p class="philosophy-text">{{ $thoughts }}</p>
    <div class="philosophy-attr">
      {{ $userdata->name ?? 'Studio' }}
      @if(isset($userdata->designation) && $userdata->designation)
        · {{ $userdata->designation }}
      @endif
    </div>
  </div>
</div>
@endif

{{-- ══════════════════════════════════════════════════════════
     CONTACT  (dark section)
══════════════════════════════════════════════════════════ --}}
<div class="id-contact-bg">
  <div class="id-contact-inner">
    <div class="id-section-hd reveal">
      <div class="id-eyebrow" style="color:var(--id-gold)">
        <i class="fa-solid fa-address-card"></i> Contact
      </div>
      <h2 class="id-title" style="color:#fff">Let's Create <em style="color:var(--id-gold-l)">Together</em></h2>
      <p class="id-sub" style="color:rgba(255,255,255,.5)">
        Every great space begins with a single conversation. We'd love to hear about yours.
      </p>
    </div>
    <div class="id-contact-grid">
      @if(isset($userdata->contact) && $userdata->contact)
      <div class="contact-ed reveal">
        <a href="tel:{{ $userdata->contact }}">
          <div class="contact-icon-ed"><i class="fa-solid fa-phone"></i></div>
          <div class="contact-lbl-ed">Call Studio</div>
          <div class="contact-val-ed">{{ $userdata->contact }}</div>
        </a>
      </div>
      @endif

      @if(isset($userdata->email) && $userdata->email)
      <div class="contact-ed reveal" style="transition-delay:80ms">
        <a href="mailto:{{ $userdata->email }}">
          <div class="contact-icon-ed"><i class="fa-solid fa-envelope"></i></div>
          <div class="contact-lbl-ed">Email Studio</div>
          <div class="contact-val-ed">{{ $userdata->email }}</div>
        </a>
      </div>
      @endif

      @if((isset($userdata->city) && $userdata->city) || (isset($userdata->state) && $userdata->state))
      <div class="contact-ed reveal" style="transition-delay:160ms">
        <div class="contact-icon-ed"><i class="fa-solid fa-location-dot"></i></div>
        <div class="contact-lbl-ed">Visit Studio</div>
        <div class="contact-val-ed">
          {{ $userdata->city ?? '' }}{{ (isset($userdata->state) && $userdata->state) ? ', '.$userdata->state : '' }}
        </div>
      </div>
      @endif

      @if(isset($userdata->facebook) || isset($userdata->instagram))
      <div class="contact-ed reveal" style="transition-delay:240ms">
        <div class="contact-icon-ed"><i class="fa-solid fa-share-nodes"></i></div>
        <div class="contact-lbl-ed">Follow Us</div>
        <div class="contact-val-ed">@if(isset($userdata->instagram))@{{ Str::after($userdata->instagram,'instagram.com/') }}@else Social Media @endif</div>
      </div>
      @endif
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     CTA BAND
══════════════════════════════════════════════════════════ --}}
<div class="id-cta-band">
  <div class="cta-inner reveal">
    <h2 class="cta-title">
      Ready to Transform<br><em>Your Space?</em>
    </h2>
    <p class="cta-sub">
      Book a complimentary design consultation and let's begin the journey to your dream interior.
    </p>
    <div class="cta-btns">
      @if(isset($userdata->contact) && $userdata->contact)
      <a href="tel:{{ $userdata->contact }}" class="cta-btn cta-btn-dark">
        <i class="fa-solid fa-calendar-check"></i> Schedule Consultation
      </a>
      @endif
      @if(isset($userdata->email) && $userdata->email)
      <a href="mailto:{{ $userdata->email }}" class="cta-btn cta-btn-gold">
        <i class="fa-solid fa-paper-plane"></i> Send Enquiry
      </a>
      @endif
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     SOCIAL LINKS
══════════════════════════════════════════════════════════ --}}
@if(isset($menu->social_link) && $menu->social_link)
@php
  $hasSocial = isset($userdata) && (
    (isset($userdata->facebook)  && $userdata->facebook)  ||
    (isset($userdata->instagram) && $userdata->instagram) ||
    (isset($userdata->linkedin)  && $userdata->linkedin)  ||
    (isset($userdata->pinterest) && $userdata->pinterest) ||
    (isset($userdata->youtube)   && $userdata->youtube)
  );
@endphp
@if($hasSocial)
<div class="id-social-strip">
  <div class="id-social-inner">
    <div class="social-lbl-ed">Follow Our Journey</div>
    <div class="social-row">
      @if(isset($userdata->facebook) && $userdata->facebook)
      <a href="{{ $userdata->facebook }}" target="_blank" class="si-ed" title="Facebook">
        <i class="fa-brands fa-facebook-f"></i>
      </a>
      @endif
      @if(isset($userdata->instagram) && $userdata->instagram)
      <a href="{{ $userdata->instagram }}" target="_blank" class="si-ed" title="Instagram">
        <i class="fa-brands fa-instagram"></i>
      </a>
      @endif
      @if(isset($userdata->linkedin) && $userdata->linkedin)
      <a href="{{ $userdata->linkedin }}" target="_blank" class="si-ed" title="LinkedIn">
        <i class="fa-brands fa-linkedin-in"></i>
      </a>
      @endif
      @if(isset($userdata->pinterest) && $userdata->pinterest)
      <a href="{{ $userdata->pinterest }}" target="_blank" class="si-ed" title="Pinterest">
        <i class="fa-brands fa-pinterest-p"></i>
      </a>
      @endif
      @if(isset($userdata->youtube) && $userdata->youtube)
      <a href="{{ $userdata->youtube }}" target="_blank" class="si-ed" title="YouTube">
        <i class="fa-brands fa-youtube"></i>
      </a>
      @endif
    </div>
  </div>
</div>
@endif
@endif

{{-- ══════════════════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════════════════ --}}
<footer class="id-footer">
  <div class="footer-brand">
    {{ $userdata->name ?? 'Studio' }} <span>·</span>
    Interior Design
  </div>
  <div class="footer-copy">
    &copy; {{ date('Y') }} All rights reserved. Digital Card by
    <a href="{{ url('/') }}" target="_blank">Fastap</a>
  </div>
</footer>

{{-- ══════════════════════════════════════════════════════════
     FLOATING BUTTONS
══════════════════════════════════════════════════════════ --}}
<div class="fab-stack">
  @if(isset($userdata->contact) && $userdata->contact)
  <a href="tel:{{ $userdata->contact }}" class="fab-item fab-call" title="Call Now">
    <i class="fa-solid fa-phone"></i>
  </a>
  @endif
  @if(isset($userdata->instagram) && $userdata->instagram)
  <a href="{{ $userdata->instagram }}" target="_blank" class="fab-item fab-wa" title="Instagram" style="background:#e1306c">
    <i class="fa-brands fa-instagram"></i>
  </a>
  @endif
</div>

{{-- ══════════════════════════════════════════════════════════
     PROFILE LOCATION TRACKER
══════════════════════════════════════════════════════════ --}}
@include('components.profile-location-tracker', [
  'customerId'  => $userdata->id ?? null,
  'profileSlug' => $userdata->slug ?? null,
  'isPreview'   => $isPreview ?? false,
])

{{-- ══════════════════════════════════════════════════════════
     SCROLL-REVEAL SCRIPT
══════════════════════════════════════════════════════════ --}}
<script>
(function(){
  var els = document.querySelectorAll('.reveal');
  if(!('IntersectionObserver' in window)){
    els.forEach(function(e){ e.classList.add('visible'); }); return;
  }
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(en){
      if(en.isIntersecting){ en.target.classList.add('visible'); io.unobserve(en.target); }
    });
  },{threshold:0.1});
  els.forEach(function(e){ io.observe(e); });
})();
</script>

</body>
</html>