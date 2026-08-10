
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Bootstrap 5 Responsive Gaspar | Personal Portfolio HTML Template">
  <meta name="keywords"
    content="Gaspar | Personal Portfolio HTML Template , template, bootstrap 5, ui template kit, Gaspar Personal Portfolio, html, css">
  <meta name="author" content="Gaspar | Personal Portfolio HTML Template">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Favicons -->
  <link href="{{ URL::asset('frontend/profile_assets/assets/img/favicon.png')}}" rel="icon">
  <!-- Google Fonts -->
  <link href="{{ URL::asset('frontend/profile_assets/assets/fonts/fonts.css')}}" rel="stylesheet">
  <!-- Bootstrap CSS-->
  <link href="{{ URL::asset('frontend/profile_assets/assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font-Awesome CSS -->
  <link href="{{ URL::asset('frontend/profile_assets/assets/css/all.css')}}" rel="stylesheet">
  <!-- Animate CSS-->
  <!--<link href="{{ URL::asset('frontend/profile_assets/assets/css/animate.min.css')}}" rel="stylesheet">-->
  <!-- Glightbox CSS-->
  <!--<link href="{{ URL::asset('frontend/profile_assets/assets/css/glightbox.min.css')}}" rel="stylesheet">-->
  <!-- Swiper CSS-->
  <link href="{{ URL::asset('frontend/profile_assets/assets/css/swiper-bundle.min.css')}}" rel="stylesheet">
  <!-- Style CSS File -->
  <link href="{{ URL::asset('frontend/profile_assets/assets/css/style.css')}}" rel="stylesheet">
  <!-- Colors CSS -->
  <!--<link rel="stylesheet" type="text/css" href="{{ URL::asset('frontend/profile_assets/assets/css/colors.css')}}" />-->
  <!-- Live Style Switcher - demo only -->
  <!--<link id="style-switch" href="{{ URL::asset('frontend/profile_assets/assets/css/colors/orange.css')}}" media="screen" rel="stylesheet" type="text/css">-->
  <!-- Responsive CSS File -->
  <link href="{{ URL::asset('frontend/profile_assets/assets/css/responsive.css')}}" rel="stylesheet">
</head>

