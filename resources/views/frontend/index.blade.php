    @extends('layouts.app')
@section('content')

<style>
@media (min-width: 1400px) {
    .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
        max-width: 1520px;
    }
.cards_img {
    height: 170px;
}
.cards_img img {
    width: 70%;
    height: 150px;
    object-fit: contain !important;
}
.bussiness_card_dem{
    font-size: 21px;
    text-transform: capitalize !important;
    line-height: 28px;
}
    @media (max-width: 1399px){
.awesome-box4 .box-img1 {
    bottom: -127px !important;
    right: -60px !important;
    width: 322px;
    transform: rotate(-15deg) !important;
}
}
@media (max-width: 1399px){
.awesome-box4 .box-img2 {
    bottom: 0;
    left: 0;
    width: 205px !important;
}
}

.pricing_main_new {
    background-image: url(frontendnew/images/pricing/price_bg1.jpg);
    background-repeat: no-repeat !important;
    background-size: 430px;
}

/*.professional_card_main {*/
/*    background-image: url(frontendnew/images/image_profession.png);*/
/*    background-repeat: no-repeat;*/
/*    background-position: bottom right;*/
/*}*/

.professional_card_main {
    /*background-image: url(frontendnew/images/image_profession.png);*/
    /*background-image: url(frontend/assets/img/elements/blumb.png);*/
    background-repeat: no-repeat;
    /* background-position: bottom right 28px; */
    background-size: 180px;
    background-position: right 3% bottom -2%;
}

.business_card_main {
    /*background-image: url(frontendnew/images/image_profession.png);*/
    /*background-image: url(frontend/assets/img/elements/real.png);*/
    background-repeat: no-repeat;
    background-position: left bottom;
    /*padding-bottom: 110px;*/
    background-size: 170px;
}

.pricing_main_new section.overview-block-ptb {
    padding-bottom: 0px !important;
}

.iq-testimonial .iq-star i {
    margin-right: 4px;
    color: #8d8686 !important;
}

.background_ani_main form input {
    margin: 0 3px;
}

.background_ani_main button.button.white.grey.iq-mr-0 {
    margin-left: 2px !important;
    border-radius: 4px !important;
}
.background_ani_main h6 {
    margin-bottom: 20px;
    margin-top: 14px;
}

.background_ani_main {
    padding: 80px 0px;
}
.background_ani_main button:hover {
    background: #7b41e3 !important;
    color: #fff !important;
}
.background_ani_main #canvas{
    height:100% !important;
}

@media(max-width:768px){
.awesome-box4 .box-img2 {
    bottom: 0;
    left: 0;
    width: 130px !important;
}

.awesome-box4 .box-img1 {
    bottom: -92px !important;
    right: -35px !important;
    width: 230px !important;
    transform: rotate(-15deg) !important;
}
.background_ani_main form input {
    margin: 0 0px;
}

.background_ani_main button.button.white.grey.iq-mr-0 {
    margin-left: 0px !important;
    border-radius: 4px !important;
}
}

.Customized_icen {
    padding: 0 12px 0 0;
}

.third_main_sectin_img img {
    width: 100%;
}

.our_testimonail{
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 5;
}
.Profilemeet_team{
    height:175px;
}

img.img-fluid.center-block.business_info_easily {
    height: 58px;
    width: 70px; 
}


</style>
@php

$data = App\Models\websetting::first();

@endphp


