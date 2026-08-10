<?php session_start(); ?>
@include('frontend.Authentication')


<?php
    // session_start();
    // include 'Authentication.blade.php';
    
    $encData=null; 
    
    // $clientCode='DCRBP';
    // $username='userph.jha_3036';
    // $password='DBOI1_SP3036';
    // $authKey='0jeOYcu3UnfmWyLC';
    // $authIV='C28LAmGxXTqmK0QJ';
    
    $clientCode='FAST97';
    $username='fastaptechnology_11915';
    $password='FAST97_SP11915';
    $authKey='2g3g4SG0aXGoIXI6';
    $authIV='3WFfiQ1I3VRruUVO';
    

    // format the amount 
    $amount = $total; // 23.6
    $roundedAmount = round($amount);
    $formattedAmount =  number_format($roundedAmount);
    //echo $formattedAmount; // Output: 24
    //

    $payerName = $first_name . $last_name;
    $payerEmail=$email;
    $payerMobile=$phone;
    $payerAddress=$message;
    
    $clientTxnId=rand(1000,9999);
    // $clientTxnId='8675732357698798';
    // $amount=$total;
    $amount=$formattedAmount;
    $amountType='INR';
   // $mcc=5137;
    $mcc=8795; // live by default
    $channelId='W';
    
    
    // $callbackUrl='http://127.0.0.1/SabPaisa_PostPg_PHP_Version_7_and_above/SabPaisaPostPgResponse.php';
    
    // $callbackUrl='/SabPaisaPostPgResponse.php';
    
    // $callbackUrl='http://127.0.0.1/Laravel/SabPaisa_PostPg_PHP_Version_7_and_above/SabPaisaPostPgResponse.php';
    
    
    
     //$callbackUrl='http://127.0.0.1:8000/sabpaisa_redirect';
    
   // $callbackUrl='http://127.0.0.1:8000/SabPaisaPostPgResponse';
   
    $callbackUrl='https://fastap.in/SabPaisaPostPgResponse';
    
    
    
    
    //$callbackUrl='http://localhost:8000/resources/views/SabPaisaPostPgResponse.blade.php';
    
    // SabPaisaPostPgResponse
    
    
    
    // Extra Parameter you can use 20 extra parameters(udf1 to udf20)
    //$Class='VIII';
    //$Roll='1008';
    
    // $encData="?clientCode=".$clientCode."&transUserName=".$username."&transUserPassword=".$password."&payerName=".$payerName.
    // "&payerMobile=".$payerMobile."&payerEmail=".$payerEmail."&payerAddress=".$payerAddress."&clientTxnId=".$clientTxnId.
    // "&amount=".$amount."&amountType=".$amountType."&mcc=".$mcc."&channelId=".$channelId."&callbackUrl=".$callbackUrl;
    // //."&udf1=".$Class."&udf2=".$Roll;
    
    // Append CSRF token to the $encData string
     //$encData .= "&_token=" . csrf_token();
    
    
    
    //  $encData="?clientCode=".$clientCode."&transUserName=".$username."&transUserPassword=".$password."&payerName=".$payerName.
    // "&payerMobile=".$payerMobile."&payerEmail=".$payerEmail."&payerAddress=".$payerAddress."&clientTxnId=".$clientTxnId.
    // "&amount=".$amount."&amountType=".$amountType."&mcc=".$mcc."&channelId=".$channelId."&callbackUrl=".$callbackUrl
    // ."&udf7=".$company_name."&udf8=".$pin_code."&udf9=".csrf_token();
    
    // $encData="?clientCode=".$clientCode."&transUserName=".$username."&transUserPassword=".$password."&payerName=".$payerName.
    // "&payerMobile=".$payerMobile."&payerEmail=".$payerEmail."&payerAddress=".$payerAddress."&clientTxnId=".$clientTxnId.
    // "&amount=".$amount."&amountType=".$amountType."&mcc=".$mcc."&channelId=".$channelId."&callbackUrl=".$callbackUrl
    // ."&udf7=".$company_name."&udf8=".$pincode."&udf9=".$city."&udf10=".$country."&udf11=".$first_name."&udf12=".$last_name;
    
    $encData="?clientCode=".$clientCode."&transUserName=".$username."&transUserPassword=".$password."&payerName=".$payerName.
    "&payerMobile=".$payerMobile."&payerEmail=".$payerEmail."&payerAddress=".$payerAddress."&clientTxnId=".$clientTxnId.
    "&amount=".$amount."&amountType=".$amountType."&mcc=".$mcc."&channelId=".$channelId."&callbackUrl=".$callbackUrl
    ."&udf7=".$first_name."&udf8=".$last_name."&udf9=".$company_name."&udf10=".$city."&udf11=".$pincode."&udf12=".$country."&udf13=".$user_id;
    
    
    $AesCipher = new AesCipher();
    $data = $AesCipher->encrypt($authKey, $authIV, $encData);

