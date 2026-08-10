@extends('layouts.app')
@section('content')
    <style>
        .delete_maie_btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .delete_maie_btn a {
            font-size: 19px;
        }

        .product_details.proh4 {
            line-height: 0.5 !important;
            margin-top: 10px !important;
        }
        
        .images_images{
 height: 100%;
    width: 100%;
        }
       .Shopping_Bag_images {
    width: 40%;
    position: relative;
    left: 62px;
    bottom: 68px;
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
                    Cart
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
                     <li class="sucess">
                        Cart
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

    
    
    <div class="product_main_home mt-2">
       <div class="container">
            <div class="row align-items-center">
                
                <!--<div class="col-lg-6 col-sm-12">-->
                <!--    <nav aria-label="breadcrumb" class="text-right">-->
                <!--        <ol class="breadcrumb">-->
                <!--            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="ion-android-home"></i>-->
                <!--                    Home</a></li>-->
                <!--            <li class="breadcrumb-item active text-dark" aria-current="page">Cart Page</li>-->
                <!--        </ol>-->
                <!--    </nav>-->
                <!--</div>-->
            </div>
        </div>
         </div>
    <!--======= Breadcrumb Left With BG Image =======-->

    <!--=================================
    Main Content -->
    <div class="main-content">
        <section class="overview-block-ptb iq-cartbox">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-sm-12">
                        <div class="total-box">
                            <div class="row align-items-center">
                                <div class="col-md-12 col-sm-12">
                                    <h6 class="float-left"><b>Shopping Bag</b> ({{ count($cartdata) }} Items)</h6>
                                </div>
                            </div>
                        </div>
                        @php
                            $totalCuponDiscount = $total = $discount_price = $bag_discount = $totalFull =  0;
                        @endphp
                        
                       
                        
                        @if (count($cartdata) > 0)
                            @foreach ($cartdata as $cart)
                                <div class="shopitem-box indc1">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="cart-img">
                                                <img src="{{ URL::asset('public/uploads/product_images/product_single_img') }}/{{ $cart->pro_img }}"
                                                    alt="product image">
                                                     @if($cart->logo_status=='1')
                                                            <div class="Shopping_Bag_images">
                                               <img class="images_images" src="{{ URL::asset('frontend/portfolio') }}/{{ $cart->image }}" alt="logo">
                                                            </div>
                                                            @endif
                                                   
                                                    
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="cart-detail">
                                                <div class="delete_maie_btn">
                                                    <h6 class="iq-tw-6"><a href="#"
                                                            class="text-dark">{{ $cart->pro_name }}</a></h6>
                                                    <!--<a href="{{ url('cartprodelete/' . $cart->id) }}" class=""><i-->
                                                    <!--        class="fa fa-trash" aria-hidden="true"></i></a>-->
                                                    
                                                    <a onclick="return confirm('Are you sure you want to delete this item from your cart?')" href="{{ url('cartprodelete/' . $cart->id) }}" class="">
                                                        <i class="material-symbols-outlined">close</i>
                                                    </a>
                                                </div>

                                                <div class="stock">In Stock</div>
                                                <!--<span class="sold">Sold by: JD Scort</span>-->
                                                <div class="shop-price w-100 d-inline-block">
                                                    <del>₹{{ $cart->pro_mrp }}</del>&nbsp;&nbsp;<strong>₹{{ $cart->pro_price }}</strong>
                                                    @php
                                                        $discount = ($cart->pro_price * 100) / $cart->pro_mrp;
                                                        $discount_price = $discount_price + $cart->pro_mrp;
                                                        $bag_discount = $bag_discount + $cart->pro_mrp - $cart->pro_price;
                                                        $discount1 = number_format((float) $discount, 0, '.', '');
                                                        $total = $total + $cart->pro_price * $cart->quantity;
                                                        $totalFull = $total;
                                                    @endphp
                                                    
                                                    
                                                    @php 
                               
                                                     $cpo = App\Models\coupon::first();
                                                        @endphp
                                                    
                                                    <span>{{isset($cpo->discoun) &&  $cpo->discoun !='' ? $cpo->discoun :'' }}% off</span>
                                                </div>
                                                <div class="col-md-12" style="padding: 0;">
                                                    <div class="product_details proh4">
                                                        <ul>
                                                            <li>
                                                                <p><b>Name: </b>{{ $cart->name }}</p>
                                                            </li>
                                                            <!--//<li><b>Email: </b>{{ $cart->email }}</li>-->
                                                            <li>
                                                                <p><b>Mobile: </b>{{ $cart->mobile }}</p>
                                                            </li>
                                                            <li>
                                                                <p><b>Designation: </b>{{ $cart->designation }}</p>
                                                            </li>
                                                          {{--  @if($cart->logo_status=='1')
                                                            <li>
                                                                <p><b>Logo: </b>YES</p>
                                                            </li>
                                                            @endif --}}
                                                    <!--         <li>-->
                                                    <!--            <p><img src="{{ URL::asset('frontend/portfolio') }}/{{ $cart->image }}"-->
                                                    <!--alt="product image" style="width:10% ; height:20px;"></p>-->
                                                    <!--        </li>-->
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!--<p>All products in cart don't have the offer!</p>-->
                                                <div class="row align-items-center">
                                                    <!--<div class="col-md-4">-->
                                                    <!--    <span class="iq-tw-6">Size:</span>-->
                                                    <!--    <div class="form-group sort-price d-inline-block">-->
                                                    <!--        <select class="form-control" id="exampleFormControlSelect1">-->
                                                    <!--            <option>XL</option>-->
                                                    <!--            <option>XXL</option>-->
                                                    <!--            <option>L</option>-->
                                                    <!--            <option>M</option>-->
                                                    <!--            <option>S</option>-->
                                                    <!--            <option>XS</option>-->
                                                    <!--        </select>-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                    <div class="col-md-8">
                                                        <!--<div class="select-no one">-->
                                                        <!--    <span class="iq-tw-6">Quantity:</span>-->

                                                        <!--    <form class="shop-input" class="shop-input" id="shopform" method="POST" action="{{ url('shopingcart', $cart->id) }}">-->
                                                        <!--        <input type="button" value="-" class="decrement" field="quantity">-->
                                                        <!--        <input type="text" name="quantity" value="{{ $cart->quantity }}" class="input-box">-->
                                                        <!--        <input type="button" value="+" class="increment" field="quantity">-->
                                                        <!--    </form>-->
                                                        <!--</div>-->
                                                    </div>
                                                </div>
                                                {{-- <div class="all-button">
                                       <a href="{{url('cartprodelete/'.$cart->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <a href="#"><span>Save For Later</span></a>
                                    </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                    </div>
                    <div class="col-lg-5 col-sm-12">
                        <div class="iq-totale">
                            <h6><b>Cart Totals</b></h6>
                            <div class="iq-carttotal">
                                <table class="table table-borderless coupon-box">
                                    <thead>
                                        <tr>
                                            <th scope="col">COUPONS</th>
                                        </tr>
                                    </thead>
                                </table>

                                <div class="iq-apply">
                                    <form method="post" action="{{ url('/setcoupon') }}">
                                        @csrf
                                        <div class="form-row align-items-center coupon_main_input">
                                            <div class="col-auto my-1">
                                                <label class="sr-only" for="inlineFormInputName">Name</label>
                                                <input type="text" name="coupon" class="form-control"
                                                    id="inlineFormInputName" placeholder="COUPONS">

                                            </div>

                                            <div class="col-auto my-1">
                                                <button type="submit" class="button">Submit</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                
                                <br>
                                @if(!empty(session()->get('coupondata')))
                                    <div class="alert alert-success">
                                        Coupon {{ session()->get('isCouponData')->name ?? '' }} applied
                                        <a href="{{ url("remove-coupon-code") }}"  type="button" class="close"  >
                                            <span aria-hidden="true">&times;</span>
                                        </a>
                                    </div>
                                @endif
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
                                @php
                               // print_r($total);die;
                               
                                     if(!empty($coupon) && !empty($total)){
                                        $totalCuponDiscount =  ($total*((int)$coupon))/100;
                                        $total = $total  - $totalCuponDiscount ;
                                    }
                                @endphp
                                
                            <!--anand start code -->
                                <div class="iq-apply">
                                    <form method="post" action="{{ url('/setagentcode') }}">
                                        @csrf
                                        <div class="form-row align-items-center coupon_main_input">
                                            <div class="col-auto my-1">
                                                <label class="sr-only" for="agent_code">Franchise Code</label>
                                                <input type="text" name="agent_code" class="form-control"
                                                    id="agent_code" placeholder="Franchise CODE">

                                            </div>

                                            <div class="col-auto my-1">
                                                <button type="submit" class="button">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                            
                                </div>
                                
                                <br>
                                @if(!empty(session()->get('agentcodedata')))
                                    <div class="alert alert-success">
                                        Franchise Code {{ session()->get('isAgentcodeData')->agent_code ?? '' }} applied
                                        <a href="{{ url("remove-agent-code") }}"  type="button" class="close"  >
                                            <span aria-hidden="true">&times;</span>
                                        </a>
                                    </div>
                                @endif
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
                                
                            <!--anand end code -->    
                                
                                <table class="table table-borderless all-totalbox">
                                    <thead>
                                        <tr>
                                            <th scope="col">PRICE DETAILS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--<tr>-->
                                        <!--    <td>Sub Total</td>-->
                                        <!--    <td class="text-right iq-tw-6 iq-font-black">- ₹{{ $discount_price }}</td>-->
                                        <!--</tr>-->
                                          
                                          </tr>
                                       {{-- @if($cart->logo_status == '1')
                                           <tr>
                                            <td>Logo Charge</td>
                                            <td class="text-right">₹{{ 150*count($data)  }}</td>
    `                                     
                                        </tr>
                                        @endif --}}
                                         <tr>
                                            <!--<td>Amount</td>-->
                                        
                                        {{-- @php
                                                        $discount = ($cart->pro_price * 100) / $cart->pro_mrp;
                                                        $discount_price = $discount_price + $cart->pro_mrp;
                                                        $bag_discount = $bag_discount + $cart->pro_mrp - $cart->pro_price;
                                                        $discount1 = number_format((float) $discount, 0, '.', '');
                                                        $total = $total + $cart->pro_price * $cart->quantity;
                                                        $totalFull = $total;
                                                    @endphp--}}
                                            <td class="iq-tw-6 iq-font-black">Price</td>
                                            <td class="text-right iq-tw-6 iq-font-black">₹{{ $discount_price ?? 0 }}</td>
                                       
                                      

                                        
                                        <tr>
                                            <td>Discount</td>
                                            <td class="highlight text-right iq-tw-6">- ₹{{ $bag_discount??'' }} </td>
                                        </tr>
                                        <tr>
                                        <td>Discounted Price</td>
                                            <td class="highlight text-right iq-tw-6">₹{{ $totalFull??'' }} </td>
                                        </tr>
                                        @if (session()->get('isCouponData') && !empty($totalCuponDiscount))
                                            <tr>
                                                <td>Coupon Discount</td>
                                                <td class="highlight text-right iq-tw-6">- ₹{{ $totalCuponDiscount }} {{ !empty($coupon) ?  "(".$coupon."%)" : "" }}</td>
                                            </tr>
                                        @endif
                                     {{--    <tr>
                                            <td>Delivery Charges</td>
                                            <td class="text-right iq-tw-6 iq-font-black">₹0</td>
                                        </tr> --}}
                                         @php
                                        //print_r($total);
                                            $total = $total;
                                            $subtotal = $total;
                                            $totalGst = ($total*18)/100;
                                            $total  =   $total +  $totalGst;
                                           @endphp
                                           
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="text-right iq-tw-6 iq-font-black"> ₹{{ $subtotal ?? 0 }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>GST (Applicable)</td>
                                            <td class="text-right iq-tw-6 iq-font-black"> ₹{{ !empty($totalGst) ? round($totalGst,2) :   0 }} (+18%)</td>
                                        </tr>
                                       
                                        <tr class="tborder tbl-footer">
                                            <td><b>Total Payable</b></td>

                                            <td class="text-right  iq-tw-6 iq-font-black"><b>?₹{{ !empty($total) ? round($total,2) :   0 }}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="button iq-mt" href="{{ url('new-checkout') }}">CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class="mt-5">No Item Found</h5>
                    @endif
                </div>
            </div>
        </section>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    @if(Session::has('message'))
        swal({
  title: "Payment Successfully",
  text: "Thanks You",
  icon: "success",
  button: "ok",
});
@endif
    </script>
@endsection

