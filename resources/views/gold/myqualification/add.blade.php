@extends('layouts.user_layout')
@section('page_title','My Qualification')
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
			    <!--<i class="fa fa-file"></i>-->
				<h2>QUALIFIACTION</h2>
			</div>
			<form action="savequalifiaction" method="post" enctype="multipart/form-data">
				 @csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Qualifiaction Title</label>
						<input type="text" class="form-control" value="{{old('qualifiaction')}}" name="qualifiaction" placeholder="Qualifiaction" required>
					</div>
					 <p style="color:red;">@error('qualifiaction'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
			<div class="row">
				
				<div class="col-md-12">
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" value="{{old('description')}}" name="description" placeholder="Description" required></textarea>
					</div>
					<p style="color:red;">@error('description'){{$message}}@enderror</p>
				</div>
			</div>
			<!-- /row-->
			<button type="submit" class="btn btn_1 medium">Save</button>
			<!--<p><a href="#0" class="">Save</a></p>-->
			</form>
		</div>
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		
	  </div>
	  <!-- /.container-fluid-->
  
  

@endsection