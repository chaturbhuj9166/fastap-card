<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@include('layouts.golden.header')
       @php
        $menu = DB::table('profile_menu')->select('*')->first();
        $logo = DB::table('logo')->where('uid',Session::get('FRONT_USER_ID'))->first();
        $map = DB::table('map')->where('uid',Session::get('FRONT_USER_ID'))->first();
                 
        $headings = DB::table('headings')->where('userid',Session::get('FRONT_USER_ID'))->first();
        @endphp
  <body>
    <!-- Animated Background -->
    <div class="lm-animated-bg" style="background-image: url({{asset('golden/img/main_bg.png')}});"></div>
    <!-- /Animated Background -->

    <!-- Loading animation -->
    <div class="preloader">
      <div class="preloader-animation">
        <div class="preloader-spinner">
        </div>
      </div>
    </div>
    <!-- /Loading animation -->
<style>
.help__box {
  max-width: 400px;
  margin: 20px auto;
  padding: 20px;
  background: #fff;
  border: 1px solid #e0e0ff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  text-align: center;
  font-family: 'Segoe UI', sans-serif;
}

.icon3 {
  display: inline-block;
  background: #f6f6ff;
  padding: 12px;
  border-radius: 50%;
  margin-bottom: 12px;
}

.icon3 i {
  font-size: 28px;
  color: #6c63ff;
}

.cont h5 {
  margin: 10px 0;
  font-weight: 600;
  font-size: 18px;
  color: #333;
}

.address-text {
  font-size: 14px;
  color: #555;
  line-height: 1.5;
  margin: 8px 0 16px;
}

.map-btn {
  display: inline-block;
  padding: 8px 14px;
  background-color: #6c63ff;
  color: #fff;
  text-decoration: none;
  border-radius: 6px;
  transition: background-color 0.3s ease;
}

.map-btn:hover {
  background-color: #4e48c8;
}


.btn.active-tab {
    background-color: #1b9fad;
    color: white;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(108, 99, 255, 0.3);
    cursor: pointer;
}
.testimonial {
    text-align: center;
    border: 2px solid #1b9fad;
    border-radius: 20px;
    margin: 45px 2px 10px;
    padding: 0 25px 15px 25px;
    box-shadow: 0px 0px #e5e6e7;
}
.portfolio-item-img {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
}

.tetimonialproduct img {
    max-width: 200px !important;
    max-height: 200px !important;
    margin: -45px auto 20px;
   border-radius: 10px;
    box-shadow: 0px 10px 10px -8px rgba(0, 0, 0, .22);
}
.title-block {
    display: flex;
    justify-content: center; /* Center the entire block horizontally */
    align-items: center; /* Center vertically (if needed) */
    flex-direction: column; /* Stack items vertically */
}

.btn-primary:hover, .btn-primary:focus, button:hover, button:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus {
    background: #2e3441;
    color: #fff;
    border: 2px solid #04b4e0;
}

.socilinkdiv{
    background: #1f2130;
    height: -21px;
    padding: 9px;
    border-radius: 5px;
}
.animated-section{
   background: linear-gradient(135deg, #2e3441, #2c2c2c);
   color:white;
}

.social-links-about ul li {
    display: inline-block;
    padding-left: 19px;
}

.cirlce_profile-about {
    width: 137px;
    height: 141px;
    /*border-radius: 50%;*/
    margin-top: -32%;
}

.defaultnone{
    display:none;
}

.displayblock{
    display:block !important;
}

.default{
    background: white;
    color: black;
    border: none;
}

.green{
    background: #28a745;
    color: white;
    border: none;
}


span.innertexticon {
    color: black;
}
.stiky_main_btn{
    display:none;
    
}

.cursor-pointer{
    display:none;
}

.headinbgcolor{
    order: 1px solid;
    border-left: 0px;
    border-radius: 0px 11px 11px 0px;
    padding: 6px;
    color: white;
    background-color: #1a9fad;
}

.pdf-container {
      display: flex;
      align-items: center;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 12px;
      width: 300px;
    }
    .pdf-icon {
      width: 40px;
      height: 40px;
      background-color: #d32f2f;
      border-radius: 4px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #ffffff;
      font-weight: bold;
      font-size: 18px;
      margin-right: 12px;
    }
    .pdf-details {
      flex-grow: 1;
    }
    .pdf-title {
      font-size: 14px;
      font-weight: bold;
      color: #333333;
      margin: 0;
    }
    .pdf-size {
      font-size: 12px;
      color: #777777;
      margin: 4px 0 0;
    }
  .newanimationonbanner{
    padding:0px !important;
  }
  
  .social-links ul li {
    display: inline-block;
    padding-left: 24px;
}
  
  .bgimage{
      width:100%;
      height: auto;
      display: block;
  }
  .card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #2e3441;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 1.25rem;
    
    
  color: #fff !important;
  border-radius: 15px !important;
  padding: 20px !important;
  max-width: 400px !important;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3) !important;
    
}
.cirlce_profile {
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    width: 120px; /* Adjust width */
    height: 120px; /* Adjust height */
    border-radius: 50%; /* Circular container */
    overflow: hidden; /* Ensure circular shape */
}
  @media only screen and (max-width: 600px) {
  .cirlce_profile{
      width: 140px;
      height: 141px;
      border-radius: 50%;
      margin-top: -33% !important;
  }
  
  .cardmargin{
      margin-top: -104%;
  }
  
  .cirlce_profile-about {
   
    margin-top: 0%;
}
  
  .stiky_main_btn{
    display:block;
    
}

.cursor-pointer{
    display:block;
}
  
  .mobilefooter{
      display:block !important;
  }
  
  .bgimage{
      width:100%;
      height: auto !important;
      display: block;
  }
  
}
  
  .mobilefooter{
      display:none;
  }
  .profile-img {
    max-width: 200px;
    max-height: 200px;
    padding: 0px !important;
    object-fit: cover;
    border-radius: 170px;
}

.user-name {
    margin-top: 20px;
    text-transform: capitalize;
    font-size: 20px;
}

.social-links {
    margin-top: 16px;
}

