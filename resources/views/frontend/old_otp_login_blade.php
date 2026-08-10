
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Fastap User Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="{{URL::asset('frontendnew/images/fevicon.png')}}" />
  <link href="{{URL::asset('frontendnew/assets_landing/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('frontendnew/assets_landing/css/style.css')}}" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
  <script src="{{URL::asset('frontendnew/assets_landing/js/bootstrap.bundle.min.js')}}"></script>
  
  
  <!-- VM Card theme style -->
    <link rel="stylesheet" href="{{url ('frontend/assets/css/main.css')}}">
    <!-- VM Card theme style -->
    
  <style type="text/css">
    section.banner_main_section{
    /*background-image: url('frontendnew/assets_landing/img/banner_bg.jpg');*/
        background-image: url('frontend/assets/img/signin/signin.png');
    background-size: 100% 100%;
}

.iner_padding h1 {
    font-size: 23px;
}
.arroundpromeet {
    padding-top: 42px;
}
  </style>
</head>
<body>
    
	<!--wrapper-->
	{{--<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				 <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<!--<div class="mb-4 text-center">-->
						<!--	<img src="{{URL::asset('assets/images/logo-img.png')}}" width="180" alt="" />-->
						<!--</div>-->
						<div class="card shadow-none">
							<div class="card-body">
								<div class="p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign in</h3>
										<!--<p>Don't have an account yet? <a href="{{route('registration')}}">Sign up here</a>-->
										<!--</p>-->
									</div>
									<div class="d-grid">
										<!--<a class="btn my-4 shadow-sm btn-white" href="{{route('google-auth')}}"> <span class="d-flex justify-content-center align-items-center">-->
          <!--                <img class="me-2" src="{{URL::asset('assets/images/icons/search.svg')}}" width="16" alt="Image Description">-->
          <!--                <span>Sign in with Google</span>-->
										<!--	</span>-->
										<!--</a>-->
										<!--<a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign in with Facebook</a>-->
									</div>
									<!--<div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH Mobile</span>-->
									<div id="thank_you_msg"></div>
										<!--<hr/>-->
									</div>
									<div class="form-body">
									    <!--Email Login-->
										<!--<form class="row g-3" id="frmLogin" method="post">-->
										<!--    @csrf-->
										<!--	<div class="col-12">-->
												<!--<label for="inputEmailAddress" class="form-label">Email Address</label>-->
										<!--		<input type="email" class="form-control" name="str_login_email" id="inputEmailAddress" placeholder="Email Address">-->
										<!--	</div>-->
										<!--	<div class="col-12">-->
												<!--<label for="inputChoosePassword" class="form-label">Enter Password</label>-->
										<!--		<div class="input-group" id="show_hide_password">-->
										<!--			<input type="password" name="str_login_password" class="form-control border-end-0" id="inputChoosePassword" value="" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>-->
										<!--		</div>-->
										<!--	</div>-->
										<!--	<div class="col-md-6">-->
										<!--		<div class="form-check form-switch">-->
										<!--			<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>-->
										<!--			<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>-->
										<!--		</div>-->
										<!--	</div>-->
										<!--	<div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>-->
										<!--	</div>-->
										<!--	<div class="col-12">-->
										<!--		<div class="d-grid">-->
										<!--			<button type="submit" id="btnLogin" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>-->
										<!--		</div>-->
										<!--			<div class="d-grid mt-2">-->
										<!--			<button type="button" id="btnopenmob" class="btn btn-info text-light"><i class="bx bxs-lock-open"></i>Login With OTP</button>-->
										<!--		</div>-->
										<!--		            <div style="    margin-top: 7px; color:red;" id="login_msg"></div>-->

										<!--	</div>-->
										<!--</form>-->
										<div style="margin-top: 7px; color:red;" id="login_msg"></div>
											<form class="row g-3" id="frmLoginMob" method="post">
						@csrf
                        <div class='input-group' id='mobileblock'>
						    <input type="number" id="number" name="phone" class="form-control" placeholder="Enter Your Mobile" value="{{old('phone')}}">
						     <div class="input-group-prepend">
						    <button class='btn btn-primary' type='button' onclick='sendOTP()'>Send Otp</button>
						    </div>
						 </div>
					</form>	 
                            
         <form >
                         <div class='input-group' style='display:none;' id='votp'>
                        <input type="text" id="verification" class="form-control" placeholder="Verification code">
                        <div class="input-group-prepend">
                        <button type="button" class="btn btn-success"  onclick="verify()">Verify code</button>
                        </div>
                        
                        </div>
                    </form>
                                    
                                    <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
                                     <div class="alert alert-danger" id="error" style="display: none;"></div>
                                    <div class="alert alert-success" id="successAuth" style="display: none;"></div>
                                    <div id="recaptcha-container" class="mt-2" ></div>
                                    	<div class="d-grid">
                                     <button type="button" class="btn btn-primary" onclick='loginmob()' id='btnmoblogin' style='display:none'>Login</button>
                                     </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					</div> 
		</div>
	</div> --}}
				
				
				


