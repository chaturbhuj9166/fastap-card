@extends('include.master')
@section('contant')


<style>
    
    .active{
            font-size: 14px;
    background-image: linear-gradient(to right, rgb(218, 34, 255) 0%, rgb(151, 51, 238) 51%, rgb(218, 34, 255) 100%);
        
    }
    
    
    .inactive{
         font-size: 14px;
        background-image: linear-gradient(to right, rgb(255, 81, 47) 0%, rgb(240, 152, 25) 51%, rgb(255, 81, 47) 100%);
    }
    ul{
        list-style:none;
    }
    h5{
        padding-left: 30px;
    }
</style>




<div class="page-wrapper">
    <div class="page-content">
          <div class="col-sm-12">
            <div class="container pt-5">
  
        <div class="card-body bg-white">
        
       <div class="row">
             <div class="col-4">
      
              <h5>Billing # Detail</h5>
              
          <ul>
              <li>Billing Detail</li>
              <li>First Name: <SPAN>{{isset($ordermeta->billing_first_name) ? $ordermeta->billing_first_name:''}}</SPAN></li>
              <li>Last Name: <span>{{isset($ordermeta->billing_last_name) ? $ordermeta->billing_last_name:''}}</span></li>
              <li>Company Name: <span>{{isset($ordermeta->billing_company_name) ? $ordermeta->billing_company_name:''}}</span></li>
              <li>Email: <span>{{isset($ordermeta->billing_email) ? $ordermeta->billing_email:''}}</span></li>
              <li>Phone: <span>{{isset($ordermeta->billing_phone) ? $ordermeta->billing_phone:''}}</span></li>
              <li>City: <span>{{isset($ordermeta->billing_city) ? $ordermeta->billing_city:''}}</span></li>
              <li>Addres: <span>{{isset($ordermeta->billing_address) ? $ordermeta->billing_address:''}}</span></li>
              <!--<li>Card Type:<span></span></li>-->
          </ul>
      
    </div>
        <!--     <div class="col-4">-->
        <!--        <h5>Shipping # Detail</h5>-->
                 
        <!--  <ul>-->
        <!--      <li>Shipping Detail</li>-->
        <!--      <li>First Name: <SPAN>{{isset($ordermeta->shipping_first_name) ? $ordermeta->shipping_first_name:''}}</SPAN></li>-->
        <!--      <li>Last Name: <span>{{isset($ordermeta->shipping_last_name) ? $ordermeta->shipping_last_name:''}}</span></li>-->
        <!--      <li>Company Name: <span>{{isset($ordermeta->shipping_company_name) ? $ordermeta->shipping_company_name:''}}</span></li>-->
        <!--      <li>Email: <span>{{isset($ordermeta->shipping_email) ? $ordermeta->shipping_email:''}}</span></li>-->
        <!--      <li>Phone: <span>{{isset($ordermeta->shipping_phone) ? $ordermeta->shipping_phone:''}}</span></li>-->
        <!--      <li>City: <span>{{isset($ordermeta->shipping_city) ? $ordermeta->shipping_city:''}}</span></li>-->
        <!--      <li>Addres: <span>{{isset($ordermeta->shipping_address) ? $ordermeta->shipping_address:''}}</span></li>-->
        <!--  </ul>-->
        <!--</div>-->
             <div class="col-4">
                 <p>Date: {{date("d F Y", strtotime($order->created_at))}}</p>
             </div>
             
 </div>
 </div>
 </div>
</div>
</div>
</div>
<!--gsdkfsgfdlfgsdkfg===================-->
<div class="page-wrapper">
<div class="page-content">


<div class="col-sm-12">
       <div class="container-fluid">

 <div class="row">
        <div class="col-lg-12">
          <div class="card">
           
            <div class="card-body">
              <div class="table-responsive">
			        <table  class="table table-bordered" style="width:100%">
                <thead>
                  <!--<tr>-->
                  <!--      <th>#</th>-->
                  <!--      <th>User Name</th>-->
                  <!--      <th>Payment Status</th>-->
                  <!--      <th>Payment Type</th>-->
                  <!--      <th>Total Amount</th>-->
                  <!--      <th>Action</th>-->
                  <!--  </tr>-->
                      <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <!--<th>Quntity</th>-->
                        <th>Name</th>
                        <!--<th>email</th>-->
                        <th>Mobile</th>
                        <th>Designation</th>
                        <th>Logo</th>
                        <!--<th>Total Amount</th>-->
                       
                    </tr>
                </thead>
                             <tbody>
                    
                        @php
                            $i=1;
                            $total = 0;
                        @endphp
                       
                        @foreach($allorder as $item)
                            @php
                               // $price = $item->price;
                                //$quantity = $item->quantity;
                               // $subtotal = ($price*$quantity);
                                //$total = $total + $subtotal;
                                $data = App\Models\product::where('id',$item->product_id)->first();
                                $pname = $data->pro_name;
                                
                                $price = $item->price;
                                if($item->product_id == '8'){
                                    if($item->logo_status == '1'){
                                        $pprice = $item->price; 
                                        $price = $pprice+150;
                                    }
                                }
                                
                                $total = $total + $price;
                            @endphp
                           
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$pname}}</td>
                            <td>₹{{$item->price}} + (18% GST)</td>
                            <!--<td>{{$item->quantity}}</td>-->
                            <td>{{$item->name}}</td>
                            {{-- <td>{{$item->email}}</td> --}}
                            <td>{{$item->mobile}}</td>
                            <td>{{$item->designation}}</td>
                          
                                @if($item->logo_status == '1')
                                    <td><a href='{{ url('frontend/portfolio',$item->image)}}' download><img src="{{ url('frontend/portfolio',$item->image)}}" style ="height: 80px; width: 80px;"alt="" download></a></td>
                                @else
                                    <td></td>
                                @endif
                            
                            <!--<td>${{$total}}</td>-->
                        </tr>
                        @endforeach
                    
                </tbody>
                 <div class="row">

                    <div class="col-12">
                       <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Total:</th>
                                <td class="d-flex justify-content-end mx-5"><p style="margin-right: 90px" > ₹{{$order->total_amount}}</p></td>
                            </tr>
                          </table>
                      </div>
                    </div>
                </div>

</table>



</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>




<style>

.w-5 {
    display: none;
}

.h-5{
    display: none;
}

</style>


@endsection
@stack('footer_script')