@extends('layouts.user_layout')
@section('page_title','My Orders')
@section('content')
<style>
    .main_fixed_content iframe {
    height: 100%;
    border: none !important; 
    border-radius: 50px;
    width: 100% !important;
}

.btn-primary{
    color: #fff !important;
    background-color: #EB1616 !important;;
    border-color: #EB1616 !important;;
}
.btn-primary:hover{
    color: #fff !important;
    background-color: #c81313 !important;
    border-color: #bc1212 !important;
}

</style>
@if(Session::get('theme') == 1 && Session::get('panel') == 1)
<style>
   .them_change{
    background-color:#fff !important;
    
}

.them_change_second{
    background-color:#06163a !important;
   
} 
 ul#exampleAccordion {
    background: #06163a !important;
}  

a {
    /* color: #392779; */
    color: #000000;
    text-decoration: none;
    -moz-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
    outline: none;
}
.savebtn {
    color: #fff;
    /* background-color: #bc1212; */
    /* border-color: #b01111; */
    background-image: linear-gradient(45deg, #13b0c1, transparent) !important;
}
</style>
@endif	

<div class="container-fluid them_change">
       
    <div class="mobile_card_order">
        @include('layouts.flash-message')
       
       <div class="row">
           <div class="col-md-8">
               <div class="tabpagenew mt-4">
                <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link active"  href="{{ url('myorder') }}">All Orders</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="{{ url('trackyourorder') }}">Track Your Order</a>
                  </li>
                 
                </ul>
            </div>
           </div>
           <!--<div class="col-md-4">-->
           <!--    <a href="profile" class="btn btn-primary mb-3 float-right">View Profile</a>-->
           <!--</div>-->
       </div>
     <div class="row">
          
         <?php $i=0;?>
        @foreach($orders as $settingee)
         <div class="col-md-4 mb-2">
             <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body ">
                            <div class="text-right"> </div>
                            <div class="px-2 py-1">
                                <h5 class="text-uppercase" style="color: black !important;font-weight: bold;">{{$settingee->name}}</h5>
                            <h5 class="mt-2 theme-color mb-3 text-danger">Thanks for your order</h5>
                            <!--<span class="theme-color">Payment Summary</span>-->
                            <div class="mb-2">
                                <hr class="new1">
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold">Payment Status</span>
                                <span class="text-muted">{{$settingee->payment_status}}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small>Payment Type</small>
                                <small>{{$settingee->payment_type}}</small>
                            </div>
                           <div class="mb-2">
                                <hr class="new1">
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <span class="font-weight-bold">Total Amount</span>
                                <span class="font-weight-bold theme-color">{{$settingee->total_amount}}</span>
                            </div> 
                            <div class="text-center mt-2">
                                <a href="userorderview{{$settingee->id }}" class="btn  text-black savebtn"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </div> 
                            </div>
                        </div>
                    </div>
                </div>
         </div>
          @endforeach
           
     </div>
      {{ $orders->links() }}
     </div>  
     
     
     
     
     
     
    

     
     
      
      
      
      
      
      
     {{-- <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> My Orders
       
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Sr.No.</th>
                  <th>User Name</th>
                  <th>Payment Status</th>
                  <th>Payment Type</th>
                  <th>Total Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
            
              <tbody>
     @include('layouts.flash-message')
            <?php $i=0;?>
                @foreach($orders as $settingee)
                <tr>
                   <tr role="row" class="odd">
                    <td><?php $i++;?>{{$i}}</td>
                    <td>{{$settingee->name}}</td>
                    <td>{{$settingee->payment_status}}</td>
                    <td>{{$settingee->payment_type}}</td>
                    <td>{{$settingee->total_amount}}</td>
                  <td>
                      <a href="userorderview{{$settingee->id }}" class="btn btn-primary text-white"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  </td>
                </tr>
                 @endforeach
              </tbody>
            </table>
             <div class="d-flex justify-content-flex-end Pagination_1" >
            {!! $orders->links("pagination::bootstrap-4") !!}
        </div>
          </div>
        </div>
       
      </div>--}}
	  <!-- /tables-->
	  </div>
  

<script>let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});</script>


<script>
    
    
$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'product.update.status',
            data: {'status': status, 'id': userId},
            success: function (data) {
                alert(data.message);
            }
        });
    });
});
    
</script>



<style>

.w-5 {
    display: none;
}

.h-5{
    display: none;
}

</style>


@endsection