<!-- BAnner section -->

<section class="sigin__page bg__white">
   <div class="container">
      <div class="signin__wrapper">
         <div class="row justify-content-between align-items-center">

			<!--<div class="col-md-6 text-white arroundpromeet">-->
   <!--      <h1>There’s a smarter<br> way to Profilemeet around</h1>   -->
   <!--      <p>Sign up with your phone number and get exclusive access to<br> discounts and savings on Profilemeet.</p>-->
   <!--   </div>-->
			<div class="col-md-6 banner_last" >
			<div class="login_page_design">
            <h3 class="text-center">Sign up Fastap</h3>
            <div class="iner_padding">
                <h1 style="color:black;">Login / Signup</h1>
                <div>
                  <form id="frmLoginMob" method="post">
						@csrf
                      
                     <div class="main">
                         <div id='mobileblock'>
                            <div class="input-group">
                              <label style="color:black;">Please enter your phone number to continue</label>
                                <input type="tel" id="txtPhone" name="phone" class="txtbox form-control" />
                            </div>
                            <div id="recaptcha-container" class='mt-2' name="recaptcha-container"></div>
                             <button class='btn btn-primary mt-2' type='button' onclick='sendOTP()'>Send Otp</button>
                         
                            <button id="btnSubmit" class="btn btn-primary mt-2" type="button" value="SUBMIT"  style='display:none'>Verify Now</button>
                            </div>
                     </div>
                  </form>
                   <form >
                         <div class='input-group' style='display:none;' id='votp'>
                        <input type="text" id="verification" class="form-control" placeholder="Verification code">
                        <div class="input-group-prepend">
                        <button type="button" class="btn btn-success" onclick="verify()">Verify code</button>
                        </div>
                        
                        </div>
                    </form>
                      <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
                        <div class="alert alert-danger mt-2" id="error" style="display: none;"></div>
                      <div class="alert alert-success mt-2" id="successAuth" style="display: none;"></div>
       
                    <p class="preferotp">Prefer to Proceed with OTP instead?<a href="javascript:;" class="otpclick_here">Click here</a></p>
                </div>
          </div>
        </div>
			</div>
			
			<div class="col-lg-5">
               <div class="signin__thumb">
                  <img src="{{url ('frontend/assets/img/signin/signin.png')}}" alt="signin">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
				
		
	
	
	
	<!--Login with Mobile no-->
	
