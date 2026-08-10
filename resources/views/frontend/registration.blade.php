<!doctype html>
<html lang="en">


<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--favicon-->
<link rel="icon" href="{{URL::asset('assets/images/favicon-32x32.png')}}" type="image/png" />
<!--plugins-->
<link href="{{URL::asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
<!-- loader-->
<link href="{{URL::asset('assets/css/pace.min.css')}}" rel="stylesheet" />
<script src="{{URL::asset('assets/js/pace.min.js')}}"></script>
<!-- Bootstrap CSS -->
<link href="{{URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
<link href="{{URL::asset('assets/css/app.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<title>Profilemeet</title>
<style>
    
    .field_error{
    color: red;
    margin-bottom: -0.5rem !important;
    }
    
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

</style>

</head>

<body class="bg-login">
<!--wrapper-->

<div class="wrapper">
<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
<div class="container">
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
<div class="col mx-auto">
<!--<div class="my-4 text-center">-->
<!--	<img src="{{URL::asset('assets/images/logo-img.png')}}" width="180" alt="" />-->
<!--</div>-->
<div class="card">
<div class="card-body">
<div class="p-4 rounded">
<div class="text-center">
<h3 class="">Sign Up</h3>
<p>Already have an account? <a href="{{route('login')}}">Sign in here</a>
</p>
</div>
<!--<div class="d-grid">-->
<!--<a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">-->
<!--<img class="me-2" src="{{URL::asset('assets/images/icons/search.svg')}}" width="16" alt="Image Description">-->
<!--<span>Sign Up with Google</span>-->
<!--</span>-->
<!--</a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign Up with Facebook</a>-->
<!--</div>-->
<h4 id="thank_you_msg" class="field_error text-center"></h4>

<div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
<hr/>
</div>
<div class="form-body">
<form class="row g-3" id="frmRegistration" method="post">
    @csrf
 @include('layouts.flash-message')
<div class="col-sm-12">
<!--<label for="inputFirstName" class="form-label">First Full Name</label>-->
<input type="text" name="name" class="form-control" id="inputFirstName" placeholder="Enter Full Name">
<div id="name_error" class="field_error"></div>

</div>

<div class="col-12">
<!--<label for="inputEmailAddress" class="form-label">Email Address</label>-->
<input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="example@user.com">
<div id="email_error" class="field_error"></div>

</div>
<div class="col-12">
<!--<label for="inputChoosePassword" class="form-label">Password</label>-->
<div class="input-group" id="show_hide_password">

<input type="password" name="password" class="form-control border-end-0" id="password" value="" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>

</div>
<div id="password_error" class="field_error"></div> 

</div>

<div class="col-12">
    <!--<label for="inputChoosePassword" class="form-label">Confirm Password</label>-->
<div class="input-group" id="show_hide_cpassword">

<input type="password" onBlur="checkpass()" name="cpassword" class="form-control border-end-0" id="confirm_password" value="" placeholder="Enter confirm Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
 </div>
 <span id='message'></span>
                     <div id="cpassword_error" class="field_error"></div> 


</div>

<div class="col-12">
<!--<label for="" class="form-label">Phone Number</label>-->
<div class="input-group" >
<input type="number" name="mobile" class="form-control"  maxlength="10"  placeholder="Enter Phone Number"> </a>

</div>

                    <div id="mobile_error" class="field_error"></div>

</div>

<!--<div class="col-12">-->
<!--<div class="form-check form-switch">-->
<!--<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">-->
<!--<label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>-->
<!--</div>-->
<!--</div>-->
<div class="col-12">
<div class="d-grid">
<button type="submit" class="btn btn-primary" id="btnRegistration"><i class='bx bx-user'></i>Sign up</button>
</div>
</div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>
<!--end row-->
</div>
</div>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{asset('frontend/js/custom.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<!--Password show & hide js -->
<script>
$(document).ready(function () {
$("#show_hide_password a").on('click', function (event) {
event.preventDefault();
if ($('#show_hide_password input').attr("type") == "text") {
$('#show_hide_password input').attr('type', 'password');
$('#show_hide_password i').addClass("bx-hide");
$('#show_hide_password i').removeClass("bx-show");
} else if ($('#show_hide_password input').attr("type") == "password") {
$('#show_hide_password input').attr('type', 'text');
$('#show_hide_password i').removeClass("bx-hide");
$('#show_hide_password i').addClass("bx-show");
}
});
});


$(document).ready(function () {
$("#show_hide_cpassword a").on('click', function (event) {
event.preventDefault();
if ($('#show_hide_cpassword input').attr("type") == "text") {
$('#show_hide_cpassword input').attr('type', 'password');
$('#show_hide_cpassword i').addClass("bx-hide");
$('#show_hide_cpassword i').removeClass("bx-show");
} else if ($('#show_hide_cpassword input').attr("type") == "password") {
$('#show_hide_cpassword input').attr('type', 'text');
$('#show_hide_cpassword i').removeClass("bx-hide");
$('#show_hide_cpassword i').addClass("bx-show");
}
});
});



function checkpass() {		
	if ($('#password').val() != $('#confirm_password').val()){
		//alert('Password Length 6 Chars minimum');
		$("#message").html('Password Not Matching').css('color', 'red');
		$('#confirm_password').val("");
	} else if($('#password').val() === $('#confirm_password').val()){
		$("#message").html('');
	}
}

</script>
<!--app JS-->
<script src="{{URL::asset('assets/js/app.js')}}"></script>
   <script>
      input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}



$('input[type=number]').on('mousewheel', function(e) {
  $(e.target).blur();
});
  </script> 
</body>


</html>