@extends('layouts.app')
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
                     Blog List
                  </h1>
                  <ul class="breadcumnd__list">
                     <li>
                        <a href="/">
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
                        <a href="/blog-list">
                           Blog
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
                        List
                     </li>
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

<!--Blog Grid Section-->
<section class="blog__grid__section bg__white pt-80 pb-80">
       <!--container-->
      <div class="container">
         <div class="row justify-content-center align-items-center">
            <!--col grid-->
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl1.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           OpenAI has launched GPT-3, a new ...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl2.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           Google has announced plans to integrate...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl3.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           AI is being used in the fight against climate...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl4.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           AI is also being used in the healthcare industry...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl5.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           There is growing concern about the ethical...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl6.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           The use of AI in hiring and recruitment processes...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl7.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           AI is being used to analyze social media...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl8.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           AI is being used in the financial industry...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl9.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           There is growing interest in using AI to improve...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl10.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           The use of AI in hiring and recruitment processes...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl11.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           AI is being used to improve crop yields...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
               <div class="realworld__items blog__list__items">
                  <div class="thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/bl12.jpg')}}" alt="img">
                  </div>
                  <div class="content">
                     <h4>
                        <a href="{{url ('/blog-details') }}">
                           AI is being used to improve energy and...
                        </a>
                     </h4>
                     <ul class="admin__wrap">
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 group
                              </i>
                           </span>
                           <span>
                              Admin
                           </span>
                        </li>
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 event_available
                              </i>
                           </span>
                           <span>
                              15-12-2023
                           </span>
                        </li>
                     </ul>
                     <p>
                        There are many variations of passages of Lorem Ipsum available...
                     </p>
                     <a href="{{url ('/blog-details') }}" class="real__btn">
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
         <!--Pagination-->
         <ul class="pagination pt__40 justify-content-center">
            <li>
               <a href="javascript:void(0)" class="icon">
                  <i class="material-symbols-outlined">
                     chevron_left
                  </i>
               </a>
            </li>
            <li>
               <a href="javascript:void(0)">
                  1
               </a>
            </li>
            <li>
               <a href="javascript:void(0)">
                  2
               </a>
            </li>
            <li>
               <a href="javascript:void(0)">
                  3
               </a>
            </li>
            <li>
               <a href="javascript:void(0)">
                  ...
               </a>
            </li>
            <li>
               <a href="javascript:void(0)" class="icon">
                  <i class="material-symbols-outlined">
                     keyboard_arrow_right
                  </i>
               </a>
            </li>
         </ul>
         <!--Pagination-->
      </div>
      <!--container-->
</section>
<!--Blog Grid Section-->

            
    @endsection