?>


@extends('layouts.app')
@section('content')



<style>.header-section , .footer__section , .float{display:none;}</style>

<!-- Banner Here -->
<!--<section class="banner__section breadcumnd__banner bannerbg">-->
   <!--Mask-->
<!--   <div class="banner__bgmask">-->
<!--      <img src="{{url ('frontend/assets/img/elements/box-element.png')}}" alt="mask">-->
<!--   </div>-->
   <!--Mask-->
   <!--Container-->
<!--   <div class="container">-->
<!--      <div class="breadcumnd__wrapper">-->
<!--         <div class="row g-4  justify-content-between align-items-end">-->
            <!--col-->
<!--            <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-8">-->
<!--               <div class="breadcumnd__content">-->
<!--                  <h1 class="title">-->
<!--                    Shipping-->
<!--                  </h1>-->
<!--                  <ul class="breadcumnd__list">-->
<!--                     <li>-->
<!--                        <a href="{{url ('/new-checkout')}}">-->
<!--                           Checkout-->
<!--                        </a>-->
<!--                     </li>-->
<!--                     <li>-->
<!--                        <span class="icon">-->
<!--                           <i class="material-symbols-outlined">-->
<!--                              chevron_right-->
<!--                           </i>-->
<!--                        </span>-->
<!--                     </li>-->
<!--                     <li class="sucess">-->
<!--                         Shipping -->
<!--                     </li>-->
<!--                  </ul>-->
<!--               </div>-->
<!--            </div>-->
            <!--col-->
<!--            <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-8">-->
<!--               <div class="breadcumnd__thumb">-->
<!--                  <img src="{{url ('frontend/assets/img/banner/breadcumnd.png')}}" alt="bread">-->
<!--               </div>-->
<!--            </div>-->
            <!--col-->
<!--         </div>-->
         <!--ai text-->
<!--         <div class="bread__ai">-->
<!--            <img src="{{url ('frontend/assets/img/elements/t-element.png')}}" alt="img">-->
<!--         </div>-->
         <!--ai text-->
<!--      </div>-->
<!--   </div>-->
   <!--Container-->
