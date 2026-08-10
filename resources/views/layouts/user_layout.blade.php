<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>User Dashboard</title>
	
  <!-- Favicons-->
  <!--<link rel="shortcut icon" href="{{ URL::asset('frontend/assets/img/logo/fastap.png')}}" type="image/x-icon">-->
  <!--<link rel="apple-touch-icon" type="image/x-icon" href="{{ URL::asset('frontend/assets/img/logo/fastap.png')}}">-->
  <!--<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ URL::asset('frontend/assets/img/logo/fastap.png')}}">-->
  <!--<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ URL::asset('frontend/assets/img/logo/fastap.png')}}">-->
  <!--<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ URL::asset('frontend/assets/img/logo/fastap.png')}}">-->
  
    <link href="{{url ('public/profilevm/assets/img/favicon.png')}}" rel="icon">

  <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
	
  <!-- Bootstrap core CSS-->
  <link href="{{ URL::asset('user_dashboard/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Main styles -->
  <link href="{{ URL::asset('user_dashboard/css/admin.css')}}" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="{{ URL::asset('user_dashboard/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Plugin styles -->
  <link href="{{ URL::asset('user_dashboard/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Your custom styles -->
  <link href="{{ URL::asset('user_dashboard/css/custom.css')}}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
label{
    text-transform: uppercase;
    font-weight: bold;
}
.bold-upper{
    text-transform: uppercase;
    font-weight: bold;
}

.sticky-footer img {
    width: 150px;
}


.bg-default {
    background-color: #212529 !important;
}

footer.sticky-footer {
    background: #212529 !important;
}



/*.card_inner_main {*/
/*    display: flex;*/
/*    align-items: center;*/
/*    justify-content: space-between;*/
/*        width: 100% !important;*/
/*}*/
.card_table_data {
    border: solid 1px #EB1616;
    border-radius: 8px;
    background: #191C24 !important;
    padding: 10px 10px 0px;
    box-shadow: 0 0 10px #EB1616;
    margin-bottom: 15px;
    color: #6C7293;
}
.card_ulist ul {
    padding-left: 0px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin-bottom: 0px;
}

.card_ulist ul li {
    list-style: none;
    width: 50.33%;
    text-align: center;
    padding: 15px 0;
}

.card_ulist ul li:last-child {
    border-right: none;
}

.class_inner_card p {
    margin-bottom: 0px;
}

.profile_imgcard {
    height: 70px;
    width: 70px;
    border: solid 1px #d1cbcb;
    border-radius: 50px;
}

.profile_imgcard img {
    width: 64px;
    height: 65px;
    border-radius: 50px;
    display: block;
    margin: 0 auto;
    margin-top: 1px;
}

.class_inner_card.profile_links p {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
}

.mobile_card_order .modal-dialog {
    margin-top: 5px !important;
    margin-bottom: 5px !important;
}


.class_inner_card p {
    margin-bottom: 0px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    /*max-width: 100%;*/
}
.class_inner_card p {
   
    overflow: hidden !important;
    display: -webkit-box !important;
    -webkit-box-orient: vertical !important;
    -webkit-line-clamp: 1 !important;
    width: 90%;
}


@media(max-width:767px){
    footer.sticky-footer img {
    width: 100px !important;
}

footer.sticky-footer {
    height: 74px;
    line-height: 30px;
}
}

.navbar-expand-lg .navbar-nav .dropdown-menu {
    position: absolute;
    z-index: 99999 !important;
}

.main_fixed_nav {
    position: fixed;
    background: #bdbfc1;
    width: 352px;
    padding: 15px 10px;
    z-index: 999 !important;
}





.stiky_main_btn {
    position: absolute;
    bottom: 58px;
    right: 41px;
}
.stiky_main_btn ul li {
    list-style: none !important;
}

.stiky_main_btn ul li i {
    background: #392779;
    color: #fff !important;
    padding: 14px 15px;
    margin-bottom: 3px;
    border-radius: 23px;
    font-size: 17px;
}

.stiky_main_btn ul {
    padding-left: 0px !important;
}

.stiky_main_btn {
    position: fixed;
    bottom: 58px;
    right: 41px;
    z-index: 11 !important;
}
.whatsapp1:hover{
        background: #0882ff;
    color: #fff !important;
    margin-bottom: 3px;
    border-radius: 23px;
    font-size: 17px;
}
.whatsapp3:hover{
        background: #08ffe1;
    color: #fff !important;
    margin-bottom: 3px;
    border-radius: 23px;
    font-size: 17px;
}
.whatsapp4:hover{
        background: #3320e7d6;
    color: #fff !important;
    margin-bottom: 3px;
    border-radius: 23px;
    font-size: 17px;
}
.whatsapp2:hover{
        background: #25d366;
    color: #fff !important;
    margin-bottom: 3px;
    border-radius: 23px;
    font-size: 17px;
}


