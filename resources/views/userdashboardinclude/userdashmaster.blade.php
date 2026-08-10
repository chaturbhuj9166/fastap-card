<!doctype html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">

<!--favicon-->
<link rel="icon" href="{{URL::asset('assets/images/logo-icon.png')}}" type="image/png" />
<!--plugins-->

<link href="{{URL::asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<link href="{{URL::asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
<!-- loader-->
<link href="{{URL::asset('assets/css/pace.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/js/pace.min.js')}}"></script>
<!-- Bootstrap CSS -->
<link href="{{URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/da3af72861.js" crossorigin="anonymous"></script>
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<!-- Theme Style CSS -->
<link rel="stylesheet" href="{{URL::asset('assets/css/dark-theme.css')}}" />
<link rel="stylesheet" href="{{URL::asset('assets/css/semi-dark.css')}}" />
<link rel="stylesheet" href="{{URL::asset('assets/css/header-colors.css')}}" />
<link href="{{URL::asset('assets/fancybox/css/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/ajax/jquery.min.js')}}"></script>
<link href="{{URL::asset('assets/css/bootstrap-toggle.min.css')}}" rel="stylesheet"/>
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css">

<link href="{{URL::asset('assets/Promo_panel/assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datetimepicker/css/classic.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('assets/plugins/datetimepicker/css/classic.time.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('assets/plugins/datetimepicker/css/classic.date.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{URL::asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="{{URL::asset('assets/Promo_panel/assets/plugins/switchery/js/switchery.min.js')}}"></script>

<title>@yield('page_title')</title>
</head>



<body>
<!--wrapper-->
<div class="wrapper">
<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
<div class="sidebar-header">
<div>
<img src="{{URL::asset('frontend/images/logo/logo.png')}}" class="logo-icon" alt="logo icon">
</div>
<!--<div>-->
<!--<h4 class="logo-text">Profilemeet</h4>-->
<!--</div>-->
<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
</div>
</div>
<!--navigation-->
<ul class="metismenu" id="menu">
<!--<li>-->
<!--<a href="userdashboard" >-->
<!--<div class="parent-icon"><i class='bx bx-home-circle'></i>-->
<!--</div>-->
<!--<div class="menu-title">Profile</div>-->
<!--</a>-->
<!--</li>-->
<li>
<a href="{{ url('/') }}" >
<div class="parent-icon"><i class='bx bx-home-circle'></i>
</div>
<div class="menu-title">Home</div>
</a>
</li>


<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fa fa-archive" aria-hidden="true"></i></div>
        <div class="menu-title">Profile</div>
    </a>
    <ul>
        <!--<li> 	-->
        <!--    <a href="userdashboard" ><i class="bx bx-right-arrow-alt"></i>My Profile</a>-->
        <!--</li>-->
        <!--<li> 	-->
        <!--    <a href="myqualification" ><i class="bx bx-right-arrow-alt"></i>My Qualification</a>-->
        <!--</li>-->
        <!--<li> 	-->
        <!--    <a href="myprofessions" ><i class="bx bx-right-arrow-alt"></i>My Profession</a>-->
        <!--</li>-->
        <!--<li> 	-->
        <!--    <a href="mythought" ><i class="bx bx-right-arrow-alt"></i>My Thought</a>-->
        <!--</li>-->
        <!--<li> 	-->
        <!--    <a href="myportfolio" ><i class="bx bx-right-arrow-alt"></i>My Photos</a>-->
        <!--</li>-->
        
        <!--<li> 	-->
        <!--    <a href="sociallist" ><i class="bx bx-right-arrow-alt"></i>My Social Link</a>-->
        <!--</li>-->
        
            <li class="nav-item">
                <a class="nav-link active"  href="{{ url('userdashboard') }}">My Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link"  href="{{ url('myqualification') }}">My Qualification</a>
              </li>
              <li class="nav-item">
                <a class="nav-link"  href="{{ url('myprofessions') }}">My Profession</a>
              </li>
               <li class="nav-item">
                <a class="nav-link"  href="{{ url('mythought') }}">My Thought</a>
              </li>
               <li class="nav-item">
                <a class="nav-link"  href="{{ url('myportfolio') }}">My Photos</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="{{ url('myvideos') }}">My Videos</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="{{ url('mysocial') }}">My Social Links</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('uploadfile') }}">Upload a file</a>
              </li>

        
    </ul>
</li>



<!--<li>-->
<!--<a href="myqualification" >-->
<!--<div class="parent-icon"><i class='bx bx-home-circle'></i>-->
<!--</div>-->
<!--<div class="menu-title">My Qualification</div>-->
<!--</a>-->
<!--</li>-->

<!--<li>-->
<!--<a href="myprofessions" >-->
<!--<div class="parent-icon"><i class='bx bx-home-circle'></i>-->
<!--</div>-->
<!--<div class="menu-title">My Profession</div>-->
<!--</a>-->
<!--</li>-->

<!--<li>-->
<!--<a href="mythought" >-->
<!--<div class="parent-icon"><i class='bx bx-home-circle'></i>-->
<!--</div>-->
<!--<div class="menu-title">My Thought</div>-->
<!--</a>-->
<!--</li>-->

<!--<li>-->
<!--<a href="myportfolio" >-->
<!--<div class="parent-icon"><i class='bx bx-home-circle'></i>-->
<!--</div>-->
<!--<div class="menu-title">My Portfolio</div>-->
<!--</a>-->
<!--</li>-->

<li>
<a href="myorder" >
<div class="parent-icon"><i class='bx bx-home-circle'></i>
</div>
<div class="menu-title">Orders</div>
</a>
</li>

