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
            <div class="card-header">
                <i class="fa fa-table"></i> Pre Order
            </div>
          
            <div class="card-body">
              <div class="">
                  <!--table-responsive-->
        			<table id="example2" class="table table-bordered" style="width:100%">
                            <thead>
                          <tr>
                                <th>Sr.No.</th>
                                <th>Transaction ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Card Type</th>
                                <th>Employee Code</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        
                            <tbody>
                                @include('layouts.flash-message')
                                <?php $i=0;?>
                                @foreach($preorders as $preorder)
                                    <tr role="row" class="odd">
                                    <td><?php $i++;?>{{$i}}</td>
                                    <td>{{$preorder->transaction_id}}</td>
                                    <td>{{$preorder->name}}</td>
                                    <td>{{$preorder->phone}}</td>
                                    <td>{{$preorder->email}}</td>
                                    <td>
                                        <a target="_blank"
                                            href='{{ url("uploads/preorder/images/$preorder->image") }}'
                                            data-fancybox="images" download>
                                            <img src='{{ url("uploads/preorder/images/$preorder->image") }}'
                                                alt="Preorder Image" class="lightbox-thumb img-thumbnail"
                                                style="width: 140px; height: 70px;" download>
                                        </a>
                                        <a href='{{ url("uploads/preorder/images/$preorder->image") }}' download> <i class="fa fa-download" aria-hidden="true"></i> <a>
                                    </td>
                                    <td>{{$preorder->card_type}}</td>
                                    
                                    <?php 
                                    /* for employee code start*/
                                    if($preorder->employee_code == ""){
                                        $employee_code = "N/A";
                                    } 
                                    else{
                                    $employee_code = $preorder->employee_code;
                                    }
                                    /* for employee code end*/
                                    
                                    /* for address code start*/
                                    if($preorder->address == ""){
                                        $address = "N/A";
                                    } 
                                    else{
                                    $address = $preorder->address;
                                    }
                                    /* for address code end*/
                                    
                                    ?>
                                    <td>{{$employee_code}}</td>
                                     <td>{{$address}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-flex-end Pagination_1" >
                        {!! $preorders->links("pagination::bootstrap-4") !!}
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






@endsection
@stack('footer_script')