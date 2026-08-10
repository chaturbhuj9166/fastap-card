@extends('layouts.about.app')
@section('content')
<!-- Banner Here -->
<section class="banner__section breadcumnd__banner bannerbg">
   <!--Mask-->
   <div class="banner__bgmask">
      <img src="{{url ('frontend/assets/img/elements/box-element.png')}}" alt="mask">
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
                     About us
                  </h1>
                  <ul class="breadcumnd__list">
                     <li>
                        <a href="{{url ('/')}}">
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
                     <li>
                        <a href="{{url ('/About-Us')}}">
                           About us
                        </a>
                     </li>
                     <li>

                  </ul>
               </div>
            </div>
            <!--col-->
            <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-8">
               <div class="breadcumnd__thumb">
                  <img src="{{url ('frontend/assets/img/banner/breadcumnd.png')}}" alt="bread">
               </div>
            </div>
            <!--col-->
         </div>
         <!--ai text-->
         <div class="bread__ai">
            <img src="{{url ('frontend/assets/img/elements/t-element.png')}}" alt="img">
         </div>
         <!--ai text-->
      </div>
   </div>
   <!--Container-->
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
                  <h2>
                    We Offer a Wide Range of Digital NFC Cards for Your Resume and for your Business Details.
                  </h2>
                  <p>
                     Artificial intelligence (AI) is perceiving, synthesizing, and inferring information—demonstrated by , as opposed to intelligence displayed by n and . Example tasks in which this is done include speech recognition,
                     computer vision, translation between (natural) languages, as well as other mappings of inputs. The  of defines artificial intelligence as:
                  </p>
               </div>
               <!--<div class="progress__wrap">-->
               <!--   <div class="pro__items">-->
               <!--      <div class="pro__head">-->
               <!--         <span class="title">-->
               <!--            Customer satisfaction-->
               <!--         </span>-->
               <!--         <span class="point">-->
               <!--            80%-->
               <!--         </span>-->
               <!--      </div>-->
               <!--      <div class="progress">-->
               <!--         <div class="progress-value"></div>-->
               <!--       </div>-->
               <!--   </div>-->
               <!--   <div class="pro__items">-->
               <!--      <div class="pro__head">-->
               <!--         <span class="title">-->
               <!--            Performance-->
               <!--         </span>-->
               <!--         <span class="point">-->
               <!--            90%-->
               <!--         </span>-->
               <!--      </div>-->
               <!--    <div class="progress">-->
               <!--      <div class="progress-value"></div>-->
               <!--    </div>-->
               <!--   </div>-->
               <!--   <div class="pro__items">-->
               <!--      <div class="pro__head">-->
               <!--         <span class="title">-->
               <!--            Marketing-->
               <!--         </span>-->
               <!--         <span class="point">-->
               <!--            70%-->
               <!--         </span>-->
               <!--      </div>-->
               <!--    <div class="progress">-->
               <!--      <div class="progress-value"></div>-->
               <!--    </div>-->
               <!--   </div>-->
               <!--    <div class="pro__items">-->
               <!--      <div class="pro__head">-->
               <!--         <span class="title">-->
               <!--            Privacy-->
               <!--         </span>-->
               <!--         <span class="point">-->
               <!--           85%-->
               <!--         </span>-->
               <!--      </div>-->
               <!--      <div class="progress">-->
               <!--         <div class="progress-value"></div>-->
               <!--      </div>-->
               <!--    </div>-->
               <!--</div>-->
               <a href="{{url ('/About-Us')}}" class="cmn--btn">
                  <span>Read More</span>
               </a>
            </div>
         </div>
         <!--about content-->
         <div class="col-xxl-1 col-xl-1 col-lg-1"></div>
         <!--about thumb-->
         <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-9 col-sm-9">
            <div class="about__thumb">
               <img src="{{url ('frontend/assets/img/about/about2.png')}}" alt="about">
            </div>
         </div>
         <!--about thumb-->
      </div>
   </div>
   <!--Container-->
   <!--elements-->
   <div class="ball3d">
      <img src="{{url ('frontend/assets/img/elements/ball3d.png')}}" alt="ball3d">
   </div>
   <div class="banner3__two">
      <img src="{{url ('frontend/assets/img/elements/3dround.png')}}" alt="ball3d">
   </div>
   <div class="banner__blump">
      <img src="{{url ('frontend/assets/img/elements/blumb.png')}}" alt="ball3d">
   </div>
   <div class="banner__nulldimond">
      <img src="{{url ('frontend/assets/img/elements/null-dimond.png')}}" alt="ball3d">
   </div>
   <!--elements-->
