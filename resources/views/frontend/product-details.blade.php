@extends('layouts.app')
@section('content')

<style>
#btnaddcart {
    margin-right: 0px !important;
    padding: 12px 6px !important;
    width: 140px !important;
}
 .never_share {
    box-shadow: 0 0 6px;
    padding: 4px 14px;
        border-radius: 8px;
}
 .protitle {
    font-weight: 600;
    color: #000 !important;
    width: 400px !importan;
} 


form.never_share h6 {
    font-size: 15px !important;
    font-weight: 600 !important;
    margin-bottom: 16px !important;
    margin-top: 15px !important;
}

form.never_share input {
    height: 37px !important;p
    border-radius: 8px !important;
    border-color: #eee !important;
}

.take_logo_background{
    width: 14px;
}
.chek_box_1{
        position: relative;
    bottom:0px;
    left: 7px;
}
#checkoutform{
       box-shadow: 0 0 18px #c7c2c2;
    padding: 4px 10px;
    border-radius: 7px; 
}
.details_page_sec {
    margin-top: 18px;
}

.cart_form_main_change input {
    border: none !important;
    box-shadow: 0 0 15px #d7d3d3;
    border-radius: 10px;
}

.details_page_sec .button.grey {
    border-radius: 10px;
}

.details_page_sec .button.grey:hover {
    color:#fff !important;
    background:#7b41e3 !important;
}

h6.please_reenter_your_password {
    margin-bottom: 10px;
}

h6.please_reenter_your_password {
    margin-bottom: 15px;
    font-size: 16px;
    font-weight: 600;

}
h4{
    font-size: 25px !important;
}

.slider_nav_detilas .slick-slide img {
    display: block;
    width: 100%;
    /*height: 260px !important;*/
}

.main_content_black {
    color:#000 !important;
}
.mfp-bottom-bar {
    display: none !important;
}
</style>
<!-- Banner Here -->
<section class="banner__section breadcumnd__banner bannerbg">
   <!--Mask-->
   <div class="banner__bgmask">
      <img src="{{url ('frontend/assets/img/elements/box-element.png')}}" alt="mask">
   </div>
   <!--Mask-->
   <!--Container-->
   <div class="container">
      <div class="breadcumnd__wrapper">
         <div class="row g-4  justify-content-between align-items-end">
            <!--col-->
            <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-8">
               <div class="breadcumnd__content">
                  <h1 class="title">
                    Single Product
                  </h1>
                  <ul class="breadcumnd__list">
                     <li>
                        <a href="{{url ('/')}}">
                           Home
                        </a>
                     </li>
                     <li>
                        <span class="icon">
                           <i class="material-symbols-outlined">
                              chevron_right
                           </i>
                        </span>
                     </li>
                     <li>
                        <a href="{{url ('/Product') }}">
                           Product
                        </a>
                     </li>
                     <li>
                        <span class="icon">
                           <i class="material-symbols-outlined">
                              chevron_right
                           </i>
                        </span>
                     </li>
                     <li class="sucess">
                        Single Product
                     </li>
                  </ul>
               </div>
            </div>
            <!--col-->
            <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-8">
               <div class="breadcumnd__thumb">
                  <img src="{{url ('frontend/assets/img/banner/breadcumnd.png')}}" alt="bread">
               </div>
            </div>
            <!--col-->
         </div>
         <!--ai text-->
         <div class="bread__ai">
            <img src="{{url ('frontend/assets/img/elements/t-element.png')}}" alt="img">
         </div>
         <!--ai text-->
      </div>
   </div>
   <!--Container-->
