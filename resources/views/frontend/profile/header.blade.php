<!--<div class="gaspar" data-magic-cursor="show" data-color="crimson">-->
    <!-- Pre Loader -->
<!--    <div id="preloader">-->
<!--      <div class="loader_line"></div>-->
<!--    </div>-->
    <!-- Pre Loader end -->
     <!-- Style switcher start -->
<!--	<div class="style-switch-wrapper">-->
<!--		<div class="style-switch-button" style="display:none">-->
<!--			<i class="fa fa-cog" aria-hidden="true"></i>-->
<!--		</div>-->
<!--		<h4>Unlimited Colors</h4>-->
<!--    <ul class="">-->
<!--      <li id="preset1" class=""><img-->
<!--        src="assets/img/colors/orange.png" alt="orange" /></li>-->
<!--      <li id="preset2" class=""><img-->
<!--        src="assets/img/colors/purple.png" alt="purple" /></li>-->
<!--      <li id="preset3" class=""><img-->
<!--        src="assets/img/colors/red.png" alt="red" /></li>-->
<!--      <li id="preset4" class=""><img-->
<!--        src="assets/img/colors/violet.png" alt="violet" /></li>-->
<!--      <li id="preset5" class=""><img-->
<!--        src="assets/img/colors/blue.png" alt="blue" /></li>-->
<!--      <li id="preset6" class=""><img-->
<!--        src="assets/img/colors/golden.png" alt="golden" /></li>-->
<!--      <li id="preset7" class=""><img-->
<!--        src="assets/img/colors/magenta.png" alt="magenta" /></li>-->
<!--      <li id="preset8" class=""><img-->
<!--        src="assets/img/colors/yellowgreen.png" alt="yellowgreen" /></li>-->
<!--      <li id="preset9" class=""><img-->
<!--        src="assets/img/colors/green.png" alt="green" /></li>-->
<!--      <li id="preset10" class=""><img-->
<!--        src="assets/img/colors/yellow.png" alt="yellow" /></li>-->
<!--    </ul>-->
<!--    <h4>Light Mode</h4>-->
<!--        <div class="switch" id="switcherrr">-->
<!--          <a href="https://avstechnolabs.com/Themeforest/Gaspar/02/Dark/index.html"><i class="fas fa-moon open"></i></a>-->
<!--        </div>-->
<!--        <h4 class="title">Magic Cursor</h4>-->
<!--        <ul class="cursor">-->
<!--          <li><a class="showme show" href="#"></a></li>-->
<!--          <li><a class="hide" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="svg" id="Capa_1"-->
<!--                enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"-->
<!--               >-->
<!--                <g>-->
<!--                  <path d="m451.002 183.574h29.997v84.853h-29.997z"-->
<!--                    transform="matrix(.707 -.707 .707 .707 -23.318 395.706)"></path>-->
<!--                  <path d="m271.002 3.574h29.997v84.853h-29.997z"-->
<!--                    transform="matrix(.707 -.707 .707 .707 51.241 215.706)"></path>-->
<!--                  <path d="m423.574 31.002h84.853v29.997h-84.853z"-->
<!--                    transform="matrix(.707 -.707 .707 .707 103.961 342.985)"></path>-->
<!--                  <path-->
<!--                    d="m42.422 512 150.458-150.458 42.114 125.464 152.988-362.988-362.988 152.988 125.464 42.114-150.458 150.458z">-->
<!--                  </path>-->
<!--                  <path d="m361 0h30v61h-30z"></path>-->
<!--                  <path d="m451 121h61v30h-61z"></path>-->
<!--                </g>-->
<!--              </svg></a></li>-->
<!--        </ul>-->
<!--        <a target="_blank" href="https://themeforest.net/item/gaspar-personal-portfolio-html-template/36192601"-->
<!--          class="purchse-btn"><i class="fa fa-shopping-cart"></i> Purchase</a>-->
<!--	</div>-->
   <!-- Style switcher End -->
    <!-- ======= Header ======= -->
    <header id="header" class="header-transparent">
      <div class="profile">
        <!--<img src="assets/img/me2.jpeg" alt="" class="img-fluid">-->
        <img src="{{ url('public/frontend/user_images',$userdata->profile)}}" alt="" class="img-fluid">
        <h1>{{$userdata->name}}</h1>
      </div>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero"><i class="fas fa-house-user"></i>Home</a></li>
          <li><a class="nav-link scrollto" href="#about"><i class="fas fa-user-alt"></i>About</a></li>
          <li><a class="nav-link scrollto" href="#services"><i class="fas fa-poll"></i>Services</a></li>
          <li><a class="nav-link scrollto" href="#portfolio"> <i class="fas fa-briefcase"></i>Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#qualification"> <i class="fas fa-user-alt"></i>Qualification</a></li>
          <li><a class="nav-link scrollto" href="#pdf"> <i class="fas fa-user-alt"></i>PDF</a></li>
          <!--<li><a class="nav-link scrollto" href="#blog"><i class="fas fa-file"></i>Blog</a></li>-->
          <!--<li><a class="nav-link scrollto" href="#contact"><i class="fas fa-envelope"></i>Contact</a></li>-->
        </ul>
        <!--i class="fas fa-bars mobile-nav-toggle"></i-->
      </nav><!-- .navbar -->
      <div class="social-links">
         <a href="{{$social['youtube']??'#'}}" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
        <a href="{{$social['twitter']??'#'}}" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
        <a href="{{$social['facebook']??'#'}}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="{{$social['instagram']??'#'}}" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
        <a href="{{$social['snapchat']??'#'}}"  target="_blank" class="google-plus"><i class="fab fa-skype"></i></a>
      </div>
      
      
    <!-- anand start code for show model popup in my product in profile -->
    <!-- Add these links in your HTML head section -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- anand end code for show model popup in my product in profile -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

    </header><!-- End Header -->
    
    
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"); /* import font */

