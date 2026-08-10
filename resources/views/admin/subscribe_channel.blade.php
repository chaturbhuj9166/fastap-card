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
    
</style>

<div class="page-wrapper">
			<div class="page-content">


<div class="col-sm-12">
       <div class="container-fluid">

 <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i>Subscribers</div>
          
            <div class="card-body">
              <div class="table-responsive">
			        <table id="example2" class="table table-bordered" style="width:100%">
                <thead>
                  <tr>
                        <th>Sr.No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                         @include('layouts.flash-message')
                    <?php $i=0;?>
                 @foreach($sub as $settingee)
                 
                 
                   

<tr role="row" class="odd">
<td><?php $i++;?>{{$i}}</td>
<td>{{$settingee->name}}</td>
<td>{{$settingee->email}}</td>
<td>{{$settingee->mobile}}</td>

<td>
<a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="subdelete{{ $settingee->id }}"><i class="fa fa-trash-o"></i></a>
</td>
@endforeach
</tbody>

</table>


 {{-- Pagination --}}
        <div class="d-flex justify-content-flex-end Pagination_1" >
            {!! $sub->links("pagination::bootstrap-4") !!}
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