.tabpagenew.mt-4 {
    border-bottom: solid 1px #d1cccc;
    padding-bottom: 15px;
}


#mainNav .navbar-collapse .navbar-sidenav > .nav-item {
    width: 125px;
    padding: 0px;
}
#mainNav .navbar-collapse .navbar-sidenav > .nav-item:hover {
   background: #000 !important;
   color: #EB1616 !important;
}
.sidebar_footer_main li.nav-item {
    width: 125px !important;
}
/*#mainNav .navbar-brand {*/
/*    width: 95px;*/
/*}*/

#mainNav .navbar-collapse .navbar-sidenav {
   
    margin-top: 62px !important;
}
#mainNav .navbar-brand img {
    width: 60%;
}
.nav-link-btn {
    color: #fff;
    background-color: #bc1212;
    border-color: #b01111;
}
.nav-link-btn:hover {
    color: #b01111;
    background-color: #ffffff !important;
    border-color: #b01111;
}

.fa-fw {
    color:#b01111;
}
.userdashboard_sidebar a.nav-link p span {
    color: #FFFFFF !important;
    font-size: 13px;
}
.userdashboard_sidebar a.nav-link p {
    margin-bottom: 0px;
    text-align: center;
}
/*#mainNav.navbar-dark .navbar-collapse .navbar-sidenav > .nav-item > .nav-link {*/
/*    color: #ced4da;*/
/*    background: #4a10a5;*/
/*    border-radius: 15px;*/
/*}*/
#mainNav .navbar-brand {
    width: 185px !important;
}
@media(max-width:992px){
    #mainNav .navbar-collapse .navbar-sidenav > .nav-item {
    width: 100% !important;
    padding: 0;
}
.sidebar_footer_main li.nav-item {
    width: 100% !important;
}
#mainNav .navbar-brand {
    width: 100%;
}
#mainNav .navbar-brand {
    width: 62% !important;
}
#mainNav .navbar-brand img {
    width: 144px !important;
}
}

.mobile_main_relative {
    width: 83%;
    margin: 0 auto;
}

.tabpagenew_mobile {
    display: none !important;
}
@media(max-width:767px){
/*    .tabpagenew ul.nav {*/
/*    display: block !important;*/
    /* text-align: center; */
/*}*/
.tabpagenew.mt-4 {
    margin-top: 8px !important;
}
.tabpagenew_mobile {
    display: block !important;
}
.tabpagenew_desktop {
    display: none !important;
}

.tabpagenew_mobile button.btn.dropdown-toggle {
    padding: 0px !important;
    background: transparent;
    font-size: 13px;
    line-height: 13px !important;
}

.tabpagenew_mobile .dropdown {
    line-height: 14px !important;
    color:#392779 !important;
}

.tabpagenew_mobile .dropdown a.dropdown-item {
    font-size: 13px;
    color:#392779 !important;
}
}


nav#mainNav {
    #191C24 !important
}


/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/

/*anand start code for hide iframe in mobile device */

/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/
@media (min-width: 320px) and (max-width: 480px) {
  .mobile_main_relative{display:none !important;}
  
  .box_general{margin-top:20% !important;}
}


  /* Style for the non-removable alert */
    .non-removable-alert {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: #ff0000; 
        color: #fff; 
        padding: 10px;
        text-align: center;
        z-index: 9999; 
    }
        
    .access{
        pointer-events: none !important;
        opacity: 0.1;
        background-color:#404040;
    }  
    .non-removable-alert{
        display:none;
    }
/* anand end code */

</style>
	
@if(Session::get('theme') == 1 && Session::get('panel') == 1)
<style>

.themdrodwn{
    background-color: #218f9b !important;
    color: white !important;
}


   .them_change{
    background-color:#fff !important;
    
}

.them_change_second{
    background-color:#06163a !important;
   
} 
 ul#exampleAccordion {
    background: #06163a !important;
}  

nav#mainNav {
    /* background: #194170 !important; */
    background-image: linear-gradient(45deg, #0d3faf, #06163a) !important;
}

