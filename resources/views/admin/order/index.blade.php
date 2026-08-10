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

    
</style>

<div class="page-wrapper">
			<div class="page-content">


<div class="col-sm-12">
       <div class="container-fluid">

 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <!--<div class="card-header"><i class="fa fa-table"></i>Orders<a style="float: right;" class="btn btn-primary" href="add-product"><i class="fa fa-plus-circle" style="margin-right: 0;" aria-hidden="true"></i></a></div>-->
          
            <div class="card-body">
              <div class="table-responsive">
			        <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                  <tr>
                        <th>Sr.No.</th>
                        <th>User Name</th>
                        <th>Payment Status</th>
                        <th>Payment Type</th>
                        <th>Merchant TransactionId</th>
                        <th>TransactionId</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <!--<th>Coupon Code Applied</th>-->
                        <th>Coupon Code </th>
                        <th>Agent Code </th>
                        <th>QR</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        @include('layouts.flash-message')
                        <?php $i=1;?>
                            @foreach($orders as $settingee)
                 
                                <tr role="row" class="odd">
                                <td>{{$i++}}</td>
                                <td>{{$settingee->user->name??''}}</td>
                                <td>{{$settingee->payment_status}}</td>
                                <td>{{$settingee->payment_type}} </td>
                                <td>{{ $settingee->merchantTransactionId ?? 'N/A' }}</td>
                                <td>{{ $settingee->transactionId ?? 'N/A' }} </td>
                                <td>{{$settingee->total_amount}}</td>
                                <td>{{date('d-M-Y',strtotime($settingee->created_at))}}</td>
                                <td class='{{$settingee->couponDetail?"text-primary":""}}'>{{$settingee->couponDetail->name??'Not Applied'}}</td>

                                <td class='{{$settingee->agentDetail?"text-primary":""}}'>{{$settingee->agentDetail->agent_code??'Not Applied'}}</td>


                                {{-- <td class='text-center'>
                                    <a href="{{$settingee->user->document?url('user/document/download/'):'#!'}}/{{$settingee->user->id}}" {{$settingee->user->document?'download':''}}>
                                    <i class='fa fa-download fa-2x text-info'></i>
                                    </a>
                                </td> --}}
                               <td>
                                   <a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{url('/profile')}}/{{$settingee->user->mobile??''}}" target="_blank" download><img src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&data={{url('/profile')}}/{{$settingee->user->mobile??''}}" download></a>
                               </td>
                             <td>
                                <input type="checkbox" data-id="{{ $settingee->id }}" name="status" class="js-switch" {{ $settingee->status == 1 ? 'checked' : '' }}></td>
                            <td>
                                  
                                    
    
                                   
                                    <a class="btn btn-dark" href="orderview{{$settingee->id }}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-dark " onclick="return confirm('Are you sure you want to delete this Order')" href="{{ url('admin/order-delete/'.$settingee->id)}}"><i class="fa fa-trash-o" ></i></a>
                                    
                                </td>
                            @endforeach
</tbody>

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

<!-- Button to Open the Modal -->
<!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">-->
<!--  Open modal-->
<!--</button>-->

<!-- The Modal -->
<div class="modal" id="active_inactive">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <div class="row">
             <div class="col-md-6"><a href="" class="btn btn-primary  d-block">QR Code Generate</a></div>
             <div class="col-md-6"><a href="" class="btn btn-primary d-block">NFC</a></div>
         </div>
      </div>

      <!-- Modal footer -->
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>-->
      <!--</div>-->

    </div>
  </div>
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
url: 'order.status',
data: {'status': status, 'id': userId},
success: function (data) {
alert(data.message);
}
});
});
});

</script>

<script>

success: function (data) {
toastr.options.closeButton = true;
toastr.options.closeMethod = 'fadeOut';
toastr.options.closeDuration = 100;
toastr.success(data.message);
}
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
@stack('footer_script')