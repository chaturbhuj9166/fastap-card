@extends('userdashboardinclude.userdashmaster')
@section('page_title','My Social Link')
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
@include('layouts.flash-message')
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header"><i class="fa fa-table"></i>Social Link<a style="float: right;" class="btn btn-primary" href="socialadd"><i class="fa fa-plus-circle" style="margin-right: 0;" aria-hidden="true"></i></a></div>
<div class="card-body">
<div class="table-responsive">


<table id="example2" class="table table-bordered" style="width:100%">
<thead>
<tr>
<th>Sr.No.</th>
<th>YouTube</th>
<th>Snapchat</th>
<th>Facebook</th>
<th>Instagram </th>
<th>linkedin</th>
<th>Twitter</th>
<th>Action</th>
</tr>
</thead>
<tbody>




<tr role="row" class="odd">
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>
    <a class="btn btn-primary" href="socialedit"><i class="fa fa-pencil"></i></a>
<a class="btn btn-danger" href=""><i class="fa fa-trash-o"></i></a>
</td>

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