</section>
<!-- About End -->

<!-- efective Here -->
<!--<section class="efective__section efective__system__section bgsection pt-120 pb-120">-->
    
<section class="efective__section efective__system__section bgsection pt__60 pb__60">
   <!--container-->
   <div class="container">
      <div class="row justify-content-between">
         <!--col grid-->
         <div class="col-xl-6 col-lg-7">
            <div class="efective__content efective__data__system">
               <div class="section__header pb__32">
                  <h2>
                     Detailed Guide on How the System Works and Operates
                  </h2>
                  <p>
                     AI is the broader concept of machines being able to perform tasks that would normally require human intelligence, such as visual perception, speech recognition, and language translation.
                  </p>
               </div>
               <div class="efective__data__wrapper">
                  <div class="row g-3">
                     <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="efect__data__iems d-grid">
                           <div class="icons">
                              <img src="{{url ('frontend/assets/img/efective/braindata.png')}}" alt="icon">
                           </div>
                           <div class="content">
                              <h5>
                                 Data Generated
                              </h5>
                              <p>
                                 The integration of AI and ML is leading to the creation of intelligent systems
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="efect__data__iems d-grid">
                           <div class="icons icons2">
                              <img src="{{url ('frontend/assets/img/efective/datastored.png')}}" alt="icon">
                           </div>
                           <div class="content">
                              <h5>
                                 Data Stored
                              </h5>
                              <p>
                                 The integration of AI and ML is leading to the creation of intelligent systems
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="efect__data__iems d-grid">
                           <div class="icons icons3">
                              <img src="{{url ('frontend/assets/img/efective/dataprocessing.png')}}" alt="icon">
                           </div>
                           <div class="content">
                              <h5>
                                 Data Processing
                              </h5>
                              <p>
                                 The integration of AI and ML is leading to the creation of intelligent systems
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="efect__data__iems d-grid">
                           <div class="icons icons4">
                              <img src="{{url ('frontend/assets/img/efective/actionable.png')}}" alt="icon">
                           </div>
                           <div class="content">
                              <h5>
                                 Actionable Insights
                              </h5>
                              <p>
                                 The integration of AI and ML is leading to the creation of intelligent systems
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--col grid-->
         <div class="col-xl-5 col-lg-5 col-md-12" >
            <div class="efective__system">
               <img src="{{url ('frontend/assets/img/efective/efectsystem.png')}}" alt="efective">
            </div>
         </div>
         <!--col grid-->
      </div>
   </div>
   <!--container-->
   <!--elements-->
   <div class="efect__element1">
      <img src="{{url ('frontend/assets/img/elements/efect-ball.png')}}" alt="img">
   </div>
   <div class="efect__three">
      <img src="{{url ('frontend/assets/img/elements/3dround.png')}}" alt="img">
   </div>
   <div class="efect__rount">
      <img src="{{url ('frontend/assets/img/elements/efect-rount.png')}}" alt="img">
   </div>
   <div class="efect__cross">
      <img src="{{url ('frontend/assets/img/elements/efect-cross2.png')}}" alt="img">
   </div>
   <!--elements-->
</section>
<!-- efective End -->

<!-- Testimonial Here -->
<!--<section class="testimonial__section bg__white pt-120 pb-120">-->
    
