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
                     Blog Details
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
                        <a href="{{url ('/blog-grid')}}">
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
                        Details
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

<!-- Blog Details Here -->
<section class="service__section bg__white pt-120 pb-80">
   <!--container-->
   <div class="container">
      <div class="row">
         <div class="col-xxl-8 col-xl-8 col-lg-8">
            <div class="service__details__left blog__details__left">
               <div class="machine__learning__box mb-5">
                  <div class="details__thumb">
                     <img src="{{url ('frontend/assets/img/bog-capabilities/blog-details1.png')}}" alt="details">
                  </div>
                  <div class="content">
                     <h2 class="headtext">
                        Google has announced plans to integrate AI into its search engine to provide
                     </h2>
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
                        <li>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 forum
                              </i>
                           </span>
                           <span>
                              Comments(144)
                           </span>
                        </li>
                     </ul>
                     <p class="text1">
                        Google has been investing in AI and machine learning technologies for several years, and has integrated these technologies into various products and services, including its search engine. The goal of this integration is to provide more relevant and accurate results for users, based on their search history, location, and other factors.
                     </p>
                     <div class="more__details__thumb">
                        <div class="more__details__item">
                           <img src="{{url ('frontend/assets/img/bog-capabilities/touch1.jpg')}}" alt="img">
                        </div>
                        <div class="more__details__item">
                           <img src="{{url ('frontend/assets/img/bog-capabilities/touch2.jpg')}}" alt="img">
                        </div>
                     </div>
                     <p class="pb__20">
                        Google's AI algorithms can now understand the context and intent behind a user's search query and provide results that are tailored to their specific needs. This integration has improved the accuracy and relevance of search results, making it easier for users to find what they are looking for.
                     </p>
                     <p>
                        In addition to improving the search experience, Google is also using AI to enhance other areas of its business, including voice recognition, image and video analysis, and natural language processing. This investment in AI technology is part of Google's larger strategy to stay ahead of the competition and offer innovative products and services to its users.
                     </p>
                     <div class="touch__standard">
                        <div class="thumb">
                           <img src="{{url ('frontend/assets/img/bog-capabilities/touch3.jpg')}}" alt="img">
                        </div>
                        <div class="touch__box">
                           <p class="ttext">
                              Autocomplete: Google's search engine now includes an autocomplete feature, which uses AI algorithms to predict and suggest search queries as users type. This helps users find what they are looking for more quickly and efficiently.
                           </p>
                           <p>
                              Voice Search: Google has integrated voice search into its search engine, allowing users to perform searches using just their voice. The voice search function uses AI algorithms to transcribe and understand spoken language, providing users with accurate results in real-time.
                           </p>
                        </div>
                     </div>
                     <p class="pb__20">
                        Here are some additional details about Google's integration of AI into its search engine:
                     </p>
                     <ul class="machine__listing">
                        <li>
                           <span>
                              1.
                           </span>
                           <span>
                              Contextual Understanding: Google's AI algorithms can now understand the context behind a user's search query and provide results that are relevant to their specific needs. For example, if a user searches for "best pizza in New York," the search engine will take into account the user's location and provide results for the best pizza places in the vicinity.
                           </span>
                        </li>
                        <li>
                           <span>
                              2.
                           </span>
                           <span>
                              Personalized Results: Google's AI algorithms can now personalize search results based on a user's search history, location, and other factors. This means that users will receive results that are tailored to their specific interests and preferences.
                           </span>
                        </li>
                        <li>
                           <span>
                              3.
                           </span>
                           <span>
                              Natural Language Processing: Google has integrated natural language processing into its search engine, allowing users to search for information using conversational language rather than traditional search queries. This has made search more intuitive and easier to use.
                           </span>
                        </li>
                     </ul>
                     <p class="pt__15">
                        These efforts demonstrate Google's commitment to improving the search experience and staying ahead of the competition in the rapidly evolving field of AI and machine learning. The company continues to invest in AI research and development, and it is likely that additional AI-powered features and improvements will
                     </p>
                     <div class="video__thumb">
                        <img src="{{url ('frontend/assets/img/bog-capabilities/blog-details2.jpg')}}" alt="img">
                        <a href="https://www.youtube.com/watch?v=wXNv-x5zVgE" class="play__btn video-btn">
                           <i class="material-symbols-outlined">
                              play_arrow
                           </i>
                        </a>
                     </div>
                     <p class="pb__20">
                        Google's AI algorithms can now understand the context and intent behind a user's search query and provide results that are tailored to their specific needs. This integration has improved the accuracy and relevance of search results, making it easier for users to find what they are looking for.
                     </p>
                     <p>
                        In addition to improving the search experience, Google is also using AI to enhance other areas of its business, including voice recognition, image and video analysis, and natural language processing. This investment in AI technology is part of Google's larger strategy to stay ahead of the competition and offer innovative products and services to its users.
                     </p>
                     <div class="standard__footer">
                        <a href="{{url ('/blog-details') }}" class="standard___btn">
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 keyboard_backspace
                              </i>
                           </span>
                           <span>
                              Previous Post
                           </span>
                        </a>
                        <ul class="social__standard">
                           <li>
                               <a href="javascript:void(0)" class="social__item">
                                 <img src="{{url ('frontend/assets/img/calltoaction/facebook.svg')}}" alt="icon">
                              </a>
                           </li>
                           <li>
                               <a href="javascript:void(0)" class="social__item social__itemtwo">
                                 <img src="{{url ('frontend/assets/img/calltoaction/instagram.svg')}}" alt="icon">
                              </a>
                           </li>
                           <li>
                               <a href="javascript:void(0)" class="social__item social__itemthree">
                                 <img src="{{url ('frontend/assets/img/calltoaction/twitter.svg')}}" alt="icon">
                              </a>
                           </li>
                           <li>
                               <a href="javascript:void(0)" class="social__item social__itemfour">
                                 <img src="{{url ('frontend/assets/img/calltoaction/linkedin.svg')}}" alt="icon">
                              </a>
                           </li>
                        </ul>
                        <a href="{{url ('/blog-details') }}" class="standard___btn2">
                           <span>
                              Next Post
                           </span>
                           <span class="icon">
                              <i class="material-symbols-outlined">
                                 trending_flat
                              </i>
                           </span>
                        </a>
                     </div>
                  </div>
               </div>

               <div class="comments__wrap">
                  <h3>
                     Comments (03)
                  </h3>
                  <div class="reviews__boxes">
                     <div class="thumb">
                        <img src="{{url ('frontend/assets/img/bog-capabilities/co1.jpg')}}" alt="img">
                     </div>
                     <div class="review-content">
                        <div class="name__ratting">
                           <span class="name">
                              Esther Howard
                           </span>
                           <span class="time">
                              2 days ago
                           </span>
                        </div>
                        <p>
                           As a business owner, I have seen the transformative power of AI first-hand. By incorporating AI into our operations, we have been able to automate many routine tasks, freeing up our employees to focus on more strategic initiatives...
                        </p>
                        <ul class="liked__wrap">
                           <li>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    thumb_up
                                 </i>
                              </span>
                              <span>
                                 18
                              </span>
                           </li>
                           <li>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    forum
                                 </i>
                              </span>
                              <span>
                                 Reply
                              </span>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="reviews__boxes">
                     <div class="thumb">
                        <img src="{{url ('frontend/assets/img/bog-capabilities/co2.jpg')}}" alt="img">
                     </div>
                     <div class="review-content">
                        <div class="name__ratting">
                           <span class="name">
                              Leslie Alexander
                           </span>
                           <span class="time">
                              2 days ago
                           </span>
                        </div>
                        <p>
                           "I have been using AI-powered tools in my work for several years now, and the impact has been tremendous. From virtual assistants that save me time by handling routine tasks to advanced analytics that help me make more informed decisions...
                        </p>
                        <ul class="liked__wrap">
                           <li>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    thumb_up
                                 </i>
                              </span>
                              <span>
                                 18
                              </span>
                           </li>
                           <li>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    forum
                                 </i>
                              </span>
                              <span>
                                 Reply
                              </span>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="reviews__boxes">
                     <div class="thumb">
                        <img src="{{url ('frontend/assets/img/bog-capabilities/co3.jpg')}}" alt="img">
                     </div>
                     <div class="review-content">
                        <div class="name__ratting">
                           <span class="name">
                              Theresa Webb
                           </span>
                           <span class="time">
                              2 days ago
                           </span>
                        </div>
                        <p>
                           I have been using AI-powered tools in my work for several years now, and the impact has been tremendous. From virtual assistants that save me time by handling routine tasks to advanced analytics that help me make more informed decisions...
                        </p>
                        <ul class="liked__wrap">
                           <li>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    thumb_up
                                 </i>
                              </span>
                              <span>
                                 18
                              </span>
                           </li>
                           <li>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    forum
                                 </i>
                              </span>
                              <span>
                                 Reply
                              </span>
                           </li>
                        </ul>
                        <div class="reply__boxes">
                           <div class="icon">
                              <img src="{{url ('frontend/assets/img/bog-capabilities/co4.jpg')}}" alt="img">
                           </div>
                           <div class="input__box">
                              <input type="text" placeholder="Join the discussion...">
                           </div>
                        </div>
                        <div class="view__all text-center">
                           <a href="javascript:void(0)" class="cmn--btn">
                              <span>
                                 View All Comment
                              </span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="write__review__wrap">
                  <h4 class="title">
                     Write a Review
                  </h4>
                  <form action="javascript:void(0)">
                     <div class="row g-4">
                        <div class="col-lg-6">
                           <input type="text" placeholder="Enter Your Name...">
                        </div>
                        <div class="col-lg-6">
                           <input type="email" placeholder="Enter Your Email...">
                        </div>
                        <div class="col-lg-12">
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Write a reviews..."> </textarea>
                        </div>
                        <button type="submit" class="cmn--btn">
                           <span>
                              Submit
                           </span>
                        </button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-xxl-4 col-xl-4 col-lg-4">
           <div class="service__details__right">
               <div class="common__item">
                  <h5 class="title">
                     Search
                  </h5>
                  <form action="#">
                     <input type="text" placeholder="Search">
                     <button>
                        <i class="material-symbols-outlined">
                           search
                        </i>
                     </button>
                  </form>
               </div>
               <div class="common__item">
                  <h5 class="title">
                     Recent News
                  </h5>
                  <div class="recent__wrap">
                     <a href="{{url ('/blog-details') }}" class="recent__items">
                        <span class="thumb">
                           <img src="{{url ('frontend/assets/img/bog-capabilities/smai.jpg')}}" alt="img">
                        </span>
                        <div class="recent__content">
                           <h6>
                              AI is being used to analyze social...
                           </h6>
                           <span class="recent__btn">
                              <span>
                                 Read More
                              </span>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    arrow_right_alt
                                 </i>
                              </span>
                           </span>
                        </div>
                     </a>
                     <a href="{{url ('/blog-details') }}" class="recent__items">
                        <span class="thumb">
                           <img src="{{url ('frontend/assets/img/bog-capabilities/bl2.jpg')}}" alt="img">
                        </span>
                        <div class="recent__content">
                           <h6>
                              Google has announced plans...
                           </h6>
                           <span class="recent__btn">
                              <span>
                                 Read More
                              </span>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    arrow_right_alt
                                 </i>
                              </span>
                           </span>
                        </div>
                     </a>
                      <a href="{{url ('/blog-details') }}" class="recent__items">
                        <span class="thumb">
                           <img src="{{url ('frontend/assets/img/detaisl/re3.jpg')}}" alt="img">
                        </span>
                        <div class="recent__content">
                           <h6>
                              AI is also being used in the healthcare...
                           </h6>
                           <span class="recent__btn">
                              <span>
                                 Read More
                              </span>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    arrow_right_alt
                                 </i>
                              </span>
                           </span>
                        </div>
                     </a>
                      <a href="{{url ('/blog-details') }}" class="recent__items">
                        <span class="thumb">
                           <img src="{{url ('frontend/assets/img/detaisl/re4.jpg')}}" alt="img">
                        </span>
                        <div class="recent__content">
                           <h6>
                              There is growing interest in using...
                           </h6>
                           <span class="recent__btn">
                              <span>
                                 Read More
                              </span>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    arrow_right_alt
                                 </i>
                              </span>
                           </span>
                        </div>
                     </a>
                  </div>
               </div>
               <div class="common__item">
                  <h5 class="title">
                     Popular Tags
                  </h5>
                  <ul class="popular__tag">
                     <li>
                         <a href="javascript:void(0)" class="social__item">
                           New
                        </a>
                     </li>
                     <li>
                         <a href="javascript:void(0)" class="social__item social__itemtwo">
                           AI
                        </a>
                     </li>
                     <li>
                         <a href="javascript:void(0)" class="social__item social__itemthree">
                           2023
                        </a>
                     </li>
                     <li>
                         <a href="javascript:void(0)" class="social__item social__itemfour">
                           ML
                        </a>
                     </li>
                     <li>
                         <a href="javascript:void(0)" class="social__item social__itemfour">
                           Amazon
                        </a>
                     </li>
                     <li>
                         <a href="javascript:void(0)" class="social__item social__itemfour">
                          Shop
                        </a>
                     </li>
                  </ul>
               </div>
               <div class="common__item">
                  <h5 class="title">
                     Follow Our Journey
                  </h5>
                  <ul class="social__standard">
                     <li>
                         <a href="javascript:void(0)" class="social__item">
                           <img src="{{url ('frontend/assets/img/calltoaction/facebook.svg')}}" alt="icon">
                        </a>
                     </li>
                     <li>
                         <a href="javascript:void(0)" class="social__item social__itemtwo">
                           <img src="{{url ('frontend/assets/img/calltoaction/instagram.svg')}}" alt="icon">
                        </a>
                     </li>
                     <li>
                         <a href="javascript:void(0)" class="social__item social__itemthree">
                           <img src="{{url ('frontend/assets/img/calltoaction/twitter.svg')}}" alt="icon">
                        </a>
                     </li>
                     <li>
                         <a href="javascript:void(0)" class="social__item social__itemfour">
                           <img src="{{url ('frontend/assets/img/calltoaction/linkedin.svg')}}" alt="icon">
                        </a>
                     </li>
                  </ul>
               </div>
           </div>
         </div>
      </div>
   </div>
   <!--container-->
