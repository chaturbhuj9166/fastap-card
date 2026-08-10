@extends('layouts.user_layout')
@section('page_title','My Product')
@section('content')


    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item">-->
        <!--  <a href="#">Dashboard</a>-->
        <!--</li>-->
      <!--  <li class="breadcrumb-item active">My Profile</li>-->
      <!--</ol>-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>Edit Product</h2>
			</div>
			<form method="post" action="updatemyproduct" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				 <input type="hidden" name="id" value="{{$myproducts->id}}"></input>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Product Title</label>
						<input type="text" class="form-control" value="{{$myproducts->title}}" name="title" placeholder="Product Title">
					</div>
					<p style="color:red;">@error('title'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Image</label>
						<input multiple type="file" class="form-control" value="{{$myproducts['images']}}" name="images[]">
    						@foreach(json_decode($myproducts->images) as $images)
    					    	<img src="{{url('frontend/myproducts/'.$images)}}" width="70" />
    						@endforeach
					</div>
					<p style="color:red;">@error('images'){{$message}}@enderror</p>
				</div>
			</div>
		 
			<!-- /row-->
			<button type="submit" class="btn btn_1 medium" name="submit">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection