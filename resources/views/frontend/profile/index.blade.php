@extends('layouts.appprofile')
@section('content')
<!-- ======= Main Section ======= -->

<style>
#youtubeLinkInput{width:300px;padding:8px}#copyLinkBtn{padding:8px 16px;background-color:#4caf50;color:#fff;border:none;cursor:pointer}#myDiv{display:none}.add_classlogo{position:relative;height:178.094px!important}.add_classitem{position:absolute;left:0!important;top:0}.portfolio-infos{position:absolute;margin-top:-25px;background:purple;padding:1px 15px;left:12px;right:12px;opacity:0px;z-index:0}.stiky_main_btn{position:fixed;bottom:58px;right:12px;z-index:11!important;top:106px!important}

</style>
          @php
          $seg = Request::segment(2);
          if($seg == ''){
        $thtmeadat = DB::table('customers')->select('themeprofile','panel_status','animation')->where('id',Session::get('FRONT_USER_ID'))->first();
       }else{
        $thtmeadat = DB::table('customers')->select('themeprofile','panel_status','animation')->where('mobile',$seg)->first();
       }
        @endphp

@if(isset($thtmeadat) && $thtmeadat!='')
@if($thtmeadat->themeprofile == 1 && $thtmeadat->panel_status == 1)
<style>
    .container,.services .icon-box{padding:30px;overflow:hidden;border-radius:20px;position:relative}#footer h3,.hero-box h1,h1,h2,h3,h4,h5,h6{font-family:Lato,sans-serif}#footer h3,.navbar li{font-weight:700;margin:0 0 15px}.header-transparent{background-color:#000!important}#header.header-scrolled{background:#000!important}#hero .container,.container{background:#2e2a2a!important}.navbar li a,.navbar li a:focus{text-decoration:none;color:#fff;align-items:center;justify-content:center;display:flex;position:relative;padding:5px 0;-moz-transition:.3s;-o-transition:.3s;-webkit-transition:.3s;-ms-transition:.3s;transition:.3s}#header .profile h1{font-size:26px!important;padding:10px 0;margin:0;line-height:1;font-weight:600;-moz-text-align-last:center;text-align-last:center;border-bottom:1px solid #fa5b0f;border-top:1px solid #fa5b0f;color:#fff}#main{background:#000}#hero .container{height:100vh;display:flex;justify-content:center;align-items:center;margin-top:15px}.navbar li{padding:5px 10px;display:flex;background:#2e2a2a;border-radius:10px;align-items:center}.about .content ul{list-style:none;padding:0;color:#fff}.about .content ul strong{margin-right:10px;color:#fff1f1}h1,h2,h3,h4,h5,h6{color:#fff}.services .icon-box{background:#000;box-shadow:0 0 10px rgb(255 250 250 / 40%);transition:.3s ease-in-out;text-align:center;border:1px solid #eee}.col-md-6.col-xl-6.d-flex.align-items-stretch.mb-lg-0.wow.swing.animated{color:#fff!important}.services .title a{color:#fff;transition:.3s}.testimonials .testimonial-item p{font-style:italic;margin:0 auto 15px;width:70%;color:#fff}#footer .copyright{margin:0 0 5px;color:#fff}.hero-box h1{margin:0 0 10px;font-size:64px;color:#fff9f9;font-weight:700}#footer h3{font-size:36px;color:#fff;position:relative;padding:0}
  