@media (max-width: 768px) {
    .profile-img {
        max-width: 150px;
        max-height: 150px;
    }
    .user-name {
        font-size: 18px;
    }
    .circle_profile-about {
        display: flex;
        justify-content: center; /* Center image horizontally */
        width: 100%;
    }
}
@media (max-width: 768px) {
    
    .profile-img {
        max-width: 150px;
        max-height: 150px;
        margin: 0 auto; /* Ensures it's centered */
    }
}
.lm-info-block h4{
    color: #04b4e0;
    font-weight: 600;
}
.lm-info-block{
    border-radius: 20px;
}
.block-title h3{
    font-size: 25px;
}
.block-title{
    margin-bottom: 0px !important;
    padding-bottom: 0px !important;
}
.form-control{
  background-color: #fff !important;
  color: #495057;
}
.no-data {
  position: relative !important;
  color: #1b9fad;
  text-align: center;
  font-family: Arial, sans-serif;
}
.no-data h3 {
    font-size: 18px;
    font-weight: 600 !important;
}
.page-title.contact {
    padding-bottom: 0px !important;
    margin-bottom: 20px !important;
}
</style>
    <div class="page">
      <div class="page-content">

          <header id="site_header" class="header mobile-menu-hide">
          <p class="rcorners2"> <img src="{{ url('public/frontend/user_images',$userdata->banner)}}" alt=""></p>
            <div class="header-content">
           

              <div class="header-photo">
                  
                  @if($userdata->profile)
                    <!--<img src="{{ url('public/frontend/user_images',$userdata->profile)}}" alt="">-->
                                    <img src="{{ url('public/frontend/user_images',$userdata->profile)}}" alt="">
                                    @else
                <img src="{{asset('golden/img/main_photo.jpg')}}" alt="" style="width:100%;height:auto;display: block;">
                  @endif
                  
              </div>
              <div class="header-titles">
                <h2 style="text-transform: capitalize;">{{$userdata->name}}</h2>
                <h4>{{$userdata->desig}}</h4>
              </div>
            </div>

            <ul class="main-menu">
              <li class="active">
                <a href="#home" class="nav-anim">
                  <span class="menu-icon lnr lnr-home"></span>
                  <span class="link-text">Home</span>
                </a>
              </li>
              <li>
                <a href="#about-me" class="nav-anim">
                  <span class="menu-icon lnr lnr-user"></span>
                  <span class="link-text">About Me</span>
                </a>
              </li>
              <li>
                <a href="#resume" class="nav-anim">
                  <span class="menu-icon lnr lnr-graduation-hat"></span>
                  <span class="link-text">PDF</span>
                </a>
              </li>
              <li>
                <a href="#portfolio" class="nav-anim">
                  <span class="menu-icon lnr lnr-briefcase"></span>
                  <span class="link-text">Portfolio</span>
                </a>
              </li>
              <li>
                <a href="#blog" class="nav-anim">
                  <span class="menu-icon lnr lnr-book"></span>
                  <span class="link-text">Blog</span>
                </a>
              </li>
              <li>
                <a href="#contact" class="nav-anim">
                  <span class="menu-icon lnr lnr-envelope"></span>
                  <span class="link-text">Contact</span>
                </a>
              </li>
            </ul>

            <div class="social-links" style="margin-left: -28px;">
              <!--<ul>-->
                  
              <!--     <li><a href="{{isset($social->instagram)? $social->instagram :'javascript:void(0)'}}"><i class="fab fa-instagram"></i></a></li>-->
              <!--  <li><a href="{{isset($social->facebook)?$social->facebook:'javascript:void(0)'}}" ><i class="fab fa-facebook-f"></i></a></li>-->
              <!--  <li><a href="{{isset($social->youtube)?$social->youtube:'javascript:void(0)'}}"><i class="fab fa-youtube"></i></a></li>-->
              <!--  <li><a href="{{isset($social->twitter)?$social->twitter:'javascript:void(0)'}}" ><i class="fab fa-twitter"></i></a></li>-->
              <!--  <li><a href="{{isset($social->pinterest)?$social->pinterest:'javascript:void(0)'}}"><i class="fab fa-pinterest"></i></a></li>-->
              <!--                     <li><a href="#"><i class="fab fa-skype"></i></a></li>-->

              <!--</ul>-->
              
              
             
              <ul>
                <li><a  href='{{isset($social->instagram)?$social->instagram:"javascript:void(0)"}}' 
                
                <?php
                if(!isset($social->instagram)){
                
                ?>
                onclick="alert('No Link')"
                <?php }?>

                ><i class="fab fa-instagram"></i></a></li>
                <li><a href="{{isset($social->facebook)?$social->facebook:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->facebook)){
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><i class="fab fa-facebook-f" ></i></a></li>
                <li><a href="{{isset($social->youtube)?$social->youtube:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->youtube)){
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><i class="fab fa-youtube" ></i></a></li>
                <li><a href="{{isset($social->twitter)?$social->twitter:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->twitter)){
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="{{isset($social->pinterest)?$social->pinterest:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->pinterest)){
                
                ?>
                onclick="alert('No Link')"
                <?php }?>
                
                ><i class="fab fa-pinterest"  ></i></a></li>

                <li><a href="{{isset($social->twitter)?$social->twitter:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->skype)){
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><i class="fab fa-skype" ></i></a>
                
                </li>
                <li><a href="{{isset($social->google_review)?$social->google_review:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->google_review)){
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><i class="fa-brands fa-google"></i></a>
                
                </li>
                 <li><a href="{{isset($social->linkdin)?$social->linkdin:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->linkdin)){
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><i class="fa-brands fa-linkedin"></i></a>
                
                </li>
              
              </ul>
              
              
            </div>

            <!--<div class="header-buttons">-->
            <!--  <a href="{{url('/userdashboard')}}" target="_blank" class="btn btn-primary">Back To Dashboard</a>-->
            <!--</div>-->

            <div class="copyrights">© 2025 All rights reserved by fastap.</div>
          </header>

          <!-- Mobile Navigation -->
          <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <!-- End Mobile Navigation -->
<style>
    
    .stiky_main_btn ul li i {
    background: #392779;
    color: #fff !important;
    padding: 14px 15px;
    margin-bottom: 3px;
    border-radius: 23px;
    font-size: 17px;
    list-style-type:none;
}

li {
    list-style-type: none;
}
.stiky_main_btn {
    position: fixed;
    bottom: 58px;
    left: 14%;
    z-index: 11 !important;
    top: 42% !important;
    display:none;
}
    .stiky_main_btn button.btn {
    background: #392779;
    border-color: #392779;
}

.btn-section, .btn-section-left {
    position: absolute;
    top: 50%;
    z-index: 9;
}

.btn-section .fixed-btn-section {
    align-items: center;
    display: flex;
    position: fixed;
   top: 62%;
   
}

.btn-section .fixed-btn-section .bars-btn {
    align-items: center;
    border-radius: 50%;
    display: flex;
    height: 60px;
    justify-content: center;
    min-width: 60px;
    width: 60px;
}

.bardiv{
    width:157px;
    height:42px;
   border-radius: 20px;
    margin-top:10px;
    background:white;
    text-align: center;
    color:black;
    border: 1px solid #1b9fad;
}

.rounded {
    border-radius: 0.70rem !important;
}




</style>






  
          <!-- Arrows Nav -->
          
          <div class="btn-section cursor-pointer " id="main-wrapperd">
                <div class="fixed-btn-section fab-btn floating-snap-btn-wrapper" id="">
                                            <div class="bars-btn salon-bars-btn ">
                        <img src="{{ asset('golden/img/sticky.png') }}"/>

                            <!--<img src="https://smartcardsolution.in/assets/img/vcard15/sticky.png">-->
                        </div>
                                        <div class="sub-btn" style="display: none;">
                        <div class="sub-btn-div ">
                                                            <div class="icon-search-container mb-3" data-ic-class="search-trigger">
                                    <div class="wp-btn">
                                        <svg class="svg-inline--fa fa-whatsapp text-light fa-2x" id="wpIcon" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="whatsapp" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg><!-- <i class="fab text-light  fa-whatsapp fa-2x" id="wpIcon"></i> Font Awesome fontawesome.com -->
                                    </div>
                                    <input type="number" class="search-input" id="wpNumber" data-ic-class="search-input" placeholder="Enter Phone No.">
                                    <div class="share-wp-btn-div">
                                        <a href="javascript:void(0)" class="vcard15-sticky-btn vcard15-btn-group d-flex justify-content-center align-items-center text-light rounded-0 text-decoration-none py-1 rounded-pill justify-content share-wp-btn">
                                            <svg class="svg-inline--fa fa-paper-plane" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path></svg><!-- <i class="fa-solid fa-paper-plane"></i> Font Awesome fontawesome.com --> </a>
                                    </div>
                                </div>
                                                                                        <div class="vcard15-btn-group">
                                    <button type="button" class="vcard15-btn-group vcard15-share  vcard15-sticky-btn mb-3  px-2 py-1"><svg class="svg-inline--fa fa-share-nodes pt-1 fs-4" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-nodes" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 127.1C448 181 405 223.1 352 223.1C326.1 223.1 302.6 213.8 285.4 197.1L191.3 244.1C191.8 248 191.1 251.1 191.1 256C191.1 260 191.8 263.1 191.3 267.9L285.4 314.9C302.6 298.2 326.1 288 352 288C405 288 448 330.1 448 384C448 437 405 480 352 480C298.1 480 256 437 256 384C256 379.1 256.2 376 256.7 372.1L162.6 325.1C145.4 341.8 121.9 352 96 352C42.98 352 0 309 0 256C0 202.1 42.98 160 96 160C121.9 160 145.4 170.2 162.6 186.9L256.7 139.9C256.2 135.1 256 132 256 128C256 74.98 298.1 32 352 32C405 32 448 74.98 448 128L448 127.1zM95.1 287.1C113.7 287.1 127.1 273.7 127.1 255.1C127.1 238.3 113.7 223.1 95.1 223.1C78.33 223.1 63.1 238.3 63.1 255.1C63.1 273.7 78.33 287.1 95.1 287.1zM352 95.1C334.3 95.1 320 110.3 320 127.1C320 145.7 334.3 159.1 352 159.1C369.7 159.1 384 145.7 384 127.1C384 110.3 369.7 95.1 352 95.1zM352 416C369.7 416 384 401.7 384 384C384 366.3 369.7 352 352 352C334.3 352 320 366.3 320 384C320 401.7 334.3 416 352 416z"></path></svg><!-- <i class="fas fa-share-alt pt-1 fs-4"></i> Font Awesome fontawesome.com --></button>
                                                                            <a type="button" class="vcard15-btn-group vcard15-sticky-btn  d-flex justify-content-center text-white align-items-center  px-2 mb-3 py-2" id="qr-code-btn" download="qr_code.png" href="data:image/png;base64,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"><svg class="svg-inline--fa fa-qrcode fs-4" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="qrcode" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M144 32C170.5 32 192 53.49 192 80V176C192 202.5 170.5 224 144 224H48C21.49 224 0 202.5 0 176V80C0 53.49 21.49 32 48 32H144zM128 96H64V160H128V96zM144 288C170.5 288 192 309.5 192 336V432C192 458.5 170.5 480 144 480H48C21.49 480 0 458.5 0 432V336C0 309.5 21.49 288 48 288H144zM128 352H64V416H128V352zM256 80C256 53.49 277.5 32 304 32H400C426.5 32 448 53.49 448 80V176C448 202.5 426.5 224 400 224H304C277.5 224 256 202.5 256 176V80zM320 160H384V96H320V160zM352 448H384V480H352V448zM448 480H416V448H448V480zM416 288H448V416H352V384H320V480H256V288H352V320H416V288z"></path></svg><!-- <i class="fa-solid fa-qrcode fs-4"></i> Font Awesome fontawesome.com --></a>
                                                                        
                                </div>
                                                    </div>
                    </div>
                    
                </div>

            </div>
          
           <div class="stiky_main_btn" id="stiky_main_btn">
        <ul>
            
            <div class="bardiv">
           <li>
            <a href="#home" class="nav-anim active">
            <!--svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" style="margin-top:9px;color:white;margin-left: -90px;" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16" >
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
</svg--><img src="{{asset('golden/img/home (1).png')}}" width="25" height="25" style="margin-left: 23px;margin-top: 7px;"> <span class="innertexticon" style="position: absolute;top: 20px;left: 56px;">Home <span style="margin-left: 28px;">></span></span> </a>   
            </li>
        
            </div>
            
            
          <div class="bardiv">
        <li>
            
            <a href="https://wa.me/{{ ltrim($userdata->country_code ?? '91', '+') }}{{ $userdata->mobile }}" target="_blank"><!--svg  xmlns="http://www.w3.org/2000/svg" width="25" height="25" style="margin-top:9px;color:white;margin-left: -90px;" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
  <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