:root{
    --white: #f9f9f9;
    --black: #36383F;
    --gray: #85888C;
} /* variables*/

/* Reset */
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{
    background-color: var(--white);
    font-family: "Poppins", sans-serif;
}
a{
    text-decoration: none;
}
ul{
    list-style: none;
}

.header{
    background-color: rgb(128,36,204);
    box-shadow: 1px 1px 5px 0px var(--gray);
    position: sticky;
    top: 0;
    width: 100%;
    z-index: 9999;
    
   
}

.modal {
    position: fixed;
    top: 63px;
    left: 0;
    z-index: 1055;
    display: none;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
}
/* Header */
/*@media only screen and (min-width: 1200px) {
  

}*/

/* Logo */
.logo{
    display: inline-block;
    color: var(--white);
    font-size: 60px;
    margin-left: 10px;
}

/* Nav menu */
.nav{
    width: 100%;
    height: 100%;
    position: fixed;
    background-color: #f7f9ff;
    overflow: hidden;

}
.menu a{
    display: block;
    padding: 8px;
    color: white;
}
.menu a:hover{
    background-color: var(--gray);
}
.nav{
    max-height: 0;
    transition: max-height .5s ease-out;
}

/* Menu Icon */
.hamb{
    cursor: pointer;
    float: right;
    padding: 40px 20px;
}/* Style label tag */

.hamb-line {
    background: var(--white);
    display: block;
    height: 2px;
    position: relative;
    width: 24px;

} /* Style span tag */

.hamb-line::before,
.hamb-line::after{
    background: var(--white);
    content: '';
    display: block;
    height: 100%;
    position: absolute;
    transition: all .2s ease-out;
    width: 100%;
}
.hamb-line::before{
    top: 5px;
}
.hamb-line::after{
    top: -5px;
}

.side-menu {
    display: none;
} /* Hide checkbox */


/* Toggle menu icon */
.side-menu:checked ~ nav{
    max-height: 14%;
}
.side-menu:checked ~ .hamb .hamb-line {
    background: transparent;
}
.side-menu:checked ~ .hamb .hamb-line::before {
    transform: rotate(-45deg);
    top:0;
}
.side-menu:checked ~ .hamb .hamb-line::after {
    transform: rotate(45deg);
    top:0;
}
.menu li {
    display: inline-block;
}
/* Responsiveness */
@media (min-width: 768px) {
    
    .nav{
        max-height: none;
        top: 0;
        position: relative;
        float: right;
        width: fit-content;
        background-color: transparent;
    }
    .menu li{
        float: left;
    }
    .menu a:hover{
        background-color: transparent;
        color: var(--gray);

    }

    .hamb{
        display: none;
    }
}
        
    </style>
    <header class="header">
       
       @if(isset($userdata->profile) && $userdata->profile!='')
        <a href="#" class="logo"><img src="{{ url('public/frontend/user_images',$userdata->profile)}}" alt="Image" style="height: 50px;text-align: center;margin: 0 auto;display: block;margin-top: 10px;border-radius: 50%;width: 50px;">
</a>
        @endif
      
        <input class="side-menu" type="checkbox" id="side-menu"/>
        <label class="hamb" for="side-menu"><span class="hamb-line"></span></label>
        
        <nav class="nav">
            <ul class="menu">
                <li><a href="#">Home</a></li>
                <li><a href="#about">About</a> </li>
                <li><a href="#services">Services</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#qualification">Qualification</a></li>
                <li><a href="#pdf">PDF</a></li>
                
            </ul>
        </nav>
    </header>
    
    