</style>
@endif
@endif
    <main id="main">
        
        
        @php
        $menu = DB::table('profile_menu')->select('*')->first();
        @endphp
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>   
            <strong>{{ $message }}</strong>
        </div>
        @endif
        
        @if ($message = Session::get('secondary'))
        <div class="alert alert-secondary alert-block" style="width:50%;">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>   
            <strong>{{ $message }}</strong>
        </div>
        @endif
          
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
            <strong>{{ $message }}</strong>
        </div>
        @endif
           
        @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-block">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
            <strong>{{ $message }}</strong>
        </div>
        @endif
           
        @if ($message = Session::get('info'))
        <div class="alert alert-info alert-block">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
            <strong>{{ $message }}</strong>
        </div>
        @endif

    @if ($errors->any())
    <div class="alert alert-danger">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
        Please check the form below for errors
    </div>
    
    @endif
    
      <!-- ======= Hero Section ======= -->
      <section id="hero" class="pt-30 w-100">
        <div class="container" style="height: 850px;">
          <span class="background"></span>
          <div class="row">
            <div class="col-12 wow bounceInUp" data-wow-duration="3s">
              <div class="hero-img">
                <!--<img src="assets/img/hero-bg-2.jpeg" alt="">-->
                      @if($userdata->profile)
                    <!--<img src="{{ url('public/frontend/user_images',$userdata->profile)}}" alt="">-->
                    <img src="{{ url('public/frontend/user_images',$userdata->profile)}}" alt="Image" style="border-radius: 23px;padding: 10px;object-fit: contain;text-align: center;margin: 0 auto;display: block;display:none" width="595" height="480" id="image_show">
                  @else
                   <img src="{{ URL::asset('public/frontend/images/img_avatar3.png') }}" width="595" height="480">
                  @endif
              </div>
            </div>
            <div class="col-12 wow bounceInDown" data-wow-duration="3s">
              <div class="hero-box">
                   <h4>{{$userdata->name}}</h4>
                {{-- <h2>I am <span class="typed"></span></h2> --}}
                <!--<h2> <span class="typed"></span></h2>-->
                <h2 style="color:#800080;">{{$userdata->desig}} </h2>
                <a href="#about" class="btn-scroll scrollto" title="Scroll Down"><i class="fas fa-angle-down"></i></a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Hero -->
      <!-- ======= About Me Section ======= -->
      <section id="about" class="about">
          @if($thtmeadat->animation == 0)
        <div class="container wow fadeInLeftBig animated" data-wow-duration="1.5s">
            @else
            <div class="container" data-wow-duration="1.5s">
            @endif
             @if($thtmeadat->animation == 0)
          <div class="section-title wow fadeInDown animated" data-wow-duration="2s">
              @else
               <div class="section-title">
              @endif
          <div class="section-title wow fadeInDown" data-wow-duration="2s">
            <p class="mt-2" style="position: absolute;color: #8888 !important;left: 0;right: 0;z-index: 1;font-weight: 700;text-transform: capitalize;line-height: 0;">About Us</p>
           
            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>
            <!--h2>ABOUT US</h2-->
            <div class="mt-2">
            <p>{{$userdata->title1}}</p>
            </div>
          </div>
          <div class="row mt-5">

            <div class="col-xl-12 col-md-12 d-flex flex-column align-items-stretch">
              <div class="content ps-lg-4 d-flex flex-column justify-content-center">
                  @if($thtmeadat->animation == 0)
                <div class="row wow fadeInLeft animated" data-wow-duration="2s">
                    @else
                     <div class="row" data-wow-duration="2s">
                    @endif
                  <div class="col-sm-6">
                    <ul>
                      <li><i class="fas fa-arrow-right"></i><strong>Name:</strong> <span>{{$userdata->name}}</span></li>
                      <li><i class="fas fa-arrow-right"></i><strong>Email:</strong> <span>{{$userdata->email}}</span></li>
                      <li><i class="fas fa-arrow-right"></i><strong>Mobile:</strong> <span>{{ ($userdata->country_code ?? '') . ' ' . $userdata->mobile }}</span></li>
                      <li><i class="fas fa-arrow-right"></i><strong>City:</strong> <span>{{$userdata->city}}</span></li>
                      <li><i class="fas fa-arrow-right"></i><strong>State:</strong> <span>{{$userdata->state}}</span></li>
                    </ul> 
                  </div>
                    <div class="social-links" style="margin-left:14%">
                        <a href="{{$social['youtube']??'#'}}" target="_blank" class="youtube"><i class="fab fa-youtube" style="font-size:30px"></i></a>
                        <a href="{{$social['twitter']??'#'}}" target="_blank" class="twitter"><i class="fab fa-twitter" style="margin-left:2%;font-size:30px"></i></a>
                        <a href="{{$social['facebook']??'#'}}" target="_blank" class="facebook" style="margin-left:2%;"><i class="fab fa-facebook-f" style="font-size:30px"></i></a>
                        <a href="{{$social['instagram']??'#'}}" target="_blank" class="instagram" style="margin-left:2%;"><i class="fab fa-instagram" style="font-size:30px"></i></a>
                        <a href="{{$social['snapchat']??'#'}}"  target="_blank" class="google-plus" style="margin-left:2%;"><i class="fab fa-skype" style="font-size:30px"></i></a>
                        <a href="{{$social['linkdin']??'#'}}"  target="_blank" class="linkedin" style="margin-left:2%;"><i class="fab fa-linkedin-in" style="font-size:30px"></i></a>
                    </div>

              </div>
            </div>
          </div>
        </div>
      </section><!-- End About Me Section -->
