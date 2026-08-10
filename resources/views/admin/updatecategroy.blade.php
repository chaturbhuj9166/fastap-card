@extends('include.master')
@section('page_title','Categroy')
@section('contant')

<style>

.button1{
    position: relative;
    bottom: 38px;
    
    }
    
    </style>

<div class="page-wrapper">
			<div class="page-content">
				

    <div class="container-fluid">

	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase">Update Categroy</div>
			 
			   <div class="text-end"><button type="back" onclick="goBack()" class="btn btn-success button1">BACK</button></div>
			     <div class="card-body">
			        
				    <form method="POST" action="admin/updatecategroy" class="form-horizontal" enctype="multipart/form-data">
@csrf
@include('layouts.flash-message')
<input type="hidden" name="id" value="{{$upadatecate['id']}}">


					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Category Name</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
                            
								<input type="text" class="form-control" value="{{$upadatecate['categroy']}}" name="categroy" placeholder="some text" value="">
								
							  </div>
						<span style="color:red;"> @error ('categroy') {{$message}}@enderror</span>
                             
						  </div>
						</div>
					

						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Image</label>
						  <div class="col-sm-9">
                          <div class="col-sm-3">
<P> <span><input type="file" name="image" class="form-control" autocomplete="nope" ></span></P>
<input type="hidden" name="logohidden" value="{{$upadatecate['image']}}">
<img src="{{('../uploads/category/'.$upadatecate->image)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 70px; height: 35px;">
</div>
						  </div>
						</div>
						
		
						

		<div class="form-group row">
						  <label for="basic-input" class="col-sm-3 col-form-label">Description</label>
						  <div class="col-sm-9">
							<div class="input-group mb-3">
								<textarea name="editor" >{{$upadatecate['description']}}</textarea>
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