</svg--><img src="{{asset('golden/img/whatsapp (1).png')}}" width="25" height="25" style="margin-left: 23px;margin-top: 7px;"> <span class="innertexticon" style="position: absolute;top: 71px;left: 56px;">Whatsapp <span style="margin-left: 0px;">></span></span></a>
            

            </li>
            </div>
            
            <div class="bardiv">
       <li>
           
           
           <a href="tel:{{ ($userdata->country_code ?? '') . $userdata->mobile }}"><!--svg xmlns="http://www.w3.org/2000/svg"  width="25" height="25" style="margin-top:9px;color:white;margin-left: -90px;" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg--> <img src="{{asset('golden/img/phone.png')}}" width="25" height="25" style="margin-left: 23px;margin-top: 7px;"><span class="innertexticon" style="position: absolute;top: 123px;left: 57px;">Call <span style="margin-left: 47px;">></span></span></a>
           

           </li>
           </div>
           <div class="bardiv">
               <li>
                   
                  <a href="#" data-toggle="modal"  data-target="#send_button"> <!--svg  xmlns="http://www.w3.org/2000/svg" width="25" height="25" style="margin-top:9px;color:white;margin-left: -90px;" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
</svg--> <img src="{{asset('golden/img/information.png')}}" width="25" height="25" style="margin-left: 23px;margin-top: 7px;"><span class="innertexticon" style="position: absolute;top: 175px;left: 57px;">Enquiry <span style="margin-left: 20px;">></span></span></a>
                   

                   </li>
                   </div>
                   <div class="bardiv">
                    <li >
                   
                  <a href="#" data-toggle="modal" id="answer-example-share-button" > <!--svg  xmlns="http://www.w3.org/2000/svg" width="25" height="25" style="margin-top:9px;color:white;margin-left: -90px;" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
  <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"/>
</svg--> <img src="{{asset('golden/img/share (1).png')}}" width="25" height="25" style="margin-left: 23px;margin-top: 7px;"><span class="innertexticon" style="position: absolute;top: 227px;left: 57px;">Share <span style="margin-left: 34px;">></span></span></a>
                   

                   </li>
                   </div>
                   <div class="bardiv">
                    <li>
                   
                  <a href="https://fastap.in/raf_create_vcard/{{$userdata->mobile}}" download=""><!--svg  xmlns="http://www.w3.org/2000/svg" width="25" height="25" style="margin-top:9px;color:white;margin-left: -90px" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
</svg--> <img src="{{asset('golden/img/download.png')}}" width="25" height="25" style="margin-left: 23px;margin-top: 7px;"><span class="innertexticon" style="position: absolute;top: 278px;left: 55px;">Download <span style="margin-left:6px;">></span></span></a>
                   

                   </li>
                   </div>
                   <div class="bardiv">
                    <li >
                   
                  <a   id="downloadButton"> <!--svg  xmlns="http://www.w3.org/2000/svg" width="25" height="25" style="margin-left: -90px;margin-top:9px;color:white" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">
  <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
  <path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1z"/>
</svg--> <img src="{{asset('golden/img/credit-card.png')}}" width="25" height="25" style="margin-left: 23px;margin-top: 7px;"><span class="innertexticon" style="position: absolute;top: 329px;left: 55px;">Share PDF<span style="margin-left: -1px;">></span></span></a>
                   

                   </li>
                   </div>

            
        </ul>
        
    </div>
    
    
    
    
    
    
          
          
          <!--<div class="lmpixels-arrows-nav">-->
          <!--  <div class="lmpixels-arrow-right"><i class="lnr lnr-chevron-right"></i></div>-->
          <!--  <div class="lmpixels-arrow-left"><i class="lnr lnr-chevron-left"></i></div>-->
          <!--</div>-->
          <!-- End Arrows Nav -->

          <div class="content-area">
            <div class="animated-sections">
              <!-- Home Subpage -->
              <section data-id="home" class="animated-section start-page newanimationonbanner">
              <div>
                  @if($userdata->banner !='')
        <img src="{{ url('public/frontend/user_images',$userdata->banner)}}" width="100%" style="width:100%;height:auto;display: block;">

                  @else
                  
        <img src="{{ url('golden/img/bg.png')}}" width="100%" class="bgimage">

                  @endif
                  
                  </div>

                <div class="section-content vcentered" style="background:linear-gradient(135deg, #2e3441, #2c2c2c); !important;">
                    <div class="row">
                        
                        
                      <div class="col-sm-12 col-md-12 col-lg-12">
                          <div class="card cardmargin">
                        <div class="title-block">
                                <div style="" class="cirlce_profile">
                                       <img src="{{ $userdata->profile ? url('public/frontend/user_images', $userdata->profile) : url('public/frontend/user_images/placeholder.png') }}"  
     alt="Profile Image" class="profile-img" style="border-radius: 50%;width: 100% !important;padding: 10px;object-fit: cover;">
                                    <!--<img src="{{ url('public/frontend/user_images',$userdata->profile)}}" alt="" ">-->
                                </div>
                                <div>

                                </div>
                          <h5 style="margin-top:10px"><b style="text-transform: capitalize;">{{$userdata->name}}</b></h5>
                          <div class="">                                    
                            
                             
                            <div class="item">
                              <div class="sp-subtitle" style="color:#1b9fad">{{$userdata->desig}}</div>
                            </div>
                            
                            
                             <div class="item">
                              <div class="sp-subtitle text-1" style="color:white">{!! Str::limit($userdata->title1, 100, ' ...') !!}</div>
                              <div class="sp-subtitle text-2" style="color:white;display:none">{{$userdata->title1}}</div>
                              <span style="color:skyblue" class="readmore"><<--Read More-->></Read></span>
                            </div>
                             <div class="item">
                                <div class="sp-subtitle" style="color:#1b9fad">
                                    <a href="tel:{{ ($userdata->country_code ?? '') . $userdata->mobile }}" style="color:#1b9fad; text-decoration: none;">
                                        {{ ($userdata->country_code ?? '') . $userdata->mobile }}
                                    </a>
                                </div>
                                </div>
                                <div class="item">
                                    <div class="sp-subtitle" style="color:#1b9fad">
                                        <a href="mailto:{{$userdata->email}}" style="color:#1b9fad; text-decoration: none;">
                                            {{$userdata->email}}
                                        </a>
                                    </div>
                                </div>
                            <div class="item">
                                <a href="https://fastap.in/raf_create_vcard/{{$userdata->mobile}}" download="">
                                <button style="width: 139px;
                                padding-left: 20px !important;
                                padding-right: 20px !important;
                                padding-top: 4px;
                                padding-bottom: 6px;">Save Contact</button></a>
                            </div>
                                <!--<div class="item">-->
                                <!--<a href="tel:{{$userdata->mobile}}">-->
                                <!--    <button style="width: 139px; padding: 4px 20px 6px;">Save Contact</button>-->
                                <!--</a>-->
                                <!--</div>-->
                          </div>
                          <center>
                          <div class="social-links" style="margin-left:-27px">
                            <ul>
                                @if(isset($social->instagram) && $social->instagram)
                                <li>
                                    <div class="socilinkdiv">
                                        <a href="{{$social->instagram}}">
                                            <img src="{{asset('public/icons/insta.png')}}">
                                        </a>
                                    </div>
                                </li>
                                @endif
                                @if(isset($social->facebook) && $social->facebook)
                                <li>
                                    <div class="socilinkdiv">
                                        <a href="{{$social->facebook}}">
                                            <img src="{{asset('public/icons/fb.png')}}">
                                        </a>
                                    </div>
                                </li>
                                @endif
                                @if(isset($social->youtube) && $social->youtube)
                                <li>
                                    <div class="socilinkdiv">
                                        <a href="{{$social->youtube}}">
                                            <img src="{{asset('public/icons/yt.png')}}">
                                        </a>
                                    </div>
                                </li>
                                @endif
                            
                                @if(isset($social->twitter) && $social->twitter)
                                <li>
                                    <div class="socilinkdiv">
                                        <a href="{{$social->twitter}}">
                                            <img src="{{asset('public/icons/x.png')}}">
                                        </a>
                                    </div>
                                </li>
                                @endif
                            </ul>
                            <ul>
                                @if(isset($social->pinterest) && $social->pinterest)
                                <li>
                                    <div class="socilinkdiv">
                                        <a href="{{$social->pinterest}}">
                                            <img src="{{asset('public/icons/pinterest.png')}}">
                                        </a>
                                    </div>
                                </li>
                                @endif
                            
                                @if(isset($social->skype) && $social->skype)
                                <li>
                                    <div class="socilinkdiv">
                                        <a href="{{$social->skype}}">
                                            <img src="{{asset('public/icons/skype.png')}}">
                                        </a>
                                    </div>
                                </li>
                                @endif
                            
                                @if(isset($social->google_review) && $social->google_review)
                                <li>
                                    <div class="socilinkdiv">
                                        <a href="{{$social->google_review}}">
                                            <img src="{{asset('public/icons/gole.png')}}" style="width: 59px !important;height: 28px;">
                                        </a>
                                    </div>
                                </li>
                                @endif
                                @if(isset($social->linkdin) && $social->linkdin)
                                <li>
                                    <div class="socilinkdiv">
                                        <a href="{{$social->linkdin}}">
                                            <img src="{{asset('public/icons/linkedin.png')}}">
                                        </a>
                                    </div>
                                </li>
                                @endif
                            </ul>
              <ul>
                {{--<li><a  href='{{isset($social->instagram)?$social->instagram:"javascript:void(0)"}}' 
                
                <?php
                if(!isset($social->instagram)){
                
                ?>
                onclick="alert('No Link')"
                <?php }?>
                
                
                ><img src="{{asset('public/icons/insta.png')}}"></a></li>
                <li><a href="{{isset($social->facebook)?$social->facebook:'javascript:void(0)'}}"
                
                
                <?php
                if(!isset($social->facebook)){
                
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><img src="{{asset('public/icons/fb.png')}}"></a></a></li>
                <li><a href="{{isset($social->youtube)?$social->youtube:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->youtube)){
                
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><img src="{{asset('public/icons/youtube.png')}}"></a></a></li>
                <li><a href="{{isset($social->twitter)?$social->twitter:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->twitter)){
                
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><img src="{{asset('public/icons/x.png')}}"></a></a></li>
                <li><a href="{{isset($social->pinterest)?$social->pinterest:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->pinterest)){
                
                ?>
                onclick="alert('No Link')"
                <?php }?>
                
                ><img src="{{asset('public/icons/pinterest.png')}}"></a></li>

                <li><a href="{{isset($social->twitter)?$social->twitter:'javascript:void(0)'}}"
                
                <?php
                if(!isset($social->twitter)){
                
                ?>
                onclick="alert('No Link')"
                <?php }?>
                ><img src="{{asset('public/icons/skype.png')}}"></a></a></li>--}}
              </ul>
              
            </div>
            
            
            </center>
           
            
               <center>
            <div class="" style="width: 20rem">
  
  <!--<ul class="list-group list-group-flush" style="padding: 20px;-->
  <!--  background: #2e3441;-->
  <!--  color: white;-->
  <!--  border-radius: 10px;-->
  <!--  border: none;margin-bottom:10px">-->
  <!--  <li class=""><span style="float:left"><b>Name:</b></span> <span style="float: inline-start;padding-left: 5px;">{{$userdata->name}}</span></li>-->
  <!--  <li class=""><span style="float:left"><b>Phone:</b></span> <span style="float: inline-start;padding-left: 5px;">{{$userdata->mobile}}</span></li>-->
  <!--  <li class=""><span style="float:left"><b>Email:</b> </span> <span style="float: inline-start;padding-left: 5px;"> {{$userdata->email}}</span></li>-->
  <!--</ul>-->