@if(isset($menu->service) && $menu->service =='0')
      <!-- ======= Our Services Section ======= -->
      <section id="services" class="services">
           @if($thtmeadat->animation == 0)
        <div class="container wow rollIn animated" data-wow-duration="1.5s">
            @else
            <div class="container" data-wow-duration="1.5s">
            @endif

     @if($thtmeadat->animation == 0)
          <div class="section-title wow bounceIn animated" data-wow-duration="3s">
              @else
        <div class="section-title" data-wow-duration="3s">

              @endif
              
              
     <p class="mt-2" style="position: absolute;color: #8888 !important;left: 0;right: 0;z-index: 1;font-weight: 700;text-transform: capitalize;line-height: 0;">OUR SERVICES</p>

            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>

          <div class="row">
              
            <!--<div class="col-md-6 col-xl-3 d-flex align-items-stretch  mb-lg-0 wow swing animated"-->
            <!--  data-wow-duration="3s">-->
            <!--  <div class="icon-box">-->
            <!--    <div class="icon"><i class="fas fa-palette"></i></div>-->
            <!--    <h4 class="title"><a href="#">Producer</a></h4>-->
            <!--    <p class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro autem, enim-->
            <!--      necessitatibus quae ab placeat consectetur velit qui, sint aliquam sunt.</p>-->
            <!--  </div>-->
            <!--</div>-->
            
            @foreach($professions as $profession)
            
            @if($thtmeadat->animation == 0)
                <div class="col-md-6 col-xl-6 d-flex align-items-stretch  mb-lg-0 wow swing animated" data-wow-duration="3s" style="padding:20px">
                  @else
                                  <div class="col-md-6 col-xl-6 d-flex align-items-stretch  mb-lg-0" data-wow-duration="3s" style="padding:20px">

                  @endif
                  <div class="icon-box mt-2">
                    <div class="icon"><!--i class="fas fa-radiation"></i--><img src="{{asset('public/frontend/profession_logo')}}/{{$profession->icon}}" width="50px" height="50px" style="border-radius: 50%;"></div>
                    <h4 class="title"><a href="#">{{$profession->profession}}</a></h4>
                    
                    <p class="description">
                       <strong><b><i class="fa fa-phone" aria-hidden="true"></i></b></strong>
                      <a href="tel:{{$profession->phone}}" style="color:#7841da !important"> <span>{{$profession->phone}}</span></a>
                    </p>
                    
                    <p class="description description_location">
                       <strong><b><i class="fa fa-map-marker" aria-hidden="true"></i></b></strong>
                       <span>{{$profession->location}}</span>
                    </p>
                    
                    <p class="description">
                       <span>
                           <!--<a href="{{$profession->iframe}}"  target="_blank" class="btn btn-primary pt-0 pb-0">View On Maps </a>-->
                            <a href="{{$profession->iframe}}"  target="_blank" class="btn btn-primary pt-0 pb-0">View On Maps </a>

                        </span>
                    </p>
                    
                <p class="description">
                   <strong>
                       <i class="fa fa-address-book-o" aria-hidden="true"></i>
                       <!--<b><i class="fa fa-columns" aria-hidden="true"></i></b>-->
                       </strong>
                   <span>{{$profession->designation}}</span>
                </p>
                
                <p class="description">
                    <a href="{{$profession->website}}" target="_blank">
                   <strong>
                       <img src="{{ URL::asset('frontendnew/images/Website_icon.png') }}">
                       <!--<b><i class="fa fa-columns" aria-hidden="true"></i></b>-->
                       </strong>
                   <span>{{$profession->website}}</span>
                   </a>
                </p>
                <p class="description">
                   <strong>
                       <b><i class="fa fa-envelope-o" aria-hidden="true"></i></b>
                       </strong>
                   <span>{{$profession->email}}</span>
                </p>
                <p class="description_arrow">
                   <strong>Description:</strong>
                   <span>{{$profession->description}}</span>
                </p>
                
                  </div>
                </div>
            @endforeach
            
          </div>
          
          @if(isset($menu->product) && $menu->product == 0)
          
          @php
                $myproductsArray = $myproducts->toArray();
            @endphp
          
          <div class="section-title wow bounceIn animated" data-wow-duration="3s">
              
              @if(isset($myproductsArray) && !empty($myproductsArray))
                <p class="mt-2" style="position: absolute;color: #8888 !important;left: 0;right: 0;z-index: 1;font-weight: 700;text-transform: capitalize;line-height: 0;">OUR PRODUCT</p>
            @endif
            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>
         
          
            <div class="row">
                @foreach($myproductsArray as $myproduct)
                 @php
                  $img = json_decode($myproduct['images']);
                  $nimg = $myproduct['images'];
                 
                  @endphp
                    <div class="col-md-4 mt-2">
                        <div class="portfolio-img wow bounceInRight text-center" data-wow-duration="2.5s" style="padding:10px;margin: 0px 0px 20px 0px;">
                            <button style="border:none;" data-toggle="modal" data-target="#productmyModal" type="button" onClick="getproduct({{$myproduct['images']}})">
                                
                                <img src="{{asset('public/frontend/myproducts')}}/{{$img[0]}}" style="position: absolute;margin-top: 2px;transform: rotate(14deg);margin-left: -23px" width="37">

                                 <!--<img src="{{ url('public/frontend/myproducts/products-img-icon.png') }}" width="70" class="mx-auto d-block" />-->
                            </button>
                            <h4 class="mt-5">{{$myproduct['title']}}</h4>
                            <h4>₹{{$myproduct['price']}}</h4>
                            <button type="button" data-toggle="modal" data-target="#product_modal" class="btn btn-primary" onClick="product_id({{$myproduct['id']}})">Enquiry</button>
                        </div>
                    </div>
                    
                    <!-- Modal -->
                   
                @endforeach
            </div>
             @endif
            

        </div>
        
        
        
         <div class="modal fade" id="productmyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                   
                                   <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" id="imgSourceData">
    
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                                   
                                   
                                       
                                </div>
                            </div>
                        </div>
                    </div>
        
        
        
        <!---product moidal--.
        <!-- Modal -->
<div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="name" class="form-control"  id="namepro" aria-describedby="emailHelp" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">City/Area</label>
    <input type="email" class="form-control" id="area" placeholder="city/area">
     <input type="hidden" class="form-control" id="proid" placeholder="Email">
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Phone</label>
    <input type="text" class="form-control" id="phone" placeholder="Phone">
  </div>
  <p id="prosuccess" class="bg-success text-ceter text-white"></p>
  <button type="button" class="btn btn-primary" onClick="submitEnquerypro()">Submit</button>
</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
      </section><!-- End Our Services Section -->
