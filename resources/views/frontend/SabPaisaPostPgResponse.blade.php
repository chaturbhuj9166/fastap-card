<?php session_start(); ?>
@include('frontend.Authentication')


<style>.header-section , .footer__section , .float{display:none;}</style>



<?php
    $query = $_REQUEST['encResponse'];

    // $authKey = '0jeOYcu3UnfmWyLC';
    // $authIV = 'C28LAmGxXTqmK0QJ';
    
    $authKey = '2g3g4SG0aXGoIXI6';
    $authIV = '3WFfiQ1I3VRruUVO';
    
    $decText = null;
    $AesCipher = new AesCipher();
    $decText = $AesCipher->decrypt($authKey, $authIV, $query);
    
     echo $decText;
     echo '<br/>';
    
    $token = strtok($decText, '&');
    echo $token;
    $i = 0;
    
    /* response value After Decryption
    
    payerName=YUVRAJ MISHRA&payerEmail=yuvraj.mishra@sabpaisa.in&payerMobile=7004069540&clientTxnId=1907&payerAddress=NA&amount=10.0
    &clientCode=NITE5&paidAmount=10.1&paymentMode=Debit Card&bankName=BOB&amountType=INR&status=FAILED&statusCode=0300&challanNumber=null
    &sabpaisaTxnId=883602112220421050&sabpaisaMessage=Sorry, Your Transaction has Failed.&bankMessage=DebitCard&bankErrorCode=null
    &sabpaisaErrorCode=null&bankTxnId=101202235510088892&transDate=Wed Dec 21 16:26:28 IST 2022&udf1=NA&udf2=NA&udf3=NA&udf4=NA&udf5=NA
    &udf6=NA&udf7=NA&udf8=NA&udf9=null&udf10=null&udf11=null&udf12=null&udf13=null&udf14=null&udf15=null&udf16=null&udf17=null&udf18=null
    &udf19=null&udf20=nulli- */
    
    //echo $token;
    
    while ($token !== false) {
        $i = $i + 1;
        $token1 = strchr($token, '=');
        $token = strtok('&');
        $fstr = ltrim($token1, '=');
    
       // echo "i-". $i . '='. $fstr;
       // echo '<br>';
    
        echo $fstr;
    
        if ($i == 1) {
            $payerName = $fstr;
        }
        if ($i == 2) {
            $payerEmail = $fstr;
        }
        if ($i == 3) {
            $payerMobile = $fstr;
        }
        if ($i == 4) {
            $clientTxnId = $fstr;
        }
        if ($i == 5) {
            $payerAddress = $fstr;
        }
        if ($i == 6) {
            $amount = $fstr;
        }
        if ($i == 7) {
            $clientCode = $fstr;
        }
        if ($i == 8) {
            $paidAmount = $fstr;
        }
        if ($i == 9) {
            $paymentMode = $fstr;
        }
        if ($i == 10) {
            $bankName = $fstr;
        }
        if ($i == 11) {
            $amountType = $fstr;
        }
        if ($i == 12) {
            $status = $fstr;
        }
        if ($i == 13) {
            $statusCode = $fstr;
        }
        if ($i == 14) {
            $challanNumber = $fstr;
        }
        if ($i == 15) {
            $sabpaisaTxnId = $fstr;
        }
        if ($i == 16) {
            $sabpaisaMessage = $fstr;
        }
        if ($i == 17) {
            $bankMessage = $fstr;
        }
        if ($i == 18) {
            $bankErrorCode = $fstr;
        }
        if ($i == 19) {
            $sabpaisaErrorCode = $fstr;
        }
        if ($i == 20) {
            $bankTxnId = $fstr;
        }
        if ($i == 21) {
            $transDate = $fstr;
        }
    
        // if ($i == 22) {
        //     $_token = $fstr;
        // }
        if ($i == 28) {
            $udf7 = $fstr;
        }
        if ($i == 29) {
            $udf8 = $fstr;
        }
        if ($i == 30) {
            $udf9 = $fstr;
        }
        if ($i == 31) {
            $udf10 = $fstr;
        }
        if ($i == 32) {
            $udf11 = $fstr;
        }
        if ($i == 33) {
            $udf12 = $fstr;
        }
        if ($i == 34) {
            //user id
            $udf13 = $fstr;
        }
        if ($token == true) {
            // $up = "UPDATE  buy_now SET txid='$pgTxnId', tx_dt='$transDate', status='1' WHERE student_id='$userid'";
            //$up = "UPDATE  buy_now SET txid='$pgTxnId', tx_dt='$transDate', status=1 WHERE student_id=$ufd20";
            // echo $up;
            //  mysqli_query($conn,$up);
    
            //echo "Hello";
        }
    }
    
    $msg ="";
    $style = "";
    if ($status == 'FAILED')
    {
        ?><style>#payment_success{display:none;}</style><?php
        $msg = 'Payment failed. Please try again.';
    }
    else
    {
        ?><style>#payment_faild{display:none;}</style><?php
        
        $msg = 'Payment was successful. Thank you for your purchase.';
        
        // $servername = 'localhost';
        // $username = 'root';
        // $password = '';
        // $dbname = 'sabpaisa_testing';
    
        // // Create connection
    
        // $conn = new mysqli($servername, $username, $password, $dbname);
    
        // $sql = "INSERT INTO orders (name, company_name, address,city,pin_code,country,email,phone,amount,status)
    
        // VALUES ('$payerName','company','$payerAddress','city','pincode','country','$payerEmail','$payerMobile','$amount','$status')";
    
        // if ($conn->query($sql) === true) {
        //     $msg = 'New record created successfully';
        // } else {
        //     echo 'Error: ' . $sql . '<br>' . $conn->error;
        // }
    
        // $conn->close();
        
        
        ?>
        
        @php
            $user_id = $udf13;
           
             $carts = \App\Models\Cart::where('user_id', $user_id)->get();
    
            if (count($carts) == 0) {
                return view('frontend.checkout');
            }
    
            
            $order = new \App\Models\Order();
            $order->user_id = $user_id;
            $order->order_status = 'inactive';
            $order->total_amount = $amount;
            $order->payment_type = $paymentMode;
            $order->payment_status = 'SUCCESS';
            $order->coupon = session('isCouponData') != null ? session('isCouponData')->id : 0;
    
            $order->agent_code = session('isAgentcodeData') != null ? session('isAgentcodeData')->id : 0;
    
            $order->agent_commission = session('agentcodedata');
    
            $order->save();
    
            $ordermeta = new \App\Models\OrderMeta();
            $ordermeta->order_id = $order->id;
            $ordermeta->billing_first_name = $udf7;
            $ordermeta->billing_last_name = $udf8;
            $ordermeta->billing_company_name = $udf9;
            $ordermeta->billing_address = $payerAddress;
            $ordermeta->billing_city = $udf10;
            $ordermeta->billing_country = $udf12;
            $ordermeta->billing_email = $payerEmail;
            $ordermeta->billing_phone = $payerMobile;
            $ordermeta->shipping_first_name = $udf7;
            $ordermeta->shipping_last_name = $udf8;
            $ordermeta->shipping_company_name = $udf9;
            $ordermeta->shipping_address = $payerAddress;
            $ordermeta->shipping_city = $udf10;
            $ordermeta->shipping_country = $udf12;
            $ordermeta->shipping_email = $payerEmail;
            $ordermeta->shipping_phone = $payerMobile;
            $ordermeta->save();
    
            foreach ($carts as $cart) {
                $product = \App\Models\product::where('id', $cart->product_id)->first();
                $order_products = new \App\Models\OrderProduct();
                $order_products->order_id = $order->id;
                $order_products->product_id = $cart->product_id;
                $order_products->quantity = $cart->quantity;
                $order_products->price = $product->pro_price;
                $order_products->name = $cart->name;
                $order_products->mobile = $cart->mobile;
                $order_products->email = $cart->email;
                $order_products->designation = $cart->designation;
                $order_products->logo_status = $cart->logo_status;
                $order_products->image = $cart->image;
                $order_products->save();
    
                $cart->delete();
            }
    
            session()->forget('coupondata');
            session()->forget('isCouponData');
            session()->forget('agentcodedata');
            session()->forget('isAgentcodeData');
        @endphp
        

        
        
        <?php
        
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Page</title>
    
    <!-- anand start code --frontend fastapp theme header -->

    <!--Favicon img-->
    <!--<link rel="shortcut icon" href="https://fastap.in/public/frontend/assets/img/logo/favicon.png">-->
    <link rel="shortcut icon" href="https://fastap.in/public/frontend/assets/img/logo/fastap.png">
    
    <!--main css-->
    <link rel="stylesheet" href="https://fastap.in/public/frontend/assets/css/main.css">

    <!-- font awsome icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- for whatsapp icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- for whatsapp icon -->
        
    <!-- anand end code --frontend fastapp theme header -->
    
    <!-- font awsome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->
    
</head>
<body>

    <!-- payment faild section start -->
     <section class="successful__section bg__white" style="padding: 50px 0px 120px;" id="payment_faild">
           <!--container-->
          <div class="container">
             <div class="row justify-content-center">
                <div class="col-lg-8">
                   <div class="payment__success__inner">
                      <div class="payment__success__header">
                         <!--<div class="icon">-->
                         <div class="">
                            <i class="fa fa-warning" style="font-size:80px;color:red"></i>
                         </div>
                         <h2>Order Confirmation</h2>
                         <p class="primary-text">{{$msg}}</p>
                      </div>
                      <!--<div class="payment__success__body">-->
                         
                      <!--</div>-->
                      
                      <div class="payment__success__footer">
                        
                         <div class="dbutton">
                            <a href="{{url('/new-checkout')}}" class="cmn--btn"><span>Return to shipping</span></a>
                         </div>
                      </div>
                      
                   </div>
                </div>
            </div>
          </div>
          <!--container-->
    </section>
    <!-- payment faild section end -->
    
    <hr/>
    
    <!--payment success section start-->
    <!--<section class="successful__section bg__white">-->
    <section class="successful__section bg__white" style="padding: 0px 0px 120px;" id="payment_success">
           <!--container-->
          <div class="container">
              
        
             <div class="row justify-content-center">
                <div class="col-lg-8">
                   <div class="payment__success__inner">
                      <div class="payment__success__header">
                         <div class="icon">
                            <i class="material-symbols-outlined">
                               done
                            </i>
                         </div>
                         <p>
                                 
                            <?php 
                            
                               // echo $decText;
                               // echo '<br/>';
                            ?>
                         </p>
                         <h2>Order Confirmation</h2>
                         <p class="primary-text">{{$msg}}</p>
                         <hr style="color:black;"/>
                         <p>Customer Information</p>
                      </div>
                      <div class="payment__success__body">
                         <ul>
                            <li>
                               <span>First Name</span>
                               <span class="textbo">{{$udf7}}</span>
                            </li>
                            <li>
                               <span>Last Name</span>
                               <span class="textbo">{{$udf8}}</span>
                            </li>
                            <li>
                               <span>Company Name</span>
                               <span class="textbo">{{$udf9}}</span>
                            </li>
                            <li>
                               <span>Address</span>
                               <span class="textbo">{{$payerAddress}}</span>
                            </li>
                            <li>
                               <span>City</span>
                               <span class="textbo">{{$udf10}}</span>
                            </li>
                            <li>
                               <span>Pin Code</span>
                               <span class="textbo">{{$udf11}}</span>
                            </li>
                            <li>
                               <span>Country</span>
                               <span class="textbo">{{$udf12}}</span>
                            </li>
                            <li>
                               <span>Email Address</span>
                               <span class="textbo">{{$payerEmail}}</span>
                            </li>
                            <li>
                               <span>Phone Number</span>
                               <span class="textbo">{{$payerMobile}}</span>
                            </li>
                             <li>
                               <span>Total Amount</span>
                               <span class="textbo">{{$amount}}</span>
                            </li>
                           
                         </ul>
                      </div>
                      <div class="payment__success__footer">
                         <div class="dbutton">
                            <a href="{{ url('/') }}" class="cmn--btn"><span>Go Website</span></a>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
          </div>
          <!--container-->
    </section>
    <!--payment success section end-->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>



    <!-- anand start code --frontend fastapp theme footer -->
    
    <!--Jquery 3 6 0 Min Js-->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://fastap.in/public/frontend/assets/js/jquery-3.6.0.min.js"></script>
    <!--Bootstrap bundle Js-->
    <script src="https://fastap.in/public/frontend/assets/js/bootstrap.bundle.min.js"></script>
    <!--Viewport Jquery Js-->
    <script src="https://fastap.in/public/frontend/assets/js/viewport.jquery.js"></script>
    <!--Odometer min Js-->
    <script src="https://fastap.in/public/frontend/assets/js/odometer.min.js"></script>
    <!--Magnifiw Popup Js-->
    <script src="https://fastap.in/public/frontend/assets/js/jquery.magnific-popup.min.js"></script>
    <!--Wow min Js-->
    <script src="https://fastap.in/public/frontend/assets/js/wow.min.js"></script>
    <!--Owl carousel min Js-->
    <script src="https://fastap.in/public/frontend/assets/js/owl.carousel.min.js"></script>
    <!--Prijm Js-->
    <script src="https://fastap.in/public/frontend/assets/js/prism.js"></script>
    <!--main Js-->
    <script src="https://fastap.in/public/frontend/assets/js/main.js"></script>
    
    <!-- anand end code --frontend fastapp theme footer -->
</body>
</html>


