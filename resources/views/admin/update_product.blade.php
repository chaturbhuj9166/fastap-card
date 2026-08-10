@extends('include.master')
@section('page_title','Categroy')
@section('contant')

<style>

.button1{
    position: relative;
    bottom: 38px;
        padding: 6px 27px;
    }
    
    </style>

<div class="page-wrapper">
			<div class="page-content">
				

    <div class="container-fluid">

	    <div class="row">
           <div class="col-lg-12">
		     <div class="card">
			   <div class="card-header text-uppercase">Update Product</div>
			 
			   <div class="text-end"><button type="back" onclick="goBack()" class="btn btn-primary button1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></div>
			     <div class="card-body">
			        
				    <form method="POST" action="admin/update-product" class="form-horizontal" enctype="multipart/form-data">
				        
				        
				        
@csrf
@include('layouts.flash-message')
<input type="hidden" name="id" value="{{$proselect['id']}}">


					    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Product Name</label>
						  <div class="col-sm-10">
							<div class="input-group mb-3">
								<input type="text" class="form-control" value="{{$proselect['pro_name']}}" name="pro_name" placeholder="some text" value="">
							  </div>
						  </div>
						</div>
						
						 <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Product Commission (%)</label>
						  <div class="col-sm-10">
							<div class="input-group mb-3">
							        <input type="number" name="commission" id="commission" maxlength="2" value="{{old('commission' ,$proselect['commission'])}}" class="form-control" placeholder="%">
							  </div>
						  </div>
						</div>
                     
						
						<div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Product Image</label>
						  <div class="col-sm-4">
                          <div class="col-sm-12">
<P> <span><input type="file" name="pro_img" class="form-control" autocomplete="nope" ></span></P>
<input type="hidden" name="logohidden" value="{{$proselect['pro_img']}}">
<img src="{{('../uploads/product_images/product_single_img/'.$proselect->pro_img)}}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 90px; height: 55px;">
</div>
						  </div>
				
						  <label for="basic-input" class="col-sm-2 col-form-label">Product Images</label>
						  <div class="col-sm-4">
                          <div class="col-sm-12">
                              <P> <span><input type="file" name="pro_multi_img[]" multiple="multiple" class="form-control" autocomplete="nope" ></span></P>
@foreach(json_decode($proselect->pro_multi_img, true) as $key => $media_gallery)
                     <a href="{{ url('/uploads/product_images/product_multi_img/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                     <img src="{{ url('/uploads/product_images/product_multi_img/'.$media_gallery) }}" alt="lightbox" class="lightbox-thumb img-thumbnail" style="width: 90px; height: 55px;">
                     </a>
                     @endforeach
						  </div>
						</div>
						</div>
						
						<br>

			    <div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Product Price</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
							<input type="number" name="pro_price" value="{{$proselect['pro_price']}}" class="form-control" >
							  </div>
							  </div>
							  
							  	  <label for="basic-input" class="col-sm-2 col-form-label">Product Mrp</label>
						  <div class="col-sm-4">
							<div class="input-group mb-3">
                            
								<input type="number" name="pro_mrp" value="{{$proselect['pro_mrp']}}" class="form-control" >
							  </div>
                             
						  </div>
						</div>
				

		<div class="form-group row">
						  <label for="basic-input" class="col-sm-2 col-form-label">Description</label>
						  <div class="col-sm-10">
							<div class="input-group mb-3">
								<textarea name="editor" >{{$proselect['pro_description']}}</textarea>
							  </div>
						  </div>
						</div>

		
<p class="text-center"><button type="submit" value="submit"  class="btn btn-success" name="submit">Update</button></p>

					</form>
					</div>
		   
	    </div>
        </div>
								</div><!--end row-->
							</div>
					


   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
@endsection