@endif
      <!-- ======= Testimonials Section ======= -->
      <section id="testimonials">
        <div class="container position-relative testimonials wow fadeIn" data-wow-duration="5s">
          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
            @foreach($thoughts as $thought)
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <!--<img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">-->
                  <h3>{{$thought->thought}}</h3>
                  <!--<h4>Ceo &amp; Founder</h4>-->
                  <p>
                    <i class="fas fa-quote-left"></i>
                     {{$thought->description}}
                    <i class="fas fa-quote-right"></i>
                  </p>
                </div>
              </div><!-- End testimonial item -->
            @endforeach  
            
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </section><!-- End Testimonials Section -->

      <!-- ======= Our Portfolio Section ======= -->
      <section id="portfolio" class="portfolio">
        <div class="container wow fadeInUp" data-wow-duration="1.5s">
            @if($menu->personal == 0 || $menu->profess == 0 || $menu->videos == 0 || $menu->google_map == 0)
                <div class="section-title wow fadeInDown" data-wow-duration="2s">
                           <p class="mt-2" style="position: absolute;color: #8888 !important;left: 0;right: 0;z-index: 1;font-weight: 700;text-transform: capitalize;line-height: 0;">OUR PORTFOLIO</p>

                    <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
                </div>
            @endif
          <ul id="portfolio-flters" class="d-flex justify-content-center wow flipInX animated mt-2" data-wow-duration="2s" style="flex-wrap: wrap;">
              @if($menu->personal == 0 )
            <li data-filter=".filter-app" class="filter-active" id="personal_photos">Personal Photos</li>
            @endif
            
            
             @if($menu->profess == 0 )
            <li class="tab-button" data-filter=".professional_photos" data-toggle="tab" data-target="#professional_photos" id="professional_photos" >Professional Photos</li>
            @endif
            <!--<li data-filter=".filter-app">Videos</li>-->
            <!--<li id="showDivBtn">Videos</li>-->
            
            @if($menu->videos == 0 )
            <li class="tab-button" data-filter=".video" data-toggle="tab" data-target="#video" id="video"> Videos </li>
            @endif
            
            
            @if(Session::get('panel') == 1 && $menu->google_map == 0)
            <!--li class="tab-button" data-filter=".log" data-toggle="tab" data-target="#logo" id="logo">Logo</li-->
            <li class="tab-button" data-filter=".map" data-toggle="tab" data-target="#map" id="map">Map</li>
            @endif
            <!--li class="tab-button" data-filter=".myproducts" data-toggle="tab" data-target="#myproducts" id="myproducts"> Products </li-->
            <!--<li data-filter=".filter-web">My work</li>-->
          </ul>

          <div class="row portfolio-container">


            @foreach($portfolios as $portfolio)
                <div class="col-lg-4 col-sm-6 portfolio-item filter-app personal_photo_class">
                    
                    @foreach(json_decode($portfolio->image) as $image)
                        <div class="portfolio-img wow bounceInLeft" data-wow-duration="2.5s" style="margin: 0px 0px 30px 0px;">
                          <img src="{{ url('public/frontend/portfolio',$image)}}" class="img-fluid" alt="" data-toggle="modal" data-target="#exampleModalCenter" onClick ="getImage(`{{url('public/frontend/portfolio',$image)}}`)">
                        </div>
                    @endforeach
                    
                  <div class="portfolio-infos">
                    <h4 style="color:white">{{$portfolio->title}}</h4>
                  </div>
                </div>
            @endforeach
           
           
            
            <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pofile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
                        
        <img src="" class="img-fluid" alt="" width="100%" height="100%" id="show_images">
                   
      </div>
     
    </div>
  </div>
