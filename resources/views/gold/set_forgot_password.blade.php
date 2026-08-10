<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from pixner.net/intellicon/intellicon/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Apr 2023 12:15:03 GMT -->
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fastap Set Forgot Password</title>
   <!--Favicon img-->
   <link rel="shortcut icon" href="{{url ('frontend/assets/img/logo/favicon.png')}}">
   <!--main css-->
   <link rel="stylesheet" href="{{url ('frontend/assets/css/main.css')}}">

   <!-- font awsome icon -->

   {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}

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
                     <h3>
                       Set New Password Fastap!
                     </h3>
                     <p>
                        Please enter your new password to continue
                     </p>
                  </div>
                  
                     @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                     @include('layouts.flash-message')
                     
                   <!--<form method="POST" action="/loginuser/login_store">-->
                   <form method="post" action="update_forget_password" enctype="multipart/form-data">
                    @csrf
                     
                     <div class="row g-4">
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="password">New Password</label>
                              <input type="password" name="new_password" id="new_password" placeholder="New Password..." required value="{{ old('new_password') }}">
                              	<p style="color:red;">@error('new_password'){{$message}}@enderror</p>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="password">Confirm Password</label>
                              <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password..." required value="{{old('confirm_pass')}}">
                              <p style="color:red;">@error('confirm_pass'){{$message}}@enderror</p>

                           </div>
                        </div>
                     </div>
                     <div class="forget__right">
                        <!--<a href="javascript:void(0)" class="forget">-->
                        <!--   Forget password-->
                        <!--</a>-->
                     </div>
                     
                     <button type="submit" name="submit" class="cmn--btn" style="border:none"> <span>Set Password</span> </button>
                  </form>
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
<!-- sign in End -->

<body>
    
</body>
</html>

