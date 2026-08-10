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
    
    #example2_info {
        text-align: end !important;
        position: relative;
        left: 36em;
    }
    
    #example2_wrapper{
        overflow:scroll;
    }
    
    
</style>

<div class="page-wrapper">
			<div class="page-content">


<div class="col-sm-12">
       <div class="container-fluid">

 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i>Manage Franchise<a style="float: right;" class="btn btn-primary" href="addagent"><i class="fa fa-plus-circle" style="margin-right: 0;" aria-hidden="true"></i></a></div>
          
            <div class="card-body">
              <div class="">
                  <!--table-responsive-->
        			<table id="example2" class="table table-bordered" style="width:100%">
                            <thead>
                          <tr>
                                <th>Sr.No.</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Franchise Code</th>
                                <th>Total Earning</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                            <tbody>
                                @include('layouts.flash-message')
                                <?php $i=0;?>
                                @foreach($agents as $agent)
                                    <tr role="row" class="odd">
                                    <td><?php $i++;?>{{$i}}</td>
                                    <td>{{$agent->name}}</td>
                                    <td>{{$agent->mobile}}</td>
                                    <td>{{$agent->email}}</td>     
                                    <td>{{$agent->agent_code}}</td>
                                    <td>
                                        <?php
                                            $totalCalculatedPercentage = 0; // Initialize the variable to store the total calculated percentage
                                        
                                            $TotalOrders = \App\Models\Order::where('agent_code', '=', $agent->id)
                                                ->orderBy('created_at', 'desc')
                                                ->get();
                                                
                                            foreach($TotalOrders as $order){
                                                $totalAmount = $order->total_amount; // Replace with your actual total amount
                                                $percentage = $order->agent_commission; // Replace with the percentage you want to calculate
                                                
                                                $calculatedPercentage = ($percentage / 100) * $totalAmount;
                                                $totalCalculatedPercentage += $calculatedPercentage; // Increment the total with the current calculated value
                                            }
                                        ?>
                                        ₹ {{ $totalCalculatedPercentage }}
                                    </td>
                                    
                                    <td> <input type="checkbox" data-id="{{ $agent->id }}" name="status" class="js-switch" {{ $agent->status == 1 ? 'checked' : '0' }}></td>
                                    <td style="display:flex">

                                    <a class="btn btn-primary" href="editagent/{{ $agent->id }}/editagent"><i class="fa fa-pencil"></i></a> &nbsp;
                                    <a class="btn btn-danger" onclick="return window.confirm('Are you sure you want to delete this Franchise?')" href="agentdelete/{{$agent->id}}"><i class="fa fa-trash-o"></i></a>&nbsp;
                                    <a class="btn btn-dark" href="viewagent/{{ $agent->id }}/viewagent"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-flex-end Pagination_1" >
                        {!! $agents->links("pagination::bootstrap-4") !!}
                    </div>

</div>
</div>
</div>
</div>
</div>
</div>
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
            url: 'agent.update.status',
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
@stack('footer_script')