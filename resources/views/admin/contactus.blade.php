@extends('include.master')
@section('page_title','contactus')
@section('contant')

<style>
    div#example2_info {
    display: none !important;
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
<div class="card-body">
<div class="">
<!--table-responsive-->

<table id="example2" class="table table-bordered" style="width:100%">
<thead>
<tr>
<th>Sr.No.</th>
<th>Name</th>
<th>Email</th>
<th>Mobile</th>
<th>Message</th>

</tr>
</thead>
<tbody>

<?php $i=0;?>
@foreach($contactus as $settingee)




<tr role="row" class="odd">
<td><?php $i++;?>{{$i}}</td>
<td>{{$settingee['name']}}</td>
<td>{{$settingee['email']}}</td>
<td>{{$settingee['sub']}}</td>
<td>{{$settingee['msg']}}</td>


<!--<td>-->
<!--      <?php $conudelete=($settingee->id);?>-->
<!--    <a class="btn btn-primary" href="viewsinglecontect{{$conudelete}}"><i class="fa fa-eye"></i></a>-->
<!--<a class="btn btn-danger" href="delete{{$conudelete}}"><i class="fa fa-trash-o"></i></a>-->
<!--</td>-->
@endforeach
</tbody>

</table>
{{-- Pagination --}}
<div class="d-flex justify-content-flex-end Pagination_1" >
{!! $contactus->links("pagination::bootstrap-4") !!}
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