<!-- anand start code fastapp theme-->

    <!-- Banner Here -->
    <section class="banner__section banner__section__two bannerbg">
        <!--Mask-->
        <div class="banner__bgmask">
            <img src="{{ url('frontend/assets/img/elements/box-element.png') }}" alt="mask">
        </div>
        <!--Mask-->
        <!--Container-->
        <div class="container">
            <div class="banner__wrapper">
                <div class="row g-4  justify-content-between">
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="banner__content">
                            <div class="content__box">
                                <span class="d3 mb-0 wow fadeInUp" data-wow-duration="2s">
                                    Revolutionize your
                                </span>
                                <span class="d3 wow fadeInUp" data-wow-duration="2.2s">
                                    Visiting Card with <span class="theme">Artificial </span>
                                    <span class="theme2">Intelligence</span>
                                </span>
                                <p class="wow fadeInUp" data-wow-duration="2.4s">
                                    We've Developed AI Based NFC Visiting Cards, which will show your Complete
                                    Business/Profession or Personal Details with just a Touch on your Cellphone.
                                </p>
                                <div class="btg__grp wow fadeInUp" data-wow-duration="2.6">
                                    <a href="{{ url('/Contact-Us') }}" class="cmn--btn">
                                        <span>Get Started</span>
                                    </a>
                                    <!--a href="https://www.youtube.com/watch?v=RvHsnpmpQwM" class="play__btn video-btn">
                                        <span class="play__icon">
                                            <i class="material-symbols-outlined">
                                                play_arrow
                                            </i>
                                        </span>
                                        <span>
                                            Watch Intro Video
                                        </span>
                                    </a-->
                                </div>
                            </div>
                            <div class="aitext2">
                                <img src="{{ url('frontend/assets/img/elements/aitext2.png') }}" alt="ai">
                            </div>
                            <div class="ball3d">
                                <img src="{{ url('frontend/assets/img/elements/ball3d.png') }}" alt="ball3d">
                            </div>
                            <div class="banner3__two">
                                <img src="{{ url('frontend/assets/img/elements/3dround.png') }}" alt="ball3d">
                            </div>
                            <div class="banner__blump">
                                <img src="{{ url('frontend/assets/img/elements/blumb.png') }}" alt="ball3d">
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-1 col-xl-1 col-lg-1"></div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-8">
                        <div class="banner__thumb">
                            <div class="thumb">
                                <img src="{{ url('frontend/assets/img/banner/banner2.png') }}" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Container-->
        <!--Elements-->
        <div class="banner__mask">
            <img src="{{ url('frontend/assets/img/elements/banner-shape2.png') }}" alt="mask">
        </div>
        <div class="dark__mask d-none">
            <img src="{{ url('frontend/assets/img/elements/banner-shape2dark.png') }}" alt="mask">
        </div>
        <div class="banner__ai2">
            <img src="{{ url('frontend/assets/img/elements/feature-ali.png') }}" alt="ai">
        </div>
        <div class="banner__checkai">
            <img src="{{ url('frontend/assets/img/elements/checkai.png') }}" alt="ai">
        </div>
        <div class="banner__nulldimond">
            <img src="{{ url('frontend/assets/img/elements/null-dimond.png') }}" alt="ai">
        </div>
        <!--Elements-->
    </section>
    <!-- Banner End -->

    <!-- About Here -->
    
        <!--<section class="about__section about__section__two bg__white pt-80 pb-120">-->
    
    <section class="about__section about__section__two bg__white pt__60 pb__60">
        <!--Container-->
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <!--about content-->
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="about__content">
                        <div class="section__header">
                            <h1 class="wow fadeInUp" data-wow-duration="2s" style="color: var(--themetext);">
                                We Offer a Wide Range of Digital NFC Cards for Your Resume and for your Business Details.
                            </h1>
                            <p class="wow fadeInUp" data-wow-duration="2.2s">
                                In today's rapidly evolving digital age, businesses are constantly seeking innovative ways to connect with potential clients, partners, and customers. One such revolutionary technology that is reshaping the way we exchange information is Near Field Communication (NFC). With its seamless data transfer capabilities, NFC has found a new application in the world of business cards, replacing traditional paper cards with smart, interactive alternatives.
                            </p>
                        </div>
                        <div class="progress__wrap wow fadeInUp" data-wow-duration="2.4s">
                            <div class="pro__items">
                                <div class="pro__head">
                                    <span class="title">
                                        Customer satisfaction
                                    </span>
                                    <span class="point">
                                        80%
                                    </span>
                                </div>
                                <div class="progress">
                                    <div class="progress-value"></div>
                                </div>
                            </div>
                            <div class="pro__items">
                                <div class="pro__head">
                                    <span class="title">
                                        Performance
                                    </span>
                                    <span class="point">
                                        90%
                                    </span>
                                </div>
                                <div class="progress">
                                    <div class="progress-value"></div>
                                </div>
                            </div>
                            <div class="pro__items">
                                <div class="pro__head">
                                    <span class="title">
                                        Marketing
                                    </span>
                                    <span class="point">
                                        70%
                                    </span>
                                </div>
                                <div class="progress">
                                    <div class="progress-value"></div>
                                </div>
                            </div>
                            <div class="pro__items">
                                <div class="pro__head">
                                    <span class="title">
                                        Privacy
                                    </span>
                                    <span class="point">
                                        85%
                                    </span>
                                </div>
                                <div class="progress">
                                    <div class="progress-value"></div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('/About-Us') }}" class="cmn--btn wow fadeInUp" data-wow-duration="2.6">
                            <span>Read More</span>
                        </a>
                    </div>
                </div>
                <!--about content-->
                <div class="col-xxl-1 col-xl-1 col-lg-1"></div>
                <!--about thumb-->
                <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-9 col-sm-9">
                    <div class="about__thumb">
                        <img src="{{ url('frontend/assets/img/about/about2.png') }}" alt="about">
                    </div>
                </div>
                <!--about thumb-->
            </div>
        </div>
        <!--Container-->
        <!--elements-->
        <div class="ball3d">
            <img src="{{ url('frontend/assets/img/elements/ball3d.png') }}" alt="ball3d">
        </div>
        <div class="banner3__two">
            <img src="{{ url('frontend/assets/img/elements/3dround.png') }}" alt="ball3d">
        </div>
        <div class="banner__blump">
            <img src="{{ url('frontend/assets/img/elements/blumb.png') }}" alt="ball3d">
        </div>
        <div class="banner__nulldimond">
            <img src="{{ url('frontend/assets/img/elements/null-dimond.png') }}" alt="ball3d">
        </div>
        <!--elements-->
    </section>
    <!-- About End -->

    <!-- Includeai Here -->
    <!--<section class="includeai__section bgsection pt-120 pb-120">-->
    
    <section class="includeai__section bgsection pt__60 pb__60">
        <!--container-->
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <!--col grid-->
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="about__content include__cheack">
                        <!--Include element-->
                        <div class="threeroune">
                            <img src="{{ url('frontend/assets/img/elements/3dround.png') }}" alt="img">
                        </div>
                        <div class="include__null">
                            <img src="{{ url('frontend/assets/img/elements/null-dimond.png') }}" alt="img">
                        </div>
                        <!--Include element-->
                        <div class="section__header">
                            <h2 class="wow fadeInUp" data-wow-duration="0.5s">
                                Check out our wide range of services including AI
                            </h2>
                            <p class="wow fadeInUp" data-wow-duration="0.7s">
                                When tapped against an NFC-enabled device, such as a smartphone or tablet, the card instantly transfers its data, opening up a world of possibilities. Recipients can save the contact details directly to their address book or access additional information like company portfolios, social media profiles, and promotional videos.
                            </p>
                        </div>
                        <ul class="about__chack">
                            <li class="wow fadeInUp" data-wow-duration="5.0s">
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        task_alt
                                    </i>
                                </span>
                                <span>
                                    Advanced Technology
                                </span>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="1s">
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        task_alt
                                    </i>
                                </span>
                                <span>
                                    100% Security System
                                </span>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="1.1s">
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        task_alt
                                    </i>
                                </span>
                                <span>
                                    Competitive Pricing
                                </span>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="01.2s">
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        task_alt
                                    </i>
                                </span>
                                <span>
                                    24 Hours Supports
                                </span>
                            </li>
                        </ul>
                        <div class="include__btn wow fadeInUp" data-wow-duration="1.5s">
                            <a href="{{ url('/Product') }}" class="cmn--btn">
                                <span>
                                    See All Products
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xxl-1 col-xl-1 col-lg-1"></div>
                <!--col grid-->
                <div class="col-xxl-5 col-xl-5 col-lg-5">
                    <div class="include__boxes">
                        <div class="inclue__box wow fadeInUp" data-wow-duration="1.1s">
                            <div class="icnos">
                                <img src="{{ url('frontend/assets/img/feature/robotic.svg') }}" alt="icon">
                            </div>
                            <div class="content">
                                <h4>
                                    Robotic Automation
                                </h4>
                                <p>
                                    Robotic Automation (RA), a fundamental Reality of AI research...
                                </p>
                            </div>
                        </div>
                        <div class="inclue__box">
                            <div class="icnos">
                                <img src="{{ url('frontend/assets/img/feature/machine.svg') }}" alt="icon">
                            </div>
                            <div class="content">
                                <h4>
                                    Machine Learning
                                </h4>
                                <p>
                                    Machine learning (ML), a fundamental concept of AI research...
                                </p>
                            </div>
                        </div>
                        <div class="inclue__box wow fadeInUp" data-wow-duration="1.3s">
                            <div class="icnos">
                                <img src="{{ url('frontend/assets/img/feature/virtual.svg') }}" alt="icon">
                            </div>
                            <div class="content">
                                <h4>
                                    Virtual Reality
                                </h4>
                                <p>
                                    Virtual Reality (VR), a fundamental Future of AI research...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--col grid-->
            </div>
        </div>
        <!--container-->

        <!--element-->
        <div class="include__elements3d">
            <img src="{{ url('frontend/assets/img/elements/ball3d.png') }}" alt="include">
        </div>
        <div class="include__elements">
            <img src="{{ url('frontend/assets/img/elements/include-element.png') }}" alt="include">
        </div>
        <div class="include__blumb">
            <img src="{{ url('frontend/assets/img/elements/blumb.png') }}" alt="include">
        </div>
        <!--element-->
    </section>
    <!-- Includeai End -->

    <!-- Pricing section start here -->
    <!--<section class="project__count bg__white pt-120 pb-120">-->
    
    
    <!--Card Section-->
    
    
    
    <section class="includeai__section bgsection pt__60 pb__60">
        <!--container-->
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <!--col grid-->
                <div class="col-md-2 mt-5 col-6 wow fadeInLeft" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/1.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInUp" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/2.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInDown" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/3.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/4.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInUp" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/5.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInDown" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/6.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/7.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInLeft" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/8.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInDown" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/9.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInUp" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/10.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/11.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInUp" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/12.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInDown" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/13.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInLeft" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/14.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/15.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInDown" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/16.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInDown" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/17.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInDown" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/18.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/19.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInUp" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/20.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInDown" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/21.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/22.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInLeft" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/23.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/25.jpeg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/29.jpg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/30.jpg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/31.jpg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                <div class="col-md-2 mt-5 col-6 wow fadeInRight" data-wow-duration="5.0s">
                   <img src="{{ url('frontend/assets/img/cards/32.jpg') }}" width="100%" height="122" style="border-radius: 0.375rem;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                </div>
                
            </div>
        </div>
        <!--container-->

        <!--element-->
        <div class="include__elements3d">
            <img src="{{ url('frontend/assets/img/elements/ball3d.png') }}" alt="include">
        </div>
        <div class="include__elements">
            <img src="{{ url('frontend/assets/img/elements/include-element.png') }}" alt="include">
        </div>
        <div class="include__blumb">
            <img src="{{ url('frontend/assets/img/elements/blumb.png') }}" alt="include">
        </div>
        <!--element-->
    </section>
    
    <!--Card Section End-->
    
    <section class="project__count bg__white pt__40 pb__40">
            <div class="container">
                 <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="heading-title text-center">
                            <h3 class="title iq-tw-6">PRICING PLANS</h3>
                            <p>Swith to the Next Generation Business Card </p>
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="smart_card_main">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                 <div class="details_smart">
                                    <h3 class="text-center">GOOGLE BUSINESS REVIEW CARD</h3>
                                    <p></p><p>This Google Business Review Card is ideal for devoted concern for Business Promotions and Reviews. Owners, Employees and Other Staff can use it. "Available in Multicolour with Professional Design"</p>
                                    <p></p>
                                     <h5><span><b>PRICE: </b></span><b>₹499/-</b> <span>MRP: </span>₹ <del>3000</del>/- </h5>
                                 <h4>Features:</h4>
                                 </div>
                                 <ul style="color:rgb(102, 102, 102);">
                                    <li> One Tap Google Review</li>
                                    <li>Direct Review QR Code</li>
                                    <li>Support</li>
                                    <li>1 Years Warrenty</li>
                                    <li> Easy Connectivity</li>
                                    <li>Many more</li>
                                </ul>
                                <div class="price__btn" style="margin: 20px 82px 0px 82px;">
                                    <a href="{{ url('/Product') }}" class="cmn--btn border__btn" style="width: 100%;text-align: center;">
                                        <span>
                                          Buy Now
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="icon" style="width:100%; height:100%">
                                    <img src="{{url('uploads/Pricing_Plans/business.jpeg')}}" alt="Product Image" style="width: 55% !important;display: block !important;margin: 0 auto !important;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="smart_card_main">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="icon" style="width:100%;height: 100%;">
                                    <img src="{{url('uploads/Pricing_Plans/business-card.png')}}" alt="Product Image" style="width: 55% !important;display: block !important;margin: 0 auto !important;">
                                </div>
                             </div>   
                            <div class="col-sm-4">
                                <div class="details_smart">
                                    <h3 class="text-center">BUSINESS CARD</h3>
                                    <p></p><p>This Business Card is  For devoted concern for Business People, Students, Employees and More. "Available in Multicolour with Professional Design"</p><p></p>
                                 <h3><span><b>PRICE:</b> </span><b>₹999/-</b> <span>MRP: </span>₹ <del>3500</del>/- </h3>
                                 <h4>Features:</h4>
                                 </div>
                                <ul style="color:rgb(102, 102, 102);">
                                    <li>Smart Profile with AI</li>
                                    <li>your product</li>
                                    <li>multiple serrvice add photo </li>
                                    <li>PDF </li>
                                    <li>inquiry </li>
                                    <li>CRM System </li>
                                    <li>Support</li>
                                    <li>QR Code</li>
                                    <li>1 Years Warranty</li>
                                    <li> User Panel </li>
                                    <li>Social Links at Single Platform</li>
                                    <li>Easy Connectivity </li>
                                    <li>Many more</li>
                                </ul>
                                <div class="price__btn" style="margin: 20px 82px 0px 82px;">
                                    <a href="{{ url('/Product') }}" class="cmn--btn border__btn" style="width: 100%;text-align: center;">
                                        <span>
                                          Buy Now
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="professional_card_main">
                     <div class="container">
                <div class="row">
                     <div class="col-sm-4">
                        <div class="details_smart">
                            <h3 class="text-center">PROFESSIONAL CARD</h3>
                            <p></p><p>This Professional Card is Pro Card for Professionals like Advocates, Doctors, Charted Accountant etc..  "Available in Beautiful Professional Logo and Design"</p><p></p>
                         <h3><span><b>PRICE: </b></span><b>₹999/-</b> <span>MRP: </span>₹ <del>4000</del>/- </h3>
                         <h4>Features:</h4>
                         </div>
                        <ul style="color:rgb(102, 102, 102);">
                            <li>Smart Profile</li>
                            <li>CRM System </li>
                            <li> Support</li>
                            <li> QR Code</li>
                            <li>1 Years Warranty</li>
                            <li>User Panel </li>
                            <li> Social Links at Single Platform</li>
                            <li> Easy Connectivity</li>
                            <li>Many More</li>
                        </ul>
                        <div class="price__btn" style="margin: 20px 82px 0px 82px;">
                                <a href="{{ url('/Product') }}" class="cmn--btn border__btn" style="width: 100%;text-align: center;">
                                    <span>
                                      Buy Now
                                    </span>
                                </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="icon" style="width:100%;height: 100%;">
                            <img src="{{url('uploads/Pricing_Plans/business-card.png')}}" alt="Product Image" style="width: 55% !important;display: block !important;margin: 0 auto !important;">
                        </div>
                    </div>
                </div>
                </div>
                </div>
                
                <div class="professional_card_main">
                     <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="icon" style="width:100%;height: 100%;">
                            <img src="{{url('uploads/product_images/product_single_img/1709182065.png')}}" alt="Product Image" style="width: 55% !important;display: block !important;margin: 0 auto !important;">
                        </div>
                    </div>
                     <div class="col-sm-4">
                        <div class="details_smart">
                            <h3 class="text-center">FULLY CUSTOMISED BUSINESS CARD</h3>
                            <p></p><p>This Business Card is  For devoted concern for Business People, Students, Employees and More. "Available in Multicolour with Professional Design"</p><p></p>
                         <h3><span><b>PRICE: </b></span><b>₹1399/-</b> <span>MRP: </span>₹ <del>4000</del>/- </h3>
                         <h4>Features:</h4>
                         </div>
                        <ul style="color:rgb(102, 102, 102);">
                            <li>Smart Profile</li>
                            <li>CRM System </li>
                            <li> Support</li>
                            <li> QR Code</li>
                            <li>1 Years Warranty</li>
                            <li>User Panel </li>
                            <li> Social Links at Single Platform</li>
                            <li>Easy Connectivity</li>
                            <li>Fully Customised Business Card</li>
                            <li>Many More</li>
                        </ul>
                        <div class="price__btn" style="margin: 20px 82px 0px 82px;">
                                <a href="{{ url('/Product') }}" class="cmn--btn border__btn" style="width: 100%;text-align: center;">
                                    <span>
                                      Buy Now
                                    </span>
                                </a>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                
                 <div class="professional_card_main">
                     <div class="container">
                <div class="row">
                    
                   
                     <div class="col-sm-4">
                        <div class="details_smart">
                            <h3 class="text-center">METAL CARD</h3>
                            <p></p><p>This Business Card is  For devoted concern for Business People, Students, Employees and More. "Available in Multicolour with Professional Design"</p><p></p>
                         <h3><span><b>PRICE:</b> </span><b>₹1999/-</b> <span>MRP: </span>₹ <del>5000</del>/- </h3>
                         <h4>Features:</h4>
                         </div>
                        <ul style="color:rgb(102, 102, 102);">
                            <li>Smart Profile with AI</li>
                            <li>your product</li>
                            <li>multiple serrvice add photo </li>
                            <li>PDF </li>
                            <li>inquiry </li>
                            <li>CRM System </li>
                            <li>Support</li>
                            <li>QR Code</li>
                            <li>1 Years Warranty</li>
                            <li> User Panel </li>
                            <li>Social Links at Single Platform</li>
                            <li>Easy Connectivity </li>
                            <li>Many more</li>
                        </ul>
                        <div class="price__btn" style="margin: 20px 82px 0px 82px;">
                                <a href="{{ url('/Product') }}" class="cmn--btn border__btn" style="width: 100%;text-align: center;">
                                    <span>
                                      Buy Now
                                    </span>
                                </a>
                        </div>
                       
                    </div>
                     <div class="col-sm-8">
                        <div class="icon" style="width:100%;height: 100%;">
                            <img src="{{ url('frontend/assets/img/cards/30.jpg') }}" alt="Product Image" style="width: 55% !important;display: block !important;margin: 0 auto !important;">
                        </div>
                    </div>
                   
                </div>
                </div>
                </div>
                
                
       
                <div class="business_card_main">
                     <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-4">
                             <!--<div class="details_smart">-->
                             <!--   <h3 class="text-center">GOLD CARD</h3>-->
                             <!--   <p></p><p>This Gold Card have the Capability of NFC with fine gold of 22krt"</p>-->
                             <!--   <p></p>-->
                             <!--    <h2><span><b>PRICE: </b></span><b>₹5000/-</b> <span>MRP: </span>₹ <del>12999</del>/- </h2>-->
                             <!--<h4>Features:</h4>-->
                             <!--</div>-->
                             
                             <div class="details_smart">
                                <h3 class="text-center">PREMIUM CARD</h3>
                                <p></p><p>This Card have the Capability of NFC with Premium Card"</p>
                                <p></p>
                                 <h5><span><b>PRICE: </b></span><b>₹2999/-</b> <span>MRP: </span>₹ <del>12999</del>/- </h5>
                             <h4>Features:</h4>
                             </div>
                             
                             <ul style="color:rgb(102, 102, 102);">
                                <li> Theme Change in One Click</li>
                                <li>Profile locking System</li>
                                <li>Icons Management</li>
                                <li>Clients Showcase in Profile</li>
                                <li> Blogging System in Profile</li>
                                <li>Pricing and plans</li>
                                <li>Get Product Enquiry to Get New</li>
                                <li>Clients and Sales</li>
                                <li>One Click Catalogue Generator of Uploaded Products or Services</li>
                                <li>Google Maps Showcase for Store or Office.</li>
                                <li>One Touch Menu Bar for Easy Navigation</li>
                                <li>Clients and Sales</li>
                            </ul>
                            <div class="price__btn" style="margin: 20px 82px 0px 82px;">
                                <a href="{{ url('/Product') }}" class="cmn--btn border__btn" style="width: 100%;text-align: center;">
                                    <span>
                                      Buy Now
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="icon" style="width:100%; height:100%">
                                <img src="{{url('uploads/Pricing_Plans/gold-card.png')}}" alt="Product Image" style="width: 55% !important;display: block !important;margin: 0 auto !important;">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                
                
                
                
                 
            </section>
    <!-- Pricing section end here -->  
    
    <!-- Project Counter Here -->
     <!--<section class="project__count bg__white pt-120 pb-120">-->
         
    <section class="project__count bg__white pt__60 pb__60">
        <!--wrapper-->
        <div class="project__count__wrap">
            <!--container-->
            <div class="container">
                <!--project-head-->
                <div class="project__head">
                    <div class="section__header section__center pb__60">
                        <h2 class="wow fadeInUp" data-wow-duration="1.1s">
                            We have successfully completed <span class="basecon">3k+</span> projects annually and counting
                        </h2>
                        <p class="wow fadeInUp" data-wow-duration="1.4s">
                            AI is the broader concept of machines being able to carry out tasks in a way that would normally
                            require human intelligence.
                        </p>
                    </div>
                </div>
                <!--project-head-->
                <div class="row g-5 justify-content-center align-items-center">
                    <!--col grid-->
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="project__count__items">
                            <div class="icon wow fadeInUp" data-wow-duration="1s">
                                <i class="material-symbols-outlined">
                                    manage_accounts
                                </i>
                            </div>
                            <div class="counter__items odometer-item wow fadeInDown" data-wow-duration="2s">
                                <div class="counter__content">
                                    <div class="cont d-flex align-items-center">
                                        <span class="odometer" data-odometer-final="3.6">
                                            0
                                        </span>
                                        <span class="plus__icon">
                                            k
                                        </span>
                                    </div>
                                </div>
                                <p>Completed Projects</p>
                            </div>
                        </div>
                    </div>
                    <!--col grid-->
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="project__count__items wow fadeInUp" data-wow-duration="1s">
                            <div class="icon icon2">
                                <i class="material-symbols-outlined">
                                    thumb_up
                                </i>
                            </div>
                            <div class="counter__items counter__items2 odometer-item wow fadeInDown"
                                data-wow-duration="2s">
                                <div class="counter__content">
                                    <div class="cont d-flex align-items-center">
                                        <span class="odometer" data-odometer-final="2.7">
                                            0
                                        </span>
                                        <span class="plus__icon">
                                            k
                                        </span>
                                    </div>
                                </div>
                                <p>Customer Satisfaction</p>
                            </div>
                        </div>
                    </div>
                    <!--col grid-->
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="project__count__items">
                            <div class="icon icon3 wow fadeInUp" data-wow-duration="1s">
                                <i class="material-symbols-outlined">
                                    group
                                </i>
                            </div>
                            <div class="counter__items counter__items3 odometer-item wow fadeInDown"
                                data-wow-duration="2s">
                                <div class="counter__content">
                                    <div class="cont d-flex align-items-center">
                                        <span class="odometer" data-odometer-final="457">
                                            0
                                        </span>
                                        <span class="plus__icon">
                                            +
                                        </span>
                                    </div>
                                </div>
                                <p>Expert Employees</p>
                            </div>
                        </div>
                    </div>
                    <!--col grid-->
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="project__count__items">
                            <div class="icon icon4 wow fadeInUp" data-wow-duration="1s">
                                <i class="material-symbols-outlined">
                                    military_tech
                                </i>
                            </div>
                            <div class="counter__items counter__items4 odometer-item wow fadeInDown"
                                data-wow-duration="2s">
                                <div class="counter__content">
                                    <div class="cont d-flex align-items-center">
                                        <span class="odometer" data-odometer-final="78">
                                            0
                                        </span>
                                        <span class="plus__icon">
                                            +
                                        </span>
                                    </div>
                                </div>
                                <p>Awards Won</p>
                            </div>
                        </div>
                    </div>
                    <!--col grid-->
                    <div class="col-xxl-6">
                        <div class="project__qustion wow fadeInUp" data-wow-duration="2s">
                            <div class="project__qustion__left">
                                <h5>
                                    Have any question about us?
                                </h5>
                                <p>
                                    Don't hesitate to contact us.
                                </p>
                            </div>
                            <div class="project__qustion__right">
                                <a href="{{ url('/contact') }}" class="cmn--btn">
                                    <span>
                                        Contact us
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--col grid-->
                </div>
            </div>
            <!--container-->

            <!--porject efect-->
            <div class="project__map">
                <img src="{{ url('frontend/assets/img/elements/map.png') }}" alt="img">
            </div>
            <!--porject efect-->
        </div>
        <!--wrapper-->
    </section>
    <!-- Project Counter End -->
     
    <!-- real world Here -->
    <!--<section class="real__world bgsection pt-120 pb-120">-->
        
    <section class="real__world bgsection pt__60 pb__60">
        <!--container-->
        <div class="container">
            <!--real head-->
            <div class="project__head">
                <div class="section__header section__center pb__60 wow fadeInUp" data-wow-duration="2s">
                    <h2>
                        Real-world examples of our unique capabilities
                    </h2>
                    <p>
                        AI is the broader concept of machines being able to carry out tasks in a way that would normally
                        require human intelligence.
                    </p>
                </div>
            </div>
            <!--real head-->
            <div class="row g-4 justify-content-center align-items-center">
                <!--col grid-->
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="2s">
                    <div class="realworld__items">
                        <div class="thumb">
                            <img src="{{ url('frontend/assets/img/bog-capabilities/re1.jpg') }}" alt="img">
                            <a href="https://www.youtube.com/watch?v=TKNNXMq4J3U" class="play__btn video-btn">
                                <i class="material-symbols-outlined">
                                    play_arrow
                                </i>
                            </a>
                        </div>
                        <div class="content">
                            <h6>
                                Technology
                            </h6>
                            <h4>
                                <a href="{{ url ('/blog-list') }}">
                                    AI Antibiotics
                                </a>
                            </h4>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                            </p>
                            <a href="{{ url ('/blog-list') }}" class="real__btn">
                                <span>
                                    Read More
                                </span>
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        arrow_right_alt
                                    </i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="2.1s">
                    <div class="realworld__items">
                        <div class="thumb">
                            <img src="{{ url('frontend/assets/img/bog-capabilities/re2.jpg') }}" alt="img">
                            <a href="https://www.youtube.com/watch?v=TKNNXMq4J3U" class="play__btn video-btn">
                                <i class="material-symbols-outlined">
                                    play_arrow
                                </i>
                            </a>
                        </div>
                        <div class="content">
                            <h6>
                                Technology
                            </h6>
                            <h4>
                                <a href="{{ url ('/blog-list') }}">
                                    Classifying listing AI photos
                                </a>
                            </h4>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                            </p>
                            <a href="{{ url ('/blog-list') }}" class="real__btn">
                                <span>
                                    Read More
                                </span>
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        arrow_right_alt
                                    </i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="2.2s">
                    <div class="realworld__items">
                        <div class="thumb">
                            <img src="{{ url('frontend/assets/img/bog-capabilities/re3.jpg') }}" alt="img">
                            <a href="https://www.youtube.com/watch?v=TKNNXMq4J3U" class="play__btn video-btn">
                                <i class="material-symbols-outlined">
                                    play_arrow
                                </i>
                            </a>
                        </div>
                        <div class="content">
                            <h6>
                                Technology
                            </h6>
                            <h4>
                                <a href="{{ url ('/blog-list') }}">
                                    Industry Labor Machine
                                </a>
                            </h4>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                            </p>
                            <a href="{{ url ('/blog-list') }}" class="real__btn">
                                <span>
                                    Read More
                                </span>
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        arrow_right_alt
                                    </i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="2.3s">
                    <div class="realworld__items">
                        <div class="thumb">
                            <img src="{{ url('frontend/assets/img/bog-capabilities/re4.jpg') }}" alt="img">
                            <a href="https://www.youtube.com/watch?v=TKNNXMq4J3U" class="play__btn video-btn">
                                <i class="material-symbols-outlined">
                                    play_arrow
                                </i>
                            </a>
                        </div>
                        <div class="content">
                            <h6>
                                Technology
                            </h6>
                            <h4>
                                <a href="{{ url ('/blog-list') }}">
                                    Education AI Studies
                                </a>
                            </h4>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                            </p>
                            <a href="{{ url ('/blog-list') }}" class="real__btn">
                                <span>
                                    Read More
                                </span>
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        arrow_right_alt
                                    </i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="2.5s">
                    <div class="realworld__items">
                        <div class="thumb">
                            <img src="{{ url('frontend/assets/img/bog-capabilities/re5.jpg') }}" alt="img">
                            <a href="https://www.youtube.com/watch?v=TKNNXMq4J3U" class="play__btn video-btn">
                                <i class="material-symbols-outlined">
                                    play_arrow
                                </i>
                            </a>
                        </div>
                        <div class="content">
                            <h6>
                                Technology
                            </h6>
                            <h4>
                                <a href="{{ url ('/blog-list') }}">
                                    Army Defence AI & ML
                                </a>
                            </h4>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                            </p>
                            <a href="{{ url ('/blog-list') }}" class="real__btn">
                                <span>
                                    Read More
                                </span>
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        arrow_right_alt
                                    </i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="2.8s">
                    <div class="realworld__items">
                        <div class="thumb">
                            <img src="{{ url('frontend/assets/img/bog-capabilities/re6.jpg') }}" alt="img">
                            <a href="https://www.youtube.com/watch?v=TKNNXMq4J3U" class="play__btn video-btn">
                                <i class="material-symbols-outlined">
                                    play_arrow
                                </i>
                            </a>
                        </div>
                        <div class="content">
                            <h6>
                                Technology
                            </h6>
                            <h4>
                                <a href="{{ url ('/blog-list') }}">
                                    ICT AI Performance
                                </a>
                            </h4>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                            </p>
                            <a href="{{ url ('/blog-list') }}" class="real__btn">
                                <span>
                                    Read More
                                </span>
                                <span class="icon">
                                    <i class="material-symbols-outlined">
                                        arrow_right_alt
                                    </i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--col grid-->
            </div>
            <!--case Studies-->
            <div class="case__btn mt-4 wow fadeInUp" data-wow-duration="0.9s">
                <a href="{{ url('/blog-list') }}" class="cmn--btn">
                    <span>
                        See All Article
                    </span>
                </a>
            </div>
            <!--case Studies-->
        </div>
        <!--container-->

        <!--element-->
        <div class="include__elements">
            <img src="{{ url('frontend/assets/img/elements/include-element.png') }}" alt="include">
        </div>
        <div class="include__blumb">
            <img src="{{ url('frontend/assets/img/elements/blumb.png') }}" alt="include">
        </div>
        <div class="include__blumb2">
            <img src="{{ url('frontend/assets/img/elements/blumb.png') }}" alt="include">
        </div>
        <div class="include__real">
            <img src="{{ url('frontend/assets/img/elements/real.png') }}" alt="include">
        </div>
        <!--element-->
    </section>
    <!-- real world End -->

    <!-- Plan Here -->
    <!--<section class="plan__section plan__section__two bg__white pt-120 pb-120">-->
        
    <!--<section class="plan__section plan__section__two bg__white pt__60 pb__60">-->
        <!--container-->
    <!--    <div class="container">-->
            <!--real head-->
    <!--        <div class="project__head wow fadeInUp" data-wow-duration="2s">-->
    <!--            <div class="section__header section__center pb__40">-->
    <!--                <h2>-->
    <!--                    Pricing Information-->
    <!--                </h2>-->
    <!--                <p>-->
    <!--                    AI is the broader concept of machines being able to carry out tasks in a way that would normally-->
    <!--                    require human intelligence.-->
    <!--                </p>-->
    <!--            </div>-->
    <!--        </div>-->
            <!--real head-->
            <!--pricing save-->
            <!--<div class="plan__save pb__60">
                <span class="month">-->
    <!--                Monthly-->
    <!--            </span>-->
    <!--            <div class="yearly__bar form-switch">-->
    <!--                <input class="form-check-input" type="checkbox" id="chid">-->
    <!--            </div>-->
    <!--            <h5>-->
    <!--                Yearly <span>(Save 30%)</span>-->
    <!--            </h5>-->
    <!--        </div>-->
            <!--pricing save-->
    <!--        <div class="row g-4 justify-content-center">-->
                <!--col grid-->
    <!--            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="2.1">-->
    <!--                <div class="plan__items plan__items__two">-->
    <!--                    <div class="plan__valu__left">-->
    <!--                        <div class="prices__area">-->
    <!--                            <div class="icon" style="width:100%;height: 100%;">-->
                                    <!--<i class="material-symbols-outlined">-->
                                    <!--    add_business-->
                                    <!--</i>-->
    <!--                                <img src="{{url('uploads/Pricing_Plans/business-card.png')}}" alt="Product Image" style="width: 100% !important;margin: 0 auto !important;">-->

    <!--                            </div>-->
    <!--                              <h4 style="font-size:21px;">-->
    <!--                                BUSINESS CARD-->
    <!--                            </h4>-->
    <!--                            <h3>-->
    <!--                                <span class="price__wrap">-->
    <!--                                    <del>₹3500</del>-->
    <!--                                    <span class="price" style="color: rgb(69, 47, 244);">₹999</span>-->
    <!--                                </span>-->
    <!--                            </h3>-->
                                <!--<h6>-->
                                <!--    /15 days-->
                                <!--</h6>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="content__wrap">-->
    <!--                        <ul class="plan__list">-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Smart Profile-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    CRM System -->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Support-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                     <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                   QR Code-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                     <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    1 Years Warranty-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                     <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Social Links at Single Platform-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Easy Connectivity -->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Many more-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                        </ul>-->
    <!--                        <div class="price__btn">-->
    <!--                            <a href="{{ url('/Product') }}" class="cmn--btn border__btn">-->
    <!--                                <span>-->
    <!--                                  Buy Now-->
    <!--                                </span>-->
    <!--                            </a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--col grid-->
    <!--            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="2.4">-->
    <!--                <div class="plan__items plan__items__two plan__items__two1">-->
    <!--                    <div class="plan__valu__left">-->
    <!--                        <div class="prices__area">-->
    <!--                            <div class="icon" style="width:100%; height:100%;">-->
                                    <!--<i class="material-symbols-outlined">-->
                                    <!--    redeem-->
                                    <!--</i>-->
    <!--                                <img src="{{url('uploads/Pricing_Plans/business-card.png')}}" alt="Product Image" style="width: 100% !important;margin: 0 auto !important;">-->

    <!--                            </div>-->
    <!--                            <h4 style="font-size:21px;">-->
    <!--                                PROFESSIONAL CARD-->
    <!--                            </h4>-->
    <!--                            <h3>-->
    <!--                                <span class="price__wrap">-->
    <!--                                    <del>₹12999</del>-->
    <!--                                    <span class="price" style="color: rgb(69, 47, 244);">₹4999</span>-->
    <!--                                </span>-->
    <!--                            </h3>-->
                              
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="content__wrap">-->
    <!--                        <ul class="plan__list">-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                     Smart Profile -->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Support-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    QR Code-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                     1 Years Warranty-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    User Panel -->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Social Links at Single Platform-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                   <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Easy Connectivity -->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Many more-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                        </ul>-->
    <!--                        <div class="price__btn">-->
    <!--                            <a href="{{ url('/Product') }}" class="cmn--btn border__btn">-->
    <!--                                <span>-->
    <!--                                    Buy Now-->
    <!--                                </span>-->
    <!--                            </a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--col grid-->
    <!--            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="2.7">-->
    <!--                <div class="plan__items plan__items__two plan__items__two2">-->
    <!--                    <div class="plan__valu__left">-->
    <!--                        <div class="prices__area">-->
    <!--                            <div class="icon" style="width:100%; height:100%">-->
                                    <!--<i class="material-symbols-outlined">-->
                                    <!--    add_business-->
                                    <!--</i>-->
    <!--                                <img src="{{url('uploads/Pricing_Plans/gold-card.png')}}" alt="Product Image" style="width: 100% !important;margin: 0 auto !important;">-->

    <!--                            </div>-->
    <!--                            <h4 style="font-size:21px;">-->
    <!--                                GOLD CARD-->
    <!--                            </h4>-->
    <!--                            <h3>-->
    <!--                                <span class="price__wrap">-->
    <!--                                    <del>₹12000</del>-->
    <!--                                    <span class="price" style="color: rgb(69, 47, 244);">₹4999</span>-->
    <!--                                </span>-->
    <!--                            </h3>-->
                                
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="content__wrap">-->
    <!--                        <ul class="plan__list">-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Smart Profile -->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Support-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                     QR Code-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    1 Years Warranty-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                     User Panel -->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                     Social Links at Single Platform-->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                     Easy Connectivity -->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <span class="icon">-->
    <!--                                    <i class="material-symbols-outlined">-->
    <!--                                        task_alt-->
    <!--                                    </i>-->
    <!--                                </span>-->
    <!--                                <span>-->
    <!--                                    Many more -->
    <!--                                </span>-->
    <!--                            </li>-->
    <!--                        </ul>-->
    <!--                        <div class="price__btn">-->
    <!--                            <a href="{{ url('/Product') }}" class="cmn--btn border__btn">-->
    <!--                                <span>-->
    <!--                                    Buy Now-->
    <!--                                </span>-->
    <!--                            </a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--col grid-->
    <!--        </div>-->
    <!--    </div>-->
        <!--container-->
        <!--elements-->
    <!--    <div class="plan__ball">-->
    <!--        <img src="{{ url('frontend/assets/img/elements/real.png') }}" alt="rocket">-->
    <!--    </div>-->
    <!--    <div class="light__threed">-->
    <!--        <img src="{{ url('frontend/assets/img/elements/null-dimond.png') }}" alt="img">-->
    <!--    </div>-->
    <!--    <div class="light__element2">-->
    <!--        <img src="{{ url('frontend/assets/img/elements/blumb.png') }}" alt="light">-->
    <!--    </div>-->
        <!--elements-->
    <!--</section>-->
    <!-- Plan End -->

    <!-- efective Here -->
    <!--<section class="efective__section efective__system__section bgsection pt-120 pb-120">-->
    
    <section class="efective__section efective__system__section bgsection pt__60 pb__60">
        <!--container-->
        <div class="container">
            <div class="row justify-content-between">
                <!--col grid-->
                <div class="col-xl-6 col-lg-7">
                    <div class="efective__content efective__data__system">
                        <div class="section__header pb__32 wow fadeInUp" data-wow-duration="2s">
                            <h2>
                                Detailed Guide on How the System Works and Operates
                            </h2>
                            <p>
                                The ease of sharing and convenience of NFC business cards streamlines the networking process, allowing professionals to focus on meaningful conversations and connections.
                            </p>
                        </div>
                        <div class="efective__data__wrapper">
                            <div class="row g-3">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 wow fadeInUp"
                                    data-wow-duration="2.1s">
                                    <div class="efect__data__iems d-grid">
                                        <div class="icons">
                                            <img src="{{ url('frontend/assets/img/efective/braindata.png') }}"
                                                alt="icon">
                                        </div>
                                        <div class="content">
                                            <h5>
                                                Data Generated
                                            </h5>
                                            <p>
                                                NFC Cards Generate Data and Give that data an Actual Platform to Run.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 wow fadeInUp"
                                    data-wow-duration="2.4s">
                                    <div class="efect__data__iems d-grid">
                                        <div class="icons icons2">
                                            <img src="{{ url('frontend/assets/img/efective/datastored.png') }}"
                                                alt="icon">
                                        </div>
                                        <div class="content">
                                            <h5>
                                                Data Stored
                                            </h5>
                                            <p>
                                                It also Stores Data like Profile, Images, Videos etc.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 wow fadeInUp"
                                    data-wow-duration="2.6s">
                                    <div class="efect__data__iems d-grid">
                                        <div class="icons icons3">
                                            <img src="{{ url('frontend/assets/img/efective/dataprocessing.png') }}"
                                                alt="icon">
                                        </div>
                                        <div class="content">
                                            <h5>
                                                Data Processing
                                            </h5>
                                            <p>
                                                Our Cards Always Process Data First Before Showing it.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 wow fadeInUp"
                                    data-wow-duration="2.8s">
                                    <div class="efect__data__iems d-grid">
                                        <div class="icons icons4">
                                            <img src="{{ url('frontend/assets/img/efective/actionable.png') }}"
                                                alt="icon">
                                        </div>
                                        <div class="content">
                                            <h5>
                                                Actionable Insights
                                            </h5>
                                            <p>
                                                With the Powerful CRM, You can Check Your Insights.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xl-5 col-lg-5 col-md-12">
                    <div class="efective__system">
                        <img src="{{ url('frontend/assets/img/efective/efectsystem.png') }}" alt="efective">
                    </div>
                </div>
                <!--col grid-->
            </div>
        </div>
        <!--container-->
        <!--elements-->
        <div class="efect__element1">
            <img src="{{ url('frontend/assets/img/elements/efect-ball.png') }}" alt="img">
        </div>
        <div class="efect__three">
            <img src="{{ url('frontend/assets/img/elements/3dround.png') }}" alt="img">
        </div>
        <div class="efect__rount">
            <img src="{{ url('frontend/assets/img/elements/efect-rount.png') }}" alt="img">
        </div>
        <div class="efect__cross">
            <img src="{{ url('frontend/assets/img/elements/efect-cross2.png') }}" alt="img">
        </div>
        <!--elements-->
    </section>
    <!-- efective End -->

    <!-- Testimonial Here -->
    <!--<section class="testimonial__section bg__white pt-120 pb-120">-->
        
    <section class="testimonial__section bg__white pt__60 pb__60">
        <!--contaienr-->
        <div class="container">
            <div class="row justify-content-between align-items-center flex-row-reverse">
                <!--col grid-->
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="testimonial__content testimonial__content__two">
                        <div class="section__header mb-2 wow fadeInUp" data-wow-duration="2s">
                            <h2>
                                User experience reports on support and services
                            </h2>
                            <p>
                                AI is the broader concept of machines being able to perform tasks that would normally
                                require human intelligence, such as visual perception, speech recognition, and language
                                translation.
                            </p>
                        </div>
                        <div class="testimonial__wrap__two owl-theme owl-carousel">
                            <div class="testimonial__items">
                                <div class="star__grp">
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star_half
                                    </i>
                                </div>
                                <p>
                                    Our company has seen significant improvement in efficiency and accuracy since
                                    implementing AI and ML technology in our processes...
                                </p>
                                <div class="client__wrap">
                                    <div class="thumb">
                                        <img src="{{ url('frontend/assets/img/testimonial/devon.png') }}" alt="img">
                                    </div>
                                    <div class="content">
                                        <h5>
                                            Devon Lane
                                        </h5>
                                        <span class="designation">
                                            Louis Vuitton
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial__items titems__two">
                                <div class="star__grp">
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star_half
                                    </i>
                                </div>
                                <p>
                                    Our company has seen significant improvement in efficiency and accuracy since
                                    implementing AI and ML technology in our processes...
                                </p>
                                <div class="client__wrap">
                                    <div class="thumb">
                                        <img src="{{ url('frontend/assets/img/testimonial/devon.png') }}" alt="img">
                                    </div>
                                    <div class="content">
                                        <h5>
                                            Devon Lane
                                        </h5>
                                        <span class="designation">
                                            Louis Vuitton
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial__items">
                                <div class="star__grp">
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star_half
                                    </i>
                                </div>
                                <p>
                                    Our company has seen significant improvement in efficiency and accuracy since
                                    implementing AI and ML technology in our processes...
                                </p>
                                <div class="client__wrap">
                                    <div class="thumb">
                                        <img src="{{ url('frontend/assets/img/testimonial/devon.png') }}" alt="img">
                                    </div>
                                    <div class="content">
                                        <h5>
                                            Devon Lane
                                        </h5>
                                        <span class="designation">
                                            Louis Vuitton
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial__items">
                                <div class="star__grp">
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star
                                    </i>
                                    <i class="material-symbols-outlined">
                                        star_half
                                    </i>
                                </div>
                                <p>
                                    Our company has seen significant improvement in efficiency and accuracy since
                                    implementing AI and ML technology in our processes...
                                </p>
                                <div class="client__wrap">
                                    <div class="thumb">
                                        <img src="{{ url('frontend/assets/img/testimonial/devon.png') }}" alt="img">
                                    </div>
                                    <div class="content">
                                        <h5>
                                            Devon Lane
                                        </h5>
                                        <span class="designation">
                                            Louis Vuitton
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xxl-6 col-lg-6 col-md-10 col-sm-12">
                    <div class="testimonial__thumb__two">
                        <img src="{{ url('frontend/assets/img/testimonial/testimonial2.png') }}" alt="client">
                    </div>
                </div>
                <!--col grid-->
            </div>
        </div>
        <!--contaienr-->
    </section>
    <!-- Testimonial End -->

    <!-- Faq Here -->
    <!--<section class="faq__section bgsection pt-120 pb-120">-->
        
    <section class="faq__section bgsection pt__60 pb__60">
        <!--container-->
        <div class="container">
            <!--accordion head-->
            <div class="section__header section__center pb__60 wow fadeInUp" data-wow-duration="2s">
                <h2>
                    Simplifying Your Information Search with FAQs
                </h2>
                <p>
                    Artificial intelligence, or AI, is the simulation of human intelligence in machines that are programmed
                    to think and learn...
                </p>
            </div>
            <!--accordion head-->
            <div class="row justify-content-between align-items-center">
                <!--col grid-->
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="accordion__wrap">
                        <div class="accordion" id="accordionExample">
                            <!--Accordion items-->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        What is smart card?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Business card is the product of Fastap which is based upon NFC technology
                                            (Near field Communication) and embedded with NFC Chip. It can be used by any
                                            person for sharing his details through tapping or scanning. Basically, Smart
                                            Card is for Smart Person.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--Accordion items-->
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        What is NFC digital card?
                                    </button>
                                </h3>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            NFC digital card is a card that contains NFC Chip in it and based on NFC
                                            technology through which you can share your details by just in single tap.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--Accordion items-->
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        How Does Smart Card Works?
                                    </button>
                                </h3>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Just Tap or Scan QR Code Which is printed on Smart Card with your Smart
                                            Phone and share details Smartly.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--Accordion items-->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree4">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree4"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Whether Smart Card works in Android or iPhone?
                                    </button>
                                </h2>
                                <div id="collapseThree4" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree4" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Smart Card Works on both android and iPhone.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--Accordion items-->
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree44">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree44"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        What is Professional Card?
                                    </button>
                                </h3>
                                <div id="collapseThree44" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree44" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            It is another Product of Fastap. It Works same as Smart Card but it is
                                            for the Professional Persons, like Doctors, Lawyers.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--Accordion items-->
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree45">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree45"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Should the Person who will receive my contact information or my profile need to
                                        Install Fastap App?
                                    </button>
                                </h3>
                                <div id="collapseThree45" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree45" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            No, it is not necessarily be needed that another person should install
                                            Fastap App.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--Accordion items-->
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree46">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree46"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Why we need Fastap App?
                                    </button>
                                </h3>
                                <div id="collapseThree46" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree46" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            To activate your Card you need App Moreover you can edit your profile though
                                            App , can purchase another card directly from App . It’s Just easier way.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--Accordion items-->
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree47">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree47"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        What Unique thing Fastap is providing ?
                                    </button>
                                </h3>
                                <div id="collapseThree47" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree47" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            Fastap is Providing you to generate your digital and Smart
                                            Profiles Webpage Which Contains your Information ,It Gives you the Platform
                                            to get Exposure You can save , share, Modify , Update your profile in single
                                            button.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--Accordion items-->
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree48">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree48"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        What will I get from Fastap Card ?
                                    </button>
                                </h3>
                                <div id="collapseThree48" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree48" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>
                                            You will get your Exposure and it is the smart way to introduce yourself .
                                        </p>
                                    </div>
                                </div>
                            </div>
                             <!--Accordion items-->
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xxl-5 col-xl-6 col-lg-6">
                    <div class="accordion__thumb">
                        <img src="{{ url('frontend/assets/img/faq/faq2.png') }}" alt="img">
                        <div class="qustion">
                            <img src="{{ url('frontend/assets/img/faq/faqqustion2.png') }}" alt="qustion">
                        </div>
                    </div>
                </div>
                <!--col grid-->
            </div>
        </div>
        <!--container-->
    </section>
    <!-- Faq End -->

    <!-- Newsletter Here -->
    <section class="newsletter__section bg__white">
        <!--container-->
        <div class="container">
            <!--newsletter wrapper-->
            <div class="newsletter__wrapper pt-120 pb-120 wow fadeInUp" data-wow-duration="2s">
                <div class="row justify-content-center">
                    <!--col grid-->
                    <div class="col-xl-6 col-lg-6">
                        <div class="newsletter__content">
                            <div class="section__header section__center">
                                <h2>
                                    Join Our Community
                                </h2>
                                <p>
                                    We are trusted by over 5000+ clients. Join them by using our services and grow your
                                    business.
                                </p>
                            </div>
                            <div class="join__btn">
                                <a href="{{ url('/Contact-Us') }}" class="cmn--btn">
                                    <span>Join us</span>
                                </a>
                            </div>
                            <!--map mast-->
                            <div class="map__mask">
                                <img src="{{ url('frontend/assets/img/elements/map.png') }}" alt="ma--mask">
                            </div>
                            <!--map mast-->
                        </div>
                    </div>
                    <!--col grid-->
                </div>
            </div>
            <!--newsletter wrapper-->
        </div>
        <!--container-->
        <!--efect Element-->
        <div class="social__element1">
            <img src="{{ url('frontend/assets/img/elements/facebook-element.png') }}" alt="img">
        </div>
        <div class="social__element1repet">
            <img src="{{ url('frontend/assets/img/elements/facebook-element.png') }}" alt="img">
        </div>
        <div class="social__element2">
            <img src="{{ url('frontend/assets/img/elements/3dots-elements.png') }}" alt="img">
        </div>
        <div class="social__element3">
            <img src="{{ url('frontend/assets/img/elements/pinter-elements.png') }}" alt="img">
        </div>
        <div class="social__element4">
            <img src="{{ url('frontend/assets/img/elements/bell-elements.png') }}" alt="img">
        </div>
        <div class="social__element5">
            <img src="{{ url('frontend/assets/img/elements/swith-elements.png') }}" alt="img">
        </div>
        <!--efect Element-->
    </section>
    <!-- Newsletter End -->
    
<!-- anand end code fastapp theme--> 
    
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@if ($message = Session::get('message_subscribers'))
      <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          Toast.fire({
            icon: 'success',
            title: '<h6>Subscribers SuccessFull</h6>'
          })
</script>
@endif

    
    
    <!--=================================-->
@endsection