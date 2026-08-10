<!-- Preloader Start Here -->
<div class="preloader__wrap">
   <div class="preloader__box">
      <div class="robot">
         <!--<img src="{{url('frontend/assets/img/elements/ponkhi.png')}}" alt="img">-->
           <img src="{{url('frontend/assets/img/logo/fastap.png')}}" alt="img">
      </div>
   </div>
</div>
<!-- Preloader End Here -->

<!-- Header top Here -->
<header class="header-section">
   <div class="container">
      <div class="header-wrapper">
         <div class="logo-menu">
            <a href="{{url('/')}}" class="logo">
               <img src="{{url('frontend/assets/img/logo/fastap.png')}}" alt="logo">
            </a>
            <a href="{{url('/')}}" class="small__logo d-xl-none">
               <img src="{{url('frontend/assets/img/logo/favicon.png')}}" alt="logo">
            </a>
         </div>
         <div class="menu__right__components compoent__middle d-flex align-items-center">
            <div class="menu__components">
                {{-- <a href="javascript:void(0)" class="mode--toggle">
                  <img src="{{url('frontend/assets/img/moon.png')}}" alt="icon">
               </a> --}}
               <div class="search-button" role="tablist">
                  <!--<button class="nav-link" id="search2s" aria-selected="false" tabindex="-1" role="tab">-->
                  <!--    <span class="icons"><i class="material-symbols-outlined">-->
                  <!--      search-->
                  <!--      </i>-->
                  <!--   </span>-->
                  <!--</button>-->
                  <div class="search-popup" style="display: none;">
                    <div class="search-bg"></div>
                    <div class="search-form" style="right: -100%;">
                      <form action="javascript:void(0)">
                        <div class="form">
                          <input type="text" id="searchs" placeholder="Search">
                        </div>
                      </form>
                    </div>
                  </div>
               </div>
               <div class="tolly__shop" style="margin: 5px 13px 0px 0px;">
                    <?php 
                        $user_id = request()->session()->get('FRONT_USER_ID');
                        $articles = App\Models\Cart::where('user_id', $user_id)->count();
                    ?>
                    <a href="{{ url('new-cart')}}" class="iq-cart iq-pos-r"><i class="fa fa-shopping-cart"></i><span class="cart-count">{{$articles}}</span></a> 
                    
               </div>
               <a href="{{url('/userdashboard')}}" class="cmn--btn">
                  <span>
                     Sign in
                  </span>
               </a>
            </div>
            <div class="header-bar d-lg-none">
               <span></span>
               <span></span>
               <span></span>
            </div>
         </div>
         <ul class="main-menu">
            <li>
               <a href="{{url ('/')}}" class="d-flex">
                 <span>
                     Home
                 </span>
                  <span class="icons">
                     <i class="material-symbols-outlined">
                        {{-- expand_more --}}
                     </i>
                  </span>
               </a>

            </li>
            
            <!--<li class="grid__style">-->
            <!--   <a href="javascript:void(0)" class="d-flex">-->
            <!--      <span>-->
            <!--         Shop-->
            <!--      </span>-->
            <!--       <span class="icons">-->
            <!--          <i class="material-symbols-outlined">-->
            <!--             expand_more-->
            <!--          </i>-->
            <!--       </span>-->
            <!--    </a>-->
            <!--   <ul class="sub-menu">-->
            <!--      <li class="subtwohober">-->
            <!--         <a href="{{url ('/Product')}}">Product Page</a>-->
            <!--      </li>-->
            <!--      <li><a href="{{url ('/single-product')}}">Single Product</a></li>-->
            <!--      <li><a href="{{url ('/cart')}}">Cart Page</a></li>-->
            <!--      <li><a href="{{url ('/checkout')}}">Checkout</a></li>-->
            <!--      <li><a href="{{url ('/payment-successfull')}}">Successful</a></li>-->
            <!--   </ul>-->
            <!--</li>-->
            
            <li>
               <a href="{{url ('/Product')}}" class="d-flex">
                 <span>
                     Product
                 </span>
                  <span class="icons">
                     <i class="material-symbols-outlined">
                        {{-- expand_more --}}
                     </i>
                  </span>
               </a>

            </li>
            
            <!--<li class="grid__style">-->
            <!--   <a href="javascript:void(0)" class="d-flex">-->
            <!--      <span>-->
            <!--         Blog-->
            <!--      </span>-->
            <!--       <span class="icons">-->
            <!--          <i class="material-symbols-outlined">-->
            <!--             expand_more-->
            <!--          </i>-->
            <!--       </span>-->
            <!--    </a>-->
            <!--   <ul class="sub-menu">-->
            <!--      {{-- <li class="subtwohober">-->
            <!--         <a href="{{url ('/blog-grid')}}">Blog Grid</a>-->
            <!--      </li> --}}-->
            <!--      <li><a href="{{url ('/blog-list')}}">Blog List</a></li>-->
            <!--      <li><a href="{{url ('/blog-details')}}">Blog Details</a></li>-->
            <!--   </ul>-->
            <!--</li>-->
            
            <li>
               <a href="{{url ('/blog-list')}}" class="d-flex">
                 <span>
                     Blog
                 </span>
                  <span class="icons">
                     <i class="material-symbols-outlined">
                        {{-- expand_more --}}
                     </i>
                  </span>
               </a>

            </li>
            
            <li class="grid__style">
               <a href="javascript:void(0)" class="d-flex">
                  <span>
                     <!--Pages-->
                     More
                  </span>
                   <span class="icons">
                      <i class="material-symbols-outlined">
                         expand_more
                      </i>
                   </span>
                </a>
               <ul class="sub-menu">
                  <li class="subtwohober">
                     <a href="{{url ('/About-Us') }}" class="d-flex align-items-center justify-content-between">
                        <span class="text">
                           About Us
                        </span>
                     </a>

                  </li>
                  <!--<li><a href="{{url ('/pricing')}}">Pricing Page</a></li>-->
                  {{-- <li class="subtwohober">
                     <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between">
                        <span class="text">
                           Services
                        </span>
                        <span class="icon">
                           <i class="material-symbols-outlined">
                              add
                           </i>
                        </span>
                     </a>
                     <ul class="sub-two">
                        <li>
                           <a href="{{url ('/services')}}">
                             Services Page
                           </a>
                        </li>
                        <li>
                           <a href="{{url ('/service-details')}}">
                              Service Details
                           </a>
                        </li>
                     </ul>
                  </li> --}}
                  <li><a href="{{url ('/faq')}}">Faq Page</a></li>
                  <li><a href="{{url ('/Contact-Us')}}">Contact</a></li>
                  <!--<li><a href="{{url ('/error')}}">404</a></li>-->
                  <li><a href="{{url ('/Corporate')}}"> Corporate </a> </li>
               </ul>
            </li>
            
            <li>
               <a href="{{url ('/preorder')}}" class="d-flex">
                 <span>
                     Pre Order
                 </span>
                  <span class="icons">
                     <i class="material-symbols-outlined">
                        {{-- expand_more --}}
                     </i>
                  </span>
               </a>

            </li>
            
            <li class="grid__style">
                <a href="javascript:void(0)" class="d-flex">
                   <span>
                      Login
                   </span>
                    <span class="icons">
                       <i class="material-symbols-outlined">
                          expand_more
                       </i>
                    </span>
                 </a>
                <ul class="sub-menu">
                   <!--<li class="subtwohober">-->
                   <!--   <a href="{{url ('/admin/dashboard')}}" target="_blank">Admin</a>-->
                   <!--</li>-->
                   <!--<li><a href="{{url ('/user/dashboard')}}" target="_blank">User</a></li>-->
                   
                    <li class="subtwohober">
                      <a href="{{url ('admin/login')}}" target="_blank">Admin</a>
                   </li>
                   <li><a href="{{url ('userdashboard')}}" target="_blank">User</a></li>
                   
                </ul>
             </li>

         </ul>
         <div class="menu__right__components right__com d-flex align-items-center">
            <div class="menu__components">
                {{-- <a href="javascript:void(0)" class="mode--toggle">
                    <img src="{{url ('frontend/assets/img/sun.png') }}" alt="icon">
               </a> --}}
               <div class="search-button" role="tablist">
                  <!--<button class="nav-link" id="search2" aria-selected="false" tabindex="-1" role="tab">-->
                  <!--    <span class="icons"><i class="material-symbols-outlined">-->
                  <!--      search-->
                  <!--      </i>-->
                  <!--   </span>-->
                  <!--</button>-->
                  <div class="search-popup2" style="display: none;">
                    <div class="search-bg2"></div>
                    <div class="search-form2" style="right: -100%;">
                       <form action="javascript:void(0)">
                        <div class="form">
                          <input type="text" id="searchs2" placeholder="Search">
                        </div>
                      </form>
                    </div>
                  </div>
               </div>
               <div class="tolly__shop">
                    <?php use Illuminate\Http\Request;
                        $user_id = request()->session()->get('FRONT_USER_ID');
                        $articles = App\Models\Cart::where('user_id', $user_id)->count();
                    ?>
                    <a href="{{ url('new-cart')}}" class="iq-cart iq-pos-r"><i class="fa fa-shopping-cart"></i><span class="cart-count">{{$articles}}</span></a> 
                    
                  
               </div>
               <a href="{{url ('/userdashboard')}}" class="cmn--btn" target="_blank">
                  <span>
                     Sign in
                  </span>
               </a>
            </div>
            <div class="header-bar d-lg-none">
               <span></span>
               <span></span>
               <span></span>
            </div>
         </div>
      </div>
   </div>
</header>
<!-- Header top End -->