<li>
<a href="changepassword" >
<div class="parent-icon"><i class='bx bx-home-circle'></i>
</div>
<div class="menu-title">Change Password</div>
</a>
</li>
@php
$url = url('index');
@endphp
<li>
<a href="{{ url('allproducts') }}" >
<div class="parent-icon"><i class='bx bx-home-circle'></i>
</div>
<div class="menu-title">Buy a new smart card</div>
</a>
</li>

<!--end navigation-->
</div>
<!--end sidebar wrapper -->
<!--start header -->
<header>
<div class="topbar d-flex align-items-center">
<nav class="navbar navbar-expand">
<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
</div>
<div class="top-menu ms-auto">
<ul class="navbar-nav align-items-center">

<li class="nav-item dropdown dropdown-large">

<div class="dropdown-menu dropdown-menu-end">

<div class="header-notifications-list">


</div>

</div>
</li>
<li class="nav-item dropdown dropdown-large">

<div class="dropdown-menu dropdown-menu-end">

<div class="header-message-list">


</div>
</div>
</li>
</ul>
</div>

<div class="user-box dropdown">
<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret has-arrow" href="javascript" role="button" data-bs-toggle="dropdown" aria-expanded="false">
{{--<img src="{{URL::asset('assets/images/logo-icon.png')}}" class="user-img" alt="user avatar">--}}
<div class="user-info ps-3">
<p class="user-name mb-0">Profilemeet</p>
<!--<p class="designattion mb-0">Web Designer</p>-->
</div>
</a>
<ul class="dropdown-menu dropdown-menu-end">
<!--<li><a class="dropdown-item" href="javascript"><i class="bx bx-user"></i><span>Profile</span></a>-->
<!--</li>-->
<!--<li><a class="dropdown-item" href="javascript"><i class="bx bx-cog"></i><span>Settings</span></a>-->
<!--</li>-->
<li><a class="dropdown-item" href="profile" ><i class="bx bx-log-out-circle"></i><span>View Profile</span></a>
<li><a class="dropdown-item" href="logout" ><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
</li>

</ul>
</div>
</nav>
</div>
</header>
<!--end header -->





@yield('contant')




<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<footer class="page-footer">
<p class="mb-0">Copyright &copy; <?php echo date('Y') ?> All right reserved.</p>
</footer>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
</div>
<div class="switcher-body">
<div class="d-flex align-items-center">
<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
</div>
<hr/>
<h6 class="mb-0">Theme Styles</h6>
<hr/>
<div class="d-flex align-items-center justify-content-between">
<div class="form-check">
<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
<label class="form-check-label" for="lightmode">Light</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
<label class="form-check-label" for="darkmode">Dark</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
<label class="form-check-label" for="semidark">Semi Dark</label>
</div>
</div>
<hr/>
<div class="form-check">
<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
</div>
<hr/>
<h6 class="mb-0">Header Colors</h6>
<hr/>
<div class="header-colors-indigators">
<div class="row row-cols-auto g-3">
<div class="col">
<div class="indigator headercolor1" id="headercolor1"></div>
</div>
<div class="col">
<div class="indigator headercolor2" id="headercolor2"></div>
</div>
<div class="col">
<div class="indigator headercolor3" id="headercolor3"></div>
</div>
<div class="col">
<div class="indigator headercolor4" id="headercolor4"></div>
</div>
<div class="col">
<div class="indigator headercolor5" id="headercolor5"></div>
</div>
<div class="col">
<div class="indigator headercolor6" id="headercolor6"></div>
</div>
<div class="col">
<div class="indigator headercolor7" id="headercolor7"></div>
</div>
<div class="col">
<div class="indigator headercolor8" id="headercolor8"></div>
</div>
</div>
</div>
<hr/>
<h6 class="mb-0">Sidebar Colors</h6>
<hr/>
<div class="header-colors-indigators">
<div class="row row-cols-auto g-3">
<div class="col">
<div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
</div>
<div class="col">
<div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
</div>
<div class="col">
<div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
</div>
<div class="col">
<div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
</div>
<div class="col">
<div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
</div>
<div class="col">
<div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
</div>
<div class="col">
<div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
</div>
<div class="col">
<div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
</div>
</div>
</div>
</div>
</div>




<!--end switcher-->
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<!--//<script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>-->

<script src="{{URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->

<script src="{{URL::asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{URL::asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{URL::asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<!--app JS-->
<script src="{{URL::asset('assets/js/app.js')}}"></script>


<script src="{{URL::asset('assets/fancybox/js/jquery.fancybox.min.js')}}"></script>


<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap-toggle.min.js')}}"></script>
<script type="text/javascript">
/* For CKeditor */

CKEDITOR.replace( 'editor');
</script>
<script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
	<script src="{{URL::asset('assets/plugins/datetimepicker/js/legacy.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datetimepicker/js/picker.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datetimepicker/js/picker.time.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datetimepicker/js/picker.date.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js')}}"></script>
<script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script type="text/javascript">
/* For CKeditor */

CKEDITOR.replace( 'editor');
</script>


<script>
$(document).ready(function() {
$('#example').DataTable();
} );
</script>
<script>
$(document).ready(function() {
var table = $('#example2').DataTable( {
lengthChange: false,
buttons: [ 'copy', 'excel', 'pdf', 'print']
} );

table.buttons().container()
.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
} );
</script>


<script>
function goBack() {
window.history.back();
}
</script>

<script>
$('.single-select').select2({
theme: 'bootstrap4',
width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
placeholder: $(this).data('placeholder'),
allowClear: Boolean($(this).data('allow-clear')),
});
$('.multiple-select').select2({
theme: 'bootstrap4',
width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
placeholder: $(this).data('placeholder'),
allowClear: Boolean($(this).data('allow-clear')),
});
</script>




@stack('footer_script')



</body>



</html>