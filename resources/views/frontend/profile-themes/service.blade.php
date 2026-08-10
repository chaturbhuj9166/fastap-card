<?php
/* ============================================================
 *  QUICK FIX SERVICES – HOME REPAIR & MAINTENANCE
 *  quickfix_profile.blade.php  |  Laravel Blade Template
 *  Orange / Navy theme  –  All images from public Unsplash URLs
 * ============================================================ */

// ── 1. MENU SETUP ────────────────────────────────────────────
if (isset($isPreview) && $isPreview) {
    $menu = (object)[
        'profile'             => 1,
        'quali'               => 1,
        'service'             => 1,
        'thought'             => 1,
        'personal'            => 1,
        'profess'             => 1,
        'videos'              => 1,
        'product'             => 1,
        'social_link'         => 1,
        'upload_file'         => 1,
        'client'              => 1,
        'menu_section'        => 1,
        'reservation_section' => 1,
        'property_listings'   => 1,
        'showreel'            => 1,
        'team_section'        => 1,
        'pricing_section'     => 1,
        'booking_section'     => 1,
    ];
} else {
    $menu = \App\Models\ProfileMenu::where('id', $userdata->id)->first();
    if (!$menu) {
        $menu = (object)[
            'profile'             => 1,
            'quali'               => 1,
            'service'             => 1,
            'thought'             => 1,
            'personal'            => 1,
            'profess'             => 1,
            'videos'              => 1,
            'product'             => 1,
            'social_link'         => 1,
            'upload_file'         => 1,
            'client'              => 1,
            'menu_section'        => 1,
            'reservation_section' => 1,
            'property_listings'   => 1,
            'showreel'            => 1,
            'team_section'        => 1,
            'pricing_section'     => 1,
            'booking_section'     => 1,
        ];
    }
}

// ── 2. THEME COLOR ────────────────────────────────────────────
$themeColor = $theme->color ?? '#f97316';   // default orange

// ── 3. IMAGE ASSETS ──────────────────────────────────────────
// Hero / Banner
$defaultBanner = 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=1800&h=700&fit=crop&auto=format&q=80';

// Business logo / avatar fallback
$defaultAvatar = 'https://images.unsplash.com/photo-1621905251189-08b45249be3d?w=400&h=400&fit=crop&auto=format&q=80';

// Service card images (home repair / maintenance topics)
$serviceImages = [
    // Plumbing
    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop&auto=format&q=80',
    // Electrical
    'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?w=600&h=400&fit=crop&auto=format&q=80',
    // Painting
    'https://images.unsplash.com/photo-1562259929-b4e1fd3aef09?w=600&h=400&fit=crop&auto=format&q=80',
    // Carpentry / woodwork
    'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=600&h=400&fit=crop&auto=format&q=80',
    // Flooring / tiling
    'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=600&h=400&fit=crop&auto=format&q=80',
    // AC / HVAC
    'https://images.unsplash.com/photo-1628177142898-93e36e4e3a50?w=600&h=400&fit=crop&auto=format&q=80',
    // General handyman
    'https://images.unsplash.com/photo-1581244277943-fe4a9c777189?w=600&h=400&fit=crop&auto=format&q=80',
    // Roofing / exterior
    'https://images.unsplash.com/photo-1503387837-b154d5074bd2?w=600&h=400&fit=crop&auto=format&q=80',
];

// Service icons (Font Awesome)
$serviceIcons = [
    'fa-wrench','fa-bolt','fa-paint-roller','fa-hammer',
    'fa-layer-group','fa-wind','fa-toolbox','fa-house-chimney',
    'fa-faucet','fa-gear','fa-screwdriver-wrench','fa-shield-halved',
];

