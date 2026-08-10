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
                     Pre Order
                  </h1>
                  <ul class="breadcumnd__list">
                     <li>
                        <a href="/">
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
                        <a href="/preorder">
                           Pre Order
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
                        Order
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

<!--Contact Section Start-->
<!--<section class="contact__section bg__white pt-120 pb-120">-->
    
<section class="contact__section bg__white pt__60 pb__60">
   <div class="container">
      <!--<div class="section__header section__center pb__60">-->
      <div class="section__header section__center pb__20">
         <!--<h2>-->
         <!--   Get in touch with us.-->
         <!--</h2>-->
         <p>
           Pay the Amount of ?1180/- (1000 + 180 GST)  for Business Card and ?5900/- (5000 + 900 GST) for Gold Card.
         </p>
      </div>

      <div class="row justify-content-center">
         <div class="col-lg-8">
            <div class="form_area">
               <!--<form id="form">-->
               
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <strong>You've Ordered Your Card Successfully !!</strong> Now Please Wait for a few Days, <a href="#" class="alert-link">We'll Call You Shortly</a>.
                    </div>
                @endif
                
                <form id="form" method="POST" action="savepreorder" enctype="multipart/form-data">
                      @csrf
                     <div class="row g-4">
                        
                        <div class="col-lg-12">
                           <div class="form-control">
                                 <label for="qr_code">Scan QR Code</label> <br/>
                                 <img style="max-width:30%;" class="normal-logo" src="{{ url('uploads/preorder/qrcode/qr-code.png') }}" alt="QR Code">
                           </div>
                        </div>
                        
                        <!--<div class="col-lg-12">-->
                        <!--   <div class="form-control">-->
                        <!--         <label for="upi_id">UPI ID</label>-->
                        <!--         <input type="text" id="upi_id" readonly value="quickiraya@yesbank">-->
                        <!--   </div>-->
                        <!--</div>-->
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="card_type" id="flexRadioDefault1" value="Business Card" {{ old('card_type') === 'Business Card' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault1">
                              BUSINESS CARD (₹1180)
                          </label>
                          <br/>
                            <input class="form-check-input" type="radio" name="card_type" id="flexRadioDefault2" value="Gold Card" {{ old('card_type') === 'Gold Card' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexRadioDefault2">
                            GOLD CARD (₹5900)
                          </label>
                            <br/>
                            @if ($errors->has('card_type'))
                                    <span class="text-danger"> {{ $errors->first('card_type') }} </span>
                            @endif
                        </div>

                        <div class="col-lg-12">
                           <div class="form-control">
                                 <label for="transaction_id">Transaction ID (Last 4 Digits) </label>
                                 <input type="text" id="transaction_id" name="transaction_id" placeholder="Enter Last 4 Digits of Your Transection ID.." value="{{ old('transaction_id') }}">
                                 
                                @if ($errors->has('transaction_id'))
                                    <span class="text-danger"> {{ $errors->first('transaction_id') }} </span>
                                @endif
                                
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-control">
                                 <label for="name">Name</label>
                                 <input type="text" name="name" id="name" placeholder="Enter Your Full Name..." value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                    <span class="text-danger"> {{ $errors->first('name') }} </span>
                            @endif
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-control">
                                 <label for="phone">Phone</label>
                                 <input type="text" name="phone" id="phone" placeholder="Enter Your Mobile Number..." value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                    <span class="text-danger"> {{ $errors->first('phone') }} </span>
                            @endif
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-control">
                                 <label for="semail">Email</label>
                                 <input type="email" name="email" id="email" placeholder="Enter Your Email..." value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                    <span class="text-danger"> {{ $errors->first('email') }} </span>
                            @endif
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-control">
                                 <label for="image">Upload Your Photo</label>
                                 <input type="file" name="image" id="image">
                            @if ($errors->has('image'))
                                    <span class="text-danger"> {{ $errors->first('image') }} </span>
                            @endif
                           </div>
                        </div>
                        
                        <div class="col-lg-12">
                           <div class="form-control">
                                 <label for="address">Address For Delivery (Optional)</label>
                                 <input type="text" name="address" id="address" placeholder="Enter Your Delivery Address (Optional)...">
                            @if ($errors->has('address'))
                                    <span class="text-danger"> {{ $errors->first('address') }} </span>
                            @endif
                           </div>
                        </div>
                        
                        <div class="row" style="margin-top: 20px;">
                            
                            <div class="col-lg-6">
                               <div class="form-control">
                                     <label for="name">Employee Code (Optional) </label>
                                     <input type="text" name="employee_code" id="employee_code" placeholder="Enter Your Employee Code (Optional)..." value="{{ old('employee') }}">
                                @if ($errors->has('employee_code'))
                                        <span class="text-danger"> {{ $errors->first('employee_code') }} </span>
                                @endif
                               </div>
                            </div>
                            
                            <div class="col-lg-6" style="margin-top: 20px;">
                                <div class="submit__btn text-center mt-4">
                            <button type="submit" class="cmn--btn">
                               <span>
                                  Submit
                               </span>
                            </button>
                         
                            </div>
                        </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<!--Contact Section End-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>

        $(document).ready(function() {
             $("#phone").keyup(function(){
                var prefix = "+91"
                if(this.value.indexOf(prefix) !== 0 ){
                    this.value = prefix + this.value;
                }
            });
        });
    </script>
    
            
@endsection
