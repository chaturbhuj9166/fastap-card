@extends('layouts.app')
@section('content')

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
                     Corporate
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
                        <a href="{{url ('/Corporate')}}">
                           Corporate
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
                        Details
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


<!-- Blog Details End -->
<!--<section class="blog__details__section pt-80 pb-80">-->

<section class="blog__details__section pt__40 pb__40">
   <!--container-->
   <div class="container">
      <!--blog details head-->
      <div class="blog__details__head ">
         <!--<h2>-->
         <!--   More Related News-->
         <!--</h2>-->
      </div>
      <!--blog details head-->
      <div class="blog__details__wrap owl-theme owl-carousel">
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{url ('frontend/assets/img/bog-capabilities/bigai.jpg')}}" alt="capabi">
            </a>
            <div class="content">
               <h4>
                  <a href="#de">
                     AI is being used to analyze social media data to...
                  </a>
               </h4>

               <p>
                  There are many variations of passages of Lorem Ipsum available, but the majority have...
               </p>

            </div>
         </div>
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{url ('frontend/assets/img/bog-capabilities/bl8.jpg')}}" alt="capabi">
            </a>
            <div class="content">
               <h4>
                  <a href="#de">
                     AI is being used in the financial industry, with banks and...
                  </a>
               </h4>

               <p>
                  There are many variations of passages of Lorem Ipsum available, but the majority have...
               </p>

            </div>
         </div>
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{url ('frontend/assets/img/bog-capabilities/c4.png')}}" alt="capabi">
            </a>
            <div class="content">
               <h4>
                  <a href="#de">
                     The use of AI in hiring and recruitment processes...
                  </a>
               </h4>
               
               <p>
                  There are many variations of passages of Lorem Ipsum available, but the majority have...
               </p>
               
            </div>
         </div>
         
         <!--<div class="capabilities__items blog__grid__items">-->
         <!--   <a href="#de" class="thumb">-->
         <!--      <img src="{{url ('frontend/assets/img/bog-capabilities/bigai.jpg')}}" alt="capabi">-->
         <!--   </a>-->
         <!--   <div class="content">-->
         <!--      <h4>-->
         <!--         <a href="#de">-->
         <!--            AI is being used to analyze social media data to...-->
         <!--         </a>-->
         <!--      </h4>-->
         <!--      <p>-->
         <!--         There are many variations of passages of Lorem Ipsum available, but the majority have...-->
         <!--      </p>-->
               
         <!--   </div>-->
         <!--</div>-->
         <!--<div class="capabilities__items blog__grid__items">-->
         <!--   <a href="#de" class="thumb">-->
         <!--      <img src="{{url ('frontend/assets/img/bog-capabilities/bl8.jpg')}}" alt="capabi">-->
         <!--   </a>-->
         <!--   <div class="content">-->
         <!--      <h4>-->
         <!--         <a href="#de">-->
         <!--            AI is being used in the financial industry, with banks and...-->
         <!--         </a>-->
         <!--      </h4>-->
              
         <!--      <p>-->
         <!--         There are many variations of passages of Lorem Ipsum available, but the majority have...-->
         <!--      </p>-->
               
         <!--   </div>-->
         <!--</div>-->
         <!--<div class="capabilities__items blog__grid__items">-->
         <!--   <a href="#de" class="thumb">-->
         <!--      <img src="{{url ('frontend/assets/img/bog-capabilities/c4.png')}}" alt="capabi">-->
         <!--   </a>-->
         <!--   <div class="content">-->
         <!--      <h4>-->
         <!--         <a href="#de">-->
         <!--            The use of AI in hiring and recruitment processes...-->
         <!--         </a>-->
         <!--      </h4>-->
         <!--      <ul class="admin__wrap">-->
         <!--         <li>-->
         <!--            <span class="icon">-->
         <!--               <i class="material-symbols-outlined">-->
         <!--                  group-->
         <!--               </i>-->
         <!--            </span>-->
         <!--            <span>-->
         <!--               Admin-->
         <!--            </span>-->
         <!--         </li>-->
         <!--         <li>-->
         <!--            <span class="icon">-->
         <!--               <i class="material-symbols-outlined">-->
         <!--                  event_available-->
         <!--               </i>-->
         <!--            </span>-->
         <!--            <span>-->
         <!--               15-12-2023-->
         <!--            </span>-->
         <!--         </li>-->
         <!--      </ul>-->
         <!--      <p>-->
         <!--         There are many variations of passages of Lorem Ipsum available, but the majority have...-->
         <!--      </p>-->
         <!--      <a href="{{url ('/blog-details') }}" class="capa__more">-->
         <!--         <span>-->
         <!--            Read More-->
         <!--         </span>-->
         <!--         <i class="material-symbols-outlined">-->
         <!--         east-->
         <!--         </i>-->
         <!--      </a>-->
         <!--   </div>-->
         <!--</div>-->
      </div>
   </div>
   <!--container-->
</section>
<!-- Blog Details End -->

<!-- Our Branding Partner start -->
<!--<section class="blog__details__section pt-80 ">-->
    