// Gallery fallback images  (real repair / renovation work)
$galleryFallbacks = [
    'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=700&h=500&fit=crop&auto=format&q=80',
    'https://images.unsplash.com/photo-1600585152220-90363fe7e115?w=700&h=500&fit=crop&auto=format&q=80',
    'https://images.unsplash.com/photo-1565538810643-b5bdb714032a?w=700&h=500&fit=crop&auto=format&q=80',
    'https://images.unsplash.com/photo-1617104678098-de229db51175?w=700&h=500&fit=crop&auto=format&q=80',
    'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=700&h=500&fit=crop&auto=format&q=80',
    'https://images.unsplash.com/photo-1581244277943-fe4a9c777189?w=700&h=500&fit=crop&auto=format&q=80',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<meta name="theme-color" content="{{ $themeColor }}"/>
<title>{{ $userdata->name ?? 'Quick Fix Services' }} – Home Repair & Maintenance</title>
<meta name="description" content="{{ $userdata->name ?? 'Quick Fix Services' }} – Professional home repair and maintenance experts. {{ $userdata->city ?? '' }}"/>

{{-- Favicon --}}
@if(isset($websetting->favicon) && $websetting->favicon)
<link rel="icon" href="{{ url('uploads/system_setting/'.$websetting->favicon) }}"/>
@endif

{{-- Google Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Bebas+Neue&display=swap" rel="stylesheet"/>

{{-- Font Awesome 6 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
/* ═══════════════════════════════════════════════════════════════
   DESIGN TOKENS
═══════════════════════════════════════════════════════════════ */
:root{
  --qf-orange    : {{ $themeColor }};
  --qf-orange-d  : color-mix(in srgb,{{ $themeColor }} 80%,#000);
  --qf-orange-l  : color-mix(in srgb,{{ $themeColor }} 14%,#fff);
  --qf-yellow    : #fbbf24;
  --qf-navy      : #0f1b2d;
  --qf-dark      : #1e293b;
  --qf-mid       : #475569;
  --qf-muted     : #94a3b8;
  --qf-border    : #e2e8f0;
  --qf-bg        : #f8f9fb;
  --qf-white     : #ffffff;
  --qf-green     : #16a34a;
  --qf-shadow-sm : 0 1px 4px rgba(0,0,0,.07),0 1px 2px rgba(0,0,0,.05);
  --qf-shadow    : 0 6px 20px rgba(0,0,0,.10);
  --qf-shadow-lg : 0 20px 50px rgba(0,0,0,.16);
  --qf-radius-sm : 8px;
  --qf-radius    : 14px;
  --qf-radius-lg : 22px;
  --qf-radius-xl : 32px;
  --qf-trans     : all .28s cubic-bezier(.4,0,.2,1);
  --font-body    : 'Nunito',sans-serif;
  --font-display : 'Bebas Neue',sans-serif;
}

/* ── RESET ── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
body{font-family:var(--font-body);background:var(--qf-bg);color:var(--qf-dark);line-height:1.65;overflow-x:hidden}
a{text-decoration:none;color:inherit}
img{max-width:100%;height:auto;display:block}
ul{list-style:none}
button{cursor:pointer;border:none;background:none;font-family:inherit}

/* ── PREVIEW BANNER ── */
.preview-bar{
  background:linear-gradient(90deg,#7c3aed,#4f46e5);
  color:#fff;text-align:center;padding:9px 16px;font-size:.84rem;
  position:relative;z-index:999;
}
.preview-bar a{color:#fde68a;font-weight:700;text-decoration:underline}

/* ═══════════════════════════════════════════════════════════════
   TOP ACTION BAR  (sticky)
═══════════════════════════════════════════════════════════════ */
.qf-top-bar{
  position:sticky;top:0;z-index:900;
  background:var(--qf-navy);
  border-bottom:3px solid var(--qf-orange);
  padding:0 24px;
  display:flex;align-items:center;justify-content:space-between;
  height:56px;
}
.topbar-brand{
  display:flex;align-items:center;gap:10px;
  color:#fff;font-family:var(--font-display);font-size:1.3rem;letter-spacing:.04em;
}
.topbar-brand-icon{
  width:34px;height:34px;border-radius:8px;
  background:var(--qf-orange);
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:1rem;
}
.topbar-actions{display:flex;gap:10px;align-items:center}
.topbar-btn{
  display:inline-flex;align-items:center;gap:6px;
  padding:7px 16px;border-radius:50px;font-size:.8rem;font-weight:700;
  transition:var(--qf-trans);
}
.topbar-btn-call{background:var(--qf-orange);color:#fff}
.topbar-btn-call:hover{background:var(--qf-orange-d)}
.topbar-btn-wa{background:#25d366;color:#fff}
.topbar-btn-wa:hover{background:#1da851}

/* ═══════════════════════════════════════════════════════════════
   HERO / BANNER
═══════════════════════════════════════════════════════════════ */
.qf-hero{
  position:relative;
  min-height:520px;
  background-color:var(--qf-navy);
  background-image:url('{{ $userdata->banner ? url("public/frontend/user_images/".$userdata->banner) : $defaultBanner }}');
  background-size:cover;
  background-position:center;
  display:flex;align-items:center;
  overflow:hidden;
}
/* dark overlay */
.qf-hero::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(
    110deg,
    rgba(15,27,45,.88) 0%,
    rgba(15,27,45,.75) 50%,
    rgba(15,27,45,.40) 100%
  );
}
/* diagonal orange accent line */
.qf-hero::after{
  content:'';position:absolute;
  top:0;right:0;width:6px;height:100%;
  background:linear-gradient(180deg,var(--qf-yellow),var(--qf-orange));
}

/* tool-belt decorative SVG strip at bottom */
.hero-bottom-strip{
  position:absolute;bottom:0;left:0;right:0;
  height:64px;background:var(--qf-bg);
  clip-path:polygon(0 60%,100% 0,100% 100%,0 100%);
}

.qf-hero-inner{
  position:relative;z-index:2;
  max-width:1200px;margin:0 auto;width:100%;
  padding:48px 24px 100px;
  display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:40px;
}

/* LEFT: text */
.hero-text{}
.hero-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.45);
  color:var(--qf-yellow);font-size:.78rem;font-weight:800;
  letter-spacing:.1em;text-transform:uppercase;
  padding:5px 14px;border-radius:50px;margin-bottom:18px;
}
.qf-hero-title{
  font-family:var(--font-display);
  font-size:clamp(2.6rem,5.5vw,4.4rem);
  color:#fff;line-height:1.05;
  letter-spacing:.02em;
  margin-bottom:10px;
  text-shadow:0 2px 12px rgba(0,0,0,.4);
}
.qf-hero-title span{color:var(--qf-orange)}
.qf-hero-sub{
  font-size:clamp(.92rem,1.8vw,1.12rem);
  color:#cbd5e1;font-weight:500;
  margin-bottom:28px;max-width:460px;
}
.hero-highlights{
  display:flex;flex-wrap:wrap;gap:10px;margin-bottom:30px;
}
.hero-highlight{
  display:inline-flex;align-items:center;gap:7px;
  background:rgba(255,255,255,.08);
  border:1px solid rgba(255,255,255,.15);
  color:#e2e8f0;font-size:.8rem;font-weight:600;
  padding:6px 14px;border-radius:50px;
}
.hero-highlight i{color:var(--qf-orange)}
.hero-cta-row{display:flex;flex-wrap:wrap;gap:12px}
.hero-btn{
  display:inline-flex;align-items:center;gap:8px;
  padding:13px 26px;border-radius:50px;font-size:.92rem;font-weight:800;
  transition:var(--qf-trans);
}
.hero-btn-primary{
  background:var(--qf-orange);color:#fff;
  box-shadow:0 6px 22px rgba(249,115,22,.45);
}
.hero-btn-primary:hover{background:var(--qf-orange-d);transform:translateY(-2px)}
.hero-btn-ghost{
  background:rgba(255,255,255,.1);color:#fff;
  border:2px solid rgba(255,255,255,.35);backdrop-filter:blur(4px);
}
.hero-btn-ghost:hover{background:rgba(255,255,255,.2);transform:translateY(-2px)}

/* RIGHT: floating stats card */
.hero-stats-card{
  background:rgba(255,255,255,.07);
  border:1px solid rgba(255,255,255,.14);
  backdrop-filter:blur(12px);
  border-radius:var(--qf-radius-lg);
  padding:30px 28px;
}
.hero-stats-grid{
  display:grid;grid-template-columns:1fr 1fr;gap:16px;
}
.hstat{
  background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);
  border-radius:var(--qf-radius);
  padding:18px 14px;text-align:center;
  transition:var(--qf-trans);
}
.hstat:hover{background:rgba(249,115,22,.15);border-color:rgba(249,115,22,.4)}
.hstat-icon{
  font-size:1.5rem;color:var(--qf-orange);margin-bottom:8px;
}
.hstat-num{
  font-family:var(--font-display);font-size:1.9rem;
  color:#fff;letter-spacing:.04em;line-height:1;
}
.hstat-label{font-size:.72rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.06em;margin-top:4px}

.trust-row{
  display:flex;flex-wrap:wrap;gap:8px;justify-content:center;margin-top:18px;
}
.trust-chip{
  display:inline-flex;align-items:center;gap:5px;
  background:rgba(16,163,74,.18);border:1px solid rgba(16,163,74,.4);
  color:#6ee7b7;font-size:.73rem;font-weight:700;
  padding:4px 12px;border-radius:50px;
}
.trust-chip i{font-size:.7rem}

/* ═══════════════════════════════════════════════════════════════
   BUSINESS PROFILE CARD  (floating under hero)
═══════════════════════════════════════════════════════════════ */
.qf-card-wrap{
  max-width:1200px;margin:-52px auto 0;
  padding:0 24px;position:relative;z-index:20;
}
.qf-biz-card{
  background:var(--qf-white);
  border-radius:var(--qf-radius-lg);
  box-shadow:var(--qf-shadow-lg);
  display:grid;grid-template-columns:220px 1fr;
  overflow:hidden;
  border-top:5px solid var(--qf-orange);
}

/* LEFT: logo / brand panel */
.bcard-brand{
  background:linear-gradient(160deg,var(--qf-navy) 0%,#1a2f4b 100%);
  padding:30px 20px;
  display:flex;flex-direction:column;align-items:center;text-align:center;gap:12px;
}
.bcard-logo-ring{
  width:110px;height:110px;border-radius:var(--qf-radius);
  background:linear-gradient(135deg,var(--qf-orange),var(--qf-yellow));
  padding:4px;flex-shrink:0;
}
.bcard-logo{
  width:100%;height:100%;border-radius:calc(var(--qf-radius) - 2px);
  object-fit:cover;border:2px solid rgba(255,255,255,.2);
}
.bcard-available{
  display:inline-flex;align-items:center;gap:6px;
  background:rgba(16,163,74,.15);color:#6ee7b7;
  font-size:.72rem;font-weight:700;letter-spacing:.04em;
  padding:4px 12px;border-radius:50px;
}
.bcard-available::before{
  content:'';width:7px;height:7px;border-radius:50%;
  background:#16a34a;box-shadow:0 0 6px #16a34a;
  animation:blink 1.4s ease-in-out infinite;
}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}
.bcard-name{
  font-family:var(--font-display);font-size:1.3rem;
  color:#fff;letter-spacing:.04em;line-height:1.15;
}
.bcard-sub{font-size:.8rem;color:#f97316;font-weight:700;letter-spacing:.03em}
.bcard-city{
  display:inline-flex;align-items:center;gap:5px;
  color:#94a3b8;font-size:.77rem;
}
.bcard-tags{
  display:flex;flex-wrap:wrap;gap:5px;justify-content:center;margin-top:4px;
}
.bcard-tag{
  background:rgba(249,115,22,.18);color:#fb923c;
  font-size:.7rem;font-weight:700;padding:3px 9px;border-radius:50px;
}
.bcard-btns{
  display:flex;flex-direction:column;gap:7px;width:100%;margin-top:6px;
}
.bcard-btn{
  display:flex;align-items:center;justify-content:center;gap:7px;
  padding:10px 12px;border-radius:50px;font-size:.82rem;font-weight:700;
  transition:var(--qf-trans);
}
.bcard-btn-call{background:var(--qf-orange);color:#fff}
.bcard-btn-call:hover{background:var(--qf-orange-d);transform:translateY(-1px)}
.bcard-btn-wa{background:#25d366;color:#fff}
.bcard-btn-wa:hover{background:#1da851;transform:translateY(-1px)}
.bcard-btn-map{background:rgba(255,255,255,.1);color:#fff;border:1px solid rgba(255,255,255,.2)}
.bcard-btn-map:hover{background:rgba(255,255,255,.2);transform:translateY(-1px)}

/* RIGHT: info panel */
.bcard-info{padding:30px 32px;display:flex;flex-direction:column;gap:18px}
.bcard-headline{
  font-family:var(--font-display);
  font-size:clamp(1.4rem,2.5vw,1.9rem);
  color:var(--qf-dark);letter-spacing:.03em;line-height:1.15;
}
.bcard-headline span{color:var(--qf-orange)}
.bcard-desc{
  font-size:.9rem;color:var(--qf-mid);line-height:1.7;
}
.bcard-badges{display:flex;flex-wrap:wrap;gap:8px}
.bcard-badge{
  display:inline-flex;align-items:center;gap:6px;
  padding:6px 13px;border-radius:50px;font-size:.77rem;font-weight:700;
  background:var(--qf-orange-l);color:var(--qf-orange-d);
}
.bcard-qs{display:grid;grid-template-columns:repeat(4,1fr);gap:10px}
.bcard-q{
  background:var(--qf-bg);border:1.5px solid var(--qf-border);
  border-radius:var(--qf-radius);padding:12px 8px;text-align:center;
  transition:var(--qf-trans);
}
.bcard-q:hover{border-color:var(--qf-orange);transform:translateY(-2px)}
.bcard-q-num{
  font-family:var(--font-display);font-size:1.5rem;
  color:var(--qf-orange);line-height:1;letter-spacing:.04em;
}
.bcard-q-label{
  font-size:.68rem;color:var(--qf-mid);text-transform:uppercase;
  letter-spacing:.05em;margin-top:3px;
}
.bcard-cta{display:flex;gap:10px;flex-wrap:wrap}
.bcard-cta-btn{
  display:inline-flex;align-items:center;gap:8px;
  padding:12px 22px;border-radius:50px;font-size:.87rem;font-weight:800;
  transition:var(--qf-trans);
}
.bcard-cta-primary{
  background:var(--qf-orange);color:#fff;
  box-shadow:0 4px 14px rgba(249,115,22,.32);
}
.bcard-cta-primary:hover{background:var(--qf-orange-d);transform:translateY(-2px)}
.bcard-cta-ghost{
  background:transparent;color:var(--qf-orange);
  border:2px solid var(--qf-orange);
}
.bcard-cta-ghost:hover{background:var(--qf-orange-l);transform:translateY(-2px)}

/* ═══════════════════════════════════════════════════════════════
   TRUST / ICON STRIP
═══════════════════════════════════════════════════════════════ */
.qf-trust{
  background:var(--qf-white);
  border-bottom:1px solid var(--qf-border);
  padding:22px 24px;
}
.qf-trust-inner{
  max-width:1200px;margin:0 auto;
  display:flex;flex-wrap:wrap;justify-content:center;gap:30px;
}
.trust-item{
  display:flex;align-items:center;gap:9px;
  color:var(--qf-mid);font-size:.84rem;font-weight:600;
}
.trust-item-icon{
  width:38px;height:38px;border-radius:50%;
  background:var(--qf-orange-l);color:var(--qf-orange);
  display:flex;align-items:center;justify-content:center;
  font-size:.9rem;flex-shrink:0;
}

/* ═══════════════════════════════════════════════════════════════
   SECTION COMMONS
═══════════════════════════════════════════════════════════════ */
.qf-section{padding:80px 24px;max-width:1200px;margin:0 auto}
.qf-section-hd{text-align:center;margin-bottom:50px}
.qf-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  color:var(--qf-orange);font-size:.78rem;font-weight:800;
  letter-spacing:.1em;text-transform:uppercase;margin-bottom:10px;
}
.qf-eyebrow::before,.qf-eyebrow::after{
  content:'';width:24px;height:2.5px;border-radius:2px;
  background:var(--qf-orange);opacity:.5;
}
.qf-title{
  font-family:var(--font-display);
  font-size:clamp(1.8rem,3.5vw,2.8rem);
  color:var(--qf-dark);letter-spacing:.03em;line-height:1.1;
  margin-bottom:10px;
}
.qf-sub{
  font-size:.95rem;color:var(--qf-mid);max-width:580px;margin:0 auto;
}
.qf-divider{
  height:1px;
  background:linear-gradient(90deg,transparent,var(--qf-border),transparent);
  margin:0 24px;
}

/* ═══════════════════════════════════════════════════════════════
   SERVICES GRID
═══════════════════════════════════════════════════════════════ */
.qf-services-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(270px,1fr));
  gap:22px;
}
.svc-card{
  background:var(--qf-white);
  border-radius:var(--qf-radius);overflow:hidden;
  border:1.5px solid var(--qf-border);
  box-shadow:var(--qf-shadow-sm);
  display:flex;flex-direction:column;
  transition:var(--qf-trans);
}
.svc-card:hover{
  transform:translateY(-6px);
  box-shadow:var(--qf-shadow-lg);
  border-color:var(--qf-orange);
}
.svc-img-wrap{
  height:172px;overflow:hidden;position:relative;
}
.svc-img-wrap img{
  width:100%;height:100%;object-fit:cover;
  transition:transform .5s ease;
}
.svc-card:hover .svc-img-wrap img{transform:scale(1.08)}
/* gradient overlay on image */
.svc-img-wrap::after{
  content:'';position:absolute;inset:0;
  background:linear-gradient(180deg,transparent 40%,rgba(15,27,45,.6) 100%);
}
.svc-icon-badge{
  position:absolute;bottom:12px;left:14px;z-index:2;
  width:40px;height:40px;border-radius:var(--qf-radius-sm);
  background:var(--qf-orange);
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:.95rem;
  box-shadow:0 4px 14px rgba(249,115,22,.5);
}
.svc-body{padding:18px 20px;flex:1;display:flex;flex-direction:column}
.svc-title{font-size:1.02rem;font-weight:800;color:var(--qf-dark);margin-bottom:7px}
.svc-desc{font-size:.84rem;color:var(--qf-mid);line-height:1.65;flex:1}
.svc-link{
  display:inline-flex;align-items:center;gap:6px;
  margin-top:12px;color:var(--qf-orange);font-size:.82rem;font-weight:800;
  transition:var(--qf-trans);
}
.svc-link:hover{gap:10px}

/* ═══════════════════════════════════════════════════════════════
   WHY CHOOSE US  (dark bg)
═══════════════════════════════════════════════════════════════ */
.qf-why-bg{
  background:linear-gradient(135deg,var(--qf-navy) 0%,#0d1f35 100%);
  padding:80px 24px;position:relative;overflow:hidden;
}
.qf-why-bg::before{
  content:'';position:absolute;inset:0;
  background-image:
    radial-gradient(circle at 15% 75%,rgba(249,115,22,.2) 0%,transparent 45%),
    radial-gradient(circle at 85% 20%,rgba(251,191,36,.12) 0%,transparent 45%);
}
/* subtle tool-pattern overlay */
.qf-why-bg::after{
  content:'';position:absolute;inset:0;
  background-image:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f97316' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.qf-why-inner{max-width:1200px;margin:0 auto;position:relative;z-index:1}
.qf-why-hd{text-align:center;margin-bottom:46px}
.qf-why-hd .qf-eyebrow{color:#fbbf24}
.qf-why-hd .qf-title{color:#fff}
.qf-why-hd .qf-sub{color:#94a3b8}
.qf-why-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
  gap:18px;
}
.why-card{
  background:rgba(255,255,255,.05);
  border:1px solid rgba(255,255,255,.09);
  border-radius:var(--qf-radius);padding:26px 22px;
  backdrop-filter:blur(4px);
  transition:var(--qf-trans);
}
.why-card:hover{
  background:rgba(249,115,22,.08);
  border-color:rgba(249,115,22,.45);
  transform:translateY(-4px);
}
.why-icon{
  width:50px;height:50px;border-radius:var(--qf-radius-sm);
  background:linear-gradient(135deg,var(--qf-orange),var(--qf-yellow));
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:1.15rem;margin-bottom:14px;
  box-shadow:0 4px 16px rgba(249,115,22,.38);
}
.why-title{font-size:.98rem;font-weight:800;color:#fff;margin-bottom:7px}
.why-desc{font-size:.83rem;color:#94a3b8;line-height:1.65}

/* ═══════════════════════════════════════════════════════════════
   PROCESS / HOW IT WORKS
═══════════════════════════════════════════════════════════════ */
.qf-process-grid{
  display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));
  gap:22px;counter-reset:step;
}
.process-step{
  text-align:center;
  position:relative;
  counter-increment:step;
}
.process-step::after{
  content:'';position:absolute;
  top:30px;left:calc(50% + 42px);
  width:calc(100% - 84px);height:2px;
  background:linear-gradient(90deg,var(--qf-orange),transparent);
  pointer-events:none;
}
.process-step:last-child::after{display:none}
.process-circle{
  width:64px;height:64px;border-radius:50%;margin:0 auto 16px;
  background:var(--qf-orange);color:#fff;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-size:1.6rem;letter-spacing:.04em;
  box-shadow:0 6px 20px rgba(249,115,22,.35);
  position:relative;
}
.process-circle::before{
  content:counter(step,decimal-leading-zero);
}
.process-icon{
  position:absolute;top:-8px;right:-8px;
  width:26px;height:26px;border-radius:50%;
  background:var(--qf-navy);border:2px solid var(--qf-orange);
  display:flex;align-items:center;justify-content:center;
  color:var(--qf-orange);font-size:.65rem;
}
.process-title{font-size:.97rem;font-weight:800;color:var(--qf-dark);margin-bottom:6px}
.process-desc{font-size:.83rem;color:var(--qf-mid);line-height:1.6}

/* ═══════════════════════════════════════════════════════════════
   GALLERY / PORTFOLIO
═══════════════════════════════════════════════════════════════ */
.qf-gallery-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:14px;
}
.gal-item{
  border-radius:var(--qf-radius);overflow:hidden;
  aspect-ratio:4/3;position:relative;background:var(--qf-border);cursor:pointer;
}
.gal-item:first-child{
  grid-column:span 2;grid-row:span 2;aspect-ratio:auto;
}
.gal-item img{
  width:100%;height:100%;object-fit:cover;
  transition:transform .5s ease;
}
.gal-item:hover img{transform:scale(1.07)}
.gal-overlay{
  position:absolute;inset:0;
  background:rgba(15,27,45,.55);
  display:flex;align-items:center;justify-content:center;
  opacity:0;transition:var(--qf-trans);
  flex-direction:column;gap:8px;
}
.gal-item:hover .gal-overlay{opacity:1}
.gal-overlay i{color:var(--qf-orange);font-size:1.8rem}
.gal-overlay span{color:#fff;font-size:.8rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase}

/* ═══════════════════════════════════════════════════════════════
   CONTACT CARDS
═══════════════════════════════════════════════════════════════ */
.qf-contact-grid{
  display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:18px;
}
.contact-card{
  background:var(--qf-white);border:1.5px solid var(--qf-border);
  border-radius:var(--qf-radius);padding:22px;text-align:center;
  box-shadow:var(--qf-shadow-sm);transition:var(--qf-trans);
}
.contact-card:hover{
  border-color:var(--qf-orange);
  transform:translateY(-4px);box-shadow:var(--qf-shadow);
}
.cc-icon{
  width:52px;height:52px;border-radius:50%;margin:0 auto 12px;
  background:var(--qf-orange-l);color:var(--qf-orange);
  display:flex;align-items:center;justify-content:center;font-size:1.15rem;
}
.cc-label{font-size:.73rem;color:var(--qf-muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:5px}
.cc-value{font-size:.9rem;font-weight:700;color:var(--qf-dark)}
.cc-value a{color:inherit;transition:color .2s}
.cc-value a:hover{color:var(--qf-orange)}

/* ═══════════════════════════════════════════════════════════════
   TAGLINE / QUOTE
═══════════════════════════════════════════════════════════════ */
.qf-tagline{
  background:linear-gradient(135deg,var(--qf-orange-l),#fff8ed);
  border-left:5px solid var(--qf-orange);
  border-radius:var(--qf-radius);
  padding:34px 38px;position:relative;overflow:hidden;
  max-width:860px;margin:0 auto;
}
.qf-tagline::before{
  content:'\201C';
  position:absolute;top:-18px;left:18px;
  font-size:8rem;font-family:var(--font-display);
  color:var(--qf-orange);opacity:.13;line-height:1;
}
.tagline-text{
  font-family:var(--font-display);
  font-size:clamp(1.1rem,2.2vw,1.55rem);
  color:var(--qf-dark);line-height:1.55;
  letter-spacing:.03em;position:relative;z-index:1;
}
.tagline-author{
  margin-top:16px;font-size:.87rem;font-weight:800;
  color:var(--qf-orange);display:flex;align-items:center;gap:7px;
}
.tagline-author::before{content:'—'}

/* ═══════════════════════════════════════════════════════════════
   CTA BAND
═══════════════════════════════════════════════════════════════ */
.qf-cta-band{
  background:var(--qf-navy);
  padding:68px 24px;text-align:center;
  position:relative;overflow:hidden;
}
.qf-cta-band::before{
  content:'';position:absolute;inset:0;
  background-image:url('https://images.unsplash.com/photo-1461695008884-244cb4b511b2?w=1600&h=600&fit=crop&auto=format&q=50');
  background-size:cover;background-position:center;
  opacity:.07;
}
/* diagonal top strip */
.qf-cta-band::after{
  content:'';position:absolute;top:0;left:0;right:0;height:6px;
  background:linear-gradient(90deg,var(--qf-orange),var(--qf-yellow),var(--qf-orange));
}
.cta-inner{position:relative;z-index:1}
.cta-title{
  font-family:var(--font-display);
  font-size:clamp(1.8rem,4vw,3rem);
  color:#fff;letter-spacing:.04em;margin-bottom:10px;
}
.cta-title span{color:var(--qf-orange)}
.cta-sub{color:#94a3b8;font-size:.97rem;margin-bottom:28px}
.cta-btns{display:flex;flex-wrap:wrap;gap:14px;justify-content:center}
.cta-btn{
  display:inline-flex;align-items:center;gap:9px;
  padding:14px 30px;border-radius:50px;font-size:.92rem;font-weight:800;
  transition:var(--qf-trans);
}
.cta-btn-primary{
  background:var(--qf-orange);color:#fff;
  box-shadow:0 6px 22px rgba(249,115,22,.45);
}
.cta-btn-primary:hover{background:var(--qf-orange-d);transform:translateY(-2px)}
.cta-btn-wa{background:#25d366;color:#fff;box-shadow:0 6px 22px rgba(37,211,102,.35)}
.cta-btn-wa:hover{background:#1da851;transform:translateY(-2px)}
.cta-btn-outline{
  background:transparent;color:#fff;
  border:2px solid rgba(255,255,255,.35);
}
.cta-btn-outline:hover{background:rgba(255,255,255,.1);transform:translateY(-2px)}

/* ═══════════════════════════════════════════════════════════════
   SOCIAL LINKS
═══════════════════════════════════════════════════════════════ */
.qf-social{
  background:var(--qf-white);border-top:1px solid var(--qf-border);
  padding:30px 24px;
}
.qf-social-inner{
  max-width:560px;margin:0 auto;text-align:center;
}
.social-lbl{
  font-size:.78rem;color:var(--qf-muted);
  text-transform:uppercase;letter-spacing:.08em;margin-bottom:14px;
}
.social-icons{display:flex;flex-wrap:wrap;gap:11px;justify-content:center}
.si{
  width:44px;height:44px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:1.05rem;color:#fff;transition:var(--qf-trans);
}
.si:hover{transform:translateY(-3px) scale(1.1)}
.si-fb{background:#1877f2}
.si-ig{background:linear-gradient(45deg,#f58529,#dd2a7b,#8134af,#515bd4)}
.si-li{background:#0a66c2}
.si-tw{background:#000}
.si-yt{background:#ff0000}
.si-wa{background:#25d366}

/* ═══════════════════════════════════════════════════════════════
   FOOTER
═══════════════════════════════════════════════════════════════ */
.qf-footer{
  background:var(--qf-navy);padding:22px 24px;text-align:center;
  border-top:3px solid var(--qf-orange);
}
.qf-footer p{font-size:.82rem;color:#64748b}
.qf-footer a{color:var(--qf-orange);font-weight:700}
.qf-footer a:hover{color:var(--qf-yellow)}

/* ═══════════════════════════════════════════════════════════════
   FLOATING CALL / WA BUTTONS
═══════════════════════════════════════════════════════════════ */
.fab-stack{
  position:fixed;bottom:24px;right:24px;z-index:9999;
  display:flex;flex-direction:column;gap:12px;
}
.fab-btn{
  width:54px;height:54px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:1.4rem;
  box-shadow:var(--qf-shadow);
  transition:var(--qf-trans);
  animation:fabPop .6s cubic-bezier(.34,1.56,.64,1) both;
}
.fab-btn:hover{transform:scale(1.12)}
.fab-call{background:var(--qf-orange);box-shadow:0 4px 16px rgba(249,115,22,.5);animation-delay:.1s}
.fab-wa  {background:#25d366;box-shadow:0 4px 16px rgba(37,211,102,.5)}
@keyframes fabPop{
  0%{transform:scale(0) rotate(-90deg);opacity:0}
  100%{transform:scale(1) rotate(0deg);opacity:1}
}

/* ═══════════════════════════════════════════════════════════════
   SCROLL-REVEAL
═══════════════════════════════════════════════════════════════ */
.reveal{opacity:0;transform:translateY(26px);transition:opacity .55s ease,transform .55s ease}
.reveal.visible{opacity:1;transform:none}

/* ═══════════════════════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════════════════════ */
@media(max-width:900px){
  .qf-hero-inner{grid-template-columns:1fr;padding-bottom:80px}
  .hero-stats-card{display:none}
  .qf-biz-card{grid-template-columns:1fr}
  .bcard-qs{grid-template-columns:repeat(2,1fr)}
  .qf-gallery-grid{grid-template-columns:1fr 1fr}
  .qf-gallery-grid .gal-item:first-child{grid-column:span 2;grid-row:span 1}
  .qf-process-grid .process-step::after{display:none}
}
@media(max-width:640px){
  .qf-hero{min-height:400px}
  .qf-top-bar{height:50px}
  .topbar-brand{font-size:1.1rem}
  .bcard-info{padding:22px 18px}
  .bcard-qs{grid-template-columns:repeat(2,1fr)}
  .qf-services-grid{grid-template-columns:1fr}
  .qf-why-grid{grid-template-columns:1fr}
  .qf-contact-grid{grid-template-columns:1fr 1fr}
  .qf-process-grid{grid-template-columns:1fr 1fr}
  .qf-tagline{padding:22px 18px}
  .cta-btns{flex-direction:column;align-items:center}
}
@media(max-width:400px){
  .qf-hero-title{font-size:2.2rem}
  .bcard-qs{grid-template-columns:1fr 1fr}
  .qf-contact-grid{grid-template-columns:1fr}
  .qf-process-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  PREVIEW BANNER                                          ║
     ╚══════════════════════════════════════════════════════════╝ --}}
@if(isset($isPreview) && $isPreview)
<div class="preview-bar">
  <i class="fa-solid fa-eye"></i> &nbsp;Preview Mode –
  <a href="/signin">Sign in</a> to edit your profile.
</div>
@endif



{{-- ╔══════════════════════════════════════════════════════════╗
     ║  HERO / BANNER                                           ║
     ╚══════════════════════════════════════════════════════════╝ --}}
<section class="qf-hero">
  <div class="hero-bottom-strip"></div>
  <div class="qf-hero-inner">

    {{-- LEFT: text --}}
    <div class="hero-text">
      <div class="hero-eyebrow">
        <i class="fa-solid fa-screwdriver-wrench"></i>
        Home Repair &amp; Maintenance Experts
      </div>

      <h1 class="qf-hero-title">
        {{ $userdata->name ?? 'Quick Fix' }}<br>
        <span>Services</span>
      </h1>

      <p class="qf-hero-sub">
        {{ $userdata->desig ?? $theme->name ?? 'Professional Home Repair & Maintenance' }}
        @if(isset($userdata->city) && $userdata->city)
          &nbsp;· {{ $userdata->city }}
        @endif
      </p>

      <div class="hero-highlights">
        <span class="hero-highlight"><i class="fa-solid fa-check-circle"></i> Plumbing</span>
        <span class="hero-highlight"><i class="fa-solid fa-check-circle"></i> Electrical</span>
        <span class="hero-highlight"><i class="fa-solid fa-check-circle"></i> Painting</span>
        <span class="hero-highlight"><i class="fa-solid fa-check-circle"></i> Carpentry</span>
        <span class="hero-highlight"><i class="fa-solid fa-check-circle"></i> AC Repair</span>
        <span class="hero-highlight"><i class="fa-solid fa-check-circle"></i> Flooring</span>
      </div>

      <div class="hero-cta-row">
        @if(isset($userdata->mobile) && $userdata->mobile)
        <a href="tel:{{ $userdata->mobile }}" class="hero-btn hero-btn-primary">
          <i class="fa-solid fa-phone"></i> Book a Service
        </a>
        @endif
        @if(isset($social->whatsapp) && $social->whatsapp)
        <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="hero-btn hero-btn-ghost">
          <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
        </a>
        @endif
      </div>
    </div>

    {{-- RIGHT: stats card --}}
    <div class="hero-stats-card">
      <div class="hero-stats-grid">
        <div class="hstat">
          <div class="hstat-icon"><i class="fa-solid fa-star"></i></div>
          <div class="hstat-num">10+</div>
          <div class="hstat-label">Yrs Experience</div>
        </div>
        <div class="hstat">
          <div class="hstat-icon"><i class="fa-solid fa-users"></i></div>
          <div class="hstat-num">5K+</div>
          <div class="hstat-label">Happy Clients</div>
        </div>
        <div class="hstat">
          <div class="hstat-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
          <div class="hstat-num">
            @if(isset($professions) && $professions->count() > 0)
              {{ $professions->count() }}+
            @else
              20+
            @endif
          </div>
          <div class="hstat-label">Services</div>
        </div>
        <div class="hstat">
          <div class="hstat-icon"><i class="fa-solid fa-clock"></i></div>
          <div class="hstat-num">24/7</div>
          <div class="hstat-label">Emergency</div>
        </div>
      </div>
      <div class="trust-row">
        <span class="trust-chip"><i class="fa-solid fa-check"></i> Licensed</span>
        <span class="trust-chip"><i class="fa-solid fa-check"></i> Insured</span>
        <span class="trust-chip"><i class="fa-solid fa-check"></i> Certified</span>
        <span class="trust-chip"><i class="fa-solid fa-check"></i> Guaranteed</span>
      </div>
    </div>

  </div>
</section>

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  BUSINESS PROFILE CARD  (floating below hero)            ║
     ╚══════════════════════════════════════════════════════════╝ --}}
<div class="qf-card-wrap reveal">
  <div class="qf-biz-card">

    {{-- LEFT: brand panel --}}
    <div class="bcard-brand">
    
      <div class="bcard-available">Open Now</div>
      <div class="bcard-name">{{ $userdata->name ?? 'Quick Fix Services' }}</div>
      <div class="bcard-sub">Home Repair &amp; Maintenance</div>
      @if(isset($userdata->city) && $userdata->city)
      <div class="bcard-city"><i class="fa-solid fa-location-dot"></i> {{ $userdata->city }}</div>
      @endif
      <div class="bcard-tags">
        <span class="bcard-tag">Plumbing</span>
        <span class="bcard-tag">Electrical</span>
        <span class="bcard-tag">Painting</span>
        <span class="bcard-tag">Carpentry</span>
      </div>
      <div class="bcard-btns">
        @if(isset($userdata->mobile) && $userdata->mobile)
        <a href="tel:{{ $userdata->mobile }}" class="bcard-btn bcard-btn-call">
          <i class="fa-solid fa-phone"></i> Call Now
        </a>
        @endif
        @if(isset($social->whatsapp) && $social->whatsapp)
        <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="bcard-btn bcard-btn-wa">
          <i class="fa-brands fa-whatsapp"></i> WhatsApp
        </a>
        @endif
        @if(isset($social->map) && $social->map)
        <a href="{{ $social->map }}" target="_blank" class="bcard-btn bcard-btn-map">
          <i class="fa-solid fa-map-pin"></i> Get Directions
        </a>
        @endif
      </div>
    </div>

    {{-- RIGHT: info panel --}}
    <div class="bcard-info">
      <h2 class="bcard-headline">
        Your Trusted <span>Home Repair</span><br>& Maintenance Partner
      </h2>
      <p class="bcard-desc">
        We provide fast, reliable, and affordable home repair and maintenance services.
        From leaky faucets to full renovations — our skilled team handles it all with
        professionalism, quality workmanship, and a satisfaction guarantee.
      </p>
      <div class="bcard-badges">
        <span class="bcard-badge"><i class="fa-solid fa-certificate"></i> Licensed Contractors</span>
        <span class="bcard-badge"><i class="fa-solid fa-shield-halved"></i> Fully Insured</span>
        <span class="bcard-badge"><i class="fa-solid fa-clock"></i> Same-Day Service</span>
        <span class="bcard-badge"><i class="fa-solid fa-thumbs-up"></i> Satisfaction Guaranteed</span>
      </div>
      <div class="bcard-qs">
        <div class="bcard-q">
          <div class="bcard-q-num">10+</div>
          <div class="bcard-q-label">Yrs Exp.</div>
        </div>
        <div class="bcard-q">
          <div class="bcard-q-num">5K+</div>
          <div class="bcard-q-label">Projects</div>
        </div>
        <div class="bcard-q">
          <div class="bcard-q-num">99%</div>
          <div class="bcard-q-label">Satisfaction</div>
        </div>
        <div class="bcard-q">
          <div class="bcard-q-num">24/7</div>
          <div class="bcard-q-label">Emergency</div>
        </div>
      </div>
      <div class="bcard-cta">
        @if(isset($userdata->mobile) && $userdata->mobile)
        <a href="tel:{{ $userdata->mobile }}" class="bcard-cta-btn bcard-cta-primary">
          <i class="fa-solid fa-wrench"></i> Book a Service
        </a>
        @endif
        @if(isset($userdata->email) && $userdata->email)
        <a href="mailto:{{ $userdata->email }}" class="bcard-cta-btn bcard-cta-ghost">
          <i class="fa-solid fa-envelope"></i> Send Enquiry
        </a>
        @endif
      </div>
    </div>

  </div>
</div>

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  TRUST STRIP                                             ║
     ╚══════════════════════════════════════════════════════════╝ --}}
<div class="qf-trust">
  <div class="qf-trust-inner">
    <div class="trust-item">
      <div class="trust-item-icon"><i class="fa-solid fa-bolt"></i></div>
      <span>Fast Response Time</span>
    </div>
    <div class="trust-item">
      <div class="trust-item-icon"><i class="fa-solid fa-shield-halved"></i></div>
      <span>Licensed &amp; Insured</span>
    </div>
    <div class="trust-item">
      <div class="trust-item-icon"><i class="fa-solid fa-indian-rupee-sign"></i></div>
      <span>Transparent Pricing</span>
    </div>
    <div class="trust-item">
      <div class="trust-item-icon"><i class="fa-solid fa-star"></i></div>
      <span>Quality Workmanship</span>
    </div>
    <div class="trust-item">
      <div class="trust-item-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
      <span>24/7 Emergency Service</span>
    </div>
    <div class="trust-item">
      <div class="trust-item-icon"><i class="fa-solid fa-thumbs-up"></i></div>
      <span>100% Satisfaction Guarantee</span>
    </div>
  </div>
</div>

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  SERVICES / WHAT WE DO                                   ║
     ╚══════════════════════════════════════════════════════════╝ --}}
@if(isset($menu->service) && $menu->service && isset($professions) && $professions->count() > 0)
<section class="qf-section">
  <div class="qf-section-hd reveal">
    <div class="qf-eyebrow">
      <i class="fa-solid fa-toolbox"></i> Our Services
    </div>
    <h2 class="qf-title">What We Fix &amp; Maintain</h2>
    <p class="qf-sub">From minor repairs to major renovations — we do it all quickly, cleanly, and with guaranteed quality.</p>
  </div>
  <div class="qf-services-grid">
    @foreach($professions as $idx => $svc)
    <div class="svc-card reveal" style="transition-delay:{{ $idx * 60 }}ms">
      <div class="svc-img-wrap">
        <img src="{{ $serviceImages[$idx % count($serviceImages)] }}" alt="{{ $svc->title ?? 'Service' }}" loading="lazy"/>
        <div class="svc-icon-badge">
          <i class="fa-solid {{ $serviceIcons[$idx % count($serviceIcons)] }}"></i>
        </div>
      </div>
      <div class="svc-body">
        <div class="svc-title">{{ $svc->title ?? 'Repair Service' }}</div>
        <div class="svc-desc">
          {{ Str::limit($svc->description ?? 'Professional repair and maintenance service delivered with speed and quality.', 105) }}
        </div>
        <span class="svc-link">Get a Quote <i class="fa-solid fa-arrow-right"></i></span>
      </div>
    </div>
    @endforeach
  </div>
</section>
<div class="qf-divider"></div>
@endif

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  WHY CHOOSE US  (dark bg with qualifications)            ║
     ╚══════════════════════════════════════════════════════════╝ --}}
@if(isset($menu->quali) && $menu->quali && isset($qualifications) && $qualifications->count() > 0)
<div class="qf-why-bg">
  <div class="qf-why-inner">
    <div class="qf-why-hd reveal">
      <div class="qf-eyebrow"><i class="fa-solid fa-award"></i> Why Choose Us</div>
      <h2 class="qf-title">The Quick Fix Advantage</h2>
      <p class="qf-sub">We go beyond just fixing — we deliver peace of mind with every job.</p>
    </div>
    <div class="qf-why-grid">
      @php
        $whyIcons = [
          'fa-bolt','fa-shield-halved','fa-star','fa-clock',
          'fa-certificate','fa-hand-holding-heart','fa-indian-rupee-sign','fa-thumbs-up'
        ];
      @endphp
      @foreach($qualifications as $qi => $qual)
      <div class="why-card reveal" style="transition-delay:{{ $qi * 70 }}ms">
        <div class="why-icon"><i class="fa-solid {{ $whyIcons[$qi % count($whyIcons)] }}"></i></div>
        <div class="why-title">{{ $qual->title ?? 'Our Advantage' }}</div>
        <div class="why-desc">
          {{ Str::limit($qual->description ?? 'Quality service delivered by trained professionals at competitive prices.', 115) }}
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  HOW IT WORKS  (4 simple steps)                          ║
     ╚══════════════════════════════════════════════════════════╝ --}}
<section class="qf-section" style="background:var(--qf-white);max-width:100%;padding:80px 24px">
  <div style="max-width:1200px;margin:0 auto">
    <div class="qf-section-hd reveal">
      <div class="qf-eyebrow"><i class="fa-solid fa-list-check"></i> Process</div>
      <h2 class="qf-title">How It Works</h2>
      <p class="qf-sub">Getting your home repaired is simple, fast, and hassle-free with Quick Fix Services.</p>
    </div>
    <div class="qf-process-grid">
      <div class="process-step reveal">
        <div class="process-circle">
          <div class="process-icon"><i class="fa-solid fa-phone"></i></div>
        </div>
        <div class="process-title">Call or WhatsApp</div>
        <div class="process-desc">Reach us anytime — describe your problem and we'll give you an instant estimate.</div>
      </div>
      <div class="process-step reveal" style="transition-delay:80ms">
        <div class="process-circle">
          <div class="process-icon"><i class="fa-solid fa-calendar-check"></i></div>
        </div>
        <div class="process-title">Schedule Visit</div>
        <div class="process-desc">Pick a time that suits you — we offer same-day and next-day slots.</div>
      </div>
      <div class="process-step reveal" style="transition-delay:160ms">
        <div class="process-circle">
          <div class="process-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
        </div>
        <div class="process-title">We Fix It</div>
        <div class="process-desc">Our skilled technician arrives on time, equipped and ready to solve the problem.</div>
      </div>
      <div class="process-step reveal" style="transition-delay:240ms">
        <div class="process-circle">
          <div class="process-icon"><i class="fa-solid fa-star"></i></div>
        </div>
        <div class="process-title">You're Satisfied</div>
        <div class="process-desc">We don't leave until you're 100% happy with the work — guaranteed.</div>
      </div>
    </div>
  </div>
</section>
<div class="qf-divider"></div>

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  PHOTO GALLERY / PORTFOLIO                               ║
     ╚══════════════════════════════════════════════════════════╝ --}}
@if(isset($menu->upload_file) && $menu->upload_file)
<section class="qf-section">
  <div class="qf-section-hd reveal">
    <div class="qf-eyebrow"><i class="fa-solid fa-images"></i> Our Work</div>
    <h2 class="qf-title">Recent Projects</h2>
    <p class="qf-sub">Take a look at some of our recent repair and renovation work — quality you can see.</p>
  </div>
  <div class="qf-gallery-grid">
    @php
      $galleryImages = [];
      if(isset($portfolios) && $portfolios->count() > 0){
        foreach($portfolios->take(6) as $port){
          $imgs = json_decode($port->images ?? '[]', true);
          if(!empty($imgs[0])){
            $galleryImages[] = url('public/frontend/portfolio/'.$imgs[0]);
          }
        }
      }
      if(count($galleryImages) < 6){
        $galleryImages = array_merge($galleryImages, array_slice($galleryFallbacks, count($galleryImages)));
      }
    @endphp
    @foreach(array_slice($galleryImages, 0, 6) as $gi => $gImg)
    <div class="gal-item reveal" style="transition-delay:{{ $gi * 60 }}ms">
      <img src="{{ $gImg }}" alt="Project {{ $gi + 1 }}" loading="lazy"/>
      <div class="gal-overlay">
        <i class="fa-solid fa-expand"></i>
        <span>View Project</span>
      </div>
    </div>
    @endforeach
  </div>
</section>
<div class="qf-divider"></div>
@endif

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  TAGLINE / BUSINESS QUOTE                                ║
     ╚══════════════════════════════════════════════════════════╝ --}}
@if(isset($menu->thought) && $menu->thought && isset($thoughts) && $thoughts)
<section class="qf-section" style="padding-top:0">
  <div class="qf-tagline reveal">
    <p class="tagline-text">"{{ $thoughts }}"</p>
    <div class="tagline-author">
      {{ $userdata->name ?? 'Quick Fix Services' }},
      {{ $userdata->desig ?? 'Home Repair Experts' }}
    </div>
  </div>
</section>
<div class="qf-divider"></div>
@endif

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  CONTACT SECTION                                         ║
     ╚══════════════════════════════════════════════════════════╝ --}}
<section class="qf-section">
  <div class="qf-section-hd reveal">
    <div class="qf-eyebrow"><i class="fa-solid fa-address-card"></i> Contact</div>
    <h2 class="qf-title">Reach Us Anytime</h2>
    <p class="qf-sub">Need a repair? We're just one call or message away — available every day.</p>
  </div>
  <div class="qf-contact-grid">
    @if(isset($userdata->mobile) && $userdata->mobile)
    <div class="contact-card reveal">
      <div class="cc-icon"><i class="fa-solid fa-phone"></i></div>
      <div class="cc-label">Phone</div>
      <div class="cc-value"><a href="tel:{{ $userdata->mobile }}">{{ $userdata->mobile }}</a></div>
    </div>
    @endif
    @if(isset($userdata->email) && $userdata->email)
    <div class="contact-card reveal" style="transition-delay:80ms">
      <div class="cc-icon"><i class="fa-solid fa-envelope"></i></div>
      <div class="cc-label">Email</div>
      <div class="cc-value"><a href="mailto:{{ $userdata->email }}">{{ $userdata->email }}</a></div>
    </div>
    @endif
    @if(isset($userdata->city) && $userdata->city)
    <div class="contact-card reveal" style="transition-delay:160ms">
      <div class="cc-icon"><i class="fa-solid fa-location-dot"></i></div>
      <div class="cc-label">Location</div>
      <div class="cc-value">{{ $userdata->city }}</div>
    </div>
    @endif
    @if(isset($social->whatsapp) && $social->whatsapp)
    <div class="contact-card reveal" style="transition-delay:240ms">
      <div class="cc-icon"><i class="fa-brands fa-whatsapp"></i></div>
      <div class="cc-label">WhatsApp</div>
      <div class="cc-value"><a href="https://wa.me/{{ $social->whatsapp }}" target="_blank">Chat Now</a></div>
    </div>
    @endif
  </div>
</section>

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  CALL-TO-ACTION BAND                                     ║
     ╚══════════════════════════════════════════════════════════╝ --}}
<div class="qf-cta-band">
  <div class="cta-inner">
    <h2 class="cta-title">Need a <span>Repair</span> Today?</h2>
    <p class="cta-sub">Fast, affordable, and professional home repair service — available right now.</p>
    <div class="cta-btns">
      @if(isset($userdata->mobile) && $userdata->mobile)
      <a href="tel:{{ $userdata->mobile }}" class="cta-btn cta-btn-primary">
        <i class="fa-solid fa-phone"></i> Call Us Now
      </a>
      @endif
      @if(isset($social->whatsapp) && $social->whatsapp)
      <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="cta-btn cta-btn-wa">
        <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
      </a>
      @endif
      @if(isset($userdata->email) && $userdata->email)
      <a href="mailto:{{ $userdata->email }}" class="cta-btn cta-btn-outline">
        <i class="fa-solid fa-envelope"></i> Send Enquiry
      </a>
      @endif
    </div>
  </div>
</div>

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  SOCIAL LINKS                                            ║
     ╚══════════════════════════════════════════════════════════╝ --}}
@if(isset($menu->social_link) && $menu->social_link)
@php
  $hasSocial = isset($social) && (
    (isset($social->facebook)  && $social->facebook)  ||
    (isset($social->instagram) && $social->instagram) ||
    (isset($social->linkedin)  && $social->linkedin)  ||
    (isset($social->twitter)   && $social->twitter)   ||
    (isset($social->youtube)   && $social->youtube)   ||
    (isset($social->whatsapp)  && $social->whatsapp)
  );
@endphp
@if($hasSocial)
<div class="qf-social">
  <div class="qf-social-inner">
    <div class="social-lbl">Follow Us Online</div>
    <div class="social-icons">
      @if(isset($social->facebook) && $social->facebook)
      <a href="{{ $social->facebook }}" target="_blank" class="si si-fb" title="Facebook">
        <i class="fa-brands fa-facebook-f"></i>
      </a>
      @endif
      @if(isset($social->instagram) && $social->instagram)
      <a href="{{ $social->instagram }}" target="_blank" class="si si-ig" title="Instagram">
        <i class="fa-brands fa-instagram"></i>
      </a>
      @endif
      @if(isset($social->linkedin) && $social->linkedin)
      <a href="{{ $social->linkedin }}" target="_blank" class="si si-li" title="LinkedIn">
        <i class="fa-brands fa-linkedin-in"></i>
      </a>
      @endif
      @if(isset($social->twitter) && $social->twitter)
      <a href="{{ $social->twitter }}" target="_blank" class="si si-tw" title="X / Twitter">
        <i class="fa-brands fa-x-twitter"></i>
      </a>
      @endif
      @if(isset($social->youtube) && $social->youtube)
      <a href="{{ $social->youtube }}" target="_blank" class="si si-yt" title="YouTube">
        <i class="fa-brands fa-youtube"></i>
      </a>
      @endif
      @if(isset($social->whatsapp) && $social->whatsapp)
      <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="si si-wa" title="WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
      </a>
      @endif
    </div>
  </div>
</div>
@endif
@endif

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  FOOTER                                                  ║
     ╚══════════════════════════════════════════════════════════╝ --}}
<footer class="qf-footer">
  <p>
    &copy; {{ date('Y') }} {{ $userdata->name ?? 'Quick Fix Services' }} —
    Home Repair &amp; Maintenance Experts. All rights reserved. |
    Digital Card by <a href="{{ url('/') }}" target="_blank">Fastap</a>
  </p>
</footer>

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  FLOATING CALL + WHATSAPP BUTTONS                        ║
     ╚══════════════════════════════════════════════════════════╝ --}}
<div class="fab-stack">
  @if(isset($userdata->mobile) && $userdata->mobile)
  <a href="tel:{{ $userdata->mobile }}" class="fab-btn fab-call" title="Call Now">
    <i class="fa-solid fa-phone"></i>
  </a>
  @endif
  @if(isset($social->whatsapp) && $social->whatsapp)
  <a href="https://wa.me/{{ $social->whatsapp }}" target="_blank" class="fab-btn fab-wa" title="WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
  </a>
  @endif
</div>

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  PROFILE LOCATION TRACKER                                ║
     ╚══════════════════════════════════════════════════════════╝ --}}
@if(isset($userdata->id) && isset($userdata->slug))
@component('components.profile-location-tracker', [
  'customerId' => $userdata->id,
  'profileSlug' => $userdata->slug,
  'isPreview'  => $isPreview ?? false,
])@endcomponent
@endif

{{-- ╔══════════════════════════════════════════════════════════╗
     ║  SCROLL-REVEAL SCRIPT                                    ║
     ╚══════════════════════════════════════════════════════════╝ --}}
<script>
(function(){
  var els = document.querySelectorAll('.reveal');
  if(!('IntersectionObserver' in window)){
    els.forEach(function(e){ e.classList.add('visible'); });
    return;
  }
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(entry.isIntersecting){
        entry.target.classList.add('visible');
        io.unobserve(entry.target);
      }
    });
  },{threshold:0.12});
  els.forEach(function(e){ io.observe(e); });
})();
</script>

</body>
</html>