@extends('include.master')
@section('contant')


<div class="page-wrapper">
<div class="page-content">


<div class="container-fluid">

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header text-uppercase">Update Sub-Categroy</div>
<div class="card-body">
<form method="POST" action="admin/update_subcatagroydata" class="form-horizontal" enctype="multipart/form-data">
@csrf
@include('layouts.flash-message')
<input type="hidden" name="id" value="{{$upadatesubcate['id']}}">


<div class="form-group row">
<label for="basic-input" class="col-sm-3 col-form-label">Sub Category Name</label>
<div class="col-sm-9">
<div class="input-group mb-3">

<input type="text" class="form-control" value="{{$upadatesubcate['sub_categroy']}}" name="subcategroy" placeholder="some text" value="">
</div>

</div>
</div>



<div class="form-group row">
<label for="basic-input" class="col-sm-3 col-form-label">Image</label>
<div class="col-sm-9">
<div class="col-sm-3">
<P> <span><input type="file" name="image" class="form-control" autocomplete="nope" ></span></P>
<input type="hidden" name="logohidden" value="{{$upadatesubcate['image']}}">
<img src="{{('../uploads/subcategory/'.$upadatesubcate->image)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 70px; height: 35px;">
</div>
</div>
</div>




<div class="form-group row">
<label for="basic-input" class="col-sm-3 col-form-label">Description</label>
<div class="col-sm-9">
<div class="input-group mb-3">
<textarea name="editor" >{{$upadatesubcate['editor']}}</textarea>
</div>
</div>
</div>

</div>

<p class="text-center"><button type="submit" value="submit"  class="btn btn-success" name="submit">Update</button></p>

</form>

</div>
</div>
</div><!--end row-->
</div>



<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->
@endsection



@stack('footer_script')