</div>

            <!--<div class="col-lg-4 col-sm-6 portfolio-item filter-web">-->
            <!--  <div class="portfolio-img wow bounceInUp" data-wow-duration="2.5s"><img-->
            <!--      src="assets/img/portfolio/portfolio_2.jpeg" class="img-fluid" alt=""></div>-->
            <!--  <div class="portfolio-info">-->
            <!--    <h4>Web 3</h4>-->
            <!--    <p>Web</p>-->
            <!--    <a href="assets/img/portfolio/portfolio_2.jpeg" data-gallery="portfolioGallery"-->
            <!--      class="portfolio-lightbox preview-link" title="Web 3"><i class="fas fa-plus"></i></a>-->
            <!--    <a href="portfolio-details.html" class="details-link" title="More Details"><i-->
            <!--        class="fas fa-paperclip"></i></a>-->
            <!--  </div>-->
            <!--</div>-->

            <!--<div class="col-lg-4 col-sm-6 portfolio-item filter-app">-->
            <!--  <div class="portfolio-img wow bounceInRight" data-wow-duration="2.5s"><img-->
            <!--      src="assets/img/portfolio/portfolio_3.jpeg" class="img-fluid" alt=""></div>-->
            <!--  <div class="portfolio-info">-->
            <!--    <h4>App 2</h4>-->
            <!--    <p>App</p>-->
            <!--    <a href="assets/img/portfolio/portfolio_3.jpeg" data-gallery="portfolioGallery"-->
            <!--      class="portfolio-lightbox preview-link" title="App 2"><i class="fas fa-plus"></i></a>-->
            <!--    <a href="portfolio-details.html" class="details-link" title="More Details"><i-->
            <!--        class="fas fa-paperclip"></i></a>-->
            <!--  </div>-->
            <!--</div>-->
 
            <div class="col-lg-4 col-sm-6 portfolio-item video" style="display:none;width:100%;" id="video_div_id">
                     @foreach($videos as $video)
                        <div class="portfolio-img wow bounceInRight" data-wow-duration="2.5s" style="padding:10px;margin: 0px 0px 20px 0px;">
                          <!--<div id="video" class="tab-pane fade"> -->
                                    <!--<div id="video"> -->
                            
                                 <a href="{{$video->video_link}}" target="_blank">{{$video->video_link}}</a>
                             
                            <!--</div>-->
                        </div>
                    @endforeach
            </div>

               @foreach ($professional_photos as $professional_photo)
                    <div class="col-lg-4 col-sm-6 portfolio-item professional_photos" style="display:none;" id="professional_photos_div_id">
                           
                        @foreach(json_decode($professional_photo->image) as $image)
                            <div class="portfolio-img wow bounceInUp" data-wow-duration="2.5s" style="margin: 0px 0px 30px 0px;">
                              <img src="{{url('public/frontend/professional_photos/'.$image)}}" class="img-fluid" alt="Image" data-toggle="modal" data-target="#exampleModalCenter" onClick="getImage(`{{url('public/frontend/professional_photos/'.$image)}}`)">
                            </div>
                         @endforeach  
                         
                        <div class="portfolio-infos">
                            <h4 style="color:white">{{$professional_photo->title}}</h4>
                            <!--<p>App</p>-->
                            <!--<a href="#" data-gallery="portfolioGallery"-->
                            <!--  class="portfolio-lightbox preview-link" title="App 1"><i class="fas fa-plus"></i></a>-->
                            <!--<a href="#" class="details-link" title="More Details"><i-->
                            <!--    class="fas fa-paperclip"></i></a>-->
                         </div>
                          
                    </div>
                @endforeach

                     @php
                    $logo = DB::table('logo')->where('uid',Session::get('FRONT_USER_ID'))->first();
                    $map = DB::table('map')->where('uid',Session::get('FRONT_USER_ID'))->first();
                    @endphp

            @if(isset($logo) && $logo!='')
            <div class="col-lg-4 col-sm-6 portfolio-item logo" style="display:none;" id="logo_div_id">
                    
                  <div class="portfolio-img wow bounceInUp" data-wow-duration="2.5s" style="margin: 0px 0px 30px 0px;">
                              <img src="{{ url('images',$logo->logo)}}" class="img-fluid" alt="Image">
                </div>
                    
                   
            </div>
            
            @endif
            <div class="col-lg-4 col-sm-6 portfolio-item map" style="display:none;width:100%;" id="map_div_id">
                    
                        @if(isset($map) && $map!='')
          
                    
                  <div class="portfolio-img wow bounceInUp" data-wow-duration="2.5s" style="margin: 0px 0px 30px 0px;">
                          <div><?php echo $map->map?></div> 
                </div>
                    
                   
            
            
            @endif
                   
            </div>
            
             
      

        <div class="col-lg-4 col-sm-6 portfolio-item myproducts" style="display:none;width:100%;" id="myproducts_div_id">
            @php
                $myproductsArray = $myproducts->toArray();
            @endphp
            
            
            <div class="row">
                @foreach($myproductsArray as $myproduct)
                    <div class="col-md-4">
                        <div class="portfolio-img wow bounceInRight text-center" data-wow-duration="2.5s" style="padding:10px;margin: 0px 0px 20px 0px;">
                            <button style="border:none;" type="button" data-toggle="modal" data-target="#myModal{{$myproduct['id']}}">
                                 <img src="{{ url('public/frontend/myproducts/products-img-icon.png') }}" width="70" class="mx-auto d-block" />
                            </button>
                            <h4>{{$myproduct['title']}}</h4>
                        </div>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="myModal{{$myproduct['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$myproduct['title']}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach(json_decode($myproduct['images'], true) as $image)
                                        <!--<img src="{{url('public/frontend/myproducts/' . $image)}}" class="img-fluid" alt="Product Image">-->
                                        <img src="{{url('public/frontend/myproducts/' . $image)}}" class="img-fluid" alt="Product Image" style="height: 150px; object-fit: cover;">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        
         



                
            <!-- anand end code myproducts section -->
            
            <!--<div class="col-lg-4 col-sm-6 portfolio-item filter-web">-->
            <!--  <div class="portfolio-img wow bounceInDown" data-wow-duration="2.5s"><img-->
            <!--      src="assets/img/portfolio/portfolio_5.jpeg" class="img-fluid" alt=""></div>-->
            <!--  <div class="portfolio-info">-->
            <!--    <h4>Web 2</h4>-->
            <!--    <p>Web</p>-->
            <!--    <a href="assets/img/portfolio/portfolio_5.jpeg" data-gallery="portfolioGallery"-->
            <!--      class="portfolio-lightbox preview-link" title="Web 2"><i class="fas fa-plus"></i></a>-->
            <!--    <a href="portfolio-details.html" class="details-link" title="More Details"><i-->
            <!--        class="fas fa-paperclip"></i></a>-->
            <!--  </div>-->
            <!--</div>-->

            <!--<div class="col-lg-4 col-sm-6 portfolio-item filter-app">-->
            <!--  <div class="portfolio-img wow bounceInRight" data-wow-duration="2.5s"><img-->
            <!--      src="assets/img/portfolio/portfolio_6.jpeg" class="img-fluid" alt=""></div>-->
            <!--  <div class="portfolio-info">-->
            <!--    <h4>App 3</h4>-->
            <!--    <p>App</p>-->
            <!--    <a href="assets/img/portfolio/portfolio_6.jpeg" data-gallery="portfolioGallery"-->
            <!--      class="portfolio-lightbox preview-link" title="App 3"><i class="fas fa-plus"></i></a>-->
            <!--    <a href="portfolio-details.html" class="details-link" title="More Details"><i-->
            <!--        class="fas fa-paperclip"></i></a>-->
            <!--  </div>-->
            <!--</div>-->

            <!--<div class="col-lg-4 col-sm-6 portfolio-item filter-card">-->
            <!--  <div class="portfolio-img wow bounceInLeft" data-wow-duration="2.5s"><img-->
            <!--      src="assets/img/portfolio/portfolio_7.jpeg" class="img-fluid" alt=""></div>-->
            <!--  <div class="portfolio-info">-->
            <!--    <h4>Card 1</h4>-->
            <!--    <p>Card</p>-->
            <!--    <a href="assets/img/portfolio/portfolio_7.jpeg" data-gallery="portfolioGallery"-->
            <!--      class="portfolio-lightbox preview-link" title="Card 1"><i class="fas fa-plus"></i></a>-->
            <!--    <a href="portfolio-details.html" class="details-link" title="More Details"><i-->
            <!--        class="fas fa-paperclip"></i></a>-->
            <!--  </div>-->
            <!--</div>-->

            <!--<div class="col-lg-4 col-sm-6 portfolio-item filter-card">-->
            <!--  <div class="portfolio-img wow bounceInUp" data-wow-duration="2.5s"><img-->
            <!--      src="assets/img/portfolio/portfolio_8.jpeg" class="img-fluid" alt=""></div>-->
            <!--  <div class="portfolio-info">-->
            <!--    <h4>Card 3</h4>-->
            <!--    <p>Card</p>-->
            <!--    <a href="assets/img/portfolio/portfolio_8.jpeg" data-gallery="portfolioGallery"-->
            <!--      class="portfolio-lightbox preview-link" title="Card 3"><i class="fas fa-plus"></i></a>-->
            <!--    <a href="portfolio-details.html" class="details-link" title="More Details"><i-->
            <!--        class="fas fa-paperclip"></i></a>-->
            <!--  </div>-->
            <!--</div>-->

            <!--<div class="col-lg-4 col-sm-6 portfolio-item filter-web">-->
            <!--  <div class="portfolio-img wow bounceInRight" data-wow-duration="2.5s"><img-->
            <!--      src="assets/img/portfolio/portfolio_9.jpeg" class="img-fluid" alt=""></div>-->
            <!--  <div class="portfolio-info">-->
            <!--    <h4>Web 3</h4>-->
            <!--    <p>Web</p>-->
            <!--    <a href="assets/img/portfolio/portfolio_9.jpeg" data-gallery="portfolioGallery"-->
            <!--      class="portfolio-lightbox preview-link" title="Web 3"><i class="fas fa-plus"></i></a>-->
            <!--    <a href="portfolio-details.html" class="details-link" title="More Details"><i-->
            <!--        class="fas fa-paperclip"></i></a>-->
            <!--  </div>-->
            <!--</div>-->
            <!--<div class="col-lg-4 col-sm-6 portfolio-item filter-web">-->
            <!--    <div class="portfolio-img wow bounceInRight" data-wow-duration="2.5s"><img-->
            <!--        src="assets/img/portfolio/portfolio_10.jpeg" class="img-fluid" alt=""></div>-->
            <!--    <div class="portfolio-info">-->
            <!--      <h4>Web 3</h4>-->
            <!--      <p>Web</p>-->
            <!--      <a href="assets/img/portfolio/portfolio_10.jpeg" data-gallery="portfolioGallery"-->
            <!--        class="portfolio-lightbox preview-link" title="Web 3"><i class="fas fa-plus"></i></a>-->
            <!--      <a href="portfolio-details.html" class="details-link" title="More Details"><i-->
            <!--          class="fas fa-paperclip"></i></a>-->
            <!--    </div>-->
            <!--  </div>-->
          </div>
        </div>
      </section>
     <!-- End Our Portfolio Section -->