.nav-link-btn {
    color: #fff;
    /* background-color: #bc1212; */
    /* border-color: #b01111; */
    background-image: linear-gradient(45deg, #13b0c1, transparent) !important;
}

.nav-link-btn {
    color: #fff;
    background-color: #218f9b;
    border-color: #218f9b;
}

.fa-fw {
    color: #1f939f !important;
}

a:hover {
    background-color: #18a5b547 !important;
    color: #EB1616 !important;
}

#mainNav.navbar-dark .navbar-collapse .navbar-sidenav > .nav-item > .nav-link > p > .nav-link-text:hover {
    color: #ffffff !important;
}


footer.sticky-footer {
   background-image: linear-gradient(45deg, #0d3faf, #06163a) !important;
   color: white;
}


#mainNav.fixed-top.navbar-dark .sidenav-toggler {
    background-color: #06163a !important;
    border-top: 1px solid #191C24 !important;
}


</style>
@endif	
</head>

<!--<body class="fixed-nav sticky-footer" id="page-top">-->

<!-- annad start code for disable right click all userpanel -->

    <?php
        $userId = Session::get('FRONT_USER_ID');
        
        $customer = \App\Models\customer::where('id', $userId)->first();
     
        if ($customer) 
        {
            $permission = $customer->permission;
        
            $bodyClass = $permission == 0 ? 'access' : '';
            
            $style = $permission == 0 ? 'display:block' : '';
            
        } else {
             
            $style = '';
            $bodyClass = '';
        }

    ?>
    
<body class="fixed-nav sticky-footer {{ $bodyClass }}" id="page-top">
    
     <script>
        // document.addEventListener('contextmenu', function(e) {
        //     e.preventDefault();
        // });
    </script>
    

    <div class="non-removable-alert" style="{{$style}}">
        <!--You don't access user panel because not approved by admin.-->
        You don't access the user panel because not given permission by the admin.
        <a href="{{url('/Product')}}" class="btn btn-info" id="enable-button" style="pointer-events: auto !important; opacity: 1 !important;">Buy Now </a>
    </div>
    
    
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
// <script>
    // window.onload = function() {
    //     // Code to display an alert when the page loads
    //     alert("You don't access user panel because not approved by admin.");
    // };