<!--</section>-->


    

    <!--<div style="color:black;">-->
    <!--        <h1> Shipping Page </h1>-->
            
    <!--        <h1>Confirmation Page</h1>-->
    <!--        <p>First Name: {{ $first_name }}</p>-->
    <!--        <p>Last Name: {{ $last_name }}</p>-->
            
    <!--        <p>Company Name: {{ $company_name }}</p>-->
    <!--        <p>Message Name: {{ $message }}</p>-->
    <!--        <p>City Name: {{ $city }}</p>-->
    <!--        <p>Pin Code Name: {{ $pincode }}</p>-->
    <!--        <p>Country Name: {{ $country }}</p>-->
    <!--        <p>Email Name: {{ $email }}</p>-->
    <!--        <p>Phone Name: {{ $phone }}</p>-->
    <!--</div>-->
    
    
    <!--cart Section-->
    <!--<section class="successful__section bg__white">-->
    <section class="successful__section bg__white" style="padding: 50px 0px 120px;">
           <!--container-->
          <div class="container">
             <div class="row justify-content-center">
                <div class="col-lg-8">
                   <div class="payment__success__inner">
                      <div class="payment__success__header">
                         <!--<div class="icon">-->
                         <!--   <i class="material-symbols-outlined">-->
                         <!--      done-->
                         <!--   </i>-->
                         <!--</div>-->
                         <h2>Order Confirmation</h2>
                         <p class="primary-text">Please Check Your Order Details</p>
                      </div>
                      <div class="payment__success__body">
                         <ul>
                             
                            <!-- <li>-->
                            <!--   <span>User id</span>-->
                            <!--   <span class="textbo">{{ $user_id }}</span>-->
                            <!--</li>-->
                            
                            <!--<li>-->
                            <!--   <span>coupondata</span>-->
                            <!--   <span class="textbo">{{ $coupondata }}</span>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--   <span>isCouponData</span>-->
                            <!--   <span class="textbo">{{ $isCouponData }}</span>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--   <span>agentcodedata</span>-->
                            <!--   <span class="textbo">{{ $agentcodedata }}</span>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--   <span>isAgentcodeData</span>-->
                            <!--   <span class="textbo">{{ $isAgentcodeData }}</span>-->
                            <!--</li>-->
                            
                            
                            <li>
                               <span>First Name</span>
                               <span class="textbo">{{ $first_name }}</span>
                            </li>
                            <li>
                               <span>Last Name</span>
                               <span class="textbo">{{ $last_name }}</span>
                            </li>
                            <li>
                               <span>Company Name</span>
                               <span class="textbo">{{ $company_name }}</span>
                            </li>
                            <li>
                               <span>Address</span>
                               <span class="textbo">{{ $message }}</span>
                            </li>
                            <li>
                               <span>City</span>
                               <span class="textbo">{{ $city }}</span>
                            </li>
                            <li>
                               <span>Pin Code</span>
                               <span class="textbo">{{ $pincode }}</span>
                            </li>
                            <li>
                               <span>Country</span>
                               <span class="textbo">{{ $country }}</span>
                            </li>
                            <li>
                               <span>Email Address</span>
                               <span class="textbo">{{ $email }}</span>
                            </li>
                            <li>
                               <span>Phone Number</span>
                               <span class="textbo">{{ $phone }}</span>
                            </li>
                             <li>
                               <span>Total Amount</span>
                               <span class="textbo">{{ $total }}</span>
                            </li>
                         </ul>
                      </div>
                      <div class="payment__success__footer">
                         <!--<div class="payment-success__footer-inner">-->
                         <!--   <a href="index.html">-->
                         <!--     <span class="icon">-->
                         <!--      <i class="material-symbols-outlined">-->
                         <!--         download-->
                         <!--      </i>-->
                         <!--     </span>-->
                         <!--     <span>-->
                         <!--         Download-->
                         <!--     </span>-->
                         <!--   </a>-->
                         <!--   <a href="index.html">-->
                         <!--      <span class="icon">-->
                         <!--         <i class="material-symbols-outlined">-->
                         <!--            print-->
                         <!--         </i>-->
                         <!--      </span>-->
                         <!--      <span>-->
                         <!--         Print Receipt-->
                         <!--      </span>-->
                         <!--   </a>-->
                         <!--   <a href="index.html">-->
                         <!--      <span class="icon">-->
                         <!--         <i class="material-symbols-outlined">-->
                         <!--            drafts-->
                         <!--         </i> -->
                         <!--      </span>-->
                         <!--      <span>-->
                         <!--         Download-->
                         <!--      </span>-->
                         <!--   </a>-->
                         <!--</div>-->
                         <div class="dbutton">
                             
                            <!--<a href="index.html" class="cmn--btn"><span>Pay Now</span></a>-->
                            
                            <!--<form action="https://stage-securepay.sabpaisa.in/SabPaisa/sabPaisaInit?v=1" method="post">-->
                                <form action="https://securepay.sabpaisa.in/SabPaisa/sabPaisaInit?v=1" method="post">

                                <!--@csrf-->
                            
                                <input type="hidden" name="encData" value="<?php echo $data?>" id="frm1">
                                <input type="hidden" name="clientCode" value ="<?php echo $clientCode?>" id="frm2">
                            
                                <!--<input type="hidden" name="udf9" value="<?php echo csrf_token(); ?>">-->
                            
                                <input class="cmn--btn" type="submit" id="submitButton" name="submit" value="Pay Now">
                            </form>
                            
                         </div>
                      </div>
                   </div>
                </div>
            </div>
          </div>
          <!--container-->
    </section>
    <!--cart Section-->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

@endsection

