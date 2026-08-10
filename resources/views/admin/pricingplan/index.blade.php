@extends('include.master')
@section('page_title','pricing_plan')
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
@include('layouts.flash-message')
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header"><i class="fa fa-table"></i>Pricing Plan
<!--<a style="float: right;" class="btn btn-primary" ></a>-->
</div>
<div class="card-body">
<div class="table-responsive">
<!--table-responsive-->

<table id="example2" class="table table-bordered" style="width:100%">
<thead>
<tr>
<th>Sr.No.</th>
<th>CARD NAME</th>
<th>CARD PRICE</th>
<th>CARD IMGAGE</th>
<th> DESCRIPTION</th>
<th>ACTION</th>
</tr>
</thead>
<tbody>

<?php $i=0;?>
@foreach($price as $settingee)




<tr role="row" class="odd">
<td><?php $i++;?>{{$i}}</td>
<td>{{$settingee->name}}</td>
<td>{{$settingee->price}}</td>
<td>
<img src="{{url('uploads/price/'.$settingee->image)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 70px; height: 60px;">
</td>
<td>{!!$settingee->short_des!!}</td>
<td>
    <a class="btn btn-primary" href="editprice{{$settingee->id}}"><i class="fa fa-pencil"></i></a>

<a class="btn btn-danger" href="pricedelete{{$settingee->id}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></a>
</td>
@endforeach
</tbody>

</table>

<div class="d-flex justify-content-flex-end Pagination_1" >

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