<section class="blog__details__section pt__40 ">
   <!--container-->
   <div class="container">
      <!--blog details head-->
      <div class="blog__details__head ">
         <h2 style="text-align:center;">
       Our Branding Partner
         </h2>
      </div>
        @php 
         $logo = App\Models\brand_logo::all();
        @endphp
      <div class="blog__details__wrap owl-theme owl-carousel">
        @foreach($logo as $item)
         <div class="capabilities__items blog__grid__items">
            <a href="#de" class="thumb">
               <img src="{{ url('uploads/product_images/'.$item->logo)}}" alt="Brand Image" style="max-width: 100px;margin: 0 auto !important;height: 78px;object-fit: contain;">
            </a>
           
         </div>
         @endforeach 
         <!--<div class="capabilities__items blog__grid__items">-->
         <!--   <a href="#de" class="thumb">-->
         <!--      <img src="{{url ('frontend/assets/img/bog-capabilities/bl8.jpg')}}" alt="capabi">-->
         <!--   </a>-->
            
         <!--</div>-->
         <!--<div class="capabilities__items blog__grid__items">-->
         <!--   <a href="#de" class="thumb">-->
         <!--      <img src="{{url ('frontend/assets/img/bog-capabilities/c4.png')}}" alt="capabi">-->
         <!--   </a>-->
         <!--</div>-->
         <!--<div class="capabilities__items blog__grid__items">-->
         <!--   <a href="#de" class="thumb">-->
         <!--      <img src="{{url ('frontend/assets/img/bog-capabilities/c4.png')}}" alt="capabi">-->
         <!--   </a>-->
         <!--</div>-->
         <!--<div class="capabilities__items blog__grid__items">-->
         <!--   <a href="#de" class="thumb">-->
         <!--      <img src="{{url ('frontend/assets/img/bog-capabilities/c4.png')}}" alt="capabi">-->
         <!--   </a>-->
         <!--</div>-->
         
       
      </div>
   </div>
   <!--container-->
</section>
<!-- Our Branding Partner End -->


<!--cart Section-->
<!--<section class="cart__section bg__white  pb-80">-->
    
<section class="cart__section bg__white  pb__40">
       <!--container-->
      <div class="container">
         <div class="row">
            <div class="col-12">
                 <form method="POST" action="savecorporate">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="checkout__single-wrapper">
                                <div class="checkout__single boxshado__single">
                                    <h5>FILL OUT THE FORM BELOW TO GET THE ESTIMATION OF OUR BULKBUSINESS CARD SEGMENT :</h5>
                                    <hr style="color: var(--banner);width: 7%;" />
                                    <div class="checkout__single-form">
                                        <div class="row g-4">
                                           <div class="col-lg-6">
                                             <div class="input-single">
                                                <input type="text" name="fname" id="userFirstName" required placeholder="First Name">
                                            </div>
                                           </div>
                                            <div class="col-lg-6">
                                             <div class="input-single">
                                                <input type="text" name="lname" id="userLastName" required placeholder="Last Name">
                                             </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-single">
                                                   <input type="email" name="email" id="userCheckEmail" required placeholder="Your Email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-single">
                                                   <input type="text" name="cname" id="cname" required placeholder="Your Company">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-single">
                                                   <input type="text" name="city" id="city" required placeholder="Your City">
                                                </div>
                                            </div>
                                             <div class="col-lg-6">
                                                <div class="input-single">
                                                   <input type="text" name="state" id="state" required placeholder="Your State">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-single">
                                                   <input type="text" name="country" id="country" required placeholder="Your Country">
                                                </div>
                                            </div>
                                             <div class="col-lg-6">
                                                <div class="input-single">
                                                   <input type="text" name="user-check-email" id="userCheckEmail" required placeholder="COMPANY SIZE (MINIMUM SIZE OF 5)*">
                                                </div>
                                            </div>
                                            
                                            <div class="input-single input-check payment__save">
                                               <label for="saveForNext">If you have a team smaller than 5 members, we recommend <a style="color: blue;" href="{{ url('/') }}">Fast App</a></label>
                                           </div>
                                           
                                            <div class="threeradio" style="text-align:right;color:black">
                                             <h1>Card Color Preference</h1>
                                               <input type="radio" value="red" name="color">RED
                                               <input type="radio" value="orange" name="color">GREEN
                                               <!--<input type="radio" value="orange" name="color">ORANGE-->
                                              <input type="radio" value="orange" name="color">PURPLE
                                              <input type="radio" value="green" name="color">GOLDEN
                                               <input type="radio" value="red" name="color">BLACK
                                                <input type="radio" value="red" name="color">ASSORTED
                                            </div>
                            
                                            <div class="text-center mt-4">
                                               
                                                <button style="border: none;float:right" type="submit" class="cmn--btn"> <span>Submit</span> </button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <!--container-->
</section>
<!--cart Section-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@if ($message = Session::get('message_corporate'))
      <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          Toast.fire({
            icon: 'success',
            title: '<h6>Thanks for Corporates Enquiry</h6>'
          })
</script>
@endif

@endsection