<body>
  <!--<div class="gaspar" data-magic-cursor="show" data-color="crimson">-->
    <!-- Pre Loader -->
    <!--<div id="preloader">-->
    <!--  <div class="loader_line"></div>-->
    <!--</div>-->
    <!-- Pre Loader end -->
     <!-- Style switcher start -->
	<!--<div class="style-switch-wrapper">-->
	<!--	<div class="style-switch-button">-->
	<!--		<i class="fa fa-cog" aria-hidden="true"></i>-->
	<!--	</div>-->
	<!--	<h4>Unlimited Colors</h4>-->
 <!--   <ul class="">-->
 <!--     <li id="preset1" class=""><img-->
 <!--       src="assets/img/colors/orange.png" alt="orange" /></li>-->
 <!--     <li id="preset2" class=""><img-->
 <!--       src="assets/img/colors/purple.png" alt="purple" /></li>-->
 <!--     <li id="preset3" class=""><img-->
 <!--       src="assets/img/colors/red.png" alt="red" /></li>-->
 <!--     <li id="preset4" class=""><img-->
 <!--       src="assets/img/colors/violet.png" alt="violet" /></li>-->
 <!--     <li id="preset5" class=""><img-->
 <!--       src="assets/img/colors/blue.png" alt="blue" /></li>-->
 <!--     <li id="preset6" class=""><img-->
 <!--       src="assets/img/colors/golden.png" alt="golden" /></li>-->
 <!--     <li id="preset7" class=""><img-->
 <!--       src="assets/img/colors/magenta.png" alt="magenta" /></li>-->
 <!--     <li id="preset8" class=""><img-->
 <!--       src="assets/img/colors/yellowgreen.png" alt="yellowgreen" /></li>-->
 <!--     <li id="preset9" class=""><img-->
 <!--       src="assets/img/colors/green.png" alt="green" /></li>-->
 <!--     <li id="preset10" class=""><img-->
 <!--       src="assets/img/colors/yellow.png" alt="yellow" /></li>-->
 <!--   </ul>-->
 <!--   <h4>Light Mode</h4>-->
 <!--       <div class="switch" id="switcherrr">-->
 <!--         <a href="https://avstechnolabs.com/Themeforest/Gaspar/02/Dark/index.html"><i class="fas fa-moon open"></i></a>-->
 <!--       </div>-->
 <!--       <h4 class="title">Magic Cursor</h4>-->
 <!--       <ul class="cursor">-->
 <!--         <li><a class="showme show" href="#"></a></li>-->
 <!--         <li><a class="hide" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="svg" id="Capa_1"-->
 <!--               enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"-->
 <!--              >-->
 <!--               <g>-->
 <!--                 <path d="m451.002 183.574h29.997v84.853h-29.997z"-->
 <!--                   transform="matrix(.707 -.707 .707 .707 -23.318 395.706)"></path>-->
 <!--                 <path d="m271.002 3.574h29.997v84.853h-29.997z"-->
 <!--                   transform="matrix(.707 -.707 .707 .707 51.241 215.706)"></path>-->
 <!--                 <path d="m423.574 31.002h84.853v29.997h-84.853z"-->
 <!--                   transform="matrix(.707 -.707 .707 .707 103.961 342.985)"></path>-->
 <!--                 <path-->
 <!--                   d="m42.422 512 150.458-150.458 42.114 125.464 152.988-362.988-362.988 152.988 125.464 42.114-150.458 150.458z">-->
 <!--                 </path>-->
 <!--                 <path d="m361 0h30v61h-30z"></path>-->
 <!--                 <path d="m451 121h61v30h-61z"></path>-->
 <!--               </g>-->
 <!--             </svg></a></li>-->
 <!--       </ul>-->
 <!--       <a target="_blank" href="https://themeforest.net/item/gaspar-personal-portfolio-html-template/36192601"-->
 <!--         class="purchse-btn"><i class="fa fa-shopping-cart"></i> Purchase</a>-->
	<!--</div>-->
   <!-- Style switcher End -->
    <!-- ======= Header ======= -->
   @include('frontend.profile.header')
    <!-- End Header -->
 <!-- ======= Main Section ======= -->
    <main id="main">
      <!-- ======= Hero Section ======= -->
     @yield('content')

      <!-- ======= Footer ======= -->
      @include('frontend.profile.footer')
      <!-- End Footer -->

    </main><!-- End main -->

    <a href="#hero" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="fas fa-arrow-up"></i></a>
    <!-- Mouse-Cursor -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- Mouse-Cursor End-->
  <!--</div>-->
  <!-- Purecounter JS-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/purecounter.js')}}"></script>
  <!-- Bootstrap JS-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Glightbox Js-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/glightbox.min.js')}}"></script>
  <!-- Isotope JS-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/isotope.pkgd.min.js')}}"></script>
  <!-- Swiper JS-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/swiper-bundle.min.js')}}"></script>
  <!-- Noframework JS-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/noframework.waypoints.js')}}"></script>
  <!-- Jquery JS-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/jquery.min.js')}}"></script>
  <!-- Wow JS-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/wow.min.js')}}"></script> 
  <!-- typed JS-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/typed.js')}}"></script>
   <!-- Colors JS -->
   <script src="{{ URL::asset('frontend/profile_assets/assets/js/color.js')}}"></script>
   <!-- Style switch -->
   <script src="{{ URL::asset('frontend/profile_assets/assets/js/style.switch.js')}}"></script>
  <!-- Main JS-->
  <script src="{{ URL::asset('frontend/profile_assets/assets/js/main.js')}}"></script>
</body>

</html>