</div>
</center>

<!--<center class="mt-5">-->
<!--    <div style="width: 20rem">-->
<!--    <img src="{{asset('golden/img/golden.jpeg')}}" style="width: 100%;-->
<!--    height: auto;-->
<!--    border-radius: 9px;">-->
<!--    </div>-->
<!--</center>-->
           
                        </div>
                        </div>
                       
                      </div>
                     
                    </div>

                </div>
             @include('layouts.golden.mobilefooter')

                
              </section>
              <!-- End of Home Subpage -->

              <!-- About Me Subpage -->
              <section data-id="about-me" class="animated-section" style="padding:0px">
                  <div style="padding:30px">
                     <button type="button" class="btn  personal active-tab">PERSONAL</button>             
                     <button type="button" class="btn profession">PROFESSIONAL</button>     
                         <br><br>
                            <div class="block-title sectiontwo">
                                 <h3 class="headinbgcolor">ABOUT ME</h3>
                            </div>
                            <div class="section-content">
                                <!-- Personal Information -->
                                <div class="row sectiontwo">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>{{$userdata->title1}}</p>
                                    </div>
                                </div>
                                <div class="row sectiontwo align-items-center">
                                <div class="col-md-4 text-center">
                                    <div class="circle_profile-about">
                                        <img src="{{ $userdata->profile ? url('public/frontend/user_images', $userdata->profile) : url('public/frontend/user_images/placeholder.png') }}"  
                                        alt="Profile Image" class="profile-img">

                                    </div>
                                </div>
                                <div class="col-md-8 text-center text-md-left">
                                <h5 class="user-name"><b>{{$userdata->name}}</b></h5>
                                <div class="owl-carousel text-rotation">                                    
                                    <div class="item">
                                        <div class="sp-subtitle">{{$userdata->desig}}</div>
                                    </div>
                                    <div class="item">
                                        <div class="sp-subtitle">{{$userdata->name}}</div>
                                    </div>
                                </div>
                                <div class="social-links" style="margin-left:-31px;">
                                        <ul>
                                        <li>
                                           <div class="socilinkdiv">
                                           <a  href='{{isset($social->instagram)?$social->instagram:"javascript:void(0)"}}' 
                                
                                <?php
                                if(!isset($social->instagram)){
                                
                                ?>
                                onclick="alert('No Link')"
                                <?php }?>
                                
                                
                                ><img src="{{asset('public/icons/insta.png')}}"></a></div></li>
                                <li>
                                    <div class="socilinkdiv">
                                    <a href="{{isset($social->facebook)?$social->facebook:'javascript:void(0)'}}"
                                
                                
                                <?php
                                if(!isset($social->facebook)){
                                
                                ?>
                                onclick="alert('No Link')"
                                <?php }?>
                                ><img src="{{asset('public/icons/fb.png')}}"></a></div></li>
                                <li>
                                     <div class="socilinkdiv">
                                    <a href="{{isset($social->youtube)?$social->youtube:'javascript:void(0)'}}"
                                
                                <?php
                                if(!isset($social->youtube)){
                                
                                ?>
                                onclick="alert('No Link')"
                                <?php }?>
                                ><img src="{{asset('public/icons/yt.png')}}"></a></div></li>
                                <li>
                                     <div class="socilinkdiv">
                                    <a href="{{isset($social->twitter)?$social->twitter:'javascript:void(0)'}}"
                                
                                <?php
                                if(!isset($social->twitter)){
                                
                                ?>
                                onclick="alert('No Link')"
                                <?php }?>
                                ><img src="{{asset('public/icons/x.png')}}"></a></div></li>
                                   </ul>  
                                   <ul>
                                       
                                       <li>
                                           <div class="socilinkdiv">
                                           <a href="{{isset($social->pinterest)?$social->pinterest:'javascript:void(0)'}}"
                                
                                <?php
                                if(!isset($social->pinterest)){
                                
                                ?>
                                onclick="alert('No Link')"
                                <?php }?>
                                
                                ><img src="{{asset('public/icons/pinterest.png')}}"></a></div></li>
                                <li>
                                    <div class="socilinkdiv">
                                    <a href="{{isset($social->twitter)?$social->twitter:'javascript:void(0)'}}"
                                
                                <?php
                                if(!isset($social->twitter)){
                                
                                ?>
                                onclick="alert('No Link')"
                                <?php }?>
                                ><img src="{{asset('public/icons/skype.png')}}"></a></div></li>
                               <li>
                                    <div class="socilinkdiv">
                                    <a href="{{isset($social->google_review)?$social->google_review:'javascript:void(0)'}}"
                                
                                <?php
                                if(!isset($social->google_review)){
                                
                                ?>
                                onclick="alert('No Link')"
                                <?php }?>
                                ><img src="{{asset('public/icons/goole_rev.png')}}" style='width: 59px !important;height: 28px;'></a></div></li>
                                <li>
                                    <div class="socilinkdiv">
                                    <a href="{{isset($social->linkdin)?$social->linkdin:'javascript:void(0)'}}"
                                
                                <?php
                                if(!isset($social->linkdin)){
                                
                                ?>
                                onclick="alert('No Link')"
                                <?php }?>
                                ><img src="{{asset('public/icons/linkedin.png')}}" style='width: 59px !important;height: 28px;'></a></div></li>
                                   </ul>
                                </div>
                            </center>
                        </div>
                       <div class="col-xs-12 col-sm-5" style="margin-left:22px">
                        <div class="info-list">
                        <ul>
                          <li>
                            <span class="title">Name</span>
                            <span class="value">{{$userdata->name}}</span>
                          </li>

                          <li>
                            <span class="title">Email</span>
                            <span class="value">{{$userdata->email}}</span>
                          </li>

                          <li>
                            <span class="title">Mobile</span>
                            <span class="value">{{ ($userdata->country_code ?? '') . ' ' . $userdata->mobile }}</span>
                          </li>
                          
                          <li>
                            <span class="title">City</span>
                            <span class="value">{{$userdata->city}}</span>
                          </li>
                          
                          <li>
                            <span class="title">State</span>
                            <span class="value">{{$userdata->state}}</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    </div>
                    @if($menu->quali == 0)
                  <!-- Certificates -->
                  @if(isset($qualifications) && $qualifications->isNotEmpty())
                  <div class="row sectiontwo mt-3">
                    <div class="col-xs-12 col-sm-12">
                      <div class="block-title">
                          
                         @if(isset($headings) && $headings->qual !='')
                          <h3 class="headinbgcolor">{{$headings->qual}} </h3>
                         @else
                          <h3 class="headinbgcolor">OUR QUALIFICATION </h3>
                         
                          @endif
                       
                      </div>
                    </div>
                  </div>
                  @endif
                  
                  <div class="row sectiontwo">
                       @foreach($qualifications as $qualifications_List)
                   
                    <!-- Certificate 1 -->
                    <div class="col-xs-12 col-sm-6">
                      <div class="certificate-item clearfix">
                        <div class="certi-logo">
                          <img src="{{ url('public/frontend/user_images',$userdata->profile)}}" alt="logo">
                        </div>
                        
                        <div class="certi-content">
                          <div class="certi-title">
                            <h4>{{$qualifications_List->qualifiaction}}</h4>
                          </div>
                          <div class="certi-id">
                            <span>Description: {{$qualifications_List->description}}</span>
                          </div>
                          
                          <div class="certi-company">
                            <span></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    <!-- End of Certificate 1 -->

                    <!-- Certificate 2 -->
                   
                    <!-- End of Certificate 2 -->
                    
                   

                  </div>
                  
                  @endif
                  <!-- End of Personal Information -->
                  
                   @if($menu->thought == 0)
                  <!-- Certificates -->
                  @if(isset($thoughts) && $thoughts->isNotEmpty())
                    <div class="block-title sectiontwo  mt-3">
                         @if(isset($headings) && $headings->thought !='')
                          <h3 class="headinbgcolor">{{$headings->thought}} </h3>
                         @else
                          <h3 class="headinbgcolor">OUR THOUGHTS </h3>
                          @endif
                    </div>
                  @endif
                    <div class="row sectiontwo">
                    <div class="col-xs-12 col-sm-12">
                       @foreach($thoughts as $thought)
                          <div class="swiper-slide">
                            <div class="testimonial-item">
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
                    </div>
                  @endif

                  <!--<div class="white-space-50"></div>-->

                  <!-- Services -->
                  <div class="row defaultnone">
                      @if(isset($professions) && $professions->isNotEmpty())
                    <div class="col-xs-12 col-sm-12">
                      <div class="block-title">
                          
                           @if(isset($headings) && $headings->service !='')
                          <h3 class="headinbgcolor">{{$headings->service}} </h3>
                         @else
                        <h3 class="headinbgcolor">OUR SERVICES</h3>
                        @endif
                      </div>
                    </div>
                    @endif
                   
                  </div>
                  
                  <div class="row defaultnone">
                    <div class="col-xs-12 col-sm-12">
                      <div class="testimonials owl-carousel">
                        <!-- Testimonial 1 -->
                    
                        @if(isset($professions) && $professions!='')
                        @foreach($professions as $profession)
                        
                        <div class="testimonial">
                            <div class="img">
                                @if($profession->icon!='')
                                <img src="{{asset('public/frontend/profession_logo')}}/{{$profession->icon}}" alt="Our Ervices">
                                    @else
                                    <img src="{{asset('golden/img/images.png')}}" alt="Our Ervices">

                                @endif
                                <h4 class="title"><a href="#">{{$profession->profession}}</a></h4>
                            </div>
                            <div class="text">
                                <p>{{$profession->description}}</p>
                            </div>
                          <div class="author-info">
                            <ul>
                                <li><strong><b><i class="fa fa-phone" aria-hidden="true"></i></b></strong>
                      <a href="tel:{{$profession->phone}}" style="color:#7841da !important"> <span>{{$profession->phone}}</span></a></li>
                                <li> <strong><b><i class="fa fa-map-marker" aria-hidden="true"></i></b></strong>
                       <span>{{$profession->location}}</span></li>
                                
                                <li><strong>
                       <i class="fa fa-address-book" aria-hidden="true"></i>
                       <!--<b><i class="fa fa-columns" aria-hidden="true"></i></b>-->
                       </strong>
                   <span>{{$profession->designation}}</span></li>
                                <li> <a href="{{$profession->website}}" target="_blank">
                  <i class="fa fa-map" aria-hidden="true"></i>
                   <span>{{$profession->website}}</span>
                   </a></li>
                                <li>
                                    <strong>
                       <b><i class="fa fa-envelope" aria-hidden="true"></i></b>
                       </strong>
                   <span>{{$profession->email}}</span></li>
                   <li>
                                <a href="{{$profession->iframe}}"  target="_blank" class="btn btn-primary pt-0 pb-0">View On Maps </a>
                                 </li>
                                
                            </ul>
                          </div>
                        </div>
                         @endforeach
                         @endif
                         

                      </div>
                    </div>
                  </div>
                  <!-- End of Testimonials -->
                  
                  
                  
                   <!--<div class="white-space-30"></div>-->
                  <div class="row defaultnone">
                     @if(isset($logo) && $logo !='')
                    <div class="col-xs-12 col-sm-12">
                      <div class="block-title">
                          @if(isset($headings) && $headings->logo !='')
                          <h3 class="headinbgcolor">{{$headings->logo}} </h3>
                         @else
                        <h3 class="headinbgcolor">OUR LOGO</h3>
                        @endif
                      </div>
                    </div>
                    @endif
                    @if(isset($logo) && $logo !='')
                        <img class="d-block w-100" src="{{asset('public/images')}}/{{$logo->logo}}" alt="First slide" style="width:100%;height:auto">
                    @endif
                  </div>
                  
                   <!--<div class="white-space-30"></div>-->
                  <!--Our Product-->
                  @if(isset($menu->product) && $menu->product == 0)
                  @php
                $myproductsArray = $myproducts->toArray();
            @endphp
             @if(isset($myproductsArray) && !empty($myproductsArray))
                  <div class="row defaultnone">
                     
                    <div class="col-xs-12 col-sm-12">
                      <div class="block-title">
                          @if(isset($headings) && $headings->prdoducts !='')
                          <h3 class="headinbgcolor">{{$headings->prdoducts}} </h3>
                         @else
                        <h3 class="headinbgcolor">OUR PRODUCT</h3>
                        @endif
                      </div>
                    </div>
                   
                  </div>
                  @endif
                  <!--<div class="white-space-30"></div>-->
                  
                  <div class="row defaultnone">
                    <div class="col-xs-12 col-sm-12">
                      <div class="testimonials owl-carousel">
                        <!-- Testimonial 1 -->
                        
                       @php
                       $count = count($myproductsArray);
                       $n= 1;
                       @endphp
                         @foreach($myproductsArray as $myproduct)
                        @php
                  $img = json_decode($myproduct['images']);
                  $nimg = $myproduct['images'];
                 
                  @endphp
                        
                        <div class="testimonial tetimonialproduct" style="height: 303px !important">
                          <div class="img">
                              
                              @if(isset($img[0]) && $img[0]!='')
                            <img src="{{asset('public/frontend/myproducts')}}/{{$img[0]}}" alt="Product" data-toggle="modal" data-target="#productmyModal" type="button" onClick="getproduct({{$myproduct['images']}})">
                            @else
                            <img src="{{asset('golden/img/default-product-image.png')}}" alt="Our Ervices">
                            @endif
                            <h6 class="title"><a href="#">{{ Str::limit($myproduct['title'], 20) }}</a></h6>
                          </div>
                          <div class="text">
                         <p class="text-center" style="color:green">?{{$myproduct['price']}}</p>
                         <center>
                            <button style="margin-top: -12px;" type="button" data-toggle="modal" data-target="#product_modal" class="btn btn-primary" onClick="product_id({{$myproduct['id']}})">Enquiry</button>
      </center>
      <div class="text-center mb-3" style="margin-top: -9px;"><span>{{$n++}} out Of {{$count}}</span></div>
                          </div>

                          <div class="author-info">
                           
                          </div>
                        
                        </div>
                           
                         @endforeach
                      </div>
                    </div>
                  </div>
                  
                  @endif
                  <!--Our product end-->

                  <!--<div class="white-space-50"></div>-->

                  <!-- Clients -->
                   @if(isset($clients) && $clients !='')
                  <div class="row defaultnone">
                    <div class="col-xs-12 col-sm-12">
                      <div class="block-title">
                          @if(isset($headings) && $headings->client !='')
                          <h3 class="headinbgcolor">{{$headings->client}} </h3>
                         @else
                        <h3 class="headinbgcolor">OUR CLIENTS</h3>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endif
              @php
              $clients = DB::table('clients')->select('*')->where('uid',Session::get('FRONT_USER_ID'))->orderby('id','DESC')->get();
              $number = 1;
              @endphp
                  <div class="row defaultnone">
                    <div class="col-xs-12 col-sm-12">
                      <div class="clients owl-carousel">
                         @if(isset($clients) && $clients !='')
                         
                           @foreach($clients as $img)
                        <div class="client-block">
                          <a href="#" target="_blank" title="Logo">
                            <img src="{{asset('public/images')}}/{{$img->image}}" alt="Logo">
                            <h6 class="text-center mt-2"><b>{{$img->name}}</b></h6>
                          </a>
                        </div>
                       

                         @endforeach
    
    @endif
  
                      </div>
                    </div>
                  </div>
                  <!-- End of Clients -->

                 
                  
                </div>
                </div>
            
             @include('layouts.golden.mobilefooter')
              </section>
              <!-- End of About Me Subpage -->

              <!-- Resume Subpage -->
              <section data-id="resume" class="animated-section" style="padding:0px">
                  <div style="padding:30px">
                    <div class="block-title">
                      <h3 class="headinbgcolor">RESUME</h3>
                    </div>
                    <div class="section-content">
                    @php
                    $pdf = DB::table('pdf')->where('uid',Session::get('FRONT_USER_ID'))->get();
                    $n = 1;
                    @endphp
                    @if(isset($pdf) && $pdf!='')
                    @foreach($pdf as $data)
                    <div class='col-2 text-center mt-2'>
    			         <a href="{{asset('public/images')}}/{{$data->pdf}}" download> <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>
    			     </div>
    			     @endforeach
    			     @else
    			     <div class="no-data"><h3>No Data Found</h3></div>
    			     @endif
{{--
                  @if($menu->quali == 0)
                  <!-- Certificates -->
                  @if(isset($qualifications) && !empty($qualifications))
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="block-title">
                        <h3 class="headinbgcolor">OUR QUALIFICATION </h3>
                      </div>
                    </div>
                  </div>
                  @endif
                  
                  <div class="row">
                       @foreach($qualifications as $qualifications_List)
                   
                    <!-- Certificate 1 -->
                    <div class="col-xs-12 col-sm-6">
                      <div class="certificate-item clearfix">
                        <div class="certi-logo">
                          <img src="{{ url('public/frontend/user_images',$userdata->profile)}}" alt="logo">
                        </div>
                        
                        <div class="certi-content">
                          <div class="certi-title">
                            <h4>{{$qualifications_List->qualifiaction}}</h4>
                          </div>
                          <div class="certi-id">
                            <span>Description: {{$qualifications_List->description}}</span>
                          </div>
                          
                          <div class="certi-company">
                            <span></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    <!-- End of Certificate 1 -->

                    <!-- Certificate 2 -->
                   
                    <!-- End of Certificate 2 -->

                  </div>
                  
                  @endif
                  --}}
                  
                  @if($menu->achievment == 0)
                  @php
                    $achive = DB::table('achive')->where('uid',Session::get('FRONT_USER_ID'))->get();
                  @endphp
                  <!-- Certificates -->
                   @isset($achive)
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 mt-5">
                      <div class="block-title">
                          @if(isset($headings) && $headings->achiev !='')
                          <h3 class="headinbgcolor">{{$headings->achiev}} </h3>
                         @else
                        <h3 class="headinbgcolor">OUR ACHIEVEMENT</h3>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endif
                  
                  <div class="row">
                      @isset($achive)
                       @foreach($achive as $ach)
                        <!-- Certificate 1 -->
                        <div class="col-xs-12 col-sm-6">
                          <div class="certificate-item clearfix">
                            <div class="certi-logo">
                              <a href="{{asset('public/images')}}/{{$ach->image}}" title='' download> <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>
                            </div>
                            <div class="certi-content">
                              <div class="certi-title">
                                <h4 class="headinbgcolor">ACHIEVEMENT</h4>
                              </div>
                              
                              <div class="certi-company">
                                <span></span>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                    @endif
                    <!-- End of Certificate 1 -->

                    <!-- Certificate 2 -->
                   
                    <!-- End of Certificate 2 -->

                  </div>
                  
                  @endif
                  
                  <!-- End of Certificates -->
                </div>
                 @if($menu->upload_file == 0)
                 @isset($myfiles)
                <div class="block-title mt-4">
                    @if(isset($headings) && $headings->pdf !='')
                          <h3 class="headinbgcolor">{{$headings->pdf}} </h3>
                         @else
                  <h3 class="headinbgcolor">OUR PDF</h3>
                  @endif
                </div>
                @endif
                @endif
                  @isset($myfiles)
                  
                   <div class="row">
                     @foreach(json_decode($myfiles) as $files)
                    <div class="col-xs-12 col-sm-6">
                        <div class="clearfix">
                        <a href="{{asset('public')}}/{{$files}}" title='{{asset($files)}}' download> <div class="pdf-container">
                            <div class="pdf-icon">PDF</div>
                            <div class="pdf-details">
                              <p class="pdf-title">Document.pdf</p>
                              <p class="pdf-size"><i class="fa fa-download" aria-hidden="true"></i></p>
                            </div>
                            </div>
                        </a>
                          
                          
                      <!--  <div class="certi-logo">-->
                            
    			               <!--<a href="{{asset('public')}}/{{$files}}" title='{{asset($files)}}' download> <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>-->
                      <!--  </div>-->
                        
                        <!--<div class="certi-content">-->
                        <!--  <div class="certi-title">-->
                        <!--    <h4>PDF -> {{$n++}}</h4>-->
                        <!--  </div>-->
                        <!--  <div class="certi-company">-->
                        <!--    <span></span>-->
                        <!--  </div>-->
                        <!--</div>-->
                      </div>
                    </div>
                    @endforeach
                    <!-- End of Certificate 1 -->

                    <!-- Certificate 2 -->
                   
                    <!-- End of Certificate 2 -->
                  </div>
                  @else
    			 @endif
    			 </div>
                
                 @include('layouts.golden.mobilefooter')
              </section>
              <!-- End of Resume Subpage -->
 
              <!-- Portfolio Subpage -->
              <section data-id="portfolio" class="animated-section" style="padding:0px">
                  <div style="padding:30px">
                  @if($menu->personal == 0 || $menu->profess == 0 || $menu->videos == 0 || $menu->google_map == 0)
                <div class="page-title">
                  <h2 class="headinbgcolor">PORTFOLIO</h2>
                </div>
                @endif

                <div class="section-content">

                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <!-- Portfolio Content -->
                      <div class="portfolio-content">
                        <ul class="portfolio-filters">
                          <li class="active">
                            <a class="filter btn btn-sm btn-link" data-group="category_all">All</a>
                          </li>
                           @if($menu->personal == 0 )
                          <li>
                            <a class="filter btn btn-sm btn-link" data-group="category_detailed">Personal Photos</a>
                          </li>
                          @endif
                          
                           @if($menu->profess == 0 )
                          <li>
                            <a class="filter btn btn-sm btn-link" data-group="category_mockups">Professional Photos</a>
                          </li>
                       @endif
                        @if($menu->videos == 0)
                          <li>
                            <a class="filter btn btn-sm btn-link" data-group="category_vimeo-videos">Videos</a>
                          </li>
                        @endif
                          @if($map)
                          <li>
                            <a class="filter btn btn-sm btn-link" data-group="category_map">Maps</a>
                          </li>
                          @endif
                        </ul>

                        <!-- Portfolio Grid -->
                        <div class="portfolio-grid three-columns">
                            @foreach($portfolios as $portfolio)
                                @php
                                    // Decode the JSON string into an array
                                    $images = json_decode($portfolio->image, true);
                                @endphp
                                 @if(is_array($images))
                                    @foreach($images as $image)
                                        <figure class="item standard" data-groups='["category_all", "category_detailed"]'>
                                            <div class="portfolio-item-img">
                                                <img src="{{ url('public/frontend/portfolio/'.$image) }}" alt="Portfolio Image" title=""/>
                                                <a href="portfolio-1.html" class="ajax-page-load"></a>
                                            </div>
                                            <i class="far fa-file-alt"></i>
                                            <h4 class="name">{{ $portfolio->title }}</h4>
                                        </figure>
                                    @endforeach
                                @endif
                            @endforeach
                              @if($menu->videos == 0)
                            @foreach($videos as $video)
                                @php
                                    // Extract YouTube video ID
                                    preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([a-zA-Z0-9_-]{11})/', $video->video_link, $matches);
                                    $youtubeId = $matches[1] ?? null;
                                @endphp
                                @if($youtubeId)
                                    <figure class="item standard lbvideo col-lg-4 col-md-6 col-12 mb-2" data-groups='["category_all", "category_vimeo-videos"]'>
                                        <div class="portfolio-item-img" style="border-radius: 12px; overflow: hidden;">
                                            <iframe 
                                                src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                                frameborder="0" 
                                                allowfullscreen 
                                                style="width: 100%; height: 200px; border-radius: 12px;">
                                            </iframe>
                                        </div>
                                        <a href="https://www.youtube.com/watch?v={{ $youtubeId }}" 
                                           target="_blank">
                                        <i class="far fa-play-circle"></i></a>
                                    </figure>
                                @endif
                            @endforeach 
                            @endif

                            @foreach ($professional_photos as $professional_photo)
                            @foreach(json_decode($professional_photo->image) as $image)
                            <figure class="item lbimage" data-groups='[ "category_all","category_mockups"]'>
                            <div class="portfolio-item-img">
                                @if (file_exists( public_path() . '/frontend/professional_photos/' . $image))
                            <img src="{{url('public/frontend/professional_photos/'.$image)}}" alt="Professional Photos" title="" style="width:100%;height:auto;border-radius: 9px;"/>
                              <a class="lightbox" title="Professional Photos" href="{{asset('golden/img/portfolio/full/5.jpg')}}"></a>
                            </div>

                            <i class="far fa-image"></i>
                            <h4 class="name">{{$professional_photo->title}}</h4>
                          </figure>
                           @else
                          <p></p>
                          @endif  
                          @endforeach  
                          @endforeach
                          @if($map)
                            <figure class="item lbvideo" data-groups='["category_map"]'>
                                <button type="button" class="btn personal active-tab" onclick="window.open('{{ $map->map }}', '_blank')">
                                    View on Google Maps
                                </button>
                            </figure>
                          @endif
                        </div>
                        </div>
                      <!-- End of Portfolio Content -->
                    </div>
                  </div>
                </div>
                </div>
                @include('layouts.golden.mobilefooter')
              </section>
              <!-- End of Portfolio Subpage -->

              <!-- Blog Subpage -->
               @php
              $blogs = DB::table('blocks')->select('*')->where('uid',Session::get('FRONT_USER_ID'))->orderby('id','DESC')->get()->toArray();
              @endphp
              
              
              <section data-id="blog" class="animated-section" style="padding:0px">
                   <div style="padding:30px">
                <div class="block-title">
                  <h3 class="headinbgcolor">BLOG</h3>
                </div>

                <div class="section-content">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="blog-masonry two-columns clearfix">
                         @if(isset($blogs) && !empty($blogs))
                        @foreach($blogs as $key => $b)
                        <!-- Blog Post 1 -->
                        <div class="item post-1">
                          <div class="blog-card">
                            <div class="media-block">
                              <div class="category">
                                <a href="#" title="View all posts in Design">Blog</a>
                              </div>
                              <a href="#">
                                <img src="{{asset('public/images')}}/{{$b->image}}" class="size-blog-masonry-image-two-c" alt="{{$b->title}}" title="" style="width: 100%;display: block;"/>
                                <div class="mask"></div>
                              </a>
                            </div>
                            <div class="post-info">
                              <a href="#">
                                <h4 class="blog-item-title">{{$b->title}}</h4>
                              </a>
                            </div>
                          </div>
                        </div>
                        <!-- End of Blog Post 1 -->
                        @endforeach
                        @else
                        <div class="no-data"><h3>No Data Found</h3></div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                @include('layouts.golden.mobilefooter')
              </section>
               
             
              <!-- End of Blog Subpage -->

              <!-- Contact Subpage -->
              <section data-id="contact" class="animated-section" style="padding:0px">
                    <div style="padding:30px">
                    <div class="page-title contact">
                        <h2 class="headinbgcolor">CONTACT</h2>
                    </div>
                <div class="section-content">
                  <div class="row">
                    <!-- Contact Info -->
                    <div class="col-xs-12 col-sm-4">
                      <div class="lm-info-block gray-default">
                        <i class="lnr lnr-map-marker"></i>
                        <h4>{{$userdata->state,}} {{$userdata->city}}</h4>
                        <span class="lm-info-block-value"></span>
                        <span class="lm-info-block-text"></span>
                      </div>

                      <div class="lm-info-block gray-default">
                        <i class="lnr lnr-phone-handset"></i>
                        <h4>{{ $userdata->country_code ?: '+91' }}{{ $userdata->mobile }}</h4>
                        <span class="lm-info-block-value"></span>
                        <span class="lm-info-block-text"></span>
                      </div>

                      <div class="lm-info-block gray-default">
                        <i class="lnr lnr-envelope"></i>
                        <h4><a href="mailto:{{$userdata->email}}" style="color: #04b4e0; font-weight: 600;"> {{$userdata->email}}</a></h4>
                        <span class="lm-info-block-value"></span>
                        <span class="lm-info-block-text"></span>
                      </div>
                    </div>
                    <!-- End of Contact Info -->

                    <!-- Contact Form -->
                    <div class="col-xs-12 col-sm-8">
                      <div class="block-title">
                          <h3 class="text-center">GET IN TOUCH</h3>
                      </div>

                     <form id="contactForm" action="{{url('/message')}}" method='post'>
                        @csrf
                        <input type='hidden' value="{{session::get('FRONT_USER_ID')}}" name='uid'/>
                          <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                          </div>
                          <div class="mb-3">
                            <label for="pwd" class="form-label">Mobile:</label>
                            <input type="number" class="form-control" id="mobile" placeholder="Mobile" name="mobile" required>
                          </div>
                          <div class="mb-3">
                            <label for="message" class="form-label">Message:</label>
                            <textarea class="form-control" rows="4" id="message" name="text" placeholder="Message" required></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                  </div>
                </div>
                </div>
                @include('layouts.golden.mobilefooter')
                 
              </section>
              <!-- End of Contact Subpage -->
            </div>
          </div>