<section class="testimonial__section bg__white pt__60 pb__60">
   <!--contaienr-->
   <div class="container">
      <div class="row justify-content-between align-items-center">
         <!--col grid-->
         <div class="col-xxl-6 col-lg-6 col-md-10 col-sm-12">
            <div class="testimonial__thumb__two">
               <img src="{{url ('frontend/assets/img/testimonial/testimonial2.png')}}" alt="client">
            </div>
         </div>
         <!--col grid-->
         <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="testimonial__content testimonial__content__two">
               <div class="section__header mb-2">
                  <h2>
                     User experience reports on support and services
                  </h2>
                  <p>
                     AI is the broader concept of machines being able to perform tasks that would normally require human intelligence, such as visual perception, speech recognition, and language translation.
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
                        Our company has seen significant improvement in efficiency and accuracy since implementing AI and ML technology in our processes...
                     </p>
                     <div class="client__wrap">
                        <div class="thumb">
                           <img src="{{url ('frontend/assets/img/testimonial/devon.png')}}" alt="img">
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
                        Our company has seen significant improvement in efficiency and accuracy since implementing AI and ML technology in our processes...
                     </p>
                     <div class="client__wrap">
                        <div class="thumb">
                           <img src="{{url ('frontend/assets/img/testimonial/devon.png')}}" alt="img">
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
                        Our company has seen significant improvement in efficiency and accuracy since implementing AI and ML technology in our processes...
                     </p>
                     <div class="client__wrap">
                        <div class="thumb">
                           <img src="{{url ('frontend/assets/img/testimonial/devon.png')}}" alt="img">
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
                        Our company has seen significant improvement in efficiency and accuracy since implementing AI and ML technology in our processes...
                     </p>
                     <div class="client__wrap">
                        <div class="thumb">
                           <img src="{{url ('frontend/assets/img/testimonial/devon.png')}}" alt="img">
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
      </div>
   </div>
   <!--contaienr-->
</section>
<!-- Testimonial End -->

<!-- Qualified Here -->
<section class="qualified__section make__service__section bgsection pt-120 pb-120">
   <!--ai robot-->
   <div class="airobot">
      <img src="{{url ('frontend/assets/img/elements/ponkhi.png')}}" alt="robot">
   </div>
   <!--ai robot-->
   <!--container-->
   <div class="container">
      <div class="row align-items-center justify-content-between">
         <!--col-->
         <div class="col-lg-5">
            <div class="make__service">
                <div class="counting__wrap">
                   <div class="counter__items odometer-item">
                     <div class="counter__content counter__content__green">
                        <div class="cont d-flex align-items-center">
                           <span class="odometer" data-odometer-final="1.9">
                              0
                           </span>
                           <span class="plus__icon">
                              k
                           </span>
                           <span class="plus__icon">
                              +
                           </span>
                        </div>
                     </div>
                     <p>Customer Satisfaction</p>
                  </div>
                   <div class="counting__middle">
                     <div class="counter__items odometer-item">
                        <div class="counter__content">
                           <div class="cont d-flex align-items-center">
                              <span class="odometer" data-odometer-final="2.3">
                                 0
                              </span>
                              <span class="plus__icon">
                                 k
                              </span>
                              <span class="plus__icon">
                                 +
                              </span>
                           </div>
                        </div>
                        <p>Completed Projects</p>
                     </div>
                     <div class="counter__items odometer-item">
                        <div class="counter__content counter__content__red">
                           <div class="cont d-flex align-items-center">
                              <span class="odometer" data-odometer-final="450">
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
                   <div class="counter__items odometer-item">
                     <div class="counter__content counter__yellow">
                        <div class="cont d-flex align-items-center">
                           <span class="odometer" data-odometer-final="67">
                              0
                           </span>
                           <span class="plus__icon">
                              +
                           </span>
                        </div>
                     </div>
                     <p>Awards Wan</p>
                  </div>
                </div>
            </div>
          </div>
         <!--col-->
         <div class="col-lg-6">
            <div class="qualified__content">
               <div class="section__header">
                  <h2>
                     Professional Services that Make Your Life Easier
                  </h2>
                  <p>
                     AI is the broader concept of machines being able to carry out tasks in a way that would normally require human intelligence. This can include things like image recognition, speech recognition, and decision making. ML is a specific type of AI that involves the use of algorithms that can learn from data.
                  </p>
               </div>
               <a href="{{url ('/About-Us')}}" class="cmn--btn">
                  <span>
                     About us
                  </span>
               </a>
            </div>
         </div>
         <!--col-->
      </div>
   </div>
   <!--container-->
   <!--elements-->
   <div class="textgreen__light">
      <img src="{{url ('frontend/assets/img/elements/green.png')}}" alt="light">
   </div>
   <div class="light__elegr">
      <img src="{{url ('frontend/assets/img/elements/green.png')}}" alt="light">
   </div>
   <div class="light__element2gr">
      <img src="{{url ('frontend/assets/img/elements/green.png')}}" alt="light">
   </div>
   <div class="light__element3">
      <img src="{{url ('frontend/assets/img/elements/green.png')}}" alt="light">
   </div>
   <div class="checkai">
      <img src="{{url ('frontend/assets/img/elements/checkai.png')}}" alt="ai">
   </div>
   <!--elements-->
</section>
<!-- Qualified End -->
@endsection