// </script>
 <!-- annad end code -->   
 
 
    <!--<div class="stiky_main_btn">-->
    <!--    <ul>-->
    <!--        <li><a href="#"><i class="fa fa-share-alt-square whatsapp1" aria-hidden="true"></i></a></li>-->
    <!--        <li><a href="#"><i class="fa fa-whatsapp whatsapp2" aria-hidden="true"></i></a></li>-->
    <!--        <li><a href="#"><i class="fa fa-phone-square whatsapp3" aria-hidden="true"></i></a></li>-->
    <!--        <li><a href="#"><i class="fa fa-download whatsapp4" aria-hidden="true"></i></a></li>-->
    <!--    </ul>-->
    <!--</div>-->
  <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
        <a class="navbar-brand" href="{{ url('/leads') }}">
        <!--<img src="{{ URL::asset('frontend/images/logo/logo.png')}}" data-retina="true" alt="" width="163" height="36">-->
                <img src="{{ URL::asset('frontend/assets/img/logo/fastap.png')}}" data-retina="true" alt="" width="163" height="36">
        <!--Profilemeet-->
        </a>
         <a class="top_btn btn  float-left mb-2 nav-link-btn bold-upper" href="/" target="_blank">
              Go Website
          </a>
          &nbsp;&nbsp;
            <a class="top_btn btn  float-left mb-2 nav-link-btn bold-upper" href="/profile" target="_blank">
              View Profile
          </a>
          
          @if(Session::get('panel') == 1)
          &nbsp;&nbsp;
          <a class="top_btn btn float-left mb-2 nav-link-btn px-4 bold-upper" href="/loginuser/theme_change">
             Theme Change
          </a>
          <!--<div class="col-2 col-md-2">
          <select class="form-control themdrodwn"  id="thempanel" style="background-color:#bc1212">
               <option>--Admin Theme--</option>
              <option {{Session::get('theme') == 0?'selected':''}}>Default Theme</option>
              <option {{Session::get('theme') == 1?'selected':''}}>Premium Theme</option>
          </select>
          
          
          </div>-->
          
           <!--<div class="col-2 col-md-2">
          <select class="form-control themdrodwn"  id="thempanelprofile" style="background-color:#bc1212">
              <option>-- Profile Theme --</option>
              <option  {{Session::get('theme_profile') == 0?'selected':''}}>Default Theme</option>
              <option  {{Session::get('theme_profile') == 1?'selected':''}}>Dark Theme</option>
          </select>-->
          
          
          </div>
          @endif
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav userdashboard_sidebar" id="exampleAccordion">
        <!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">-->
        <!--  <a class="nav-link" href="newindex">-->
        <!--    <i class="fa fa-fw fa-dashboard"></i>-->
        <!--    <span class="nav-link-text">Dashboard</span>-->
        <!--  </a>-->
        <!--</li>-->
	
		 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Leads">
          <a class="nav-link" href="{{ url('/leads') }}">
            <p><i class="fa fa-fw fa-tachometer"></i></p>
            <p><span class="nav-link-text">Dashboard</span></p>
          </a>
         </li>
  
		<!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">-->
  <!--        <a class="nav-link" href="{{ url('/') }}">-->
  <!--            <p><i class="fa fa-fw fa-plus-circle"></i></p>-->
  <!--              <p><span class="nav-link-text">Home</span></p>-->
            
  <!--        </a>-->
  <!--      </li>-->
        <li class="nav-item" >
          <a class="nav-link " href="/userdashboard" >
            <p><i class="fa fa-fw  fa-user"></i></p>
            <p><span class="nav-link-text">Profile</span></p>
          </a>
          {{--<ul class="sidenav-second-level collapse" id="collapseProfile">
            <li>
              <a href="userdashboard">MY PROFILE</a>
            </li>
			<li>
              <a href="myqualification">MY QUALIFICATION</a>
            </li>
            	<li>
              <a href="{{ url('myprofessions') }}">MY PROFESSION</a>
            </li>
            <li>
              <a href="{{ url('mythought') }}">MY THOUGHT</a>
            </li>
             <li>
              <a href="{{ url('myportfolio') }}">MY PHOTOS</a>
            </li>
             <li>
              <a href="{{ url('mysocial') }}">MY SOCIAL LINK</a>
            </li>
          </ul>--}}
        </li>
		<!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">-->
  <!--        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">-->
  <!--          <i class="fa fa-fw fa-gear"></i>-->
  <!--          <span class="nav-link-text">Components</span>-->
  <!--        </a>-->
  <!--        <ul class="sidenav-second-level collapse" id="collapseComponents">-->
  <!--          <li>-->
  <!--            <a href="charts.html">Charts</a>-->
  <!--          </li>-->
		<!--	<li>-->
  <!--            <a href="tables.html">Tables</a>-->
  <!--          </li>-->
  <!--        </ul>-->
  <!--      </li>-->
  

  <li class="nav-item">
          <a class="nav-link" href="{{ url('myorder') }}">
            <p><i class="fa fa-fw fa-shopping-bag"></i></p>
            <p><span class="nav-link-text">Orders</span></p>
          </a>
          
         {{-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseOrder" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Orders</span>
          </a>
         <ul class="sidenav-second-level collapse" id="collapseOrder">
            <li>
              <a href="{{ url('myorder') }}">All Order</a>
            </li>
			<li>
              <a href="{{ url('trackyourorder') }}">Track Your Order</a>
            </li>
            
          </ul>--}}
        </li>
  
  
  
  
 {{-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
          <a class="nav-link" href="{{ url('myorder') }}">
            <i class="fa fa-fw fa-plus-circle"></i>
            <span class="nav-link-
            text">Orders</span>
          </a>
        </li>--}}
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
          <a class="nav-link" href="{{ url('changepassword') }}">
           <p><i class="fa fa-fw fa-plus-circle"></i></p> 
            <p><span class="nav-link-text">Change Password</span></p>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
          <a class="nav-link" href="/Product" target="_blank">
            <p><i class="fa fa-fw fa-plus-circle"></i></p>
            <p><span class="nav-link-text">Buy a new smart card</span></p>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
          <a class="nav-link" href="{{ url('qrcode') }}">
            <p><i class="fa fa-fw fa-qrcode"></i></p>
            <p><span class="nav-link-text">QR Code</span></p>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler sidebar_footer_main">
        <li class="nav-item">
          <a class="nav-link text-center">
               <!--id="sidenavToggler"-->
            <!--<i class="fa fa-fw fa-angle-left"></i>-->&nbsp;
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!--<li class="nav-item dropdown">-->
        <!--  <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
        <!--    <i class="fa fa-fw fa-envelope"></i>-->
        <!--    <span class="d-lg-none">Messages-->
        <!--      <span class="badge badge-pill badge-primary">12 New</span>-->
        <!--    </span>-->
        <!--    <span class="indicator text-primary d-none d-lg-block">-->
        <!--      <i class="fa fa-fw fa-circle"></i>-->
        <!--    </span>-->
        <!--  </a>-->
        <!--  <div class="dropdown-menu" aria-labelledby="messagesDropdown">-->
        <!--    <h6 class="dropdown-header">New Messages:</h6>-->
        <!--    <div class="dropdown-divider"></div>-->
        <!--    <a class="dropdown-item" href="#">-->
        <!--      <strong>David Miller</strong>-->
        <!--      <span class="small float-right text-muted">11:21 AM</span>-->
        <!--      <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>-->
        <!--    </a>-->
        <!--    <div class="dropdown-divider"></div>-->
        <!--    <a class="dropdown-item" href="#">-->
        <!--      <strong>Jane Smith</strong>-->
        <!--      <span class="small float-right text-muted">11:21 AM</span>-->
        <!--      <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>-->
        <!--    </a>-->
        <!--    <div class="dropdown-divider"></div>-->
        <!--    <a class="dropdown-item" href="#">-->
        <!--      <strong>John Doe</strong>-->
        <!--      <span class="small float-right text-muted">11:21 AM</span>-->
        <!--      <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>-->
        <!--    </a>-->
        <!--    <div class="dropdown-divider"></div>-->
        <!--    <a class="dropdown-item small" href="#">View all messages</a>-->
        <!--  </div>-->
        <!--</li>-->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <!--<i class="fa fa-fw fa-bell"></i>-->
            Fastap
            <!--<span class="d-lg-none">Alerts-->
            <!--  <span class="badge badge-pill badge-warning">6 New</span>-->
            <!--</span>-->
            <!--<span class="indicator text-warning d-none d-lg-block">-->
            <!--  <i class="fa fa-fw fa-circle"></i>-->
            <!--</span>-->
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <!--<h6 class="dropdown-header">New Alerts:</h6>-->
            
            <a class="dropdown-item" href="{{ url('profile') }}">
             <i class="fa fa-eye" aria-hidden="true"></i> View Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('logout') }}">
             <i class="fa fa-fw fa-sign-out"></i> Logout
            </a>
          </div>
        </li>
       
        <!--<li class="nav-item">-->
        <!--  <a class="nav-link" data-toggle="modal" data-target="#exampleModal">-->
        <!--    <i class="fa fa-fw fa-sign-out"></i>Logout</a>-->
        <!--</li>-->
      </ul>
    </div>
  </nav>
  <!-- /Navigation-->
  <div class="content-wrapper them_change">
     
    @yield('content')
	  <!-- /.container-fluid-->
   	</div>
    <!-- /.container-wrapper-->
    <footer class="sticky-footer ">
      <div class="container">
        <div class="text-center">
          <small>Copyright © FASTAP<?php echo date("Y") ; ?> All right reserved. <span><b>Make Your Profile in 2 Minutes with fastap.in </b> <a href="{{ url('') }}">
              <!--<img src="{{ URL::asset('frontend/images/logo/logo.png')}}">-->
               <img src="{{ URL::asset('frontend/assets/img/logo/fastap.png')}}">
              </a></span></small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('user_dashboard/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('user_dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ URL::asset('user_dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ URL::asset('user_dashboard/vendor/chart.js/Chart.js')}}"></script>
    <script src="{{ URL::asset('user_dashboard/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ URL::asset('user_dashboard/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
	<script src="{{ URL::asset('user_dashboard/vendor/jquery.selectbox-0.2.js')}}"></script>
	<script src="{{ URL::asset('user_dashboard/vendor/retina-replace.min.js')}}"></script>
	<script src="{{ URL::asset('user_dashboard/vendor/jquery.magnific-popup.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ URL::asset('user_dashboard/js/admin.js')}}"></script>
	<!-- Custom scripts for this page-->
    <script src="{{ URL::asset('user_dashboard/js/admin-charts.js')}}"></script>
    <script src="{{ URL::asset('user_dashboard/js/admin-datatables.js')}}"></script>
    
    <script>
        $("#thempanel").on('change',function(){
            window.location.href = '/loginuser/theme_change';
        })
        
    </script>
    
     <script>
        $("#thempanelprofile").on('change',function(){
            window.location.href = '/loginuser/theme_change_profile';
        })
        
    </script>
</body>

</html>
