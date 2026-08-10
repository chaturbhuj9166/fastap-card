@extends('layouts.app')
@section('content')

    <!-- Banner Here -->
    <section class="banner__section breadcumnd__banner bannerbg">
        <!--Mask-->
        <div class="banner__bgmask">
            <img src="{{ url('frontend/assets/img/elements/box-element.png') }}" alt="mask">
        </div>
        <!--Mask-->
        <!--Container-->
        <div class="container">
            <div class="breadcumnd__wrapper">
                <div class="row g-4  justify-content-between align-items-end">
                    <!--col-->
                    <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-8">
                        <div class="breadcumnd__content">
                            <h1 class="title">
                                Faq's
                            </h1>
                            <ul class="breadcumnd__list">
                                <li>
                                    <a href="{{ url('/') }}">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <span class="icon">
                                        <i class="material-symbols-outlined">
                                            chevron_right
                                        </i>
                                    </span>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        Pages
                                    </a>
                                </li>
                                <li>
                                    <span class="icon">
                                        <i class="material-symbols-outlined">
                                            chevron_right
                                        </i>
                                    </span>
                                </li>
                                <li class="sucess">
                                    Faq's
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--col-->
                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-8">
                        <div class="breadcumnd__thumb">
                            <img src="{{ url('frontend/assets/img/banner/breadcumnd.png') }}" alt="bread">
                        </div>
                    </div>
                    <!--col-->
                </div>
                <!--ai text-->
                <div class="bread__ai">
                    <img src="{{ url('frontend/assets/img/elements/t-element.png') }}" alt="img">
                </div>
                <!--ai text-->
            </div>
        </div>
        <!--Container-->
    </section>
    <!-- Banner End -->

    <!-- Faq Here -->
    
    <!--<section class="faq__section__four bg__white pt-120 pb-120">-->
        
    <section class="faq__section__four bg__white pt__60 pb__60">
        <!--container-->
        <div class="container">
            <div class="row justify-content-between">
                <!--col grid-->
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="common__item">
                        <div class="service__link__wrap">
                            <a href="javacript:void(0)" style="background: #3FCA90;">
                                <span class="icon">
                                    <img src="{{ url('frontend/assets/img/svg-icon/iai.svg') }}" alt="img">
                                </span>
                                <span style=" color: red;font-weight: bold;">
                                    Questions?
                                </span>

                            </a>
                            <a href="javacript:void(0)">
                                {{-- <span class="icon">
                                    <img src="{{ url('frontend/assets/img/svg-icon/imac.svg') }}" alt="img">
                                </span> --}}
                                <span>
                                    Fast App is the leading Digital NFC Business Card Platform for Companies and individuals. With our best in class Services, You can Manage Your Profile Very Easily, Also we are the complete end-to-end solution in this Industry.
                                </span>
                            </a>
                            <a href="javacript:void(0)">
                                {{-- <span class="icon">
                                    <img src="{{ url('frontend/assets/img/svg-icon/ivar.svg') }}" alt="img">
                                </span> --}}
                                <span>
                                    With our 24/7 customer support and largest user base in India, you will get the full power NFC Technology. So Buckle-up and Get Ready for the Experience.
                                </span>
                            </a>
                            <a href="javacript:void(0)">
                                <span class="icon">
                                    <img src="{{ url('frontend/assets/img/svg-icon/clo.svg') }}" alt="img">
                                </span>
                                <span>
                                    24/7 Customer Services with Our Top Experts.
                                </span>
                            </a>
                            <a href="javacript:void(0)">
                                <span class="icon">
                                    <img src="{{ url('frontend/assets/img/svg-icon/ana.svg') }}" alt="img">
                                </span>
                                <span>
                                    Custom Profile and it's User Panel for Great Experience
                                </span>
                            </a>
                            <a href="javacript:void(0)">
                                <span class="icon">
                                    <img src="{{ url('frontend/assets/img/svg-icon/iphy.svg') }}" alt="img">
                                </span>
                                <span>
                                    Instantly share your info with a tap, scan, or send.
                                </span>
                            </a>
                            <a href="javacript:void(0)">
                                <span class="icon">
                                    <img src="{{ url('frontend/assets/img/svg-icon/iaph.svg') }}" alt="img">
                                </span>
                                <span>
                                    Fastap is the fastest way to Manage Your Complete Profile.
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--col grid-->
                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="main__accordion__content">
                        <div class="accordion__wrap">
                            <div class="accordion" id="accordionExample">
                                
                                <!--Accordion items-->
                                <?php $i=0;?>
                                 @foreach($show_info as $key=>$value)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{$key}}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                                {{$value->name}}
                                            </button>
                                        </h2>
                                        <div id="collapse{{$key}}" class="accordion-collapse collapse"
                                            aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>
                                                    {{$value->description}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                 @endforeach    

                            </div>
                        </div>

                    </div>
                </div>
                <!--col grid-->
            </div>
        </div>
        <!--container-->
    </section>
    <!-- Faq End -->
            
    @endsection