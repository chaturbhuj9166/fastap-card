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
                    Checkout
                  </h1>
                  <ul class="breadcumnd__list">
                     <li>
                        <a href="{{url ('/Product')}}">
                           Shop
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
                         Checkout 
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
    
    
    <div class="product_main_home mt-2">
       <div class="container">
            <div class="row align-items-center">
                <!--<div class="col-lg-6 col-sm-12">-->
                <!--    <div class="iq-mb-0">-->
                <!--        <h2 class="">Checkout</h2>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-6 col-sm-12">-->
                <!--    <nav aria-label="breadcrumb" class="text-right">-->
                <!--        <ol class="breadcrumb">-->
                <!--            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="ion-android-home"></i>-->
                <!--                    Home</a></li>-->
                <!--            <li class="breadcrumb-item active  text-dark" aria-current="page">Checkout Page</li>-->
                <!--        </ol>-->
                <!--    </nav>-->
                <!--</div>-->
            </div>
        </div>
         </div>
    <!--======= Breadcrumb Left With BG Image =======-->
    <!--=================================
            Main Content -->
    @php
    $totalCuponDiscount = $total = $discount_price = $bag_discount = $totalFull = 0;
    @endphp
    @foreach ($cartdata as $item)
        @php
            $discount = ($item->pro_price * 100) / $item->pro_mrp;
            $discount_price = $discount_price + $item->pro_mrp;
            $total = $total + $item->pro_price * $item->quantity;
            $totalFull = $total;
        @endphp
    @endforeach
    <div class="main-content">
        <section class="overview-block-ptb iq-checkout">
            <div class="container">

                <!--<div class="row">-->
                <!--    <div class="col-lg-6 col-md-12">-->
                <!--        </div>-->
                <!--</div>-->
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="title">
                            <h5><b>Billing & Shipping Detail</b></h5>
                        </div>
                        <!--<form class="billing-form" method="post" action="{{url('confirmorderr')}}">-->
                        <!-- anand start code -->
                             
                         
                        <!-- for phone pay payment gatway -->
                        <form class="billing-form" method="get" action="{{ route('phonePe') }}">
                        <!-- for phone pay payment gatway -->  
                        <!-- anand end code -->
                            <!--@csrf-->
                            
                            <?php header("Access-Control-Allow-Origin: *"); ?>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="first_name" placeholder="FIRST NAME*" required>
                                
                                <!--@error('first_name')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                                @if ($errors->has('first_name'))
                                    <span class="text-danger"> {{ $errors->first('first_name') }} </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="last_name" placeholder="LAST NAME*" required>
                                <!--@error('last_name')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                                @if ($errors->has('last_name'))
                                    <span class="text-danger"> {{ $errors->first('last_name') }} </span>
                                @endif
                            </div>

                            <!-- COMPANY NAME -->
                            <div class="form-group">
                                <input type="text-area" class="form-control" name="company_name"
                                    placeholder="COMPANY NAME*" required>
                                <!--@error('company_name')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                                @if ($errors->has('company_name'))
                                    <span class="text-danger"> {{ $errors->first('company_name') }} </span>
                                @endif
                            </div>
                            <!-- Address 1 -->
                            <div class="form-group">
                                <!--<input type="text" class="form-control"  name="address" placeholder="ADDRESS*">-->
                                <textarea name="message" class="form-control" rows="1" cols="30" placeholder="ADDRESS*" required></textarea>
                                <!--@error('message')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                                @if ($errors->has('message'))
                                    <span class="text-danger"> {{ $errors->first('message') }} </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="form-control" type="text" name="city" placeholder="CITY / TOWN*" required>
                                <!--@error('city')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                                @if ($errors->has('city'))
                                    <span class="text-danger"> {{ $errors->first('city') }} </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" name="pincode" placeholder="PINCODE*" required>
                                <!--@error('pincode')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                                @if ($errors->has('pincode'))
                                    <span class="text-danger"> {{ $errors->first('pincode') }} </span>
                                @endif
                            </div>
                            <!-- COUNTRY -->
                            <div class="form-group">
                                <select class="form-control" name="country" required>
                                    <!--<option value="select">SELECT COUNTRY*</option>-->
                                     <option value="">SELECT COUNTRY*</option>
                                    <option value="China">China</option>
                                    <option value="Paris">Paris</option>
                                    <option value="UK">UK</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="USA">USA</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Australia">Australia</option>
                                    <option value="India">India</option>
                                </select>
                                <!--@error('country')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                                @if ($errors->has('country'))
                                    <span class="text-danger"> {{ $errors->first('country') }} </span>
                                @endif
                            </div>
                            <!-- Email NAME -->
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="EMAIL ADDRESS*" required>
                                <!--@error('email')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                                @if ($errors->has('email'))
                                    <span class="text-danger"> {{ $errors->first('email') }} </span>
                                @endif
                            </div>
                            <!-- phone number -->
                            <div class="form-group">
                                <input type="number" class="form-control" name="phone" placeholder="PHONE*" required>
                                <!--@error('phone')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                                @if ($errors->has('phone'))
                                    <span class="text-danger"> {{ $errors->first('phone') }} </span>
                                @endif
                            </div>

                            <!-- CITY / TOWN -->
                            <!--<div class="row">-->
                            <!--    <div class="col-md-6 form-group float-left">-->
                            <!--        <input class="form-control" type="text" name="city" placeholder="City / Town*">-->
                            <!--    </div>-->
                            <!-- ZIP CODE -->
                            <!--    <div class="col-md-6 form-group float-right">-->
                            <!--        <input class="form-control" type="text" name="zip" placeholder="Zip Code*">-->
                            <!--    </div>-->
                            <!--</div>-->

                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <!--    <div class="col-lg-12 col-md-12">-->
                            <!--    <div class="shop-widget">-->
                            <!--        <div id="accordionTwo">-->
                            <!--            <div class="card dashed">-->
                            <!--                <div class="card-header" id="headingTwo">-->
                            <!--                    <h5 class="mb-0">-->
                            <!--                    <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">-->
                            <!--                        <h6 class="iq-font-dark"><span class="iq-tw-6 text-uppercase">Have a coupon?</span> <span class="iq-font-green"> Click here to enter your code</span></h6>-->
                            <!--                    </a>-->
                            <!--                    </h5>-->
                            <!--                </div>-->
                            <!--                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">-->
                            <!--                    <div class="checkout-input">-->
                            <!--                        <form method="post" action="{{ url('/setcoupon') }}">-->
                            <!--                            @csrf-->
                            <!--                            <div class="form-group">-->
                            <!--                                <input type="text" name="coupon" class="form-control" id="exampleInputEmail1" placeholder="Enter Coupon Code...">-->
                            <!--                            </div>-->
                            <!--                            <button type="submit" class="button">Apply Coupon</button>-->
                            <!--                        </form>-->
                            <!--                    </div>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>

                        <div class="iq-cartbox iq-totale">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            <h6><b>Your Total Order</b></h6>
                            <div class="iq-carttotal">
                                <table class="table table-borderless all-totalbox">
                                    <thead>
                                        <tr>
                                            <th scope="col">PRICE DETAILS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Price</td>
                                            <td class="text-right iq-tw-6 iq-font-black">₹ {{ $discount_price ?? 0 }}</td>
                                        </tr>
                                        <tr>
                                            <td>Discounted</td>
                                            <td class="text-right iq-tw-6 iq-font-black">₹ -{{ $discount_price-$totalFull ?? 0 }}</td>
                                        </tr>
                                        <tr>
                                            <td>Discounted Price</td>
                                            <td class="text-right iq-tw-6 iq-font-black">₹ {{ $totalFull ?? 0 }}</td>
                                        </tr>
                                        @php
                                            
                                            if (!empty($coupon) && !empty($total)) {
                                                $totalCuponDiscount = ($total * ((int) $coupon)) / 100;
                                                $total = $total - $totalCuponDiscount;
                                            }
                                        @endphp
                                        @if (session()->get('isCouponData') && !empty($totalCuponDiscount))
                                            <tr>
                                                <td>Coupon Discount</td>
                                                <td class="highlight text-right iq-tw-6">- ₹{{ $totalCuponDiscount }}
                                                    {{ !empty($coupon) ? '(' . $coupon . '%)' : '' }}</td>
                                            </tr>
                                        @endif
                                        {{-- <tr>
                                            <td>Delivery Charges</td>
                                            <td class="text-right iq-tw-6 iq-font-black">₹0</td>
                                        </tr> --}}
                                        @php
                                            //print_r($total);
                                            $total = $total;
                                            $subtotal = $total;
                                            $totalGst = ($total * 18) / 100;
                                            $total = $total + $totalGst;
                                        @endphp
                                        
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="text-right iq-tw-6 iq-font-black"> ₹{{ $subtotal ?? 0 }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>GST (Applicable)</td>
                                            <td class="text-right iq-tw-6 iq-font-black">
                                                ₹{{ !empty($totalGst) ? round($totalGst, 2) : 0 }} (+18%)</td>
                                        </tr>

                                        <tr class="tborder tbl-footer">
                                            <td><b>Total Payable</b></td>

                                            <td class="text-right  iq-tw-6 iq-font-black">
                                                <b>?₹{{ !empty($total) ? round($total, 2) : 0 }}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                               <!--<div class="pay-box">-->
                               <!--     <h6><b>Payment Type</b></h6>-->
                               <!--     <ul>-->
                               <!--         <p>There are many variations of passages of Lorem Ipsum available.</p>-->
                               <!--         <li>-->
                               <!--             <div class="radio">-->
                               <!--                 <input type="radio" name="payment_methode" id="radio1"-->
                               <!--                     value="Direct Bank Transfer" checked="">-->
                               <!--                 <label for="radio1">Direct Bank Transfer</label>-->
                               <!--             </div>-->
                               <!--         </li>-->
                               <!--         <li>-->
                               <!--             <div class="radio">-->
                               <!--                 <input type="radio" name="payment_methode" id="radio2"-->
                               <!--                     value="Cheque">-->
                               <!--                 <label for="radio2">Cheque</label>-->
                               <!--             </div>-->
                               <!--         </li>-->
                               <!--         <li>-->
                               <!--             <div class="radio">-->
                               <!--                 <input type="radio" name="payment_methode" id="radio3"-->
                               <!--                     value="Cash On Delivery">-->
                               <!--                 <label for="radio3">Cash On Delivery</label>-->
                               <!--             </div>-->
                               <!--         </li>-->
                               <!--         <li>-->
                               <!--             <div class="radio">-->
                               <!--                 <input type="radio" name="payment_methode" id="radio4"-->
                               <!--                     value="Paypal">-->
                               <!--                 <label for="radio4">Paypal</label>-->
                               <!--             </div>-->
                               <!--         </li>-->
                               <!--     </ul>-->
                               <!-- </div> -->
                               <div class="iq-terms">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value=""
                                            id="defaultCheck1">
                                        <label class="form-check-label iq-font-black" for="defaultCheck1"
                                            data-toggle="tooltip"
                                            title="Simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.">
                                            <a href="{{route('term_condition')}}">I have read terms and conditions*</a>

                                        </label>
                                    </div>
                                </div> 
                                @error('terms')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" class="" name="total" value="{{ $total - $coupon }}"
                                    id="exampleCheck1">
                                <!--<button class="button iq-mt" type="button" id="show">Online Pay</button>-->
                                
                                <!-- anand stat code -->
                                
                                <!--<button class="button iq-mt" type="button" id="show">Continue To Shipping</button>-->
                                
                                <!--<button class="button iq-mt" type="submit" class="btn btn-primary">Continue To Shipping</button>-->
                                
                                <!-- for phone pay payment gatway -->
                                <button class="button iq-mt" type="submit" class="btn btn-primary">Pay Now</button>
                                <!-- for phone pay payment gatway -->
                                
                                <!-- annd start code -->
                                 <!--<button class="button iq-mt" type="submit" id="cash" name="submit" value="submit">Cash On Delivery</button>-->
                                </form>
                            </div>
                            <!-- LOGIN FORM -->
                            <!--<div class="iq-rc-box">-->
                            <!--    <div class="heading-left">-->
                            <!--    <h6><b>Returning Customer</b></h6></div>-->
                            <!--    <div>-->
                            <!--        <form class="clearfix" name="login-form" action="#" method="post">-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-md-12 form-group">-->
                            <!--                    <input type="text" name="email" class="form-control" placeholder="E-mail">-->
                            <!--                </div>-->
                            <!--                <div class="col-md-12 form-group">-->
                            <!--                    <input type="password" name="password" class="form-control" placeholder="Password">-->
                            <!--                </div>-->
                            <!--                <div class="col-md-12">-->
                            <!--                    <a href="#" class="float-left">Forgot password?</a>-->
                            <!--                    <a class="button float-right" href="#">SIGN IN</a>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </form>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        $(document).ready(function() {
            let validation = false;
            $("#show").click(function() {
                $(".validationError").remove();
                $.ajax({
                    url: "{{ url('confirmorder') }}",
                    method: "POST",
                    data: $(".billing-form").serialize() + "ispayment=false",
                    dataType: 'json',
                    success: function(result, status, jqXHR) {
                        if (result.status == false && result.validation == false) {

                            $.each(result.errors, function(key, value) {

                                $(".billing-form [name='" + key + "']").after(
                                    "<div class='text-danger validationError'>" +
                                    value + "</div>")
                            });
                        } else {
                            var totalAmount = "{{ !empty($total) ? round($total, 2) : 0 }}";
console.log(totalAmount)
                            // var product_id =  $(this).attr("data-id");
                            var options = {
                                "key": "{{ env('RAZORPAY_KEY') }}",
                                "currency": "INR",
                                "amount": (totalAmount*100), // 2000 paise = INR 20
                                "name": "FASTAP",
                                "description": "Payment",
                                // "image": "frontend/assets/img/logo/fastap.png",
                                "image": "frontendnew/images/fevicon.png",
                            
                                "handler": function(response) {
                                    let formaData = $(".billing-form").serialize();
                                    window.location.href ='{{ url("confirmorder") }}?'+formaData+'&'+'payment_id='+response.razorpay_payment_id+'&payment_methode=razorpay&total='+totalAmount;
                                },
                                "prefill": {
                                    "contact": $("input[name='phone']").val(),
                                    "email": $("input[name='email']").val(),
                                },
                                "theme": {
                                    "color": "#528FF0"
                                }
                            };
                            var rzp1 = new Razorpay(options);
                            rzp1.open();
                        }

                    },
                    error(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.status)

                    }
                });

                if (validation == true) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('body').on('click', '.buy_now', function(e) {

                    });
                }
            });

        });
    </script>
@endsection