<!--CB-modal -->
<!-- Button trigger modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="send_button" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/message')}}" method='post'>
                   @csrf
                    <input type='hidden' value="{{$userdata->id}}" name='uid' id='userId'/>
                  <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
po                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                  </div>
                  <div class="mb-3">
                    <label for="pwd" class="form-label">Mobile:</label>
                    <input type="number" class="form-control" id="mobile" placeholder="Mobile" name="mobile">
                  </div>
                  <div class="mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea class="form-control" rows="5" id="message" name="text" placeholder="Message"></textarea>
                  </div>
                  <!--<div class="form-check mb-3">-->
                  <!--  <label class="form-check-label">-->
                  <!--    <input class="form-check-input" type="checkbox" name="remember"> Remember me-->
                  <!--  </label>-->
                  <!--</div>-->
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
      </div>
      
    </div>
  </div>
</div>

<!--modal-->


<!-- Modal -->
<div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Enquiry</h5>
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
  <p id="prosuccess" class="bg-success"></p>
  <button type="button" class="btn btn-primary" onClick="submitEnquerypro()">Submit</button>
</form>
      </div>
      
    </div>
  </div>
</div>

<!--modal-->
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

<script>
  $(document).ready(function() {
    $("#myModal").modal();
  });
</script>

      </div>
      <!--send enquiery form start-->
    
   