<!-- anand start code for Our Qualification -->



@if(Session::get('panel')==1 && $menu->client == 0)
<section id="qualification" class="services">
     @if($thtmeadat->animation == 0)
        <div class="container wow rollIn animated" data-wow-duration="1.5s">
            @else
             <div class="container " data-wow-duration="1.5s">
            @endif
 @if($thtmeadat->animation == 0)
          <div class="section-title wow bounceIn animated" data-wow-duration="3s">
              @else
              <div class="section-title" data-wow-duration="3s">
              @endif
            <span>OUR LOGO</span>
          
            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>

          <div class="row">
            
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  
  <div class="carousel-inner">
        @if(isset($logo) && $logo !='')
      
     
      <img class="d-block w-100" src="{{asset('images')}}/{{$logo->logo}}" alt="First slide">
     @endif
    
  </div>
  
  
  
 
</div>
            
            
          </div>
        </div>
      </section>
@endif


@if(Session::get('panel')==1 && $menu->block == 0)
<section id="qualification" class="services">
        @if($thtmeadat->animation == 0)
        <div class="container wow rollIn animated" data-wow-duration="1.5s">
            @else
             <div class="container " data-wow-duration="1.5s">
            @endif
 @if($thtmeadat->animation == 0)
          <div class="section-title wow bounceIn animated" data-wow-duration="3s">
              @else
                        <div class="section-title" data-wow-duration="3s">

              @endif
            <span>OUR BLOGS</span>
            
            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>

          <div class="row">
              
              @php
              $blogs = DB::table('blocks')->select('*')->where('uid',Session::get('FRONT_USER_ID'))->orderby('id','DESC')->get();
              @endphp
              
            
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  
  <div class="carousel-inner">
        @if(isset($blogs) && $blogs !='')
      
      @foreach($blogs as $key => $b)
      <?php
     if($key == 0){
         $active = 'active';
     }else{
         $active = '';
     }
      
      ?>
      
    <div class="carousel-item {{$active}}">
      <img class="d-block w-100" src="{{asset('images')}}/{{$b->image}}" alt="First slide">
       <div class="portfolio-info">
                    <h4 class="text-center mt-2"><b>{{$b->title}}</b></h4>
                    
                  </div>
    </div>
    
    
    @endforeach
    
    @endif
    
  </div>
  
  
  
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
            
            
          </div>
        </div>
      </section>
@endif

@if($menu->quali == 0)
    <section id="qualification" class="services">
        @if($thtmeadat->animation == 0)
        <div class="container wow rollIn animated" data-wow-duration="1.5s">
            @else
             <div class="container " data-wow-duration="1.5s">
            @endif
 @if($thtmeadat->animation == 0)
          <div class="section-title wow bounceIn animated" data-wow-duration="3s">
              @else
              <div class="section-title" data-wow-duration="3s">
              @endif
<p class="mt-2" style="position: absolute;color: #8888 !important;left: 0;right: 0;z-index: 1;font-weight: 700;text-transform: capitalize;line-height: 0;">QUALIFICATION</p>

            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>

          <div class="row mt-2">
            @foreach($qualifications as $qualifications_List)
            
             @if($thtmeadat->animation == 0)
                        <div class="col-md-4 col-xl-4 d-flex align-items-stretch  mb-lg-0 wow swing animated" data-wow-duration="3s" style="padding:20px">

              @else
                             <div class="col-md-4 col-xl-4 d-flex align-items-stretch  mb-lg-0" data-wow-duration="3s" style="padding:20px">

              @endif
                  <div class="icon-box">
                    <div class="icon"><i class="fas fa-radiation"></i></div>
                    <h4 class="title"><a href="#">{{$qualifications_List->qualifiaction}}</a></h4>
                    
                <p class="description_arrow">
                   <strong>Description:</strong>
                   <span>{{$qualifications_List->description}}</span>
                </p>
                
                  </div>
                </div>
            @endforeach
            
          </div>
        </div>
      </section>