{{--	
	<div class="modal fade" id="mobilelogin" tabindex="-1" aria-labelledby="mobileloginLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mobileloginLabel">Login Using Mobile No</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                	<form class="row g-3" id="frmLoginMob" method="post">
						@csrf
                        <div class='input-group' >
						    <input type="number" id="number" name="phone" class="form-control" placeholder="Enter Mobile no" value="{{old('phone')}}">
						    
						           <div id="recaptcha-container" class="mt-2" ></div>
						    <button class='btn btn-primary' type='button' onclick='sendOTP()'>Send Otp</button>
						    </div>
						 </div>
					</form>	 
                            
         <form >
                         <div class='input-group' style='display:none;' id='votp'>
                        <input type="text" id="verification" class="form-control" placeholder="Verification code">
                        <div class="input-group-prepend">
                        <button type="button" class="btn btn-success" onclick="verify()">Verify code</button>
                        </div>
                        
                        </div>
                    </form>
                                    
                                    <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
                                     <div class="alert alert-danger" id="error" style="display: none;"></div>
                                    <div class="alert alert-success" id="successAuth" style="display: none;"></div>
                                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick='loginmob()' id='btnmoblogin' style='display:none'>Login</button>
      </div>
    </div>
  </div>
</div>
	
--}}
	
	
	
	
	
	
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<!--Password show & hide js -->
	<script>
	    
	    jQuery('#frmLogin').submit(function(e){
  jQuery('#login_msg').html("");
  e.preventDefault();
  jQuery.ajax({
    url:'login_process',
    data:jQuery('#frmLogin').serialize(),
    type:'post',
    success:function(result){
      if(result.status=="error"){
        jQuery('#login_msg').html(result.msg);
      }
      
      if(result.status=="success"){
       window.location.href= '{{URL::previous()}}';
        //jQuery('#frmLogin')[0].reset();
        //jQuery('#thank_you_msg').html(result.msg);
      }
    }
  });
});
	    
	</script>
	
	
	
	
	
	
	
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
	</script>
	<!--app JS-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{asset('frontend/js/custom.js')}}"></script>
	<script src="{{URL::asset('assets/js/app.js')}}"></script>
	
	
	
		<script>
	    $(document).ready(function(){
	        $('#mobilelogin').modal('show');
	    });
	</script>
	
	
	
	
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
        <script>
             const firebaseConfig = {
                    //   apiKey: "AIzaSyAszGtL8TfOzfzFj2OKXa9tDK_iQ8Jln9A",
                    //     authDomain: "profile-meet.firebaseapp.com",
                    //     projectId: "profile-meet",
                    //     storageBucket: "profile-meet.appspot.com",
                    //     messagingSenderId: "1092671098086",
                    //     appId: "1:1092671098086:web:6a9206fd4ad099af51ff27",
                    //     measurementId: "G-7YY6G2CMZ6"
                        
                    // Live site detail (fastap.in) 
                        apiKey: "AIzaSyD4ip7LpuyayECSTy8AQySH89wDPm2Xw_Q",
                        authDomain: "fastap-b7f08.firebaseapp.com",
                        projectId: "fastap-b7f08",
                        storageBucket: "fastap-b7f08.appspot.com",
                        messagingSenderId: "753032849386",
                        appId: "1:753032849386:web:511a80ff40de7cd76af493",
                        measurementId: "G-HN7GTZW68N"
                    //
                            };
                    firebase.initializeApp(firebaseConfig);
        </script>
        
        
        <script>
            function loginmob(){
                  jQuery('#login_msg').html("");
                      jQuery.ajax({
                    url:'{{route("login.login_process")}}',
                    data:$('#frmLoginMob').serialize(),
                    type:'post',
                     success:function(result){
                    if(result.status=="error"){
                    jQuery('#login_msg').html(result.msg);
      }
      
      if(result.status=="success"){
       window.location.href= '{{url("/leads")}}';
        //jQuery('#frmLogin')[0].reset();
        //jQuery('#thank_you_msg').html(result.msg);
      }
    }
  });
            }
        </script>
        
        
        
        
        
         <script type="text/javascript">
            window.onload = function () {
                render();
            };
            
            function render() {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
                recaptchaVerifier.render();
            }
            
              function sendOTP() {
                   var code = $("#txtPhone").intlTelInput("getSelectedCountryData").dialCode;
                    
                var number = '+'+code+$('#txtPhone').val();
                var mob=$('#txtPhone').val();
              
                firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    console.log(coderesult);
                    $("#successAuth").text("Message sent");
                    $('#mobileblock').hide();
                    $("#successAuth").show();
                    $('#recaptcha-container').hide();
                    $("#votp").show();
                    $('#formmobile').val(mob);
                    $('#mobilenumber').val(mob);
                }).catch(function (error) {
                    $("#error").text(error.message);
                    $("#error").show();
                });
            }
            
            function verify() {
                $('#error').hide();
                 $("#successOtpAuth").text("");
                $("#successOtpAuth").hide();
                var code = $("#verification").val();
                coderesult.confirm(code).then(function (result) {
                    var user = result.user;
                    console.log(user);
                    // $("#successOtpAuth").text("Auth is successful");
                    // $("#successOtpAuth").show();
                    $('#submitbtn').removeAttr('disabled');
                    // $('#btnmoblogin').show();
                   $('#votp').hide();
                   loginmob();
                }).catch(function (error) {
                   
                    $("#error").text(error.message);
                    $("#error").show();
                });
            }
            
        $(document).on('click','#btnopenmob',function(){
              $('#mobilelogin').modal('show');
        });
    
        </script>
        

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
 <script>
$(document).ready(function(){
  $(".click_here").click(function(){
    $(".password_hide").show();
  });
});

$(document).ready(function(){
  $(".click_here").click(function(){
    $(".prefersign").hide();
  });
});

$(document).ready(function(){
  $(".click_here").click(function(){
    $(".preferotp").show();
  });
});

$(document).ready(function(){
  $(".otpclick_here").click(function(){
    $(".password_hide").hide();
  });
});

$(document).ready(function(){
  $(".otpclick_here").click(function(){
    $(".preferotp").hide();
  });
});

$(document).ready(function(){
  $(".otpclick_here").click(function(){
    $(".prefersign").show();
  });
});

</script>
 <script type="text/javascript">
     $(function () {
         var code = "+91"; // Assigning value from model.
         $('#txtPhone').val(code);
         $('#txtPhone').intlTelInput({
             autoHideDialCode: true,
             autoPlaceholder: "ON",
             dropdownContainer: document.body,
             formatOnDisplay: true,
             hiddenInput: "full_number",
             initialCountry: "auto",
             nationalMode: true,
             placeholderNumberType: "MOBILE",
             preferredCountries: ['US'],
             separateDialCode: true
         });
         $('#btnSubmit').on('click', function () {
             var code = $("#txtPhone").intlTelInput("getSelectedCountryData").dialCode;
             var phoneNumber = $('#txtPhone').val();
             var name = $("#txtPhone").intlTelInput("getSelectedCountryData").name;
             alert('Country Code : ' + code + '\nPhone Number : ' + phoneNumber + '\nCountry Name : ' + name);
         });
     });
 </script>
</body>


</html>