<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fastap User Signup</title>
   <link rel="shortcut icon" href="{{url('frontend/assets/img/logo/favicon.png')}}">
   <link rel="stylesheet" href="{{url('frontend/assets/css/main.css')}}">
   
   <!-- intl-tel-input CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.13/build/css/intlTelInput.min.css" />
   
   <style>
      .intl-tel-input {
         width: 100%;
      }
      #mobile-number {
         padding-left: 70px !important;
      }
      .iti__flag-container{
        width: 75px;
        color: #000;
      }
      .iti__country-name{
        color: #000 !important;
      }
   </style>
</head>
<body>

<!-- sign in Here -->
<section class="sigin__page bg__white" style="padding: 0px 0 0;">
   <div class="container">
      <div class="signin__wrapper">
         <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
               <div class="signin__content__left">
                  <div class="signin__head">
                     <h3>Register New User!</h3>
                     <p>Please enter your details to join us</p>
                  </div>
                  <form method="POST" action="/registeruser/register_store">
                     @csrf
                     <input type="hidden" id="country_code" name="country_code" value="+91">
                     <div class="row g-4">
                        <div class="col-lg-6">
                           <div class="form__grp">
                              <label for="name">Enter Your Name</label>
                              <input type="text" id="name" name="name" placeholder="Enter Your Name..." value="{{old('name')}}">
                              @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                              @endif
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form__grp">
                              <label for="mobile">Enter Your Mobile</label>
                              <input type="tel" id="mobile-number" name="mobile" placeholder="Enter Your Mobile..." value="{{old('mobile')}}">
                              @if ($errors->has('mobile'))
                              <span class="text-danger">{{ $errors->first('mobile') }}</span>
                              @endif
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="email">Enter Your Email ID</label>
                              <input type="email" id="email" name="email" placeholder="Enter Your Email..." value="{{ old('email') }}">
                              @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                              @endif
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="password">Enter Your Password</label>
                              <input type="password" id="password" name="password" placeholder="Enter Your Password..." value="{{old('password')}}">
                              @if ($errors->has('password'))
                              <span class="text-danger">{{ $errors->first('password') }}</span>
                              @endif
                           </div>
                        </div>
                     </div>
                     <p class="accout">Do you have an account? <a href="/Login">Signin</a></p>
                     <button style="border:none;" type="submit" class="cmn--btn"><span>Sign up</span></button>
                     <span class="text-danger">{{ session('error') }}</span>
                  </form>
               </div>
            </div>
            <div class="col-lg-5">
               <div class="signin__thumb">
                  <img src="{{url('frontend/assets/img/signin/signin.png')}}" alt="signin">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.13/build/js/intlTelInput-jquery.min.js"></script>
<script>
   // Initialize intlTelInput
   const input = $("#mobile-number");
   const iti = input.intlTelInput({
      initialCountry: "in",
      separateDialCode: true,
    //   utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.13/build/js/utils.js"
   });

   // Update hidden input with dial code on country change
   input.on("countrychange", function() {
      const code = iti.intlTelInput("getSelectedCountryData").dialCode;
      $("#country_code").val("+" + code);
   });
</script>
</body>
</html>
