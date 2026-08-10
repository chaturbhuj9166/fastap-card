 @extends('layouts.app')
@section('content')

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
                  
                </div>
            </div>
        </div>
        <!--Container-->
        <!--Elements-->
        
        <!--Elements-->
    </section>
    <section class="about__section about__section__two bg__white pt__60 pb__60">
        <!--Container-->
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <!--about content-->
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="about__content">
                        <div class="section__header">
                            <h3 class="wow fadeInUp text-center text-danger" data-wow-duration="2s" style="color: var(--themetext);">
                               "You're Not Registered. Please Register or Enter a Valid Link"<br>
                               <span><a href="signin" style="color:blue">Regitser Now</a></span>
                              
                            </h3>
                            
                            
                        </div>

                    </div>
                </div>
                <!--about content-->
                <div class="col-xxl-1 col-xl-1 col-lg-1"></div>
                <!--about thumb-->
                <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-9 col-sm-9" style="margin-top: 37%;">
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

@endsection