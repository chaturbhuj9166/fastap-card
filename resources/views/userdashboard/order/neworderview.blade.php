@extends('layouts.user_layout')
@section('page_title','My Orders View')
@section('content')
<style>
    .totalpricesection {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-right: 30px;
        border-bottom: solid 1px;
}

.totalpricesection p {
    margin-bottom: 12px;
}

.biling_detailsmain {
    background: #fff;
    border-radius: 6px;
    margin-bottom: 40px;
    margin-top: 30px;
    padding: 20px;
}
.biling_detailsmain ul {
    padding-left: 0px;
}

.biling_detailsmain ul li {
    list-style: none !important;
    padding: 3px 0;
}


</style>

@if(Session::get('theme') == 1 && Session::get('panel') == 1)
<style>
   .them_change{
    background-color:#f0e68c !important;
    
}

.them_change_second{
    background-color:#06163a !important;
   
} 
 ul#exampleAccordion {
    background: #06163a !important;
}  
</style>
@endif	
<div class="container-fluid">
     
		<div class="biling_detailsmain">
    		<div class="row">
                 <div class="col-4">
                  <h5>Billing # Detail</h5>
              <ul>
                <li>Billing Detail</li>
                <li><b>First Name:</b> <span>{{isset($ordermeta->billing_first_name) ? $ordermeta->billing_first_name:''}}</span></li>
              <li><b>Last Name:</b> <span>{{isset($ordermeta->billing_last_name) ? $ordermeta->billing_last_name:''}}</span></li>
              <li><b>Company Name:</b> <span>{{isset($ordermeta->billing_company_name) ? $ordermeta->billing_company_name:''}}</span></li>
              <!--<li><b>Email:</b> <span>{{isset($ordermeta->billing_email) ? $ordermeta->billing_email:''}}</span></li>-->
              <li><b>Phone:</b> <span>{{isset($ordermeta->billing_phone) ? $ordermeta->billing_phone:''}}</span></li>
              <li><b>City:</b> <span>{{isset($ordermeta->billing_city) ? $ordermeta->billing_city:''}}</span></li>
              <li><b>Addres:</b> <span>{{isset($ordermeta->billing_address) ? $ordermeta->billing_address:''}}</span></li>
                  
                  
              </ul>
                </div>
                 <div class="col-4">
                     <p>Date: {{date("d F Y", strtotime($order->created_at))}}</p>
                 </div>
            </div>
        </div>
		
		
		
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> My Orders View
       
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" >
              <thead>
                  
                <tr>
                  <th>#</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Name</th>
                  <!--<th>Email</th>-->
                  <th>Mobile</th>
                  <th>Designation</th>
                  <th>Logo</th>
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
                  <td>{{ $pname }}</td>
                  <td>₹{{$item->price}}</td>
                  <td>{{$item->name}}</td>
                  <!--<td>{{$item->email}}</td>-->
                  <td>{{$item->mobile}}</td>
                  <td>{{$item->designation}}</td>
                    @if($item->product_id == '8')
                                @if($item->logo_status == '1')
                                    <td><img src="{{ url('frontend/portfolio',$item->image)}}" style ="height: 80px; width: 80px;"alt=""></td>
                                @else
                                    <td></td>
                                @endif
                            @endif
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="totalpricesection">
                <p><b>Total:</b></p>
                <p>₹{{$total}}</p>
            </div>
          </div>
        </div>
       
      </div>
	  <!-- /tables-->
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