@endif
<!-- anand end code for Our Qualification -->

<!-- anand start code for Our PDF -->
@if($menu->upload_file == 0)
    <section id="pdf" class="services">
        @if($thtmeadat->animation == 0)
        <div class="container wow rollIn animated" data-wow-duration="1.5s">
            @else
             <div class="container " data-wow-duration="1.5s">
            @endif

@if($thtmeadat->animation == 0)
          <div class="section-title wow bounceIn animated" data-wow-duration="3s">
              @else
              <div class="section-title" data-wow-duration="3s">
              @endif
         <p class="mt-2" style="position: absolute;color: #8888 !important;left: 0;right: 0;z-index: 1;font-weight: 700;text-transform: capitalize;line-height: 0;">OUR PDF</p>
   
           
            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>

   
          
          @isset($myfiles)
			<!--<div class='card'>-->
				<div class='card_table_data mt-2'>
			    <div class='card-header'>
			        Our PDF
			    </div>
			    <div class='card-body'>
			        <div class='row'>
			            @foreach(json_decode($myfiles) as $files)
    			            <div class='col-3 text-center mt-2'>
    			               <a href="{{asset('public')}}/{{$files}}" title='{{asset($files)}}' download> <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>
    			            </div>
			            @endforeach
			             
			        </div>
			    </div>
			</div>
		@endisset
        </div>
      </section>
      @endif

<!-- anand end code for Our PDF -->

<!-- anand start code for Our PDF -->
@if($menu->download == 0 && Session::get('panel')==1)
    <section id="pdf" class="services">
         @if($thtmeadat->animation == 0)
        <div class="container wow rollIn animated" data-wow-duration="1.5s">
            @else
             <div class="container " data-wow-duration="1.5s">
            @endif

          <div class="section-title wow bounceIn animated" data-wow-duration="3s">
                    <p class="mt-2" style="position: absolute;color: #8888 !important;left: 0;right: 0;z-index: 1;font-weight: 700;text-transform: capitalize;line-height: 0;">OUR RESUME</p>

            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>

   @php
   $pdf = DB::table('pdf')->where('uid',Session::get('FRONT_USER_ID'))->first();
   @endphp
          
          @isset($pdf)
			<!--<div class='card'>-->
				<div class='card_table_data'>
			    <div class='card-header'>
			        My Resume
			    </div>
			    <div class='card-body'>
			        <div class='row'>
			           
    			            <div class='col-3 text-center mt-2'>
    			               <a href="{{asset('images')}}/{{$pdf->pdf}}" download> <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>
    			            </div>
			           
			             
			        </div>
			    </div>
			</div>
		@endisset
        </div>
      </section>
      @endif
      
      @if($menu->achievment == 0 && Session::get('panel')==1)
       <section id="pdf" class="services">
         @if($thtmeadat->animation == 0)
        <div class="container wow rollIn animated" data-wow-duration="1.5s">
            @else
             <div class="container " data-wow-duration="1.5s">
            @endif
@if($thtmeadat->animation == 0)
          <div class="section-title wow bounceIn animated" data-wow-duration="3s">
              @else
              <div class="section-title" data-wow-duration="3s">
              @endif
            <span>OUR ACHIEVEMENT</span>
           
            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>

   @php
   $achive = DB::table('achive')->where('uid',Session::get('FRONT_USER_ID'))->first();
   @endphp
          
          @isset($achive)
			<!--<div class='card'>-->
				<div class='card_table_data'>
			    <div class='card-header'>
			        My Achievement
			    </div>
			    <div class='card-body'>
			        <div class='row'>
			           
    			            <div class='col-3 text-center mt-2'>
    			               <a href="{{asset('images')}}/{{$achive->image}}" title='' download> <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>
    			            </div>
			           
			             
			        </div>
			    </div>
			</div>
		@endisset
        </div>
        
      </section>
     
@endif


@if($menu->achievment == 0 && Session::get('panel')==1)
       <section id="pdf" class="services">
        @if($thtmeadat->animation == 0)
        <div class="container wow rollIn animated" data-wow-duration="1.5s">
            @else
             <div class="container " data-wow-duration="1.5s">
            @endif

 @if($thtmeadat->animation == 0)
        <div class="section-title wow bounceIn animated" data-wow-duration="3s">
            @else
              <div class="section-title" data-wow-duration="3s">
            @endif
         
            <span>OUR CLIENTS</span>
           
            <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
          </div>

   @php
   $achive = DB::table('achive')->where('uid',Session::get('FRONT_USER_ID'))->first();
   @endphp
          
          @isset($achive)
			<!--<div class='card'>-->
				<div class='card_table_data'>
			    <div class='card-header'>
			        My Clients
			    </div>
			    <div class='card-body'>
			        <div class='row'>
			           
    			            
			           <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                    @php
              $clients = DB::table('clients')->select('*')->where('uid',Session::get('FRONT_USER_ID'))->orderby('id','DESC')->get();
              $number = 1;
              @endphp
  <div class="carousel-inner">
        @if(isset($clients) && $clients !='')
      
      @foreach($clients as $key => $b)
      <?php
     if($key == 0){
         $active = 'active';
     }else{
         $active = '';
     }
      
      ?>
      
    <div class="carousel-item {{$active}}">
        
        <div class="row">
            @foreach($clients as $img)
           
         <div class="col-lg-4">
             <img class="d-block" src="{{asset('images')}}/{{$img->image}}" alt="First slide" width="200" height="200" style="border-radius:50%">
       <div class="portfolio-info">
    <h4 class="text-center mt-2"><b>{{$b->name}}</b></h4>
    </div>
             
         </div>
         
         @endforeach
        </div>
      
    </div>
    
    
    @endforeach
    
    @endif
    
  </div>
  
  
  
  <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
			             
			        </div>
			    </div>
			</div>
		@endisset
        </div>
        
      </section>
     