<!-- Button trigger modal -->


<!-- Modal -->

    
    <!--End enquiery form end-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            let portfolioItems = $(".portfolio-grid .item").length; // Count the number of items
           console.log(portfolioItems);
            if (portfolioItems > 3) {
                let loadMoreButton = `
                    <div class="load-more-container" style="text-align: center; margin-top: 20px;">
                        <button id="loadMoreButton" class="btn btn-primary">Load More</button>
                    </div>
                `;
        
                $(".portfolio-grid").after(loadMoreButton);
            }
            else if(portfolioItems == 0){
                let noDataMessage = `
                    <div class="no-data">
                        <h3>No Data Found</h3>
                    </div>
                    `;
                $(".portfolio-grid").after(noDataMessage);
            }
            var $grid = $('.portfolio-grid');
    
                // Initialize Shuffle.js
            var shuffleInstance = new Shuffle($grid[0], {
                itemSelector: ".item"
            });
            
            let offset = 3; // Start offset after the first 4 images
            let limit = 3; 
            
            $("#loadMoreButton").on("click", function() {
                let activeCategory = $(".portfolio-filters .active a").data("group");
                var itemClass = activeCategory === "category_detailed" ? "standard" : "lbimage";
                console.log(activeCategory);
                var shuffleInstance = new Shuffle($grid[0], {
                    itemSelector: `.item.${itemClass}`
                });
                let userId = $("#userId").val();

                $.ajax({
                    url: "/load-more-portfolios", // API Endpoint
                    type: "GET",
                    data: { offset: offset, limit: limit, category: activeCategory, user_id: userId }, // Send offset & limit
                    dataType: "json",
                    success: function (response) {
                        if (response.length > 0) {
                            response.forEach((portfolio) => {
                                 portfolio.image_urls.forEach((imageUrl) => {
                                    let newItem = $(`
                                        <figure class="item ${itemClass} shuffle-item" data-groups='["category_all", "${activeCategory}"]'>
                                            <div class="portfolio-item-img">
                                            <img src="${imageUrl}" alt="Portfolio Image"/>
                                            </div>
                                            <i class="far fa-file-alt"></i>
                                            <h4 class="name">${portfolio.title}</h4>
                                        </figure>
                                    `);
            
                                    $(".portfolio-grid").append(newItem);
            
                                    // Update Shuffle.js
                                    shuffleInstance.appended(newItem);
                                });
                            });
        
                            // Increase offset for next request
                            offset += limit;
                        } else {
                            $("#loadMoreButton").hide();
                        }
                    },
                    error: function () {
                        console.log("Error loading more items.");
                    }
                });
            });

            $(".portfolio-filters a").on("click", function (e) {
                e.preventDefault();
        
         let activeSection = $("section.section-active");
         activeSection.find(".no-data").remove();
                $(".portfolio-filters li").removeClass("active");
                $(this).parent().addClass("active");
        
                let selectedCategory = $(this).data("group");

                shuffleInstance.destroy();

                // Reinitialize Shuffle.js
                shuffleInstance = new Shuffle($grid[0], {
                    itemSelector: ".item.standard"
                });
                if (selectedCategory === "category_all") {
                    shuffleInstance.shuffle(Shuffle.ALL_ITEMS);
                } else {
                    shuffleInstance.shuffle(selectedCategory);
                }
        
                let visibleItems = $(".portfolio-grid .item").filter(function () {
                    return $(this).data("groups").includes(selectedCategory);
                });
        
                if (visibleItems.length == 0) {
                    $(".load-more-container").remove(); // Remove existing button
                    let activeSection = $("section.section-active");
                    activeSection.find(".no-data").remove(); // Remove only the no-data inside the active section
                    let noDataMessage = `
                        <div class="no-data">
                            <h3>No Data Found</h3>
                        </div>
                        `;
                        
                    activeSection.append(noDataMessage);
                }
                
            });

            $("#send_button").modal('show')
        });

