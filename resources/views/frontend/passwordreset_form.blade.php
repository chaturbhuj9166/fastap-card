
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Fastap Password Reset</title>
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
    

<!-- BAnner section -->

<section class="sigin__page bg__white" style="padding: 10px 0 0;">
   <div class="container">
      <div class="signin__wrapper">
         <div class="row justify-content-between align-items-center">
			<div class="col-md-6 banner_last" >
			<div class="login_page_design">
            <h3 class="text-center" style="border-radius: 5px;">Reset Password Fastap</h3>
            <div class="iner_padding">
                <!--<h1 style="color:black;">Reset Password</h1>-->
                <div>
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong> {{ $message }} </strong>
                        </div>
                    @endif

					@if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <strong> {{ $message }} </strong>
                        </div>
                    @endif
                  <form method="post" action="{{url('/forgot_reset_password')}}">
						@csrf
						
						<input type="hidden" name="email" value="{{$email}}"/>
                     <div class="main">
                         <div id='mobileblock'>
                            <div class="input-group" style="margin-bottom: 10px;">
                              <label style="color:black;">Password</label> 
                                <input style="width:100%;margin-top: 10px;" type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password" required/>
                                @if($errors->has('pwd'))
                                    <span class="text-danger"> {{ $errors->first('pwd') }} </span>
                                @endif
                            </div>
                            
                            <div class="input-group" style="margin-bottom: 10px;">
                              <label style="color:black;">Confirm Password</label> 
                                <input style="width:100%;margin-top: 10px;" type="password" id="cpwd" name="cpwd" class="form-control" placeholder="Enter confirm password" required/>
                                @if($errors->has('cpwd'))
                                    <span class="text-danger"> {{ $errors->first('cpwd') }} </span>
                                @endif
                            </div>
                            
                             <button class='btn btn-success mt-2' type='submit'>Reset Password</button>
                            </div>
                     </div>
                  </form>
                   
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
				

	
	
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

<!--app JS-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{asset('frontend/js/custom.js')}}"></script>
<script src="{{URL::asset('assets/js/app.js')}}"></script>
	
	

	
	
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
</body>
</html>