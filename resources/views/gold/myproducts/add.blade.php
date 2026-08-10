@extends('layouts.user_layout')
@section('page_title','My Products')
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
				<h2>Products</h2>
			</div>
			<form method="post" action="savemyproduct" enctype="multipart/form-data">
				@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Product Title</label>
						<input type="text" class="form-control" value="{{old('title')}}" name="title" placeholder="Product Title" >
					</div>
					<p style="color:red;">@error('title'){{$message}}@enderror</p>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Image</label>
						<input multiple type="file" class="form-control" value="{{old('images')}}" name="images[]" >
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