</section>
<!-- Banner End -->



          <!--style="background-image: url('{{ URL::asset('frontendnew/images/bg/ca38ac51-8e02-4507-9a67-38314a5446f1.jpg')}}'); background-position: center center; background-repeat: no-repeat; background-size: 100% 100%; !important"-->
        
 <!--======= Breadcrumb Left With BG Image =======-->
      <div class="overview-block-ptb iq-over-black-70 iq-breadcrumb3 text-left iq-font-white product_details_main_bannr"> <div class="container">
            <div class="row align-items-center">
               <!--<div class="col-lg-8">-->
               <!--   <div class="iq-mb-0">-->
                   
               <!--     <h2 class="iq-font-white iq-tw-6">Product-details</h2>-->
               <!--   </div>-->
                                         

               <!--</div>-->
               <!--<div class="col-lg-4">-->
               <!--   <nav aria-label="breadcrumb" class="text-right">-->
               <!--      <ol class="breadcrumb">-->
               <!--         <li class="breadcrumb-item"><a href="{{ url('/')}}"><i class="ion-android-home"></i>Home</a></li>-->
               <!--         <li class="breadcrumb-item active text-white" aria-current="page">Product-details</li>-->
               <!--      </ol>-->
               <!--   </nav>-->
               <!--</div>-->
            </div>
         </div>
      </div>
      <!--======= Breadcrumb Left With BG Image =======-->



      <!--=================================
         Main Content -->
      <div class="main-content main_content_black">
         <section class="overview-block-ptb" data-twttr-rendered="true" data-spy="scroll" data-target=".bs-docs-sidebar">
            <div class="container">
               <div class="row">
                  {{--<div class="col-lg-3 col-md-12 col-sm-12 iq-mtb-15">
                     <div class="shop-widget">
                        <div class="iq-post-sidebar">
                           <div class="shop-filter">
                             
           
                             
                                  <div id="accordionTwo">
                                 <div class="card">
                                    <div class="card-header" id="headingSix">
                                       <h5 class="mb-0">
                                          <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                             <h6 class="iq-tw-6 iq-font-dark text-uppercase">Popular Products</h6>
                                          </a>
                                       </h5>
                                    </div>
                                    <div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-parent="#accordion">
                                       <div class="list-inline iq-widget-menu">
                                          <ul class="iq-post">
                                                <?php 
                                             use App\Models\product;
                                            
                                             $products = product::where('status','1')->orderBy(DB::raw('RAND()'))->take(6)->get();
                                              ?>
                                              @foreach($products as $item)
                                             <li class="mt-2">
                                                <!--<div class="post-img" ><a href="{{ url('product-details') }}/{{$item->id}}"> <img src="{{url('/public/uploads/product_images/product_single_img'.'/'.$item->pro_img)}}" alt="#"> </a></div>-->
                                                
                                                <div class="post-img" ><a href="{{ url('product-details') }}/{{$item->id}}"> <img src="{{url('/public/uploads/product_images/product_single_img'.'/'.$item->pro_img)}}" alt="#"> </a></div>


                                                <div class="post-blog">
                                                   <a href="Product-details-new/{{$item->id}}">{{$item->pro_name}} </a>
                                                   <div class="shop-price">
                                                      <del>₹{{$item->pro_mrp}}</del>&nbsp;&nbsp;<strong>₹{{$item->pro_price}}</strong>
                                                   </div>
                                                </div>
                                             </li>
                                           
                                             @endforeach
                                          
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>--}}
                  <div class="col-lg-12 col-md-12 col-sm-12 iq-mtb-15">
                     <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 iq-mtb-15">
                        <div class="iq-slick">
        <div class="slider slider-for">
   
 
      </div>
      <div class="slider slider-nav slider_nav_detilas">
                <!--@foreach(json_decode($product->pro_multi_img, true) as $key => $media_gallery)-->
                <!--<div class="owl-carousel arrow-4 popup-gallery popup_main_galery" data-autoplay="true" data-loop="true" data-nav="true" data-dots="false" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="15">-->
                <!--         <div><a href="{{url('uploads/product_images/product_multi_img/'.$media_gallery)}}" class="popup-img"><img class="img-fluid" src="{{url('uploads/product_images/product_multi_img/'.$media_gallery)}}"></a></div> -->
                
                <!-- </div>-->
                <!--	@endforeach-->
                
                <a href="{{ url('product-details') }}/{{$product->id}}"> 
