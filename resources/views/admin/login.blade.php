<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from pixner.net/intellicon/intellicon/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Apr 2023 12:15:03 GMT -->
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fastap Admin Login</title>
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
                        Welcome Back!
                     </h3>
                     <p>
                        Sign in to your account and join us
                     </p>
                  </div>
                  
                     @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                     @include('layouts.flash-message')
                     
                    <form form action="{{ route('admin.check') }}" method="POST">
						@csrf
                     
                     <div class="row g-4">
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="emailid">Enter Your Email ID</label>
                              <input type="email" name="email" id="emailid" placeholder="Enter Your Email..." required>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="paswords">Enter Your Password</label>
                              <input type="password" name="password" id="paswords" placeholder="Enter Your Password..." required>
                           </div>
                        </div>
                     </div>
                     <!--<div class="forget__right">-->
                     <!--   <a href="javascript:void(0)" class="forget">-->
                     <!--      Forget password-->
                     <!--   </a>-->
                     <!--</div>-->
                     <!--<p class="accout">-->
                     <!--   Do you have an account? <a href="{{url ('/signin')}}">Signup</a>-->
                     <!--</p>-->
                     <!--<a href="{{url ('/signup')}}" class="cmn--btn">-->
                     <!--   <span>-->
                     <!--      Signin-->
                     <!--   </span>-->
                     <!--</a>-->
                     
                     <button type="submit" name="submit" class="cmn--btn mt-5" style="border:none"> <span>Login</span> </button>
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