function product_id(id){
    $("#proid").val(id)
}

$(".fixed-btn-section").on('click',function(){
    $("#stiky_main_btn").toggle();
})
    </script>
    
    <script>
    $('#answer-example-share-button').on('click', () => {
        var nurl="{{url('/profile')}}/";
  if (navigator.share) {
    navigator.share({
        title: 'Web Share',
        text: 'Hi, Check Digital Card of {{$userdata->name}} ',
        url: nurl+'{{$userdata->mobile}}',
      })
      .then(() => console.log('Successful share'))
      .catch((error) => console.log('Error sharing', error));
  } else {
    console.log('Share not supported on this browser, do it the old way.');
  }
});
</script>

<script>
    
    const fabElement = document.getElementById("floating-snap-btn-wrapper");
let oldPositionX,
  oldPositionY;

const move = (e) => {
  if (!fabElement.classList.contains("fab-active")) {
    if (e.type === "touchmove") {
      fabElement.style.top = e.touches[0].clientY + "px";
      fabElement.style.left = e.touches[0].clientX + "px";
    } else {
      fabElement.style.top = e.clientY + "px";
      fabElement.style.left = e.clientX + "px";
    }
  }
};

const mouseDown = (e) => {
  console.log("mouse down ");
  oldPositionY = fabElement.style.top;
  oldPositionX = fabElement.style.left;
  if (e.type === "mousedown") {
    window.addEventListener("mousemove", move);
  } else {
    window.addEventListener("touchmove", move);
  }

  fabElement.style.transition = "none";
};