<img style="width: 100%;" src="{{url('/public/uploads/product_images/product_single_img'.'/'.$product->pro_img)}}" alt="#"> </a>
        
     
      </div>
    
    </div>
                        </div>
                <div class="col-lg-6 col-md-12 col-sm-12 iq-mtb-15">
    <div class="iq-shopdetail indc d-flex justify-content-between align-items-center">
        <h3 class="iq-tw-6 protitle">{{ $product->pro_name }}</h3>
        
        <!-- Add to Cart Button Positioned to the Right -->
        <form method="post" action="{{ url('shopingcart', $product->id) }}" enctype="multipart/form-data" id="checkoutform">
            @csrf
            <button class="cmn--btn" type="submit" id="btnaddcart" data-id="{{ $product->id }}" style="border:none"><span><i class="fa fa-shopping-cart"></i> Add To Cart</span></button>
        </form>
    </div>

    <div class="iq-rating">
        <ul class="list-inline float-left">
            <li class="list-inline-item"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
        </ul>
    </div>

    <div class="shop-price w-100 d-inline-block">
        <del>₹{{ $product->pro_mrp }}</del>&nbsp;&nbsp;
        <strong>₹{{ $product->pro_price }}</strong>
    </div>

    <div class="iq-pt-15"><b><h4>Product Detail:</h4></b></div>
    <p>{!! $product->pro_description !!}</p>
    </div>

                     </div>
                    
                  </div>
               </div>
            </div>
      </div>
      
      
      
      
      
      
    

                </div>
                
                <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Login Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST" action="/loginuser/login_store">
                    @csrf
                     <input type="hidden" name="product_id" id="product_id" value="">
                     <div class="row g-4">
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="email">Enter Your Email ID</label>
                              <input type="email" name="email" id="email" placeholder="Enter Your Email..." required value="{{ old('email') }}" style="color:black">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="password">Enter Your Password</label>
                              <input type="password" name="password" id="password" placeholder="Enter Your Password..." required value="{{old('password')}}" style="color:black">
                           </div>
                        </div>
                     </div>
                     <!--<div class="forget__right">-->
                     <!--   <a href="javascript:void(0)" class="forget">-->
                     <!--      Forget password-->
                     <!--   </a>-->
                     <!--</div>-->
                     <p class="accout" style="color:black">
                        Do you have an account? <a href="javascript:void(0)" style="color:blue" data-dismiss="modal" aria-label="Close" id="signup">Signup</a><br/>
                        <a href="{{url ('/forgot_password')}}" style="color:blue">Forgot Password</a>
                     </p>
                     <!--<a href="{{url ('/signup')}}" class="cmn--btn">-->
                     <!--   <span>-->
                     <!--      Signin-->
                     <!--   </span>-->
                     <!--</a>-->
                     
                     <button type="submit" name="submit" class="cmn--btn" style="border:none"> <span>Login</span> </button>
                  </form>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>








<!-- Modal -->
<div class="modal fade" id="RegisterexampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Signup Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST" action="/registeruser/register_store">
                    @csrf
                     <div class="row g-4">
                         <!--   <div class="col-lg-6">-->
                         <!--      <div class="form__grp">-->
                         <!--         <label for="firstname">First Name</label>-->
                         <!--         <input type="text" id="firstname" placeholder="Enter First Name...">-->
                         <!--      </div>-->
                         <!--   </div>-->
                         <!--   <div class="col-lg-6">-->
                         <!--      <div class="form__grp">-->
                         <!--         <label for="lastname">Last Name</label>-->
                         <!--         <input type="text" id="lastname" placeholder="Enter Last Name...">-->
                         <!--      </div>-->
                         <!--   </div>-->
                        <div class="col-lg-6">
                           <div class="form__grp">
                              <label for="name">Enter Your Name</label>
                              <input type="text" id="name" name="name" placeholder="Enter Your Name..." value="{{old('name')}}" style="color:black">
                                @if ($errors->has('name'))
                                    <span class="text-danger"> {{ $errors->first('name') }} </span>
                                @endif
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form__grp">
                              <label for="mobile">Enter Your Mobile</label>
                              <input type="text" id="mobile" name="mobile" placeholder="Enter Your Mobile..." value="{{old('mobile')}}" style="color:black">
                                @if ($errors->has('mobile'))
                                    <span class="text-danger"> {{ $errors->first('mobile') }} </span>
                                @endif
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="emailid">Enter Your Email ID</label>
                              <input type="email" id="email" name="email" placeholder="Enter Your Email..." value="{{ old('email') }}" style="color:black">
                                @if ($errors->has('email'))
                                    <span class="text-danger"> {{ $errors->first('email') }} </span>
                                @endif
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form__grp">
                              <label for="passsword">Enter Your Password</label>
                              <input type="password" id="passsword" name="password" placeholder="Enter Your Password..." value="{{old('password')}}" style="color:black">
                                @if ($errors->has('password'))
                                    <span class="text-danger"> {{ $errors->first('password') }} </span>
                                @endif
                           </div>
                        </div>
                     </div>
                     <p class="accout">
                        Do you have an account? <a href="/Login">Signin</a>
                     </p>
                     <!--<a href="signin.html" class="cmn--btn">-->
                     <!--   <span>-->
                     <!--      Signup-->
                     <!--   </span>-->
                     <!--</a>-->
                     <button style="border:none;" type="submit" class="cmn--btn"> <span> Sign up </span> </button>
                      <span class="text-danger"> {{ session('error') }} </span>
                  </form>
      </div>
      
    </div>
  </div>
</div>
                  
      </section>
     
      </div>




<script>
    $(function() {
 
  $('.theInput').attr('disabled', 'disabled')
 
  $('#vehicle3').change(function(e) {
    var selected_type = $(this).val();
    
    if (selected_type == 'A') {
      $('#myfile').removeAttr('disabled'); 
     
    }
    
  })
})
</script>




<script>
$(document).ready(function() {
$("#vehicle3").click(function() {
$("#myfile").attr('disabled', !$("#myfile").attr('disabled'));
});
});
</script>
     
     
     
     
     <script>
    // International telephone format
