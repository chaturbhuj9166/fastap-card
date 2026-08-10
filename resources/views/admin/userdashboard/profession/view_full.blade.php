@extends('userdashboardinclude.userdashmaster')
@section('page_title','My Professions')
@section('contant')


<div class="page-wrapper">
<div class="page-content">

<div class="container-fluid">


<div class="row">

<div class="col-lg-12">
<div class="card">
<div class="row">

<div class="col-md-6"> <h5 class="card-header text-uppercase"> My Professions Details </h5></div>



<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered">
<thead>


<tr>
<th>Profession Name</th>
<td>{{$profession->profession}}</td>
</tr>

<tr>
<th>Logo</th>
<td><a href="{{ url('frontend/profession_logo/'.$profession->logo)}}" data-fancybox="images" data-caption="This image has a caption">
<img src="{{ url('frontend/profession_logo/'.$profession->logo)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 140px; height: 70px;">
</a></td>
</tr>


<tr>

<th>Phone Number</th>
<td>{{$profession->phone}}</td>

</tr>
<tr>  
<th>Email</th>
<td>{{$profession->email}}</td>

</tr>





<tr>  
<th>Loaction </th>
<td>{!! $profession->location !!}</td>

</tr>

<tr>  
<th >Google map loaction </th>
<td>{!! $profession->iframe !!}</td>

</tr>

<tr>  
<th >Google map loaction </th>
<td>{!! $profession->description !!}</td>

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
@stack('footer_script')