</section>
<!-- Blog Details End -->

<!-- Blog Details End -->
<section class="blog__details__section pt-80 pb-80">
   <!--container-->
   <div class="container">
      <!--blog details head-->
      <div class="blog__details__head ">
         <h2>
            More Related News
         </h2>
      </div>
      <!--blog details head-->
      <div class="blog__details__wrap owl-theme owl-carousel">
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{url ('frontend/assets/img/bog-capabilities/bigai.jpg')}}" alt="capabi">
            </a>
            <div class="content">
               <h4>
                  <a href="#de">
                     AI is being used to analyze social media data to...
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
                  There are many variations of passages of Lorem Ipsum available, but the majority have...
               </p>
               <a href="{{url ('/blog-details') }}" class="capa__more">
                  <span>
                     Read More
                  </span>
                  <i class="material-symbols-outlined">
                  east
                  </i>
               </a>
            </div>
         </div>
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{url ('frontend/assets/img/bog-capabilities/bl8.jpg')}}" alt="capabi">
            </a>
            <div class="content">
               <h4>
                  <a href="#de">
                     AI is being used in the financial industry, with banks and...
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
                  There are many variations of passages of Lorem Ipsum available, but the majority have...
               </p>
               <a href="{{url ('/blog-details') }}" class="capa__more">
                  <span>
                     Read More
                  </span>
                  <i class="material-symbols-outlined">
                  east
                  </i>
               </a>
            </div>
         </div>
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{url ('frontend/assets/img/bog-capabilities/c4.png')}}" alt="capabi">
            </a>
            <div class="content">
               <h4>
                  <a href="#de">
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
                  There are many variations of passages of Lorem Ipsum available, but the majority have...
               </p>
               <a href="{{url ('/blog-details') }}" class="capa__more">
                  <span>
                     Read More
                  </span>
                  <i class="material-symbols-outlined">
                  east
                  </i>
               </a>
            </div>
         </div>
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{url ('frontend/assets/img/bog-capabilities/bigai.jpg')}}" alt="capabi">
            </a>
            <div class="content">
               <h4>
                  <a href="#de">
                     AI is being used to analyze social media data to...
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
                  There are many variations of passages of Lorem Ipsum available, but the majority have...
               </p>
               <a href="{{url ('/blog-details') }}" class="capa__more">
                  <span>
                     Read More
                  </span>
                  <i class="material-symbols-outlined">
                  east
                  </i>
               </a>
            </div>
         </div>
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{url ('frontend/assets/img/bog-capabilities/bl8.jpg')}}" alt="capabi">
            </a>
            <div class="content">
               <h4>
                  <a href="#de">
                     AI is being used in the financial industry, with banks and...
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
                  There are many variations of passages of Lorem Ipsum available, but the majority have...
               </p>
               <a href="{{url ('/blog-details') }}" class="capa__more">
                  <span>
                     Read More
                  </span>
                  <i class="material-symbols-outlined">
                  east
                  </i>
               </a>
            </div>
         </div>
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{url ('frontend/assets/img/bog-capabilities/c4.png')}}" alt="capabi">
            </a>
            <div class="content">
               <h4>
                  <a href="#de">
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
                  There are many variations of passages of Lorem Ipsum available, but the majority have...
               </p>
               <a href="{{url ('/blog-details') }}" class="capa__more">
                  <span>
                     Read More
                  </span>
                  <i class="material-symbols-outlined">
                  east
                  </i>
               </a>
            </div>
         </div>
      </div>
   </div>
   <!--container-->
</section>
<!-- Blog Details End -->


            
@endsection