// $("#phone").intlTelInput();
// get the country data from the plugin
var countryData = window.intlTelInputGlobals.getCountryData(),
  input = document.querySelector("#phone"),
  addressDropdown = document.querySelector("#address-country");

// init plugin
var iti = window.intlTelInput(input, {
  hiddenInput: "full_phone",
  utilsScript: "https://intl-tel-input.com/node_modules/intl-tel-input/build/js/utils.js?1549804213570" // just for formatting/placeholders etc
});

// populate the country dropdown
for (var i = 0; i < countryData.length; i++) {
  var country = countryData[i];
  var optionNode = document.createElement("option");
  optionNode.value = country.iso2;
  var textNode = document.createTextNode(country.name);
  optionNode.appendChild(textNode);
  addressDropdown.appendChild(optionNode);
}
// set it's initial value
addressDropdown.value = iti.getSelectedCountryData().iso2;

// listen to the telephone input for changes
input.addEventListener('countrychange', function(e) {
  addressDropdown.value = iti.getSelectedCountryData().iso2;
});

// listen to the address dropdown for changes
addressDropdown.addEventListener('change', function() {
  iti.setCountry(this.value);
});
</script>


<script>
    $(function() {
  //disable all input at start
  $('.theInput').attr('disabled', 'disabled')
  
  //monitor type changes
  $('#vehicle3').change(function(e) {
    var selected_type = $(this).val(); //get the form value
    
    if (selected_type == 'A') { //if A is selected
      $('#myfile').removeAttr('disabled'); //enable Input A
     
    }
    
  })
})
</script>




<script>
$(document).ready(function() {
$("#vehicle3").click(function() {
$("#myfile").attr('disabled', !$("#myfile").attr('disabled'));
});
});
</script>

<script>
$(document).ready(function() {
$("#vehicle3").click(function() {
$("#myfile").attr('disabled', !$("#myfile").attr('disabled'));
});
});
</script>

<script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
        
 <script>
        // Replace with your Firebase config
        const firebaseConfig = {
            
        //   apiKey: "AIzaSyDq6uMlxGkdkMKLtokoQynzRERGcfoyJE0",
        //   authDomain: "test-d7faf.firebaseapp.com",
        //   projectId: "test-d7faf",
        //   storageBucket: "test-d7faf.appspot.com",
        //   messagingSenderId: "27592741772",
        //   appId: "1:27592741772:web:4a97598a0992753f26fca9",
        //   measurementId: "G-ZL7KQHY5N9"
        
            apiKey: "AIzaSyD4ip7LpuyayECSTy8AQySH89wDPm2Xw_Q",
            authDomain: "fastap-b7f08.firebaseapp.com",
            projectId: "fastap-b7f08",
            storageBucket: "fastap-b7f08.appspot.com",
            messagingSenderId: "753032849386",
            appId: "1:753032849386:web:511a80ff40de7cd76af493",
            measurementId: "G-HN7GTZW68N"
            
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        let coderesult;

        function sendOTP() {
            var number = '+91' + $("#number").val();
            var mob = $("#number").val();

            // Create a reCAPTCHA verifier instance
            var recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');

            // Render the reCAPTCHA widget on the specified HTML element
            recaptchaVerifier.render();

            firebase.auth().signInWithPhoneNumber(number, recaptchaVerifier).then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                console.log(coderesult);
                $("#successAuth").text("Message sent");
                $('#recaptcha-container').hide();
                $("#successAuth").show();
                $("#successOtpAuth").hide();
                $("#votp").show();
                $('#formmobile').val(mob);
                $('#mobilenumber').val(mob);
            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }

        function verify() {
            $("#error").hide();
            var code = $("#verification").val();
            coderesult.confirm(code).then(function (result) {
                var user = result.user;
                console.log(user);
                $("#successOtpAuth").text("Auth is successful");
                $("#successOtpAuth").show();
                $('#submitbtn').removeAttr('disabled');
                $('#votp').hide();
                $('#btnaddcart').show();
            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
        
        
        
        $("#btnaddcart").on('click',function(){
           var auth = "{{Session::get('FRONT_USER_ID')}}"
         
           if(auth == ''){
              $('#product_id').val($(this).data('id'));
              $("#exampleModalCenter").modal('show')
              return false;
          }
         
        })
        
        $("#signup").on('click',function(){
            $("#exampleModalCenter").modal('hide')
             $("#RegisterexampleModalCenter").modal('show')
        })
        
         $(".close").on('click',function(){
            $("#exampleModalCenter").modal('hide')
             $("#RegisterexampleModalCenter").modal('hide')
        })
        
        
    </script>
        
        
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




@endsection		