@endif
<!-- anand end code for Our PDF -->



  <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
  
  
  <script  src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  
      <script>
// $(document).ready(function(){
//   $(".pera_right_arrow").click(function(){
//     $(".description_arrow").toggle();
//   });


// document.getElementById("showDivBtn").addEventListener("click", function() {
//   var myDiv = document.getElementById("myDiv");
//   if (myDiv.style.display === "none") {
//     myDiv.style.display = "block";
//   } else {
//     myDiv.style.display = "none";
//   }
// });


// document.getElementById("copyLinkBtn").addEventListener("click", function() {
//   var linkInput = document.getElementById("youtubeLinkInput");
//   linkInput.select();
//   linkInput.setSelectionRange(0, 99999);
//   document.execCommand("copy");
// });





// anand start code 
// $(document).ready(function(){
//     alert('hi')
// document.getElementById('video').addEventListener('click', function() {
//     alert('video alert');
//     //var videoBlock = document.getElementById('video_div_id');
//   // videoBlock.style.display = (videoBlock.style.display === 'none') ? 'block' : 'none';
//     document.getElementById("video_div_id").style.diplay="block"; // line 1

// });

// document.getElementById('professional_photos').addEventListener('click', function() {
//     var professional_photosBlock = document.getElementById('professional_photos_div_id');
//     professional_photosBlock.style.display = (professional_photosBlock.style.display === 'none') ? 'block' : 'none';
// });

// });
// });


    $(document).ready(function(){
    //   alert("asdf"); 
    
    // Show professional photos section when the button is clicked
      $("#professional_photos").click(function() {
        // $("#professional_photos_div_id").show();
            $(".professional_photos").show();
            $("#video_div_id").hide();
            $(".personal_photo_class").hide();
            $("#myproducts_div_id").hide();
            $(".logo").hide();
            $(".map").hide();
            $(".portfolio-container").removeClass('add_classlogo');
            $(".portfolio-item").removeClass('add_classitem');
            
      });
      // Toggle visibility of videos section
    $("#video").click(function() {
        //   alert('video alert');
        $("#video_div_id").show();
        $(".portfolio-container").removeClass('add_classlogo');
            $(".portfolio-item").removeClass('add_classitem');
        // $("#professional_photos_div_id").hide();
        $(".personal_photo_class").hide();
        $(".professional_photos").hide();
        $("#myproducts_div_id").hide();
        $(".logo").hide();
        $(".map").hide();
      });  
      
        $("#personal_photos").click(function() {
           //alert('video alert');
        $(".personal_photo_class").show();
        // $("#professional_photos_div_id").hide();
        $(".portfolio-container").removeClass('add_classlogo');
            $(".portfolio-item").removeClass('add_classitem');
        $("#video_div_id").hide();
        $(".professional_photos").hide();
        $("#myproducts_div_id").hide();
        $(".logo").hide();
        $(".map").hide();
      });
      
        $("#myproducts").click(function() {
               //alert('myproducts alert');
               $(".portfolio-container").removeClass('add_classlogo');
            $(".portfolio-item").removeClass('add_classitem');
            $("#myproducts_div_id").show();
            $("#video_div_id").hide();
            // $("#professional_photos_div_id").hide();
            $(".personal_photo_class").hide();
            $(".professional_photos").hide();
            $(".logo").hide();
            $(".map").hide();
            
            
         }); 
         
         
         $("#logo").click(function() {
               //alert('myproducts alert');
            $(".logo").show();
            $(".portfolio-container").addClass('add_classlogo');
            $(".portfolio-item").addClass('add_classitem');
            
            $(".personal_photo_class").hide();
            $(".professional_photos").hide();
            $(".map").hide();
            
           
            
         }); 
         
         $("#map").click(function() {
               //alert('myproducts alert');
            $(".map").show();
            $(".portfolio-container").removeClass('add_classlogo');
            $(".portfolio-item").removeClass('add_classitem');
            $(".personal_photo_class").hide();
            $(".professional_photos").hide();
             $(".logo").hide();
           
            
         }); 
         
         
  
    });
// anand end code -->


function getImage(img){
    $("#show_images").attr("src",img);
}


function getproduct(img){
    
var imgData = img;
$.each(imgData, function( key, value ) {
    if(key == 0){
        var classActive = 'active';
    }else{
        var classActive = ''
    }
    
   
    $("#imgSourceData").append('<div class="carousel-item '+classActive+'"><img class="d-block w-100" src="https://fastap.in/public/frontend/myproducts/'+value+'"></div>');
  
});
}

function product_id(id){
    $("#proid").val(id)
}


function submitEnquerypro(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    
    var namepro = $("#namepro").val();
    var area = $("#area").val();
    var phone = $("#phone").val();
     var proid = $("#proid").val();
     
     if(namepro == ''){
         alert('Name is required');
         return false;
     }
     
     if(area == ''){
         alert('Area/City is required');
         return false;
     }
     
     if(phone == ''){
         alert('Phone is required');
         return false;
     }
     
     
    
    $.ajax({
        url: '{{url("product_enquery")}}',
        type: 'POST',
        data: {
        name:namepro,
        area:area,
        phone:phone,
        proid:proid,
        },
        dataType: 'JSON',
        success: function (data) {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $('#product_modal').hide();
            $('#namepro, #area, #phone, #proid').val('');
        }
                    
        }); 
    
    
}




$(document).ready(function(){
  
    $("#image_show").show();
  
});



</script>

@endsection