const mouseUp = (e) => {
  console.log("mouse up");
  if (e.type === "mouseup") {
    window.removeEventListener("mousemove", move);
  } else {
    window.removeEventListener("touchmove", move);
  }
  snapToSide(e);
  fabElement.style.transition = "0.3s ease-in-out left";
};

const snapToSide = (e) => {
  const wrapperElement = document.getElementById('main-wrapper');
  const windowWidth = window.innerWidth;
  let currPositionX, currPositionY;
  if (e.type === "touchend") {
    currPositionX = e.changedTouches[0].clientX;
    currPositionY = e.changedTouches[0].clientY;
  } else {
    currPositionX = e.clientX;
    currPositionY = e.clientY;
  }
  if(currPositionY < 50) {
   fabElement.style.top = 50 + "px"; 
  }
  if(currPositionY > wrapperElement.clientHeight - 50) {
    fabElement.style.top = (wrapperElement.clientHeight - 50) + "px"; 
  }
  if (currPositionX < windowWidth / 2) {
    fabElement.style.left = 30 + "px";
    fabElement.classList.remove('right');
    fabElement.classList.add('left');
  } else {
    fabElement.style.left = windowWidth - 30 + "px";
    fabElement.classList.remove('left');
    fabElement.classList.add('right');
  }
};

fabElement.addEventListener("mousedown", mouseDown);

fabElement.addEventListener("mouseup", mouseUp);

fabElement.addEventListener("touchstart", mouseDown);

fabElement.addEventListener("touchend", mouseUp);

fabElement.addEventListener("click", (e) => {
  if (
    oldPositionY === fabElement.style.top &&
    oldPositionX === fabElement.style.left
  ) {
    fabElement.classList.toggle("fab-active");
  }
});

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
                       $("#prosuccess").text('Product Enquiery Send Succeefully');

                        
                    }
                    
                }); 
    
    
}
    
</script>



<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


$(".profession").on('click',function(){
    $(".defaultnone").addClass('displayblock');
    $(".sectiontwo").addClass('defaultnone');
    // Toggle active class
    $(".btn").removeClass('active-tab');
    $(this).addClass('active-tab');
})

$(".personal").on('click',function(){
    $(".sectiontwo").removeClass('defaultnone');
    $(".defaultnone").removeClass('displayblock');
     $(".btn").removeClass('active-tab');
    $(this).addClass('active-tab');
})

$(".readmore").on('click',function(){
    $('.text-1').toggle();
     $('.text-2').toggle();
     //$(this).text('<<--Read Less-->');
})


document.addEventListener("DOMContentLoaded", function () {
    console.log('test')
    var downloadButton = document.getElementById("downloadButton");
    
    downloadButton.addEventListener("click", function () {
        var htmlContent = document.documentElement.outerHTML;

        // Create a Blob containing the HTML content
        var blob = new Blob([htmlContent], { type: "text/html" });

        // Create a temporary link element to trigger the download
        var a = document.createElement("a");
        a.href = URL.createObjectURL(blob);
        a.download = "page.html";
        a.style.display = "none";
        document.body.appendChild(a);

        // Trigger the click event on the link
        a.click();

        // Remove the temporary link element
        document.body.removeChild(a);
    });
});



document.addEventListener("DOMContentLoaded", function () {
    console.log('test')
    var downloadButton = document.getElementById("downloadButtontwo");
    
    downloadButton.addEventListener("click", function () {
        var htmlContent = document.documentElement.outerHTML;

        // Create a Blob containing the HTML content
        var blob = new Blob([htmlContent], { type: "text/html" });

        // Create a temporary link element to trigger the download
        var a = document.createElement("a");
        a.href = URL.createObjectURL(blob);
        a.download = "page.html";
        a.style.display = "none";
        document.body.appendChild(a);

        // Trigger the click event on the link
        a.click();

        // Remove the temporary link element
        document.body.removeChild(a);
    });
});
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
</script>
@include('layouts.golden.footer')

