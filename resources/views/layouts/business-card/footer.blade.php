<!-- Footer Here -->

<style>
/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/
@media (min-width: 320px) and (max-width: 480px) {
  .icon{padding: 8px 0px 0px 0px;}
}
</style>


<footer class="footer__section">
    <!--shpa-->
    <div class="footer__shape">
       <img src="{{url('frontend/assets/img/elements/footer-shape.png')}}" alt="img">
    </div>
    <div class="footer__darkshpae">
       <img src="{{url('frontend/assets/img/elements/footer-shapedark.png')}}" alt="img">
    </div>
    <!--shpa-->
    <div class="container">
       <div class="footer__wrapper">
          <div class="footer__top">
             <div class="row g-5">
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                   <div class="footer__widget">
                      <div class="widget__head">
                         <a href="{{url ('/')}}" class="footer__logo">
                            <img src="{{url('frontend/assets/img/logo/fastap.png')}}" alt="logo">
                         </a>
                      </div>
                      <p class="pb__20">
                         Artificial Intelligence (AI) and Machine Learning (ML) are closely related technologies that enable computers to learn from data and make predictions
                      </p>
                      <ul class="social">
                         <li>
                            <a href="javascript:void(0)" class="social__item">
                               <span class="icon">
                                  <img src="{{url('frontend/assets/img/svg-icon/facebook.svg')}}" alt="svg">
                               </span>
                            </a>
                         </li>
                         <li>
                            <a href="javascript:void(0)" class="social__item social__itemtwo">
                               <span class="icon">
                                  <img src="{{url('frontend/assets/img/svg-icon/instagram.svg')}}" alt="svg">
                               </span>
                            </a>
                         </li>
                         <li>
                            <a href="javascript:void(0)" class="social__item social__itemthree">
                               <span class="icon">
                                  <img src="{{url('frontend/assets/img/svg-icon/twitter.svg')}}" alt="svg')}}">
                               </span>
                            </a>
                         </li>
                         <li>
                            <a href="javascript:void(0)" class="social__item social__itemfour">
                               <span class="icon">
                                  <img src="{{url('frontend/assets/img/svg-icon/linkedin.svg')}}" alt="svg">
                               </span>
                            </a>
                         </li>
                      </ul>
                   </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                   <div class="footer__widget">
                      <div class="widget__head">
                         <h4>
                            Quick Links
                         </h4>
                      </div>
                      <div class="widget__link">
                         <a href="{{url ('/About-Us')}}" class="link">
                            About us
                         </a>
                          <a href="{{url ('/Corporate')}}" class="link">
                            Corporate
                         </a>
                         <a href="{{url ('/Product')}}" class="link">
                            Products
                         </a>
                         <a href="{{url ('/faq')}}" class="link">
                            Faq
                         </a>
                         
                         <a href="{{url ('/Contact-Us')}}" class="link">
                            Contact Us
                         </a>
                         
                         <!--<a href="{{url ('/pricing')}}" class="link">-->
                         <!--   Pricing Plan-->
                         <!--</a>-->
                         <!--<a href="{{url ('/shop')}}" class="link">-->
                         <!--   Shop-->
                         <!--</a>-->
                         
                      </div>
                   </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                   <div class="footer__widget">
                      <div class="widget__head">
                         <h4>
                            Products
                         </h4>
                      </div>
                     <div class="widget__link">
                         <a href="{{url ('/product-details/51')}}" class="link">
                            BUSINESS CARD
                         </a>
                         <a href="{{url ('/product-details/52')}}" class="link">
                            PROFESSIONAL CARD
                         </a>
                         <a href="{{url ('/product-details/60')}}" class="link">
                            PREMIUM  CARD
                         </a>
                         
                         <!--<a href="{{url ('/signup') }}" class="link">-->
                         <!--   Statistic-->
                         <!--</a>-->
                         <!--<a href="{{url ('/signup') }}" class="link">-->
                         <!--   Data Mining-->
                         <!--</a>-->
                         
                      </div>
                   </div>
                </div>
                
                 @php 
                    $data = App\Models\websetting::first();
                @endphp
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                   <div class="footer__widget">
                      <div class="widget__head">
                         <h4>
                            Contact
                         </h4>
                      </div>
                       <div class="widget__link">
                         <a href="javascript:void(0)" class="footer__contact__items">
                            <span class="icon">
                               <i class="material-symbols-outlined">
                                  add_call
                               </i>
                            </span>
                           <span class="fcontact__content">
                               {{$data->mobile}}
                           </span>
                         </a>
                         <a href="javascript:void(0)" class="footer__contact__items">
                            <span class="icon icontwo">
                               <i class="material-symbols-outlined">
                                  mark_as_unread
                               </i>
                            </span>
                            <span class="fcontact__content">
                              <span class="__cf_email__" data-cfemail="d5b0adb4b8a5b9b095b0adb4b8a5b9b0fbb6bab8"> {{$data->email}}</span>
                            </span>
                         </a>
                         <a href="javascript:void(0)" class="footer__contact__items">
                            <span class="icon iconthree">
                               <span class="material-symbols-outlined">
                                  pin_drop
                               </span>
                            </span>
                            <span class="fcontact__content">
                                {{$data->address}}
                            </span>
                         </a>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <!--<div class="footer__bottom">-->
          <!--   <p>-->
          <!--      Copyright  ©-->
          <!--      <script>-->
          <!--          document.write(new Date().getFullYear());-->
          <!--      </script>-->
          <!--      VM Cards All right reserved.-->
          <!--   </p>-->
          <!--</div>-->
          <div class="footer__bottom footer__bottom__two">
            <p>
                Copyright  ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                Fastap All right reserved.
            </p>
            <ul class="footer__bottom__link">
               <!--<li>-->
               <!--   <a href="{{url ('/privecy_policy')}}">-->
               <!--      Support-->
               <!--   </a>-->
               <!--</li>-->
               <li>
                  <a href="{{url ('/privacy_policy')}}">
                     Privacy policy
                  </a>
               </li>
               <li>
                  <a href="{{url ('/privacy_policy')}}">
                     Terms of condition
                  </a>
               </li>
            </ul>
         </div>
      </div>
       </div>
    </div>
    <!--footer mask-->
    <div class="footer__mask">
       <img src="{{url('frontend/assets/img/elements/box-element.png')}}" alt="mask">
    </div>
    <!--footer mask-->
 </footer>
 <!-- Footer End -->