@extends('include.master')
@section('contant')

<div class="page-wrapper">
<div class="page-content">

<div class="container-fluid">


<div class="row">

<div class="col-lg-12">
<div class="card">
<div class="row">

<div class="col-md-6"> <h5 class="card-header text-uppercase"> Product Details </h5></div>



<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered">
<thead>
<!--<tr>-->
<!--<th>Categroy Name</th>-->
<!--<td>{{$singal->categroy}}</td>-->
<!--</tr>-->
<!--<tr>-->
<!--<th>Subcategroy Name</th>-->
<!--<td>{{$singal->sub_categroy}}</td>-->
<!--</tr>-->

<tr>
<th>Product Name</th>
<td>{{$singal->pro_name}}</td>
</tr>
<tr>
<th>Product Commission</th>
<td>{{$singal->commission}}</td>
</tr>
<tr>
<th>Product Image</th>
<td><a href="{{ url('uploads/product_images/product_single_img/'.$singal->pro_img)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{ url('uploads/product_images/product_single_img/'.$singal->pro_img)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 140px; height: 70px;">
</a></td>
</tr>

<tr>
<th>Product Images</th>
<td>@foreach(json_decode($singal->pro_multi_img, true) as $key => $media_gallery)
<a href="{{ url('/uploads/product_images/product_multi_img/'.$media_gallery) }}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{ url('/uploads/product_images/product_multi_img/'.$media_gallery) }}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 140px; height: 70px;">
</a>
@endforeach</td>
</tr>
<tr>

<th>Product MRP</th>
<td>₹{{$singal->pro_mrp}}</td>

</tr>
<tr>  
<th>Product Price</th>
<td>₹{{$singal->pro_price}}</td>

</tr>





<tr>  
<th>Product About</th>
<td>{!! $singal->pro_description !!}</td>

</tr>

<tr>  
<th>Product Status</th>
<td>
<?php if($singal['status']=='1'){?>

<small class="active">Active</small>
<?php } else{?>

<small class="inactive">Inactive</small>
<?php } ?>

</td>
</tr>
</thead>
</table>
</div>
</div>


</div>
</div>     
</div>
</div>  
</div>
</div>



@endsection



