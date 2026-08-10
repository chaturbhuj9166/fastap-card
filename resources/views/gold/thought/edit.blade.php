@extends('layouts.user_layout')
@section('page_title','My Photos')
@section('content')


    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item">-->
        <!--  <a href="#">Dashboard</a>-->
        <!--</li>-->
      <!--  <li class="breadcrumb-item active">My Profile</li>-->
      <!--</ol>-->
      <!--fds-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2>Photos Edit</h2>
			</div>
			<form action="updatethought" method="post" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="id" value="{{$thought->id}}" />
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Portfolio Title</label>
						<input type="text" value="{{$thought->thought}}" name="thought" class="form-control" placeholder="Portfolio Title">
					</div>
					<p style="color:red;">@error('$thought'){{$message}}@enderror</p>
				</div>
				
				<!-- <div class="col-md-6">
					<div class="form-group">
						<label>Image</label>
						<input type="file" class="form-control" >
					</div>
					
				</div> -->
			</div>

			<div class="row">
				
				<div class="col-md-12">
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" value="{{$thought->description}}" name="description" placeholder="Description">{{$thought->description}}</textarea>
					</div>
					<p style="color:red;">@error('description'){{$message}}@enderror</p>
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